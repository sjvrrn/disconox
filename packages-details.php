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
    <?php require_once("header.php");?>
	<?php
//error_reporting(0); 
$part_rating = "";
$r = "";
require_once("header.php");
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
include("db.php");
//require_once("db.php");
if(isset($_GET['vd'])){
 $partner_id = base64_decode($_GET['vd']); 
/*content start*/
/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"partnerId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ul= url."packageByPartner";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch); // echo"<pre>"; print_r($response); exit;
	if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
		
		 echo json_encode(array("success" => false, "message" => $e->getMessage()));
    return;
    } else {
        $responsObj = json_decode($response, TRUE);
		
        if ($responsObj["error"]) {  
            echo "Bad Request";
        } else {
            $response = $responsObj;
            $message = $response['message'];
            $products = $response['productDetails'];
			$details = $products[0]; // echo"<pre>"; print_r($details); exit;
			$cuisines  = $details['cuisines'];
			$avg_cost = $details['avg_cost'];
			$menu      = $details['menu'];
			$start_date_time   = $details['start_date_time'];
			$end_date_time  = $details['end_date_time'];
			$name = $details['name'] ;//=> Pradise Hotel
			$category_id = $details['category_id'];// => 6
			$highlights = $details['highlights'];// =>  speciality
			$description = $details['description'];// => venue desc
			$artist_info = $details['artist_info'];// => artist 
			$pps_ids = $details['pps_ids'];// => 6,7,8,9,10
			//packages details
			$pps_catids = explode(',',$details['pps_catids']);
			$ppc_catnames = explode(',',$details['ppc_catnames']);
			$ps_price = explode(',',$details['ps_price']);
			$pps_tags = explode(':',$details['pps_tags']) ;
			$pps_capacity = explode(",",$details['ps_capacity']) ;
			$pps_description  = explode("+",$details['pps_desc']);
			$pps_duration  = explode("/",$details['duration']);
			
			$partner_name = $details['partner_name'];// => partner _namee1
			$partner_title = $details['partner_title'];// => partner_title
			$partner_address = $details['partner_address'];// => fdsf
			$partner_desc = $details['partner_desc'];// => sdfs
			$partner_pic = $details['partner_pic'] ;//=> assets/uploads/bc5cd007c76bd7b00a1aa1a873bd8f59.jpg
			$location = $details['location'] ;//=> https://www.go
				
            $facilities = $details['facilities'];
			$dress_code = $details['dress_code'];
			$music_genere = $details['music_genre'];  
			$start_date_time= $details['start_date_time'];
			$end_date_time  = $details['end_date_time'];
			
         }
    }
    curl_close($ch);
    /*end*/
/*------------------------------------------------------------------------------------------------------*/
	$data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "userId"=>$partner_id
        );
        $data_json = json_encode($data);
        $ua=url."allreviews"; 
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
                $partner_name = $reviews['name'];
                $partner_title = $reviews['title'];
                $partner_address = $reviews['address'];
                $partner_description = $reviews['description'];
                $partner_pic = $reviews['partner_pic'];
                $partner_location  = $reviews['location'];
				if(isset($reviews['gallery']))
				{
				$gallery = explode(";",$reviews['gallery']);
				}
				else
				{
				$gallery = "";	
				}
				if(isset($reviews['videos']))
				{
                $videos = explode(";",$reviews['videos']);
				}
				else
				{
				$videos = "";
				}
				if(isset($reviews['review']))
				{
                $reviews = explode(";",$reviews['review']);
				}
				else
				{
				 $reviews = "";
				}
				if(isset($reviews['ratings']))
				{
				$ratings = explode(",",$reviews['ratings']); 
				}
				else
				{
				 $ratings = "";	
				}
				if(isset($reviews['review_name']))
				{
				$review_name = explode(",",$reviews['review_name']); 
				}
				else
				{
				$review_name = "";	
				}
				if(isset($reviews['review_img']))
				{
				$review_imgs = explode(",",$reviews['review_img']); 
				}
				else
				{
				 $review_imgs = "";
				}
				if(isset($reviews['dates']))
				{
                $dates  = explode(",",$reviews['dates']);
				}
				else
				{
				$dates = "";
				}
             }
        }
        curl_close($ch);
        /*end*/
} 
	/*  $res=mysql_query("SELECT pr.rating,pr.review,pr.created,u.name,u.image 
					FROM  `product_reviews` pr
					LEFT JOIN `users` u ON u.id=pr.uid
					WHERE pr.pid=".$partner_id);
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
	 */
    /*Terms defination*/
	$term = "";
     foreach($terms as $ter){
      if($ter){
        $term .= '<li>'.$ter.'</li>';
      }
     }
	 
    /*Gallery images*/	
	$img = "";
	if(isset($gallery) && $gallery != "")
	{
	foreach($gallery as $image){
	  if($image){
       $img .='<div class="item cbp-item">
                <div class="cbp-caption"> <a href="partners/'.$image.'" class="cbp-lightbox" > <img src="partners/'.$image.'" style="height:140px;"> </a> </div>
               </div>';
	  }
	}
	}
