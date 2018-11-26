<?php 
//if(isset($_POST['login']) && !isset($_GET['userid'])){
if(isset($_POST['login']) && !isset($_SESSION['id'])){
	//echo"post"; exit;
$data  = array(
	   "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
	   "email"=>$_POST['email'],
	   "password"=>$_POST['password']
	   );
	$data_json = json_encode($data);
	$ur = url."login";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $ur);
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
			
			$message = $responsObj['message'];
		    echo "<script type='text/javascript'>alert('$message');
		window.location='index.php';</script>";
		} else {
			
			$message = $responsObj['message'];
		    echo "<script type='text/javascript'>alert('$message');</script>";
			$user = $responsObj['UserDetails'];
			$_SESSION['id'] = $user['id'];
			$userId = $_SESSION['id'];
			$_SESSION['name'] = $user['name'];
			$_SESSION['email'] = $user['email'];
			$_SESSION['image'] = $user['image'];
			$_SESSION['address'] = $user['address'];
			$_SESSION['phone'] = $user['phone'];
			$_SESSION['role'] = $user['role']; 
			if($_SESSION['role']==2)
			{ 
		    header('location:partners/index.php?userid='.$userId);
		    //echo "<script type='text/javascript'>window.location.replace(partners/index.php?userid=$userId';</script>";
			}elseif($_SESSION['role']==1)
			{			
			header('location:admin/index.php?userid='.$userId);	
		    //echo "<script type='text/javascript'>window.location='location:admin/index.php?userid=$userId';</script>";
				
			}else
			{
				header("location:index.php?userid=".$userId);
				//echo "<script type='text/javascript'>window.location='index.php?userid=$userId';</script>";
				
				
			}
	}	
	curl_close($ch);
		//end
}
}

if(isset($_POST['signup'])){
	 
	//user registration 
	$data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "name"=>$_POST['user_name'],
           "password"=>$_POST['password'],
           "phone"=>$_POST['phone'],
           "email"=>$_POST['email'],
           "address"=>"",
           "image"=>"",
           "role"=>3,
		   "venue_name"=>"",
		   "street_name"=>"",
		   "city"=>"",
		   "state"=>"",
		   "location"=>""
           );
		$data_json = json_encode($data);
		$uk = $login_url."registration";
		
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
        $message = $responsObj['message'];
		/*$message = '<div class="alert alert-success fade in"><a href="#" class="close" 												data-dismiss="alert">&times;</a><strong>Success!</strong>'.$message.'.</div>';*/
		echo "<script type='text/javascript'>alert('$message');
		window.location='index.php';</script>";
    } else {
		$message = $responsObj['message'];
	
		$user = $responsObj;
		
		$_SESSION['id'] = $user['id'];
		$_SESSION['name'] = $user['name'];
		$_SESSION['email'] = $user['email'];
		$_SESSION['phone'] = $user['phone'];
		$_SESSION['role'] = $user['role'];
		
		echo "<script type='text/javascript'>alert('$message');
		window.location='index.php';</script>";
    } 
}	
curl_close($ch);
//singup end
	}

if(isset($_POST['forgot'])){
/*partner start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "role"=>2
);
$data_json = json_encode($data);
$ui = url."all_users"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ui);
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
        $users = $responsObj['PartnersData'];
		
    } 
}	
curl_close($ch);
}
/*partner end*/
/*review start*/
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "productId"=>0
);
$data_json = json_encode($data);
$ub = url."getreviews"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ub);
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
        //echo "Bad Request";
    } else {
        $message = $responsObj['message'];
        $reviews = $responsObj['reviews'];
		
    } 
}	
curl_close($ch);
/*review end*/

//forgotpassword
if(isset($_POST['account'])){
$email = $_POST['email'];
$data = array(
    "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
    "email"=>$email 
);
$data_json = json_encode($data);

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

    if ($responsObj["error"]) {
        echo "Bad Request";
    } else {
        $message = $responsObj['message'];
         if($message=="User Data"){
//mail function start
$to      = 'example@example.com';
$subject = "Mail Regarding Forgot Password";
$message = "Please Click This LInk To Login" ;
$header = "From: noreply@example.com\r\n"; 
$header.= "MIME-Version: 1.0\r\n"; 
$header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
$header.= "X-Priority: 1\r\n"; 

if(mail($email, $subject, $message, $header)){
	echo"<script>alert('Email send to Your Email ');</script>";
	}else{
			echo"<script>alert('Email sending Failed to Your Email ');</script>";
		}
//mail function end
				}else{
				echo'<script>alert("userNotExist")</script>';
					}
	} 
}	
curl_close($ch);

	}	
