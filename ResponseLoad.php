<!DOCTYPE html>
<html>
<body>
<div align="center">

<h1> Leave a response! </h1>

<?php

	function ConfirmResponse() {
		session_start();

		$ID = $_SESSION['login_user'];
		$response = $_POST["response"];
		$comment = $_GET["com"];

		include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

		    $stmt = $dbh->prepare("INSERT INTO Responses (ID, comment, response) VALUES (:ID, :comment, :response)");

		    $stmt->bindParam(':response', $response, PDO::PARAM_STR);
		    $stmt->bindParam(':ID', $ID, PDO::PARAM_STR);
		    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

		    if($stmt->execute()) {

		    		echo "<b>Response Posted!</b><br><br>";
		    		echo "<a href = \"admin_index.html\">Return to main menu</a>";

		    } else echo "FAILED TO INSERT INTO RESPONSES.";
    	} catch (PDOException $e) {
    	    print "Error!: " . $e->getMessage() . "<br/>";
    	    die();
    	}
    }

    if(isset($_POST['submit']))
      {
          ConfirmResponse();

      } else echo "DID NOT ENTER IN COMMENT. RETURN TO PREVIOUS PAGE."


?>

</div>
</body>
</html>
