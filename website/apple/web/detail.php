<?php require ('../_head1.php'); ?>
<?php ob_start(); ?>
<?php
if (isset($_SESSION['id'])) {
  $id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
} else {
}
?>
<?php
$proid = $_GET['id'];
$sql = "SELECT * FROM tbl_product WHERE pro_id='$proid' LIMIT 1";
$result = mysqli_query($cnn,$sql);
$product = mysqli_fetch_all($result,MYSQLI_ASSOC);

if(!isset($_GET['id']) || empty($_GET['id']) ) {
  header('location:404.php');
}
?>




<div class="container">
  <div class="row">
    <div class="jumbotron  text-center" style="width:1140px;padding:20px">
      <h1><?php echo $product[0]['pro_name']; ?></h1>
      <hr>
      <a href="../assets/img/pro/<?php echo $product[0]['pro_image']; ?>" data-lightbox="lightbox" data-title="<?php echo $product[0]['pro_name']; ?>">
        <img src="../assets/img/pro/<?php echo $product[0]['pro_image']; ?>" alt="" width="400">
      </a><br>
        <br><p class="lead">
<?php echo $product[0]['pro_description']; ?>
        </p><br>
    <h3>Price <?php echo number_format($product[0]['pro_price']); ?> ฿</h3>
    <br>
    <h5>We have <?php echo $product[0]['pro_quantity']; ?> items in stock.</h5>

    <?php
    if (isset($_SESSION['id'])) { ?>
      <?php
        if(isset($_POST['addtocart'])) {
          $amount = $_POST['amount'];

          $sql = "SELECT * FROM tbl_cart WHERE cart_member='$id' AND cart_product='$proid'";
          $result = mysqli_query($cnn,$sql);
          $cart = mysqli_fetch_all($result,MYSQLI_ASSOC);
          if (count($cart) > 0) {
            //Item is already in a cart
            $oldamount = $cart[0]['cart_quantity'];
            $newamount = $oldamount + $amount;
            $sql = "UPDATE tbl_cart SET cart_quantity=$newamount WHERE cart_product=$proid AND cart_member=$id";
            $result = mysqli_query($cnn,$sql);
          } else {
            //First time purchase
            $sql = "INSERT INTO tbl_cart(cart_member,cart_product,cart_quantity) VALUES('$id','$proid','$amount')";
            $result = mysqli_query($cnn,$sql);
          }
          header('location:cart.php');

        }
      ?>





      <?php if($product[0]['pro_quantity'] != 0) { ?>
        <form action="" method="post" class="">



          <div class="form-group row">
            <div class="row" style="margin: 0 auto;text-align:center">
        <input type="number" class="form-control form-control-lg" name="amount" style="width:90px" value="1">&nbsp;&nbsp;
<button class="btn btn-lg btn-primary text-white" type="submit" name="addtocart">Add to Cart</button>
</div>


</div>
</form>
   <?php } else { ?>
<div class="alert alert-danger">Sorry, this item is out of stock.</div>
     <?php } ?>


    <?php } else { ?>
      <br>
<div class="alert alert-danger">Please login to purchase this item</div>


      <?php } ?>
      </div>






  </div>
</div>
<a name="last">






<?php require ('../_foot.php'); ?>
