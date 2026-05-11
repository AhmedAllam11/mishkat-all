<?php
require 'db.php';
echo "--- COURSE 1 ---\n";
$c = $conn->query("SELECT * FROM courses WHERE id=1")->fetch_assoc();
print_r($c);
echo "--- EPISODES FOR COURSE 1 ---\n";
$r = $conn->query("SELECT * FROM episodes WHERE course_id=1");
while($row = $r->fetch_assoc()) print_r($row);
?>
