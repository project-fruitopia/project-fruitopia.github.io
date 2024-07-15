<?php
    include ('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular.min.js"></script>
    <script src="js/validation.js"></script>
    <title>Login</title>
</head>
<body ng-app="StrengthValidationApp">
  <div class="container" ng-controller="StrengthValidationCtrl">
    <div class="box form-box">
        <header>Login</header>
        <form class="form-1" action="login.php" method="post">

            <div style ="color:red; text-align:center"><?php echo display_error(); ?></div>

            <div class="field input">
                <label style="color:#f5f5f5" for="email">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter Username" autocomplete="off" required>
            </div>

            <div class="field input" >
                <label style="color:#f5f5f5" for="password" ng-style="checkpwdStrength">Password</label>
                <input type="password" name="password" id="password" ng-change="validationInputPwdText(userPassword)" placeholder="Enter Password" autocomplete="off" required>
            </div>

            <div class="text">
                <input type="checkbox" class="check" onclick="togglePwd()"> Show Password
            </div>

            <div class="field">
                <input type="submit" class="btn" name="login_btn" value="Login" required>
            </div>

            <div class="links">
                Don't have account? <a href="register.php">   Sign Up Now</a>
            </div>

            <div>
                <button class='links'><a href="index.php">Go Back</a></button>
            </div>
        </form>
    </div>
  </div>
</body>
</html>