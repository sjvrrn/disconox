<?php
session_start();
/*if(!$_SESSION['id']){
    header("location:login.php");
}*/
/*
 * get all users
 */
/*start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "role"=>3
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/all_users";

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
        $users = $responsObj['PartnersData'];
    }
}
curl_close($ch);
/*
 * get all partners
 */
/*start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "role"=>2
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/all_users";

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
        $partners = $responsObj['PartnersData'];
    }
}
curl_close($ch);
if(isset($_POST['submit'])){
$users  = 1;
$partners  = 4;
$note    = $_POST['note'];
 $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "users"=>$users,
        "partners"=>$partners,
        "notification"=>$note
    );
    $data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/add_notification";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch); print_r($response); exit;
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
            header("location:surprise.php");
        }
    }
    curl_close($ch);
	}
/*end*/?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
<?php require_once("header.php");?>
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
                            <form class="app-search">
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
        <?php require_once("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Notifications</li>
							
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
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
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
        						<h4 class="card-title m-b20 p-t5">Notifications</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
								<a href="notification-history.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">HISTORY</button></a>
							</div>
						</div>
                        <div class="card card-outline-info m-t20">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        <div class="row">
                                        	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">Whome you want to send</div>
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="p-b10">Select Users</h4>
                                                	<div class="scrollbar" id="style-4">
                                                	<div class="force-overflow">
                                              <!-----select users---->
                                                        <?php foreach($users as $user){ $user = (object)$user; ?>
                                                <div class="row">
                                                	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <input type="checkbox"  name="users[]" id="users"   />
                                    <label for="md_checkbox_1"><?php echo $user->email; ?></label>
                                    				</div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    	<?php echo $user->name; ?>
                                                    </div>
                                    			</div>
                                                <hr class="m-t0"/>
                                                        <?php }?>
                                            <!--select user end-->
                                                </div>
                                                </div>
                                            </div>
                                           <!-- <div class="modal-footer">
                                                <div class="form-actions text-right">
												
												<a href="#" data-dismiss="modal" aria-hidden="true"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                                <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">DONE</button></a>
											</div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4 class="p-b10">Select Partners</h4>
                                                <div class="scrollbar" id="style-3">
                                                	<div class="force-overflow">
                                           <?php foreach($partners as $partner){ $partner = (object)$partner;?>
                                                <div class="row">
                                                	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <input type="checkbox" id="md_checkbox" name="partners[]" id="partners"  />
                                    <label for="md_checkbox_5"><?php echo $partner->email;?></label>
                                    				</div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    	<?php echo $partner->name;?>
                                                    </div>
                                    			</div>
                                                <hr class="m-t0"/>
                                                     <?php }?>
                                                </div>
                                                </div>
                                            </div>
                                          <!--  <div class="modal-footer">
                                                <div class="form-actions text-right">
												
												<a href="#" data-dismiss="modal" aria-hidden="true"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                                <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">DONE</button></a>
											</div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                                            	<div class="dark-gray-bg">
                                                	<input name="group1" type="radio" id="radio_1" checked />
                                                    <label for="radio_1" class="p-r10 m-b0">All Partners</label>
                                                    <input name="group1" type="radio" id="radio_2" />
                                                    <label for="radio_2" class="m-b0"> All Users</label>
                                                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success m-l40">Selected Users Only</button></a>
                                                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg1"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">Selected Partners Only</button></a>
                                                </div>
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group p-t20">
												<label>Note</label>
												<textarea class="form-control" id="note" name="note" placeholder="Enter your Notification here" rows="5"></textarea>
											</div>
                                            </div>
                                        </div>
                                    </div>
        							<div class="row">
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<div class="form-actions text-right">
                                                <a href="#"><input type="submit" name="submit" id="submit" value="SAVE"></a>												
												<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>

											</div>
										</div>
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        		<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <h4>Overflowing text to show scroll behavior</h4>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
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
    <?php require_once("footer.php");?>
    </body>
</html>
