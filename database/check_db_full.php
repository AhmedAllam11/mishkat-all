<?php
require 'db.php';
echo "--- COURSES WITH CONTENT ---\n";
$r = $conn->query("SELECT id, title, content_type, content_data FROM courses WHERE content_data != '' AND content_data IS NOT NULL");
while($row = $r->fetch_assoc()) print_r($row);

echo "--- EPISODES ---\n";
$r = $conn->query("SELECT id, course_id, title, content_type, content_data FROM episodes");
while($row = $r->fetch_assoc()) print_r($row);
?>
