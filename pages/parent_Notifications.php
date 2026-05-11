<?php
// Converted from parent/Notifications.jsx
$alerts = [
    ['id' => 1, 'type' => 'report', 'title' => 'تقرير الحفظ الأسبوعي - أحمد محمد', 'desc' => 'تم تحديث تقرير الأداء الخاص بالطالب أحمد، لقد أتم حفظ سورة الملك بتقدير ممتاز.', 'time' => 'منذ ساعتين', 'icon' => 'assignment', 'color' => 'emerald'],
    ['id' => 2, 'type' => 'absence', 'title' => 'تنبيه غياب غير مبرر', 'desc' => 'تغيبت الطالبة سارة محمد عن حلقة التجويد الصباحية لهذا اليوم دون إخطار مسبق.', 'time' => '10:30 ص', 'icon' => 'error', 'color' => 'red'],
    ['id' => 3, 'type' => 'promo', 'title' => 'إعلان: مسابقة المشكاة السنوية', 'desc' => 'تعلن إدارة مشكاة عن بدء التسجيل في المسابقة السنوية لحفظ القرآن الكريم وجوائز كبرى للفائزين.', 'time' => 'أمس', 'icon' => 'announcement', 'color' => 'amber'],
    ['id' => 4, 'type' => 'payment', 'title' => 'تأكيد عملية دفع بنجاح', 'desc' => 'تم استلام دفعة الاشتراك الشهري بنجاح. رقم الفاتورة المرجعي: INV-9921#.', 'time' => 'أمس', 'icon' => 'receipt', 'color' => 'blue'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">مركز التنبيهات</h1>
            <p class="text-gray-500 font-medium">تابع آخر التحديثات المتعلقة بمسيرة أبنائك التعليمية والإعلانات الإدارية</p>
        </div>
        <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">
            <span class="material-icons-outlined">check_circle</span>
            تحديد الكل كمقروء
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 text-right">
        <div class="lg:col-span-1 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-white p-5 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col items-center justify-center text-center group hover:shadow-lg transition-all">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl mb-3 transition-transform group-hover:scale-110 bg-emerald-50 text-emerald-700"><span class="material-icons-outlined">assignment</span></div>
                    <div class="text-xl font-black text-gray-900 mb-1">12</div>
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest leading-tight">تقارير جديدة</p>
                </div>
            </div>
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10 text-right">
                    <h4 class="text-lg font-black mb-1">مستوى الالتزام</h4>
                    <p class="text-[10px] text-emerald-300 font-bold mb-6 uppercase tracking-widest">معدل حضور الأبناء</p>
                    <div class="text-4xl font-black mb-4">94%</div>
                    <div class="w-full h-2 bg-emerald-800 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-400 rounded-full" style="width: 94%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-6">
            <div class="space-y-4">
                <?php foreach ($alerts as $alert): ?>
                <div class="group bg-white p-6 md:p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all relative overflow-hidden flex flex-col md:flex-row items-center gap-8 text-right">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shrink-0 transition-transform group-hover:scale-110 <?php echo $alert['color'] === 'emerald' ? 'bg-emerald-50 text-emerald-600' : ($alert['color'] === 'red' ? 'bg-red-50 text-red-600' : ($alert['color'] === 'amber' ? 'bg-amber-50 text-amber-600' : 'bg-blue-50 text-blue-600')); ?>">
                        <span class="material-icons-outlined text-3xl"><?php echo $alert['icon']; ?></span>
                    </div>
                    <div class="flex-1 text-center md:text-right">
                        <div class="flex flex-col md:flex-row md:items-center justify-center md:justify-start gap-2 mb-2">
                            <h4 class="text-lg font-black <?php echo $alert['color'] === 'red' ? 'text-red-700' : 'text-gray-900'; ?>"><?php echo $alert['title']; ?></h4>
                            <span class="text-[10px] font-black text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md"><?php echo $alert['time']; ?></span>
                        </div>
                        <p class="text-sm font-medium text-gray-500 leading-relaxed"><?php echo $alert['desc']; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>