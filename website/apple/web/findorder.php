<?php require ('../_head1.php'); ?>
<div class="container">
  <br><br>
     <div class="jumbotron text-center fadeInDown" style="width:1000px;text-align:center;margin: 0 auto;">
       <img src="../assets/img/order.png" width="128">
       <h1>Please enter your order number</h1>
       <br><br>

       <form class="form-signin" action="" method="get">
         <label  class="sr-only">Search</label>
         <input type="text" autocomplete="off" name="q"  class="form-control form-control-lg" placeholder="" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">
         <br><br>
         <button class="btn btn-lg btn-primary btn-block" type="button" name="search" onclick="findOrder()">Search</button>
       </form>
     </div>
   </div>
   <script>
   function findOrder() {
     sweetAlert("Order not found", "", "error");
    }
   </script>
   <?php require ('../_foot.php'); ?>
