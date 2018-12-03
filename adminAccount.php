<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php
    session_start();
	include 'include/db_connect.php';

    if ($_SESSION['loggedIn'] === true){
      echo "<title>Canna-Duh Account</title>";
    }else{
      header('Location:login.php');
    exit();
    }
?>
<link href="css/account.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?php include 'header.php'; ?>

  <div class="page-layout">
    <div class="sidebar">
      <h1 class="sidebar-item">Admin</h1>
<<<<<<< HEAD
      <a class="link" href="#orders" data-link="orders">Order History</a>
      <a class="link" href="#users" data-link="users">User List</a>
      <a class="link" href="#editprod" data-link="editprod">Add/Edit Product</a>
      <a class="link" href="#editsupp" data-link="editsupp">Add/Edit Supplier</a>
=======
      <a class="link" href="#orders" data-link="orders">Order History</a></li>
      <a class="link" href="#users" data-link="users">User List</a></li>
      <a class="link" href="#settings" data-link="editprod">Add/Edit Product</a></li>
	    <a class="link" href="#settings" data-link="editsupp">Add/Edit Supplier</a></li>
>>>>>>> 4d5b9c8f393078a825da68f131b20eb0f7d1f016
    </div>
    <div class="content-container">

	   <div class="content-area" data-link="orders">
        <div class="content-header">
          <h2>Order List</h2>
        </div>
        <div class="content">

    	<?php
      		$pst = $connection->prepare("SELECT orderId, userName, cartId from Orders");
			$pst->execute();
			$pst->store_result();
			$pst->bind_result($orderId,$userName,$cartId);

			while ($pst->fetch()){
			echo "<p>Order Id: $orderId</p>";
			echo "<p>User Name: $userName</p>";
			echo "<p>Cart Id: $cartId</p>";
			}
      	?>
      </div>
    </div>
      <div class="content-area" data-link="users">
        <div class="content-header">
          <h2>User List</h2>
        </div>
        <div class="content">

    	<?php
      		$pst = $connection->prepare("SELECT userName, firstName, lastName, age, address, city, province, postal, email, phoneNum from Users");
			$pst->execute();
			$pst->store_result();
			$pst->bind_result($userName,$firstName,$lastName,$age,$address,$city,$province,$postal,$email,$phoneNum);

			while ($pst->fetch()){
			echo "<p>User Name: $userName</p>";
			echo "<p>First Name: $firstName</p>";
			echo "<p>Last Name: $lastName</p>";
			echo "<p>Age: $age</p>";
			echo "<p>Address: $address</p>";
			echo "<p>City: $city</p>";
			echo "<p>Province: $province</p>";
			echo "<p>Postal Code: $postal</p>";
			echo "<p>Email: $email</p>";
			echo "<p>Phone Number: $phoneNum</p>";
			}
      	?>


        </div>
       </div>
      <div class="content-area" data-link="editprod">
        <div class="content-header">
          <h2>Add/Edit Products</h2>
        </div>
        <div class="content">
<<<<<<< HEAD
		      <form method='post' action='addeditprod.php'>
            <label for='product'>Choose a product to edit:</label>
            <select name='product'>
              <option value='' selected>--Select Product--</option>
              <option value='new'>Add new product</option>
              <?php include 'productList.php'; ?>
            </select>
            <p>Enter Product Name: *<input type="text" name="productName"></p>
			      <p>Enter Strain: *<input type="text" name="strain"></p>
			      <p>Enter Potency THC: <input type="number" min='0' max='100' name="potencyThc"></p>
			      <p>Enter Potency CBD: <input type="number" min='0' max='100' name="potencyCbd"></p>
            <p>Enter Price: <input type="number" name="price"></p>
            <p>Enter Description: <input type="text" name="description"></p>
            <p>Enter Stock: <input type="number" name="stock" value='1'></p>
            <p>Check if stock is limited: <input type="checkbox" name="isLimited"></p>
            <!-- <select name='supplierId'> -->

            <!-- </select>  -->
=======
		      
          <form method='post' action='addeditprod'>
            <p>Enter Product ID: <input type="number" name="productId"></p>
            <p>Enter Product Name: <input type="number" name="productName"></p>
			      <p>Enter Strain: <input type="number" name="strain"></p>
			      <p>Enter Potency THC: <input type="number" name="potencyThc"></p>
			      <p>Enter Potency CBD: <input type="number" name="potencyCbd"></p>
            <p>Enter Price: <input type="number" name="price"></p>
            <p>Enter Description: <input type="number" name="description"></p>
>>>>>>> 4d5b9c8f393078a825da68f131b20eb0f7d1f016
            <p>Enter Supplier ID: <input type="number" name="supplierId"></p>
            <button type='submit'>Submit</button>
          </form>
          <form action="productImgUpload.php" method="post" enctype="multipart/form-data">
            <label for='productName'>Choose a product to edit:</label>
            <select name='productName'>
              <option value='' selected>--Select Product--</option>
              <?php include 'productList.php'; ?>
            </select>
            <p><input type="file" name="prodImg" id="profileImgUpload"></p>
            <p><input type="submit" name="submit" value="Upload File Now" ></p>
          </form>

		  </div>
<<<<<<< HEAD
    </div>
      <div class="content-area" data-link="editsupp">
=======
    </div>	
	      <div class="content-area" data-link="editsupp">
>>>>>>> 4d5b9c8f393078a825da68f131b20eb0f7d1f016
        <div class="content-header">
          <h2>Add/Edit Supplier</h2>
        </div>
        <div class="content">
		      
          <form action="productImgUpload.php" method="post" enctype="multipart/form-data">
            <p>Enter Supplier ID: <input type="numeric" name="supplierId"></p>
            <p>Enter Supplier Name: <input type="numeric" name="supplierName"></p>
			      <p>Enter Address: <input type="numeric" name="address"></p>
			      <p>Enter City: <input type="numeric" name="city"></p>
			      <p>Enter Postal Code: <input type="numeric" name="postalCode"></p>
			      <p>Enter Province: <input type="numeric" name="province"></p>
			      <p>Enter Email: <input type="numeric" name="email"></p>
			      <p>Enter Phone Number: <input type="numeric" name="phoneNum"></p>
          </form>
		
		  </div>
    </div>
    </div>
</div>

<script type="text/javascript" src="js/adminView.js"></script>

</body>
</html>
