<html>
<body>
<div align="center">

<h1>Return Information </h1>
<p> Enter the following information. </p>

<?php
	$CarVin = $_GET["id"];
	$RID = $_GET["rid"];

	$Link = "ReturnConfirm.php?id=".$CarVin."&rid=".$RID;

	echo "<form action=".$Link." method=\"post\">";
?>

  Odometer at return: <br><input type="int(11)" name="odometer_return"><br><br>
  Length of rental in hours: <br><input type="int(10)" name="time"><br><br>
  <input id="button" type="submit" name="submit" value="Submit">
</form>

</div>
</body>
</html> 