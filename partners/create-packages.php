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
  <?php
error_reporting(0);
  require_once("header.php"); ?>
</head>
<!---ex js start--->
<link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<!-- page CSS -->
<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
<link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

<!--ex js end--->
<?php 
  session_start();
  
     //parent end}
if(isset($_GET['dp'])){
                   $productId = base64_decode($_GET['dp']); 	
              /*delete deal*/
              $data = array(
                  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                  "productId"=> $productId
              );
              $data_json = json_encode($data);
              $ue = $url."productDelete";
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $ue);
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
                      header('location:packages.php');
                      
              
                  }
              }
              curl_close($ch);
                  }
if(isset($_GET['ep'])){
 /*getDetals & offers start*/
  $product_Id = base64_decode($_GET['ep']);
      /*get details of packages */
  $data = array(
      "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
      "product_id"=>$product_Id
  );
  $data_json = json_encode($data);
  $ud = $url."packageDetails";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ud);
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
          //echo "Bad Request";
      } else {
          $message = $responsObj['message'];
          $package  = $responsObj['packageDetails'];
		 //echo"<pre>"; print_r($package); exit;
		// $booking = explode('/',$responsObj['packageDetails'][0]['booking_days']);
		 //$booking_days = $booking[0];
		// $booking_time = $booking[1];
          $packaged =(object)$responsObj['packageDetails'][0];
          $titanium =(object)$responsObj['packageDetails'][0];
          $platinum = (object)$responsObj['packageDetails'][1];
          $gold     = (object)$responsObj['packageDetails'][2];
          $silver   = (object)$responsObj['packageDetails'][3];
          $bronze   = (object)$responsObj['packageDetails'][4];
		  $titanium->offer_days = explode(',',$titanium->offer_days);
		  $platinum->offer_days = explode(',',$platinum->offer_days);
		  $gold->offer_days = explode(',',$gold->offer_days);
		  $silver->offer_days = explode(',',$silver->offer_days);
		  $bronze->offer_days = explode(',',$bronze->offer_days);
		  $terms     = explode(',',$titanium->terms);
		  $ids       = explode(',',$titanium->ids); 
		 //$packageIds = array_column($package,'id');
		  $packageIds = array();
		  foreach($responsObj['packageDetails'] as $result){
			  array_push($packageIds,$result['id']);
			   }
			  }
  }
  
  curl_close($ch);
  /*******get reviews****/
     
      }	
