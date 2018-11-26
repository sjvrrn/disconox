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
  <?php
require_once("header.php");
?>
 <!-- Bootstrap Core CSS -->
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
  <!--datepicker start-->
  <!--datepicker end-->
</head>

<?php
error_reporting(0);
if (isset($_GET['ep'])) {
    /*get product Details*/
    $productId = base64_decode($_GET['ep']);
    $data      = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "productId" => $productId
    );
    $data_json = json_encode($data);
    $uc        = $url . "getDealsoffers";
    $ch        = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uc); 
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);  
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        $responsObj = json_decode($response, TRUE);
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {  
		    $message       = $responsObj['message']; 
            $deals         = $responsObj['productDetails'][0];
            $booking       = explode(',', $deals['offer_days']); //echo"<pre>"; print_r($deals); exit;
            $start_date_time = explode(' ',$deals['start_date_time']);
			$start_date_time = $start_date_time[0];
            $end_date_time  = explode(' ',$deals['end_date_time']);
			$end_date_time  = $end_date_time[0];
			$start_time   = $deals['start_time'];
			$end_time    = $deals['end_time'];
			$deal_start_time = $responsObj['productDetails'][0]['start_time'];
			$deal_end_time = $responsObj['productDetails'][0]['end_time'];
			$offer_start_time = $responsObj['productDetails'][1]['start_time'];
			$offer_end_time = $responsObj['productDetails'][1]['end_time'];
			$size          = count($responsObj['productDetails']); 
			if($size==1){  
			    $type =  $responsObj['productDetails'][0]['type'];
				if($type==1){  
					            $deal          = (object) $responsObj['productDetails'][0];  
                                $deal_id       = $deal->id;	
                                $deal_booking  = explode(',', $deal->offer_days);
								echo"<script>$('#offer').hide();</script>";
								
                                
				}else{	
				                $offer         = (object) $responsObj['productDetails'][0]; 
								$offer_id      = $offer->id;						
								$offer_booking = explode(',', $offer->offer_days);
								
				}
			}else{
				  	            $deal  = (object) $responsObj['productDetails'][1];  		
				                $offer = (object) $responsObj['productDetails'][0]; 	
								
								$offer_id      = $offer->id;
                                $deal_id       = $deal->id;		
                                $deal_booking  = explode(',', $deal->offer_days);
								$offer_booking = explode(',', $offer->offer_days);
			}
        }
    }
    curl_close($ch);    
    /*getDetals & offers start*/
    $product_Id = base64_decode($_GET['ep']);
    $data       = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "productId" => $product_Id
    ); 
    $data_json  = json_encode($data);
    $ud         = $url . "getTerms";
    $ch         = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ud);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch); 
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        
        $responsObj = json_decode($response, TRUE);
        
        if ($responsObj["error"]) {
            //echo "Bad Request";
        } else {
			$message = $responsObj['message'];
            $termId = array_column($responsObj['terms'], 'id');;
            $terms  = $responsObj['terms'];
            
        }
    }
    curl_close($ch);
}
if (isset($_GET['dp'])) {
    $productId = base64_decode($_GET['dp']);
    /*delete deal*/
    $data      = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "productId" => $productId
    );
    $data_json = json_encode($data);
    $ue        = $url . "productDelete";
    $ch        = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ue);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
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
}
//submit form data
if (isset($_POST['submit'])) {
	
    $product_terms = array(
        "terms" => $_POST['terms_conditions'],
        "id" => $termId
    );
    if (isset($_GET['ep'])) {
        
        $data      = array(
            "clientId" => "x6DmrbsQFZyUUiggs0BZ",
            "product_id" => $productId,
            "name" => $_POST['venue_name'],
            "start_date_time" => $_POST['deal_start_date'][0].' '.$_POST['deal_start_time'][0],
            "end_date_time" => $_POST['deal_end_date'][0].' '.$_POST['deal_end_time'][0],
            "start_time" => $_POST['deal_start_time'][0],
            "end_time" => $_POST['deal_end_time'][0],
            "today" => $_POST['today'],
            "booking_days" => implode(',',$_POST['deal_bookings']),
            'product_terms' => $product_terms,
           
        );
        /*update product*/
        $data_json = json_encode($data);
        $uk        = $url . "updateItem"; 
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $uk);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch); 
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
                
                /*update deals**/
                $dealId = $_POST['dealid'];
                for ($i = 0; $i < count($_POST['deal_name']); $i++) {
                    $deal_data = array(
                        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
                        "deal_id" => $dealId,
                        "name" => $_POST['deal_name'][$i],
						"highlights"=>$_POST['deal_highlite'][$i],
                        "price" => $_POST['deal_amount'][$i],
                        "about_deal" => $_POST['deal_description'][$i]
                    );
                    $data_json = json_encode($deal_data); 
                    $uf        = $url . "modifyDeal";
                    $ch        = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $uf);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $response = curl_exec($ch);
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
                            if (isset($_GET['ep'])) {
                                // header("location:edit-deals-offers.php?ep=".$_GET['ep']);                
                            } else {
                                // header("location:deals-offers.php");
                            }
                        }
                    }
                    curl_close($ch);
                }
                /*deal end*/
                
            }
        }
        curl_close($ch);
        
        /*update offer*/
       $offer_id = $_POST['offerid']; 
		if(isset($offer_id)){
        for ($i = 0; $i < count($_POST['offer_name']); $i++) {
            $data      = array(
                "clientId" => "x6DmrbsQFZyUUiggs0BZ",
                "deal_id" => $offer_id,
                "name" => $_POST['offer_name'][$i],
                "highlights" => $_POST['offer_highlite'][$i],
                "price" => $_POST['offer_amount'][$i],
                "about_deal" => $_POST['offer_description'][$i]
            );
            $data_json = json_encode($data);
            $ug        = $url . "modifyDeal";
            $ch        = curl_init();
            curl_setopt($ch, CURLOPT_URL, $ug);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($ch); 
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
                    /*echo"<script>alert('".$message."');</script>";*/
                    if ($_GET['ep'] == "") {
                        header("location:edit-deals-offers.php?ep=" . $_GET['ep']);
                    } else {
                        header("location:deals-offers.php");
                    }
                }
            }
            curl_close($ch);
        }
	}
        /*end offer*/
    } else {
        /* update end*/
        $data      = array(
							"clientId" => "x6DmrbsQFZyUUiggs0BZ",
							"user_id" => $_SESSION['id'],
							"category_id" => 1,
							"name" => $_POST['venue_name'],
							"start_date_time" => date("Y-m-d", strtotime($_POST['deal_start_date'][0])) . ' ' . $_POST['deal_start_time'][0],
							"end_date_time" => date("Y-m-d", strtotime($_POST['deal_end_date'][0])) . ' ' . $_POST['deal_end_time'][0],
							"start_time"=>$_POST['deal_start_time'][0],
							"end_time"=>$_POST['deal_end_time'][0],
							"today"=>$_POST['today'],
							"offer_days"=>implode(',',$_POST['deal_bookings']),
							"status" => "1"
							);
							
							
        $data_json = json_encode($data); //echo"<pre>";print_r($data_json); exit;
        $ul        = $url . "Product1";
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ul);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);// print_r($response); exit;
        
        if ($response === false) {
            $info = curl_getinfo($ch);
            curl_close($ch);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        } else {
            $responsObj = json_decode($response, TRUE);
            if ($responsObj["error"]) {
                echo "Bad Request";
            } else {
                $message  = $responsObj['message'];
                $parentId = $responsObj['parent_id'];
                /**add dealsoffers*/
                
                if ($_POST['offer_name'][0] != "") {
                    for ($i = 0; $i < count($_POST['offer_name']); $i++) {
                        $data      = array(
                            "clientId" => "x6DmrbsQFZyUUiggs0BZ",
                            "product_id" => $parentId,
                            "name" => $_POST['offer_name'][$i],
                            "type" => 2,
                            "price" => $_POST['offer_amount'][$i],
                            "highlite" => $_POST['offer_highlite'][$i],
                            "start_date_time" => date("Y-m-d", strtotime($_POST['offer_start_date'][$i])) . ':' . $_POST['offer_start_time'][$i],
                            "end_date_time" => date("Y-m-d", strtotime($_POST['offer_end_date'][$i])) . ':' . $_POST['offer_end_time'][$i],
                            "about_deal" => $_POST['offer_description'][$i],
                            "offerdays" => implode(',', $_POST['booking_offers']),
                            "start_time" => $_POST['offer_start_time'][$i],
                            "end_time" => $_POST['offer_end_time'][$i],
                            "today" => $_POST['today_offer'],
                            "product_terms" => $product_terms
                        );
						
                        $data_json = json_encode($data);
                        $ur        = $url . "addDealsOffers";
                        $ch        = curl_init();  //print_r($data_json); die;
                        curl_setopt($ch, CURLOPT_URL, $ur);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($ch);  
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
                                /* echo"<script>alert('".$message."');</script>";*/
                            }
                        }
                        curl_close($ch);
                        /*end*/
                    }
                }
                /*offers start*/
                if ($_POST['deal_name'][0] != "") {
                    for ($i = 0; $i < count($_POST['deal_name']); $i++) {
                        $data      = array(
                            "clientId" => "x6DmrbsQFZyUUiggs0BZ",
                            "product_id" => $parentId,
                            "name" => $_POST['deal_name'][$i],
                            "type" => 1,
                            "price" => $_POST['deal_amount'][$i],
                            "highlite" => $_POST['deal_highlite'][$i],
                            "start_date_time" => date("Y-m-d", strtotime($_POST['deal_start_date'][$i])) . ':' . $_POST['deal_start_time'][$i],
                            "end_date_time" => date("Y-m-d", strtotime($_POST['deal_end_date'][$i])) . ':' . $_POST['deal_end_time'][$i],
                            "about_deal" => $_POST['deal_description'][$i],
                            "offerdays" => implode(',', $_POST['deal_bookings']),
                            "start_time" => $_POST['deal_start_time'][$i],
                            "end_time" => $_POST['deal_end_time'][$i],
							"today" => $_POST['today_deal'],
                            "product_terms" => $product_terms
							                            
                        );
                        $data_json = json_encode($data);
                        $u         = $url . "addDealsOffers";
                        $ch        = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $u);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                        $response = curl_exec($ch);  
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
                                /* echo"<script>alert('".$message."');</script>";*/
                                }
                        }
                        curl_close($ch);
                    }
                }
                header("location:deals-offers.php");
            }
        }
        curl_close($ch);
        //end    
    }
    
}
?>

  <body class="fix-header card-no-border">
    <div class="preloader">
      <svg class="circular" viewBox="25 25 50 50">
                  <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                </svg>
    </div>
    <div id="main-wrapper">
      <?php
