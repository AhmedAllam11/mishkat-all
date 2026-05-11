-- ========================================================
-- هيكل قاعدة بيانات منصة مشكاة التعليمية (Mishkat Platform)
-- تم إعداده ليكون واضحاً ومنظماً لمناقشة مشروع التخرج
-- ========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- 1. جدول المستخدمين (users)
-- يضم كافة أنواع الحسابات: (الطلاب، المعلمون، أولياء الأمور، الإدارة)
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,              -- اسم المستخدم الكامل
  `email` varchar(255) NOT NULL,             -- البريد الإلكتروني (فريد)
  `phone` varchar(20) DEFAULT NULL,          -- رقم الهاتف
  `role` enum('student','teacher','parent','admin') NOT NULL DEFAULT 'student', -- دور المستخدم
  `password` varchar(255) NOT NULL,          -- كلمة المرور المشفرة
  `gender` varchar(10) DEFAULT 'ذكر',        -- الجنس
  `age` int(11) DEFAULT NULL,                -- العمر
  `location` varchar(255) DEFAULT NULL,      -- الموقع الجغرافي
  `status` enum('active','pending','suspended') DEFAULT 'active', -- حالة الحساب
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- تاريخ الإنشاء
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. معلومات المعلمين (teachers_info)
-- يحتوي على البيانات المهنية الخاصة بالمعلمين فقط
CREATE TABLE IF NOT EXISTS `teachers_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,                -- ربط بمعرف المستخدم في جدول users
  `specialty` varchar(255) DEFAULT NULL,     -- التخصص التعليمي
  `experience_years` int(11) DEFAULT NULL,   -- سنوات الخبرة
  `location` varchar(255) DEFAULT NULL,      -- موقع المعلم
  `cv_url` varchar(255) DEFAULT NULL,        -- رابط السيرة الذاتية
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `teachers_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. جدول الربط (parent_student)
-- يحقق علاقة (متعدد لمتعدد) لربط أولياء الأمور بأبنائهم الطلاب
CREATE TABLE IF NOT EXISTS `parent_student` (
  `parent_id` int(11) NOT NULL,              -- معرف ولي الأمر
  `student_id` int(11) NOT NULL,             -- معرف الطالب
  PRIMARY KEY (`parent_id`,`student_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `parent_student_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parent_student_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. المسارات التعليمية (courses)
-- يمثل الدورات المتاحة في المنصة (تجويد، حفظ، تفسير، إلخ)
CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,             -- عنوان الدورة
  `description` text,                         -- وصف الدورة
  `category` varchar(100) DEFAULT NULL,      -- التصنيف
  `teacher_id` int(11) DEFAULT NULL,         -- المعلم المسؤول عن الدورة
  `image_url` varchar(255) DEFAULT NULL,      -- صورة الدورة
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`),
  CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. الحلقات والدروس (episodes)
-- يمثل المحتوى التعليمي الفعلي لكل دورة
CREATE TABLE IF NOT EXISTS `episodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,              -- الدورة التابع لها الدرس
  `title` varchar(255) NOT NULL,             -- عنوان الدرس
  `content_type` enum('video','file','link') DEFAULT 'video', -- نوع المحتوى
  `content_url` varchar(255) DEFAULT NULL,    -- رابط الفيديو أو الملف
  `order_no` int(11) DEFAULT '0',            -- ترتيب الدرس في الدورة
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. المهام والواجبات (tasks)
-- يمثل الواجبات اليومية التي يكلف بها الطلاب
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,             -- عنوان المهمة
  `description` text,                         -- تفاصيل المهمة
  `type` enum('reading','audio','exam') DEFAULT 'reading', -- نوع المهمة
  `deadline` date DEFAULT NULL,              -- الموعد النهائي للتسليم
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. متابعة المهام (user_tasks)
-- يسجل حالة إنجاز المهام لكل طالب على حدة
CREATE TABLE IF NOT EXISTS `user_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,                -- معرف الطالب
  `task_id` int(11) NOT NULL,                -- معرف المهمة
  `completed` tinyint(1) DEFAULT '0',        -- حالة الإكمال (0: لم يكتمل، 1: مكتمل)
  `completed_at` timestamp NULL DEFAULT NULL, -- وقت الإكمال الفعلي
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`),
  CONSTRAINT `user_tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_tasks_ibfk_2` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