?>
<header class="c-layout-header c-layout-header-3 c-layout-header-3-custom-menu c-layout-header-dark-mobile" data-minimize-offset="80">
  <div class="c-topbar c-topbar-dark  c-solid-bg">
    <div class="container-fluid">
      <!-- BEGIN: INLINE NAV -->
      <nav class="c-top-menu c-pull-left">
        <ul class="c-icons c-theme-ul">
          <li>
            <a href="#"> 
              <i class="fa  fa-map-marker">
              </i> Hyderabad, India. 
            </a>
          </li>
        </ul>
      </nav>
      <!-- END: INLINE NAV -->
      <!-- BEGIN: INLINE NAV -->
      <nav class="c-top-menu c-pull-right">
        <ul class="c-links c-theme-ul">
          <li>
            <a href="index.php">Home
            </a>
          </li>
          <li class="c-divider">|
          </li>
          <li>
            <a href="about.php">About us
            </a>
          </li>
          <li class="c-divider">|
          </li>
          <li>
            <a href="contact-us.php">Contact us</a>
          </li>
          <li class="c-divider">|
          </li>
          <li>
           <a data-toggle="modal" data-target=".enquiry">Capture your event</a>
          </li>
          <li class="c-divider">|
          </li>
          <li>
           <a href="gallery.php">Gallery</a>
          </li>
          <li class="c-divider">|
          </li>
          <li>
           <a href="shop.php">Shop</a>
          </li>
          <li class="c-divider">|
          </li>
        </ul>
        <ul class="c-ext c-theme-ul">
          <!--<li>
            <a href="#" class="c-btn-icon c-cart-toggler"> 
              <i class="fa fa-bell-o c-gold">
              </i>
              <span class="c-cart-number ">5
              </span>
            </a>
          </li>
          <li class="c-divider">|
          </li>-->
          <li>
            <?php if(isset($_SESSION['id'])){ 
				    if($_SESSION['role']==1){
					  echo "<a class='sign-btn c-btn c-btn-header btn btn-sm c-btn-border-1x c-btn-circle c-btn-uppercase c-btn-sbold' href='index.php'><i class='fa fa-user'></i> ".$_SESSION['name']."</a>";
				    }elseif($_SESSION['role']==2){ 
					  echo "<a class='sign-btn c-btn c-btn-header btn btn-sm c-btn-border-1x c-btn-circle c-btn-uppercase c-btn-sbold' href='partners/index.php'><i class='fa fa-user'></i> ".$_SESSION['name']."</a>"; 
				    }else{ 
					  echo "<a class='sign-btn c-btn c-btn-header btn btn-sm c-btn-border-1x c-btn-circle c-btn-uppercase c-btn-sbold c-quick-sidebar-toggler'><i class='fa fa-user'></i> ".$_SESSION['name']."</a>"; 
				    } 
			  ?>
          <?php }else{?>
		  
            <a data-toggle="modal" data-target="#login-form" class="sign-btn c-btn  c-btn-header btn btn-sm c-btn-border-1x c-btn-circle c-btn-uppercase c-btn-sbold">
              <i class="fa fa-user"></i> Login
            </a>
			
          <?php } ?>
          </li>
          <li class="c-lang dropdown c-last">
            <a href="#">
              <i class="fa fa-map-marker">
              </i>
            </a>
            <ul class="dropdown-menu pull-right" role="menu">
              <li class="active">
                <a href="#">Hyderabad
                </a>
              </li>
              <li>
                <a href="#" style="color:#999">Bangalore  (Coming Soon)
                </a>
              </li>
              <li>
                <a href="#" style="color:#999;">Pune  (Coming Soon)
                </a>
              </li>
              <li>
                <a href="#" style="color:#999;">Goa  (Coming Soon)
                </a>
              </li>
              <li>
                <a href="#" style="color:#999;">Mumbai  (Coming Soon)
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- END: INLINE NAV -->
    </div>
    <div class="c-cart-menu">
      <div class="c-cart-menu-title">
        <p>
          <h4> You dont have any Notifications
          </h4>
        </p>
      </div>
      <div class="c-padding-10 c-font-13">
        <div class="alert alert-warning alert-dismissible" role="alert">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          <a class="c-font-slim" href="#">View
        </a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
          <span aria-hidden="true">×
          </span> 
        </button>
        </div>
        <div class="alert alert-warning alert-dismissible" role="alert"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          <a class="c-font-slim" href="#">View
        </a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
          <span aria-hidden="true">×
          </span> 
        </button>
        </div>
        <div class="alert alert-warning alert-dismissible" role="alert"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
          <a class="c-font-slim" href="#">View
        </a>.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
          <span aria-hidden="true">×
          </span> 
        </button>
        </div>
      </div>
      <div class="c-cart-menu-footer">
        <a href="notifications.php" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase">View All
      </a>
      </div>
    </div>
  </div>
  <div class="c-navbar">
    <div class="container-fluid">
      <!-- BEGIN: BRAND -->
      <div class="c-navbar-wrapper clearfix">
        <div class="c-brand c-pull-left">
          <a href="index.php" class="c-logo"> 
          <img src="assets/base/img/layout/logos/logo-1.png" alt="DISCONOX" class="c-desktop-logo"> 
          <img src="assets/base/img/layout/logos/logo-2.png" alt="DISCONOX" class="c-desktop-logo-inverse"> 
          <img src="assets/base/img/layout/logos/logo-3.png" alt="DISCONOX" class="c-mobile-logo"> 
        </a>
          <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu"> 
          <span class="c-line">
          </span> 
          <span class="c-line">
          </span> 
          <span class="c-line">
          </span> 
        </button>
          <button class="c-topbar-toggler" type="button"> 
          <i class="fa fa-ellipsis-v">
          </i> 
        </button>
        </div>
        <!-- END: BRAND -->
        <!-- END: QUICK SEARCH -->
        <!-- BEGIN: HOR NAV -->
        <!-- BEGIN: LAYOUT/HEADERS/MEGA-MENU -->
        <!-- BEGIN: MEGA MENU -->
        <!-- Dropdown menu toggle on mobile: c-toggler class can be applied to the link arrow or link itself depending on toggle mode -->
        <nav class="c-mega-menu c-pull-right c-mega-menu-dark c-mega-menu-dark-mobile c-fonts-uppercase c-fonts-bold">
          <ul class="nav navbar-nav c-theme-nav">
            <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('1')==$_GET['pd']){ echo 'c-active'; } } ?>">
              <a href="search-results.php?pd=<?php echo base64_encode(1); ?>" class="c-link">Deals & Offers
            </a>
            </li>
            <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('4')==$_GET['pd']){ echo 'c-active'; }} ?>">
              <a href="search-results.php?pd=<?php echo base64_encode(4); ?>" class="c-link">Book A Table
            </a>
            </li>
             <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('5')==$_GET['pd']){ echo 'c-active'; } }?>">
              <a href="search-results.php?pd=<?php echo base64_encode(5); ?>" class="c-link">Book A Bottle
            </a>
            </li>
             <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('6')==$_GET['pd']){ echo 'c-active'; } }?>">
              <a href="search-results.php?pd=<?php echo base64_encode(6); ?>" class="c-link">Packages
            </a>
            </li>
            <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('7')==$_GET['pd']){ echo 'c-active'; } } ?>">
              <a href="search-results.php?pd=<?php echo base64_encode(7); ?>" class="c-link">Entry
            </a>
            </li>
             <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('3')==$_GET['pd']){ echo 'c-active'; } } ?>">
              <a href="search-results.php?pd=<?php echo base64_encode(3); ?>" class="c-link">Guest List
            </a>
            </li>
            <li class="<?php if(isset($_GET['pd'])){ if(base64_encode('2')==$_GET['pd']){ echo 'c-active'; } } ?>">
              <a href="search-results.php?pd=<?php echo base64_encode(2); ?>" class="c-link">Surprise
            </a>
            </li>
           
            <?php if(isset($_SESSION['id'])){  ?>
            <li class="c-quick-sidebar-toggler-wrapper">
              <a href="#" class="c-quick-sidebar-toggler"> 
              <span class="c-line">
              </span> 
              <span class="c-line">
              </span> 
              <span class="c-line">
              </span> 
            </a>
            </li>
            <?php } ?>
          </ul>
        </nav>
        <!-- END: MEGA MENU -->
        <!-- END: LAYOUT/HEADERS/MEGA-MENU -->
        <!-- END: HOR NAV -->
      </div>
      <!-- BEGIN: LAYOUT/HEADERS/QUICK-CART -->
      <!-- BEGIN: CART MENU -->
      <!-- END: CART MENU -->
      <!-- END: LAYOUT/HEADERS/QUICK-CART -->
    </div>
  </div>
