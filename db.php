<?php

//$con=mysqli_connect('localhost', 'disconox_disco', 'disconox_1', 'disconox_1');
$con=mysqli_connect('localhost', 'root', '', 'disconox_1');
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
?>