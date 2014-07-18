<?php  
				//initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
?>
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
				<script type="text/javascript" src="../js/login2-JS.js"></script>