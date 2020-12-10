<?php
include("connection.php"); 

 
// Creating MySQL connection.
 
// Storing the received JSON in $json.
$json = file_get_contents('php://input');
 
// Decode the received JSON and store into $obj
$obj = json_decode($json,true);
 
// Getting name from $obj.
$name = $obj['name'];
 
// Getting email from $obj.
$email = $obj['email'];
 
// Getting phone number from $obj.
$phone_number = $obj['phone_number'];
$pass = $obj['pass'];

 
// Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into ar_register_user (name,email,phone,password) values ('$name','$email','$phone_number','$pass')";

 if(mysqli_query($con,$Sql_Query)){
 
	 // On query success it will print below message.
	$MSG = 'Data Successfully Submitted.' ;
	 
	// Converting the message into JSON format.
	$json = json_encode($MSG);
	 
	// Echo the message.
	 echo $json ;
 
 }
 else{
 
	echo 'Try Again';
 
 }
 mysqli_close($con);
?>