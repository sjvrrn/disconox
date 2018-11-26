  
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
	
      $data_json = json_encode($data);
      $ud = $url."getsurprises"; 
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
              $products = $responsObj['productDetails'];
              $index    = (object)$products[0]; 
			  $boquet    = (object)$products[0];
              $cake      = (object)$products[1];
              $baloons = (object)$products[2];
              $liveartist = (object)$products[3];
              $bottleofwine = (object)$products[4];			
              $customsurprise = (object)$products[5]; 
			  $idarray = array($boquet->surprise_id,$cake->surprise_id,$baloons->surprise_id,$liveartist->surprise_id,$bottleofwine->surprise_id,$customsurprise->surprise_id);
           }
      }
      curl_close($ch);
      
      /*getDetals & offers start*/
   /*getDetals & offers start*/
  $productId = base64_decode($_GET['es']);  
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
           $terms = $responsObj['terms']; //echo"<pre>";print_r($terms); exit;
		  // $terms = explode(',',$terms[0]['discription']); 
        $primage = $responsObj['terms'][0]['image']; 
		$imageid = $responsObj['terms'][0]['imageid']; 
		 $termId = $responsObj['terms'][0]['id'];
		// $imageid  = array_column($responsObj['terms'],'imageid');   
		  // $termid   = array_column($responsObj['terms'],'id');
