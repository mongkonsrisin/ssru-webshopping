<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>



<div class="container">
     <div class="jumbotron">
       <h1>Add Product</h1>
       <hr>

       <img src="../assets/img/pro/pro.jpg" width="400">
       <?php
         if(isset($_POST['add'])) {
           $category = $_POST['category'];
           $name = $_POST['name'];
           $description = $_POST['description'];
           $price = $_POST['price'];
           $quantity = $_POST['quantity'];
           $target_dir = "../assets/img/pro/";
           $temp = explode(".", $_FILES["fileToUpload"]["name"]);
           $newfilename = md5(microtime(true)) . '.' . end($temp);
          move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename);
          $sql = "INSERT INTO tbl_product(pro_name,pro_description,pro_price,pro_image,pro_quantity,pro_status,pro_category) VALUES ('$name','$description','$price','$newfilename','$quantity',1,'$category')";
          $result = mysqli_query($cnn,$sql);

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
           <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name'] ?></option>
          <?php } ?>

         </select>
       </div>
     </div>

         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Name</strong></label>
       <div class="col-6">
        <input class="form-control" name="name" type="text" value="">
       </div>
     </div>
     <div class="form-group row">
     <label  class="col-4 col-form-label"><strong>Description</strong></label>
     <div class="col-6">
       <textarea class="form-control"  style="resize:none;height:150px" autocomplete="off" name="description"></textarea>
     </div>
     </div>
       <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Price</strong></label>
       <div class="col-6">
        <input class="form-control" autocomplete="off" name="price" type="text" value="">
       </div>
     </div>

   <div class="form-group row">
   <label  class="col-4 col-form-label"><strong>Quantity</strong></label>
   <div class="col-6">
    <input class="form-control" autocomplete="off" name="quantity" type="text" value="">
   </div>
 </div>

     <div class="form-group">
              <label class="custom-file">
        <input type="file" id="file" class="custom-file-input" name="fileToUpload">
        <span class="custom-file-control"></span>
      </label>
      </div>

 <button class="btn btn-lg btn-success" name="add" type="submit">ADD</button>&nbsp;&nbsp;


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
