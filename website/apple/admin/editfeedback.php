<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_feedback WHERE feed_id=$id LIMIT 1";
$result = mysqli_query($cnn,$sql);
$feedback = mysqli_fetch_all($result,MYSQLI_ASSOC);


?>


<div class="container">
     <div class="jumbotron">
       <h1>Feedback from <?php echo $feedback[0]['feed_fullname']; ?></h1>
       <hr>

       <?php
         if(isset($_POST['edit'])) {
           $status = $_POST['status'];

           $sql = "UPDATE tbl_feedback SET feed_status='$status' WHERE feed_id=$id";
           $result = mysqli_query($cnn,$sql);
            header("location:feedback.php");
         }
       ?>
       <form class="form form-profile" method="post" action="" enctype="multipart/form-data">

         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Full Name</strong></label>
       <div class="col-6">
        <input class="form-control" name="fullname" type="text" value="<?php echo $feedback[0]['feed_fullname']; ?>" disabled="">
       </div>
     </div>
     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>Content</strong></label>
     <div class="col-6">
       <textarea class="form-control"  style="resize:none;height:150px" autocomplete="off" name="content" disabled=""><?php echo $feedback[0]['feed_content']; ?></textarea>
     </div>
     </div>
       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>E-mail</strong></label>
       <div class="col-6">
        <input class="form-control" autocomplete="off" name="email" type="text" value="<?php echo $feedback[0]['feed_email']; ?>" disabled="">
       </div>
     </div>

     <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Status</strong></label>
   <div class="col-6">
     <?php
     if($feedback[0]['feed_status'] == 1) $s1 = 'selected';
     else  if($feedback[0]['feed_status'] == 2)  $s2 = 'selected';
     else  if($feedback[0]['feed_status'] == 3) $s3 = 'selected';

     ?>
     <select name="status" class="custom-select">
       <option value="1" <?php if(isset($s1)) echo $s1?>>Not fix</option>
       <option value="2" <?php if(isset($s2)) echo $s2?>>Fixing</option>
       <option value="3" <?php if(isset($s3)) echo $s3?>>Already Fixed</option>
     </select>
   </div>
  </div>

 <button class="btn btn-lg btn-success" name="edit" type="submit">EDIT</button>&nbsp;&nbsp;


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
