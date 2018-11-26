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
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <?php 
  require_once("header.php");
  if(!isset($_SESSION['id'])){
   header("location:index.php");
   }
  include("db.php");
  $uid = $_SESSION['id'];
  ?>
</head>
<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once("top.php"); ?>
  <!-- END: HEADER -->

  <!-- BEGIN: PAGE CONTAINER -->
  <div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image: url(assets/images/note-bg.jpg)">
      <div class="container">
        <div class="c-page-title">
          <p class="c-font-white">Booking History</p>
        </div>
      </div>
      <div class="ac-nav">
        <div class="container">
          <a href="profile-settings.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Profile Settings</a>
          <a href="booking-history.php" class="btn btn-xs c-btn-green c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Booking History</a>
          <a href="notifications.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Notifications</a>
          <a href="receipts.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Receipts</a>
        </div>
      </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->
<?php
/*$sql="SELECT * FROM product_orders where uid=$uid AND status='success'";
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
*/
/* Booking History */
$uid = $_SESSION['id'];
$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>$uid
           );
		$data_json = json_encode($data);
		
	    $ud = $url."bookingHistoryDetails";
		
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
				
				$Booking_count = $responsObj['Booking_count'];
				$message = $responsObj['message'];
            } else {
				echo 'test2';
                $rec = $responsObj['BookingDetails'];
                $Booking_count = $responsObj['Booking_count'];
				$message = $responsObj['message'];
                 
                //header("location:".$_SERVER['PHP_SELF']);
            }
            curl_close($ch);
			
        }
/* End Booking History */


?>
    <div class="c-content-box c-size-md c-bg-white">
      <div class="container-fluid">
        <div class="row">
          <p> You done <span class="c-gold"><b><?php echo $Booking_count; ?></b></span> Bookings</p>
          <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-font-bold">Booking History</h3>
          </div>
        </div>
        <div class="row c-margin-b-40 c-order-history-2">
          <div class="row c-cart-table-title">
            <div class="col-md-2 c-cart-image">
              <h3 class="c-font-uppercase c-font-bold c-font-16 c-font-grey-2">Date</h3>
            </div>
            <div class="col-md-1 c-cart-ref">
              <h3 class="c-font-uppercase c-font-bold c-font-16 c-font-grey-2">Order</h3>
            </div>
            <div class="col-md-3 c-cart-desc">
              <h3 class="c-font-uppercase c-font-bold c-font-16 c-font-grey-2">Description</h3>
            </div>
            <div class="col-md-2 c-cart-price">
              <h3 class="c-font-uppercase c-font-bold c-font-16 c-font-grey-2">Price</h3>
            </div>
            <div class="col-md-2 c-cart-qty">
              <h3 class="c-font-uppercase c-font-bold c-font-16 c-font-grey-2">Receipt</h3>
            </div>
          </div>
          <!-- BEGIN: ORDER HISTORY ITEM ROW -->
          <?php
		  if($Booking_count > 0)
		  {
				 echo '<div class="row c-cart-table-row">
					  <h2 class="c-font-uppercase c-font-bold c-theme-bg c-font-white c-cart-item-title c-cart-item-first">Item 1</h2>
					  <div class="col-md-2 col-sm-3 col-xs-5 c-cart-image">
						<p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Date</p>
						<p>'.$rec["createdAt"].'</p>
					  </div>
					  <div class="col-md-1 col-sm-3 col-xs-6 c-cart-ref">
						<p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Order</p>
						<p>#'.$rec["id"].'</p>
					  </div>
					  <div class="col-md-3 col-sm-6 col-xs-6 c-cart-desc">
						<p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Description</p>
						<p>
						  <a href="#" class="c-theme-link c-font-dark">'.$rec["product_name"].'</a>
						</p>
					  </div>
					  <div class="clearfix col-md-2 col-sm-3 col-xs-6 c-cart-price">
						<p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Price</p>
						<p class="c-cart-price c-font-bold"><i class="fa fa-inr mar-r-10"></i>'.$rec["price"].'</p>
					  </div>
					  <div class="col-md-2 col-sm-3 col-xs-6 c-cart-qty">
						<p class="c-cart-sub-title c-theme-font c-font-uppercase c-font-bold">Receipt</p>
						<p><a href="receipts.php">View Receipt</a>
					  </div>
					</div>';
             
			 }
			 else
			 {
			 ?>
			 <div class="c-content-box c-size-md c-bg-white">
			  <div class="container">
				<div class="row">
				 
				  <div class="c-content-panel">
					<div class="c-body">
					  No Bookings Found
					</div>
				  </div>
				</div>
			  </div>
             </div>
			 <?php
			 }
			?>

            <!-- END: ORDER HISTORY ITEM ROW -->
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