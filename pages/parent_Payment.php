<?php
// Converted from Payment.jsx
$students = [
    ['id' => 1, 'name' => "أحمد محمد علي", 'level' => "التمهيدي", 'avatar' => "A", 'selectedPath' => "مسار التجويد", 'price' => 250],
    ['id' => 2, 'name' => "سارة محمد علي", 'level' => "المتوسط", 'avatar' => "S", 'selectedPath' => "مسار الحفظ", 'price' => 250],
];
$paths = [
    ['name' => "مسار الحفظ", 'icon' => "📖", 'price' => 250],
    ['name' => "مسار التجويد", 'icon' => "🎧", 'price' => 250],
    ['name' => "مسار التفسير", 'icon' => "📜", 'price' => 250],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">الاشتراك والدفع</h1>
            <p class="text-gray-500 font-medium">إدارة مسارات أبنائك وإتمام عملية الدفع بأمان وسهولة</p>
        </div>
        <div class="bg-white px-8 py-4 rounded-[2rem] shadow-sm border border-gray-100 flex items-center gap-4 group">
            <div class="w-12 h-12 bg-emerald-50 text-emerald-700 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                <span class="material-icons-outlined">account_balance_wallet</span>
            </div>
            <div class="text-right">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">الرصيد الحالي</p>
                <p class="text-xl font-black text-gray-900">0 ج.م</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-1 space-y-6 lg:order-last">
            <div class="bg-white p-8 rounded-[3rem] shadow-xl border border-gray-100 relative overflow-hidden">
                <h3 class="text-xl font-black text-gray-800 mb-8 flex items-center gap-2">
                    <span class="material-icons-outlined text-emerald-600">receipt</span>
                    ملخص الاشتراك
                </h3>
                <div class="space-y-6 mb-8">
                    <?php foreach ($students as $s): ?>
                    <div class="flex justify-between items-center group text-right">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gray-50 rounded-xl flex items-center justify-center font-black text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-700 transition-colors"><?php echo $s['avatar']; ?></div>
                            <div>
                                <p class="text-sm font-black text-gray-800"><?php echo $s['name']; ?></p>
                                <p class="text-[10px] font-bold text-gray-400"><?php echo $s['selectedPath']; ?></p>
                            </div>
                        </div>
                        <span class="font-black text-gray-900"><?php echo $s['price']; ?> ج.م</span>
                    </div>
                    <?php endforeach; ?>
                    <div class="flex justify-between items-center text-gray-400 font-bold text-sm">
                        <span>رسوم إدارية</span>
                        <span>15 ج.م</span>
                    </div>
                </div>
                <div class="pt-6 border-t border-gray-100 mb-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-lg font-black text-gray-900">الإجمالي</span>
                        <span class="text-2xl font-black text-emerald-700">515 ج.م</span>
                    </div>
                </div>
                <button class="w-full py-4 bg-emerald-700 text-white rounded-2xl font-black text-sm shadow-xl shadow-emerald-100 hover:bg-emerald-800 transition-all flex items-center justify-center gap-2">
                    <span class="material-icons-outlined">payment</span>
                    تأكيد الدفع والاشتراك
                </button>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-right">
                <?php foreach ($students as $student): ?>
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 group">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-16 h-16 bg-gray-50 rounded-[1.5rem] flex items-center justify-center text-2xl font-black text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-700 transition-all"><?php echo $student['avatar']; ?></div>
                        <div>
                            <h4 class="text-xl font-black text-gray-900"><?php echo $student['name']; ?></h4>
                            <p class="text-sm text-gray-400 font-bold">المستوى: <?php echo $student['level']; ?></p>
                        </div>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4 mr-2">اختر المسار التعليمي</p>
                    <div class="space-y-3">
                        <?php foreach ($paths as $p): ?>
                        <button class="w-full flex items-center justify-between p-4 rounded-2xl border-2 transition-all <?php echo $student['selectedPath'] === $p['name'] ? 'border-emerald-600 bg-emerald-50/50' : 'border-transparent bg-gray-50 hover:bg-white hover:border-gray-200'; ?>">
                            <div class="flex items-center gap-3">
                                <span class="text-xl"><?php echo $p['icon']; ?></span>
                                <span class="text-sm font-black <?php echo $student['selectedPath'] === $p['name'] ? 'text-emerald-700' : 'text-gray-600'; ?>"><?php echo $p['name']; ?></span>
                            </div>
                            <?php if ($student['selectedPath'] === $p['name']): ?>
                                <span class="material-icons-outlined text-emerald-600">check_circle</span>
                            <?php endif; ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>