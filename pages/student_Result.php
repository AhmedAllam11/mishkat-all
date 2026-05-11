<?php
// Converted from ResultPage.jsx
$score = 3;
$total = 3;
?>
<main class="flex-1 flex flex-col items-center justify-center p-10 bg-gray-50/50" dir="rtl">
    <div class="w-full max-w-xl bg-white p-16 rounded-[3.5rem] shadow-2xl border border-gray-100 text-center relative overflow-hidden">
        <div class="relative z-10">
            <div class="w-24 h-24 bg-emerald-100 text-emerald-700 rounded-full flex items-center justify-center text-5xl mb-8 mx-auto shadow-lg shadow-emerald-50 transition-transform scale-110">
                <span class="material-icons-outlined text-5xl">emoji_events</span>
            </div>
            <h1 class="text-4xl font-black text-gray-900 mb-4 tracking-tight">نتيجة الاختبار</h1>
            <p class="text-xl text-gray-500 font-medium mb-10">تهانينا! لقد أتممت الاختبار بنجاح باهر.</p>
            
            <div class="bg-gray-50 rounded-3xl p-10 mb-10 border border-gray-100">
                <div class="text-xs font-black text-gray-400 uppercase tracking-widest mb-2">درجتك النهائية</div>
                <div class="text-7xl font-black text-emerald-700">
                    <?php echo $score; ?> <span class="text-3xl text-gray-300">/ <?php echo $total; ?></span>
                </div>
            </div>

            <a href="dashboard.php?page=calendar" class="inline-flex items-center gap-3 px-10 py-5 bg-emerald-800 text-white rounded-[2rem] text-lg font-black shadow-xl shadow-emerald-100 hover:bg-emerald-900 hover:scale-105 transition-all">
                العودة للتقويم الدراسي
                <span class="material-icons-outlined">arrow_left</span>
            </a>
        </div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
    </div>
</main>
