<?php
// Converted from ReportsAdmin.jsx
$studentsProgress = [
    ['id' => 1, 'name' => 'أحمد سامي القحطاني', 'level' => 'المستوى الثالث - حلقة الفاروق', 'progress' => 78, 'status' => 'ملتزم', 'avatar' => 'أ'],
    ['id' => 2, 'name' => 'محمد عبد الرحمن', 'level' => 'المستوى الأول - حلقة النور', 'progress' => 42, 'status' => 'يحتاج متابعة', 'avatar' => 'م'],
    ['id' => 3, 'name' => 'سارة خالد التميمي', 'level' => 'المستوى الرابع - حلقة خديجة', 'progress' => 92, 'status' => 'ملتزم', 'avatar' => 'س']
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">التقارير التحليلية</h1>
            <p class="text-gray-500 font-medium">متابعة شاملة لمؤشرات الأداء الأكاديمي والالتزام الإداري</p>
        </div>
        <div class="flex gap-4">
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">download</span>
                تصدير البيانات
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="p-8 rounded-[3rem] shadow-sm border transition-all group hover:shadow-xl relative overflow-hidden bg-white border-emerald-100 text-right">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-emerald-50 text-emerald-700 shadow-emerald-100">
                    <span class="material-icons-outlined text-3xl">trending_up</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600">+12.5%</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">معدل الإنجاز العام</p>
            <h2 class="text-3xl font-black text-gray-900">84.2%</h2>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden text-right">
        <table class="w-full text-right border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الطالب والمستوى</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">نسبة الإنجاز</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">الحالة الإدارية</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($studentsProgress as $student): ?>
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center font-black text-xl group-hover:scale-110 transition-transform"><?php echo $student['avatar']; ?></div>
                            <div>
                                <p class="font-black text-gray-900 mb-0.5"><?php echo $student['name']; ?></p>
                                <p class="text-[10px] text-gray-400 font-bold"><?php echo $student['level']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex flex-col gap-2 min-w-[120px]">
                            <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-1000 <?php echo $student['progress'] > 50 ? 'bg-emerald-600' : 'bg-red-500'; ?>" style="width: <?php echo $student['progress']; ?>%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase <?php echo $student['status'] === 'ملتزم' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600'; ?>">
                            • <?php echo $student['status']; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>