<?php
/**
 * لوحة تحكم المنصة
 * الصفحة الرئيسية للأعضاء (طلاب، معلمين، أولياء أمور، مديرين)
 */
session_start();
require_once 'includes/db.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['user_role'];
$name = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];

// تعريف القوائم الجانبية بناءً على نوع المستخدم
$links = [];
if ($role === 'student') {
    $links = [
        ['name' => 'الملف الشخصي', 'icon' => 'account_circle', 'page' => 'profile'],
        ['name' => 'الاشتراك والدفع', 'icon' => 'payments', 'page' => 'courses'],
        ['name' => 'التقويم الدراسي', 'icon' => 'calendar_month', 'page' => 'calendar'],
        ['name' => 'المكتبة الإسلامية', 'icon' => 'library_books', 'page' => 'library'],
        ['name' => 'المهام اليومية', 'icon' => 'assignment', 'page' => 'tasks'],
        ['name' => 'متابعة المسار', 'icon' => 'timeline', 'page' => 'tracking'],
    ];
} elseif ($role === 'teacher') {
    $links = [
        ['name' => 'الملف الشخصي', 'icon' => 'account_circle', 'page' => 'profile'],
        ['name' => 'إدارة الحلقات', 'icon' => 'groups', 'page' => 'episodes'],
        ['name' => 'سجل الطلاب', 'icon' => 'school', 'page' => 'students'],
        ['name' => 'التقييم الأكاديمي', 'icon' => 'insights', 'page' => 'evaluation'],
        ['name' => 'التقارير', 'icon' => 'description', 'page' => 'reports'],
        ['name' => 'المكتبة القرآنية', 'icon' => 'library_books', 'page' => 'library'],
    ];
} elseif ($role === 'parent') {
    $links = [
        ['name' => 'الملف الشخصي', 'icon' => 'account_circle', 'page' => 'profile'],
        ['name' => 'تقارير الأبناء', 'icon' => 'description', 'page' => 'reports'],
        ['name' => 'جدول الحلقات', 'icon' => 'calendar_month', 'page' => 'episods'],
        ['name' => 'الإشعارات', 'icon' => 'notifications', 'page' => 'notifications'],
        ['name' => 'الاشتراكات والدفع', 'icon' => 'payments', 'page' => 'payment'],
    ];
} elseif ($role === 'admin') {
    $links = [
        ['name' => 'إدارة الحسابات', 'icon' => 'groups', 'page' => 'accounts'],
        ['name' => 'إدارة الطلاب', 'icon' => 'school', 'page' => 'students'],
        ['name' => 'المحتوى التعليمي', 'icon' => 'library_books', 'page' => 'content'],
        ['name' => 'تنظيم الحلقات', 'icon' => 'calendar_month', 'page' => 'circles'],
        ['name' => 'مراجعة المعلمين', 'icon' => 'verified_user', 'page' => 'review-teachers'],
        ['name' => 'التقارير العامة', 'icon' => 'insights', 'page' => 'reports'],
        ['name' => 'المالية والدفع', 'icon' => 'payments', 'page' => 'subscriptions'],
        ['name' => 'الإشعارات', 'icon' => 'notifications', 'page' => 'notifications'],
        ['name' => 'إعدادات النظام', 'icon' => 'settings', 'page' => 'settings'],
    ];
}

// تحديد الصفحة الحالية
$currentPage = $_GET['page'] ?? '';
if ($currentPage == '') {
    $currentPage = $links[0]['page'] ?? 'profile';
}

$pageTitle = '';
foreach ($links as $link) {
    if ($link['page'] === $currentPage) {
        $pageTitle = $link['name'];
        break;
    }
}
if (!$pageTitle) $pageTitle = 'لوحة التحكم';

