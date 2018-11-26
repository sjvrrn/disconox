<?php  
require_once( "header.php");
$content = "";
if(!$_GET['pd'])
{
	
$category=base64_decode($_REQUEST[ 'category']); 

}else
{
	 
$category=base64_decode($_REQUEST[ 'pd']); 
	 
} 
if(isset($_REQUEST[ 'city']))
{
	
$city=$_REQUEST[ 'city'];

}

if(isset($_REQUEST[ 'venue']))
{
	
$venue=$_REQUEST[ 'venue'];

}
else
{

$venue = '';

}
if(isset($_SESSION['id']))
{
	
$userID = $_SESSION['id'];

}
else
{

$userID = '';
	
}
$data=array( "clientId"=>"x6DmrbsQFZyUUiggs0BZ", "user_id"=>$userID, "category_id"=>$category, "word"=>$venue ); 
$api_url = $url."searchresult";   
$data_json = json_encode($data); 
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $api_url); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
$response = curl_exec($ch); //echo"<pre>";print_r($response); exit;
 
if ($response === false) 
{  
	$info = curl_getinfo($ch);
	curl_close($ch);
	die('error occured during curl exec. Additioanl info: ' . var_export($info));
} 
else 
{
	$responsObj = json_decode($response, TRUE);

	if ($responsObj["error"]) {
	echo "Bad Request";
	} else {
	$response = (object)$responsObj;
	$message = $response->message;
	$products = $response->productDetails;
	
	}
}
	
curl_close($ch);
	
    /*end*/
foreach($products as $product){
	  $product = (object)$product; 
	  $url = "partners/".trim($product->partner_pic);
	  $categoryids = explode(',',$product->cat_ids); 
	  $images_count  =   $product->image_count;
	  $videos_count  = $product->video_count;
      $list ='';
if(in_array(1,$categoryids))
{	
	$list .='<a href="deals-offers-details.php?vd='.base64_encode($product->uid).'&pd=MQ==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Deals & Offers</a>';
	$product_url = 'deals-offers-details.php?vd='.base64_encode($product->uid).'&pd=MQ==';
}
if(in_array(2,$categoryids))
{
	$list .='<a href="surprise-details.php?vd='.base64_encode($product->uid).'&pd=Mg==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Surprise</a>';
	$product_url = 'surprise-details.php?vd='.base64_encode($product->uid).'&pd=Mg==';
}
if(in_array(3,$categoryids))
{
	$list .='<a href="guest-list-details.php?vd='.base64_encode($product->uid).'&pd=Mw==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Guest List</a>';
	$product_url = 'guest-list-details.php?vd='.base64_encode($product->uid).'&pd=Mw==';
}
if(in_array(4,$categoryids))
{
	$list .='<a href="book-table-details.php?vd='.base64_encode($product->uid).'&pd=NA==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Table</a>';
	$product_url = 'book-table-details.php?vd='.base64_encode($product->uid).'&pd=NA==';
}
if(in_array(5,$categoryids))
{
	$list .='<a href="book-bottle.php?vd='.base64_encode($product->uid).'&pd=NQ==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Bottle</a>';
	$product_url = 'book-bottle.php?vd='.base64_encode($product->uid).'&pd=NQ==';
}
if(in_array(6,$categoryids))
{
	$list .='<a href="packages-details.php?vd='.base64_encode($product->uid).'&pd=Ng==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Packages</a>';
	$product_url = 'packages-details.php?vd='.base64_encode($product->uid).'&pd=Ng==';
}
if(in_array(7,$categoryids))
{
	$list .='<a href="entry-details.php?vd='.base64_encode($product->uid).'&pd=Nw==" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Entry</a>';
	$product_url = 'entry-details.php?vd='.base64_encode($product->uid).'&pd=Nw==';
}
	
	 $rating = intval($product->rating);
	 
	  if($rating==1)
	  { 
	    $rating='
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>';
	  }
	  elseif($rating==2)
	  { 
	    $rating='
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>';
	  }
	  elseif($rating==3)
	  { 
	    $rating='
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>';
	  }
	  elseif($rating==4)
	  { 
	    $rating='
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>';
	  }
	  elseif($rating==5)
	  { 
	    $rating='
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>
		<span class="fa fa-star c-theme-font"></span>';
	  }
	  else
	  {
		$rating='
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>
		<span class="fa fa-star-o c-theme-font"></span>';
	  }
	  
      $content .='<div class="listing-outer">
                        <div class="c-content-product-2 c-bg-white">
                            <div class="col-md-3">
                            <div class="row">
                                <div class="c-content-overlay">
                                    <div class="c-label c-bg-dark c-font-white c-font-12 c-font-bold"><i class="fa fa-camera"></i>'.$images_count.'</div>
                                    <div class="c-label c-label-right c-theme-bg c-font-white c-font-13 c-font-bold"><i class="fa fa-video-camera"></i> 0</div>
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="'.$product_url.'" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url('.$url.');"></div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-9">
                                <div class="c-info-list">
                                    <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                        <a class="c-theme-link" href="'.$product_url.'">'.ucwords($product->product_name).'</a>
                                        <span class="c-font-14 c-grey">'.$product->Title.'</span>
                                    </h3>
                                    <span class="addr">'.$product->Address.'</span>
									<p class="c-review-star">
                                        '.$rating.'
									</p>
                                    <hr>
                                    <p class="c-desc c-font-14 c-font-thin">'.$product->description.'</p>
                                    <hr>
									 <p class="c-desc c-font-14 c-font-bold"><a href="'.$product_url.'">Facilities: '.$product->facilities.'</a></p>
									<hr>
									 <p class="c-desc c-font-14 c-font-bold"><a href="'.$product_url.'">Dress Code: '.$product->dress_code.'</a></p>
                                    <hr>
									 <p class="c-desc c-font-14 c-font-bold"><a href="'.$product_url.'">Music Genre: '.$product->music_genre.'</a></p>
									<hr>
                                </div>
                                <div>
									'.$list.'                                   
                                </div>
                            </div>
                        </div>
                    </div>';
  }	

