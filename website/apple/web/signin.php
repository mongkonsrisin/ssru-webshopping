<?php require ('../_head1.php'); ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center" style="width:480px;text-align:center;margin: 0 auto;">
          <img src="../assets/img/mem/profile.png" width="128"><br><br>

      <?php
        if(isset($_POST['login'])) {

          //Get login form value
          $username = $_POST['username'];
          $password = $_POST['password'];
          $sql = "SELECT * FROM tbl_member WHERE mem_username='$username' AND mem_password='$password' AND mem_status=1 LIMIT 1";
          $result = mysqli_query($cnn,$sql);
          $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
          if (!$user) {
            // Wrong user or pass
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Wrong Username or Password.</div>';
          } else {
            // everything is correct , so do login and set user id to session
            $_SESSION['id'] = $user[0]['mem_id'];
            header('location:profile.php');
          }
        }
      ?>
      <h2 class="form-signin-heading text-center">Sign In to your Account</h2><br>
      <form class="form-signin" action="" method="post">
        <?php if(isset($error)) echo $error;?>

        <label class="sr-only">Username</label>
        <input type="text" name="username" autocomplete="off" class="form-control" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">

        <label class="sr-only">Password</label>
        <input type="password" name="password"  autocomplete="off" class="form-control" placeholder="Password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>">
        <br>

        <label class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input">
        <span class="custom-control-indicator"></span>
        <span class="custom-control-description">Remember Password</span>
      </label>
        <br> <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
      </form>
      <h6 class="text-center"><a href="forgot.php">Forgot Password</a></h6>
    </div>
  </div>
    <?php require ('../_foot.php'); ?>
