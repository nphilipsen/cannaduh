<?php
session_start();

if ($_SESSION['loggedIn'] == true)
	session_destroy();

header('Location:login.php');
exit();
?>
