<?php
	$host = '';
	$user = '';
	$pass = '';
	$db = '';
/* Connect to the database */
	mysql_pconnect($host,$user,$pass) or die (mysql_error());
	mysql_select_db($db) or die(mysql_error());	
?>