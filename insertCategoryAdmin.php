<?php
	session_start();
	require_once('config.php');
?>
<?php
	
	$catName=$_POST['cat_name'];
	$catDes=$_POST['cat_description'];
	
	if (empty($_POST['cat_name']))
	{
		if(empty($_POST['cat_description']))
		{
		?>
			<script type="text/javascript">
			alert("Category Description Cannot Be Empty");
			history.back();
			</script>
		<?php
		}
		?>
		<script type="text/javascript">
			alert("Category Name Cannot Be Empty");
			history.back();
		</script>
<?php
	}
	else
	{
		$query1 = "INSERT INTO 
						P4_categories
							(id,
							cat_name,
							cat_description) 
						VALUES('',
							  '$catName',
							  '$catDes')";
		$result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
		header("Location: showCategory.php");
	}
?>