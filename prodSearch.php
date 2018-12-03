<?php

	include 'include/db_connect.php';
	setlocale(LC_MONETARY, 'en_US');

	$product = "%";
	$all = array();
	$indica = array();
	$sativa = array();
	$hybrid = array();
	$access = array();

	if (isset($_GET['productName'])){
		$product = "%".$_GET['productName']."%";
	}

	$sql = $connection->prepare("SELECT * FROM Product WHERE productName LIKE ?");
	$sql->bind_param( "s", $product);
	$sql->execute();
	$sql->store_result();
	$sql->bind_result($prodId, $prodName, $strain, $potencyThc, $potencyCbd, $price, $desc, $stock, $isLimited, $prodImg, $prodImgType, $supplierId );

	while ($sql->fetch()){
		$add = "<a href=\"addcart.php?id=".$prodId."\">Add To Cart</a>";
		$prodPage = "<a href=\"productDesc.php?id=".$prodId."\">".$prodName."</a>";
		array_push($all, array($prodId, $prodName, $strain, $potencyThc, $potencyCbd, $price, $desc, $stock, $isLimited, $prodImg, $prodImgType, $supplierId, $add, $prodPage));
		if(strtolower($strain) == 'indica'){
			array_push($indica,array($prodId, $prodName, $strain, $potencyThc, $potencyCbd, $price, $desc, $stock, $isLimited, $prodImg, $prodImgType, $supplierId, $add, $prodPage));
		} 
		if(strtolower($strain) == 'sativa'){
			array_push($sativa, array($prodId, $prodName, $strain, $potencyThc, $potencyCbd, $price, $desc, $stock, $isLimited, $prodImg, $prodImgType, $supplierId, $add, $prodPage));
		}
		if(strtolower($strain) == 'hybrid'){
			array_push($hybrid, array($prodId, $prodName, $strain, $potencyThc, $potencyCbd, $price, $desc, $stock, $isLimited, $prodImg, $prodImgType, $supplierId, $add, $prodPage));
		}
			
	}

?>