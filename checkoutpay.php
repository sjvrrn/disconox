<?php 
error_reporting(0);
session_start(); 
//require_once("db.php");
if((isset($_POST['paynow']))&& ($_POST['price']>0)){
//if((isset( $_POST['price'])) && (!empty( $_POST['price']))){
 $pid = $_POST['product_id'];  
  if($_POST['uid']==0){
	$email = $_POST['email'];
	  $fname =  $_POST['fname'];
	  $phone  = $_POST['mobile'];
	  //email checking
$sql= "select * from users where email ='$email'";
  $result = mysql_query($sql);
if ($result->num_rows <=0) {
	 $password = md5(123456);
 $sql ="INSERT INTO users(name, email, phone,password, role,status) 
  VALUES ('$fname','$email','$phone','$password',3,1)";  
$result = mysql_query($sql);
$uid = mysql_insert_id();
/**email send to user*/
$to =  $email;
$subject = "Regarding Registration with disconox";
$txt = "Your Account created with Disconox.you can login with  www.Disconox.com .Your Testing password is :123456";
$headers = "From: narayana557@gmail.com" . "\r\n" .
"CC: mendu.sriram@gmail.com";
$email = mail($to,$subject,$txt,$headers);
if($email){
	echo"<script>alert('mail send uccessfully to ".$to."');</script>";
}
  /*email end*/
  }
  if(!$pid){
	  $pid=1;
  }
  print_r($_POST); exit;
  $amount = $_POST['price'];
  $purpose = $_POST['item'];
  $phone = $_POST['mobile'];
  $buyername = $_POST['fname'];
  $email = $_POST['email'];
  $time  = $_POST['time'];
  $customer_address = $_POST['address'];
  $uid =$_POST['uid'];
  $created = date('Y-m-d h:i:s');
  $sql= "INSERT INTO product_orders(pid,product_name,uid,price,customer_name,customer_email,customer_phone,customer_address,time,status,createdAt) VALUES ('$pid','$purpose','$uid','$amount','$buyername','$email','$phone','$customer_address',$time,'process','$created')";
  mysql_query($sql);
  /**email send to user*/
$to =  $email;
$subject = "Regarding order with disconox";
//$message = 'Dear '.$buyer_name.' .your orderd An item with Disconox.com. Your order done successfully'.'\n';
//$message .=nl2br('your order Details Are');
//$message .=nl2br('productName:'.$purpose);
//$message .=nl2br('Amount Charged:'.$amount);
$message  ='Deary '.$buyer_name.'Your order done Successful with Disconox.com';
$headers = "From: ".$buyer_name."" . "\r\n" .
"CC: narayanaphp90@gmail.com";
$email = mail($to,$subject,$message,$headers);
if($email){
	      echo"<script>alert('mail send uccessfully to ".$to."');</script>";
          }
  //send email to use
  
  $order_id = mysql_insert_id();
  $_SESSION['product_order_id']= $order_id;
  $_SESSION['amount'] =$amount ;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/');
  curl_setopt($ch, CURLOPT_HEADER, FALSE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER,
 array("X-Api-Key:4a7e198a8ff966eec1c843b7a5e7597a",
 "X-Auth-Token:7505126ef589be432677055b38a88862"));
$payload = Array(
 'purpose' => $purpose,
 'amount' => $amount,
 'phone' => $phone,
 'buyer_name' => $buyername,
 //'redirect_url' => 'http://www.disconox.com',
 //'webhook' => 'http://www.disconox.com/webhook.php',
 'redirect_url' => 'http://13.59.92.22',
 'webhook' => 'http://13.59.92.22/webhook.php',
 'send_email' => true,
 'send_sms' => true,
 'email' => $email,
 'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch);
$data = json_decode($response,true);
//var_dump($data);
//insert into sales db
//session_start();
//$username = $_SESSION["username"];


$site=$data["payment_request"]["longurl"];
header('HTTP/1.1 301 Moved Permanently');
header('Location:'.$site);
echo '<script>window.location.href="' . $site . '";</script>';
} else {
 header("Location:index.php");
}
}


?>