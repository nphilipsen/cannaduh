<?php 
session_start();
if ($_SESSION['loggedIn'] === true){
	header('Location: shop.php');
	exit();
} else{
	header('Location:login.php');
	exit();
}
?>
