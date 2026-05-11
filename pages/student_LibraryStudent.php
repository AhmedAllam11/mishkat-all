<?php
// Converted from LibraryStudent.jsx
$books = [
    ['id' => 1, 'title' => 'الوجيز في التفسير', 'type' => 'tafsir', 'author' => 'د. وهبة الزحيلي', 'rating' => 4.8],
    ['id' => 2, 'title' => 'مخارج الحروف', 'type' => 'tajweed', 'author' => 'الشيخ أيمن سويد', 'rating' => 4.9],
    ['id' => 3, 'title' => 'تسجيلات التحفيظ', 'type' => 'audio', 'author' => 'مشروع مشكاة', 'rating' => 4.5],
    ['id' => 4, 'title' => 'أسباب النزول', 'type' => 'pdf', 'author' => 'الواحدي النيسابوري', 'rating' => 4.7, 'link' => '#'],
    ['id' => 5, 'title' => 'شرح المقدمة الجزرية', 'type' => 'pdf', 'author' => 'غانم قدوري', 'rating' => 5.0, 'link' => '#'],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">المكتبة القرآنية</h1>
            <p class="text-gray-500 font-medium">مرجعك الشامل لعلوم القرآن والتفسير والتجويد</p>
        </div>
        <div class="w-full md:w-96 relative">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="ابحث عن كتاب، تسجيل، أو مادة تعليمية..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <span class="material-icons-outlined text-emerald-700 text-2xl">menu_book</span>
                    <h3 class="font-black text-gray-800">أوراد اليوم</h3>
                </div>
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-gray-900 mb-1">سورة الملك</h4>
                    <p class="text-xs text-gray-400 font-bold">من الآية 1 إلى 10</p>
                </div>
                <div class="space-y-4">
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <span class="text-xs font-black inline-block py-1 px-2 uppercase rounded-full text-emerald-600 bg-emerald-50">مستوى الإنجاز</span>
                            <span class="text-xs font-black inline-block text-emerald-600">60%</span>
                        </div>
                        <div class="overflow-hidden h-2.5 mb-4 text-xs flex rounded-full bg-emerald-50">
                            <div style="width: 60%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-emerald-600 transition-all duration-1000"></div>
                        </div>
                    </div>
                    <button class="w-full py-3.5 bg-emerald-700 text-white rounded-2xl font-black text-sm shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">استكمال القراءة</button>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100">
                <h3 class="font-black text-gray-800 mb-6 pr-2">الأقسام</h3>
                <div class="space-y-2">
                    <?php 
                    $cats = [
                        ['id' => 'all', 'label' => 'الكل', 'icon' => 'menu_book'],
                        ['id' => 'tafsir', 'label' => 'التفسير', 'icon' => 'menu_book'],
                        ['id' => 'tajweed', 'label' => 'التجويد', 'icon' => 'play_circle_filled'],
                        ['id' => 'audio', 'label' => 'الصوتيات', 'icon' => 'headset'],
                        ['id' => 'pdf', 'label' => 'الكتب الرقمية', 'icon' => 'picture_as_pdf']
                    ];
                    foreach ($cats as $cat): ?>
                    <button class="w-full flex items-center justify-between p-3.5 rounded-2xl transition-all group <?php echo $cat['id'] == 'all' ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-100' : 'text-gray-500 hover:bg-gray-50'; ?>">
                        <span class="material-icons-outlined text-lg group-hover:scale-110 transition-transform"><?php echo $cat['icon']; ?></span>
                        <span class="font-bold text-sm"><?php echo $cat['label']; ?></span>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-8">
            <div class="bg-emerald-900 rounded-[3rem] p-8 md:p-12 text-white flex flex-col md:flex-row items-center gap-8 relative overflow-hidden shadow-2xl">
                <div class="flex-1 text-center md:text-right relative z-10">
                    <span class="px-4 py-1.5 bg-emerald-700/50 rounded-full text-xs font-black mb-4 inline-block">مسار جديد</span>
                    <h2 class="text-3xl md:text-4xl font-black mb-4 leading-tight">تيسير التجويد: أحكام النون الساكنة</h2>
                    <button class="px-8 py-3.5 bg-white text-emerald-900 rounded-2xl font-black shadow-xl hover:scale-105 transition-all">ابدأ الدراسة الآن</button>
                </div>
                <div class="w-48 h-48 md:w-64 md:h-64 relative z-10">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="study" class="w-full h-full object-contain" />
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-800/30 rounded-full blur-[100px]"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($books as $book): ?>
                <div class="group bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all flex items-center gap-6">
                    <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center text-3xl group-hover:bg-emerald-50 transition-colors">
                        <?php 
                        $icon = 'menu_book';
                        if ($book['type'] == 'tajweed') $icon = 'play_circle_filled';
                        if ($book['type'] == 'audio') $icon = 'headset';
                        if ($book['type'] == 'pdf') $icon = 'picture_as_pdf';
                        ?>
                        <span class="material-icons-outlined <?php echo 'text-' . ($book['type'] == 'tafsir' ? 'emerald' : ($book['type'] == 'tajweed' ? 'amber' : ($book['type'] == 'audio' ? 'blue' : 'red'))) . '-600'; ?>"><?php echo $icon; ?></span>
                    </div>
                    <div class="flex-1 text-right">
                        <div class="flex items-center gap-1 justify-end text-amber-400 mb-1">
                            <span class="text-xs font-black text-gray-400 ml-1"><?php echo $book['rating']; ?></span>
                            <span class="material-icons-outlined" style="font-size: 14px;">star</span>
                        </div>
                        <h4 class="font-black text-gray-800 group-hover:text-emerald-700 transition-colors mb-1"><?php echo $book['title']; ?></h4>
                        <p class="text-xs text-gray-400 font-bold mb-4"><?php echo $book['author']; ?></p>
                        <div class="flex items-center gap-3 justify-end">
                            <button class="p-2.5 bg-gray-50 rounded-xl text-gray-400 hover:bg-emerald-50 hover:text-emerald-700 transition-all">
                                <span class="material-icons-outlined">download</span>
                            </button>
                            <button class="px-6 py-2 bg-emerald-700 text-white text-xs font-black rounded-xl hover:bg-emerald-800 transition-all">فتح المورد</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>