<?php include('functions.php') ?>

<!DOCTYPE html>
<html>
<head>
<title>Create user</title>
<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
<style>
.header {
   background: #003366;
   }
   button[name=register_btn] {
   background: #003366;
}
</style>
</head>
<body>
        <div class="container">
        <div class="box form-box">
                <header>Admin - create user</header>
                <form method="post" action="create_user.php">

                <div style ="color:red; text-align:center"><?php echo display_error(); ?></div>

                <div class="field input">
                        <label style="color:#f5f5f5">Username</label>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                </div>
                <div class="field input">
                        <label style="color:#f5f5f5">Email</label>
                        <input type="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="field input">
                        <label style="color:#f5f5f5">User type</label>
                        <select class="field input" name="user_type" id="user_type" >
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                        </select>
                </div>
                <div class="field input">
                        <label style="color:#f5f5f5">Password</label>
                        <input type="password" name="password_1">
                </div>
                <div class="field input">
                        <label style="color:#f5f5f5">Confirm password</label>
                        <input type="password" name="password_2">
                </div>
                <div class="field">
                        <button type="submit" class="btn" name="register_btn"> + Create user</button>
                </div>

                <div>
                <button class='links'><a href="adminhome.php">Go Back</a></button>
                </div>
                </form>
        </div>
</body>
</html>