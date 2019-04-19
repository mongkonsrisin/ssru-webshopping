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
       <h1><i class="fa fa-home"></i> <?php echo $user[0]['mem_fullname']; ?>'s order</h1>
       <hr>
       <br><br>
       <div class="row">

      <?php
      $sql = "SELECT * FROM tbl_order LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id WHERE or_member='$id' ORDER BY or_id DESC";
      $result = mysqli_query($cnn,$sql);
      $orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach($orders as $order) { ?>
          <div class="card" style="width:100%">
            <div class="card-block">
              <h4 class="card-title">Order ID : <?php echo $order['or_id']?></h4>
              <h5 class="card-title">Date : <?php echo $order['or_date']?> <?php echo $order['or_time']?></h5>
              <?php
              $orderid = $order['or_id'];
              $sql = "SELECT * FROM tbl_order_detail LEFT JOIN tbl_product ON tbl_order_detail.detail_product = tbl_product.pro_id
              LEFT JOIN tbl_order ON tbl_order_detail.detail_order=tbl_order.or_id
              LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id
              WHERE detail_order='$orderid'";
              $result = mysqli_query($cnn,$sql);
              $details = mysqli_fetch_all($result,MYSQLI_ASSOC);
              $net = 0;

              foreach ($details as $detail) {

                $total=  $detail['detail_amount'] * $detail['pro_price'];
                ?>

                <h6 class="card-subtitle mb-2 text-muted"><?php echo $detail['pro_name']?> x <?php echo number_format($detail['detail_amount'])?> = <?php echo $total ?></h6>

              <?php $net = $net + $total; } ?>
              <h5 class="card-title">Total : <?php echo number_format($net) ?> ฿</h5>
              <?php
               switch ($order['or_status']) {
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
              ?>
              <h5 class="card-title">Status : <?php echo $txt ?></h5>
              <?php if($order['or_status'] == 1) { ?>
              <a href="pay.php?id=<?php echo $order['or_id'] ?>" class="btn btn-primary"><i class="fa fa-dollar"></i> Pay</a>
              <?php } ?>
              <a href="orderdetail.php?id=<?php echo $order['or_id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i> View detail</a>

            </div>
          </div>

          <?php } ?>
        </div>
</div>
   </div>

   <?php require ('../_foot.php'); ?>
