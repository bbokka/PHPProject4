<?php
	$server	= 'localhost';
	$dbusername	= 'bbokka';
	$dbpassword	= 'balareddy';
	$database	= 'bbokka';

	$connect =mysql_connect($server, $dbusername,  $dbpassword) or 
	die ("Check your server connection.");
	
	mysql_select_db($database) or die ("Check your server connection.");	
?>