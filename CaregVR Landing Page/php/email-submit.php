<?php
include_once("configure.php");

$email_access = new Config();

if(isset($_POST['email_data_values'])){
  $name = $_POST['name_data_values'];
	$n_email = $_POST['email_data_values'];
	$email = $email_access->htmlfilter($n_email);

	if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)){
		$email_field['email'] = $email;
		$email_check = $email_access->email_exits($n_email);

		if($email_check){
			$insert = $email_access->insert($name, $n_email);
			if($insert){
				echo "Thank You For Subscribing!";
			}
			else{
				echo "Not Subscribed";
				return false;
			}
		}
		else{
			echo "You Have Already Subscribed";
			return false;
		}
	}
	else{
		if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)){
			echo "*Please Enter A Valid Email Address*";
			return false;
		}
	}
}
?>
