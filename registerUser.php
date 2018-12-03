<!DOCTYPE html>
<html>
<head>
<title>Welcome to CANNADUH</title>
</head>
<body>

<h1>If you don't have an account, sign up here!</h1>


<form method="post" action="registerUser.php">
<div class="input.group">
	<p>Starred fields are required</p>
	<p>User Name*</p><p><input type="text" name="userName" size="50"></p>
	<p>Password*</p><p><input type="password" name="password" size="50"></p>
	<p>Email</p><p><input type="text" name="email" size="50"></p>
	<p>First Name</p><p><input type="text" name="firstName" size="50"></p>
	<p>Last Name</p><p><input type="text" name="lastName" size="50"></p>
	<p>Age</p><p><input type="number" name="age" size="50"></p>
	<p>Province</p><p><input type="text" name="province" size="50"></p>
	<p>City</p><p><input type="text" name="city" size="50"></p>
	<p>Address</p><p><input type="text" name="address" size="50"></p>
	<p>Postal Code</p><p><input type="text" name="postal" size="50"></p>
	<p>Phone Number</p><p><input type="text" name="phoneNum" size="50"></p>
	<input type="submit" value="Submit"><input type="reset" value="Reset">
</div>
<p>
	Already a member? <a href="login.php">Login</a>
</p>	
</form>


<?php
include 'include/db_connect.php';
$thedeets = array('email'=>null, 'fname'=>null, 'lname'=>null, 'age'=>null, 'prov'=>null, 'city'=>null, 'addy'=>null, 'post'=>null, 'pnum'=>null);
// $email = null;
// $fname = null;
// $lname = null;
// $age = null;
// $prov = null;
// $city = null;
// $addy = null;
// $post = null;
// $pnum = null;
if (isset($_POST['userName']) && isset($_POST['password'])){
$uname = $_POST['userName'];
$pass = md5($_POST['password']);
$email = $_POST['email'];
$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$age = $_POST['age'];
$prov = $_POST['province'];
$city = $_POST['city'];
$addy = $_POST['address'];
$post = $_POST['postal'];
$pnum = $_POST['phoneNum'];
$sql = $connection->prepare("INSERT INTO Users (userName, password, firstName, lastName, age, province, city, address, postal, email, phoneNum, isAdmin) VALUES (?,?,?,?,?,?,?,?,?,?,?,0)");
$sql->bind_param("ssssissssss", $uname, $pass, $fname, $lname, $age, $prov, $city, $addy, $post, $email, $pnum);

if($sql->execute()){
	echo "<script language='javascript'>alert(\"User created\");window.location.replace('login.php');</script>";
}else{
	echo "<script language='javascript'>alert(\"User creation failed, please contact a site administrator\");window.location.replace('registerUser.php');</script>";
}
}


?>

</body>
</html>