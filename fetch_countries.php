<?php
include 'db.php';

$result = $conn->query("SELECT * FROM countries");
$countries = [];
while ($row = $result->fetch_assoc()) {
    $countries[] = $row;
}
echo json_encode($countries);
?>
