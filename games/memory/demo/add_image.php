<?php require_once('../Connections/h.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("delete from img_mem  WHERE img_id=%s",
                                             GetSQLValueString($_POST['img_id'], "int"));

  mysql_select_db($database_h, $h);
  $Result1 = mysql_query($updateSQL, $h) or die(mysql_error());
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "-1";
if (isset($_GET['lesson_id'])) {
  $colname_Recordset1 = $_GET['lesson_id'];
}
mysql_select_db($database_h, $h);
$query_Recordset1 = sprintf("SELECT * FROM lesson_mem WHERE lesson_id = %s", GetSQLValueString($colname_Recordset1, "int"));
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
  $imgFile = $_FILES['user_image']['name'];
  $tmp_dir = $_FILES['user_image']['tmp_name'];
  $imgSize = $_FILES['user_image']['size'];
  if(empty($imgFile)){
   $errMSG = "Please Select File.";
  }
  $upload_dir = $_GET['lesson_id'];
   $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
   // rename uploading image
   $file_name_encrypt=$imgFile;

   $userpic = $file_name_encrypt;
      // allow valid image file formats
   if(in_array($imgExt, $valid_extensions)){   
    // Check file size '5MB'
    if($imgSize < 5000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.'/'.$userpic);
    }
    else{
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "Sorry, only JPG, JPEG, PNG & GIF  files are allowed.";  
   }
$im=$upload_dir.'/'.$userpic;
$insertSQL = sprintf("INSERT INTO img_mem (img,lesson_id,img_txt) VALUES (%s,%s,%s)",
					     GetSQLValueString($im, "text"),
						 GetSQLValueString($_GET['lesson_id'], "int"),
						 GetSQLValueString($_POST['img_txt'], "text")
						

					   );

mysql_select_db($database_h, $h);
  mysql_query("SET NAMES 'UTF8'");

  $Result1 = mysql_query($insertSQL,  $h) or die(mysql_error());

}


$maxRows_Recordset2 = 10;
$pageNum_Recordset2 = 0;
if (isset($_GET['pageNum_Recordset2'])) {
  $pageNum_Recordset2 = $_GET['pageNum_Recordset2'];
}
$startRow_Recordset2 = $pageNum_Recordset2 * $maxRows_Recordset2;

$colname_Recordset2 = "-1";
if (isset($_GET['lesson_id'])) {
  $colname_Recordset2 = $_GET['lesson_id'];
}
mysql_select_db($database_h, $h);
$query_Recordset2 = sprintf("SELECT * FROM img_mem WHERE lesson_id = %s", GetSQLValueString($colname_Recordset2, "int"));
$query_limit_Recordset2 = sprintf("%s LIMIT %d, %d", $query_Recordset2, $startRow_Recordset2, $maxRows_Recordset2);
$Recordset2 = mysql_query($query_limit_Recordset2, $h) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);

if (isset($_GET['totalRows_Recordset2'])) {
  $totalRows_Recordset2 = $_GET['totalRows_Recordset2'];
} else {
  $all_Recordset2 = mysql_query($query_Recordset2);
  $totalRows_Recordset2 = mysql_num_rows($all_Recordset2);
}
$totalPages_Recordset2 = ceil($totalRows_Recordset2/$maxRows_Recordset2)-1;

$currentPage = $_SERVER["PHP_SELF"];

$queryString_Recordset2 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset2") == false && 
        stristr($param, "totalRows_Recordset2") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset2 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset2 = sprintf("&totalRows_Recordset2=%d%s", $totalRows_Recordset2, $queryString_Recordset2);
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" enctype="multipart/form-data" class="form-horizontal">

 
  <div class="form-group">
    <label class="control-label col-sm-2" for="Lesson_name">upload file:</label>
    <div class="col-sm-5">
      <input type="file" name="user_image" value="" size="32" class="form-control"/>
    </div>
  </div>
 <div class="form-group">
    <label class="control-label col-sm-2" for="img_txt">Insert text:</label>
    <div class="col-sm-5">
      <input type="text" name="img_txt" value="" size="32" class="form-control"/>
    </div>
  </div>
    
<div class="form-group">        
    <div class="col-sm-offset-2 col-sm-6" align="center">
        <button type="submit" class="btn btn-danger" >insert</button>
    </div> 
  </div> 

  <input type="hidden" name="MM_insert" value="form1" />
</form>
<table class="table table-striped">
  <tr align="center">
     <td>#</td>
    <td>image name</td>
     <td>img</td>
          <td>text</td>

     <td>delete</td>

  </tr>
  <?php do {
	   ?>
    <tr align="center">
<td><?php echo ++$pageNum_Recordset2; ?></td>
      <td><?php echo $row_Recordset2['img']; ?></td>
            <td><img src="<?php echo $row_Recordset2['img']; ?>" class="img-thumbnail" alt="Cinque Terre">
</td>
      <td><?php echo $row_Recordset2['img_txt']; ?></td>

            <td>&nbsp;
              <form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
                <table align="center">
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="del" /></td>
                  </tr>
                </table>
                <input type="hidden" name="MM_update" value="form2" />
                <input type="hidden" name="img_id" value="<?php echo $row_Recordset2['img_id']; ?>" />
              </form>
            <p>&nbsp;</p></td>

    </tr>
    <?php } while ($row_Recordset2 = mysql_fetch_assoc($Recordset2)); ?>
</table>
<table border="0" align="center">
  <tr>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, 0, $queryString_Recordset2); ?>">First</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 > 0) { // Show if not first page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, max(0, $pageNum_Recordset2 - 1), $queryString_Recordset2); ?>">Previous</a>
        <?php } // Show if not first page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, min($totalPages_Recordset2, $pageNum_Recordset2 + 1), $queryString_Recordset2); ?>">Next</a>
        <?php } // Show if not last page ?></td>
    <td><?php if ($pageNum_Recordset2 < $totalPages_Recordset2) { // Show if not last page ?>
        <a href="<?php printf("%s?pageNum_Recordset2=%d%s", $currentPage, $totalPages_Recordset2, $queryString_Recordset2); ?>">Last</a>
        <?php } // Show if not last page ?></td>
  </tr>
</table>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
