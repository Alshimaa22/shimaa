<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_h = "166.62.88.2";
$database_h = "vps1_tafl";
$username_h = "vps1_tafl";
$password_h = "Tf@665544998877";
$h = mysql_pconnect($hostname_h, $username_h, $password_h) or trigger_error(mysql_error(),E_USER_ERROR); 
?>