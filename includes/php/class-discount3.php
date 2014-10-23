<?php 
  if (!isset($_SESSION)) {
	session_start();
}

class discount 
{
	public $id;
	public $discount_code;
	public $discount_name;
	public $customerid;
	protected $applied;
	protected $date_obtained;
	protected $expiration_date;
	protected $amount;
	protected $combinable;
	protected $life_of_discount;
	protected $multiple_use;
	protected $type;
	protected $MAYBE;
	protected $YES;
	protected $NO;
	protected $SOMETIMES;
	public $status;
	public $change_status;
    public $button_value;
	public $button_visibility;
	
	public function __construct( $customerid ) {
		$this->customerid = $customerid;
	}
	
	public function getFieldValues() {
		$this->getUserDiscounts();
		$this->getDiscountTally();
		$this->getDiscountTally2();		
		$this->getButtonValue();
		$this->getButtonVisibility();
		$this->getChangeStatus();
	}
	
	public function getButtonValue() {
		return $this->button_value;
	}
	
	public function getButtonVisibility() {
		return $this->button_visibility;
	}
	
	public function getChangeStatus() {
		return $this->change_status;
	}
	
	public function getMAYBE() {
		return $this->MAYBE;
	}
	
	public function getYES() {
		return $this->YES;
	}	
	
	public function getNO() {
		return $this->NO;
	}
	
