        <span id="primary-page-heading">
          <h1>Please Sign In To Prievew This Application</h1>
          <span id="logged-in-user-details">
            <?php 
              echo "Username: " .@$_SESSION['MM_Username']."<br />";
              echo "Customer ID: " .@$_SESSION['MM_UserGroup']."<br />"; 
            ?>
          </span>
          <span id="logged-in-user-details-2"></span>
        </span>