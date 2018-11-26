<?php
error_reporting(0);
session_start();
if(!$_SESSION['id']){
    header("location:../admin/login.php");
}
if(isset($_GET['ep'])){
/*get product Details*/
$productId = base64_decode($_GET['ep']); 
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=> $productId
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/getproductDetails";
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
        $product = (object)$responsObj['productDetails'][0];  
		$product_id = $productId; 

    }
}
curl_close($ch);
/*end*/
/*getDetals & offers start*/
$productId = base64_decode($_GET['ep']); 
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/getDealsoffers";
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
        $deal = (object)$responsObj['productDetails'][0];
		$offer = (object)$responsObj['productDetails'][1];
		$deal_id = $deal->id;
		$offer_id = $offer->id;
		
    }
}
curl_close($ch);
/*end*/
/*getDetals & offers start*/
$productId = base64_decode($_GET['ep']); 
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>1
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/getreviews";
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
		$reviews = $responsObj['reviews'];
    }
}
curl_close($ch);
}
if(isset($_GET['dp'])){
	 $productId = base64_decode($_GET['dp']); 	
		/*delete deal*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=> $productId
);
$data_json = json_encode($data);
$url = "http://localhost/angular/disconox/Disco/v1/InnoChat/productDelete";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response  = curl_exec($ch);print_r($response);
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
        header('location:../partners/deals-offers.php');
		

    }
}
curl_close($ch);

/* end*/
	}

/*end*/
if(isset($_POST['submit'])){ 
	if(count($_FILES)>0){
    /*images*/
    $j = 0;
    $images = array();
    for ($i = 0; $i < count($_FILES['images']['tmp_name']); $i++) {
        $target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['images']['name'][$i]));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
        $j = $j + 1;
        if (($_FILES["images"]["size"][$i] < 10000000)
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $target_path)) {
                $images[$i] = $target_path;
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
    /*gallery*/
    $j = 0;
    $gallery = array();
    for ($i = 0; $i < count($_FILES['gallery']['name']); $i++) {
        $target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['gallery']['name'][$i]));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
        $j = $j + 1;
        if (($_FILES["gallery"]["size"][$i] < 10000000)
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $target_path)) {
                array_push($gallery,$target_path);
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
  /*end*/
}
    //deals&offers-1,surprise-2,guestlist-3,booktable-4,bookbottle-5,package-6,entry-7
	if(isset($_GET['ep'])){
    $data= array(
						"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
						"product_id"=>$productId,
						"user_id"=>$_SESSION['id'],
						"name"=>$_POST['venue_name'],
						"address"=>$_POST['address'],
						"highlights"=>$_POST['specialities'],
						"location"=>$_POST['map_url'],
			            "closed_date"=>$_POST['date-format1'],
			            "tags"=>$_POST['tags'],
			            "description"=>$_POST['venue_description'],
			            "artist_info"=>$_POST['venue_description1'],
			            "status"=>0
			             );
/*update product*/
    $data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/updateItem";
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
			if(isset($_GET['ep'])){
            header("location:edit-deals-offers.php?ep=".$_GET['ep']);				
				}else{
            header("location:edit-deals-offers.php");
			                       }
        }
    }
    curl_close($ch);			
/*end*/
/*update deals**/

    $data= array(
						"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
						"deal_id"=>$deal_id,
						"name"=> $_POST['deal_name'],
						"highlights"=>$_POST['deal_highlite'],
						"price"=>$_POST['deal_amount'],
						"start_date_time"=>$_POST['deal_start_date'].$_POST['deal_start_time'],
			            "end_date_time"=>$_POST['deal_end_date'].$_POST['deal_end_time'],
			            "tags"=>$_POST['deal_tags'],
			            "about_deal"=>$_POST['deal_description'],
			             );

    $data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/modifyDeal";
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
			if(isset($_GET['ep'])){
            header("location:edit-deals-offers.php?ep=".$_GET['ep']);				
				}else{
            header("location:edit-deals-offers.php");
			                       }
        }
    }
    curl_close($ch);			


