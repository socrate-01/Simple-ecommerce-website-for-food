<?php  
	require('top.php');
    if (!isset($_SESSION['USER_LOGIN'])) {
        ?>
            <script type="text/javascript">
                window.location.href='login.php';
            </script>
        <?php
    }
?>
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(images/bg/bgziz1.png) no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner">
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.php">Accueil</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                                  <span class="breadcrumb-item active">Mon profil</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Contact Area -->
        <section class="htc__contact__area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <h2 class="title__line--6">Mon profil</h2>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form id="login-form" method="post">
                                    <div class="single-contact-form">
                                        <label>Changez votre nom</label>
                                        <div class="contact-box name">
                                            <input type="text" name="name" id="name" placeholder="Nom complet*" style="width:100%" value="<?php  echo $_SESSION['USER_NAME'] ?>">
                                        </div>
                                        <span class="field_error" id="name_error"></span>
                                    </div>
                                    <div class="contact-btn">
                                        <button id="btn_submit" type="button" class="fv-btn" onclick="update_profile()" >Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="contact-form-wrap mt--60">
                            <div class="col-xs-12">
                                <div class="contact-title">
                                    <h2 class="title__line--6">Changer votre mot de passe</h2>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <form method="post" id="passwordForm">
                                    <div class="single-contact-form">
                                        <label>Saisissez votre mot de passe actuel</label>
                                        <div class="contact-box name">
                                            <input type="password" name="current_password" id="current_password" style="width:100%" >
                                        </div>
                                        <span class="field_error" id="current_password_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <label>Saisissez votre nouveau mot de passe</label>
                                        <div class="contact-box name">
                                            <input type="password" name="new_password" id="new_password" style="width:100%" >
                                        </div>
                                        <span class="field_error" id="new_password_error"></span>
                                    </div>
                                    <div class="single-contact-form">
                                        <label>Confirmez votre nouveau mot de passe</label>
                                        <div class="contact-box name">
                                            <input type="password" name="confirm_new_password" id="confirm_new_password" style="width:100%" >
                                        </div>
                                        <span class="field_error" id="confirm_new_password_error"></span>
                                    </div>
                                    <div class="contact-btn">
                                        <button id="btn_submit_pass" type="button" class="fv-btn" onclick="update_password()" >Mettre à jour</button>
                                    </div>
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
            function update_profile() {
                jQuery('#name_error').html('');
                var name=jQuery('#name').val();
                if (name=='') 
                {
                    jQuery('#name_error').html('S\'il vous plaît saisissez votre nom complet');
                }
                else
                {
                    jQuery('#btn_submit').html('Patientez...');
                    jQuery('#btn_submit').attr('disabled',true);
                     jQuery.ajax({
                        url:'update_profile.php',
                        type:'post',
                        data:'name='+name,
                        success:function(result) {
                            jQuery('#name_error').html(result);
                            jQuery('#btn_submit').html('Mettre à jour');
                            jQuery('#btn_submit').attr('disabled',false);
                        }
                     });
                }
            }
            function update_password() {
                jQuery('#current_password_error').html('');
                jQuery('#new_password_error').html('');
                jQuery('#confirm_new_password_error').html('');
                var current_password=jQuery('#current_password').val();
                var new_password=jQuery('#new_password').val();
                var confirm_new_password=jQuery('#confirm_new_password').val();
                var is_error='';
                if (current_password=='') 
                {
                    jQuery('#current_password_error').html('S\'il vous plaît saisissez votre mot de passe');
                    is_error='yes';
                }
                if (new_password=='') 
                {
                    jQuery('#new_password_error').html('S\'il vous plaît saisissez votre nouveau mot de passe');
                    is_error='yes';
                }
                if (confirm_new_password=='') 
                {
                    jQuery('#confirm_new_password_error').html('Confirmez votre nouveau mot de passe');
                    is_error='yes';
                }

                if (new_password!='' && confirm_new_password!='' && new_password!=confirm_new_password) 
                {
                    jQuery('#confirm_new_password_error').html('Veuillez à bien confirmer votre nouveau mot de passe');
                    is_error='yes';
                }
                if (is_error=='') 
                {
                    jQuery('#btn_submit_pass').html('Patientez...');
                    jQuery('#btn_submit_pass').attr('disabled',true);
                     jQuery.ajax({
                        url:'update_password.php',
                        type:'post',
                        data:'currentpassword='+current_password+'&newpassword='+new_password,
                        success:function(result) {
                            jQuery('#current_password_error').html(result);
                            jQuery('#btn_submit_pass').html('Mettre à jour');
                            jQuery('#btn_submit_pass').attr('disabled',false);
                            jQuery('#passwordForm')[0].reset();
                        }
                     });
                }
            }
        </script>
<?php  
	require('footer.php');
?> 