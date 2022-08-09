<?php  
	require('connection.php');
	require('functions.php');
	$msg = '';
	if (isset($_POST['submit'])) 
	{
		$username= get_safe_value($con,$_POST['username']);
		$password= get_safe_value($con,$_POST['password']);
		$sql = "SELECT * from admin_users where username='$username' AND password='$password' ";
		$res = mysqli_query($con, $sql);
		$count = mysqli_num_rows($res);
		if ($count >0) {
         $row=mysqli_fetch_assoc($res);
         if ($row['status'] ==1 ) {
   			$_SESSION['ADMIN_LOGIN']='yes';
   			$_SESSION['ADMIN_USERNAME']= $username;
            $_SESSION['ADMIN_ROLE']= $row['role'];
            $_SESSION['ADMIN_ID']= $row['id'];
   			header('location:orders.php');
   			die();
         }
         else
         {
            $msg='Votre compte a été désactivé veuillez contacter l\'administrateur de ce site.';
         }
		}
		else
		{
			$msg='Les informations que vous avez saisies sont invalides';
		}
	}
?>
<!doctype html>
<html class="no-js" lang="">
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title> LOGIN ADMIN</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/normalize.css">
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets/css/font-awesome.min.css">
      <link rel="stylesheet" href="assets/css/themify-icons.css">
      <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
      <link rel="stylesheet" href="assets/css/flag-icon.min.css">
      <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
   </head>
   <body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
            <div class="login-content">
               <div class="login-form mt-150">
                  <form method="post">
                     <div class="form-group">
                        <label>Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur" required="">
                     </div>
                     <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required="">
                     </div>
                     <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Se connecter</button>
                     <div class="field_error">
                     	<?php echo $msg; ?>	
                     </div>
					</form>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>