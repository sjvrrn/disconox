<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
  <title>Disconox</title>
  <!-- Bootstrap Core CSS -->
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- page CSS -->
  <link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
  <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
  <link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
  <link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
  <?php require_once("header.php");?>
</head>
<?php
  error_reporting(0);
  session_start(); 
  if(!isset($_SESSION['id'])){
      //header("location:../admin/login.php");
  }
  //surprise
  if(isset($_GET['dp'])){
  $productId = base64_decode($_GET['dp']);
      $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "productId"=>$productId
      );
      $data_json = json_encode($data);
      $ua = $url."productDelete";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $ua);
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
             // $message = $responsObj['message'];
            
              header("location:surprise.php");
          }
      }
      curl_close($ch);  
  }
  
  
  if(isset($_GET['es'])){
     $productId = base64_decode($_GET['es']);  
      //product details start
      $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "productId"=>$productId
        );
	  $data_json = json_encode($data);//print_r($data_json); exit;
      $ud = $url."getsurprises"; 
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $ud);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response  = curl_exec($ch);   //echo"<pre>"; print_r($response); exit;
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
              $index    = $products[0]; 
			  $booking_days = explode(',',$index['booking_days']);  
			  $start_date = substr($index['start_date_time'],0,10);
			  $end_date   = substr($index['end_date_time'],0,10);
			  $start_time    = $index['start_time'];
			  $end_time = $index['end_time'];
			  $today    = $index['today']; 
			  $terms   = explode(',',$index['terms']); 
			  $term_ids = explode(',',$index['ids']); 
			  
			  if($today>0){  echo"<script>$('#duration').hide();</script>";}
			  $name     = $index['name'];
			  $capture  = $index['capture_event'];
			
              $bottle_of_wine = (object)$products[0];	
              $customsurprise = (object)$products[1]; 
			  $other_details =  (object)$products[2]; //print_r($other_details); exit;
			  $idarray = array($bottle_of_wine->surprise_id,$customsurprise->surprise_id,$other_details->surprise_id); 
		   }
      }
      curl_close($ch);
      /**product end**/
      }
  
  //delete surprise
  if(isset($_POST['submit'])){        /*images*/  //echo"<pre><br>"; print_r($_POST); exit;
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
                 //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
              } else {
                  //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
              }
          } else {
              //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
          }
      }
      /*gallery*/
 
  $bottleofwine  = array(
               "category_id"=>5,
               "price"=>$_POST['bottleofwine_price'],
               "price2"=>$_POST['bottleofwine_price2'],
			   "price3"=>$_POST['bottleofwine_price3'],
               "description"=>$_POST['bottleofwine_description']
              );
			  
$custom   =     array(
               "category_id"=>6,
               "price"=>$_POST['custom_price'],
               "price2"=>$_POST['custom_price2'],
			   "price3"=>$_POST['custom_price3'],
               "description"=>$_POST['custom_description']
               );
$other   =     array(
               "category_id"=>7,
               "price"=>implode(',',$_POST['packag_type']),
               "price2"=>$_POST['package_price'],
			   "price3"=>$_POST['custom_package_name'].'+'.$_POST['custom_package_price'],
               "description"=>$_POST['other_description']
               );
			
