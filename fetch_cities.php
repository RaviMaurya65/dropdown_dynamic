<?php
include 'db.php';

$state_id = $_POST['state_id'];
$result = $conn->query("SELECT * FROM cities WHERE state_id = $state_id");
$cities = [];
while ($row = $result->fetch_assoc()) {
    $cities[] = $row;
}
echo json_encode($cities);
?>
