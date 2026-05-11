<?php
require_once 'db.php';

// Disable foreign key checks to allow dropping tables safely
$conn->query("SET FOREIGN_KEY_CHECKS = 0");

$tables_to_drop = [
    'exam_results', 'parent_student', 'student_tracking', 'evaluations', 
    'circle_students', 'circles', 'library_items', 'calendar_events', 
    'notifications', 'user_tasks', 'tasks', 'enrollments', 'courses', 
    'teachers_info', 'settings', 'users', 'episodes', 'quizzes', 'quiz_questions', 'user_episodes', 'payments', 'subscriptions'
];

foreach ($tables_to_drop as $table) {
    $conn->query("DROP TABLE IF EXISTS $table");
}

// Enable foreign key checks back
$conn->query("SET FOREIGN_KEY_CHECKS = 1");

$tables = [
    "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(50) DEFAULT NULL,
        gender ENUM('ذكر','أنثى') DEFAULT NULL,
        location VARCHAR(255) DEFAULT NULL,
        role ENUM('admin','teacher','student','parent') NOT NULL DEFAULT 'student',
        status ENUM('active','suspended','pending') DEFAULT 'active',
        avatar VARCHAR(500) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE teachers_info (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        specialty VARCHAR(255),
        experience_years INT DEFAULT 0,
        bio TEXT,
        rating DECIMAL(3,2) DEFAULT 5.0,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE courses (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        type VARCHAR(100),
        description TEXT,
        sessions_count VARCHAR(100),
        students_count INT DEFAULT 0,
        price DECIMAL(10,2) DEFAULT 0,
        color VARCHAR(50) DEFAULT 'emerald',
        status ENUM('active','draft','archived') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE enrollments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        course_id INT NOT NULL,
        enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        progress INT DEFAULT 0,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        type ENUM('book','exam','audio') DEFAULT 'book',
        deadline VARCHAR(100),
        status ENUM('عاجل','اعتيادي','متأخر') DEFAULT 'اعتيادي',
        assigned_by INT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE user_tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        task_id INT NOT NULL,
        completed TINYINT(1) DEFAULT 0,
        completion_date DATETIME DEFAULT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255),
        message TEXT,
        type ENUM('system','success','alert','msg') DEFAULT 'system',
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE calendar_events (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        event_date DATE NOT NULL,
        event_time TIME DEFAULT '00:00:00',
        type ENUM('class','exam','meeting','holiday') DEFAULT 'class',
        color VARCHAR(50) DEFAULT 'emerald',
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE library_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        category VARCHAR(100),
        type ENUM('pdf','audio','video','article') DEFAULT 'pdf',
        description TEXT,
        file_url TEXT,
        downloads INT DEFAULT 0,
        uploaded_by INT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE circles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        teacher_id INT NOT NULL,
        max_students INT DEFAULT 20,
        status ENUM('active','paused','completed') DEFAULT 'active',
        schedule VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE circle_students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        circle_id INT NOT NULL,
        student_id INT NOT NULL,
        joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (circle_id) REFERENCES circles(id) ON DELETE CASCADE,
        FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE evaluations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        teacher_id INT NOT NULL,
        student_id INT NOT NULL,
        memorization INT DEFAULT 0,
        tajweed INT DEFAULT 0,
        behavior INT DEFAULT 0,
        attendance INT DEFAULT 0,
        notes TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE student_tracking (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_id INT NOT NULL,
        surah VARCHAR(100),
        from_ayah INT,
        to_ayah INT,
        quality ENUM('ممتاز','جيد جداً','جيد','مقبول','ضعيف') DEFAULT 'جيد',
        notes TEXT,
        recorded_by INT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE payments (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        amount DECIMAL(10,2) NOT NULL,
        status ENUM('pending','completed','failed') DEFAULT 'completed',
        method VARCHAR(50) DEFAULT 'card',
        description VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        plan_name VARCHAR(100),
        amount DECIMAL(10,2),
        start_date DATE,
        end_date DATE,
        status ENUM('active','expired','cancelled') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        setting_key VARCHAR(100) UNIQUE,
        setting_value TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE exam_results (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        exam_title VARCHAR(255),
        score INT,
        total INT,
        percentage DECIMAL(5,2),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE episodes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_id INT NOT NULL,
        teacher_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        content_type ENUM('text','video','file','link') DEFAULT 'text',
        content_data TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
        FOREIGN KEY (teacher_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE quizzes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        episode_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (episode_id) REFERENCES episodes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE quiz_questions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        quiz_id INT NOT NULL,
        question TEXT NOT NULL,
        options TEXT NOT NULL, -- JSON string
        correct_answer VARCHAR(255) NOT NULL,
        FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE user_episodes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        episode_id INT NOT NULL,
        completed TINYINT(1) DEFAULT 0,
        completed_at DATETIME DEFAULT NULL,
        UNIQUE KEY user_ep_unique (user_id, episode_id),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (episode_id) REFERENCES episodes(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    "CREATE TABLE parent_student (
        id INT AUTO_INCREMENT PRIMARY KEY,
        parent_id INT NOT NULL,
        student_id INT NOT NULL,
        FOREIGN KEY (parent_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
];

foreach ($tables as $sql) {
    if (!$conn->query($sql)) {
        echo "Error creating table: " . $conn->error . "<br>";
    }
}

// Seed Users
$pass = password_hash("123456", PASSWORD_DEFAULT);
$conn->query("INSERT INTO users (name, email, password, role, status) VALUES 
('مدير المنصة', 'admin@mishkat.com', '$pass', 'admin', 'active'),
('المعلم محمد', 'teacher@mishkat.com', '$pass', 'teacher', 'active'),
('الطالب أحمد', 'student@mishkat.com', '$pass', 'student', 'active'),
('ولي الأمر خالد', 'parent@mishkat.com', '$pass', 'parent', 'active')");

// Seed Courses
$conn->query("INSERT INTO courses (title, type, description, sessions_count, price, color) VALUES 
('دورة التجويد', 'تجويد', 'شرح مبسط لأحكام التجويد وإتقان مخارج الحروف', '12 حصة', 300, 'emerald'),
('مسار الحفظ', 'حفظ', 'برنامج مكثف لحفظ القرآن الكريم مع المراجعة', '24 حصة', 500, 'blue'),
('دورة التفسير', 'تفسير', 'تدبر معاني القرآن الكريم وبيان أسباب النزول', '10 حصص', 400, 'amber')");

// Seed Settings
$conn->query("INSERT INTO settings (setting_key, setting_value) VALUES 
('site_name', 'أكاديمية مشكاة'),
('site_email', 'info@mishkat.com'),
('registration_open', '1'),
('max_students_per_circle', '20')");

echo "<h2>Database Refreshed Successfully!</h2>";
echo "<p>Please return to <a href='login.php'>Login Page</a> and use: <b>admin@mishkat.com</b> / <b>123456</b></p>";
?>
