<?php  
	require('top.php');
    $cat_id=mysqli_escape_string($con,$_GET['id']);
    $categories=mysqli_escape_string($con,$_GET['categories']);
    if ($cat_id>0) {
         $plat=mysqli_query($con, "select product.*, categories.categories from product,categories where product.status='1' and product.categories_id='$cat_id' and product.categories_id = categories.id");
    }
    else
    {
        ?>
            <script type="text/javascript">
                window.location.href='index.php';
            </script>
        <?php
    }
?>
        <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2 style="padding-top: 50px;" ></h2>
                        <p style="padding-top: 10px;">Catégories :  <?php echo $categories ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*"><?php echo $categories ?></button>
                            
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="row special-list">
                <?php  
                    while ($row=mysqli_fetch_assoc($plat)) {
                ?>
                    <div class="col-lg-4 col-md-6 special-grid drinks">
                        <div class="gallery-single fix">
                            <img height="300" src="<?php echo "media/product/".$row['image']; ?>"  alt="Image">
                            <div class="why-text">
                                <h4><?php echo $row['name']; ?></h4>
                                <p><?php echo $row['description']; ?></p>
                                <h5><?php echo $row['price']; ?></h5>
                                <center><p><a class="btn btn-lg btn-circle btn-outline-new-white" onclick="manage_cart('<?php echo $row['id'] ?>', 'add')">Ajouter au panier</a></p></center>
                            </div>
                        </div>
                    </div>
                <?php  
                    }
                ?>

                
            </div>
        </div>
        <script type="text/javascript">
             function sort_product_drop(cat_id,site_path) {
                 var sort_product_id=jQuery('#sort_product_id').val();
                 window.location.href=site_path+"categories.php?id="+cat_id+"&sort="+sort_product_id;
             }
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
        <!-- End Product Grid -->
        <!-- End Banner Area -->
<?php  
	require('footer.php');
?> 