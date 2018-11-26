<?php 
error_reporting(0);
require_once("header.php");
	/*get all posts*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
		"user_id"=>0,
		"category_id"=>1
    );
    $data_json = json_encode($data);
	$ul=$url."product_list";
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

        if ($responsObj["error"]){
            echo "Bad Request";
        } else {
            $response = (object)$responsObj;
            $message = $response->message;
            $products = $response->productDetails;
			
         }
    }
    curl_close($ch);
	/*foreach start /end**/
	$i=0;
	foreach($products as $product){
		($i<11){
		$product = (object)$project; 	
		$content   .= '<div class="c-content-product-2 c-bg-white">
                            <div class="col-md-3">
                            <div class="row">
                                <div class="c-content-overlay">
                                    <div class="c-label c-bg-dark c-font-white c-font-12 c-font-bold"><i class="fa fa-camera"></i> 36</div>
                                    <div class="c-label c-label-right c-theme-bg c-font-white c-font-13 c-font-bold"><i class="fa fa-video-camera"></i> 3</div>
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="#" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url('.$project->image.');"></div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-9">
                                <div class="c-info-list">
                                    <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                        <a class="c-theme-link" href="#">'.$product->name.' </a>
                                        <span class="c-font-14 c-grey">PUB,CASUAL DINING</span>
                                    </h3>
                                    <span class="addr">'.$product->address.'</span>
                                    <p class="c-review-star">
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star-half-o c-theme-font"></span>
                                        <span class="fa fa-star-o c-theme-font"></span> (18) </p>
                                    <hr>
                                    <p class="c-desc c-font-14 c-font-thin">'.$product->description.'.</p>
                                    <hr>
                                    o
                                </div>
                                <div>
                                    <p class="a-offer"> Available Deals</p>
                                    <a href="deals-offers-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Deals & Offers</a>
                                    <a href="surprise-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Surprise</a>
                                    <a href="guest-list-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Guest List</a>
                                    <a href="book-table-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Table</a>
                                    <a href="book-bottle.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Book a Bottle</a>
                                    <a href="packages-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Packages</a>
                                    <a href="entry-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Entry</a>
                                </div>
                            </div>
                        </div>
                    </div>';
		}
	}
	
	
?>
 <!DOCTYPE html>

