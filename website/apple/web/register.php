<?php require ('../_head1.php');

 ?>

    <div class="container">
      <br><br>

      <div class="jumbotron text-center" style="width:560px;text-align:center;margin: 0 auto;">
        <img src="../assets/img/mem/profile.png" width="128"><br><br>

      <?php
        if(isset($_POST['register'])) {

          //Get register form value
          $username = $_POST['username'];
          $fullname = $_POST['fullname'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $confirmpassword = $_POST['confirmpassword'];
          $phone = $_POST['phone'];

          if (empty($username) || empty($password) || empty($fullname) || empty($email) || empty($phone)) {
            //Check for blank fields
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Blank field(s).</div>';
          } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //Check for email formatting
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Wrong email.</div>';
          } else if ($password != $confirmpassword) {
            //Check for matching password
            $error = '<div class="alert alert-danger" role="alert"><strong>Error !</strong> Password mismatch.</div>';
          } else {
            //Nothing error , so registerrrrr
			$date = date('Y-m-d');
            $sql = "INSERT INTO tbl_member(mem_username, mem_password, mem_fullname, mem_email, mem_phone, mem_status, mem_photo,mem_registerdate) VALUES('$username','$password','$fullname','$email','$phone',1,'profile.png','$date')";
            $result = mysqli_query($cnn,$sql);
            require ('../_mail.php');
            $mail->Subject = "Thanks for register !";
            $mail->Body = "<h3>Welcome to Apple <br> Here's your information<br>
            <b>Username : </b>$username<br>
            <b>Password : </b>$password<br>
            <b>Fullname : </b>$fullname<br>
            <b>Email : </b>$email<br>
            <b>Phone : </b>$phone<br>
            </h3>";

            $mail->AddAddress($email, "");




            $mail->set('X-Priority', '1');

            $mail->Send();
            header('location:register_ok.php');
          }

        }
      ?>
      <h2 class="form-signin-heading text-center">Create new account</h2><br>

      <form class="form-signin" action="" method="post">
        <?php if(isset($error)) echo $error;?>

        <label  class="sr-only">Username</label>
        <input type="text" autocomplete="off" name="username"  class="form-control" placeholder="Username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">

        <label  class="sr-only">Password</label>
        <input type="password" autocomplete="off" name="password" class="form-control" placeholder="Password" value="">
        <label  class="sr-only">Password</label>
        <input type="password" autocomplete="off" name="confirmpassword" class="form-control" placeholder="Confirm Password" value="">
        <br>
        <label  class="sr-only">Full Name</label>
        <input type="text" autocomplete="off" name="fullname"  class="form-control" placeholder="Full Name" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname'];?>">

        <label  class="sr-only">Email</label>
        <input type="text" autocomplete="off" name="email"  class="form-control" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">

        <label class="sr-only">Phone</label>
        <input type="text" autocomplete="off" name="phone" class="form-control" placeholder="Phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">

        <br>



        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="register">Register</button>
      </form>
    </div>

    </div>
    <?php require ('../_foot.php'); ?>
