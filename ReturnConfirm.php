<!DOCTYPE html>
  <html>
  <head>
  <div align="center">
  <title>Return Confirmation</title>
  </head>
  <body>
  <h2>Return Confirmation:</h2>

	<table border = "1">
	   <tr>
	     <th>Reservation #</th>
	     <th>Rental Length (Hrs)</th>
		 <th>Make</th>
		 <th>Model</th>
		 <th>Year</th>
		 <th>Odometer @ Pickup</th>
		 <th>Odometer @ Return</th>
		 <th>Status</th>

	<?php
		function ReturnConfirm() {
			session_start();

			$ID = $_SESSION['login_user'];
			$CarVin = $_GET["id"];
			$RID = $_GET["rid"];
			$odometer_return = $_POST['odometer_return'];
			$time = $_POST['time'];
			$returned = "returned";

			include("config.php");
    	$DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        	$dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

			    $stmt = $dbh->prepare("UPDATE CAR SET status = :returned WHERE VIN = :CarVin");

			    $stmt->bindParam(':CarVin', $CarVin, PDO::PARAM_STR);
			    $stmt->bindParam(':returned', $returned, PDO::PARAM_STR);

			    if($stmt->execute()) {
			    	$stmt2 = $dbh->prepare("INSERT INTO Build_Hist (ID, VIN, R_ID) VALUES (:ID, :CarVin, :RID)");

			    	$stmt2->bindParam(':CarVin', $CarVin, PDO::PARAM_STR);
			    	$stmt2->bindParam(':ID', $ID, PDO::PARAM_STR);
			    	$stmt2->bindParam(':RID', $RID, PDO::PARAM_STR);

			    	if($stmt2->execute()) {

			    		$stmt3 = $dbh->prepare("UPDATE Rental_Hist SET odometer_return = :odometer_return, time = :time WHERE R_ID = :RID");

			    		$stmt3->bindParam(':odometer_return', $odometer_return, PDO::PARAM_STR);
			    		$stmt3->bindParam(':time', $time, PDO::PARAM_STR);
			    		$stmt3->bindParam(':RID', $RID, PDO::PARAM_STR);

			    		if($stmt3->execute()) {

			    			$rows = $dbh->query("select R_ID, time, make, model, year, odometer_pickup, odometer_return, status
						    					 from Members natural join Books natural join Rental_Hist natural join Car
						    					 where ID = '$ID' and R_ID = '$RID'");
			    			if(!$rows) echo "Query failed.";
			    			$row = $rows->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

	    					echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td></tr>";
	    					echo "<br><br><a href=\"CommentForm.html\">Leave a comment!</a>";
	    					echo "<br><a href=\"member_index.html\">Return to Main Menu</a>";
			    		} else echo "FAILED TO UPDATE RENTAL_HIST.";
			    	} else echo "FAILED TO UPDATE BUILD_HIST.";
			    } else echo "FAILED TO UPDATE CAR STATUS.";

			    $dbh = null;
			} catch (PDOException $e) {
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
		}

		if(isset($_POST['submit']))
		  {
		      ReturnConfirm();

		  } else echo "DID NOT ENTER IN SEARCH INFORMATION. RETURN TO PREVIOUS PAGE."

	?>

	</table>
</body>
</div>
</html>
