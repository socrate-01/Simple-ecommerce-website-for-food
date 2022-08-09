<?php  
	require('connection.php');
	require('functions.php');

	
	$pid=get_safe_value($con,$_POST['pid']);	
	$type=get_safe_value($con,$_POST['type']);  
	$added_on=date('Y-m-d h:i:s');

	if ( isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!='') {
		$uid=$_SESSION['USER_ID'];
		$sql="select * from wishlist where user_id='$uid' and product_id='$pid' ";
		$res=mysqli_query($con,$sql);
		if (mysqli_num_rows($res)>0) {
			echo "already_added";
		}
		else
		{
			mysqli_query($con,"insert into wishlist(user_id,product_id,added_on) values('$uid','$pid','$added_on')");	
			$res1=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid' "));
			echo $res1;
		}
	}
	else
	{
		echo "not_login";
	}
?>