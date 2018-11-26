<?php 
session_start();
require_once("header.php");
//user registration	
		$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>$_SESSION['id']
           );
		$data_json = json_encode($data);
	    $ud = $url."userDetails";
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
                $partner = (object)$responsObj['UserDetails'];
                 $name = explode('-',$partner->name);
                 $address = explode(",",$partner->address);
				 
            }
            curl_close($ch);
        }
	//end
	//get user profile details
		$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>$_SESSION['id']
           );
		$data_json = json_encode($data);
	    $ud = $url."getProfile"; 
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
                $user = (object)$responsObj['profileDetails']; 
                $images = explode(',',$user->images); 
				$videos_list = explode(',',$user->videos);
		       $imageids = $user->imageids;	
			   $videoids = $user->videoids; 
			   
			        }
            curl_close($ch);
        }
	//end
	
//update user details
if(isset($_POST['submit'])){

	/*image start*/ 
        $target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['images']['name']));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
		 if (($_FILES["images"]["size"]< 10000000)
            && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['images']['tmp_name'], $target_path)) {
                $image = $target_path; 
                //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        } 
/*image end*/
		//Array ( [first_name] => raju [last_name] => r [email] => rajup@gmail.com [phone] => 8 [password] => [cpassword] => [submit] => )i
    $data  = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$_SESSION['id'],
        "name"=>$_POST['first_name'].'-'.$_POST["last_name"],
        "address"=>$_POST['street'].','.$_POST['city'].','.$address[2],
        "password"=>$_POST['password'],
        "email"=>$_POST['email'],
        "phone"=>$_POST['phone'],
        "image"=> $image
    ); 
    $data_json = json_encode($data);
    $uu = $url."userUpdate"; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $uu);
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
            header("location:my-profile.php");


        }
    }
    curl_close($ch);
//singup end
}
//submit partner profile
if(isset($_POST['profile'])){
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
                //    echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                //  echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
    /*end*/
   //partner pic
		$target_path = "assets/uploads/";
        $validextensions = array("jpeg", "jpg", "png");
        $ext = explode('.', basename($_FILES['partner_image']['name']));
        $file_extension = end($ext);
        $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
        if (($_FILES["partner_image"]["size"]< 10000000) && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['partner_image']['tmp_name'], $target_path)) {
                $image = $target_path;
                //    echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {
                //  echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    //start  profile_pic

     $product_gallery  = array("images"=>implode(",",$gallery),"type"=>2);
	 $product_videos   = array(implode(",",$_POST['video']));
	 
		if($_POST['profile_id']!=""){
			
			 $product_gallery  = array("images"=>implode(",",$gallery),"ids"=>$imageids);
	 $product_videos   = array(implode(",",$_POST['video']),"ids"=>$videoids);
				$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"user_id" =>$_SESSION['id'],
		"profile_id"=>$_POST['profile_id'],
        "name"=>$_POST['partner_name'],
        "title"=>$_POST['partner_title'],
        "address"=>$_POST['partner_address'],
        "description"=>$_POST['partner_description'],
        "map_url"=>$_POST['map_url'],
		"partner_pic"=>$image,
		'product_gallery'=>$product_gallery,
		'product_videos'=>$product_videos);
		$data_json = json_encode($data);
		$api_url = $url."updateprofile";
	    }else{
	    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"user_id"=>$_SESSION['id'],
        "name"=>$_POST['partner_name'],
        "title"=>"partner_title",
        "address"=>$_POST['partner_address'],
        "description"=>$_POST['partner_description'],
        "map_url"=>$_POST['map_url'],
		"partner_pic"=>$image,
		'product_gallery'=>$product_gallery,
		'product_videos'=>$product_videos
		);
         $data_json = json_encode($data);
         $api_url = $url."profile";
		}     
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);print_r($response);exit;
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
            header("location:my-profile.php");
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
    <!-- Custom CSS -->
	<link href="css/fonts/css/fontawesome.css" rel="stylesheet">
    <link href="css/fonts/css/fa-brands.css" rel="stylesheet">
    <link href="css/fonts/css/fa-regular.css" rel="stylesheet">
    <link href="css/fonts/css/fa-solid.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
	
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
        <?php require_once("top.php"); ?>
        <?php require_once("left-sidebar.php"); ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">My Profile</li>
							
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title1 p-t9 flt-left p-l20">My Profile</h4>
							</div>
						</div>
                        <div class="card card-outline-info m-t20">
                            
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">First Name</label>
                                                    <input type="text"  class="form-control" placeholder="" name="first_name" id="first_name" value="<?php echo $name[0];?>"> 
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text"  class="form-control form-control-danger" placeholder="doe" id="last_name" name="last_name" value="<?php echo $name[1];?>">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" name="email"  id="email" class="form-control form-control-danger" placeholder=" Email comes here" value="<?php echo $partner->email;?>">
                                                    
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="phonenumber" id="phone" name="phone" class="form-control form-control-danger" placeholder="Phone Number comes here " value="<?php echo $partner->phone;?>">
                                                  </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Password</label>
                                                    <input type="Password" id="Password" name="password" class="form-control form-control-danger" placeholder=" Password comes here" >
                                                    
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Re Enter Password</label>
                                                    <input type="password" id="cpassword" name="cpassword" class="form-control form-control-danger" placeholder="Password comes here ">
                                                    
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        
                                        
                                        
                                        <!--/row-->
                                  </div>
									<div class="row">
										<div class="col-md-6">
											<div class="flt-left">
                                            <?php if($partner->image===""){ ?>
                                            <img src="assets/images/profile-pick.png"/>
											<?php }else{?>
												<img src='<?php echo $partner->image; ?>' width="115px" height="100px">
												<?php } ?>
                                            </div>
                                            <div class="revenue-fa flt-left p-t34 p-l20">
                                            <span> <input type="file" name="profile_pic" id="profile_pic" ></span>
                                            <div id="load"></div>