<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Disconox</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&amp;subset=all' rel='stylesheet' type='text/css'>
        <link href="assets/plugins/socicon/socicon.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-social/bootstrap-social.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
        <link href="assets/plugins/animate/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        
        <!-- BEGIN THEME STYLES -->
        <link href="assets/base/css/plugins.css" rel="stylesheet" type="text/css" />
        <link href="assets/base/css/components.css" id="style_components" rel="stylesheet" type="text/css" />
        <link href="assets/base/css/themes/default.css" rel="stylesheet" id="style_theme" type="text/css" />
        <link href="assets/base/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="assets/base/css/jquery-ui.css" rel="stylesheet">
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
        <link href="https://fonts.googleapis.com/css?family=Caveat:400,700" rel="stylesheet">
        </head>
 <body class="c-layout-header-fixed">
        <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: HEADER -->
        <header class="c-layout-header c-layout-header-3 c-layout-header-3-custom-menu c-layout-header-dark-mobile" data-minimize-offset="80">
            <div class="c-topbar c-topbar-dark  c-solid-bg">
                <div class="container-fluid">
                    <!-- BEGIN: INLINE NAV -->
                    <nav class="c-top-menu c-pull-left">
                        <ul class="c-icons c-theme-ul">
                            <li>
                                <a href="#">
                                    <i class="fa  fa-map-marker"></i> Event Booking, Hyderabad, India.
                                </a>
                            </li>
                            
                        </ul>
                    </nav>
                    <!-- END: INLINE NAV -->
                    <!-- BEGIN: INLINE NAV -->
                    <nav class="c-top-menu c-pull-right">
                        <ul class="c-links c-theme-ul">
                            <li>
                                <a href="index.html">Home</a>
                            </li>
                            <li class="c-divider">|</li>
                            <li>
                                <a href="about.html">About</a>
                            </li>
                            <li class="c-divider">|</li>
                            
                            <li>
                                <a href="contact-us.html">Contact</a>
                            </li>
                            <li class="c-divider">|</li>
                            <li>
                                <a href="faqs.html">FAQ's</a>
                            </li>
                            <li class="c-divider">|</li>
                            <li><a href="#"> <i class="fa fa-taxi"></i> Need Driver?</a>
                                </li>
                                <li class="c-divider">|</li>
                        </ul>
                        
                        <ul class="c-ext c-theme-ul">
                            
                           
                                <li><a href="#" class="c-btn-icon c-cart-toggler">
                                <i class="fa fa-bell-o c-gold"></i><span class="c-cart-number ">5</span></a></li>
                                <li class="c-divider">|</li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#login-form" class=" sign-btn c-btn  c-btn-header btn btn-sm c-btn-border-1x  c-btn-circle c-btn-uppercase c-btn-sbold ">
                                        <i class="fa fa-user"></i> Login</a>
                                </li>
                                
                                
                                <li class="c-lang dropdown c-last">
                                <a href="#"><i class="fa fa-map-marker"></i></a>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li class="active">
                                        <a href="#">Hyderabad</a>
                                    </li>
                                    <li>
                                        <a href="#">Delhi</a>
                                    </li>
                                    <li>
                                        <a href="#">Mumbai</a>
                                    </li>
                                    <li>
                                        <a href="#">Kolkata</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- END: INLINE NAV -->
                    
                </div>
                
                <div class="c-cart-menu">
                        <div class="c-cart-menu-title">
                            <p> <h4> You dont have any Notifications</h4></p>
                            
                        </div>
                        <div class="c-padding-10 c-font-13">
                        <div class="alert alert-warning alert-dismissible" role="alert">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                <a class="c-font-slim" href="#">View</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            
                            <div class="alert alert-warning alert-dismissible" role="alert"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                <a class="c-font-slim" href="#">View</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            
                            <div class="alert alert-warning alert-dismissible" role="alert"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                <a class="c-font-slim" href="#">View</a>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        </div>
                        
                        <div class="c-cart-menu-footer">
                            
                            <a href="notifications.html" class="btn btn-md c-btn c-btn-square c-theme-btn c-font-white c-font-bold c-center c-font-uppercase">View All</a>
                        </div>
                    </div>
            </div>
            <div class="c-navbar">
                <div class="container-fluid">
                    <!-- BEGIN: BRAND -->
                    <div class="c-navbar-wrapper clearfix">
                        <div class="c-brand c-pull-left">
                            <a href="index.html" class="c-logo">
                                <img src="assets/base/img/layout/logos/logo-1.png" alt="DISCONOX" class="c-desktop-logo">
                                <img src="assets/base/img/layout/logos/logo-2.png" alt="DISCONOX" class="c-desktop-logo-inverse">
                                <img src="assets/base/img/layout/logos/logo-3.png" alt="DISCONOX" class="c-mobile-logo"> </a>
                            <button class="c-hor-nav-toggler" type="button" data-target=".c-mega-menu">
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                                <span class="c-line"></span>
                            </button>
                            <button class="c-topbar-toggler" type="button">
                                <i class="fa fa-ellipsis-v"></i>
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
                                
                                <li class="c-active"><a href="search-results.html" class="c-link">Deals & Offers</a></li>
                                <li><a href="search-results.html" class="c-link">Surprise</a></li>
                                <li><a href="search-results.html" class="c-link">Guest List</a></li>
                                <li><a href="search-results.html" class="c-link">Book A Table</a></li>
                                <li><a href="search-results.html" class="c-link">Book A Bottle</a></li>
                                <li><a href="search-results.html" class="c-link">Packages</a></li>
                                <li><a href="search-results.html" class="c-link">Entry</a></li>
                                
                                
                                
                                
                                <li class="c-quick-sidebar-toggler-wrapper">
                                    <a href="#" class="c-quick-sidebar-toggler">
                                        <span class="c-line"></span>
                                        <span class="c-line"></span>
                                        <span class="c-line"></span>
                                    </a>
                                </li>
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
        <!-- END: HEADER -->
        <!-- END: LAYOUT/HEADERS/HEADER-1 -->
        <!-- BEGIN: CONTENT/USER/FORGET-PASSWORD-FORM -->
        <div class="modal fade c-content-login-form" id="forget-password-form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header c-no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="c-font-24 c-font-sbold">Password Recovery</h3>
                        <p>To recover your password please fill in your email address</p>
                        <form>
                            <div class="form-group">
                                <label for="forget-email" class="hide">Email</label>
                                <input type="email" class="form-control input-lg c-square" id="forget-email" placeholder="Email"> </div>
                            <div class="form-group">
                                <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Submit</button>
                                <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer c-no-border">
                        <span class="c-text-account">Don't Have An Account Yet ?</span>
                        <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: CONTENT/USER/FORGET-PASSWORD-FORM -->
        <!-- BEGIN: CONTENT/USER/SIGNUP-FORM -->
        <div class="modal fade c-content-login-form" id="signup-form" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content c-square">
                    <div class="modal-header c-no-border">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="c-font-24 c-font-sbold">Create An Account</h3>
                        <p>Please fill in below form to create an account with us</p>
                        <form>
                            <div class="form-group">
                                <label for="signup-email" class="hide">Email</label>
                                <input type="email" class="form-control input-lg c-square" id="signup-email" placeholder="Email"> </div>
                            <div class="form-group">
                                <label for="signup-username" class="hide">Username</label>
                                <input type="email" class="form-control input-lg c-square" id="signup-username" placeholder="Username"> </div>
                            <div class="form-group">
                                <label for="signup-fullname" class="hide">Password</label>
                                <input type="password" class="form-control input-lg c-square" id="password" placeholder="Password"> </div>
                                <div class="form-group">
                                <label for="signup-fullname" class="hide">Confirm Password</label>
                                <input type="password" class="form-control input-lg c-square" id="confirm password" placeholder="Confirm Password"> </div>
                            <!--<div class="form-group">
                                <label for="signup-country" class="hide">Country</label>
                                <select class="form-control input-lg c-square" id="signup-country">
                                    <option value="1">Country</option>
                                </select>
                            </div>-->
                            <div class="form-group">
                                <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Signup</button>
                                <a href="javascript:;" class="c-btn-forgot" data-toggle="modal" data-target="#login-form" data-dismiss="modal">Back To Login</a>
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
                        <h3 class="c-font-24 c-font-sbold">Good Afternoon!</h3>
                        <p>Let's make today a great day!</p>
                        <form>
                            <div class="form-group">
                                <label for="login-email" class="hide">Email</label>
                                <input type="email" class="form-control input-lg c-square" id="login-email" placeholder="Email"> </div>
                            <div class="form-group">
                                <label for="login-password" class="hide">Password</label>
                                <input type="password" class="form-control input-lg c-square" id="login-password" placeholder="Password"> </div>
                            <div class="form-group">
                                <div class="c-checkbox">
                                    <input type="checkbox" id="login-rememberme" class="c-check">
                                    <label for="login-rememberme" class="c-font-thin c-font-17">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> Remember Me </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn c-theme-btn btn-md c-btn-uppercase c-btn-bold c-btn-square c-btn-login">Login</button>
                                <a href="javascript:;" data-toggle="modal" data-target="#forget-password-form" data-dismiss="modal" class="c-btn-forgot">Forgot Your Password ?</a>
                            </div>
                            <div class="clearfix">
                                <div class="c-content-divider c-divider-sm c-icon-bg c-bg-grey c-margin-b-20">
                                    <span>or signup with</span>
                                </div>
                                <ul class="c-content-list-adjusted">
                                    <li>
                                        <a class="btn btn-block c-btn-square btn-social btn-twitter">
                                            <i class="fa fa-twitter"></i> Twitter </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-block c-btn-square btn-social btn-facebook">
                                            <i class="fa fa-facebook"></i> Facebook </a>
                                    </li>
                                    <li>
                                        <a class="btn btn-block c-btn-square btn-social btn-google">
                                            <i class="fa fa-google"></i> Google </a>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer c-no-border">
                        <span class="c-text-account">Don't Have An Account Yet ?</span>
                        <a href="javascript:;" data-toggle="modal" data-target="#signup-form" data-dismiss="modal" class="btn c-btn-dark-1 btn c-btn-uppercase c-btn-bold c-btn-slim c-btn-border-2x c-btn-square c-btn-signup">Signup!</a>
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
                    <div class="profile-pic">
                                    	<a href="#"><img class="img-responsive" src="assets/images/p-pic.png"/></a>
                                    </div>
                                        <h4 class="c-center c-font-white">User Name</h4>
                                        <div class="c-line c-dot c-theme-bg c-theme-bg-after"></div>
                                        <p class="c-center s-font">Welcome to Disconox</p>
                                    </div>
                                    
                                    <div class="c-content-ver-nav">
                        <div class="c-content-title-1 c-title-md c-margin-t-40">
                            <h3 class="c-font-white">Account Settings</h3>
                            <div class="c-line-left c-theme-bg"></div>
                        </div>
                        <ul class="c-menu c-arrow-dot1 c-theme">
                            <li>
                                <a href="profile-settings.html"><i class="fa fa-user"></i> Profile Settings</a>
                            </li>
                            <li>
                                <a href="booking-history.html"><i class="fa fa-history"></i> Booking History</a>
                            </li>
                            <li>
                                <a href="notifications.html"><i class="fa fa-bell"></i> Notifications</a>
                            </li>
                            <li>
                                <a href="receipts.html"><i class="fa fa-file-text"></i> Receipts</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-eject"></i> Logout</a>
                            </li>
                            
                        </ul>
                        
                        
                    </div>
                                    
                                    
                    
                </div>
                
                
                
                
            </div>
        </nav>
        <!-- END: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
        <!-- BEGIN: PAGE CONTAINER -->
        
        <!--search-->
        
        
        
        <div class="c-layout-page">
        
        <div class="c-content-box c-size-sm c-bg-shade s-inner">
                <div class="container">
                    <div class="auto-container">
            
            <!--Search Form-->
            <div class="search-form ">
                <form method="post" action="search-details.html">
                    <div class="clearfix">
                        <div class="form-group col-md-5 col-sm-12 col-xs-12">
                            <input type="text" name="fname" value="" placeholder="Search by city, location..." required>
                        </div>
                        <div class="form-group col-md-4 col-sm-12 col-xs-12">
                            <input type="text" name="lname" value="" placeholder="Venue Name EX: Local Box Pub" required>
                        </div>
                       
                        <!--Form Group-->
                        <div class="form-group col-md-3 col-sm-12 col-xs-12">
                            <select class="custom-select-box">
                                <option>All Categories</option>
                                <option>Deals & Offers</option>
                                <option>Surprise</option>
                                <option>Guest List</option>
                                <option>Book A Table</option>
                                <option>Book A Bottle</option>
                                <option>Packages</option>
                                <option>Entry</option>
                            </select>
                        </div>
                        <div class="btn-group">
                            <button type="submit" class="theme-btn search-btn"><span class="icon fa fa-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>
            <!--End Search Form-->
            
           
            
            
        </div>
                </div>
            </div>
        
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            <div class=" c-subtitle c-fonts-uppercase c-fonts-bold c-bordered c-bordered-both">
                <div class="container">
                <div class="col-md-10">
                    <div class="check-outer">
                    
                    	<ul>
                        <p class="filter-head">Filter By</p>
                        	<li>
                            <div class="tag-box-two"><input type="checkbox" name="tags" id="tag-one"><label for="tag-one">Deals & Offers</label></div>
                            </li>
                            
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-two"><label for="tag-two">Surprise</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-three"><label for="tag-three">Guest List</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-four"><label for="tag-four">Table Booking</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-five"><label for="tag-five">Bottle Booking</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-six"><label for="tag-six">Packages</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-seven"><label for="tag-seven">Entry</label></div>
                            </li>
                            <li>
                            	<div class="tag-box-two"><input type="checkbox" name="tags" id="tag-eight"><label for="tag-eight">All</label></div>
                            </li>
                        </ul>
                    </div>
                    
                    </div> <!--col div-->                               
                     <div class="col-md-2">
                     	<div class="form-group  mar-b-0">
                            <select class="custom-select-box">
                                <option>Relevance</option>
                                <option>New & Popular</option>
                                <option>Most Viewed</option>
                                <option>By Star Rating</option>
                                <option>With Media Only</option>
                                <option>A - Z</option>
                               
                            </select>
                        </div>
                     </div><!--coldiv-->                               
                                                    
                                                   
                </div>
            </div>
            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-2 -->
            
            <div class="c-content-box c-size-md  c-bg-grey">
            <div class="container">
                
                <p> Showing Search results <span>235</span> for <span class="c-gold"> Key word name Comes here</span></p>
                    <!-- BEGIN: PAGE CONTENT -->
                    <!-- BEGIN: CONTENT/SHOPS/SHOP-RESULT-FILTER-1 -->
                    
                    <!-- END: CONTENT/SHOPS/SHOP-RESULT-FILTER-1 -->
                    <div class="c-margin-t-20"></div>
                    <!-- BEGIN: CONTENT/SHOPS/SHOP-2-8 -->
                    <div class="listing-outer">
                        
                  <?php  echo $content; ?>
                    
                    
                    <div class="listing-outer">
                        <div class="c-content-product-2 c-bg-white">
                            <div class="col-md-3">
                            <div class="row">
                                <div class="c-content-overlay">
                                    <div class="c-label c-bg-dark c-font-white c-font-12 c-font-bold"><i class="fa fa-camera"></i> 10</div>
                                    <div class="c-label c-label-right c-theme-bg c-font-white c-font-13 c-font-bold"><i class="fa fa-video-camera"></i> 40</div>
                                    <div class="c-overlay-wrapper">
                                        <div class="c-overlay-content">
                                            <a href="#" class="btn btn-md c-btn-grey-1 c-btn-uppercase c-btn-bold c-btn-border-1x c-btn-square">Explore</a>
                                        </div>
                                    </div>
                                    <div class="c-bg-img-center c-overlay-object" data-height="height" style="height: 230px; background-image: url(assets/images/club-7.jpg);"></div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-9">
                                <div class="c-info-list">
                                    <h3 class="c-title c-font-bold c-font-22 c-font-dark">
                                        <a class="c-theme-link" href="#">Pub Name One Comes Here </a>
                                        <span class="c-font-14 c-grey">PUB,CASUAL DINING</span>
                                    </h3>
                                    <span class="addr">3rd Floor, Inorbit Mall, Hitech City, Hyderabad</span>
                                    <p class="c-review-star">
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star c-theme-font"></span>
                                        <span class="fa fa-star-half-o c-theme-font"></span>
                                        <span class="fa fa-star-o c-theme-font"></span> (18) </p>
                                    <hr>
                                    <p class="c-desc c-font-14 c-font-thin">Short Discription about Pub Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet.</p>
                                    <hr>
                                    
                                </div>
                                <div>
                                    <p class="a-offer"> Available Deals</p>
                                    <a href="deals-offers-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Deals & Offers</a>
                                    <a href="surprise-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Surprise</a>
                                    <a href="guest-list-details.html" class="btn btn-xs c-btn-dark c-btn-circle c-btn-border-1x c-margin-b-10 c-font-14">Guest List</a>
                                   
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="c-content-pagination c-square c-theme pull-right">
                        <li class="c-prev">
                            <a href="#">
                                <i class="fa fa-angle-left"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">1</a>
                        </li>
                        <li class="c-active">
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li class="c-next">
                            <a href="#">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- END: PAGE CONTENT -->
               </div> 
            </div>
        </div>
        <!-- END: PAGE CONTAINER -->
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-7 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-7">
            <div class="container">
                <div class="c-prefooter">
                    <div class="c-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <ul class="c-links c-theme-ul">
                                <li>
                                        <a href="become-a-partner.html">Become A Partner</a>
                                    </li>
                                    <li>
                                        <a href="about.html">About Disconox</a>
                                    </li>
                                                                        
                                    <li>
                                        <a href="faqs.html">FAQ's</a>
                                    </li>
                                    <li>
                                        <a href="contact-us.html">Contact Us</a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a href="#">Book A Cab</a>
                                    </li>
                                    <li>
                                        <a href="terms-of-use.html">Terms Of Use</a>
                                    </li>
                                    
                                    
                                </ul>
                               
                            </div>
                            <div class="col-md-5 col-sm-6 col-xs-12">
                                <div class="c-content-title-1 c-title-md">
                                    <h3 class="c-title c-font-uppercase c-font-bold">About Disconox</h3>
                                    <div class="c-line-left hide"></div>
                                </div>
                                <p>Find nightspots, pubs, bars and Happy Hour Deals in Hyderabad.<br>

