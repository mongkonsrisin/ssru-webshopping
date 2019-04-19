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
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-home"></i> Pay</h1>
       <hr>
       <br><br>

      <?php
      $orderid = $_GET['id'];
      $sql = "SELECT * FROM tbl_order  WHERE or_id='$orderid' LIMIT 1";
      $result = mysqli_query($cnn,$sql);
      $order = mysqli_fetch_all($result,MYSQLI_ASSOC);
 ?>




              <h4>Order ID :<?php echo $order[0]['or_id']?></h4>
              <h5>Receive Name : <?php echo $order[0]['or_receivename']?></h5>
              <h5>Receive Address : <?php echo $order[0]['or_receiveaddress']?></h5>
              <br>
              <h4>Status : <?php
               switch ($order[0]['or_status']) {
                 case '1':
                  $txt = '<span class="text-danger">Not pay</span>';
                   break;
                  case '2':
                    $txt = '<span class="text-warning">Payment is being verify</span>';
                   break;
                    case '3':
                      $txt = '<span class="text-primary">Payment accepted , awaiting for shipment</span>';
                       break;
                 default:
                   break;
               }
              echo '<strong>'.$txt.'</strong>';
              ?></h4>

              <br><br>
              <table class="table" style="background:white;">
              <thead class="thead-inverse">
              <tr>
               <th>#</th>
               <th>Item</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Net</th>
              </tr>
              </thead>
              <tbody>

                <?php $details = $sql = "SELECT * FROM tbl_order_detail LEFT JOIN tbl_product ON tbl_order_detail.detail_product = tbl_product.pro_id
                LEFT JOIN tbl_order ON tbl_order_detail.detail_order=tbl_order.or_id
                LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id
                WHERE detail_order='$orderid'";
                $result = mysqli_query($cnn,$sql);
                $details = mysqli_fetch_all($result,MYSQLI_ASSOC);
                $net = 0;
                $i =1;
                foreach ($details as $detail) {

                  $total=  $detail['detail_amount'] * $detail['pro_price'];
                  ?>

              <tr>
               <th scope="row"><?php echo $i; ?></th>
               <td><?php echo $detail['pro_name'] ?><br><br></td>
               <td><?php echo number_format($detail['pro_price']) ?> ฿</td>
               <td><?php echo $detail['detail_amount']; ?> </td>
               <td width="200"><b><?php echo  $total ?> ฿</b></td>
              </tr>
              <?php $net = $net + $total;$i++; } ?>

              <tr>
                <td colspan="5" align="right">
                <h4>Total <?php echo $net; ?> ฿</h4>

            </td>
            </tr>


              </tbody>
              </table>
              <?php
                if(isset($_POST['update'])) {
                 //Upload photo working!
                 if ($_FILES["fileToUpload"]["name"] == null) {
                   $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Please select a file.</div>';
               } else {
                 $target_dir = "../assets/img/mem/";
                 $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                 $newfilename = md5(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename);
                $sql = "UPDATE tbl_member SET mem_photo='$newfilename' WHERE mem_id='$id'";
                $result = mysqli_query($cnn,$sql);
                header('location:profile.php');
               }
                }
              ?>

<form action="" method="post" enctype="multipart/form-data"<?php
  if(isset($_POST['pay'])) {
    $bank = $_POST['bank'];
   //Upload photo working!
   if ($_FILES["fileToUpload"]["name"] == null) {
     $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Please select a file.</div>';
 } else {
   $target_dir = "../assets/img/pay/";
   $temp = explode(".", $_FILES["fileToUpload"]["name"]);
   $newfilename = md5(microtime(true)) . '.' . end($temp);
  move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename);
  $sql = "UPDATE tbl_order SET or_payslip='$newfilename', or_paybank='$bank', or_status=2 WHERE or_id='$orderid'";
  $result = mysqli_query($cnn,$sql);
  header('location:order.php');
 }
  }
?>>

                 <div class="card-block">

                   <label class="custom-control custom-radio">
                     <input value="kbank" name="bank" type="radio" class="custom-control-input">
                     <span class="custom-control-indicator"></span>
                     <span class="custom-control-description"><strong>KBANK : </strong>XXX-X-XXXXX-X</span>
                   </label>
                   <br>
                   <label class="custom-control custom-radio">
                     <input value="scb" name="bank" type="radio" class="custom-control-input">
                     <span class="custom-control-indicator"></span>
                     <span class="custom-control-description"><strong>SCB : </strong>XXX-X-XXXXX-X</span>
                   </label>
                   <br>
                   <label class="custom-control custom-radio">
                     <input value="tmb" name="bank" type="radio" class="custom-control-input">
                     <span class="custom-control-indicator"></span>
                     <span class="custom-control-description"><strong>TMB : </strong>XXX-X-XXXXX-X</span>
                   </label>
                   <br><br>
                   <div class="form-group">
                            <label class="custom-file">
                      <input type="file" id="file" class="custom-file-input" name="fileToUpload">
                      <span class="custom-file-control"></span>
                    </label>
                    </div>
                   <button type="submit" class="btn btn-success" name="pay">Select</button>

              </div>
</form>



   </div>
</div>
   <?php require ('../_foot.php'); ?>
