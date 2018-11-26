<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html ng-app='disconox'>
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
  <style>
    .c-layout-revo-slider {
      margin-top: -80px;
    }
   #myVideo {
    right: 0;
    bottom: 0;
    min-width: 100%; 
    min-height: 100%;
	margin-top:-85px;
   }
   /*.ui[class*="eight column"].grid>.column:not(.row), .ui[class*="eight column"].grid>.row>.column {
    width: 14%;
   }
   .ui.grid>.column:not(.row), .ui.grid>.row>.column {
    display: inline-block;
   }*/
   .ta-center, .tac {
    text-align: center;
   }
   .img-center {
    display: block;
    margin: 0 auto;
}
@media (max-width:600px) and (min-width:360px) {   
  .seven-cols .col-xs-6{
	  min-height:140px;
  }
 }
 @media (min-width: 768px){
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1  {
    width: 100%;
    *width: 100%;
  }
  
}

@media (min-width: 992px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}

/**
 *  The following is not really needed in this case
 *  Only to demonstrate the usage of @media for large screens
 */    
@media (min-width: 1200px) {
  .seven-cols .col-md-1,
  .seven-cols .col-sm-1,
  .seven-cols .col-lg-1 {
    width: 14.285714285714285714285714285714%;
    *width: 14.285714285714285714285714285714%;
  }
}
  </style>
  <?php   
   require_once('header.php');
   define("url","http://localhost/disconoxv1/Api/");
	if(isset($_GET['payment_request_id'])){  
		include("db.php");
		$order_id = $_SESSION['product_order_id'];
		$payment_id = $_GET['payment_id'];
		$payment_request_id= $_GET['payment_request_id'];
		$upd="update product_orders set payment_id='$payment_id',payment_request_id='$payment_request_id',status='success' where id='$order_id'";
		mysql_query($upd);
		header("location:after-checkout.php");
	}
	/*get all posts*/
   $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
    );
    $data_json = json_encode($data);
	$ua = url."showAllReviews"; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ua);
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
           // echo "Bad Request";
        } else {
            $response = (object)$responsObj;
            $message = $response->message;
            $reviews = $response->reviews;  // echo"<pre>"; print_r($reviews); exit;
			
         }
    }
    curl_close($ch);
	
	//test 
	/* $ch = curl_init("http://google.com");    // initialize curl handle
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($ch);
    print($data); die; */
	//end
	/**allusers**/
	try{
	$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
    );
	$data_json = json_encode($data);
	$ua= url."all_users";  
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ua);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	 $response  = curl_exec($ch);  
	 if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch); 
}
	if ($response === false) {
		 throw new Exception(curl_error($ch), curl_errno($ch));
        $info = curl_getinfo($ch);  
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
		
    } else {

        $responsObj = json_decode($response, TRUE);

        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $response = $responsObj;
            $PartnersData = $response['PartnersData'];  
            $partners = array_column($PartnersData,'partner_pic');
			
         }
    }
	 curl_close($ch);
	 
	}catch(Exception $e){
		trigger_error(sprintf(
        'Curl failed with error #%d: %s',
        $e->getCode(), $e->getMessage()),
        E_USER_ERROR);
		
	}
  

    /*end*/
	?>
