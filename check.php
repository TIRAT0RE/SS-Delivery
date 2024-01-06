<?php
include("db.php");

if (isset($_POST['phone'])) {
    $phone = $_POST['phone'];

    // Запрос на получение всех заказов с указанным номером телефона
    $stmt = $mysql->prepare("SELECT id, status, courier_name, accepted_time, completed_time FROM orders WHERE phone = ?");
    $stmt->bind_param("s", $phone);
    $stmt->execute();
    $stmt->bind_result($order_id, $status, $courier_name, $accepted_time, $completed_time);

    // Создаем массив для хранения результатов
    $orders = array();

    // Записываем результаты в массив
    while ($stmt->fetch()) {
        $orders[] = array(
            'order_id' => $order_id,
            'status' => $status,
            'courier_name' => $courier_name,
            'accepted_time' => $accepted_time,
            'completed_time' => $completed_time
        );
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Перевірити статус доставки</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            text-align: center;
            padding: 20px;
        }

        h2, h3, p {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 300px;
            padding: 10px;
            margin-bottom: 15px;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }

        p {
            margin-top: 10px;
            color: #666;
        }
		
		.home-button {
			display: block;
			margin-top: 20px auto;
			padding: 10px 20px;
			background-color: #4CAF50;
			color: white;
			text-align: center;
			text-decoration: none;
			font-size: 16px;
			cursor: pointer;
			border-radius: 5px;
			width: fit-content;
		}

		.home-button:hover {
			background-color: #45a049;
		}
		
		body.dark-theme {
			background-color: #333;
			color: #fff;
		}
		
		.dark-theme {
			color: #fff;
		}
		
		.theme-switch-wrapper {
			position: fixed;
			top: 10px;
			right: 10px;
			display: flex;
			align-items: center;
		}

		.theme-switch {
			display: inline-block;
			height: 34px;
			position: relative;
			width: 60px;
		}
		
		.slider {
			background-color: #ddd;
			bottom: 0;
			cursor: pointer;
			left: 0;
			position: absolute;
			right: 0;
			top: 0;
			transition: 0.5s;
		}

		.slider:before {
			background-color: #fff;
			bottom: 4px;
			content: "";
			height: 26px;
			left: 4px;
			position: absolute;
			transition: 0.4s;
			width: 26px;
		}

		input:checked + .slider {
			background-color: #2196F3;
		}

		input:checked + .slider:before {
			transform: translateX(26px);
		}
    </style>
</head>
<body>
<div class="theme-switch-wrapper">
    <label class="theme-switch" for="checkbox">
        <input type="checkbox" id="checkbox" />
        <div class="slider round"></div>
    </label>
    <em>Темна тема</em>
</div>
	<a href="index.php" class="home-button">На головну</a>
    <h1>Перевірити статус замовлення</h1>

    <form method="post" action="check.php">
        <label for="phone">Введіть номер телефону:</label>
        <input type="text" name="phone" required>
        <button type="submit">Перевірити</button>
    </form>

    <?php if(isset($orders) && !empty($orders)): ?>
        <h2>Замовлення з номером телефону <?php echo $phone; ?>:</h2>
        <?php foreach ($orders as $order): ?>
            <h3>Статус замовлення #<?php echo $order['order_id']; ?>: <?php echo $order['status']; ?></h3>
            <?php if ($order['status'] == 'Accepted' || $order['status'] == 'Completed' || $order['status'] == 'Not accepted'): ?>
                <p>Ім’я вашого кур’єра: <?php echo $order['courier_name']; ?></p>
                <p>Час прийняття замовлення: <?php echo $order['accepted_time']; ?></p>
                <p>Час виконання замовлення: <?php echo $order['completed_time']; ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Немає замовлень з таким номером телефону.</p>
    <?php endif; ?>

    <script>
        const checkbox = document.getElementById('checkbox');
        const body = document.body;

        checkbox.addEventListener('change', () => {
            body.classList.toggle('dark-theme');
        });
    </script>
</body>
</html>
