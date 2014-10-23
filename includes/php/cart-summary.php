<?php
  if (!isset($_SESSION)) {
	session_start();
}

class calculate_price {
	public $customerid;
	public $unit_price;
	public $quantity;
	public $item_subtotal;
	public $total_cart_items;
	public $cart_subtotal_price;
	public $savings;
	public $total_savings;
	public $json;
	public $newJSON;
	public function __construct($customerid) {
		$this->customerid = $customerid;
	}
	public function getCartSummary() {
		$this->getPrice ();
		$this->getDiscounts ();
		$this->getTotalCartItems ();
		$this->getCartSubtotal ();
		$this->getTotalSavings ();
		$this->getJSONformat ();
	}
	public function getJSONformat () {
		$json = array( "total_cart_items" => $this->total_cart_items, "cart_subtotal_price" => $this->cart_subtotal_price, "total_savings" => $this->total_savings );
		echo $newJSON = json_encode ( $json );
	}
	public function getCartSubtotal() {
		return $this->cart_subtotal_price;
	}
	public function getTotalCartItems() {
		return $this->total_cart_items;
	}
	public function getTotalSavings() {
		return $this->total_savings;
	}
	public function getPrice() {
		$mysqli = new mysqli ( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
		$query = "SELECT * FROM cart_items WHERE customerid = '$this->customerid'";
		$result = $mysqli->query ( $query );
		while ( $row = $result->fetch_assoc () ) {
			$item_subtotal = $row ['unit_price'] * $row ['quantity'];
			$this->cart_subtotal_price = $this->cart_subtotal_price + $item_subtotal;
			$this->total_cart_items += $row ['quantity'];
		}
	}
	public function getDiscounts() {
		$mysqli = new mysqli ( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
		$query = "SELECT dd.discount_code AS code, dc.discount_name AS name, dd.discount_name AS name, type, amount, multiple_use AS mu, combinable, life_of_discount AS life, id, customerid AS cid, applied, date_obtained, expiration_date AS expires FROM discounts_database AS dd LEFT JOIN discounts_customer AS dc ON dd.discount_name = dc.discount_name WHERE dc.customerid = '" . $this->customerid . "'";
		
		$result = $mysqli->query ( $query );
		// $this->cart_subtotal_price = 0;
		// $this->total_cart_items = 0;
		// $this->savings =0;
		// $this->total_savings = 0;
		
		while ( $row = $result->fetch_assoc () ) {
			$row ['name'] . " ------ " . $row ['applied'] . " ------ " . $row ['amount'] . "<br/>";
			
			if ((isset ( $row ['applied'] ) && $row ['applied'] == "YES") && isset ( $row ['type'] ) && $row ['type'] == "fixed") {
				$this->type = "fixed";
				$this->savings = $row ['amount'];
				$this->cart_subtotal_price -= $this->savings;
				$this->total_savings += $this->savings;
			}
			
			if ((isset ( $row ['applied'] ) && $row ['applied'] == "YES") && isset ( $row ['type'] ) && $row ['type'] == "percent") {
				$this->type = "percent";
				$this->amount = $row ['amount'];
				$this->rate = ($this->amount / 100);
				$this->savings = $this->rate * $this->cart_subtotal_price;
				$this->cart_subtotal_price -= $this->savings;
				$this->total_savings += $this->savings;
			} else {
				"error";
			}
			$_SESSION ['total_items'] = $this->total_cart_items;
			$_SESSION ['cart_subtotal_price'] = number_format ( $this->cart_subtotal_price, 2 );
			$_SESSION ['total_savings'] = number_format ( $this->total_savings, 2 );
			$this->cart_subtotal_price = number_format ( $this->cart_subtotal_price, 2 );
			$this->total_savings = number_format ( $this->total_savings, 2 );
			$this->savings = number_format ( $this->savings, 2 );
			$this->cart_subtotal_price = number_format ( $this->cart_subtotal_price, 2 );
		}
	}
}
$price = new calculate_price ( @$_SESSION ['MM_UserGroup'] );
$price->getCartSummary ();
//echo "Total Cart Items: " . $price->getTotalCartItems ();
//echo "<br>";
//echo "Cart Subtotal: " . $price->getCartSubtotal ();
//echo "<br>";
//echo "Total Savings: " . $price->getTotalSavings ();
//echo "<br>";
//echo "<br>";
//$price->getJSONformat();
?>