<?php
  include 'include/db_connect.php';
  $sql = $connection->prepare("SELECT supplierName, supplierId FROM Supplier");

  if ($sql->execute()){
    $sql->bind_result($suppname, $suppId);
    while($sql->fetch()){
      echo "<option value='$suppId'>$suppname</option>";
    }
  }else {
    echo "<script language='javascript'>alert('Something went wrong, please contact an administrator')</script>";
  }
?>