require_once("top.php");
?>
     <?php
require_once("left-sidebar.php");
?>
     <div class="page-wrapper">
        <div class="container-fluid">
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
                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 58,356</h4>
                  </div>
                  <div class="spark-chart">
                    <div id="monthchart">
                      <canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas>
                    </div>
                  </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                  <div class="chart-text m-r-10">
                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 48,356</h4>
                  </div>
                  <div class="spark-chart">
                    <div id="lastmonthchart">
                      <canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row b-b">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
                <a href="deals-offers.php">
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button>
                        </a>
                <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">Edit Deals &amp; Offers</h4>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
                <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                <a href="deals-offers.php">
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
                        </a>
              </div>
            </div>
            <div class="row m-t20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                           <input type="text" id="venue_name" name="venue_name" class="form-control" placeholder="Name" value='<?php
echo $deal->productname;
?>'>
                           <small class="form-control-feedback"></small> 
                         </div>
                      </div>
                    <hr class="hr"/>
                    <!---------------------------------------deals--------------------------------------------------------------------------------------->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="deals">
                        <h4 class="card-title p-t10">Deals</h4>
                        <div class="alert alert-warning">
                          <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>-->
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Deal Name</label>
                                <input type="text" id="deal_name" name="deal_name[]" class="form-control" placeholder="ex: Golden coin" value="<?php
