<?php

function generateToken($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function listProductByYear($year) {
  global $cnn;
  $sql = "SELECT * FROM tbl_product WHERE pro_year='$year' ORDER BY pro_price";
  $result = mysqli_query($cnn,$sql);
  $products = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $products;
}

function login($username,$password) {
  global $cnn;
  $sql = "SELECT * FROM tbl_member WHERE mem_username='$username' AND mem_password='$password'";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $user;
}

function register($username,$password,$fullname,$email,$phone) {
  global $cnn;
  $sql = "INSERT INTO tbl_member VALUES(null,'$username','$password','$fullname','$email','$phone','')";
  $result = mysqli_query($cnn,$sql);
  require_once('class.phpmailer.php');
	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = "ssl"; // sets the prefix to the servier
	$mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
	$mail->Port = 465; // set the SMTP port for the GMAIL server
	$mail->Username = "s58122202001@gmail.com"; // GMAIL username
	$mail->Password = "Kendo133"; // GMAIL password
	$mail->From = "s58122202001@gmail.com"; // "name@yourdomain.com";
	//$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	$mail->FromName = "Mongkon Srisin";  // set from Name
	$mail->Subject = "Welcome to iStore";
	$mail->Body = "<h3>Welcome to iStore <br> Here's your information<br>
  <b>Username : </b>$username<br>
  <b>Password : </b>$password<br>
  <b>Fullname : </b>$fullname<br>
  <b>Email : </b>$email<br>
  <b>Phone : </b>$phone<br>

  </h3>";

	$mail->AddAddress($email, ""); // to Address



	//$mail->AddCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC
	//$mail->AddBCC("member@thaicreate.com", "Mr.Member ShotDev"); //CC

	$mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low

	$mail->Send();
}

function updateProfile($id,$fullname,$email,$phone) {
  global $cnn;

  $target_dir = "../assets/img/mem/";
$target_file = $target_dir . basename($_FILES["pic"]["name"]);

$sql = "SELECT * FROM tbl_member WHERE mem_id=$id";
$result = mysqli_query($cnn,$sql);
$user = mysqli_fetch_all($result,MYSQLI_ASSOC);
$x = rename($target_file, "../assets/img/mem/".$user[0]['mem_username'].'.jpg');


  move_uploaded_file($_FILES["pic"]['tmp_name'], $target_file);

//  print_r($_FILES);


  $sql = "UPDATE tbl_member SET mem_fullname='$fullname' , mem_email='$email' , mem_phone='$phone' WHERE mem_id='$id'";
  $result = mysqli_query($cnn,$sql);
}

function getUserById($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_member  WHERE mem_id='$id'";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $user[0];
}

function getUserByEmail($email) {
  global $cnn;
  $sql = "SELECT * FROM tbl_member WHERE mem_email='$email'";
  $result = mysqli_query($cnn,$sql);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $user;
}

function getProductById($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_product WHERE pro_id='$id'";
  $result = mysqli_query($cnn,$sql);
  $product = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $product[0];
}

function listAllUsers() {
  global $cnn;
  $sql = "SELECT * FROM tbl_member";
  $result = mysqli_query($cnn,$sql);
  $users = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $users;
}

function listAllFeedbacks() {
  global $cnn;
  $sql = "SELECT * FROM tbl_feedback";
  $result = mysqli_query($cnn,$sql);
  $feedbacks = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $feedbacks;
}

function listAllOsks() {
  global $cnn;
  $sql = "SELECT * FROM tbl_osk";
  $result = mysqli_query($cnn,$sql);
  $osks = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $osks;
}

function addProducts($name,$price,$image,$year) {
  global $cnn;
  $sql = "INSERT INTO tbl_product VALUES(null,'$name','$price','$image','$year','0')";
  $result = mysqli_query($cnn,$sql);
}


function updateProduct($id,$name,$price) {
  global $cnn;
  $sql = "UPDATE tbl_product SET pro_name='$name' , pro_price='$price' WHERE pro_id='$id'";
  $result = mysqli_query($cnn,$sql);
}

function deleteProduct($id) {
  global $cnn;
  $sql = "DELETE FROM tbl_product WHERE pro_id='$id'";
  $result = mysqli_query($cnn,$sql);
}

function getCommentByProductId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_comment LEFT JOIN tbl_member ON tbl_comment.com_member = tbl_member.mem_id WHERE com_product='$id'";
  $result = mysqli_query($cnn,$sql);
  $comment = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $comment;
}

function countCommentByProductId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_comment WHERE com_product='$id'";
  $result = mysqli_query($cnn,$sql);
  return mysqli_num_rows($result);
}

function countCommentByUserId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_comment WHERE com_member='$id'";
  $result = mysqli_query($cnn,$sql);
  return mysqli_num_rows($result);
}

function addComment($user,$product,$text) {
  global $cnn;
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $sql = "INSERT INTO tbl_comment VALUES(null,'$text','$product','$user','$date','$time')";
  $result = mysqli_query($cnn,$sql);
}

function searchProduct($q) {
  global $cnn;
  $sql = "SELECT * FROM tbl_product WHERE pro_name LIKE '%$q%'";
  $result = mysqli_query($cnn,$sql);
  $product = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $product;
}

