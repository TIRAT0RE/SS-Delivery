<?php
include("db.php");

$completedOrdersQuery = $mysql->query("SELECT * FROM orders where status='Completed'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виконані замовлення</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form method="POST" class="completed-button" action="logout_courier.php">
    <input type="submit" value="Вийти">
</form>
	<a href="takejob.php" class="takejob-button">Переглянути доступні замовлення</a>
    <h2>Виконані замовлення</h2>
    <table>
        <tr>
            <th>Номер замовлення</th>
            <th>Ім’я кур’єра</th>
            <th>Ім’я замовника</th>
			<th>Телефон замовника</th>
            <th>Адреса доставки</th>
			<th>Транспорт доставки</th>
        </tr>
        <?php while ($order = $completedOrdersQuery->fetch_array()) { ?>
            <tr>
                <td><?php echo $order['id']; ?></td>
                <td><?php echo $order['courier_name']; ?></td>
                <td><?php echo $order['customer_name']; ?></td>
				<td><?php echo $order['phone']; ?></td>
                <td><?php echo $order['address']; ?></td>
				<td><?php echo $order['transport']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
