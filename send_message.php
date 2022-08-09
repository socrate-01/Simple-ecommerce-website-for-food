<?php  
	require('connection.php');
	require('functions.php');

	$name=get_safe_value($con,$_POST['name']);
	$email=get_safe_value($con,$_POST['email']);
	$mobile=get_safe_value($con,$_POST['mobile']);
	$comment=get_safe_value($con,$_POST['comment']);
	$added_on=date('Y-m-d h:i:s');

	$sql = "INSERT INTO contact_us (name, email, mobile, comment, added_on) VALUES ('$name', '$email', '$mobile', '$comment', '$added_on')";
	if ($con->query($sql) === TRUE) {
	  echo "";
	} else {
	  echo "Error: " . $sql . "<br>" . $con->error;
	}
	echo "Votre message a bien été bien envoyé";
?>