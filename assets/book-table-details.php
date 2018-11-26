<?php 
error_reporting(0); 
require_once("header.php"); 
if(isset($_POST['submit'])){
			//start
			$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"name"=> $_SESSION['id'],
		"email"=>$_SESSION['email'],
		"phone"=>$_SESSION['phone'],
		"comment"=>$_POST['comment']
        );
    $api_url = $url."comment"; 
    /*get all posts*/
    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
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
          //  echo "Bad Request";
        } else {
            $response = (object)$responsObj;
            $message = $response->message;
            $products = $response->productDetails;
	
        }
    }
    curl_close($ch);
			//end
			  }
 $partner_id = base64_decode($_GET['vd']);  
/*content start*/
/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"partnerId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ur = $url."booktableByPartner";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ur);
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
            $index = $responsObj['productDetails'][0];
			$product = $responsObj['productDetails'];
			$name = $index['name'];// => spider
            $category_id = $index['category_id'];// => 4
            $highlights = $index['highlights'];// => specialities
            $description = $index['description'];// => desc
            $artist_info = $index['artist_info'] ;//=> artist
            $pbt_ids = explode(',',$index['pbt_ids']);//=> 11,11,12,12,13,13,14,14,15,15
            $pbt_catids = explode(',',$index['pbt_catids']);// => 1,1,1,1,1,1,1,1,1,1
            $pbt_catnames = explode(',',$index['pbt_catnames']);// => seeter2,seeter2,seeter2,seeter2,seeter2,seeter2,seeter2,seeter2,seeter2,seeter2
            $ps_price = explode(',',$index['ps_price']);// => 5000.00,5000.00,6000.00,6000.00,7000.00,7000.00,8000.00,8000.00,9000.00,9000.00
            $partner_name = $index[''];// => partner _namee
            $partner_title = $index['partner_title'] ;//=> partner_title
            $partner_address = $index['partner_address'];// => address
            $partner_desc = $index['partner_desc'];// => description
            $partner_pic = $index['partner_pic'];// => assets/uploads/41e74a569578d40969b550cba409d198.jpg
            $location = $index['location'] ;//> map
			$tags   = $index['tags'];
		}
    }
    curl_close($ch);
    /*end*/
	

/*------------------------------------------------------------------------------------------------------*/
	/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"userId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ua=$url."allreviews"; 
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
            echo "Bad Request";
        } else {
            $response = (object)$responsObj;
            $message = $response->message;
            $reviews = $response->reviews[0];  // echo"<pre>"; print_r($reviews); exit;
			$images =  explode(",",$reviews['images']) ;
			$terms  = explode(",",$reviews['terms']); 
			$videos = explode(",",$reviews['videos']);
    		$review    = explode(",",$reviews['review']); 
			$dates    = explode(",",$reviews['dates']);
			$names    = explode(",",$reviews['names']); 
 			$partner_name = $reviews['name'];
			$partner_title = $reviews['title'];
			$partner_address = $reviews['address'];
			$partner_description = $reviews['description'];
			$partner_pic = $reviews['partner_pic'];
			$partner_location    = $reviews['location'];
			$id  = $review['id']; 
         }
    }
    curl_close($ch);
    /*end*/

/*reviews start */
if(count($review)>0){
	$i=0;
foreach($review as $re){
	//$image = $review->image;
// $url = "partners/".$image;
	$rating .='<div class="row c-margin-t-40">
                                            <div class="col-xs-6">
                                                <div class="c-user-avatar">
                                                    <img src="assets/base/img/content/avatars/team8.jpg" /> </div>
                                                <div class="c-product-review-name">
                                                    <h3 class="c-font-bold c-font-24 c-margin-b-5">'.$names[$i].'</h3>
                                                    <p class="c-date c-theme-font c-font-14">'.$dates[$i].'</p>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="c-product-rating c-right c-gold">
                                                    <span class="stars">2.6545344</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="c-product-review-content">
                                            <p> '.$re.'</p>
                                        </div>';
	$i++;
                }

            } 
