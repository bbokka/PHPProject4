<?php
session_start();

	require_once("config.php");
	$uid= $_SESSION[login_id];
	$role=$_POST['role'];
	
	if($_POST['role'] == 1 || $_POST['role'] == 2 || $_POST['role'] == 3)
	{
		$query = "update P4_users set role_id='$role' where id='$uid'";
		$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
		header("Location: changeUserRoles.php");
	}
	else
	{
?>
    <script type="text/javascript">
		alert("Make a choice to Update the Role");
		history.back();
	</script>
  <?php
	}
 ?>
