<?php
error_reporting(0);
ob_start();
if(session_id() == '') {
    session_start(); 
}
?>
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
<link href="assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN: BASE PLUGINS  -->
<link href="assets/plugins/revo-slider/css/settings.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/revo-slider/css/layers.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/revo-slider/css/navigation.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/owl-carousel/owl.theme.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/owl-carousel/owl.transitions.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/slider-for-bootstrap/css/slider.css" rel="stylesheet" type="text/css" />
<!-- END: BASE PLUGINS -->
<!-- BEGIN THEME STYLES -->
<link href="assets/base/css/plugins.css" rel="stylesheet" type="text/css" />
<link href="assets/base/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
<link href="assets/base/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css" />
<link href="assets/base/css/custom.css" rel="stylesheet" type="text/css" />
<link href="assets/base/css/jquery-ui.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
<script src="assets/base/js/components.js" type="text/javascript"></script>
<script src="assets/base/js/components-shop.js" type="text/javascript"></script>

<!-- END THEME STYLES -->
<link rel="shortcut icon" hrefr="assets/images/favicon.ico" />
<link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">
<style>
.img-responsive
{
	width:100%;
}
</style>
<!------------------------------------------------------------------------------------------------------->
<?php 
if(!isset($_SESSION['id'])){
	
//header("location:index.php");

}
//define("url","http://disconox.com.fozzyhost.com/v1/InnoChat/");
$url = "http://localhost/disconoxv1/Api/";
const url = "http://localhost/disconoxv1/Api/";
//$url = "http://13.59.92.22/v1/InnoChat/";
$login_url = $url;
require_once('neutral.php');
?>