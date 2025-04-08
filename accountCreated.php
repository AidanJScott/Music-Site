<?php 
    require_once '../reg_conn.php';
	session_start();
	if (isset($_COOKIE['PHPSESSID']) AND isset($_SESSION['name']) AND isset($_SESSION['email'])) {
		$name = $_SESSION['name'];
		$message = "Thank you, $name for creating an account!";
		$message2 = "Please log in <a href=\"login.php\">here</a>";
	} else { 
		$message = 'You have reached this page in error';
		$message2 = 'Please use the menu at the right';	
	}
	//The require header is deferred until session variables are set so that the menu can display correctly
	require 'includes/header.php';
	// Print the message:
	echo '<h2 style="text-align:center">'.$message.'</h2>';
	echo '<h3 style="text-align:center">'.$message2.'</h3>';
	// Include the footer and quit the script:
	include ('includes/footer.php'); 	
?>