</header>
<!-- END: LAYOUT/HEADERS/HEADER-1 -->
<!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->

<div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content c-square">
      <div class="modal-header c-no-border">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;
          </span> 
        </button>
      </div>
      <div class="modal-body">
        <h3 class="c-font-24 c-font-sbold">Password Recovery
        </h3>
        <p>To recover your password please fill in your email address
        </p>
        <form action="" method="post">
          <div class="form-group">
            <label for="forget-email" class="hide">Email</label>
            <input type="email" name="email" class="form-control input-lg c-square" id="email" placeholder="Email">
          </div>
          <div class="form-group">
            <input type="submit" name="account" id="account" value="ForgotPassword" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login" >
            <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login
            </a>
          </div>
        </form>
      </div>
      <div class="modal-footer c-no-border">
        <span class="c-text-account">Don't Have An Account Yet ?
        </span>
        <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!
        </a>
      </div>
    </div>
  </div>
</div>
<div class="modal fade c-content-login-form" id="signup-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content c-square">
      <div class="modal-header c-no-border">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;
          </span> 
        </button>
      </div>
      <div class="modal-body">
        <h3 class="c-font-24 c-font-sbold">Create An Account
        </h3>
        <p>Please fill in below form to create an account with us
        </p>
        <form action="" method="post">
          
          <div class="form-group">
            <label for="signup-username" class="hide">Name</label>
            <input type="text" class="form-control input-lg c-square" id="user_name" name="user_name" placeholder="Name" required>
          </div>
          
          <div class="form-group">
            <label for="signup-email" class="hide">Email</label>
            <input type="email" class="form-control input-lg c-square" id="email" name="email" placeholder="Email" required>
          </div>
          
          <div class="form-group">
            <label for="signup-email" class="hide">Phone</label>
            <input type="text" class="form-control input-lg c-square" id="phone" name="phone" placeholder="Phone" maxlength="10" required>
          </div>
          
          <div class="form-group">
            <label for="signup-fullname" class="hide">Password</label>
            <input type="password" class="form-control input-lg c-square" name="password" id="password" placeholder="Password"  maxlength="10" required>
          </div>
          <div class="form-group">
            <label for="signup-fullname" class="hide">Confirm Password</label>
            <input type="password" class="form-control input-lg c-square" id="cpassword" name="cpassword" placeholder="Confirm Password" maxlength="10" required>
          </div>
          <div class="form-group">
            <button type="submit" name="signup" id="signup" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Signup
            </button>
            <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- END: CONTENT/USER/SIGNUP-FORM -->
