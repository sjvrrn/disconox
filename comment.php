<?php 
//Get Comments Starts here

/*get Comments Start*/				
function comment($category_id){

?>

  <form action="" method="post">
            <div class="c-product-review-input">
              <h3 class="c-font-bold c-font-uppercase"></h3>
              <!--star rating start-->
<style>
.rating {
    float:left;
}

/* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
   follow these rules. Every browser that supports :checked also supports :not(), so
   it doesn’t make the test unnecessarily selective */
.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:200%;
    line-height:1.2;
    color:#ddd;
    text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
    content: '★ ';
}

.rating > input:checked ~ label {
    color: #f70;
    text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
    color: gold;
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
    color: #ea0;
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > label:active {
    position:relative;
    top:2px;
    left:2px;
}

/* end of Lea's code */

/*
 * Clearfix from html5 boilerplate
 */

.clearfix:before,
.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

.clearfix:after {
    clear: both;
}

/*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */

.clearfix {
    *zoom: 1;
}

/* my stuff */
#status, button {
    margin: 20px 0;
}

</style>
<script>
var ds = $.noConflict();
ds(document).ready(function(){
	ds(document).on('click','.st',function(e){ e.stopPropagation(); });

});
</script>
<?php 
if(isset($_POST['submit'])){   
			 
									 $data = array(
									"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
									"userId"=> $_SESSION['id'],
									"email"=>$_SESSION['email'],
									"phone"=>$_SESSION['phone'],
									"comment"=>$_POST['comment'],
									"rating"=>$_POST['rating'],
									"partner_id"=> base64_decode($_GET['vd']),
									"category_id"=> $category_id
									);			
							   $api_url = url."comment"; 
								/*get all posts*/
								$data_json = json_encode($data); //print_r($data_json); exit;
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
?>
<div id="status"></div>
<form id="ratingForm">
    <fieldset class="rating">
        <legend>Please rate:</legend>
        <input type="radio" class="st" id="star5" name="rating" value="5" /><label for="star5" title="Rocks!">5 stars</label>
        <input type="radio" class="st" id="star4" name="rating" value="4" /><label for="star4" title="Pretty good">4 stars</label>
        <input type="radio" class="st" id="star3" name="rating" value="3" /><label for="star3" title="Meh">3 stars</label>
        <input type="radio" class="st" id="star2" name="rating" value="2" /><label for="star2" title="Kinda bad">2 stars</label>
        <input type="radio" class="st" id="star1" name="rating" value="1" /><label for="star1" title="Sucks big time">1 star</label>
    </fieldset>	
	<!--start rating end-->
              <textarea name='comment' id='comment'></textarea>
              <button type='submit' name='submit' id='submit' value='submit' class="btn c-btn c-btn-square c-theme-btn c-font-bold c-font-uppercase c-font-white">Submit Review</button>
            </div>
          </form>
		  <!--review rating end---->
	  <?php 
}

function termsConditions($productId){
$productId = base64_decode($productId);  
/*
 *GetTerms and Conditions
*/
								$data = array(
									"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
									"productId"=>$productId
								);
								$data_json = json_encode($data);
								$ul=url."gettermsConditions";	
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $ul);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
								curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								$response  = curl_exec($ch); //print_r($response); exit;
								if ($response === false) {
									$info = curl_getinfo($ch);
									curl_close($ch);
									die('error occured during curl exec. Additioanl info: ' . var_export($info));
								} else {
							
									$responsObj = json_decode($response, TRUE);
									   
									if ($responsObj["error"]){
										echo "Bad Request";
									} else {
										 $response     = (object)$responsObj;//echo"<pre>";
									     $terms        = $response->terms; 
										 $p_terms      = explode(',',$response->instructions);
										 $conditions   = "<ul>";
										 foreach($terms as $term){
											 $conditions.= "<li class='text-mute'>".$term['discription']."</li>";
											 
										 }
										 foreach($p_terms as $term){
											 $conditions.= "<li class='text-mute'><b>".$term['discription']."</b>	</li>";
											 
										 }
										 
										 $conditions .='</ul>';
										 echo $conditions;
									}
								}
								curl_close($ch);
//end
	
}
?>