<?php
/**
 * Created by PhpStorm.
 * User: Recording
 * Date: 03/Mar/2018
 * Time: 11:53 PM
 */
ob_start(); 
error_reporting(0);
session_start();
if(!isset($_SESSION['id'])){
//header("location:logout.php");
		}

//$url = "http://disconox.com.fozzyhost.com/v1/InnoChat/";
$url = "localhost/disconoxv1/Api/";
 require_once('partner_neutral.php');
?>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/jquery-ui.css" rel="stylesheet">
<link href="css/fonts/css/fontawesome.css" rel="stylesheet">
<link href="css/fonts/css/fa-brands.css" rel="stylesheet">
<link href="css/fonts/css/fa-regular.css" rel="stylesheet">
<link href="css/fonts/css/fa-solid.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/colors/blue.css" id="theme" rel="stylesheet">
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<link href="css/example-styles.css" rel="stylesheet" type="text/css">

<!-----------------customer----------------->
