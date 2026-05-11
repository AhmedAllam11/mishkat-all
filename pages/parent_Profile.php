<?php
// Converted from Profile.jsx
$user = [
    'name' => 'ولي الأمر',
    'phone' => '0500000000',
    'email' => 'parent@mishkat.com',
    'gender' => 'ذكر',
    'age' => 35
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">الملف الشخصي</h1>
            <p class="text-gray-500 font-medium">إدارة بيانات حسابك وتفضيلات التواصل في منصة مشكاة</p>
        </div>
        <div class="flex gap-3">
            <button class="p-3 bg-white border border-gray-100 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all shadow-sm">
                <span class="material-icons-outlined">notifications_none</span>
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">
                <span class="material-icons-outlined">edit</span>
                تعديل الملف
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 text-center relative overflow-hidden group">
                <div class="w-24 h-24 bg-emerald-100 rounded-[2rem] mx-auto flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-icons-outlined text-emerald-700 text-5xl">person</span>
                </div>
                <h2 class="text-2xl font-black text-gray-900 mb-1"><?php echo $user['name']; ?></h2>
                <p class="text-sm text-gray-400 font-bold mb-8">حساب ولي أمر معتمد</p>
                <div class="space-y-4">
                    <div class="bg-emerald-50 p-4 rounded-2xl flex justify-between items-center border border-emerald-100">
                        <span class="font-black text-emerald-700">نشط</span>
                        <span class="text-xs font-bold text-emerald-600/60 uppercase tracking-widest">حالة الحساب</span>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -translate-x-16 -translate-y-16 blur-3xl opacity-50"></div>
            </div>

            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="material-icons-outlined text-emerald-400 text-4xl mb-6 group-hover:rotate-12 transition-transform">security</span>
                    <h4 class="text-xl font-black mb-2">أمان الحساب</h4>
                    <p class="text-sm text-emerald-200 font-medium mb-8 leading-relaxed">تأكد من تحديث كلمة المرور بشكل دوري لحماية بياناتك وبيانات أبنائك.</p>
                    <button class="w-full py-4 bg-emerald-700 hover:bg-emerald-600 rounded-2xl font-black text-sm transition-all shadow-xl">تغيير كلمة المرور</button>
                </div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-50"></div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-700">
                        <span class="material-icons-outlined">settings</span>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800">بيانات الحساب الشخصي</h2>
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
                    <div class="p-6 rounded-[2rem] border bg-gray-50 border-gray-50 flex items-center justify-between group hover:shadow-lg">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-white text-gray-400 shadow-sm">
                            <span class="material-icons-outlined">phone</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 mb-1 uppercase tracking-widest">رقم الهاتف</p>
                            <h4 class="text-lg font-black text-gray-800"><?php echo $user['phone']; ?></h4>
                        </div>
                    </div>
                    <div class="p-6 rounded-[2rem] border bg-gray-50 border-gray-50 flex items-center justify-between group hover:shadow-lg">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-white text-gray-400 shadow-sm">
                            <span class="material-icons-outlined">email</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 mb-1 uppercase tracking-widest">البريد الإلكتروني</p>
                            <h4 class="text-lg font-black text-gray-800"><?php echo $user['email']; ?></h4>
                        </div>
                    </div>
                    <div class="p-6 rounded-[2rem] border bg-emerald-50 border-emerald-100 flex items-center justify-between group hover:shadow-lg">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 bg-white text-emerald-700 shadow-sm">
                            <span class="material-icons-outlined">check_circle</span>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 mb-1 uppercase tracking-widest">تاريخ الانضمام</p>
                            <h4 class="text-lg font-black text-emerald-900">أكتوبر 2024</h4>
                        </div>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/50 rounded-full -translate-x-16 -translate-y-16 blur-3xl"></div>
            </div>
        </div>
    </div>
</main>