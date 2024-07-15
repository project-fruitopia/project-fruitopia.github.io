<?php include('functions.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <header>Sign Up</header>
            <form action="register.php" method="post">

                <div style ="color:red; text-align:center"><?php echo display_error(); ?></div>

                <div class="field input">
                    <label style="color:#f5f5f5" for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Enter a username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label style="color:#f5f5f5" for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter a valid email address" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label style="color:#f5f5f5" for="password">New Password</label>
                    <input type="password" name="password_1" id="password_1" placeholder="Enter a new password" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label style="color:#f5f5f5" for="password">Confirm Password</label>
                    <input type="password" name="password_2" id="password_2" placeholder="Confirm password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="register_btn" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="login.php">Sign In</a>
                </div>
            </form>
        </div>
      </div>
</body>
</html>