</head>
<body class="c-layout-header-fixed " ng-controller="index">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php  require_once("top.php"); ?>
  <!-- END: HEADER -->
  <div class="c-layout-page">
    <!-- BEGIN: PAGE CONTENT -->
    <!-- BEGIN: LAYOUT/SLIDERS/REVO-SLIDER-4 -->
    <section class="c-layout-revo-slider c-layout-revo-slider-4">
      <div class="tp-banner-container c-theme">
        <video autoplay muted loop id="myVideo">
          <source src="disconox.mp4" type="video/mp4">
          Your browser does not support HTML5 video.
        </video>
      </div>
    </section>
    <div class="c-content-box c-size-sm c-bg-grey">
      <div class="container">
        <div class="auto-container">
          <!--Search Form-->
          <div class="search-form">
            <form method="get" action="search-results.php">
              <div class="clearfix">
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <input type="text" name="city" value="Hyderabad" placeholder="Search by city, location...">
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <input type="text" name="venue" value="" placeholder="Venue Name EX: Local Box Pub">
                </div>
                <!--Form Group-->
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <select class="custom-select-box" name='pd'>
                        <option value="">All Categories</option>
                        <option value="MQ==">Deals & Offers</option>
                        <option value="NA==">Book A Table</option>
                        <option value="NQ==">Book A Bottle</option>
                        <option value="Ng==">Packages</option>
                        <option value="Nw==">Entry</option>
                        <option value="Mw==">Guest List</option>
                        <option value="Mg==">Surprise</option>
                    </select>
                </div>
                <div class="btn-group">
                  <button type="submit" name='filter' id='filter' value="filter" class="theme-btn search-btn"><span class="icon fa fa-search"></span></button>
                </div>
              </div>
            </form>
          </div>
          <!--End Search Form-->
        </div>
      </div>
    </div>
    <!--<div class="c-content-box c-bg-white pad-bt-25">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-1.jpg" ></a> </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-1.jpg" ></a> </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-1.jpg" ></a> </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-1.jpg" ></a> </div>
            </div>
          </div>
        </div>
      </div>-->
    <!--<div class="c-content-box c-size-md  c-bg-dark">
        <div class="container">
          <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold c-font-white">Book Now - Get Discounts</h3>
            <div class="c-line-center c-theme-bg"></div>
            <p class="c-center c-font-uppercase c-font-white">Showcasing latest Events, Offers, Discounts & Packages.</p>
          </div>
          <div class="cbp-panel">
            <div class="c-content-latest-works cbp cbp-l-grid-masonry-projects wow animate fadeInLeft">
              <div class="cbp-item graphic">
                <div class="cbp-caption">
                  <div class="home-mask">Deals & Offers</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/01.jpg" alt="Deals & Offers"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Deals_Offers'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item web-design logos wow animate fadeInLeft">
                <div class="cbp-caption">
                  <div class="home-mask">Surprise</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/02.jpg" alt="Surprise"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Surprise'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item graphic logos wow animate fadeInLeft" data-wow-delay="0.2s">
                <div class="cbp-caption">
                  <div class="home-mask">Guest List</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/03.jpg" alt="Guest List"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Guest_List'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item identity web-design wow animate fadeInLeft" data-wow-delay="0.4s">
                <div class="cbp-caption">
                  <div class="home-mask">Book A Table</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/04.jpg" alt="Book A Table"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Book_A_Table'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item web-design graphic wow animate fadeInLeft">
                <div class="cbp-caption">
                  <div class="home-mask">Book A Boottle</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/05.jpg" alt="Book A Bottle"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Book_A_Bottle'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item identity web-design wow animate fadeInLeft" data-wow-delay="0.2s">
                <div class="cbp-caption">
                  <div class="home-mask">Packages</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/06.jpg" alt="Packages"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Packages'); ?>p" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cbp-item graphic logos wow animate fadeInLeft" data-wow-delay="0.4s">
                <div class="cbp-caption">
                  <div class="home-mask">Entry</div>
                  <div class="cbp-caption-defaultWrap"> <img src="assets/images/07.jpg" alt="Entry"> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="c-masonry-border"></div>
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body"> <a href="search-results.php?pd=<?php echo base64_encode('Entry'); ?>" class=" cbp-l-caption-buttonLeft btn c-btn-square c-btn-border-1x c-btn-white c-btn-bold c-btn-uppercase">explore all</a> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>-->
    <!--<div class="c-content-box c-bg-white pad-bt-25">
        <div class="container">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
              <div class="pramotions"> <a href="#" target="_blank"><img class="img-responsive c-margin-b-10" src="assets/images/adimg-2.jpg" ></a> </div>
            </div>
          </div>
        </div>
      </div>-->
    
    <div class="c-content-box c-size-md c-bg-gray-1">
       <div class="container">
      
      <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Quick Searches</h3>
            <div class="c-line-center c-theme-bg"></div>
      </div>
      <div class="ui segment eight column doubling padded grid row seven-cols">
            <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(1); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/deals_offers.png" style="height:75px;width:75px;">
                <div>Deals & Offers</div>
             </a>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(4); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/book-a-table.png" style="height:75px;width:75px;">
                <div>Book A Table</div>
             </a>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(5); ?>"  class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/book_a_bottle.png" style="height:75px;width:75px;">
                <div>Book A Bottle</div>
             </a>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-6">             
             <a href="search-results.php?pd=<?php echo base64_encode(6); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/packages.png" style="height:75px;width:75px;">
                <div>Packages</div>
             </a>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(7); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/entry.png" style="height:75px;width:75px;">
                <div>Entry</div>
             </a>
            </div>
             <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(3); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/guest_list.png" style="height:75px;width:75px;">
                <div>Guest List</div>
            </a>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-6">
             <a href="search-results.php?pd=<?php echo base64_encode(2); ?>" class="column ta-center start-categories-item">
                <img class="ui middle aligned img-center image mb5" src="images/surprise.png" style="height:75px;width:75px;">
                <div>Surprise</div>
             </a>
            </div>
     </div>
    </div>
   </div>
   
    <div class="c-content-box c-size-md c-bg-grey-1">
      <div class="container">
        <div class="c-content-blog-post-card-1-slider" data-slider="owl" data-items="3" data-auto-play="8000">
          <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold">Customer Reviews</h3>
            <div class="c-line-center c-theme-bg"></div>
            <!--<p class="c-center c-font-uppercase1">Lorem ipsum dolor sit amet et consectetuer adipiscing elit</p>-->
          </div>
          <div class="owl-carousel owl-theme c-theme">
            <?php 
			  $i=0;
			  foreach($reviews as $review){				  
													$review = (object)$review;
													if($i>3){ break 1;}
													  if(!$review->image){
														  $review_img = 'assets/images/p-pic.png';
													  }else{
														  $review_img = $review->image;
													  }
												   
												  ?>
												<div class="item">
												  <div class="c-content-testimonial-3 c-option-default">
													<div class="c-content" style="min-height: 156px;">
													  <?php echo $review->review; ?>
													</div>
													<div class="c-person"> <img src="<?php echo $review_img; ?>" class="img-responsive">
													  <div class="c-person-detail c-font-uppercase">
														<h4 class="c-name">
														  <?php echo $review->name;?>
														</h4>
														<!--<p class="c-position c-font-bold c-theme-font">CFO, Walmart</p>-->
													  </div>
													</div>
												  </div>
												</div>
							<?php $i++; }?>
          </div>
        </div>
      </div>
    </div>
    <div class="c-content-box c-size-md c-bg-gray-1">
      <div class="container">
        <!-- Begin: Testimonals 1 component -->
        <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="6" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
          <!-- Begin: Title 1 component -->
          <div class="c-content-title-1">
            <h3 class="c-center c-font-uppercase c-font-bold ">Disconox Partners</h3>
            <div class="c-line-center c-theme-bg"></div>
          </div>
          <!-- End-->
          <!-- Begin: Owlcarousel -->
          <div class="owl-carousel owl-theme c-theme owl-bordered1">
            <?php foreach($PartnersData as $image){ ?>
            <div class="item"> <a href="deals-offers-details.php?vd=<?php echo base64_encode($image['id']);?>"> <img src="<?php echo "partners/".$image['partner_pic'];?>" alt="" height="150px;"/> </a> </div>
            <?php }?>
          </div>
          <!-- End-->
        </div>
        <!-- End-->
      </div>
    </div>
  </div>
  <!-- END: LAYOUT/SLIDERS/REVO-SLIDER-4 -->
  <!-- BEGIN: CONTENT/FEATURES/FEATURES-1 -->
  <?php require_once('footer.php');?>
  <!-- BEGIN: LAYOUT PLUGINS -->
</body>

</html>