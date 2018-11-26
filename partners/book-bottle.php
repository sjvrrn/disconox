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
  <?php   require_once ("header.php");   ?>
  <!-- page CSS -->
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


  <link href="css/colors/blue.css" id="theme" rel="stylesheet">
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>
<?php  
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
                      header('location:bookbottle.php');
                      
              
                  }
              }
              curl_close($ch);
                  }
  if(isset($_GET['eb'])){  
      /*get product details*/
     $productId = base64_decode($_GET['eb']); 
      /*get details of packages */
  $data = array(
      "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
      "productId"=>$productId
  );
  $data_json = json_encode($data);
  $uf = $url."bottleDetails";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $uf);
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
          $bottles  = $responsObj['bottleDetails'][0];//print_r($bottles); exit; 
		  $product_id = $bottles['product_id'];
		  $venue_name       = $bottles['name'];
		  $start_date_time = explode(' ',$bottles['start_date_time']);
		  $end_date_time   = explode(' ',$bottles['end_date_time']);
		  $start_date      = $start_date_time[0];
		  $end_date        = $end_date_time[0];;
		  $start_time      = $bottles['start_time'];
		  $end_time        = $bottles['end_time'];
		  $offer_days      = explode(',',$bottles['offer_days']);
		  $today           = $bottles['today'];
		  $bottle_name     = explode(',',$bottles['bottle_name']);
		  $price           = explode(',',$bottles['price']);
		  $actual_price    = explode(',',$bottles['actual_price']);
		  $bottle_id       = explode(',',$bottles['bottle_id']);
		  $terms_conditions = explode(',',$bottles['terms']);
		  $term_ids             = explode(',',$bottles['ids']);
		  $venue_description = $bottles['description'];
		  $bottleids = array();
		}
  }
  curl_close($ch);
  /*******get reviews****/
  //getDetals & offers start*
  $product_Id = base64_decode($_GET['eb']); 
  $data = array(
      "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
      "productId"=>$productId
  );
  $data_json = json_encode($data);
  $ug = $url."getTerms";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ug);
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
            $termId = array_column($responsObj['terms'], 'id'); 
            $terms  = array_column($responsObj['terms'],'discription');
		 
      }
  }
  curl_close($ch);
      
      /*end*/
      }
  session_start();
  if(isset($_POST['submit'])){
  
      $j = 0;

      /*products*/
      $product = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "category_id"=>5,
          "name"=>$_POST['venue_name'],
          "status"=>0);
          
          /*update product*/
          /**product updatation**/
          
          if(isset($_GET['eb'])){
			  
	              $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$term_ids);  				
                  $sur_data= array(   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                                      "product_id"=>base64_decode($_GET['eb']),
                                      "name"=>$_POST['venue_name'],
                                      "start_date_time"=>$_POST['start_date'].' '.$_POST['start_time'],
									  "end_date_time"=>$_POST['end_date'].' '.$_POST['end_time'],
									  "start_time"=>$_POST['start_time'],
									  "end_time"=>$_POST['end_time'],
									  "today"=>$_POST['today'],
									  'product_terms'=> $product_terms,
									  "booking_days"=>implode(',',$_POST["booking_days"])									  
                                       ); 
                 $data_json = json_encode($sur_data); //echo"<pre><br>";print_r($data_json); exit;
                  $uk = $url."updateItem";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $uk);
                  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
                  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
                  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                  $response  = curl_exec($ch); //echo"<pre>"; print_r($response); exit;
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
	  }
               $bottle_info = array(
          "name"=>$_POST['bottlename'],
          "price"=>$_POST['offer_price'],
          "actual_price"=>$_POST['original_price']
      );
      if(isset($_GET['eb'])){
          
           $bottle_info = array(
          "name"=>$_POST['bottlename'],
          "price"=>$_POST['offer_price'],
          "actual_price"=>$_POST['original_price'],
		  "description"=>$_POST['venue_description'],
          "id"=>$_POST['bottle_id']
          );
            $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=>base64_decode($_GET['eb']),
          "bottle_info"=>$bottle_info,
            );
       $ui = $url."bottleUpdate";
          
          }else{
              
$data = array(    
							  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
							  "user_id"=>$_SESSION['id'],
							  "category_id" =>5,
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
      $response  = curl_exec($ch); //print_r($response); exit;
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
      }
	  }
      curl_close($ch); 
//end
        
		$data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "bottle_info"=>$bottle_info,
          "terms_conditions"=>$terms_conditions,
		  "description"=>$_POST['venue_description'],
          "parentId"=>$parentId
          );
      $ui = $url."bookbottle";
              }
			 
	  $data_json = json_encode($data); //print_r($data_json); die;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $ui);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response  = curl_exec($ch); //print_r($response); exit;
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
              header("location:bookbottle.php");
          }
      }
      curl_close($ch);
      /*end*/
  }
  ?>

