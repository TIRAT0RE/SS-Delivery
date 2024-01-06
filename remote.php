<!DOCTYPE html>
<html>
<head>
    <title>List of orders</title>
</head>
<body>

<h1>List of orders</h1>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kuryer";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, district_id, customer_name, phone, address, price, courier_name, transport, is_urgent, status FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>ID: " . $row["id"]. " - District ID: " . $row["district_id"]. " - Name: " . $row["customer_name"]. " - Phone: " . $row["phone"]. " - Address: " . $row["address"]. " - Price: " . $row["price"]. " - Courier name: " . $row["courier_name"]. " - Transport: " . $row["transport"]. " - Urgent: " . $row["is_urgent"]. " - Order accepted: " . $row["status"]."</li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
