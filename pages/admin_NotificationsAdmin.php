<?php
// Converted from NotificationsAdmin.jsx
$alerts = [
    ['id' => 1, 'type' => 'error', 'title' => 'فشل في معالجة الدفعة المالية', 'desc' => 'تعذر إرسال المستحقات المالية لـ 3 معلمين بسبب خطأ في بيانات الحساب البنكي. يرجى المراجعة الفورية.', 'time' => 'منذ 15 دقيقة', 'color' => 'red'],
    ['id' => 2, 'type' => 'info', 'title' => 'تحديث النظام المجدول', 'desc' => 'سيبدأ تحديث النظام القادم يوم الأحد الساعة 2:00 صباحاً. سيتم إخطار جميع المستخدمين عبر البريد الإلكتروني.', 'time' => 'منذ ساعتين', 'color' => 'blue'],
    ['id' => 3, 'type' => 'msg', 'title' => 'رسالة من المعلمة: سارة خالد', 'desc' => 'أواجه مشكلة في إضافة طالب جديد إلى حلقة "نور البيان". يبدو أن النظام يظهر رسالة خطأ عند الضغط على حفظ.', 'time' => 'منذ 4 ساعات', 'color' => 'emerald', 'avatar' => 'S'],
    ['id' => 4, 'type' => 'success', 'title' => 'تفعيل حسابات طلاب جدد', 'desc' => 'تمت مراجعة وقبول 5 طلبات تسجيل جديدة بنجاح وإرسال بيانات الدخول لأولياء الأمور.', 'time' => 'أمس', 'color' => 'emerald'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">مركز التواصل والإشعارات</h1>
            <p class="text-gray-500 font-medium">إدارة تنبيهات النظام، رسائل المستخدمين، والتواصل الجماعي المباشر</p>
        </div>
        <div class="w-full md:w-96 relative">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="البحث في سجل التنبيهات..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-right">
        <div class="lg:col-span-2 space-y-6">
            <div class="space-y-4">
                <?php foreach ($alerts as $alert): ?>
                <div class="group bg-white p-6 md:p-8 rounded-[2.5rem] shadow-sm border border-gray-100 hover:shadow-xl transition-all relative overflow-hidden flex flex-col md:flex-row items-center gap-8 text-right">
                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shrink-0 transition-transform group-hover:scale-110 shadow-sm <?php echo $alert['color'] === 'red' ? 'bg-red-50 text-red-600' : ($alert['color'] === 'blue' ? 'bg-blue-50 text-blue-600' : 'bg-emerald-50 text-emerald-700'); ?>">
                        <?php if (isset($alert['avatar'])): ?>
                            <span class="font-black text-xl"><?php echo $alert['avatar']; ?></span>
                        <?php else: ?>
                            <span class="material-icons-outlined text-3xl"><?php echo $alert['type'] === 'error' ? 'error' : ($alert['type'] === 'info' ? 'info' : 'notifications_active'); ?></span>
                        <?php endif; ?>
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

        <div class="space-y-6 text-right">
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group text-center">
                <div class="relative z-10 flex flex-col items-center">
                    <div class="w-16 h-16 bg-emerald-800 rounded-2xl flex items-center justify-center text-3xl mb-6">
                        <span class="material-icons-outlined">send</span>
                    </div>
                    <h3 class="text-2xl font-black mb-2">إرسال تنبيه جديد</h3>
                    <p class="text-sm font-medium text-emerald-200 leading-relaxed mb-8 px-4">قم بإرسال رسائل فورية أو تنبيهات مجدولة لجميع المستخدمين أو فئات محددة.</p>
                    <button class="w-full py-4 bg-white text-emerald-900 rounded-[2rem] font-black shadow-xl hover:scale-105 transition-all">بدء الإرسال الجماعي</button>
                </div>
            </div>
        </div>
    </div>
</main>