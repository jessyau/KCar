<!DOCTYPE html>
  <html>
  <head>
    <div align="center">
    <title>Cars With Least Rentals</title>
    </head>
    <body>
    <h2>Cars That Had The Least Rentals: </h2>
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

        $rows = $dbh->query("SELECT VIN, make, model, year
                             FROM Car as C
                             WHERE not exists (SELECT VIN
                                               FROM Books B
                                               WHERE C.VIN = B.VIN)");
        if($rows->fetchColumn() > 0)
        {
          $rows = $dbh->query("SELECT VIN, make, model, year
                             FROM Car as C
                             WHERE not exists (SELECT VIN
                                               FROM Books B
                                               WHERE C.VIN = B.VIN)");

          foreach($rows as $row) {
            $carName = $row[1] . " " . $row[2];

          echo "<tr><td>".$row[0]."</td><td>".$carName."</td><td>".$row[3]."</td><td>0</td></tr>";
          }
        } else {
          $rows2 = $dbh->query("SELECT VIN, make, model, year, min(c.num) as Rental_Total
                               FROM (SELECT VIN, R_ID, make, model, year, count(VIN) AS num
                                     FROM Car natural join Books natural join Rental_Hist
                                     GROUP BY VIN)c;");
          foreach($rows2 as $row2) {
            $carName = $row2[1] . " " . $row2[2];

            echo "<tr><td>".$row2[0]."</td><td>".$carName."</td><td>".$row2[3]."</td><td>".$row2[5]."</td></tr>";
          }
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
