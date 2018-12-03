<?php
  include 'include/db_connect.php';
  $sql = $connection->prepare("SELECT productName, strain FROM Product ORDER BY strain");
  // $sql->execute();
  if ($sql->execute()){
    // $sql->store_result();
    $sql->bind_result($prodname, $strain);
    $laststrain = "";
    while($sql->fetch()){
      if ($strain != $laststrain){
        if ($laststrain != ""){
          echo "</optgroup>";
        }
        echo "<optgroup label='$strain'>";
      }
      echo "<option value='$prodname'>$prodname</option>";
      $laststrain = $strain;
    }
  }else {
    echo "<script language='javascript'>alert('Something went wrong, please contact an administrator')</script>";
  }
  echo "</optgroup>";
?>
