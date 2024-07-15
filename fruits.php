<?php
  require('functions.php');
?>

<?=section_header('Fruits','sub_page')?>
<?=navigation_section()?>

  <!-- fruit section -->
<section class="fruit_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <hr>
      <h2>
        Fresh Fruit
      </h2>
    </div>
  </div>

  <!-- displaying each element in the fruits table -->
  <div class="container-fluid">
    <div class="fruit_container">
        <?php
          $stmt = $con->prepare('SELECT * FROM fruits');
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()):
        ?>

      <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
        <div class="card-deck">
          <div class="card p-2 border-secondary mb-2">
            <img src="<?= $row['img'] ?>" class="card-img-top" height="300">
            <div class="card-body p-1">
              <h4 class="card-title text-center text-info"><?= $row['name'] ?></h4>
              <h5 class="card-text text-center text-danger">Rs&nbsp;&nbsp;<?= number_format($row['retailprice'],2) ?>/kg</h5>
            </div>
            <div class="card-footer p-1">
              <form action="" class="form-submit">
                <div class="row p-2">
                    <div class="col-md-6 py-1 pl-4">
                      <b>Quantity : </b>
                    </div>
                    <div class="col-md-6">
                      <input type="number" class="form-control pqty" min="1" value=1>
                    </div>  
                </div>
                <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                <input type="hidden" class="pname" value="<?= $row['name'] ?>">
                <input type="hidden" class="pprice" value="<?= $row['retailprice'] ?>">
                <input type="hidden" class="pimage" value="<?= $row['img'] ?>">
                <input type="hidden" class="pcode" value="<?= $row['code'] ?>">
                <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to
                  cart</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile; ?>
    </div>
    </div>
  </div>
</section>

  <!-- end fruit section -->
<script type="text/javascript" src="js/loadcart.js"></script>

<?=section_footer()?>