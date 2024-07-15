<?php
    include_once "connection.php";
?>
       
 <!-- nav -->
<div class="nav_section">
<nav  class="navbar navbar-expand-lg navbar-light px-5">
    
    <a class="navbar-brand ml-5" href="./adminhome.php">
        <h2>Fruitopia</h2>
    </a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0"></ul>

    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success" >
                <h3>
                    <?php 
                        //echo $_SESSION['success']; 
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
    <?php endif ?>

    <!-- logged in user information -->
    <div class="user-cart">
        <ul class="navbar-nav">
            <?php  if (isset($_SESSION['user'])) : ?>
                <li class="nav-item active">
                    <a class='link' href="create_user.php"><button> Add user </button></a>
                </li>
                <li class="nav-item active">
                    <a href="adminhome.php?logout='1'"><button>Logout</button></a>
                </li>
                <li class="nav-item active">
                    <strong class="user"><?php echo $_SESSION['user']['username']; ?></strong>
                </li>
            <?php endif ?>
        </ul>
    </div>

    <!-- styling the admin icon -->
    <div class="user-cart">  
        <?php           
        if(isset($_SESSION['user'])){
          ?>
          <a href="" style="text-decoration:none;">
            <i class="fa fa-user mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
         </a>
          <?php
        } else {
            ?>
            <a href="" style="text-decoration:none;">
                    <i class="fa fa-sign-in mr-5" style="font-size:30px; color:#fff;" aria-hidden="true"></i>
            </a>

            <?php
        } ?>
    </div>  
</nav>
</div>
