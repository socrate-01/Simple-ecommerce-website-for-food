<?php  
	require('top.php');
    if (isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']=='yes'){
        ?>
        <script type="text/javascript">
            window.location.href='my_order.php';
        </script>
        <?php
    }
?>

        <section class="htc__contact__area ptb--100 bg__white" style="padding-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <center><h2 class="title__line--6">Mot de passe oublié</h2></center>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="login-form" method="post">
                                    <div class="single-contact-form">
                                        <div >
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Email*" style="width:100%" >
                                        </div>
                                        <span style="color: red; font-size:15px;" id="email_error"></span>
                                    </div>
                                    <br>
                                    <div class="contact-btn">
                                        <center><button id="btn_submit" type="button" class="btn btn-common" id="email_button" onclick="forget_password()" >Soumettre</button></center>
                                    </div>
                                    <br>
                                </form>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </section>
        <input type="textbox" id="is_email_verified" style="display: none;">
        <input type="textbox" id="is_mobile_verified" style="display: none;">
        <script type="text/javascript">
            function forget_password() {
                jQuery('#email_error').html('');
                var email=jQuery('#email').val();
                if (email=='') 
                {
                    jQuery('#email_error').html('S\'il vous plaît saisissez votre adresse email');
                }
                else
                {
                    jQuery('#btn_submit').html('Patientez...');
                    jQuery('#btn_submit').attr('disabled',true);
                     jQuery.ajax({
                        url:'forget_password_submit.php',
                        type:'post',
                        data:'email='+email,
                        success:function(result) {
                            jQuery('#btn_submit').html('Soumettre');
                            jQuery('#btn_submit').attr('disabled',false);
                            if(result=="Veuillez consulter votre mail pour recupérer votre mot de passe") 
                            {
                                jQuery('#btn_submit').hide();
                                jQuery('#email_error').html(result);
                            }
                            else if (result=="Cet adresse email n'est pas inscrit.") 
                            {
                                jQuery('#email_error').html(result);
                            }
                            else
                            {
                                jQuery('#email_error').html('Veuillez patienter s\'il vous plaît! et vérifier si votre connexion réseau est active');
                            }
                        }
                     });
                }
            }
        </script>
<?php  
	require('footer.php');
?> 