echo $deal->name;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Highlite Text</label>
                                <input type="text" id="deal_highlite" name="deal_highlite[]" class="form-control" placeholder="Ex: 50% Off" value="<?php
echo $deal->subtitle;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Minimum booking amount</label>
                                <input type="number" id="deal_amount" name="deal_amount[]" class="form-control" placeholder="1000/-" value="<?php
echo $deal->price;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                          </div>

                          
                          <?php
?>
                           <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox" name="deal_start_time[]" placeholder="Check time"  value="<?php echo $deal_start_time;?>" autocomplete="off">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox" name="deal_end_time[]" placeholder="Check time" value="<?php echo $deal_end_time;?>" autocomplete="off">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only For Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($deal->today)){echo"checked";} ?>  id= "today"  name="today_deal"  value="1"> 
                                </div>
                              </div> 
                            </div>
							<?php if(empty($deal->today)){ ?>
                            <div class="row" id="duration">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='deal_bookings[]' class="form-control" id="multi" multiple>
                                        <option value="4" <?php
if (in_array(4, $deal_booking)) {
    echo "selected";
}
?>>Mon</option>
                                        <option value="5" <?php
if (in_array(5, $deal_booking)) {
    echo "selected";
}
?>>Tue</option>
                                        <option value="6" <?php
if (in_array(6, $deal_booking)) {
    echo "selected";
}
?>>Wed</option>
                                        <option value="0" <?php
if (in_array(0, $deal_booking)) {
    echo "selected";
}
?>>Thur</option>
                                        <option value="1" <?php
if (in_array(1, $deal_booking)) {
    echo "selected";
}
?>>Fri</option>
                                        <option value="2" <?php
if (in_array(2, $deal_booking)) {
    echo "selected";
}
?>>Sat</option>
                                        <option value="3" <?php
if (in_array(3, $deal_booking)) {
    echo "selected";
}
?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose1"  name="deal_start_date[]" placeholder="mm/dd/yyyy" value="<?php echo $start_date_time; ?>" autocomplete="off">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose2"  name="deal_end_date[]" placeholder="mm/dd/yyyy" value="<?php echo $end_date_time; ?>" autocomplete="off">
                                </div>
                              </div>
                            </div>
							<?php } ?>
                            <br>
                            <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="m-b0">About the deal</label>
                                  <textarea class="form-control" rows="3" id="deal_description" name="deal_description[]"><?php
