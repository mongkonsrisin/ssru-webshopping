<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php
$id = $_GET['id'];

$sql = "SELECT * FROM tbl_category WHERE cat_id=$id";
$result = mysqli_query($cnn,$sql);
$category = mysqli_fetch_all($result,MYSQLI_ASSOC);

?>


<div class="container">
     <div class="jumbotron">
       <h1><?php echo $category[0]['cat_name']; ?></h1>
       <hr>

       <?php
         if(isset($_POST['edit'])) {
           $name = $_POST['name'];
           $sql = "UPDATE tbl_category SET cat_name='$name' WHERE cat_id='$id'";
           $result = mysqli_query($cnn,$sql);
           header('location:category.php');
         }
       ?>
       <form class="form form-profile" method="post" action="">
         <?php if(isset($error)) echo $error;?>
         <div class="form-group row">
         <label  class="col-4 col-form-label"><strong>ID</strong></label>
         <div class="col-6">
           <p class="form-control-static"><?php echo $category[0]['cat_id']; ?></p>
         </div>
        </div>
         <div class="form-group row">
       <label  class="col-4 col-form-label"><strong>Name</strong></label>
       <div class="col-6">
        <input class="form-control" name="name" type="text" value="<?php echo $category[0]['cat_name']; ?>">
       </div>
     </div>





 <button class="btn btn-lg btn-success" name="edit" type="submit">SAVE</button>&nbsp;&nbsp;


       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
5
