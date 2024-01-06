<?php
include("db.php");

// Проверяем, была ли отправлена форма с номером заказа
if(isset($_POST['order_id'])){
    $order_id = $_POST['order_id'];

    $stmt = $mysql->prepare("SELECT status, kuryer_name FROM orders WHERE order_id = ?");
    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $stmt->bind_result($status, $kuryerName);
    $stmt->fetch();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Order Status</title>
</head>
<body>
    <h1>Check Order Status</h1>

    <!-- Форма для ввода номера заказа -->
    <form method="post" action="check.php">
        <label for="order_id">Enter your order ID:</label>
        <input type="text" name="order_id" required>
        <button type="submit">Check Status</button>
    </form>

    <!-- Отображение статуса заказа и имени курьера -->
    <?php if(isset($status)): ?>
        <h2>Order Status: <?php echo $status; ?></h2>
        <?php if($status == 'Accepted'): ?>
            <p>Courier Name: <?php echo $kuryerName; ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
