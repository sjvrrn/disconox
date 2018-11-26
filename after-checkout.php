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
  <?php require_once('header.php'); session_start(); ?>
</head>


<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once('top.php');?>
  <!-- END: HEADER -->
  <!-- BEGIN: PAGE CONTAINER -->
  <div class="c-layout-page">


    <div class="c-content-box c-size-lg c-overflow-hide c-bg-white">
      <div class="container">
        <div class="c-shop-order-complete-1 c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
          <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Checkout Completed</h3>
            <div class="c-line-center c-theme-bg"></div>
          </div>
          <div class="c-theme-bg">
            <p class="c-message c-center c-font-white c-font-20 c-font-sbold">
              <i class="fa fa-check"></i> Thank you. Your order has been received. <br> Please use your Order ID as the payment reference. </p>
          </div>

          <!-- BEGIN: ORDER SUMMARY -->
          <hr>
          <div class="row c-order-summary c-center">
            <ul class="c-list-inline list-inline">
              <li>
                <h3>Order Number</h3>
                <p>#
                  <?php echo $_SESSION['product_order_id']; ?>
                </p>
              </li>
              <li>
                <h3>Date Purchased</h3>
                <p>
                  <?php echo date("Y/m/d"); ?>
                </p>
              </li>
              <li>
                <h3>Total Payable</h3>
                <p><i class="fa fa-inr mar-r-10"></i>
                  <?php echo $_SESSION['amount']; ?>
                </p>
              </li>
              <li>
                <h3>Payment Method</h3>
                <p>Online</p>
              </li>
            </ul>
          </div>
          <!-- END: ORDER SUMMARY -->
        </div>
      </div>
    </div>


    <!-- END: PAGE CONTENT -->
  </div>
  <!-- END: PAGE CONTAINER -->
  <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
  <?php require_once('footer.php');?>
  <?php $_SESSION['product_order_id']=''; ?>
  <?php $_SESSION['amount']=''; ?>
  <!-- END: LAYOUT/FOOTERS/GO2TOP -->
  <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
  <!-- BEGIN: CORE PLUGINS -->

</body>

</html>