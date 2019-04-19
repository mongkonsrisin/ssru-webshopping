<?php require ('../_head1.php'); ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center  fadeInDown" style="width:480px;text-align:center;margin: 0 auto;">
        <img src="../assets/img/mem/profile.png" width="128"><br><br>
      <h2 class="form-signin-heading text-center">Please enter your E-mail</h2><br>
      <?php
        if(isset($_POST['forgot'])) {
          $email = $_POST['email'];
          $user = getUserByEmail($email);
          if (!$user) {
            $msg = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> No user found.</div>';
          } else {
            $token = generateToken(64);
            forgotPassword($email,$token);
            $url = "resetpassword.php?token=$token";
            header("location:$url");
          }
        }
      ?>
      <form class="form-forgot" action="" method="post">
        <?php if(isset($msg)) echo $msg;?>
        <label class="sr-only">E-mail</label>
        <input type="text" name="email" autocomplete="off" class="form-control" placeholder="E-mail" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit"  name="forgot">Get Password</button>

      </form>
    </div>
  </div>

    <?php require ('../_foot.php'); ?>
