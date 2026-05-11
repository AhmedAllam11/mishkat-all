<?php
// Converted from CoursesPage.jsx
$plans = [
    ['id' => 1, 'title' => 'تفسير', 'desc' => 'فهم الآيات', 'price' => 180, 'type' => 'شهري'],
    ['id' => 2, 'title' => 'تجويد', 'desc' => 'إتقان التلاوة', 'price' => 200, 'type' => 'شهري'],
    ['id' => 3, 'title' => 'تحفيظ', 'desc' => 'حفظ القرآن', 'price' => 250, 'type' => 'شهري'],
];
?>
<main class="flex flex-col px-6 py-4" dir="rtl">
    <div class="bg-white rounded-xl px-6 py-4 mb-6 flex justify-between items-center shadow-sm">
        <div class="w-[120px]"></div>
        <div class="w-full max-w-[420px] bg-gray-100 rounded-full px-4 py-2 flex items-center gap-2">
            <span class="material-icons-outlined text-gray-400">search</span>
            <input class="bg-transparent w-full outline-none text-right text-sm" placeholder="بحث في المسارات..." />
        </div>
        <h2 class="text-emerald-700 font-bold text-lg">مشكاة</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="space-y-4">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-right">
                <h3 class="font-bold mb-4 text-gray-800">ملخص الاشتراك</h3>
                <div id="planSummary" class="hidden space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                        <span id="summaryTitle" class="font-bold text-emerald-700"></span>
                        <span class="text-gray-400">الباقة</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-50">
                        <span id="summaryType" class="font-bold"></span>
                        <span class="text-gray-400">النوع</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-black text-emerald-700 text-lg"><span id="summaryPrice"></span> ج.م</span>
                        <span class="text-gray-400">السعر</span>
                    </div>
                </div>
                <p id="noPlanMsg" class="text-gray-400 text-sm py-4">اختر باقة لعرض التفاصيل</p>
                <button class="w-full mt-6 bg-emerald-700 text-white py-3 rounded-xl font-bold shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">إتمام الدفع</button>
            </div>

            <div class="bg-emerald-50 border border-emerald-100 p-6 rounded-xl text-right">
                <div class="flex justify-end gap-2 items-center mb-2">
                    <h3 class="font-bold text-emerald-700">الدعم الفني</h3>
                    <span class="material-icons-outlined text-emerald-700">support_agent</span>
                </div>
                <p class="text-xs text-emerald-600 mb-4">تواصل معنا لحل أي مشكلة تواجهك</p>
                <button class="w-full bg-emerald-600 text-white py-2.5 rounded-xl flex items-center justify-center gap-2 text-sm font-bold shadow-md">
                    <i class="fab fa-whatsapp"></i> واتساب الدعم
                </button>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <?php foreach ($plans as $plan): ?>
                <div class="plan-card cursor-pointer bg-white p-6 rounded-2xl border-2 border-transparent hover:border-emerald-500 shadow-sm transition-all group" 
                     onclick="selectPlan(<?php echo htmlspecialchars(json_encode($plan)); ?>, this)">
                    <h4 class="font-black text-gray-800 text-right group-hover:text-emerald-700 mb-2"><?php echo $plan['title']; ?></h4>
                    <p class="text-xs text-gray-400 font-medium mb-4 text-right"><?php echo $plan['desc']; ?></p>
                    <div class="flex justify-between items-center mt-4 border-t border-gray-50 pt-3">
                        <span class="text-xs font-bold text-gray-400"><?php echo $plan['type']; ?></span>
                        <span class="font-black text-emerald-700"><?php echo $plan['price']; ?> ج.م</span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 text-right">
                <h3 class="font-black text-gray-800 mb-6 flex items-center justify-end gap-2">طريقة الدفع <span class="material-icons-outlined text-emerald-600">payments</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label class="flex items-center justify-between border-2 border-gray-50 p-4 rounded-2xl cursor-pointer hover:border-emerald-100 hover:bg-emerald-50/30 transition-all">
                        <input type="radio" name="pay" value="vodafone" class="accent-emerald-600" />
                        <span class="font-bold text-gray-700">فودافون كاش</span>
                        <span class="material-icons-outlined text-emerald-600">smartphone</span>
                    </label>
                    <label class="flex items-center justify-between border-2 border-emerald-600 bg-emerald-50/30 p-4 rounded-2xl cursor-pointer">
                        <input type="radio" name="pay" value="card" checked class="accent-emerald-600" />
                        <span class="font-bold text-gray-700">بطاقة بنكية</span>
                        <span class="material-icons-outlined text-emerald-600">credit_card</span>
                    </label>
                    <label class="flex items-center justify-between border-2 border-gray-50 p-4 rounded-2xl cursor-pointer hover:border-emerald-100 hover:bg-emerald-50/30 transition-all">
                        <input type="radio" name="pay" value="instapay" class="accent-emerald-600" />
                        <span class="font-bold text-gray-700">إنستاباي</span>
                        <span class="material-icons-outlined text-emerald-600">account_balance</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectPlan(plan, el) {
            document.querySelectorAll('.plan-card').forEach(c => c.classList.remove('border-emerald-600', 'bg-emerald-50/30'));
            el.classList.add('border-emerald-600', 'bg-emerald-50/30');
            
            document.getElementById('planSummary').classList.remove('hidden');
            document.getElementById('noPlanMsg').classList.add('hidden');
            
            document.getElementById('summaryTitle').innerText = plan.title;
            document.getElementById('summaryType').innerText = plan.type;
            document.getElementById('summaryPrice').innerText = plan.price;
        }
    </script>
</main>