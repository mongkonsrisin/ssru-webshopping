<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
?>
<?php $year = $_GET['year']; ?>
<?php if($year != 58 && $year != 59 && $year != 60) {
  header('location:404.php');
}
?>
<?php  $products = listProductByYear($year); ?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Products (<?php echo count($products); ?>)</h1>
       <p class="lead">This example is a quick exercise to illustrate how fixed to top navbar works. As you scroll, it will remain fixed to the top of your browser's viewport.</p>
       <a class="btn btn-lg btn-success" href="addproduct.php?year=<?php echo $year; ?>" role="button"> <i class="fa fa-plus"></i> Add</a>

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
