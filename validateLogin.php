<?php

session_start();

$_SESSION['loggedIn'] = false;

/** Get customer id **/
$userName = null;
if(isset($_POST['userName']))
	$userName = $_POST['userName'];
if($userName == null)
	die("No user name entered");


//get customer password
$userPass = "";
if(isset($_POST['userPass']))
	$userPass = md5($_POST['userPass']);
if($_POST['userPass'] == "")
	die("No password entered");

if ($_SERVER["REQUEST_METHOD"] == "POST"){

	include 'include/db_connect.php';
	
	//query for admin account
    $admin = $connection->prepare("SELECT userName, password FROM Users WHERE userName= ? AND password = ? AND isAdmin = 1");
    $admin->bind_param( "ss", $userName,$userPass);
    $admin->execute();
    $admin->store_result();
    $rows = $admin->num_rows;
	//admin is found, set session variables and redirect
	if($rows == 1){
		$_SESSION['userName'] = $userName;
		$_SESSION['isAdmin'] = true;
		$_SESSION['loggedIn'] = true;
		header('Location: adminAccount.php');
    }else{
        //query for user account
        $user = $connection->prepare("SELECT userName, password FROM Users WHERE userName=? AND password=? AND isAdmin = 0");
        $user->bind_param( "ss", $userName,$userPass);
        $user->execute();
        $user->store_result();
        $rows = $user->num_rows;
        if($rows == 1){
			//user is found, set session variable and redirect
			$_SESSION['userName'] = $userName;
			$_SESSION['isAdmin'] = false;
			$_SESSION['loggedIn'] = true;
			header('Location: shop.php');
        }else{
			$_SESSION['errMsg'] = "<p style='color:red' align='center'> Invalid username/password! </p>";
			//username and password combo do not exist
			header('Location: login.php');
        }
	}
    mysqli_close($connection);
}else{
	//user is trying to access page indirectly, redirect to login page
	header('Location: login.php');
}


?>
