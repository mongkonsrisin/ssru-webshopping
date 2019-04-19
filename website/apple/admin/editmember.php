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
       $file = '../assets/img/mem/' . $user[0]['mem_photo'];
       ?>

       <img src="<?php echo $file ?>" width="300">
       <br><br>
      <a href="changeprofilepicture.php?id=<?php echo $user[0]['mem_id']; ?>" class="btn btn-sm btn-secondary" role="button"><i class="fa fa-image"></i> Change Profile Picture</a>

       <?php
         if(isset($_POST['update'])) {
           $fullname = $_POST['fullname'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
           $sql = "UPDATE tbl_member SET mem_fullname='$fullname' , mem_email='$email' , mem_phone='$phone' WHERE mem_id='$id'";
           $result = mysqli_query($cnn,$sql);
           header('location:member.php');
         }
       ?>
       <form class="form form-profile" method="post" action="">

         <div class="form-group row">
         <label  class="col-4 col-form-label"><strong>ID</strong></label>
         <div class="col-6">
           <p class="form-control-static"><?php echo $user[0]['mem_id']; ?></p>
         </div>
       </div>

       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Username</strong></label>
       <div class="col-6">
        <input class="form-control" name="username" type="text" value="<?php echo $user[0]['mem_username']; ?>" disabled>
       </div>
     </div>

       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Full Name</strong></label>
       <div class="col-6">
        <input class="form-control" autocomplete="off" name="fullname" type="text" value="<?php echo $user[0]['mem_fullname']; ?>">
       </div>
     </div>

     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>E-mail</strong></label>
     <div class="col-6">
      <input class="form-control" autocomplete="off" name="email" type="text" value="<?php echo $user[0]['mem_email']; ?>">
     </div>
   </div>

   <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Phone Number</strong></label>
   <div class="col-6">
    <input class="form-control" autocomplete="off" name="phone" type="text" value="<?php echo $user[0]['mem_phone']; ?>">
   </div>
 </div>
 <a href="changepassword.php?id=<?php echo $user[0]['mem_id']; ?>" class="btn btn-sm btn-secondary" role="button"><i class="fa fa-key"></i> Change Password</a>
<br><br>
 <button class="btn btn-lg btn-primary" name="update" type="submit">SAVE</button>


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
