<?php
// Converted from student/Profile.jsx
$user = [
    'name' => $_SESSION['user_name'],
    'phone' => '0500000000',
    'email' => 'student@mishkat.com',
    'nationalId' => '1029384756',
    'location' => 'الرياض، السعودية',
    'gender' => 'ذكر',
    'age' => 20,
    'track' => 'حفظ'
];
?>
<main class="flex-1 px-10 py-6" dir="rtl">
    <div class="bg-white rounded-xl px-6 py-4 flex justify-between items-center mb-6 shadow-sm">
        <div class="flex gap-5 text-gray-500 text-xl">
            <span class="material-icons-outlined">notifications</span>
            <span class="material-icons-outlined">settings</span>
        </div>
        <h1 class="text-lg font-bold text-emerald-700">الملف الشخصي للطالب</h1>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-md space-y-6 text-right">
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <h2 class="text-2xl font-bold text-gray-800">بيانات الحساب الشخصي</h2>
            <button class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-6 py-2 rounded-xl font-bold hover:bg-emerald-100 transition">تعديل البيانات</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <p class="text-xs text-gray-400 mb-1">الاسم الكامل</p>
                <div class="flex items-center gap-3 font-bold">
                    <span class="material-icons-outlined text-emerald-600">person</span>
                    <span><?php echo htmlspecialchars($user['name']); ?></span>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <p class="text-xs text-gray-400 mb-1">رقم الهاتف</p>
                <div class="flex items-center gap-3 font-bold">
                    <span class="material-icons-outlined text-emerald-600">phone</span>
                    <span><?php echo htmlspecialchars($user['phone']); ?></span>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <p class="text-xs text-gray-400 mb-1">البريد الإلكتروني</p>
                <div class="flex items-center gap-3 font-bold">
                    <span class="material-icons-outlined text-emerald-600">email</span>
                    <span><?php echo htmlspecialchars($user['email']); ?></span>
                </div>
            </div>
            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <p class="text-xs text-gray-400 mb-1">المسار الحالي</p>
                <div class="flex items-center gap-3 font-bold text-emerald-800">
                    <span class="material-icons-outlined text-emerald-600">auto_stories</span>
                    <span><?php echo htmlspecialchars($user['track']); ?></span>
                </div>
            </div>
        </div>
    </div>
</main>