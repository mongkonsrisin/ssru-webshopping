<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$id = $_GET['id'];
$sql = "UPDATE tbl_product SET pro_status=0 WHERE pro_id=$id";
$result = mysqli_query($cnn,$sql);
header('location:allproduct.php');
?>
<?php require ('../_foot.php'); ?>
