<?php
// Converted from SettingsAdmin.jsx
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إعدادات النظام</h1>
            <p class="text-gray-500 font-medium">التحكم المركزي في تكوينات الخادم، الصلاحيات، والتكاملات التقنية</p>
        </div>
        <button class="flex items-center gap-2 px-8 py-3 bg-emerald-700 text-white rounded-2xl font-black shadow-lg shadow-emerald-100 hover:bg-emerald-800 transition-all">
            <span class="material-icons-outlined">cloud_done</span>
            حفظ كافة التغييرات
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 relative overflow-hidden">
                <h3 class="text-xl font-black text-gray-900 mb-8 flex items-center gap-3">
                    <span class="material-icons-outlined text-emerald-600">settings</span>
                    الإعدادات العامة للمنصة
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 text-right">
                    <div class="space-y-2">
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest mr-2">اسم المؤسسة التعليمية</label>
                        <input type="text" value="أكاديمية مشكاة للعلوم الشرعية" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-50 transition-all font-bold text-gray-700" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-black text-gray-400 uppercase tracking-widest mr-2">النطاق الرئيسي (Domain)</label>
                        <input type="text" value="mishkah.edu.sa" dir="ltr" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none focus:ring-4 focus:ring-emerald-50 transition-all font-bold text-gray-700" />
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-emerald-900 p-8 rounded-[3rem] text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <h3 class="text-xl font-black mb-6 flex items-center gap-3">
                        <span class="material-icons-outlined text-emerald-400">dns</span>
                        حالة الخادم والبنية التحتية
                    </h3>
                    <div class="space-y-8">
                        <div class="space-y-3">
                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest text-emerald-300">
                                <div class="flex items-center gap-2"><span class="material-icons-outlined text-sm">memory</span><span>استهلاك المعالج (CPU)</span></div>
                                <span>24%</span>
                            </div>
                            <div class="h-1.5 w-full bg-emerald-800 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-400 rounded-full transition-all duration-1000" style="width: 24%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>