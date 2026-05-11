<?php
/**
 * الصفحة الرئيسية لمنصة مشكاة
 * تعرض رؤية المنصة والمسارات التعليمية والمعلمين
 */
require_once 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منصة مشكاة | رحلتك نحو إتقان القرآن الكريم</title>
    
    <!-- الاستعانة بمكتبات التصميم الخارجية -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    
    <!-- ملف التنسيق الرئيسي المستقل -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body class="bg-white">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-emerald-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-emerald-700 rounded-xl flex items-center justify-center text-white font-black text-2xl">م</div>
                <span class="text-2xl font-black text-emerald-900 tracking-tighter">مشكاة</span>
            </div>
            <div class="hidden lg:flex items-center gap-10">
                <a href="#" class="text-sm font-bold text-emerald-700">الرئيسية</a>
                <a href="#courses" class="text-sm font-bold text-gray-500 hover:text-emerald-700 transition-colors">المسارات</a>
                <a href="#teachers" class="text-sm font-bold text-gray-500 hover:text-emerald-700 transition-colors">المعلمون</a>
                <a href="about.php" class="text-sm font-bold text-gray-500 hover:text-emerald-700 transition-colors">عن المنصة</a>
                <a href="contact.php" class="text-sm font-bold text-gray-500 hover:text-emerald-700 transition-colors">تواصل معنا</a>
            </div>
            <div class="flex items-center gap-6">
                <a href="login.php" class="text-sm font-bold text-emerald-700 hover:underline">تسجيل الدخول</a>
                <a href="register.php" class="px-8 py-2.5 bg-emerald-700 text-white rounded-xl text-sm font-black hover:bg-emerald-800 transition-all shadow-lg">اشترك الآن</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-vision py-32 md:py-48 relative overflow-hidden text-white">
        <div class="max-w-5xl mx-auto px-6 text-center reveal-text relative z-10">
            <div class="mb-10">
                <span class="inline-flex items-center gap-2 px-6 py-2.5 bg-white/10 text-emerald-300 rounded-full text-lg md:text-xl font-bold border border-white/10 italic backdrop-blur-sm">
                    "وَقُل رَّبِّ زِدْنِي عِلْمًا"
                </span>
            </div>
            <h1 class="text-5xl md:text-8xl font-black mb-10 leading-tight">حفظ، تجويد وتفسير <br><span class="text-emerald-300 italic">بأسلوب عصري فريد</span></h1>
            <p class="text-xl md:text-2xl text-emerald-100/60 max-w-3xl mx-auto mb-16 leading-relaxed font-medium">اكتشف بيئة تعليمية تفاعلية تجمع بين أصالة المنهج وحداثة الوسيلة، مع نخبة من المتخصصين في علوم القرآن واللغة العربية.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="register.php" class="px-12 py-5 bg-white text-emerald-900 rounded-2xl font-black text-lg shadow-2xl hover:bg-emerald-50 transition-all">ابدأ رحلتك الآن</a>
                <a href="about.php" class="px-12 py-5 bg-transparent text-white border-2 border-white/20 rounded-2xl font-black text-lg hover:bg-white/5 transition-all">عن المنصة</a>
            </div>
        </div>
    </section>

    <!-- Courses Section (With Background) -->
    <section id="courses" class="py-32 bg-section-light border-y border-emerald-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-black text-gray-900 mb-4">المسارات التعليمية</h2>
                <div class="w-16 h-1.5 bg-stats mx-auto rounded-full mb-6"></div>
                <p class="text-gray-500 font-medium">برامج متنوعة تناسب جميع المستويات والأعمار</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <?php 
                $cards = [
                    ['t'=>'دورة التجويد', 'i'=>'auto_stories', 'd'=>'شرح مبسط لأحكام التجويد وإتقان مخارج الحروف لضبط القراءة.'],
                    ['t'=>'مسار الحفظ', 'i'=>'menu_book', 'd'=>'برنامج مكثف لحفظ القرآن الكريم مع مراجعة دورية وتثبيت.'],
                    ['t'=>'دورة التفسير', 'i'=>'record_voice_over', 'd'=>'تدبر معاني القرآن الكريم وبيان أسباب النزول للأجزاء المختارة.']
                ];
                foreach($cards as $c): ?>
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-emerald-100 hover:border-stats hover:shadow-xl transition-all text-center">
                    <div class="w-16 h-16 bg-emerald-50 text-stats rounded-3xl flex items-center justify-center mb-8 mx-auto">
                        <span class="material-icons-outlined text-3xl"><?php echo $c['i']; ?></span>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4"><?php echo $c['t']; ?></h3>
                    <p class="text-gray-500 font-medium text-sm mb-10 leading-relaxed"><?php echo $c['d']; ?></p>
                    <a href="course_details.php" class="inline-block px-8 py-3 bg-emerald-50 text-stats rounded-full text-sm font-black hover:bg-stats hover:text-white transition-all">تفاصيل المسار</a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Stats Bar -->
    <section class="py-16 bg-stats text-white">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-12 text-center">
            <div><p class="text-4xl font-black mb-1">500+</p><p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest">طالب وطالبة</p></div>
            <div><p class="text-4xl font-black mb-1">12+</p><p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest">معلم مجاز</p></div>
            <div><p class="text-4xl font-black mb-1">3</p><p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest">مسارات</p></div>
            <div><p class="text-4xl font-black mb-1">100%</p><p class="text-emerald-100 text-[10px] font-black uppercase tracking-widest">نسبة الإتقان</p></div>
        </div>
    </section>

    <!-- Teachers Section (With Background) -->
    <section id="teachers" class="py-32 bg-section-light border-y border-emerald-50">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-black text-gray-900 mb-16">نخبة المعلمين</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <?php 
                $teachers = [['n'=>'أحمد محمد','i'=>'person'],['n'=>'سارة علي','i'=>'person_2'],['n'=>'محمد إبراهيم','i'=>'person'],['n'=>'منى محمود','i'=>'person_2']];
                foreach($teachers as $t): ?>
                <div class="p-10 bg-white rounded-[3rem] border border-emerald-100 hover:border-stats transition-all group shadow-sm">
                    <div class="w-24 h-24 bg-emerald-50 text-stats rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-stats group-hover:text-white transition-all">
                        <span class="material-icons-outlined text-5xl"><?php echo $t['i']; ?></span>
                    </div>
                    <h3 class="text-lg font-black text-gray-900"><?php echo $t['n']; ?></h3>
                    <p class="text-[10px] font-black text-emerald-600 mt-2 uppercase tracking-widest">معلم مجاز</p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-vision py-12 text-center text-white/50 border-t border-emerald-900">
        <div class="flex justify-center gap-10 mb-8 font-bold text-sm">
            <a href="about.php" class="hover:text-emerald-300 transition-colors">عن المنصة</a>
            <a href="#courses" class="hover:text-emerald-300 transition-colors">المسارات</a>
            <a href="contact.php" class="hover:text-emerald-300 transition-colors">تواصل معنا</a>
        </div>
        <p class="text-white/20 text-xs font-bold">© 2026 منصة مشكاة التعليمية. جميع الحقوق محفوظة.</p>
    </footer>

</body>
</html>
