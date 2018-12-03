<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php 
   	session_start();

   	if ($_SESSION['loggedIn'] === true){
   		echo "<title>Canna-Duh Dispensary</title>";
   	}else{
  		header('Location:login.php');
		exit();
   	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="css/shop.css" rel="stylesheet"> 

</head>
<body>

<?php include 'header.php'; ?>
<div class="page-layout">
    <div class="sidebar">
      <h1 class="sidebar-item">Product Categories</h1>
      <a class="link" href="#all" data-link="all">All</a></li>
      <a class="link" href="#indica" data-link="indica">Indica</a></li>
      <a class="link" href="#sativa" data-link="sativa">Sativa</a></li>
      <a class="link" href="#hybrid" data-link="hybrid">Hybrid</a></li>
      <a class="link" href="#access" data-link="access">Accessories</a></li>
    </div>
    <div class="content-container">
		<h1>Search for the products you want to buy:</h1>
		<form method="get" action="shop.php">
		<input type="text" name="productName" size="50">
		<input type="submit" value="Submit"><input type="reset" value="Reset"> (Leave blank for all products)
		</form>

		<?php include 'prodSearch.php'; ?>

		<div class="content-area" data-link="all">
	        <div class="content-header">
	          <h2>All</h2>
	        </div>
	        <div class="content">
			<table><tr><th></th><th>Product Name</th><th>Strain</th><th>Price</th><th>Stock</th><th></th></tr>
			
			<?php
				foreach ($all as $a){
					echo "<tr><td>$a[12]</td><td>$a[13]</td><td>$a[2]</td><td>$a[5]</td><td>$a[7]</td><td><a href=\"productDesc.php?id=$a[0]\"><img src=\"data:".$a[10].";base64,".base64_encode($a[9])."\" class=\"thumbnail\"></a></td></tr>";
				}
			?>
			
	        </table>  
	        </div>
       </div>
       <div class="content-area" data-link="indica">
	        <div class="content-header">
	          <h2>Indica</h2>
	        </div>
	        <div class="content">
			
			<table><tr><th></th><th>Product Name</th><th>Strain</th><th>Price</th><th>Stock</th></tr>
			
			<?php
				foreach ($indica as $ind){
					echo "<tr><td>$ind[12]</td><td>$ind[13]</td><td>$ind[2]</td><td>$ind[5]</td><td>$ind[7]</td><td><a href=\"productDesc.php?id=$ind[0]\"><img src=\"data:".$ind[10].";base64,".base64_encode($ind[9])."\" class=\"thumbnail\"></a></td></tr>";
				}
			?>
			
	        </table> 
	          
	        </div>
       </div>
       <div class="content-area" data-link="sativa">
	        <div class="content-header">
	          <h2>Sativa</h2>
	        </div>
	        <div class="content">
			
			<table><tr><th></th><th>Product Name</th><th>Strain</th><th>Price</th><th>Stock</th></tr>
			
			<?php
				foreach ($sativa as $sat){
					echo "<tr><td>$sat[12]</td><td>$sat[13]</td><td>$sat[2]</td><td>$sat[5]</td><td>$sat[7]</td><td><a href=\"productDesc.php?id=$sat[0]\"><img src=\"data:".$sat[10].";base64,".base64_encode($sat[9])."\" class=\"thumbnail\"></a></td></tr>";
				}
			?>
			
	        </table> 
			
	          
	        </div>
       </div>
       <div class="content-area" data-link="hybrid">
	        <div class="content-header">
	          <h2>Hybrid</h2>
	        </div>
	        <div class="content">
			
			<table><tr><th></th><th>Product Name</th><th>Strain</th><th>Price</th><th>Stock</th></tr>
			
			<?php
				foreach ($hybrid as $hyb){
					echo "<tr><td>$hyb[12]</td><td>$hyb[13]</td><td>$hyb[2]</td><td>$hyb[5]</td><td>$hyb[7]</td><td><a href=\"productDesc.php?id=$hyb[0]\"><img src=\"data:".$hyb[10].";base64,".base64_encode($hyb[9])."\" class=\"thumbnail\"></a></td></tr>";
				}
			?>
			
	        </table> 
			
	          
	        </div>
       </div>
       <div class="content-area" data-link="accessories">
	        <div class="content-header">
	          <h2>Accessories</h2>
	        </div>
	        <div class="content">
			
			<table><tr><th></th><th>Product Name</th><th>Strain</th><th>Price</th><th>Stock</th></tr>
			
			<?php
				foreach ($access as $acc){
					echo "<tr><td>$acc[12]</td><td>$acc[13]</td><td>$acc[2]</td><td>$acc[5]</td><td>$acc[7]</td><td><a href=\"productDesc.php?id=$acc[0]\"><img src=\"data:".$acc[10].";base64,".base64_encode($acc[9])."\" class=\"thumbnail\"></a></td></tr>";
				}
			?>
			
	        </table> 
			
	          
	        </div>
       </div>
	</div>
</div>

<script type="text/javascript" src="js/shopView.js"></script>

</body>
</html>