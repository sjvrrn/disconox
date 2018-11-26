<?php
error_reporting(0);
/*edit artist*/
require_once("header.php");
/*Array ( [id] => 1 [name] => narayana.. [email] => admin@gmail.com [phone] => 8985740222 [address] => [password] => [role] => 4 [image] => [status] => 0
[created] => 2018-02-25 12:06:24 [user_id] => 31 [specialization] => specialization.. [experience] => 8 [description] => description.... ) */
if(isset($_GET['ea'])){
    $user_id = base64_decode($_GET['ea']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$user_id
    );
    $data_json = json_encode($data);
    $ud = $url."artistDetails";
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
            $artist = $responsObj['artistDetails'];
        }
    }
    curl_close($ch);
}
/*delete artist*/
if(isset($_GET['da'])){
    $user_id = base64_decode($_GET['da']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$user_id
    );
    $data_json = json_encode($data);
    $ad = $url."artistDelete";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ad);
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
		   header("location:artists.php");
        }
    }
    curl_close($ch);
}
//form submit
if(isset($_POST['submit'])){
    /*start*/
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
	
    if(isset($_GET['ea'])){
			$userid = base64_decode($_GET['ea']);
			$data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "userid"=>$userid,
            "name"=>$_POST["name"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "spec"=>$_POST["specialization"],
            "exp"=>$_POST["experience"],
            "desc"=>$_POST["description"],
			"image"=>$target_path
        );
		$ca = $url."artistUpdate";
	}else{
		        $data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "name"=>$_POST["name"],
            "phone"=>$_POST["phone"],
            "email"=>$_POST["email"],
            "spec"=>$_POST["specialization"],
            "exp"=>$_POST["experience"],
            "desc"=>$_POST["description"],
			"images"=>$target_path,
             "role"=>4
        );
		$ca = $url. "add_artist";
		}
    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ca);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch); print_r($response); exit;
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
            if(isset($_GET['ea'])){
                header("location:create-artist.php?ea=".$_GET['ea']);
            }else{
                header("location:artists.php");
            }

        }
    }
    curl_close($ch);
    /*end*/
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<?php require_once ("header.php");?>
</head>
<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/disco-logo.png"/> </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                                            <div class="u-text">
                                                <h4>Steave Jobs</h4>
                                                <p class="text-muted">varun@gmail.com</p><a href="my-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="my-profile.html"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="my-balance.html"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php require_once ("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Artist</li>
							<li class="breadcrumb-item active">Create/Edit Artist</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
						
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title m-b20">Edit/Create New Artist</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
								<a href="artists.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">Back</button></a>
							</div>
						</div>
                        <div class="card card-outline-info m-t20">
                            <div class="card-body">
                                <form action="" method="post" enctype="multipart/form-data" >
                                    <div class="form-body">
                                        <div class="row p-t-20">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Artist Name</label>
                                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $artist['name']; ?>" required>
                                                    </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="number"  id="phone" name="phone" class="form-control form-control-danger" value="<?php echo $artist['phone']; ?>"required>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control form-control-danger" value="<?php echo $artist['email']; ?>" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label class="control-label">Specialization (ex: DJ, Singer,,,etc)</label>
                                                    <input type="text" id="specialization" name="specialization" class="form-control form-control-danger" value="<?php echo $artist['specialization']; ?>" required>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label>Experience</label>
                                                    <select class="form-control custom-select" name="experience" id="experience" required>
                                                        <option>Select</option>
                                                        <option <?php if($artist['experience']==1){ echo"selected";} ?>>1</option>
                                                        <option <?php if($artist['experience']==2){ echo"selected";} ?>>2</option>
                                                        <option <?php if($artist['experience']==3){ echo"selected";} ?>>3</option>
                                                        <option <?php if($artist['experience']==4){ echo"selected";} ?>>4</option>
                                                        <option <?php if($artist['experience']==5){ echo"selected";} ?>>5</option>
                                                        <option <?php if($artist['experience']==6){ echo"selected";} ?>>6</option>
                                                        <option <?php if($artist['experience']==7){ echo"selected";} ?>>7</option>
                                                        <option <?php if($artist['experience']==8){ echo"selected";} ?>>8</option>
                                                        <option <?php if($artist['experience']==9){ echo"selected";} ?>>9</option>
                                                        <option <?php if($artist['experience']>=10){ echo"selected";} ?>>10 + Years</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group p-t20">
												<label>About Artist(minimum 250 words)</label>
                                                    <textarea class="form-control" rows="5" name="description" id="description" maxlength="	250"><?php echo $artist['description']; ?></textarea>
											</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
										<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
										    <p>Profile pic</p>
                                            <?php 
																						?>
                                            
											<div class="search-pic"><input type="file" name='images' id='images' ></div>
											<div class="text-center revenue-fa m-t10">
												<span class="p-r10"><a href="profile-pick-edit.html?ei=<?php echo base64_encode($artist['id']); ?>"><i class="fa fa-pencil lblue"></i></a></span>
												<span><a href="profile-pick-edit.html?di=<?php echo base64_encode($artist['id']); ?>"><i class="fa fa-trash red"></i></a></span>
											</div>
										</div>
										<!--<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
										    <p>Profile banner</p>
											<div class="post-pic"><img src="assets/images/search-res-pic.jpg" class="img-responsive"/></div>
											<div class="text-center revenue-fa m-t10">
												<span class="p-r10"><a href="profile-pick-edit.html"><i class="fa fa-pencil lblue"></i></a></span>
												<span><a href="#" data-toggle="modal" data-target="#myTrash"><i class="fa fa-trash red"></i></a></span>
											</div>
										</div>-->
									</div>
									<div class="row">
										<div class="col-md-6">
										</div>
										<div class="col-md-6">
											<div class="form-actions text-right">
                                                <button type="submit" name="submit" id="submit" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                                                <button type="reset" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button>
                                                </div>
										</div>
										
									</div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<div id="myTrash" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header text-right">
      </div>
      <div class="modal-body">
	  <button type="button" class="close " data-dismiss="modal">×</button>
        <p>You Want To Delete? </p>
        <p>&nbsp;</p>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">YES</button></a>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-danger">NO</button></a>
      </div>
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
    <?php require_once ("footer.php");?>
</body>

</html>
