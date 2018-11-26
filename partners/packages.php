<?php
error_reporting(0);
require_once("header.php"); 
session_start();
/*start*/
$data = array(
  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
  "user_id"=>$_SESSION['id'],
  "category_id"=>6,
  "user_id"=>$_SESSION['id']
);
$data_json = json_encode($data);
$api_url = $url."product_list"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response  = curl_exec($ch);//echo"<pre>"; print_r($response); exit;
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
        $products = $responsObj['productDetails'];
		
    }
}
curl_close($ch);
/*end*/
foreach($products as $product){
	$product = (object)$product;
	$image = $product->image;
	//if(file_exists("admin/".$image)){$url = "admin/".$image;}else{ $url = "partners/".$image;}
	$packages .='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="card card-outline-info m-t20">
							<div class="card-body partner">
							<div class="card-top" style="background:url('.$product->image.') no-repeat; width:100%; height:192px;">
                                	<div class="pull-left">
                                    	<a href="edit-reviews.php" class="faicon"><i class="fa fa-commenting-o"></i></a>
                                        <a href="post-revenue.php" class="faicon"><i class="fa fa-inr"></i></a>
                                    </div>
									<div class="pull-right"><a  id="delete" href="create-packages.php?dp='.base64_encode($product->productid).'"   class="fatrash"><i class="fa fa-trash-o"></i></a></div>
									<div class="post-title"><i class="fa fa-flag p-r5"></i>Package</div>
								</div>
                                <div class="card-middle">
                                	<div class="entry-name p-b10">'.$product->name.'</div>
									<div class="switch flt-left m-t2">
                                        <label>
                                            <input type="checkbox" id="status" namee="status" value='.$product->productid.' checked=""><span class="lever switch-col-amber m-l0"></span>
										</label>
                                    </div>
									<div class="text-right"><a href="create-packages.php?ep='.base64_encode($product->productid).'"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">EDIT</button></a></div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>';
	
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
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
   <?php require_once("header.php"); ?>
	
</head>

<body class="fix-header card-no-border">
   
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
   <div id="main-wrapper">
       <?php require_once("top.php");?>
       <?php require_once("left-sidebar.php"); ?>
       <div class="page-wrapper">
           <div class="container-fluid">
               <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Packages</li>
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
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
              <div class="row all-posts">
                    <div class="col-lg-12">
						
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 xsp-l10">
							 <h4 class="card-title m-b0">Packages| You have  <span><?php echo  count($products);?></span>  posts</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 p-r0 text-right p-b10">
                            	<a href="create-packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">+ Create New</button></a>
								<!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">Back</button></a>-->
							</div>
							
						</div>
                        
                    </div>
                <!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="card card-outline-info m-t20">
							<div class="card-body partner">
								<div class="card-top" style="background:url(assets/images/card-banner.jpg) no-repeat; width:100%; height:192px;">
                                	<div class="pull-left">
                                    	<a href="edit-reviews.php" class="faicon"><i class="fa fa-commenting-o"></i></a>
                                        <a href="post-revenue.php" class="faicon"><i class="fa fa-inr"></i></a>
                                    </div>
									<div class="pull-right"><a href="#" data-toggle="modal" data-target="#myTrash"  class="fatrash"><i class="fa fa-trash-o"></i></a></div>
									<div class="post-title"><i class="fa fa-flag p-r5"></i> Packages</div>
								</div>
                                <div class="card-middle">
                                	<div class="entry-name p-b10">package Name comes here</div>
									<div class="switch flt-left m-t2">
                                        <label>
                                            <input type="checkbox" checked=""><span class="lever switch-col-amber m-l0"></span>
										</label>
                                    </div>
									<div class="text-right"><a href="create-packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">EDIT</button></a></div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>-->
					<?php echo $packages; ?>
                </div>
                <div class="bg-borange">
                	<div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <div>At This movement you dont have any posts</div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <a href="create-packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-right">Create New Post</button></a>
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
   <?php require_once("footer.php"); ?>
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
</body>

</html>
