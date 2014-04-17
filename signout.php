<?php
	session_start();
	unset($_SESSION['login_id']);
	unset($_SESSION['name']);
	//unset cookie
	//$hour=time()-3600;
	//setcookie('ID_my_site'," ", $hour);
	header("Location: index.php");  
?>