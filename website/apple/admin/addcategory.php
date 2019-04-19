<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>


<div class="container">
     <div class="jumbotron">
       <h1>Add Category</h1>
       <hr>

       <?php
         if(isset($_POST['add'])) {
           $name = $_POST['name'];
           $sql = "INSERT INTO tbl_category(cat_name,cat_status) VALUES('$name',1)";
           $result = mysqli_query($cnn,$sql);
           header('location:category.php');
         }
       ?>
       <form class="form form-profile" method="post" action="">
         <?php if(isset($error)) echo $error;?>

         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Name</strong></label>
       <div class="col-6">
        <input class="form-control" name="name" type="text" value="">
       </div>
     </div>





 <button class="btn btn-lg btn-success" name="add" type="submit">SAVE</button>&nbsp;&nbsp;


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
