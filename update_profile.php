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

	$name=get_safe_value($con,$_POST['name']); 
	$uid=$_SESSION['USER_ID'];
	$sql="update users set name='$name' where id='$uid' ";
	mysqli_query($con,$sql);
	$_SESSION['USER_NAME']=$name;
	echo "Votre nom a été modifié";
?> 