<body class="fix-header card-no-border">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
              <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
  </div>
  <div id="main-wrapper">
    <?php require_once ("top.php");?>
    <?php require_once ("left-sidebar.php");?>
    <div class="page-wrapper">
      <div class="container-fluid">
        <div class="row page-titles">
          <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
              <li class="breadcrumb-item active">posts</li>
              <li class="breadcrumb-item active">Book a bottle</li>
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
                  <div id="monthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                </div>
              </div>
              <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                <div class="chart-text m-r-10">
                  <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                  <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0</h4>
                </div>
                <div class="spark-chart">
                  <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row b-b">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
              <a href="bookbottle.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button></a>
              <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">New/Edit Book A Boottle</h4>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
              <!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
              <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
              <a href="bookbottle.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
            </div>
          </div>
          <div class="row m-t20">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                      <div class="col-md-6">
                          <input type="text"  name="venue_name" class="form-control" placeholder="Name" value="<?php echo $venue_name;?>">
                          <small class="form-control-feedback"></small> 
                      </div>
                  </div>
                  <hr class="hr"/>
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
                                  <small class="form-control-feedback"></small> </div>
                              </div>    
                              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only For Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($deal->today)){echo"checked";} ?>  id= "today"  name="today_deal"  value="1"> 
                                </div>
                              </div>							  
                            </div>
                  <div class="row" id="duration">
                             <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Offer Days</label>
                                <div class="input-group">
                                    <select name='booking_days[]' class="form-control" id="multi" multiple>
                                        <option value="4" <?php if(in_array(4,$offer_days)){echo"selected";} ?>>Mon</option>
                                        <option value="5" <?php if(in_array(5,$offer_days)){echo"selected";} ?>>Tue</option>
                                        <option value="6" <?php if(in_array(6,$offer_days)){echo"selected";} ?>>Wed</option>
                                        <option value="0" <?php if(in_array(0,$offer_days)){echo"selected";} ?>>Thur</option>
                                        <option value="1" <?php if(in_array(1,$offer_days)){echo"selected";} ?>>Fri</option>
                                        <option value="2" <?php if(in_array(2,$offer_days)){echo"selected";} ?>>Sat</option>
                                        <option value="3" <?php if(in_array(3,$offer_days)){echo"selected";} ?>>Sun</option>
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
                  <!-----/date----->
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="addbt">
                      <h4 class="card-title p-t10">Book A Bottle Price List</h4>

                      <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        <div class="row">
                          <?php
                                                     if (count($bottle_name)>0){
		for($i=0; $i<count($bottle_name); $i++){								?>						 
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Bottle Name</label>
                                <input type="text" name="bottlename[]" id="bottlename" class="form-control" placeholder="Bottle Name" value="<?php echo $bottle_name[$i];  ?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Offer Price (Enter Value only ex: 2500/-)</label>
                                <input type="text" id="offer_price" name="offer_price[]" class="form-control" placeholder="Ex: 2500/-" value="<?php echo $price[$i];?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Orginal Price </label>
                                <input type="text" id="original_price" name="original_price[]" class="form-control" placeholder="Ex: 2500/-" value="<?php echo $actual_price[$i];?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>


                            <input type="hidden" name="bottle_id[]" value="<?php echo $bottle_id[$i];?>">
                            <?php }
                                                }else{?>

                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Bottle Name</label>
                                <input type="text" name="bottlename[]" id="bottlename" class="form-control" placeholder="Bottle Name" value="<?php echo $bottle->bottle_name  ?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Offer Price</label>
                                <input type="text" id="offer_price" name="offer_price[]" class="form-control" placeholder="Ex: 2500/-" value="<?php echo $bottle->price;?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="control-label">Orginal Price </label>
                                <input type="text" id="original_price" name="original_price[]" class="form-control" placeholder="Ex: 2500/-" value="<?php echo $bottle->actual_price;?>">
                                <small class="form-control-feedback"></small>
                              </div>
                            </div>

                            <?php  } ?>
                        </div>

                      </div>
                    </div>
                    
                  </div>
                  <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right" id="addbtl">+ Add More</button>
                  <div class="clearfix"></div>
                  <!-----date-->
                  <hr class="hr" />

                  <div class="row p-t30">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                      <div class="form-group">
                        <label class="m-b0">Discription (minimum 1000 alfabets)</label>
                        <textarea class="form-control" rows="5" name="venue_description" id="venue_description"><?php echo $venue_description ;?></textarea>
                      </div>
                    </div>
                  </div>
                  <hr class="hr m-t0" />
                  
                  <!--------------------------------------------------terms&package------------------------------------------------->

                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id='tc'>
                      <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>



                      <?php if(count($terms_conditions)>0){
						  $i=0;
						  foreach($terms_conditions as $term){ ?>
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
                  <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10" id="addtc">+ Add More Rows</button>
                  <div class="clearfix"></div>
                  <hr class="hr" />

                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                      <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                      <!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                      <a href="bookbottle.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                    </div>
                  </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        <div id="footer">
          <footer>
            <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
          </footer>
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
    </div>
  </div>
  <?php  require_once("footer.php");?>
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
  <!--ex js start-->

  <!--ex js end-->

  <script>
    jQuery(document).ready(function() {
//today 
//For Deal 
$(document).on("click","#today",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration").show(); else $("#duration").hide(); 
    });    
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

    <!-- STAR RATING --> 
    <script >
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
    $(document).on("click", "#addtc", function() {
      var count = $("#tc > div").length;
      count = parseInt(count) + 1;
      $("#tc").append('<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control"  id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
    });
    $(document).on("click", "#addbtl", function() {
      $("#addbt").append('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button><div class="row"><div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Bottle Name</label><input type="text" name="bottlename[]" id="bottlename" class="form-control" placeholder="Bottle Name"><small class="form-control-feedback"></small></div></div><div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"><div class="form-group">											<label class="control-label">Offer Price (Enter Value only ex: 2500/-)</label><input type="text" id="offer_price" name="offer_price[]" class="form-control" placeholder="Ex: 2500/-"><small class="form-control-feedback"></small></div></div><div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"><div class="form-group"><label class="control-label">Orginal Price </label><input type="text" id="original_price" name="original_price[]" class="form-control" placeholder="Ex: 2500/-"><small class="form-control-feedback"></small></div></div></div></div>');

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
              
              