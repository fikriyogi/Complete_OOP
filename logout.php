<?php 

include('class/db.class.php');
$db = new database();

session_start();

$db->logout($_SESSION['email']);

setcookie('username', '', 0, '/');
setcookie('nama', '', 0, '/');

session_unset();
session_destroy();

header('location:login.php');
?>