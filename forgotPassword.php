<!DOCTYPE html>
<html>
<head>
<title>Welcome to CANNADUH</title>
</head>
<body>

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
		
</body>
</html>