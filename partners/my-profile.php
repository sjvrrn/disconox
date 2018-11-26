<?php
error_reporting(0);
session_start();
if (isset($_GET['id'])) {
    $_SESSION['id'] = base64_decode($_GET['id']);
    $encodeid       = base64_encode($_SESSION['id']);
}
require_once("header.php");
require_once("../db.php");
if (isset($_GET['profileid'])) {
    $_SESSION['profile_id'] = base64_decode($_GET['profileid']);
    $profileID              = $_SESSION['profile_id'];
    $encodeprofileid        = base64_encode($profileID);
}
//user Details
if (!isset($_POST['submit']) && (isset($_SESSION['id']))) {
    $data      = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "userid" => $_SESSION['id']
    );
    $data_json = json_encode($data);
    $url1      = $url . "userDetails";
    $ch        = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url1);
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
            $partner = (object) $responsObj['UserDetails'];
            $name    = explode('-', $partner->name);
            //$address = explode(",",$partner->address);
            //$_SESSION['id'] = $partner->id;
            
            $_SESSION['image'] = $partner->image;
        }
        curl_close($ch);
    }
    $data      = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "userid" => $_SESSION['id']
    );
    $data_json = json_encode($data);
    $ud        = $url . "getProfile";
    $ch        = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ud);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch); //print_r($response); exit;
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        
        $responsObj = json_decode($response, TRUE);
        
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $user = (object) $responsObj['profileDetails'];
            
            $_SESSION['profile_id'] = $user->id;
            $user->booking_days;
            $booking_days         = explode(',', $user->booking_days);
            $facilities           = $user->facilities;
            $dress_code           = $user->dress_code;
            $music_genre          = $user->music_genre;
            $booking_time         = $user->booking_time;
            $images               = explode(',', $user->images);
            $videos_list          = explode(',', $user->videos);
            $imageids             = explode(',', $user->imageids);
            $videoids             = explode(',', $user->videoids);
            $cuisines             = $user->cuisines;
            $avg_cost             = $user->avg_cost;
            $start_time           = $user->start_time;
            $end_time             = $user->end_time;
            $menu                 = $user->menu;
            $partner_instructions = $user->partner_instructions;
            $artist_name          = $user->artist_name;
            $artist_pic           = $user->artist_path;
			$Title                = $user->Title; 
        }
        curl_close($ch);
    }
}
//end

