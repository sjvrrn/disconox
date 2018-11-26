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
	
	/*get details of packages */
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId
);
$data_json = json_encode($data);
$ua = $url."tableDetails";
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
		$tables = $responsObj['tableDetails'];//print_r($tables); exit;
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
$ub = $url."gettermsConditions";
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
$product_images  = array("images"=>implode(",",$images),"type"=>1);   
$terms_conditions = array( "terms_conditions"=>implode(",",$_POST['terms_conditions']));
			
    $product = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "name"=>$_POST['venue_name'],
        "category_id"=>4,
        "highlights"=>$_POST['specialities'],
        "closed_date"=>$_POST['date-format1'],
        "tags"=>$_POST['tags'],
        "description" =>$_POST['venue_description'],
        "artist_info"=>$_POST['artist_info']
         );
    $seater = array(
                        "2SETER"=>$_POST['seeter2'],
                        "4SETER"=>$_POST['seeter4'],
                        "6SETER"=>$_POST['seeter6'],
                        "8SETER"=>$_POST['seeter8'],
                        "10SETER"=>$_POST['seeter10']
                   );	 	
	
	  
	if(isset($_GET['et'])){
		 /**start****/
	                
                  $product_gallery  = array("images"=>$images,"type"=>2,'id'=>$imageid); 
                  $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$term_ids);   			
                  $sur_data= array(   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                                      "product_id"=>base64_decode($_GET['et']),
                                      "name"=>$_POST['venue_name'],
                                      "highlights"=>$_POST['specialities'],
                                      "closed_date"=>$_POST['date-format1'],
                                      "tags"=>$_POST['tags'],
                                      "description"=>$_POST['venue_description'],
                                      "artist_info"=>$_POST['artist_info'],
									  "product_images"=> $product_gallery,
									  'product_terms'=> $product_terms
                                       ); 
              		$data_json = json_encode( $sur_data);
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
        "seater"=>$_POST['price'],
		"seater_ids"=>$_POST['table_id']
        ); 
		$ud = $url."tableUpdate";
	}else{
		   $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"product"=>$product,
        "prices"=>$seater,
        "product_images"=>$product_images,
        "terms_conditions"=>$terms_conditions,
		"user_id"=>$_SESSION['id']
    );
		$ud = $url."booktable";
		
		}
		
 $data_json = json_encode($data);
    
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
            echo "Bad Request";
        } else {
            $message = $responsObj['message'];
            echo"<script>alert('".$message."');</script>";
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
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
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
						<h4 class="card-title m-b20 flt-left p-t5 p-l20 ">Edit Book A Table</h4>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
						<!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
                        <button type="submit" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
						<a href="booktable.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
					</div>	
				</div>
				
                <div class="row m-t20">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="card-body">
								
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Name</label>
												<input type="text" id="venue_name" name="venue_name" class="form-control" value="<?php echo $index->name; ?>">
												<small class="form-control-feedback"></small> 
											</div>
                                        </div>
										<!--<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Venue Location Map (url)</label>
												<input type="text" id="map_url" name="map_url" class="form-control" >
												<small class="form-control-feedback"></small> 
											</div>
                                        </div>-->
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label class="control-label">Venue Category (ex: Pub, Bar, Casual Dining,.. etc)</label>
											<div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
												<input type="text" id="tags" name="tags" data-role="tagsinput" placeholder="add tags" value="<?php echo $index->tags; ?>">
											</div>
										</div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Venue Highlights / Specialities</label>
												<textarea class="form-control" rows="2" name="specialities" id="specialities"><?php echo $index->highlights; ?></textarea>
											</div>
                                        </div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-material p-t40">
												<label>Post Close from website Date & time</label>
											  
										      <input type="text" id="date-format1" name="date-format1" class="form-control" placeholder=" " value="<?php echo $index->closed_date; ?>">
                                           </div>
                                        </div>
										<!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<div class="form-group">
												<label>Address</label>
												<textarea class="form-control" rows="5" id="address" name="address"></textarea>
											</div>
                                        </div>-->
										
									</div>
									<hr class="hr"/>	<div class="alert alert-warning">
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<h4 class="card-title p-t10">Book A Table Price List</h4>
										
                                            <?php 
											if(count($tables)>0){
											$i=0;
											foreach($tables as $table){ $table = (object)$table; $j = ($i+1)*2;
											if($i<5){
												if($i%3==0){ echo'</div><div class="row">';}
												echo'<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">'.$j.'Seeter</label>
																<input type="text" id="seeter2" name="price[]" class="form-control" placeholder="2500/-" value="'.$table->price.'">
															</div>
														</div>
													</div><input type="hidden" name="table_id[]" value="'.$table->table_id.'">'; 
													$i++;
												}
												}
											}else{
											?>
                                            
                                            
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">2 Seeter</label>
																<input type="text" id="seeter2" name="seeter2" class="form-control" placeholder="2500/-">
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">4 Seeter</label>
																<input type="text" id="seeter4" name="seeter4" class="form-control" placeholder="3500/-">
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">6 Seeter</label>
																<input type="text" id="seeter6" name="seeter6" class="form-control" placeholder="4500/-">
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">8 Seeter</label>
																<input type="text" id="seeter8"  name="seeter8" class="form-control" placeholder="5500/-">
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 info-bg">
														<div class="alert alert-info">
															<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
															
															<div class="form-group p-t5">
																<label class="control-label m-b0">10 Seeter</label>
																<input type="text" id="seeter10" name="seeter10" class="form-control" placeholder="6500/-">
															</div>
														</div>
													</div>
												</div>
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
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gallery artist-info">
											<div class="alert alert-info">
												<!--<a href="#"><button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></a>-->
												<div class="form-group">
													<label class="m-b0">Artist Info<!-- <span class="p-l30"><a href="profile-pick-edit.html"></a></span>--></label>
													<textarea class="form-control" rows="5" placeholder="(minimum 1000 alfabets)" id="artist_info" name="artist_info"><?php echo $index->artist_info;?></textarea>
											    </div>
											</div>
										</div>
									</div>
									<hr class="hr m-t0"/>
									
									
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										  <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="tc">
										     <?php if(count($terms)>0){foreach($terms as $term){ $term = (object)$term;?>
          										  <div class="alert alert-warning terms-alert">
           											<div class="form-group m-b10">
                                                        <label class="control-label"></label>
                                                        <input type="text" class="form-control" placeholder=" " name="terms_conditions[]"  value="<?php  echo $term->discription ;?>">
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
										 
                                        <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10" id="addtc">+ Add More Rows</button>
									</div>
									
									<hr class="hr"/>
									<div class="row">
										     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <input type="file" name="images[]" multiple>
                                            <?php if($image!=""){?>
                                            <img src="<?php echo $image;?>"  width="115px" height="100px"  style="border-radius: 10px;margin-top: 10px;">
                                            <?php }?>
                                              <input type="hidden" name="image_id" value="<?php echo $index->image_id;?>">
                                          </div>
                                        </div>
									<hr class="hr"/>
							<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
						
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
                        <button type="submit" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
						<!--<a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>-->
						<a href="booktable.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
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
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
	
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
<script>
$(document).ready(function(){
	$(document).on("click","#addtc",function(){ var count =$("#tc > div").length;  count= parseInt(count)+1;
		$("#tc").append('<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control"  id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
		});
	});
</script>