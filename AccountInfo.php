<!DOCTYPE html>
  <html>
  <head>
  <div align="center">
  <title>User Rental History</title>
  </head>
  <body>
  <h2>Rental History:</h2>

	<table border = "1">
	   <tr>
	     <th>Reservation #</th>
	     <th>Length (Hr)</th>
		 <th>Make</th>
		 <th>Model</th>
		 <th>Year</th>
		 <th>Odometer @ Pickup</th>
		 <th>Odometer @ Return</th>

	<?php

		session_start();

		$ID = $_SESSION['login_user'];

		include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);
		    $rows = $dbh->query("select R_ID, time, make, model, year, odometer_pickup, odometer_return, status
		    					 from Members natural join Books natural join Rental_Hist natural join Car
		    					 where ID = '$ID'");


		    foreach($rows as $row) {
				echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
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
