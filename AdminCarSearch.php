<!DOCTYPE html>
  <html>
  <head>
    <div align="center">
    <title>Car Search Results</title>
    </head>
    <body>
    <h2>Available Cars At Your Current Location: </h2>
    <table border="1">
    <tr>
    <th>VIN</th>
    <th>Branch</th>
    <th>Car Type</th>
    <th>Year</th>
    <th>Street # </th>
    <th>Street Name</th>
    <th>City</th>
    <th>Postal Code</th>
    <th>Options</th>

<?php

    session_start();

    $ID = $_SESSION["login_user"];

    include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);
        $branch_query = $dbh->query("SELECT home FROM Admin WHERE ID = '$ID'");

        $branch_ID = $branch_query->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);

        $rows = $dbh->query("SELECT VIN, branch_id, make, model, year, status, street_number, street_name, city, postal
                             FROM Car natural join Location natural join Parks_At
                             WHERE branch_ID = '$branch_ID[0]' and status = 'Available'");

        foreach($rows as $row) {
          $carName = $row[2] . " " . $row[3];
          $Link = "<a href = 'ViewReservation.php?id=".$row[0]."'> View Reservation</a>";

        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$carName."</td><td>".$row[4]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$Link."</td></tr>";
        }

        echo "<a href=\"AddCarForm.html\"> Add a car! </a><br>";
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
