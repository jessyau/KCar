<!DOCTYPE html>
  <html>
  <head>
    <div align="center">
    <title>Car Reservations</title>
    </head>
    <body>
    <h2>Reservation Details For Selected Car: </h2>
    <table border="1">
    <tr>
    <th>Reservation #</th>
    <th>Date</th>
    <th>Pickup Time</th>
    <th>Length (Hr)</th>
    <th>Make </th>
    <th>Model</th>
    <th>Year</th>

<?php

    $VIN = $_GET["id"];

    include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

        $rows = $dbh->query("SELECT R_ID, date, pickup, length, make, model, year
                             FROM Car natural join Books natural join Reservation
                             WHERE VIN = '$VIN'");

        foreach($rows as $row) {

        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td></tr>";
        }

        echo "<a href=\"admin_index.html\"> Go back to main menu </a><br>";
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
