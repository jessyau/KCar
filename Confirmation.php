<!DOCTYPE html>
  <html>
  <head>
	<title>Confirmation Page</title>
  </head>
  <body>
	<h2>Reservation Confirmation Page </h2>
  <p>Note: Please do not refresh or go back a page. It will cause a dual booking with a different reservation ID.</p>

  <b><u><h4>Your Reservation Details</h4></b></u>

<?php

  function nonunique_RID($dbh, $RID) {
      try {
        $RID_query = $dbh->query("SELECT * FROM Reservation where RID = '$RID'");

        return (!$RID_query) ? false: true;

        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

  }

  function confirmation() {

    session_start();

    $pickup_date = $_POST["pick_up_date"];
    $pickup_time = $_POST["pick_up_time"];
    $ID = $_SESSION['login_user'];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $CarVin = $_GET["id"];

    include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

        do {
          $RID = rand();
        } while (nonunique_RID($dbh, $RID));

        $car_query = $dbh->query("SELECT * FROM Car natural join Parks_At where VIN = '$CarVin'");

        if(!$car_query) echo "Car query failed.";
        $car = $car_query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

        $stmt = $dbh->prepare("INSERT INTO Reservation(R_ID, date, pickup, fname, lname, phone)
                        VALUES (:RID, :pickup_date, :pickup_time, :fname, :lname, :phone)");

        $stmt->bindParam(':RID', $RID);
        $stmt->bindParam(':pickup_date', $pickup_date);
        $stmt->bindParam(':pickup_time', $pickup_time);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':phone', $phone);

        if($stmt->execute())
        {
          if($dbh->query("INSERT INTO Books VALUES ('$ID', '$RID', '$CarVin', '$car[0]')"))
          {
            echo "Reservation Number: ".$RID."<br>";
            echo "Reserved car: ".$car[2]." ".$car[1]."<br>";
            echo "Pick up date: ".$pickup_date."<br>";
            echo "Pick up time: ".$pickup_time."<br>";
            echo "Name: ".$fname." ".$lname."<br>";
            echo "Phone number: ".$phone;
          } else echo "ERROR: INSERT INTO 'BOOKS' FAILED.";
        } else echo "ERROR: INSERT TO 'RESERVATION' FAILED.";

        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }

  if(isset($_POST['submit']))
    {
      confirmation();
    }

?>

  <br><br><br><a href="member_index.html">Go back to the home page</a>
	</table>
  </body>
</html>
