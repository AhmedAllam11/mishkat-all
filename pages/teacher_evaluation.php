<?php
// Converted from evaluation.jsx
$studentName = 'أحمد محمد علي';
$task = 'حفظ سورة الكهف (1-20)';
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">تقييم مستوى الطالب</h1>
            <p class="text-gray-500 font-medium">سجل أداء الطالب بدقة لتحفيزه ومتابعة تقدمه</p>
        </div>
        <button class="flex items-center gap-2 px-6 py-2.5 bg-white border border-gray-100 rounded-2xl text-emerald-700 font-black hover:bg-emerald-50 transition-all shadow-sm">
            <span class="material-icons-outlined">history</span>
            سجل التقييمات السابقة
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 text-center relative overflow-hidden group">
                <div class="w-24 h-24 bg-emerald-100 rounded-[2rem] mx-auto flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-icons-outlined text-emerald-700 text-5xl">person</span>
                </div>
                <h2 class="text-xl font-black text-gray-800 mb-2"><?php echo $studentName; ?></h2>
                <p class="text-sm text-gray-400 font-bold mb-8">طالب متميز • المستوى الثاني</p>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center group-hover:bg-emerald-50 transition-colors">
                        <span class="font-black text-emerald-700">24 حلقة</span>
                        <span class="text-xs font-bold text-gray-500">الحضور الكلي</span>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl flex justify-between items-center group-hover:bg-emerald-50 transition-colors">
                        <span class="font-black text-emerald-700">صفحتين/يوم</span>
                        <span class="text-xs font-bold text-gray-500">معدل الحفظ</span>
                    </div>
                </div>
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-emerald-50 rounded-full blur-3xl opacity-50"></div>
            </div>

            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden">
                <h3 class="text-lg font-black mb-4 relative z-10">إنجاز الطالب</h3>
                <div class="text-4xl font-black mb-2 relative z-10">88%</div>
                <p class="text-xs text-emerald-300 font-bold relative z-10 leading-relaxed">أكمل أحمد 4 أجزاء من القرآن الكريم هذا الفصل الدراسي بنجاح</p>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800 rounded-full blur-3xl opacity-50"></div>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-6">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="flex items-center gap-3 mb-10">
                    <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-700">
                        <span class="material-icons-outlined text-2xl">assignment</span>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800">تفاصيل الحصة والتقييم</h2>
                </div>

                <form class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-3 text-right">
                            <label class="text-sm font-black text-gray-700 mr-2">اسم الطالب</label>
                            <input readOnly class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl text-gray-400 font-bold outline-none" value="<?php echo $studentName; ?>" />
                        </div>
                        <div class="space-y-3 text-right">
                            <label class="text-sm font-black text-gray-700 mr-2">المادة/الورد الدراسي</label>
                            <input class="w-full px-6 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-emerald-500/20 font-bold outline-none transition-all" placeholder="مثال: حفظ سورة الملك" value="<?php echo $task; ?>" />
                        </div>
                    </div>

                    <div class="space-y-6 text-right">
                        <label class="text-sm font-black text-gray-700 mr-2">مستوى الأداء اليومي</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <button type="button" class="rating-btn flex flex-col items-center gap-3 p-6 rounded-[2rem] border-2 transition-all shadow-lg bg-gray-50 text-gray-400 border-transparent hover:border-red-100" onclick="setRating('poor', this)">
                                <span class="material-icons-outlined text-4xl">sentiment_dissatisfied</span>
                                <span class="font-black text-sm">يحتاج تحسين</span>
                            </button>
                            <button type="button" class="rating-btn flex flex-col items-center gap-3 p-6 rounded-[2rem] border-2 transition-all shadow-lg bg-gray-50 text-gray-400 border-transparent hover:border-blue-100" onclick="setRating('good', this)">
                                <span class="material-icons-outlined text-4xl">sentiment_satisfied</span>
                                <span class="font-black text-sm">جيد جداً</span>
                            </button>
                            <button type="button" class="rating-btn flex flex-col items-center gap-3 p-6 rounded-[2rem] border-2 transition-all shadow-lg bg-emerald-600 text-white shadow-emerald-100 border-transparent" onclick="setRating('excellent', this)">
                                <span class="material-icons-outlined text-4xl">sentiment_very_satisfied</span>
                                <span class="font-black text-sm">ممتاز</span>
                            </button>
                        </div>
                    </div>

                    <div class="space-y-3 text-right">
                        <label class="text-sm font-black text-gray-700 mr-2">ملاحظات المعلم وتوجيهاته</label>
                        <textarea class="w-full h-40 px-6 py-4 bg-gray-50 border-none rounded-3xl focus:ring-2 focus:ring-emerald-500/20 font-bold outline-none transition-all resize-none" placeholder="سجل ملاحظاتك على الأداء، نقاط القوة، والمواضع التي تحتاج مراجعة..."></textarea>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 pt-4">
                        <button type="submit" class="flex-1 py-4 bg-emerald-700 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-800 transition-all flex items-center justify-center gap-3">
                            <span class="material-icons-outlined" style="transform: rotate(180deg);">send</span>
                            حفظ وإرسال التقييم
                        </button>
                        <button type="button" class="px-10 py-4 bg-gray-50 text-gray-500 rounded-2xl font-black hover:bg-gray-100 transition-all">إلغاء</button>
                    </div>
                </form>
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50/50 rounded-full -translate-x-16 -translate-y-16 blur-3xl"></div>
            </div>
        </div>
    </div>

    <script>
        function setRating(rating, el) {
            document.querySelectorAll('.rating-btn').forEach(btn => {
                btn.classList.remove('bg-red-600', 'bg-blue-600', 'bg-emerald-600', 'text-white', 'shadow-red-100', 'shadow-blue-100', 'shadow-emerald-100');
                btn.classList.add('bg-gray-50', 'text-gray-400');
            });
            
            el.classList.remove('bg-gray-50', 'text-gray-400');
            if (rating === 'poor') el.classList.add('bg-red-600', 'text-white', 'shadow-red-100');
            if (rating === 'good') el.classList.add('bg-blue-600', 'text-white', 'shadow-blue-100');
            if (rating === 'excellent') el.classList.add('bg-emerald-600', 'text-white', 'shadow-emerald-100');
        }
    </script>
</main>