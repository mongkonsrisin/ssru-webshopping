<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>

<?php
$q = $_GET['q'];
$sql = "SELECT * FROM tbl_product WHERE pro_name LIKE '%$q%'";
$result = mysqli_query($cnn,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Products (<?php echo count($products); ?>)</h1>
       <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser's viewport.</p>
       <div style="float:left">
         <a class="btn  btn-primary" href="printmember.php" target="_blank" role="button"> <i class="fa fa-print"></i> Print</a>

       </div>
       <form action="findmember.php" method="get" class="form-inline" style="float:right">
         <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" name="q" placeholder="Search..." value="<?php echo $q ?>">
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
      <td width="200"><a href="editproduct.php?year=<?php echo $product['pro_year'] ?>&id=<?php echo $product['pro_id'] ?>"><i class="fa fa-edit"></i> Edit</a><br><a href="deleteproduct.php?year=<?php echo $product['pro_year'] ?>&id=<?php echo $product['pro_id'] ?>" class="text-danger"><i class="fa fa-trash"></i> Delete</a></td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>
   </div>

   <?php require ('../_foot.php'); ?>
