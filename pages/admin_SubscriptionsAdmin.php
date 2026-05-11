<?php
// Converted from SubscriptionsAdmin.jsx
$transactions = [
    ['id' => 1, 'name' => 'عبدالرحمن محمد خالد', 'invoice' => '#MSK-8921', 'course' => 'حلقة الإتقان (تجويد)', 'date' => '14 أكتوبر 2023', 'amount' => '350 ر.س', 'status' => 'مكتمل', 'statusType' => 'success'],
    ['id' => 2, 'name' => 'فهد بن سلمان العتيبي', 'invoice' => '#MSK-8854', 'course' => 'مسار اللغة العربية', 'date' => '12 أكتوبر 2023', 'amount' => '420 ر.س', 'status' => 'متأخر', 'statusType' => 'late'],
    ['id' => 3, 'name' => 'سارة إبراهيم الشريف', 'invoice' => '#MSK-8910', 'course' => 'تحفيظ الصغار', 'date' => '10 أكتوبر 2023', 'amount' => '280 ر.س', 'status' => 'مكتمل', 'statusType' => 'success'],
    ['id' => 4, 'name' => 'يوسف عبدالله العمري', 'invoice' => '#MSK-8722', 'course' => 'القراءات العشر', 'date' => '08 أكتوبر 2023', 'amount' => '500 ر.س', 'status' => 'فشل الدفع', 'statusType' => 'failed'],
    ['id' => 5, 'name' => 'نورة عبدالعزيز', 'invoice' => '#MSK-8611', 'course' => 'حلقة الإتقان (تجويد)', 'date' => '05 أكتوبر 2023', 'amount' => '350 ر.س', 'status' => 'مكتمل', 'statusType' => 'success']
];
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">إدارة الاشتراكات والمالية</h1>
            <p class="text-gray-500 font-medium">متابعة التدفقات المالية، الفواتير، وحالات الدفع لجميع الطلاب</p>
        </div>
        <div class="w-full md:w-96 relative">
            <span class="material-icons-outlined absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 text-xl">search</span>
            <input type="text" placeholder="بحث عن معاملة، فاتورة، اسم طالب..." class="w-full pr-12 pl-4 py-3.5 bg-white border border-gray-100 rounded-2xl shadow-sm outline-none focus:ring-4 focus:ring-emerald-50 transition-all text-sm font-medium" />
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        <div class="p-8 rounded-[3rem] shadow-sm border border-gray-100 transition-all group hover:shadow-xl relative overflow-hidden bg-white">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-emerald-50 text-emerald-700 shadow-emerald-100">
                    <span class="material-icons-outlined">trending_up</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600">+12%</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">الاشتراكات النشطة</p>
            <h2 class="text-3xl font-black text-gray-900">1,240</h2>
        </div>
        <div class="p-8 rounded-[3rem] shadow-sm border border-gray-100 transition-all group hover:shadow-xl relative overflow-hidden bg-white">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-blue-50 text-blue-700 shadow-blue-100">
                    <span class="material-icons-outlined">account_balance_wallet</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-emerald-50 text-emerald-600">من 154 معاملة</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">إجمالي المدفوعات</p>
            <h2 class="text-3xl font-black text-gray-900">45,000 ر.س</h2>
        </div>
        <div class="p-8 rounded-[3rem] shadow-sm border border-red-100 transition-all group hover:shadow-xl relative overflow-hidden bg-white">
            <div class="flex justify-between items-start mb-6">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl transition-transform group-hover:scale-110 shadow-sm bg-red-50 text-red-700 shadow-red-100">
                    <span class="material-icons-outlined">error</span>
                </div>
                <span class="px-2 py-0.5 rounded-lg text-[10px] font-black bg-red-50 text-red-600 animate-pulse">إجراء فوري مطلوب</span>
            </div>
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">حالات متأخرة</p>
            <h2 class="text-3xl font-black text-red-700">18</h2>
        </div>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-50 flex flex-col md:flex-row justify-between items-center gap-6 bg-gray-50/30">
            <div class="flex bg-white p-1.5 rounded-2xl border border-gray-100 shadow-sm w-full md:w-auto overflow-x-auto">
                <?php foreach (['كافة المعاملات', 'الاشتراكات النشطة', 'الفشل والتأخير', 'الفواتير المستحقة'] as $i => $tab): ?>
                <button class="px-6 py-2.5 text-[10px] font-black rounded-xl transition-all whitespace-nowrap <?php echo $i === 0 ? 'bg-emerald-700 text-white shadow-lg shadow-emerald-100' : 'text-gray-400 hover:bg-white'; ?>">
                    <?php echo $tab; ?>
                </button>
                <?php endforeach; ?>
            </div>
            <div class="flex gap-3">
                <button class="p-3 bg-white border border-gray-100 rounded-2xl text-gray-400 hover:text-emerald-700 transition-all shadow-sm"><span class="material-icons-outlined">filter_list</span></button>
                <button class="flex items-center gap-2 px-6 py-2.5 bg-emerald-700 text-white rounded-2xl font-black hover:bg-emerald-800 transition-all shadow-lg shadow-emerald-100">
                    <span class="material-icons-outlined">file_download</span>
                    تقرير مالي
                </button>
            </div>
        </div>

        <table class="w-full text-right border-collapse">
            <thead>
                <tr class="bg-gray-50/50">
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">الطالب والمعاملة</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">المسار التعليمي</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">التاريخ</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">المبلغ</th>
                    <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">الحالة</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php foreach ($transactions as $item): ?>
                <tr class="group hover:bg-gray-50/50 transition-all">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl transition-transform group-hover:scale-110 shadow-sm <?php echo $item['statusType'] === 'success' ? 'bg-emerald-50 text-emerald-700' : ($item['statusType'] === 'late' ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700'); ?>">
                                <span class="material-icons-outlined">receipt</span>
                            </div>
                            <div>
                                <p class="text-lg font-black text-gray-900 mb-0.5"><?php echo $item['name']; ?></p>
                                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">INV: <?php echo $item['invoice']; ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-sm font-bold text-gray-600"><?php echo $item['course']; ?></td>
                    <td class="px-8 py-6 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest"><?php echo $item['date']; ?></td>
                    <td class="px-8 py-6 text-center font-black text-gray-900"><?php echo $item['amount']; ?></td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black tracking-widest uppercase <?php echo $item['statusType'] === 'success' ? 'bg-emerald-100 text-emerald-700' : ($item['statusType'] === 'late' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo $item['status']; ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>