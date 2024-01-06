<?php
echo "POST district_id: " . (isset($_POST['district_id']) ? $_POST['district_id'] : 'Not set in POST') . "<br>";
echo "GET district_id: " . (isset($_GET['district_id']) ? $_GET['district_id'] : 'Not set in GET') . "<br>";

$district_id = isset($_POST['district_id']) ? $_POST['district_id'] : (isset($_GET['district_id']) ? $_GET['district_id'] : null);
$customer_name = $_POST['customer_name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$price = $_POST['price'];
$courier_name = $_POST['courier_name'];
$transport = $_POST['transport'];
$is_urgent = isset($_POST['urgentDelivery']) && $_POST['urgentDelivery'] === 'on' ? 'yes' : 'no';

include("db.php");

$stmt = $mysql->prepare("INSERT INTO orders (district_id, customer_name, phone, address, price, courier_name, transport, is_urgent) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssisss", $district_id, $customer_name, $phone, $address, $price, $courier_name, $transport, $is_urgent);
$stmt->execute();

$order_id = $stmt->insert_id;

header("Location: index.php");
?>
