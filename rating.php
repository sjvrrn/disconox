


<?php
/*rating start */
function rating($category_id){
	$data = array(
								"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
								"partner_id"=> base64_decode($_GET['vd']),
								"category_id"=>$category_id
								);
								
						   $api_url = url."getReviews"; 
							/*get all posts*/
							$data_json = json_encode($data); //print_r($data_json); exit;
							$ch = curl_init();
							curl_setopt($ch, CURLOPT_URL, $api_url);
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
									
								} else {
									$response = (object)$responsObj;
									$message = $response->message;
									$reviews = $response->reviews;
								}
							}
							curl_close($ch);
/*get Comment End*/				
foreach($reviews as $review){ 
									$review = (object)$review;
								  if(!$review->image){
									  $review_img = 'assets/images/p-pic.png';
								  }else{
									  $review_img = $review->image;
								  }
								 if($review->rating ==5){
									$rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star"></i>';
								  }elseif($review->rating ==4){
									$rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i>';
								  }elseif($review->rating==3){
									$rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
								  }elseif($review->rating==2){
									$rat = '<i class="fa fa-star "></i> <i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
								  }else{
									$rat = '<i class="fa fa-star "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i> <i class="fa fa-star-o "></i>';
								  }
								  $rating .= '
									<div class="row c-margin-t-40">
									  <div class="col-xs-6">
										<div class="c-user-avatar"> <img src="'.$review_img.'"> </div>
										<div class="c-product-review-name">
										  <h3 class="c-font-bold c-font-24 c-margin-b-5" style="font-weight:400 !important;font-size:16px;">'.$review->review.'</h3>
										 </div>
									  </div>
									  <div class="col-xs-6">
										<div class="c-product-rating c-right c-gold"> '.$rat.'</br> <p class="c-date c-theme-font c-font-14">'.$review->createdAt.'</p></div>
										
									  </div>
									</div>
									<div class ="c-product-review-content">
									  <p> </p>
									</div>';
								   $r++;
								   $part_rating = $review->rating;
								}
/*rating end*/
 if(isset($rating)) { echo $rating; } 
 
}
 ?>