//update user details
if (isset($_POST['submit'])) {
    /*image start*/
    $partner_id      = base64_encode($_SESSION['id']);
    $encodeprofileid = base64_encode($_SESSION['profile_id']);
    if ($_POST['password'] == $_POST['cpassword']) {
        $target_path     = "assets/uploads/";
        $validextensions = array(
            "jpeg",
            "jpg",
            "png"
        );
        $ext             = explode('.', basename($_FILES['partner_pic']['name']));
        $file_extension  = end($ext);
        $target_path     = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
        if (($_FILES["partner_pic"]["size"] < 10000000) && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['partner_pic']['tmp_name'], $target_path)) {
                $image = $target_path;
                
            } else {
                
            }
        } else {
            
        }
        /*image end*/
        if ($_POST['password'] == $_POST['cpassword']) {
            
            $data      = array(
                "clientId" => "x6DmrbsQFZyUUiggs0BZ",
                "userid" => $_SESSION['id'],
                "name" => $_POST['first_name'] . '-' . $_POST["last_name"],
                "address" => "",
                "password" => $_POST['password'],
                "phone" => $_POST['phone'],
                "image" => $image
            );
            $data_json = json_encode($data);
            $uu        = $url . "userUpdate";
            $ch        = curl_init();
            curl_setopt($ch, CURLOPT_URL, $uu);
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
                    
                    $message = $responsObj['results'];
                    echo "<script type='text/javascript'>
        //alert('$message');
        //window.location='my-profile.php';
        
        window.location='my-profile.php?id=$partner_id&profileid=$encodeprofileid';
        </script>";
                    
                    
                    // header("location:my-profile.php");
                    
                    
                }
            }
            curl_close($ch);
            
        } else {
            echo "<script type='text/javascript'>
        alert('Passwords do no match');
        </script>";
        }
    } else {
        
        echo "<script type='text/javascript'>
        
        alert('Passwords do no match');
        window.location='my-profile.php?id=$partner_id';
        
        </script>";
        
    }
    //singup end
}
//submit partner profile
if (isset($_POST['profile_img_vid'])) {
    
    
    $j           = 0;
    $gallery     = array();
    $imageType   = array();
    $image_array = array();
    for ($i = 0; $i < count($_FILES['gallery']['name']); $i++) {
        //if($_FILES['gallery']['name'][$i] !==""){ array_push($image_array,$imageids[$i]); }
        $target_path     = "assets/uploads/";
        $validextensions = array(
            "jpeg",
            "jpg",
            "png"
        );
        $ext             = explode('.', basename($_FILES['gallery']['name'][$i]));
        $file_extension  = end($ext);
        $target_path     = $target_path . $ext[0] . rand(1, 999999999999) . "." . $ext[count($ext) - 1];
        $j               = $j + 1;
        if (($_FILES["gallery"]["size"][$i] < 10000000) && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['gallery']['tmp_name'][$i], $target_path)) {
                $gallery[$i]   = $target_path;
                $imageType[$i] = $file_extension;
                
            } else {
                echo $j . ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
    
    
    $product_gallery = $gallery;
    
    $videoids       = 1;
    $product_videos = $_POST['videolink'];
    
    $Profile_ID = $_POST['profile_id'];
    if (count($product_videos) > 0) {
        for ($k = 0; $k < count($product_videos); $k++) {
            
            $sql = "insert into product_videos(pid,url) value($Profile_ID,'" . $product_videos[$k] . "')";
            $res = mysqli_query($con, $sql);
            
            
        }
        $product_videos = "";
    }
    if (count($product_gallery) > 0) {
        for ($h = 0; $h < count($product_gallery); $h++) {
            
            $sql  = "insert into product_images(pid,image,    type) values($Profile_ID,'" . $product_gallery[$h] . "','" . $imageType[$h] . "')";
            $resg = mysqli_query($con, $sql);
            
        }
        $product_gallery = "";
    }
    echo "<script type='text/javascript'>
        alert('Post Successfully.');
        window.location='my-profile.php';
        </script>";
}
if (isset($_POST['profile'])) { 
    /*menu upload*/
    $target_path     = "assets/uploads/";
    $validextensions = array(
        "jpeg",
        "jpg",
        "png"
    );
    $ext             = explode('.', basename($_FILES['menu']['name']));
    $file_extension  = end($ext);
    $target_path     = $target_path . $ext[0] . rand(10, 100) . "." . $ext[count($ext) - 1];
    // $j = $j + 1;
    if (($_FILES["menu"]["size"] < 10000000) && in_array($file_extension, $validextensions)) {
        if (move_uploaded_file($_FILES['menu']['tmp_name'], $target_path)) {
            $menu_path = $target_path;
            
        } else {
            
        }
    } else {
    }
    /*menu upload end*/
    /*artist pic*/
    $target_path     = "assets/uploads/";
    $validextensions = array(
        "jpeg",
        "jpg",
        "png"
    );
    $ext             = explode('.', basename($_FILES['artist_pic']['name']));
    $file_extension  = end($ext);
    $target_path     = $target_path . $ext[0] . rand(10, 100) . "." . $ext[count($ext) - 1];
    // $j = $j + 1;
    if (($_FILES["artist_pic"]["size"] < 10000000) && in_array($file_extension, $validextensions)) {
        if (move_uploaded_file($_FILES['artist_pic']['tmp_name'], $target_path)) {
            $artist_path = $target_path;
            
        } else {
            
        }
    } else {
        
    }
    /*end*/
    /*partner_pic upload*/
    $target_path1     = "assets/uploads/";
    $validextensions1 = array(
        "jpeg",
        "jpg",
        "png"
    );
    $ext1             = explode('.', basename($_FILES['partner_image']['name']));
    $file_extension1  = end($ext1);
    $target_path1     = $target_path1 . $ext1[0] . rand(10, 100) . "." . $ext1[count($ext1) - 1];
    $j                = $j + 1;
    if (($_FILES["partner_image"]["size"] < 10000000) && in_array($file_extension1, $validextensions1)) {
        if (move_uploaded_file($_FILES['partner_image']['tmp_name'], $target_path1)) {
            $partner_pic_path = $target_path1;
            
        } else {
            
        }
    } else {
        
    }
   $_SESSION['profile_id']; 
    if ($_SESSION['profile_id'] != "") { 
        
        $data      = array(
            "clientId" => "x6DmrbsQFZyUUiggs0BZ",
            "user_id" => $_SESSION['id'],
            "profile_id" => $_SESSION['profile_id'],
            "name" => $_POST['partner_name'],
            "title" => implode(",",$_POST['partner_title']),
            "address" => $_POST['partner_address'],
            "description" => $_POST['partner_description'],
            "map_url" => $_POST['map_url'],
            "partner_pic" => $partner_pic_path,
            "facilities" => $_POST['facilities'],
            "dress_code" => $_POST['dress_code'],
            "music_genre" => $_POST["music_genre"],
            "cuisines" => $_POST['cuisines'],
            "avg_cost" => $_POST['avg_cost'],
            "menu" => $menu_path,
            "partner_instructions" => $_POST['partner_instructions'],
            "artist_name" => $_POST['artist_name'],
            "artist_path" => $artist_path
        );
        $data_json = json_encode($data);  //print_r($data_json); die;  
        $api_url   = $url . "updateprofile";
        
    } 
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
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
            
        } else {
            $message         = $responsObj['results'];
            $encodeid        = base64_encode($_SESSION['id']);
            $encodeprofileid = base64_encode($_SESSION['profile_id']);
            echo "<script type='text/javascript'>
        alert('$message');
        window.location='my-profile.php?id=$encodeid&profileid=$encodeprofileid';
        </script>";
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
<script src="http://localhost/disconox/partners/assets/plugins/jquery/jquery.min.js"></script>
<!---map start---->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<link href="assets/plugins/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>

<script>

$(document).ready(function(){
    $("#my-address").blur(function(){    
        codeAddress();
    });
});
</script>
    
    <script type="text/javascript">
        function initialize() {
        var address = (document.getElementById('my-address')); //alert(address); 
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
      });
}
function codeAddress() {
    geocoder = new google.maps.Geocoder();
    var address = document.getElementById("my-address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {

      alert("Latitude: "+results[0].geometry.location.lat());
      alert("Longitude: "+results[0].geometry.location.lng());
      var latlang = results[0].geometry.location.lat()+','+results[0].geometry.location.lng();
     // alert(latlang);
      $("#maplatlang").val(latlang);
      } 

	else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  
google.maps.event.addDomListener(window, 'load', initialize);
}
        </script>
