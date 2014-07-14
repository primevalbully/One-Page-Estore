<?php 

  //When IS-combinable discounts are already applied, 
  //(determined by $MAYBE >= 1) this if statement catches all discounts that are
  //NON-combinable and NOT already applied, and prevents the user
  //from applying these discounts by setting $submit = "hidden" which hides the submit button.
  if(( $MAYBE >= 1 ) && isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "NO") && isset($row_query['combinable']) && ($row_query['combinable'] == "NO")){
	$applied = "YES"; 
	$value = "Apply";
	$submit = "hidden";
	$check4 = "true";
	
	   //echo "check a";	
		   
	//When a NON-comibinable discount is already applied
	//(which is determined through the $YES variables, 
	//this statement modifies the remaining discounts of both types by hiding the submit button.
	} elseif(( $YES >= 1 ) && isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "NO") && isset($row_query['combinable']) && ($row_query['combinable'] == "YES" OR $row_query['combinable'] == "NO")){
	$applied = "YES"; 
	$value = "Apply";
	$submit = "hidden";
	$check4 = "true";
	
	   //echo "check b";
	
	//When a NON-comibinable discount is applied
	//(which is determined through the $YES and $totalRows_Recordset1 variables), 
	//this conditional statement modifies the applied discount's button by setting $value = "Use Later."
	} elseif(( $YES >= 1 ) && isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "YES") && isset($row_query['combinable']) && ($row_query['combinable'] == "NO")) {
	$applied = "NO"; 
	$value = "Use Later";
	$submit = "submit";
	$check4 = "true";
	
	   //echo "check 1";
	
	//When an IS-comibinable discount is applied-
	//(determined by $SOMETIMES and $totalRows_Recordset1 variables), 
	//this statement modifies all other IS-combinable buttons to reflect this by setting $value = "Apply."
	} elseif(( $SOMETIMES >= 1 ) && isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "NO") && isset($row_query['combinable']) && ($row_query['combinable'] == "YES")) {
	$applied = "YES"; 
	$value = "Apply";
	$submit = "submit";
	$check4 = "true";
	
	   //echo "check 2";
	
	//When an IS-comibinable discount is already applied-
	//(determined by $totalRows_Recordset1 < 1 and $row_query['applied'] == "NO"), 
	//this statement modifies this discount's button by setting $value = "Use Later."
	} elseif( isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "YES")) {
	$applied = "NO"; 
	$value = "Use Later";
	$submit = "submit";
	$check4 = "true";
	
	   //echo "check 3";
	
	//When no discounts of any kind are applied-
	} elseif( isset($row_query['id']) && isset($row_query['applied']) && ($row_query['applied'] == "NO")) {
	$applied = "YES"; 
	$value = "Apply";
	$submit = "submit";
	$check4 = "true";
	
	   //echo "check 5";
	
    }   
   //When the user enables or applies any type of discount several conditional values must be determined
     //including what discounts and of what type, if any, that are already applied.
    
   //Meaning, the conditional discount type determines which discounts the user will 
     //subsequently be allowed to apply, or not apply, in accourdance with discount policy.
    
   //Ergo, when a non-combinable discount is applied, ALL other discounts in the users account 
     //become unalterable by hiding the submit button, i.e.(check a and check b).
   
   //Conversely, if any discount that IS-combinable is applied, 
     //only the submit buttons of the NON-combinable discounts are then removed.    
     //This allows the user to coninue applying any combinable discount as desired.
   
   //Finally, the submit button is also modified based on the conditional discount applied status. 
     //If applied, the variable $value becomes "use later," whereas, this variable becomes = "Apply" 
     //if the query returns a discount status of not-applied.		     
     //this prevents the user from adding multiple discounts inappropriately.
     //this statement ensures that the original discount in question
     //is still modifiable by allowing access to the submit button.
?>