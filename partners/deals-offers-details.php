<?php 
require_once("header.php");
include("db.php");
if(isset($_POST['submit']))
{ 
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
                
            } else {
                $response = (object)$responsObj;
                $message = $response->message;
                $products = $response->productDetails;
            }
        }
        curl_close($ch);
                //end
                  }
    if(isset($_GET['vd'])){
        $partner_id = base64_decode($_GET['vd']); 
		
        $data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "partnerId"=>$partner_id
        );
        $data_json = json_encode($data);
        $ul=$url."dealsByPartner";
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
                
            } else {
                $response = (object)$responsObj;
                $message = $response->message;
				$products = $responsObj['productDetails'];
                $product = $response->productDetails[0];
				$product_id    = $product['id'];// => Pradise Hotel
				$product_name    = $product['name'];// => Pradise Hotel
				$category_id     = $product['category_id'];// => 1
				$highlights      = $product['highlights'];   //=> specialities
				$description     = $product['description'];// => venue desc
				$artist_info     = $product['artist_info'];// => artist info
				$pdf_ids 	     = $product['pdf_ids'];// => 1,2,1,2
				$pdf_catids 	 = $product['pdf_catids'];// => 1,1,1,1
				$pdf_dealsname   = explode(',',$product['pdf_dealsname']);/* => offer name,deal_name,offer name,deal_name/===*/
				$pdf_start_date_time = explode(',',$product['pdf_start_date_time']);// => 2018-03-28 07:25:00,2018-03-28 07:25:00,2018-03-28 07:25:00,2018-03-28 07:25:00
				$pdf_end_date_time   = explode(',',$product['pdf_end_date_time']);// => 2018-03-28 07:25:00,2018-03-28 07:25:00,2018-03-28 07:25:00,2018-03-28 07:25:00
				$ps_price 		 = explode(',',$product['ps_price']);// => 2000.00,1000.00,2000.00,1000.00
				$pdf_title 		 = explode(';',$product['pdf_title']);// => 50%;50%;50%;50%
				$pdf_tags        = explode(';',$product['pdf_tags']);// => offertag;deal tag;offertag;deal tag
				$partner_name    = $product['partner_name'];// => partner _namee
				$partner_title   = $product['partner_title'];//=> partner_title
				$partner_address = $product['partner_address'];// => address
				$partner_desc    = $product['partner_desc']; //=> description
				$partner_pic     = $product['partner_pic'];// => assets/uploads/post-banner.jpg
				$location        = $product['location']; //=> map
				$terms  = explode(";",$product['terms']); 
			
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
               
            } else {
                $response = (object)$responsObj;
                $message = $response->message;
                $reviews = $response->reviews[0];  // echo"<pre>"; print_r($reviews); exit;
                $partner_name = $reviews['name'];
                $partner_title = $reviews['title'];
                $partner_address = $reviews['address'];
                $partner_description = $reviews['description'];
                $partner_pic = $reviews['partner_pic'];
                $partner_location  = $reviews['location'];
				$gallery =  explode(";",$reviews['gallery']) ;
                $videos = explode(";",$reviews['videos']);
                $reviews = explode(";",$reviews['review']);
				$ratings = explode(",",$reviews['ratings']); 
				$review_name = explode(",",$reviews['review_name']); 
				$review_imgs = explode(",",$reviews['review_img']); 
                $dates  = explode(",",$reviews['dates']);
             }
        }
        curl_close($ch);
        /*end*/
    } 
	
	$res=mysql_query("SELECT pr.rating,pr.review,pr.created,u.name,u.image 
					FROM  `product_reviews` pr
					LEFT JOIN `users` u ON u.id=pr.uid
					WHERE pr.pid=".$product_id);
	$r=0;
	while ($rec =  mysql_fetch_assoc($res)){
	  if(!$rec['image']){
		  $review_img = 'assets/images/p-pic.png';
	  }else{
		  $review_img = 'partners/'.$rec['image'];
	  }
	  if($rec['rating']==5){
	    $rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star"></i>';
	  }elseif($rec['rating']==4){
	    $rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i>';
	  }elseif($rec['rating']==3){
	    $rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
	  }elseif($rec['rating']==2){
		$rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
	  }else{
		$rat = '<i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
	  }
      $rating .='
		<div class="row c-margin-t-40">
		  <div class="col-xs-6">
			<div class="c-user-avatar"> <img src="'.$review_img.'"> </div>
			<div class="c-product-review-name">
			  <h3 class="c-font-bold c-font-24 c-margin-b-5">'.$rec['review'].'</h3>
			  <p class="c-date c-theme-font c-font-14">'.$rec['created'].'</p>
			</div>
		  </div>
		  <div class="col-xs-6">
			<div class="c-product-rating c-right c-gold"> '.$rat.'</div>
		  </div>
		</div>
		<div class="c-product-review-content">
		  <p> </p>
		</div>';
	   $r++;
	   $part_rating= $rec['rating'];
	}
	
   /*reviews start */
    /*$i=0;
    foreach($reviews as $review){
	   if($review){
	    $x = ($review/5)*100;
		$rating .='
		<div class="row c-margin-t-40">
		  <div class="col-xs-6">
			<div class="c-user-avatar"> <img src="partners/'.$review_imgs[$i].'"> </div>
			<div class="c-product-review-name">
			  <h3 class="c-font-bold c-font-24 c-margin-b-5">'.$review_name[$i].'</h3>
			  <p class="c-date c-theme-font c-font-14">'.$dates[$i].'</p>
			</div>
		  </div>
		  <div class="col-xs-6">
			<div class="c-product-rating c-right c-gold"> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-half-o "></i> </div>
		  </div>
		</div>
		<div class="c-product-review-content">
		  <p> </p>
		</div>';
        $i++;
	   }
     }*/
	
    /*Terms defination*/
     foreach($terms as $ter){
      if($ter){
        $term .= '<li>'.$ter.'</li>';
      }
     }
	 
    /*Gallery images*/	
	foreach($gallery as $image){
	  if($image){
       $img .='<div class="item cbp-item">
                <div class="cbp-caption"> <a href="partners/'.$image.'" class="cbp-lightbox" > <img src="partners/'.$image.'" style="height:140px;"> </a> </div>
               </div>';
	  }
	}
	
	

    /*deal tags*/
    if(count($products)>0){			
     
        foreach($products as $pro){
        $start  = explode(" ",$pro['start_date_time']);
        $end  = explode(" ",$pro['end_date_time']);
		$price = $pro['price'][$i];
            $deal  .= '<div class="dp-outer-deals">
                                    <div class="dpod-head">'.$pro['name'].'</div><!--head-->
                                    <form action="checkout.php" method="post">
                                    <input type="hidden" name="item" id="item" value="'.$pro['name'].'">
                                    <input type="hidden" name="product_id" value="'.$pro["id"].'">
                                    <div class="package-outer">
                                                <div class="col-md-9 col-sm-12">
                                                    <div class="c-content-title-3 c-theme-border">
                                            <h1 class="c-left c-font-uppercase"><span class="c-gold fon-gold-hevy">'.$pro["highlights"].'</span></h1>
                                            <div class="c-line c-dot c-dot-left "></div>
                                            
                                            <div class="row">
                                            
                                            <div class="col-md-6 col-xs-12">
                                            <p><i class="fa fa-calendar"></i> From Date: <span><b>'.$start[0].'</b> to <span><b>'.$end[0].'</b></span></span></p>
                                            </div>
                                            
                                            <div class="col-md-6 col-xs-12">
                                            <p><i class="fa fa-clock-o"></i> Time: <span><b>'.$start[1].'</b> to <span>'.$end[1].'</span></span></p>
                                            </div>
                                            
                                            <div class="col-md-12 col-xs-12">
                                            <hr>
                                            <h2 class="c-gold"><span><b>Minimum Booking Amount:<i class="fa fa-inr mar-rl-10 "></i>'.$pro["price"].'/- </b></span></h2>
                                            <input type="hidden" name="price" id="price" value="'.$pro["price"].'">
                                            </div>
                                            </div>
                                        <h2 class="c-left c-font-uppercase c-margin-t-20">About This Deal</h2>
                                            <p>'.$pro["description"].'</p>
                                            <p><span class="label label-default c-font-slim"></span>
                                        '.$pro["tags"].'
                                        </p>                                   
                                        </div>
                                              </div>
                                                <div class="col-md-3 col-sm-12">
                                                <input type="submit" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase"  name="checkout" id="checkout" value="BOOK NOW"></form>
                                                    <!--<a href="checkout.php?co='.base64_encode($pro["id"]).'&cid='.base64_encode(1).'&ba='.base64_encode($pro["id"]).'"><button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase">BOOK NOW</button></a>-->
                                                </div>
                                                </div></div>';
        }
   }
?>
    <!DOCTYPE html>
     <html lang="en">
      <head>
        <meta charset="utf-8" />
        <title>Disconox</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <body class="c-layout-header-fixed">
        <style>
		.containerdiv {
		  border: 0;
		  float: left;
		  position: relative;
		  width: 300px;
		} 
		.cornerimage {
		  border: 0;
		  position: absolute;
		  top: 0;
		  left: 0;
		  overflow: hidden;
		 } 
		 img{
		   max-width: 300px;
		 }
		</style>
		<?php require_once("top.php");?>
            <div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
            <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
              <div class="container">
                <div class="col-md-9"></div>
                </div>
                <!--col div-->
                <div class="col-md-3">
                  <a href="search-results.php" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-t-10 c-margin-b-10 c-font-14 pull-right">Back to Search Results</a>
                </div>
                <!--coldiv-->
              </div>
            </div>
            <div class="c-bg-grey pad-t-25">
    
              <div class="container c-bg-white ">
                <div class="col-md-6 col-sm-12">
    
                  <div class="c-info-list ">
    
    
    
                    <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                      <a class="c-theme-link" href="#"> <i class="fa fa-heart"></i> <?php echo $partner_name;?></a></h3>
    
                    <?php echo implode(',',$pdf_tags) ;?>
    
                    <hr>
                    <span class="c-review-star">
                    <?php 
                    if($part_rating==5)
					{
                      $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span>';
                    }elseif($part_rating==4)
					{
					  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
                    
                    }elseif($part_rating==3)
					{
					  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
                    
                    }elseif($part_rating==2)
					{
					  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
                   
                    }elseif($part_rating==1)
					{
					  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
                   
                    }else
					{
					  $prat = '<span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
				    }
				  ?>
                  <?php echo $prat; ?>(<?php echo $r; ?>) 
                  </span>
                    <button type="button" class="btn btn-xs c-font-14 vl" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-map-marker"></i> View Location Map
                    </button>
                    <hr>
    
                    <!--location map model start-->
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content c-square">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel"><?php echo  $partner_name; ?></h4>
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
                        <p><i class="fa fa-road"></i> Address: <span><b> <?php echo $partner_address; ?></b></span></p>
                    <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span> <?php echo $highlights; ?> </span></p>
    
                  </div>
    
                </div>
<div class="col-md-6 col-sm-12">

<img class="img-responsive c-margin-t-15 c-margin-b-15" src="<?php echo 'partners/'.$partner_pic; ?>" width="500px"height="300px">

</div>
<div class="listing-outer">
<div class="c-content-product-2 ">

<div class="col-md-12 c-padding-20">
  <h3 class="c-font-24">Offering Deals & Offers</h3>

  <?php echo $deal; ?>
  <div>

  </div>
</div>
</div>
</div>

</div>
</div>
<div class="c-content-box c-size-sm c-bg-dark">
		<div class="container">
			<!-- Begin: Testimonals 1 component -->
			<div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
			   
				<!-- Begin: Owlcarousel -->
				<div class="owl-carousel owl-theme c-theme owl-bordered1">

	
<?php echo $img; ?>
        <!--video-->
        <!--<div class="item c-content-isotope-gallery ">
          <div class="c-content-isotope-item">
            <div class="c-content-isotope-image-container">
              <div class="v-icon-tr"><i class="fa fa-video-camera"></i></div>
              <img class="" src="assets/images/g1.jpg" />
              <div class="c-content-isotope-overlay c-ilightbox-image-3" href='https://www.youtube.com/watch?v=aydtRFzY0oE' data-options="smartRecognition: true">
                <div class="c-content-isotope-overlay-icon"> <i class="fa fa-play c-font-white"></i> </div>
              </div>
            </div>
          </div>
          <a href="#" class="cbp-l-grid-masonry-projects-title c-font-white">Video Caption</a> </div>-->
        <!--video--end-->

        
      </div>
<!-- End-->
</div>
<!-- End-->
</div>
</div>
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
<?php require_once("footer.php");?>
</body>
</html>
        <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>
        <script src="assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="assets/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="assets/plugins/slider-for-bootstrap/js/bootstrap-slider.js" type="text/javascript"></script>
        <script src="assets/plugins/revo-slider/js/jquery.themepunch.tools.min.js" type="text/javascript"></script>
        <script src="assets/plugins/revo-slider/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
        <script src="assets/plugins/revo-slider/js/extensions/revolution.extension.slideanims.min.js" type="text/javascript"></script>
        <script src="assets/plugins/revo-slider/js/extensions/revolution.extension.layeranimation.min.js" type="text/javascript"></script>
        <script src="assets/base/js/components.js" type="text/javascript"></script>
        <script src="assets/base/js/components-shop.js" type="text/javascript"></script>
        <script src="assets/base/js/app.js" type="text/javascript"></script>
        <script>
            $(document).ready(function()
            {
                App.init(); // init core    
            });
        </script>
        <script src="assets/base/js/scripts/pages/masonry-gallery.js" type="text/javascript"></script>
        <script src="assets/base/js/scripts/revo-slider/slider-1.js" type="text/javascript"></script>
        <script src="assets/plugins/isotope/isotope.pkgd.min.js" type="text/javascript"></script>
        <script src="assets/plugins/isotope/imagesloaded.pkgd.min.js" type="text/javascript"></script>
        <script src="assets/plugins/isotope/packery-mode.pkgd.min.js" type="text/javascript"></script>
        <script src="assets/plugins/ilightbox/js/jquery.requestAnimationFrame.js" type="text/javascript"></script>
        <script src="assets/plugins/ilightbox/js/jquery.mousewheel.js" type="text/javascript"></script>
        <script src="assets/plugins/ilightbox/js/ilightbox.packed.js" type="text/javascript"></script>
        <script src="assets/base/js/scripts/pages/isotope-gallery.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/base/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
        <script type="text/javascript" src="assets/base/js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
        <script type="text/javascript">
	    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
  		  });
		</script>