// خريطة الصفحات (توجيه الصفحات إلى الملفات الفعلية)
$pageMap = [
    'student' => [
        'profile' => 'student/Profile.php',
        'courses' => 'student/CoursesPage.php',
        'calendar' => 'student/Calendar.php',
        'library' => 'student/LibraryStudent.php',
        'tasks' => 'student/Tasks.php',
        'tracking' => 'student/Tracking.php',
        'exam' => 'student/Exam.php',
        'result' => 'student/Result.php',
        'episodes' => 'student/Episodes.php',
    ],
    'teacher' => [
        'profile' => 'teacher/Profile.php',
        'episodes' => 'teacher/Episodes.php',
        'students' => 'teacher/StudentsPage.php',
        'evaluation' => 'teacher/Evaluation.php',
        'reports' => 'teacher/Reports.php',
        'library' => 'teacher/Library.php',
    ],
    'admin' => [
        'accounts' => 'admin/AccountsManagement.php',
        'students' => 'admin/StudentsManagement.php',
        'content' => 'admin/ContentManagement.php',
        'circles' => 'admin/CirclesManagement.php',
        'review-teachers' => 'admin/ReviewTeachers.php',
        'reports' => 'admin/ReportsAdmin.php',
        'subscriptions' => 'admin/SubscriptionsAdmin.php',
        'notifications' => 'admin/NotificationsAdmin.php',
        'settings' => 'admin/SettingsAdmin.php',
    ],
    'parent' => [
        'profile' => 'parent/Profile.php',
        'reports' => 'parent/ReportsPage.php',
        'episods' => 'parent/Episods.php',
        'notifications' => 'parent/Notifications.php',
        'payment' => 'parent/Payment.php',
    ],
];

$fileName = $pageMap[$role][$currentPage] ?? '';

