<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>YOUR NAME Grocery Order Processing</title>
</head>
<body>

<?php
/** If you're developing locally on WINDOWS, uncomment the following line **/
//include 'include/money_format_windows.php';
include 'include/db_connect.php';
setlocale(LC_MONETARY, 'en_US');

session_start();

/** Get customer id **/
$custId = null;
if(isset($_GET['customerId'])){
	$custId = $_GET['customerId'];
} 
if($custId == null){
	echo "<h1>No ID entered</h1>";
	die();
}
//get customer password
$custPass = "";
if(isset($_GET['custPass'])){
	$custPass = $_GET['custPass'];
}
if($custPass == ""){
	echo "<h1>No password entered</h1>";
	die();
}
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
}

//Obtain order total, or calculate it
if (isset($_SESSION['total'])){
	$total = $_SESSION['total'];
} elseif (!is_null($productList) || !empty($productList)){
	$total = 0;
	foreach ($productList as $product){
		$total += $product['price'] * $product['quantity'];	
	}
} else {
	$total = 0;
}

/** Make connection and validate **/
$conn = sqlsrv_connect( $server, $connectionInfo);

if( $conn ) {
     //echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}

//Grab password
$cpass_sql = "SELECT password FROM Customer WHERE customerId = ".$custId."";
$cpass_stmt = sqlsrv_query($conn, $cpass_sql);
if( $cpass_stmt === false )
	die( print_r( sqlsrv_errors(), true));
if( sqlsrv_fetch( $cpass_stmt ) === false)
	die( print_r( sqlsrv_errors(), true));
$cpass = sqlsrv_get_field($cpass_stmt, 0);

//authenticate user
if ($custPass != $cpass){
	echo "<h1>That's an invalid password! Go back and try again!</h1>";
	die();
}

//Obtain max customer Id
$max_cust_sql = "SELECT MAX(customerId) FROM Customer";
$max_cust_stmt = sqlsrv_query($conn, $max_cust_sql);
if( $max_cust_stmt === false )
     die( print_r( sqlsrv_errors(), true));
 if( sqlsrv_fetch( $max_cust_stmt ) === false)
     die( print_r( sqlsrv_errors(), true));
$max_custId = sqlsrv_get_field($max_cust_stmt, 0);
//echo "max cust id ".$max_custId;
 
/**
Determine if valid customer id was entered
Determine if there are products in the shopping cart
If either are not true, display an error message
**/
if (is_null($custId) || !is_numeric($custId) || $custId < 1 || $custId > $max_custId){
	echo "<h1>Invalid customer id.  Go back to the previous page and try again.</h1>";
	die ();
} else if (is_null($productList) || empty($productList)){
	echo "<h1>Your shopping cart is empty!</h1>";
	die ();	
}

/** Save order information to database**/
/** Update total amount for order record **/
$sql = "INSERT INTO Orders OUTPUT INSERTED.orderId VALUES( ".$custId.", ".$total." )";
$pstmt = sqlsrv_query( $conn, $sql );
if(!sqlsrv_fetch($pstmt)){
	die( print_r( sqlsrv_errors(), true));
}
$orderId = sqlsrv_get_field($pstmt,0);

/** Insert each item into OrderedProduct table using OrderId from previous INSERT **/
if(!is_null($productList) || !empty($productList)){
	foreach ($productList as $product){
		$sql = "INSERT INTO OrderedProduct VALUES( ".$orderId.", ".$product['id'].", ".$product['quantity'].", ".$product['price']." )";
		$pstmt = sqlsrv_query( $conn, $sql );
	}
}

/** Print out order summary **/
if (!is_null($productList) || !empty($productList)){
	echo "<h1>Your Order Summary</h1>";
	echo "<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th><th>Price</th><th>Subtotal</th></tr>";
	foreach ($productList as $product)
		echo "<tr><td align=\"center\">".$product['id']."</td><td align=\"center\">".$product['name']."</td><td align=\"center\">".$product['quantity']."</td><td align=\"center\">".str_replace("USD","$",money_format('%i',$product['price']))."</td><td align=\"center\">".str_replace("USD","$",money_format('%i',$product['price']))."</td></tr>";
	echo "<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"center\">".str_replace("USD","$",money_format('%i',$total))."</td></tr></table>";
	echo "<h3>Order completed. Your order will be shipping soon.</h3>";
	echo "<h3>Your order reference number is: ".$orderId."</h3>";
	echo "<h3>Shipping to customer: ".$custId."</h3>";
	//Grab cname
	$cname_sql = "SELECT cname FROM Customer WHERE customerId=".$custId."";
	$cname_stmt = sqlsrv_query($conn, $cname_sql);
	if( $cname_stmt === false )
		die( print_r( sqlsrv_errors(), true));
	if( sqlsrv_fetch( $cname_stmt ) === false)
		die( print_r( sqlsrv_errors(), true));
	$cname = sqlsrv_get_field($cname_stmt, 0);
	echo "<h3>Name: ".$cname."</h3>";
}
/** Clear session/cart **/
$_SESSION = array();
sqlsrv_close($conn);
?>
</body>
</html>

