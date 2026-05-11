<?php
require_once 'db.php';

// Add columns to teachers_info
$sql1 = "ALTER TABLE teachers_info ADD COLUMN location VARCHAR(255) AFTER rating";
$sql2 = "ALTER TABLE teachers_info ADD COLUMN cv_url VARCHAR(500) AFTER location";

if ($conn->query($sql1)) echo "Column 'location' added.<br>";
else echo "Error adding 'location' (maybe it exists): " . $conn->error . "<br>";

if ($conn->query($sql2)) echo "Column 'cv_url' added.<br>";
else echo "Error adding 'cv_url' (maybe it exists): " . $conn->error . "<br>";

echo "<h2>Database Schema Updated Successfully!</h2>";
echo "<p><a href='index.php'>Return to Home</a></p>";
?>
