<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Canna-duh Dispensary Order List</title>
</head>
<body>
 
<h1>Order List</h1>

<?php
/** If you're developing locally on WINDOWS, uncomment the following line **/
//include 'include/money_format_windows.php';
include 'include/db_credentials.php';
setlocale(LC_MONETARY, 'en_US');

/** Create connection, and validate that it connected successfully **/
$conn = sqlsrv_connect( $server, $connectionInfo);

if( $conn ) { 
     echo "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
}
/**
Useful code for formatting currency:
	str_replace("USD","$",money_format('%i',"YOUR STRING HERE"))
**/
echo "<table border=\"1\"><tr><th>Order Id</th><th>Customer Id</th><th>Customer Name</th><th>Total Amount</th></tr>";
/** Write query to retrieve all order headers **/
$orders_sql = "SELECT orderId, Orders.customerId, cname, totalAmount FROM Orders JOIN Customer ON Orders.customerId = Customer.customerId";
$orders_stmt = sqlsrv_query($conn,$orders_sql);
if( $orders_stmt === false )
     die( print_r( sqlsrv_errors(), true));


// For each order in the results
while ($orders_row = sqlsrv_fetch_array( $orders_stmt, SQLSRV_FETCH_ASSOC)){
		//Print out the order header information
		$orderId = $orders_row['orderId'];
		echo ("<tr><td>".$orderId."</td><td>".$orders_row['customerId']."</td><td>".$orders_row['cname']."</td><td>".str_replace("USD","$",money_format('%i',$orders_row['totalAmount']))."</td></tr>");
		//Write a query to retrieve the products in the order
		$product_sql = "SELECT productId, quantity, price FROM OrderedProduct WHERE orderId = ?";
		$product_params = array(&$orderId);
			//- Use sqlsrv_prepare($connection, $sql, array( &$variable ) 
				//and sqlsrv_execute($preparedStatement) 
				//so you can reuse the query multiple times (just change the value of $variable)
		$product_stmt = sqlsrv_prepare($conn, $product_sql, $product_params);
		if (!$product_stmt) {
			die( print_r( sqlsrv_errors(), true));
		}
		//For each product in the order
		if (sqlsrv_execute($product_stmt)) {
			echo "<tr align=\"right\"><td colspan=\"4\"><table border=\"1\"><th>Product Id</th> <th>Quantity</th> <th>Price</th></tr>";
			//Write out product information 
			while ($product_row = sqlsrv_fetch_array($product_stmt, SQLSRV_FETCH_BOTH))
				echo "<tr><td>".$product_row[0]."</td><td>".$product_row[1]."</td><td>".str_replace("USD","$",money_format('%i',$product_row[2]))."</td></tr>";
			echo "</table></td></tr>";
		} else {
			die( print_r( sqlsrv_errors(), true));
		}
}

/** Close connection **/
sqlsrv_close($conn);
?>

</body>
</html>