Plan your night and share with your friends<br>

Party in Style...!</p>

<p>Are you new in town? Or just looking for a new spot to have a few drinks and meet new people? With our app, you will never have to hassle through traffic to find one.</p>
                            </div>
                            <div class="col-md-3 col-sm-12 col-xs-12">
                                <div class="c-content-title-1 c-title-md">
                                    <h3 class="c-title c-font-uppercase c-font-bold">Contact Us</h3>
                                    <div class="c-line-left hide"></div>
                                </div>
                                <p class="c-address c-font-16">DISCONOX<br>
Flat number A4B<br>

A BLOCK, Cosmopolitan Aparments<br>

Somajiguda, Hyderabad 500082 <br>

                                   
                                    <br> Email:
                                    <a href="mailto:connect@disconox.com">
                                        <span class="c-theme-color">connect@disconox.com</span>
                                    </a>
                                    
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="c-line"></div>
                    <div class="c-head">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="c-left">
                                    <div class="socicon">
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-facebook tooltips" data-original-title="Facebook" data-container="body"></a>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-twitter tooltips" data-original-title="Twitter" data-container="body"></a>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-youtube tooltips" data-original-title="Youtube" data-container="body"></a>
                                        <a href="#" class="socicon-btn socicon-btn-circle socicon-solid c-font-dark-1 c-theme-on-hover socicon-tumblr tooltips" data-original-title="Tumblr" data-container="body"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="c-right">
                                    <h3 class="c-title c-font-uppercase c-font-bold">Download Mobile App</h3>
                                    <div class="c-icons">
                                        <a href="#" class="c-font-30 c-font-green-1 socicon-btn socicon-android tooltips" data-original-title="Android" data-container="body"></a>
                                        <a href="#" class="c-font-30 c-font-grey-3 socicon-btn socicon-apple tooltips" data-original-title="Apple" data-container="body"></a>
                                        <a href="#" class="c-font-30 c-font-blue-3 socicon-btn socicon-windows tooltips" data-original-title="Windows" data-container="body"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-postfooter c-bg-dark-2">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 c-col">
                            <p class="c-copyright c-font-grey">2017-2018 © DISCONOX
                                <span class="c-font-grey-3">All Rights Reserved.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-7 -->
        <!-- BEGIN: LAYOUT/FOOTERS/GO2TOP -->
        <div class="c-layout-go2top">
            <i class="icon-arrow-up"></i>
        </div>
        <!-- END: LAYOUT/FOOTERS/GO2TOP -->
        <!-- BEGIN: LAYOUT/BASE/BOTTOM -->
        <!-- BEGIN: CORE PLUGINS -->
        <!--[if lt IE 9]>
	<script src="../assets/global/plugins/excanvas.min.js"></script> 
	<![endif]-->
        <script src="assets/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/base/js/jquery-ui.js"></script>
        <script>
		//Custom Seclect Box
	if($('.custom-select-box').length){
		$('.custom-select-box').selectmenu().selectmenu('menuWidget').addClass('overflow');
	}
	</script>
        <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        
        <!-- END: CORE PLUGINS -->
        <!-- BEGIN: LAYOUT PLUGINS -->
        
        <!-- END: LAYOUT PLUGINS -->
        <!-- BEGIN: THEME SCRIPTS -->
        <script src="assets/base/js/components.js" type="text/javascript"></script>
        <script src="assets/base/js/components-shop.js" type="text/javascript"></script>
        <script src="assets/base/js/app.js" type="text/javascript"></script>
        <script>
            $(document).ready(function()
            {
                App.init(); // init core    
            });
        </script>
        <!-- END: THEME SCRIPTS -->
        <!-- END: LAYOUT/BASE/BOTTOM -->
    </body>

</html>