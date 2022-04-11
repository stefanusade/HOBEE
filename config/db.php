<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'hobee';

$conn = mysqli_connect($db_host,$db_user,$db_pass,$db_name);

if(mysqli_connect_errno()){
    echo mysqli_connect_error();
    exit;
}

// Time Configuration
date_default_timezone_set("Asia/Jakarta");
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');
$year = date('Y');