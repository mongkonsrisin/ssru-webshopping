<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$sql = "SELECT * FROM tbl_member WHERE mem_status=1";
$result = mysqli_query($cnn,$sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM tbl_order";
$result = mysqli_query($cnn,$sql);
$orders = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM tbl_product WHERE pro_status=1";
$result = mysqli_query($cnn,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);

$date = date("Y-m-d");
$sql = "SELECT * FROM tbl_order WHERE or_date='$date'";
$result = mysqli_query($cnn,$sql);
$orderstoday = mysqli_fetch_all($result,MYSQLI_ASSOC);

$sql = "SELECT * FROM tbl_feedback";
$result = mysqli_query($cnn,$sql);
$feedbacks = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1>Hello Admin !</h1>
       <hr>
       <h3>Your shop summary...</h3>
       <br>
       <div class="row" >

         <div class="col-lg-2" style="border:1px solid black;height:auto;padding:12px;margin:8px">
           <center>
           <h1><i class="fa fa-user"></i></h1><h3>Members</h3>
           <h5><?php echo count($users) ?> </h5>
         </center>
         </div>
         <div class="col-lg-2" style="border:1px solid black;height:auto;padding:12px;margin:8px">
           <center>
             <h1><i class="fa fa-dropbox"></i></h1><h3>Products</h3>
           <h5><?php echo count($products) ?> </h5>
         </center>
         </div>
         <div class="col-lg-2" style="border:1px solid black;height:auto;padding:12px;margin:8px">
           <center>
             <h1><i class="fa fa-list"></i></h1><h3>Orders</h3>
           <h5><?php echo count($orders) ?> </h5>
         </center>
         </div>
         <div class="col-lg-2" style="border:1px solid black;height:auto;padding:12px;margin:8px">
           <center>
             <h1><i class="fa fa-money"></i></h1><h3>Not paid</h3>
           <h5><?php echo count($orderstoday) ?> </h5>
         </center>
         </div>
         <div class="col-lg-2" style="border:1px solid black;height:auto;padding:12px;margin:8px">
           <center>
             <h1><i class="fa fa-question-circle"></i></h1><h3>Feedback</h3>
           <h5><?php echo count($feedbacks) ?> </h5>
         </center>
         </div>
       </div>
       <br>
     </div>
   </div>

   <?php require ('../_foot.php'); ?>
