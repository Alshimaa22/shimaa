<?php require_once('Connections/h.php'); ?>
<?php
include("menue.php");

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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO lesson ( lesson_name) VALUES ( %s)",
                       GetSQLValueString($_POST['lesson_name'], "text"));

  mysql_select_db($database_h, $h);
  $Result1 = mysql_query($insertSQL, $h) or die(mysql_error());
  $last_id =mysql_insert_id();
  
  mkdir($last_id);

}
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("delete from lesson WHERE lesson_id=%s",
                       GetSQLValueString($_POST['lesson_id'], "int"));
					     mysql_select_db($database_h, $h);

  $Result1 = mysql_query($updateSQL, $h) or die(mysql_error());
  deleteDirectory($_POST['lesson_id']);
}
                      
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_h, $h);
$query_Recordset1 = "SELECT * FROM lesson";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $h) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" class="form-horizontal">
  <table class="table table-striped">
    
   <div class="form-group">
    <label class="control-label col-sm-2" for="Lesson_name">Lesson Name:</label>
    <div class="col-sm-5">
      <input type="text" name="lesson_name" value="" size="32" class="form-control"/>
       </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" class="btn btn-danger">Submit</button>
    </div>
  </div>
     
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<table class="table table-striped">
  <tr align="center">
    <td>Lesson Name</td>
        <td>add image</td>
        <td>Delete lesson</td>

  </tr>
  <?php do { ?>
    <tr align="center">
      <td><?php echo $row_Recordset1['lesson_name']; ?></td>
            <td><a href="add_image.php?lesson_id=<?php echo $row_Recordset1['lesson_id'];?> ">add</a></td>
            <td>
              <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
               
<div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" class="btn btn-warning">del</button>
    </div>
  </div>                <input type="hidden" name="MM_update" value="form2" />
                <input type="hidden" name="lesson_id" value="<?php echo $row_Recordset1['lesson_id']; ?>" />
              </form>
            <p>&nbsp;</p></td>

    </tr>
    <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
