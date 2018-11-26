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
<style>
#map{
	margin-bottom:-3%;	
}
.tooltip1 {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}
.tooltip1 .tooltiptext {
    visibility: hidden;
    width: 150px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: 100%;
    left: 50%;
    margin-left: -60px;
	font-size:13px;
}
.tooltip1 .tooltiptext::after {
    content: "";
    position: absolute;
    bottom: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent transparent black transparent;
}
.tooltip1:hover .tooltiptext {
    visibility: visible;
}
</style>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<?php
$term = "";
$img = "";
$part_rating = "";
$prat = "";
$r = ""; 
require_once("header.php");
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
include("db.php");

 $GLOBALS['gallery'] = array();
    allReviews(1);
    $gallery = $GLOBALS['gallery'][0];

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
/*
 * get book details 
 */
 $partner_id = base64_decode($_GET['vd']);  
/*content start*/
/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"partnerId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ur = url."booktableByPartner";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ur);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch);//echo"<pre>"; print_r($response); exit;
    if ($response === false) {
        $info = curl_getinfo($ch);
        curl_close($ch);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    } else {
        $responsObj = json_decode($response, TRUE);
        if ($responsObj["error"]) {
            echo "Bad Request";
        } else {
            $index = $responsObj['productDetails'][0];//echo"<pre>"; print_r($index); exit;
			$product = $responsObj['productDetails']; 
			$cuisines  = $index['cuisines'];
			$avg_cost  = $index['avg_cost'];
			$menu     = $index['menu'];
			$name = $index['name'];// => spider
			$start_date_time = explode(' ',$index['start_date_time']);$start_date = $start_date_time[0];
			$end_date_time   = explode(' ',$index['end_date_time']); $end_date = $end_date_time[0];  
            $start_time     = $index['start_time'];
            $end_time       = $index['end_time'];
            $category_id = $index['category_id'];
            $highlights = $index['highlights'];
            $description = $index['description'];
            $artist_info = $index['artist_info'] ;
			$pbt_ids = explode(',',$index['pbt_ids']);
			$pbt_catids = explode(',',$index['pbt_catids']);
			$ps_price = explode(',',$index['ps_price']);
			//Partner Data
			$partner_title = $index['partner_title'] ;//=> partner_title
            $partner_pic = $index['partner_pic'];// => assets/uploads/41e74a569578d40969b550cba409d198.jpg
            $terms  = explode(";",$index['terms']); 
			$facilities = $index['facilities'];
			$dress_code = $index['dress_code'];
			$music_genre = $index['music_genre'];
			$offer_days = explode('/',$index['booking_days']);
			$partner_rating  = $index['rating'];
			$location   = $index['location'];
		}
    }
    curl_close($ch);
/*end*/
/*------------------------------------------------------------------------------------------------------*/

?>
</head>

<link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">

<body class="c-layout-header-fixed">
<!-- BEGIN: LAYOUT/HEADERS/HEADER-1 --> 
<!-- BEGIN: HEADER -->
<?php require_once("top.php");?>
<link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
<style>
  .vl{
	margin:0px !important;
   }
