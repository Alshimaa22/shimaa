<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_memory = "166.62.88.2";
$database_h = "vps1_tafl";
$username_memory = "vps1_tafl";
$password_memory = "Tf@665544998877";
$h = mysql_pconnect($hostname_memory, $username_memory, $password_memory) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES 'utf8'");
mysql_query( "SET CHARACTER SET utf8"); 
 

?>