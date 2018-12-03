<!DOCTYPE html>
<html>
<head>
<?php 
   	session_start();

   	if ($_SESSION['loggedIn'] === true){
   		echo "<title>Canna-Duh Dispensary Checkout</title>";
   	}else{
  		header('Location:login.php');
		exit();
   	}
?>
</head>
<body>

<h1>Enter your customer ID and password to complete the transaction:</h1>

<form method="get" action="order.php">
<p>ID</p><p><input type="text" name="customerId" size="50"></p>
<p>Password</p><p><input type="password" name="custPass" size="50"></p>
<input type="submit" value="Submit"><input type="reset" value="Reset">
</form>

</body>
</html>

