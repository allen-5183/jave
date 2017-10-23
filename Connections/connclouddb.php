<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_connclouddb = "localhost:6033";
$database_connclouddb = "clouddb";
$username_connclouddb = "admin";
$password_connclouddb = "";
$connclouddb = mysql_pconnect($hostname_connclouddb, $username_connclouddb, $password_connclouddb) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("set names 'utf8'");
?>