<!DOCTYPE html>
<html>
<body>
<div align="center">

<h1> Leave a comment! </h1>

<?php

	function ConfirmPost() {
		session_start();

		$ID = $_SESSION['login_user'];
		$topic = $_POST["topic"];
		$comment = $_POST["comment"];
		$time = date('Y-m-d H:m:s');
		$date = date('Y-m-d');

		include("config.php");
    $DSN = 'mysql:host=' . $DB_HOST . ';dbname=' . $DB_NAME;

    try {
        $dbh = new PDO($DSN, $DB_USER, $DB_PASSWORD);

		    $stmt = $dbh->prepare("INSERT INTO Comments (ID, topic, comment) VALUES (:ID, :topic, :comment)");

		    $stmt->bindParam(':topic', $topic, PDO::PARAM_STR);
		    $stmt->bindParam(':ID', $ID, PDO::PARAM_STR);
		    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

		    if($stmt->execute()) {
		    	$stmt2 = $dbh->prepare("INSERT INTO Post (ID, Date, Time, comment) VALUES (:ID, :Date, :Time, :comment)");

		    	$stmt2->bindParam(':comment', $comment, PDO::PARAM_STR);
		    	$stmt2->bindParam(':ID', $ID, PDO::PARAM_STR);
		    	$stmt2->bindParam(':Date', $date, PDO::PARAM_STR);
		    	$stmt2->bindParam(':Time', $time, PDO::PARAM_STR);

		    	if($stmt2->execute()) {

		    		echo "<b>Comment Posted!</b><br><br>";
		    		echo "<a href = \"member_index.html\">Return to main menu</a>";

		    	} else echo "FAILED TO INSERT INTO POST.";
		    } else echo "FAILED TO INSERT INTO COMMENTS.";
    	} catch (PDOException $e) {
    	    print "Error!: " . $e->getMessage() . "<br/>";
    	    die();
    	}
    }

    if(isset($_POST['submit']))
      {
          ConfirmPost();

      } else echo "DID NOT ENTER IN COMMENT. RETURN TO PREVIOUS PAGE."


?>

</div>
</body>
</html>
