<?php  
	require 'top.php';
    if (!isset($_SESSION['USER_LOGIN'])) {
        ?>
            <script type="text/javascript">
                window.location.href='login.php';
            </script>
        <?php
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
    $uid=$_SESSION['USER_ID'];
    $sql="select * from orders";  
    $res=mysqli_query($con, $sql);
?>

	 <div class="wishlist-area ptb--100 bg__white" style="padding-top: 100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="wishlist-content">
                            <form action="#">
                                <div class="wishlist-table table-responsive">
                                    <table class="table table-light">
                                        <thead>
                                            <tr>
                                                <th class="product-thumbnail">ID de la commande</th>
                                                <th class="product-name"><span class="nobr">Date de la commande</span></th>
                                                <th class="product-price"><span class="nobr">Nom du client</span></th>
                                                <th class="product-price"><span class="nobr">Adresse du client</span></th>
                                                <th class="product-price"><span class="nobr">Numéro de téléphone du client</span></th>
                                                <th
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php  
												while ($row=mysqli_fetch_assoc($res)){
                                        	?>
	                                            <tr>
	                                            	<td class="product-add-to-cart"><a class="btn btn-common" href="my_order_details.php?id=<?php echo $row['id']; ?>"> <?php echo $row['id']; ?> </a></td>
	                                            	<td class="product-name"> <?php echo $row['added_on']; ?> </td>
	                                            	<td class="product-name"> 
	                                            		<?php echo $row['nom']; ?> <br>
	                                            	</td>
                                                   <td class="product-name"> 
                                                        <?php echo $row['adresse']; ?> <br>
                                                    </td>
                                                    <td class="product-name"> 
                                                        <?php echo $row['numero']; ?> <br>
                                                    </td>
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php  
	require 'footer.php';
?>