<?php  
				//initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!-- saved from url=(0014)about:internet -->
    <title>Total eCommerce Web Application</title>  
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" >
    <link rel="stylesheet" type="text/css" href="../css/jquery.ui.theme.css" title="ui-theme" />
    <link rel="stylesheet" type="text/css" href="../css/root-web-applications.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_page.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_table.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <script type="text/javascript" src="../js/jquery-1.9.1-min.js"></script>        
    <script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js" language="javascript" ></script>
	<script type="text/javascript" src="../js/jquery.dataTables.editable.js"></script> 
	<script type="text/javascript" src="../js/jquery.jeditable.mini.js"></script>
    <script type="text/javascript" src="../js/dataTables.fnReloadAjax.js"></script>
    <script type="text/javascript" src="../js/one-page-estore.js"></script>
    <script type="text/javascript" src="../js/google.js"></script>
  </head>
  <body itemscope itemtype="http://schema.org/WebPage"> 
    <div class="container">
      <div class="content">
        <?php include('accordion-header.php'); ?>
        <div id="application">
<?php
  //initialize the session
  if (!isset($_SESSION)) {
    session_start();
} 
  Class accordion_Module 
  { 
    // Class accordion_Module's attributes
	public $link_id;
	public $link_href;
	public $link_name;
	public $module_content;
	
	// Class accordian_Module's constructor
	public function __construct( $link_id, $link_href, $link_name, $module_content )
	{
		$this->link_id = $link_id;
		$this->link_href = $link_href;
		$this->link_name = $link_name;
		$this->module_content = $module_content;		
	}
	
	public function display_Accordion()
	{
		$this->display_Accordion_Button();
		$this->get_Module_Content();
		$this->display_Accordion_Content();
	}
	    // Class accordian_Module's operators
		public function display_Accordion_Button()
		{
			// Accordion Button Header
			?> 
			<h3 class="accordion-header">
			  <span class="headerLink">
				<a 
				  class="link" 
				  id="<?php echo $this->link_id; ?>"
				  href="<?php echo $this->link_href; ?>"><?php echo $this->link_name; ?></a>
			  </span>
			</h3>
            <?php  }
			// This function gets the individual file contents for the
			// different accordion modules that will be inserted.
			 public function get_Module_Content()
			{
				echo "<fieldset>
			      <legend></legend>";
				include($this->module_content);
				echo "</fieldset>";	
				return $this->module_content;		   
			} 
			public function display_Accordion_Content()
			{
				// This will be modified by the child class
		
		}	
	  }
?>
 <?php 
$login_Module = new accordion_Module( "sign-in", "#sign-in", "Sign-in", "login-module-content.php" );
$login_Module2 = new accordion_Module( "account-details", "#account-details", "Account-Details", "account-module-content.php" );
$login_Module4 = new accordion_Module( "add-discount", "#add-discount", "Add-Discount", "add-discount-module-content.php" );
$login_Module5 = new accordion_Module( "shopping-cart", "#shopping-cart", "Saved-Discounts", "DT-saved-discounts-module-content.php" );

$login_Module->display_Accordion();
$login_Module2->display_Accordion();
$login_Module4->display_Accordion();
$login_Module5->display_Accordion();

?>
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