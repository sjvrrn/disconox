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
 /*
 *Get Categories
 */
              $data = array(
                  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                  "user_id"=> $_SESSION['id'],
				  "cat_id"=>1
              );
              $data_json = json_encode($data);
              $ue = $url."getCategory";
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $ue);
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
              curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
              $response  = curl_exec($ch); //echo"<pre>";print_r($response); exit;
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
					  $Main_Categories = $responsObj['categories'];
					  //for Only subcategories means 2nd stageq
					  if(count($Main_Categories)>0){
						  //subcategories
						  $sub_Categories .="<select name='cat_name' id='main_cat'>
						                      <option>Select Category<option>";
						  foreach($Main_Categories as $main){ $main = (object)$main; 
							$sub_Categories.='<option value="'.$main->id.'">'.$main->cat_name.'</option>';
							  
						  }
						  $sub_Categories.='</select>';
						//SubCategories1
						 $sub_Categories1 .="<select name='supercat_name' id='main_cat1'><option>Select Category<option>";
						  foreach($Main_Categories as $main){ 
						         $main = (object)$main; 
							    $sub_Categories1.='<option value ="'.$main->id.'">'.$main->cat_name.'</option>';
							    }
						  $sub_Categories1.='</select>';	
                        //subcategory2
						 $sub_Categories2 .="<select name='supercat_name' id='main_cat2'><option>Select Category<option>";
						  foreach($Main_Categories as $main){ 
						         $main = (object)$main; 
							    $sub_Categories2.='<option value ="'.$main->id.'">'.$main->cat_name.'</option>';
							    }
						  $sub_Categories2.='</select>';
						  
					  }
                     // header('categories.php');
                      
              
                  }
              }
              curl_close($ch); 
 // end
if($_POST['maincategory']){   
	$cat_name  = $_POST['category_name'];
	$category_id = $_POST['id'];
	$category =  array('cat_id'=>1,
					  'cat_name'=>$cat_name
					  );
	
	$data     = array("clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	                  "user_id"=>$_SESSION['id'],
	                  'category'=>$category
					  ); 
    $data_json = json_encode($data);
	$url = $url."addCategory";
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
	$response   = curl_exec($curl);
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
}
 //end 
//Get Sub Categories
	 if($_POST['subcategory']){ 		 
		$cat_name  =  $_POST['cat_name'];
		$category  = $_POST['cat_id']; 
	    $category  =  array('cat_id'=>$category,
						  'cat_name'=>$cat_name,
						  'maincat_id'=>$_POST['main']
						  );
	
	$data     = array("clientId" => "x6DmrbsQFZyUUiggs0BZ",
	                  "user_id"  => $_SESSION['id'],
	                  'category' => $category
					  ); 
    $data_json = json_encode($data);
	$url = $url."addCategory";
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
	$response   = curl_exec($curl); //print_r($response); exit;
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
      }	  
if($_POST['childCategory']){	
	$supercat_id    = $_POST['supercat_name'];
	$subcat_id      = $_POST['subcat_name'];
	$cat_name    = $_POST['item_name'];
    $cat_id           = $_POST['cat_id']; 
	$category =  array(
					  'supercat_id'=>$supercat_id,
					  'subcat_id'=>$subcat_id,
					  'cat_name'=>$cat_name,
					  'cat_id'=>$cat_id
					  );
	$data     = array(
	                  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	                  "user_id"=>$_SESSION['id'],
	                  'category'=>$category
					  ); 
    $data_json = json_encode($data);  
	$url = $url."addCategory";
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
	$response   = curl_exec($curl); 
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
}
 //child sub Category
if($_POST['childsubCategory']){	
	$supercat_name    = $_POST['supercat_name'];
	$subcat_name      = $_POST['subcat_name'];
	$childcat_name    = $_POST['childcat_name'];
	$item_name    = $_POST['item_name'];
    $cat_id           = $_POST['cat_id']; 
	$category =  array(
					  'supercat_id'=>$supercat_name,
					  'subcat_id'=>$subcat_name,
					  'childcat_id'=>$childcat_name,
					  'item_name'=>$item_name,
					  'cat_id'=>$cat_id
					  );
	$data     = array(
	                  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	                  "user_id"=>$_SESSION['id'],
	                  'category'=>$category
					  ); 
    $data_json = json_encode($data);  
	$url = $url."addCategory";
	$curl = curl_init();
	curl_setopt($curl,CURLOPT_URL,$url);
	curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
	curl_setopt($curl,CURLOPT_POSTFIELDS,$data_json);
	curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
	$response   = curl_exec($curl);
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
}
 //end 
 
   
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
              <li class="breadcrumb-item active">New/edit Categories</li>
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
          </div>
          </div>
          <div class="row m-t20">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="card">
                <div class="card-body">
                 
                  <hr class="hr" />
