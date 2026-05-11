<?php
// Converted from Calendar.jsx
$events = [
    ['id' => 1, 'day' => 5, 'title' => "حلقة الحفظ المكثف", 'time' => "04:00", 'teacher' => "الشيخ عبدالله الجهني", 'type' => "class"],
    ['id' => 2, 'day' => 5, 'title' => "اختبار تجويد (المستوى 1)", 'time' => "18:30", 'teacher' => "منصة الاختبارات", 'type' => "exam"],
    ['id' => 3, 'day' => 12, 'title' => "تفسير سورة الفاتحة", 'time' => "10:00", 'teacher' => "الشيخ محمد راتب", 'type' => "class"],
    ['id' => 4, 'day' => 20, 'title' => "مراجعة المتون", 'time' => "15:00", 'teacher' => "ذاتي", 'type' => "class"]
];
$stats = ['completed' => 18, 'total' => 24, 'examsLeft' => 4, 'hours' => 12];
$monthNames = ["يناير", "فبراير", "مارس", "أبريل", "مايو", "يونيو", "يوليو", "أغسطس", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
$currentMonth = (int)date('m');
$currentYear = (int)date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$firstDay = date('N', strtotime("$currentYear-$currentMonth-01")); // 1 (Mon) to 7 (Sun)
// React code used Saturday as index 0, but date('N') is Mon=1. Let's adjust.
// In the PHP code below I'll handle the grid.
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">جدولك الزمني</h1>
            <p class="text-gray-500 font-medium">نظم وقتك مع حلقات تحفيظ مشكاة والدروس المباشرة</p>
        </div>
        <div class="flex bg-white p-1 rounded-2xl shadow-sm border border-gray-100">
            <button class="px-6 py-2 bg-emerald-700 text-white rounded-xl font-bold shadow-lg shadow-emerald-200">الالتقويم</button>
            <button class="px-6 py-2 text-gray-500 font-bold hover:bg-gray-50 rounded-xl transition">قائمة الحلقات</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-2 text-emerald-700">
                        <span class="material-icons-outlined text-sm">today</span>
                        <span class="font-black text-sm">اليوم</span>
                    </div>
                    <h3 class="font-black text-gray-800 text-lg">جدول اليوم</h3>
                </div>
                <div class="space-y-8 relative text-right">
                    <div class="absolute top-2 right-3 bottom-0 w-0.5 bg-gray-100"></div>
                    <?php foreach ($events as $event): if ($event['day'] == (int)date('d')): ?>
                    <div class="relative flex items-start gap-4 pr-10 group">
                        <div class="absolute right-1.5 top-1.5 w-3.5 h-3.5 rounded-full border-2 border-white bg-emerald-600 shadow-md group-hover:scale-125 transition-transform z-10"></div>
                        <div class="flex-1 text-right">
                            <div class="flex items-center gap-2 justify-end mb-1">
                                <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md flex items-center gap-1">
                                    <span class="material-icons-outlined text-xs">access_time</span><?php echo $event['time']; ?>
                                </span>
                            </div>
                            <div class="p-4 rounded-2xl border-2 transition-all cursor-pointer shadow-sm <?php echo $event['type'] === 'exam' ? 'bg-amber-50 border-amber-100' : 'bg-emerald-50 border-emerald-100'; ?>">
                                <h4 class="font-bold text-gray-800 text-sm mb-2"><?php echo $event['title']; ?></h4>
                                <div class="flex items-center gap-1 justify-end text-[10px] text-gray-500 font-bold">
                                    <span><?php echo $event['teacher']; ?></span>
                                    <span class="material-icons-outlined text-sm">person</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; endforeach; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden p-8">
                <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
                    <div class="flex items-center gap-4">
                        <button class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-all"><span class="material-icons-outlined">chevron_right</span></button>
                        <div class="text-center px-4">
                            <h2 class="text-2xl font-black text-gray-900 leading-tight"><?php echo $monthNames[$currentMonth-1]; ?></h2>
                            <p class="text-sm text-gray-400 font-black tracking-widest"><?php echo $currentYear; ?></p>
                        </div>
                        <button class="w-12 h-12 flex items-center justify-center bg-gray-50 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-600 transition-all"><span class="material-icons-outlined">chevron_left</span></button>
                    </div>
                </div>
                <div class="grid grid-cols-7 mb-4">
                    <?php foreach (['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'] as $day): ?>
                        <div class="text-center py-4 text-xs font-black text-gray-400 uppercase"><?php echo $day; ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="grid grid-cols-7 gap-4">
                    <?php 
                    // Calculate start padding (adjusting for Arabic week starting Sat)
                    // date('N') is 1 (Mon) to 7 (Sun)
                    // Sat=6, Sun=7, Mon=1, Tue=2, Wed=3, Thu=4, Fri=5
                    $satOffset = ($firstDay == 6) ? 0 : (($firstDay == 7) ? 1 : $firstDay + 1);
                    for ($i = 0; $i < $satOffset; $i++): ?>
                        <div class="h-32 rounded-[1.5rem] bg-gray-50/30 border border-transparent"></div>
                    <?php endfor; ?>
                    <?php for ($day = 1; $day <= $daysInMonth; $day++): 
                        $dayEvents = array_filter($events, function($e) use ($day) { return $e['day'] == $day; });
                        $isToday = $day == (int)date('d');
                    ?>
                        <div class="h-32 md:h-40 rounded-[2rem] p-4 text-right transition-all group relative border-2 <?php echo $isToday ? 'border-emerald-500 bg-emerald-50/30 ring-4 ring-emerald-50' : 'border-transparent bg-gray-50 hover:bg-white hover:border-gray-200'; ?>">
                            <span class="text-lg font-black block mb-2 transition-colors <?php echo $isToday ? 'text-emerald-700' : 'text-gray-400 group-hover:text-gray-900'; ?>"><?php echo $day; ?></span>
                            <div class="space-y-1.5 overflow-hidden">
                                <?php foreach ($dayEvents as $event): ?>
                                    <div class="text-[8px] md:text-[10px] font-bold px-2 py-1.5 rounded-lg truncate shadow-sm transition-transform hover:scale-105 cursor-pointer <?php echo $event['type'] === 'exam' ? 'bg-amber-100 text-amber-700' : 'bg-emerald-600 text-white'; ?>"><?php echo $event['title']; ?></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</main>