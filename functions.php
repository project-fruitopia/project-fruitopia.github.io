<?php
session_start();
include ('connection.php');

// variable declaration
$username = "";
$email    = "";
$errors   = array();

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
  register();
}

// REGISTER USER
function register(){
  // call these variables with the global keyword to make them available in function
  global $con, $errors, $username, $email;

  // receive all input values from the form. Call the e() function
  // defined below to escape form values
  $username    =  e($_POST['username']);
  $email       =  e($_POST['email']);
  $password_1  =  e($_POST['password_1']);
  $password_2  =  e($_POST['password_2']);

  //verifying the unique email
  $verify_query = mysqli_query($con,"SELECT email FROM users WHERE email='$email'");

  if (mysqli_num_rows($verify_query)!=0 ) {
          array_push($errors, "This email is already used, please try another one");
  }
  // form validation: ensure that the form is correctly filled
  if (empty($username)) { 
          array_push($errors, "Username is required"); 
  }
  if (empty($email)) { 
          array_push($errors, "Email is required"); 
  }
  if (empty($password_1)) { 
          array_push($errors, "Password is required"); 
  }
  if ($password_1 != $password_2) {
          array_push($errors, "The two passwords do not match");
  }


  // register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database

    if (isset($_POST['user_type'])) {
      $user_type = e($_POST['user_type']);
      $query = "INSERT INTO users (username, email, user_type, password) 
                        VALUES('$username', '$email', '$user_type', '$password')";
      mysqli_query($con, $query);
      $_SESSION['success']  = "New user successfully created!!";

      echo "<div class='message'>
            <p>Registration successful!</p>
        </div> <br>";
      echo "<a href='login.php'><button class='btn'>Login Now</button>";

      header('location: adminhome.php');
    }else{
      $query = "INSERT INTO users (username, email, user_type, password) 
                        VALUES('$username', '$email', 'user', '$password')";
      mysqli_query($con, $query);

      // get id of the created user
      $logged_in_user_id = mysqli_insert_id($con);

      $_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
      $_SESSION['success']  = "You are now logged in";

      echo "<div class='message'>
            <p>Registration successful!</p>
        </div> <br>";
      echo "<a href='index.php'><button class='btn'>Login Now</button>";

      header('location: index.php');                          
    }
  }
}

// return user array from their id
function getUserById($id){
  global $con;
  $query = "SELECT * FROM users WHERE id=" . $id;
  $result = mysqli_query($con, $query);

  $user = mysqli_fetch_assoc($result);
  return $user;
}

// escape string
function e($val){
  global $con;
  return mysqli_real_escape_string($con, trim($val));
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
        login();
}

