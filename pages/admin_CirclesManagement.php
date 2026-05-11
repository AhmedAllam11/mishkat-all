<?php
// Converted from CirclesManagement.jsx
$circles = [
    ['id' => 1, 'title' => 'حلقة الإمام الشافعي (تجويد)', 'teacher' => 'د. أحمد العتيبي', 'studentsCount' => 12, 'status' => 'مباشر الآن', 'nextTime' => 'اليوم - 8:30 م', 'progress' => 85, 'color' => 'emerald'],
    ['id' => 2, 'title' => 'أساسيات التفسير - المستوى الأول', 'teacher' => 'أ. سارة خالد', 'studentsCount' => 20, 'status' => 'تبدأ قريباً', 'nextTime' => 'الاثنين - 4:00 م', 'progress' => 20, 'color' => 'blue'],
    ['id' => 3, 'title' => 'حفظ جزء تبارك - المجموعة ب', 'teacher' => 'الشيخ محمد محمود', 'studentsCount' => 8, 'status' => 'مباشر الآن', 'nextTime' => 'غداً - 9:00 ص', 'progress' => 50, 'color' => 'emerald']
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الحلقات التعليمية</h1>
            <p class="text-gray-500 font-medium">الفصل الدراسي الثاني - متابعة وتنظيم الحلقات المباشرة</p>
        </div>
        <div class="flex gap-4">
            <div class="relative w-64 md:w-80">
                <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                <input type="text" placeholder="بحث عن حلقة، معلم..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
            </div>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">add</span>
                إنشاء حلقة
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10 text-right">
                    <h3 class="text-xl font-black mb-2">تنظيم سريع</h3>
                    <p class="text-xs font-medium text-emerald-200 leading-relaxed mb-8">قم بربط الطلاب والمعلمين بالحلقات المتاحة بضغطة واحدة.</p>
                    <div class="space-y-3">
                        <button class="w-full flex justify-between items-center bg-emerald-800 hover:bg-emerald-700 px-6 py-4 rounded-2xl text-sm font-black transition-all group">
                            <div class="flex items-center gap-3">
                                <span class="material-icons-outlined text-emerald-400">person_add</span>
                                <span>ربط معلم</span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 text-center group hover:shadow-xl transition-all">
                    <h2 class="text-4xl font-black mb-2 transition-transform group-hover:scale-110 text-emerald-700">42</h2>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">إجمالي الحلقات</p>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 text-center group hover:shadow-xl transition-all">
                    <h2 class="text-4xl font-black mb-2 transition-transform group-hover:scale-110 text-blue-700">850</h2>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">طلاب نشطون</p>
                </div>
                <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 text-center group hover:shadow-xl transition-all">
                    <h2 class="text-4xl font-black mb-2 transition-transform group-hover:scale-110 text-amber-700">10</h2>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">معلمون متاحون</p>
                </div>
            </div>

            <div class="space-y-6">
                <?php foreach ($circles as $circle): ?>
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 group hover:shadow-xl transition-all relative overflow-hidden">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8 text-right">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 rounded-[1.5rem] flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm <?php echo $circle['color'] === 'emerald' ? 'bg-emerald-50 text-emerald-700' : 'bg-blue-50 text-blue-700'; ?>">
                                <span class="material-icons-outlined text-3xl">video_call</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-gray-900 mb-1 group-hover:text-emerald-700 transition-colors"><?php echo $circle['title']; ?></h3>
                                <p class="text-sm font-bold text-gray-400"><?php echo $circle['teacher']; ?> • <span class="text-emerald-600"><?php echo $circle['studentsCount']; ?> طالباً</span></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest <?php echo $circle['status'] === 'مباشر الآن' ? 'bg-red-50 text-red-600 animate-pulse' : 'bg-gray-100 text-gray-500'; ?>">
                                <?php echo $circle['status']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row justify-between items-end gap-6 border-t border-gray-50 pt-8">
                        <button class="text-emerald-700 font-black text-sm flex items-center gap-2 hover:underline">
                            عرض تفاصيل الحلقة والطلاب
                            <span class="material-icons-outlined">keyboard_arrow_left</span>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>