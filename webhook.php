<?php
/*
Basic PHP script to handle Instamojo RAP webhook.
*/
session_start();
$data = $_POST;
$mac_provided = $data['mac']; // Get the MAC from the POST data
unset($data['mac']); // Remove the MAC key from the data.
$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];
if($major >= 5 and $minor >= 4){
 ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
 uksort($data, 'strcasecmp');
}
// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without <>
$mac_calculated = hash_hmac("sha1", implode("|", $data), "d07eb2d7e252493c8d191f45f590f6ff");
if($mac_provided == $mac_calculated){
 $payment_id = $data['payment_id'];
 $status = $data['status'];
 $amount = $data['amount'];
 $purpose = $data['purpose'];
 $order_id = $_SESSION['product_order_id'];
 $_SESSION['amount'] = $amount;
 if($data['status'] == "Credit"){
  $upd="update product_orders set payment_id='$payment_id',price='$amount',status='success' where id='$order_id'";
  mysql_query($upd);
  header("location:after-checkout.php");
 }
 else{
  $upd="update product_orders set payment_id='$payment_id',price='$amount',status='fail' where id='$order_id'";
  mysql_query($upd);
  header("location:index.php");
 }
}
else{
 echo "MAC mismatch";
}
?>