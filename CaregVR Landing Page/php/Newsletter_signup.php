<?php
// NOTE: Must login using a password. So, change the password with the following command in the MySQL Powershell
// ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
// 'password' should of course be changed to a real password

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$tablename = "subscribers";
$dbName = "caregivr";

// 1.) Retrieve name and email from HTML
$name= $_POST['name'];
$email= $_POST['email'];
// $name = "fake name";
// $email = "PGhadban@gmail.com";

// 2.) Check if email is Valid
if(preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $email)){
  echo "Valid email" . "<br>";
} else{
  echo "Non - Valid email" . "<br>";
}


// 3.) Connect to DB
$con= mysqli_connect($hostname, $username, $password, $dbName)
      or die("Unable to select database");
echo "Connected" ."<br>";


// .) Check if email is already stored
$check_query = "SELECT Name FROM $tablename WHERE email = '$email'";
$result = mysqli_query($con, $check_query) or die ("Error querying database");
$is_in_DB = mysqli_fetch_assoc($result);
if ($is_in_DB['Name']){
  echo $is_in_DB['Name'];
  echo ", you are already subscribed."."<br>";
  return;
}


// 5.) Send Confirmation email
$subject = "Subscription Confirmation";
$message = "Hi $name,\n\n Thank you for signing up for the CaregiVR Newsletter!\n
          If you have any questions please feel free to reach out to me directly at: my_email@caregiVR.com\n\n
          All the best,\n
          Your friends at caregiVR";
$message = wordwrap($message, 70);
$headers = "From: PGhadban@gmail.com";
// mail($email, $subject, $message);


// 6.) Insert name and email into the DB
$insert_query= "INSERT INTO $tablename (Name, Email) VALUES ('$name', '$email')";
mysqli_query ($con, $insert_query)
      or die ("Error querying database");
echo 'You have been successfully added.'. '<br>';
mysqli_close($con);

?>
