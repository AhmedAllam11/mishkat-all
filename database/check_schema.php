<?php
require 'db.php';
$r = $conn->query("DESCRIBE episodes");
while($row = $r->fetch_assoc()) print_r($row);
?>
