<!DOCTYPE html>
  <html>
  <head>
    <div align="center">
    <title>Cars With Most Rentals</title>
    </head>
    <body>
    <h2>Cars That Had The Most Rentals: </h2>
    <table border="1">
    <tr>
    <th>VIN</th>
    <th>Car Type</th>
    <th>Year</th>
    <th>Rental Count</th>

<?php

    include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

        $rows = $dbh->query("SELECT VIN, R_ID, make, model, year, max(y.num) as Rental_Total
                             FROM (SELECT VIN, R_ID, make, model, year, count(VIN) AS num
                                   FROM Car natural join Books natural join Rental_Hist
                                   GROUP BY VIN)y");

        foreach($rows as $row) {
          $carName = $row[2] . " " . $row[3];

        echo "<tr><td>".$row[0]."</td><td>".$carName."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
        }

        echo "<a href=\"admin_index.html\"> Return to main menu</a><br>";
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
