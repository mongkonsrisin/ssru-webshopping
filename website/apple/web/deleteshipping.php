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

    $shipid = $_GET['id'];
    $sql = "SELECT * FROM tbl_shipping WHERE ship_id='$shipid'";
    $result = mysqli_query($cnn,$sql);
    $shipping = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-home"></i> <?php echo $user[0]['mem_fullname']; ?>'s shipping address</h1>
       <hr>

       <p class="lead"><strong style="font-weight:bold">Name :</strong> <?php echo $shipping[0]['ship_name']; ?></p>
       <p class="lead"><strong style="font-weight:bold">Address :</strong><?php echo $shipping[0]['ship_address'] . ' ' . $shipping[0]['ship_district'] . ' '
        . $shipping[0]['ship_amphoe'] . ' '. $shipping[0]['ship_province']. ' ' . $shipping[0]['ship_zipcode'] ?></p>
       <p class="lead"><strong style="font-weight:bold">Phone :</strong> <?php echo $shipping[0]['ship_phone']; ?></p>
       <p class="lead text-danger"><strong style="font-weight:bold">Are you sure , this <?php echo $user[0]['mem_fullname']; ?>'s shipping address will be permanently delete ?</strong></p>
       <?php
         if(isset($_POST['delete'])) {
           $sql = "DELETE FROM  tbl_shipping  WHERE ship_id='$shipid'";
           $result = mysqli_query($cnn,$sql);
           header("location:shipping.php");
         }
       ?>
       <form method="post" action="">
        <button class="btn btn-lg btn-danger" name="delete" type="submit">DELETE</button>&nbsp;&nbsp;
        <button class="btn btn-lg btn-secondary" type="button" onclick="window.location.href='shipping.php';">CANCEL</button>
      </form>



     </div>
   </div>

   <?php require ('../_foot.php'); ?>
