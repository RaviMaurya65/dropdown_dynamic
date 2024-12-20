<?php
include 'db.php';

$country_id = $_POST['country_id'];
$result = $conn->query("SELECT * FROM states WHERE country_id = $country_id");
$states = [];
while ($row = $result->fetch_assoc()) {
    $states[] = $row;
}
echo json_encode($states);
?>
