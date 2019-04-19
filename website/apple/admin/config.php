<?php require ('../_head2.php');

 ?>
 <?php
 if (!isset($_SESSION['admin'])) {
   header('location:signin.php');
   exit;
 }
 ?>
    <div class="container">
      <div class="jumbotron text-center fadeInDown" style="width:440px;text-align:center;margin: 0 auto;">

        <img src="../assets/img/gear.png" width="128"><br><br>
      <h2 class="form-signin-heading text-center">Shop Configuration</h2><br>
      <br>
      <?php
      $ALLOW_REGISTRATION = getConfig('ALLOW_REGISTRATION');
      if($ALLOW_REGISTRATION == 1) {
        $yes = 'checked';
      }
      if($ALLOW_REGISTRATION == 0) {
        $no = 'checked';
      }

      if(isset($_POST['set'])) {
        $ALLOW_REGISTRATION = $_POST['ALLOW_REGISTRATION'];
        updateConfig('ALLOW_REGISTRATION',$ALLOW_REGISTRATION);
        header('location:config.php');
      }
      ?>
      <form class="form-config" action="" method="post">



              <div class="form-group row">
        <label for="example-text-input" class="col-6 col-form-label">Allow Registration</label>
        <div class="col-6">

          <label class="custom-control custom-radio">
            <input  name="ALLOW_REGISTRATION" value="1" type="radio" class="custom-control-input" <?php if(isset($yes)) echo $yes ?>>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">YES</span>
          </label>

          <label class="custom-control custom-radio">
            <input  name="ALLOW_REGISTRATION" value="0" type="radio" class="custom-control-input" <?php if(isset($no)) echo $no ?>>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">NO</span>
          </label>

        </div>
      </div>


      <div class="form-group row">
<label for="example-text-input" class="col-6 col-form-label">Maintenance Mode</label>
<div class="col-6">

  <label class="custom-control custom-radio">
    <input  name="MAINTENANCE_MODE" value="1" type="radio" class="custom-control-input">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">YES</span>
  </label>

  <label class="custom-control custom-radio">
    <input  name="MAINTENANCE_MODE" value="0" type="radio" class="custom-control-input">
    <span class="custom-control-indicator"></span>
    <span class="custom-control-description">NO</span>
  </label>

</div>
</div>




        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="set">Set</button>
      </form>
    </div>
    </div>
    <?php require ('../_foot.php'); ?>
