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
  <?php   require_once("header.php"); ?>
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
      //$productId = base64_decode($_GET['ep']);
  /*getDetals & offers start*/
  $product_Id = base64_decode($_GET['ep']); 
  $data = array(
      "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
      "productId"=>$product_Id
  );
  $data_json = json_encode($data);
  $ue = $url."gettermsConditions";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $ue);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  $response  = curl_exec($ch);//print_r($response); exit;
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
           $terms  = $responsObj['terms'];//print_r($terms); exit;
           $image   =  $responsObj['terms'][0]['image']; 
		    $imageid = $responsObj['terms'][0]['imageid']; 
		  // $imageid  = array_column($responsObj['terms'],'imageid');   
		  $termid = array();
		  foreach($terms as $result){
			  array_push($termid,$result['id']);
			  }
			  $termid = array_unique($termid);
			  $terms = array_unique($terms); //print_r($termid);echo"<br>"; print_r($terms); exit;
		  // $termid   = array_column($responsObj['terms'],'id');
      }
  }
  curl_close($ch);    
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
		 
          $packaged =(object)$responsObj['packageDetails'][0]; 
          $titanium =(object)$responsObj['packageDetails'][0];
          $platinum = (object)$responsObj['packageDetails'][1];
          $gold     = (object)$responsObj['packageDetails'][2];
          $silver   = (object)$responsObj['packageDetails'][3];
          $bronze   = (object)$responsObj['packageDetails'][4];
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
                 //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
              } else {
                  //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
              }
          } else {
              //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
          }
      }
      /**product updatation**/
      if(isset($_GET['ep'])){
     
		 /**start****/
	                
                  $product_gallery  = array("images"=>$images,"type"=>2,'id'=>$imageid); 
                  $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$termid);
				 $sur_data= array(   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                                      "product_id"=>base64_decode($_GET['ep']),
                                      "name"=>$_POST['venue_name'],
                                      "highlights"=>$_POST['specialities'],
                                      "closed_date"=>$_POST['end_date'],
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
      }else{
                           
      /**end**/
  /*parentId start*/
      $data = array("clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                      "user_id"=>$_SESSION['id'],
                      "category_id"=>6,
                      "name"=>$_POST['venue_name'],
                      "highlights"=>$_POST['specialities'],
                       "closed_date"=>date("Y-m-d",strtotime($_POST['date-format1'])),
                        "tags"=>$_POST['tags'],
                        "description"=>$_POST["venue_description"],
                        "artist_info"=>$_POST["artist_info"],
                        "status"=>"1");				 
                              
          $data_json = json_encode($data);
      $ua = $url."Product1";
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
              $message = $responsObj['message'];
              $parentId = $responsObj['parent_id'];           
          }
      }
      curl_close($ch);
  }
      /*end*/	
      
  //category_id =product surprise categories
  $titanium = array(
                   "category_id"=>1,
                   "price"=>$_POST['titanium_price'],
                   "description"=>$_POST['titanium_description'],
                   "tags"=>$_POST['titanium_tags'],
                   "id"=>$_POST['titanium_id']
                  );
				
  $platinum   = array(
               "category_id"=>2,
               "price"=>$_POST['platinum_price'],
               "description"=>$_POST['platinum_description'],
               "tags"=>$_POST['platinum_tags'],
               "id"=>$_POST['platinum_id']
               );
  $gold   =     array(
               "category_id"=>3,
               "price"=>$_POST['gold_price'],
               "description"=>$_POST['gold_description'],
               "tags"=>$_POST['gold_tags'],
               "id"=>$_POST['gold_id']
               );
  $silver =   array(
                      "category_id"=>4,
                      "price"=>$_POST['silver_price'],
                      "description"=>$_POST['silver_description'],
                      "tags"=>$_POST['silver_tags'],
                      "id"=>$_POST['silver_id']
                  );
  $bronze  = array(
                  "category_id"=>5,
                  "price"=>$_POST['bronze_price'],
                  "description"=>$_POST['bronze_description'],
                  "tags"=>$_POST['bronze_tags'],
                  "id"=>$_POST['bronze_id']
              );
  /*parend id end*/
   $package_categories = array($titanium,$platinum,$gold,$silver,$bronze);
     $product_images  = array("images"=>implode(",",$images),"type"=>2); 
      $terms_conditions = array(implode(",",$_POST['terms_conditions']) );  
      if(isset($_GET['ep'])){
              $terms_conditions = array("terms"=>implode(",",$_POST['terms_conditions']),"ids"=>$_POST['ptid']);
              $product_images  = array("images"=>implode(",",$images),"id"=>$_POST['image_id']);
          
          $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=>base64_decode($_GET['ep']),
          "package_products"=>$package_categories,
		  "package_ids"=>$packageIds
        );  
         $uc = $url."packageUpdate";		
  }else{	
         $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=>  $parentId,
          "package_products"=>$package_categories,
          "product_images"=>$product_images,
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
      $response  = curl_exec($ch);// print_r($response); exit;
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
                header("location:packages.php");
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
        <form action=""  method="post" enctype="multipart/form-data" >
        <div class="row b-b">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0">
            <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info flt-left">Back</button></a>
            <h4 class="card-title m-b20 flt-left p-t5 p-l20 ">New/Edit Package</h4>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0">
            <!-- <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>--> 
            <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a> 
            <button type="submit" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
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
                <input type="text" name="venue_name" class="form-control" placeholder="Name" value="<?php echo $titanium->name; ?>">
                <small class="form-control-feedback"></small> </div>
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label class="control-label">Venue Category (ex: Pub, Bar, Casual Dining,.. etc)</label>
              <div class="input-group"> <span class="input-group-addon">Tags</span>
                <input type="text" name="tags"  data-role="tagsinput"  value="<?php echo $packaged->tags;?>">
              </div>
            </div>
            <!--<div class="col-md-6">
              <div class="form-group">
                <label class="control-label">Venue Location Map (url)</label>
                <input type="text" name="map_url" class="form-control" placeholder="paste your google map url here">
                <small class="form-control-feedback"></small> </div>
            </div>-->
            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group p-t20">
                <label>Address</label>
                <textarea class="form-control" rows="2" name="address"></textarea>
              </div>
            </div>-->
            </div>
             <div class="clearfix"></div>
            <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group p-t20">
                <label>Venue Highlights / Specialities</label>
                <textarea class="form-control" rows="2" name="specialities"> <?php echo $packaged->highlights;?></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-material"><br>
              <label>Post Close from website Date & time</label>
                <input id="date-format1" name="date-format1" class="form-control" placeholder=" "  data-dtp="dtp_yqfSj" type="text">
                </div>
           </div>
          </div>
          <hr class="hr"/>
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
                      <div class="row"> 
                        <!--------------------TITANIUM/PLATINUM/GOLD/SILVER/BRONZE----------->
                       <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" name	="titanium_price" class="form-control" placeholder="2500/-" value="<?php echo $titanium->price;?>">
                            <small class="form-control-feedback"></small> </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Package Highlights / items</label>
                          <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                            <input type="text" name="titanium_tags" data-role="tagsinput" placeholder="add tags" value="<?php echo $titanium->ptags;?>">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>About Package</label>
                            <textarea class="form-control" rows="5" name="titanium_description"><?php echo $titanium->pdescription;?></textarea>
                            <input type="hidden" name="titanium_id" value="<?php echo $titanium->id;?>">
                          </div>
                        </div>
                      </div>
                      
                      
                      
                    </div>
                  </div>
                  <div class="tab-pane" id="tab2" role="tabpanel">
                    <div class="p-20">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" name="platinum_price" class="form-control" placeholder="2500/-" value="<?php echo $platinum->price;?>">
                            <small class="form-control-feedback"></small> </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Package Highlights / items</label>
                          <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                            <input type="text"  name="platinum_tags" data-role="tagsinput" value="<?php echo $platinum->ptags;?>">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>About Package</label>
                            <textarea class="form-control" rows="5" name="platinum_description"><?php echo $platinum->pdescription;?></textarea>
                             <input type="hidden" name="platinum_id" value="<?php echo $platinum->id;?>">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab3" role="tabpanel">
                    <div class="p-20">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" name="gold_price" class="form-control" placeholder="2500/-" value="<?php echo $gold->price;?>">
                            <small class="form-control-feedback"></small> </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Package Highlights / items</label>
                          <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                            <input type="text" name="gold_tags" data-role="tagsinput" value="<?php echo $gold->ptags;?>">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>About Package</label>
                             <input type="hidden" name="gold_id" value="<?php echo $gold->id;?>">
                            <textarea class="form-control" rows="5" name="gold_description"><?php echo $gold->pdescription;?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab4" role="tabpanel">
                    <div class="p-20">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" id="firstName" name="silver_price" class="form-control" placeholder="2500/-" value="<?php echo $silver->price;?>">
                            <small class="form-control-feedback"></small> </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Package Highlights / items</label>
                          <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                            <input type="text" name="silver_tags" data-role="tagsinput" value="<?php echo $silver->ptags;?>">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>About Package</label>
                                                       <input type="hidden" name="silver_id" value="<?php echo $silver->id;?>">
                            <textarea class="form-control" rows="5" name="silver_description"><?php echo $silver->pdescription;?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane" id="tab5" role="tabpanel">
                    <div class="p-20">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-group">
                            <label class="control-label">Price</label>
                            <input type="text" id="firstName" name="bronze_price" class="form-control" placeholder="2500/-" value="<?php echo $bronze->price;?>">
                            <small class="form-control-feedback"></small> </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <label class="control-label">Package Highlights / items</label>
                          <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                            <input type="text" name="bronze_tags" data-role="tagsinput" placeholder="add tags" value="<?php echo $bronze->ptags;?>">
                          </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                            <label>About Package</label>
                                                       <input type="hidden" name="bronze_id" value="<?php echo $bronze->id;?>">
                            <textarea class="form-control" rows="5" name="bronze_description"><?php echo $bronze->pdescription;?></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
          <div class="row p-t30">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="form-group">
                <label class="m-b0">Venue Discription </label>
                <textarea class="form-control" rows="5" name="venue_description"><?php echo $packaged->description;?></textarea>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gallery artist-info">
              <div class="form-group">
                <label class="m-b0"> Artist Info </label>
                <textarea class="form-control" rows="5" name="artist_info"><?php echo $packaged->artist_info;?></textarea>
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
                  <input type="text" class="form-control" placeholder=" " name="terms_conditions[]"  value="<?php  echo $term->discription; ?>">
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
          <div class="clearfix"></div>
          <hr class="hr"/>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <h4 class="card-title p-t10 p-b10">Media</h4>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
              <input type="file" name="images[]" multiple>
              <?php if($image!=""){?>
              <img src="<?php echo $image;?>"  width="115px" height="100px"  style="border-radius: 10px;margin-top: 10px;">
              <?php }?>
                <input type="hidden" name="image_id" value="<?php echo $imageid;?>">
            </div>
          </div>
          <hr class="hr"/>
          <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
          <button type="submit" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
          <a href="packages.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
      </div>
    </div>
     </form>
     
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
      <script src="assets/plugins/jquery/jquery.min.js"></script>
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
  $(document).on('click','#addtc',function(){ 
  var count =  $('#tc').children('div').length;
  count = parseInt(count)+1; 
  var x ='<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control" placeholder=" " id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>';
      $("#tc").append(x);
      
      });
      
  });
  </script>