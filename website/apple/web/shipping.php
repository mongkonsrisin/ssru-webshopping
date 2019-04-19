<?php require ('../_head1.php'); ?>
<?php
//If user try to access this page without login , redirect to 404
if (!isset($_SESSION['id'])) {
  header('location:404.php');
  exit;
}
// Get User detail
$id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
    $result = mysqli_query($cnn,$sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-home"></i> <?php echo $user[0]['mem_fullname']; ?>'s shipping address</h1>
       <hr>
       <a class="btn btn-lg btn-success" href="addshipping.php" role="button">Add</a>
       <br><br>
       <div class="row">

      <?php
      $sql = "SELECT * FROM tbl_shipping WHERE ship_member='$id' LIMIT 1";
      $result = mysqli_query($cnn,$sql);
      $shippings = mysqli_fetch_all($result,MYSQLI_ASSOC);
        foreach($shippings as $shipping) { ?>
          <div class="card" style="width:100%">
            <div class="card-block">
              <h4 class="card-title"  style="font-size:14pt;"><strong>Name : </strong><?php echo $shipping['ship_name']?></h4>
              <h4 class="card-title"  style="font-size:14pt;"><strong>Phone : </strong><?php echo $shipping['ship_phone']?></h4>
              <h4 class="card-title"  style="font-size:14pt;"><strong>Address : </strong><?php echo $shipping['ship_address'] . ' ' . $shipping['ship_district'] . ' ' . $shipping['ship_amphoe'] . ' '. $shipping['ship_province']. ' '. $shipping['ship_zipcode']?></h4>
              <a href="editshipping.php?id=<?php echo $shipping['ship_id'] ?>" class="card-link text-primary">Edit</a>
              <a href="deleteshipping.php?id=<?php echo $shipping['ship_id'] ?>" class="card-link text-danger">Delete</a>
            </div>
          </div>

          <?php } ?>
        </div>
</div>
   </div>

   <?php require ('../_foot.php'); ?>
