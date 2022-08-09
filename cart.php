<?php  
	require('top.php');
?>
        <div class="container" style="padding-top: 100px;">
            <table class="table table-light">
              <thead>
                <tr>
                  <th scope="col">Produits</th>
                  <th scope="col">Nom des produits</th>
                  <th scope="col">Prix</th>
                  <th scope="col">Quantité</th>
                  <th scope="col">Total</th>
                  <th scope="col">Supprimer</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                        if(isset($_SESSION['cart']))
                        {
                            foreach ($_SESSION['cart'] as $key=>$val) {
                            $productArr=get_product($con,'','',$key,'','');
                            $qty=$val['qty'];
                    ?>
                    <tr>
                        <td ><a href="#"><img height="50" width="50" src="<?php echo "media/product/".$productArr[0]['image'] ?>" alt="product img" /></a></td>
                        <td ><a href="#"><?php echo $productArr[0]['name'] ?></a></td>
                        <td><span><?php echo $productArr[0]['price'] ?></span></td>
                        <td><input onchange="manage_cart('<?php echo $key ?>', 'update')" type="number" id="<?php echo $key?>qty" value="<?php echo $qty ?>" />&nbsp;&nbsp;</td>
                        <td><?php echo $productArr[0]['price']*$qty ?></td>
                                            <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>', 'remove')"><i class="fas fa-trash"></i></a></td> 
                    </tr>                        
                    <?php  
                        }
                    }
                    ?>
              </tbody>
            </table>
            
            <div class="row" style="padding-bottom: 50px;">
                <a class="btn btn-secondary" href="index.php">Retourner à l'accueil</a>
                <!-- <p style="font-size: 20px;margin-left: 10px;color: red;">Vous ne pouvez plus commander</p> -->
                <a style="margin-left: 10px;" class="btn btn-secondary" href="checkout.php">Saisir les données du client</a>
                
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