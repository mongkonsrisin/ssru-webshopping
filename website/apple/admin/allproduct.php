<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$sql = "SELECT * FROM tbl_product LEFT JOIN tbl_category ON tbl_product.pro_category=tbl_category.cat_id WHERE pro_status=1";
$result = mysqli_query($cnn,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Products (<?php echo count($products); ?>)</h1>
<hr>
       <div style="float:left">
         <a class="btn  btn-success" href="addproduct.php"  role="button"> <i class="fa fa-plus"></i> Add</a>
         <a class="btn  btn-primary" href="printproduct.php" target="_blank" role="button"> <i class="fa fa-print"></i> Print</a>

       </div>
       <form action="findproduct.php" method="get" class="form-inline" style="float:right">
         <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" placeholder="Search...">
         <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
       </form>
     </div>
     <table class="table table-striped" style="background:white;">
  <thead class="">
    <tr>
      <th>#</th>
      <th>Image</th>
      <th>Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Category</th>
      <th>Menu</th>
  </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach($products as $product) {
         ?>

    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><a href="../assets/img/pro/<?php echo $product['pro_image']; ?>" data-lightbox="<?php echo $product['pro_id']; ?>" data-title="<?php echo $product['pro_name']; ?>"><img src="../assets/img/pro/<?php echo $product['pro_image'] ?>" width="120"></a></td>
      <td><?php echo $product['pro_name'] ?></td>
      <td><?php echo $product['pro_price'] ?> ฿</td>
      <td><?php echo $product['pro_quantity'] ?></td>
      <td><?php echo $product['cat_name'] ?></td>
      <td width="200">
        <a class="btn btn-primary" href="editproduct.php?id=<?php echo $product['pro_id'] ?>"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger" href="#"  data-toggle="modal" data-target="#del<?php echo $product['pro_id'] ?>"><i class="fa fa-trash"></i></a>
        <div class="modal fade" id="del<?php echo $product['pro_id'] ?>">
      <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <b><?php echo $product['pro_name'] ?></b> ?</p>
      </div>
      <div class="modal-footer">
        <a role="button" class="btn btn-danger" href="instantdeleteproduct.php?id=<?php echo $product['pro_id'] ?>">Delete</a>
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
