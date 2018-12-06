<?php
session_start();
if ($_SESSION['loggedIn'] === true){
  echo "<title>Canna-Duh Dispensary</title>";
}else{
  header('Location:login.php');
exit();
}
?>
