<?php require ('../_head1.php'); ?>
<?php
if (!isset($_SESSION['id'])) {
  header('location:404.php');
  exit;
}
?>
<?php
$id = $_SESSION['id'];
$sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);

  $sql = "SELECT * FROM tbl_cart LEFT JOIN tbl_product ON tbl_cart.cart_product=tbl_product.pro_id WHERE cart_member='$id'";
  $result = mysqli_query($cnn,$sql);
  $carts = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-shopping-cart"></i> Shopping cart</h1>
       <hr>
       <br><br>
       <div class="row">

         <table class="table table-striped" style="background:white;">
         <thead class="">
         <tr>
          <th>#</th>
          <th>Item</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Net</th>
          <th>Menu</th>
         </tr>
         </thead>
         <tbody>
         <?php
          $i = 1;
          $net = 0;
          foreach($carts as $cart) {
            $total = $cart['pro_price']*$cart['cart_quantity'];
            ?>
         <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><?php echo $cart['pro_name'] ?><br><br><img src="../assets/img/pro/<?php echo $cart['pro_image']; ?>" alt="" style="margin:0;width:128   !important;"></td>
          <td><?php echo $cart['pro_price'] ?> ฿</td>
          <td><?php echo $cart['cart_quantity']; ?> </td>
          <td width="200"><b><?php echo  $total ?> ฿</b></td>
          <td width="200"><a role="button" href="deletecart.php?id=<?php echo $cart['cart_id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
         </tr>
         <?php $net = $net+$total;
         $i++; } ?>
         </tbody>
         </table>


  </div>
  <div align="center"><h2>Grand Total : <?php echo $net; ?>฿</h2><br>
    <?php
if(isset($_POST['placeorder'])) {

  $date = date("Y-m-d");
  $time = date("H:i:s");

  $sql_selectcart = "SELECT * FROM tbl_cart LEFT JOIN tbl_product ON tbl_cart.cart_product=tbl_product.pro_id WHERE cart_member='$id'";
  $result_selectcart = mysqli_query($cnn,$sql_selectcart);
  $sql_insertorder = "INSERT INTO tbl_order(or_member,or_date,or_time,or_status) VALUES('$id','$date','$time',1)";
  $result = mysqli_query($cnn,$sql_insertorder);
  $orderid = mysqli_insert_id($cnn);

  while($cart = mysqli_fetch_assoc($result_selectcart)) {
    $product = $cart['cart_product'];
    $quantity = $cart['cart_quantity'];
    $sql_insertorderdetail = "INSERT INTO tbl_order_detail VALUES(null,'$product','$quantity','$orderid')";
    $result = mysqli_query($cnn,$sql_insertorderdetail);

    $sql_oldstock = "SELECT * FROM tbl_product WHERE pro_id=$product";
    $result_oldstock = mysqli_query($cnn,$sql_oldstock);
    $oldstock = mysqli_fetch_all($result_oldstock,MYSQLI_ASSOC);
    $old = $oldstock[0]['pro_quantity'];
    $new = $old - $quantity;

    $sql_updatestock = "UPDATE tbl_product SET pro_quantity=$new WHERE pro_id=$product";
    $result_updatestock = mysqli_query($cnn,$sql_updatestock);

  }


  $sql_deletecart = "DELETE FROM tbl_cart WHERE cart_member='$id'";
  $result_deletecart = mysqli_query($cnn,$sql_deletecart);

  $url = "selectshipping.php?id=$orderid";
  header("location:$url");


}
if ($net == 0) {
  $disabled = 'disabled';
}
    ?>
    <form action="" method="post">
  <button class="btn btn-lg btn-success" type="submit" name="placeorder" <?php if(isset($disabled)) echo $disabled?>>Place Order</button>
</form>
</div>
</div>
   </div>

   <?php require ('../_foot.php'); ?>
