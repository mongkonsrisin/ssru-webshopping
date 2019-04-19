<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$id = $_GET['id'];
$sql = "UPDATE tbl_member SET mem_status=0 WHERE mem_id=$id";
$result = mysqli_query($cnn,$sql);
header('location:member.php');
?>
<?php require ('../_foot.php'); ?>
