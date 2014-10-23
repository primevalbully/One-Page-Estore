<?php  
  //initialize the session
  if (!isset($_SESSION)) {
	session_start();
}
?>
<div id="cont" class="group">
  <div id="loginSpinner">
	<img 
      src="../images/ajax-loader4.gif" 
      alt="loading..." 
      class="spinner" 
      style="/*display: none;*/">
  </div>
  <div id="logindiv">
	<form 
	  id="loginForm" 
	  name="loginForm" 
	  method="POST" 
	  action="class-login.php">
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
			$buttonValue = $_SESSION['buttonValue'] = "Sign Out";
			} else { $buttonValue = $_SESSION['buttonValue'] = "Sign In";
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