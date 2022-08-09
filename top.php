<?php  
	require('connection.php');
	require('functions.php');
	require('add_to_cart.php');
	$cat_res=mysqli_query($con, "select * from categories where status=1 order by categories asc");
	$cat_arr=array(); 
	while ($row=mysqli_fetch_assoc($cat_res)) {
		 $cat_arr[]=$row;
	}
	$obj=new add_to_cart();
	$totalProduct=$obj->totalProduct();

    if (isset($_SESSION['USER_LOGIN'])) {
        $uid=$_SESSION['USER_ID'];
        $res=mysqli_num_rows(mysqli_query($con,"select product.name,product.image,product.price,product.mrp,wishlist.id from product,wishlist where wishlist.product_id=product.id and wishlist.user_id='$uid' "));
    }

    $script_name=$_SERVER['SCRIPT_NAME'];
    $script_name_arr=explode('/', $script_name);
    $mypage=$script_name_arr[count($script_name_arr)-1];
    $meta_title='FANAMI SHOP';
    $meta_desc='';
    $meta_keyword='';

    if ($mypage=='product.php') {
        $product_id=get_safe_value($con,$_GET['id']);
        $product_meta=mysqli_fetch_assoc(mysqli_query($con,"select * from product where id='$product_id'"));
        if (mysqli_num_rows(mysqli_query($con,"select * from product where id='$product_id'"))>0 ) {
            $meta_title = $product_meta['meta_title']; 
            $meta_desc = $product_meta['meta_desc'];
            $meta_keyword = $product_meta['meta_keyword'];
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en"><!-- Basic -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">   
       
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
     
         <!-- Site Metas -->
        <title>SocratisFood</title>  
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Site Icons -->
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">    
        <!-- Site CSS -->
        <link rel="stylesheet" href="css/style.css">    
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="css/responsive.css">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="css/custom.css">

        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>
    <body>
    <!-- Start header -->
    <header class="top-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="" alt="" />
                    <a class="nav-link" href="index.php" style="font-size: 25px;">Facturation</a>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-rs-food" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbars-rs-food">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item "><a class="nav-link" href="index.php">Accueil</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Catégories</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <?php  
                                            foreach ($cat_arr as $list) {
                                                ?>
                                <a class="dropdown-item" href="categories.php?id=<?php echo $list['id'] ?>&categories=<?php echo $list['categories'] ?>"><?php echo $list['categories']; ?></a>
                                <?php
                                            }
                                        ?>
                            </div>
                        </li>
                                                <?php 
                            if (!isset($_SESSION['USER_LOGIN']) ){
                                echo "<li class='nav-item'><a class='nav-link' href='login.php'>CONNEXION</a></li>";
                            }
                            else
                            {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="dropdown-a" data-toggle="dropdown">Compte</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                        <a class="dropdown-item" href=  "my_order.php">Mes Factures</a>
                                        <a class='nav-link' href='logout.php'>DECONNEXION</a>
                                    </div>
                                </li>
                                <?php
                            }
                        ?> 
                        <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i><span class="htc__qua"><?php echo $totalProduct ?></span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>