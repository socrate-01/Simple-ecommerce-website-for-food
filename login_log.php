<?php  
	require('connection.php');
	require('functions.php');

	$email=get_safe_value($con,$_POST['email']);	
	$password=get_safe_value($con,$_POST['password']); 

	$sql="select * from users where email='$email' and password='$password' ";	
	$res=mysqli_query($con, $sql);
	$check_user=mysqli_num_rows($res);
	if ($check_user>0) {
		$row=mysqli_fetch_assoc($res);
		$_SESSION['USER_LOGIN']='yes';
		$_SESSION['USER_ID']=$row['id'];
		$_SESSION['USER_NAME']=$row['name'];
		$_SESSION['USER_EMAIL']=$row['email'];
		$_SESSION['USER_MOBILE']=$row['mobile'];
		echo "valid";
	}
	else
	{
		echo "wrong";
	}
?>