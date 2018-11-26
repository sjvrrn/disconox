<?php 
require_once("header.php");
if(isset($_POST['email'])){

/*start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	'email'=>$_POST['email']
);
$data_json = json_encode($data);
$ul = $url."http://localhost/angular/disconox/Disco/v1/InnoChat/productByCategory";
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
//        echo "Bad Request";
        
    } else {
        $message = $responsObj['message'];
        $products = $responsObj['PartnersData'];
		if(count($products)){  return 1;}else{return 0; }
    }
}
curl_close($ch);
/*end*/

}