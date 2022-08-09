 <?php  
   require('top.php');
   isAdmin();
   $username='';
   $password='';
   $email='';
   $mobile='';
   $msg='';
   if (isset($_GET['id']) && $_GET['id']!='') {
    $id= get_safe_value($con,$_GET['id']);
    $sql="select * from admin_users where id='$id'";
    $res=mysqli_query($con,$sql);
    $check=mysqli_num_rows($res);
    if ($check>0) {
      $row=mysqli_fetch_assoc($res);
      $username=$row['username'];
      $password=$row['password'];
      $email=$row['email'];
      $mobile=$row['mobile'];
    }
    else
    {
      header('location:vendor.php');
    }    
   }
   if (isset($_POST['submit'])) {
      $username= get_safe_value($con,$_POST['username']);
      $password= get_safe_value($con,$_POST['password']);
      $email= get_safe_value($con,$_POST['email']);
      $mobile= get_safe_value($con,$_POST['mobile']);
      
      if ($msg=='') {
        if (isset($_GET['id']) && $_GET['id']!='') {
          $sql = "UPDATE admin_users set username='$username' , password='$password', email='$email', mobile='$mobile' where id='$id'";
          if ($con->query($sql) === TRUE) {
            header('location:vendor.php');
          } else {
            echo "Error: " . $sql . "<br>" . $con->error;
          }
        }
        else
        {
          $sql = "INSERT INTO admin_users (username,password,role,email,mobile,status) VALUES ('$username','$password', '1','$email','$mobile','1')";
          if ($con->query($sql) === TRUE) {
            header('location:vendor.php');
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
                        <div class="card-header"><strong>Livreurs</strong><small> Form</small></div>
                        <form method="post">
                          <div class="card-body card-block">
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Nom d'utilisateur</label>
                              <input type="text" id="categories" name="username" placeholder="Saisissez le nom de la catégorie" value="<?php echo $username ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Mot de passe</label>
                              <input type="text" id="categories" name="password" placeholder="Saisissez le nom de la catégorie" value="<?php echo $password ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Email</label>
                              <input type="text" id="categories" name="email" placeholder="Saisissez le nom de la catégorie" value="<?php echo $email ?>" class="form-control" required="">
                             </div>
                             <div class="form-group">
                              <label for="categories" class=" form-control-label">Mobile</label>
                              <input type="text" id="categories" name="mobile" placeholder="Saisissez le nom de la catégorie" value="<?php echo $mobile ?>" class="form-control" required="">
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