$termid = array();
foreach($terms as $term){
  array_push($termid,$term['id']);
}
$imageid  = array();
foreach($terms as $term){
  array_push($imageid,$term['imageid']);
}

		//surpriseId

      }
  }
  curl_close($ch);
  
      /**product end**/
      }
  
  //delete surprise
  
  if(isset($_POST['submit'])){        /*images*/
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
    /*  $j = 0;
      $gallery = array();
      for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
          $target_path = "assets/uploads/";
          $validextensions = array("jpeg", "jpg", "png");
          $ext = explode('.', basename($_FILES['images']['name'][$i]));
          $file_extension = end($ext);
          $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
          $j = $j + 1;
          if (($_FILES["images"]["size"][$i] < 10000000)
              && in_array($file_extension, $validextensions)) {
              if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $target_path)) {
                  array_push($gallery,$target_path);
              //    echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
              } else {
                //  echo $j. ').<span id="error">please try again!.</span><br/><br/>';
              }
          } else {
              //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
          }
      }*/
      /*end*/
  //Boquet,cake,baloons,liveartist,bottleofwine,custom surprise,other
  //category_id =product surprise categories
  $boquet = array(
                   "category_id"=>1,
                   "price"=>$_POST['boquet_price'],
                   "description"=>$_POST['boquet_description'],
                   "note"=>$_POST['boquet_note']
                  );
  $cake   = array(
               "category_id"=>2,
               "price"=>$_POST['cake_price'],
               "description"=>$_POST['cake_description'],
               "note"=>$_POST['cake_note']
               );
  $baloons   =     array(
               "category_id"=>3,
               "price"=>$_POST['baloons_price'],
               "description"=>$_POST['baloons_description'],
               "note"=>$_POST['baloons_note']
               );
  $liveartist =   array(
                      "category_id"=>4,
                      "price"=>$_POST['liveartist_price'],
                      "description"=>$_POST['liveartist_description'],
                      "note"=>$_POST['liveartist_note']
                  );
  $bottleofwine  = array(
                  "category_id"=>5,
                  "price"=>$_POST['bottleofwine_price'],
                  "description"=>$_POST['bottleofwine_description'],
                  "note"=>$_POST['bottleofwine_note']
              );
  $custom   =     array(
               "category_id"=>6,
               "price"=>$_POST['custom_price'],
               "description"=>$_POST['custom_description'],
               "note"=>$_POST['custom_note']
               );
if(!isset($_GET['es'])){ 
  /*product start*/
               
             $data = array(    
                           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                          "user_id"=>$_SESSION['id'],
                          "name"=>$_POST['venue_name'],
                          "highlights"=>$_POST['specialities'],
                          "closed_date"=>$_POST["date-format1"],
                          "tags"=>$_POST['venue_tags'],
                          "description"=>$_POST['event_description'],
                          "artist_info"=>$_POST['artist_info'],
                          "category_id"=>2,
                          "status"=>1
                           );
      $data_json = json_encode($data);
      $uc = $url."Product1";
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
              echo"<script>alert('".$message."');</script>";
              $parentId = $responsObj['parent_id']; 
        
  /*product end*/
                           
      $surprise_categories = array($boquet,$cake,$baloons,$liveartist,$bottleofwine,$custom);
      $terms_conditions = array("terms_conditions"=>implode(",",$_POST['terms_conditions']));
      $link = array("links"=>implode(",",$_POST['link']));
      $product_images  = array("images"=>implode(",",$images),"type"=>1);
      $product_gallery  = array("images"=>implode(",",$gallery),"type"=>2);
      $product_reviews = array("rating"=>$_POST['review_name'],
                        "review"=>$_POST['rate_comment'],
                        "uid"=>$_SESSION['id'],
                        "status"=>1
                         );
						 
      $data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=> $parentId,
          "surprise_products"=>$surprise_categories,
          "product_images"=>$product_images,
          "product_gallery"=>$product_gallery,
          "terms_conditions"=>$terms_conditions,
          "product_reviews"=>$product_reviews,
          "link"=>$link
      ); 
      $data_json = json_encode($data);
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
              echo "Bad Request";
          } else {
              $message = $responsObj['message'];
              echo"<script>alert('".$message."');</script>";
              header("location:surprise.php");
          }
      }
      curl_close($ch);
      //parent end
        }
      }
      curl_close($ch);
  }else{ 
	  /**update surprises****/
	                
                  $product_gallery  = array("images"=>$images,"type"=>2,'id'=>$imageid); 
                  $product_terms = array("terms"=>$_POST['terms_conditions'],"id"=>$termid);  
                  $sur_data= array(       "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                                      "product_id"=>base64_decode($_GET['es']),
                                      "name"=>$_POST['venue_name'],
                                      "highlights"=>$_POST['specialities'],
                                      "closed_date"=>$_POST['date-format1'],
                                      "tags"=>$_POST['venue_tags'],
                                      "description"=>$_POST['event_description'],
                                      "artist_info"=>$_POST['artist_info'],
									  "product_images"=> $product_gallery,
									  'product_terms'=> $product_terms
                                       ); 
              /*update product*/
                  $data_json = json_encode( $sur_data);
                  $uk = $url."updateItem";
                  $ch = curl_init();
                  curl_setopt($ch, CURLOPT_URL, $uk);
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
                          echo "Bad Request";
                      } else {
                          $message = $responsObj['message'];
					  }
      }
      curl_close($ch);
				 
	  /*surprise end**/
	   
	  /**updat surprises */
	    $boquet = array(
                   "category_id"=>1,
                   "price"=>$_POST['boquet_price'],
                   "description"=>$_POST['boquet_description'],
                   "note"=>$_POST['boquet_note'],
				   "id"=>$idarray[0]
                  );
  $cake   = array(
               "category_id"=>2,
               "price"=>$_POST['cake_price'],
               "description"=>$_POST['cake_description'],
               "note"=>$_POST['cake_note'],
			 	"id"=>$idarray[1]
               );
  $baloons   =     array(
               "category_id"=>3,
               "price"=>$_POST['baloons_price'],
               "description"=>$_POST['baloons_description'],
               "note"=>$_POST['baloons_note'],
			    "id"=>$idarray[2]
               );
  $liveartist =   array(
                      "category_id"=>4,
                      "price"=>$_POST['liveartist_price'],
                      "description"=>$_POST['liveartist_description'],
                      "note"=>$_POST['liveartist_note'],
					   "id"=>$idarray[3]
                  );
  $bottleofwine  = array(
                  "category_id"=>5,
                  "price"=>$_POST['bottleofwine_price'],
                  "description"=>$_POST['bottleofwine_description'],
                  "note"=>$_POST['bottleofwine_note'],
				   "id"=>$idarray[4]
              );
  $custom   =     array(
               "category_id"=>6,
               "price"=>$_POST['custom_price'],
               "description"=>$_POST['custom_description'],
               "note"=>$_POST['custom_note'],
			    "id"=>$idarray[5]
               );
