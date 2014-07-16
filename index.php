<?php require_once('includes/php/metcdb.php'); ?>
<?php include('includes/php/cs5_function.php'); ?>
<?php include('includes/php/yn_tally.php'); ?>
<?php include('includes/php/modal-functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- saved from url=(0014)about:internet -->
    <title>Total eCommerce Web Application</title>  
    <meta name="author" lang="en" content="Alexander W Clark">
    <meta name="description" content="This is an entire Ecommerce website condensed into only one page through highly dynamic and interactive web programming.">
    <link href="https://plus.google.com/109520826444336591679" rel="publisher" />
    <link rel="shortcut icon" href="https://myeccentrictees.com/shades.ico" type="image/x-icon">
    <link rel="canonical" href="http://www.one-page-estore.com/">
    <meta name="robots" content="FOLLOW,INDEX">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="includes/css/jquery-ui.css" >
    <link rel="stylesheet" type="text/css" href="includes/css/jquery.ui.theme.css" title="ui-theme" />
    <link rel="stylesheet" type="text/css" href="includes/css/root-web-applications.css">
    <link rel="stylesheet" type="text/css" href="includes/css/demo_page.css">
    <link rel="stylesheet" type="text/css" href="includes/css/demo_table.css">
    <link rel="stylesheet" type="text/css" href="includes/css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="includes/css/modal.css">
    <script type="text/javascript" src="includes/js/sorttable.js"></script>
    <script type="text/javascript" src="includes/js/jquery-1.9.1-min.js"></script>        
    <script type="text/javascript" src="includes/js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="includes/js/jquery.dataTables.js" language="javascript" ></script>
	<script type="text/javascript" src="includes/js/jquery.dataTables.editable.js"></script> 
	<script type="text/javascript" src="includes/js/jquery.jeditable.mini.js"></script>
    <script type="text/javascript" src="includes/js/dataTables.fnReloadAjax.js"></script>
    <script type="text/javascript" src="includes/js/modal.js"></script>
    <script type="text/javascript" src="includes/js/google.js"></script>
  </head>
  <body itemscope itemtype="http://schema.org/WebPage"> 
    <div class="container">
      <div class="content">
        <?php include('includes/php/accordion-header.php'); ?>
        <div id="application">
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="sign-in" href="#sign-in">Sign In</a>
            </span>
          </h3>
          <fieldset>
            <legend></legend>
            <div id="cont" class="group">
              <span id="loginSpinner">
                <img src="includes/images/loading.gif" class="spinner" alt="loading..." style="/*display: none;*/">
              </span>
              <div id="logindiv">
                <form 
                  id="loginForm" 
                  name="loginForm" 
                  method="POST" 
                  action="login">
                  <div id="promptDiv" class="basePrompt"></div>
                  <div class="field">
                    <input  
                      id="username" 
                      name="username" 
                      type="text" 
                      value="lordvoz"
                      autocomplete="on" 
                      placeholder="Username" 
                      title="Username">
                  </div>
                  <div class="field">
                    <input 
                      id="password"
                      name="password"
                      type="password" 
                      value="password12"
                      autocomplete="on"
                      placeholder="Password"
                      title="Password">
                  </div>
                  <input 
                    class="three-d-button"
                    type="button"
                    id="submitButton"
                    value="<?php echo $buttonValue; ?>">
                </form>
              </div><!--End of logindiv Div-->
            </div><!--End of cont Div-->
            <script type="text/javascript" src="includes/js/login-JS.js"></script>
          </fieldset>
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="#" href="#account-details">Account Details</a>
            </span>
          </h3>
          <fieldset class="accordion-frame">
            <legend></legend>
            <div id="tabs">
              <ul>
                <li><a href="#tabs-1">Account Details</a></li>
                <li><a href="#tabs-2">Shipping Address</a></li>
                <li><a href="#tabs-3">Payment Information</a></li>
                <li><a href="#tabs-4">Order History</a></li>
              </ul>            
              <div id="tabs-1">
                <table id="account-details">
                  <thead>
                    <th>Account Details <a class="three-d-button" href="includes/myaccount/modify_personal_info.php">Modify</a></th>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Customer ID</th>
                      <td id="customerid">
                        <?php if(isset($_SESSION['MM_UserGroup'])) { echo $_SESSION['MM_UserGroup']; } ?>
                      </td>
                    </tr>
                    <tr>
                      <th>Username</th>
                      <td class="username editable_textarea" id="username"><?php echo $row_rs_uspass['username']; ?></td>
                    </tr>
                    <tr>
                      <th>Password</th>
                      <td>
                        <a class="three-d-button" href="includes/myaccount/change_password.php">Change Password</a>
                      </td>
                    </tr>
                    <tr>
                      <th>Email</th>
                      <td class="editable_textarea" id="email"><?php echo $row_rs_uspass['email']; ?></td>
                    </tr>
                    <tr>
                      <th>Member Since</th>
                      <td id="member_since"><?php echo $row_rs_uspass['member_since']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div><!--End of tabs-1 Div-->
              <div id="tabs-2">
                <table id="shipping-address">
                  <thead>
                    <th>Shipping Address <a class="three-d-button" href="includes/myaccount/modify_ship_address.php">Modify</a></th>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Address</th>
                      <td class="ship_address1 editable_textarea" id="ship_address1"><?php echo trim($row_rs_uspass['ship_address1']); ?></td>
                    </tr>
                    <tr>
                      <th>Address-2</th>
                      <td class="ship_address2 editable_textarea" id="ship_address2"><?php echo $row_rs_uspass['ship_address2']; ?></td>
                    </tr>
                    <tr>
                      <th>City</th>
                      <td class="ship_city editable_textarea" id="ship_city"><?php echo $row_rs_uspass['ship_city']; ?></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td class="ship_state editable_textarea" id="ship_state"><?php echo $row_rs_uspass['ship_state']; ?></td>
                    </tr>
                    <tr>
                      <th>Zip</th>
                      <td class="ship_zip editable_textarea" id="ship_zip"><?php echo $row_rs_uspass['ship_zip']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div><!--End of tabs-2 Div-->
              <div id="tabs-3">
                <table id="payment-address">
                  <thead>
                    <th>Payment Address <a class="three-d-button" href="includes/myaccount/modify_ship_address.php">Modify</a></th>
                  </thead>
                  <tbody>
                    <tr>
                      <th>Address</th>
                      <td class="bill_address1 editable_textarea" id="bill_address1"><?php echo trim($row_rs_uspass['bill_address1']); ?></td>
                    </tr>
                    <tr>
                      <th>Address-2</th>
                      <td class="bill_address2 editable_textarea" id="bill_address2"><?php echo $row_rs_uspass['bill_address2']; ?></td>
                    </tr>
                    <tr>
                      <th>City</th>
                      <td class="bill_city editable_textarea" id="bill_city"><?php echo $row_rs_uspass['bill_city']; ?></td>
                    </tr>
                    <tr>
                      <th>State</th>
                      <td class="bill_state editable_textarea" id="bill_state"><?php echo $row_rs_uspass['bill_state']; ?></td>
                    </tr>
                    <tr>
                      <th>Zip</th>
                      <td class="bill_zip editable_textarea" id="bill_zip"><?php echo $row_rs_uspass['bill_zip']; ?></td>
                    </tr>
                    <tr>
                      <th>Phone</th>
                      <td class="bill_phone editable_textarea" id="bill_phone"><?php echo $row_rs_uspass['bill_phone']; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div><!--End of tabs-3 Div-->
              <div id="tabs-4">
                    <table id="order-history">
                        <thead>
                        <th>Order History <a class="three-d-button" href="includes/myaccount/modify_ship_address.php">Modify</a></th>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Address</th>
                            <td class="editable_textarea">
                                <?php //combine $bill_address1 and $bill_address2.
                                $_SESSION['ship_address'] = $row_rs_uspass['ship_address1'] . ', ' . $row_rs_uspass['ship_address2'];
                                echo $_SESSION['ship_address']; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td class="editable_textarea"><?php echo $row_rs_uspass['ship_city']; ?></td>
                        </tr>
                        <tr>
                            <th>Zip</th>
                            <td class="editable_textarea"><?php echo $row_rs_uspass['ship_zip']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div><!--End of tabs-4 Div-->
            </div><!--End of tabs Div-->
          </fieldset>                                     
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="discounts-available" href="#discounts-available">Discounts Available</a>
            </span>
          </h3>
          <div class="accordion-frame">
            <h4 id="saved-discounts">View or Apply A Saved Discount</h4>
            <fieldset class="accordion-frame">
              <legend></legend>
              <table id="disc_table" class="sortable">
                <thead>
                  <tr>
                    <th width="119">Code</th>
                    <th width="120" class="sorttable_nosort">Applied</th>
                    <th width="73">Amount</th>
                    <th width="100">Expiration Date</th>
                    <th width="95">Multiple Use</th>
                    <th width="95">Combinable</th>
                  </tr>
                </thead>
                <tbody>
                  <?php do { ?>
                  <tr class="code">
                    <td class="discount_code2" id="discount-code" width="119"><?php echo $row_query['discount_code']; ?></td>
                    <td class="applied2" id="applied" width="120">
                      <?php include('includes/php/class-discount.php'); ?>
                      <form 
                        id="discount_form"
                        name="discount_form"
                        method="post" 
                        action="<?php echo "includes/myaccount/personal_info.php"; ?>">         
                        <input 
                          type="hidden"
                          id="change"
                          name="change"
                          value="change">
                        <input 
                          type="hidden"
                          id="id"
                          name="id"
                          value="<?php echo $id = $row_query['id']; ?>">
                        <input 
                          type="hidden"
                          id="applied"
                          name="applied"
                          value="<?php echo $applied; ?>">
                        <span id="discount_status">
                          <?php echo $row_query['applied']; ?>
                          <button 
                            type="<?php echo $submit; ?>" 
                            id="submit"
                            name="submit"
                            value="<?php echo $value;?>"><?php echo $value;?></button>
                        </span>
                      </form>
                    </td>
                    <td class="amount2" width="73">
                    <?php 
                      if(isset($row_query['type']) && $row_query['type'] == "fixed") {
                          echo "$";
                          echo $row_query['amount']; 
                      } elseif(isset($row_query['type']) && $row_query['type'] == "percent") {
                          echo $row_query['amount']; 
                          echo "%";
                      } else {
                          echo "error";
                      }
                    ?>
                    </td>
                    <td class="expiration_date2" sorttable_customkey="<?php echo $expiration_date = strtotime($row_query['expiration_date']); ?>"  width="100">
                      <?php 
                        $new_format = ('%B %d, %Y');
                        echo $display_expiration_date = strftime($new_format, $expiration_date);
                      ?>
                    </td>
                    <td class="multiple_use2" width="95"><?php echo $row_query['multiple_use']; ?></td>
                    <td class="combinable2" width="95"><?php echo $row_query['combinable']; ?></td>
                  </tr>
                  <?php } while($row_query = mysql_fetch_assoc($query)); ?>
                </tbody>
              </table>
              <a href="#" class="add-new-discount-link">Add New Discount</a>
            </fieldset>
          </div>
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="add-discount" href="#add-discount">Add Discount</a>
            </span>
          </h3>
          <div id="add-user-discount">
            <fieldset class="accordion-frame">
              <legend></legend>
              <h4 id="add-discount-header">Add a discount code to your account by entering it below</h4>
              <div id="boxes">
              <div id="discount-messages" title="Basic dialog">
                <div class="apDivInner">
                  <div class="apDivInnerMost">                         
                    <div id="messages" class="window">              
                    </div>
                  </div>
                </div>
              </div>
              <span id="spinner-new-discount">
                <img src="includes/images/loading.gif" class="spinner" alt="loading..." style="/*display: none;*/">
              </span>                             
              <div class="apDivOuter">
                <div class="apDivInner">
                  <div class="apDivInnerMost">
                    <?php include('includes/php/class-captcha.php'); ?>
                    <script type="text/javascript" src="includes/js/add-new-dscount-JS.js"></script>
                  </div><!--End of apDivInnerMost Div-->
                </div><!--End of apDivInner Div-->                         
              </div><!--End of apDivOuter Div-->             
              <?php do { ?>
              <?php } while ($row_rs_discounts = mysql_fetch_assoc($rs_discounts)); ?>                                                
              <div id="mask"></div><!-- Mask to cover the whole screen -->
              </div>
            </fieldset>
          </div>        
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="shopping-cart" href="#shopping-cart">Saved Discounts</a>
            </span>
          </h3>
          <div id="dt_example">
            <h1>Your Discounts</h1>
            <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
              <thead>
                <tr>
                  <th>id</th>
                  <th>Customer ID</th>
                  <th>Discount Name</th>
                  <th>Discount Code</th>
                  <th>Type</th>
                  <th>Amount</th>
                  <th>Applied</th>
                  <th>Date Obtained</th>
                  <th>Expiration Date</th>
                  <th>Multiple Use</th>
                  <th>Combinable</th>
                  <th>Life of Discount</th>
                </tr>
              </thead>
              <tbody>
                <tr>&nbsp;</tr>
              </tbody>
            </table>
          </div>
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="shopping-cart" href="#shopping-cart">Shopping Cart</a>
            </span>
          </h3>
          <div id="cart-items">                        
            <h1>Your Shopping Cart</h1>
            <table id="myDataTable">
              <thead>
                  <tr>
                      <th>Company name</th>
                      <th>Address</th>
                      <th>Town</th>
                  </tr>
              </thead>
              <tbody>
                      <tr id="17">
                          <td>Emkay Entertainments</td>
                          <td>Nobel House, Regent Centre</td>
                          <td>Lothian</td>
                      </tr>
                      <tr id="18">
                          <td>The Empire</td>
                          <td>Milton Keynes Leisure Plaza</td>
                          <td>Buckinghamshire</td>
                      </tr>
                      <tr id="19">
                          <td>Asadul Ltd</td>
                          <td>Hophouse</td>
                          <td>Essex</td>
                      </tr>
                      <tr id="21">
                          <td>Ashley Mark Publishing Company</td>
                          <td>1-2 Vance Court</td>
                          <td>Tyne &amp; Wear</td>
                      </tr>
              </tbody>
          </table>
          </div>
          <h3 class="accordion-header">
            <span class="headerLink">
              <a class="link" id="" href="#product=catalog">Product Catalog</a>
            </span>
          </h3>
          <div id="product-catalog">                        
            <h1>Catalog of Products</h1>
          </div>
        </div>
        <span class="lastModified">
          <time 
            itemprop="dateModified" 
            datetime="<?php echo date("Y-d-m", getlastmod());?>">
            <?php echo "Updated on: " . date("F d Y", getlastmod());?>
          </time>
        </span>       
      </div>
    </div>
  </body> 
</html>