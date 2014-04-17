<style type="text/css">
	a.feature
	{
		display: inline-block;
		cursor: pointer;
		min-width: 200px; 
		margin-right: 15px;
		margin-top: 15px;
		padding: 5px auto;
		color: #FF4D4D;
		font-weight: 50;
		text-align: center;
		
		-webkit-box-shadow: 0 0 5px 2px #fff;
		-moz-box-shadow: 0 0 5px 2px #fff;
		box-shadow: 0 0 5px 2px #fff;
		background: #ffffff;
		-moz-border-radius: 5px;
		-webkit-border-radius: 5px;
		-khtml-border-radius: 5px;
		border-radius: 5px;
	}
	
	a.selected
	{
		background: black;
	}
	
	div.Form_Box
	{
		width:95%; 
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 10px;
		
		max-width:1024px; 
		min-height:50px; 
		padding:10px;
		-webkit-border-radius: 10px;
		-moz-border-radius: 10px;
		
		-webkit-box-shadow: 0 0 5px 2px #888;
		-moz-box-shadow: 0 0 5px 2px #888;
		box-shadow: 0 0 5px 2px #888;
		
		border-radius: 10px; 
		background-color:white; 
		
		
	}
	
	div.features_div
	{
		width:95%; 
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		margin-bottom: 2%;
	}
</style>
<?
	echo '<div class="features_div" >';

	session_start();
	$role = $_SESSION['rank'];
	if($role == 1 || $role == 4)
	{
		echo '<a class="feature'; 
		if($_POST['selected'] == 1) echo ' selected';
		echo'" href="changeUserRoles.php"> Change User Roles </a>';
		
		echo '<a class="feature'; 
		if($_POST['selected'] == 2) echo ' selected';
		echo'" href="setPagination.php"> Set Pagination </a>';
	
		echo '<a class="feature';
		if($_POST['selected'] == 3) echo ' selected';
		echo'" href="CategoryModification.php"> Add/Delete Category </a>';
		
		echo '<a class="feature';  
		if($_POST['selected'] == 7) echo ' selected';
		echo'" href="userStats.php"> User Stats </a>';
	}
	
	if($role != 3)
	{
		echo '<a class="feature';  
		if($_POST['selected'] == 4) echo ' selected';
		echo'" href="goToDeleteUser.php" > Delete User </a>';
		
		echo '<a class="feature';  
		if($_POST['selected'] == 5) echo ' selected';
		echo'" href="suspendUser.php" > Suspend User </a>';
		
		echo '<a class="feature';  
		if($_POST['selected'] == 6) echo ' selected';
		echo'" href="freezeThreads.php" > Freeze Threads </a>';
	}
	
	/*
	echo '<a class="feature';  
	if($_POST['selected'] == 8) echo ' selected';
	echo'" href="#"> Edit/Delete Messages </a>
	*/
	echo '</div>';
?>