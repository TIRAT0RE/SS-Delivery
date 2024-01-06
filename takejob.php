<?php
include("db.php");

session_start();

if (!isset($_SESSION['courier_id'])) {
    header("Location: login_courier.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["transport"])) {
    $order_id = $_POST['order_id'];
    $courier_id = $_SESSION['courier_id'];
    $transport = $_POST['transport'];

    $courierQuery = $mysql->query("SELECT name FROM couriers WHERE id = $courier_id");
    $courier = $courierQuery->fetch_array();
    $courier_name = $courier['name'];

    $updateQuery = "UPDATE orders SET courier_name = '$courier_name', transport = '$transport', status = 'Accepted' WHERE id = $order_id";
    $mysql->query($updateQuery);

    header("Location: order_details.php?order_id=$order_id");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Взяти замовлення</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form method="POST" class="completed-button" action="logout_courier.php">
    <input type="submit" value="Вийти">
</form>
	<a href="completed.php" class="completed-button">Переглянути виконані замовлення</a>
    <h2>Доступні замовлення</h2>
    <table>
        <tr>
            <th>ID замовлення</th>
            <th>Ім’я замовника</th>
			<th>Телефон замовника</th>
            <th>Адреса доставки</th>
			<th>Термінова доставка</th>
            <th>Дії</th>
        </tr>
        <?php
        $ordersQuery = $mysql->query("SELECT * FROM orders WHERE status = 'Not accepted'");

        while ($order = $ordersQuery->fetch_array()) {
            ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['customer_name']; ?></td>
				<td><?php echo $order['phone']; ?></td>
                <td><?php echo $order['address']; ?></td>
				<td><?php echo $order['is_urgent']; ?></td>
                <td>
                    <form method="POST" action="takejob.php">
                        <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                        <label for="transport">Вибрати транспорт:</label>
                        <select name="transport" required>
                            <option value="bike">Велосипед</option>
                            <option value="car">Автомобіль</option>
                            <option value="scooter">Скутер</option>
                        </select>
                        <input type="submit" value="Взятися">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
