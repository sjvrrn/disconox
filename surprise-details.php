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
	<link href="assets/base/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen">
    <style>
	  .vl{
		margin:0px !important;
	   }
	   .c-content-accordion-1.c-theme .panel > .panel-heading > .panel-title > a.collapsed{
		   background-color: #c7a369 !important;
		   color:#fff !important;
	   }
	</style>
<?php 
require_once('header.php'); 
require_once('neutral.php');
require_once("allreviews.php");
require_once('rating.php');
require_once('comment.php');
$term = "";
$img = "";
$part_rating = "";
$prat = "";
$r = "";
if(isset($_GET['vd']))
{ 
$partner_id = base64_decode($_GET['vd']); 
$data = array(
"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
"partnerId"=>$partner_id
); 
$data_json = json_encode($data); //print_r($data_json); exit;
$ur = url."surpriseByPartner"; 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $ur); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
$response = curl_exec($ch); 
if ($response === false) { $info = curl_getinfo($ch); 
curl_close($ch); var_dump(var_export($info)); //exit; 
die('error occured during curl exec. Additioanl info: ' . var_export($info)); 
} else { 
$responsObj = json_decode($response, TRUE);  //echo"<pre>"; print_r($responsObj); exit;
if ($responsObj["error"]) { // echo "Bad Request"; 
} else { 
$response = $responsObj;
$message = $response['message']; 
$partner_products = $response['productDetails']; //echo"<br><pre>"; print_r($partner_products); exit;
$product = $response['productDetails'][0];   //echo"==<br>";echo"<pre>"; print_r($product); exit;
			$name = $product['name'];
			$cuisines  = $product['cuisines'];
			$avg_cost  =$product['avg_cost'];
			$menu      = $product['menu'];
			$category_id = $product['category_id'];
			$start_date_time  = $product['start_date_time'];
			$end_date_time    = $product['end_date_time'];
			$highlights = $product['highlights'];
			$description = $product['description'];
			$artist_info = $product['artist_info'];
			$start_time  = $product['start_time'];
			$end_time    = $product['end_time'];
			$partner_name = $product['partner_name'];
            $partner_title = $product['partner_title'];
            $partner_address = $product['partner_address'];
            $partner_description = $product['partner_desc'];
            $partner_pic = $product['partner_pic']; //exit;
			$location = $product['location']; // => map
			$ps_catnames = explode(',',$product['ps_catnames']);
			$ps_catids = explode(',',$product['ps_catids']);
			$ps_categories = array_combine($ps_catids,$ps_catnames); 
			$facilities = $product['facilities'];
			$dress_code = $product['dress_code'];
			$music_genere = $product['music_genre'];
							
         }
    }
    curl_close($ch);
    /*end*/
	/*sub_surprise categories*/
$data = array(
          "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
      );
	  $data_json = json_encode($data); 
      $ud = url."getSubSurprises";  
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $ud);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
      curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
      $response  = curl_exec($ch);   //echo"<pre>"; print_r($response); exit;
      if ($response === false) {
         $info = curl_getinfo($ch);
          curl_close($ch);
          die('error occured during curl exec. Additioanl info: ' . var_export($info));
      } else {
          $responsObj = json_decode($response, TRUE);
          if ($responsObj["error"]) {
              echo "Bad Request";
          } else { 
              $message = $responsObj['message'];  
              $products = $responsObj['productDetails']; //print_r($products); exit; 
			  $capture_event  = $products[0]['capture_event'];
			}
      }
      curl_close($ch);
	/*end*/
	$data = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "userId"=>$partner_id,
			"category_id"=>2
        );
        $data_json = json_encode($data);//print_r($data_json); exit;
        $ua=url."allreviews"; 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ua);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response  = curl_exec($ch);//echo"<pre>";print_r($response); exit;
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
                $partner_location  = $reviews['location'];
			             }
        }
        curl_close($ch);
        /*end*/
} 
   $term = "";
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
	$GLOBALS['gallery'] = array();
