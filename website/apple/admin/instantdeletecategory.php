<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$id = $_GET['id'];
$sql = "UPDATE tbl_category SET cat_status=0 WHERE cat_id=$id";
$result = mysqli_query($cnn,$sql);
echo $sql;
//header('location:category.php');
?>
<?php require ('../_foot.php'); ?>
