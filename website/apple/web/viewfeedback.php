<?php require ('../_head1.php'); ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_feedback WHERE feed_id=$id LIMIT 1";
$result = mysqli_query($cnn,$sql);
$feedback = mysqli_fetch_all($result,MYSQLI_ASSOC);
if (count($feedback) == 0) {
  header('location:feedback_notfound.php');
  exit;
}

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

         <div class="form-group row">
       <label  class="col-2 col-form-label"><strong>Full Name</strong></label>
       <div class="col-10">
         <p class="form-control-static"><?php echo $feedback[0]['feed_fullname']; ?></p>
       </div>
     </div>
     <div class="form-group row">
     <label  class="col-2 col-form-label"><strong>Content</strong></label>
     <div class="col-10">
       <p class="form-control-static"><?php echo $feedback[0]['feed_content']; ?></p>
     </div>
     </div>
       <div class="form-group row">
       <label  class="col-2 col-form-label"><strong>E-mail</strong></label>
       <div class="col-10">
         <p class="form-control-static"><?php echo $feedback[0]['feed_email']; ?></p>
       </div>
     </div>
     <div class="form-group row">
     <label  class="col-2 col-form-label"><strong>Status</strong></label>
     <div class="col-10">
       <?php
       if($feedback[0]['feed_status'] == 1) $txt = '<span class="text-danger">Not fix</span>';
       else  if($feedback[0]['feed_status'] == 2)  $txt = '<span class="text-warning">Fixing</span>';
       else  if($feedback[0]['feed_status'] == 3) $txt = '<span class="text-success">Alredy fixed</span>';

       ?>
       <p class="form-control-static"><?php echo $txt; ?></p>
     </div>
   </div>

     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
