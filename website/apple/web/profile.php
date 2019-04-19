<?php require ('../_head1.php'); ?>
<?php
//If user try to access this page without login , redirect to 404
if (!isset($_SESSION['id'])) {
  header('location:404.php');
  exit;
}
// Get User detail
$id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
    $result = mysqli_query($cnn,$sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> <?php echo $user[0]['mem_fullname']; ?></h1>
       <hr>
       <div class="row">
       <div class="col-lg-4">
       <?php
       $file = '../assets/img/mem/' . $user[0]['mem_photo'];
       ?>

       <img src="<?php echo $file ?>" width="300">
       <br><br>
       <center><a href="changeprofilepicture.php" class="btn btn-sm btn-secondary" role="button"><i class="fa fa-image"></i> Change Profile Picture</a></center>

            </div>
            <div class="col-lg-8">

       <p class="lead"><strong style="font-weight:bold">ID :</strong> <?php echo $user[0]['mem_id']; ?></p>
       <p class="lead"><strong style="font-weight:bold">Username :</strong> <?php echo $user[0]['mem_username']; ?></p>
       <p class="lead"><strong style="font-weight:bold">Full Name :</strong> <?php echo $user[0]['mem_fullname']; ?></p>
       <p class="lead"><strong style="font-weight:bold">E-mail :</strong> <?php echo $user[0]['mem_email']; ?></p>
       <p class="lead"><strong style="font-weight:bold">Phone Number :</strong> <?php echo $user[0]['mem_phone']; ?></p>
       <?php
       $originaldate = $user[0]['mem_registerdate'];
       $newdate = date("M jS , Y", strtotime($originaldate));
       ?>
       <p class="lead"><strong style="font-weight:bold">Join date :</strong> <?php echo $newdate; ?></p>
       <p class="lead"><strong style="font-weight:bold">Shipping :</strong> <a href="shipping.php">View</a></p>
       <p class="lead"><strong style="font-weight:bold">Order :</strong> <a href="order.php">View</a></p>

     </div>
</div>

       <hr>
       <a class="btn btn-lg btn-primary" href="editprofile.php" role="button">Edit Profile</a>
       <a class="btn btn-lg btn-primary" href="editpassword.php" role="button">Edit Password</a>

     </div>
   </div>

   <?php require ('../_foot.php'); ?>