<!---map end----->


<style>
#imageupload{
    //display:none;
}
</style>
<script>
$(document).ready(function(){  
 
    $(document).on('change',"#image_1",function(){
      //  alert('change'); 
        //readURL(this,"image1");
    });
    $(document).on("change","#partner_pic",function(){
        
        
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

</head>

<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php
require_once("top.php");
?>
       <?php
require_once("left-sidebar.php");
?>
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
                                    <h4 class="m-t-0 text-info">$0</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$0</h4></div>
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
                                                    <input type="text"  class="form-control" placeholder="" name="first_name" id="first_name" value="<?php
echo $name[0];
?>"> 
                                                    </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name</label>
                                                    <input type="text"  class="form-control form-control-danger" placeholder="doe" id="last_name" name="last_name" value="<?php
echo $name[1];
?>">
                                                    </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input type="email" name="email" disabled  id="email" class="form-control 
                                                    form-control-danger" placeholder=" Email comes here" value="<?php
echo $partner->email;
?>">
                                                    
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="phonenumber" id="phone" name="phone" class="form-control form-control-danger" placeholder="Phone Number comes here " value="<?php
echo $partner->phone;
?>">
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="flt-left">
                                            <?php
if ($partner->image == "") {
?>
                                           <img src="assets/images/profile-pick.png" id="load" width="115px" height="100px"/>
                                            <?php
} else {
?>
                                               <img src='<?php
    echo $partner->image;
?>' " width="115px" height="100px">
                                                <?php
}
?>
                                           </div>
                                            <div class="revenue-fa flt-left p-t34 p-l20">
                                            <span> <input type="file" name="partner_pic" id="partner_pic" ></span>
                                            <div ></div>
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
                                <input type="text"  class="form-control" name="partner_name" id="partner_name" value="<?php
echo $user->Name;
?>"> 
                                </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <!--<div class="form-group">
                                <label class="control-label">Title</label>
                                  <select class="form-control"  name="partner_title" id="partner_title">
									<option value="bars" <?php if($user->Title=="bars"){ echo"selected";} ?>>Bars</option>
									<option value="casualdining" <?php if($user->Title=="casualdining"){ echo"selected";} ?>>Casual Dining</option>
									<option value="lounges"<?php if($user->Title=="lounges"){ echo"selected";} ?>>Lounges</option>
									<option value="clubs"<?php if($user->Title=="clubs"){ echo"selected";} ?>>Clubs</option>
									<option value="pubs"<?php if($user->Title=="pubs"){ echo"selected";} ?>>Pubs</option>
									<option value="microbreweries"<?php if($user->Title=="microbreweries"){ echo"selected";} ?>>Microbreweries</option>
									<option value="cafes"<?php if($user->Title=="cafes"){ echo"selected";} ?>>Cafes</option>
									<option value="finedining"<?php if($user->Title=="finedinings"){ echo"selected";} ?>>Fine Dining</option>
								  </select>
                                </div>-->
								<?php $Title = explode(',',$user->Title);?>
								 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                <label class="control-label">Title</label>
                                <div class="input-group">
                                <select name='partner_title[]' class="form-control" id="multi" multiple>
             <option value="bars" <?php if (in_array("bars", $Title)) {echo "selected";}?>>Bars</option>
              <option value="casualdining" <?php if (in_array("casualdining", $Title)) {echo "selected";}?>>CasualDining</option>
              <option value="lounges" <?php if (in_array("lounges", $Title)) {echo "selected";}?>>Lounges</option>
			  <option value="clubs" <?php if (in_array("clubs", $Title)) { echo "selected";} ?>>Clubs</option>
			  <option value="pubs" <?php if (in_array("pubs", $Title)) { echo "selected";} ?>>Pubs</option>
			  <option value="microbreweries" <?php if (in_array("microbreweries", $Title)) { echo "selected";} ?>>Microbreweries</option>
			  <option value="cafes" <?php if (in_array("cafes", $Title)) { echo "selected";}?>>Cafes</option>
			  <option value="finedining" <?php if (in_array("finedining", $Title)) { echo "selected";}?>>FineDining</option>
                                </select>
                                </div>
                              </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label class="m-b0">Address </label>
                              <textarea class="form-control" rows="4" id="partner_address" name="partner_address"><?php
echo $user->Address;
?></textarea>
                            </div>
                         </div>
                        <!--/span-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                              <label class="m-b0">Short Description </label>
                              <textarea class="form-control" rows="4" id="partner_description" name="partner_description"><?php
echo $user->description;
?></textarea>
                            </div>
                         </div>
                        <!--/span-->
                    </div>
                     <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">facilities</label>
                                <input type="text" name="facilities"  id="facilities" class="form-control form-control-danger" placeholder=" " value="<?php
echo $facilities;
?>">
                                
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Dress Code</label>
                                <input type="text" id="dress_code" name="dress_code" class="form-control form-control-danger" placeholder=" " value="<?php
echo $dress_code;
?>">
                              </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Music Genre</label>
                                <input type="text" name="music_genre"  id="music_genre" class="form-control form-control-danger" placeholder=" " value="<?php
echo $music_genre;
?>">
                                
                            </div>
                        </div>
                        <!--/span-->
                          <input type="hidden" id="maplatlang" name="map_url"  class="form-control" value="<?php
echo $user->location;
?>">
                        <!--/span-->
                    <!--/span-->
                         <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Venue Location Map (url)</label>
                          <input type="text" id="my-address"   name='address' class="form-control" value="<?php
echo $user->location;
?>">
                          <small class="form-control-feedback"></small> </div>
                    </div>
                        <!--/span-->    
                        
                    </div>
                    <!--/row-->
                    <!-----row----->  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">cuisines</label>
                                <input type="text" name="cuisines"  id="cuisines" class="form-control form-control-danger" placeholder=" " value="<?php
echo $cuisines;
?>">
                                
                            </div>
                        </div>
                        <!--/span-->
                         <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Average Cost</label>
                          <input type="text" id="avg_cost" name="avg_cost"  class="form-control" value="<?php
echo $avg_cost;
?>">
                          <small class="form-control-feedback"></small> </div>
                    </div>
                        <!--/span-->
                    </div>
                <!----row---->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Start Time</label>
                                   <input  type='text' class="form-control"  id="startTimeTextBox" name="start_time" placeholder="Check time"  value="<?php
echo $start_time;
?>">
                                  <small class="form-control-feedback"></small> </div>
                            </div>
                        <!--/span-->
                         <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">End Time</label>
                          <input  type="text" class="form-control" id="endTimeTextBox" name="end_time" placeholder="Check time" value="<?php
echo $end_time;
?>">
                          <small class="form-control-feedback"></small> </div>
                    </div>
                        <!--/span-->
                    </div>
                <!-----row----->
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Terms & Conditions</label>
                                  <textarea class="form-control" rows="4" id="partner_instructions" name="partner_instructions"><?php
echo $partner_instructions;
?></textarea>
                            </div>
                        </div>
                        <!--/span-->
                         <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">In House Artist</label>
                          <input type="text" id="artist_name" name="artist_name"  class="form-control" value="<?php
echo $artist_name;
?>">
                          <small class="form-control-feedback"></small> </div>
                    </div>
                        <!--/span-->
                    </div>
                <!-----row----->  
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label class="control-label">Partner Pic</label>
                <?php
if ($user->partner_pic != "") {
    $Partnerimage = $user->partner_pic;
} else {
    $Partnerimage = "assets/images/background/user-info.jpg";
}
?>
               <div class="flt-left" id="partner_image" ><img id="partner_image" src="<?php
echo $Partnerimage;
?>" width="100px;" /></div>
                <input type="file" name="partner_image"  id="partner_image" class="form-control form-control-danger" >
                <span> <img src="<?php$user->partner_pic;?>" ></span>
                </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                <div class="form-group">
                <label class="control-label">Menu Upload</label>
                <?php
if ($menu != "") {
    $menuimage = $menu;
} else {
    $menuimage = "assets/images/background/user-info.jpg";
}
?>
               <div class="flt-left" id="profile_image" ><img id="profile_picture" src="<?php
echo $menuimage;
?>" width="100px;" /></div>
                <input type="file" id="menu" name="menu" class="form-control form-control-danger" placeholder="Phone Number comes here " value="<?php //echo $dress_code;
?>"> </div>
                </div>
                <!--/span-->
                </div>
                <!--/row-->
                <!-----/row----->
                <!-----row----->  
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                <label class="control-label">Artist Pic</label>
                <?php
if ($artist_pic != "") {
    $artist_pic = $artist_pic;
} else {
    $artist_pic = "assets/images/background/user-info.jpg";
}
?>
               <div class="flt-left" id="artist_pic" ><img id="artist_pic" src="<?php
echo $artist_pic;
?>" width="100px;" /></div>
                <input type="file" name="artist_pic"  id="artist_pic" class="form-control form-control-danger" >
                <!--<span> <img src="<?php //echo  $artist_pic;
?>" ></span>-->
                </div>
                </div>
                <!--/span--
                
                <!--/span-->
                </div>
                                        
                <div class="form-actions text-right">
                <button type="submit"  name="profile" id="profile" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                <a href="index.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
                </div>
</form>
 <!--/row-->
 <form action="" method="post" enctype="multipart/form-data">
                            <h4 class="card-title p-t10 p-b10">Gallery</h4>
                            <div class="table-responsive">
                            <h5 class="card-title p-t10 p-b10 m-b0">Photos</h5>
                            <table class="table table-bordered" id="dynamic_field">
                            <?php

if (count($images) > 0 && count(array_flip($images)) > 1) {
    foreach ($images as $image) {
?>            
                            <tr>
                                <div class="flt-left" style="width: 120px;">
                                <img src="<?php
        echo $image;
?>"  width="115px" height="100px" style="border-radius:10px 10px;margin-top:10px;">
                                </div>
                                
                            </tr>
                            <?php
    }
}
?>
                           <tr>
                                <td><input type="file" name="gallery[]" id="gallery" placeholder="Enter your Name" class="form-control name_list" />
                                <div id="image_1"></div></td>
                                <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                            </tr>
                            
                            </table>
                            <h5 class="card-title p-t10 p-b10 m-b0">Videos</h5>
                            <table class="table table-bordered" id="dynamic_field_vid">
                            <?php

if (count($videos_list) > 0 && count(array_flip($videos_list)) > 1) {
    $i = 1;
    foreach ($videos_list as $video) {
        echo "S.No <a href='$video' target='_blank'>TLink" . $i . "</a>";
        echo "<br>";
        
?>
                                 
                                
                            <?php
        $i++;
    }
}
?>
                           <tr>
                                <td><input type="text" name="videolink[]" id="videolink" placeholder="Enter your youtube link here" class="form-control name_list" />
                                <div id="image_1"></div></td>
                                <td><button type="button" name="addvid" id="addvid" class="btn btn-success">Add More</button></td>
                            </tr>
                            
                        </table>
                        
                 <input type='hidden' name='profile_id' id="profile_id" value="<?php
echo $_SESSION['id'];
?>">
                        <hr class="hr"/>
                        <div class="form-actions text-right">
                            <button type="submit"  name="profile_img_vid" id="profile_img_vid" value="save" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button>
                            <a href="index.php"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a>
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
</body>
</html>

<?php
require_once("footer.php");
?>
<script>
$(document).ready(function(){
    $("#partner_image").click(function(e){
        
            e.preventDefault();
         $.ajax({
        url: "imageupload/index.php" + '?type=ajax', success: function (data) { 
            $('#imageupload').html(data);
            //$("#change-profile-pic")
            $('#profile_pic_modal').modal({show:true}); 
        
        }
    });
    });
    
    
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      // $('#multi-select-demo').multiselect();
    });
</script>    

<!--<script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>-->
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
<script>
$(document).ready(function(){
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" name="gallery[]" id="gallery" placeholder="upload" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    $('#submit').click(function(){        
        $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_name').serialize(),
            success:function(data)
            {
                
                $('#add_name')[0].reset();
            }
        });
    });
    
});

