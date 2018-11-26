<?php 
session_start();
session_destroy();
$_SESSION = array();
unset($_SESSION); 
header("location:index.php");
?>