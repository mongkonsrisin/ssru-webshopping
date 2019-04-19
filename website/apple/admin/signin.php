<?php
require ('../_db.php');
require ('../_func.php');
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

  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
   body { background-image: url('../assets/img/bg2.jpg');}
  /* button,.btn { background-color: #FF4081; border:0;}
   button:hover,.btn:hover { background-color: #C51162; border:0;}*/
  </style>
</head>
<body>

    <div class="container">
      <div class="jumbotron text-center fadeInDown" style="width:480px;text-align:center;margin: 0 auto;">
          <img src="../assets/img/icon-b.png" width="128"><br><br>

      <?php
        if(isset($_POST['login'])) {
          $username = $_POST['username'];
          $password = $_POST['password'];
          if ($username == 'admin' && $password == '1234') {
            $_SESSION['admin'] = 'admin';
            header('location:index.php');
          } else {
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Wrong Username or Password.</div>';
          }
        }
      ?>
      <h2 class="form-signin-heading text-center">Hello World</h2><br>
      <form class="form-admin" action="" method="post">
        <?php if(isset($error)) echo $error;?>

        <label class="sr-only">Username</label>
        <input type="text" name="username" autocomplete="off" class="form-control form-control-lg" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">

        <label class="sr-only">Password</label>
        <input type="password" name="password"  autocomplete="off" class="form-control form-control-lg" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>">
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      </form>
    </div>
  </div>
    <?php require ('../_foot.php'); ?>
