<?php require ('../_head2.php'); ?>
<?php
if (!isset($_SESSION['admin'])) {
  header('location:signin.php');
  exit;
}
$sql = "SELECT * FROM tbl_member WHERE mem_status=1";
$result = mysqli_query($cnn,$sql);
$users = mysqli_fetch_all($result,MYSQLI_ASSOC);

 ?>
<div class="container">
     <div class="jumbotron">
       <h1><i class="fa fa-user"></i> Members (<?php echo count($users); ?>)</h1>
       <hr>
       <div style="float:left">
         <a class="btn  btn-primary" href="printmember.php" target="_blank" role="button"> <i class="fa fa-print"></i> Print</a>

       </div>
      <form action="findmember.php" method="get" class="form-inline" style="float:right">
      <label class="mr-sm-2">From...</label>
      <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" name="from" value="<?php echo date("Y-m-d")?>">
      <label class="mr-sm-2">To...</label>
      <input type="date" class="form-control mb-2 mr-sm-2 mb-sm-0" name="to" value="<?php echo date("Y-m-d")?>">
      
      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>
     </div>

     <table class="table table-striped" style="background:white;">
  <thead class="">
    <tr>
      <th>#</th>
      <th>Image</th>
      <th>Full Name</th>
      <th>Username</th>
      <th>E-mail</th>
      <th>Phone</th>
      <th>Join date</th>
      <th>Address</th>
      <th>Menu</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $i = 1;
      foreach($users as $user) {
        ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <?php
      $file = '../assets/img/mem/' . $user['mem_photo'];
      ?>

      <td>
        <a href="<?php echo $file ?>" data-lightbox="<?php echo $user['mem_id']; ?>" data-title="<?php echo $user['mem_fullname']; ?>">
          <img src="<?php echo $file ?>" width="120">

     </a>
     </td>
      <td><?php echo $user['mem_fullname'] ?></td>
      <td><?php echo $user['mem_username'] ?></td>
      <td><?php echo $user['mem_email'] ?></td>
      <td><?php echo $user['mem_phone'] ?></td>
      <?php
      $originaldate = $user['mem_registerdate'];
      $newdate = date("j M Y", strtotime($originaldate));
      ?>
      <td><?php echo $newdate ?></td>
      <?php
      $memid = $user['mem_id'];
      $sql = "SELECT * FROM tbl_shipping WHERE ship_member=$memid";
      $result = mysqli_query($cnn,$sql);
      $shippings = mysqli_fetch_all($result,MYSQLI_ASSOC);

        ?>
      <td>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#m<?php echo $user['mem_id'] ?>"><i class="fa fa-eye"> </i> (<?php echo count($shippings)?>)</button>
        <!-- Modal -->
<div class="modal fade" id="m<?php echo $user['mem_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $user['mem_fullname'] ?>'s Shipping Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<?php   foreach ($shippings as $shipping) { ?>
            <div class="">
              <h4 style="font-size:14pt;"><strong>Name : </strong><?php echo $shipping['ship_name']?></h4>
              <h4 style="font-size:14pt;"><strong>Phone : </strong><?php echo $shipping['ship_phone']?></h4>
              <h4   style="font-size:14pt;"><strong>Address : </strong><?php echo $shipping['ship_address'] . ' ' . $shipping['ship_district'] . ' ' . $shipping['ship_amphoe'] . ' '. $shipping['ship_province']. ' '. $shipping['ship_zipcode']?></h4>
              <a href="editshipping.php?id=<?php echo $shipping['ship_id'] ?>" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
              <a href="deleteshipping.php?id=<?php echo $shipping['ship_id'] ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
            </div>
            <br><br>
          <?php
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
      </td>
      <td width="250">
        <a class="btn btn-primary" href="editmember.php?id=<?php echo $user['mem_id'] ?>"><i class="fa fa-edit"></i></a>
        <a class="btn btn-danger" href="#"  data-toggle="modal" data-target="#del<?php echo $user['mem_id'] ?>"><i class="fa fa-trash"></i></a>
        <a class="btn btn-warning" href="printonemember.php?id=<?php echo $user['mem_id'] ?>"><i class="fa fa-print"></i></a>

        <div class="modal fade" id="del<?php echo $user['mem_id'] ?>">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete <?php echo $user['mem_fullname'] ?> ?</p>
      </div>
      <div class="modal-footer">
        <a role="button" class="btn btn-danger" href="instantdeletemember.php?id=<?php echo $user['mem_id'] ?>">Delete</a>
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
