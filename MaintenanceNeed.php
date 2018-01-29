<!DOCTYPE html>
  <html>
  <head>
    <div align="center">
    <title>Maintenance Need Results</title>
    </head>
    <body>
    <h2>Cars That Need Maintenance: </h2>
    <table border="1">
    <tr>
    <th>VIN</th>
    <th>Branch</th>
    <th>Car Type</th>
    <th>Year</th>
    <th>Last Maintenance Date</th>

<?php

    include("config.php");

    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

        $rows = $dbh->query("SELECT VIN, branch_id, make, model, year, maint_date
                             FROM Car natural join Maintenance natural join Parks_At
                             WHERE (last_odometer-maint_odometer)>5000");

        foreach($rows as $row) {
          $carName = $row[2] . " " . $row[3];

        echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$carName."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
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
