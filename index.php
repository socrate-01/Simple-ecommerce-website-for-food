<?php  
	require('top.php');
?>
 <!-- Start slides -->
    <div id="slides" class="cover-slides">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                    <div class="inner-column">
                        <h1>Bienvenue dans notre <span>site de facturation</span></h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End slides -->
    
    <!-- Start About -->
    
    <!-- Start Menu -->
    
    </div>
    <!-- End Menu -->
        <script type="text/javascript">
            function manage_cart(pid,type)
            {
                var qty=1;
                jQuery.ajax({
                    url:'manage_cart.php',
                    type:'post',
                    data:'pid='+pid+'&qty='+qty+'&type='+type,
                    success:function(result){
                        jQuery('.htc__qua').html(result);
                    }
                });
            }
            function wishlist_manage(pid,type){
                jQuery.ajax({
                    url:'wishlist_manage.php',
                    type:'post',
                    data:'pid='+pid+'&type='+type,
                    success:function(result){
                        if (result=='not_login') 
                        {
                            window.location.href='login.php';
                        }
                        if (result=='already_added') 
                        {
                            
                        }
                        else
                        {
                            jQuery('.htc__wishlist').html(result);
                        }
                        
                    }
                });
            }
        </script>
<?php  
	require('footer.php');
?> 