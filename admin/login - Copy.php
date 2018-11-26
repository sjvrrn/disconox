<?php
if(isset($_POST['submit'])){
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "email"=>$_POST["email"],
    "password"=>$_POST['password']
);

$data_json = json_encode($data);

//$url = "http://localhost/invention/v1/hrims/adminlogin";
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/login";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response  = curl_exec($ch);


if ($response === false) {
$info = curl_getinfo($ch);
curl_close($ch);
die('error occured during curl exec. Additioanl info: ' . var_export($info));
} else {

$responsObj = json_decode($response, TRUE);

if ($responsObj["error"]) {
echo "Bad Request";
} else {
$message = $responsObj['message'];
echo"<script>alert('".$message."');</script>";
session_start();
$UserDetails = $responsObj['UserDetails'];
$_SESSION['id'] = $UserDetails['id'];
$_SESSION['name'] = $UserDetails['name'];
    $_SESSION['email'] = $UserDetails['email'];
$_SESSION['addresss'] = $UserDetails['address'];
$_SESSION['phone'] = $UserDetails['phone'];
header("location:index.php");
}
}
curl_close($ch);

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
    <?php require_once ("header.php");?>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body>
     <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <section id="wrapper">
        <div class="login-register" style="background-image:url(assets/images/background/login-register.jpg);">    
        	<div class="bg-shadow">    
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="" method="post">
                    <div>
                    	<div class="pull-left"><h3 class="box-title m-b-20">Sign In</h3></div>
                        <div class="pull-right">
                        	<a href="#"><img src="assets/images/logo.png"/></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Username" id="email" name="email"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Password" name="password" id="password"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary pull-left p-t-0">
                                <input id="checkbox-signup" type="checkbox" name="remember_me" id="remember_me">
                                <label for="checkbox-signup"> Remember me </label>
                            </div> <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" name="submit" id="submit" value="submit">Log In</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                            <div class="social">
                                <a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip" title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a>
                                <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip" title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Don't have an account? <a href="register.php" class="text-info m-l-5"><b>Sign Up</b></a></p>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="" method="post">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email"> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn- lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
           </div>
        </div>
        
    </section>
   <?php require_once ("footer.php");?>
   
</body>

</html>