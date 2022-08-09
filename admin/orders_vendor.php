 <?php  
   require('top.php');
 ?>
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Commandes</h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">ID de la commande</th>
                                                <th class="product-name"><span class="nobr">Nom du produit</th>
                                                <th class="product-price"><span class="nobr"> Quantité Commandée </span></th>
                                                <th class="product-stock-stauts"><span class="nobr">Type de paiment</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Statut du paiment</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Statut de la commande </span></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php  
                                            $sql="select order_detail.qty,product.name,orders.*,order_status.name as names from order_detail,product,orders,order_status where orders.order_status=order_status.id and product.id=order_detail.product_id and orders.id=order_detail.order_id and product.added_by='".$_SESSION['ADMIN_ID']."' order by orders.id desc";  
                                            $res=mysqli_query($con, $sql);
                                            while ($row=mysqli_fetch_assoc($res)){
                                          ?>
                                              <tr>
                                                <td class="product-add-to-cart"> <?php echo $row['id']; ?></td>
                                                <td class="product-name"> <?php echo $row['name']; ?> </td>
                                                <td class="product-name"> 
                                                  <?php echo $row['qty']; ?> 
                                                </td>
                                                <td class="product-name"> <?php echo $row['payment_type']; ?> </td>
                                                <td class="product-name"> <?php echo $row['payment_status']; ?> </td>
                                                <td class="product-name"> <?php echo $row['names']; ?> </td>
                                              </tr>
                                            <?php  
                                              }
                                            ?>
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