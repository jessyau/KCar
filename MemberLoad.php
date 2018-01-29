<?php

	function Register()
	{
		include('config.php');

		$cxn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect: " . mysqli_error());

		$db = mysqli_select_db($cxn, $DB_NAME) or die("Failed to connect: " . mysqli_error());

		session_start(); //starting the session for user profile page

		if(!empty($_POST['ID'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
		{
			$query = mysqli_query($cxn, "SELECT * FROM Members where ID = '$_POST[ID]'") or die(mysql_error());
			$row_cnt = mysqli_num_rows($query);

			$date = date('Y-m-d');
			$ID = $_POST['ID'];
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$phone =  $_POST['phone'];
			$email = $_POST['email'];
			$credit_num = $_POST['credit_num'];
			$credit_expiry = $_POST['credit_expiry'];
			$pw =  $_POST['pw'];

			if($row_cnt < 1)
			{
				if(mysqli_query($cxn,"INSERT INTO `Members` VALUES ('$ID', '$fname', '$lname', '$phone', '$email', '$credit_num',
								'$credit_expiry', '$date', '$pw')"))
				{
					session_start(); //starting the session for user profile page
					$_SESSION['login_user'] = $_POST['ID'];
					echo "REGISTRATION SUCCESS";
					header('Location: member_index.html');
				}
			} else {
				echo "USER NAME ALREADY EXISTS. PLEASE CHOOSE ANOTHER USER NAME.";
			}
		} mysqli_close($cxn);
	}

	if(isset($_POST['submit']))
	{
			Register();
	}



?>
