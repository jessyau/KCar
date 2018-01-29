<!DOCTYPE html>
<html>
<body>
<div align="center">

<h1> New Car Registration </h1>

<?php

	function RegisterCar()
	{
		include('config.php');

		$cxn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect: " . mysqli_error());

		$db = mysqli_select_db($cxn, $DB_NAME) or die("Failed to connect: " . mysqli_error());

		session_start(); //starting the session for user profile page

		if(!empty($_POST['VIN'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
		{
			$query = mysqli_query($cxn, "SELECT * FROM Car where VIN = '$_POST[VIN]'") or die(mysql_error());
			$row_cnt = mysqli_num_rows($query);

			$VIN = $_POST['VIN'];
			$branch_ID = $_POST['branch_ID'];
			$make = $_POST['make'];
			$model = $_POST['model'];
			$year =  $_POST['year'];
			$status = $_POST['status'];
			$last_odometer = $_POST['last_odometer'];
			$last_gas = $_POST['last_gas'];

			if($row_cnt < 1)
			{
				if(mysqli_query($cxn,"INSERT INTO `Car` VALUES ('$VIN', '$make', '$model', '$year', '$status', '$last_odometer',
								'$last_gas')"))
				{
					if(mysqli_query($cxn,"INSERT INTO `Parks_At` VALUES ('$VIN', '$branch_ID')"))
					{
						echo "REGISTRATION SUCCESS";
						echo "<br><a href=\"admin_index.html\">Return to main menu</a>";
					} else echo "FAILED TO INSERT INTO PARKS_AT.";
				} else echo "FAILED TO INSERT INTO CAR.";
			} else {
				echo "VIN ALREADY EXISTS. PLEASE CHOOSE ANOTHER VIN.";
			}
		} mysqli_close($cxn);
	}

	if(isset($_POST['submit']))
	{
			RegisterCar();
	}

?>

</div>
</body>
</html>
