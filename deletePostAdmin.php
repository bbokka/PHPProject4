<?php
	//<!-- retreive the comment on the post and insert it into the post table-->
	session_start();
	require_once('config.php');
	
	$date= date("Y/m/d H:i:s");
	if($_SESSION['rank'] == 1 || $_SESSION['rank'] == 4)
	{
		$postEdited = "the Post has been deleted by ADMIN";
	}
	if($_SESSION['rank'] == 2)
	{
		$postEdited = "the Post has been deleted by MODERATOR";
	}
	
	$postid   = $_REQUEST['post_id'];
	$del_flag = 1;
	$modified_by = $_SESSION['login_id'] ;
	
	$query  = "
				UPDATE
					P4_posts
				SET 
					post_content = '$postEdited',
					date_last_modified = '$date',
					Is_archived = '$del_flag',
					last_modified_by = '$modified_by'
				WHERE 
					post_id='$postid'";
	$result = mysql_query($query) or die ("Unable to verify user because " . mysql_error());
	header("Location: extractPost.php");
	
?>
	
 