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
if(isset($_POST['submit'])){
			//start
			$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"name"=> $_SESSION['id'],
		"email"=>$_SESSION['email'],
		"phone"=>$_SESSION['phone'],
		"comment"=>$_POST['comment']
        );
    $api_url = url."comment"; 
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
			  }
if(isset($_GET['vd'])){
  $partner_id = base64_decode($_GET['vd']);  
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"partnerId"=>$partner_id
    );
    $data_json = json_encode($data);
	$ul= url."guestlistByPartner";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch); //echo"<pre>";print_r($response); exit;
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
            $products = $response['productDetails'][0];// echo"<pre>"; print_r($products); exit;
			            $start_date_time = $products['start_date_time'];
						$cuisines    = $products['cuisines'];
						$avg_cost    = $products['avg_cost'];
						$menu        = $products['menu'];
						$end_date_time   = $products['end_date_time'];
						$start_time = $products['start_time'];
						$end_time  = $products['end_time'];
     					$highlights = $products['highlights'];// => dfssdf
						$description = $products['partner_desc'];// 
						$facilities  = $products['facilities'];
						$dress_code  = $products['dress_code'];
						$music_genre = $products['music_genre'];
						$location  = $products['location'];
						$guest_list_name = explode(',',$products['guest_list_name']);
						$price     = explode(',',$products['price']);
						$actual_price = explode(',',$products['actual_price']);
		        }
    }
    curl_close($ch);
	
}    
     /*$sql = "SELECT pr.rating,pr.review,pr.created,u.name,u.image 
					FROM  `product_reviews` pr
					LEFT JOIN `users` u ON u.id=pr.uid
					WHERE pr.pid=".$partner_id;
	 $res=mysqli_query($con,$sql);
	$r=0;   
	 while($rec =  mysql_fetch_assoc($res)){ 
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
	} */
    /*Terms defination*/
	
?>
<style>
.vl{
margin:0px !important;
}
</style>
<script>
				function myFunction(str) {
					
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
                      xmlhttp.open("GET","guesttickets.php?q="+str,true);
                    xmlhttp.send();

  
                }

				</script>
