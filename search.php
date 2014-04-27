
<?php
session_start();

//connect to MySQL
	$server		= 'weiglevm.cs.odu.edu';
	$dbusername	= 'vputta';
	$dbpassword	= 'vaidhu';
	$database	= 'vputta';
$mysqli = new mysqli($server, $dbusername,  $dbpassword, $database) or 
     die ("Check your server connection.");


echo "<h1>Example 6 - Use BOOLEAN MODE</h1>";

echo "<h2>Search </h2>";
$search_str = "Post";
$query = "SELECT post_id FROM P4_posts " .
  "WHERE MATCH(post_content) AGAINST('+$search_str' IN BOOLEAN MODE) ";
run_query($search_str);
format_results();
echo "hi";
echo $query;

/*$mysqli->close();

		function run_query($search_str) 
		{
		  global $mysqli;
		  global $query;
		  global $result;

		  $result = $mysqli->query($query) 
			or die($mysqli->error);

		  $num_articles = $result->num_rows;
		  if ($num_articles == 1)
		  {
			echo "<p>There is $num_articles article that matches the query ($search_str)</p>";
		  } else
		  {
			echo "<p>There are $num_articles articles that match the query ($search_str)</p>";
		  }
		}

function format_results() 
{
  global $result;
  global $articles;

  $article_header=<<<EOD
  <table width="70%" border="1" cellpadding="2"
         cellspacing="2" align="center">
    <tr>
      <th>Post Date</th>
      <th>Post Content</th>
    </tr>
EOD;

  $article_details = '';
  while ($row = $result->fetch_array()) {
    $article_title = $row['post_content']; 
    $article_date = $row['date_created'];
    //$article_url = $row['url'];
     
    $article_details .=<<<EOD
    <tr>
      <td>$article_date</td>
      <td>$article_title</td>
    </tr>
EOD;
  }
  $result->free();

  
} */

?>