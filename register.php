<?php
/**
 * صفحة إنشاء حساب جديد
 * تتيح للطلاب والمعلمين وأولياء الأمور التسجيل في المنصة
 */
ob_start();
session_start();
require_once 'includes/db.php';

$error = '';
$success_msg = '';

// معالجة طلب التسجيل
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $role = $_POST['role'] ?? 'student';
    $password = $_POST['password'] ?? '';
    $gender = $_POST['gender'] ?? 'ذكر';
    $age = intval($_POST['age'] ?? 0);
    $location = $_POST['location'] ?? '';
    
    // بيانات خاصة بالمعلمين
    $specialty = $_POST['specialty'] ?? '';
    $experience = $_POST['experience'] ?? 0;
    $cv_path = '';

    // بيانات خاصة بأولياء الأمور
    $student_name = trim($_POST['student_name'] ?? '');
    $student_email = trim($_POST['student_email'] ?? '');

    // معالجة رفع السيرة الذاتية للمعلمين
    if ($role === 'teacher' && isset($_FILES['cv_file']) && $_FILES['cv_file']['error'] === 0) {
        $ext = pathinfo($_FILES['cv_file']['name'], PATHINFO_EXTENSION);
        $filename = "cv_" . time() . "_" . uniqid() . "." . $ext;
        $target = "uploads/cvs/" . $filename;
        if (!is_dir("uploads/cvs/")) mkdir("uploads/cvs/", 0777, true);
        if (move_uploaded_file($_FILES['cv_file']['tmp_name'], $target)) {
            $cv_path = $target;
        }
    }

    // التحقق الأساسي من البيانات
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'يرجى ملء كافة البيانات الأساسية';
    } else {
        // حسابات المعلمين تحتاج موافقة الإدارة، أما البقية فتفعل تلقائياً
        $status = ($role === 'teacher') ? 'pending' : 'active';
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (name, email, phone, role, password, gender, age, location, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $name, $email, $phone, $role, $hashed, $gender, $age, $location, $status);
        
        try {
            if ($stmt->execute()) {
                $new_id = $stmt->insert_id;
                
                // إضافة بيانات المعلم الإضافية
                if ($role === 'teacher') {
                    $stmt_ti = $conn->prepare("INSERT INTO teachers_info (user_id, specialty, experience_years, location, cv_url) VALUES (?, ?, ?, ?, ?)");
                    $stmt_ti->bind_param("isiss", $new_id, $specialty, $experience, $location, $cv_path);
                    $stmt_ti->execute();
                    
                    $success_msg = 'تم إرسال طلب انضمامك بنجاح! يرجى انتظار مراجعة الإدارة والموافقة على حسابك.';
                } else {
                    // ربط حساب ولي الأمر بالطالب إذا تم إدخال بيانات الطالب
                    if ($role === 'parent' && !empty($student_name) && !empty($student_email)) {
                        $stmt_stu = $conn->prepare("SELECT id FROM users WHERE role='student' AND email=? AND name=?");
                        $stmt_stu->bind_param("ss", $student_email, $student_name);
                        $stmt_stu->execute();
                        $res_stu = $stmt_stu->get_result();
                        if ($res_stu->num_rows > 0) {
                            $stu_id = $res_stu->fetch_assoc()['id'];
                            $conn->query("INSERT INTO parent_student (parent_id, student_id) VALUES ($new_id, $stu_id)");
                        }
                    }

                    // تهيئة الجلسة للمستخدم الجديد
                    $_SESSION['user_id'] = $new_id;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_role'] = $role;

                    // تعيين المهام الافتراضية للطلاب الجدد
                    if ($role === 'student') {
                        $all_tasks = $conn->query("SELECT id FROM tasks");
                        if ($all_tasks) {
                            while($t = $all_tasks->fetch_assoc()) {
                                $tid = $t['id'];
                                $conn->query("INSERT INTO user_tasks (user_id, task_id, completed) VALUES ($new_id, $tid, 0)");
                            }
                        }
                    }

                    session_write_close();
                    header("Location: dashboard.php");
                    exit();
                }
            } else {
                $error = 'حدث خطأ أثناء إنشاء الحساب';
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                $error = 'هذا البريد الإلكتروني مسجل بالفعل';
            } else {
                $error = 'خطأ في قاعدة البيانات: ' . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب - أكاديمية مشكاة</title>
    
    <!-- المكتبات الخارجية -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <style>
        .role-card.active { border-color: #065f46; background: #f0fdf4; }
        .role-card.active .icon-box { background: #065f46; color: white; }
        .step-transition { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
        .bg-mesh { background-color: #065f46; background-image: radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.3) 0, transparent 50%), radial-gradient(at 100% 100%, rgba(5, 150, 105, 0.3) 0, transparent 50%); }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-6xl w-full bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col md:flex-row min-h-[700px]">
        
        <!-- الجانب الأيمن: شعار المنصة -->
        <div class="hidden md:flex w-[400px] bg-mesh p-16 flex-col justify-between text-white relative">
            <div class="relative z-10 text-right">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center mb-12">
                    <span class="font-black text-3xl">م</span>
                </div>
                <h2 class="text-4xl font-black mb-6 leading-tight">انضم إلى <br>أكاديمية مشكاة</h2>
                <p class="text-emerald-100/70 font-medium leading-relaxed">خطوتك الأولى نحو إتقان القرآن الكريم والعلوم الشرعية بأحدث الوسائل التقنية.</p>
            </div>

            <div class="relative z-10 text-right">
                <div class="flex -space-x-3 rtl:space-x-reverse mb-4 justify-end">
                    <div class="w-10 h-10 rounded-full border-2 border-emerald-900 bg-slate-200"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-emerald-900 bg-slate-300"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-emerald-900 bg-slate-400"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-emerald-900 bg-emerald-600 flex items-center justify-center text-[10px] font-black">+1.5k</div>
                </div>
                <p class="text-[10px] font-black text-emerald-100/50 uppercase tracking-widest">انضم لأكثر من 1500 طالب ومعلم</p>
            </div>

            <div class="absolute top-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/2"></div>
            <div class="absolute bottom-0 right-0 w-48 h-48 bg-emerald-400/10 rounded-full blur-3xl translate-y-1/2 translate-x-1/2"></div>
        </div>

        <!-- الجانب الأيسر: نموذج التسجيل -->
        <div class="flex-1 p-8 md:p-16 flex flex-col justify-center relative overflow-hidden">
            
            <?php if($success_msg): ?>
            <div class="text-center animate-fadeIn">
                <div class="w-24 h-24 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-8">
                    <span class="material-icons-outlined text-5xl">verified_user</span>
                </div>
                <h2 class="text-3xl font-black text-slate-900 mb-4">شكراً لانضمامك!</h2>
                <p class="text-slate-500 font-bold mb-10 leading-relaxed"><?php echo $success_msg; ?></p>
                <a href="index.php" class="inline-block px-12 py-4 bg-emerald-900 text-white rounded-2xl font-black hover:bg-black transition-all">العودة للرئيسية</a>
            </div>
            <?php else: ?>

            <!-- الخطوة 1: اختيار نوع الحساب -->
            <div id="step1" class="step-transition">
                <div class="flex justify-between items-start mb-12">
                    <div>
                        <h1 class="text-3xl font-black text-slate-900">إنشاء حساب جديد</h1>
                        <p class="text-slate-400 font-bold mt-1">الخطوة <span class="text-emerald-700">1</span> من 2</p>
                    </div>
                    <div class="text-left">
                        <p class="text-xs font-bold text-slate-400">لديك حساب بالفعل؟</p>
                        <a href="login.php" class="text-sm font-black text-emerald-700 hover:underline">تسجيل الدخول</a>
                        <br>
                        <a href="admin_login.php" class="text-[10px] font-bold text-slate-300 hover:text-slate-500">دخول الإدارة</a>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-10">
                    <div onclick="selectRole('student')" id="role_student" class="role-card active group p-6 rounded-[2rem] border-2 border-slate-50 cursor-pointer transition-all hover:border-emerald-100 text-center">
                        <div class="icon-box w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600">
                            <span class="material-icons-outlined">school</span>
                        </div>
                        <p class="font-black text-slate-600 text-sm">طالب</p>
                    </div>

                    <div onclick="selectRole('teacher')" id="role_teacher" class="role-card group p-6 rounded-[2rem] border-2 border-slate-50 cursor-pointer transition-all hover:border-emerald-100 text-center">
                        <div class="icon-box w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600">
                            <span class="material-icons-outlined">person</span>
                        </div>
                        <p class="font-black text-slate-600 text-sm">معلم</p>
                    </div>

                    <div onclick="selectRole('parent')" id="role_parent" class="role-card group p-6 rounded-[2rem] border-2 border-slate-50 cursor-pointer transition-all hover:border-emerald-100 text-center">
                        <div class="icon-box w-12 h-12 bg-slate-50 rounded-2xl flex items-center justify-center mx-auto mb-4 transition-all text-slate-400 group-hover:bg-emerald-50 group-hover:text-emerald-600">
                            <span class="material-icons-outlined">group</span>
                        </div>
                        <p class="font-black text-slate-600 text-sm">ولي أمر</p>
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-3xl mb-12 flex items-center gap-6">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center text-emerald-700">
                        <span id="roleIcon" class="material-icons-outlined text-3xl">school</span>
                    </div>
                    <div>
                        <h4 id="roleTitle" class="font-black text-slate-900">حساب طالب</h4>
                        <p id="roleDesc" class="text-xs font-bold text-slate-400 mt-1">سيتم توفير أدوات ومميزات مخصصة لخدمة احتياجاتك كطالب في المنصة.</p>
                    </div>
                </div>

                <button onclick="nextStep()" class="w-full py-5 bg-emerald-900 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-emerald-100 hover:bg-black transition-all flex items-center justify-center gap-4">
                    المتابعة للبيانات <span class="material-icons-outlined">arrow_back</span>
                </button>
            </div>

            <!-- الخطوة 2: نموذج إدخال البيانات -->
            <form id="step2" action="register.php" method="POST" enctype="multipart/form-data" class="step-transition hidden translate-x-12 opacity-0">
                <input type="hidden" name="role" id="roleInput" value="student">
                
                <button type="button" onclick="prevStep()" class="inline-flex items-center gap-2 text-slate-400 hover:text-emerald-700 font-bold mb-8">
                    <span class="material-icons-outlined">arrow_forward</span> العودة لاختيار النوع
                </button>

                <h2 class="text-3xl font-black text-slate-900 mb-8 tracking-tight">إكمال البيانات</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">الاسم بالكامل</label>
                        <input type="text" name="name" required placeholder="الاسم" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">البريد الإلكتروني</label>
                        <input type="email" name="email" required placeholder="example@mail.com" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">رقم الهاتف</label>
                        <input type="text" name="phone" placeholder="01XXXXXXXXX" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">كلمة المرور</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">النوع</label>
                        <select name="gender" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700 appearance-none">
                            <option value="ذكر">ذكر</option>
                            <option value="أنثى">أنثى</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">المكان أو العنوان</label>
                        <input type="text" name="location" placeholder="المكان" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">العمر</label>
                        <input type="number" name="age" placeholder="العمر" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                    </div>

                    <!-- حقول المعلم فقط -->
                    <div id="teacherFields" class="hidden md:contents">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">التخصص</label>
                            <input type="text" name="specialty" placeholder="مثلاً: تجويد وحفظ" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">سنوات الخبرة</label>
                            <input type="number" name="experience" placeholder="0" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                        </div>
                        <div class="space-y-1 md:col-span-2">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">رفع السيرة الذاتية (CV)</label>
                            <input type="file" name="cv_file" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                        </div>
                    </div>

                    <!-- حقول ولي الأمر فقط -->
                    <div id="parentFields" class="hidden md:contents">
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">اسم الطالب (الابن)</label>
                            <input type="text" name="student_name" placeholder="الاسم بالكامل" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">البريد الإلكتروني للطالب</label>
                            <input type="email" name="student_email" placeholder="student@mail.com" class="w-full px-6 py-3.5 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 font-bold text-slate-700">
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-5 bg-emerald-900 text-white rounded-[2rem] font-black text-lg shadow-xl shadow-emerald-100 hover:bg-black transition-all mt-10">
                    تأكيد البيانات وإرسال الطلب
                </button>
            </form>

            <?php if($error): ?>
            <div class="absolute bottom-8 right-8 left-8 bg-red-50 text-red-600 p-4 rounded-2xl font-bold text-xs flex items-center gap-2 border border-red-100 animate-pulse">
                <span class="material-icons-outlined">error</span> <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <?php endif; ?>
        </div>

    </div>

    <!-- ملفات الـ JavaScript المستقلة -->
    <script src="assets/js/register.js"></script>
</body>
</html>