?>
<script>
$(document).ready(function(){
$.fn.stars = function() {
    return $(this).each(function() {
        var val = parseFloat($(this).html());
  	//val = Math.round(val * 4) / 4; /* To round to nearest quarter */
//        val = Math.round(val * 2) / 2; /* To round to nearest half */
        var size = Math.max(0, (Math.min(5, val))) * 16;
        var $span = $('<span />').width(size);
        $(this).html($span);
    });
}
});
</script>
<?php
/*review defination*/
if(count($terms)>0){
	$i=0;
foreach($terms as $ter){
	if($i<11){
	$term .='<li>'.$ter.'</li>';
	}
	$i++;
}
}
/*-----------------------------------------------------------------------------------------------------*/


foreach($videos as $url){
	$video .='<div class="owl-item" style="width: 240px;"><div class="item c-content-isotope-gallery ">
                                <div class="c-content-isotope-item">
                            <div class="c-content-isotope-image-container">
                            <div class="v-icon-tr"><i class="fa fa-video-camera"></i></div>
                                <img class="" src="assets/images/g1.jpg">
                                <div class="c-content-isotope-overlay c-ilightbox-image-3" href="'.$url.'" data-options="smartRecognition: true">
                                    <div class="c-content-isotope-overlay-icon">
                                        <i class="fa fa-play c-font-white"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                           <a href="#" class="cbp-l-grid-masonry-projects-title c-font-white"></a>     
                            </div></div>';
}							


foreach($images as $image){
$img .='<div class="owl-item" style="width: 240px;"><div class="item cbp-item">
                                <div class="cbp-caption">
                                    
                                    <a href="partners/'.$image.'" class="cbp-lightbox"> <img src="partners/'.$image.'" alt=""> </a>
                                      
                                </div>
                                <a href="#" class="cbp-l-grid-masonry-projects-title c-font-white"></a>
                            </div></div>';
							}

?>
<!DOCTYPE html>

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
  <!--<![endif]-->
  <!-- BEGIN HEAD --><head>
    <meta charset="utf-8" />
    <title>Disconox</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?php require_once('header.php');?>
  </head>
  

  <link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">

  <body class="c-layout-header-fixed">
    <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
    <!-- BEGIN: HEADER -->
    <?php require_once("top.php");?>
    <!-- END: HEADER -->
    <!-- BEGIN: PAGE CONTAINER -->
    <div class="c-layout-page">
      <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
      <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
          <div class="col-md-9">
            <div class="check-outer">


            </div>

          </div>
          <!--col div-->
          <div class="col-md-3">
            <a href="search-results.php" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-t-10 c-margin-b-10 c-font-14 pull-right">Back to Search Results</a>
          </div>
          <!--coldiv-->


        </div>
      </div>

      <div class="c-bg-grey pad-t-25">

        <div class="container">
          <h3 class="c-title c-font-bold c-font-22 c-font-dark">
            <a class="c-theme-link" href="#"><?php echo $partnerDetails->Name;?> </a>
           <button type="button" class="btn btn-xs c-font-14 vl" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-map-marker"></i> View Location Map</button>
          </h3>

          <img class="img-responsive" alt="" src="<?php echo "partners/".$partnerDetails->partner_pic;?>">