/*content end*/
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
  <style>
    .listing-outer p {
      margin: 0 0 5px;
    }
    .listing-outer hr {
      margin-bottom: 5px;
      margin-top: 5px;
    }
	.listing-outer a:hover, a:focus {
      color: #DAA520 !important;
    }
  </style>
</head>
<body class="c-layout-header-fixed">
  <?php require_once("top.php");?>
  <div class="c-layout-page">
    <div class="c-content-box c-size-sm c-bg-shade s-inner">
      <div class="container">
        <div class="auto-container">
          <!--Search Form-->
          <div class="search-form ">
            <form method="get" action="search-results.php">
              <div class="clearfix">
                <div class="form-group col-md-5 col-sm-12 col-xs-12">
                  <input type="text" name="city" placeholder="Search by city, location..." required value="Hyderabad">
                </div>
                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                  <input type="text" name="venue" value="<?php if(isset($_REQUEST['venue'])){ echo $_REQUEST['venue']; } ?>" placeholder="Venue Name EX: Local Box Pub" required>
                </div>

                <!--Form Group-->
                <div class="form-group col-md-3 col-sm-12 col-xs-12">
                  <select class="custom-select-box" name='pd'>
                                <option value="">All Categories</option>
                                <option value="MQ==" <?php if($_GET['pd']==base64_encode(1)){ echo "selected"; } ?>>Deals & Offers</option>
                                <option value="NA==" <?php if($_GET['pd']==base64_encode(4)){ echo "selected"; }?>>Book A Table</option>
                                <option value="NQ==" <?php if($_GET['pd']==base64_encode(5)){ echo "selected"; }?>>Book A Bottle</option>
                                <option value="Ng==" <?php if($_GET['pd']==base64_encode(6)){ echo "selected"; }?>>Packages</option>
                                <option value="Nw==" <?php if($_GET['pd']==base64_encode(7)){ echo "selected"; }?>>Entry</option>
                                <option value="Mw==" <?php if($_GET['pd']==base64_encode(3)){ echo "selected"; }?>>Guest List</option>
                                <option value="Mg==" <?php if($_GET['pd']==base64_encode(2)){ echo "selected"; }?>>Surprise</option>
                            </select>
                </div>
                <div class="btn-group">
                  <button type="submit" class="theme-btn search-btn"><span class="icon fa fa-search"></span></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
      <div class="container">
      </div>
    </div>
    <div class="c-content-box c-size-md1  c-bg-grey">
      <div class="container">
        <div class="c-margin-t-20"></div>
        <?php echo $content;
		?>
      </div>
    </div>
  </div>
</body>

</html>
<?php require_once('footer.php');?>