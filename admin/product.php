 <?php  
   require('top.php');
   isAdmin();
   $uid= get_safe_value($con,$_SESSION['ADMIN_ID']);
   $condition='';
   $condition1='';
   if ($_SESSION['ADMIN_ROLE']==1) {
    $condition=" and product.added_by='$uid' ";
    $condition1=" and added_by='$uid' ";
   }

   if (isset($_GET['type']) && $_GET['type'] !='') {
      $type = get_safe_value($con,$_GET['type']);
      if ($type == 'status') {
          $operation = get_safe_value($con,$_GET['operation']);
          $id = get_safe_value($con,$_GET['id']);
          if ($operation=='active') {
             $status='1';
          }
          else
          {
            $status='0';
          }
          $update_status_sql="update product set status='$status' where id='$id' $condition1";
          mysqli_query($con, $update_status_sql);
       } 

       if ($type == 'delete') {
          $id = get_safe_value($con,$_GET['id']);
          $delete_sql="delete from product where id='$id' $condition1 ";
          mysqli_query($con, $delete_sql);
       }
   }
   
    $sql="select product.*,categories.categories,sub_categories.sub_categories from product,categories,sub_categories where product.categories_id=categories.id and product.sub_categories_id=sub_categories.id  $condition order by product.id desc";
    $res=mysqli_query($con,$sql);
 ?>
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Produits</h4>
                           <h4 class="box-link"><a href="manage_product.php">Ajouter un produit</a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th class="avatar">ID</th>
                                       <th>Restaurants</th>
                                       <!--<th>Sous-catégories</th>-->
                                       <th>Plats</th>
                                       <th>Image</th>
                                       <!--<th>Prix de détail maximum</th>-->
                                       <th>Prix</th>
                                       <!--<th>Quantité</th>-->
                                       <th></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php  
                                       $i=1;
                                       while ($row=mysqli_fetch_assoc($res)) {
                                    ?>
                                    <tr>
                                       <td class="serial"><?php echo $i; ?></td> 
                                       <td><?php echo $row['id'];  ?></td>
                                       <td><?php echo $row['categories'];  ?></td>
                                       <!--<td><?php echo $row['sub_categories'];  ?></td>-->
                                       <td><?php echo $row['name'];  ?></td>
                                       <td><img src="<?php echo  "../media/product/".$row['image']?>" /></td>
                                       <!--<td><?php echo $row['mrp'];  ?></td>-->
                                       <td><?php echo $row['price'];  ?></td>
                                       <!--<td><?php echo $row['qty'];  ?></td>-->
                                       <td><?php 
                                          if ($row['status']==1) {
                                             echo "<a class='badge badge-complete' href='?type=status&operation=deactive&id=".$row['id']."'>Activé</a>&nbsp";
                                          }
                                          else
                                          {  
                                             echo "<a class='badge badge-pending' href='?type=status&operation=active&id=".$row['id']."'>Désactivé</a>&nbsp";
                                          }
                                          echo "<a class='badge badge-edit' href='manage_product.php?id=".$row['id']."'>Modifier</a>";
                                          echo "&nbsp<a class='badge badge-delete' href='?type=delete&id=".$row['id']."'>Supprimer</a>";
                                       ?></td>
                                    </tr>
                                    <?php } ?>
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