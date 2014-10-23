<div id="primary-page-heading">
  <h1>Please Sign In To Prievew This Application</h1>
  <span id="logged-in-user-details">
    <?php 
      echo "Username: " .@$_SESSION['MM_Username']."<br />";
      echo "Customer ID: " .@$_SESSION['MM_UserGroup']."<br />"; 
    ?>
  </span>
  <span id="logged-in-user-details-2"></span>
  <div class="shop-cart-widget">
  <div class="total-cart-items"><?php echo "Items: " . @$_SESSION ['total_items']; ?></div>
  <div class="cart-subtotal-price"><?php echo "Subtotal: " . @$_SESSION ['cart_subtotal_price']; ?></div>
  <div class="total-savings"><?php echo "Savings: " . @$_SESSION ['total_savings']; ?></div>
  </div>
</div>