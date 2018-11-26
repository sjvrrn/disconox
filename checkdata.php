<?php 
require_once("resheader.php");

if(isset($_POST['user_email']))
{
	
	        $data  = array(
            "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
            "user_email"=>$_POST['user_email']
            );
			$data_json = json_encode($data);
			$url = $url."checkEmail";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$response  = curl_exec($ch);
		    if ($response === false) 
			{
			
			  $info = curl_getinfo($ch);
			  curl_close($ch);
			  die('error occured during curl exec. Additioanl info: ' . var_export($info));
		    }else
			{
		
				$responsObj = json_decode($response, TRUE);

				 if ($responsObj["error"]) 
				 {
					 
				 echo "<script type='text/javascript'>alert('Bad Request')</script>";
				 //echo "Bad Request";
				 
				 }else
				 {
					 echo $responsObj['message'];
			
				 } 
            }	
            curl_close($ch);

 
}


		 
		
		
