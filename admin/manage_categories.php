 <?php  
   require('top.php');
   isAdmin();
   $categories='';
   $msg='';
   if (isset($_GET['id']) && $_GET['id']!='') {
    $id= get_safe_value($con,$_GET['id']);
    $sql="select * from categories where id='$id'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if ($check>0) {
      $row=mysqli_fetch_assoc($res);
      $categories=$row['categories'];
    }
    else
    {
      header('location:categorie.php');
    }    
   }
   if (isset($_POST['submit'])) {
      $categories= get_safe_value($con,$_POST['categories']);
      $sql="select * from categories where categories='$categories'";
      $res=mysqli_query($con,$sql);
      $check=mysqli_num_rows($res);
      if ($check>0) {
        if (isset($_GET['id']) && $_GET['id']!='') {
          $getData = mysqli_fetch_assoc($res);
          if ($id==$getData['id']) {

          }
          else
          {
            $msg="Cette catégorie est déjà existente";
          }
        }else{
          $msg="Cette catégorie est déjà existente";
        }
        
      }
      
      if ($msg=='') {
        if (isset($_GET['id']) && $_GET['id']!='') {
          $sql = "UPDATE categories set categories='$categories' where id='$id'";
          if ($con->query($sql) === TRUE) {
            header('location:categorie.php');
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
        else
        {
          $sql = "INSERT INTO categories (categories,status) VALUES ('$categories', '1')";
          if ($con->query($sql) === TRUE) {
            header('location:categorie.php');
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
                        <div class="card-header"><strong>Catégories</strong><small> Form</small></div>
                        <form method="post">
                          <div class="card-body card-block">
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Catégories</label>
                              <input type="text" id="categories" name="categories" placeholder="Saisissez le nom de la catégorie" value="<?php echo $categories ?>" class="form-control" required="">
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
 <?php  
   require('footer.php');
 ?>