echo $deal->about_deal;
?></textarea>
                                  <input type='hidden' name='dealid' value="<?php
echo $deal_id;
?>">
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      <!-- <button type="button" id="addDeals" class="btn waves-effect waves-light btn-rounded btn-success flt-right">+ Add More Deals</button>-->
                    </div>

                    <!--------------------------------------------------------------------------offers-------------------------------------------------------->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="offer">
                        <h4 class="card-title p-t10">Offers</h4>
                        <div class="alert alert-warning" class="offer">
                          <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>-->
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Offer Name</label>
                                <input type="text" id="offer_name" name="offer_name[]" class="form-control" placeholder="ex: Golden coin" value="<?php
echo $offer->name;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Highlite Text</label>
                                <input type="text" id="offer_highlite" name="offer_highlite[]" class="form-control" placeholder="Ex: 50% Off" value="<?php
echo $offer->subtitle;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Minimum booking amount</label>
                                <input type="text" id="offer_amount" name="offer_amount[]" class="form-control" placeholder="1000/-" value="<?php
echo $offer->price;
?>">
                                <small class="form-control-feedback"></small> </div>
                            </div>
                          </div>
                         
                         <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox1" name="offer_start_time[]" placeholder="Check time"  value="<?php
echo $offer_start_time;
?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox1" name="offer_end_time[]" placeholder="Check time" value="<?php
echo $offer_end_time;
?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($offer->today)){ echo"checked";} ?> name="today_offer"  id ="today_offer" value="1">
                                </div>
                              </div> 
                            </div>
							<?php if(empty($offer->today)){ ?>
                          <div class="row" id="duration1">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_offers[]' class="form-control" id="multi2" multiple>
                                        <option value="4" <?php
if (in_array(4, $offer_booking)) {
    echo "selected";
}
?>>Mon</option>
                                        <option value="5" <?php
if (in_array(5, $offer_booking)) {
    echo "selected";
}
?>>Tue</option>
                                        <option value="6" <?php
if (in_array(6, $offer_booking)) {
    echo "selected";
}
?>>Wed</option>
                                        <option value="0" <?php
if (in_array(0, $offer_booking)) {
    echo "selected";
}
?>>Thur</option>
                                        <option value="1" <?php
if (in_array(1, $offer_booking)) {
    echo "selected";
}
?>>Fri</option>
                                        <option value="2" <?php
if (in_array(2, $offer_booking)) {
    echo "selected";
}
?>>Sat</option>
                                        <option value="3" <?php
if (in_array(3, $offer_booking)) {
    echo "selected";
}
?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose3"  name="offer_start_date[]" placeholder="mm/dd/yyyy" value="<?php
echo $offer_start_time;
?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose4"  name="offer_end_date[]" placeholder="mm/dd/yyyy" value="<?php
echo $offer_end_time;
?>">
                                </div>
                              </div>
                            </div>
							<?php } ?>
                          <br>
                          <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                <label class="m-b0">About the offer</label>
                                <textarea class="form-control" rows="3" id="offer_description" name="offer_description[]"><?php
