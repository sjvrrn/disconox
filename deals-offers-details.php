<?php
require_once("header.php");
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
include("db.php");

/*
 *Get Deals Details By PartnerId
 */
if (isset($_GET['vd'])) {
    $partner_id = base64_decode($_GET['vd']);
    $data       = array(
        "clientId" => "x6DmrbsQFZyUUiggs0BZ",
        "partnerId" => $partner_id
    );
    $data_json  = json_encode($data);
    $ul         = url . "dealsByPartner";
    $ch         = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch); //print_r($response);die;
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        $responsObj = json_decode($response, TRUE);
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $response             = (object) $responsObj; //echo"<pre>";
            $message              = $response->message;
            $products             = $response->productDetails;
            $product_list         = $responsObj['productDetails'];
            $products             = $products[0]; //echo"<pre><br>";print_r($products); exit;
            $product_id           = $products['id'];
            $product_name         = $products['name'];
            $highlights           = $products['highlights'];
            $description          = $products['description'];
            $pdf_ids              = $products['pdf_id'];
            $partner_name         = $products['partner_name'];
            $partner_title        = $products['partner_title'];
            $partner_address      = $products['partner_address'];
            $partner_description  = $products['partner_desc'];
            $partner_pic          = trim($products['partner_pic']);
            $partner_instructions = $products['partner_instructions'];
            $location             = $products['location'];
            $facilities           = $products['facilities'];
            $dress_code           = $products['dress_code'];
            $music_genere         = $products['music_genre'];
            //$booking_days  = explode('/',$products['booking_days']);
            $cuisines             = $products['cuisines'];
            $avg_cost             = $products['avg_cost'];
            $menu                 = $products['menu'];
            $hours                = $products['start_time'] . ' - ' . $products['end_time'];
			$partner_rating       = $products['rating'];
        }
    }
    curl_close($ch);
    //Only For Videos and Gallery Of Partner
    $GLOBALS['gallery'] = array();
    allReviews(1);
    $gallery = $GLOBALS['gallery'][0];
}
/*
 *end
 */

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
    <link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
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

      img {
        max-width: 300px;
      }

      .vl {
        margin: 0px !important;
      }
    </style>
    <?php
require_once("top.php");
?>
   <div class="c-layout-page">
      <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <?php
echo back_page();
?>
         </div>
        </div>
      </div>

      <div class="c-bg-grey pad-t-25">
        <div class="container c-bg-white ">
          <div class="col-md-6 col-sm-12">
            <div class="c-info-list ">
              <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                <a class="c-theme-link" href="#"> <i class="fa fa-heart"></i> <?php
echo $partner_name;
?></a></h3>
              <?php
if (isset($pdf_tags)) {
    echo implode(',', $pdf_tags);
}
?>
             <hr>
              <span class="c-review-star">
                    <?php
if ($partner_rating == 5) {
    $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span>';
} elseif ($partner_rating == 4) {
    $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
} elseif ($partner_rating == 3) {
    $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
} elseif ($partner_rating == 2) {
    $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
} elseif ($partner_rating == 1) {
    $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
} else {
    $prat = '<span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
}
?>
             <?php
echo $prat;
?>(
              <?php
echo round($partner_rating,2);
?>)
              </span>

              <?php
echo show_map($partner_name, $location);
?>
             <p><i class="fa fa-road"></i> Address: <span><b> <?php
echo $partner_address;
?></b></span></p>
              <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span> <?php
echo $highlights;
?> </span></p>
              <p><i></i><b>Hours:</b><span><?php
echo $hours;
?></span></p>
              <p><i></i> <b>Description:</b> <span><?php
echo $partner_description;
?> </span></p>
              <p><i></i> <b>Facilities:</b> <span><?php
echo $facilities;
?> </span></p>
              <p><i></i> <b>Dress code:</b> <span><?php
echo $dress_code;
?> </span></p>
              <p><i></i> <b>Music Genre:</b> <span><?php