<!--                                            <span class="p-r10"><a href="edit-upload-image.php"><i class="fa fa-pencil lblue"></i></a></span>-->
                                           <!-- <span><a href="#" data-toggle="modal" data-target="#myTrash"><i class="fa fa-trash red"></i></a></span>-->
                                            </div>
										</div>
										<div class="col-md-6">
											<div class="form-actions text-right">
												<a href="#"><button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button></a>
												<a href="index.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                              </div>
										</div>
									</div>
                                </form>
                            </div>
                        </div>
                        
                        <div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title1 p-t9 flt-left p-l20">Partner Details</h4>
							</div>
						</div>
                         
                         <div class="card card-outline-info m-t20">
                            
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="form-body">
                                        
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Partner Name</label>
                                                    <input type="text"  class="form-control" name="partner_name" id="partner_name" value="<?php echo $user->Name;?>"> 
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Title</label>
                                                    <input type="text"  class="form-control form-control-danger" id="partner_title" name="partner_title" value="<?php echo $user->Title;?>">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                  <label class="m-b0">Address </label>
                                                  <textarea class="form-control" rows="4" id="partner_address" name="partner_address"><?php echo $user->Address;?></textarea>
                                                </div>
                                             </div>
                                            <!--/span-->
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                  <label class="m-b0">Short Discription </label>
                                                  <textarea class="form-control" rows="4" id="partner_description" name="partner_description"><?php echo $user->description;?></textarea>
                                                </div>
                                             </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                    </div>
									<div class="row">
										<div class="col-md-6">                                             
                                           <?php if($user->partner_pic!=""){ $image= $user->partner_pic;}else{ $image= "assets/images/background/user-info.jpg";}?>
											<div class="flt-left"><img src="<?php echo $image;?>" width="100px;"/></div>
                                            <div class="revenue-fa flt-left p-t34 p-l20">
                                                <span> <input type="file" name="partner_image" id="partner_image" ></span>
                                                <span> <img src="<?php $user->partner_pic;?>" ></span>

                                            </div>
										</div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                              <label class="control-label">Venue Location Map (url)</label>
                                              <input type="text" id="map_url" name="map_url"  class="form-control" value="<?php  echo $user->location; ?>">
                                              <small class="form-control-feedback"></small> </div>
                                        </div>
                                    </div>                                    <hr class="hr"/>
									<h4 class="card-title p-t10 p-b10">Gallery</h4>
									<div class="row gallery">
									
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
											
											<div>
                                            <h5 class="card-title p-t10 p-b10 m-b0">Photos</h5>
												<ul class="gallery">
                                                <?php 
											if(count($images)>0){
												$i=0;
											foreach($images as $image){   if($i<11){?>
												
                                                 <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="<?php echo $image;?>"  width="115px" height="100px" style="border-radius:10px 10px;margin-top:10px;">
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
												
										  <?php $i++;  }
										  }
											}else{
											
											
											?>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <div class="clear"></div>
                                                    <li style="width:300px;">
                                                     <div class="flt-left" style="width: 120px;">
													  <img src="assets/images/gallery-photo.jpg" class="img-responsive"/>
                                                     </div>
												     <div class="revenue-fa flt-left p-t34 p-l20" style="width: 100px;">
                                                       <input type="file" name="gallery[]" id="image1">
													   <div id="image_1"></div>
													 </div>
													</li>
                                                    <?php 
												}
													?>
												</ul>
											</div>
										</div>
										
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
										<h5 class="card-title p-t10 p-b10 m-b0">Videos</h5>
										<?php 
										if(count($videos_list>0)){
											
											$i=0;
										foreach($videos_list as $video){
											if($i<11){
											echo'<div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" value="'.$video.'" id="videolink1" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>';
											
											}$i++;
										}
										}else{
											
											//}else{
										
										?>
											<div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" id="videolink1" value="==" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
                                            <div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" id="videolink1" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
											<div class="alert alert-info">
												<button type="button"  class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text"  name="video[]"id="videolink2" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
											<div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text"  name="video[]" id="videolink2" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
                                            <div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" id="videolink2" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
                                            <div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" id="videolink2" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
                                            <div class="alert alert-info">
												<button type="button" class="close m-t5" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
												<div class="form-group">
													<input type="text" name="video[]" id="videolink2" class="form-control" placeholder="you tube video link comes here">
												</div>
											</div>
                                           
										</div>
                                         <?php } ?>
									</div>
                                    <input type='hidden' name='profile_id' id="profile_id" value="<?php echo $user->id;?>">
                                    <hr class="hr"/>
									<div class="form-actions text-right">
										<button type="submit"  name="profile" id="profile" value="save" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
										<a href="index.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                
                
				<!-- Modal -->
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
            <!--<div id="footer">
                <footer>
                    <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                </footer>
            </div>-->
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
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <!----------------------image thumbnail------------------>

<script type="text/javascript">
$(function() {
    $("#uploadFile").on("change", function()
    {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                $("#imagePreview").css("background-image", "url("+this.result+")");
            }
        }
    });
});
</script>
    <!--------------------thumb nail end---------------------->
</body>

</html>
<script>
 
$(document).ready(function(){    
    $(document).on('change',"#image_1",function(){
        alert('change'); 
		//readURL(this,"image1");
    });
	$(document).on("change","#profile_pic",function(){
				readURL(this);		
		});  
		
		function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#load').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    		
	});
</script>