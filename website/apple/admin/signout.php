<?php require ('../_head2.php'); ?>
<?php
session_destroy();
header('location:signin.php');
exit;
 ?>
<?php require ('../_foot.php'); ?>
