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
       <h1><i class="fa fa-home"></i> Select your shipping information</h1>
       <hr>
       <br><br>
       <div class="row">

      <?php
      $orderid = $_GET['id'];
      $sql = "SELECT * FROM tbl_order  WHERE or_id='$orderid' LIMIT 1";
      $result = mysqli_query($cnn,$sql);
      $order = mysqli_fetch_all($result,MYSQLI_ASSOC);
 ?>
<?php
//Save shipping
if(isset($_POST['saveshipping'])) {
  //$shipid = $_POST['shipping'];
//  $sql_getship = "SELECT * FROM tbl_shipping WHERE ship_id=$shipid LIMIT 1";
  //$result_getship = mysqli_query($cnn,$sql_getship);
//  $ship = mysqli_fetch_all($result_getship,MYSQLI_ASSOC);
   //$shipname = $ship[0]['ship_name'];
   $shipaddress = $_POST['address'] . ' '
   . $_POST['district'] . ' '
   . $_POST['amphoe'] . ' '
   . $_POST['province'] . ' '
   . $_POST['zipcode'];
   $name = $user[0]['mem_fullname'];
   $sql_saveshipping = "UPDATE tbl_order SET or_receivename='$name' , or_receiveaddress='$shipaddress' WHERE or_id=$orderid";
   $result_saveshipping = mysqli_query($cnn,$sql_saveshipping);
   header('location:order.php');

}
?>
<form class="form" method="post" id="demo1">
 <?php
 $sql = "SELECT * FROM tbl_shipping WHERE ship_member='$id' LIMIT 1";
 $result = mysqli_query($cnn,$sql);
 $shippings = mysqli_fetch_all($result,MYSQLI_ASSOC);
   foreach($shippings as $shipping) { ?>
     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>Address</strong></label>
     <div class="col-8">
      <textarea class="form-control"  style="resize:none;height:150px" autocomplete="off" name="address"><?php  echo $shipping['ship_address'] ?></textarea>
     </div>
   </div>
   <div class="form-group row">
  <label  class="col-4 col-form-label"><strong>District</strong></label>
  <div class="col-8">
  <input class="form-control" name="district" type="text" value="<?php  echo $shipping['ship_district'] ?>">
  </div>
  </div>
  <div class="form-group row">
  <label  class="col-4 col-form-label"><strong>Amphoe</strong></label>
  <div class="col-8">
  <input class="form-control" name="amphoe" type="text" value="<?php  echo $shipping['ship_amphoe'] ?>">
  </div>
  </div>
  <div class="form-group row">
  <label  class="col-4 col-form-label"><strong>Province</strong></label>
  <div class="col-8">
  <input class="form-control" name="province" type="text" value="<?php  echo $shipping['ship_province'] ?>">
  </div>
  </div>
  <div class="form-group row">
  <label  class="col-4 col-form-label"><strong>Zipcode</strong></label>
  <div class="col-8">
  <input class="form-control" name="zipcode" type="text" value="<?php  echo $shipping['ship_zipcode'] ?>">
  </div>
  </div>
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js"></script>

    <!-- dependencies for zip mode -->
    <script type="text/javascript" src="../thai/jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
    <!-- / dependencies for zip mode -->

    <script type="text/javascript" src="../thai/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="../thai/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <script type="text/javascript" src="../thai/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

    <script type="text/javascript">

        $.Thailand({
            database: '../thai/jquery.Thailand.js/database/db.json',

            $district: $('#demo1 [name="district"]'),
            $amphoe: $('#demo1 [name="amphoe"]'),
            $province: $('#demo1 [name="province"]'),
            $zipcode: $('#demo1 [name="zipcode"]'),

            onDataFill: function(data){
                console.info('Data Filled', data);
            },

            onLoad: function(){
                console.info('Autocomplete is ready!');
                $('#loader, .demo').toggle();
            }
        });


        $('#demo1 [name="district"]').change(function(){
            console.log('ตำบล', this.value);
        });
        $('#demo1 [name="amphoe"]').change(function(){
            console.log('อำเภอ', this.value);
        });
        $('#demo1 [name="province"]').change(function(){
            console.log('จังหวัด', this.value);
        });
        $('#demo1 [name="zipcode"]').change(function(){
            console.log('รหัสไปรษณีย์', this.value);
        });

      $.Thailand({
            database: '../thai/jquery.Thailand.js/database/db.zip',
            $search: $('#demo2 [name="search"]'),

            onDataFill: function(data){
                console.log(data)
                var html = '<b>ที่อยู่:</b> ตำบล' + data.district + ' อำเภอ' + data.amphoe + ' จังหวัด' + data.province + ' ' + data.zipcode;
                $('#demo2-output').prepend('<div class="uk-alert-warning" uk-alert><a class="uk-alert-close" uk-close></a>' + html + '</div>');
            }

        });     </script>



     <?php } ?>
     <button type="submit" class="btn btn-success" name="saveshipping">Select</button>
</form>
     <br>
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
</div>
   <?php require ('../_foot.php'); ?>
