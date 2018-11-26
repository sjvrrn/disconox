<!DOCTYPE html>

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
  <meta charset="utf-8" />
  <title>DISCONOX</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta content="" name="description" />
  <meta content="" name="author" />
<?php 
require_once("header.php"); 
//echo"<pre><br>";print_r($_POST); exit; 
//place orders
//print_r($_POST); exit;
if(isset($_POST['checkout'])){ 
	//print_r($_POST); exit;
    $_SESSION['item']=""; $_SESSION['price'] = 0; $_SESSION['time'] = ""; $_SESSION['product_id'] =0; $_SESSION['cateogry_id']=0;	
    $_SESSION['item']= $_POST['item']; 
	$_SESSION['price'] = $_POST['price'];
	$_SESSION['time'] = $_POST['time'];
	$_SESSION['product_id']  = $_POST['product_id'];
	if(isset($_POST['category_id'])){
	$_SESSION['category_id'] = $_POST['category_id'];	
	}
	
}					

//third party registration	
if(isset($_POST['submit'])){
	//user registration 
	$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "name"=>$_POST['fname'].'-'.$_POST['lname'],
           "password"=>$_POST['password'],
           "phone"=>$_POST['mobile'],
           "email"=>$_POST['email'],
           "address"=>$_POST['address'],
           "image"=>"",
           "role"=>3
           );
		$data_json = json_encode($data);
		$uk = $url."registration";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $uk);
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
        $message = $responsObj['message'];
        $user_id = $responsObj['validUserDetails']; 
		session_start();
		$_SESSION['id'] = $user_id;
		$_SESSION['name'] = $_POST['fname'].'-'.$_POST['lname'];
		
		header('location:checkout.php');
	} 
}	
curl_close($ch);
//singup end
	}
?>
<script>
    function check() {

      if (document.getElementById('createAccount').checked) {
        return true;
      } else {
        alert('Please Accept  Create  Your Account');
        return false;
      }


    }
  </script>
