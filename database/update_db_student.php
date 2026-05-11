<?php
require_once 'db.php';

// Add age column to users
$sql = "ALTER TABLE users ADD COLUMN age INT AFTER gender";
if ($conn->query($sql)) echo "Column 'age' added to users table.<br>";
else echo "Age column already exists or error: " . $conn->error . "<br>";

// Create uploads directory
if (!file_exists('uploads/cvs')) {
    mkdir('uploads/cvs', 0777, true);
    echo "Directory 'uploads/cvs' created.<br>";
}

echo "<h2>Database and Filesystem Updated!</h2>";
echo "<p><a href='index.php'>Return to Home</a></p>";
?>
