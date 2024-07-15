<?php
  require 'functions.php';

  //If the user is not logged in and tries to access this page, they are automatically redirected to the index page.
  if (!isLoggedIn()) {
        $_SESSION['msg'] = "You must log in first";
        echo $_SESSION['msg'];
        header('location: index.php');
  }

	$grand_total = 0;
	$allItems = '';
	$items = [];

	$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
	$stmt = $con->prepare($sql);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($row = $result->fetch_assoc()) {
	  $grand_total += $row['total_price'];
	  $items[] = $row['ItemQty'];
	}
	$allItems = implode(', ', $items);
?>

<?=section_header('Checkout','sub_page')?>
<?=navigation_section()?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 px-4 pb-4" id="order">
      <h4 class="text-center text-info p-2">Complete your order!</h4>
      <div class="jumbotron p-3 mb-2 text-center">
        <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
        <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
        <h5><b>Total Amount Payable Rs: </b><?= number_format($grand_total,2) ?>/-</h5>
      </div>
      <form action="" method="post" id="placeOrder">
        <input type="hidden" name="products" value="<?= $allItems; ?>">
        <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
        <div class="form-group">
          <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
          <input type="email" name="email" class="form-control" placeholder="Enter E-Mail" required>
        </div>
        <div class="form-group">
          <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
        </div>
        <div class="form-group">
          <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address" required></textarea>
        </div>
        <h6 class="text-center lead">Select Payment Mode</h6>
        <div class="form-group">
          <select name="pmode" class="form-control">
            <option value="" selected disabled>-Select Payment Mode-</option>
            <option value="cod">Cash On Delivery</option>
            <option value="netbanking">Internet Banking</option>
            <option value="cards">Debit/Credit Card</option>
          </select>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block">
        </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
$(document).ready(function() {

  // Sending Form data to the server
  $("#placeOrder").submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'action.php',
      method: 'post',
      data: $('form').serialize() + "&action=order",
      success: function(response) {
        $("#order").html(response);
      }
    });
  });

  // Load total no.of items added in the cart and display in the navbar
  load_cart_item_number();

  function load_cart_item_number() {
    $.ajax({
      url: 'action.php',
      method: 'get',
      data: {
        cartItem: "cart_item"
      },
      success: function(response) {
        $("#cart-item").html(response);
      }
    });
  }
});
</script>

<?=section_footer()?>
