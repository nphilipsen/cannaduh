<!DOCTYPE html>
<html>
<head>
<title>Your Shopping Cart</title>
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
</head>
<body>
<?php include 'header.php'; 
include 'include\money_format_windows.php'; ?>
<div class="content-container">
<div class="page-layout">
    <div class="sidebar">
    </div>

<table cellpadding="2" cellspacing="2" border="1">
	<tr>
		<th>Option</th>
		<th>Id</th>
		<th>Name</th>
		<th>Price</th>
		<th>Quantity</th>
		<th>Subtotal</th>
	</tr>
	