<!DOCTYPE html>
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
      <link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
      <style>
        .vl {
          margin: 0px !important;
        }
      </style>
<?php 
require_once("header.php");
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
include("db.php");
   //Only For Videos and Gallery Of Partner
    $GLOBALS['gallery'] = array();
    allReviews(1);
    $gallery = $GLOBALS['gallery'][0];



/*get Comments Start*/
$img = show_images($gallery);
foreach ($gallery as $image) {
    if ($image) {
        $img .= '<div class="item cbp-item">
                                                    <div class="cbp-caption"> <a href="partners/' . $image . '" class="cbp-lightbox" > <img src="partners/' . $image . '" style="height:140px;"> </a> </div>
                                                   </div>';
    }
}
$deal = show_products($product_list);

$term = "";
$img = "";
$part_rating = "";
$prat = "";
$r = "";
if(isset($_POST['submit'])){
			
$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"name"=> $_SESSION['id'],
		"email"=>$_SESSION['email'],
		"phone"=>$_SESSION['phone'],
		"comment"=>$_POST['comment']
        );
    $api_url = url."comment"; 
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
if(isset($_GET['vd'])){
 $partner_id = base64_decode($_GET['vd']); 
 /*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"partnerId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ul= url."bookbottleByPartner";
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
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $response = $responsObj;
            $message = $response['message'];
            $products = $response['productDetails'];
			$details = $products[0]; //echo"<pre>"; print_r($details); exit;
			//print_r($details);exit;
			$cuisines  = $details['cuisines'];
		    $avg_cost  = $details['avg_cost']; 
			$menu     = $details['menu'];
            $start_date_time = $details['start_date_time'];
            $end_date_time = $details['end_date_time'];
            $name = $details['name'];
			$description = $details['description'] ;
			$rating      = $details['rating'];
			$partner_rating = round($rating);
			$pbb_ids = explode(",",$details['pbb_ids']);// => 1,1
			if(isset($details['pbb_name']))
			{
			$pbb_name = explode(',',$details['pbb_name']);// => dsf,dsf
			}
			else
			{
			 $pbb_name = "";
			}
			if(isset($details['pbb_price']))
			{
			$pbb_price = explode(',',$details['pbb_price']);// => 435.00,435.00
			}
			else
			{
			$pbb_price = "";
			}
			
			if(isset($details['pbb_actual_price']))
			{
			$pbb_actual_price = explode(',',$details['pbb_actual_price']);// => 345345.00,345345.00
			}
			else
			{
			$pbb_actual_price = "";
			}
			$partner_name = $details['partner_name'];// => partner _namee
			$partner_title = $details['partner_title'];// => partner_title
			$partner_address = $details['partner_address'];// => address
			$partner_desc = $details['partner_desc'];// => description
			$partner_pic = $details['partner_pic'] ;//=> assets/uploads/41e74a569578d40969b550cba409d198.jpg
			$location = $details['location'];//=> map
			$product_img = $details['product_img'];//=> map
			if(isset($details['terms']))
			{
			$terms  = explode(";",$details['terms']);
			}
			else
			{
			$terms = "";
			}
			$facilities = $details['facilities'];
			$dress_code = $details['dress_code'];
			$music_genre = $details['music_genre'];
			if(isset($details['booking_days']))
			{
            $booking = explode('/',$details['booking_days']);//print_r($booking); exit;
			$booking_days = $booking[0]; 
			$booking_time = $booking[1];  
			}
			else
			{
			$booking_days = ""; 
			$booking_time = ""; 
			}

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
                $partner_pic1 = $reviews['partner_pic'];
                $partner_location  = $reviews['location'];
				if(isset($reviews['gallery']))
				{
				$gallery =  explode(";",$reviews['gallery']) ;
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
					$dates  = "";
				}
             }
        }
        curl_close($ch);
        /*end*/

}
?>
  <?php	
    /*Terms defination*/
	if(isset($terms))
	{
     foreach($terms as $ter){
      if($ter){
        $term .= '<li>'.$ter.'</li>';
      }
     }
	}
	 
    /*Gallery images*/	
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

      <body class="c-layout-header-fixed">
        <?php require_once('top.php');?>
        <nav class="c-layout-quick-sidebar">
          <div class="c-header">
            <button type="button" class="c-link c-close">
                    <i class="fa fa-close"></i>
                </button>
          </div>

        </nav>
        <div class="c-layout-page">
          <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
            <div class="container">
              <div class="col-md-9"></div>
              <div class="col-md-3">
                <?php  echo back_page();?>
              </div>
            </div>
          </div>
          <div class="c-bg-grey pad-t-25">
            <div class="container">
              <h3 class="c-title c-font-bold c-font-22 c-font-dark"><a class="c-theme-link" href="#">
			  <?php if(isset($details->name)) { echo $details->name; }?> </a></h3>
              <div class="listing-outer">
                <div class="c-content-product-2 c-bg-white">
                  <div class="col-md-5">
                    <div class="c-info-list">
                      <br>
                      <img class="img-responsive" alt="" src="<?php echo "partners/".$partner_pic;?>">
                      <hr>
                      <p><i class="fa fa-heart"></i> Venue: <span><b> <?php if(isset($partner_name)) { echo $partner_name; } ?></b></span><br>
                        <?php if(isset($tags)) { echo implode(',',$tags); } ?>
                      </p>
                      <p class="c-review-star">
                        <?php 
								     if($partner_rating==5){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span>';
									  }elseif($partner_rating==4){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
										
									  }elseif($partner_rating==3){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
										
									  }elseif($partner_rating==2){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									   
									  }elseif($partner_rating==1){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									   
									  }else{
										  $prat = '<span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									  }
									  ?>
                        <?php echo $rating; ?>(
                        <?php echo number_format((float)$rating,2,'.',''); ?>)
                      </p>
                      <?php  //echo show_map($partner_name,$location);?>

                      <p><i class="fa fa-road"></i> Address: <span><b> <?php echo $partner_address;  ?></b></span></p>
                      <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span> <?php echo $highlights;?>  </span></p>
                      <p><i></i> <b>Timings:</b> <span> <?php echo $start_date_time.' '.$end_date_time; ?> </span></p>
                      <p><i></i> <b>Description:</b> <span><?php echo $description;?> </span></p>
                      <p><i></i> <b>Facilities:</b> <span><?php echo $facilities;?> </span></p>
                      <p><i></i> <b>Dress code:</b> <span><?php echo $dress_code;?> </span></p>
                      <p><i></i> <b>Music Genre:</b> <span><?php echo $music_genre;?> </span></p>
                      <p><i></i> <b>Cuisines:</b> <span><?php echo $cuisines;?> </span></p>
                      <p><i></i> <b>Average cost for two:</b> <span><?php echo $avg_cost;?> </span></p>
                      <p><i></i> <b>Menu:</b>
                          <div class="col-md-6 col-sm-12"> <span><img src="partners/<?php echo $menu;?>" class="img-responsive"></span></div>
                      </p>
                    </div>

                  </div>
                  <div class="col-md-7 c-padding-20">
                    <p class="c-margin-b-10 c-font-20">BUY A BOTTLE</p>
                    <div class="book-bot-outer">
                      <!--start_date_time--->
                      <?php  $start = explode(' ',$start_date_time);
							 $end   = explode(' ',$end_date_time);
					   ?>
                      <div class="row">
                        <div class="col-md-7 col-xs-7">
                          <p><i class="fa fa-calendar"></i> From Date: <span><b><?php if($start_date_time){ echo $start[0]; } ?></b><?php if(isset($start[0]) && isset($end[0])) {?> to <?php } ?><span><b><?php  if($end_date_time){echo  $end[0];} ?></b></span></span>
                          </p>
                        </div>

                        <div class="col-md-5 col-xs-5">
                          <p><i class="fa fa-clock-o"></i> Time: <span><b><?php if(isset($start[1])) { echo $start[1]; }?></b> <?php if(isset($end[1]) && isset($start[1])) {?> to <?php } ?><span><b><?php if(isset($end[1])) { echo $end[1]; }?></b></span></span>
                          </p>
                        </div>

                      </div>
                      <!--end_date_time-->
                      <ul>
                        <form action="checkout.php?pd=NQ==" method="post" id="checkout_form">
                          <?php for($i=0;$i<count($pbb_ids);$i++){?>
                          <li>
                            <div class="tag-box-bottle">
                              <input name="tags" id="tag-one" type="checkbox">

                              <label for="tag-one">
                                        <div class="col-md-5 col-xs-12"><?php echo $pbb_name[$i];?> </div>
                                        <div class="col-md-7 col-xs-12" style="font-size:18px;">Offer Price<span class="new-price" style="font-size:21px;"><i class="fa fa-inr"></i><?php echo $pbb_price[$i]; ?>/-</span> <span class="old-p"><?php echo $pbb_actual_price[$i];?>/-</span></div>
                                    <input type="text" name="item" id="item" value="<?php echo $pbb_name[$i];?>">
                                    <input type="text" name="actual_price" id="actual_price" value="<?php echo $pbb_actual_price[$i];?>">
                                    <input type="text" name="price" id="price" value="<?php echo $pbb_price[$i];?>">
                                    <p>Note: Mixtures are free with the bottle</p>
                               </label>
                              <input type='hidden' name='checkout' value="checkout">
                              <button type="submit" name="checkout" id="checkout" value="BUY NOW" class="btn pull-right  c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" style="display:none">BUY NOW</button>
                              <button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm">BOOK NOW</button>

                            </div>
                          </li>
                          <?php } ?>
                        </form>
                      </ul>


                      <div class="col-md-12 col-sm-12">


                        <!--MODEL START one modal for all packages-->
                        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="date-time" aria-hidden="true">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content c-square">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                <h4 class="modal-title" id="date-time">Select Date & Time</h4>
                              </div>
                              <div class="modal-body">

                                <fieldset>

                                  <div class="form-group">
                                    <input name="date" type="text" id="datetime_picker"  class="form-control" placeholder="Select Date & Time"/><br/>
                                  </div>
                                </fieldset>


                              </div>
                              <div class="modal-footer">
                                <a href="checkout.php?pd=NQ=="><button type="button" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase" id="done">Done</button></a>
                                <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Back</button>
                              </div>
                            </div>

                          </div>

                        </div>

                      </div>

                    </div>



                    <div>

                    </div>
                  </div>
                  <!-------------------------------------pick start-->

                  <!--pic end---------------------------------------->

                </div>
              </div>
            </div>


            <!-----slider----->
            <div class="c-content-box c-size-sm c-bg-dark">
              <div class="container">
                <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
                  <div class="owl-carousel owl-theme c-theme owl-bordered1">
                                <?php
if (isset($img)) {
    echo $img;
}
?>
                  </div>
                </div>
              </div>
            </div>
            <!-----/slider----->
<!--review rating --->
<div class="container">
          <div class="c-product-tab-container">
            <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40" style="font-weight:400 !important">Reviews & Rating</h3>
           <?php
rating(5);
?>
         </div>
          <?php
if ($_SESSION['role'] > 2) {
    comment(5);
} else {
?>
       <div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          </div>
      </div>
        <?php
}
?>
         
        </div>
      </div>          

            <!-- END: PAGE CONTENT -->
          </div>
        </div>
      </body>

    </html>

    <?php require_once( 'footer.php');?>
    
    <script>
      $(document).ready(function() {
        $(document).on('click', '#done', function(e) {
          $("#my_modal").trigger("click");
          e.preventDefault();
        });
        $("#proceed").click(function() {
          var time = $("#dtp_input1").val();
          $("#time").val(time);
          if (time == "") {
            alert("please Select Date and Time"); //return false;
          }
          document.getElementById('checkout_form').submit();
        });

      });
    </script>

    <script>
      $("a").click(function() {
        $(this).next().prop("checked", "checked");
      });

      $('a').click(function() {
        $('li:has(input:radio:checked)').addClass('active');
        $('li:has(input:radio:not(:checked))').removeClass('active');
      });
    </script>
    <script>
      $(document).ready(function() {
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
    <!--date time picker-->
    <!--datetime picker --->
    <script type="text/javascript">
      var x = '<?php echo $booking_days;?>';
      var st = '<?php echo $booking_time; ?>';
      st = parseInt(st);
      x = parseInt(x);
      var arr = [];
      for (i = 0; i < Math.round(st); i++) {
        arr.push(i);
      }
      var time_string = arr.toString();
      $('.form_datetime').datetimepicker({
        stepping: 30,
        hoursDisabled: time_string,
        setStartDate: '2018/05/1 10:00',
        daysOfWeekDisabled: [x],
        datesDisabled: ['2016/08/20'],
        autoclose: true,
      });
    </script>
    <!--datetime picker end-->
    <script>
      $(document).ready(function() {
        App.init(); // init core
        $('input[name^="checkout"]').click(function(e) {
          $("#my_modal").trigger("click");
          e.preventDefault();
        });
        $("#proceed").click(function() {
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
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" id="proceed" class="btn btn-default" data-dismiss="modal">Proceed</button>
            </div>
          </div>
        </div>
      </div>

    </div>