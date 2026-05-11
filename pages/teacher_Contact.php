<?php
// Converted from ContactTeacher.jsx
$user = [
    'name' => 'د. أحمد محمد',
    'specialty' => 'معلم قراءات وتجويد',
    'phone' => '0500000000',
    'email' => 'teacher@mishkat.com',
    'experience' => 12,
    'education' => 'دكتوراه في الدراسات الإسلامية'
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">السيرة الذاتية والملف الشخصي</h1>
            <p class="text-gray-500 font-medium">إدارة ملفك المهني وسيرتك الذاتية في منصة مشكاة</p>
        </div>
        <button class="flex items-center gap-2 px-8 py-3 bg-emerald-700 text-white rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">
            <span class="material-icons-outlined">edit</span>
            تعديل البيانات
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-right">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 text-center relative overflow-hidden group">
                <div class="relative inline-block mb-6">
                    <div class="w-32 h-32 bg-emerald-100 rounded-[2.5rem] flex items-center justify-center overflow-hidden border-4 border-white shadow-xl">
                        <span class="material-icons-outlined text-emerald-700 text-6xl">person</span>
                    </div>
                </div>
                <h2 class="text-2xl font-black text-gray-900 mb-1"><?php echo $user['name']; ?></h2>
                <p class="text-emerald-600 font-black text-sm mb-8"><?php echo $user['specialty']; ?></p>
                <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 flex items-center justify-between mb-4">
                    <span class="text-emerald-700 font-black">نشط</span>
                    <span class="text-xs font-bold text-emerald-600/60 uppercase">حالة الحساب</span>
                </div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -translate-x-16 -translate-y-16 blur-3xl opacity-50"></div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-700">
                        <span class="material-icons-outlined">history_edu</span>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800">بيانات السيرة الذاتية</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-right">
                    <div class="p-6 rounded-[2rem] border bg-gray-50 border-gray-50 flex items-center justify-between group hover:shadow-lg">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-white text-gray-400 shadow-sm">
                            <span class="material-icons-outlined">person</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 mb-1 uppercase tracking-widest">الاسم الكامل</p>
                            <h4 class="text-lg font-black text-gray-800"><?php echo $user['name']; ?></h4>
                        </div>
                    </div>
                    <div class="p-6 rounded-[2rem] border bg-emerald-50 border-emerald-100 flex items-center justify-between group hover:shadow-lg">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-white text-emerald-700 shadow-sm">
                            <span class="material-icons-outlined">work</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 mb-1 uppercase tracking-widest">سنوات الخبرة</p>
                            <h4 class="text-lg font-black text-emerald-900"><?php echo $user['experience']; ?> سنوات</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