allReviews(2);
$gallery = $GLOBALS['gallery'][0]; //print_r($gallery); exit;
	if(isset($gallery) && $gallery != "")
	{
		
	foreach($gallery as $image)
	{
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
      <div class="c-layout-page">
        <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
          <div class="container">
            <div class="col-md-9">
              <div class="check-outer">
                 </div>
            </div>
            <div class="col-md-3"> <?php  echo back_page();?></div>
          </div>
        </div>
        <div class="c-bg-grey pad-t-25">
        <div class="container">
            <h3 class="c-title c-font-bold c-font-22 c-font-dark">
              <a class="c-theme-link" href="#"><?php if(isset($boquet->name)) { echo $boquet->name; }?> </a>
            </h3>
            <?php 
			if(isset($boquet->image)) 
			{ 
			$url="partners/".$boquet->image;
			}
			?>
              <div class="listing-outer">
                <h3 class="c-title c-font-bold c-font-22 c-font-dark"><a class="c-theme-link" href="#">
				<?php if(isset($details->name)) { echo $details->name; }?> </a></h3>
                <div class="c-content-product-2 c-bg-white">
                  <div class="col-md-6">
                  <div class="c-info-list"><br>
                    <p><img class="img-responsive" alt="" src="<?php echo "partners/".$partner_pic;?>"></p>
                    <hr>
                    <p><i class="fa fa-heart"></i> Venue: <span><b><?php echo $partner_name;?></b></span>
                      <span class="label label-default c-font-slim"><?php echo $partner_title; ?></span>
                     <!-- <span class="label label-default c-font-slim">CASUAL DINING</span>
                      <span class="label label-default c-font-slim">BAR</span>-->
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
                  <?php echo $prat; ?>(<?php echo $r; ?>) 
                  </p>
                  <?php  echo show_map($partner_name,$location);?>
                    <p><i class="fa fa-road"></i> Address: <span><b><?php echo $partner_address;  ?> </b></span></p>
                    <p><i class="fa fa-thumbs-o-up"></i> <b>Highlights:</b> <span><?php echo $highlights;?> </span></p>
					<p><i></i> <b>Timings:</b> <span> <?php echo $start_time.' '.$end_time; ?> </span></p>
                    <p><i></i> <b>Description:</b> <span> <?php echo $description; ?> </span></p>
					<p><i></i> <b>Facilities:</b> <span><?php echo $facilities;?> </span></p>
					<p><i></i> <b>Dress code:</b> <span><?php echo $dress_code;?> </span></p>
					<p><i></i> <b>Music Genre:</b> <span><?php echo $music_genere;?> </span></p>
					<p><i></i> <b>Cuisines:</b> <span><?php echo $cuisines;?> </span></p>
					<p><i></i> <b>Average cost for two:</b> <span><?php echo $avg_cost;?> </span></p>
					<p><i></i> <b>Menu:</b>
                <div class="col-md-6 col-sm-12"> <span><img src="partners/<?php echo $menu;?>" class="img-responsive" style="height:75%"></span></div>
              </p>
                  </div>
                </div>
                  <div class="col-md-6 c-padding-20">
					<!--start_date_time--->
					<?php  
					$start = explode('/',$start_date_time); 
					$end   = explode('/',$end_date_time); ?>
					 <div class="row">
                                            
                                            <div class="col-md-7 col-xs-7">
                                            <p><i class="fa fa-calendar"></i> From Date: <span><b><?php echo $start_date_time;?></b> to <span><b><?php  echo $end_date_time;?></b></span></span></p>
                                            </div>
                                            
                                            <div class="col-md-5 col-xs-5">
                                            <p><i class="fa fa-clock-o"></i> Time: <span><b><?php echo $start_time; ?> to <span><b><?php echo $end_time;?></b></span></span></p>
                                            </div>
                                            
											</div>
					<!--end_date_time-->
                 <form action='checkout.php' method='post' id="checkout_form">
                  <p class="c-margin-b-10 c-font-20">CHOOSE A SURPRISE</p>
                  <div class="sur-select">
                    <div class="col-md-6 col-xs-12">
                      <div class="form-group mar-b-0">
                        <input type="hidden" name='time' id='time'>
                        <select class="custom-select-box" id="event">
                                <option value="Whom you want Surprise">Whom you want Surprise</option>
								<option value="Wife">Wife</option>
                                <option value="Husband">Husband</option>
                                <option value="Boy Friend">Boy Friend</option>
                                <option value="Girl Friend">Girl Friend</option>
                                <option value="Friend">Friend</option>
                                <option value="Fiance">Fiance</option>
                            </select>
                      </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                      <div class="form-group mar-b-0">
                        <select class="custom-select-box" id="occasion">
                                <option value="">Select Occasion</option>
                                <option value="Anniversary">Anniversary</option>
                                <option value="Birthday">Birthday</option>
                                <option value="Proposal">Proposal</option>
                                <option value="Just like that">Just like that</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="clearfix"></div>
                    <div class="c-content-accordion-1 c-theme">
                      <?php   
					  //boquet ,cake,baloons,liveartist,
					  $img_cat0 = array("images/boquet1.jpg","images/boquet2.jpg","images/boquet3.jpg");
					  $img_cat1 = array("images/cake1.jpg","images/cake2.jpg","images/cake3.jpg");
					  $img_cat3= array("images/english.jpg","images/hindi.jpg","images/mix.jpg");
					  $img_cat2 = array("images/setup1.jpg","images/setup2.jpg","images/setup3.jpg");
					  $img_cat4 = array("images/bottle-of-wine.jpg");
				       $i=0; 
					   if(count($partner_products)>0){
						  foreach($products as $product){ $product = (object)$product;
						  $j = $product->category_id;
						  if($j==1){ $arr = $img_cat0;}elseif($j==2){ $arr = $img_cat1;}elseif($j==3){ $arr = $img_cat2;}elseif($j==4){$arr = $img_cat3;}elseif($j==5){$arr = $img_cat4;}
						  
				       ?>
                       <div class="panel">
                        <div class="panel-heading" role="tab" id="headingTwo<?php  echo $i;?>">
                          <h4 class="panel-title">
                            <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $j;?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $i;?>"><i class="fa  fa-ge"></i><?php echo $ps_categories[$product->category_id];?>
							<span class="price-right"> <i class="fa fa-inr1"></i><?php //echo $ps_price[$i];?></span>
							</a>
                          </h4>
                        </div>
                        <div id="collapseTwo<?php  echo $j;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
						<div class="panel-body">
                            <div class="col-md-9 col-xs-12">                
                              <div class="lit-info2">
							   <label style="width:90%">
                                <div class="col-md-5 col-xs-12">
                                 <input type="radio" id="price<?php echo $i;?>" name="price<?php echo $i;?>"  value ="<?php echo $product->price; ?>">
                                 <img src="<?php echo $arr[0];?>"> 
                                 </div>
                                 <div class="col-md-7 col-xs-12">
                                    Rs. <?php echo $product->price; ?>/-
                                 </div>
                               </label>
                              </div>
							  <hr>
                              
							  <div class="lit-info2">
                              <label style="width:90%">
                               <div class="col-md-5 col-xs-12">
                                <input type="radio" id="price<?php echo $i;?>" name="price<?php echo $i;?>"  value ="<?php echo $product->price2; ?>"> 
                                <img src="<?php echo $arr[1];?>"> 
                               </div>
                               <div class="col-md-7 col-xs-12">
                                <p>Rs. <?php echo $product->price2; ?>/-</p>
                               </div>
                              </label>
                              </div>
							  <hr>
							  <div class="lit-info2">
							  <label style="width:90%">
                               <div class="col-md-5 col-xs-12">
                                <input type="radio" id="price<?php echo $i;?>" name="price<?php echo $i;?>"  value ="<?php echo $product->price3; ?>"> 
                                <img src="<?php echo $arr[2];?>"> 
                               </div>
                               <div class="col-md-7 col-xs-12">
                                 <p>Rs. <?php echo $product->price3; ?>/-</p>
                               </div>
                               </label>
                               </div>
                              <hr>
							
							  <p class="lit-info2">
                              <label><input type="text"  id="boquet_note" name="note[]" value="" class="form-control input-lg c-square" placeholder="Note"></label>
                              </p>
                              <hr>
							  <p class="lit-info2">
                                <?php echo $product->description; ?>
                              </p>
                            </div>
                        </div>
                       </div>
                      </div>  
						  <?php
							$i++;
							}
							}
						/*partnter products*/
 $i=0; 
 $j=4;// echo"<pre>"; print_r($partner_products); exit;
						  foreach($partner_products as $product){ 
						  $product = (object)$product; 
						  if(!empty($product->id)){
					?>
                       <div class="panel">
                        <div class="panel-heading" role="tab" id="headingTwo<?php  echo $i;?>">
                          <h4 class="panel-title">
                            <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $j+1;?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $j+1;?>"><i class="fa  fa-ge"></i><?php echo $ps_categories[$product->category_id];?>
							<span class="price-right"> <i class="fa fa-inr1"></i><?php //echo $ps_price[$i];?></span></a>
                          </h4>
                        </div>
                        <div id="collapseTwo<?php  echo $j+1;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
						<div class="panel-body">                            
                            <div class="col-md-9 col-xs-12">    
                             <?php if ($product->category_id==5){ ?>
							 
							   <p class="lit-info2">
							    <label class="checkbox-inline"><input type="checkbox" name="price<?php echo $j;?>"
								id ="price<?php echo $j;?>" value ="<?php echo $product->price2; ?>">
                                <img src="images/bottle-of-wine.jpg" width="36"> Rs. <?php  echo $product->price; ?>/-(<?php echo $product->price2; ?>)</label>
                              </p>
							 
							 <?php }elseif($product->category_id==7){
								 $custom   = explode('+',$product->price3); 
								 ?>
							 
							   <p class="lit-info2">
							    <label class="checkbox-inline"><input type="checkbox" name="price<?php echo $j;?>"
								id ="price<?php echo $j;?>" value ="<?php echo $product->price2; ?>">
                                Rs. <?php  echo $product->price; ?>/-(<?php echo $product->price2; ?>)</label>
                              </p>
							  <p class="lit-info2">
							    <label class="checkbox-inline"><input type="checkbox" name="price7"
								id ="price7" value ="<?php echo $custom[1]; ?>">
                               Rs. <?php  echo $custom[0]; ?>/-(<?php echo $custom[1]; ?>)
							   </label>
                              </p>
                              <?php }else{  ?>
							 
							  <p class="lit-info2">
							    <label class="checkbox-inline"><input type="checkbox" name="price<?php echo $j;?>"  id ="price<?php echo $j;?>"  value ="<?php echo $product->price2; ?>">
                                Rs. <?php  echo $product->price; ?>/-(<?php echo $product->price2; ?>)</label>
                              </p>
						  <?php } ?>
							  <hr>
							
							  <p class="lit-info2">
                              <label><input type="text"  id="boquet_note[]" name="note[]" value="" class="form-control input-lg c-square" placeholder="Note"></label>
                              </p>
                              <hr>
							  <p class="lit-info2">
                                <?php echo $product->description; ?>
                              </p>
                            </div>
                        </div>
                       </div>
                      </div>  
						  <?php
							$i++;$j++;
							}		
}							
                         /*partner products end*/
					  ?>
                      
                    <div class="panel">
                    <div class="panel-heading" role="tab" id="headingTwo9">
                      <h4 class="panel-title">
                        <a class="c-font-bold c-font-18" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo9" aria-expanded="false" aria-controls="collapseTwo9"><i class="fa fa-file-video-o"></i> <?php echo 'CAPTURE YOUR MOMENT';?>
                        <span class="price-right"> <i class="fa fa-inr1"></i><?php //echo $ps_price[$i];?></span></a>
                      </h4>
                     </div>
                     <div id="collapseTwo9" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" aria-expanded="false">
                        <div class="panel-body">
				         <div class="col-md-12 col-xs-12">
                             <?php $j = $i-1;?>
						     <p class="lit-info2">
                              <label><input type="checkbox" name="cvideo" id="capture_event" value ="<?php echo $capture_event; ?>">
                              <img src="images/capture-your-moment.jpg" width="36"> Capture your moment</label>
							  <span>(<?php echo $capture_event;?>)</span>
                            </p>
				     </div>
                        </div>
                     </div>
                   </div>
                   
                   </div>
                   
                   
                    <div class="col-md-3 col-xs-12">
					<input type="hidden" name="price" id="price">
					<input type="hidden" name="item" id="item">
					<input type="hidden" name='checkout' value='checkout'>
					<input type="hidden" name="str" id="str">
				    <input type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-toggle="modal" data-target=".bs-example-modal-sm"  name="booknow" value="BOOK NOW"> 
                     </div>
                  </form>
                   </div>
                 </div>
               <div>
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
                                                  <button type="button"  id='done' name="checkout1" value="checkout" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Done</button>
                                                  </a>
                                                  <button type="button" class="btn c-theme-btn c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Back</button>
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
      </div> 
                        </div> 
                    </div>
                </div>	
	    <div class="c-content-box c-bg-grey c-padding-20">
          <div class="container">
            <div class="c-product-tab-container">
              <h3 class=" c-font-bold c-font-22 c-margin-b-40 c-margin-t-40">Reviews & Rating</h3>
              <?php  rating(2); ?>
            </div>
          <?php comment(2);?>
          </div>
        </div>
        </div>
      </div>
      <!-- END: PAGE CONTAINER -->
      <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
      <?php require_once('footer.php');?>
      
    </body>

</html>

<script>
            $(document).ready(function()
            {
                App.init(); // init core
			 $("#checkout").click(function(e){
				$("#my_modal").trigger("click");
				e.preventDefault();
		
			});
             $("#proceed").click(function(e){ 
			 
			 //alert(price);
			 e.preventDefault();
			//alert(item);
				
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
          <h2>Terms & Conditions </h2>
        </div><p>
              <div >
   <?php 
/*
 *get terms and conditions
 */
 $termsConditions = termsConditions($_GET['vd']);
//end
 ?>
              </div>
            </p>			     <!--  <div class="modal-footer">
          
        </div>-->
		<div class="modal-footer">
		 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="proceed" class="btn btn-default" data-dismiss="modal">Proceed</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>		<!--modal div end-------------------------------------------------------->
<!--date time picker-->  
	<script>
	$(document).ready(function(){
	
	$("#capture_event").change(function(e){ 
		if (this.checked){  
		                   $('#my_modal').show();
			//$("#enquiry").trigger("click");
			e.preventDefault();
		} else {
		}
	});

	$(document).on('click','#done',function(e){
		
	$("#my_modal").trigger("click");
				e.preventDefault();
	//$("#checkout").trigger('click');
});	
$(document).on('click','#proceed',function(){	 
          // var a =  $('#price0').attr('checked')? $("#input:radio[name=price0]:checked").val():0; 
		   var a = parseInt($("input[id='price0']:checked").val());if(isNaN(a)){a=0;};	
		   var b = parseInt($("input[id='price1']:checked").val());if(isNaN(b)){b=0;};	
		   var c = parseInt($("input[id='price2']:checked").val());if(isNaN(c)){c=0;};	
		   var d = parseInt($("input[id='price3']:checked").val());if(isNaN(d)){d=0;};	
		   var e = parseInt($("input[id='price4']:checked").val());if(isNaN(e)){e=0;};	
		   var f = parseInt($("input[id='price5']:checked").val());if(isNaN(f)){f=0;};	
		   var g = parseInt($("input[id='price6']:checked").val());if(isNaN(g)){g=0;};	
		   var h = parseInt($("input[id='price7']:checked").val());if(isNaN(h)){h=0;};	
		   var i = parseInt($("input[id='capture_event']:checked").val());if(isNaN(i)){i=0;};	
		   
//var boquet_price       = parseInt($("input[id='price0']:checked").val());if(isNaN(boquet_price)){boquet_price=0;}	
//var price1 = boquet_price+cake_price+baloons_price+liveartist_price+bof_price+cs_price+os_price+cvideo+custom;  
 var event            = $("#event").val();
 var occasion         = $("#occasion").val();
 var item             = event+'_'+occasion; 
 var price = a+b+c+d+e+f+g+h+i; 
 price = parseInt(price); 
$("#price").val(price);
var time = $("#datetime_picker").val(); 
$("#time").val(time);
if(time==""){
alert("please Select Date and Time"); return false;
	        } 
 $('#checkout_form').submit(); 
			 /* var str = "";
			 if(boquet_price>0){str = str+"boquet-";}
			 if(cake_price>0){str = str+"cake-";}
			 if(baloons_price>0){str = str+"baloons";}
			 if(liveartist_price>0){str = str+"liveartist-";}
			 if(bof_price>0){str = str+"bottleofwine-";}
			 if(cs_price>0){str =str +"customsurprise-";}
			 $("#str").val(str);$("#item").val(item); 
			  
			  */
	
	 
});
		
	});
	</script>        
<script type="text/javascript">
var x   = '<?php echo $booking_days;?>';
var st  = '<?php echo $booking_time; ?>';
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
    daysOfWeekDisabled: [x,2],
    datesDisabled: ['2016/08/20'],	
    autoclose: true,   
    });
    </script>