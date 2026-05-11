<?php
// Converted from StudentsPage.jsx
$students = [
    ['id' => 'STD-40291', 'name' => 'أحمد علي منصور', 'track' => 'حفظ القرآن المكثف', 'level' => 'المستوى 4', 'joinDate' => '2024-01-15', 'status' => 'نشط'],
    ['id' => 'STD-31822', 'name' => 'خالد محمود إبراهيم', 'track' => 'التجويد والإتقان', 'level' => 'المستوى 2', 'joinDate' => '2024-02-10', 'status' => 'نشط'],
    ['id' => 'STD-55120', 'name' => 'سعد إبراهيم الصاوي', 'track' => 'حفظ القرآن المكثف', 'level' => 'المستوى 1', 'joinDate' => '2024-03-05', 'status' => 'متوقف'],
    ['id' => 'STD-12983', 'name' => 'محمد يوسف', 'track' => 'القراءات العشر', 'level' => 'المستوى 3', 'joinDate' => '2024-01-20', 'status' => 'نشط'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الطلاب</h1>
            <p class="text-gray-500 font-medium">لديك <?php echo count($students); ?> طالباً مسجلاً في حلقاتك حالياً</p>
        </div>
        <div class="flex gap-3">
            <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-100 rounded-2xl text-gray-600 font-bold hover:bg-gray-50 transition-all shadow-sm">
                <span class="material-icons-outlined">file_download</span>
                تصدير القائمة
            </button>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">person_add</span>
                طالب جديد
            </button>
        </div>
    </div>

    <div class="bg-white p-4 rounded-[2rem] shadow-sm border border-gray-100 mb-8 flex flex-col md:flex-row gap-4 items-center">
        <div class="flex-1 relative w-full">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="البحث عن طريق الاسم، الرقم التعريفي..." class="w-full pr-12 pl-4 py-3 bg-gray-50 border-none rounded-2xl outline-none focus:ring-2 focus:ring-emerald-500/20 text-sm font-bold" />
        </div>
        <div class="flex gap-2">
            <button class="p-3 bg-gray-50 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all"><span class="material-icons-outlined">filter_list</span></button>
            <button class="p-3 bg-gray-50 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all"><span class="material-icons-outlined">sort</span></button>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-right border-collapse">
            <thead>
                <tr class="bg-emerald-50/50 border-b border-gray-50">
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">الطالب</th>
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">المسار</th>
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">المستوى</th>
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">تاريخ الانضمام</th>
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">الحالة</th>
                    <th class="px-8 py-5 text-sm font-black text-emerald-800">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($students as $s): ?>
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center font-black">
                                <?php echo mb_substr($s['name'], 0, 1, 'UTF-8'); ?>
                            </div>
                            <div>
                                <p class="font-black text-gray-800"><?php echo $s['name']; ?></p>
                                <p class="text-[10px] text-gray-400 font-bold"><?php echo $s['id']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-5 text-sm font-bold text-gray-600"><?php echo $s['track']; ?></td>
                    <td class="px-8 py-5 text-sm font-black text-emerald-700"><?php echo $s['level']; ?></td>
                    <td class="px-8 py-5 text-sm font-bold text-gray-400"><?php echo $s['joinDate']; ?></td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black <?php echo $s['status'] === 'نشط' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600'; ?>">
                            <?php echo $s['status']; ?>
                        </span>
                    </td>
                    <td class="px-8 py-5">
                        <div class="flex items-center gap-2">
                            <button class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-700 transition-all"><span class="material-icons-outlined text-sm">edit</span></button>
                            <button class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:bg-red-50 hover:text-red-600 transition-all"><span class="material-icons-outlined text-sm">delete</span></button>
                            <button class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:bg-blue-50 hover:text-blue-600 transition-all"><span class="material-icons-outlined text-sm">visibility</span></button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-8 flex justify-between items-center px-4">
        <p class="text-sm font-bold text-gray-400">عرض <?php echo count($students); ?> من <?php echo count($students); ?> طالب</p>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-gray-400 cursor-not-allowed">السابق</button>
            <button class="px-4 py-2 bg-white border border-gray-100 rounded-xl text-sm font-bold text-emerald-700 hover:bg-emerald-50 transition-all">التالي</button>
        </div>
    </div>
</main>