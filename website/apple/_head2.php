<?php
require ('_db.php');
require ('_cfg.php');
require ('_func.php');
session_name('store-back');
session_start();
?>
<html>
<head>
  <title>Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.9.0/css/lightbox.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
   body { background-image: url('../assets/img/bg2.jpg');}
  /* button,.btn { background-color: #FF4081; border:0;}
   button:hover,.btn:hover { background-color: #C51162; border:0;}*/
  </style>
</head>
<body>
  <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
       <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
       </button>
       <a class="navbar-brand" href="index.php">
<img src="../assets/img/icon-w.png" width="30" height="30" class="d-inline-block align-top" alt="">
         Admin</a>
       <div class="collapse navbar-collapse" id="navbarCollapse">
         <ul class="navbar-nav mr-auto">
           <li class="nav-item">
             <a class="nav-link text-white" href="allproduct.php">Product</a>
           </li>
           <li class="nav-item">
             <a class="nav-link text-white" href="category.php">Category</a>
           </li>

           <li class="nav-item">
               <a class="nav-link text-white" href="member.php">Member</a>
           </li>
           <li class="nav-item">
               <a class="nav-link text-white" href="order.php">Order</a>
           </li>
           <li class="nav-item">
               <a class="nav-link text-white" href="feedback.php">Feedback</a>
           </li>
         </ul>
         <ul class="nav navbar-nav">

               <li class="nav-item">
                 <button class="btn btn-danger my-2 my-sm-0"  onclick="window.location.href='signout.php';">Sign Out</button>
               </li>
           </ul>
       </div>
     </nav>
