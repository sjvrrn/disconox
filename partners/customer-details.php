<?php

session_start();
if(!$_SESSION['id']){

    header("location:login.php");
}
/*get user details*/
require_once("header.php");
if(isset($_GET['ce'])){
    $user_id = base64_decode($_GET['ce']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$user_id
    );
    $data_json = json_encode($data);
    $ul = $url."userDetails";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
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
            $user = $responsObj['UserDetails'];
            $name  = explode("_",$user['name']);
            $address = explode(",",$user['address']);
            /*Array ( [id] => 5 [name] => aaaaaaaaa_aaaaaaaa [email] => sriram08534@gmail.com [phone] => aa [address] => [password] => e10adc3949ba59abbe56e057f20f883e [role] => 3
            [image] => [status] => 1 [created] => 2018-02-24 01:04:13 ) */
        }
    }
    curl_close($ch);
}
/*end*/
/*delete user*/
if(isset($_GET['du'])){
    $user_id = base64_decode($_GET['du']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$user_id
    );
    $data_json = json_encode($data);
    $uu = $url."userDelete";
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
            header("location:users.php");
        }
    }
    curl_close($ch);
}
/*form submit*/
if(isset($_POST['submit'])){
    /*start*/
    /*Array ( [last_name] => aaaaaaaa [email] => admin@gmail.com [phone] => 8985740230 [street] => srnagar [city] => hyderabad [state] => Telangana [password] => 11
     [cpassword] => 11 [submit] => ) */

    if(isset($_GET['ce'])){

        $data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "userid"=>base64_decode($_GET['ce']),
            "name"=>$_POST["first_name"] .'_'.$_POST['last_name'],
            "password"=>$_POST["password"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "address"=>$_POST["street"].','.$_POST["city"].','.$_POST["state"]
        );
        $action = $url."userUpdate";
    }else{
        $data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "name"=>$_POST["first_name"].'_'.$_POST['last_name'],
            "password"=>$_POST["password"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "address"=>$_POST["street"].','.$_POST["city"].','.$_POST["state"],
            "role"=>3
        );
        $action = $url."registration";
    }
    $data_json = json_encode($data);
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
            if(isset($_GET['ce'])){
                header("location:customer-details.php?ce=".$_GET['ce']);
            }else{
                header("location:customers.php.php");
            }

        }
    }
    curl_close($ch);
    /*end*/
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
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <?php require_once ("header.php");?>
</head>
<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/disco-logo.png"/> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search" action="" method="post">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Steave Jobs</h4>
                                                <p class="text-muted">varun@gmail.com</p><a href="my-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="my-profile.html"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="my-balance.html"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
    <?php require_once ("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
							<li class="breadcrumb-item active">User Profile Details</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">Selected User Name Comes Here</h4>
							</div>
						</div>
						<div class="row b-b p-b10">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title1 p-t9">ID: <span><?php echo base64_decode($_GET['ce']); ?></span></h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
                            <a href="customer-history.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">View History</button></a>
								<a href="customers.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">Back</button></a>
							</div>
						</div>
                        <div class="card card-outline-info m-t20">
                            
                            <div class="card-body">
                               <form  action="" method="post">
                                <div class="form-body">
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">First Name</label>
                                                <input type="text" id="first_name" name="first_name" class="form-control form-control-danger" value="<?php echo $name[0];?>" required >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" id="last_name" name="last_name" class="form-control form-control-danger" value="<?php echo $name[1];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="email" id="email"  name="email" class="form-control form-control-danger" value="<?php echo $user['email'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone Number</label>
                                                <input type="phonenumber" id="phone" name="phone" class="form-control form-control-danger" value="<?php echo $user['phone'];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="box-title m-t10">Address</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input type="text" class="form-control" name="street" id="street" value="<?php echo $address[0];?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="<?php echo $address[1];?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select class="form-control" name="state" id="city"  required>
                                                    <option>--Select your State--</option>
                                                    <option <?php if($address[2]=="Telangana"){ echo"selected";} ?>>Telangana</option>
                                                    <option <?php if($address[2]=="AndhraPradesh"){ echo"selected";} ?>>AndhraPradesh</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <?php if(isset($_GET['eu'])){ $option ="" ;}else{ $option="required";} ?>
                                                <input type="password" class="form-control" name="password" id="password" <?php echo $option; ?>>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Re Enter Password</label>
                                                <input type="password" class="form-control" id="cpassword" name="cpassword" <?php echo $option; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="flt-left"><img src="assets/images/profile-pick.png"/></div>
                                        <div class="revenue-fa flt-left p-t34 p-l20">
                                            <span class="p-r10"><a href="profile-pick-edit.html?ei=<?php echo base64_encode($user['id']); ?>"><i class="fa fa-pencil lblue"></i></a></span>
                                            <span><a href="profile-pick-edit.html?di=<?php echo base64_encode($user['id']); ?>"><i class="fa fa-trash red"></i></a></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-actions text-right">
                                            <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                                            <button type="reset" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
                                        </div>
                                    </div>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="myTrash" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-md">
                    <div class="modal-content">
      <div class="modal-header text-right">
      </div>
      <div class="modal-body">
	  <button type="button" class="close " data-dismiss="modal">&times;</button>
        <p>You Want To Delete? </p>
        <p>&nbsp;</p>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">YES</button></a>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-danger">NO</button></a>
      </div>
    </div>
                  </div>
                </div>
            </div>
            <div id="footer">
                <footer>
                    <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                </footer>
            </div>
        </div>
    </div>
<?php require_once ("footer.php");?>
    
</body>

</html>
