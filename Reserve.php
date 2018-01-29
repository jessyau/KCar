<!DOCTYPE html>
 <html>
 <body>
 <div align="center">

 <h1> Reservation Form </h1>

<?php

$link = "Confirmation.php?id=".$_GET["id"];

 echo "<form action=".$link." method=\"post\">";
 ?>

   Confirm Pick Up Date <br><input type="date" name="pick_up_date" min="<?php echo date('Y-m-d'); ?>"><br><br>
   Confirm Time Of Pick Up <br><input type="time" name="pick_up_time" min="08:00" max="20:00" step="900"><br><br>
   First Name <br><input type="varchar(20)" name="fname"><br><br>
   Last Name <br><input type="varchar(20)" name="lname"><br><br>
   Phone Number <br><input type="decimal(30)" name="phone"><br><br>
   <input id="button" type="submit" name="submit" value="Reserve">
 </form>



 </div>
 </body>
 </html> 