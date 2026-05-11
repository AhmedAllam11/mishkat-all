<?php
/**
 * واجهة برمجية التطبيقات (API) المركزية لمنصة مشكاة
 * =================================================
 * هذا الملف هو العصب الرئيسي للمنصة، حيث يستقبل كافة الطلبات من الواجهة الأمامية (JavaScript)
 * ويقوم بالتواصل مع قاعدة البيانات لتنفيذ العمليات المطلوبة (إضافة، حذف، تعديل، جلب بيانات).
 */

session_start();
require_once '../includes/db.php'; // الاتصال بقاعدة البيانات

ob_start(); // تخزين المخرجات لمنع ظهور التحذيرات التي قد تفسد صيغة JSON
header('Content-Type: application/json; charset=utf-8');

/**
 * وظيفة (jsonOut): ترسل البيانات بصيغة JSON وتنهي التنفيذ.
 * تستخدم لضمان أن الرد دائماً يكون مفهوماً من قبل الجافا سكريبت.
 */
function jsonOut($data) { 
    ob_clean(); 
    echo json_encode($data, JSON_UNESCAPED_UNICODE); 
    exit; 
}

/**
 * وظيفة (denied): تستخدم عند محاولة الوصول لبيانات غير مصرح بها.
 */
function denied() { jsonOut(['success'=>false,'message'=>'غير مصرح لك بالوصول لهذه البيانات']); }

/**
 * وظائف جلب معلومات الجلسة (Session)
 */
function getUID() { return $_SESSION['user_id'] ?? 0; }
function getRole() { return $_SESSION['user_role'] ?? ''; }

/**
 * وظيفة (dbQuery): لتنفيذ استعلامات قاعدة البيانات مع التحقق من الأخطاء.
 */
function dbQuery($sql) {
    global $conn;
    $r = $conn->query($sql);
    if (!$r) jsonOut(['success'=>false, 'message'=>'خطأ في قاعدة البيانات: '.$conn->error]);
    return $r;
}

/**
 * وظيفة (handleUpload): لمعالجة رفع الملفات (فيديو، صور، ملفات PDF).
 */
function handleUpload($fileKey, $folder = '../uploads/') {
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) return null;
    if (!is_dir($folder)) mkdir($folder, 0777, true);
    $ext = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . '.' . $ext;
    $target = $folder . $newName;
    if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target)) return 'uploads/' . $newName;
    return null;
}

// استقبال نوع الإجراء (Action)
$action = $_REQUEST['action'] ?? '';
$uid = getUID();

/**
 * 1. العمليات العامة (لا تتطلب تسجيل دخول)
 */
// جلب الدورات المتاحة للجميع في الصفحة الرئيسية
if ($action === 'get_public_courses') {
    $r = dbQuery("SELECT * FROM courses WHERE status='active' ORDER BY id");
    $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);
}
// جلب قائمة المعلمين لعرضها للزوار
if ($action === 'get_public_teachers') {
    $r = $conn->query("SELECT u.id,u.name, ti.* FROM users u JOIN teachers_info ti ON u.id=ti.user_id WHERE u.role='teacher' AND u.status='active'");
    $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);
}

/**
 * التحقق من تسجيل الدخول للعمليات التالية
 */
if (!$uid) denied();
$role = getRole();