$surprise_categories = array($boquet,$cake,$baloons,$liveartist,$bottleofwine,$custom);
       $sur_data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
          "product_id"=> base64_decode($_GET['es']),
          "surprise_products"=>$surprise_categories,
          );  
      $data_json = json_encode($sur_data);
      $uk = $url."Updatesurprise";
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
            <button type="d" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
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
                    <div class="form-group">
                      <label class="control-label">Name</label>
                      <input type="text" id="venue_name" name="venue_name" class="form-control" placeholder="Name" value="<?php echo $index->name;?>">
                      <small class="form-control-feedback"></small> </div>
                  </div>
                  <!--<div class="col-md-6">
                                              <div class="form-group">
                                                  <label class="control-label">Venue Location Map (url)</label>
                                                  <input type="text" id="venue_map"  name="venue_map" class="form-control" placeholder="paste your google map url here" value="<?php echo $product->location;?>">
                                                  <small class="form-control-feedback"></small> 
                                              </div>
                                          </div>-->
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label">Venue Category (ex: Pub, Bar, Casual Dining,.. etc)</label>
                    <div class="input-group m-b-30"> <span class="input-group-addon">Tags</span>
                      <input type="text" id="venue_tags" name="venue_tags"  data-role="tagsinput" placeholder="add tags" value="<?php echo $index->tags;?>" >
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label>Venue Highlights / Specialities</label>
                      <textarea class="form-control" rows="2" id="specialities" name="specialities"><?php echo $index->highlights;?></textarea>
                    </div>
                  </div>
                   <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-material p-t40">
                            <label>Post Close from website Date & time</label>
                            <input type="text" id="date-format1" name="date-format1" class="form-control" placeholder=" " value="<?php echo $index->closed_date; ?>">
                          </div>
                        </div>-->
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                          <div class="form-material p-t40">
                            <label>Post Close from website Date & time</label>
                            <input type="text" id="date-format1" name="date-format1" class="form-control" placeholder=" " value="<?php echo $index->closed_date; ?>">
                          </div>
                        </div>
                </div>
                <hr class="hr"/>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="card-title p-t10">Surprise Options</h4>
                    <div class="border p10">
                      <ul class="nav nav-tabs customtab" role="tablist">
                        <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab1"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">BOQUET</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab2" role="tab2"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">CAKE</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab3" role="tab3"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BALOONS</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab4" role="tab4"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">LIVE ARTISTS</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab5" role="tab5"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">BOTTLE OF WINE</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#tab6" role="tab6"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">CUSTOM SURPRISE</span></a> </li>
                      </ul>
                      <!-------------------------------------------------------boquet---->
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab1" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text" id="boquet_price"  name="boquet_price"class="form-control" placeholder="2500/-" value="<?php echo $boquet->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="boquet_note" name="boquet_note" class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $boquet->note;?>">
                                  <small class="form-control-feedback"></small> </div>
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
                        <!-------------------------cake-------------->
                        <div class="tab-pane" id="tab2" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text" id="cake_price" name="cake_price" class="form-control" placeholder="2500/-" value="<?php echo $cake->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="cake_note" name="cake_note"  class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $cake->note;?>">
                                  <small class="form-control-feedback"></small> </div>
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
                        <!-------------------------------------------------baloons------------------------------------------->
                        <div class="tab-pane" id="tab3" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text" id="baloons_price" name="baloons_price" class="form-control" placeholder="2500/-" value="<?php echo $baloons->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="baloons_note"  name="baloons_note" class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $baloons->note;?>">
                                  <small class="form-control-feedback"></small> </div>
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
                        <!--------------live artists------------------------>
                        <div class="tab-pane" id="tab4" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text" id="liveartist_price"  name="liveartist_price"class="form-control" placeholder="2500/-" value="<?php echo $liveartist->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="liveartist_note" name="liveartist_note" class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $liveartist->note;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>Discription</label>
                                  <textarea class="form-control" rows="5" id="liveartist_description" name="liveartist_description"><?php echo $liveartist->description;?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!----------------------bottleofwine------------------->
                        <div class="tab-pane" id="tab5" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text" id="bottleofwine_price" name="bottleofwine_price" class="form-control" placeholder="2500/-" value="<?php echo $bottleofwine->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="bottleofwine_note" name="bottleofwine_note" class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $bottleofwine->note;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>Discription</label>
                                  <textarea class="form-control" rows="5" id="bottleofwine_description" name="bottleofwine_description"> <?php echo $bottleofwine->description;?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-------------------------custom surprise-------------->
                        <div class="tab-pane" id="tab6" role="tabpanel">
                          <div class="p-20">
                            <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label class="control-label">Price</label>
                                  <input type="text"  id="custom_price" name="custom_price" class="form-control" placeholder="2500/-" value="<?php echo $customsurprise->price;?>">
                                  <small class="form-control-feedback"></small> </div>
                                <div class="form-group">
                                  <label class="control-label">Note</label>
                                  <input type="text" id="custom_note" name="custom_note" class="form-control" placeholder="To avail offer, Minimum 24 hours prior" value="<?php echo $customsurprise->note;?>">
                                  <small class="form-control-feedback"></small> </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                  <label>Discription</label>
                                  <textarea class="form-control" rows="5" id="custom_description" name="custom_description"> <?php echo $customsurprise->description;?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--------------------------------------------	--------------------->
                <div class="row p-t30">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                      <label class="m-b0">About Event (minimum 1000 alfabets)</label>
                      <textarea class="form-control" rows="5" id="event_description" name="event_description"><?php echo $index->prdescription;?></textarea>
                    </div>
                  </div>
                  <div  class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gallery artist-info">
                    <div class="alert alert-info"> <!--<a href="#">
                      <button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                      </a>-->
                      <div class="form-group">
                        <label class="m-b0">Artist Info <!--<span class="p-l30"><a href="profile-pick-edit.html"></span></a></span>--></label>
                        <textarea class="form-control" rows="5" placeholder="(minimum 1000 alfabets)" id="artist_info" name="artist_info"><?php echo $index->artist_info;?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="hr m-t0"/>
                <div class="row" >
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                    <h4 class="card-title p-t10 p-b10">Terms & Conditions</h4>
                  </div>
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id = "add_more">
                    
                      <?php if(count($terms)>0){
                          foreach($terms as $term){ 
                          ?>
                      <div class="alert alert-warning terms-alert">
                      <div class="form-group m-b10">
                        <label class="control-label"></label>
                        <input type="text" class="form-control" placeholder=" " name="terms_conditions[]"  value="<?php  echo $term['discription'] ;?>">
                        <small class="form-control-feedback"></small> </div>
                      <input type='hidden' name='ptid[]' value='<?php echo $ptid; ?>'>
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
              <button type="button" class="btn waves-effect waves-light btn-rounded btn-success flt-right m-t10" id ="addmore" name="addmore">+ Add More Rows</button>
              <hr class="hr"/>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                  <input type="file" name="images[]" multiple>
                  <?php if($index->image!=""){?>
                    <img src="<?php echo $index->image;?>"  width="115px" height="100px"  style="border-radius: 10px;margin-top: 10px;">
					  <?php }?>
                  <input type="hidden" name="image_id" value="<?php echo $imageid;?>">
                </div>
                
              </div>
              <hr class="hr"/>
                   
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-left m-b0"> </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-r0 text-right m-b0 p-r20">
            <button type="submit" name="submit" id="submit"  class="btn waves-effect waves-light btn-rounded btn-success" >SAVE</button>
            <!--<a href="#"><button type="submit" name="edit" id="edit" class="btn waves-effect waves-light btn-rounded btn-primary">EDIT</button></a>--> 
            <a href="surprise.php">
            <button type="reset" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
            </a> </div>
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
              
  <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> 
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
  $(document).on('click','#addmore',function(){ 
  var count =  $('#add_more').children('div').length;
  count = parseInt(count)+1;
  var x ='<div class="alert alert-warning terms-alert"><div class="form-group m-b10"><label class="control-label"></label><input type="text" class="form-control" placeholder=" " id="terms_conditions" name="terms_conditions[]"><small class="form-control-feedback"></small></div><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>';
      $("#add_more").append(x);
      
      });
      
  });
  </script>