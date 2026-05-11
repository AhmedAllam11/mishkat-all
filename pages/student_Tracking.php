<?php
// Converted from Tracking.jsx
$weeklyStats = [
    ['day' => 'الأحد', 'date' => 24, 'progress' => 80, 'active' => false],
    ['day' => 'الإثنين', 'date' => 25, 'progress' => 95, 'active' => false],
    ['day' => 'الثلاثاء', 'date' => 26, 'progress' => 70, 'active' => false],
    ['day' => 'الأربعاء', 'date' => 27, 'progress' => 90, 'active' => false],
    ['day' => 'الخميس', 'date' => 28, 'progress' => 100, 'active' => true],
    ['day' => 'الجمعة', 'date' => 29, 'progress' => 0, 'disabled' => true],
    ['day' => 'السبت', 'date' => 30, 'progress' => 0, 'disabled' => true],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">متابعة مسارك التعليمي</h1>
            <p class="text-gray-500 font-medium">أنت تبلي بلاءً حسناً! لقد أنجزت 85% من أهداف هذا الشهر</p>
        </div>
        <div class="flex gap-3">
            <div class="bg-white px-4 py-2 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-2">
                <span class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></span>
                <span class="text-xs font-black text-emerald-700">أنت في المسار الصحيح</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-right">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="flex justify-between items-center mb-10">
                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-700 rounded-full text-xs font-black">المستوى المتقدم</span>
                    <h3 class="text-xl font-black text-gray-800 flex items-center gap-2">
                        <span class="material-icons-outlined text-emerald-600">timeline</span>
                        خريطة المسار التعليمي
                    </h3>
                </div>
                <div class="relative flex justify-between items-center px-4 md:px-12">
                    <div class="absolute top-1/2 left-12 right-12 h-1.5 bg-gray-50 -translate-y-1/2 rounded-full"></div>
                    <div class="absolute top-1/2 left-1/2 right-12 h-1.5 bg-emerald-600 -translate-y-1/2 rounded-full shadow-lg shadow-emerald-200"></div>
                    <div class="relative z-10 flex flex-col items-center group">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl transition-all duration-500 shadow-lg bg-emerald-100 text-emerald-700">
                            <span class="material-icons-outlined">check_circle</span>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-sm font-black mb-1">التأسيس</p>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-gray-400">مكتمل</p>
                        </div>
                    </div>
                    <div class="relative z-10 flex flex-col items-center group">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-2xl transition-all duration-500 shadow-lg bg-emerald-600 text-white scale-125 ring-8 ring-emerald-50">
                            <span class="material-icons-outlined">auto_graph</span>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-sm font-black mb-1 text-emerald-800">المرحلة الحالية</p>
                            <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-600">قيد الحفظ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 text-center">
                <div class="inline-flex p-4 bg-emerald-50 rounded-3xl text-emerald-700 mb-6">
                    <span class="material-icons-outlined text-4xl">trending_up</span>
                </div>
                <p class="text-gray-400 font-black text-sm mb-2 uppercase tracking-widest">إنجاز العام</p>
                <h2 class="text-5xl font-black text-gray-900 mb-4">68%</h2>
                <div class="relative h-4 bg-gray-50 rounded-full overflow-hidden mb-4">
                    <div class="absolute top-0 right-0 bottom-0 bg-emerald-600 rounded-full shadow-lg shadow-emerald-100 transition-all duration-1000" style="width: 68%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full mt-10 text-right">
        <h3 class="text-2xl font-black text-gray-800 flex items-center gap-2 justify-end mb-8">
            النشاط الأسبوعي
            <span class="material-icons-outlined text-emerald-600">calendar_month</span>
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-6">
            <?php foreach ($weeklyStats as $item): 
                $isActive = $item['active'] ?? false;
                $isDisabled = $item['disabled'] ?? false;
                $progress = $item['progress'] ?? 0;
            ?>
            <div class="group h-48 rounded-[2rem] border-2 transition-all p-6 flex flex-col justify-between items-center cursor-pointer <?php echo $isActive ? 'bg-emerald-600 border-emerald-600 text-white shadow-xl shadow-emerald-100 scale-105' : ($isDisabled ? 'bg-gray-50/50 border-transparent opacity-40' : 'bg-white border-transparent hover:border-emerald-100 shadow-sm'); ?>">
                <span class="text-xs font-black uppercase <?php echo $isActive ? 'text-emerald-100' : 'text-gray-400'; ?>"><?php echo $item['day']; ?></span>
                <span class="text-2xl font-black"><?php echo $item['date']; ?></span>
                <div class="w-full space-y-2">
                    <div class="h-1.5 w-full rounded-full overflow-hidden <?php echo $isActive ? 'bg-emerald-700' : 'bg-gray-100'; ?>">
                        <div class="h-full rounded-full transition-all duration-1000 <?php echo $isActive ? 'bg-white' : 'bg-emerald-500'; ?>" style="width: <?php echo $progress; ?>%"></div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>