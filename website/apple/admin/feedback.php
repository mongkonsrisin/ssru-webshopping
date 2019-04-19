<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$sql = "SELECT * FROM tbl_feedback WHERE feed_status <> 0";
$result = mysqli_query($cnn,$sql);
$feedbacks = mysqli_fetch_all($result,MYSQLI_ASSOC);
  ?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-question-circle"></i> Feedbacks (<?php echo count($feedbacks); ?>)</h1>
<hr>
<div style="float:left">
  <a class="btn  btn-primary" href="printfeedback.php" target="_blank" role="button"> <i class="fa fa-print"></i> Print</a>

</div>
<form action="findmember.php" method="get" class="form-inline" style="float:right">
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" placeholder="Search...">
  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
</form>     </div>
     <table class="table table-striped" style="background:white;">
  <thead class="">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th width="350">Content</th>
      <th>Date</th>
      <th>Time</th>
      <th>Status</th>
      <th>Menu</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach($feedbacks as $feedback) { ?>

    <tr>
      <th scope="row"><?php echo $i; ?></th>

      <td><?php echo $feedback['feed_fullname'] ?></td>
      <td><?php echo $feedback['feed_email'] ?></td>
      <td width="350"><?php echo $feedback['feed_content'] ?></td>
      <td><?php echo $feedback['feed_date'] ?></td>
      <td><?php echo $feedback['feed_time'] ?></td>
      <td><?php
      if ($feedback['feed_status'] == 1) {
        $txt = "<span class='text-danger'>ยังไม่แก้</span>";
      } else if ($feedback['feed_status'] == 2) {
        $txt = "<span class='text-warning'>กำลังแก้</span>";
      } else if ($feedback['feed_status'] == 3) {
        $txt = "<span class='text-success'>แก้ไขแล้ว</span>";
      }
      echo $txt;
      ?></td>
      <td><a href="editfeedback.php?id=<?php echo $feedback['feed_id'] ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
        &nbsp;&nbsp;<a href="#"  data-toggle="modal" data-target="#del<?php echo $feedback['feed_id'] ?>"  class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
      <div class="modal fade" id="del<?php echo $feedback['feed_id'] ?>">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title">Delete confirmation</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to delete feedback from <b><?php echo $feedback['feed_fullname'] ?></b> ?</p>
    </div>
    <div class="modal-footer">
      <a role="button" class="btn btn-danger" href="instantdeletefeedback.php?id=<?php echo $feedback['feed_id'] ?>">Delete</a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>
   </div>

   <?php require ('../_foot.php'); ?>
