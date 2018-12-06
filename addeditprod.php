<?php
include 'include/db_connect.php';

if (isset($_POST['insert'])){
  if (isset($_POST['productName']) && isset($_POST['strain'])){
    if ($_POST['product'] == 'new'){
      $sql = $connection->prepare("INSERT INTO Product(productName, strain, potencyThc, potencyCbd, price, description, stock, isLimited, supplierId) VALUES (?,?,?,?,?,?,?,?,?)");
      $sql->bind_param("ssiiisiii", $_POST['productName'], $_POST['strain'], $_POST['potencyThc'], $_POST['potencyCbd'], $_POST['price'], $_POST['description'], $_POST['stock'], $_POST['isLimited'], $_POST['supplierId']);
      if ($sql->execute())
        echo "<script language='javascript'>alert(\"".$_POST['productName']." added\");window.location.replace('adminAccount.php');</script>";
      else
        echo "<script language='javascript'>alert(\"".$_POST['productName']." not added, please contact an admistrator\");window.location.replace('adminAccount.php');</script>";
    }else {
      echo "<script language='javascript'>alert('Select \'Add new product\' to insert new product into database');window.location.replace('adminAccount.php');</script>";
    }
  }else {
    echo "<script language='javascript'>alert('Product Name and Strain fields are mandatory');window.location.replace('adminAccount.php');</script>";
  }
}else if (isset($_POST['update'])){

  $sql = $connection->prepare("SELECT productId, productName, strain, potencyThc, potencyCbd, price, description, stock, isLimited, supplierId FROM Product WHERE productName = ?");
  $sql->bind_param("s", $_POST['product']);
  if ($sql->execute()){
    $sql->store_result();
    $sql->bind_result($productId, $old_productName, $old_strain, $old_potencyThc, $old_potencyCbd, $old_price, $old_description, $old_stock, $old_isLimited, $old_supplierId);
    $sql->fetch();

    if ($sql->num_rows == 0)
      echo "<script language='javascript'>alert('Product not found in database, contact administrator');window.location.replace('adminAccount.php');</script>";
  }

  $productName = ($_POST['productName'] == null) ? $old_productName : $_POST['productName'];
  $strain = ($_POST['strain'] == null) ? $old_strain : $_POST['strain'];
  $potencyThc = ($_POST['potencyThc'] == null) ? (int) $old_potencyThc : (int) $_POST['potencyThc'];
  $potencyCbd = ($_POST['potencyCbd'] == null) ? (int) $old_potencyCbd : (int) $_POST['potencyCbd'];
  $price = ($_POST['price'] == null) ? (int) $old_price : (int) $_POST['price'];
  $description = ($_POST['description'] == null) ? $old_description : $_POST['description'];
  $stock = ($_POST['stock'] == null) ? (int) $old_stock : (int) $_POST['stock'];
  $isLimited = (!isset($_POST['isLimited'])) ? (int) $old_isLimited : (int) $_POST['isLimited'];
  $supplierId = ($_POST['supplierId'] == null) ? (int) $old_supplierId : (int) $_POST['supplierId'];

  $sql = $connection->prepare("UPDATE Product SET productName = ?, strain = ?, potencyThc = ?, potencyCbd = ?, price = ?, description = ?, stock = ?, isLimited = ?, supplierId = ? WHERE productId = ?");
  $sql->bind_param("ssiiisiiii", $productName, $strain, $potencyThc, $potencyCbd, $price, $description, $stock, $isLimited, $supplierId, $productId);
  if ($sql->execute())
    echo "<script language='javascript'>alert('Changes accepted');window.location.replace('adminAccount.php');</script>";
  else
    echo "<script language='javascript'>alert('Changes not accepted, please contact an admistrator');window.location.replace('adminAccount.php');</script>";
}
?>