<!--start-->
      <div class="listing-outer">
            <div class="c-content-product-2 c-bg-white">
              <div class="col-md-6">

                <div class="c-info-list">

                  <!--location map model start-->
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content c-square">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                          <h4 class="modal-title" id="myLargeModalLabel">
                            <?php echo $name;?>
                          </h4>
                        </div>
                        <div class="modal-body">
                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d243647.3169796658!2d78.26796156870589!3d17.41229980306336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb99daeaebd2c7%3A0xae93b78392bafbc2!2sHyderabad%2C+Telangana!5e0!3m2!1sen!2sin!4v1512761922958" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                        <div class="modal-footer">

                          <button type="button" class="btn c-btn-dark c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!--location map model close-->


                  <hr>
                  <p><i class="fa fa-heart"></i> Venue: <span><b> <?php echo $index->Name;?>&nbsp;&nbsp;&nbsp;<?php echo $partner_name;?></b></span>
                    <?php echo $tags;?>
                  </p>
                  <p class="c-review-star">
                    <span class="fa fa-star c-theme-font"></span>
                    <span class="fa fa-star c-theme-font"></span>
                    <span class="fa fa-star c-theme-font"></span>
                    <span class="fa fa-star-half-o c-theme-font"></span>
                    <span class="fa fa-star-o c-theme-font"></span>
                    <?php echo count($details->images);?>
                  </p>


                  <p><i class="fa fa-road"></i> Address: <span><b><?php echo $partner_address;?></b></span></p>
                  <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span><?php echo $highlights;?></span></p>


                </div>

              </div>
              <div class="col-md-6 c-padding-20">
                <p class="c-margin-b-10 c-font-20">BOOK A TABLE</p>

                <div class="table-group">

                  <ul>
                  <?php   
				    $i=1;
					echo "<pre>";  
					print_r($product);
					die;
				    foreach($product as $detail){  $detail = (object)$detail;   $j = $i*2;?>
                    <li>
                      <a id="customoptions_image_0_0" title="" onClick="return false;" href="#"> <img class="small-image-preview img-responsive v-middle" title="" src="assets/images/<?php echo $j;?>s.png">
                      <span class="tit"><?php echo $i*2;?>SETER<br><span class="c-font-12"><i class="fa fa-inr"></i> <?php echo $detail->ps_price[$i]; ?>/- </span></span></a>
                      <input id="options_9_3" class="radio validate-one-required-by-name product-custom-option" type="radio" value="22" name="options[9]" onClick="opConfig.reloadPrice();">
					</li>
                    <?php $i++; } ?>
                  
                 </ul>

                  <div>
					</div>
                  <hr>

                  <div class="col-md-8 col-xs-12">

                    <form action="" class="form-horizontal" role="form">
                      <fieldset>

                        <div class="form-group">

                          <div class="input-group date form_datetime " data-date="1979-09-16T05:25:07Z" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
                            <input class="form-control" size="16" type="text" placeholder="SELECT DATE" value="" readonly>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                          </div>
                          <input type="hidden" id="dtp_input1" value="" />
                        </div>
                      </fieldset>
                    </form>
                  </div>
                  <div class="col-md-4 col-sm-xs12">
                    <a href="checkout.php"><button type="button" class="btn c-margin-t-5 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase">BOOK NOW</button></a>
                  </div>

                </div>
                <!--table group-->
				<div>
			</div>
              </div>
            </div>
          </div>
          
<!--end-->

        </div>
      </div>

  <!--cz content start-->
    <div class="c-content-box c-size-sm c-bg-dark">
                <div class="container">
                    <!-- Begin: Testimonals 1 component -->
                    <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
                       
                        <!-- Begin: Owlcarousel -->
                        <div class="owl-carousel owl-theme c-theme owl-bordered1" style="opacity: 1; display: block;">
                            
                            <div class="owl-wrapper-outer">
                            
                            <div class="owl-wrapper" style="width: 4800px; left: 0px; display: block; transition: all 800ms ease; transform: translate3d(-240px, 0px, 0px);">
                            <div class="owl-item" style="width: 240px;">
                           
                            <div class="item cbp-item">
                                <div class="cbp-caption">
                                    
                                    <a href="assets/images/g1b.jpg" class="cbp-lightbox"> <img src="assets/images/g1.jpg" alt=""> </a>
                                      
                                </div>
                                <a href="#" class="cbp-l-grid-masonry-projects-title c-font-white"></a>
                            </div>
                            
                            </div>
                            <?php echo $img;?>
                            <?php echo $video;?>
                            </div>
                            </div>
                          
                            
                        <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div></div></div>
                        <!-- End-->
                    </div>
                    <!-- End-->
                </div>
            </div>
  <!---media end-->
   <div class="c-bg-white pad-bt-25">
              <div class="container">
                <h1>Discription</h1>
                <p><?php echo $description; ?></p>
              </div>
            </div>
   <div class="c-bg-white pad-bt-25">
              <div class="container">
                <h1>Terms & Conditions </h1>
                <ul>
                  <?php echo $term; ?>
                </ul>
              </div>
            </div>    
   <div class="c-content-box c-bg-grey c-padding-20">
              <div class="container">
                <div class="c-product-tab-container">
                  <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40">Reviews & Rating</h3>
                  <?php  echo $rating; ?>
                </div>
                <form action="" method="post">
               <div class="c-product-review-input">
                                                <h3 class="c-font-bold c-font-uppercase"></h3>
                                                <p class="c-review-rating-input">Rating:
                                                                                            <i class="fa fa-star-o"></i>	
                                                                                            <i class="fa fa-star-o"></i>
                                                                                            <i class="fa fa-star-o"></i>
                                                                                            <i class="fa fa-star-o"></i>
                                                                                            <i class="fa fa-star-o"></i>
                                                                                        </p>
                                                <textarea name='comment' id='comment'></textarea>
                                                <button  type='submit' name='submit' id='submit' value='submit'class="btn c-btn c-btn-square c-theme-btn c-font-bold c-font-uppercase c-font-white">Submit Review</button>
                                            </div>
                                            </form>
              </div>
			  <style>
              #hide {
    display:none;
}
 
