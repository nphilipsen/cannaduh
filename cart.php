<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php include 'sessionCheck.php'; ?>
<link href="css/cart.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';?>
<div class="page-layout">
   	<div class="sidebar">
      <h1 class="sidebar-item">Cart</h1>
      <a class="link" href="checkout.php">Checkout</a>
      <a class="link" href="clearCart.php">Clear Cart</a>
      <a class="link" href="shop.php">Continue Shopping</a>
   	</div>
	<div class="content-container">
		<?php include 'showCart.php';?>
	</div>
</div>
</body>
</html>
