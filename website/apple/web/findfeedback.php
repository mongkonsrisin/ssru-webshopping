<?php require ('../_head1.php');
if(isset($_SESSION['id'])) {
$id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
    $result = mysqli_query($cnn,$sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
 ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center" style="width:480px;text-align:center;margin: 0 auto;">
        <img src="../assets/img/like.png" width="128"><br><br>
    
      <h2 class="form-signin-heading text-center">Find your feedback</h2><br>
      <span>Please enter your feedback ID and email</span><br><br>
      <form class="form-signin" action="viewfeedback.php" method="get">
        <?php if(isset($error)) echo $error;?>

        <label  class="sr-only">Feedback ID</label>
        <input type="text" autocomplete="off" name="id"  class="form-control" placeholder="Feedback ID" value="">


        <br>






        <br>

        <button class="btn btn-lg btn-primary btn-block" type="submit" name="search">Search</button>
      </form>
    </div>
    </div>
    <?php require ('../_foot.php'); ?>
