<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$id = $_GET['id'];
$sql = "UPDATE tbl_feedback SET feed_status=0 WHERE feed_id=$id";
$result = mysqli_query($cnn,$sql);
header('location:feedback.php');
?>
   <?php require ('../_foot.php'); ?>
