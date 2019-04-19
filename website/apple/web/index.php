<?php require ('../_head1.php'); ?>
<div class="container">
  <br><br>
     <div class="jumbotron text-center" style="width:1000px;text-align:center;margin: 0 auto;">
       <img src="../assets/img/icon-b.png" width="128"><br><br>
       <h1>Hi, how can I help?</h1>
       <br><br>
       <?php
       if(isset($_GET['search'])) {
         $q = $_GET['q'];
             if (empty($q)) {
               $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank field.</div>';
             } else {
             $url = 'result.php?q='.$q;
             header("location:$url");
           }
       }
       ?>
       <form class="form-search" action="" method="get">
         <?php if(isset($error)) echo $error;?>
         <label  class="sr-only">Search</label>
         <input type="text" autocomplete="off" name="q"  class="form-control form-control-lg" placeholder="" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">
         <br><br>
         <button class="btn btn-lg btn-primary btn-block" type="submit" name="search">Search</button>
       </form>
     </div>
   </div>

   <?php require ('../_foot.php'); ?>
