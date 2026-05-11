<?php
// Converted from StudentsManagement.jsx
require_once __DIR__ . '/../includes/db.php';

$students = [];
$res = $conn->query("SELECT id, name, created_at as details, 'نشط' as status, SUBSTRING(name, 1, 1) as avatar, 'emerald' as color FROM users WHERE role = 'student' ORDER BY created_at DESC");
while ($row = $res->fetch_assoc()) {
    $students[] = $row;
}

// If no students in DB yet, show some empty state or the seeded ones
if (empty($students)) {
    $students = [
        ['id' => 'STU-001', 'name' => 'لا يوجد طلاب حالياً', 'details' => 'قم بإضافة طلاب جدد', 'status' => 'غير نشط', 'avatar' => '?', 'color' => 'red'],
    ];
}
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة سجلات الطلاب</h1>
            <p class="text-gray-500 font-medium">متابعة دقيقة لمسار الطلاب الأكاديمي وحالات القيد في النظام</p>
        </div>
        <div class="flex gap-4">
            <div class="relative w-64 md:w-80">
                <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                <input type="text" placeholder="بحث عن طالب، معرف..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
            </div>
            <button class="p-3.5 bg-white border border-gray-100 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all shadow-sm">
                <span class="material-icons-outlined">settings</span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="p-8 rounded-[3rem] shadow-sm border transition-all group hover:shadow-2xl relative overflow-hidden bg-emerald-900 border-emerald-900 text-white shadow-xl">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-emerald-800 text-emerald-400">
                    <span class="material-icons-outlined">school</span>
                </div>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest mb-1 text-emerald-300">إجمالي الطلاب</p>
            <h2 class="text-4xl font-black text-white">1,284</h2>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-emerald-800 rounded-full blur-3xl opacity-50 group-hover:scale-125 transition-transform duration-700"></div>
        </div>
        <div class="p-8 rounded-[3rem] shadow-sm border transition-all group hover:shadow-2xl relative overflow-hidden bg-white border-gray-100">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-blue-50 text-blue-700 shadow-blue-100">
                    <span class="material-icons-outlined">check_circle</span>
                </div>
            </div>
            <p class="text-[10px] font-black uppercase tracking-widest mb-1 text-gray-400">طلاب نشطون</p>
            <h2 class="text-4xl font-black text-gray-900">1,150</h2>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden relative">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-6 bg-gray-50/30">
            <div class="flex bg-white p-1.5 rounded-2xl border border-gray-100 shadow-sm">
                <button class="px-8 py-2.5 text-xs font-black bg-emerald-700 text-white rounded-xl shadow-lg shadow-emerald-100">الكل</button>
                <button class="px-8 py-2.5 text-xs font-black text-gray-400 hover:bg-gray-50 rounded-xl transition-all">نشط</button>
            </div>
            <div class="flex gap-3">
                <button class="flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-100 rounded-2xl text-gray-600 font-bold hover:bg-gray-50 transition-all shadow-sm">
                    <span class="material-icons-outlined">file_download</span>
                    تصدير القائمة
                </button>
                <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                    <span class="material-icons-outlined">add</span>
                    طالب جديد
                </button>
            </div>
        </div>

        <table class="w-full text-right border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الطالب والمعلومات الأكاديمية</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">المعرف الموحد</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">حالة القيد</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الإجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($students as $student): ?>
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="w-14 h-14 rounded-[1.5rem] flex items-center justify-center font-black text-xl transition-transform group-hover:scale-110 <?php echo $student['color'] === 'emerald' ? 'bg-emerald-100 text-emerald-700' : ($student['color'] === 'amber' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700'); ?>">
                                <?php echo $student['avatar']; ?>
                            </div>
                            <div>
                                <p class="text-lg font-black text-gray-900 mb-0.5"><?php echo $student['name']; ?></p>
                                <p class="text-xs font-bold text-gray-400"><?php echo $student['details']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center font-mono text-xs font-black text-gray-400 tracking-wider"><?php echo $student['id']; ?></td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase <?php echo $student['status'] === 'نشط' ? 'bg-emerald-100 text-emerald-700' : ($student['status'] === 'قيد المراجعة' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700'); ?>">
                            • <?php echo $student['status']; ?>
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <button class="p-3 bg-gray-50 rounded-2xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-700 transition-all shadow-sm">
                            <span class="material-icons-outlined">more_vert</span>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination matching React design -->
        <div class="p-8 bg-gray-50/30 border-t border-gray-50 flex flex-col md:flex-row justify-between items-center gap-4">
          <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">عرض 10 طلاب من إجمالي 1,284</p>
          <div class="flex items-center gap-2">
            <button class="p-2.5 bg-white rounded-xl shadow-sm text-gray-400 hover:text-emerald-700 transition-all border border-gray-100"><span class="material-icons-outlined">chevron_right</span></button>
            <button class="w-10 h-10 rounded-xl text-xs font-black bg-emerald-700 text-white shadow-lg shadow-emerald-100">1</button>
            <button class="w-10 h-10 rounded-xl text-xs font-black text-gray-400 bg-white border border-gray-100 hover:bg-gray-50">2</button>
            <button class="w-10 h-10 rounded-xl text-xs font-black text-gray-400 bg-white border border-gray-100 hover:bg-gray-50">3</button>
            <span class="px-2 text-gray-300">...</span>
            <button class="w-10 h-10 rounded-xl text-xs font-black text-gray-400 bg-white border border-gray-100 hover:bg-gray-50">129</button>
            <button class="p-2.5 bg-white rounded-xl shadow-sm text-gray-400 hover:text-emerald-700 transition-all border border-gray-100"><span class="material-icons-outlined">chevron_left</span></button>
          </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[placeholder="بحث عن طالب، معرف..."]');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        tableRows.forEach(row => {
            const name = row.querySelector('p.text-lg').textContent.toLowerCase();
            const id = row.querySelector('td.font-mono').textContent.toLowerCase();
            if (name.includes(query) || id.includes(query)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    const addStudentBtn = document.querySelector('button.bg-emerald-700.text-white.rounded-2xl.font-black');
    if (addStudentBtn) {
        addStudentBtn.addEventListener('click', function() {
            const name = prompt('أدخل اسم الطالب الجديد:');
            const email = prompt('أدخل البريد الإلكتروني للطالب:');
            if (name && email) {
                const formData = new FormData();
                formData.append('action', 'add_student');
                formData.append('name', name);
                formData.append('email', email);

                fetch('api.php', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('تم إضافة الطالب بنجاح!');
                        location.reload();
                    } else {
                        alert('خطأ: ' + data.message);
                    }
                });
            }
        });
    }
});
</script>