<!-- BEGIN: CONTENT/USER/LOGIN-FORM -->
<div class="modal fade c-content-login-form" id="login-form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content c-square">
      <div class="modal-header c-no-border">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> 
          <span aria-hidden="true">&times;</span> 
        </button>
      </div>
      <div class="modal-body">
        <?php if(isset($_GET['st'])){ ?>
        <p style="color:red;"><?php echo base64_decode($_GET['st']); ?></p>
        <?php }else{ ?>
        <h3 class="c-font-24 c-font-sbold">Good Afternoon!</h3>
        <p>Let's make today a great day!</p>
        <?php } ?>
        <form action="" method="post">
          <div class="form-group">
            <label for="login-email" class="hide">Email</label>
            <input type="email" class="form-control input-lg c-square" id="email" name="email" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label for="login-password" class="hide">Password</label>
            <input type="password" class="form-control input-lg c-square" id="password" name="password" placeholder="Password" required maxlength="10">
          </div>
		   <div class="form-group">
            <label for="login-password" class="hide"></label>
          <input type="checkbox" value="remember-me" id="remember_me" class="box" > Remember me
          </div>
          <!--<div class="form-group">
            <div class="c-checkbox">
              <input type="checkbox" id="login-rememberme" class="c-check">
              <label for="login-rememberme" class="c-font-thin c-font-17"> 
                <span></span> 
                <span class="check"></span> 
                <span class="box"></span> Remember Me 
              </label>
            </div>
          </div>-->
          <div class="form-group">
            <button type="submit" name="login" id="login" value="login" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">
              <?php if(!isset($_SESSION['id'])){ echo"Login";} ?>
            </button>
            <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?
            </a>
          </div>
		    <!--remember me login function start-->
		  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            $(function() {

                if (localStorage.chkbx && localStorage.chkbx != '') {
                    $('#remember_me').attr('checked', 'checked');
                    $('#email').val(localStorage.usrname);
                    $('#password').val(localStorage.pass);
                } else {
                    $('#remember_me').removeAttr('checked');
                    $('#email').val('');
                    $('#password').val('');
                }

                $('#remember_me').click(function() {

                    if ($('#remember_me').is(':checked')) {
                        // save username and password
                        localStorage.email = $('#email').val();
                        localStorage.password = $('#password').val(); 
                        localStorage.chkbx = $('#remember_me').val(); 
                    } else {
                        localStorage.email = '';
                        localStorage.password = '';
                        localStorage.chkbx = '';
                    }
                });
            });

        </script>
		
		  <!--remember me login function end-->
          <!--<div class="clearfix">
            <div class="c-content-divider c-divider-sm c-icon-bg c-bg-grey c-margin-b-20">
              <span>or signup with
              </span>
            </div>
            <ul class="c-content-list-adjusted">
              <li>
                <a class="btn btn-block c-btn-square btn-social btn-twitter"> <i class="fa fa-twitter"></i> Twitter </a>
              </li>
              <li>
                <a class="btn btn-block c-btn-square btn-social btn-facebook"> <i class="fa fa-facebook"></i> Facebook </a>
              </li>
              <li><a class="btn btn-block c-btn-square btn-social btn-google"> <i class="fa fa-google"></i> Google </a>
              </li>
            </ul>
          </div>-->
        </form>
      </div>
      <div class="modal-footer c-no-border">
        <span class="c-text-account">Don't Have An Account Yet ?
        </span>
        <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!
        </a>
      </div>
    </div>
  </div>
