<!DOCTYPE html>
  <html>
  <head>
	<title>Comment Search Results</title>
  </head>
  <body>
  	<div align="center">
	<h2>Comments from specified date:</h2>

	<table border="1">
	   <tr>
	     <th>ID</th>
		 <th>Timestamp</th>
		 <th>Topic</th>
		 <th>Comment</th>
		 <th>Option</th>

<?php
/* Process the form data and access the database */

session_start();

$date = $_POST["date"];
$ID = $_SESSION["login_user"];

include("config.php");
$DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

try {
    $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

    $rows = $dbh->query("select ID, Time, topic, comment from Comments natural join Post where Date = '$date'");

    foreach($rows as $row) {
	    $Link = "<a href = 'CommentResponse.php?id=".$row[0]."&com=".$row[3]."'> Respond to Comment</a>";
		echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$Link."</td></tr>";
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
	</table>
</div>
  </body>
</html>
