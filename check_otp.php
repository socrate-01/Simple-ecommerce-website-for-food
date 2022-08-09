<?php  
	require('connection.php');
	require('functions.php');

	$type=get_safe_value($con,$_POST['type']); 
	$otp=get_safe_value($con,$_POST['otp']);

	if ($type=='email') {
		if ($otp==$_SESSION['EMAIL_OTP']) {
			echo "Done";
		}
		else
		{
			echo "no";
		}
	}
	if ($type=='mobile') {
		if ($otp==$_SESSION['MOBILE_OTP']) {
			echo "Done";
		}
		else
		{
			echo "no";
		}
	}
?>