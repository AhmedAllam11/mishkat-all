<?php
require_once 'db.php';
$userId = $_SESSION['user_id'];

// Fetch tasks from DB
$tasksQuery = "
    SELECT t.*, IFNULL(ut.completed, 0) as completed 
    FROM tasks t 
    LEFT JOIN user_tasks ut ON t.id = ut.task_id AND ut.user_id = $userId
";
$tasksResult = $conn->query($tasksQuery);
$tasks = [];
if ($tasksResult) {
    while ($row = $tasksResult->fetch_assoc()) {
        $tasks[] = $row;
    }
}

// Fallback to mock data if DB is empty for demo purposes
if (empty($tasks)) {
    $tasks = [
        ['id' => 1, 'title' => 'مراجعة سورة البقرة', 'desc' => 'من الآية 1 إلى 50 - حفظاً وتجويداً', 'status' => 'عاجل', 'deadline' => 'ينتهي غداً', 'type' => 'book', 'completed' => 0],
        ['id' => 2, 'title' => 'اختبار التجويد الاسبوعي', 'desc' => 'أحكام النون الساكنة', 'status' => 'اعتيادي', 'deadline' => 'بعد 3 أيام', 'type' => 'exam', 'completed' => 0],
        ['id' => 3, 'title' => 'تسجيل تلاوة', 'desc' => 'تسجيل صوتي 3 دقائق', 'status' => 'متأخر', 'deadline' => 'منذ أمس', 'type' => 'audio', 'completed' => 0],
        ['id' => 4, 'title' => 'حفظ سورة الكهف', 'desc' => 'أول 10 آيات', 'status' => 'اعتيادي', 'deadline' => 'بعد يومين', 'type' => 'book', 'completed' => 1],
    ];
}

$upcoming = [
    ['id' => 1, 'title' => 'حلقة التلاوة الصباحية', 'teacher' => 'الشيخ محمود', 'time' => '08:00 ص', 'day' => '24', 'month' => 'أكتوبر'],
    ['id' => 2, 'title' => 'شرح متن الجزرية', 'teacher' => 'قاعة ب', 'time' => '04:30 م', 'day' => '26', 'month' => 'أكتوبر'],
];

