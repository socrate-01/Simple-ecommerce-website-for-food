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
   $categories_id='';
   $sub_categories_id='';
   $name='';
   $mrp='';
   $price='';
   $qty='';
   $image='';
   $short_desc='';
   $description='';
   $meta_title='';
   $meta_desc='';
   $meta_keyword='';
   $best_seller='';

   $msg='';
   $image_required='required';

   if (isset($_GET['id']) && $_GET['id']!='') {
    $image_required=''; 
    $id= get_safe_value($con,$_GET['id']);
    $sql="select * from product where id='$id' $condition1";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if ($check>0) {
      $row=mysqli_fetch_assoc($res);
      $categories_id=$row['categories_id'];
      $sub_categories_id=$row['sub_categories_id'];
      $name=$row['name'];
      $mrp=$row['mrp'];
      $price=$row['price'];
      $qty=$row['qty'];
      $short_desc=$row['short_desc'];
      $description=$row['description'];
      $meta_title=$row['meta_title'];
      $meta_desc=$row['meta_desc'];
      $meta_keyword=$row['meta_keyword'];
      $best_seller=$row['best_seller'];
    }
    else
    {
      header('location:product.php');
    }    
   }
   if (isset($_POST['submit'])) {
      $categories_id= get_safe_value($con,$_POST['categories_id']);
      $sub_categories_id=get_safe_value($con,$_POST['sub_categories_id']);
      $name= get_safe_value($con,$_POST['name']);
      $mrp= get_safe_value($con,$_POST['mrp']);
      $price= get_safe_value($con,$_POST['price']);
      $qty= get_safe_value($con,$_POST['qty']);
      $short_desc= get_safe_value($con,$_POST['short_desc']);
      $description= get_safe_value($con,$_POST['description']);
      $meta_title= get_safe_value($con,$_POST['meta_title']);
      $meta_desc= get_safe_value($con,$_POST['meta_desc']);
      $meta_keyword= get_safe_value($con,$_POST['meta_keyword']);
      $best_seller= get_safe_value($con,$_POST['best_seller']);


      $sql="select * from product where name='$name' $condition1";
      $res=mysqli_query($con,$sql);
      $check=mysqli_num_rows($res);
      if ($check>0) {
        if (isset($_GET['id']) && $_GET['id']!='') {
          $getData = mysqli_fetch_assoc($res);
          if ($id==$getData['id']) {

          }
          else
          {
            $msg="Ce produit est déjà existant";
          }
        }else{
          $msg="Ce produit est déjà existant";
        }
        
      }
      
      if ($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg' &&  $_FILES['image']['type']!='') {
        $msg="Vueillez sélectionner une image (png , jpg , jpeg)";
      }

      if ($msg=='') {
        if (isset($_GET['id']) && $_GET['id']!='') {
          if ($_FILES['image']['name']!='') {
            $image=rand(111111111, 999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], "../media/product/".$image);
            $sql = "UPDATE product set categories_id='$categories_id' , sub_categories_id=$sub_categories_id,name='$name' ,mrp='$mrp' ,price='$price' ,qty='$qty' ,short_desc='$short_desc' ,description='$description' ,meta_title='$meta_title' ,meta_desc='$meta_desc' ,meta_keyword='$meta_keyword',image='$image',best_seller=$best_seller where id='$id'";
          }
          else
          {
            $sql = "UPDATE product set categories_id='$categories_id', sub_categories_id='$sub_categories_id' ,name='$name' ,mrp='$mrp' ,price='$price' ,qty='$qty' ,short_desc='$short_desc' ,description='$description' ,meta_title='$meta_title' ,meta_desc='$meta_desc' ,meta_keyword='$meta_keyword',best_seller=$best_seller where id='$id'";
          }
          
          if ($con->query($sql) === TRUE) {
            header('location:product.php');
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
        else
        {
          $image=rand(111111111, 999999999).'_'.$_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'],  "../media/product/".$image);
          $sql = "INSERT INTO product (categories_id,sub_categories_id,name,mrp,price,qty,short_desc,description,meta_title,meta_desc,meta_keyword,status,image,best_seller,added_by) VALUES ('$categories_id', '$sub_categories_id','$name' , '$mrp' , '$price' , '$qty' ,'$short_desc' , '$description' , '$meta_title' , '$meta_desc' , '$meta_keyword' , 1, '$image' ,'$best_seller','$uid')";
          if ($con->query($sql) === TRUE) {
            header('location:product.php');
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
        die();
      }
 
   }
 ?>
  <div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>Produits</strong><small> Form</small></div>
                        <form method="post" enctype="multipart/form-data">
                          <div class="card-body card-block">
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Produits</label>
                              <select class="form-control" name="categories_id" id="categories_id" onchange="get_sub_cat('')" required="">
                                <option>Sélectionner une catégorie</option>
                                <?php
                                $res1= mysqli_query($con,"select id,categories from categories order by categories asc");
                                  while ($row=mysqli_fetch_assoc($res1)) {
                                    if ($row['id']==$categories_id) {
                                      echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                    }
                                    else
                                    {
                                      echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                    }
                                  }
                                ?>
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="sub_categories" class=" form-control-label">Sous-catégories</label>
                              <select class="form-control" name="sub_categories_id" id="sub_categories_id">
                                <option>Sélectionner une sous-catégorie</option>
                                
                              </select>
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Nom du plat</label>
                              <input type="text" id="categories" name="name" placeholder="Saisissez le nom du plat" value="<?php echo $name ?>" class="form-control" required="">
                             </div>

                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Meilleures ventes</label>
                              <select class="form-control" name="best_seller" required="">
                                <option value="">Sélectionner</option>
                                <?php  
                                  if ($best_seller==1) {
                                    echo "<option value='1' selected>OUI</option>";
                                    echo "<option value='0'>NON</option>";
                                  }
                                  elseif ($best_seller==0) {
                                    echo "<option value='1'>OUI</option>";
                                    echo "<option value='0' selected>NON</option>";
                                  }else{
                                    echo "<option value='1'>OUI</option>";
                                    echo "<option value='0'>NON</option>";
                                  }
                                ?>
                              </select>
                             </div>

                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Prix de détail maximum</label>
                              <input type="text" id="categories" name="mrp" placeholder="Saisissez le prix de détail maximum " value="<?php echo $mrp ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Prix</label>
                              <input type="text" id="categories" name="price" placeholder="Saisissez le prix du produit " value="<?php echo $price ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Quantité</label>
                              <input type="text" id="categories" name="qty" placeholder="Saisissez la quantité du produit " value="<?php echo $qty ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Image</label>
                              <input type="file" id="categories" name="image" class="form-control" <?php echo $image_required; ?> >
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Description court</label>
                              <textarea id="categories" name="short_desc" placeholder="Saisissez une description courte du produit " class="form-control" required=""><?php echo $short_desc ?></textarea>
                             </div>
                              <div class="form-group">
                              <label for="categories" class=" form-control-label">Description </label>
                              <textarea id="categories" name="description" placeholder="Saisissez une description du produit " class="form-control" required=""><?php echo $description ?></textarea>
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Titre</label>
                              <textarea id="categories" name="meta_title" placeholder="Saisissez un meta titre pour ce produit" class="form-control"><?php echo $meta_title ?></textarea>
                             </div>
                              <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Description</label>
                              <textarea id="categories" name="meta_desc" placeholder="Saisissez une meta description pour ce produit" class="form-control"><?php echo $meta_desc ?></textarea>
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Meta Mots-Clés</label>
                              <textarea id="categories" name="meta_keyword" placeholder="Saisissez des méta mot-clés pour ce produit" class="form-control"><?php echo $meta_keyword ?></textarea>
                             </div>

                             <button id="payment-button" type="submit" name="submit" class="btn btn-lg btn-info btn-block">
                             <span id="payment-button-amount">Soumettre</span>
                             </button>
                             <div class="field_error">
                              <?php echo $msg; ?> 
                             </div>
                          </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div> 
         <script type="text/javascript">
           function get_sub_cat(sub_cat_id) {
            var categories_id=jQuery('#categories_id').val();
            jQuery.ajax({
              url:'get_sub_cat.php',
              type:'post',
              data:'categories_id='+categories_id+'&sub_cat_id='+sub_cat_id,
              success:function(result){
                jQuery('#sub_categories_id').html(result);
              }
            });
           }
         </script>
 <?php  
   require('footer.php');
 ?>
 <script type="text/javascript">
          <?php  
          if (isset($_GET['id']) && $_GET['id']!='') {
            ?>
            get_sub_cat('<?php echo $sub_categories_id ?>');
            <?php
          }
          ?>
 </script>