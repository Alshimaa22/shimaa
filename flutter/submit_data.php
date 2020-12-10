<?php
include 'DatabaseConfig.php';

 
// Creating MySQL connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
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
$messages = $obj['messages'];

 
// Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into user_info_flutter (name,email,phone_number,messages) values ('$name','$email','$phone_number','$messages')";
 
 
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