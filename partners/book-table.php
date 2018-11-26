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
  <?php require_once ("header.php");?>
</head>
<?php
session_start();
/*if(!isset($_SESSION['id'])){
    header("location:login.
	php");
}*/
if(isset($_GET['dt'])){
                   $productId = base64_decode($_GET['dt']); 	
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
                      header('location:booktable.php');
                      
              
                  }
              }
              curl_close($ch);
                  }
if(isset($_GET['et'])){
	$productId = base64_decode($_GET['et']);
/*
 *productdetails
 */	
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId
);
$data_json = json_encode($data); //print_r($data_json); die;
$ua = $url."productDetails";
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
        //echo "Bad Request";
    } else {
        $message = $responsObj['message'];
		$product  = (object)$responsObj['productDetails'][0];  
		$start_date_time = explode(' ',$product->start_date_time); 
		$end_date_time = explode(' ',$product->end_date_time); 
		$start_date = $start_date_time[0];
		$start_time = $start_date_time[1];
		$end_date = $end_date_time[0];
		$end_time = $end_date_time[1];
		$product_name = $product->name;
		$offer_days  = explode(',',$product->offer_days);
}		
    }

curl_close($ch); 
/*get details of packages */
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId
);
$data_json = json_encode($data); //print_r($data_json); die;
$ua = $url."tableDetails";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ua);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response  = curl_exec($ch);  //echo"<pre>"; print_r($response); exit;
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
		$tables = $responsObj['tableDetails']; 
        $table_ids = array_column($tables,'table_id'); 
		$booking = explode('/',$tables[0]['booking_days']);//print_r($booking); exit;
        $booking_days = $booking[0]; 
		$booking_time = $booking[1];		
		$index =(object)$responsObj['tableDetails'][0];
		
		
$btids = array();
		foreach($responsObj['tableDetails']  as $result){
	array_push($btids,$result['table_id']);
	
}		
    }
}
curl_close($ch);
/*******get reviews****/
/*getDetals & offers start*/
 $productId = base64_decode($_GET['et']); 
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId
);
$data_json = json_encode($data);
$ub = $url."getTerms";
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
        //echo "Bad Request";
    } else {
        $message = $responsObj['message'];
		 $terms = $responsObj['terms']; 
		 $term_ids  = array();
		 foreach($terms as $result){
			 array_push($term_ids,$result['id']);
		}
		 $term_ids = array_unique($term_ids);
		 $terms = array_unique($terms);
		 $image = $terms[0]['image']; 
		 $imageid = $terms[0]['imageid'];
    }
}
curl_close($ch);
	
	}


if(isset($_POST['submit'])){
/*start*/
$terms_conditions = array( "terms_conditions"=>implode(",",$_POST['terms_conditions']));
			
   
    $seater = array(
					"2Pax"=>$_POST['seeter2'],
					"4Pax"=>$_POST['seeter4'],
					"6Pax"=>$_POST['seeter6'],
					"8Pax"=>$_POST['seeter8'],
					"10Pax"=>$_POST['seeter10']
			   );	 	
	
	  
	if(isset($_GET['et'])){
		 /**start****/
	              $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$term_ids);   			
                  $sur_data= array(   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                                      "product_id"=>base64_decode($_GET['et']),
                                      "name"=>$_POST['venue_name'],
									  "start_date_time"  =>$_POST['start_date'].' '.$_POST['start_time'],
									  "end_date_time"=>$_POST['end_date'].' '.$_POST['end_time'],
									  "start_time"=>$_POST['start_time'],
									  "end_time"=>$_POST['end_time'],
									  "today"=>"",
									  'booking_days'=>$_POST['booking_days'].'/'.$_POST['booking_time'],
                                      'product_terms'=> $product_terms,
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
	}
	
if(isset($_GET['et'])){
	
	  $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"seater_ids" =>$table_ids,
       "cost"=>$_POST['cost']
        ); 
		$ud = $url."tableUpdate";
	}else{	  
	/*
	 *save product data 
	*/	
	 $data      =  array(
							"clientId" => "x6DmrbsQFZyUUiggs0BZ",
							"user_id" => $_SESSION['id'],
							"category_id" =>4,
							"name" => $_POST['venue_name'],
							"start_date_time" => date("Y-m-d", strtotime($_POST['start_date'])) . ' ' . $_POST['start_time'],
							"end_date_time" => date("Y-m-d", strtotime($_POST['end_date'])) . ' ' . $_POST['end_time'],
							"start_time"=>$_POST['start_time'],
							"end_time"=>$_POST['end_time'],
							"today"=>$_POST['today'],
							"offer_days"=>implode(',',$_POST['booking_days']),
							"status" => "1"
							);
        $data_json = json_encode($data);// echo"<pre>";print_r($data_json); exit;
        $ul        = $url . "Product1";
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ul);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);  //print_r($response); exit;
        
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
/*
 *save bottle info
*/ 
	$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",	
		"prices"=>$_POST['cost'],
		"seeter"=>$_POST['seeter'],
        "terms_conditions"=>$terms_conditions,
		"product_id"=>$parentId
      );
		$ud = $url."booktable";	
