 <?php  
   require('top.php');

   if (isset($_POST['submit2'])) {
     $sql1="truncate orders";
     $sql2="truncate order_detail";
     mysqli_query($con, $sql1);
     mysqli_query($con, $sql2);
   }
   if (isset($_GET['type']) && $_GET['type'] !='') {
      $type = get_safe_value($con,$_GET['type']);
       if ($type == 'delete') {
          $id = get_safe_value($con,$_GET['id']);
          $delete_sql="delete from orders where id='$id' ";
          $delete_sql1="delete from order_detail where order_id='$id' ";
          mysqli_query($con, $delete_sql);
          mysqli_query($con, $delete_sql1);
       }
   }
   
 ?>
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Commandes</h4>
                           
                           <form method="post">
                             <input type="submit" name="submit2" value="Supprimer toutes les factures">
                           </form>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">ID de la facture</th>
                                                <th class="product-name"><span class="nobr">Date de la facture</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Nom du client</span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Adresse du client </span></th>
                                                <th class="product-add-to-cart"><span class="nobr">Numéro de téléphone du client</span></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php  
                                            $sql="select * from orders";  
                                            $res=mysqli_query($con, $sql);
                                            while ($row=mysqli_fetch_assoc($res)){
                                          ?>
                                              <tr>
                                                <td class="product-add-to-cart"><a href="orders_details.php?id=<?php echo $row['id']; ?>&user=<?php echo $row['user_id']; ?>&nom=<?php echo $row['nom']; ?>"> <?php echo $row['id']; ?> </a></td>
                                                <td class="product-name"> <?php echo $row['added_on']; ?> </td>
                                                 <td class="product-name"> <?php echo $row['nom']; ?> </td>
                                                 <td class="product-name"> <?php echo $row['adresse']; ?> </td>
                                                 <td class="product-name"> <?php echo $row['numero']; ?> </td>
                                                  <td><?php 
                                          echo "&nbsp<a class='badge badge-delete' href='?type=delete&id=".$row['id']."'>Supprimer</a>";
                                       ?></td>
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