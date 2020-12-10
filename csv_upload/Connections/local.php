<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_local = "166.62.88.2";
$database_local = "vps1_tafl";
$username_local = "vps1_tafl";
$password_local = "Tf@665544998877";
$local = mysqli_connect($hostname_local, $username_local, $password_local) or trigger_error(mysqli_error(),E_USER_ERROR); 
?>