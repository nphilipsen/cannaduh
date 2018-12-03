<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php 
   	session_start();
   	if ($_SESSION['loggedIn'] === true){
   		echo "<title>Canna-Duh Dispensary</title>";
   	}else{
  		header('Location:login.php');
		exit();
   	}
?>
<link href="css/cart.css" rel="stylesheet"> 
</head>
<body>
<?php include 'header.php'; 
//include 'include\money_format_windows.php'; 
?>


<div class="page-layout">
   	<div class="sidebar">
   	</div>
	<div class="content-container">
		<?php include 'showCart.php';?>
		<div class="cart-form">
			<form>
		        <input type="button" onClick="location.href='checkout.php'" value="Checkout" class="form-button"/>
				<input type="button" onClick="location.href='shop.php'" value="Continue Shopping" class="form-button"/>
				<input type="button" onClick="location.href='updateQuantity.php'" value="Update Quantities" class="form-button"/>
		    </form>
		</div>
	</div>
</div>



</body>

<footer>
</footer>


</html>