$(document).ready(function(){
    var i=1;
    $('#addvid').click(function(){
        i++;
        $('#dynamic_field_vid').append('<tr id="row'+i+'"><td><input type="text" name="videolink[]" id="videolink" placeholder="Enter your youtube link here" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
    });
    
    $(document).on('click', '.btn_remove', function(){
        var button_id = $(this).attr("id"); 
        $('#row'+button_id+'').remove();
    });
    
    $('#submit').click(function(){        
        $.ajax({
            url:"name.php",
            method:"POST",
            data:$('#add_name').serialize(),
            success:function(data)
            {
                
                $('#add_name')[0].reset();
            }
        });
    });
    
});
</script>

<script src="js/jquery-ui.js"></script>
<script src="js/jquery-ui-timepicker-addon.js"></script>    
<script>
//
//start time end time 
  $(function(){ 
    $('#startTimeTextBox').timepicker({
        timeFormat: 'hh:mm tt'
    });
    
    $('#endTimeTextBox').timepicker({
        timeFormat: 'hh:mm tt'
    });
/*
 *For Multi Select
 */	
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
//end
 //partner-title multi select
  $('#multi').multipleSelect({
            isOpen: true,
            keepOpen: true
        });
		});
$('#partner_title').multiselect({
    columns: 2,
    placeholder: 'Select options'
});
  </script>
<script type="text/javascript" src="js/jquery.multi-select.js"></script>
<script type="text/javascript">
$(function(){
    $('#multi').multiSelect();
});
</script>
  <?php
$con->close();
?>