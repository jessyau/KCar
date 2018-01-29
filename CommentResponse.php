<!DOCTYPE html>
<html>
<body>
<div align="center">

<h1> Leave a response! </h1>

<?php

	$ID = $_GET["id"];
	$comment = $_GET["com"];

	echo "<form action=\"ResponseLoad.php?id=".$ID."&com=".$comment."\" method=\"post\">"
?>

  Response: <br><input type="text" name="response"><br><br>
  <input id="button" type="submit" name="submit" value="Respond">
</form>

<br><a href="admin_index.html">Return to main menu</a>

</div>
</body>
</html> 