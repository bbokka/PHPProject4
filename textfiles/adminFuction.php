<?php
session_start();

$username=$_POST['emailid'];
$userpassword=$_POST['password'];

$server	= 'localhost';
$dbusername	= 'bbokka';
$dbpassword	= 'balareddy';
$database	= 'bbokka';
$connect =mysql_connect($server, $dbusername,  $dbpassword) or 
die ("Check your server connection.");

mysql_select_db($database) or
die ("Check your server connection.");

$query = "SELECT username,title from P2_user_login,P2_user_level where rank=rank_id";
$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
while($row = mysql_fetch_assoc($result))
	{
		echo '<div style="width:100%; max-width:1024px; min-height:50px; padding:10px;-webkit-border-radius: 10px;
-moz-border-radius: 10px;box-shadow: 10px 10px 5px #888888;
border-radius: 10px; background-color:white; margin-bottom : 5px;">';
		
	
		echo  $row['username'].$row['title'];
		echo'<input type="radio" name="role" value="Admin">Admin
  <input type="radio" name="role" value="Moderator">Moderator
  <input type="radio" name="role" value="User">User<br>
  <button type="button">Update</button>';
		echo "";
		
		echo '</div>';
		
	}
?>		

		
	