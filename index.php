<?php
include("db.php");

$districts = $mysql->query("SELECT * FROM districts");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Доставка від Стасяня та Сурена</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">  
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <meta charset="utf-8">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <div class="logo">
        <a href="index.php" draggable="false"><img src="sources/img/logo.png" draggable="false" alt=" ">SS-Delivery</a>
    </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item links">
          <a href="check.php">Перевірити статус замовлення</a>
        </li>
        <li class="nav-item links">
          <div class="cart-btn"><span class="material-icons-round"> shopping_cart </span></div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="theme-switch-wrapper">
    <label class="theme-switch" for="checkbox">
        <input type="checkbox" id="checkbox" />
        <div class="slider round"></div>
    </label>
    <em>Темна тема</em>
</div>

<div class="ticket-slider">
    <h1 class="title">Виберіть район:</h1>
    <div class="ticket-list row">
        <?php if ($districts->num_rows != 0) { ?>
            <?php while ($district = $districts->fetch_array()) { ?>
                <div class="col-md-3">
                    <a style="display:block" href="field.php?id=<?php echo $district['id']; ?>">
                        <div class="ticket-item text-center">
                            <img src="sources/img/ticket.png" alt="" class="img-fluid">
                            <p class="ticket-name"><?php echo $district['name'] ?></p>
                            <div class="buy-item">
                                <div class="btn-add">Choose</div>
                                <span class="price"><?php echo $district['price_from']; ?> &#8372 - <?php echo $district['price_to']; ?> &#8372</span>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h2>Немає районів</h2>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script>
    const checkbox = document.getElementById('checkbox');
    const body = document.body;

    checkbox.addEventListener('change', () => {
        body.classList.toggle('dark-theme');
    });
</script>
</body>
</html>
