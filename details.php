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
  <?php require_once('header.php');?>
  <link href="./details/prettyPhoto.css" rel="stylesheet">
  <link href="./details/animate.css" rel="stylesheet">
  <link href="./details/main.css" rel="stylesheet">
</head>

<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once("top.php");?>
  <!-- END: HEADER -->

  <div class="c-layout-page">
     <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <input action="action" onclick="window.history.go(-1); return false;" value="Back to Shop" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-t-10 c-margin-b-10 c-font-14 pull-right" type="button">          
          </div>
        </div>
      </div>
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!--<div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image:url(assets/images/note-bg.jpg)">
        <div class="container">
          <div class="c-page-title">
            <p class="s-font c-font-white c-font-26 ">About Disconox</p>
          </div>
        </div>
      </div>-->
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->

    <div class="c-content-box c-size-md c-bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <!--<div class="c-content-title-1">
              <h3 class=" c-font-uppercase c-font-bold">Collections</h3>
              <div class="c-line-left c-theme-bg"></div>
            </div>-->
            <section>
              <div class="container">
			      <div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->

							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">T-Shirt</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Shirt</a></h4>
								</div>
							</div>
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Sleeve</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="#">Neck</a></h4>
								</div>
							</div>
							
						</div><!--/category-productsr-->
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="./details/1.jpg" alt="">
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="./details/new.jpg" class="newarrival" alt="">
								<h2>Aa Raha Hoon Half Sleeve T-Shirt</h2>
								<p>ID: 1089772</p>
								<img src="./details/rating.png" alt="">
								<span>
									<label style="float: left;margin-top: 8px;">Price:</label>
                                    <span><i class="fa fa-inr mar-rl-10 "></i>300</span><br>
									<label>Quantity:</label>
									<input type="text" value="3">
                                    <br>
									<button type="button" class="btn btn-fefault cart" style="margin-left:0px;">
										<i class="fa fa-shopping-cart"></i>
										Buy Now
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> PUMA</p>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
															
				</div>
			</div>
		      </div>
	       </section>
          </div>
        </div>
      </div>
    </div>
    <!-- END: PAGE CONTENT -->
  </div>
  <?php require_once('footer.php');?>
</body>

</html>