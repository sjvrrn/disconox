<?php 


$data = array("clientId"=>"x6DmrbsQFZyUUiggs0BZ",
              "user_email"=>"narayana557@gmail.com");
$data_json = json_encode($data);
								$ua="localhost/disconox/api/CheckEmail"; 
								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $ua);
								curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
								curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
								$response  = curl_exec($ch);  print_r($response); 
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
										
										
									}
								}
								curl_close($ch);
								
								?>