<?php
  include('class-accordion_Module.php');
  
  // login functionality is provided here
  Class accordion_login extends accordion_Module
  {
	  public $module_content;
	  
	  public function __construct( $link_id, $link_href, $link_name, $module_content ) 
	  {
	      parent::__construct( $link_id, $link_href, $link_name );
		  $this->module_content = $module_content;
	  }
	  
	  // This function gets the individual file contents for the
	  // different accordion modules that will be inserted.
	  public function get_Module_Content()
	  {
		   return file_get_contents( $this->module_content );
	  }
	  public function display_Accordion_Content()
	  {
		  $base = parent::display_Accordion_Content();
		  $module_content = $this->get_Module_Content();
		  echo $base . $module_content . "</fieldset>";
		  }
  }
?>	  
<?php 
  $login = new accordion_login( "sign-in", "#sign-in", "Sign-in", "login-module-content.php" );
  echo $login->display_Accordion();
  ?>