</style>
<!-- END: HEADER --> 
<!-- BEGIN: PAGE CONTAINER -->
<div class="c-layout-page"> 
  <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-1 -->
  <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
      <div class="container">
        <div class="col-md-9"></div>
        <div class="col-md-3"><?php  echo back_page();?></div>
      </div>
  </div>
  <div class="c-bg-grey pad-t-25">
    <div class="container">
      <div class="listing-outer">
        <h3 class="c-title c-font-bold c-font-22 c-font-dark"><a class="c-theme-link" href="#"><?php if(isset($details->name)) { echo $details->name; }?> </a></h3>
        <div class="c-content-product-2 c-bg-white">
          <div class="col-md-6"> 
            <div class="c-info-list"> 
             <br>
             <img class="img-responsive" alt="" src="<?php echo "partners/".$partner_pic;?>" > 
              <hr>
              <p><i class="fa fa-heart"></i> Venue: <span><b> <?php if(isset($Name)) { echo $name ; }?>&nbsp;&nbsp;&nbsp;
			  <?php if(isset($partner_name)) { echo $partner_name; } ?></b></span> <?php echo $tags;?> </p>
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
                  <?php echo $partner_rating; ?>(<?php echo round($partner_rating); //number_format((float)$partner_rating,'2','.',''); ?>) 
              </p>
              <?php echo show_map($partner_name,$location);?>
                <p><i class="fa fa-road"></i> Address: <span><b><?php echo $partner_address;?></b></span></p>
                <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span><?php echo $highlights;?></span></p>
			    <p><i></i> <b>Timings:</b> <span> <?php echo $partner_description; ?> </span></p>
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
          <div class="col-md-6 c-padding-20">
            <p class="c-margin-b-10 c-font-20">BOOK A TABLE</p>
            <div class="table-group">
				<!--start_date_time--->
					 <div class="row">
                                            
                                            <div class="col-md-7 col-xs-7">
                                            <p><i class="fa fa-calendar"></i> From Date: <span><b>
											</b> <?php echo $start_date; ?> to <?php echo $end_date; ?></b></span></span></p>
                                            </div>
                                            
                                            <div class="col-md-5 col-xs-5">
                                            <p><i class="fa fa-clock-o"></i> Time: <span><b><?php echo $start_time; ?>to <?php echo $end_time;?></b></span></span></p>
                                            </div>
                                            
											</div>
					<!--end_date_time-->
             <form method="post" action="checkout.php?pd=NA==" id="checkout_form">
               <input type="hidden" value="BOOK A TABLE" name="item">
			   <input type="hidden" value="BOOK A TABLE" name="time" id="time">
              <ul>
                <?php   
				  
				    foreach($product as $detail){
					$detail = (object)$detail;  
					$price = explode(',',$detail->ps_price);
					$pbt_catname = explode(',',$detail->pbt_catids);
					for($i=0;$i<count($price);$i++){  
					?>
                    <li class="tooltip1"> <a id="customoptions_image_0_0" title="" onClick="return false;" href="#"> <img class="small-image-preview img-responsive v-middle" title="" src="assets/images/<?php echo ($i+1)*2;?>s.png"> <span class="tit"><?php echo $pbt_catname[$i];?><br>
                      <span class="c-font-12"><i class="fa fa-inr"></i> <?php echo $price[$i]; ?>/- </span></span></a>
                      <input id="options_9_3" name="price" class="radio validate-one-required-by-name product-custom-option" type="radio" value="<?php echo $price[$i]; ?>"  onClick="opConfig.reloadPrice();">
                     <span class="tooltiptext">The amount is redeemable against your bill</span>
                    </li>	
                    <?php 
					$i++;
					 } 
					} ?>
              </ul>
              <div class="col-md-12 col-sm-xs12"> 
			  <input type='hidden' name="checkout" value="checkout">
                <input type="submit" name='checkout' id='checkout1' value="checkout" class="btn c-margin-t-5 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" style="display:none">
				 <button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm">BOOK NOW</button>
                </div>
             </form>
            </div>
            <!--table group-->
            <div> </div>
          </div>
        </div>
      </div>
      <!-------------------------------------pick start-->
		<div class="col-md-3 col-sm-12">
                                     
                                      
                                      <!--MODEL </div>START one modal for all packages-->
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
                                                    <input name="date" type="text" id="datetime_picker"  class="form-control" placeholder="Select Date & Time"/>
                                                    <br/>
                                                  </div>
                                                </fieldset>
                                                <div class="modal-footer">
                                                  <button type="button"  id='done' name="checkout1" value="checkout" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Done</button>
                                                  </a>
                                                  <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Back</button>
                                                </div>
                                             
                                            </div>
                                            <!-- /.modal-content --> 
                                          </div>
                                          <!-- /.modal-dialog --> 
                                        </div>
                                      </div>
									  	
      </div>
		<!--pic end---------------------------------------->
      <!--end--> 
      
    </div>
  </div>
  
  <!--cz content start-->
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
rating(4);
?>
         </div>
          <?php
if ($_SESSION['role'] > 2) {
    comment(4);
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
<!---comment End-->
</div>
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
</body>
</html>

<script>
	$(document).ready(function()
	{
		App.init(); // init core
	 $('input[name^="checkout"]').click(function(e){
		$("#my_modal").trigger("click");
		e.preventDefault();

	});
			
		$("#stop").click(function(){
		return false;
		});				
	});
</script>
	<!--modal div start----------------------------------------------------->
<div class="container">
  
  <!-- Trigger the modal with a button -->
  <button type="button"  id="my_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='display:none'>Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">TERMS AND CONDITIONS</h4>
        </div>
		<!--<p>
              <div>
                <h2>Terms & Conditions </h2>
                <ul>
                  <?php echo $term; ?>
                </ul>
              </div>
            </p>-->			     <!--  <div class="modal-footer">
          
        </div>-->
		<div class="modal-footer">
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="proceed" class="btn btn-default" data-dismiss="modal">Proceed</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>		<!--modal div end-------------------------------------------------------->
	<!--modal div start----------------------------------------------------->
<div class="container">
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      </div>
  </div>
  
</div>		<!--modal div end-------------------------------------------------------->
<!--date time picker--> 
<script type="text/javascript">
var x   = '<?php echo $booking_days;?>';
var st  = '<?php echo $booking_time; ?>';
st = parseInt(st);
var arr = [];
for(i=0;i<Math.round(st);i++){
	arr.push(i);
}
var time_string = arr.toString(); 
//$('#datepicker').datepicker('setStartDate', "01-01-1900");
$('.form_datetime').datetimepicker({
  	stepping: 30,
    hoursDisabled: time_string,
	setStartDate: '2018/05/1 10:00',
    daysOfWeekDisabled: [x,2],
    datesDisabled: ['2016/08/20'],	
    autoclose: true,   
    });
    </script>
	<script>
	$(document).ready(function(){
		$(document).on('click','#done',function(e){ 
	$("#my_modal").trigger("click");
				e.preventDefault();
});	
$("#proceed").click(function(){   
	 var time = $("#dtp_input1").val();
	 $("#time").val(time);
	 if(time==""){
		 alert("please Select Date and Time"); //return false;
	 }
		 document.getElementById('checkout_form').submit();
	});			
});
</script>        
    
<script type="text/javascript">
var x   = '<?php echo $booking_days;?>';
var st  = '<?php echo $booking_time; ?>';
x = parseInt(x);
st = parseInt(st);
var arr = [];
for(i=0;i<Math.round(st);i++){
	arr.push(i);
}
var time_string = arr.toString(); 
$('.form_datetime').datetimepicker({
  	stepping: 30,
    hoursDisabled: time_string,
	setStartDate: '2018/05/1 10:00',
    daysOfWeekDisabled: [x],	
    autoclose: true,   
});
</script>