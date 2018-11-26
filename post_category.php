<?php
error_reporting(0);
session_start();

if(isset($_POST['category_name'])){
	 $cat_name = $_POST['category_name']; 
	/*switch start*/
    switch ($cat_name) {
        case "Deals_Offers":
            $link = "edit-deals-offers.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allDealOffers";
            break;
        case "Surprise":
            $link = "edit-surprise.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allSurprises";
            break;
        case "Guest_List":
            $link = "edit-guest-list.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allGuestlist";
            break;
        case "Book_A_Table":
            $link = "edit-book-table.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allBookTable";
            break;
        case "Book_A_Bottle":
            $link = "edit-book-bottle.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allBookbottle";
            break;
        case "Packages":
            $link = "edit-packages.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allPackages";
            break;
        case "Entry":
            $link = "edit-entry.php?ep";
            $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/allentry";
            break;
        default:
            header("location:all-posts.php");
    }
	    /*switch end*/
    /*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
    );
    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
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
            $products = $response->productDetails;
        }
    }
    curl_close($ch);
    /*end*/
    /*data start*/
    $data = '';
    foreach($products as $product){  $product = (object)$product;
        /*image start*/
        $imageURL = $product->image;
        if (!file_exists(dirname($_SERVER['SCRIPT_FILENAME']).'/'.$imageURL)) {
            $imageURL = "../partners/".$imageURL;
        }
        if($imageURL==""){$imageURL='assets/images/post-banner.jpg'; }
        /*image end*/
       $data .= '
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="card card-outline-info m-t20">
                <div class="card-body"><div class="card-top" style="background:url('.$imageURL.') no-repeat center center /cover; width:100%; height:192px;">
                        <div><a href="pick-edit.php?id='.base64_encode($product->id).'" class="fatrash" data-toggle="modal" data-target="#myTrash"><i class="fa fa-trash-o"></i></a></div>
                            </div>
                    <div class="card-middle">
                        <div class="entry-name p-b10">'.$product->name.'</div>
                        <div class="switch flt-left m-t2">
                            <label>
                                <input type="checkbox" checked="">
                                <span class="lever switch-col-amber m-l0"></span> </label>
                        </div>
                        <div class="text-right"><a href="'.$link.'='.base64_encode($product->id).'">
                                <button type="button" class="btn waves-effect waves-light btn-rounded btn-success">EDIT</button>
                            </a></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>';
    }
   echo $data; exit;
    /*data end*/
	}else{/*

*/
}

if(isset($_POST['user_id'])){
	$userId = $_POST['user_id'];
	//
	 /*get all posts*/
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/updateArtist";
	$data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"userid"=>$userId
    );
    $data_json = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
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
           echo $response->message;
        }
    }
    curl_close($ch);
    /*end*/
}
    ?>