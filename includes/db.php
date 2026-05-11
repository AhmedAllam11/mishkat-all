<?php
/**
 * ملف الاتصال بقاعدة البيانات
 * يحتوي على إعدادات الاتصال والربط مع MySQL
 */

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "mishkat_db";

// إنشاء الاتصال باستخدام MySQLi
$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من نجاح الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

// تعيين ترميز البيانات إلى utf8mb4 لدعم اللغة العربية بشكل كامل
$conn->set_charset("utf8mb4");
?>