echo $music_genere;
?> </span></p>
              <p><i></i> <b>Cuisines:</b> <span><?php
echo $cuisines;
?> </span></p>
              <p><i></i> <b>Average cost for two:</b> <span><i class="fa fa-inr mar-rl-10 "></i><?php
echo $avg_cost;
?>/- </span></p>
              <p><i></i> <b>Menu:</b>
                <div class="col-md-6 col-sm-12"> <span><img src="partners/<?php
echo $menu;
?>" class="img-responsive" style="height:75%"></span></div>
              </p>
              <br>
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <img class="img-responsive c-margin-t-15 c-margin-b-15" src="<?php
echo 'partners/' . $partner_pic;
?>">
          </div>
          <div class="listing-outer">
            <div class="c-content-product-2 ">
              <div class="col-md-12 c-padding-20">
                <h3 class="c-font-24">Offering Deals & Offers</h3>
                <?php
echo $deal;
?>
               <div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-12">
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="date-time" aria-hidden="true">
          <div class="modal-dialog modal-sm">
            <div class="modal-content c-square">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                <h4 class="modal-title" id="date-time">Select Date & Time</h4>
              </div>
              <div class="modal-body">
                <fieldset>
                  <div class="form-group">
                    <input name="date" type="text" id="datetime_picker" class="form-control" placeholder="Select Date & Time"/>
                    <br/>
                  </div>
                </fieldset>
                <div class="modal-footer">
                  <button type="button" id='done' name="checkout1" value="checkout" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Done</button>
                  </a>
                  <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Back</button>
                </div>

              </div>
            </div>
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
<!--review rating start-->
      <div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          <div class="c-product-tab-container">
            <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40" style="font-weight:400 !important">Reviews & Rating</h3>
           <?php
rating(1);
?>
         </div>
          <?php
if ($_SESSION['role'] > 2) {
    comment(1);
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
      
    </div>
  </body>

</html>
<?php
require_once('footer.php');
?>

<div class="col-md-3 col-sm-12">
  <div class="container">
    <button type="button" id="my_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='display:none'>Open Modal</button>
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h2>Terms & Conditions </h2>
<?php
/*
 *get terms and conditions
 */
$termsConditions = termsConditions($_GET['vd']);
//end
?>
         </div>
          <p>
            <div>
              <ul>
                <?php
echo $comment;
?>
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
<!--/*
 *start rating  
 */-->
<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<script src="assets/base/js/starrr.min.js"></script>
<style>
.starrr { display: inline-block; }

.starrr i {
  font-size: 16px;
  padding: 0 1px;
  cursor: pointer;
  color: #ffd119;
}
</style>
 <!--//end-->

  <script>
  var jq = $.noConflict();
    //jq(document).on("click",".st",function(e){  e.stopPropagation(); e.preventDefault(); }).	
	$(document).ready(function() {
	  $(document).on('click', '#booknow', function() {
        var bookid = $(this).data('ids');
        $("#bookid").val(bookid);
      });
      $(document).on('click', '#done', function(e) {
        $("#my_modal").trigger("click");
        e.preventDefault();
      });
      $(document).on('click', '#proceed', function() {
        var time = $("#datetime_picker").val();
        $("#time").val(time);  
        if (time == "") {
          alert("please Select Date and Time");
          return false;
        }
        var bookid = $("#bookid").val();
        $("#checkout" + bookid).trigger("click"); 
      });
    });
  </script>
  <script type="text/javascript">
    var x = '<?php
echo $booking_days;
?>';
    var st = '<?php
echo $booking_time;
?>';
    st = parseInt(st);
    var arr = [];
    for (i = 0; i < Math.round(st); i++) {
      arr.push(i);
    } 
    var time_string = arr.toString();
     $('.form_datetime').datetimepicker({
      stepping: 30,
      hoursDisabled: time_string,
      startDate: '+1d',
      daysOfWeekDisabled: [x, 2],
      datesDisabled: ['2016/08/20'],
      autoclose: true,
    }); 
  </script>