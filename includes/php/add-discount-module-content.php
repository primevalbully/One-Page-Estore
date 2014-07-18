          <div id="add-user-discount">
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
                <img src="../images/loading.gif" class="spinner" alt="loading..." style="/*display: none;*/">
              </span>                             
              <div class="apDivOuter">
                <div class="apDivInner">
                  <div class="apDivInnerMost">
                    <?php include('class-captcha.php'); ?>
                    <script type="text/javascript" src="../js/add-new-dscount-JS2.js"></script>
                  </div><!--End of apDivInnerMost Div-->
                </div><!--End of apDivInner Div-->                         
              </div><!--End of apDivOuter Div-->             
              <div id="mask"></div><!-- Mask to cover the whole screen -->
            </div>
          </div>