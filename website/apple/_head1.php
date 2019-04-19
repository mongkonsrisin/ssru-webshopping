<?php
require ('_db.php');
require ('_cfg.php');
require ('_func.php');
session_name('store-front');
session_start();
ob_start();
?>
<html>
<head>
  <title><?php echo $shopname; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
   <link rel="stylesheet" href="../thai/jquery.Thailand.js/dist/jquery.Thailand.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">


</head>
<body>
  <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <a class="navbar-brand" href="index.php">
         <img src="../assets/img/icon-w.png" width="30" height="30" class="d-inline-block align-top" alt="">
         <?php echo $shopname; ?></a>
       <div class="collapse navbar-collapse" id="navbarCollapse">
         <ul class="navbar-nav mr-auto">


           <?php
            $sql = "SELECT * FROM tbl_category WHERE cat_status=1";
            $result = mysqli_query($cnn,$sql);
            $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
            foreach ($categories as $category) {

           ?>
           <li class="nav-item">
             <a class="nav-link text-white" href="product.php?catid=<?php echo $category['cat_id']?>"><?php echo $category['cat_name']?></a>
           </li>

           <?php } ?>

           <li class="nav-item">
             <a class="nav-link text-white" href="contact.php">Contact</a>
           </li>
         </ul>
         <ul class="nav navbar-nav">

            <?php if(isset($_SESSION['id'])) {
              $id = $_SESSION['id'];
              $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
                $result = mysqli_query($cnn,$sql);
                $user = mysqli_fetch_all($result,MYSQLI_ASSOC); ?>
              <li class="nav-item">

                 <a class="nav-link text-white" href="profile.php">
                   <?php
                   $file = '../assets/img/mem/' . $user[0]['mem_photo'];
                   ?>

                   <img class="d-inline-block align-top" width="20" height="20" src="<?php echo $file ?>"> &nbsp;&nbsp;<?php echo $user[0]['mem_fullname']; ?></a>
               </li>
             <li class="nav-item">
                 <a class="nav-link text-white" href="cart.php">Cart</a>
             </li>
             <li class="nav-item">
                 <a class="nav-link text-white" href="signout.php">Sign Out</a>
             </li>
             <?php } else { ?>
               <li class="nav-item">
                   <a class="nav-link text-white" href="signin.php">Sign In</a>
               </li>
               <li class="nav-item">
                   <a class="nav-link text-white" href="register.php">Register</a>
               </li>
               <?php }  ?>

           </ul>
       </div>
     </nav>