</div>
<!-- END: CONTENT/USER/LOGIN-FORM -->
<!-- BEGIN: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
<nav class="c-layout-quick-sidebar">
  <div class="c-header">
    <button type="button" class="c-link c-close"> 
      <i class="fa fa-close"></i> 
    </button>
  </div>
  <div class="c-content">
    <div class="c-section">
      <div class="c-content-title-2">
        <?php  
		
		if(isset($_SESSION['image']))
		{
			
			 if(isset($_SESSIOIN['role'])==1)
			 {
				 if($_SESSION['image'] == "")
				 {
					$imagurl = "assets/images/p-pic.png"; 
				 }
				 else
				 {
					 
				 $imagurl = "admin/".$_SESSION['image'];
				 
				 }
				 
			 }else if(isset($_SESSIOIN['role'])==2)
			 { 
		        if($_SESSION['image'] == "")
				 {
					 
					$imagurl = "assets/images/p-pic.png"; 
					
				 }
				 else
				 {
					 
				 $imagurl = "partners/".$_SESSION['image'];
				 
				 }
			 }else
			 {
				 
				 if($_SESSION['image'] == "")
				 {
					$imagurl = "assets/images/p-pic.png"; 
				 }
				 else
				 {
					 
				    $imagurl = $_SESSION['image'];
				 
				 }
			 }
        }else
		{
			
	    $imagurl = "assets/images/p-pic.png";
		}
		
		
		?>
        <div class="profile-pic">
          <a href="#">
            <img class="img-responsive" src="<?php echo $imagurl;?>"/>
          </a>
        </div>
        <h4 class="c-center c-font-white">
          <?php if(isset($_SESSION['name'])){ echo $_SESSION['name'];}else{ echo"User Name";}?>
        </h4>
        <div class="c-line c-dot c-theme-bg c-theme-bg-after">
        </div>
        <p class="c-center c-font-white">Welcome to Disconox
        </p>
      </div>
      <div class="c-content-ver-nav">
        <div class="c-content-title-1 c-title-md c-margin-t-40">
          <h3 class="c-font-white">Account Settings</h3>
          <div class="c-line-left c-theme-bg"></div>
        </div>
        <ul class="c-menu c-arrow-dot1 c-theme">
          <li>
            <a href="profile-settings.php"><i class="fa fa-user"></i> Profile Settings</a>
          </li>
          <li>
            <a href="booking-history.php"><i class="fa fa-history"></i> Booking History</a>
          </li>
          <li>
            <a href="notifications.php"><i class="fa fa-bell"></i> Notifications</a>
          </li>
          <li>
            <a href="receipts.php"><i class="fa fa-file-text"></i> Receipts</a>
          </li>
          <li>
            <a href="logout.php"><i class="fa fa-eject"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>

 <div class="modal fade enquiry" tabindex="-1" role="dialog" aria-labelledby="date-time" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content c-square">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
          <h4 class="modal-title" id="date-time">Enquiry</h4>
        </div>
        <div class="modal-body">
        
           <fieldset>
              <div class="form-group">
                 <div class="input-group col-md-12">
                  <input class="form-control" size="16" type="text" value="" placeholder="Name">
                 </div>
                 <div class="input-group col-md-12">
                  <input class="form-control" size="16" type="text" value="" placeholder="Email">
                 </div>
                 <div class="input-group col-md-12">
                  <input class="form-control" size="16" type="text" value="" placeholder="Phone Number">
                 </div>
                <br/>
              </div>
            </fieldset>
            <div class="modal-footer">
              <button type="button"  data-dismiss="modal" name="checkout1" value="checkout" class="btn c-theme-btn c-btn-square c-btn-bold c-btn-uppercase">Done</button>
              </a>
              
            </div>
         
        </div>
      </div>
    </div>
  </div>
