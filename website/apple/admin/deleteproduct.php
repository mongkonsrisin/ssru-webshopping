<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$id = $_GET['id'];
 $year = $_GET['year'];
$product = getProductById($id);
if ($product['pro_status'] == 0) {
  $delete =  true;
} else if ($product['pro_status'] == 1)  {
  $delete = false;
  $error = '<div class="alert alert-danger" role="alert"><strong>Not Allow !</strong> This is a sample product.</div>';
}
?>
<div class="container">
     <div class="jumbotron">
       <h1> <?php echo $product['pro_name']; ?></h1>
       <hr>
       <?php if(isset($error)) echo $error;?>
       <img src="../assets/img/pro/<?php echo $product['pro_image']; ?>" width="400">
              <br><br>
       <p class="lead"><strong style="font-weight:bold">Name :</strong> <?php echo $product['pro_name']; ?></p>
       <p class="lead"><strong style="font-weight:bold">Price :</strong> <?php echo $product['pro_price']; ?> ฿</p>
       <p class="lead text-danger"><strong style="font-weight:bold">Are you sure , <?php echo $product['pro_name']; ?> will be permanently delete ?</strong></p>
       <?php
         if(isset($_POST['delete']) && $delete) {
           $product = deleteProduct($id);
           $url = 'product.php?year='.$year;
           header("location:$url");
         }
       ?>
       <form method="post" action="">
        <button class="btn btn-lg btn-danger" name="delete" type="submit" <?php if(!$delete) echo 'disabled'; ?>>DELETE</button>&nbsp;&nbsp;
        <button class="btn btn-lg btn-secondary" type="button" onclick="window.location.href='product.php?year=<?php echo  $year; ?>';">CANCEL</button>
      </form>
     </div>
   </div>

   <?php require ('../_foot.php'); ?>
