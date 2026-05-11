<?php
// Converted from Library.jsx
$categories = [
    ['label' => "الكل", 'count' => 12],
    ['label' => "مسار التفسير", 'count' => 4],
    ['label' => "المسار التجويد", 'count' => 5],
    ['label' => "مسار القراءات", 'count' => 3],
];
$resources = [
    [
        'title' => "التفسير الميسر - سورة البقرة",
        'desc' => "طرق فعالة لشرح التفسير للطلاب بطريقة ميسرة وممتعة",
        'type' => "video",
        'category' => "مسار التفسير",
        'url' => "https://www.youtube.com/embed/z0aOrazTmbg?si=m-YLfbwr1KbD2x4W&amp;start=89",
        'views' => "450",
        'time' => "10:20",
    ],
    [
        'title' => "أحكام التجويد للمبتدئين",
        'desc' => "شرح المخارج والصفات بأسلوب بسيط للمراحل الأولى",
        'type' => "video",
        'category' => "المسار التجويد",
        'url' => "https://www.youtube.com/embed/kZetNz-gA0U?si=X0ALnrMR1J9My4wB",
        'views' => "1.2k",
        'time' => "15:45",
    ],
    [
        'title' => "القراءات العشر الصغرى",
        'desc' => "تعليم جمع القراءات العشر الصغرى من الصفر للمبتدئين",
        'type' => "video",
        'category' => "مسار القراءات",
        'url' => "https://www.youtube.com/embed/ZzY4NOB62NA?si=7Za4S7LPw4Qns0qv&amp;start=58",
        'views' => "900",
        'time' => "12:10",
    ],
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">مصادر مساعدة للتعلم</h1>
            <p class="text-gray-500 font-medium">مكتبة شاملة لكل المواد التعليمية والمراجع العلمية للمعلمين</p>
        </div>
        <div class="w-full md:w-96 relative">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="البحث عن دروس أو مراجع..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                    <span class="material-icons-outlined text-emerald-600">filter_list</span>
                    مراجع حسب المسار
                </h3>
                <div class="space-y-2">
                    <?php foreach ($categories as $cat): ?>
                    <button class="w-full flex items-center justify-between p-4 rounded-2xl transition-all group <?php echo $cat['label'] === 'الكل' ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-100' : 'text-gray-500 hover:bg-gray-50'; ?>">
                        <span class="font-bold text-sm"><?php echo $cat['label']; ?></span>
                        <span class="px-2.5 py-0.5 rounded-lg text-[10px] font-black <?php echo $cat['label'] === 'الكل' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-400 group-hover:bg-emerald-50 group-hover:text-emerald-700'; ?>">
                            <?php echo $cat['count']; ?>
                        </span>
                    </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bg-emerald-900 rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <span class="material-icons-outlined text-emerald-400 text-4xl mb-6 group-hover:rotate-12 transition-transform">video_library</span>
                    <h4 class="text-xl font-black mb-2">إضافة مورد جديد</h4>
                    <p class="text-sm text-emerald-200 font-medium mb-8 leading-relaxed">هل لديك مادة تعليمية مفيدة؟ شاركها مع بقية المعلمين لتعم الفائدة</p>
                    <button class="w-full py-4 bg-emerald-700 hover:bg-emerald-600 rounded-2xl font-black text-sm transition-all shadow-xl">رفع ملف أو فيديو</button>
                </div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-50"></div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-8">
            <div class="flex items-center justify-between px-4">
                <h2 class="text-2xl font-black text-gray-800 flex items-center gap-3">
                    <span class="w-2 h-8 bg-emerald-600 rounded-full"></span>
                    المواد التعليمية المتاحة
                </h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <?php foreach ($resources as $item): ?>
                <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 hover:shadow-2xl transition-all">
                    <div class="relative h-56 w-full bg-gray-900">
                        <iframe class="w-full h-full opacity-90 group-hover:opacity-100 transition-opacity" src="<?php echo $item['url']; ?>" title="<?php echo $item['title']; ?>" allowFullScreen></iframe>
                        <div class="absolute top-4 right-4 px-3 py-1 bg-black/40 backdrop-blur-md rounded-lg text-[10px] font-black text-white uppercase tracking-widest"><?php echo $item['category']; ?></div>
                    </div>
                    <div class="p-8 text-right space-y-4">
                        <h3 class="text-xl font-black text-gray-900 group-hover:text-emerald-700 transition-colors leading-tight"><?php echo $item['title']; ?></h3>
                        <p class="text-sm text-gray-400 font-bold leading-relaxed"><?php echo $item['desc']; ?></p>
                        <div class="flex items-center justify-between pt-4 border-t border-gray-50">
                            <div class="flex items-center gap-4">
                                <span class="flex items-center gap-1.5 text-xs font-black text-gray-400"><span class="material-icons-outlined text-sm">visibility</span><?php echo $item['views']; ?></span>
                                <span class="flex items-center gap-1.5 text-xs font-black text-gray-400"><span class="material-icons-outlined text-sm">play_circle_filled</span><?php echo $item['time']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>