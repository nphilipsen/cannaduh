
<?php
include 'sessionCheck.php';
include 'include/db_connect.php';
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
} else{ 	// No products currently in list.  Create a list.
	$productList = array();
}

// Add new product selected
// Get product information
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$pst = $connection->prepare("SELECT productName, price FROM Product WHERE productId = ?");
	$pst->bind_param('i',$id);
	$pst->execute();
	$pst->store_result();
	$pst->bind_result($name, $price);
	$pst->fetch();
} else {
	header('Location: listprod.php');
}

// Update quantity if add same item to order again
if (isset($productList[$id])){
	$productList[$id]['quantity'] = $productList[$id]['quantity'] + $_GET['q'];
} else {
	$productList[$id] = array( "id"=>$id, "name"=>$name, "price"=>$price, "quantity"=>$_GET['q'] );
}

$_SESSION['productList'] = $productList;
header('Location: cart.php');
?>