<!--styles------>
<style>
.card .card-header{
background :#624A4A none repeat scroll 0% 0% !important
	
}
</style>
<!------end----->
<!------------collapse start--------------------------->
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header btn btn-info" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" >
          Main Categories
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
       <!-----collapse one body-------->
	  <div class="row">
	  <!---row start--->
	  <form action="" method="post">
	  <div  class="col-sm-12">
	  <label>Enter Category Name</label>
	  <input type="text" name="category_name" class="text-success">
	  </div>
	  <div class="col-sm-12">
	  <input type="hidden" name="category_id" value="1">
	  <input type="submit"  id="maincategory" name="maincategory" value="submit" class="btn btn-info">
	  
	  </div>
	  </div>
	  <!--row end-->
	  </div>
	   <!-----end----->
      </div>
    </div>
  
  <div class="card">
    <div class="card-header btn btn-info" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" >
          SubCategories
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
 <div class="row">      
	  <!-----subcategories--------->
	  <form action="" method="post">
	   <div class="col-sm-12" id="subcategories1">
	   <?php //echo $sub_Categories1;?>
	   </div>	  
	   <div class="col-sm-12">
	   <input type="text" name="cat_name" class="text-success" >
	   </div>
	   
	   <input type="hidden" name="main" id="main" value="1">
	   <input type="hidden" name="cat_id" value="2">
	   <div class="col-sm-12">
	   <input type="submit" name="subcategory" value="submit" class="btn btn-info">
	   </div>
	   </form>
	   <!--end-->
	   </div>
      </div>
    </div>
  </div>
  
  <div class="card">
    <div class="card-header btn btn-info" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" >
          ChildCategories

        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
       <div class="row">
	   <!---row start------>
	   <form action="" method="post">
	   <!--main Categories--->
	   <div class="col-sm-12" id="subcategories2">
	   <?php //echo $sub_Categories1;?>
	   </div>
	   <!--sub Categories---->
	   <div class="col-sm-12" id="subcategory">
	   </div>
	   <div class="col-sm-12">
	   <input type="text" name="item_name" class="text-success">
	   </div>
	   <input type="hidden" id="cat_id" name="cat_id" value="3">
	   <!--submit-->
	   <div class="col-sm-12">
	   <input type="submit" name="childCategory" value="submit" class="btn btn-info">
	   </div>
	   </form>
	   </div>
	   <!----end---->
	   </div>
      </div>
    </div>
  </div>
  <!--child cat---->
 
  <div class="card">
    <div class="card-header btn btn-info" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      <h5 class="mb-0">
        <button class="btn btn-link collapsed" type="button" >
          ChildCategories

        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
       <div class="row">
	   <!---row start------>
	   <form action="" method="post">
	   <!--main Categories--->
	   <div class="col-sm-12" id="subcategories3">
	   <?php //echo $sub_Categories2;?>
	   </div>
	   <!--sub Categories---->
	   <div class="col-sm-12" id="childSubcategory">
	   
	   </div>
	   <!--Enter Child Category Name--->
	   <div class="col-sm-12" id="childCategory">
	   
	   </div>
	   <!--enter childsubcategory name-->
	   <!--Enter Child Category Name--->
	   <div class="col-sm-12">
	   <input type="text" name="item_name">
	   </div>
	   <input type="hidden" id="cat_id" name="cat_id" value="4">
	   <!--submit-->
	   <div class="col-sm-12">
	   <input type="submit" name="childsubCategory" value="submit" class="btn btn-info">
	   </div>
	   </form>
	   </div>
	   <!----end---->
	   </div>
      </div>
    </div>
  </div>
  <!--end-->
  
  </div>
</div>
<!------------collapse end------------------------------>
				  
				 
        </div>
        </div>

        <!-- Modal -->
       
        </div>
        <!-- ============================================================== -->

        </div>
        </form>
      </div>
    </div>
  </div>

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
      <!--Custom JavaScript -->
      
     <script src="assets/plugins/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
      <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
   
<script>
$(document).ready(function() {
//ajax to get Main Categories
var cat_id = 1;
	$.ajax({
		type:"POST",
		url:"ajax.php",
		data:"main_category="+cat_id,
		success:function(response){  
		document.getElementById("subcategories1").innerHTML= response;
		document.getElementById("subcategories2").innerHTML= response;
		document.getElementById("subcategories3").innerHTML= response;
		}
	});
//FOr Main Category events
$("#main_cat").change(function(){
	$("#main").val($(this).val());
});		

//subcategories
$("#main_cat1").change(function(){
	var super_category_id = $(this).val();
	//ajax to get sub categories values
	$.ajax({
		type:"POST",
		url:"ajax.php",
		data:"super_category_id="+super_category_id,
		success:function(response){ alert(response); 
		document.getElementById("subcategory").innerHTML= response;
		}
	});
  });		
//For Child Sub Categories
$("#main_cat2").change(function(){
	var super_category_id = $(this).val();
	//ajax to get sub categories values
	$.ajax({
		type:"POST",
		url:"ajax.php",
		data:"sub_category_id="+super_category_id,
		success:function(response){  
		document.getElementById("childSubcategory").innerHTML= response;
		}
	});
  });		
});
</script>
<script>
$(document).on("change","#sub_cat2",function(){
 
	var subcat_id = $(this).val();
	var maincat_id = $("#main_cat2").val();
	//ajax get child sub category values
	$.ajax({
		type:'POST',
		url:"ajax.php",
		data:"subcategory_id="+subcat_id+"&maincat_id="+maincat_id,
		success: function(response){ document.getElementById("childCategory").innerHTML = response;}
	    }); 
	
});
</script> 
</body>

</html>

              
              <script src="js/custom.min.js"></script>