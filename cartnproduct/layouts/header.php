<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Product page</title>
    <style type="text/css">
        .container .row{
            min height: 1000px;
        }
    </style>
</head>
<body>
    <!-- Header -->
        <nav class="navbar navbar-expand-sm bg-light navbar-light" >
        <div class="container">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="product.php">Home</a>
        </li>
      <?php
  	$cart = [];
      if(isset($_COOKIE['cart'])) {
          $json = $_COOKIE['cart'];
          $cart = json_decode($json, true);
      }
      $count = 0;
      foreach ($cart as $item) {
        $count += $item['num'];
      }
      ?>
    <a href="cart.php">
    <button type="button" class= "btn btn-primary">
        cart <span class="badge badge-light"><?=$count?></span>
      </button>
    </a>
    </div>
</nav>

    