// LOGIN USER
function login(){
  global $con, $username, $errors;

  // grap form values
  $username = e($_POST['username']);
  $password = e($_POST['password']);

  // make sure form is filled properly
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  // attempt login if no errors on form
  if (count($errors) == 0) {
    $password = md5($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $results = mysqli_query($con, $query);

    if (mysqli_num_rows($results) == 1) { // user found
      // check if user is admin or user
      $logged_in_user = mysqli_fetch_assoc($results);
      if ($logged_in_user['user_type'] == 'admin') {

        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: adminhome.php');            
      }else{
        $_SESSION['user'] = $logged_in_user;
        $_SESSION['success']  = "You are now logged in";
        header('location: index.php');
      }
    }else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

//display error in login and register forms
function display_error() {
  global $errors;

  if (count($errors) > 0){
    echo '<div class="error">';
    foreach ($errors as $error){
      echo $error .'<br>';
    }
    echo '</div>';
  }
}     

//check if user is logged in
function isLoggedIn()
{
  if (isset($_SESSION['user'])) {
    return true;
  }else{
    return false;
  }
}

//check if the user is admin
function isAdmin()
{
  if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
    return true;
  }else{
    return false;
  }
}

//Section header
function section_header($title,$class){
echo <<<EOT
<!DOCTYPE html>
<html>
<head>
	<!-- Basic -->
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<!-- Site Metas -->
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="author" content="" />

	<title>$title</title>

	<!-- ajax stylesheets -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <!-- angular js -->
  <script src= "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>

  <!-- jquery --> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script>

	<!-- bootstrap core css -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

	<!-- fonts style -->
	<link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />

	<!-- Custom styles -->
	<link href="css/style.css" rel="stylesheet" />

	<!-- responsive style -->
	<link href="css/responsive.css" rel="stylesheet" />

	<!--js scripts-->
	<script src="js/js/validation.js"></script>
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript">
  (function(d, t) {
      var v = d.createElement(t), s = d.getElementsByTagName(t)[0];
      v.onload = function() {
        window.voiceflow.chat.load({
          verify: { projectID: '668f7576a7a55549aeb0f627' },
          url: 'https://general-runtime.voiceflow.com',
          versionID: 'production'
        });
      }
      v.src = "https://cdn.voiceflow.com/widget/bundle.mjs"; v.type = "text/javascript"; s.parentNode.insertBefore(v, s);
  })(document, 'script');
  </script>

</head>
	<body class="$class">
	<header>
	  <div class="hero_area">
	    <div class="brand_box">
	      <a class="navbar-brand" href="index.php">
	        <span>
	          Fruitopia
	        </span>
	      </a>
	    </div>
    </div>
	</header>
EOT;
}


function slider_section() {
echo <<<EOT
	<section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="img-box">
              <img src="images/slider-img.jpg" width=1600 height=565 alt="">
            </div>
          </div>
          <div class="carousel-item">
            <div class="img-box">
              <img src="images/slider-img-1.jpg" width=1600 height=565 alt="">
            </div>
          </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>
    </section>
EOT;
}

function navigation_section(){
echo <<<EOT
  <section class="nav_section">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" id = "home" href="index.php">Home<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="fruits.php">Fruits</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="testimonial.php">Testimonial</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
		              <a class="nav-link" href="checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
      	        </li>
      	        <li class="nav-item">
      	          <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
      	        </li>
EOT;		    
                if (isset($_SESSION['user'])) {
echo <<<EOT
                <li class="nav-item">
                  <a style="color" class="nav-link" id="logout" href="logout.php"> Logout</a>
                </li>
EOT;
                }
                else { 
echo <<<EOT
                <li class="nav-item">
                  <a class="nav-link" id = "login"  href="login.php"> Login</a>
                </li>
EOT;
                      } 
                echo '<li class="nav-item">';
                  if (isset($_SESSION['user']))
                    echo '<strong><i><span style="color:#8fdae4" class="nav-link">'.$_SESSION['user']['username'];
          			       echo '</span></i></strong>';;
echo <<<EOT
    			           </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </section>
EOT;
}

//Info section
function section_info(){
echo <<<EOT
  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_logo">
        <h2>
          Fruitopia
        </h2>
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="">
              <img src="images/location.png" alt="">
              <span>
                Reduit, Moka Mauritius
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="images/call.png" alt="">
              <span>
                Call : +230 51234567
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="images/mail.png" alt="">
              <span>
                demo@fruitopia.com
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="info_form">
            <form action="">
              <input type="email" placeholder="Enter your email">
              <button>
                subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="info_social">
            <div>
              <a href="">
                <img src="images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
EOT;
}

//testimonial section
function section_testimonial(){
  echo <<<EOT
  <section class="client_section layout_padding">
    <div class="container ">
      <div class="heading_container">
        <h2>
          What Customers Say
        </h2>
        <hr>
      </div>
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/client-img-1.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Alicia May
                </h5>
                <p>
                  <img src="images/left-quote.png" alt="">
                  <span>
                    Ripe, juicy, and bursting with flavor
                  </span>
                  <img src="images/right-quote.png" alt=""> <br>
                  I recently purchased a batch of mangoes from this fruit shop, and they were absolutely heavenly! The fruits were ripe, juicy, and bursting with flavor. Each bite felt like a tropical paradise. Will definitely order again!
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/client-img.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  John Doe
                </h5>
                <p>
                  <img src="images/left-quote.png" alt="">
                  <span>
                    Crisp, sweet, and perfect
                  </span>
                  <img src="images/right-quote.png" alt=""> <br>
                  I'm a regular customer, and I'm always impressed by the quality of apples I receive. Crisp, sweet, and perfect for snacking. It's evident that this fruit shop takes pride in offering the best produce. Thumbs up!
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="images/client-img-2.jpg" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Rosalyn Cooper
                </h5>
                <p>
                  <img src="images/left-quote.png" alt="">
                  <span>
                    The juiciest and sweetest
                  </span>
                  <img src="images/right-quote.png" alt=""> <br>
                  I can't get enough of the watermelons from this store. They are hands down the juiciest and sweetest I've ever had. Perfect for hot summer days. My family loves them too!
                </p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>

    </div>
  </section>
  EOT;
  }

//Contact section
function section_contact(){
  echo <<<EOT
  <section class="contact_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-2 col-md-10 offset-md-1">
          <div class="heading_container">
            <hr>
            <h2>
              Request A call back
            </h2>
          </div>
        </div>
      </div>

      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1">
            <form action="">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Full Name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Email" />
                  </div>
                  <div>
                    <input type="tel" placeholder="Phone Number" />
                  </div>
                  <div>
                    <input type="text" class="message_input" placeholder="Message" />
                  </div>
                  <div>
                    <button type="submit">
                      Send
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6 px-0">
            <div class="map_container">
              <div class="map-responsive">
                <iframe src="https://maps.google.com/maps?q=Reduit,%20Moka,%20Mauritius&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  EOT;
}

// Section footer
function section_footer() {
$year=date("Y");
echo <<<EOT
<section class="container-fluid footer_section ">
    <p>
      &copy; <span id="displayYear">$year</span> All Rights Reserved.
    </p>
  </section>
  </body>
</html>
EOT;
}
?>