echo $offer->about_deal;
?></textarea>
                                <input type='hidden' name='offerid' value="<?php
echo $offer->id;
?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--<button type="button" id="offers" class="btn waves-effect waves-light btn-rounded btn-success flt-right">+ Add More Offers</button>-->
                    <div class="clearfix"></div>
                    <hr class="hr m-t0" />
                    <!--------------------------------------------------terms&package------------------------------------------------->

                    <div class="row" id="conditions">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="card-title p-t10 p-b10">Terms & Conditions </h4>
                      </div>
                      <!--t&c start-->

                      <?php
$i = 0;
if (count($terms) > 0) {
    foreach ($terms as $term) {
?>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-warning terms-alert">
                          <div class="form-group m-b10">
                            <label class="control-label"></label>
                            <input type="text" class="form-control" placeholder=" " name="terms_conditions[]" id="terms_conditions" value="<?php
        echo $term['discription'];
?>">
                            <input type="hidden" name="term_id[]" value="<?php
        echo $term->id;
?>">
                            <small class="form-control-feedback"></small>
                          </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>

                        <!--t&c end-->
                      </div>

                      <?php
        $i++;
    }
    
} else {
?>
                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="alert alert-warning terms-alert">
                          <div class="form-group m-b10">
                            <label class="control-label"></label>
                            <input type="text" class="form-control" placeholder=" " name="terms_conditions[]" id="terms_conditions">
                            <small class="form-control-feedback"></small>
                          </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>

                        <!--t&c end-->
                      </div>



                      <?php
}
?>
                   </div>
                    <button type="button" id="terms" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10">+ Add More</button>
                    <div class="clearfix"></div>
                    <div class="row">

                      <div class="clearfix"></div>
                    </div>
                    <hr class="hr" />
                    <?php
