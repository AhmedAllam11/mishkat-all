<?php
require_once 'db.php';

$email = 'admin@mishkat.com';
$password = '123456';
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Check if admin exists
$check = $conn->query("SELECT id FROM users WHERE email = '$email'");

if ($check->num_rows > 0) {
    // Update existing admin
    $conn->query("UPDATE users SET password = '$hashed', role = 'admin', status = 'active' WHERE email = '$email'");
    echo "<h1>تم تحديث بيانات المسؤول بنجاح!</h1>";
} else {
    // Create new admin
    $conn->query("INSERT INTO users (name, email, password, role, status) VALUES ('مدير النظام', '$email', '$hashed', 'admin', 'active')");
    echo "<h1>تم إنشاء حساب مسؤول جديد بنجاح!</h1>";
}

echo "<p>البريد: <b>$email</b></p>";
echo "<p>كلمة المرور: <b>$password</b></p>";
echo "<p><a href='admin_login.php'>انتقل الآن لصفحة دخول الإدارة</a></p>";
?>
