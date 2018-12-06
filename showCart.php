<!DOCTYPE html>
<html>
<head>
<?php include 'sessionCheck.php'; ?>
</head>
<body>

<?php
// Get the current list of products
$productList = null;
if (isset($_SESSION['productList'])){
	$productList = $_SESSION['productList'];
	echo("<h1>Your Shopping Cart</h1>");
	echo("<table><tr><th>Product Id</th><th>Product Name</th><th>Quantity</th>");
	echo("<th>Price</th><th>Subtotal</th></tr>");

	$total =0;
	foreach ($productList as $id => $prod) {
		echo("<tr><td>". $prod['id'] . "</td>");
		echo("<td>" . $prod['name'] . "</td>");
		echo("<td align=\"center\">". $prod['quantity'] . "</td>");
		$price = $prod['price'];

		echo("<td align=\"right\">".$price."</td>");
		echo("<td align=\"right\">" . $prod['quantity']*$price . "</td></tr>");
		echo("</tr>");
		$total = $total + $prod['quantity']*$price;
	}
	echo("<tr><td colspan=\"4\" align=\"right\"><b>Order Total</b></td><td align=\"right\">".$total."</td></tr>");
	echo("</table>");
} else{
	echo("<h1>Your shopping cart is empty!</h1>");
}
?>
</body>
</html>
