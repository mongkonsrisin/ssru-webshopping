<?php require ('../_head1.php'); ?>
<?php $q = $_GET['q']; ?>
<?php
if(!isset($_GET['q']) || empty($_GET['q'])  ) {
  header('location:404.php');
}
$products = searchProduct($q);
?>
<div class="container">
  <div class="row">
    <div class="jumbotron" style="width:1140px;padding:20px">
      <h1>We found <?php echo count($products); ?> results for <?php echo $q; ?></h1>
      <hr>
    <?php
      foreach ($products as $product) {
    ?>
    <div class="card" style="background: transparent">
        <img src="../assets/img/pro/<?php echo $product['pro_image']; ?>" alt="" style="margin:0;width:100% !important;">
          <a class="btn btn-lg btn-primary" href="detail.php?id=<?php echo $product['pro_id']; ?>" role="button"><?php echo $product['pro_name']; ?> <?php echo $product['pro_price']; ?> ฿</a>
        </div>
    <?php } ?>
  </div>
</div>
</div>

<?php require ('../_foot.php'); ?>
