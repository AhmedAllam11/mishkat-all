<?php
/**
 * واجهة برمجية التطبيقات (API) المركزية للمنصة
 * هذا الملف هو النقطة الأساسية للتعامل مع كافة طلبات البيانات (Requests) من الواجهة الأمامية (Front-End)
 * يقوم باستقبال نوع الإجراء (action) وتنفيذه على قاعدة البيانات ثم إعادة النتيجة بصيغة JSON
 */
session_start();
require_once '../includes/db.php';

ob_start(); // تخزين المخرجات لمنع ظهور التحذيرات التي قد تفسد صيغة JSON
header('Content-Type: application/json; charset=utf-8');

/**
 * وظيفة لإرسال المخرجات بصيغة JSON وإنهاء التنفيذ
 */
function jsonOut($data) { 
    ob_clean(); 
    echo json_encode($data, JSON_UNESCAPED_UNICODE); 
    exit; 
}

/**
 * وظيفة للتحقق من الصلاحيات
 */
function denied() { jsonOut(['success'=>false,'message'=>'غير مصرح بالدخول']); }

/**
 * جلب معرف المستخدم الحالي
 */
function getUID() { return $_SESSION['user_id'] ?? 0; }

/**
 * جلب دور المستخدم الحالي (طالب، معلم، إلخ)
 */
function getRole() { return $_SESSION['user_role'] ?? ''; }

/**
 * تنفيذ استعلام في قاعدة البيانات مع معالجة الأخطاء
 */
function dbQuery($sql) {
    global $conn;
    $r = $conn->query($sql);
    if (!$r) jsonOut(['success'=>false, 'message'=>'خطأ في قاعدة البيانات: '.$conn->error]);
    return $r;
}

function handleUpload($fileKey, $folder = 'uploads/') {
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] !== UPLOAD_ERR_OK) return null;
    if (!is_dir($folder)) mkdir($folder, 0777, true);
    $ext = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . '.' . $ext;
    $target = $folder . $newName;
    if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target)) return $target;
    return null;
}

$action = $_REQUEST['action'] ?? '';
$uid = getUID();

// Public actions (no auth needed)
if ($action === 'get_public_courses') {
    $r = dbQuery("SELECT * FROM courses WHERE status='active' ORDER BY id");
    $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);
}
if ($action === 'get_public_teachers') {
    $r = $conn->query("SELECT u.id,u.name, ti.* FROM users u JOIN teachers_info ti ON u.id=ti.user_id WHERE u.role='teacher' AND u.status='active'");
    $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);
}

// Auth required
if (!$uid) denied();
$role = getRole();

