<?php
include("db.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = mysqli_real_escape_string($mysql, $_POST['login']);
    $password = mysqli_real_escape_string($mysql, $_POST['password']);

    $result = $mysql->query("SELECT * FROM couriers WHERE login='$login' AND password='$password'");
    
    if ($result->num_rows > 0) {
        $courier = $result->fetch_assoc();
        $_SESSION['courier_id'] = $courier['id'];
        header("Location: takejob.php");
        exit();
    } else {
        echo "Неправильний логін або пароль.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизація</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h2>Увійти</h2>
	<div class="container">
		<form method="POST" action="login_courier.php">
        <label for="login">Логін:</label>
        <input type="text" name="login" required>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
        <input type="submit" value="Login">
		</form>
	</div>
</body>
</html>
