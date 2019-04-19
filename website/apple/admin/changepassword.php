<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> <?php echo $user[0]['mem_fullname']; ?></h1>
       <hr>

       <?php
         if(isset($_POST['update'])) {
           $newpassword = $_POST['newpassword'];
           $confirmpassword = $_POST['confirmpassword'];

          if ($newpassword != $confirmpassword) {
             $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Password mismatch</div>';
           } else if (empty($newpassword) || empty($confirmpassword)) {
             $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank fields</div>';
           } else {
           $sql = "UPDATE tbl_member SET mem_password='$newpassword'  WHERE mem_id='$id'";
           $result = mysqli_query($cnn,$sql);
           header('location:member.php');
         }
         }
       ?>
       <form class="form form-profile" method="post" action="">
         <?php if(isset($error)) echo $error;?>





     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>New Password</strong></label>
     <div class="col-6">
      <input class="form-control" name="newpassword" type="password" value="">
     </div>
   </div>

   <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Confirm Password</strong></label>
   <div class="col-6">
    <input class="form-control" name="confirmpassword" type="password" value="">
   </div>
 </div>




 <button class="btn btn-lg btn-primary" name="update" type="submit">SAVE</button>


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
