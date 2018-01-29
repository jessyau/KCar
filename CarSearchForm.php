<html>
<body>
<div align="center">

<h1> Car Search </h1>


<form action="CarSearchResults.php" method="post">
  Pick Up Date <br><input type="date" name="pick_up_date" min="<?php echo date('Y-m-d'); ?>"><br><br>
  Time Of Pick Up: <br><input type="time" name="pick_up_time" min="08:00" max="20:00" step="900"><br><br>
  Length of Reservation (Hours): <br><input type="number" name="length" id="length"
                					min="1" max="120" step="1" value="1"><br><br>
  Location: <br><input type="varchar(20)" name="location"><br><br>
  <input id="button" type="submit" name="submit" value="Search">
</form>

</div>
</body>
</html> 