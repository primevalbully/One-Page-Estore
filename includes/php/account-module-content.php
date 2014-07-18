<?php require_once('metcdb.php'); ?>
<?php include('cs5_function.php'); ?>
<?php include('modal-functions.php'); ?>
 <?php  
				//initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
?>           <div id="tabs">
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