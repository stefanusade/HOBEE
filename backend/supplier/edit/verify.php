<?php
session_start();
if(isset($_SESSION['login'])&&$_SESSION['role']==2){
    $username = $_SESSION['username'];
}else{
    header('Location:../../logout.php');
}