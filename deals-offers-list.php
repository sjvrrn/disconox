<?php 
error_reporting(0);
require_once("header.php");
	/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"user_id"=>0,
		"category_id"=>1
    );
    $data_json = json_encode($data);
	$ul=$url."product_list";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
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

        if ($responsObj["error"]){
            echo "Bad Request";
        } else {
            $response = (object)$responsObj;
            $message = $response->message;
            $products = $response->productDetails;
		
			
         }
    }
    curl_close($ch);
	/*foreach start /end**/
	$i=0;
	foreach($products as $product){
		$product = (object)$project; 	
		$product_list .='<div class="listing-outer">
							<div class="c-content-product-2 c-bg-white">
								<div class="col-md-3">
								<div class="row">
									<div class="c-content-overlay">
										<div class="c-label c-bg-dark c-font-white c-font-12 c-font-bold"><i class="fa fa-camera"></i> 36</div>
										<div class="c-label c-label-right c-theme-bg c-font-white c-font-13 c-font-bold"><i class="fa fa-video-camera"></i> 3</div>
										<div class="c-overlay-wrapper">
											<div class="c-overlay-content">
												<a href="#" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
											</div>
										</div>
										<div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url('.$project->uimage.');"></div>
									</div>
								</div>
								</div>
								<div class="col-md-9">
									<div class="c-info-list">
										<h3 class="c-title c-font-bold c-font-22 c-font-dark">
											<a class="c-theme-link" href="#">'.$product->username.'</a>
											<!--<span class="c-font-14 c-grey">PUB,CASUAL DINING</span>-->
										</h3>
										<span class="addr">'.$product->uaddress.'</span>
										<p class="c-review-star">
											<span class="fa fa-star c-theme-font"></span>
											<span class="fa fa-star c-theme-font"></span>
											<span class="fa fa-star c-theme-font"></span>
											<span class="fa fa-star-half-o c-theme-font"></span>
											<span class="fa fa-star-o c-theme-font"></span> (18) </p>
										<hr>
										<p class="c-desc c-font-14 c-font-thin">Short Discription about Pub Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
										<hr>
										
									</div>
							<div>
							<p class="a-offer"> Available Deals</p>
							<a href="deals-offers-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Deals & Offers</a>
							<a href="surprise-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Surprise</a>
							<a href="guest-list-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Guest List</a>
							<a href="book-table-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Table</a>
							<a href="book-bottle.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Bottle</a>
							<a href="packages-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Packages</a>
							<a href="entry-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Entry</a>
							</div>
						    </div>
							</div>
						</div>';
						
		$content   .= '<div class="c-content-product-2 c-bg-white">
                            <div class="col-md-3">
                            <div class="row">
                                <div class="c-content-overlay">
                                    <div class="c-label c-bg-dark c-font-white c-font-12 c-font-bold"><i class="fa fa-camera"></i> 36</div>
                                    <div class="c-label c-label-right c-theme-bg c-font-white c-font-13 c-font-bold"><i class="fa fa-video-camera"></i> 3</div>
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="#" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url('.$project->image.');"></div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-9">
                                <div class="c-info-list">
                                    <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                        <a class="c-theme-link" href="#">'.$product->name.' </a>
                                        <span class="c-font-14 c-grey">PUB,CASUAL DINING</span>
                                    </h3>
                                    <span class="addr">'.$product->address.'</span>
                                    <p class="c-review-star">
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star-half-o c-theme-font"></span>
                                        <span class="fa fa-star-o c-theme-font"></span> (18) </p>
                                    <hr>
                                    <p class="c-desc c-font-14 c-font-thin">'.$product->description.'.</p>
                                    <hr>
                                </div>
                                <div>
                                    <p class="a-offer"> Available Deals</p>
                                     <a href="deals-offers-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Deals &                                        Offers</a>
                                     <a href="surprise-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Surprise</a>
                                    <a href="guest-list-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Guest List</a>
                                    <a href="book-table-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Table</a>
                                    <a href="book-bottle.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Bottle</a>
                                    <a href="packages-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Packages</a>
                                    <a href="entry-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Entry</a>
                                </div>
                            </div>
                        </div>
                    </div>';
		}
	
