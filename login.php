<!DOCTYPE html>
<html>
<head>
<title>Welcome to CANNADUH</title>
</head>
<body>

<h1>Enter your user name and password to enter the store:</h1>

<form method="post" action="validateLogin.php">
<div class="input.group">
	<p>User Name</p><p><input type="text" name="userName" size="50"></p>
	<p>Password</p><p><input type="password" name="userPass" size="50"></p>
	<input type="submit" value="Submit"><input type="reset" value="Reset">
</div>
<p>
	Not yet a member? <a href="registerUser.php">Sign up</a>
</p>	
<p>	
	Forgot Password? <a href="forgotPassword.php">Reset Password</a>
</p>

</form>

</body>
</html>