/*end*/		
/*update offer*/
$data= array(
						"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
						"deal_id"=>$deal_id,
						"name"=> $_POST['offer_Name'],
						"highlights"=>$_POST['offer_highlite'],
						"price"=>$_POST['offer_amount'],
						"start_date_time"=>$_POST['offer_start_date'].$_POST['offer_start_time'],
			            "end_date_time"=>$_POST['deal_end_date'].$_POST['offer_end_time'],
			            "tags"=>$_POST['offer_tags'],
			            "about_deal"=>$_POST['offer_description'],
			             );
    $data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/updateItem";
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
			if(isset($_GET['ep'])){
            header("location:edit-deals-offers.php?ep=".$_GET['ep']);				
				}else{
            header("location:edit-deals-offers.php");
			                       }
        }
    }
    curl_close($ch);			

}
/*end*/			
	
			
    $product_offers = array(
                    "name"=>$_POST['offer_Name'],
                    "type"=>2,
                    "price"=>$_POST['offer_amount'],
                    "start_date_time"=>$_POST['offer_start_date'].':'.$_POST['offer_start_time'],
                    "end_date_time"=>$_POST['offer_end_date'].':'.$_POST['offer_end_time'],
                    "tags"=>$_POST['offer_tags'],
                   "about_deal"=>$_POST['offer_description']
                     );
    $product_deal= array(
                    "name"=>$_POST['deal_name'],
                    "type"=>1,
                    "price"=>$_POST['deal_amount'],
                    "start_date_time"=>$_POST['deal_start_date'].':'.$_POST['deal_start_time'],
                    "end_date_time"=>$_POST['deal_end_date'].':'.$_POST['deal_end_time'],
                    "tags"=>$_POST['deal_tags'],
                    "about_deal"=>$_POST['deal_description']
                            );
   
    $product_reviews = array(
                      "rating"=>$_POST['review_name'],
                      "review"=>$_POST['rate_comment'],
					  "uid"=>$_SESSION['id'],
                      "status"=>1
                       );

    $product_images  = array("images"=>implode(",",$images),"type"=>1);
    $product_gallery  = array("images"=>implode(",",$gallery),"type"=>2);
    $product_videos   = array("videos"=>implode(",",$_POST['video']));
	 $product_terms = array("description"=> implode(",",$_POST['terms_conditions']) );
	/**addproduct**/
	$data = array("clientId"=>"x6DmrbsQFZyUUiggs0BZ",
					"user_id"=>$_SESSION['id'],
					"category_id"=>1,
					"name"=>$_POST['venue_name'],
					"address"=>$_POST['address'],
					"highlights"=>$_POST['specialities'],
					"location"=>$_POST['map_url'],
					  "closed_date"=>$_POST['date-format1'],
					  "tags"=>$_POST['tags'],
					  "description"=>$_POST["venue_description"],
					  "artist_info"=>$_POST["venue_description1"],
					  "status"=>"1");					 
							 
							 
	$data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/Product";
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
            $parentId = $responsObj['parent_id']; 
		 
 $data = array(
                 "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                 "product_id"=>$parentId,
                 "product_deals"=> (object)$product_deal,
                 "product_offers"=>(object)$product_offers,
                 "product_terms"=>(object)$product_terms,
                 "product_reviews"=>(object)$product_reviews,
                 "product_images"=>(object)$product_images,
                 "product_gallery"=>(object)$product_gallery,
                 "product_videos"=>(object)$product_videos
               );
//'clientId','product_deals','product_offers','product_terms','product_reviews','product_images','product_gallery','product_videos'		   
    $data_json = json_encode($data);
    $url = "http://localhost/Disco/v1/InnoChat/addDealsoffers";
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
            header("location:edit-deals-offers.php");
        }
    }
    curl_close($ch);
    /*end*/
	
	   }
    }
    curl_close($ch);