if(!isset($_GET['es'])){    
  /*product start*/               
             $data = array(    
							  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
							  "user_id"=>$_SESSION['id'],
							  "category_id" => 2,
							  "name"=>$_POST['venue_name'],
							  "start_date_time"=>date("Y-m-d",strtotime($_POST['start_date'])).' '.$_POST['start_time'],
							  "end_date_time"=>date("Y-m-d",strtotime($_POST['end_date'])).' '.$_POST['end_time'],
							  "start_time"=>$_POST['start_time'],
							  "end_time"=>$_POST['end_time'],
							  "today"=>$_POST['today'],
							  "offer_days"=>implode(',',$_POST['booking_days']),
							  "status"=>"1"
                           ); 
      $data_json = json_encode($data);
      $uc = $url."Product1";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $uc);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response  = curl_exec($ch); 
      if ($response === false){
          $info = curl_getinfo($ch);
          curl_close($ch);
          die('error occured during curl exec. Additioanl info: ' . var_export($info));
      } else {
          $responsObj = json_decode($response, TRUE);//print_r($responsObj); exit;
          if ($responsObj["error"]) {
              echo "Bad Request";
          } else {
              $message = $responsObj['message'];
              //echo"<script>alert('".$message."');</script>";
              $parentId = $responsObj['parent_id'];      
  /*product end*/                    
      $surprise_categories = array($bottleofwine,$custom,$other); //echo"<pre>"; //print_r($surprise_categories); exit;
      $terms_conditions = array("terms_conditions"=>implode(",",$_POST['terms_conditions']));
      $link = array("links"=>implode(",",$_POST['link']));
      $cvideo         = $_POST['capture_event'];
	  $data = array(
					  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
					  "product_id"=> $parentId,
					  "surprise_products"=>$surprise_categories,
					  "terms_conditions"=>$terms_conditions,
					  "cvideo"=>$cvideo
					); 
      $data_json = json_encode($data);// echo"<pre>=="; print_r($data_json); exit;
     $uc = $url."addsurpriseCategories"; 
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
			  $message = $responsObj['message'];
			  echo "<script type='text/javascript'>
					alert('$message');
					</script>";
          } else {
              $message = $responsObj['message'];
			  echo "<script type='text/javascript'>
					alert('$message');
					window.location='surprise.php';
					</script>";
             // header("location:surprise.php");
          }
      }
      curl_close($ch);
      //parent end
        }
      }
      curl_close($ch);
  }else{  
	  /**update surprises****/
	                
                   
                  $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$term_ids);  
                  $sur_data= array(     
							 "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                              "product_id"=>base64_decode($_GET['es']),
							  "name"=>$_POST['venue_name'],
							  "start_date_time"=>date("Y-m-d",strtotime($_POST['start_date'])).' '.$_POST['start_time'],
							  "end_date_time"=>date("Y-m-d",strtotime($_POST['end_date'])).' '.$_POST['end_time'],
							  "start_time"=>$_POST['start_time'],
							  "end_time"=>$_POST['end_time'],
							  "today"=>$_POST['today'],
							  "booking_days"=>implode(',',$_POST['booking_days']),
							  'product_terms'=> $product_terms,
                           ); 
              /*update product*/
                  $data_json = json_encode( $sur_data); 
                  $uk = $url."updateItem";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $uk);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  $response  = curl_exec($ch);  //print_r($response); exit;
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
					  }
      }
      curl_close($ch);
				 
	  /*product  end**/
	   
	  /**updat surprises */
  $bottleofwine  = array(
                  "category_id"=>5,
                  "price"=>$_POST['bottleofwine_price'],
				  "price2"=>$_POST['bottleofwine_price2'],
				  "price3"=>$_POST['bottleofwine_price3'],
                  "description"=>$_POST['bottleofwine_description'],
                  "id"=>$idarray[0]
              ); 
  $custom   =     array(
               "category_id"=>6,
               "price"=>$_POST['custom_price'],
			   "price2"=>$_POST['custom_price2'],
			   "price3"=>$_POST['custom_price3'],
               "description"=>$_POST['custom_description'],
               "id"=>$idarray[1]
               );
$other   =     array(
               "category_id"=>7,
               "price"=>implode(',',$_POST['packag_type']),
               "price2"=>$_POST['package_price'],
			   "price3"=>$_POST['custom_package_name'].'+'.$_POST['custom_package_price'],
               "description"=>$_POST['other_description'],
			    "id"=>$idarray[2]
               );
