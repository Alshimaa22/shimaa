<?php require_once('Connections/local.php'); ?>
<?php
ob_start(); 
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

$currentPage = $_SERVER["PHP_SELF"];
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;
$local-> set_charset("utf8");
$id=$_GET['id'];

mysqli_select_db($local,$database_local);
$query_Recordset1 = "SELECT DISTINCT `Event Title` FROM calender_logs  GROUP BY `Event Title` ORDER BY `Event Title` DESC where `Event Title`='$id'";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;
$local-> set_charset("utf8");
$x=$_POST['name'];
mysqli_select_db($local,$database_local);
$query_Recordset2 = "SELECT DISTINCT `Event Title`,`Participant identifier` FROM calender_logs where `Event Title` LIKE  '%$x%%' ";
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
echo $query_limit_Recordset2;
$Recordset2 = mysqli_query($local,$query_limit_Recordset2) or die(mysql_error());
$row_Recordset2 = mysqli_fetch_assoc($Recordset2);
header('Location:sub_det.php?id='.$row_Recordset2['Event Title']);
ob_end_flush();
?>

<?php
}
?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
  <h2 align="center">CSV Reports</h2>
  </div>
  
  <div class="container">
  <form class="form-inline" action="subject.php" name="form1" method="post">
    <div class="form-group">
      <label for="email">Search Subject:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Student Name" name="name">
    </div>
    
      <input type="hidden" name="MM_insert" value="form1" />

    <button type="submit" class="btn btn-default">Search</button>
  </form>
</div>
  
  </br>

<table border="1" class="table table-striped">
  <tr>
                <th align="right">Details</th>
                <th>#</th>
  <?php do { 
  if($row_Recordset1['Event Title']!=''&& $row_Recordset1['Event Title']!=null)
  {
  ?>
    <tr>
     
      
<td><a href="sub_std_det.php?id=<?php echo  $row_Recordset1['Event Title'];?>"><?php echo  $row_Recordset1['Event Title'];?></a></td>
<td><?php echo ++$startRow_Recordset1;?></td>

    </tr>
    <?php }} while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
</table>
<table border="0" align="center">
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