<!-- END: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
<!-- BEGIN: PAGE CONTAINER -->
						<!--rating css/js--------------------->
                       
<script>
$(document).ready(function() {
    $("form#ratingForm").submit(function(e) 
    {
        e.preventDefault(); // prevent the default click action from being performed
        if ($("#ratingForm :radio:checked").length == 0) {
            $('#status').html("nothing checked");
            return false;
        } else {
            $('#status').html( 'You picked ' + $('input:radio[name=rating]:checked').val() );
        }
    });
});
</script>
<style>
.rating {
    float:left;
}

/* :not(:checked) is a filter, so that browsers that don't support :checked don't 
   follow these rules. Every browser that supports :checked also supports :not(), so
   it doesn't make the test unnecessarily selective */
.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;	
    font-size:100%;
    line-height:1.2;
    color:#ddd;
    text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
    content: '★ ';
}

.rating > input:checked ~ label {
    color: #c60;
    text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:hover,
.rating:not(:checked) > label:hover ~ label {
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > input:checked + label:hover,
.rating > input:checked + label:hover ~ label,
.rating > input:checked ~ label:hover,
.rating > input:checked ~ label:hover ~ label,
.rating > label:hover ~ input:checked ~ label {
    
    text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
}

.rating > label:active {
    position:relative;
    top:2px;
    left:2px;
}

/* end of Lea's code */

/*
 * Clearfix from html5 boilerplate
 */

.clearfix:before,
.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

.clearfix:after {
    clear: both;
}

/*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */

.clearfix {
    *zoom: 1;
}

/* my stuff */
#status, button {
    margin: 20px 0;
}
.c-theme-on-hover.active {
    color: #c7a369 !important;
	border: 1px solid #353b3e !important;
	background-color:#1a1a1a !important;
}
.c-theme-on-hover:hover {
	background-color: #2a2e31 !important;
}
</style>