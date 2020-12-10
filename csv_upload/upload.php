<?php
$dsn = "mysql:host=localhost;dbname=excel";
$user = "root";
$passwd = "";
if(!empty($_FILES)) {
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) 
{
$sourcePath = $_FILES['userImage']['tmp_name'];
$targetPath = "images/".$_FILES['userImage']['name'];
$dir="images";
$imgExt = strtolower(pathinfo($targetPath ,PATHINFO_EXTENSION)); // get image extension
//if($imgExt=="csv"){
move_uploaded_file($sourcePath,$targetPath);
echo"Uploaded Successfully";
$file = fopen($targetPath."","r");
while(! feof($file))
{
$myArray = array();
$myArray=fgetcsv($file);
	
try{
 $pdo = new PDO("mysql:host=localhost;dbname=excel", 
                     "root", ""); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE, 
                        PDO::ERRMODE_EXCEPTION); 
						$pdo->exec("set names utf8");
} 
catch (Exception $e)
{
die("Unable to connect: " . $e->getMessage());
}    
try
{
$sql = ("INSERT INTO meet_logs ( date_csv,`Event Name`,`Event Description`, `Meeting Code`, `Participant Identifier`, `Participant Outside Organisation`, `Client Type`, `Organizer Email`, `Product Type`,Duration,`Call_ Rating_out`,`Participant Name`,`IP Address`,`City`,`Country`,`Calendar Event Id`) VALUES  ('$myArray[0]','$myArray[1]','$myArray[2]','$myArray[3]','$myArray[4]','$myArray[5]','$myArray[6]','$myArray[7]','$myArray[8]',$myArray[9],'$myArray[10]','$myArray[11]','$myArray[12]','$myArray[13]','$myArray[14]','$myArray[26]')");
$pdo->exec($sql);
$pdo->exec("set names utf8");

} 
catch (PDOException $e) { 
   
} 
     }
	 
	 ?>
	 <a href="save_det.php">Show Student Deatails </a>
	 <?php
	           

  
  }
  
				
  
  }
   unset($pdo); 


?>