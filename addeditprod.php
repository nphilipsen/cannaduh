<?php
  include 'include/db_connect.php';

  // $productName = null;
  // $strain = null;
  // $potencyThc = null;
  // $potencyCbd = null;
  // $price = null;
  // $description = null;
  // $stock = null;
  // $isLimited = null;
  // $supplierId = null;

  if (isset($_POST['productName'])&& isset($_POST['strain'])){
    if ($_POST['product'] == 'new'){
      $sql  = $connection->prepare("INSERT INTO Product(productName, strain, potencyThc, potencyCbd, price, description, stock, isLimited, supplierId) VALUES (?,?,?,?,?,?,?,?,?)");
      $sql->bind_param("ssiiisiii", $_POST['productName'], $_POST['strain'], $_POST['potencyThc'], $_POST['potencyCbd'], $_POST['price'], $_POST['description'], $_POST['stock'], $_POST['isLimited'], $_POST['supplierId']);
      if ($sql->execute())
        echo "<script language='javascript'>alert(\"".$_POST['productName']." added\");window.location.replace('adminAccount.php');</script>";
      else
        echo "<script language='javascript'>alert(\"".$_POST['productName']." not added, please contact an admistrator\");window.location.replace('adminAccount.php');</script>";
    }else {
      $fieldname = implode("", array_keys($_POST));
      die ($fieldname);
      $sql  = $connection->prepare("INSERT INTO Product(?) VALUES (?)");
      $sql->bind_param(".gettype($_POST[$fieldname])[0].", $_POST[$fieldname]);
      if ($sql->execute())
        echo "<script language='javascript'>alert('$fieldname changed');window.location.replace(adminAccount.php);</script>";
      else
        echo "<script language='javascript'>alert('$fieldname not changed, please contact an admistrator');window.location.replace(adminAccount.php);</script>";
    }
  }else {
    echo "<script language='javascript'>alert('Product Name and strain are mandatory');window.location.replace(adminAccount.php);</script>";
  }
?>
