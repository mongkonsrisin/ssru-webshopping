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
       <?php
        if(isset($_POST['update'])) {
          $name = $_POST['name'];
          $address = $_POST['address'];
          $district = $_POST['district'];
          $amphoe = $_POST['amphoe'];
          $province = $_POST['province'];
          $zipcode = $_POST['zipcode'];
          $phone = $_POST['phone'];
          if (empty($name) || empty($address) || empty($district) || empty($amphoe) || empty($province) || empty($zipcode) || empty($phone)) {
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank field(s).</div>';
          } else {
            $sql = "UPDATE  tbl_shipping SET ship_name='$name' , ship_address='$address' , ship_district='$district' , ship_amphoe='$amphoe' ,  ship_province='$province' , ship_zipcode='$zipcode' , ship_phone='$phone' WHERE ship_id='$shipid'";
            $result = mysqli_query($cnn,$sql);
         header('location:shipping.php');
       }
        }
       ?>
       <form class="form form-address" method="post" action="" id="demo1">
         <?php if(isset($error)) echo $error;?>

         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Name</strong></label>
       <div class="col-8">
        <input class="form-control" name="name" type="text" value="<?php echo $shipping[0]['ship_name']?>">
       </div>
     </div>

       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Address</strong></label>
       <div class="col-8">
        <textarea class="form-control"  style="resize:none;height:150px" autocomplete="off" name="address"><?php echo $shipping[0]['ship_address']?></textarea>
       </div>
     </div>

     <div class="form-group row">
    <label  class="col-4 col-form-label"><strong>District</strong></label>
    <div class="col-8">
    <input class="form-control" name="district" type="text" value="<?php echo $shipping[0]['ship_district']?>">
    </div>
    </div>
    <div class="form-group row">
    <label  class="col-4 col-form-label"><strong>Amphoe</strong></label>
    <div class="col-8">
    <input class="form-control" name="amphoe" type="text" value="<?php echo $shipping[0]['ship_amphoe']?>">
    </div>
    </div>
    <div class="form-group row">
    <label  class="col-4 col-form-label"><strong>Province</strong></label>
    <div class="col-8">
    <input class="form-control" name="province" type="text" value="<?php echo $shipping[0]['ship_province']?>">
    </div>
    </div>
    <div class="form-group row">
    <label  class="col-4 col-form-label"><strong>Zipcode</strong></label>
    <div class="col-8">
    <input class="form-control" name="zipcode" type="text" value="<?php echo $shipping[0]['ship_zipcode']?>">
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


   <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Phone</strong></label>
   <div class="col-8">
    <input class="form-control" autocomplete="off" name="phone" type="text" value="<?php echo $shipping[0]['ship_phone']?>">
   </div>
 </div>

 <button class="btn btn-lg btn-primary" name="update" type="submit">SAVE</button>


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