</head>
<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once('top.php');?>
  <style>
    .has-error {
      border: #ff0000 solid 1px;
    }

    .has-success {
      border: #04c448 solid 1px;
    }
  </style>
  <!-- END: HEADER -->

  <!-- BEGIN: PAGE CONTAINER -->
  <div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->

    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->

    <div class="c-content-box c-size-md c-bg-grey">
      <form name="checkout" method="post" action="checkoutpay.php" id="checkout" onsubmit="return validate();">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <!--<form class="c-shop-form-1"  action="" method="post">-->
              <!-- BEGIN: ADDRESS FORM -->
              <div class="">
                <!-- BEGIN: BILLING ADDRESS -->
                <?php 		
				//Array ( [id] => 1 [name] => kiran-k [email] => kiran@gmail.com [image] => [address] => srnagar,hyderabad,Andhra Pradesh [role] => 2 ) 
				if(isset($_SESSION['name']))
				{
					
				$name = explode("-",$_SESSION['name']);
				
				}
				else
				{
					
				$name = "";
				
				}
				
				if(isset($_SESSION['address']))
				{
					
				$address = explode(",",$_SESSION['address']);
				
				}
				else
				{
					
				$address = "";
				
				}
				
			  ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label">First Name</label>
                        <input type="text" name='fname' id='fname' class="form-control c-square c-theme" placeholder="First Name" value='<?php if(isset($name[0])) { echo $name[0]; }?>' required>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label">Last Name</label>
                        <input type="text" name='lname' id='lname' class="form-control c-square c-theme" placeholder="Last Name" value='<?php if(isset($name[1])) {  echo $name[1]; }?>' required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label class="control-label">Address</label>
                    <input type="text" class="form-control c-square c-theme" name='address' id='address' placeholder="Street Address" value="<?php if(isset($_SESSION['address'])) { echo $_SESSION['address']; }?>" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="control-label">Town / City</label>
                    <input type="text" class="form-control c-square c-theme" placeholder="Town / City" name='city' id='city' value="<?php if(isset($address[0])) { echo $address[0]; }?>" required>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label class="control-label">Email Address</label>
                        <input type="email" class="form-control c-square c-theme" placeholder="Email Address" name='email' id='email' value="<?php if(isset($_SESSION['email'])) { echo $_SESSION['email']; }?>" required>
                      </div>
                      <div class="col-md-6">
                        <label class="control-label">Phone</label>
                        <input type="tel" name='mobile' id='mobile' class="form-control c-square c-theme" placeholder="Phone" value="<?php if(isset($_SESSION['phone'])) { echo $_SESSION['phone']; }?>" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12">
                    <?php  if(!isset($_SESSION['id'])){?>
                    <div class="row">
                      <div class="form-group col-md-6">
                        <input type="checkbox" name='createAccount' id='createAccount' required>
                        <label class="control-label">Create Account</label>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <!--<div class="row c-margin-t-15">
                <div class="form-group col-md-12">
                  <div class="c-checkbox c-toggle-hide" data-object-selector="c-account" data-animation-speed="600">
                    <input type="checkbox" id="checkbox1-77" class="c-check">
                    <label for="checkbox1-77"> <span class="inc"></span> <span class="check"></span> <span class="box"></span> Create an account? </label>
                  </div>
                  <p class="help-block">Create an account by entering the information below. If you are a returning customer please login.</p>
                </div>
              </div>-->
                <!--<div class="row c-account">
                <div class="form-group col-md-12">
                  <label class="control-label">Account Password</label>
                  <input type="password" class="form-control c-square c-theme" name='password' id='password' placeholder="Password">
                </div>
              </div>-->

                <!-- END: PASSWORD -->
                <!--<div class="row c-margin-t-30">
                <div class="form-group col-md-12" role="group">
                  <button type="submit" name='submit' id='submit' value='submit'  class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Submit</button>
                  <button type="reset"class="btn btn-lg btn-border c-btn-square c-btn-uppercase c-btn-bold">Cancel</button>
                </div>
              </div>-->
              </div>
              <!-- END: ADDRESS FORM -->
              <!--</form>      -->
            </div>
			
            <div class="col-md-5">
              <div class="c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
                <h1 class="c-font-bold c-font-uppercase c-font-24">Your Order</h1>

                <ul class="c-order list-unstyled">
                  <li class="row c-margin-b-5">
                    <div class="pay-head">
                      <div class="col-md-6 c-font-20">
                        <p class="c-margin-t-10">Perticulars</p>
                      </div>
                      <div class="col-md-6 c-font-20">
                        <p class="c-margin-t-10">Total</p>
                      </div>
                    </div>
                  </li>
                  <?php //for($i=0;$i<(count($_SESSION['price']));$i++){?>
                  <li class="row c-border-bottom"></li>
                  <li class="row ">
                    <div class="col-md-6 c-font-20">
                      <a href="#" class="c-theme-link c-gold">
                        <?php echo $_SESSION['item'];?>
                      </a>
                      <input type="hidden" name="item" value="<?php echo $_SESSION['item'];?>">
                      <input type="hidden" name="product_id" value="<?php echo $_SESSIOIN['product_id'];?>">
                      <input type="hidden" name="time" value="<?php echo $_SESSION['time'];?>">
                      <?php if(isset($_SESSION['id'])){ ?>
                      <input type="hidden" name="uid" value="<?php echo $_SESSION['id'];?>">
                      <?php }else{ ?>
                      <input type="hidden" name="uid" value="0">
                      <?php }?>
                    </div>
                    <div class="col-md-6 c-font-20 c-gold">
                      <p class="">Rs.
                 <?php  echo $_POST['price']; ?>/-</p>
                      <input type="hidden" name="price" value="<?php echo $_POST['price'];;?>">

                    </div>
                  </li>
                  <?php //}?>
                  <li class="row ">
                    <div class="col-md-6 c-font-20">
                      <p class="c-font-30">Total</p>
                    </div>
                    <div class="col-md-6 c-font-20">
                      <p class="c-font-bold c-font-30">Rs. <span class="c-shipping-total"><?php $x=0;  if(isset($_POST['price'])){ echo $_POST['price']; }?></span>
                        <input type="hidden" name="total" value="<?php echo $_POST['price']; ?>">
                      </p>
                    </div>
                  </li>
                  <hr class="border-b-1">
                  <li class="row c-margin-b-5 c-margin-t-5">
                    <div class="form-group col-md-12">
                      <div class="c-checkbox">
                        <input type="checkbox" id="checkbox1-11" class="c-check" checked>
                        <label for="checkbox1-11">
                      <span class="inc"></span> <span class="check"></span> <span class="box"></span>
                      <p class="c-font-14">I've read and accept the Terms & Conditions <a class="c-gold" data-toggle="modal" data-target=".bs-example-modal-lg">View Terms
                        </button>
                        </a></p>
                      </label>

                        <!--terms model start-->
                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content c-square">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <h4 class="modal-title" id="myLargeModalLabel">Terms & Conditions</h4>
                              </div>
                              <div class="modal-body">
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum </p>
                                <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum </p>
                              </div>
                              <div class="modal-footer"> <a href="after-checkout.html">
                              
                              </a>
                                <button type="button" class="btn c-btn-dark c-btn-border-2x c-btn-square c-btn-bold c-btn-uppercase" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                            <!-- /.modal-content -->
                          </div>
                          <!-- /.modal-dialog -->
                        </div>
                        <!--terms model end-->
                      </div>
                    </div>
                  </li>
                  <li class="row">
                    <div class="form-group col-md-12" role="group">
                      <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold" name="paynow" id="paynow" value="paynow" onclick='check()'>Pay Now</button>
                      <button type="reset" class="btn btn-lg btn-default c-btn-square c-btn-uppercase c-btn-bold">Cancel</button>
                    </div>
                  </li>
                </ul>

              </div>

              <!-- END: PAGE CONTENT -->
            </div>
          </div>
          <!--col div-->

        </div>
      </form>
    </div>
  </div>
  <!-- END: PAGE CONTAINER -->
  <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
  <?php require_once('footer.php');?>
  <!-- BEGIN: CORE PLUGINS -->
  <script>
    function validate() {
      var name = $("#fname").val();
      var mobile = $("#mobile").val();
      var address = $("#address").val();
      var city = $("#city").val();
      /*var pass =  $("#user-pw").val();
       */

      var proc = "t";

      if (name == "") {
        $("#fname").addClass("has-error");
        proc = "f";
      } else {
        $("#fname").addClass("has-success");
      }

      var phoneno = /^\d{10}$/;
      if (mobile == "") {
        $("#mobile").addClass("has-error");
        proc = "f";
      } else if (mobile.match(phoneno)) {
        proc = "t";
      } else {
        $("#mobile").addClass("has-success");
        proc = "f";
        alert("Please Enter Valid Phone number");
      }


      if (address == "") {
        $("#address").addClass("has-error");
        proc = "f";
      } else {
        $("#address").addClass("has-success");
      }


      if (city == "") {
        $("#city").addClass("has-error");
        proc = "f";
      } else {
        $("#city").addClass("has-success");
      }

      if (proc == "t") {
        return true;
      } else {
        return false;
      }

    }
  </script>
</body>

</html>