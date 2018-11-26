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
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  <?php
require_once("header.php"); 
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
include("db.php");


if(isset($_GET['vd'])){ 
$partner_id = base64_decode($_GET['vd']); 
/*get posts*/ 
$data = array( 
"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
"partnerId"=>$partner_id 
); 
$data_json = json_encode($data);   //print_r($data_json); exit;
$ul= url."bookentryDetailsById"; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $ul); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
$response = curl_exec($ch); //echo"<pre>"; print_r($response); exit;
if ($response === false) { $info = curl_getinfo($ch); curl_close($ch); 
die('error occured during curl exec. Additioanl info: ' . var_export($info)); 
} else {  
$responsObj = json_decode($response, TRUE); 
if ($responsObj["error"]) { echo "Bad Request"; } else { 
$response = $responsObj;
$message = $response['message']; 
$details = $response['entryDetails'][0];
$entry_title = $details['productname']; 
$products = $response['entryDetails'];
$cuisines = $details['cuisines'];
$avg_cost = $details['avg_cost'];
$menu     = $details['menu'];
$start_date_time = $details['start_date_time'];
$end_date_time   = $details['end_date_time'];
$name = $details['NAME']; 
$category_id = $details['id']; 
//$category_id = $details['category_id']; 
//$highlights = $details['highlights']; 
$description = $details['description']; 
$pe_event_description = explode('/',$details['event_description']); 
$artist_info = $details['artist_info'] ; 
$pe_ids = $details['product_id'];
$tags = $details['tags']; 
//$partner_name = $details['partner_name'] ; 
//$partner_title = $details['partner_title'] ; 
//$partner_address = $details['partner_address']; 
//$partner_desc = $details['partner_desc']; 
//$partner_pic = $details['partner_pic']; 
$location = $details['location']; 
$terms = explode(";",$details['terms']); 
$facilities = $details['facilities']; 
$dress_code = $details['dress_code']; 
$music_genre = $details['music_genre']; 
$booking = explode('/',$details['booking_days']); 
} } 
curl_close($ch); 

$GLOBALS['gallery'] = array();
allReviews(3);
$gallery = $GLOBALS['gallery'][0];
/*Gallery images*/ 
if(isset($gallery) && $gallery !="")
{
foreach($gallery as $image){
	if($image){
		$img .='<div class="item cbp-item">
    <div class="cbp-caption">
        <a href="partners/'.$image.'" class="cbp-lightbox"> <img src="partners/'.$image.'" style="height:140px;"> </a>
    </div>
</div>'; 
} 
}
} ?>
<?php } /*end*/ ?>
  <style>
    .vl {
      margin: 0px !important;
    }
  </style>
 
  <body class="c-layout-header-fixed">
    <?php
	require_once( "top.php");
	?>
	<style>