switch($action) {
// ── TASKS ──
case 'get_tasks':
    $r = $conn->query("SELECT t.*, IFNULL(ut.completed,0) as completed FROM tasks t LEFT JOIN user_tasks ut ON t.id=ut.task_id AND ut.user_id=$uid ORDER BY t.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'complete_task':
    $tid = intval($_POST['task_id'] ?? 0);
    if(!$tid) jsonOut(['success'=>false,'message'=>'معرف المهمة مطلوب']);
    $ch = $conn->query("SELECT id FROM user_tasks WHERE user_id=$uid AND task_id=$tid");
    if($ch->num_rows>0) $conn->query("UPDATE user_tasks SET completed=1,completion_date=NOW() WHERE user_id=$uid AND task_id=$tid");
    else $conn->query("INSERT INTO user_tasks(user_id,task_id,completed,completion_date) VALUES($uid,$tid,1,NOW())");
    jsonOut(['success'=>true]);

case 'toggle_task':
    $tid = intval($_POST['id'] ?? 0);
    $status = intval($_POST['status'] ?? 0);
    $ch = $conn->query("SELECT id FROM user_tasks WHERE user_id=$uid AND task_id=$tid");
    if($ch->num_rows>0) $conn->query("UPDATE user_tasks SET completed=$status, completion_date=".($status?"NOW()":"NULL")." WHERE user_id=$uid AND task_id=$tid");
    else $conn->query("INSERT INTO user_tasks(user_id,task_id,completed,completion_date) VALUES($uid,$tid,$status,".($status?"NOW()":"NULL").")");
    jsonOut(['success'=>true]);

case 'add_task':
    if($role!=='admin' && $role!=='teacher') denied();
    $stmt=$conn->prepare("INSERT INTO tasks(title,description,type,deadline,status,assigned_by) VALUES(?,?,?,?,?,?)");
    $t=$_POST['title'];$desc=$_POST['description']??'';$tp=$_POST['type']??'book';$dl=$_POST['deadline']??'';$st=$_POST['status']??'اعتيادي';
    $stmt->bind_param("sssssi",$t,$desc,$tp,$dl,$st,$uid);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

case 'delete_task':
    if($role!=='admin' && $role!=='teacher') denied();
    $tid=intval($_POST['task_id']??0);
    $conn->query("DELETE FROM tasks WHERE id=$tid");
    jsonOut(['success'=>true]);

// ── NOTIFICATIONS ──
case 'get_notifications':
    $r=$conn->query("SELECT * FROM notifications WHERE user_id=$uid ORDER BY created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    $unread=$conn->query("SELECT COUNT(*) as c FROM notifications WHERE user_id=$uid AND is_read=0")->fetch_assoc()['c'];
    jsonOut(['success'=>true,'data'=>$d,'unread'=>$unread]);

case 'read_notification':
    $nid=intval($_POST['notif_id']??0);
    $conn->query("UPDATE notifications SET is_read=1 WHERE id=$nid AND user_id=$uid");
    jsonOut(['success'=>true]);

case 'read_all_notifications':
    $conn->query("UPDATE notifications SET is_read=1 WHERE user_id=$uid");
    jsonOut(['success'=>true]);

case 'send_notification':
    if($role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO notifications(user_id,title,message,type) VALUES(?,?,?,?)");
    $to=intval($_POST['to_user']);$t=$_POST['title'];$m=$_POST['message'];$tp=$_POST['type']??'system';
    $stmt->bind_param("isss",$to,$t,$m,$tp);
    $stmt->execute();
    jsonOut(['success'=>true]);

// ── CALENDAR ──
case 'get_events':
    $r=$conn->query("SELECT * FROM calendar_events WHERE user_id=$uid ORDER BY event_date,event_time");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_event':
    $stmt=$conn->prepare("INSERT INTO calendar_events(user_id,title,description,event_date,event_time,type,color) VALUES(?,?,?,?,?,?,?)");
    $t=$_POST['title'];$desc=$_POST['description']??'';$ed=$_POST['event_date'];$et=$_POST['event_time']??'00:00';$tp=$_POST['type']??'class';$cl=$_POST['color']??'emerald';
    $stmt->bind_param("issssss",$uid,$t,$desc,$ed,$et,$tp,$cl);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

case 'delete_event':
    $eid=intval($_POST['event_id']??0);
    $conn->query("DELETE FROM calendar_events WHERE id=$eid AND user_id=$uid");
    jsonOut(['success'=>true]);

// ── COURSES ──
case 'get_courses':
    $r = dbQuery("SELECT * FROM courses ORDER BY created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_course':
    if($role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO courses(title,type,description,content_type,content_data,sessions_count,price,color) VALUES(?,?,?,?,?,?,?,?)");
    $t=$_POST['title'];$tp=$_POST['type']??'';$desc=$_POST['description']??'';$sc=$_POST['sessions_count']??'';$pr=floatval($_POST['price']??0);$cl=$_POST['color']??'emerald';
    $ct=$_POST['content_type']??'text';$cd=$_POST['content_data']??'';
    if ($ct === 'file') {
        $uploaded = handleUpload('video_file');
        if ($uploaded) $cd = $uploaded;
    }
    $stmt->bind_param("ssssssds",$t,$tp,$desc,$ct,$cd,$sc,$pr,$cl);
    $stmt->execute();
    $newCourseId = $stmt->insert_id;

    if(!empty($cd)) {
        $titlePrefix = "مقدمة: " . $t;
        $introDesc = "محتوى الدورة الرئيسي المضاف من الإدارة";
        $stmt2 = $conn->prepare("INSERT INTO episodes(course_id, teacher_id, title, description, content_type, content_data) VALUES(?,?,?,?,?,?)");
        $stmt2->bind_param("iissss", $newCourseId, $uid, $titlePrefix, $introDesc, $ct, $cd);
        $stmt2->execute();
    }
    jsonOut(['success'=>true,'id'=>$newCourseId]);

case 'update_course':
    if($role!=='admin') denied();
    $cid=intval($_POST['course_id']);
    $stmt=$conn->prepare("UPDATE courses SET title=?,type=?,description=?,content_type=?,content_data=?,sessions_count=?,price=?,color=? WHERE id=?");
    $t=$_POST['title'];$tp=$_POST['type']??'';$desc=$_POST['description']??'';$sc=$_POST['sessions_count']??'';$pr=floatval($_POST['price']??0);$cl=$_POST['color']??'emerald';
    $ct=$_POST['content_type']??'text';$cd=$_POST['content_data']??'';
    if ($ct === 'file') {
        $uploaded = handleUpload('video_file');
        if ($uploaded) $cd = $uploaded;
    }
    $stmt->bind_param("ssssssdsi",$t,$tp,$desc,$ct,$cd,$sc,$pr,$cl,$cid);
    $stmt->execute();
    jsonOut(['success'=>true]);

case 'delete_course':
    if($role!=='admin') denied();
    $cid=intval($_POST['course_id']);
    $conn->query("DELETE FROM courses WHERE id=$cid");
    jsonOut(['success'=>true]);

// ── USERS / STUDENTS ──
case 'get_users':
    if($role!=='admin' && $role!=='teacher') denied();
    $filter=$_GET['role_filter']??'';
    $where = $filter ? "WHERE role='".addslashes($filter)."'" : "";
    $r=$conn->query("SELECT id,name,email,phone,role,status,gender,created_at FROM users $where ORDER BY created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'get_students':
    if($role!=='admin' && $role!=='teacher') denied();
    $r=$conn->query("SELECT u.id,u.name,u.email,u.phone,u.status,u.created_at,
        e.course_id, c.title as course_title, e.progress
        FROM users u 
        LEFT JOIN enrollments e ON u.id=e.user_id 
        LEFT JOIN courses c ON e.course_id=c.id 
        WHERE u.role='student' ORDER BY u.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_user':
    if($role!=='admin') denied();
    $n=$_POST['name'];$e=$_POST['email'];$p=password_hash($_POST['password']??'123456',PASSWORD_DEFAULT);$r2=$_POST['role']??'student';$ph=$_POST['phone']??'';
    $ch=$conn->query("SELECT id FROM users WHERE email='".addslashes($e)."'");
    if($ch->num_rows>0) jsonOut(['success'=>false,'message'=>'البريد مسجل مسبقاً']);
    $stmt=$conn->prepare("INSERT INTO users(name,email,password,role,phone) VALUES(?,?,?,?,?)");
    $stmt->bind_param("sssss",$n,$e,$p,$r2,$ph);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

case 'update_user':
    if($role!=='admin' && $uid!=intval($_POST['user_id'])) denied();
    $target=intval($_POST['user_id']);
    $stmt=$conn->prepare("UPDATE users SET name=?,email=?,phone=?,status=? WHERE id=?");
    $n=$_POST['name'];$e=$_POST['email'];$ph=$_POST['phone']??'';$st=$_POST['status']??'active';
    $stmt->bind_param("ssssi",$n,$e,$ph,$st,$target);
    $stmt->execute();
    jsonOut(['success'=>true]);

case 'delete_user':
    if($role!=='admin') denied();
    $target=intval($_POST['user_id']);
    $conn->query("DELETE FROM users WHERE id=$target");
    jsonOut(['success'=>true]);

case 'toggle_user_status':
    if($role!=='admin') denied();
    $target=intval($_POST['user_id']);
    $force = $_POST['force_status'] ?? '';
    if ($force) {
        $new = $force;
    } else {
        $cur=$conn->query("SELECT status FROM users WHERE id=$target")->fetch_assoc()['status'];
        $new = $cur==='active' ? 'suspended' : 'active';
    }
    $conn->query("UPDATE users SET status='$new' WHERE id=$target");
    jsonOut(['success'=>true,'new_status'=>$new]);

// ── PROFILE ──
case 'get_profile':
    $r=$conn->query("SELECT id,name,email,phone,gender,location,role,status,created_at FROM users WHERE id=$uid")->fetch_assoc();
    jsonOut(['success'=>true,'data'=>$r]);

    jsonOut(['success'=>true]);

case 'link_student':
    if ($_SESSION['user_role'] !== 'parent') jsonOut(['success'=>false, 'message'=>'غير مصرح لك']);
    $studentName = trim($_POST['student_name'] ?? '');
    $studentEmail = trim($_POST['student_email'] ?? '');
    
    if (empty($studentName) || empty($studentEmail)) {
        jsonOut(['success'=>false, 'message'=>'يرجى إدخال اسم الطالب والبريد الإلكتروني']);
    }
    
    // Find student
    $stmt = $conn->prepare("SELECT id FROM users WHERE role='student' AND email=? AND name=?");
    $stmt->bind_param("ss", $studentEmail, $studentName);
    $stmt->execute();
    $res = $stmt->get_result();
    
    if ($res->num_rows === 0) {
        jsonOut(['success'=>false, 'message'=>'لم يتم العثور على طالب مسجل بهذا الاسم والبريد الإلكتروني. يرجى التأكد من البيانات.']);
    }
    
    $student = $res->fetch_assoc();
    $studentId = $student['id'];
    
    // Check if already linked
    $check = $conn->query("SELECT id FROM parent_student WHERE parent_id=$uid AND student_id=$studentId");
    if ($check->num_rows > 0) {
        jsonOut(['success'=>false, 'message'=>'هذا الطالب مضاف لديك مسبقاً']);
    }
    
    // Link
    $conn->query("INSERT INTO parent_student (parent_id, student_id) VALUES ($uid, $studentId)");
    jsonOut(['success'=>true, 'message'=>'تم ربط حساب الطالب بنجاح!']);

case 'update_teacher_profile':
    if($role!=='teacher' && $role!=='admin') denied();
    $target_uid = ($role==='admin' && isset($_POST['user_id'])) ? intval($_POST['user_id']) : $uid;
    
    // Update users table
    $stmt1 = $conn->prepare("UPDATE users SET name=?, phone=?, location=? WHERE id=?");
    $n = $_POST['name']; $ph = $_POST['phone'] ?? ''; $loc = $_POST['location'] ?? '';
    $stmt1->bind_param("sssi", $n, $ph, $loc, $target_uid);
    $stmt1->execute();
    
    // Update teachers_info table
    $stmt2 = $conn->prepare("UPDATE teachers_info SET specialty=?, experience_years=?, location=?, cv_url=?, bio=? WHERE user_id=?");
    $spec = $_POST['specialty'] ?? ''; $exp = intval($_POST['experience'] ?? 0); 
    $cv = $_POST['cv_url'] ?? ''; $bio = $_POST['bio'] ?? '';
    $stmt2->bind_param("sisssi", $spec, $exp, $loc, $cv, $bio, $target_uid);
    $stmt2->execute();
    
    $_SESSION['user_name'] = $n;
    jsonOut(['success'=>true]);

case 'update_student_profile':
    if($role!=='student' && $role!=='admin') denied();
    $target_uid = ($role==='admin' && isset($_POST['user_id'])) ? intval($_POST['user_id']) : $uid;
    
    $stmt = $conn->prepare("UPDATE users SET name=?, phone=?, gender=?, age=?, location=? WHERE id=?");
    $n = $_POST['name']; $ph = $_POST['phone'] ?? ''; $g = $_POST['gender'] ?? 'ذكر';
    $a = intval($_POST['age'] ?? 0); $loc = $_POST['location'] ?? '';
    $stmt->bind_param("sssisi", $n, $ph, $g, $a, $loc, $target_uid);
    $stmt->execute();
    
    $_SESSION['user_name'] = $n;
    jsonOut(['success'=>true]);

case 'change_password':
    $old=$_POST['old_password'];$new=$_POST['new_password'];
    $cur=$conn->query("SELECT password FROM users WHERE id=$uid")->fetch_assoc()['password'];
    if(!password_verify($old,$cur)) jsonOut(['success'=>false,'message'=>'كلمة المرور الحالية غير صحيحة']);
    $hashed=password_hash($new,PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$hashed' WHERE id=$uid");
    jsonOut(['success'=>true]);

// ── ENROLLMENTS ──
case 'get_enrollments':
    $target = ($role==='admin'||$role==='teacher') ? '' : "WHERE e.user_id=$uid";
    $r=$conn->query("SELECT e.*,c.title,c.type,c.color,u.name as student_name FROM enrollments e JOIN courses c ON e.course_id=c.id JOIN users u ON e.user_id=u.id $target ORDER BY e.enrolled_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'enroll_course':
    $cid=intval($_POST['course_id']);
    $ch=$conn->query("SELECT id FROM enrollments WHERE user_id=$uid AND course_id=$cid");
    if($ch->num_rows>0) jsonOut(['success'=>false,'message'=>'مسجل بالفعل']);
    $conn->query("INSERT INTO enrollments(user_id,course_id) VALUES($uid,$cid)");
    $conn->query("UPDATE courses SET students_count=students_count+1 WHERE id=$cid");
    jsonOut(['success'=>true]);

case 'get_library':
    $cat = $_GET['category'] ?? '';
    $where = $cat ? "WHERE li.category='".addslashes($cat)."'" : '';
    $r = dbQuery("SELECT li.*, u.name as author FROM library_items li LEFT JOIN users u ON li.uploaded_by = u.id $where ORDER BY li.created_at DESC");
    $d = []; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true, 'data'=>$d]);

case 'add_library_item':
    if($role!=='admin' && $role!=='teacher') denied();
    $stmt=$conn->prepare("INSERT INTO library_items(title,category,type,description,file_url,uploaded_by) VALUES(?,?,?,?,?,?)");
    $t=$_POST['title'];$cat=$_POST['category']??'';$tp=$_POST['type']??'pdf';$desc=$_POST['description']??'';$url=$_POST['file_url']??'';
    $stmt->bind_param("sssssi",$t,$cat,$tp,$desc,$url,$uid);
    $stmt->execute();
    jsonOut(['success'=>true, 'id'=>$stmt->insert_id]);

case 'delete_library_item':
    if($role!=='admin' && $role!=='teacher') denied();
    $lid=intval($_POST['item_id']);
    $where = ($role === 'admin') ? "id=$lid" : "id=$lid AND uploaded_by=$uid";
    $conn->query("DELETE FROM library_items WHERE $where");
    jsonOut(['success'=>true]);

case 'update_library_item':
    if($role!=='admin' && $role!=='teacher') denied();
    $lid=intval($_POST['item_id']);
    $stmt=$conn->prepare("UPDATE library_items SET title=?, category=?, type=?, description=?, file_url=? WHERE id=? AND (uploaded_by=? OR '$role'='admin')");
    $t=$_POST['title'];$cat=$_POST['category'];$tp=$_POST['type'];$desc=$_POST['description'];$url=$_POST['file_url'];
    $stmt->bind_param("sssssii", $t, $cat, $tp, $desc, $url, $lid, $uid);
    $stmt->execute();
    jsonOut(['success'=>true]);

// ── CIRCLES ──
case 'get_circles':
    $r=$conn->query("SELECT ci.*,u.name as teacher_name,(SELECT COUNT(*) FROM circle_students WHERE circle_id=ci.id) as current_students FROM circles ci JOIN users u ON ci.teacher_id=u.id ORDER BY ci.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_circle':
    if($role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO circles(name,teacher_id,max_students,schedule) VALUES(?,?,?,?)");
    $n=$_POST['name'];$tid=intval($_POST['teacher_id']);$mx=intval($_POST['max_students']??20);$sch=$_POST['schedule']??'';
    $stmt->bind_param("siis",$n,$tid,$mx,$sch);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

case 'delete_circle':
    if($role!=='admin') denied();
    $cid=intval($_POST['circle_id']);
    $conn->query("DELETE FROM circles WHERE id=$cid");
    jsonOut(['success'=>true]);

// ── EVALUATIONS ──
case 'get_evaluations':
    $w = $role==='teacher' ? "WHERE ev.teacher_id=$uid" : ($role==='student' ? "WHERE ev.student_id=$uid" : "");
    $r=$conn->query("SELECT ev.*,u.name as student_name,t.name as teacher_name FROM evaluations ev JOIN users u ON ev.student_id=u.id JOIN users t ON ev.teacher_id=t.id $w ORDER BY ev.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_evaluation':
    if($role!=='teacher' && $role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO evaluations(teacher_id,student_id,memorization,tajweed,behavior,attendance,notes) VALUES(?,?,?,?,?,?,?)");
    $sid=intval($_POST['student_id']);$mem=intval($_POST['memorization']??0);$taj=intval($_POST['tajweed']??0);$beh=intval($_POST['behavior']??0);$att=intval($_POST['attendance']??0);$notes=$_POST['notes']??'';
    $stmt->bind_param("iiiiiis",$uid,$sid,$mem,$taj,$beh,$att,$notes);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

// ── TRACKING ──
case 'get_tracking':
    $target = $role==='student' ? $uid : intval($_GET['student_id']??$uid);
    $r=$conn->query("SELECT st.*,u.name as recorder_name FROM student_tracking st LEFT JOIN users u ON st.recorded_by=u.id WHERE st.student_id=$target ORDER BY st.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'add_tracking':
    if($role!=='teacher' && $role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO student_tracking(student_id,surah,from_ayah,to_ayah,quality,notes,recorded_by) VALUES(?,?,?,?,?,?,?)");
    $sid=intval($_POST['student_id']);$su=$_POST['surah'];$fa=intval($_POST['from_ayah']??1);$ta=intval($_POST['to_ayah']??1);$q=$_POST['quality']??'جيد';$n=$_POST['notes']??'';
    $stmt->bind_param("isiiisi",$sid,$su,$fa,$ta,$q,$n,$uid);
    $stmt->execute();
    jsonOut(['success'=>true]);

// ── PAYMENTS ──
case 'get_payments':
    $target = $role==='admin' ? '' : "WHERE p.user_id=$uid";
    $r=$conn->query("SELECT p.*,u.name as user_name FROM payments p JOIN users u ON p.user_id=u.id $target ORDER BY p.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

case 'process_payment':
    $amt=floatval($_POST['amount']??0);$desc=$_POST['description']??'';$method=$_POST['method']??'card';
    if($amt<=0) jsonOut(['success'=>false,'message'=>'مبلغ غير صالح']);
    $stmt=$conn->prepare("INSERT INTO payments(user_id,amount,method,status,description) VALUES(?,?,?,'completed',?)");
    $stmt->bind_param("idss",$uid,$amt,$method,$desc);
    $stmt->execute();
    jsonOut(['success'=>true,'id'=>$stmt->insert_id]);

// ── SUBSCRIPTIONS ──
case 'get_subscriptions':
    $target = $role==='admin' ? '' : "WHERE s.user_id=$uid";
    $r=$conn->query("SELECT s.*,u.name as user_name FROM subscriptions s JOIN users u ON s.user_id=u.id $target ORDER BY s.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

// ── EPISODES / SESSIONS ──
case 'get_episodes':
    $cid = intval($_GET['course_id'] ?? 0);
    $where = $cid ? "WHERE e.course_id=$cid" : "";
    $r = dbQuery("SELECT e.*, c.title as course_title, 
        (SELECT COUNT(*) FROM quizzes q WHERE q.episode_id = e.id) as has_quiz,
        (SELECT completed FROM user_episodes WHERE user_id=$uid AND episode_id=e.id) as completed 
        FROM episodes e JOIN courses c ON e.course_id=c.id $where ORDER BY e.created_at ASC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true, 'data'=>$d]);

case 'add_episode':
    if($role!=='teacher' && $role!=='admin') denied();
    $stmt=$conn->prepare("INSERT INTO episodes(course_id,teacher_id,title,description,content_type,content_data) VALUES(?,?,?,?,?,?)");
    $cid=intval($_POST['course_id']);$t=$_POST['title'];$desc=$_POST['description']??'';$ct=$_POST['content_type']??'text';$cd=$_POST['content_data']??'';
    if ($ct === 'file') {
        $uploaded = handleUpload('video_file');
        if ($uploaded) $cd = $uploaded;
    }
    $stmt->bind_param("iissss",$cid,$uid,$t,$desc,$ct,$cd);
    if(!$stmt->execute()) jsonOut(['success'=>false, 'message'=>'خطأ في حفظ الحلقة: '.$stmt->error]);
    $eid = $stmt->insert_id;
    
    // Notify students enrolled in this course
    $course = $conn->query("SELECT title FROM courses WHERE id=$cid")->fetch_assoc();
    $cTitle = $course['title'];
    $conn->query("INSERT INTO notifications (user_id, title, message, type) 
                  SELECT user_id, 'حلقة جديدة', 'تم إضافة حلقة جديدة: $t في دورة $cTitle', 'system' 
                  FROM enrollments WHERE course_id=$cid");
                  
    jsonOut(['success'=>true, 'id'=>$eid]);

case 'update_episode':
    if($role!=='teacher' && $role!=='admin') denied();
    $eid=intval($_POST['episode_id']);
    $stmt=$conn->prepare("UPDATE episodes SET title=?,description=?,content_type=?,content_data=? WHERE id=?");
    $t=$_POST['title'];$desc=$_POST['description']??'';$ct=$_POST['content_type']??'text';$cd=$_POST['content_data']??'';
    if ($ct === 'file') {
        $uploaded = handleUpload('video_file');
        if ($uploaded) $cd = $uploaded;
    }
    $stmt->bind_param("ssssi",$t,$desc,$ct,$cd,$eid);
    $stmt->execute();
    jsonOut(['success'=>true]);

case 'delete_episode':
    if($role!=='teacher' && $role!=='admin') denied();
    $eid=intval($_POST['episode_id']);
    $conn->query("DELETE FROM episodes WHERE id=$eid");
    jsonOut(['success'=>true]);

case 'get_episode_quiz':
    $eid = intval($_GET['episode_id']);
    $quiz = $conn->query("SELECT * FROM quizzes WHERE episode_id=$eid")->fetch_assoc();
    if(!$quiz) jsonOut(['success'=>false, 'message'=>'لا يوجد اختبار لهذه الحلقة']);
    $qid = $quiz['id'];
    $questions = $conn->query("SELECT * FROM quiz_questions WHERE quiz_id=$qid");
    $qs = []; while($qrow=$questions->fetch_assoc()) {
        $qrow['options'] = json_decode($qrow['options']);
        $qs[] = $qrow;
    }
    jsonOut(['success'=>true, 'quiz'=>$quiz, 'questions'=>$qs]);

case 'add_quiz':
    if($role!=='teacher' && $role!=='admin') denied();
    $eid = intval($_POST['episode_id']);
    $title = $_POST['title'];
    // Clear old quiz
    $conn->query("DELETE FROM quizzes WHERE episode_id=$eid");
    $conn->query("INSERT INTO quizzes(episode_id, title) VALUES($eid, '$title')");
    $qid = $conn->insert_id;
    
    if(isset($_POST['questions'])) {
        $questions = json_decode($_POST['questions'], true);
        foreach($questions as $q) {
            $stmt = $conn->prepare("INSERT INTO quiz_questions(quiz_id, question, options, correct_answer) VALUES(?,?,?,?)");
            $opts = json_encode($q['options'], JSON_UNESCAPED_UNICODE);
            $stmt->bind_param("isss", $qid, $q['question'], $opts, $q['correct_answer']);
            $stmt->execute();
        }
    }
    jsonOut(['success'=>true, 'quiz_id'=>$qid]);

case 'submit_quiz_result':
    $eid = intval($_POST['episode_id']);
    $score = intval($_POST['score']);
    $total = intval($_POST['total']);
    $pct = round(($score/$total)*100, 2);
    
    // Save Result
    $ep = $conn->query("SELECT title, course_id FROM episodes WHERE id=$eid")->fetch_assoc();
    $title = "اختبار: " . $ep['title'];
    $stmt = $conn->prepare("INSERT INTO exam_results(user_id, exam_title, score, total, percentage) VALUES(?,?,?,?,?)");
    $stmt->bind_param("isiid", $uid, $title, $score, $total, $pct);
    $stmt->execute();
    
    // Mark Episode as Completed
    $conn->query("INSERT INTO user_episodes (user_id, episode_id, completed, completed_at) 
                  VALUES ($uid, $eid, 1, NOW()) ON DUPLICATE KEY UPDATE completed=1, completed_at=NOW()");
    
    // Update Course Progress
    $courseId = $ep['course_id'];
    $totalEp = $conn->query("SELECT COUNT(*) as c FROM episodes WHERE course_id=$courseId")->fetch_assoc()['c'];
    $doneEp = $conn->query("SELECT COUNT(*) as c FROM user_episodes ue JOIN episodes e ON ue.episode_id=e.id WHERE ue.user_id=$uid AND e.course_id=$courseId AND ue.completed=1")->fetch_assoc()['c'];
    $prog = ($totalEp > 0) ? round(($doneEp / $totalEp) * 100) : 0;
    $conn->query("UPDATE enrollments SET progress=$prog WHERE user_id=$uid AND course_id=$courseId");
    
    jsonOut(['success'=>true, 'percentage'=>$pct, 'progress'=>$prog]);

case 'complete_episode':
    $eid = intval($_POST['episode_id']);
    // Check if quiz exists
    $hasQuiz = $conn->query("SELECT id FROM quizzes WHERE episode_id=$eid")->num_rows > 0;
    
    if(!$hasQuiz) {
        // Mark as completed immediately if no quiz
        $conn->query("INSERT INTO user_episodes (user_id, episode_id, completed, completed_at) 
                      VALUES ($uid, $eid, 1, NOW()) ON DUPLICATE KEY UPDATE completed=1, completed_at=NOW()");
        
        $ep = $conn->query("SELECT course_id FROM episodes WHERE id=$eid")->fetch_assoc();
        $courseId = $ep['course_id'];
        $totalEp = $conn->query("SELECT COUNT(*) as c FROM episodes WHERE course_id=$courseId")->fetch_assoc()['c'];
        $doneEp = $conn->query("SELECT COUNT(*) as c FROM user_episodes ue JOIN episodes e ON ue.episode_id=e.id WHERE ue.user_id=$uid AND e.course_id=$courseId AND ue.completed=1")->fetch_assoc()['c'];
        $prog = ($totalEp > 0) ? round(($doneEp / $totalEp) * 100) : 0;
        $conn->query("UPDATE enrollments SET progress=$prog WHERE user_id=$uid AND course_id=$courseId");
        
        jsonOut(['success'=>true, 'message'=>'تم إكمال الحلقة بنجاح', 'progress'=>$prog, 'has_quiz'=>false]);
    } else {
        jsonOut(['success'=>true, 'has_quiz'=>true]);
    }

// ── SETTINGS (admin) ──
case 'get_settings':
    if($role!=='admin') denied();
    $r=$conn->query("SELECT * FROM settings ORDER BY id");
    $d=[]; while($row=$r->fetch_assoc()) $d[$row['setting_key']]=$row['setting_value'];
    jsonOut(['success'=>true,'data'=>$d]);

case 'update_settings':
    if($role!=='admin') denied();
    $settings = json_decode(file_get_contents('php://input'),true) ?? $_POST;
    foreach($settings as $k=>$v) {
        if($k==='action') continue;
        $stmt=$conn->prepare("INSERT INTO settings(setting_key,setting_value) VALUES(?,?) ON DUPLICATE KEY UPDATE setting_value=?");
        $stmt->bind_param("sss",$k,$v,$v);
        $stmt->execute();
    }
    jsonOut(['success'=>true]);

// ── DASHBOARD STATS ──
case 'get_dashboard_stats':
    $stats = [];
    if($role==='admin') {
        $stats['total_users'] = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
        $stats['students'] = $conn->query("SELECT COUNT(*) as c FROM users WHERE role='student'")->fetch_assoc()['c'];
        $stats['teachers'] = $conn->query("SELECT COUNT(*) as c FROM users WHERE role='teacher'")->fetch_assoc()['c'];
        $stats['parents'] = $conn->query("SELECT COUNT(*) as c FROM users WHERE role='parent'")->fetch_assoc()['c'];
        $stats['courses'] = $conn->query("SELECT COUNT(*) as c FROM courses")->fetch_assoc()['c'];
        $stats['circles'] = $conn->query("SELECT COUNT(*) as c FROM circles")->fetch_assoc()['c'];
        $stats['revenue'] = $conn->query("SELECT IFNULL(SUM(amount),0) as s FROM payments WHERE status='completed'")->fetch_assoc()['s'];
    } elseif($role==='student') {
        $stats['courses'] = $conn->query("SELECT COUNT(*) as c FROM enrollments WHERE user_id=$uid")->fetch_assoc()['c'];
        $stats['completed_tasks'] = $conn->query("SELECT COUNT(*) as c FROM user_tasks WHERE user_id=$uid AND completed=1")->fetch_assoc()['c'];
        $stats['pending_tasks'] = $conn->query("SELECT COUNT(*) as c FROM tasks t WHERE t.id NOT IN (SELECT task_id FROM user_tasks WHERE user_id=$uid AND completed=1)")->fetch_assoc()['c'];
        $stats['points'] = $stats['completed_tasks'] * 10;
    } elseif($role==='teacher') {
        $stats['students'] = $conn->query("SELECT COUNT(DISTINCT cs.student_id) as c FROM circle_students cs JOIN circles ci ON cs.circle_id=ci.id WHERE ci.teacher_id=$uid")->fetch_assoc()['c'];
        $stats['circles'] = $conn->query("SELECT COUNT(*) as c FROM circles WHERE teacher_id=$uid")->fetch_assoc()['c'];
        $stats['evaluations'] = $conn->query("SELECT COUNT(*) as c FROM evaluations WHERE teacher_id=$uid")->fetch_assoc()['c'];
    } elseif($role==='parent') {
        $children = $conn->query("SELECT student_id FROM parent_student WHERE parent_id=$uid");
        $ids = [];
        while($ch=$children->fetch_assoc()) $ids[]=$ch['student_id'];
        $stats['children_count'] = count($ids);
        if(!empty($ids)){
            $idStr=implode(',',$ids);
            $stats['children_tasks'] = $conn->query("SELECT COUNT(*) as c FROM user_tasks WHERE user_id IN($idStr) AND completed=1")->fetch_assoc()['c'];
        }
    }
    jsonOut(['success'=>true,'data'=>$stats]);

// ── PARENT: get children ──
case 'get_children':
    if($role!=='parent') denied();
    $r=$conn->query("SELECT u.id,u.name,u.email,u.phone,u.created_at FROM parent_student ps JOIN users u ON ps.student_id=u.id WHERE ps.parent_id=$uid");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

// ── TEACHERS ──
case 'get_teachers':
    $r=$conn->query("SELECT u.id,u.name,u.email,u.phone,u.status,ti.specialty,ti.experience_years,ti.location,ti.description,ti.rating FROM users u LEFT JOIN teachers_info ti ON u.id=ti.user_id WHERE u.role='teacher' ORDER BY u.created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

// ── EXAM RESULTS ──
case 'get_exam_results':
    $target = $role==='student' ? $uid : intval($_GET['student_id']??$uid);
    $r=$conn->query("SELECT * FROM exam_results WHERE user_id=$target ORDER BY created_at DESC");
    $d=[]; while($row=$r->fetch_assoc()) $d[]=$row;
    jsonOut(['success'=>true,'data'=>$d]);

// ── SEARCH ──
case 'search':
    $q = addslashes($_GET['q']??'');
    if(!$q) jsonOut(['success'=>true,'data'=>[]]);
    $results = [];
    $r=$conn->query("SELECT id,name,email,role FROM users WHERE name LIKE '%$q%' OR email LIKE '%$q%' LIMIT 10");
    while($row=$r->fetch_assoc()) $results[]=['type'=>'user','data'=>$row];
    $r=$conn->query("SELECT id,title FROM courses WHERE title LIKE '%$q%' LIMIT 5");
    while($row=$r->fetch_assoc()) $results[]=['type'=>'course','data'=>$row];
    jsonOut(['success'=>true,'data'=>$results]);

default:
    jsonOut(['success'=>false,'message'=>'إجراء غير معروف: '.$action]);
}
?>
