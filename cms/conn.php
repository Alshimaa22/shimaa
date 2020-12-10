<?php
define('SQL_HOST','166.62.88.2');
define('SQL_USER','vps1_tafl02');
define('SQL_PASS','Tf@665544998877');
define('SQL_DB','vps1_tafl02');

$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS)
  or die('Could not connect to the database; ' . mysql_error());

mysql_select_db(SQL_DB, $conn)
  or die('Could not select database; ' . mysql_error());

?>