select {
  
  font-size: 16px;
  border: 1px solid #ccc;
  height: 34px;
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
}
</style>
	 <script>
				/* function myFunction(str) {
					if (str=="") 
					{
                      document.getElementById("txtHint").innerHTML="";
                      return;
                    } 
                    if (window.XMLHttpRequest) 
					{
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                     xmlhttp=new XMLHttpRequest();
                    } else 
					{ // code for IE6, IE5
                      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange=function() 
					{
                     if (this.readyState==4 && this.status==200) 
					 {
                       document.getElementById("txtHint").innerHTML=this.responseText;
                     }
                    }
                      xmlhttp.open("GET","gettickets.php?q="+str,true);
                    xmlhttp.send();

  
                } */

				</script>
    <div class="c-layout-page">
      <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
        <div class="container">
          <div class="col-md-9"></div>
          <div class="col-md-3">
            <?php echo back_page();?>
          </div>
        </div>
      </div>
      <div class="c-bg-grey">
        <div class="container">
          <div class="listing-outer">
            <div class="c-content-product-2 c-bg-white">
              <div class="col-md-6">
                <div class="c-info-list">
                  <br>
                  <img class="img-responsive" alt="" src="<?php echo 'partners/'.$partner_pic;?>">
                  <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                    <a class="c-theme-link" href="#">
                      <?php //echo $name;?>
                    </a>
                  </h3>
                  <hr>
                  <p><i class="fa fa-heart"></i> Venue: <span><b><?php echo $entry_title;?></b></span>
                    <span class="label label-default c-font-slim"><?php echo $tags;?></span>
                  </p>
                  <p class="c-review-star">
                    <span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>() </p>
                  <?php echo show_map($partner_name,$location);?>
                  <!--<p><i class="fa fa-calendar"></i> Date: <span><b> 29 Feb 2017</b></span></p>
                    <p><i class="fa fa-clock-o"></i> Time: <span><b> 6.30 pm</b></span></p>-->
                  <p><i class="fa fa-road"></i><b> Address:</b> <span><?php echo  $partner_address; ?></span>
                  </p>
                  <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span><?php echo $tags;?></span>
                  </p>
                  <p><i></i> <b>Hours:</b> <span><?php echo  $details['start_time'].'  '.$details['end_time'];?> </span>
                  </p>
                  <p><i></i> <b>Facilities:</b> <span><?php echo $facilities; ?></span>
                  </p>
                  <p><i></i> <b>Description:</b> <span><?php echo $description;?> </span></p>
                  <p><i></i> <b>Dress code:</b> <span><?php echo $dress_code; ?></span>
                  </p>
                  <p><i></i> <b>Music Genre:</b> <span><?php echo $music_genre;?></span>
                  </p>
                  <p><i></i> <b>Cuisines:</b> <span><?php echo $cuisines; ?></span>
                  </p>
                  <p><i></i> <b>Average cost for two:</b> <span><?php echo $avg_cost; ?></span>
                  </p>
                  <?php if($menu){ ?>
                  <p><i></i> <b>Menu:</b>
                   <div class="col-md-6 col-sm-12"> <span><img src="partners/<?php echo $menu;?>" class="img-responsive"></span></div>
                  </p>
                  <?php } ?>
                </div>
              </div>
              <!-----new part ------>
              <div class="col-md-6 c-padding-20">
                <!--start_date_time--->
                <?php  $start = explode(' ',$start_date_time);
                       $end   = explode(' ',$end_date_time);
					?>
					<?php 
					$i=0;
					foreach($products  as $product){  
						$product = (object)$product;
						$price = explode('/',$details['price']);
						$name = explode('/',$details['NAME']); 
						$desc = explode('/',$details['description']) ; 
						$image =  $product->event_image; 
						$description = $product->event_description;
						?>
                <div class="row" style="padding-top:10%">

                  <div class="col-md-7 col-xs-7">
                    <p><i class="fa fa-calendar"></i> From Date: <span><b>
					<?php 
					echo $product->start_date_time;?></b> to<b> <?php  echo $product->end_date_time; ?></b></span></span>
                    </p>
                  </div>
                  <div class="col-md-5 col-xs-5">
                    <p><i class="fa fa-clock-o"></i> Time: <span><b>
					<?php echo $product->start_time; ?> </b>to<b><?php echo $product->end_time;?>
					</b></span>
                    </p>
                  </div>

                </div>
		    <div class="row">
             <div class="col-md-5 col-xs-5">
                    <img src="partners/<?php echo $image;?>" style="width:203%">
                  </div>
			</div>			
				<div class="row">
			<div class="col-xs-4 col-md-5">
			Event Description
			</div>
			<div class="col-xs-4 col-md-7">
			<?php echo $description;?>
			</div>
			</div>
                <!--end_date_time-->
				
                <p class="c-margin-b-10 c-font-20"></p>
                <div class="sur-select">
                  <div class="col-md-6 col-xs-12">
                    <div class="form-group mar-b-0">
                      <form action="checkout.php" method="post" id="checkout_form">
                        <input type="hidden" name="time" id="time">
						<input type="hidden" id="form_no" name="form_no" value="">
					<select id="count" onchange="myFunction(this.value)" name="countNumberTickets">
					            <option value="">Select Number of Tickets</option>
                                <option value="<?php echo $pe_price[0]; ?>">1</option>
								<option value="<?php echo $pe_price[0]; ?>">2</option>
                                <option value="<?php echo $pe_price[0]; ?>">3</option>
                                <option value="<?php echo $pe_price[0]; ?>">4</option>
                                <option value="<?php echo $pe_price[0]; ?>">5</option>
                                <option value="<?php echo $pe_price[0]; ?>">6</option>
                                <option value="<?php echo $pe_price[0]; ?>">7</option>
</select>	
                  
                      </form>
                    </div>
                  </div>
                  
                </div>
                <div class="clearfix"></div>
				<!----entry desc -->
				
				<!--entry desc end-->
                <div class="c-content-accordion-1 c-theme" >
                  <!--panel-->
                  <?php  //r($i=0; $i<count($price); $i++){?>
                  <!-----panel----->
                  <form action="checkout.php?pd=Nw==" method="post" id="stag_form1<?php echo $i;?>">
				   <input type="hidden" name="price" id="price" value="<?php echo $pe_price[0]; ?>">
				  <div id="txtHint">
				  <script>
				/*   $(document).ready(function(){
					  $(document).on('click','#stag',function(){
						  var count = $("#count").val();
						  alert(count); 
					  });
					  
				  }); */
				  </script>
                    <div class="panel" id='stag'>
                      <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                          <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2<?php echo $i;?>" aria-expanded="false" aria-controls="collapseTwo2<?php echo $i; ?>">Stag<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                        </h4>
                      </div>
                      <div id="collapseTwo2<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                        <div class="panel-body">

                          <div class="col-md-9 col-xs-12">

                            <p class="lit-info2">
							 <label class="checkbox-inline">Name: <?php echo $name[0]; ?></label>
							</p>
							<p class="lit-info2">
                             <label class="checkbox-inline">Price: Rs. <?php echo $price[0]; ?>/-</label>
                            </p>
                           <p class="lit-info2">
                              <label class="checkbox-inline">Desc:<?php echo $desc[0]; ?></label>
                              <input type="hidden" name="item" id="item" value="<?php echo $desc[0]; ?>">
                            </p>
							<hr>
                           </div>
                           
                          <div class="col-md-3 col-xs-12">
                              <input type="hidden" name="item" id="item" value="<?php echo $name[0]; ?>">
                              <input type="hidden" name="price" value="<?php echo $price[0]; ?>">
                              <input type="hidden" name="desc" name="<?php echo $desc[0]; ?>">
                              <input type="submit" id="1<?php echo $i;?>" name="checkout" data-id="stag_form" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
							  
                              </p>
                            </div>
                          
                        </div>
                      </div>
                    </div>
					</div>
                  </form>
                  <?php //} ?>
                  <!-----panel----->
                  <form action="checkout.php?pd=Nw==" method="post" id="stag_form2<?php echo $i; ?>">
		<input type="hidden" name="price" id="price" value="<?php if(isset($pe_price[1])){ echo $pe_price[1]; } ?>">
                    <div class="panel" >
                      <div class="panel-heading" role="tab" id="headingTwo1">
                        <h4 class="panel-title">
                          <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1<?php echo $i;?>" aria-expanded="false" aria-controls="collapseTwo1<?php echo $i;?>">Single Girl<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                        </h4>
                      </div>
                      <div id="collapseTwo1<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                        <div class="panel-body">

                          <div class="col-md-9 col-xs-12">

                          <p class="lit-info2">
							 <label class="checkbox-inline">Name: <?php echo $name[1]; ?></label>
							</p>
							<p class="lit-info2">
                             <label class="checkbox-inline">Price: Rs. <?php echo $price[1]; ?>/-</label>
                            </p>
                           <p class="lit-info2">
                              <label class="checkbox-inline">Desc:<?php echo $desc[1]; ?></label>
                              <input type="hidden" name="item" id="item" value="<?php echo $desc[1]; ?>">
                            </p>
                            <hr>
                           </div>
                            <div class="col-md-3 col-xs-12">
                               <input type="hidden" name="item" id="item" value="<?php echo $name[1]; ?>">
                              <input type="hidden" name="price" value="<?php echo $price[1]; ?>">
                              <input type="hidden" name="desc" name="<?php echo $desc[1]; ?>">
                              <input type="submit" id="2<?php echo $i;?>" name="checkout" data-id="stag_form" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                              </p>
                            </div>
                        
                        </div>
                      </div>
                    </div>
                  </form>
                  <!-----panel-->
                  <!-----panel-->
                  <form action="checkout.php?pd=Nw==" method="post" id="stag_form3<?php echo $i;?>">
						<input type="hidden" name="price" id="price" value="<?php if(isset($pe_price[2])){ echo $pe_price[2]; }?>">
                    <div class="panel">
                      <div class="panel-heading" role="tab" id="headingTwo3">
                        <h4 class="panel-title">
                          <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3<?php echo $i;?>" aria-expanded="false" aria-controls="collapseTwo3<?php echo $i;?>">Couple<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                        </h4>
                      </div>
                      <div id="collapseTwo3<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                        <div class="panel-body">

                          <div class="col-md-9 col-xs-12">
						<p class="lit-info2">
							 <label class="checkbox-inline">Name: <?php echo $name[2]; ?></label>
							</p>
							<p class="lit-info2">
                             <label class="checkbox-inline">Price: Rs. <?php echo $price[2]; ?>/-</label>
                            </p>
                           <p class="lit-info2">
                              <label class="checkbox-inline">Desc:<?php echo $desc[2]; ?></label>
                              <input type="hidden" name="item" id="item" value="<?php echo $desc[2]; ?>">
                            </p>
                            <hr>
                          </div>
                            
                          <div class="col-md-3 col-xs-12">
                               <input type="hidden" name="item" id="item" value="<?php echo $name[2]; ?>">
                              <input type="hidden"  id="price" name="price" value="<?php echo $price[2]; ?>">
                              <input type="hidden" id="desc"  name="desc" name="<?php echo $desc[2]; ?>">
                                <input type="button" id="3<?php echo $i;?>"  name="checkout" data-id="stag_form" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                            </p>
                            </div>
                         
                        </div>
                      </div>
                  </form>
                  <!----/panel----->
                  </div>
                </div>
				<?php $i++; } ?>
              </div>
			  	
              <!------new part----->
            </div>
            <!---media end-->
            <!--<div class="c-bg-white pad-bt-25">
          <div class="container">
            <h1>About Event</h1>
            <p>couple -ticket</p>
          </div>
        </div>-->
          </div>
        </div>
        <!-----container end----->
        <!-----slider----->
        <div class="c-content-box c-size-sm c-bg-dark">
          <div class="container">
            <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
              <div class="owl-carousel owl-theme c-theme owl-bordered1">
                <?php 
				if(isset($img))
				{
					echo $img;
				}					
				?>
              </div>
            </div>
          </div>
        </div>
        <!-----/slider----->

        <!-----pick start----->
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
                      <input name="date" type="text" id="datetime_picker"  class="form-control" placeholder="Select Date & Time"/>
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
        <!-----pic END----->
		<!--container END-->
      </div>
    </div>
    <a name="footer"></a>
    <div class="c-layout-go2top"> <i class="icon-arrow-up"></i> </div>
  </body>