$i = 0;
foreach ($reviews as $review) {
    $review = (object) $review;
    if ($i < 6) {
?>
                 </div>
                  <div class="row">
                    <!----------------------------------------------------------rating&reviews---------------------------------------------->
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                      <?php
        if (!file_exists(dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $review->image)) {
            $imageURL = "../partners/" . $review->image;
        } //if($review->image==""){$imageURL='assets/images/post-banner.jpg'; }
?>
                     <div><img src="<?php
        echo $review->image;
?>" class="img-responsive m-t15" /></div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                      <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" id="review_name" name="review_name" class="form-control" placeholder="ex: Golden coin" value="<?php
        echo $review->name;
?>">
                        <small class="form-control-feedback"></small> </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                      <div class="input-group">
                        <label class="control-label date-label">Date</label>
                        <br/>
                        <div class="clearfix"></div>
                        <input class="form-control m-t31 m-l-49" id="rate_date" name="rate_date" placeholder="Date" value="<?php
        echo $review->created;
?>">
                      </div>

                      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                        <div class="form-group">
                          <label class="control-label">Comment</label>
                          <input type="text" id="rate_comment" name="rate_comment" class="form-control" placeholder="Comment" value="<?php
        echo $review->review;
?>">
                          <small class="form-control-feedback"></small> </div>
                      </div>
                      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                        <label class="control-label date-label"><?php
        echo $review->rating;
?></label>
                        <br/>
                        <div class="star-rating m-l-4 m-t-12"><s><s><s><s><s></s></s>
                          </s>
                          </s>
                          </s>
                        </div>
                      </div>
                      <!--review end-->
                    </div>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div><a href="#" class="btn-view"><img src="assets/images/view-darrow.png " class="flt-left p-t5"/><span>View All</span></a></div>
                      </div>
                    </div>
                    <?php
    }
    $i++;
}
?>

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                        <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button>
                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <!--Modal for Trash icon-->
          <div id="myTrash" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header text-right"> </div>
                <div class="modal-body">
                  <button type="button" class="close " data-dismiss="modal">&times;</button>
                  <p>You Want To Delete? </p>
                  <p>&nbsp;</p>
                  <a href="#">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-success">YES</button>
                            </a> <a href="#">
                            <button type="button" class="btn waves-effect waves-light btn-rounded btn-danger">NO</button>
                            </a> </div>
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
      <?php
require_once("footer.php");
?>
     <script src="assets/plugins/switchery/dist/switchery.min.js"></script>
      <script src="assets/plugins/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
      <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
      <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
      <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
      <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
      <script src="assets/plugins/moment/moment.js"></script>
      <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
      <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
      <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
      <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
      <script src="assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
      <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
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
          //booking_days
              $('#multi').multipleSelect({
            isOpen: true,
            keepOpen: true
        });
        //booking_offers
        //booking_days
              $('#multi2').multipleSelect({
            isOpen: true,
            keepOpen: true
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
        $('#mdate').bootstrapMaterialDatePicker({
          weekStart: 0,
          time: false
        });
        $('#timepicker').bootstrapMaterialDatePicker({
          format: 'HH:mm',
          time: true,
          date: false
        });
        $('#timepicker1').bootstrapMaterialDatePicker({
          format: 'HH:mm',
          time: true,
          date: false
        });
        $('#timepicker2').bootstrapMaterialDatePicker({
          format: 'HH:mm',
          time: true,
          date: false
        });
        $('#timepicker3').bootstrapMaterialDatePicker({
          format: 'HH:mm',
          time: true,
          date: false
        });
        $('#date-format').bootstrapMaterialDatePicker({
          format: 'dddd DD MMMM YYYY - HH:mm'
        });
        $('#date-format1').bootstrapMaterialDatePicker({
          format: 'dddd DD MMMM YYYY - HH:mm'
        });
        $('#min-date').bootstrapMaterialDatePicker({
          format: 'DD/MM/YYYY HH:mm',
          minDate: new Date()
        });
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
        jQuery('#datepicker-autoclose0').datepicker({
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
            $(e.target).addClass('active'); // the element user has clicked on


            var numStars = $(e.target).parentsUntil("div").length + 1;
            $('.show-result').text(numStars + (numStars == 1 ? " star" : " stars!"));
          });
        });
      </script>
  </body>

