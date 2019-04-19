<?php require ('../_head1.php'); ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center  fadeInDown" style="width:480px;text-align:center;margin: 0 auto;">
        <img src="../assets/img/mem/profile.png" width="128"><br><br>
      <h2 class="form-signin-heading text-center">Reset Password</h2><br>

      <form class="form-forgot" action="" method="post">
        <?php if(isset($msg)) echo $msg;?>
        <label class="sr-only">Password</label>
        <input type="password" name="password" autocomplete="off" class="form-control" placeholder="Password">

        <label class="sr-only">Confirm Password</label>
        <input type="password" name="confirmpassword" autocomplete="off" class="form-control" placeholder="Confirm Password">

        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit"  name="forgot">Update</button>

      </form>
    </div>
  </div>

    <?php require ('../_foot.php'); ?>
