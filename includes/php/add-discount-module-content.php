<div id="add-user-discount">
  <h4 id="add-discount-header">Add a discount code to your account by entering it below</h4>
  <div id="boxes">
    <div id="discount-messages" title="Add New Discount">
      <div class="apDivInner">
        <div class="apDivInnerMost">                         
          <div id="messages" class="window">              
          </div>
        </div>
      </div>
    </div>
    <div class="spinner-new-discount">
      <img 
        src="../images/ajax-loader4.gif" 
        class="spinner" 
        alt="loading..."
        style="/*display: none;*/">
    </div>                             
    <div class="apDivOuter">
      <div class="apDivInner">
        <div class="apDivInnerMost">
          <?php include('class-captcha.php'); ?>
        </div><!--End of apDivInnerMost Div-->
      </div><!--End of apDivInner Div-->                         
    </div><!--End of apDivOuter Div-->             
    <div id="mask"></div><!-- Mask to cover the whole screen -->
  </div>
</div>