<link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
</head>
<?php 
$GLOBALS['gallery'] = array();
allReviews(7);
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
}
?>
<body class="c-layout-header-fixed">
<?php require_once('top.php');?> 
        <div class="c-layout-page">
            <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
              <div class="container">
                <div class="col-md-9"></div>
                <div class="col-md-3"><?php  //echo back_page();?></div>
              </div>
            </div>
            <div class="c-bg-grey pad-t-25">
            <div class="container">
            <div class="listing-outer">
                <h3 class="c-title c-font-bold c-font-22 c-font-dark"><a class="c-theme-link" href="#">
				<?php  if(isset($details->name)) { echo $details->name; }?> </a></h3>
            	<div class="c-content-product-2 c-bg-white">
                            <div class="col-md-5">
                             <div class="c-info-list">
                                  <?php 
								  //$guest  =(object)$products[0]; 
								  ?><br>
                                    <img class="img-responsive" alt="" src="<?php echo "partners/".$partner_pic;?>"> 
                                    <hr>
                                    <p><i class="fa fa-heart"></i> Venue: <span><b> <?php echo $partner_name ;?></b></span><br>
                                    <?php   if(isset($products[0]['ptags'])) { echo $products[0]['ptags']; }?>
                                    </p>
                                    <p class="c-review-star">
                                     <?php  						 
									  if($part_rating==5){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span>';
									  }elseif($part_rating==4){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
										
									  }elseif($part_rating==3){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
										
									  }elseif($part_rating==2){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									   
									  }elseif($part_rating==1){
										  $prat = '<span class="fa fa-star c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									  }else{
										  $prat = '<span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span><span class="fa fa-star-o c-theme-font"></span>';
									  }
									  ?>
									  <?php  echo $prat; ?>(<?php echo $r; ?>) 
                                    </p>

                <?php echo show_map($partner_name,$location);  ?>
                <p><i class="fa fa-road"></i> Address: <span><b><?php echo $partner_address;  ?></b></span></p>
                <p><i></i> <b>Timings:</b> <span> <?php echo $start_time.'  '.$end_time; ?> </span></p>
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
            <?php  
			$start = explode(' ',$start_date_time);
            $end   = explode(' ',$end_date_time);
			?>
            <div class="col-md-6 c-padding-20">
              <!--start_date_time--->
              <div class="row">

                <div class="col-md-7 col-xs-7">
                  <p><i class="fa fa-calendar"></i> From Date: <span><b>
				  <?php 
					if(isset($start_date_time))
					{
					echo $start[0];
					}
					?></b><?php if(isset($start_date_time) && isset($end_date_time)){ ?> to <?php } ?><span><b>
					<?php  
					if(isset($end_date_time)){ echo  $end[0]; } 
					?></b></span></span>
                  </p>
                </div>

                <div class="col-md-5 col-xs-5">
                  <p><i class="fa fa-clock-o"></i> Time: <span><b>
				  <?php echo $start_time;?></b> to <span><b>
					<?php echo $end_time;?></b></span></span>
                  </p>
                </div>

              </div>
              <!--end_date_time-->
              <p class="c-margin-b-10 c-font-20">CHOOSE Guest List Options</p>
              <div class="sur-select">
                <div class="col-md-6 col-xs-12">
                  <div class="form-group mar-b-0">
                    <form action="checkout.php?pd=Mw==" method="post" id="checkout_form">
                      <input type="hidden" name="time" id="time">
					  <select id="count" onchange="myFunction(this.value)" name="countNumberTickets">
					            <option value="">Select Number of Tickets</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_1'; ?>">1</option>
								<option value="<?php echo $actual_price[0].'_'.$price[0].'_2'; ?>">2</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_3'; ?>">3</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_4'; ?>">4</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_5'; ?>">5</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_6'; ?>">6</option>
                                <option value="<?php echo $actual_price[0].'_'.$price[0].'_7'; ?>">7</option>
                     </select>
                    </form>
                  </div>
                </div>
                <div class="col-md-6 col-xs-12">
                  <div class="form-group mar-b-0">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="c-content-accordion-1 c-theme">
                <!--panel-->
                <?php  //r($i=0; $i<count($price); $i++){?>
                <!-----panel----->
                <form action="checkout.php?pd=Mw==" method="post" id="single_form1">
				<div id="txtHint">
				<input type="hidden" name="price" id="price" value="<?php echo $price[0]; ?>">
				  <div class="panel">
                    <div class="panel-heading" role="tab" id="headingTwo">
                      <h4 class="panel-title">
                        <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2" aria-expanded="false" aria-controls="collapseTwo2">Stag<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                      </h4>
                    </div>
                    <div id="collapseTwo2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                      <div class="panel-body">

                        <div class="col-md-9 col-xs-12">
                          <p class="lit-info2">
                            <label class="checkbox-inline">Actual Price:<strike> Rs. <?php echo $actual_price[0]; ?>/-</strike></label>
                          </p>
                          <hr>
                          <p class="lit-info2">
                            <label class="checkbox-inline">Price: Rs. <?php echo $price[0]; ?>/-</label>
                            
                          </p>
                          <hr>
                          
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <input type="hidden" name="item" id="item" value="stag_girl">
                            <input type="hidden" name="checkout" value="checkout">
                            <input type="hidden" id="str" name="str">
							<input type="hidden" id="form_id">
                            <input type="button" id="booknow" data-id="1" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                            </p>
                          </div>
                        </div>
                      </div>
                  </div>
				  </div>
                </form>
                <?php //} ?>
                <!-----panel----->
                <form action="checkout.php?pd=Mw==" method="post" id="single_form2">
				<input type="hidden" name="price" id="price" value="<?php echo $price[1]; ?>">
				  <div class="panel">
                    <div class="panel-heading" role="tab" id="headingTwo1">
                      <h4 class="panel-title">
                        <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1" aria-expanded="false" aria-controls="collapseTwo1">Single Girl<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                      </h4>
                    </div>
                    <div id="collapseTwo1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">

                      <div class="panel-body">
                        <div class="col-md-9 col-xs-12">
                          <p class="lit-info2">
                            <label class="checkbox-inline">Actual Price:<strike> Rs. <?php echo $actual_price[1]; ?>/-</strike></label>
                          </p>
                          <hr>
                          <p class="lit-info2">
                            <label class="checkbox-inline">Price: Rs. <?php echo $price[1]; ?>/-</label>
                            
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-3 col-xs-12">
                            <input type="hidden" name="item" id="item" value="Single Girl">
                            <input type="hidden" name="checkout" value="checkout">
                            <input type="hidden" id="str" name="str">
							<input type="hidden" id="form_id">
                            <input type="button" id="booknow" data-id="2" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                            </p>
                          </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!-----panel-->
                <!-----panel-->
                <form action="checkout.php?pd=Mw==" method="post" id="single_form3">
                 <input type="hidden" name="price" id="price" value="<?php echo $price[2]; ?>">
				  <div class="panel">
                    <div class="panel-heading" role="tab" id="headingTwo3">
                      <h4 class="panel-title">
                        <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3" aria-expanded="false" aria-controls="collapseTwo3">Couple<span class="price-right"> <i class="fa fa-inr1"></i></span></a>
                      </h4>
                    </div>
                    <div id="collapseTwo3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false" style="">
                      <div class="panel-body">
                        <div class="col-md-9 col-xs-12">
                          <p class="lit-info2">
                            <label class="checkbox-inline">Actual Price:<strike> Rs. <?php echo $actual_price[2]; ?>/-</strike></label>
                          </p>
                          <hr>
                          <p class="lit-info2">
                            <label class="checkbox-inline">Price: Rs. <?php echo $price[2]; ?>/-</label>
                          </p>
                          <hr>
                        </div>
                        <div class="col-md-3 col-xs-12">
                              <input type="hidden" name="item" id="item" value="Couple">
                              <input type="hidden" name="checkout" value="checkout">
                              <input type="hidden" id="str" name="str">
							  <input type="hidden" id="form_id">
                              <input type="button" id="booknow" data-id="3"  class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm" value="BOOK NOW">
                         </div>
                      </div>
                    </div>
                  </div>
                </form>
                <!----/panel----->
             </div>
              </div>
            </div>
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
        </div>
      </div>


      <div class="c-content-box c-size-sm c-bg-dark">
        <div class="container">
          <div class="c-content-client-logos-slider-1  c-bordered" data-slider="owl" data-items="5" data-desktop-items="4" data-desktop-small-items="3" data-tablet-items="3" data-mobile-small-items="2" data-auto-play="5000">
            <div class="owl-carousel owl-theme c-theme owl-bordered1">
              <?php echo $img; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          <div class="c-product-tab-container">
            <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40" style="font-weight:400 !important">Reviews & Rating</h3>
           <?php rating(7); ?>
          </div>
		  <?php    if($_SESSION['role']>2){
			  comment(7);
		}else{?>
		<div class="c-content-box c-bg-grey c-padding-20">
        <div class="container">
          </div>
      </div>
	    <?php }?>
		  
        </div>
      </div>
    </div>
</body>

</html>
<?php require_once( 'footer.php');?>
<script>
  /** init datepicker */
  $(document).ready(function() {
    /* $("#booknow").click(function() {
		var id = parseInt($(this).data('id')); alert(id);
	    var form_id = "#single_form"+id;	
		$("#"+form_id+" form_id").val(id);
	});  */
 $(document).on("click","#booknow",function(){ var id = $(this).data('id');  $("#form_id").val(id); });
    $(document).on('click', '#done', function(e) {
      $("#my_modal").trigger("click");
      e.preventDefault();
      //$("#checkout").trigger('click');
    }); 
    $(document).on('click', '#proceed', function() {
    /*   var time = $("#dtp_input1").val();
      $("#time").val(time);
      if (time == "") {
        alert("please Select Date and Time");
        return false;
      } */
      //$("#checkout").trigger("click");
	  var id = $("#form_id").val(); 
	  $("#single_form"+id).submit();
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
          <h4 class="modal-title">TERMS AND CONDITIONS</h4>
        </div>
        <p>
          <div>
            <h2>Terms & Conditions </h2>
            <ul>
<?php
/*
 *get terms and conditions
 */
 $termsConditions = termsConditions($_GET['vd']);
//end
 ?>
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