//end	
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
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <!-- page CSS -->
    <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
	<?php require_once ("header.php");?>
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/disco-logo.png"/> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->	
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
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
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
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
                            <li class="breadcrumb-item active">posts</li>
							<li class="breadcrumb-item active">edit deals & offers</li>
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
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                
                <!-- ./Row -->
                <!-- Row -->
				<div class="row b-b">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
						<a href="all-posts.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button></a>
						<h4 class="card-title m-b20 flt-left p-t5 p-l20 ">Edit Deals &amp; Offers</h4>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
						<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>
						<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
						<a href="edit-deals-offers.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button></a>
					</div>
							
				</div>
				
                <div class="row m-t20">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
								<form action="" method="post"  enctype="multipart/form-data">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Venue Name</label>
												<input type="text" id="venue_name" name="venue_name" class="form-control" placeholder="Venue Name" value='<?php echo $product->name; ?>'>
												<small class="form-control-feedback"></small> 
											</div>
                                        </div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Venue Location Map (url)</label>
												<input type="text" id="map_url" name="map_url"  class="form-control" placeholder="paste your google map url here" value="<?php  echo $product->location; ?>">
												<small class="form-control-feedback"></small> 
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<h5 class="m-t-30">Venue Category (ex: Pub, Bar, Casual Dining,.. etc) </h5>
											<div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
												<input type="text" name="tags" id="tags" data-role="tagsinput" placeholder="add tags" value="<?php echo $product->tags; ?>">
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-material p-t40">
												<label>Post Close from website Date & time</label>
											   <input type="text" id="date-format1" name="date-format1" class="form-control" placeholder=" " value="<?php echo $product->closed_date; ?>">
										   </div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Address</label>
												<textarea class="form-control" rows="5" id="address" name="address"><?php echo $product->address;?></textarea>
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Venue Highlights / Specialities</label>
												<textarea class="form-control" rows="5" id="specialities" name="specialities"><?php echo $product->highlights; ?></textarea>
											</div>
                                        </div>
									</div>
									<hr class="hr"/>
                                    <!-----------------------------------------deals--------------------------------------------------------------------------------------->
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h4 class="card-title p-t10">Deals</h4>
											<div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Deal Name</label>
															<input type="text" id="deal_name"  name="deal_name" class="form-control" placeholder="ex: Golden coin" value="<?php echo $deal->name;?>">
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Highlite Text</label>
															<input type="text" id="deal_highlite" name="deal_highlite"  class="form-control" placeholder="Ex: 50% Off, Next 1 Hour" value="<?php echo $deal->subtitle;?>"  >
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Minimum booking amount</label>
															<input type="text" id="deal_amount" name="deal_amount" class="form-control" placeholder="1000/-" value="<?php echo $deal->price;?>">
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													
												</div>
                                                <?php 
												
												$date_time = explode(" ",$deal->start_date_time);
												$date_time2 = explode(" ",$deal->end_date_time);
												?>
												<div class="row">
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <label class="control-label">Start date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="deal_start_date" name="deal_start_date"  placeholder="mm/dd/yyyy" value="<?php echo $date_time[0];?>">
                                            </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
												<label class="control-label">Start Time</label>
												<input  type='time' class="form-control" id="deal_start_time" name="deal_start_time" placeholder="Check time"  value="<?php echo $date_time[1]; ?>">
												<small class="form-control-feedback"></small> 
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <label class="control-label">End date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="deal_end_date" name="deal_end_date" placeholder="mm/dd/yyyy" value="<?php echo $date_time2[0]; ?>">
                                            </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
												<label class="control-label">End Time</label>
												<input  type="time" class="form-control" id="deal_end_time" name="deal_end_time" placeholder="Check time" value="<?php echo $date_time2[1];?>">
												<small class="form-control-feedback"></small> 
											</div>
										</div>
												</div>
												
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<h5>Highlights / items</h5>
												<div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
													<input type="text" id="deal_tags"  name="deal_tags" data-role="tagsinput" placeholder="add tags" value="<?php echo $deal->tags; ?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="m-b0">About the deal</label>
													<textarea class="form-control" rows="3" id="deal_description" name="deal_description"><?php echo $deal->about_deal; ?></textarea>
												</div>
											</div>
										</div>											
                                            </div>
										</div>
										
									</div>
                                    <!--------------------------------------------------------------------------offers-------------------------------------------------------->
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h4 class="card-title p-t10">Offers</h4>
											<div class="alert alert-warning">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Offer Name</label>
															<input type="text" id="offer_Name" name="offer_Name" class="form-control" placeholder="ex: Golden coin" value="<?php echo $offer->name; ?>" >
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Highlite Text</label>
															<input type="text" id="offer_highlite" name="offer_highlite" class="form-control" placeholder="Ex: 50% Off, Next 1 Hour" value="<?php echo $offer->subtitle; ?>">
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
														<div class="form-group">
															<label class="control-label">Minimum booking amount</label>
															<input type="text" id="offer_amount" name="offer_amount" class="form-control" placeholder="1000/-" value="<?php echo $offer->price; ?>">
															<small class="form-control-feedback"></small> 
														</div>
													</div>
													
												</div>
                                                <?php 
												$start_time = explode(" ",$offer->start_date_time);
												$start_time2 = explode(" ",$offer->end_date_time);
					
												?>
												<div class="row">
													<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <label class="control-label">Start date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="offer_start_date" name="offer_start_date" placeholder="mm/dd/yyyy" value="<?php echo $start_time[0];?>">
                                            </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
												<label class="control-label">Start Time</label>
												<input type="time" class="form-control" id="offer_start_time" name="offer_start_time" placeholder="Check time" value="<?php echo $start_time[1];?>">
												<small class="form-control-feedback"></small> 
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <label class="control-label">End date</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="offer_end_date" name="offer_end_date" placeholder="mm/dd/yyyy" value="<?php echo $start_time2[0];?>">
                                            </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                                            <div class="form-group">
												<label class="control-label">End Time</label>
												<input type="time" class="form-control" name="offer_end_time" id="offer_end_time" placeholder="Check time" value="<?php echo $start_time2[1];?>">
												<small class="form-control-feedback"></small> 
											</div>
										</div>
												</div>
										<div class="row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<h5>Highlights / items</h5>
												<div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
													<input type="text"  id="offer_tags" name="offer_tags" value="<?php $offer->tags;?>" data-role="tagsinput" placeholder="add tags">
												</div>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<div class="form-group">
													<label class="m-b0">About the deal</label>
													<textarea class="form-control" rows="3" id="offer_description" name="offer_description" ><?php echo $offer->about_deal; ?></textarea>
												</div>
											</div>
										</div>
												
                                            </div>
										</div>
										
									</div>

									<div class="row">
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="m-b0">Venue Discription </label>
												<textarea class="form-control" rows="5" id="venue_description" name="venue_description"><?php echo $product->description; ?></textarea>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label class="m-b0"> </label>
                                                <textarea class="form-control" rows="5" id="venue_description1" name="venue_description1"><?php echo $product->artist_info; ?></textarea>
											</div>
										</div>
									</div>
									<hr class="hr m-t0"/>
									
									<!--------------------------------------------------terms&package------------------------------------------------->
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <h4 class="card-title p-t10 p-b10">Terms & Conditions for packages</h4>
										</div>
                                        <!--t&c start-->
                                        <?php  
										$terms  = explode(",",$product->terms); 
										$i=1;
										foreach($terms as $term){
											if($i<6){
											?>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        
										  <div class="alert alert-warning terms-alert">
										    <div class="form-group m-b10">
												<label class="control-label"><?php echo $i;?></label>
												<input type="text" class="form-control" placeholder=" " name="terms_conditions[]" id="terms_conditions" value="<?php echo $term; ?>">
												<small class="form-control-feedback"></small> 
											</div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
										  </div>
                                         
										 <!--t&c end-->									  
										</div>
                                           <?php }
										   
										   $i++; } ?>
									</div>                                   
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div><a href="#" class="btn-view"><img src="assets/images/view-darrow.png" class="flt-left p-t5"/><span>View All</span></a></div>
										</div>
									</div>
                                     
									<hr class="hr"/>
									<!--<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h4 class="card-title p-t10 p-b10">Ratings & Reviews</h4>
										</div>
									</div>-->
                                    <?php 
									$i=0;
									foreach($reviews as $review){ $review = (object)$review;
									if($i<6){
									 ?>
									<div class="row">
               <!----------------------------------------------------------rating&reviews---------------------------------------------->
                                    	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <?php 
										if (!file_exists(dirname($_SERVER['SCRIPT_FILENAME']).'/'.$review->image)) {
                                                           $imageURL = "../partners/".$review->image;
                                                                                              } //if($review->image==""){$imageURL='assets/images/post-banner.jpg'; }
										?>
											<div><img src="<?php echo $review->image;?>" class="img-responsive m-t15"/></div>
										</div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input type="text" id="review_name" name="review_name" class="form-control" placeholder="ex: Golden coin" value="<?php echo $review->name; ?>">
												<small class="form-control-feedback"></small> 
											</div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="input-group">
												<label class="control-label date-label">Date</label><br/>
												<div class="clearfix"></div>
                                                <input type="date" class="form-control m-t31 m-l-49" id="rate_date" name="rate_date" placeholder="Date" value="<?php echo $review->created ?>">
                                            </div>
										</div>
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
											<div class="form-group">
												<label class="control-label">Comment</label>
												<input type="text" id="rate_comment"  name="rate_comment" class="form-control" placeholder="Comment" value="<?php echo $review->review;?>" >
												<small class="form-control-feedback"></small> 
											</div>
										</div>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
											<label class="control-label date-label"><?php echo $review->rating;?></label><br/>
											<div class="star-rating m-l-4 m-t-12"><s><s><s><s><s></s></s></s></s></s></div>
										</div>
                                        <!--review end-->
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div><a href="#" class="btn-view"><img src="assets/images/view-darrow.png " class="flt-left p-t5"/><span>View All</span></a></div>
										</div>
									</div>
                                    
                                    <?php }$i++; }?>
                                    
									<hr class="hr"/>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h4 class="card-title p-t10 p-b10">Media</h4>
										</div>
										<?php 
										if(isset($_GET['pd'])){
										$images = explode(",",$product->images);
										$images_ids = explode(",",$product->image_ids);
										$image_type = explode(",",$product->type);
										$i=0;
										$gallery = "";
										foreach($images as $image){
											if (!file_exists(dirname($_SERVER['SCRIPT_FILENAME']).'/'.$image)) {
                                                           $image = "../partners/".$image;
                                                                                              } if($image==""){$imageURL='assets/images/post-banner.jpg'; }
											if($image_type[$i]==1){												  
										?>
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										    <p></p>
											<div class="search-pic"><img src="<?php echo $image;?>" class="img-responsive"/></div>
											<div class="text-center revenue-fa m-t10">
												<span class="p-r10"><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>"><i class="fa fa-pencil lblue"></i></a></span>
												<span><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>" ><i class="fa fa-trash red"></i></a></span>
											</div>
										</div>';
                                        <?php 
										}elseif($image_type[$i]==2){
										$gallery .= '<li>
													<img src="'.$image.'" class="img-responsive"/>
														<div class="gallery-fa">
															<div class="text-center revenue-fa m-t10">
																<span class="p-r10"><a href="profile-pick-edit.php?ei='.base64_encode($images_ids[$i]).'&ep='.$_GET["ep"].'"><i class="fa fa-pencil lblue"></i></a></span>
																<span><a href="profile-pick-edit.php?di='.base64_encode($images_ids[$i]).'&ep='.$_GET["ep"].'"><i class="fa fa-trash red"></i></a></span>
															</div>
														</div>
													</li>';
										}
										 $i++; }
										}
										
										 ?>
										 <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										    <p></p>
											<div class="search-pic">
											<input type='file' name='images[]' id='images' multiple>
											</div>
											<div class="text-center revenue-fa m-t10">
												<span class="p-r10"><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>"><i class="fa fa-pencil lblue"></i></a></span>
												<span><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>" ><i class="fa fa-trash red"></i></a></span>
											</div>
										</div>
                                         
									</div>
									<hr class="hr"/>
                                    <!-----------------------------------------------------------------gallery------------------------------------------------------>
									<h4 class="card-title p-t10 p-b10">Gallery</h4>
									<div class="row gallery">
									
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											
											<div>
											<h5 class="card-title p-t10 p-b10 m-b0">Photos</h5>
												<ul class="gallery">
                                           <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										  
											<div class="search-pic">
											<input type='file' name='gallery[]' id='gallery' multiple>
											</div>
											<div class="text-center revenue-fa m-t10">
												<span class="p-r10"><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>"><i class="fa fa-pencil lblue"></i></a></span>
												<span><a href="profile-pick-edit.php?ei=<?php echo  base64_encode($images_ids[$i]);?>&ep=<?php echo $_GET["ep"];?>" ><i class="fa fa-trash red"></i></a></span>
											</div>
										</div>         
												</ul>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<h5 class="card-title p-t10 p-b10 m-b0">Videos</h5>
										<!--videos start-->
                                        <?php 
										$links = explode(",",$product->links);
										$i=0;
										foreach($links as $link ){ 
										if($i<6){
										?>
											<div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" id="video" name="video[]" class="form-control" value="<?php echo $link ;?>" placeholder="you tube video link comes here">
												</div>
											</div>
                                            <?php }$i++;
										}?>
                                            <input type="hidden" name='video_links' value="<?php echo $product->video_ids;?>">
											<!--videos end-->
										</div>
									</div>

								
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <!-- Row -->
                <div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">

					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                    						<a href="edit-deals-offers.html"><button type="submit" name="submit" id="submit" >SAVE</button></a>
						<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>
						<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>

					</div>

				</div></form>
                
               
                <!--Modal for Trash icon-->
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
            <!-- ============================================================== -->
            <div id="footer">
                 <footer>
                   <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                 </footer>
            </div>
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
<?php require_once ("footer.php");?>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <script src="assets/plugins/switchery/dist/switchery.min.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
	<script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
    jQuery(document).ready(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').click(function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>
	<script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
         $('#timepicker').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
		 $('#timepicker1').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
		 $('#timepicker2').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
		 $('#timepicker3').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
   $('#date-format1').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
        $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
	
	
	
	
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	jQuery('#datepicker-autoclose1').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	jQuery('#datepicker-autoclose2').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	jQuery('#datepicker-autoclose3').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	jQuery('#datepicker-autoclose4').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <!--R-->
	
	<!-- STAR RATING -->
	<script>
	$(function() {
    $("div.star-rating > s, div.star-rating-rtl > s").on("click", function(e) {
    
    // remove all active classes first, needed if user clicks multiple times
    $(this).closest('div').find('.active').removeClass('active');

    $(e.target).parentsUntil("div").addClass('active'); // all elements up from the clicked one excluding self
    $(e.target).addClass('active');  // the element user has clicked on


        var numStars = $(e.target).parentsUntil("div").length+1;
        $('.show-result').text(numStars + (numStars == 1 ? " star" : " stars!"));
    });
});
	</script>
</body>

</html>
<?php
/*
 *
 *
   {                "clientId":"x6DmrbsQFZyUUiggs0BZ",
                    "product" : {
                                  "name":"name",
                                  "category_id":1,
                                  "address":"address",
                                  "highlights":"specialities",
                                  "location":"map_url",
                                  "closed_date":"closed_date",
                                  "tags":"product_tags",
                                  "description":"venuedescription",
                                  "artist_info":"venuedescription1",
                                  "status":0
                                 },
                "product_deals" : {
                                    "name" : "deal_name",
                                   "type" : 1,
                                   "price" :200 ,
                                   "start_date_time" : "2018-03-05:21:25",
                                   "end_date_time" : "2018-03-05:09:25",
                                   "tags" : "Bar,Dining,Pub",
                                   "about_deal" : "deal description"
                                    },
                "product_offers":{
                                    "name" : "offer_name",
                                   "type" : 2,
                                   "price" :2000 ,
                                   "start_date_time" : "2018-03-05:21:25",
                                   "end_date_time" : "2018-03-05:09:25",
                                   "tags" : "Bar,Dining,Pub",
                                   "about_deal" : "offer description"
                                    },
                "product_terms":{"description":"terms & conditions1,terms & conditions2"},
                "product_reviews":{"rating":3,"review":"comment","status":"status"},
                "product_images":{"images":"assets/uploads/d62e6f633fb437110d77f2d0b2169fee.jpg,assets/uploads/8b8f64aa6b21112f1e500793960c75fb      .jpg,assets/uploads/e6188c7aa9974d64b520063af990de7f.jpg,assets/uploads/077a6b2fd4a7f663b3f8f38b30c2ee2f.jpg","type":1},
                "product_gallery":{"images":"assets/uploads/d62e6f633fb437110d77f2d0b2169fee.jpg,assets/uploads/8b8f64aa6b21112f1e500793960c75fb      .jpg,assets/uploads/e6188c7aa9974d64b520063af990de7f.jpg,assets/uploads/077a6b2fd4a7f663b3f8f38b30c2ee2f.jpg","type":2},
                "product_videos":{"videos": "link1,link2,link3"},
                "user_id":21

   }*/


?>