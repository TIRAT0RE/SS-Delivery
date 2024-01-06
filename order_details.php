<?php
include("db.php");

session_start();

if (!isset($_SESSION['courier_id'])) {
    header("Location: login_courier.php");
    exit();
}

if (isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["complete_order"])) {
        $courier_id = $_SESSION['courier_id'];

        $updateQuery = "UPDATE orders SET status = 'Completed' WHERE id = $order_id";
        $mysql->query($updateQuery);

        $updateCourierQuery = "UPDATE couriers SET completed_amount = completed_amount + 1 WHERE id = $courier_id";
        $mysql->query($updateCourierQuery);

        header("Location: takejob.php");
        exit();
    }

    $orderQuery = $mysql->query("SELECT * FROM orders WHERE id = $order_id");

    if ($order = $orderQuery->fetch_array()) {
        echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Інформація про доставку</title>
                <link rel='stylesheet' href='styles.css'>
            </head>
            <body>
                <h1>Інформація про доставку</h1>
                <p><strong>Номер замовлення:</strong> {$order['id']}</p>
                <p><strong>Ім’я замовника:</strong> {$order['customer_name']}</p>
				<p><strong>Телефон замовника:</strong> {$order['phone']}</p>
                <p><strong>Адреса доставки:</strong> {$order['address']}</p>
                <p><strong>Ім’я кур’єра:</strong> {$order['courier_name']}</p>
                <p><strong>Транспорт:</strong> {$order['transport']}</p>
                <p><strong>Статус:</strong> {$order['status']}</p>";

        echo "<form method='POST' action='order_details.php?order_id={$order['id']}'>
                <input type='submit' name='complete_order' value='Complete Order'>
              </form>";

        echo "</body></html>";
    } else {
        echo "Замовлення не знайдене.";
    }
} else {
    echo "Введіть номер замовлення.";
}
?>
