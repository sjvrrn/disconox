


<?php
session_start();
/*if(!$_SESSION['id']){
    header("location:login.php");
}*/
/*
 * get all users
 */
/*start*/
require_once("header.php");
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "role"=>3
);
$data_json = json_encode($data);
$ua = $url"all_users";

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
$ub = $url."all_users";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $ub);
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
    $uc = $url."add_notification";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uc);
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
   <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
        <?php require_once("top.php"); ?>
         <?php require_once("left-sidebar.php");?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Home</li>
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
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i>0</h4></div>
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
                            	<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left m-r20">Back</button></a>
								<h4 class="card-title m-b20 p-t5">Notifications</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
								<a href="notification-history.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">HISTORY</button></a>
							</div>
							
						</div>
                        <div class="card card-outline-info m-t20">
                            
                            <div class="card-body">
                                <form action=" " method="post">
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
                                              
                                              <?php foreach($users as $user){  $user = (object)$user;?>
                                                <div class="row">
                                                	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <input type="checkbox" id="md_checkbox_1" class="filled-in chk-col-blue" checked />
                                    <label for="md_checkbox_1"><?php echo $user->email?></label>
                                    				</div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                     <?php echo $user->name;?>
                                                    </div>
                                    			</div>
                                                <hr class="m-t0"/>
                                              <?php }?>
                                                </div>
                                                </div>
                                                
                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-actions text-right">
												
												<a href="#" data-dismiss="modal" aria-hidden="true"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                                <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">DONE</button></a>
											</div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                 <!-- sample modal content -->
                                <div class="modal fade bs-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            
                                            <div class="modal-body">
                                                <h4 class="p-b10">Select Partners</h4>
                                                
                                                <div class="scrollbar" id="style-3">
                                                	<div class="force-overflow">
                                               
                                               <?php foreach($partners as $partner){ $parnter = (object)$partner;?>
                                                <div class="row">
                                                	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <input type="checkbox" id="md_checkbox_11" class="filled-in chk-col-blue" checked />
                                    <label for="md_checkbox_11"><?php echo $parnter->email;?></label>
                                    				</div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                    	<?php echo $parnter->name;?>
                                                    </div>
                                    			</div>
                                                <hr class="m-t0"/>
                                               <?php }?>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="form-actions text-right">
												
												<a href="#" data-dismiss="modal" aria-hidden="true"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                                <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">DONE</button></a>
											</div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                            	<div class="dark-gray-bg">
                                                	<input name="group1" type="radio" id="radio_1" checked />
                                                    <label for="radio_1" class="p-r10 m-b0">All Partners</label>
                                                    <input name="group1" type="radio" id="radio_2" />
                                                    <label for="radio_2" class="m-b0"> All Users</label>
                                                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success m-l40">Selected Users Only</button></a>
                                                    <a href="#" data-toggle="modal" data-target=".bs-example-modal-lg1"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">Selected Partners</button></a>
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-12 ">
                                                <div class="form-group p-t20">
												<label>Note</label>
												<textarea class="form-control" placeholder="Enter your Notification here" rows="5"></textarea>
											</div>
                                            </div>
                                        </div>
                                       
                                        <!--/row-->
                                        
                                    </div>
                                    
									<div class="row">
										<div class="col-md-6">
											
										</div>
										<div class="col-md-6">
											<div class="form-actions text-right">
													  <input type='submit' name='submit'  id="submit" value='SAVE' >												
												<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>

											</div>
										</div>
										
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
                
				
            </div>
            
            <div id="footer">
                 <footer>
                   <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                 </footer>
            </div>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
 <?php require_once("footer.php");?>   
</body>

</html>