if(isset($_POST['submit'])){	
      /**product updatation**/
      if(isset($_GET['ep'])){
		 
	              $product_terms    = array("terms"=>$_POST['terms_conditions'],"id"=>$ids); 
				  $sur_data         = array(   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
											  "product_id"=>base64_decode($_GET['ep']),
											  "name"=>$_POST['venue_name'],
											  "start_date_time" =>$_POST['start_date'].' '.$_POST['start_time'],
											  "end_date_time"=>$_POST['end_date'].' '.$_POST['end_time'],
											  "start_time"=>$_POST['start_time'],
											  "end_time"=>$_POST['end_time'],
											  "today"=>$_POST['today'],
											  'product_terms'=> $product_terms,
											  "booking_days"=>$_POST["booking_days"]
                                       );
              		$data_json = json_encode($sur_data);
                  $uk = $url."updateItem";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $uk);
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
					  }
      }
      curl_close($ch);
				 
	  /*end**/
      }else{
		  
		  
		  $j=0;
		  $gallery = array();
		  foreach($_FILES as $files){ 
			  for ($i = 0; $i < count($files); $i++) { 
						/**gallery start**/
		$target_path     = "assets/uploads/";
        $validextensions = array(
            "jpeg",
            "jpg",
            "png"
        );
        $ext             = explode('.', basename($files['name'][$i]));
        $file_extension  = end($ext);
        $target_path     = $target_path . $ext[0] . rand(1,999999999999) . "." . $ext[count($ext) - 1];
         if (($files["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($files['tmp_name'][$i], $target_path)) {
               $gallery[$j][] = $target_path;
                $imageType = $file_extension;
                
            } else {
               // echo $j . ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            //echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
				/*gallery end*/ 
		    }	$j++;		
		  }
		
        /*
		 *book package start
		 */
		
		  $data      =  array(
							"clientId" => "x6DmrbsQFZyUUiggs0BZ",
							"user_id" => $_SESSION['id'],
							"category_id" =>6,
							"name" => $_POST['venue_name'],
							"start_date_time" => date("Y-m-d", strtotime($_POST['start_date'])) . ' ' . $_POST['start_time'],
							"end_date_time" => date("Y-m-d", strtotime($_POST['end_date'])) . ' ' . $_POST['end_time'],
							"start_time"=>$_POST['start_time'],
							"end_time"=>$_POST['end_time'],
							"today"=>$_POST['today'],
							"offer_days"=>implode(',',$_POST['booking_days']),
							"status" => "1"
							);
							//'clientId','user_id','name','status',"start_date_time","end_date_time","start_time","end_time","today","offer_days","status","category_id"
        $data_json = json_encode($data); //echo"<pre>";print_r($data_json); exit;
        $ul        = $url . "Product1";
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ul);
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
                $message  = $responsObj['message'];
                $parentId = $responsObj['parent_id'];
				 }
    }
    curl_close($ch);
		 //end
  }
      
  //category_id =product surprise categories
  $titanium = array(
                   "category_id"=>1,
                   "price"=>$_POST['titanium_price'],
                   "description"=>$_POST['titanium_description'],
                   "duration"=>$_POST['titanium_time'],
				   "capacity"=>$_POST['titanium_capacity'],
                   "id"=>$_POST['titanium_id'],
				   "NoOfItemsSelect"=>implode(',',$_POST['titanium_NoOfItemsSelect']),
				   "image" =>implode(',',$gallery[0])
                  );
				
  $platinum = array(
               "category_id"=>2,
               "price"=>$_POST['platinum_price'],
               "description"=>$_POST['platinum_description'],
               "duration"=>$_POST['platinum_time'],
			   "capacity"=>$_POST['platinum_capacity'],
               "id"=>$_POST['platinum_id'],
			   "NoOfItemsSelect"=>implode(',',$_POST['platinum_NoOfItemsSelect']),
				   "image" =>implode(',',$gallery[1])
			   
              );
  $gold   =   array(
               "category_id"=>3,
               "price"=>$_POST['gold_price'],
               "description"=>$_POST['gold_description'],
               "duration"=>$_POST['gold_time'],
			   "capacity"=>$_POST['gold_capacity'],
               "id"=>$_POST['gold_id'],
			   "NoOfItemsSelect"=>implode(',',$_POST['gold_NoOfItemsSelect']),
				   "image" =>implode(',',$gallery[2])
              );
  $silver =   array(
				  "category_id"=>4,
				  "price"=>$_POST['silver_price'],
				  "description"=>$_POST['silver_description'],
				  "duration"=>$_POST['silver_time'],
				  "capacity"=>$_POST['silver_capacity'],
				  "id"=>$_POST['silver_id'],
			   "NoOfItemsSelect"=>implode(',',$_POST['silver_NoOfItemsSelect']),
				   "image" =>implode(',',$gallery[3])
              );
  $bronze  = array(
                  "category_id"=>5,
                  "price"=>$_POST['bronze_price'],
                  "description"=>$_POST['bronze_description'],
                  "duration"=>$_POST['bronze_time'],
				  "capacity"=>$_POST['bronze_capacity'],
                  "id"=>$_POST['bronze_id'],
			   "NoOfItemsSelect"=>implode(',',$_POST['bronze_NoOfItemsSelect']),
				   "image" =>implode(',',$gallery[4])
              );
  /*parend id end*/
   $package_categories = array($titanium,$platinum,$gold,$silver,$bronze);//echo"<pre>"; print_r($package_categories); exit;
      $terms_conditions = array(implode(",",$_POST['terms_conditions']));  
      if(isset($_GET['ep'])){
              $terms_conditions = array("terms"=>implode(",",$_POST['terms_conditions']),"ids"=>$_POST['ptid']);
           
          $data = array(
						  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
						  "product_id"=>base64_decode($_GET['ep']),
						  "package_products"=>$package_categories
						);  
         $uc = $url."packageUpdate";		
  }else{	
         $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=>  $parentId,
          "package_products"=>$package_categories,
          "terms_conditions"=>$terms_conditions
      );  
      $uc = $url."addpackageCategories";
      }  
      $data_json = json_encode($data);
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
            /*  echo"<script>alert('".$message."');</script>";*/
           //   header("location:surprise.php");
               // header("location:packages.php");
          }
      }
      curl_close($ch);
  }
   
  ?>

