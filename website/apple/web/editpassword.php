<?php require ('../_head1.php'); ?>
<?php
if (!isset($_SESSION['id'])) {
  header('location:404.php');
  exit;
}
$id = $_SESSION['id'];
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
           $oldpassword = $_POST['oldpassword'];
           $newpassword = $_POST['newpassword'];
           $confirmpassword = $_POST['confirmpassword'];

           $currentpassword = $user[0]['mem_password'];
           if ($oldpassword != $currentpassword) {
             $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Old password in invalid.</div>';
           } else if ($oldpassword == $currentpassword && $newpassword != $confirmpassword) {
             $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Password mismatch</div>';
           } else if ($oldpassword == $currentpassword && (empty($newpassword) || empty($confirmpassword))) {
             $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank fields</div>';
           } else {
           $sql = "UPDATE tbl_member SET mem_password='$newpassword'  WHERE mem_id='$id'";
           $result = mysqli_query($cnn,$sql);
           header('location:profile.php');
         }
         }
       ?>
       <form class="form form-profile" method="post" action="">
         <?php if(isset($error)) echo $error;?>



       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Old Password</strong></label>
       <div class="col-6">
        <input class="form-control" name="oldpassword" type="password" value="">
       </div>
     </div>

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
