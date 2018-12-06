<?php
  include 'include/db_connect.php';
  $sql = $connection->prepare("SELECT DISTINCT strain FROM Product");

  if ($sql->execute()){
    $sql->bind_result($strain);
    while($sql->fetch()){
      echo "<option value='$strain'>$strain</option>";
    }
  }else {
    echo "<script language='javascript'>alert('Something went wrong, please contact an administrator')</script>";
  }
?>
