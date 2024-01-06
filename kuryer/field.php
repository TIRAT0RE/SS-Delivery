<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Замовлення доставки</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php" class="home-button">На головну</a>
    <div class="container">
        <form action="order.php" method="POST" id="form">
            <label for="name">Ім'я:</label>
            <input type="text" name="customer_name" id="name" required>

			<label for="phone">Телефон:</label>
			<div class="phone-input">
				<span>+</span>
				<input type="tel" id="phone" name="phone" pattern="[0-9]{12}" required title="Введіть номер телефону.">
			</div>


            <label for="address">Адреса:</label>
            <input type="text" name="address" id="address" required>

            <label for="urgentDelivery">Срочна доставка:</label>
            <input type="checkbox" name="urgentDelivery" id="urgentDelivery">

            <input type="hidden" name="price" id="formPrice">
            <?php if (isset($_GET['id'])) : ?>
                <input type="hidden" name="district_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
				<input type="hidden" name="kuryer_name" value="">
				<input type="hidden" name="transport" value="">
            <?php endif; ?>

            <p>До сплати <span id="modalPay"></span> &#8372;</p>

            <button type="submit">Замовити доставку</button>
        </form>
    </div>
<div class="theme-switch-wrapper">
    <label class="theme-switch" for="checkbox">
        <input type="checkbox" id="checkbox" />
        <div class="slider round"></div>
    </label>
    <em>Темна тема</em>
</div>

    <script>
        $("#form").submit(function (e) {
            let formName = $("#name").val();
            let formPhone = $("#phone").val();
            let formAddress = $("#address").val();
            let isUrgent = $("#urgentDelivery").is(":checked");

            if (formName.length === 0 || formAddress.length === 0) {
                alert("Введіть правильно усі дані.");
                e.preventDefault();
            } else {
                $("#formPrice").val(isUrgent ? 350 : 250);
            }
        });
    </script>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const urgentDeliveryCheckbox = document.getElementById('urgentDelivery');
			const formPriceInput = document.getElementById('formPrice');
			const modalPaySpan = document.getElementById('modalPay');
			const initialPrice = 250;

			formPriceInput.value = initialPrice;
			modalPaySpan.textContent = initialPrice;

			urgentDeliveryCheckbox.addEventListener('change', function () {
				if (this.checked) {
					formPriceInput.value = initialPrice + 100;
				} else {
					formPriceInput.value = initialPrice;
				}

				modalPaySpan.textContent = formPriceInput.value;
			});
		});
	</script>
	<script>
		const checkbox = document.getElementById('checkbox');
		const body = document.body;
		const ticketItem = document.querySelector('.ticket-list .ticket-item');

		checkbox.addEventListener('change', () => {
			body.classList.toggle('dark-theme');
			ticketItem.classList.toggle('dark-theme');
		});

	</script>
</body>
</html>