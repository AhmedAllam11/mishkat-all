<?php
// Converted from PackagesPage.jsx
$sessions = [
    ['id' => 1, 'title' => "حلقة الفجر - سورة البقرة", 'students' => 12, 'time' => "05:00 ص", 'status' => 'completed'],
    ['id' => 2, 'title' => "حلقة الصديق - الجزء 26", 'students' => 15, 'time' => "04:30 م", 'status' => 'active'],
    ['id' => 3, 'title' => "حلقة الفاروق - التجويد", 'students' => 10, 'time' => "07:00 م", 'status' => 'pending'],
    ['id' => 4, 'title' => "حلقة الزهراء - القراءات", 'students' => 11, 'time' => "09:00 م", 'status' => 'pending'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الحلقات القرآنية</h1>
            <p class="text-gray-500 font-medium">لوحة التحكم المركزية لإدارة حلقاتك ومواعيد البث المباشر</p>
        </div>
        <div class="flex gap-3">
            <button class="p-3 bg-white border border-gray-100 rounded-2xl text-emerald-700 hover:bg-emerald-50 transition-all shadow-sm">
                <span class="material-icons-outlined text-2xl">refresh</span>
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">calendar_today</span>
                جدول المواعيد
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-emerald-900 rounded-[3rem] p-10 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center gap-10">
            <div class="flex-1 text-center md:text-right relative z-10">
                <span class="px-4 py-1.5 bg-emerald-700/50 rounded-full text-[10px] font-black mb-6 inline-block uppercase tracking-widest">جارية الآن</span>
                <h2 class="text-3xl font-black mb-4 leading-tight">حلقة الصديق - حفظ القرآن المكثف</h2>
                <p class="text-emerald-200 font-medium mb-8 leading-relaxed">الحلقة الحالية تبدأ بعد 10 دقائق. يرجى التواجد لبدء البث المباشر مع الطلاب.</p>
                <button class="flex items-center gap-3 px-8 py-4 bg-white text-emerald-900 rounded-2xl font-black shadow-xl hover:scale-105 transition-all mx-auto md:mx-0">
                    <span class="material-icons-outlined">video_call</span>
                    دخول غرفة البث الآن
                </button>
            </div>
            <div class="w-48 h-48 bg-emerald-800/50 rounded-[2.5rem] flex items-center justify-center relative z-10 backdrop-blur-md border border-emerald-700/50">
                <span class="material-icons-outlined text-6xl text-emerald-400">video_call</span>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-800 rounded-full -translate-x-20 -translate-y-20 blur-[100px] opacity-50"></div>
        </div>

        <div class="bg-white rounded-[3rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-black text-gray-800 mb-8">نظرة عامة</h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl transition-all bg-emerald-50 text-emerald-700">
                                <span class="material-icons-outlined">people</span>
                            </div>
                            <span class="font-bold text-gray-400 text-sm">إجمالي الطلاب</span>
                        </div>
                        <span class="text-xl font-black text-gray-900">48</span>
                    </div>
                </div>
            </div>
            <button class="w-full mt-8 py-4 bg-gray-50 text-gray-500 rounded-2xl font-black text-sm hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                <span class="material-icons-outlined">settings</span>
                إعدادات الحلقات
            </button>
        </div>
    </div>

    <div class="mt-10 bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50">
            <h3 class="text-xl font-black text-gray-800">قائمة الحلقات اليومية</h3>
        </div>
        <div class="divide-y divide-gray-50">
            <?php foreach ($sessions as $s): ?>
            <div class="p-6 md:p-8 hover:bg-gray-50/50 transition-all flex flex-col md:flex-row items-center gap-8 group">
                <div class="w-full md:w-32 flex items-center justify-center">
                    <span class="px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase <?php echo $s['status'] === 'active' ? 'bg-emerald-100 text-emerald-700 ring-4 ring-emerald-50' : ($s['status'] === 'completed' ? 'bg-gray-100 text-gray-400' : 'bg-amber-100 text-amber-700'); ?>">
                        <?php echo $s['status'] === 'active' ? 'جارية الآن' : ($s['status'] === 'completed' ? 'انتهت' : 'بانتظار البدء'); ?>
                    </span>
                </div>
                <div class="flex-1 text-center md:text-right">
                    <h4 class="text-lg font-black text-gray-800 group-hover:text-emerald-700 transition-colors mb-1"><?php echo $s['title']; ?></h4>
                    <div class="flex items-center gap-4 justify-center md:justify-start text-gray-400 font-bold text-xs">
                        <span class="flex items-center gap-1"><span class="material-icons-outlined text-sm">people</span> <?php echo $s['students']; ?> طالباً</span>
                        <span class="flex items-center gap-1"><span class="material-icons-outlined text-sm">access_time</span> <?php echo $s['time']; ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <?php if ($s['status'] === 'completed'): ?>
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                            <span class="material-icons-outlined">check_circle</span>
                        </div>
                    <?php else: ?>
                        <button class="px-8 py-3 rounded-2xl font-black text-xs transition-all shadow-lg <?php echo $s['status'] === 'active' ? 'bg-blue-600 text-white shadow-blue-100' : 'bg-emerald-700 text-white shadow-emerald-100 hover:bg-emerald-800'; ?>">
                            <?php echo $s['status'] === 'active' ? 'دخول الغرفة' : 'بدء الحلقة'; ?>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
