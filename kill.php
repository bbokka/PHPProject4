<?php
	session_start();
	
	//Array ( [rank] => 4 [admin] => 1 [moderator] => 0 [usr] => 1 [category] => 4 [thread] => 23 [del_flag] => 0 [post_id] => 102 [$del_flag] => 0 
	unset($_SESSION['rank']);
	unset($_SESSION['admin']);
	unset($_SESSION['moderator']);
	unset($_SESSION['usr']);
	unset($_SESSION['category']);
	unset($_SESSION['thread']);
	unset($_SESSION['del_flag']);
	unset($_SESSION['post_id']);
	unset($_SESSION['$del_flag']);
	unset($_SESSION['login_id']);
	unset($_SESSION['name']);
	header("location: login.php");
?>