<body class="fix-header card-no-border">
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper">
    <?php  require_once("top.php");?>
    <?php  require_once("left-sidebar.php");?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row page-titles">
          <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">posts</li>
              <li class="breadcrumb-item active">New/edit package</li>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
              <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button></a>
              <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">New/Edit Package</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
              <!-- <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
              <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
              <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
            </div>
          </div>
          <div class="row m-t20">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="venue_name" class="form-control" placeholder="Name" value="<?php echo $titanium->name; ?>">
                        <small class="form-control-feedback"></small>
                    </div>
                  </div>
                  <hr class="hr" />
                  <!-----/date----->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h4 class="card-title p-t10">Guest List Options</h4>
                      <div class="border p10">
                        <ul class="nav nav-tabs customtab" role="tablist">
                          <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab1"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">TITANIUM</span></a> </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab2"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">PLATINUM</span></a> </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab3"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">GOLD</span></a> </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4" role="tab4"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">SILVER</span></a> </li>
                          <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab5" role="tab5"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BRONZE</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab1" role="tabpanel">
                            <div class="p-20">
							<!---start row-->
                              <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" name="titanium_price" class="form-control" placeholder="2500/-" value="<?php echo $titanium->price;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <label class="control-label">Time Duration</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox6" name="titanium_time" placeholder="Check time" value="<?php echo $titanium->duration;?>">
                                  </div>
								  

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Capacity</label>
                                    <input type="text" name="titanium_capacity" class="form-control" placeholder="EX: Boys 2 : Girls 1" value="<?php echo $titanium->capacity;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                    <label>About Package</label>
                                  <!--<textarea class="form-control" rows="5" name="titanium_description"><?php //echo $titanium->pdescription;?></textarea> -->
								  <textarea name="titanium_description"><?php echo $titanium->pdescription;?></textarea>
									<input type="hidden" name="titanium_id" value="<?php echo $titanium->id;?>">
                                  </div>
                                </div>
                              </div>
							  <!--end row-->
							  <!---start row-->
                              <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox1" name="start_time" placeholder="Check time"  value="<?php echo $titanium->start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox1" name="end_time" placeholder="Check time" value="<?php echo $titanium->end_time;;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only For Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($titanium->today)){echo"checked";} ?>  id = "today1"  name="titanium_today"  value="1"> 
                                </div>
                              </div> 
                            </div>
							<!--row end-->
							<!---start row-->
                              <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days[]' class="form-control" id="multi1" multiple>
                                        <option value="4" <?php if(in_array(4,$titanium->offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$titanium->offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$titanium->offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$titanium->offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$titanium->offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$titanium->offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$titanium->offer_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose2"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $titanium->start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose3"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $titanium->end_date;?>">
                                </div>
                              </div>
                            </div>
							<!----end row--->
						
							<!--- Appatizers start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Appatizers</h4>
							</div>
                              <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='titanium_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='titanium_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="titanium_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">MainCourse</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='titanium_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='titanium_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="titanium_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Desserts</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='titanium_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='titanium_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="titanium_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Accompaniments</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='titanium_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='titanium_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="titanium_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
                            </div>
                          </div>
                          <div class="tab-pane" id="tab2" role="tabpanel">
                            <div class="p-20">
                              <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" name="titanium_price" class="form-control" placeholder="2500/-" value="<?php echo $platinum->price;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <label class="control-label">Time Duration</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox7" name="titanium_time" placeholder="Check time" value="<?php echo $platinum->duration;?>">
                                  </div>
                                
								<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Capacity</label>
                                    <input type="text" name="titanium_capacity" class="form-control" placeholder="EX: Boys 2 : Girls 1" value="<?php echo $platinum->capacity;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                    <label>About Package</label>
                                 <!--   <textarea class="form-control" rows="5" name="platinum_description"><?php //echo $platinum->pdescription;?></textarea>-->
										  <textarea name="platinum_description"><?php echo $platinum->pdescription;?></textarea>
                                    <input type="hidden" name="platinum_id" value="<?php echo $platinum->id;?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox2" name="start_time" placeholder="Check time"  value="<?php echo $platinum->start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox2" name="end_time" placeholder="Check time" value="<?php echo $platinum->end_time;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only For Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($platinum->today)){echo"checked";} ?>  id= "today1"  name="today"  value="1"> 
                                </div>
                              </div> 
                            </div>
                              <div class="row" id="duration1">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days' class="form-control" id="multi2" multiple>
                                        <option value="4" <?php if(in_array(4,$platinum->offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$platinum->offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$platinum->offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$platinum->offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$platinum->offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$platinum->offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$platinum->offer_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose5"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $platinum->start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose6"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $platinum->end_date;?>">
                                </div>
                              </div>
                            </div>
							<!----row end---->
								
							<!--- Appatizers start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Appatizers</h4>
							</div>
                              <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='platinum_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='platinum_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="platinum_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">MainCourse</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='platinum_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='platinum_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="platinum_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Desserts</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='platinum_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='platinum_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="platinum_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Accompaniments</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='platinum_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='platinum_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="platinum_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
                            </div>
                          </div>
                          <div class="tab-pane" id="tab3" role="tabpanel">
                            <div class="p-20">
                              <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" name="gold_price" class="form-control" placeholder="2500/-" value="<?php echo $gold->price;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <label class="control-label">Time Duration</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox8" name="gold_time" placeholder="Check time" value="<?php echo $gold->duration;?>">
                                  </div>
								  
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Capacity</label>
                                    <input type="text" name="gold_capacity" class="form-control" placeholder="EX: Boys 2 : Girls 1" value="<?php echo $gold->capacity;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                    <label>About Package</label>
                                    <input type="hidden" name="gold_id" value="<?php echo $gold->id;?>">
                                    <!--<textarea class="form-control" rows="5" name="gold_description"><?php //echo $gold->pdescription;?></textarea>-->
									  <textarea name="gold_description"><?php echo $gold->pdescription;?></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox3" name="start_time" placeholder="Check time"  value="<?php echo $gold->start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox3" name="end_time" placeholder="Check time" value="<?php echo $gold->end_time;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only Today</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose7"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $gold->today;?>">
                                </div>
                              </div> 
                            </div>
							<!--row start-->
                              <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days' class="form-control" id="multi3" multiple>
                                        <option value="4" <?php if(in_array(4,$gold->offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$gold->offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$gold->offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$gold->offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$gold->offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$gold->offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$gold->offer_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose8"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $gold->start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose9"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $gold->end_date;?>">
                                </div>
                              </div>
                            </div>
							<!---row end-->
							
							<!--- Appatizers start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Appatizers</h4>
							</div>
                              <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='gold_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='gold_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="gold_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">MainCourse</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='gold_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='gold_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="gold_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Desserts</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='gold_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='gold_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="gold_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Accompaniments</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='gold_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='gold_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="gold_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
                            </div>
                          </div>
                          <div class="tab-pane" id="tab4" role="tabpanel">
                            <div class="p-20">
                              <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" id="firstName" name="silver_price" class="form-control" placeholder="2500/-" value="<?php echo $silver->price;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <label class="control-label">Time Duration</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox9" name="silver_time" placeholder="Check time" value="<?php echo $silver->duration;?>">
                                  </div>
								  
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Ratio</label>
                                    <input type="text" name="silver_capacity" class="form-control" placeholder="EX: Boys 2 : Girls 1" value="<?php echo $silver->capacity;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                    <label>About Package</label>
                                    <input type="hidden" name="silver_id" value="<?php echo $silver->id;?>">
                                    <!--<textarea class="form-control" rows="5" name="silver_description"><?php //echo $silver->pdescription;?></textarea>-->
									<textarea name="silver_description"><?php echo $silver->pdescription;?></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox4" name="start_time" placeholder="Check time"  value="<?php echo $silver->start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox4" name="end_time" placeholder="Check time" value="<?php echo $silver->end_time;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only Today</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose10"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $silver->today;?>">
                                </div>
                              </div> 
                            </div>
                              <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days' class="form-control" id="multi4" multiple>
                                        <option value="4" <?php if(in_array(4,$silver->offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$silver->offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$silver->offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$silver->offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$silver->offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$silver->offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$silver->offer_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose11"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $silver->start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose12"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $silver->end_date;?>">
                                </div>
                              </div>
                            </div>
							<!--row end-->
							<!----Appatizers start-->
							  <div class="row">
							  <h4 class="card-title p-t10">Appatizers</h4>
							</div>
                              <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='silver_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='silver_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="silver_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">MainCourse</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='silver_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='silver_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="silver_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Desserts</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='silver_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='silver_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="silver_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Accompaniments</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='silver_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='silver_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="silver_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
                            </div>
                          </div>
                          <div class="tab-pane" id="tab5" role="tabpanel">
                            <div class="p-20">
                              <div class="row">

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Price</label>
                                    <input type="text" id="firstName" name="bronze_price" class="form-control" placeholder="2500/-" value="<?php echo $bronze->price;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <label class="control-label">Time Duration</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox10" name="bronze_time" placeholder="Check time" value="<?php echo $bronze->duration;?>">
                                  </div>
                                
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                  <div class="form-group">
                                    <label class="control-label">Ratio</label>
                                    <input type="text" name="bronze_capacity" class="form-control" placeholder="EX: Boys 2 : Girls 1" value="<?php echo $bronze->capacity;?>">
                                    <small class="form-control-feedback"></small> </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                  <div class="form-group">
                                    <label>About Package</label>
                                    <input type="hidden" name="bronze_id" value="<?php echo $bronze->id;?>">
                                    <!--<textarea class="form-control" rows="5" name="bronze_description"><?php echo $bronze->pdescription;?></textarea>-->
									<textarea name="bronze_description"><?php echo $bronze->pdescription;?></textarea>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">Start Time</label>
                                  <input  type='text' class="form-control"  id="startTimeTextBox5" name="start_time" placeholder="Check time"  value="<?php echo $bronze->start_time; ?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <div class="form-group">
                                  <label class="control-label">End Time</label>
                                  <input  type="text" class="form-control" id="endTimeTextBox5" name="end_time" placeholder="Check time" value="<?php echo $bronze->end_time;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only Today</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose13"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $bronze->today;?>">
                                </div>
                              </div> 
                            </div>
                            <div class="row">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days' class="form-control" id="multi5" multiple>
                                        <option value="4" <?php if(in_array(4,$bronze->offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$bronze->offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$bronze->offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$bronze->offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$bronze->offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$bronze->offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$bronze->offer_days)){echo"selected";} ?>>Sun</option>
                                    </select>
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Start Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="datepicker-autoclose14"  name="start_date" placeholder="mm/dd/yyyy" value="<?php echo $bronze->start_date;?>">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">End date</label>
                                <div class="input-group">
                                 <input type="text" class="form-control" id="datepicker-autoclose15"  name="end_date" placeholder="mm/dd/yyyy" value="<?php echo $bronze->end_date;?>">
                                </div>
                              </div>
                            </div>
							<!----Appatizers start-->
							  <div class="row">
							  <h4 class="card-title p-t10">Appatizers</h4>
							</div>
                              <div class="row">
							 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='bronze_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='bronze_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="bronze_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">MainCourse</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='bronze_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='bronze_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="bronze_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!--- MainCourse start row-->
							  <div class="row">
							  <h4 class="card-title p-t10">Desserts</h4>
							</div>
                              <div class="row">
							  
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='bronze_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='bronze_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="bronze_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
							<!---Accompaniments-->
							  <div class="row">
							  <h4 class="card-title p-t10">Accompaniments</h4>
							</div>
                              <div class="row">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Capacity</label>
                                <div class="input-group">
                                    <input type="text" name='bronze_capacity[]' class="form-control" id="capacity">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">NoOfItemsSelect</label>
                                <div class="input-group">
									 <input type="text" name='bronze_NoOfItemsSelect[]' class="form-control" id="noOfItemsSelect">
                                </div>
                              </div>
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">ImageUpload</label>
                                <div class="input-group">
                                 <input type="file" class="form-control" id="package_image"  name="bronze_images[]" value="" >
                                </div>
                              </div>
                            </div>
							<!----end row--->
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                  <!--/row-->
                  <hr class="hr m-t0" />
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tc">

                      <?php 
					  
					  if(count($terms)>0){ 
						  $i = 0;
						  foreach($terms as $term){   ?>
                      <div class="alert alert-warning terms-alert">
                        <div class="form-group m-b10">
                          <label class="control-label"></label>
                          <input type="text" class="form-control" placeholder=" " name="terms_conditions[]" value="<?php  echo $term; ?>">
                          <small class="form-control-feedback"></small> </div>
                        <input type='hidden' name='ptid[]' value='<?php echo $ids[$i]; ?>'>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="terms_conditions[]"> <span aria-hidden="true">&times;</span> </button>
                      </div>
                      <?php $i++; }
					  }else{?>
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
                  <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10" id="addtc">+ Add More Rows</button>
                  <div class="clearfix"></div>
                  <hr class="hr" />
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                      <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                      <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                    </div>
                  </div>

        </div>
        </div>

        <!-- Modal -->
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
        <!-- ============================================================== -->

        </div>
        </form>
      </div>
    </div>
  </div>

      <script src="assets/plugins/jquery/jquery.min.js"></script>
	  <script src="https://cdn.ckeditor.com/4.10.1/standard/ckeditor.js"></script>
<script>
			CKEDITOR.replace( 'titanium_description' );
			CKEDITOR.replace( 'platinum_description' );
			CKEDITOR.replace( 'gold_description' );
			CKEDITOR.replace( 'silver_description' );
			CKEDITOR.replace( 'bronze_description' );
		</script>
      <!-- Bootstrap tether Core JavaScript -->
      <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
      <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
      <!-- slimscrollbar scrollbar JavaScript -->
      <script src="js/jquery.slimscroll.js"></script>
      <!--Wave Effects -->
      <script src="js/waves.js"></script>
      <!--Menu sidebar -->
      <script src="js/sidebarmenu.js"></script>
      <!--stickey kit -->
      <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
      <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
      <!--Custom JavaScript -->
      <script src="js/custom.min.js"></script>
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
//For Deal 
$(document).on("click","#today1",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration1").show(); else $("#duration1").hide(); 
})
//titanium 
$(document).on("click","#today2",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration2").show(); else $("#duration2").hide(); 
})
//platinum 
$(document).on("click","#today3",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration3").show(); else $("#duration3").hide(); 
})
//gold 
$(document).on("click","#today4",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration4").show(); else $("#duration4").hide(); 
})
//silver 
$(document).on("click","#today5",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration5").show(); else $("#duration5").hide(); 
}
//bronze
$(document).on("click","#today",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration").show(); else $("#duration").hide(); 
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
        $('#mdate').bootstrapMaterialDatePicker({
          weekStart: 0,
          time: false
        });
        $('#timepicker').bootstrapMaterialDatePicker({
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
        jQuery('#datepicker-autoclose5').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose6').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose7').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose8').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose9').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose10').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose11').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose12').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose13').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose14').datepicker({
          autoclose: true,
          todayHighlight: true
        });
		jQuery('#datepicker-autoclose15').datepicker({
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
      <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>

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
    $(document).on('click', '#addtc', function() {
      var count = $('#tc').children('div').length;
      count = parseInt(count) + 1;
      var x = '<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control" placeholder=" " id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>';
      $("#tc").append(x);

    });

  });
</script>

<script src="js/jquery-ui.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>           
<script>
  $(function(){ 
	$('#startTimeTextBox1').timepicker({
		timeFormat: 'hh:mm tt'
	});
	
  $('#endTimeTextBox1').timepicker({
		timeFormat: 'hh:mm tt'
	});
  });
  
  $(function(){ 
	$('#startTimeTextBox2').timepicker({
		timeFormat: 'hh:mm tt'
	});
	
  $('#endTimeTextBox2').timepicker({
		timeFormat: 'hh:mm tt'
	});
  });
  
  $(function(){ 
	$('#startTimeTextBox3').timepicker({
		timeFormat: 'hh:mm tt'
	});
	
  $('#endTimeTextBox3').timepicker({
		timeFormat: 'hh:mm tt'
	});
  });
  
  $(function(){ 
	$('#startTimeTextBox4').timepicker({
		timeFormat: 'hh:mm tt'
	});
	
  $('#endTimeTextBox4').timepicker({
		timeFormat: 'hh:mm tt'
	});
  });
  
  $(function(){ 
	$('#startTimeTextBox5').timepicker({
		timeFormat: 'hh:mm tt'
	});
	
  $('#endTimeTextBox6').timepicker({
		timeFormat: 'hh:mm tt'
	});
$('#endTimeTextBox7').timepicker({
		timeFormat: 'hh:mm tt'
	});
$('#endTimeTextBox8').timepicker({
		timeFormat: 'hh:mm tt'
	});
$('#endTimeTextBox9').timepicker({
		timeFormat: 'hh:mm tt'
	});
$('#endTimeTextBox10').timepicker({
		timeFormat: 'hh:mm tt'
	});
  });
</script>


<script type="text/javascript" src="js/jquery.multi-select.js"></script>
<script type="text/javascript">
$(function(){
	$('#multi1').multiSelect();
});
$(function(){
	$('#multi2').multiSelect();
});
$(function(){
	$('#multi3').multiSelect();
});
$(function(){
	$('#multi4').multiSelect();
});
$(function(){
	$('#multi5').multiSelect();
});
</script>
              
              