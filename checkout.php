<?php  
	require('top.php');
    $nbproduit=0;
    if (!isset($_SESSION['cart']) || count($_SESSION['cart'])==0 ) {
        ?>
            <script type="text/javascript">
                window.location.href='index.php';
            </script>
        <?php
    }
    $cart_total=0;
    if(isset($_SESSION['cart']))
    {
        foreach ($_SESSION['cart'] as $key=>$val) {
            $productArr=get_product($con,'','',$key,'','');
            $qty=$val['qty'];
            $cart_total=$cart_total+($qty*$productArr[0]['price']);
        }
    }

    if ( isset($_POST['submit']) ) {
        $nom =  get_safe_value($con,$_POST['nom']);
        $adresse =  get_safe_value($con,$_POST['adresse']);
        $numero =  get_safe_value($con,$_POST['numero']);
        $user_id=$_SESSION['USER_ID'];
        $total_price=$cart_total;
        $payment_status='Non fait';
        $order_status='1';
        $added_on=date('Y-m-d h:i:s');
        $sql="insert into orders(user_id,nom,adresse,numero,total_price,added_on) values ('$user_id','$nom','$adresse','$numero','$total_price','$added_on')";
        if ($con->query($sql) === TRUE) {
            $order_id=mysqli_insert_id($con);
            foreach ($_SESSION['cart'] as $key=>$val) {
                $productArr=get_product($con,'','',$key,'','');
                $qty=$val['qty'];
                $price=$productArr[0]['price'];
                $sql="insert into order_detail(order_id,product_id,qty,price,added_on) values('$order_id','$key','$qty','$price','$added_on')";
                if ($con->query($sql) === TRUE) {
                    unset($_SESSION['cart']);
                    ?>
                        <script type="text/javascript">
                            window.location.href='my_order.php';
                        </script>
                    <?php
                } else {
                  echo "Error: " . $sql . "<br>" . $con->error;
                }

            }
        } else {
          echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
?>
        
        <div class="checkout-wrap ptb--100" style="padding-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="checkout__inner">
                            <div class="accordion-list">
                                <div class="accordion">
                                    
                                    <?php 
                                        if (!isset($_SESSION['USER_LOGIN'])) {
                                    ?>
                                    <div class="col-xs-12">
                                        <div class="contact-title">
                                            <h2 class="title__line--6">SE CONNECTER</h2>
                                        </div>
                                    </div>
                                    <div class="accordion__body">
                                        <div class="accordion__body__form">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <div class="checkout-method__login">
                                                        <form id="login-form">
                                                            <div class="single-contact-form">
                                                                <div >
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
                                                                <a href="forget_password.php" style="margin-left: 10px;font-size: 20px;">J'ai oublié mon mot de passe</a>
                                                                </center>
                                                            </div>

                                                        </form>

                                                        <!--<form action="#">
                                                            <h5 class="checkout-method__title">Login</h5>
                                                            <div class="single-input">
                                                                <label for="user-email">Email Address</label>
                                                                <input type="email" id="user-email">
                                                            </div>
                                                            <div class="single-input">
                                                                <label for="user-pass">Password</label>
                                                                <input type="password" id="user-pass">
                                                            </div>
                                                            <p class="require">* Required fields</p>
                                                            <div class="dark-btn">
                                                                <a href="#">LogIn</a>
                                                            </div>
                                                        </form>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <?php 
                                        if (isset($_SESSION['USER_LOGIN'])) {
                                    ?>
                                    <div class="accordion__title">
                                        INFORMATIONS SUR LE CLIENT
                                    </div>
                                            <form method="post" >
                                                <input name="nom" class="form-control" type="text"  placeholder="saisissez le nom complet du client*" style="width:100%" >
                                                <br>
                                                <input name="adresse" class="form-control" type="text"  placeholder="saisissez l'adresse du client*" style="width:100%" >
                                                <br>
                                                <input name="numero" class="form-control" type="text"  placeholder="saisissez le numéro de téléphone*" style="width:100%" >
                                                <br>
                                                <input class="btn btn-common" type="submit" name="submit" value="Finaliser la facturation">
                                            </form>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="jumbotron">
                            <div class="order-details">
                                <center><h2 class="order-details__title">Votre Commande</h2></center>
                                <hr>
                                <div class="order-details__item">
                                    <?php  
                                        $cart_total=0;
                                        if(isset($_SESSION['cart']))
                                        {
                                        foreach ($_SESSION['cart'] as $key=>$val) {
                                            
                                            $productArr=get_product($con,'','',$key,'','');
                                            $qty=$val['qty'];
                                            $nbproduit += $qty;
                                            $cart_total=$cart_total+($qty*$productArr[0]['price']);
                                    ?>
                                    <div class="row">
                                        <div >
                                            <img height="50" width="50" src="<?php echo "media/product/".$productArr[0]['image'] ?>" >
                                        </div>
                                        <div >
                                            <a href="#"><?php echo $productArr[0]['name'] ?></a>
                                            <span class="price"><?php echo $productArr[0]['price'] ?></span>
                                            <span class="price">Quantité : <?php echo $qty ?></span>
                                        </div>
                                        <div >
                                            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>', 'remove')" ><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <?php
                                        }
                                        }
                                    ?>
                                </div>
                                <hr>
                                <center><div class="ordre-details__total">
                                    <h2>Total de la commande</h2>
                                    <h2><?php echo $cart_total ?></h2>
                                    <h2>+Livraison : <?php echo $nbproduit * 150 ?> </h2>
                                    <h2>=</h2>
                                    <h2><?php echo $cart_total + ($nbproduit * 150) ?></h2>
                                </div>
                                </center>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function manage_cart(pid,type)
            {
                var qty=0;
                jQuery.ajax({
                    url:'manage_cart.php',
                    type:'post',
                    data:'pid='+pid+'&qty='+qty+'&type='+type,
                    success:function(result){
                        window.location.href='checkout.php';
                        jQuery('.htc__qua').html(result);
                    }
                });
            }
            function user_login()
            {
                jQuery('.field_error').html('');
                var email=jQuery("#login_name").val();
                var password=jQuery("#login_password").val();
                var is_error='';

                if(email==""){
                    jQuery('#login_name_error').html('S\'il vous plaît saisissez votre adresse email');
                    is_error='yes';
                }
                if(password==""){
                    jQuery('#login_password_error').html('S\'il vous plaît saisissez votre mot de passe');
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
                                window.location.href='checkout.php';
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
                    jQuery('#name_error').html('S\'il vous plaît saisissez votre nom');
                    is_error='yes';
                }
                if(email==""){
                    jQuery('#email_error').html('S\'il vous plaît saisissez votre adresse email');
                    is_error='yes';
                }
                if(mobile==""){
                    jQuery('#mobile_error').html('S\'il vous plaît saisissez votre numéro de téléphone');
                    is_error='yes';
                }
                if(password==""){
                    jQuery('#password_error').html('S\'il vous plaît saisissez un mot de passe');
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
                                jQuery('#email_error').html('Cet adresse email a déjà été utilisé');
                            }
                            if(result=='insert')
                            {
                                jQuery('.register_msg').html('Merci de vous être inscrit.Vous pouvez maintenant vous connecter et passer votre première commande');
                            }
                        }
                    });
                }
            }
        </script>

<?php  
	require('footer.php');
?> 