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
                      <?php include('class-discount.php'); ?>
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