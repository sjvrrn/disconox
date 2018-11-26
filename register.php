<?php
if(isset($_POST['submit'])){
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "name"=>$_POST['name'],
    "password"=>$_POST['password'],
    "email"=>$_POST["email"],
    "phone"=>"",
    "address"=>"",
	"image"=>"",
    "role"=>1
);

$data_json = json_encode($data);

//$url = "http://localhost/invention/v1/hrims/adminlogin";
 $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/registration";

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
header("location:login.php");

echo $empDetails['employee_number'];
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
    <?php  require_once ("header.php");?>
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
            <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="" method="post">
                   
                    <div>
                    	<div class="pull-left"><h3 class="box-title m-b-20">Sign Up</h3></div>
                        <div class="pull-right">
                        	<a href="#"><img src="assets/images/logo.png"/></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Name" name="name" id="name">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Password" name="password" id="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" required="" placeholder="Confirm Password" name="cpassword" id="cpassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-success p-t-0 p-l-10">
                                <input id="checkbox-signup" type="checkbox" id="terms_conditions" name="terms_conditions">
                                <label for="checkbox-signup"> I agree to all <a href="#">Terms</a></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" name="submit" id="submit" type="submit">Sign Up</button>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Already have an account? <a href="login.php" class="text-info m-l-5"><b>Sign In</b></a></p>
                        </div>
                    </div>
                </form>
                
            </div>
          </div>
        </div>
    </section>
</body>
<?php require_once("footer.php");?>
</html>