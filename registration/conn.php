<?php
$servername="192.168.1.25";
$dbuser="root";
$dbpassword="mysql";
$dbname="login_register";
$conn= mysqli_connect($servername,$dbuser,$dbpassword,$dbname);
if (!$conn) {
    die("something went wrong");
}






?>