.rating input {
    position:absolute;
    filter:alpha(opacity=0);
    -moz-opacity:0;
    -khtml-opacity:0;
    opacity:0;
    cursor:pointer;
    width:17px;
}
 
.rating span {
    width:24px;
    height:16px;
    line-height:16px;
    padding:1px 22px 1px 0; /* 1px FireFox fix */
    background:url(stars.png) no-repeat -22px 0;
}
 
/* Change span immediately following the checked radio */
 
.rating input:checked + span {
    background-position:-22px 0;
}
 
/* Reset all remaining stars back to default background.
   This supersedes the above due to its ordering. */
 
.rating input:checked + span ~ span {
    background-position:0 0;
}
 
              
              </style>
            </div>     
    </div>
    <!-- END: PAGE CONTAINER -->
    <?php require_once('footer.php');?>
    <!-- BEGIN: CORE PLUGINS -->
    <!--[if lt IE 9]>

        <!-- END: CORE PLUGINS -->
    <!-- BEGIN: LAYOUT PLUGINS -->
    <script src="assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
    <script src="assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
    <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="assets/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
    <script src="assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
    <script src="assets/plugins/slider-for-bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>
    <!-- END: LAYOUT PLUGINS -->
    <!-- BEGIN: LAYOUT PLUGINS -->
    <script src="assets/plugins/revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
    <script src="assets/plugins/revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
    <script src="assets/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
    <script src="assets/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js" type="text/javascript"></script>
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
    <!-- BEGIN: PAGE SCRIPTS -->
    <script src="assets/base/js/scripts/pages/masonry-gallery.js" type="text/javascript"></script>
    <!-- END: PAGE SCRIPTS -->
    <!-- END: LAYOUT/BASE/BOTTOM -->
    <!-- END: THEME SCRIPTS -->
    <!-- BEGIN: PAGE SCRIPTS -->
    <script src="assets/base/js/scripts/revo-slider/slider-1.js" type="text/javascript"></script>
    <script src="assets/plugins/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
    <script src="assets/plugins/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
    <script src="assets/plugins/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>
    <script src="assets/plugins/ilightbox/js/jquery.requestAnimationFrame.js" type="text/javascript"></script>
    <script src="assets/plugins/ilightbox/js/jquery.mousewheel.js" type="text/javascript"></script>
    <script src="assets/plugins/ilightbox/js/ilightbox.packed.js" type="text/javascript"></script>
    <script src="assets/base/js/scripts/pages/isotope-gallery.js" type="text/javascript"></script>
    <!-- END: PAGE SCRIPTS -->
    <!-- END: LAYOUT/BASE/BOTTOM -->


    <!--image check box -->
    <script>
$("a").click(function() {
  $(this).next().prop("checked", "checked");
});

$('a').click(function() {
  $('li:has(input:radio:checked)').addClass('active');
  $('li:has(input:radio:not(:checked))').removeClass('active');
});
    </script>

    <!--date time picker-->
    <script type="text/javascript" src="assets/base/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="assets/base/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
    <script type="text/javascript">
$('.form_datetime').datetimepicker({
  //language:  'fr',
  weekStart: 1,
  todayBtn: 1,
  autoclose: 1,
  todayHighlight: 1,
  startView: 2,
  forceParse: 0,
  showMeridian: 1
});
    </script>
  </body>

</html>