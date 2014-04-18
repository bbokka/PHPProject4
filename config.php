<?php
	$server		= 'weiglevm.cs.odu.edu';
	$dbusername	= 'vputta';
	$dbpassword	= 'vaidhu';
	$database	= 'vputta';
	
	$connect 	= mysql_connect($server, $dbusername,  $dbpassword) or die ("Check your server connection.". mysql_error());
	
	mysql_select_db($database) or die ("Check your server connection.");	
?>