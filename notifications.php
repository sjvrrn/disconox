<?php
require_once("header.php");
if(!isset($_SESSION['id'])){
header("location:index.php");
}
$data  = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "userid"=>$_SESSION['id']
    );
    $data_json = json_encode($data);
	
    $url = $url."userNotifications";
	
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
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
            
			$notification = $responsObj['message'];
			$NotificaitonsCount = $responsObj['NotificaitonsCount'];
			
        } else {
            $message = $responsObj['message'];
			$NotificaitonsCount = $responsObj['NotificaitonsCount'];
			$notifications = $responsObj['NotificaitonsDetails'];
foreach($notifications as $notification){
	
$notification .='<div class="alert alert-warning alert-dismissible" role="alert"> '.$notifications->notification.'.
                                <a class="c-font-slim" href="#">View</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>';
						
	}
	

        }
    }
    curl_close($ch);
//singup end
?>
<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
  <meta charset="utf-8" />
  <title>DISCONOX</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description" />
  <meta content="" name="author" />
  <link rel="shortcut icon" href="favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet" />
</head>
<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once('top.php');?>
  <!-- END: HEADER -->
  <!-- BEGIN: PAGE CONTAINER -->
  <div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(assets/images/note-bg.jpg)">
      <div class="container">
        <div class="c-page-title">
          <p class="c-font-white">Notifications</p>
        </div>
      </div>
      <div class="ac-nav">
        <div class="container">
          <a href="profile-settings.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Profile Settings</a>
          <a href="booking-history.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Booking History</a>
          <a href="notifications.php" class="btn btn-xs c-btn-green c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Notifications</a>
          <a href="receipts.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Receipts</a>
        </div>
      </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->
    <div class="c-content-box c-size-md c-bg-white">
      <div class="container">
        <div class="row">
          <p> You have <span class="c-gold"><b>
		  <?php if($NotificaitonsCount == 0){ echo $NotificaitonsCount; }?></b></span> Notifications</p>
          <div class="c-content-panel">
            <div class="c-body">
              <?php if(isset($notification)){ echo $notification; }?>
              <!-- <div class="alert alert-danger alert-dismissible" role="alert"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
                  <a class="c-font-slim" href="#">try submitting again</a>.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END: PAGE CONTENT -->
  </div>
  <!-- END: PAGE CONTAINER -->
  <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
  <?php require_once('footer.php');?>
</body>
</html>