$surprise_categories = array($bottleofwine,$custom,$other);
       $sur_data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=> base64_decode($_GET['es']),
          "surprise_products"=>$surprise_categories,
		  "cvideo"=>$_POST['capture_event']
          );  
      $data_json = json_encode($sur_data);  //echo"<pre>";print_r($data_json); exit;
      $uk = $url."Updatesurprise";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $uk);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response  = curl_exec($ch); //print_r($response);exit;
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
	  /*end*/	  
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
      <?php require_once("top.php"); ?>
      <?php require_once('left-sidebar.php');?>
      <div class="page-wrapper">
        <div class="container-fluid">
          <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
              <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">posts</li>
                <li class="breadcrumb-item active">New/edit Surprise</li>
              </ol>
            </div>
            <div class="col-md-7 col-4 align-self-center">
              <div class="d-flex m-t-10 justify-content-end">
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                  <div class="chart-text m-r-10">
                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4>
                  </div>
                  <div class="spark-chart">
                    <div id="monthchart"></div>
                  </div>
                </div>
                <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                  <div class="chart-text m-r-10">
                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0</h4>
                  </div>
                  <div class="spark-chart">
                    <div id="lastmonthchart"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="row b-b">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> <a href="surprise.php">
            <button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button>
            </a>
                <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">New/Edit Surprise</h4>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
                <!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                <button type="d" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                <a href="surprise.php">
            <button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
            </a> </div>
            </div>
            <div class="row m-t20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <input type="text" id="venue_name" name="venue_name" class="form-control" placeholder="Name" value="<?php echo $name;?>">
                        <small class="form-control-feedback"></small>
                      </div>
                    </div>
                    <hr class="hr" />
                    <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox" name="start_time" placeholder="Check time"  value="<?php echo $start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox" name="end_time" placeholder="Check time" value="<?php echo $end_time;?>">
                                  <small class="form-control-feedback"></small> 
								  </div>
                              </div>    
                              <div class="col-xs-6">
                                <label class="control-label">Only Today</label>
								<div class="input-group">
                                    <input type="checkbox" class="form-control"  id="today" name="today" value="1"<?php if($today>0){echo"checked";}?>>
                                </div>
                              </div> 
                            </div>
							
                    <div class="row"  id="duration">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days[]' class="form-control" id="multi" multiple>
						<option value="4" <?php if(in_array(4,$booking_days)){echo"selected";} ?>>Mon</option>
						<option value="5" <?php if(in_array(5,$booking_days)){echo"selected";} ?>>Tue</option>
						<option value="6" <?php if(in_array(6,$booking_days)){echo"selected";} ?>>Wed</option>
						<option value="0" <?php if(in_array(0,$booking_days)){echo"selected";} ?>>Thur</option>
						<option value="1" <?php if(in_array(1,$booking_days)){echo"selected";} ?>>Fri</option>
						<option value="2" <?php if(in_array(2,$booking_days)){echo"selected";} ?>>Sat</option>
						<option value="3" <?php if(in_array(3,$booking_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose1"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose2"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $end_date;?>">
                                </div>
                              </div>
                            </div>
							
  <hr class="hr" />
                    <!--<div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Capture Event</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox" name="capture_event" placeholder="Check time"  value="<?php //echo $capture; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
							  </div>
<hr class="hr" />-->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<h4 class="card-title p-t10">Surprise Options</h4>
	<div class="border p10">
	  <ul class="nav nav-tabs customtab" role="tablist">
<?php if($_SESSION['role']==1){?>
		<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab1"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">BOQUET</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab2"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">CAKE</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab3"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BALOONS</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4" role="tab4"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">LIVE ARTISTS</span></a> </li>
<?php }else{  ?>
		<li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab5" role="tab5"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BOTTLE OF Choice</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab6" role="tab6"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">CUSTOM SURPRISE</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab7" role="tab7"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Other</span></a> </li>
<?php } ?>
        </ul>
<!-------------------------------------------------------boquet---->
<div class="tab-content">
<?php if($_SESSION['role']==1){ ?>
<div class="tab-pane active" id="tab1" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
		  <div class="form-group">
			<label class="control-label">category A/Price</label>
			<input type="text" id="boquet_price" name="boquet_price" class="form-control" placeholder="2500/-" value="<?php echo $boquet->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category B/Price</label>
			<input type="text" id="boquet_price" name="boquet_price2" class="form-control" placeholder="2500/-" value="<?php echo $boquet->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4 col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="boquet_price" name="boquet_price3" class="form-control" placeholder="2500/-" value="<?php echo $boquet->price3;?>">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Discription</label>
		  <textarea class="form-control" rows="5" id="boquet_description" name="boquet_description"><?php echo $boquet->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--cake cr------------------->
<div class="tab-pane" id="tab2" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">category A/Price</label>
			<input type="text" id="cake_price1" name="cake_price" class="form-control" placeholder="2500/-" value="<?php echo $cake->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category B/Price</label>
			<input type="text" id="cake_price2" name="cake_price2" class="form-control" placeholder="2500/-" value="<?php echo $cake->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="cake_price3" name="cake_price3" class="form-control" placeholder="2500/-" value="<?php echo $cake->price3;?>">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Discription</label>
		  <textarea class="form-control" rows="5" id="cake_description" name="cake_description"><?php echo $cake->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--cake end------------------>
<!--baloons start-------------->
<div class="tab-pane" id="tab3" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">category A/Price</label>
			<input type="text" id="baloons_price1" name="baloons_price" class="form-control" placeholder="2500/-" value="<?php echo $baloons->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category B/Price</label>
			<input type="text" id="baloons_price2" name="baloons_price2" class="form-control" placeholder="2500/-" value="<?php echo $baloons->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="baloons_price3" name="baloons_price3" class="form-control" placeholder="2500/-" value="<?php echo $baloons->price3;?>">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	 
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Discription</label>
		  <textarea class="form-control" rows="5" id="baloons_description" name="baloons_description"><?php echo $baloons->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--baloons end----------------->
<!-----LIVE ARTISTS(changes)------>
<div class="tab-pane" id="tab4" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">category A/Price</label>
			<input type="text" id="lifveartist_price1" name="lifveartist_price" class="form-control" placeholder="2500/-" value="<?php echo $liveartist->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category B/Price</label>
			<input type="text" id="lifveartist_price2" name="lifveartist_price2" class="form-control" placeholder="2500/-" value="<?php echo $liveartist->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="lifveartist_price3" name="lifveartist_price3" class="form-control" placeholder="2500/-" value="<?php echo $liveartist->price3;?>">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	 
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Discription</label>
		  <textarea class="form-control" rows="5" id="lifveartist_description" name="lifveartist_description"><?php echo $liveartist->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--LIVE ARTISTS End-->
<?php }else{ ?>
<!--BOTTLE OF WINE start-->
<div class="tab-pane active" id="tab5" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">Tag</label>
			<input type="text" id="bottleofwine_price1" name="bottleofwine_price" class="form-control" placeholder="Tag Name" value="<?php echo $bottle_of_wine  ->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">Price</label>
			<input type="text" id="bottleofwine_price2" name="bottleofwine_price2" class="form-control" placeholder="2500/-" value="<?php echo $bottle_of_wine->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3 invisible" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="bottleofwine_price3" name="bottleofwine_price3" class="form-control" placeholder="2500/-" value="NO">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	 
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Description</label>
		  <textarea class="form-control" rows="5" id="bottleofwine_description" name="bottleofwine_description"><?php echo $bottle_of_wine->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--CUSTOM SURPRISE start-->
<div class="tab-pane" id="tab6" role="tabpanel">
  <div class="p-20">
	<div class="row">
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">Tag</label>
			<input type="text" id="custom_price1" name="custom_price" class="form-control" placeholder="Tag Name" value="<?php echo $customsurprise->price;?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">Price</label>
			<input type="text" id="custom_price2" name="custom_price2" class="form-control" placeholder="2500/-" value="<?php echo $customsurprise->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3 invisible">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">category C/Price</label>
			<input type="text" id="custom_price3" name="custom_price3" class="form-control" placeholder="2500/-" value="NO">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>
	 
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Description</label>
		  <textarea class="form-control" rows="5" id="custom_description" name="custom_description"><?php echo $customsurprise->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<!--Other Artist Start --->
<div class="tab-pane" id="tab7" role="tabpanel">
  <div class="p-20">
	<div class="row">
	<!----------price------------->
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">Select Category</label>
			<!--<input type="text" id="other_price2" name="other_price2" class="form-control" placeholder="2500/-" value="<?php //echo $other_details->price2;?>">-->
			<!--select food/lliquor package-->
			<?php $package = explode(',',$other_details->price);
			      $custom_package = explode('+',$other_details->price3);
			?>
			   <select name='packag_type[]' class="form-control" id="multi1" multiple>
				<option value="1" <?php if(in_array(1,$package)){echo"selected";} ?>>FoodPackage</option>
				<option value="2" <?php if(in_array(2,$package)){echo"selected";} ?>>Liquor Package</option>
                                    </select>
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
<!---------price1----------->
<div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">Package Price</label>
			<input type="text" id="package_price3" name="package_price" class="form-control" placeholder="2500/-" value="<?php echo $other_details->price2;?>">
			<small class="form-control-feedback"></small> </div>
		</div>
	  </div>
<!-----------price2---------->	  
</div>
<div class="row">
<!---package price description------->
	  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		  <div class="form-group">
			<label class="control-label">Custom Package Name</label>
			<input type="text" id="other_price1" name="custom_package_name" class="form-control" placeholder="Package Name" value="<?php echo $custom_package[0];?>">
			<small class="form-control-feedback"></small> </div>
	  </div>
<!---custo	price ---->
  <div class="col-lg-4 col-md-4 col-sm-4col-xs-3">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  <div class="form-group">
			<label class="control-label">Custom Package Price</label>
			<input type="text" id="other_price3" name="custom_package_price" class="form-control" placeholder="2500/-" value="<?php  echo $custom_package[1];?>">
			<small class="form-control-feedback"></small> </div>
		</div>

	  </div>  
</div>
<div class="row">
	  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<div class="form-group">
		  <label>Description</label>
		  <textarea class="form-control" rows="5" id="other_description" name="other_description"><?php echo $other_details->description;?></textarea>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php } ?>
<hr class="hr m-t0" />
<!-- Other Artist End ---> <!--------------------------------------------------terms&package------------------------------------------------->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="add_more">

                        <?php if(count($terms)>0){ $i=0;
                          foreach($terms as $term){  
                          ?>
                        <div class="alert alert-warning terms-alert">
                          <div class="form-group m-b10">
                            <label class="control-label"></label>
                            <input type="text" class="form-control" placeholder=" " name="terms_conditions[]" value="<?php  echo $term;?>">
                            <small class="form-control-feedback"></small> </div>
                          <input type='hidden' name='ptid[]' value='<?php echo $term_ids[$i]; ?>'>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="terms_conditions[]"> <span aria-hidden="true">&times;</span> </button>
                        </div>

                        <?php $i++;} }else{?>
                        <div class="alert alert-warning terms-alert">
                          <div class="form-group m-b10">
                            <label class="control-label"></label>
                            <input type="text" class="form-control" placeholder=" " name="terms_conditions[]">
                            <small class="form-control-feedback"></small> </div>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <?php } ?>
                      </div>

                    </div>
                    <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10" id="addmore" name="addmore">+ Add More</button>
                    <div class="clearfix"></div>

                    <hr class="hr" />

                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                        <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                        <!--<a href="#"><button type="submit" name="edit" id="edit" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                        <a href="surprise.php">
            <button type="reset" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
            </a> </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>
            <div id="myTrash" class="modal fade" role="dialog">
              <div class="modal-dialog modal-md">
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
          </form>
        </div>
      </div>
    </div>
    <?php require_once("footer.php");?>
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
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
          new Switchery($(this)[0], $(this).data());
        });
        $(".select2").select2();
        $('.selectpicker').selectpicker();
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
          },
          minimumInputLength: 1,
          templateResult: formatRepo,
          templateSelection: formatRepoSelection
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

    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
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
    $(document).on('click', '#addmore', function() {
      var count = $('#add_more').children('div').length;
      count = parseInt(count) + 1;
      var x = '<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control" placeholder=" " id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>';
      $("#add_more").append(x);

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
	
	$(document).on("click","#today",function(){
	var ischecked=$(this).is(':checked'); 
	if(!ischecked)  $("#duration").show(); else $("#duration").hide(); 
    }); 
	
	
  });
    $('#multi').multipleSelect({
            isOpen: true,
            keepOpen: true
        });
/* $('#multi1').multipleSelect({
            isOpen: true,
            keepOpen: true
        }); */
</script>


<script type="text/javascript" src="js/jquery.multi-select.js"></script>
<script type="text/javascript">
$(function(){
	$('#multi').multiSelect();
    $('#multi1').multiSelect();
	});


$(function(){
	$('#multi2').multiSelect();
});
</script>

              