<?php

	function LogIn()
	{
		include("config.php");

		$cxn = mysqli_connect($DB_HOST,$DB_USER,$DB_PASSWORD) or die("Failed to connect: " . mysqli_error());

		$db = mysqli_select_db($cxn, $DB_NAME) or die("Failed to connect: " . mysqli_error());


		if(!empty($_POST['ID']) || !empty($_POST['pw'])) //checking the 'user' name which is from Sign-In.html, is it empty or have some text
		{
			$member_query = mysqli_query($cxn, "SELECT * FROM Members where ID = '$_POST[ID]' AND pw = '$_POST[pw]'") or die(mysql_error());
			$admin_query = mysqli_query($cxn, "SELECT * FROM Admin where ID = '$_POST[ID]' AND pw = '$_POST[pw]'") or die(mysql_error());
			$mem_row_cnt = mysqli_num_rows($member_query);
			$admin_row_cnt = mysqli_num_rows($admin_query);

			session_start(); //starting the session for user profile page

			if($mem_row_cnt > 0)
			{
				$_SESSION['login_user'] = $_POST['ID'];
				header('Location: member_index.html');
			} else if($admin_row_cnt > 0) {
				$_SESSION['login_user'] = $_POST['ID'];
				header('Location: admin_index.html');
			} else {
				echo "SORRY... YOU ENTERED WRONG ID AND PASSWORD... PLEASE RETRY...";
			}
		} else {
			echo "INVALID USER NAME AND/OR PASSWORD";
		} mysqli_close($cxn);
	}

	if(isset($_POST['submit']))
		{
			LogIn();
		}

?>


