<?php
	session_start();
	include 'include/db_connect.php';
	
    if ($_SESSION['loggedIn'] === true){
      echo "<title>Canna-Duh Account</title>";
    }else{
      header('Location:login.php');
    exit();
    }

	$errors = [];

	$fileExtensions = ['jpeg','jpg','png'];
	$fileName = $_FILES['profile']['name'];
	$fileSize = $_FILES['profile']['size'];
	$fileTmpName  = $_FILES['profile']['tmp_name'];
	$fileType = $_FILES['profile']['type'];
	$fileExtension = strtolower(end(explode('.',$fileName)));
	echo $fileExtension;
	if (isset($_POST['submit'])) {

        if (! in_array($fileExtension,$fileExtensions)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors)) {
 
        	$pst = $connection->prepare("UPDATE Users SET profImg = '".$connection->real_escape_string(file_get_contents($fileTmpName))."', profImgType = '$fileType' WHERE userName = ?");
			$pst->bind_param( "s", $_SESSION['userName']);
			$pst->execute();
			header('Location:account.php');
			exit();

        } else{
        	echo "<p>The following errors occured:</p>";
        	foreach ($errors as $error) {
                echo $error."\n";
            }
        }
    }
?>