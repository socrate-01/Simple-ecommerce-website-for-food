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
                                    <center><h2 class="title__line--6">SE CONNECTER</h2></center>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="login-form" method="post">
                                    <div class="single-contact-form">
                                        <div>
                                            <input class="form-control" type="email" name="login_name" id="login_name" placeholder="Email*" style="width:100%" >
                                        </div>
                                        <span style="color: red; font-size:15px;" id="login_name_error"></span>
                                    </div>
                                    <br>
                                    <div class="single-contact-form">
                                        <div >
                                            <input class="form-control" type="password" name="login_password" id="login_password" placeholder="Password*" style="width:100%" >
                                        </div>
                                        <span style="color: red; font-size:15px;" id="login_password_error"></span>
                                    </div>
                                    <div class="form-output login_msg field_error">
                                        <p class="form-messege"></p>
                                    </div>
                                
                                    <div class="contact-btn">
                                        <center><button type="button" class="btn btn-common" onclick="user_login()">SE connecter</button>
                                        <br>

                                        </center>
                                    </div>
                                    <br>
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
            function user_login()
            {
                jQuery('.field_error').html('');
                var email=jQuery("#login_name").val();
                var password=jQuery("#login_password").val();
                var is_error='';

                if(email==""){
                    jQuery('#login_name_error').html('S\'il vous pla??t saisissez votre adresse email');
                    is_error='yes';
                }
                if(password==""){
                    jQuery('#login_password_error').html('S\'il vous pla??t saisissez votre mot de passe');
                    is_error='yes';
                }
                if(is_error=='')
                {   
                    jQuery.ajax({
                        url:'login_log.php',
                        type:'post',
                        data:'email='+email+'&password='+password,
                        success:function(result){
                            if(result=='wrong')
                            {
                                jQuery('.login_msg').html('Les informations que vous avez saisies sont invalides');
                            }
                            if(result=='valid')
                            {
                                window.location.href='index.php';
                            }
                        }
                    });
                }
            }
            function user_register()
            {
                jQuery('.field_error').html('');
                var name=jQuery("#name").val(); 
                var email=jQuery("#email").val();
                var mobile=jQuery("#mobile").val();
                var password=jQuery("#password").val();
                var is_error='';

                if(name==""){
                    jQuery('#name_error').html('S\'il vous pla??t saisissez votre nom');
                    is_error='yes';
                }
                if(email==""){
                    jQuery('#email_error').html('S\'il vous pla??t saisissez votre adresse email');
                    is_error='yes';
                }
                if(mobile==""){
                    jQuery('#mobile_error').html('S\'il vous pla??t saisissez votre num??ro de t??l??phone');
                    is_error='yes';
                }
                if(password==""){
                    jQuery('#password_error').html('S\'il vous pla??t saisissez un mot de passe');
                    is_error='yes';
                }
                if(is_error=='')
                {   
                    jQuery.ajax({
                        url:'register.php',
                        type:'post',
                        data:'name='+name+'&email='+email+'&mobile='+mobile+'&password='+password,
                        success:function(result){
                            if(result=='present')
                            {
                                jQuery('#email_error').html('Cet adresse email a d??j?? ??t?? utilis??');
                            }
                            if(result=='mobile_present')
                            {
                                jQuery('#mobile_error').html('Ce num??ro de t??l??phone a d??j?? ??t?? utilis??');
                            }
                            if(result=='insert')
                            {
                                jQuery('.register_msg').html('Merci de vous ??tre inscrit.Vous pouvez maintenant vous connecter et passer votre premi??re commande(Nous allons dans un instant r??actualiser la page)');
                                setTimeout(function(){ window.location.href=window.location.href; }, 5000);
                            }
                        }
                    });
                }
            }
            /*function mobile_sent_otp() {
                jQuery('#mobile_error').html('');
                var mobile=jQuery('#mobile').val();
                if (mobile=='') 
                {
                    jQuery('#mobile_error').html('S\'il vous pla??t num??ro de t??l??phone');
                }
                else
                {
                    jQuery('#mobile_button').html('Patientez...');
                    jQuery('#mobile_button').attr('disabled',true);
                    jQuery.ajax({
                        url:'send_otp.php',
                        type:'post',
                        data:'mobile='+mobile+'&type=mobile',
                        success:function(result){
                            if (result=='Done') 
                            {
                                jQuery('#mobile').hide();
                                jQuery('#mobile_button').hide();
                                jQuery('#mobile_otp').show();
                                jQuery('#mobile_otp_button').show();
                            } 
                            else if(result=='mobile_present'){
                                jQuery('#mobile_error').html('Cet num??ro de t??l??phone a d??j?? ??t?? utilis??');
                                jQuery('#mobile_button').html('Envoyer Code de v??rification');
                                jQuery('#mobile_button').attr('disabled',false);
                            }
                            else
                            {
                                jQuery('#mobile_button').html('Envoyer Code de v??rification');
                                jQuery('#mobile_button').attr('disabled',false);
                                jQuery('#mobile_error').html('Veuillez patienter s\'il vous pla??t! et v??rifier si votre connexion r??seau est active');
                            }
                        }
                    }); 
                }
            }
            function mobile_verify_otp() {
                jQuery('#mobile_error').html('');
                var otp=jQuery('#mobile_otp').val();
                if (otp=='') 
                {
                    jQuery('#mobile_error').html('S\'il vous pla??t saisissez le code de v??rification qu\'on vous a envoy?? par sms');
                }
                else{
                    jQuery.ajax({
                        url:'check_otp.php',
                        type:'post',
                        data:'otp='+otp+'&type=mobile',
                        success:function(result){
                            if (result=='Done') 
                            {
                                jQuery('#mobile').show();
                                jQuery('#mobile_otp').hide();
                                jQuery('#mobile_otp_button').hide();
                                jQuery('#mobile_otp_result').html('V??rification de votre num??ro de t??l??phone r??ussie, num??ro valide');
                                jQuery('#is_mobile_verified').val('1');
                                if (jQuery('#is_email_verified').val()==1) 
                                {
                                    jQuery('#btn_register').attr('disabled',false);
                                }
                            } 
                            else
                            {
                                jQuery('#mobile_error').html('Le code de v??rification que vous avez saisi n\'est pas valide'); 
                            }
                        }
                    });
                }
            }*/


            function email_sent_otp() {
                jQuery('#email_error').html('');
                var email=jQuery('#email').val();
                if (email=='') 
                {
                    jQuery('#email_error').html('S\'il vous pla??t saisissez votre adresse email');
                }
                else
                {
                    jQuery('#email_button').html('Patientez...');
                    jQuery('#email_button').attr('disabled',true);
                    jQuery.ajax({
                        url:'send_otp.php',
                        type:'post',
                        data:'email='+email+'&type=email',
                        success:function(result){
                            if (result=='Done') 
                            {
                                jQuery('#email').hide();
                                jQuery('#email_button').hide();
                                jQuery('#email_otp').show();
                                jQuery('#email_otp_button').show();
                            } 
                            else if(result=='present'){
                                jQuery('#email_error').html('Cet adresse email a d??j?? ??t?? utilis??');
                                jQuery('#email_button').html('Envoyer Code de v??rification');
                                jQuery('#email_button').attr('disabled',false);
                            }
                            else
                            {
                                jQuery('#email_button').html('Envoyer Code de v??rification');
                                jQuery('#email_button').attr('disabled',false);
                                jQuery('#email_error').html('Veuillez patienter s\'il vous pla??t! et v??rifier si votre connexion r??seau est active');
                            }
                        }
                    }); 
                }
            }
            function email_verify_otp() {
                jQuery('#email_error').html('');
                var otp=jQuery('#email_otp').val();
                if (otp=='') 
                {
                    jQuery('#email_error').html('S\'il vous pla??t saisissez le code de v??rification qu\'on vous a envoy?? par mail');
                }
                else{
                    jQuery.ajax({
                        url:'check_otp.php',
                        type:'post',
                        data:'otp='+otp+'&type=email',
                        success:function(result){
                            if (result=='Done') 
                            {
                                jQuery('#email').show();
                                jQuery('#email_otp').hide();
                                jQuery('#email_otp_button').hide();
                                jQuery('#email_otp_result').html('V??rification email r??ussie, email valide');
                                jQuery('#is_email_verified').val('1');
                                /*if (jQuery('#is_mobile_verified').val()==1) 
                                {*/
                                    jQuery('#btn_register').attr('disabled',false);
                                //}
                            } 
                            else
                            {
                                jQuery('#email_error').html('Le code de v??rification que vous avez saisi n\'est pas valide'); 
                            }
                        }
                    });
                }
            }
        </script>
<?php  
    require('footer.php');
?> 