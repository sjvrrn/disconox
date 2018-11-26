<?php 
function allReviews($category_id){
                              $data = array("clientId"=>"x6DmrbsQFZyUUiggs0BZ","userId"=>base64_decode($_GET['vd']),"category_id"=>$category_id);//echo'<pre><br>';print_r($data); exit;
								$data_json = json_encode($data);
								$ua=url."allreviews"; 
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $ua);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
								curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								$response  = curl_exec($ch); //print_r($response); die;
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
										$reviews = $response->reviews[0];
										$gallery =  explode(";",$reviews['gallery']);	
										array_push($GLOBALS['gallery'],$gallery);							
										$videos = explode(";",$reviews['videos']);
										
									}
								}
								curl_close($ch);
}
?>