<?php
// Converted from ExamPage.jsx
$questions = [
    [
        'id' => 1,
        'question' => "ما حكم التجويد؟",
        'answers' => ["واجب", "سنة", "مكروه", "مباح"],
        'correct' => 0,
    ],
    [
        'id' => 2,
        'question' => "عدد مخارج الحروف؟",
        'answers' => ["15", "16", "17", "18"],
        'correct' => 1,
    ],
    [
        'id' => 3,
        'question' => "أول سورة في القرآن؟",
        'answers' => ["البقرة", "الفاتحة", "الإخلاص", "الناس"],
        'correct' => 1,
    ],
];
?>
<main class="flex-1 flex flex-col items-center justify-center p-10 bg-gray-50/50" dir="rtl">
    <div class="w-full max-w-2xl bg-white p-12 rounded-[3rem] shadow-xl border border-gray-100 text-right">
        <h2 class="text-2xl font-black text-gray-900 mb-8">اختبار تجويد (المستوى 1)</h2>
        <div id="quizContainer">
            <h3 class="text-xl font-bold mb-6 text-gray-800">السؤال 1 من <?php echo count($questions); ?></h3>
            <p class="text-lg text-gray-600 mb-10"><?php echo $questions[0]['question']; ?></p>
            <div class="space-y-4">
                <?php foreach ($questions[0]['answers'] as $index => $answer): ?>
                <div class="p-6 border-2 border-gray-100 rounded-2xl cursor-pointer hover:bg-emerald-50 hover:border-emerald-200 transition-all font-bold text-gray-700 flex items-center justify-between group">
                    <span><?php echo $answer; ?></span>
                    <span class="w-6 h-6 border-2 border-gray-200 rounded-full group-hover:border-emerald-500"></span>
                </div>
                <?php endforeach; ?>
            </div>
            <button class="mt-12 w-full py-5 bg-emerald-700 text-white rounded-2xl font-black text-lg shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">التالي</button>
        </div>
    </div>
</main>