// جلب عدد الإشعارات غير المقروءة
$unreadNotifs = 0;
$res = $conn->query("SELECT COUNT(*) as c FROM notifications WHERE user_id=$userId AND is_read=0");
if ($res) {
    $unreadNotifs = $res->fetch_assoc()['c'];
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - <?php echo htmlspecialchars($pageTitle); ?></title>
    
    <!-- الاستعانة بالمكتبات الخارجية -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!-- ملفات التنسيق المنظمة -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body class="bg-gray-50 flex h-screen overflow-hidden">

    <!-- حاوية التنبيهات -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- غطاء الشاشة للموبايل -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black/30 z-[90] hidden md:hidden" onclick="toggleMobileSidebar()"></div>

    <!-- القائمة الجانبية -->
    <aside id="sidebar" class="relative h-screen bg-white border-l border-gray-100 flex flex-col shadow-xl transition-all duration-500 ease-in-out sidebar-open z-50">
        
        <button id="sidebarToggle" class="hidden md:flex absolute -left-4 top-10 w-8 h-8 bg-white border border-gray-100 rounded-full items-center justify-center shadow-lg hover:bg-gray-50 transition-all z-10">
            <span class="material-icons-outlined text-gray-400 transition-transform duration-500" id="toggleIcon">chevron_left</span>
        </button>

        <div class="p-6 flex items-center gap-3 border-b border-gray-50 overflow-hidden">
            <a href="index.php" class="w-10 h-10 bg-emerald-700 rounded-xl flex items-center justify-center shrink-0 shadow-lg shadow-emerald-100 hover:rotate-12 transition-transform">
                <span class="text-white font-black text-xl">م</span>
            </a>
            <div id="brandText" class="flex flex-col whitespace-nowrap">
                <span class="text-lg font-black text-gray-900 tracking-tight">مشكاة</span>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest -mt-1">منصة تعليمية</span>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto py-6 px-3 custom-scrollbar">
            <ul class="space-y-1">
                <?php foreach($links as $link): 
                    $isActive = ($link['page'] === $currentPage);
                ?>
                <li>
                    <a href="?page=<?php echo $link['page']; ?>" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group relative
                       <?php echo $isActive ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-100 font-black' : 'text-gray-400 hover:bg-emerald-50/50 hover:text-emerald-700'; ?>">
                        <span class="material-icons-outlined text-[22px] transition-transform group-hover:scale-110"><?php echo $link['icon']; ?></span>
                        <span class="text-sm whitespace-nowrap sidebar-text"><?php echo $link['name']; ?></span>
                        <?php if($link['page']==='notifications' && $unreadNotifs > 0): ?>
                        <span class="absolute left-3 top-2 min-w-[18px] h-[18px] bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center sidebar-text"><?php echo $unreadNotifs; ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="p-3 border-t border-gray-50">
            <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 w-full rounded-xl transition-all group">
                <span class="material-icons-outlined text-[22px] group-hover:translate-x-1 transition-transform">logout</span>
                <span class="text-sm font-bold sidebar-text">تسجيل خروج</span>
            </a>
        </div>
    </aside>

    <!-- المحتوى الرئيسي -->
    <div class="flex-1 flex flex-col overflow-hidden">
        
        <!-- شريط التنقل العلوي -->
        <nav class="h-16 bg-white/90 backdrop-blur-md border-b border-gray-100 px-4 md:px-8 flex items-center justify-between sticky top-0 z-40">
            
            <button class="md:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-xl" onclick="toggleMobileSidebar()">
                <span class="material-icons-outlined">menu</span>
            </button>

            <!-- محرك البحث -->
            <div class="hidden md:flex relative w-80 group">
                <span class="material-icons-outlined absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg group-focus-within:text-emerald-600 transition-colors">search</span>
                <input type="text" id="globalSearch" placeholder="البحث في المنصة..." 
                    class="w-full pr-10 pl-4 py-2 bg-gray-50 border-none rounded-xl outline-none focus:ring-2 focus:ring-emerald-100 transition-all text-sm font-medium" />
            </div>

            <div class="flex items-center gap-3">
                <button class="p-2 text-gray-400 hover:text-emerald-700 hover:bg-emerald-50 rounded-xl transition-all relative" onclick="toggleNotifPanel()">
                    <span class="material-icons-outlined text-xl">notifications</span>
                    <?php if($unreadNotifs > 0): ?>
                    <span id="notifBadge" class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center"><?php echo $unreadNotifs; ?></span>
                    <?php endif; ?>
                </button>

                <div class="h-6 w-px bg-gray-100 mx-1 hidden md:block"></div>

                <!-- حساب المستخدم -->
                <button class="flex items-center gap-2 p-1 pr-3 bg-gray-50 rounded-xl border border-gray-100 hover:bg-white hover:shadow-md transition-all group" onclick="toggleProfileMenu()">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold text-gray-900 leading-tight"><?php echo htmlspecialchars($name); ?></p>
                        <p class="text-[9px] font-bold text-emerald-600 uppercase tracking-wider">
                            <?php 
                                $roleNames = ['admin'=>'مدير النظام','teacher'=>'معلم','student'=>'طالب','parent'=>'ولي أمر'];
                                echo $roleNames[$role] ?? $role;
                            ?>
                        </p>
                    </div>
                    <div class="w-8 h-8 bg-emerald-700 rounded-lg flex items-center justify-center shadow-md shadow-emerald-100">
                        <span class="text-white font-bold text-sm"><?php echo mb_substr($name, 0, 1, "UTF-8"); ?></span>
                    </div>
                </button>
            </div>
        </nav>

        <!-- لوحة الإشعارات -->
        <div id="notifPanel" class="hidden absolute left-4 md:left-8 top-16 w-80 bg-white rounded-2xl shadow-2xl border border-gray-100 z-50 overflow-hidden animate-fadeIn">
            <div class="p-4 border-b border-gray-50 flex justify-between items-center">
                <h4 class="font-bold text-gray-900">الإشعارات</h4>
                <button onclick="markAllRead()" class="text-xs font-bold text-emerald-600 hover:underline">قراءة الكل</button>
            </div>
            <div id="notifList" class="max-h-80 overflow-y-auto custom-scrollbar"></div>
        </div>

        <!-- منطقة عرض المحتوى -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8 custom-scrollbar">
            <div class="max-w-[1600px] mx-auto page-content">
                <?php
                if ($fileName && file_exists("pages/" . $fileName)) {
                    include("pages/" . $fileName);
                } else {
                ?>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 text-center min-h-[400px] flex flex-col items-center justify-center">
                    <span class="material-icons-outlined text-6xl text-gray-200 mb-4">construction</span>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">صفحة <?php echo htmlspecialchars($pageTitle); ?></h3>
                    <p class="text-gray-400 text-sm">جاري تطوير هذه الصفحة...</p>
                </div>
                <?php } ?>
            </div>
        </main>
    </div>

    <!-- ملفات الـ JavaScript المستقلة -->
    <script src="assets/js/dashboard.js"></script>
</body>
</html>
