<?php
// initialize the session
if (! isset( $_SESSION )) {
	session_start();
}
class user_Login {
	// Class to handle accessing and verifying user credentials.
	public $username;
	public $password;
	public function __construct( $username, $password ) {
		$this->username = $username;
		$this->password = $password;
	}
	public function sanitize_Var() {
		return trim( $this->password );
	}
	public function encode_Password() {
		return sha1( $this->password );
	}
	public function getUsername() {
		return $this->username;
	}
	public function user_Query() {
		$mysqli = new mysqli( 'localhost', 'ChinChinMonster', 'one4PBchaos!', 'metcdatabase' );
		if ($mysqli->connect_errno) {
			echo "An error has occured, please try again.";
			exit();
		}
		echo $password = $this->sanitize_Var();
		echo "<br>";
		echo $password = $this->encode_Password();
		echo "<br>";
		echo $username = $this->getUsername();
		$sql = "SELECT * FROM uspass WHERE username = '$username' AND password = '$password'";
		echo "<br>";
		print_r( $sql );
		echo "<br>";
		$result = $mysqli->query( $sql );
		echo "<br>";
		$row = $result->fetch_row();
		print_r( $row );
		echo "<br>";
		echo $_SESSION['MM_Username'] = $row[1];
		echo "<br>";
		echo $_SESSION['MM_UserGroup'] = $row[0];
		// echo $_SESSION['MM_UserGroup'] = $row['customerid'];
		// print_r( $result->password );
	}
}
$userLogin = new user_Login( $_POST['username'], $_POST['password'] );
$userLogin->user_Query();
sleep( 1 );
?>