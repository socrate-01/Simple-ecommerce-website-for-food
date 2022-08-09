<?php  
	require('top.php');
    if (!isset($_SESSION['USER_LOGIN'])) {
        ?>
            <script type="text/javascript">
                window.location.href='login.php';
            </script>
        <?php
    }
    $uid=$_SESSION['USER_ID'];

    if (isset($_GET['id'])) {
        $wid=$_GET['id'];
        mysqli_query($con,"delete from wishlist where id='$wid' and user_id='$uid' ");
        ?>
            <script type="text/javascript">
                window.location.href='wishlist.php';
            </script>
        <?php
    }

    $res=mysqli_query($con,"select product.id as idp,product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid' ");
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
                                  <span class="breadcrumb-item active">Produits favoris</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">Produits</th>
                                            <th class="product-name">Nom des produits</th>
                                            <th class="product-remove">Supprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  
                                            while ($row=mysqli_fetch_assoc($res)) {
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image'] ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="product.php?id=<?php echo $row['idp']; ?>"><?php echo $row['name'] ?></a>
                                                <ul  class="pro__prize">
                                                    <li class="old__prize"><?php echo $row['mrp'] ?></li>
                                                    <li><?php echo $row['price'] ?></li>
                                                </ul>
                                            </td>
                                            <td class="product-remove"><a href="wishlist.php?id=<?php echo $row['id'] ?>" ><i class="icon-trash icons"></i></a></td> 
                                            
                                        </tr>
                                        <?php  
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="<?php echo SITE_PATH ?>">Continuer Shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function manage_cart(pid,type)
            {
                var qty=jQuery("#"+pid+"qty").val();
                jQuery.ajax({
                    url:'manage_cart.php',
                    type:'post',
                    data:'pid='+pid+'&qty='+qty+'&type='+type,
                    success:function(result){
                        window.location.href='cart.php';
                        jQuery('.htc__qua').html(result);
                    }
                });
            }
        </script>
<?php  
	require('footer.php');
?> 