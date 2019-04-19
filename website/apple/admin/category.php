<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$sql = "SELECT * FROM tbl_category WHERE cat_status=1";
$result = mysqli_query($cnn,$sql);
$categories = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Categories (<?php echo count($categories); ?>)</h1>
<hr>
       <div style="float:left">
         <a class="btn  btn-success" href="addcategory.php"  role="button"> <i class="fa fa-plus"></i> Add</a>
         <a class="btn  btn-primary" href="printcategory.php" target="_blank" role="button"> <i class="fa fa-print"></i> Print</a>

       </div>
       <form action="findcategory.php" method="get" class="form-inline" style="float:right">
         <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" placeholder="Search...">
         <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
       </form>
     </div>
     <table class="table table-striped" style="background:white;">
  <thead class="">
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Item in this category</th>
      <th>Menu</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach($categories as $category) {
        $catid = $category['cat_id'] ;
        $sql = "SELECT * FROM tbl_product WHERE pro_category=$catid";
        $result = mysqli_query($cnn,$sql);
        $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
         ?>

    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $category['cat_name'] ?></td>
      <td><?php echo count($products) ?></td>

      <td width="200">
        <a class="btn btn-primary" href="editcategory.php?id=<?php echo $category['cat_id'] ?>"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger" href="#"  data-toggle="modal" data-target="#del<?php echo $category['cat_id'] ?>"><i class="fa fa-trash"></i></a>
        <div class="modal fade" id="del<?php echo $category['cat_id'] ?>">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b><?php echo $category['cat_name'] ?></b> ?</p>
      </div>
      <div class="modal-footer">
        <a role="button" class="btn btn-danger" href="instantdeletecategory.php?id=<?php echo $category['cat_id'] ?>">Delete</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
      </div>
      </div>
      </td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>
   </div>

   <?php require ('../_foot.php'); ?>
