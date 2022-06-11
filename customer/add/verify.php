<?php
session_start();
if(!isset($_SESSION['login'])||$_SESSION['role']!=3){
    header('Location:../../login.php');
}
$username = $_SESSION['username'];