//end		
	} 
		
    $data_json = json_encode($data);  //print_r($data_json);die;
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ud);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);   //print_r($response); exit;
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
            header("location:booktable.php");
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
                <li class="breadcrumb-item active">New / edit book a Table</li>
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
                <a href="booktable.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button></a>
                <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">Book A Table</h4>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
                <!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                <a href="booktable.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
              </div>
            </div>

            <div class="row m-t20">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" id="venue_name" name="venue_name" class="form-control" value="<?php echo $product_name; ?>" placeholder="Name">
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
                          <small class="form-control-feedback"></small> </div>
                      </div>    
                       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Only For Today</label>
                                <div class="input-group">
                                    <input type="checkbox" <?php if(!empty($deal->today)){echo"checked";} ?>  id= "today"  name="today"  value="1"> 
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
                    <div class="alert alert-warning">
                      <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h4 class="card-title p-t10">Book A Table Price List</h4>

                          <?php 
								if(count($tables)>0){
								$i=0;
								foreach($tables as $table){ $table = (object)$table; 
							
									if($i%3==0){ echo'</div><div class="row">';}
									echo'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
											<div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
												
												<div class="form-group p-t5">
													<label class="control-label m-b0">'.$table->category_id.'Seeter</label>
													<input type="text" id="seeter2" name="cost[]" class="form-control" placeholder="2500/-" value="'.$table->price.'">
												</div>
											</div>
										</div><input type="hidden" name="table_id[]" value="'.$table->table_id.'">'; 
										$i++;
									
									}
								}else{
						  ?>

                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">2 PAX</label>
								  <input type="hidden" name="seeter[]" value="2" >
                                  <input type="text" id="seeter2" name="cost[]" class="form-control" placeholder="2500/-">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">4 PAX</label>
								  <input type="hidden" name="seeter[]" value="4" >
                                  <input type="text" id="seeter4" name="cost[]" class="form-control" placeholder="3500/-">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">6 PAX</label>
								  <input type="hidden" name="seeter[]" value="6" >
                                  <input type="text" id="seeter6" name="cost[]" class="form-control" placeholder="4500/-">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">8 PAX</label>
								  <input type="hidden" name="seeter[]" value="8" >
                                  <input type="text" id="seeter8" name="cost[]" class="form-control" placeholder="5500/-">
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">10 PAX</label>
								  <input type="hidden" name="seeter[]" value="10" >
                                  <input type="text" id="seeter10" name="cost[]" class="form-control" placeholder="6500/-">
                                </div>
                              </div>
                            </div>
                          </div>
						  <!--adding Extra table details--->
						    <div class="row">
							<!--start--
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
                              <div class="alert alert-info">
                                <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>

                                <div class="form-group p-t5">
                                  <label class="control-label m-b0">8 PAX</label>
                                  <input type="text" id="seeter8" name="seeter8" class="form-control" placeholder="5500/-">
                                </div>
                              </div>
                            </div>
							<!--end-->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 info-bg">
                              <div class="alert alert-info">
							<select class="selectpicker" data-live-search="true" name='seeter[]'>
							  <?php for($i=10;$i<21;$i++){
							  echo'<option data-tokens="'.$i.'" value='.$i.'>'.$i.'</option>';
								 } ?>
							</select>
							 <div class="form-group p-t5">
                                  <input type="text" id="seeter8" name="cost[]" class="form-control" placeholder="5500/-">
                                </div>
							</div>
							</div>
                            <!--1 end-->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 info-bg">
                              <div class="alert alert-info">
							<select class="selectpicker" data-live-search="true" name='seeter[]'>
							  <?php for($i=10;$i<21;$i++){
							  echo'<option data-tokens="'.$i.'" value='.$i.'>'.$i.'</option>';
								 } ?>
							</select>
							 <div class="form-group p-t5">
                                  <input type="text" id="seeter8"  name="cost[]"  class="form-control" placeholder="5500/-">
                                </div>
							</div>
							</div>
							<!--2 end-->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 info-bg">
                              <div class="alert alert-info">
							<select class="selectpicker" data-live-search="true" name='seeter[]'>
							  <?php for($i=10;$i<21;$i++){
							  echo'<option data-tokens="'.$i.'" value='.$i.'>'.$i.'</option>';
								 } ?>
							</select>
							 <div class="form-group p-t5">
                                  <input type="text" id="seeter8"  name="cost[]"  class="form-control" placeholder="5500/-">
                                </div>
							</div>
							</div>
							<!--3 -->
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 info-bg">
                              <div class="alert alert-info">
							<select class="selectpicker" data-live-search="true" name='seeter[]'>
							  <?php for($i=10;$i<21;$i++){
							  echo'<option data-tokens="'.$i.'" value='.$i.'>'.$i.'</option>';
								 } ?>
							</select>
							  <div class="form-group p-t5">
                                  <input type="text" id="seeter8"  name="cost[]"  class="form-control" placeholder="5500/-">
                                </div>
							</div>
							</div>
							<!--4 -->
                          </div>
						  <!--2 row end-->
						  <?php }?>


                        </div>

                      </div>

                    </div>

                    <div class="row p-t30">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label class="m-b0">Discription (minimum 1000 alfabets)</label>
                          <textarea class="form-control" rows="5" id="venue_description" name="venue_description"><?php echo $index->description;?></textarea>
                        </div>
                      </div>
                    </div>
                    <hr class="hr m-t0" />
                    <!--------------------------------------------------terms&package------------------------------------------------->
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tc">
                        <?php if(count($terms)>0){foreach($terms as $term){ $term = (object)$term;?>
                        <div class="alert alert-warning terms-alert">
                          <div class="form-group m-b10">
                            <label class="control-label"></label>
                            <input type="text" class="form-control" placeholder=" " name="terms_conditions[]" value="<?php  echo $term->discription ;?>">
                            <small class="form-control-feedback"></small> </div>
                          <input type='hidden' name='ptid[]' value='<?php echo $term->id; ?>'>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close" name="terms_conditions[]"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <?php } }else{?>
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
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">

                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                        <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                        <!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                        <a href="booktable.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                      </div>
                    </div>
          </div>
          </div>
          </div>
          </div>
          
          </form>
          <!-- Modal -->
          <div id="myTrash" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">

              <!-- Modal content-->
              <div class="modal-content">
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
//For Deal 
$(document).on("click","#today",function(){ var ischecked= $(this).is(':checked'); if(!ischecked)  $("#duration").show(); else $("#duration").hide(); 
})
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
    $(document).on("click", "#addtc", function() {
      var count = $("#tc > div").length;
      count = parseInt(count) + 1;
      $("#tc").append('<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control"  id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
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
              
              