$completedCount = count(array_filter($tasks, function($t) { return $t['completed']; }));
$progress = count($tasks) > 0 ? round(($completedCount / count($tasks)) * 100) : 0;
?>
<main class="flex-1 flex flex-col px-4 md:px-8 py-6 bg-gray-50/50" dir="rtl">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="text-right">
            <h1 class="text-3xl font-black text-gray-900 mb-2">مهامك التعليمية</h1>
            <p class="text-gray-500 font-medium">لديك <?php echo count($tasks) - $completedCount; ?> مهام متبقية لإنجازها اليوم</p>
        </div>
        <div class="flex gap-3">
            <button class="px-6 py-2.5 rounded-2xl font-bold transition-all bg-emerald-700 text-white shadow-lg shadow-emerald-200">الكل</button>
            <button class="px-6 py-2.5 rounded-2xl font-bold transition-all bg-white text-gray-600 hover:bg-gray-100">قيد التنفيذ</button>
            <button class="px-6 py-2.5 rounded-2xl font-bold transition-all bg-white text-gray-600 hover:bg-gray-100">المكتملة</button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl bg-emerald-50 text-emerald-700">
                <span class="material-icons-outlined">assignment</span>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-sm font-bold mb-1">إجمالي المهام</p>
                <h3 class="text-2xl font-black text-gray-900"><?php echo count($tasks); ?></h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl bg-amber-50 text-amber-700">
                <span class="material-icons-outlined">access_time</span>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-sm font-bold mb-1">قيد التنفيذ</p>
                <h3 class="text-2xl font-black text-gray-900"><?php echo count($tasks) - $completedCount; ?></h3>
            </div>
        </div>
        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 flex items-center justify-between group hover:shadow-md transition-all">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-2xl bg-blue-50 text-blue-700">
                <span class="material-icons-outlined">check_circle</span>
            </div>
            <div class="text-right">
                <p class="text-gray-400 text-sm font-bold mb-1">مكتملة</p>
                <h3 class="text-2xl font-black text-gray-900"><?php echo $completedCount; ?></h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-emerald-900 text-white rounded-[2rem] p-8 relative overflow-hidden shadow-2xl">
                <div class="relative z-10">
                    <h3 class="text-xl font-bold mb-2">تقدمك العام</h3>
                    <p class="text-emerald-200 text-sm mb-6">أنت تبلي بلاءً حسناً!</p>
                    <div class="flex items-center justify-center mb-6">
                        <div class="relative w-32 h-32 flex items-center justify-center">
                            <svg class="w-full h-full rotate-[-90deg]">
                                <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-emerald-800" />
                                <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-white transition-all duration-1000" 
                                    stroke-dasharray="364" stroke-dashoffset="<?php echo 364 - (364 * $progress) / 100; ?>" stroke-linecap="round" />
                            </svg>
                            <span class="absolute text-2xl font-black"><?php echo $progress; ?>%</span>
                        </div>
                    </div>
                    <button class="w-full py-3 bg-emerald-700/50 hover:bg-emerald-700 rounded-xl text-sm font-bold transition">عرض الإحصائيات</button>
                </div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-emerald-800/30 rounded-full blur-3xl"></div>
            </div>

            <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <button class="text-emerald-600 text-sm font-bold">الكل</button>
                    <h3 class="font-black text-gray-800">حصص قادمة</h3>
                </div>
                <div class="space-y-4">
                    <?php foreach ($upcoming as $item): ?>
                    <div class="group flex items-center gap-4 p-3 hover:bg-emerald-50 rounded-2xl transition-all cursor-pointer border border-transparent hover:border-emerald-100">
                        <div class="flex-1 text-right">
                            <h4 class="font-bold text-gray-800 text-sm group-hover:text-emerald-900"><?php echo $item['title']; ?></h4>
                            <p class="text-[10px] text-gray-400 font-medium"><?php echo $item['teacher']; ?> • <?php echo $item['time']; ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gray-50 rounded-xl flex flex-col items-center justify-center group-hover:bg-white transition-colors">
                            <span class="text-emerald-700 font-black text-sm"><?php echo $item['day']; ?></span>
                            <span class="text-[9px] text-gray-400 font-bold uppercase"><?php echo $item['month']; ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-700">
                    <span class="material-icons-outlined text-xl">assignment</span>
                </div>
                <h3 class="text-xl font-black text-gray-800">قائمة المها�                    <button 
                        onclick="toggleTask(<?php echo $task['id']; ?>, this)"
                        class="w-8 h-8 rounded-full border-2 flex items-center justify-center transition-all <?php echo $task['completed'] ? 'bg-emerald-600 border-emerald-600 text-white' : 'border-gray-200 hover:border-emerald-400'; ?>">
                        <?php if ($task['completed']) echo '<span class="material-icons-outlined text-sm">check_circle</span>'; ?>
                    </button>
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-colors <?php echo $task['completed'] ? 'bg-white' : 'bg-gray-50 group-hover:bg-emerald-50'; ?>">
                        <span class="material-icons-outlined text-emerald-600"><?php echo ($task['type'] == 'audio' ? 'mic' : ($task['type'] == 'exam' ? 'quiz' : 'menu_book')); ?></span>
                    </div>
                    <div class="flex-1 text-center md:text-right">
                        <div class="flex flex-col md:flex-row md:items-center gap-2 mb-1 justify-center md:justify-start">
                            <h4 class="text-lg font-black transition-all <?php echo $task['completed'] ? 'text-gray-400 line-through' : 'text-gray-800'; ?>"><?php echo $task['title']; ?></h4>
                            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold w-fit mx-auto md:mx-0 <?php echo $task['status'] == 'عاجل' ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-500'; ?>"><?php echo $task['status']; ?></span>
                        </div>
                        <p class="text-sm text-gray-400 font-medium leading-relaxed"><?php echo $task['desc']; ?></p>
                    </div>
                    <div class="flex flex-col items-center md:items-end gap-3 min-w-[120px]">
                        <span class="text-xs font-bold text-gray-400 flex items-center gap-1">
                            <span class="material-icons-outlined text-sm">access_time</span>
                            <?php echo $task['deadline']; ?>
                        </span>
                        <?php if (!$task['completed']): ?>
                        <button 
                            onclick="toggleTask(<?php echo $task['id']; ?>, this.parentElement.parentElement.querySelector('button'))"
                            class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-95">ابدأ الآن</button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
    function toggleTask(taskId, btn) {
        const formData = new FormData();
        formData.append('action', 'complete_task');
        formData.append('task_id', taskId);

        fetch('api.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Visual update
                btn.classList.add('bg-emerald-600', 'border-emerald-600', 'text-white');
                btn.innerHTML = '<span class="material-icons-outlined text-sm">check_circle</span>';
                // Refresh page or update progress bar via JS if wanted
                location.reload(); 
            } else {
                alert('Error: ' + data.message);
            }
        });
    }
    </script>
</main>
d']): ?>
                        <button class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black rounded-xl shadow-lg shadow-emerald-200 transition-all active:scale-95">ابدأ الآن</button>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>