</html>
<script>
  /** init datepicker */
  $(document).ready(function() {
    $(document).on('click', '#done', function(e) {
		var time = $("#datetime_picker").val();
		var count = $("#count").val(); alert(count);
		
      $("#my_modal").trigger("click");
      e.preventDefault();
      //$("#checkout").trigger('click');
    });
    $(document).on('click', '#proceed', function() {
      $("#time").val(time);
      if (time == "") {
        alert("please Select Date and Time");
        return false;
      }
      var count = $("#count").val(); 
      var price = parseInt($("#cost").val());
      $("#price").val(count * price);
      $("#checkout").trigger("click");
    });
  });
</script>


<script>
  $(document).ready(function() {

    $.fn.stars = function() {
      return $(this).each(function() {
        var val = parseFloat($(this).html());
        var size = Math.max(0, (Math.min(5, val))) * 16;
        var $span = $('<span />').width(size);
        $(this).html($span);
      });
    }
  });
</script>

<script>
  $(document).ready(function() {
   // App.init(); // init core
    $('input[name^="checkout"]').click(function(e) { 
	var id = this.id; 
	$("#form_no").val(id);
	
     // $("#my_modal").trigger("click");
      e.preventDefault();
    }); 
    $("#proceed").click(function() { 
     var id = $("#form_no").val();
     if(id==0){
		 var count = $("#count").val();
		 if(count<3){ alert('--');
			 return false;
		 }
		 
	 }     
	 $('#stag_form'+id).submit();
    });
    $("#stop").click(function() {
      return false;
    });
	
  });