?>
<!DOCTYPE html>

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>Disconox</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description" />
  <meta content="" name="author" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
  <link href="assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

  <link href="assets/plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN THEME STYLES -->
  <link href="assets/base/css/plugins.css" rel="stylesheet" type="text/css" />
  <link href="assets/base/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
  <link href="assets/base/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css" />
  <link href="assets/base/css/custom.css" rel="stylesheet" type="text/css" />
  <link href="assets/base/css/jquery-ui.css" rel="stylesheet">
  <!-- END THEME STYLES -->
  <link rel="shortcut icon" href="favicon.ico" />
  <link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">
  <?php require_once('header.php');?>
</head>

<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once('top.php');?>
  <!-- END: HEADER -->
  <!-- END: LAYOUT/HEADERS/HEADER-1 -->

  <div class="c-layout-page">

    <div class="c-content-box c-size-sm c-bg-shade s-inner">
      <div class="container">
        <div class="auto-container">

          <!--Search Form-->
          <div class="search-form ">
            <form method="post" action="search-details.html">
              <div class="clearfix">
                <div class="form-group col-md-5 col-sm-12 col-xs-12">
                  <input type="text" name="fname" value="" placeholder="Search by city, location..." required>
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <input type="text" name="lname" value="" placeholder="Venue Name EX: Local Box Pub" required>
                </div>

                <!--Form Group-->
                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                  <select class="custom-select-box">
                                <option>All Categories</option>
                                <option>Deals & Offers</option>
                                <option>Surprise</option>
                                <option>Guest List</option>
                                <option>Book A Table</option>
                                <option>Book A Bottle</option>
                                <option>Packages</option>
                                <option>Entry</option>
                            </select>
                </div>
                <div class="btn-group">
                  <button type="submit" class="theme-btn search-btn"><span class="icon fa fa-search"></span></button>
                </div>
              </div>
            </form>
          </div>
          <!--End Search Form-->




        </div>
      </div>
    </div>

    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
    <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
      <div class="container">
        <div class="col-md-10">
          <div class="check-outer">

            <ul>
              <p class="filter-head">Filter By</p>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-one"><label for="tag-one">Deals & Offers</label></div>
              </li>

              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-two"><label for="tag-two">Surprise</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-three"><label for="tag-three">Guest List</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-four"><label for="tag-four">Table Booking</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-five"><label for="tag-five">Bottle Booking</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-six"><label for="tag-six">Packages</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-seven"><label for="tag-seven">Entry</label></div>
              </li>
              <li>
                <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-eight"><label for="tag-eight">All</label></div>
              </li>
            </ul>
          </div>

        </div>
        <!--col div-->
        <div class="col-md-2">
          <div class="form-group  mar-b-0">
            <select class="custom-select-box">
                                <option>Relevance</option>
                                <option>New & Popular</option>
                                <option>Most Viewed</option>
                                <option>By Star Rating</option>
                                <option>With Media Only</option>
                                <option>A - Z</option>
                               
                            </select>
          </div>
        </div>
        <!--coldiv-->


      </div>
    </div>
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->

    <div class="c-content-box c-size-md  c-bg-grey">
      <div class="container">

        <p> Showing Search results <span>235</span> for <span class="c-gold"> Key word name Comes here</span></p>
        <!-- BEGIN: PAGE CONTENT -->
        <!-- BEGIN: CONTENT/SHOPS/SHOP-RESULT-FILTER-1 -->

        <!-- END: CONTENT/SHOPS/SHOP-RESULT-FILTER-1 -->
        <div class="c-margin-t-20"></div>
        <!-- BEGIN: CONTENT/SHOPS/SHOP-2-8 -->
        <div class="listing-outer">
          <?php  echo $$product_list; ?>
          <!--<ul class="c-content-pagination c-square c-theme pull-right">
                        <li class="c-prev">
                            <a href="#">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">1</a>
                        </li>
                        <li class="c-active">
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li class="c-next">
                            <a href="#">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>-->
          <!-- END: PAGE CONTENT -->
        </div>
      </div>
    </div>
    <!-- END: PAGE CONTAINER -->
    <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-7 -->
    <a name="footer"></a>
    <footer class="c-layout-footer c-layout-footer-7">
      <div class="container">
        <div class="c-prefooter">
          <div class="c-body">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="c-links c-theme-ul">
                  <li>
                    <a href="become-a-partner.html">Become A Partner</a>
                  </li>
                  <li>
                    <a href="about.html">About Disconox</a>
                  </li>

                  <li>
                    <a href="faqs.html">FAQ's</a>
                  </li>
                  <li>
                    <a href="contact-us.html">Contact Us</a>
                  </li>


                  <li>
                    <a href="#">Book A Cab</a>
                  </li>
                  <li>
                    <a href="terms-of-use.html">Terms Of Use</a>
                  </li>


                </ul>

              </div>
              <div class="col-md-5 col-sm-6 col-xs-12">
                <div class="c-content-title-1 c-title-md">
                  <h3 class="c-title c-font-uppercase c-font-bold">About Disconox</h3>
                  <div class="c-line-left hide"></div>
                </div>
                <p>Find nightspots, pubs, bars and Happy Hour Deals in Hyderabad.<br> Plan your night and share with your friends<br> Party in Style...!</p>

                <p>Are you new in town? Or just looking for a new spot to have a few drinks and meet new people? With our app, you will never have to hassle through traffic to find one.</p>
              </div>
              <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="c-content-title-1 c-title-md">
                  <h3 class="c-title c-font-uppercase c-font-bold">Contact Us</h3>
                  <div class="c-line-left hide"></div>
                </div>
                <p class="c-address c-font-16">DISCONOX<br> Flat number A4B<br> A BLOCK, Cosmopolitan Aparments<br> Somajiguda, Hyderabad 500082 <br>


                  <br> Email:
                  <a href="mailto:connect@disconox.com">
                                        <span class="c-theme-color">connect@disconox.com</span>
                                    </a>

                </p>
              </div>
            </div>
          </div>

          <div class="c-line"></div>
          <div class="c-head">
            <div class="row">
              <div class="col-md-6 col-sm-12">
                <div class="c-left">
                  <div class="socicon">
                    <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-facebook tooltips" data-original-title="Facebook" data-container="body"></a>
                    <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-twitter tooltips" data-original-title="Twitter" data-container="body"></a>
                    <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-youtube tooltips" data-original-title="Youtube" data-container="body"></a>
                    <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-tumblr tooltips" data-original-title="Tumblr" data-container="body"></a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12">
                <div class="c-right">
                  <h3 class="c-title c-font-uppercase c-font-bold">Download Mobile App</h3>
                  <div class="c-icons">
                    <a href="#" class="c-font-30 c-font-green-1 socicon-btn socicon-android tooltips" data-original-title="Android" data-container="body"></a>
                    <a href="#" class="c-font-30 c-font-grey-3 socicon-btn socicon-apple tooltips" data-original-title="Apple" data-container="body"></a>
                    <a href="#" class="c-font-30 c-font-blue-3 socicon-btn socicon-windows tooltips" data-original-title="Windows" data-container="body"></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="c-postfooter c-bg-dark-2">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-12 c-col">
              <p class="c-copyright c-font-grey">2017-2018 © DISCONOX
                <span class="c-font-grey-3">All Rights Reserved.</span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <!-- END: LAYOUT/FOOTERS/FOOTER-7 -->
    <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
    <div class="c-layout-go2top">
      <i class="icon-arrow-up"></i>
    </div>
    <!-- END: LAYOUT/FOOTERS/GO2TOP -->
    <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
    <!-- BEGIN: CORE PLUGINS -->
    <!--[if lt IE 9]>
	<script src="../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
    <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/base/js/jquery-ui.js"></script>
    <script>
      //Custom Seclect Box
      if ($('.custom-select-box').length) {
        $('.custom-select-box').selectmenu().selectmenu('menuWidget').addClass('overflow');
      }
    </script>
    <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- END: CORE PLUGINS -->
    <!-- BEGIN: LAYOUT PLUGINS -->

    <!-- END: LAYOUT PLUGINS -->
    <!-- BEGIN: THEME SCRIPTS -->
    <script src="assets/base/js/components.js" type="text/javascript"></script>
    <script src="assets/base/js/components-shop.js" type="text/javascript"></script>
    <script src="assets/base/js/app.js" type="text/javascript"></script>
    <script>
      $(document).ready(function() {
        App.init(); // init core    
      });
    </script>
    <!-- END: THEME SCRIPTS -->
    <!-- END: LAYOUT/BASE/BOTTOM -->
</body>

</html>