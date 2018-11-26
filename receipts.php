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
<?php 
require_once("header.php");
/* Receipts API */
$uid = $_SESSION['id'];
$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "userid"=>$uid
           );
		$data_json = json_encode($data);
		
	    $ud = $url."receiptsDetails";
		
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
				
				$count = $responsObj['count'];
				$message = $responsObj['message'];
            } else {
				echo 'test2';
                $rec = $responsObj['ReceiptsDetails'];
                $count = $responsObj['count'];
				$message = $responsObj['message'];
                 
                //header("location:".$_SERVER['PHP_SELF']);
            }
            curl_close($ch);
			
        }
/* End Receipts API */

if(!isset($_SESSION['id'])){
header("location:index.php");
}
include("db.php"); 
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
          <p class="c-font-white">Receipts / Invoice</p>
        </div>
      </div>
      <div class="ac-nav">
        <div class="container">
          <a href="profile-settings.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Profile Settings</a>
          <a href="booking-history.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Booking History</a>
          <a href="notifications.php" class="btn btn-xs c-btn-white c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Notifications</a>
          <a href="receipts.php" class="btn btn-xs c-btn-green c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Receipts</a>
        </div>
      </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->
    <div class="c-content-box c-size-md c-bg-white">
      <div class="container">
        <div class="row">
		<?php
		if($count > 0)
		{
		?>
<p> You have <span class="c-gold"><b>0</b></span> Receipts</p>
        <?php
		}
		?>
          <div class="c-content-title-1">
            <h3 class="c-font-uppercase c-font-bold">Your Receipts</h3>
          </div>
        </div>
        <?php
			
		if($count > 0)
		{
        ?>
          <div class="c-content-accordion-1 c-theme">
            <div class="panel-group" id="accordion" role="tablist">
              <div class="panel">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a class="c-font-bold c-font-19 collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $rec[" id "]; ?>" aria-expanded="false" aria-controls="collapseOne">Order Id #<?php echo $rec["id"]; ?></a>
                  </h4>
                </div>
                <div id="collapse<?php echo $rec[" id "]; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" style="height: 0px;">
                  <div class="panel-body c-font-14">
                    <div class="r-outer c-color-black">
                      <div class="col-xs-12">
                        <div class="invoice-title">
                          <h2>Invoice</h2>
                          <h3 class="pull-right"><a class="mar-r-10 c-gold" href="#">Download</a> Order #
                            <?php echo $rec["id"]; ?>
                          </h3>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-xs-6">
                            <address>
                                <strong>Address:</strong><br>
                                   <?php echo $rec["customer_address"]; ?> 
                                </address>
                          </div>
                          <div class="col-xs-6 text-right">
                            <address>
    					<strong>Order Date:</strong><br>
    					<?php echo $rec["createdAt"]; ?> <br><br>
    				      </address>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="r-outer c-color-black">
                      <div class="col-md-12">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title p-title"><strong>Order summary</strong></h3>
                          </div>
                          <div class="panel-body">
                            <div class="table-responsive">
                              <table class="table table-condensed">
                                <thead>
                                  <tr>
                                    <td><strong>Item</strong></td>
                                    <td class="text-center"><strong>Price</strong></td>
                                    <td class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <?php echo $rec["product_name"]; ?>
                                    </td>
                                    <td class="text-center"><i class="fa fa-inr mar-r-10"></i>
                                      <?php echo $rec["price"]; ?>
                                    </td>
                                    <td class="text-center">1</td>
                                    <td class="text-right"><i class="fa fa-inr mar-r-10"></i>
                                      <?php echo $rec["price"]; ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right"><i class="fa fa-inr mar-r-10"></i>
                                      <?php echo $rec["price"]; ?>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php 
            }else
            {
			?>
	<div class="c-content-box c-size-md c-bg-white">
      <div class="container">
        <div class="row">
          <p> You have <span class="c-gold"><b>0</b></span> Receipts</p>
          <div class="c-content-panel">
            <div class="c-body">
              No Receipts Found
            </div>
          </div>
        </div>
      </div>
    </div>
			<?php
			}
			?>
      </div>
    </div>


    <!-- END: PAGE CONTENT -->
  </div>
  <!-- END: PAGE CONTAINER -->
  <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
  <?php require_once("footer.php"); ?>
</body>

</html>