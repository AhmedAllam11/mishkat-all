<?php
/**
 * صفحة تسجيل الدخول
 * تتيح للمستخدمين الدخول إلى حساباتهم بناءً على أدوارهم
 */
ob_start();
session_start();
require_once 'includes/db.php';

$error = '';

// معالجة طلب تسجيل الدخول
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // البحث عن المستخدم في قاعدة البيانات
    $stmt = $conn->prepare("SELECT id, name, email, password, role, status FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // التحقق من حالة الحساب
        if ($user['status'] === 'suspended') {
            $error = 'حسابك معلق، يرجى التواصل مع الإدارة';
        } elseif ($user['status'] === 'pending') {
            $error = 'حسابك قيد المراجعة حالياً، يرجى انتظار موافقة الإدارة لتتمكن من الدخول';
        } elseif (password_verify($password, $user['password'])) {
            // نجاح تسجيل الدخول - حفظ بيانات الجلسة
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            session_write_close();
            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'كلمة المرور غير صحيحة';
        }
    } else {
        $error = 'البريد الإلكتروني غير مسجل';
    }
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - مشكاة</title>
    
    <!-- المكتبات الخارجية -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- ملف التنسيق الخاص بصفحات الدخول -->
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Background Accents -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-emerald-100 rounded-full blur-3xl opacity-50 -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50 translate-y-1/2 -translate-x-1/2"></div>

    <div class="max-w-md w-full relative z-10 animate-slideUp">
        <div class="text-center mb-8">
            <a href="index.php" class="inline-flex w-16 h-16 bg-emerald-700 rounded-2xl items-center justify-center shadow-2xl shadow-emerald-200 mb-4 hover:scale-110 transition-transform">
                <span class="text-white font-black text-3xl">م</span>
            </a>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">مرحباً بك مجدداً</h1>
            <p class="text-slate-500 font-medium mt-2">سجل دخولك لمتابعة رحلتك التعليمية</p>
        </div>

        <div class="glass p-8 rounded-[2.5rem] shadow-2xl shadow-slate-200 border border-white">
            <?php if($error): ?>
            <div class="bg-red-50 border border-red-100 text-red-600 p-4 rounded-2xl mb-6 text-sm font-bold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 mr-1">البريد الإلكتروني</label>
                    <input type="email" name="email" required placeholder="example@domain.com"
                        class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all font-bold text-slate-700 placeholder:text-slate-300">
                </div>
                <div>
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 mr-1">كلمة المرور</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 transition-all font-bold text-slate-700 placeholder:text-slate-300">
                </div>
                
                <div class="flex items-center justify-between py-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" class="w-5 h-5 rounded-lg border-none bg-slate-100 text-emerald-600 focus:ring-0 transition-all">
                        <span class="text-sm font-bold text-slate-500 group-hover:text-slate-700">تذكرني</span>
                    </label>
                    <a href="#" class="text-sm font-bold text-emerald-600 hover:text-emerald-700 transition-colors">نسيت كلمة المرور؟</a>
                </div>

                <button type="submit" 
                    class="w-full py-4 bg-emerald-700 text-white rounded-2xl font-black text-lg hover:bg-emerald-800 hover:scale-[1.02] active:scale-95 transition-all shadow-xl shadow-emerald-200">
                    تسجيل الدخول
                </button>
            </form>
        </div>

        <p class="text-center mt-8 text-slate-500 font-bold">
            ليس لديك حساب؟ 
            <a href="register.php" class="text-emerald-600 hover:underline">اشترك الآن</a>
        </p>
    </div>
</body>
</html>
