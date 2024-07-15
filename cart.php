<?php
  require('functions.php');
?>

<?=section_header('Cart','sub_page')?>
<?=navigation_section()?>

<div class="cart content-wrapper">
    <div style="display:<?php if (isset($_SESSION['showAlert'])) {
          echo $_SESSION['showAlert'];
        } else {
          echo 'none';
        } 
        unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>
          <?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
          } 
            unset($_SESSION['showAlert']); ?>
        </strong>
    </div>
    <h1>Shopping Cart</h1>
    <form action="cart.php" method="post">
        <table class="center">
            <thead>
                <tr>
                    <th colspan="2">Fruit</th>
                    <th>Price/kg</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>
                    <a href="action.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'connection.php';
                    $stmt = $con->prepare('SELECT * FROM cart');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $grand_total = 0;
                    while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                    <td><img src="<?= $row['img'] ?>" width="50"></td>
                    <td><?= $row['product_name'] ?></td>
                    <td>
                      Rs&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                    </td>
                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                    <td>
                      <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                    </td>
                    <td>Rs&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                    <td>
                      <a href="action.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php $grand_total += $row['total_price']; ?>
                <?php endwhile; ?>
                <tr>
                <td colspan="3">
                  <a href="fruits.php" class="btn btn-success">Continue
                    Shopping</a>
                </td>
                <td colspan="2"><b>Grand Total</b></td>
                <td><b>Rs&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                <td>
                  <a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp;Checkout</a>
                </td>
              </tr>
            </tbody>
        </table>
    </form>
</div>

<script type="text/javascript">
$(document).ready(function() {

// Change the item quantity
$(".itemQty").on('change', function() {
  var $el = $(this).closest('tr');

  var pid = $el.find(".pid").val();
  var pprice = $el.find(".pprice").val();
  var qty = $el.find(".itemQty").val();
  location.reload(true);
  $.ajax({
    url: 'action.php',
    method: 'post',
    cache: false,
    data: {
      qty: qty,
      pid: pid,
      pprice: pprice
    },
    success: function(response) {
      console.log(response);
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
