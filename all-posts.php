<?php
error_reporting(0);
session_start();
require_once("header.php");
if(!isset($_SESSION['id'])){
    header("location:login.php");
}else{
/*start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
);
$data_json = json_encode($data);
$ul = $url."productByCategory";
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
        $products = $responsObj['ProductDetails'];
		//echo"<pre>"; print_r($products); exit;
    }
}
curl_close($ch);
/*end*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
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
                    <a class="navbar-brand" href="index.php"><img src="assets/images/disco-logo.png"/> </a>
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
                                                <p class="text-muted">varun@gmail.com</p><a href="my-profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="my-profile.php"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="my-balance.php"><i class="ti-wallet"></i> My Balance</a></li>
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
                            <li class="breadcrumb-item active">Posts</li>
							
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
                <div class="row all-posts" id="post_display">
                    <div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">You have <span>8</span>  posts</h4>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 p-l0">
								<div class="form-group">
									<div>
										Search <input type="text" class="form-control w65 border-no border-rno" placeholder=" ">
									</div>
                                </div>
							</div>
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 p-l0">
								<div class="form-group country">
									<label class="control-label text-right col-md-3">Sort by</label>
										<span class="bg-white p-tb7-rl0">
										<select class="form-control custom-select w65 border-no" id="category" name="category">
										    <option>All</option>
											<option value="Deals_Offers">Deals & Offers</option>
											<option value="Surprise">Surprise</option>
											<option value="Guest_List">Guest List</option>
											<option value="Book_A_Table">Book A Table</option>
											<option value="Book_A_Bottle">Book A Bottle</option>
											<option value="Packages">Packages</option>
											<option value="Entry">Entry</option>
										</select>
										</span>
                                </div>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 p-r0 text-right">
								&nbsp;
							</div>
						</div>
                    </div>
                    <div class="row" id="display_data" style="width:100%">
					<?php foreach($products as $product){ $product = (object)$product; ?>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="card card-outline-info m-t20">
							<div class="card-body">
                            <?php 
							             $imageURL = $product->image;
							if (!file_exists(dirname($_SERVER['SCRIPT_FILENAME']).'/'.$imageURL)) {
                                                           $imageURL = "../partners/".$imageURL;
                                                                                              } if($imageURL==""){$imageURL='assets/images/post-banner.jpg'; }
							if($product->category_id==1){
									$link = "edit-deals-offers.php?id=".$product->id;
								}elseif($product->category_id==2){
									$link = "edit-surprise.php?id=".$product->id;
								}elseif($product->category_id==3){
									$link = "edit-guest-list.php?id=".$product->id;
								}elseif($product->category_id==4){
									$link = "edit-book-table.php?id=".$product->id;
								}elseif($product->category_id==5){
									$link = "edit-book-bottle.php?id=".$product->id;
								}elseif($product->category_id==6){
									$link = "edit-packages.php?id=".$product->id;
								}elseif($product->category_id==7){
									$link = "edit-entry.php?id=".$product->id;
								}																  
							
							
							?>
                            
								<div class="card-top" style="background:url(<?php echo $imageURL;?>) no-repeat center center /cover; width:100%; height:192px;">
									<div><a href="pick-edit.php?id=<?php echo base64_encode($product->id); ?>" class="fatrash" data-toggle="modal" data-target="#myTrash"><i class="fa fa-trash-o"></i></a></div>
									<div class="post-title"><i class="fa fa-flag p-r5"></i><?php echo $product->category_name;?></div>
								</div>
                                <div class="card-middle">
									<div class="entry-name p-b10"><?php echo $product->name;?></div>
									<div class="switch flt-left m-t2">
                                        <label>
                                            <input type="checkbox" checked=""><span class="lever switch-col-amber m-l0"></span>
										</label>
                                    </div>
									<div class="text-right"><a href="<?php echo $link; ?>" type="button" class="btn waves-effect waves-light btn-rounded btn-success">EDIT</button></a></div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>
                    
                       <?php }?>
					</div>
                </div>
<div id="myTrash" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
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
<script>
$(document).ready(function(){
	$(document).on('change','#category',function(){
		var val = $(this).val();
		/*ajax start*/
		 $.ajax({
                    type: 'post',
                    url: 'post_category.php',
                    data:"category_name="+val,
                    success: function (data) {
						$("#display_data").html(data);
                    }
                });
		/*ajax end*/
		
		});
	
	});
</script>
<?php }?>