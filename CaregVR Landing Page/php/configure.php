<?php

class Config{
	private $hostname = "127.0.0.1";
	private $username = "root";
	private $password = "";
	private $tablename = "subscribers";
	private $dbName = "caregivr";
	public $con;

	public function __construct(){
		//Args:
		//		None
		//Description:
		//		Connects to the database using the private class variables declared.

		$this->con = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbName);
		if(!$this->con){
			return false;
		}
		// echo "Connected" . "<br>";
	}

	public function htmlfilter($form_data){
		//Args:
		//		$form_data (Array) - Email Address
		//Description:
		//		Used for validating email address

		$form_data = trim(stripcslashes(htmlspecialchars($form_data)));
		$form_data = mysqli_real_escape_string($this->con, trim(strip_tags($form_data)));
		return $form_data;
	}

	public function insert($name_data, $email_data){
		//Args:
		//		$tablename (text) - Name of the database
		//		$name_data (text) - Name of user subsctibing
		//		$email_data (text) - Email address of user subsctibing
		//Description:
		//		Inserts the provided name/email data into the specified $tablename.

		$insert_query= "INSERT INTO $this->tablename (Name, Email) VALUES ('$name_data', '$email_data')";
		$insert_result = mysqli_query($this->con, $insert_query);
		if($insert_result){
			return $insert_result;
		}
		else{
			return false;
		}
	}

	public function email_exits($email_data){
		//Args:
		//		$tablename (text) - Name of the database
		//		$email_data (text) - Email address of user subsctibing
		//Description:
		//		Checks if the given email address is already in the DB (i.e user is already subscribed)

		$check_query = "SELECT * FROM $this->tablename WHERE email = '$email_data'";
		$result = mysqli_query($this->con, $check_query);
		$is_in_DB = mysqli_fetch_assoc($result);
		if ($is_in_DB){
			return False;
		}
		else{
			return true;
		}
	}
}
?>
