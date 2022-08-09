<?php  
	require('connection.php');
	require('functions.php');

	$name=get_safe_value($con,$_POST['name']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$password=get_safe_value($con,$_POST['password']); 

	$sql="select * from users where email='$email' ";	
	$res=mysqli_query($con, $sql);
	$check_user=mysqli_num_rows($res);

	$sql1="select * from users where mobile='$mobile' ";	
	$res1=mysqli_query($con, $sql1);
	$check_mobile=mysqli_num_rows($res1);

	if ($check_user>0) {
		echo "present"; 
	}elseif ($check_mobile>0) {
		echo "mobile_present"; 
	}
	else
	{
		$added_on=date('Y-m-d h:i:s');
		$sql="insert into users(name,email,mobile,password,added_on) values('$name','$email','$mobile','$password','$added_on')";
		if ($con->query($sql) === TRUE) {
		  echo "insert";
		} else {
		  echo "Error: " . $sql . "<br>" . $con->error;
		}
		
	}
?>