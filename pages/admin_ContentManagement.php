<?php
// Converted from ContentManagement.jsx
require_once __DIR__ . '/../includes/db.php';

$courses = [];
$res = $conn->query("SELECT * FROM courses ORDER BY created_at DESC");
while ($row = $res->fetch_assoc()) {
    $courses[] = $row;
}
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4 text-right">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة المحتوى التعليمي</h1>
            <p class="text-gray-500 font-medium">تنظيم وتحديث المسارات التعليمية، المناهج، والتسعير العالمي</p>
        </div>
        <div class="flex gap-4">
            <div class="relative w-64 md:w-80">
                <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
                <input type="text" placeholder="بحث في المسارات..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
            </div>
            <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                <span class="material-icons-outlined">add</span>
                إضافة مسار
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
        <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 text-center relative group hover:shadow-xl transition-all">
            <span class="absolute top-6 right-6 px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest">نشط الآن</span>
            <h2 class="text-5xl font-black text-emerald-800 mb-2 group-hover:scale-110 transition-transform">12</h2>
            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">إجمالي المسارات التعليمية</p>
        </div>
    </div>

    <div class="space-y-6">
        <?php foreach ($courses as $course): ?>
        <div class="group bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center hover:shadow-2xl transition-all relative overflow-hidden text-right">
            <div class="flex flex-col md:flex-row items-center gap-8 flex-1 w-full text-right">
                <div class="w-24 h-24 rounded-[2rem] flex items-center justify-center text-4xl shadow-sm transition-transform group-hover:scale-110 <?php echo $course['color'] === 'emerald' ? 'bg-emerald-50 text-emerald-700' : ($course['color'] === 'blue' ? 'bg-blue-50 text-blue-700' : 'bg-amber-50 text-amber-700'); ?>">
                    <span class="material-icons-outlined text-4xl">book</span>
                </div>
                <div class="text-center md:text-right flex-1">
                    <div class="flex flex-col md:flex-row items-center gap-3 mb-2 justify-center md:justify-start">
                        <h3 class="text-2xl font-black text-gray-900 group-hover:text-emerald-700 transition-colors"><?php echo $course['title']; ?></h3>
                        <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?php echo $course['color'] === 'emerald' ? 'bg-emerald-100 text-emerald-700' : ($course['color'] === 'blue' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700'); ?>"><?php echo $course['type']; ?></span>
                    </div>
                    <p class="text-sm font-medium text-gray-400 max-w-xl mb-6"><?php echo $course['desc']; ?></p>
                </div>
            </div>
            <div class="flex flex-col items-center md:items-end gap-6 w-full md:w-64 md:border-r border-gray-100 md:pr-10 mt-8 md:mt-0">
                <div class="text-center md:text-right">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">رسوم التسجيل</p>
                    <h4 class="text-3xl font-black text-emerald-700"><?php echo $course['price']; ?></h4>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('input[placeholder="بحث في المسارات..."]');
    const courseCards = document.querySelectorAll('.space-y-6 > div');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        courseCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const desc = card.querySelector('p').textContent.toLowerCase();
            if (title.includes(query) || desc.includes(query)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });

    const addCourseBtn = document.querySelector('button.bg-emerald-700.text-white.rounded-2xl.font-black');
    if (addCourseBtn) {
        addCourseBtn.addEventListener('click', function() {
            const title = prompt('اسم المسار الجديد:');
            const price = prompt('السعر (ج.م):');
            if (title && price) {
                // Here we would call the API to add a course
                alert('تم إرسال طلب إضافة المسار: ' + title);
            }
        });
    }
});
</script>