<?php 
function show_map($name,$location){

	echo'<button type="button" class="btn btn-xs c-font-14 vl" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-map-marker"></i> View Location Map
                    </button>
                    </button>
                    <hr>
    
                    <!--location map model start-->
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content c-square">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel">'.$name.'</h4>
                          </div>
                          <div class="modal-body">
						  <!--custom start-->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSlm5x5KhDhIME4q8rEbEihBWmKzJhJ3c&callback=myMap"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script>
function initialize() {
//latlang constructor
var latlng = new google.maps.LatLng('.$location.');
//map object definition
var hyd_map = new google.maps.Map(document.getElementById("map"),{
		                                                         "center":latlng,
																 "zoom":12
	                                                             });
    																  
//markerobject definition
var marker = new google.maps.Marker({
	                                map : hyd_map,
									position :latlng,
									draggable : false,
									anchorpoint: new google.maps.Point(0,-29)
                                     });
//info window object
var infoWindow  = new google.maps.InfoWindow();

//add content to mapMarker
google.maps.event.addListener(marker,"click",function(){
	
//set content  
var infoContent  = "<div>" +
      "<div><b>Location</b> : '.$name.'</div></div>";
//set content to infowidnow
infoWindow.setContent(infoContent);
//open infowindow on map with content
infoWindow.open(map,marker);
	
});									 
									 }
google.maps.event.addDomListener(window,"load",initialize);
</script>
<div id="map" style="width: 100%; height: 100%;"></div>  
						  <!--custom end-->
						  
                          
                          </div>
                          <div class="modal-footer">
    
                            <button type="button" class="btn c-btn-dark c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!--location map model close-->';
	
	
}
function back_page(){
	                  
echo'<input action="action" onclick="window.history.go(-1); return false;" type="button" value="Back to Search Results" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-t-10 c-margin-b-10 c-font-14 pull-right"/>';                
				}
				//$term = '';
function terms($terms){
     foreach($terms as $ter){ echo $ter; 
      if(!empty($ter)){
        $term .= '<li>'.$ter.'</li>';
      }
     } 
	 return $term;
	 }
//show images/videos homepage
function show_images($gallery){ 
	foreach($gallery as $image){
	  if($image){
       $img .='<div class="item cbp-item">
                <div class="cbp-caption"> <a href="partner/'.$image.'" class="cbp-lightbox" > <img src="partners/'.$image.'" style="height:140px;"> </a> </div>
               </div>';
	  }
	}
	return $img;
	}
//product details show start//

function show_products($product_list){
if(count($product_list)>0){	
if(count($product_list)==1&&$product_list[0]['name']==""){  return "Dela's Are Not Available"; }else{		
		  foreach($product_list as $product){
        $product = (object)$product;
        $start  = explode(" ",$product->start_date_time);
        $end  = explode(" ",$product->end_date_time);
            $deal  .= '<div class="dp-outer-deals">
                                    <div class="dpod-head">'.$product->name.'</div><!--head-->
                                    <form action="checkout.php" method="post" id="checkout_form'.$product->id.'" >
                                    <input type="hidden" name="item" id="item" value="'.$product->name.'">
                                    <input type="hidden" name="product_id" value="'.$product->id.'">
									<input type="hidden" name="time" id="time">
                                    <div class="package-outer">
                                                <div class="col-md-9 col-sm-12">
                                                    <div class="c-content-title-3 c-theme-border">
                                            <h1 class="c-left c-font-uppercase"><span class="c-gold fon-gold-hevy">'.$product->highlights.'</span></h1>
                                            <div class="c-line c-dot c-dot-left "></div>
                                            <div class="row">
                                            <div class="col-md-6 col-xs-12">
                                            <p><i class="fa fa-calendar"></i> From Date: <span><b>'.$start[0].'</b> to <span><b>'.$end[0].'</b></span></span></p>
                                            </div>
                                            <div class="col-md-6 col-xs-12">
                                            <p><i class="fa fa-clock-o"></i> Time: <span><b>'.$start[1].'</b> to <span><b>'.$end[1].'</b></span></span></p>
                                            </div>
                                            <div class="col-md-12 col-xs-12">
                                            <hr>
                                            <h2 class="c-gold"><span><b>Minimum Booking Amount:<i class="fa fa-inr mar-rl-10 "></i>'.$product->price.'/- </b></span></h2>
                                            <input type="hidden" name="price" id="price" value="'.$product->price.'">
                                            </div>
                                            </div>
                                        <h2 class="c-left c-font-uppercase c-margin-t-20">About This Deal</h2>
                                            <p>'.$product->description.'</p>
                                            <p><span class="label label-default c-font-slim"></span>
                                        '.$product->tags.'
                                        </p>                                   
                                        </div></div>
                                                <div class="col-md-3 col-sm-12">
												<input type="hidden" id="bookid" value="">
                                                <input type="submit" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" data-ids='.$product->id.'  name="checkout" id="checkout'.$product->id.'" value="BOOK NOW" style="display:none"></form>
												  <button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase" id="booknow" data-ids='.$product->id.' data-toggle="modal" data-target=".bs-example-modal-sm">BOOK NOW</button>
                                                </div>
                                                </div></div>';
        }
		return $deal;
   }   	
}
	}
	
	
?>

<!--<a href="checkout.php?co='.base64_encode($product->id).'&cid='.base64_encode(1).'&ba='.base64_encode($product->id).'"><button type="button" class="btn pull-right c-margin-t-30 c-btn-green c-btn-circle c-btn-bold c-btn-uppercase">BOOK NOW</button></a>-->