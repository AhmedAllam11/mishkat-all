<?php
// Converted from Reports.jsx
$studentsReports = [
    ['id' => 1, 'name' => "أحمد محمد علي", 'circle' => "حلقة الصديق", 'joz' => 26, 'rating' => "ممتاز", 'pages' => 14, 'color' => "emerald"],
    ['id' => 2, 'name' => "ياسين إبراهيم", 'circle' => "حلقة الفاروق", 'joz' => 15, 'rating' => "جيد جداً", 'pages' => 8, 'color' => "blue"],
    ['id' => 3, 'name' => "سارة محمود كمال", 'circle' => "حلقة الزهراء", 'joz' => 30, 'rating' => "ممتاز", 'pages' => 22, 'color' => "emerald"],
    ['id' => 4, 'name' => "ليلى حسن", 'circle' => "حلقة الزهراء", 'joz' => 29, 'rating' => "جيد", 'pages' => 5, 'color' => "amber"],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">تقارير المتابعة</h1>
            <p class="text-gray-500 font-medium">عرض شامل لنتائج الطلاب وتقارير الإنجاز الشهرية</p>
        </div>
        <div class="flex items-center gap-3 px-6 py-3 bg-red-50 border border-red-100 rounded-2xl text-red-600 font-bold text-sm">
            <span class="material-icons-outlined">error_outline</span>
            <span>التقارير ترسل تلقائياً لأولياء الأمور نهاية كل أسبوع</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 bg-white rounded-[3rem] p-10 shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="flex justify-between items-center mb-12">
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-emerald-600 rounded-full"></span>
                        <span class="text-xs font-bold text-gray-500">الحفظ</span>
                    </div>
                </div>
                <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                    <span class="material-icons-outlined text-emerald-600">trending_up</span>
                    تطور المستوى العام
                </h3>
            </div>
            <div class="h-64 flex items-end justify-between px-4">
                <?php foreach ([['m' => 'أكتوبر', 'v' => 40], ['m' => 'نوفمبر', 'v' => 65], ['m' => 'ديسمبر', 'v' => 85], ['m' => 'يناير', 'v' => 100]] as $d): ?>
                <div class="flex flex-col items-center gap-4 group">
                    <div class="relative w-16 md:w-24 bg-gray-50 rounded-2xl flex flex-col justify-end overflow-hidden h-48">
                        <div class="w-full bg-emerald-200" style="height: <?php echo $d['v']*0.7; ?>%"></div>
                        <div class="absolute bottom-0 w-full bg-emerald-600 shadow-lg" style="height: <?php echo $d['v']*0.4; ?>%"></div>
                    </div>
                    <span class="text-xs font-black text-gray-400 group-hover:text-gray-900"><?php echo $d['m']; ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-emerald-900 p-8 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                <div class="flex justify-between items-center mb-8">
                    <span class="material-icons-outlined text-emerald-400">check_circle_outline</span>
                </div>
                <p class="text-emerald-200 font-bold text-sm mb-1">نسبة الانضباط العام</p>
                <h2 class="text-5xl font-black mb-4">94%</h2>
                <div class="w-full h-2 bg-emerald-800 rounded-full overflow-hidden">
                    <div class="h-full bg-emerald-400 rounded-full" style="width: 94%"></div>
                </div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-30"></div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="text-xl font-black text-gray-800">تقارير الطلاب التفصيلية</h3>
        </div>
        <div class="divide-y divide-gray-50">
            <?php foreach ($studentsReports as $report): ?>
            <div class="p-6 md:p-8 hover:bg-gray-50/50 transition-all flex flex-col md:flex-row items-center gap-8 text-center md:text-right">
                <div class="flex flex-col md:flex-row items-center gap-4 md:w-80">
                    <div class="w-14 h-14 bg-<?php echo $report['color']; ?>-100 text-<?php echo $report['color']; ?>-700 rounded-2xl flex items-center justify-center font-black text-xl">
                        <?php echo mb_substr($report['name'], 0, 1, 'UTF-8'); ?>
                    </div>
                    <div>
                        <h4 class="font-black text-gray-800"><?php echo $report['name']; ?></h4>
                        <p class="text-xs text-gray-400 font-bold"><?php echo $report['circle']; ?> • الجزء <?php echo $report['joz']; ?></p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-8 flex-1">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-black text-gray-400 uppercase">آخر تقييم</span>
                        <span class="text-sm font-black text-<?php echo $report['color'] == 'emerald' ? 'emerald' : 'blue'; ?>-600"><?php echo $report['rating']; ?></span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-black text-gray-400 uppercase">المحفوظات</span>
                        <span class="text-sm font-black text-gray-700"><?php echo $report['pages']; ?> صفحة</span>
                    </div>
                </div>
                <button class="px-8 py-3 bg-emerald-700 text-white rounded-2xl font-black text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all flex items-center gap-2">
                    <span class="material-icons-outlined text-sm">visibility</span>
                    عرض التقرير الكامل
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>