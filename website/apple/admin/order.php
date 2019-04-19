<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$sql = "SELECT * FROM tbl_order LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id";
$result = mysqli_query($cnn,$sql);
$orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Orders (<?php echo count($orders); ?>)</h1>
    <hr>
    <div style="float:left">

    </div>
    <form action="findorder.php" method="get" class="form-inline" style="float:right">
      <label class="mr-sm-2">From...</label>
      <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" name="from">
      <label class="mr-sm-2">To...</label>
      <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" name="to" value="<?php echo date("Y-m-d")?>">
      <label class="mr-sm-2">Status</label>
      <select name="status" class="custom-select" style="width:120px">
        <option value="0">All</option>
        <option value="1">Not pay</option>
        <option value="2">Payment is being verify</option>
        <option value="3">Payment accepted , awaiting for shipment</option>
        <option value="4">Shipped</option>
      </select>      &nbsp;&nbsp;
      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>

     </div>
     <table class="table table-striped" style="background:white;">
  <thead class="">
    <tr>
      <th>#</th>
      <th>Order ID</th>
      <th>Name</th>
      <th>Date</th>
      <th>Status</th>
      <th>Menu</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach($orders as $order) {
        ?>

    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $order['or_id'] ?></td>
      <td><?php echo $order['mem_fullname'] ?></td>
      <td><?php echo $order['or_date'] ?></td>
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
      <td><?php echo $txt ?> </td>


      <td width="200"><a href="orderdetail.php?id=<?php echo $order['or_id'] ?>"><i class="fa fa-eye"></i> View</a></td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>
   </div>

   <?php require ('../_foot.php'); ?>
