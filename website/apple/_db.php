<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'apple';
$cnn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
mysqli_query($cnn,'SET NAMES UTF8');
?>
