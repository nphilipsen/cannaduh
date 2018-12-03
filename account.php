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
      <h1 class="sidebar-item">Account</h1>
      <a class="link" href="#profile" data-link="profile">User Profile</a></li>
      <a class="link" href="#orders" data-link="orders">Order History</a></li>
      <a class="link" href="#settings" data-link="settings">Account Settings</a></li>
      <a class="link" href="#support" data-link="support">Change Password</a></li>
    </div>
    <div class="content-container">

    	<?php
      		$pst = $connection->prepare("SELECT profImg, profImgType FROM Users WHERE userName = ?");
			$pst->bind_param( "s", $_SESSION['userName']);
			$pst->execute();
			$pst->store_result();
			$pst->bind_result($profImg,$profImgType);
			$pst->fetch();
			$rows = $pst->num_rows;
			if($profImg == null){
				echo "<figure class=\"proFig\"><img src=\"img/default-profImg.jpeg\" alt=\"default-profImg\" class=\"profImg\"></figure>";
			}else {
				echo "<figure class=\"proFig\"><img src=\"data:".$profImgType.";base64,".base64_encode($profImg)."\" alt=\"profImg\" class=\"profImg\"></figure>";
			}
      	?>


      <div class="content-area" data-link="profile">
        <div class="content-header">
          <h2>User Profile</h2>
        </div>
        <div class="content">
		
		<?php
			$pst = $connection->prepare("SELECT firstName, lastName, age, province, city, address, postal, email, phoneNum FROM Users WHERE userName = ?");
			$pst->bind_param( "s", $_SESSION['userName']);
			$pst->execute();
			$pst->store_result();
			$pst->bind_result($fname,$lname,$age,$prov,$city,$addy,$postal,$email,$pnum);
			$pst->fetch();
			
			echo "<p>User Name: ".$_SESSION['userName']."</p>";
			echo "<p>First Name: $fname</p>";
			echo "<p>Last Name: $lname</p>";
			echo "<p>Age: $age</p>";
			echo "<p>Province: $prov</p>";
			echo "<p>City: $city</p>";
			echo "<p>Address: $addy</p>";
			echo "<p>Postal Code: $postal</p>";
			echo "<p>Email: $email</p>";
			echo "<p>Phone Number: $pnum</p>";
		?>
		
          
        </div>
       </div>
      <div class="content-area" data-link="orders">
        <div class="content-header">
          <h2>Order History</h2>
        </div>
        <div class="content">
		
		<?php
			$pst = $connection->prepare("SELECT Orders.orderId, isOpen, cartId, orderDate, shipmentDate, shipmentTotal FROM Orders JOIN Shipment ON Orders.orderId = Shipment.orderId WHERE userName = ?");
			$pst->bind_param( "s", $_SESSION['userName']);
			$pst->execute();
			$pst->store_result();
			$rows = $pst->num_rows;
			if($rows == 0){
				echo "You currently have not placed any orders.";
			}else {
				$pst->bind_result($orderId,$isOpen, $cartId, $orderDate, $shipmentDate, $shipmentTotal);
				while($pst->fetch()){
					echo "<p>Order #: $orderId</p>";
					echo "<p>Order Date: $orderDate</p>";
					if ($isOpen){
						$pst = $connection->prepare("SELECT SUM(price*quantity) AS orderTotal FROM (SELECT productId, quantity FROM Cart JOIN Orders ON Cart.cartId = Orders.cartId WHERE Orders.userName = ?) AS Contents JOIN Product ON Contents.productId = Product.productId");
						$pst->bind_param( "s", $_SESSION['userName']);
						$pst->execute();
						$pst->store_result();
						$pst->bind_result($orderTotal);
						$pst->fetch();
						echo "<p>Shipment Date: Order Pending</p>";
						echo "<p>Order Total: $orderTotal</p>";
					}else{
						echo "<p>Shipment Date: $shipmentDate</p>";
						echo "<p>Order Total: $shipmentTotal</p>";
					}
				}
			}
		?>
		
		</div>
      </div>
      <div class="content-area" data-link="settings">
        <div class="content-header">
          <h2>Account Settings</h2>
        </div>
        <div class="content">
          <form method="post" action="changeEmail.php">
            <p>
              	<label for="change-email">Change Email</label>
             	<input type="email" id="change-email" class="form-text" placeholder="Enter New Email">
            	<button type="submit" class="form-button">Submit</button>
            </p>
       	   </form>
          	<form action="profileImgUpload.php" method="post" enctype="multipart/form-data">
        	Upload a Profile Image:
        		<input type="file" name="profile" id="profileImgUpload">
        		<input type="submit" name="submit" value="Upload File Now" >
        	</form>        	
        </div>
      </div>
      <div class="content-area" data-link="support">
        <div class="content-header">
          <h2>Change Password</h2>
        </div>
        <div class="content">
          <p>
            <label for="support-ticket-textbox">We will send a password reset link to your email.</label>
          </p>
          <form method="POST" action="pass_reset.php">
              <label for="change-email">Enter Email: </label>
              <input type="email" id="email" name="email" class="form-text" placeholder="Enter Current Email" required>
              <button type="submit" class="form-button">Submit</button>
          </form>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript" src="js/account.js"></script>

</body>
</html>