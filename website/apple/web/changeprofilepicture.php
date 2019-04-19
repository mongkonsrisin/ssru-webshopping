<?php require ('../_head1.php'); ?>
<?php
if (!isset($_SESSION['id'])) {
  header('location:404.php');
  exit;
}
$id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
    $result = mysqli_query($cnn,$sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> <?php echo $user[0]['mem_fullname']; ?></h1>
       <hr>
       <?php
       $file = '../assets/img/mem/' . $user[0]['mem_photo'];
       ?>

       <img src="<?php echo $file ?>" width="300">
       <?php
         if(isset($_POST['update'])) {
          //Upload photo working!
          if ($_FILES["fileToUpload"]["name"] == null) {
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Please select a file.</div>';
        } else {
          $target_dir = "../assets/img/mem/";
          $temp = explode(".", $_FILES["fileToUpload"]["name"]);
          $newfilename = md5(microtime(true)) . '.' . end($temp);
         move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$newfilename);
         $sql = "UPDATE tbl_member SET mem_photo='$newfilename' WHERE mem_id='$id'";
         $result = mysqli_query($cnn,$sql);
         header('location:profile.php');
        }
         }
       ?>
       <br><br>

       <p class="lead">Please choose your new profile picture...</p>

       <form class="form" method="post" action="" enctype="multipart/form-data">
         <?php if(isset($error)) echo $error;?>

<div class="form-group">
         <label class="custom-file">
   <input type="file" id="file" class="custom-file-input" name="fileToUpload">
   <span class="custom-file-control"></span>
 </label>
 </div>
 <button class="btn btn-lg btn-primary" name="update" type="submit">SAVE</button>

       </form>


     </div>
   </div>

   <?php require ('../_foot.php'); ?>
