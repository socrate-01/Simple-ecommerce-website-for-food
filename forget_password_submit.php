<?php  
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;


	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	require('connection.php');
	require('functions.php');

		$email=get_safe_value($con,$_POST['email']);
		$sql="select * from users where email='$email' ";	
		$res=mysqli_query($con, $sql);
		$check_user=mysqli_num_rows($res);

		if ($check_user>0) {
			$row=mysqli_fetch_assoc($res);
			$pwd=$row['password'];
			$html="Votre mot de passe est <strong>$pwd</strong>";
			$mail =new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host="smtp.gmail.com";
			$mail->Post=587;
			$mail->SMTPSecure="tls";
			$mail->SMTPAuth=true;
			$mail->Username="fanami283";
			$mail->Password="fanami@@##20002000";
			$mail->SetFrom("baabdoulaziz00@gmail.com");
			$mail->addAddress("$email");
			$mail->IsHTML(true);
			$mail->Subject="ZIZFOOD Mot de passe oublie";
			$mail->Body=$html;
			$mail->SMTPOptions=array('ssl'=>array(
				'verify_peer'=>false,
				'verify_peer_name'=>false,
				'allow_self_signed'=>false
			));
			if ($mail->send()) {
				echo "Veuillez consulter votre mail pour recupérer votre mot de passe";
			}else{
				//echo "Error occur";
			}
		}
		else
		{
			echo "Cet adresse email n'est pas inscrit."; 
			die();
		}
?>