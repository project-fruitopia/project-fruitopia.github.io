<?php 
  require 'functions.php';
?>

<?=section_header('Home','')?>
<?=slider_section()?>
<?=navigation_section()?>

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


<strong>
<!-- message -->
<?php if (isset($_SESSION['msg'])) : ?>
  <div class="error success" style="text-align:center" >
      <?php 
        echo $_SESSION['msg']; 
        unset($_SESSION['msg']);
      ?>
  </div>
<?php endif ?>
</strong>


<!-- shop section -->

<section class="shop_section layout_padding">
  <div class="container">
    <div class="box">
      <div class="detail-box">
        <h2>
          Fruit shop
        </h2>
        <p>
          Fruitopia provides a variety of exotic fruits
        </p>
      </div>
      <div class="img-box">
        <img src="images/shop-img.jpg" alt="">
      </div>
      <div class="btn-box">
        <a href="fruits.php">
          Click to discover
        </a>
      </div>
    </div>
  </div>
</section>

<!-- end shop section -->

<!-- about section -->

<section class="about_section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 px-0">
        <div class="img-box">
          <img src="images/about-img.jpg" alt="">
        </div>
      </div>
      <div class="col-md-5">
        <div class="detail-box">
          <div class="heading_container">
            <hr>
            <h2>
              About Our Fruit Shop
            </h2>
          </div>
          <p>
            Our selection includes seasonal delights such as juicy watermelons, sweet mangoes, crisp apples, and a colorful array of berries.
          </p>
          <a href="about.php">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<?=section_testimonial()?>

<?=section_contact()?>

<?=section_info()?>

<?=section_footer()?>

?>
