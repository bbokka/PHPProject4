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
		$cat_id1=$row1['category_id'];
		
	
		$query3="select * from P4_categories where id=$cat_id1";
			$result3= mysql_query($query3) or die ("Unable to verify user because " . mysql_error());
			while($row3 = mysql_fetch_array($result3))
			{
				$cat_name1= $row3['cat_name'];

				print " <tr>
				<td>$cat_name1</td>
				<td>$th_name</td></tr><br />";
			}
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
				$thread_id1=$row2['thread_id'];
				
				$query4="select * from P4_threads where thread_id=$thread_id1";
				$result4= mysql_query($query4) or die ("Unable to verify user because " . mysql_error());
				while($row4 = mysql_fetch_array($result4))
				{
					$thread_name1= $row4['thread_name'];
					$cat_id1=$row4['category_id'];
					
					$query5="select * from P4_categories where id=$cat_id1";
					$result5= mysql_query($query5) or die ("Unable to verify user because " . mysql_error());
					while($row5 = mysql_fetch_array($result5))
					{
						$cat_name1= $row5['cat_name'];

						print " <tr>
						<td>$cat_name1</td>
						<td>$thread_name1</td>
						<td>$content</td></tr><br />"; 
					} 
				}
			}
	}
	
?>