</script>
<!--modal div start----------------------------------------------------->
<div class="container">
  <button type="button" id="my_modal" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" style='display:none'>Open Modal</button>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h2>Terms & Conditions </h2>
        </div>
        <p>
          <div>
		  <?php
/*
 *get terms and conditions
 */
 $termsConditions = termsConditions($_GET['vd']);
//end
 ?>
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
</div>
</div>
</div>
</div>
<div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          <div class="c-product-tab-container">
            <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40" style="font-weight:400 !important">Reviews & Rating</h3>
           <?php rating(3); ?>
          </div>
		  <?php    if($_SESSION['role']>2){
			  comment(3);
		}else{?>
		<div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          </div>
      </div>
	    <?php }?>
		  
        </div>
      </div>
</div>
<?php require_once( 'footer.php');?>
</body>

</html>
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
<script type="text/javascript">
  var x = '<?php echo $booking_days;?>';
  var st = '<?php echo $booking_time; ?>';
  st = parseInt(st);
  var arr = [];
  for (i = 0; i < Math.round(st); i++) {
    arr.push(i);
  }
  var time_string = arr.toString();
  //$('#datepicker').datepicker('setStartDate', "01-01-1900");
  $('.form_datetime').datetimepicker({
    stepping: 30,
    hoursDisabled: time_string,
    setStartDate: '2018/05/1 10:00',
    daysOfWeekDisabled: [x, 2],
    datesDisabled: ['2016/08/20'],
    autoclose: true,
  });
</script>