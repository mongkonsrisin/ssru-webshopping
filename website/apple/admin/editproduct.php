<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM tbl_product WHERE pro_id=$id LIMIT 1";
$result = mysqli_query($cnn,$sql);
$product = mysqli_fetch_all($result,MYSQLI_ASSOC);


?>


<div class="container">
     <div class="jumbotron">
       <h1><?php echo $product[0]['pro_name']; ?></h1>
       <hr>

       <img src="../assets/img/pro/<?php echo $product[0]['pro_image']; ?>" width="400">
       <?php
         if(isset($_POST['edit'])) {
           $category = $_POST['category'];
           $name = $_POST['name'];
           $description = $_POST['description'];
           $price = $_POST['price'];
           $quantity = $_POST['quantity'];

           $sql = "UPDATE tbl_product SET pro_name='$name',pro_category='$category',pro_description='$description',pro_price='$price',pro_quantity='$quantity' WHERE pro_id=$id";
           $result = mysqli_query($cnn,$sql);

           if($_FILES["fileToUpload"]["name"] != null) {
                 $target_dir = "../assets/img/pro/";
                 $temp = explode(".", $_FILES["fileToUpload"]["name"]);
                 $newfilename = md5(microtime(true)) . '.' . end($temp);
                move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename);
                $sql = "UPDATE tbl_product SET pro_image='$newfilename' WHERE pro_id=$id";
                $result = mysqli_query($cnn,$sql);
          }

            header("location:allproduct.php");
         }
       ?>
       <form class="form form-profile" method="post" action="" enctype="multipart/form-data">
         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Category</strong></label>
       <div class="col-6">
         <select name="category" class="custom-select">
           <?php
           $sql = "SELECT * FROM tbl_category WHERE cat_status=1";
           $result = mysqli_query($cnn,$sql);
           $categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
           foreach($categories as $category) {
           ?>
           <?php if($category['cat_id'] == $product[0]['pro_category']  ) $selected = 'selected'; else $selected = ''; ?>
           <option value="<?php echo $category['cat_id'] ?>" <?php if(isset($selected)) echo $selected ?>><?php echo $category['cat_name'] ?></option>
          <?php } ?>

         </select>
       </div>
     </div>

         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Name</strong></label>
       <div class="col-6">
        <input class="form-control" name="name" type="text" value="<?php echo $product[0]['pro_name']; ?>">
       </div>
     </div>
     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>Description</strong></label>
     <div class="col-6">
       <textarea class="form-control"  style="resize:none;height:150px" autocomplete="off" name="description"><?php echo $product[0]['pro_description']; ?></textarea>
     </div>
     </div>
       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Price</strong></label>
       <div class="col-6">
        <input class="form-control" autocomplete="off" name="price" type="text" value="<?php echo $product[0]['pro_price']; ?>">
       </div>
     </div>

   <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Quantity</strong></label>
   <div class="col-6">
    <input class="form-control" autocomplete="off" name="quantity" type="text" value="<?php echo $product[0]['pro_quantity']; ?>">
   </div>
 </div>

     <div class="form-group">
              <label class="custom-file">
        <input type="file" id="file" class="custom-file-input" name="fileToUpload">
        <span class="custom-file-control"></span>
      </label>
      </div>

 <button class="btn btn-lg btn-success" name="edit" type="submit">EDIT</button>&nbsp;&nbsp;


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