switch($action) {
    
    // ── قسم المهام (TASKS) ──
    case 'get_tasks':
        // جلب المهام مع حالة الإكمال للمستخدم الحالي
        $r = $conn->query("SELECT t.*, IFNULL(ut.completed,0) as completed FROM tasks t LEFT JOIN user_tasks ut ON t.id=ut.task_id AND ut.user_id=$uid ORDER BY t.created_at DESC");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true,'data'=>$d]);

    case 'toggle_task':
        // تغيير حالة المهمة (مكتملة / غير مكتملة)
        $tid = intval($_POST['id'] ?? 0);
        $status = intval($_POST['status'] ?? 0);
        $ch = $conn->query("SELECT id FROM user_tasks WHERE user_id=$uid AND task_id=$tid");
        if($ch->num_rows>0) $conn->query("UPDATE user_tasks SET completed=$status, completion_date=".($status?"NOW()":"NULL")." WHERE user_id=$uid AND task_id=$tid");
        else $conn->query("INSERT INTO user_tasks(user_id,task_id,completed,completion_date) VALUES($uid,$tid,$status,".($status?"NOW()":"NULL").")");
        jsonOut(['success'=>true]);

    // ── قسم الإشعارات (NOTIFICATIONS) ──
    case 'get_notifications':
        // جلب الإشعارات الخاصة بالمستخدم
        $r=$conn->query("SELECT * FROM notifications WHERE user_id=$uid ORDER BY created_at DESC");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        $unread=$conn->query("SELECT COUNT(*) as c FROM notifications WHERE user_id=$uid AND is_read=0")->fetch_assoc()['c'];
        jsonOut(['success'=>true,'data'=>$d,'unread'=>$unread]);

    case 'read_notification':
        // تحديث إشعار معين ليصبح مقروءاً
        $nid=intval($_POST['notif_id']??0);
        $conn->query("UPDATE notifications SET is_read=1 WHERE id=$nid AND user_id=$uid");
        jsonOut(['success'=>true]);

    // ── قسم التقويم (CALENDAR) ──
    case 'get_events':
        // جلب أحداث التقويم (حصص، اختبارات)
        $r=$conn->query("SELECT * FROM calendar_events WHERE user_id=$uid ORDER BY event_date,event_time");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true,'data'=>$d]);

    case 'add_event':
        // إضافة حدث جديد للتقويم الشخصي
        $stmt=$conn->prepare("INSERT INTO calendar_events(user_id,title,description,event_date,event_time,type,color) VALUES(?,?,?,?,?,?,?)");
        $t=$_POST['title'];$desc=$_POST['description']??'';$ed=$_POST['event_date'];$et=$_POST['event_time']??'00:00';$tp=$_POST['type']??'class';$cl=$_POST['color']??'emerald';
        $stmt->bind_param("issssss",$uid,$t,$desc,$ed,$et,$tp,$cl);
        $stmt->execute();
        jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

    // ── قسم الدورات (COURSES) ──
    case 'get_courses':
        // جلب كافة الدورات المتاحة في النظام
        $r = dbQuery("SELECT * FROM courses ORDER BY created_at DESC");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true,'data'=>$d]);

    case 'enroll_course':
        // تسجيل طالب في دورة معينة
        $cid=intval($_POST['course_id']);
        $ch=$conn->query("SELECT id FROM enrollments WHERE user_id=$uid AND course_id=$cid");
        if($ch->num_rows>0) jsonOut(['success'=>false,'message'=>'أنت مسجل بالفعل في هذه الدورة']);
        $conn->query("INSERT INTO enrollments(user_id,course_id) VALUES($uid,$cid)");
        $conn->query("UPDATE courses SET students_count=students_count+1 WHERE id=$cid");
        jsonOut(['success'=>true]);

    // ── قسم الدروس والحلقات (EPISODES) ──
    case 'get_episodes':
        // جلب دروس دورة معينة مع حالة إنجاز الطالب لكل درس
        $cid = intval($_GET['course_id'] ?? 0);
        $where = $cid ? "WHERE e.course_id=$cid" : "";
        $r = dbQuery("SELECT e.*, c.title as course_title, 
            (SELECT COUNT(*) FROM quizzes q WHERE q.episode_id = e.id) as has_quiz,
            (SELECT completed FROM user_episodes WHERE user_id=$uid AND episode_id=e.id) as completed 
            FROM episodes e JOIN courses c ON e.course_id=c.id $where ORDER BY e.created_at ASC");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true, 'data'=>$d]);

    case 'complete_episode':
        // تسجيل إكمال الدرس وتحديث نسبة التقدم في الدورة
        $eid = intval($_POST['episode_id']);
        $hasQuiz = $conn->query("SELECT id FROM quizzes WHERE episode_id=$eid")->num_rows > 0;
        
        if(!$hasQuiz) {
            $conn->query("INSERT INTO user_episodes (user_id, episode_id, completed, completed_at) 
                          VALUES ($uid, $eid, 1, NOW()) ON DUPLICATE KEY UPDATE completed=1, completed_at=NOW()");
            
            // تحديث نسبة التقدم في الدورة
            $ep = $conn->query("SELECT course_id FROM episodes WHERE id=$eid")->fetch_assoc();
            $courseId = $ep['course_id'];
            $totalEp = $conn->query("SELECT COUNT(*) as c FROM episodes WHERE course_id=$courseId")->fetch_assoc()['c'];
            $doneEp = $conn->query("SELECT COUNT(*) as c FROM user_episodes ue JOIN episodes e ON ue.episode_id=e.id WHERE ue.user_id=$uid AND e.course_id=$courseId AND ue.completed=1")->fetch_assoc()['c'];
            $prog = ($totalEp > 0) ? round(($doneEp / $totalEp) * 100) : 0;
            $conn->query("UPDATE enrollments SET progress=$prog WHERE user_id=$uid AND course_id=$courseId");
            
            jsonOut(['success'=>true, 'message'=>'تم إكمال الدرس', 'progress'=>$prog, 'has_quiz'=>false]);
        } else {
            jsonOut(['success'=>true, 'has_quiz'=>true]);
        }

    // ── قسم المكتبة (LIBRARY) ──
    case 'get_library':
        // جلب الكتب والمواد من المكتبة الإسلامية
        $cat = $_GET['category'] ?? '';
        $where = $cat ? "WHERE li.category='".addslashes($cat)."'" : '';
        $r = dbQuery("SELECT li.*, u.name as author FROM library_items li LEFT JOIN users u ON li.uploaded_by = u.id $where ORDER BY li.created_at DESC");
        $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true, 'data'=>$d]);

    // ── إدارة المستخدمين (للمدير والمعلم) ──
    case 'get_students':
        if($role!=='admin' && $role!=='teacher') denied();
        $r=$conn->query("SELECT u.id,u.name,u.email,u.phone,u.status,u.created_at FROM users u WHERE u.role='student' ORDER BY u.created_at DESC");
        $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
        jsonOut(['success'=>true,'data'=>$d]);

    // ── إحصائيات لوحة التحكم (DASHBOARD STATS) ──
    case 'get_dashboard_stats':
        $stats = [];
        if($role==='admin') {
            $stats['total_users'] = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
            $stats['courses'] = $conn->query("SELECT COUNT(*) as c FROM courses")->fetch_assoc()['c'];
            $stats['revenue'] = $conn->query("SELECT IFNULL(SUM(amount),0) as s FROM payments WHERE status='completed'")->fetch_assoc()['s'];
        } elseif($role==='student') {
            $stats['courses'] = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE user_id=$uid")->fetch_assoc()['c'];
            $stats['completed_tasks'] = $conn->query("SELECT COUNT(*) as c FROM user_tasks WHERE user_id=$uid AND completed=1")->fetch_assoc()['c'];
        }
        jsonOut(['success'=>true,'data'=>$stats]);

    // ── ملف المستخدم (PROFILE) ──
    case 'get_profile':
        $r=$conn->query("SELECT id,name,email,phone,gender,location,role,status,created_at FROM users WHERE id=$uid")->fetch_assoc();
        jsonOut(['success'=>true,'data'=>$r]);

    default:
        jsonOut(['success'=>false,'message'=>'الإجراء المطلوب غير موجود: '.$action]);
}
?>
