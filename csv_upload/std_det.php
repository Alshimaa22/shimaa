<?php require_once('Connections/local.php'); ?>
<?php
include('menue.php');
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$id=$_GET['id'];


$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$local-> set_charset("utf8");
/*//"SELECT DISTINCT date_csv,`Participant Name`, `Participant identifier`,Duration,`Event Name`,`Event Description`, `City`,`Country`,`Participant identifier`,`Event Title`,`Activity Name` FROM meet_logs,calender_logs where `Event Id`=`Calendar Event Id` and `Participant identifier`='$id' and `Event Title`!=''";*/
mysqli_select_db($local,$database_local);
$query_Recordset1 = "SELECT DISTINCT date_csv,`Participant Name`, `Participant identifier`,Duration,`Event Name`,`City`,`Country`,`Participant identifier`,`Event Title` FROM calender_logs INNER JOIN meet_logs ON meet_logs.`Calendar Event Id` = calender_logs.`Event Id` and `Participant Identifier`='$id'" ;
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysqli_query($local,$query_limit_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($local,$query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);


?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Upload CSV files - E-learning department WAAG</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
  <div class="jumbotron">
  <h2 align="center"> Report for student:</h2>
<h3 align="center">  Name::<?php 
if($row_Recordset1['Participant identifier']==''||$row_Recordset1['Participant identifier']==null)

echo 'Student with No registered email';
else
echo $row_Recordset1['Participant Name']

?></h3>
<h3 align="center">  Email::<?php 
if($row_Recordset1['Participant identifier']==''||$row_Recordset1['Participant identifier']==null)
echo 'Student with No registered email';
else
echo $row_Recordset1['Participant identifier']?></h3>

  </div>
<table class="table table-striped" align="center">
      <tr align="center">
      <td align="center">Country</td>
       <td align="center">City</td>
        <td align="center">Duration</td>
        <td align="center">Event Name</td>
          <td align="center">Date</td>
        <td align="center">Name</td>
         <td align="center">#</td>
      </tr>
  <?php do { ?>
    <tr>
   <tr>
   <td align="right"><?php echo $row_Recordset1['Country']?></td>
    <td align="right"><?php echo $row_Recordset1['City']?></td>
    <td align="right"><?php 
	echo gmdate("H:i:s", $row_Recordset1['Duration']);
	?></td>
  <td align="right"><?php echo $row_Recordset1['Event Title']?></td>

      <td align="right"><?php
	  
	   echo $row_Recordset1['date_csv']?></td>
   
    <td align="right"><?php echo $row_Recordset1['Participant Name']?></td>
<td><?php echo ++$startRow_Recordset1;?></td>
  </tr>
  
  
    
    <?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
<table border="0"  align="center">
  <tr>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
</div>
</body>
</html>
<?php

mysqli_free_result($Recordset1);
?>