function checkUsername($username) {
  global $cnn;
  $sql = "SELECT * FROM tbl_member WHERE mem_username='$username'";
  $result = mysqli_query($cnn,$sql);
  return $result;
}



function sendFeedback($fullname,$email,$content) {
  global $cnn;
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $sql = "INSERT INTO tbl_feedback VALUES(null,'$fullname','$email','$content','$date','$time')";
  mysqli_query($cnn,$sql);

}
function deleteFeedback($id) {
  global $cnn;
  $sql = "DELETE FROM tbl_feedback WHERE feed_id='$id'";
  $result = mysqli_query($cnn,$sql);
}

function getConfig($key) {
  global $cnn;
  $sql = "SELECT cfg_value FROM tbl_config WHERE cfg_key='$key'";
  $result = mysqli_query($cnn,$sql);
  $config = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $config[0]['cfg_value'];
}

function updateConfig($key,$value) {
  global $cnn;
  $sql = "UPDATE tbl_config SET cfg_value='$value' WHERE cfg_key='$key'";
  $result = mysqli_query($cnn,$sql);
}

function getShippingbyUserId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_shipping WHERE ship_member='$id'";
  $result = mysqli_query($cnn,$sql);
  $shipping = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $shipping;
}

function getShippingbyId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_shipping WHERE ship_id='$id'";
  $result = mysqli_query($cnn,$sql);
  $shipping = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $shipping;
}

function addShipping($name,$address,$district,$amphoe,$province,$zipcode,$phone,$user) {
  global $cnn;
  $sql = "INSERT INTO tbl_shipping VALUES(null,'$name','$address','$phone','$user','$district','$amphoe','$province','$zipcode')";
  $result = mysqli_query($cnn,$sql);
}

function updateShipping($name,$address,$phone,$id) {
  global $cnn;
  $sql = "UPDATE  tbl_shipping SET ship_name='$name' , ship_address='$address' , ship_phone='$phone' WHERE ship_id='$id'";
  $result = mysqli_query($cnn,$sql);
}

function deleteShipping($id) {
  global $cnn;
  $sql = "DELETE FROM  tbl_shipping  WHERE ship_id='$id'";
  $result = mysqli_query($cnn,$sql);
}


function forgotPassword($email,$token) {
  global $cnn;
  $sql = "UPDATE tbl_member SET mem_token='$token' WHERE mem_email='$email'";
  $result = mysqli_query($cnn,$sql);
}

function countShippingByUserId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_shipping WHERE ship_member='$id'";
  $result = mysqli_query($cnn,$sql);
  return mysqli_num_rows($result);
}

function countOrderByUserId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_order WHERE or_member='$id'";
  $result = mysqli_query($cnn,$sql);
  return mysqli_num_rows($result);
}

function checkCart($user,$product) {
  global $cnn;
  $sql = "SELECT * FROM tbl_cart WHERE cart_member='$user' AND cart_product='$product'";
  $result = mysqli_query($cnn,$sql);
  return mysqli_num_rows($result);

}


function addToCart($user,$product,$quantity) {
  global $cnn;
  $sql = "INSERT INTO tbl_cart VALUES(null,'$user','$product','$quantity')";

  $result = mysqli_query($cnn,$sql);

}



function updateCart($user,$product,$quantity) {

}

function showCart($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_cart LEFT JOIN tbl_product ON tbl_cart.cart_product=tbl_product.pro_id WHERE cart_member='$id'";
  $result = mysqli_query($cnn,$sql);
  $cart = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $cart;
}


function cartToOrder($cartid,$userid,$address) {
  global $cnn;
  $date = date("Y-m-d");
  $time = date("H:i:s");
  $sql = "SELECT * FROM tbl_cart LEFT JOIN tbl_product ON tbl_cart.cart_product=tbl_product.pro_id WHERE cart_member='$userid'";
  $result1 = mysqli_query($cnn,$sql);
  $sql = "INSERT INTO tbl_order VALUES(null,'$userid','$date','$time','$address',1)";
  $result = mysqli_query($cnn,$sql);
  $orderid = mysqli_insert_id($cnn);

  while($cart = mysqli_fetch_assoc($result1)) {
    $sql = "INSERT INTO tbl_order_detail VALUES(null,'$cart[cart_product]','$cart[cart_quantity]','$orderid')";
    $result = mysqli_query($cnn,$sql);
  }
  $sql = "DELETE FROM tbl_cart WHERE cart_member='$userid'";
  $result = mysqli_query($cnn,$sql);


}

function getOrderbyUserId($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_order LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id WHERE or_member='$id'";
  $result = mysqli_query($cnn,$sql);
  $orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $orders;
}


function getOrderDetail($id) {
  global $cnn;
  $sql = "SELECT * FROM tbl_order_detail LEFT JOIN tbl_product ON tbl_order_detail.detail_product = tbl_product.pro_id
  LEFT JOIN tbl_order ON tbl_order_detail.detail_order=tbl_order.or_id
  LEFT JOIN tbl_member ON tbl_order.or_member=tbl_member.mem_id
  WHERE detail_order='$id'";
  $result = mysqli_query($cnn,$sql);
  $orders = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $orders;
}



 ?>
