  <?php  
	require('connection.php');
	require('functions.php');

	if (!isset($_SESSION['USER_LOGIN'])) {
        ?>
            <script type="text/javascript">
                window.location.href='index.php';
            </script>
        <?php
    }

	$current_password=get_safe_value($con,$_POST['currentpassword']); 
	$new_password=get_safe_value($con,$_POST['newpassword']);
	$uid=$_SESSION['USER_ID'];

	$row=mysqli_fetch_assoc(mysqli_query($con,"select password from users where id='$uid' "));

	if ($row['password']!=$current_password) {
		echo "Le mot de passe que vous avez saisi est invalide";
	}
	else
	{
		$sql="update users set password='$new_password' where id='$uid' ";
		mysqli_query($con,$sql);
		echo "La modification de votre mot de passe est un succès";
	}
?> 