 <?php  
   require('top.php');
   isAdmin();
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
          $update_status_sql="update categories set status='$status' where id='$id' ";
          mysqli_query($con, $update_status_sql);
       } 

       if ($type == 'delete') {
          $id = get_safe_value($con,$_GET['id']);
          $delete_sql="delete from categories where id='$id' ";
          mysqli_query($con, $delete_sql);
       }
   }

   $sql="select * from categories order by categories asc";
   $res=mysqli_query($con,$sql);
 ?>
 <div class="content pb-0">
            <div class="orders">
               <div class="row">
                  <div class="col-xl-12">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Catégories</h4>
                           <h4 class="box-link"><a href="manage_categories.php">Ajouter une catégorie</a></h4>
                        </div>
                        <div class="card-body--">
                           <div class="table-stats order-table ov-h">
                              <table class="table ">
                                 <thead>
                                    <tr>
                                       <th class="serial">#</th>
                                       <th class="avatar">ID</th>
                                       <th>Restaurant</th>
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
                                       <td><?php 
                                          if ($row['status']==1) {
                                             echo "<a class='badge badge-complete' href='?type=status&operation=deactive&id=".$row['id']."'>Activé</a>&nbsp";
                                          }
                                          else
                                          {  
                                             echo "<a class='badge badge-pending' href='?type=status&operation=active&id=".$row['id']."'>Désactivé</a>&nbsp";
                                          }
                                          echo "<a class='badge badge-edit' href='manage_categories.php?id=".$row['id']."'>Modifier</a>";
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