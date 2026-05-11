<?php
// Converted from ReportsPage.jsx
$students = [
    ['id' => 1, 'name' => 'سارة محمد', 'grade' => 'الصف الرابع', 'group' => 'حلقة الفردوس', 'progress' => 88, 'status' => 'نشط', 'avatar' => 'S'],
    ['id' => 2, 'name' => 'أحمد محمد', 'grade' => 'الصف الثاني', 'group' => 'حلقة الرحمة', 'progress' => 94, 'status' => 'نشط', 'avatar' => 'A'],
];
$reports = [
    ['id' => 1, 'title' => 'تقرير الأداء الأسبوعي', 'student' => 'أحمد محمد', 'date' => '2024-10-14', 'teacher' => 'الشيخ عبدالرحمن', 'status' => 'ممتاز', 'score' => 98],
    ['id' => 2, 'title' => 'تقرير الحفظ والتلاوة', 'student' => 'سارة محمد', 'date' => '2024-10-10', 'teacher' => 'المعلمة مريم', 'status' => 'ممتاز', 'score' => 95],
    ['id' => 3, 'title' => 'تقرير السلوك والانضباط', 'student' => 'أحمد محمد', 'date' => '2024-10-05', 'teacher' => 'الشيخ عبدالرحمن', 'status' => 'جيد جداً', 'score' => 88],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">تقارير مستوى الأبناء</h1>
            <p class="text-gray-500 font-medium">متابعة دقيقة للأداء الأكاديمي، الحفظ، والسلوك لأبنائك في منصة مشكاة</p>
        </div>
        <div class="flex gap-3">
            <button class="flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-100 rounded-2xl text-gray-600 font-bold hover:bg-gray-50 transition-all shadow-sm">
                <span class="material-icons-outlined">history</span>
                الأرشيف
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php foreach ($students as $student): ?>
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all">
                <div class="flex justify-between items-start mb-6">
                    <div class="w-16 h-16 bg-emerald-100 text-emerald-700 rounded-[1.5rem] flex items-center justify-center font-black text-2xl group-hover:scale-110 transition-transform">
                        <?php echo $student['avatar']; ?>
                    </div>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest"><?php echo $student['status']; ?></span>
                </div>
                <h3 class="text-xl font-black text-gray-900 mb-1"><?php echo $student['name']; ?></h3>
                <p class="text-sm text-gray-400 font-bold mb-8"><?php echo $student['grade']; ?> • <?php echo $student['group']; ?></p>
                <div class="space-y-4">
                    <div class="flex justify-between items-end mb-1">
                        <span class="text-xs font-black text-emerald-700">معدل الإنجاز العام</span>
                        <span class="text-sm font-black text-gray-900"><?php echo $student['progress']; ?>%</span>
                    </div>
                    <div class="h-2.5 w-full bg-gray-50 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-600 rounded-full transition-all duration-1000" style="width: <?php echo $student['progress']; ?>%"></div>
                    </div>
                </div>
                <button class="w-full mt-8 py-4 bg-emerald-700 text-white rounded-2xl font-black text-sm shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">عرض تقارير الطالب</button>
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/50 rounded-full -translate-x-16 -translate-y-16 blur-3xl"></div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-black mb-8 flex items-center gap-2">
                    <span class="material-icons-outlined text-emerald-400">timeline</span>
                    ملخص الشهر
                </h3>
                <div class="space-y-8">
                    <div class="flex items-center justify-between group">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-emerald-300 uppercase tracking-widest mb-1">نسبة التحسن</p>
                            <h4 class="text-2xl font-black group-hover:scale-105 transition-transform">12.4%</h4>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/5">
                            <span class="material-icons-outlined text-emerald-400">trending_up</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between group">
                        <div class="text-right">
                            <p class="text-[10px] font-black text-emerald-300 uppercase tracking-widest mb-1">نسبة الحضور</p>
                            <h4 class="text-2xl font-black group-hover:scale-105 transition-transform">98%</h4>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur-md border border-white/5">
                            <span class="material-icons-outlined text-emerald-400">trending_up</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-30"></div>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
            <h3 class="text-xl font-black text-gray-800">أحدث التقارير الواردة</h3>
        </div>
        <div class="divide-y divide-gray-50">
            <?php foreach ($reports as $report): ?>
            <div class="p-6 md:p-8 hover:bg-gray-50/50 transition-all flex flex-col md:flex-row items-center gap-8 group">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                    <span class="material-icons-outlined">assignment</span>
                </div>
                <div class="flex-1 text-center md:text-right">
                    <div class="flex flex-col md:flex-row md:items-center gap-2 mb-1 justify-center md:justify-start">
                        <h4 class="text-lg font-black text-gray-900"><?php echo $report['title']; ?></h4>
                        <span class="px-2 py-0.5 bg-gray-100 text-gray-500 rounded-md text-[10px] font-black"><?php echo $report['student']; ?></span>
                    </div>
                    <p class="text-xs text-gray-400 font-bold"><?php echo $report['date']; ?> • <?php echo $report['teacher']; ?></p>
                </div>
                <div class="flex flex-col items-center md:items-end gap-2 min-w-[120px]">
                    <span class="text-emerald-700 font-black text-sm"><?php echo $report['status']; ?></span>
                    <div class="h-1.5 w-24 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-600 rounded-full" style="width: <?php echo $report['score']; ?>%"></div>
                    </div>
                </div>
                <button class="px-8 py-3 bg-emerald-700 text-white rounded-2xl font-black text-xs shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all flex items-center gap-2">
                    <span class="material-icons-outlined text-sm">visibility</span>
                    عرض
                </button>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>