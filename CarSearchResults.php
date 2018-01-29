<!DOCTYPE html>
  <html>
  <head>


<?php
/* Process the form data and access the database */

  function CarSearch() {
      echo "
      <title>Car Search Results</title>
      </head>
      <body>
      <h2>Available Cars: </h2>
      <table border=\"1\">
      <tr>
      <th>Branch</th>
      <th>Car Type</th>
      <th>Year</th>
      <th>Street </th>
      <th>Address</th>
      <th>City</th>
      <th>Postal Code</th>
      <th>Options</th>";

    $pickup_date = $_POST["pick_up_date"];
    $pickup_time = $_POST["pick_up_time"];
    $length = $_POST["length"];
    $location = $_POST["location"];


    include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);
        $rows = $dbh->query("SELECT VIN, branch_id, make, model, year, status, street_number, street_name, city, postal
                   FROM Car natural join Location natural join Parks_At
                   WHERE city = '$location' and status = 'Available'
                   ORDER BY branch_id");


        foreach($rows as $row) {
          $carName = $row[2] . " " . $row[3];
          $Link = "<a href = 'Reserve.php?id=".$row[0]."'> Reserve Now</a>";

        echo "<tr><td>".$row[1]."</td><td>".$carName."</td><td>".$row[4]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td><td>".$row[9]."</td><td>".$Link."</td></tr>";
        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
  }


  if(isset($_POST['submit']))
    {
        CarSearch();
    } else echo "DID NOT ENTER IN SEARCH INFORMATION. RETURN TO PREVIOUS PAGE."
?>
	</table>
  </body>
</html>
