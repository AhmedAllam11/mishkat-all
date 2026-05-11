<?php
// Converted from AccountsManagement.jsx
$users = [
    ['id' => '2024-05110', 'name' => 'عبدالرحمن محمد الفارس', 'type' => 'معلم', 'joinDate' => '12 مارس 2024', 'status' => 'نشط', 'avatar' => 'A'],
    ['id' => '2024-09822', 'name' => 'سعود بن عبدالله', 'type' => 'طالب', 'joinDate' => '05 فبراير 2024', 'status' => 'نشط', 'avatar' => 'S'],
    ['id' => '2023-11004', 'name' => 'نورة خالد العتيبي', 'type' => 'ولي أمر', 'joinDate' => '20 نوفمبر 2023', 'status' => 'متوقف', 'avatar' => 'N'],
    ['id' => '2024-01229', 'name' => 'ياسر سليمان', 'type' => 'معلم', 'joinDate' => '15 يناير 2024', 'status' => 'نشط', 'avatar' => 'Y'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الحسابات</h1>
            <p class="text-gray-500 font-medium">التحكم المركزي بجميع مستخدمي منصة مشكاة</p>
        </div>
        <div class="flex gap-3">
            <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-100 rounded-2xl text-gray-600 font-bold hover:bg-gray-50 transition-all shadow-sm">
                <span class="material-icons-outlined">file_download</span>
                تصدير البيانات
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">add</span>
                إضافة حساب جديد
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-emerald-900 p-8 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group">
            <div class="relative z-10">
                <p class="text-[10px] font-black text-emerald-300 uppercase tracking-widest mb-1">إجمالي المستخدمين</p>
                <h2 class="text-4xl font-black mb-4">2,482</h2>
                <div class="flex items-center gap-2 text-xs font-black text-emerald-400">
                    <span class="material-icons-outlined" style="font-size: 16px;">trending_up</span>
                    <span>+24% عن الشهر الماضي</span>
                </div>
            </div>
            <div class="absolute top-4 left-4 text-emerald-800 opacity-20 text-6xl">
                <span class="material-icons-outlined" style="font-size: 60px;">people</span>
            </div>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-blue-50 text-blue-700">
                    <span class="material-icons-outlined">school</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600">+12%</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">الطلاب</p>
            <h2 class="text-2xl font-black text-gray-900">1,840</h2>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-amber-50 text-amber-700">
                    <span class="material-icons-outlined">groups</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600">+5%</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">المعلمون</p>
            <h2 class="text-2xl font-black text-gray-900">142</h2>
        </div>
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 group hover:shadow-xl transition-all">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-red-50 text-red-700">
                    <span class="material-icons-outlined">family_restroom</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-red-50 text-red-600">-3%</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">أولياء الأمور</p>
            <h2 class="text-2xl font-black text-gray-900">500</h2>
        </div>
    </div>

    <div class="bg-white p-4 rounded-[2.5rem] shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row gap-4 items-center relative overflow-hidden">
        <div class="flex-1 relative w-full">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="البحث عن مستخدم بالاسم أو رقم الهوية..." class="w-full pr-12 pl-4 py-3.5 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 text-sm font-bold" />
        </div>
        <div class="flex gap-2">
            <button class="p-3.5 bg-gray-50 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all"><span class="material-icons-outlined">filter_list</span></button>
            <button class="p-3.5 bg-gray-50 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all"><span class="material-icons-outlined">history</span></button>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-right border-collapse">
            <thead>
                <tr class="bg-gray-50/50 border-b border-gray-50">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">المستخدم</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">نوع الحساب</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">تاريخ الانضمام</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الحالة</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($users as $user): ?>
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-emerald-100 text-emerald-700 rounded-2xl flex items-center justify-center font-black text-xl group-hover:scale-110 transition-transform">
                                <?php echo $user['avatar']; ?>
                            </div>
                            <div>
                                <p class="font-black text-gray-900"><?php echo $user['name']; ?></p>
                                <p class="text-[10px] text-gray-400 font-bold">ID: <?php echo $user['id']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest <?php echo $user['type'] === 'معلم' ? 'bg-emerald-50 text-emerald-600' : ($user['type'] === 'طالب' ? 'bg-blue-50 text-blue-600' : 'bg-orange-50 text-orange-600'); ?>">
                            <?php echo $user['type']; ?>
                        </span>
                    </td>
                    <td class="px-8 py-5 text-sm font-bold text-gray-400"><?php echo $user['joinDate']; ?></td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full <?php echo $user['status'] === 'نشط' ? 'bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.5)]' : 'bg-red-500'; ?>"></div>
                            <span class="text-xs font-black text-gray-700"><?php echo $user['status']; ?></span>
                        </div>
                    </td>
                    <td class="px-8 py-5">
                        <button class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                            <span class="material-icons-outlined">more_vert</span>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>