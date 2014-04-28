		<?php
	session_start();
	require_once('config.php');
	
	$search_word=mysql_real_escape_string( $_POST['searchword']);
	$cat_val=mysql_real_escape_string( $_POST['cat_name']);
	$submit_btn= mysql_real_escape_string( $_POST["submit"]);
	
	$query1="SELECT * FROM P4_threads " .
				"WHERE MATCH(thread_name) AGAINST('$search_word' IN BOOLEAN MODE) 
			and category_id=$cat_val
			and is_archived=0
			order by creation_date";
				
    $result1= mysql_query($query1) or die ("Unable to verify user because " . mysql_error());
	
	while($row1 = mysql_fetch_array($result1))
	{
		$th_id= $row1['thread_id'];
		$th_name=$row1['thread_name'];
		
		print " <tr>
				<td>$th_name</td>
				<td>Thread</td></tr><br />";
	}
    
	$query="SELECT thread_id,thread_name
			from P4_threads
			where category_id=$cat_val";
				
    $result= mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	
	while($row = mysql_fetch_array($result))
	{
		$th_id= $row['thread_id'];
		$th_name=$row['thread_name'];
		
		
		$query2="SELECT * FROM P4_posts " .
				"WHERE MATCH(post_content) AGAINST('$search_word' IN BOOLEAN MODE) 
				and Is_archived=0
				and thread_id=$th_id
				order by date_created";
				
		$result2= mysql_query($query2) or die ("Unable to verify user because " . mysql_error());
		
		while($row2 = mysql_fetch_array($result2))
			{  
				$content= $row2['post_content'];
				print " <tr>
				<td>$content</td>
				<td>Post</td></tr><br />"; 
			} 
	}
	
?>


