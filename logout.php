<?php  
	session_start();
	unset($_SESSION['USER_LOGIN']);
	unset($_SESSION['USER_ID']);
	unset($_SESSION['USER_NAME']);
	unset($_SESSION['USER_EMAIL']);
	unset($_SESSION['USER_MOBILE']);
	unset($_SESSION['cart']);
	header('location:index.php');
	die();
?>
