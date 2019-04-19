<?php require ('../_head1.php');
if(isset($_SESSION['id'])) {
$id = $_SESSION['id'];
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id' LIMIT 1";
    $result = mysqli_query($cnn,$sql);
    $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
 ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center" style="width:480px;text-align:center;margin: 0 auto;">
        <img src="../assets/img/like.png" width="128"><br><br>
      <?php
        if(isset($_POST['feedback'])) {
          $fullname = $_POST['fullname'];
          $email = $_POST['email'];
          $content = $_POST['content'];
          if (empty($fullname) || empty($email) || empty($content)) {
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank field(s).</div>';
          } else {
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $sql = "INSERT INTO tbl_feedback(feed_fullname,feed_email,feed_content,feed_date,feed_time,feed_status) VALUES('$fullname','$email','$content','$date','$time',1)";
            $result = mysqli_query($cnn,$sql);
            require ('../_mail.php');
            $mail->Subject = "Thanks for contact us";
            $mail->Body = "<h3>Here's your feedback<br>
            <b>Name : </b>$fullname<br>
            <b>Email : </b>$email<br>
            <b>Content : </b>$content<br>
            <b>Date : </b>$date<br>
            <b>Time : </b>$time<br>

            </h3>";

            $mail->AddAddress($email, "");




            $mail->set('X-Priority', '1');

            $mail->Send();
              header('location:feedback_ok.php');
          }
        }
      ?>
      <h2 class="form-signin-heading text-center">We love feedback</h2><br>

      <form class="form-signin" action="" method="post">
        <?php if(isset($error)) echo $error;?>

        <label  class="sr-only">Name</label>
        <input type="text" autocomplete="off" name="fullname"  class="form-control" placeholder="Name" value="<?php if(isset($id)) echo $user[0]['mem_fullname'];?><?php if(isset($_POST['fullname'])) echo $_POST['fullname'];?>">


        <br>


        <label  class="sr-only">Email</label>
        <input type="text" autocomplete="off" name="email"  class="form-control" placeholder="Email" value="<?php if(isset($id)) echo $user[0]['mem_email'];?><?php if(isset($_POST['email'])) echo $_POST['email'];?>">



        <br>

        <textarea class="form-control" name="content" placeholder="Your feedback" rows="6" style="resize:none"><?php if(isset($_POST['content'])) echo $_POST['content'];?></textarea>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="feedback">Send</button>
      </form>
      <h5><a href="findfeedback.php" class="">Track your feedback</a></h5>

    </div>
    </div>
    <?php require ('../_foot.php'); ?>
