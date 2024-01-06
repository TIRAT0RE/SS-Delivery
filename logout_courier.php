<?php
session_start();

// Уничтожаем все данные сессии
session_destroy();

// Перенаправляем пользователя на страницу авторизации курьера
header("Location: login_courier.php");
exit();
?>
