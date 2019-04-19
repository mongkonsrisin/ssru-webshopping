<?php require ('../_head1.php'); ?>


<?php
$id = $_GET['id'];
$sql = "DELETE FROM tbl_cart WHERE cart_id='$id'";
$result = mysqli_query($cnn,$sql);

header('location:cart.php');
?>
   <?php require ('../_foot.php'); ?>
