<?php
// Converted from Episods.jsx
$days = [
    ['name' => 'الأحد', 'date' => 12, 'active' => true],
    ['name' => 'الإثنين', 'date' => 13],
    ['name' => 'الثلاثاء', 'date' => 14],
    ['name' => 'الأربعاء', 'date' => 15],
    ['name' => 'الخميس', 'date' => 16],
    ['name' => 'الجمعة', 'date' => 17],
    ['name' => 'السبت', 'date' => 18],
];
$episodes = [
    ['id' => 1, 'day' => 'الأحد', 'type' => 'live', 'title' => 'حلقة الحفظ المكثف', 'student' => 'محمد أحمد', 'time' => '04:30 م', 'teacher' => 'الشيخ محمود'],
    ['id' => 2, 'day' => 'الأحد', 'type' => 'recorded', 'title' => 'شرح أحكام التجويد', 'student' => 'سارة أحمد', 'time' => '05:00 م', 'teacher' => 'المعلمة مريم'],
    ['id' => 3, 'day' => 'الثلاثاء', 'type' => 'live', 'title' => 'حلقة التثبيت والمراجعة', 'student' => 'محمد أحمد', 'time' => '10:00 ص', 'teacher' => 'الشيخ محمود'],
    ['id' => 4, 'day' => 'الخميس', 'type' => 'recorded', 'title' => 'قصص الأنبياء للأطفال', 'student' => 'محمد أحمد', 'time' => '05:30 م', 'teacher' => 'أ. خالد'],
    ['id' => 5, 'day' => 'الجمعة', 'type' => 'live', 'title' => 'تلاوة جماعية', 'student' => 'محمد أحمد', 'time' => '04:30 م', 'teacher' => 'الشيخ محمود'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">جدول حلقات الأبناء</h1>
            <p class="text-gray-500 font-medium">متابعة مواعيد الحلقات المباشرة والمسجلة لجميع أبنائك خلال الأسبوع</p>
        </div>
        <div class="flex bg-white p-1 rounded-2xl border border-gray-100 shadow-sm">
            <button class="px-6 py-2 bg-emerald-700 text-white rounded-xl text-xs font-black shadow-lg shadow-emerald-100">الأسبوع الحالي</button>
            <button class="px-6 py-2 text-gray-400 font-black text-xs hover:bg-gray-50 rounded-xl transition-all">الأسبوع القادم</button>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-10">
        <?php foreach ($days as $day): ?>
        <div class="p-6 rounded-[2rem] border-2 transition-all flex flex-col items-center justify-center gap-2 group cursor-pointer <?php echo $day['active'] ? 'bg-emerald-700 border-emerald-700 text-white shadow-xl shadow-emerald-100 scale-105' : 'bg-white border-transparent hover:border-emerald-100 shadow-sm'; ?>">
            <span class="text-[10px] font-black uppercase tracking-widest <?php echo $day['active'] ? 'text-emerald-100' : 'text-gray-400 group-hover:text-emerald-600'; ?>"><?php echo $day['name']; ?></span>
            <span class="text-2xl font-black <?php echo $day['active'] ? 'text-white' : 'text-gray-900'; ?>"><?php echo $day['date']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between px-4 mb-2">
                <h3 class="text-xl font-black text-gray-800 flex items-center gap-3">
                    <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                    تفاصيل الجدول لليوم المختار
                </h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($episodes as $ep): if ($ep['day'] == 'الأحد'): ?>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 shadow-sm <?php echo $ep['type'] === 'live' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700'; ?>">
                            <span class="material-icons-outlined text-2xl"><?php echo $ep['type'] === 'live' ? 'video_call' : 'play_circle_outline'; ?></span>
                        </div>
                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?php echo $ep['type'] === 'live' ? 'bg-red-50 text-red-600 animate-pulse' : 'bg-gray-100 text-gray-500'; ?>">
                            <?php echo $ep['type'] === 'live' ? 'بث مباشر' : 'محاضرة مسجلة'; ?>
                        </span>
                    </div>
                    <h4 class="text-xl font-black text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors"><?php echo $ep['title']; ?></h4>
                    <div class="space-y-3 mb-8">
                        <div class="flex items-center gap-2 text-gray-500 font-bold text-sm">
                            <span class="material-icons-outlined text-emerald-600 text-lg">person</span>
                            <span>الطالب: <?php echo $ep['student']; ?></span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-500 font-bold text-sm">
                            <span class="material-icons-outlined text-emerald-600 text-lg">access_time</span>
                            <span>الوقت: <?php echo $ep['time']; ?></span>
                        </div>
                        <p class="text-[10px] text-gray-400 font-bold pr-7">المعلم: <?php echo $ep['teacher']; ?></p>
                    </div>
                    <button class="w-full py-4 bg-gray-50 text-emerald-700 rounded-2xl font-black text-sm flex items-center justify-center gap-2 hover:bg-emerald-700 hover:text-white transition-all shadow-sm">
                        <?php echo $ep['type'] === 'live' ? 'دخول الحلقة الآن' : 'مشاهدة التسجيل'; ?>
                        <span class="material-icons-outlined text-lg">keyboard_arrow_left</span>
                    </button>
                    <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-50/50 rounded-full -translate-x-12 -translate-y-12 blur-2xl opacity-50"></div>
                </div>
                <?php endif; endforeach; ?>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="material-icons-outlined text-emerald-400 text-4xl mb-6 group-hover:scale-110 transition-transform">video_call</span>
                    <h4 class="text-xl font-black mb-2">تعليمات البث المباشر</h4>
                    <ul class="text-xs font-medium text-emerald-200 space-y-4 mb-8">
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mt-1.5 shrink-0"></span>يرجى التأكد من استقرار الإنترنت قبل بدء الحلقة بـ 5 دقائق.</li>
                        <li class="flex items-start gap-2"><span class="w-1.5 h-1.5 bg-emerald-400 rounded-full mt-1.5 shrink-0"></span>توفير مكان هادئ للابن لضمان أعلى مستويات التركيز.</li>
                    </ul>
                    <button class="w-full py-4 bg-emerald-700 hover:bg-emerald-600 rounded-2xl font-black text-sm transition-all shadow-xl">اختبار سرعة الإنترنت</button>
                </div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-50"></div>
            </div>
        </div>
    </div>
</main>