	public function getSOMETIMES() {
		return $this->SOMETIMES;
	}
	public function getCustomerID() {
		return $this->customerid;
	}
	public function getDiscountTally() {
		//$this->getMAYBE();
		//$this->getYES();
		//$this->getNO();
		//$this->getSOMETIMES();
		
		$MAYBE = 0;
		$YES = 0;
		$NO = 0;
		$SOMETIMES = 0;
		
		//tallys the number of discounts that can be categorized by these four different
		//possible combinations.
		$mysqli = new mysqli ( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
		if($mysqli->connect_errno)
		{
			echo "Error Connecting to Database.";
			exit;
			}; 
		$query = "SELECT dc.id, dc.customerid, db.discount_name, dc.discount_code, db.type, db.amount, dc.applied, dc.date_obtained, dc.expiration_date, db.multiple_use, db.combinable, db.life_of_discount FROM discounts_database AS db LEFT JOIN discounts_customer AS dc ON db.discount_name = dc.discount_name WHERE dc.customerid = '" . self::getCustomerID() . "'";
		$result = $mysqli->query( $query );
		$row = $result->fetch_assoc();
		$totalRecords = $result->num_rows;
		do {
		   if( ($row['applied'] == "YES") && ($row['combinable'] == "YES") ) {
				$this->MAYBE += 1; 
				//If $this->MAYBE is > 0 the user already has discounts applied and all 
				  //non-combinable discounts must be blocked from attempts at being appliied 
				  //while still allowing IS-combinable discounts to be freely applied. 
		   } 
		   if( ($row['applied'] == "YES") && ($row['combinable'] == "NO") ) {
				$this->YES += 1;  
				//If $this->YES is > 0 the user already has a non-combinable discount applied
				  //and the user must be prohibited from applying all discounts of every type.
		   } 
		   if( ($row['applied'] == "NO") && ($row['combinable'] == "NO") ) {
				$this->NO += 1;
		   } 
		   if( ($row['applied'] == "NO") && ($row['combinable'] == "YES") ) {
				$this->SOMETIMES += 1; 
		   }  
		  $tally = array( "MAYBE" => $this->MAYBE, "YES" => $this->YES, "NO" => $this->NO, "SOMETIMES" => $this->SOMETIMES );		  
		} while( $row = $result->fetch_assoc() );
		    $newJSON = json_encode ( $tally );
		    //echo $newJSON;
	}
		
	public function getDiscountTally2() {
		//$this->getUserDiscounts();
		$this->getMAYBE();
		$this->getYES();
		$this->getNO();
		$this->getSOMETIMES();
		
		//tallys the number of discounts that can be categorized by these four different
		//possible combinations.
		$mysqli = new mysqli ( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
		if($mysqli->connect_errno)
		{
			echo "Error Connecting to Database.";
			exit;
			}; 
		$query = "SELECT dc.id, dc.customerid, db.discount_name, dc.discount_code, db.type, db.amount, dc.applied, dc.date_obtained, dc.expiration_date, db.multiple_use, db.combinable, db.life_of_discount FROM discounts_database AS db LEFT JOIN discounts_customer AS dc ON db.discount_name = dc.discount_name WHERE dc.customerid = '" . $this->customerid . "'";
		$result = $mysqli->query( $query );
		$row = $result->fetch_assoc();
		$totalRecords = $result->num_rows;
		
		self::getDiscountTally();

		do {
		//$this->button_visibility = ((self::getYES() >= 1) ? 'submit': 'hidden');
		if(( self::getMAYBE() >= 1 ) && ($row['applied'] == "NO") && ($row['combinable'] == "NO")){
		  $this->applied = "YES"; 
		  $this->button_value = "Apply";
		  $this->button_visibility = "hidden";//echo "check a";	
				 
		  /****  this statement modifies the remaining discounts of both types by hiding the submit button. ****/
		  //If a non-combinable discount is already applied and it is
		    // NOT this discount, the button values will be as follows.
		  } elseif(( self::getYES() >= 1 ) && ($row['applied'] == "NO") && ($row['combinable'] == "YES" || $row['combinable'] == "NO")){
		  $this->applied = "YES"; 
		  $this->button_value = "Apply";
		  $this->button_visibility = "hidden"; //echo "check b";
		  
		  //This statement modifies the applied discount's button by setting $this->button_value = "Use Later"
		    //and by showing the submit button.
		  //If a non-combinable discount is already applied and it IS
		    // this discount, the button values will be as follows.
		  } elseif(( self::getYES() >= 1 ) && ($row['applied'] == "YES") && ($row['combinable'] == "NO")) {
		  $this->applied = "NO"; 
		  $this->button_value = "Use Later";
		  $this->button_visibility = "submit"; //echo "check 1";
		  
		  //When an IS-comibinable discount is applied-
		  //(determined by $this->SOMETIMES), this statement modifies all other 
		  //IS-combinable buttons to reflect this by setting $this->button_value = "Apply."
		  } elseif(( self::getSOMETIMES() >= 1 ) && ($row['applied'] == "NO") && ($row['combinable'] == "YES")) {
		  $this->applied = "YES"; 
		  $this->button_value = "Apply";
		  $this->button_visibility = "submit"; //echo "check 2";
		  
		  //When an IS-comibinable discount is already applied-
		  //(determined by $totalRows_Recordset1 < 1 and $this->applied == "NO"), 
		  //this statement modifies this discount's button by setting $this->button_value = "Use Later."
		  } elseif( $row['applied'] == "YES" ) {
		  $this->applied = "NO"; 
		  $this->button_value = "Use Later";
		  $this->button_visibility = "submit"; //echo "check 3";
		  
		  //When no discounts of any kind are applied-
		  } elseif( $row['applied'] == "NO" ) {
		  $this->applied = "YES"; 
		  $this->button_value = "Apply";
		  $this->button_visibility = "submit"; //echo "check 5";  
		  }   
		  $buttonParameters[] = array($row['id'], $row['applied'], $this->button_value, $this->button_visibility, $row['discount_code']);		
		  //$buttonParameters[] = array("id" => $row['id'], "applied" => $row['applied'], "button_value" => $this->button_value, "button_visibility" => $this->button_visibility, "discount_code" => $row['discount_code']);		
		} while( $row = $result->fetch_assoc() );
		$tally = $buttonParameters;
		$newJSON = json_encode ( $tally );
		echo $newJSON;	
	}
	public function getUserDiscounts() {
		$mysqli = new mysqli ( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
		if($mysqli->connect_errno)
		{
			echo "Error Connecting to Database.";
			exit;
			}; 
		$query = "SELECT dc.id, dc.customerid, db.discount_name, dc.discount_code, db.type, db.amount, dc.applied, dc.date_obtained, dc.expiration_date, db.multiple_use, db.combinable, db.life_of_discount FROM discounts_database AS db LEFT JOIN discounts_customer AS dc ON db.discount_name = dc.discount_name WHERE dc.customerid = '" . $this->customerid . "'";
		$result = $mysqli->query( $query );
		while ( $row = $result->fetch_assoc () ) {
			$test_data [] = $row;
		};
		$json ['data'] = $test_data;
		$newJSON = json_encode ( $json );
		echo $newJSON;
	}
	
	public function getStatus() {
		$this->status = intval( $this->applied . $this->combinable );
		return $this->status;
	}
	
	
	public function sendOutput() {
		}
}
$output = new discount( @$_SESSION['MM_UserGroup'] );
//$output->getUserDiscounts();
//$output->getDiscountTally();
$output->getDiscountTally2();
?>