?>
    <style>
      .vl {
        margin: 0px !important;
      }
    </style>

    <body class="c-layout-header-fixed">
      <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
      <!-- BEGIN: HEADER -->
      <?php require_once("top.php");?>
      <link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
      <!-- END: HEADER -->
      <!-- END: LAYOUT/HEADERS/HEADER-1 -->
      <!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->

      <div class="c-layout-page">
        <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
        <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
          <div class="container">
            <div class="col-md-9"></div>
            <div class="col-md-3">
              <?php  echo back_page();?>
            </div>
          </div>
        </div>

        <div class="c-bg-grey pad-t-25">

          <div class="container c-bg-white ">
            <div class="col-md-6 col-sm-12">

              <div class="c-info-list ">
                <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                  <a class="c-theme-link" href="#"> <i class="fa fa-heart"></i> <?php echo $partner_name; ?></a></h3>


                <span class="label label-default c-font-slim">PUB</span>
                <span class="label label-default c-font-slim">CASUAL DINING</span>
                <span class="label label-default c-font-slim">BAR</span>
                <hr>
                <span class="c-review-star">
                                          <?php 
											if($part_rating==5){
											  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span>'; }elseif($part_rating==4){ $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>'; }elseif($part_rating==3){ $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>'; }elseif($part_rating==2){ $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>'; }elseif($part_rating==1){ $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>'; }else{ $prat = '<span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>'; } ?>
                <?php echo $prat; ?>(
                <?php echo $r; ?>)
                </span>
                <!--location map model start-->
                <?php echo show_map($partner_name,$location);?>
                <!--location map model close-->
                <hr>
                <p><i class="fa fa-road"></i> Address: <span><b><?php echo $partner_address; ?></b></span></p>
                <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span> <?php echo $highlights;?></span></p>
                <p><i></i> <b>Facilities:</b> <span><?php echo $facilities;?> </span></p>
                <p><i></i> <b>Description:</b> <span><?php echo $description;?> </span></p>
                <p><i></i> <b>Dress code:</b> <span><?php echo $dress_code;?> </span></p>
                <p><i></i> <b>Music Genre:</b> <span><?php echo $music_genere;?> </span></p>
                <p><i></i> <b>Cusines:</b> <span><?php echo $cuisines;?> </span></p>
                <p><i></i> <b>Average cost for two:</b> <span><?php echo $avg_cost;?> </span></p>
                <p><i></i> <b>Menu:</b>
                   <div class="col-md-6 col-sm-12"> <span><img src="partners/<?php echo $menu;?>" class="img-responsive"></span></div>
                </p>
              </div>

            </div>
            <div class="col-md-6 col-sm-12">
              <br>
              <img class="img-responsive" src='<?php echo "partners/".$partner_pic ;?>'>

            </div>


            <!--start_date_time--->
            <?php          $start = explode(' ',$start_date_time);
                           $end   = explode(' ',$end_date_time);
					?>
            <div class="row">

              <div class="col-md-6 col-xs-6">
                <p><i class="fa fa-calendar"></i> From Date: <span><b><?php if($start_date_time){
												 echo $start[0];
											}?></b><?php if(isset($start[0]) && isset($end[0])){ ?> to <?php } ?><span><b><?php  if($end_date_time){echo  $end[0];} ?></b></span></span>
                </p>
              </div>

              <div class="col-md-6 col-xs-6">
                <p><i class="fa fa-clock-o"></i> Time: <span><b><?php if(isset($start[1])){ echo $start[1]; }?></b> <?php if(isset($start[1]) && isset($end[1])){ ?> to <?php } ?> <span><b><?php if(isset($end[1])){ echo $end[1]; }?></b></span></span>
                </p>
              </div>

            </div>
            <!--end_date_time-->
            <div class="listing-outer">
              <div class="c-content-product-2 ">

                <div class="col-md-12 c-padding-20">
                  <h3 class="c-font-24">Offering Packages</h3>

                  <div class="c-content-accordion-1 c-theme">
                    <div class="panel-group" id="accordion" role="tablist">
                      <?php  
					  
					  for($i=0;$i<count($ps_price);$i++){ if($i<1){ $val="true";}else{ $val="false";}?>
                      <div class="panel">
                        <div class="panel-heading" role="tab" id="headingOne">
                          <h4 class="panel-title">
                            <a class="c-font-bold c-font-19" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i; ?>" aria-expanded="<?php echo $val;?>" aria-controls="collapseOne">
                              <?php echo $ppc_catnames[$i]; ?><span class="price-right"> <i class="fa fa-inr"></i> <?php echo $ps_price[$i]; ?>/-</span></a>
                          </h4>
                        </div>
                        <div id="collapse<?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <div class="package-outer">
                              <div class="col-md-9 col-sm-12">
                                <div class="c-content-title-3 c-theme-border">
                                  <h2 class="c-left c-font-uppercase"><span class="c-gold"><?php echo $ppc_catnames[$i]; ?></span>
                                    <?php if(isset($pps_tags[$i])) { echo $pps_tags[$i]; }?>
                                  </h2>
                                  <div class="c-line c-dot c-dot-left "></div>
                                  <?php 
								  $ar = "";
								  if(isset($pps_tags[$i]))
								  {
								  $arr = explode(',',$pps_tags[$i]);  
								  foreach($arr as $ar){?>
                                  <p><span class="label label-default c-font-slim"><?php echo $ar;?></span>
                                    <?php }
								  }else
								  { ?>
							  <p><span class="label label-default c-font-slim"><?php echo $ar;?></span>
								  <?php }?>
                                  </p>
                                  <p><i class="fa fa-clock-o"></i> Package duration: <span><b><?php if(isset($start[1])) { echo $start[1]; }?></b> to <span><b><?php if(isset($end[1])) { echo $end[1]; }?></b></span></span>
                </p>
                                  <h2 class="c-left c-font-uppercase c-margin-t-20">Ratio</h2>
                                  <p>
                                    <?php if(isset($pps_capacity[$i])){ echo $pps_capacity[$i]; }?>
                                  </p>
                                  <h2 class="c-left c-font-uppercase c-margin-t-20">About Package</h2>
                                  <p>
                                    <?php echo $pps_description[$i];?>
                                  </p>
                                  <!------------------>
                                  <div class="c-bg-white pad-bt-25">
                                    <h2 class="c-left c-font-uppercase c-margin-t-20">Duration</h2>
                                  <p>
                                    <?php $duration = explode(' ',$pps_duration[$i]); echo $duration[0].'<p>&nbr&nbr</p>Hrs';?>
                                  </p>
                                  </div>
                                  <!---------------------->
                                  <!----------------------->
                                </div>
                              </div>
                              <div class="col-md-3 col-sm-12">
                                    <div class="form-group mar-b-0" style="border:1px solid #CCC;">
                                          <select class="custom-select-box" id="occasion">
                                                <option value="">Select Occasion</option>
                                                <option value="Birthday party">Birthday party</option>
                                                <option value="Anniversary">Anniversary</option>
                                                <option value="Corporate Party">Corporate Party</option>
                                                <option value="Kitty Party">Kitty Party</option>
                                                <option value="Bachelor Party">Bachelor Party</option>
                                                <option value="Bachelorette party">Bachelorette party</option>
                                                <option value="Reunion and Surprise party">Reunion and Surprise party</option>
                                           </select>
                                    </div>
                                <button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $i; ?>">BOOK NOW</button>

                                <!--MODEL </div>START one modal for all packages-->
                                <div class="modal fade bs-example-modal-sm<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="date-time" aria-hidden="true">
                                  <div class="modal-dialog modal-sm">
                                    <div class="modal-content c-square">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                        <h4 class="modal-title" id="date-time">Select Date & Time</h4>
                                      </div>
                                      <div class="modal-body">
                                        <form action="checkout.php?pd=Ng==" id='checkout_form' class="form-horizontal" role="form" method="post">
                                          <input type="hidden" name="price" id="price" value="<?php echo $ps_price[$i]; ?>">
                                          <input type="hidden" name="item" id="item" value="<?php echo $ppc_catnames[$i]; ?>">
                                          <input type="hidden" name="time" id="time">
                                          <fieldset>
                                            <div class="form-group">
                                              <input name="date" type="text" id="datetime_picker"  class="form-control" placeholder="Select Date & Time"/>
                                              <br/>
                                              <div>
                                                <input name="lname" value="" placeholder="Note..." required="" type="text" style="width: 100%;height: 75px;margin-top:25px;">
                                              </div>
                                            </div>
                                          </fieldset>
                                          <div class="modal-footer">
                                            <input type="hidden" name="checkout" value="checkout">
                                            <button type="submit" id='checkout' name="checkout" value="checkout" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Done</button>
                                            </a>
                                            <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Back</button>
                                          </div>
                                        </form>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                </div>
                                <!--MODEL END-->
                              </div>
                            </div>
                            <!--package outer-->

                          </div>
                          <!--panel body-->
                        </div>
                      </div>
                      <?php  }?>

                    </div>
                  </div>
                  <div>

                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>


        <!--cz content start-->
        <div class="c-content-box c-size-sm c-bg-dark">
          <div class="container">
            <!-- Begin: Testimonals 1 component -->
            <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
              <!-- Begin: Owlcarousel -->
              <div class="owl-carousel owl-theme c-theme owl-bordered1">
                <?php echo $img; ?>
              </div>
              <!-- End-->
            </div>
            <!-- End-->
          </div>
        </div>
        <!---media end-->

        <!--dont remove this div-->
        <div id="grid-container" class="cbp cbp-l-grid-masonry-projects">
        </div>
        <!--dont remove this div-->


        <div class="c-content-box c-bg-grey c-padding-20">
          <div class="container">
            <div class="c-product-tab-container">
              <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40">Reviews & Rating</h3>
              <?PHP if(isset($rating)) { echo $rating; } ?>
            </div>
            <form action="" method="post">
              <div class="c-product-review-input">
                <h3 class="c-font-bold c-font-uppercase">Submit your Review</h3>
                <p class="c-review-rating-input">Rating:
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                  <i class="fa fa-star-o"></i>
                </p>
                <textarea name='comment' id='comment'></textarea>
                <button type='submit' name='submit' id='submit' value='submit' class="btn c-btn c-btn-square c-theme-btn c-font-bold c-font-uppercase c-font-white">Submit Review</button>
              </div>
            </form>
          </div>
        </div>





        <!-- END: PAGE CONTENT -->
      </div>
      <!-- END: PAGE CONTAINER -->
      <?php require_once('footer.php');?>
      <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
      <!-- BEGIN: CORE PLUGINS -->
      <!-- END: PAGE CONTAINER -->
      <?php require_once('footer.php');?>
      <!-- BEGIN: CORE PLUGINS -->
      <!--[if lt IE 9]>

     
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
    </body>

  </html>


  <script>
    $(document).ready(function() {
      App.init(); // init core
      $('#checkout').click(function(e) {
        $("#my_modal").trigger("click");
        e.preventDefault();

      });
      $("#proceed").click(function() {
        var time = $("#dtp_input1").val();
        $("#time").val(time);
        if (time == "") {
          alert("please Select Date and Time");
          return false;
        }
        document.getElementById('checkout_form').submit();
      });
      $("#stop").click(function() {
        return false;
      });
    });
  </script>
  <!--modal div start----------------------------------------------------->
  <div class="container">

    <!-- Trigger the modal with a button -->
    <button type="button" id="my_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='display:none'>Open Modal</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2>Terms & Conditions </h2>
          </div>
          <p>
            <div>

              <ul>
                <?php echo $term; ?>
              </ul>
            </div>
          </p>
          <!--  <div class="modal-footer">
          
        </div>-->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" id="proceed" class="btn btn-default" data-dismiss="modal">Proceed</button>
          </div>
        </div>

      </div>
    </div>

  </div>
  <!--modal div end-------------------------------------------------------->
  <!--datetime picker --->
  <script type="text/javascript">
    var x = '<?php echo $booking_days;?>';
    var st = '<?php echo $booking_time; ?>';
    st = parseInt(st);
    var arr = [];
    for (i = 0; i < Math.round(st); i++) {
      arr.push(i);
    }
    var time_string = arr.toString();
    $('.form_datetime').datetimepicker({
      stepping: 30,
      hoursDisabled: time_string,
      setStartDate: '2018/05/1 10:00',
      daysOfWeekDisabled: [x, 2],
      datesDisabled: ['2016/08/20'],
      autoclose: true,
    });
  </script>
  <!--datetime picker end-->