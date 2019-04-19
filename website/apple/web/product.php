<?php require ('../_head1.php'); ?>

<?php
$catid = $_GET['catid'];
$sql = "SELECT * FROM tbl_product LEFT JOIN tbl_category ON tbl_product.pro_category=tbl_category.cat_id WHERE pro_category=$catid AND pro_status=1";
$result = mysqli_query($cnn,$sql);
$products = mysqli_fetch_all($result,MYSQLI_ASSOC);
?>

<div class="container">
  <div class="row">
    <div class="jumbotron">
      <h1><?php echo $products[0]['cat_name']; ?> (<?php echo count($products); ?> items)</h1>

    <?php
      foreach ($products as $product) {
    ?>
    <div class="card" style="background: transparent">
        <img src="../assets/img/pro/<?php echo $product['pro_image']; ?>" alt="" style="margin:0;width:100% !important;">
          <a class="btn btn-lg btn-primary" href="detail.php?id=<?php echo $product['pro_id']; ?>" role="button"><?php echo $product['pro_name']; ?> <?php echo number_format($product['pro_price']); ?> ฿</a>
        </div>
    <?php } ?>

  </div>

</div>

</div>
<?php require ('../_foot.php'); ?>
