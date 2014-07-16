<?php require_once('metcdb.php'); ?>
<?php include('cs5_function.php'); ?>
<?php include('yn_tally.php'); ?>
<?php include('modal-functions2.php'); ?>
    <link rel="stylesheet" type="text/css" href="../css/jquery-ui.css" >
    <link rel="stylesheet" type="text/css" href="../css/jquery.ui.theme.css" title="ui-theme" />
    <link rel="stylesheet" type="text/css" href="../css/root-web-applications.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_page.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_table.css">
    <link rel="stylesheet" type="text/css" href="../css/demo_table_jui.css">
    <link rel="stylesheet" type="text/css" href="../css/modal.css">
    <script type="text/javascript" src="../js/sorttable.js"></script>
    <script type="text/javascript" src="../js/jquery-1.9.1-min.js"></script>        
    <script type="text/javascript" src="../js/jquery-ui-1.10.1.custom.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js" language="javascript" ></script>
	<script type="text/javascript" src="../js/jquery.dataTables.editable.js"></script> 
	<script type="text/javascript" src="../js/jquery.jeditable.mini.js"></script>
    <script type="text/javascript" src="../js/dataTables.fnReloadAjax.js"></script>
    <script type="text/javascript" src="../js/modal.js"></script>
    <script type="text/javascript" src="../js/google.js"></script>

<?php
  
  Class accordion_Module 
  { 
    // Class accordion_Module's attributes
	public $link_id;
	public $link_href;
	public $link_name;
	
	// Class accordian_Module's constructor
	public function __construct( $link_id, $link_href, $link_name )
	{
		$this->link_id = $link_id;
		$this->link_href = $link_href;
		$this->link_name = $link_name;
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
        <fieldset>
          <legend></legend>
            <div id="cont" class="group">
              <span id="loginSpinner">
                <img src="../images/loading.gif" class="spinner" alt="loading..." style="/*display: none;*/">
              </span>
              <div id="logindiv">
                <form 
                  id="loginForm" 
                  name="loginForm" 
                  method="POST" 
                  action="">
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
				  <?php 
				    if((isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup'] !== '')) 
					{
						$buttonValue = "Sign Out";
						} else { $buttonValue = "Sign In";
						}; 
				  ?>
                  <input 
                    class="three-d-button"
                    type="button"
                    id="submitButton"
                    value="<?php echo $buttonValue; ?>">
                </form>
              </div><!--End of logindiv Div-->
            </div><!--End of cont Div-->
            <script type="text/javascript" src="../js/login2-JS.js"></script>
          </fieldset>
		<?php return;
	}
	
  }
  ?>
 <?php 
$login_Module = new accordion_Module( "sign-in", "#sign-in", "Sign-in" );
echo $login_Module->display_Accordion_Button();
?>