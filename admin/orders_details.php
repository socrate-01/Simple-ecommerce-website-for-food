 <?php  
   require('top.php');
   $order_id=get_safe_value($con,$_GET['id']);
   $user_id=get_safe_value($con,$_GET['user']);

 ?>
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Détails Commandes ID : <?php echo $order_id; ?></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">Nom du produit</th>
                                                <th class="product-thumbnail">Image du produit</th>
                                                <th class="product-name"><span class="nobr">Quantité</span></th>
                                                <th class="product-price"><span class="nobr"> Prix </span></th>
                                                <th class="product-price"><span class="nobr"> Prix Total </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php  
                                                $total_price=0;
                                            $sql="select order_detail.*, product.name, product.image from order_detail,product where order_detail.order_id='$order_id' and order_detail.product_id=product.id"; 
                                            $res=mysqli_query($con, $sql);
                                            while ($row=mysqli_fetch_assoc($res)){
                                                    $total_price=$total_price+($row['qty']*$row['price']);
                                          ?>
                                              <tr>
                                                <td class="product-add-to-cart"><a href="#"> <?php echo $row['name']; ?> </a></td>
                                                <td class="product-name"> <img src="<?php echo "../media/product/".$row['image']; ?>" > </td>
                                                <td class="product-name"> <?php echo $row['qty']; ?> </td>
                                                <td class="product-name"> <?php echo $row['price']; ?> </td>
                                                <td class="product-name"> <?php echo $row['qty']*$row['price']; ?> </td>
                                              </tr>
                                            <?php  
                                              }
                                            ?>
                                                <tr>
                                                    <td class="product-name" colspan="3"></td>
                                                    <td class="product-name">TOTAL</td>
                                                    <td class="product-name"> <?php echo $total_price; ?> </td>
                                                </tr>
                                        </tbody>
                                    </table>




                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
		  </div>
 <?php  
   require('footer.php');
 ?>