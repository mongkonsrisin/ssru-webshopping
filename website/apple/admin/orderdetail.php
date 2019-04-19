<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-home"></i> Order detail</h1>
       <hr>
       <br><br>

      <?php
      $orderid = $_GET['id'];
      $sql = "SELECT * FROM tbl_order  WHERE or_id='$orderid' LIMIT 1";
      $result = mysqli_query($cnn,$sql);
      $order = mysqli_fetch_all($result,MYSQLI_ASSOC);
 ?>
 <?php
if(isset($_POST['save'])) {
  $status = $_POST['status'];
  $tracking = $_POST['tracking'];

  $sql = "UPDATE tbl_order SET or_status='$status' , or_tracking='$tracking' WHERE or_id=$orderid";
  $result = mysqli_query($cnn,$sql);
header('location:order.php');
}
 ?>
<form class="form-inline" action="" method="post">
  <label class="mr-sm-2">Status</label>
  <?php
  if($order[0]['or_status'] == 1) $s1 = 'selected';
  else  if($order[0]['or_status'] == 2)  $s2 = 'selected';
  else  if($order[0]['or_status'] == 3) $s3 = 'selected';
  else  if($order[0]['or_status'] == 4)  $s4 = 'selected';

  ?>
  <select name="status" class="custom-select">
    <option value="1" <?php if(isset($s1)) echo $s1?>>Not pay</option>
    <option value="2" <?php if(isset($s2)) echo $s2?>>Payment is being verify</option>
    <option value="3" <?php if(isset($s3)) echo $s3?>>Payment accepted , awaiting for shipment</option>
    <option value="4" <?php if(isset($s4)) echo $s4?>>Shipped</option>
  </select>
  &nbsp;&nbsp;&nbsp;
  <label class="mr-sm-2">Tracking Number</label>
  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="tracking" value="<?php echo $order[0]['or_tracking']?>">
  <button class="btn btn-success" type="submit" name="save">Save</button>
</form>


<hr>
              <h4>Order ID : <?php echo $order[0]['or_id']?></h4>
              <?php
              $originaldate = $order[0]['or_date'];
              $newdate = date("M jS , Y", strtotime($originaldate));
              ?>
              <h4>Order Date : <?php echo $newdate ?></h4>
              <br>
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
                       case '4':
                         $txt = '<span class="text-success">Shipped</span>';
                          break;
                 default:
                   break;
               }
              echo '<strong>'.$txt.'</strong>';
              ?></h4>

              <?php if($order[0]['or_status'] == 4) { ?>
                <h4>Tracking Number : <?php echo $order[0]['or_tracking']?></h4>

                <?php } ?>
                <br><br>
                <?php if($order[0]['or_status'] == 3 || $order[0]['or_status'] == 4) { ?>
                  <h4><a target="_blank" href="printorder.php?id=<?php echo $order[0]['or_id'] ?>" role="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</a></h4>

                  <?php } ?>
              <?php if($order[0]['or_status'] == 2) { ?>
              <?php
              $file = '../assets/img/pay/' . $order[0]['or_payslip'];
              ?>
              <br>
              <img src="<?php echo $file ?>" width="300">
              <h5>Bank : <?php echo strtoupper($order[0]['or_paybank']) ?></h5>
              <?php } ?>
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
               <td><?php echo $detail['pro_name'] ?><br><br><img src="../assets/img/pro/<?php echo $detail['pro_image']; ?>" alt="" style="margin:0;width:128   !important;"></td>
               <td><?php echo $detail['pro_price'] ?> ฿</td>
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







   </div>
</div>
   <?php require ('../_foot.php'); ?>
