<!DOCTYPE html>
  <html>
  <head>
  	<div align = "center">
	<title>About K-Town Car Share</title>
  </head>
  <body>
	<h2>K-Town Car Share Locations</h2>

	<table border="1">
	   <tr>
	     <th>Branch ID</th>
		 <th>Street #</th>
		 <th>Street Name</th>
		 <th>City</th>
		 <th>Province</th>
		 <th>Postal Code</th>

<?php
/* Process the form data and access the database */

	include("config.php");
  $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
      $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);
	    $rows = $dbh->query("select * from Location");


	    foreach($rows as $row) {
			echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
	    }
	    $dbh = null;
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}
?>
	</table>
  </body>
</div>
</html>