</html>
<script>
  $(document).ready(function() {
    
//For Deal 
$(document).on("click","#today",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration").show(); else $("#duration").hide(); 
    });    
//For Offers    
$(document).on("click","#today_offer",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration1").show(); else $("#duration1").hide(); 
    });
    
    
    $(document).on("click", "#addDeals", function() {
      $("#deals").append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><h4 class="card-title p-t10"></h4><div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Deal Name</label><input type="text" id="deal_name"  name="deal_name[]" class="form-control" placeholder="ex: Golden coin"><small class="form-control-feedback"></small></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Highlite Text</label><input type="text" id="deal_highlite" name="deal_highlite[]"  class="form-control" placeholder="Ex: 50% Off, Next 1 Hour" ><small class="form-control-feedback"></small></div></div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Minimum booking amount</label><input type="text" id="deal_amount" name="deal_amount[]" class="form-control" placeholder="1000/-" ><small class="form-control-feedback"></small> </div></div></div><div class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><label class="control-label">Start date</label><div class="input-group"><input class="form-control" id="datepicker-autoclose" name="deal_start_date[]"  placeholder="mm/dd/yyyy" ></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="form-group"><label class="control-label">Start Time</label><input  type="time" class="form-control" id="timepicker" name="deal_start_time[]" placeholder="Check time"  ><small class="form-control-feedback"></small> </div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><label class="control-label">End date</label><div class="input-group"><input type="text" class="form-control" id="datepicker-autoclose1"  name="deal_end_date[]" placeholder="mm/dd/yyyy" value="<?php
echo $date_time2[0];
?>"></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="form-group"><label class="control-label">End Time</label><input  type="time" class="form-control" id="timepicker1" name="deal_end_time[]" placeholder="Check time" ><small class="form-control-feedback"></small> </div></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><h5>Highlights / items</h5><div class="input-group m-b-30"> <span class="input-group-addon">Tags</span><input type="text" id="datepicker-autoclose2"  name="deal_tags[]" data-role="tagsinput" placeholder="add tags" ></div></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="form-group"><label class="m-b0">About the deal</label><textarea class="form-control" rows="3" id="deal_description" name="deal_description"></textarea></div></div></div></div></div></div>');


    });
    $(document).on("click", "#terms", function() {
      var count = $("#conditions > div").length;
      $("#conditions").append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" name="terms_conditions[]" class="form-control" placeholder=" "><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div></div>');
    });

    //offers  /id="datepicker-autoclose"/timepicker
    $(document).on("click", "#offers", function() {
      $("#offer").append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label"></label><input type="text" name="offer_name[]" class="form-control" placeholder="ex: Golden coin"><small class="form-control-feedback"></small> </div></div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Highlite Text</label><input type="text" id="offer_highlight[]" class="form-control" placeholder="Ex: 50% Off, Next 1 Hour"><small class="form-control-feedback"></small> </div></div><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Minimum booking amount</label><input type="text" name="offer_amount[]" class="form-control" placeholder="1000/-"><small class="form-control-feedback"></small></div></div></div><div class="row"><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><label class="control-label">Start date</label><div class="input-group"><input type="text" class="form-control" id="offer_start_date[]" placeholder="mm/dd/yyyy"></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="form-group"><label class="control-label">Start Time</label><input class="form-control" name="offer_start_time[]" placeholder="Check time" data-dtp="dtp_oTIiZ"><small class="form-control-feedback"></small></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><label class="control-label">End date</label><div class="input-group"><input type="text" class="form-control" name="offer_end_date[]" placeholder="mm/dd/yyyy"></div></div><div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><div class="form-group"><label class="control-label">End Time</label><input class="form-control" name="offer_end_time[]" placeholder="Check time" data-dtp="dtp_oTIiZ"><small class="form-control-feedback"></small></div></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><h5>Highlights / items</h5><div class="input-group m-b-30"> <span class="input-group-addon">Tags</span><input type="text" name="offer_tags[]" value="" data-role="tagsinput" placeholder="add tags"></div></div><div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><div class="form-group"><label class="m-b0">About the Offer</label><textarea class="form-control" rows="3" name="offer_description[]"></textarea></div></div></div></div></div>');
    });

  });
</script>

<script src="js/jquery-ui.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>          
<script>
  $(function(){ 
    $('#startTimeTextBox').timepicker({
        timeFormat: 'hh:mm tt'
    });
    
    $('#endTimeTextBox').timepicker({
        timeFormat: 'hh:mm tt'
    });
    
    $('#startTimeTextBox1').timepicker({
        timeFormat: 'hh:mm tt'
    });
    
    $('#endTimeTextBox1').timepicker({
        timeFormat: 'hh:mm tt'
    });
  });
</script>


<script type="text/javascript" src="js/jquery.multi-select.js"></script>
<script type="text/javascript">
$(function(){
    $('#multi').multiSelect();
});
$(function(){
    $('#multi2').multiSelect();
});
</script>