<?php
require_once('header.php');
if(isset($_POST['user_id'])){
	 $productId = $_POST['user_id']; 
	 $status    = $_POST['status'];
	/*start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	"productId"=>$productId,
	"status"=>$status
	
);
$data_json = json_encode($data);
$ul = $url."productStatus";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ul);
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

    if($responsObj["error"]) {
        echo "Bad Request";
    } else {
        echo $products = $responsObj['results'];
    }
}
curl_close($ch);
/*end*/

	
	
	}

 ?>