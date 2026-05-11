<?php
// Converted from ReviewTeachers.jsx
$requests = [
    ['id' => 1, 'name' => 'أ. فاطمة الزهراء', 'specialty' => 'اللغة العربية', 'date' => '14 أكتوبر 2023', 'experience' => '5 سنوات', 'email' => 'f.zahra@email.com', 'status' => 'بانتظار المراجعة', 'avatar' => 'F'],
    ['id' => 2, 'name' => 'د. أحمد عبد الرحمن', 'specialty' => 'الدراسات الإسلامية', 'date' => '12 أكتوبر 2023', 'experience' => '12 سنة', 'email' => 'a.abdelrahman@email.com', 'status' => 'بانتظار المراجعة', 'avatar' => 'A'],
    ['id' => 3, 'name' => 'د. مريم إبراهيم', 'specialty' => 'التربية الإسلامية', 'date' => '16 أكتوبر 2023', 'experience' => '15 سنة', 'email' => 'm.ibrahim@email.com', 'status' => 'بانتظار المراجعة', 'avatar' => 'M'],
    ['id' => 4, 'name' => 'أ. يوسف محمد', 'specialty' => 'علوم القرآن', 'date' => '15 أكتوبر 2023', 'experience' => '8 سنوات', 'email' => 'yousif.m@email.com', 'status' => 'بانتظار المراجعة', 'avatar' => 'Y']
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">مراجعة المعلمين الجدد</h1>
            <p class="text-gray-500 font-medium">التحقق من الكفاءة العلمية والخبرات العملية للمتقدمين الجدد</p>
        </div>
        <div class="flex gap-4">
            <div class="relative w-64 md:w-80">
                <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                <input type="text" placeholder="بحث عن معلم..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10 text-right">
                    <div class="w-16 h-16 bg-emerald-800 rounded-2xl flex items-center justify-center text-3xl mb-8">
                        <span class="material-icons-outlined">verified_user</span>
                    </div>
                    <h3 class="text-2xl font-black mb-4">نظام الفحص</h3>
                    <p class="text-xs font-medium text-emerald-200 leading-relaxed mb-8">جميع طلبات المعلمين الجدد تكون مجمدة تلقائياً حتى يتم اعتمادها من قبل الإدارة.</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-right">
                <?php foreach ($requests as $req): ?>
                <div class="group bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-2xl transition-all relative overflow-hidden flex flex-col h-full">
                    <div class="flex justify-between items-start mb-8">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center font-black text-2xl group-hover:scale-110 transition-transform shadow-sm"><?php echo $req['avatar']; ?></div>
                            <div>
                                <h3 class="text-xl font-black text-gray-900 mb-0.5 group-hover:text-emerald-700 transition-colors"><?php echo $req['name']; ?></h3>
                                <p class="text-xs font-bold text-gray-400">التخصص: <?php echo $req['specialty']; ?></p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[9px] font-black uppercase tracking-widest rounded-lg"><?php echo $req['status']; ?></span>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full py-4 bg-emerald-50 text-emerald-700 rounded-2xl font-black text-sm flex items-center justify-center gap-2 hover:bg-emerald-100 transition-all">
                            <span class="material-icons-outlined">visibility</span>
                            عرض الملف الشخصي الكامل
                        </button>
                        <div class="flex gap-3">
                            <button class="flex-1 py-4 bg-red-50 text-red-600 rounded-2xl font-black text-xs hover:bg-red-100 transition-all flex items-center justify-center gap-1.5 shadow-sm">
                                <span class="material-icons-outlined">close</span>
                                رفض الطلب
                            </button>
                            <button class="flex-1 py-4 bg-emerald-700 text-white rounded-2xl font-black text-xs hover:bg-emerald-800 transition-all flex items-center justify-center gap-1.5 shadow-lg shadow-emerald-100">
                                <span class="material-icons-outlined">check</span>
                                قبول
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>