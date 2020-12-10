<?php

	//Define your host here.
	$HostName = "166.62.88.2";
	 
	//Define your MySQL Database Name here.
	$DatabaseName = "vps1_tafl";
	 
	//Define your Database UserName here.
	$HostUser = "vps1_tafl";
	 
	//Define your Database Password here.
	$HostPass = "Tf@665544998877";
	 
	// Creating connection
	$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
 
if ($conn->connect_error) {
 
	die("Connection failed: " . $conn->connect_error);
} 
 
	// Creating SQL command to fetch all records from Student_Data Table.
	$sql = "SELECT * FROM ar_flutter_subject";
	 
	$result = $conn->query($sql);
 
if ($result->num_rows >0) {
 
	 while($row[] = $result->fetch_assoc()) {
	 
	 $item = $row;
	 
	 $json = json_encode($item, JSON_NUMERIC_CHECK);
	 
 }
 
} else {
	echo "No Data Found.";
}
echo $json;
$conn->close();

?>