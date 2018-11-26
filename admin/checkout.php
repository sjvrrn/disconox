<!DOCTYPE html>
<?php $redirect = "checkout.php";
error_reporting(0);
session_start();
$pid = base64_decode($_GET['co']);
$cat_id = base64_decode($_GET['cid']);
$price  = base64_decode($_GET['ba']);

?>
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
                                <a href="index.php">Home</a>
                            </li>
                            <li class="c-divider">|</li>
                            <li>
                                <a href="about.php">About</a>
                            </li>
                            <li class="c-divider">|</li>

                            <li>
                                <a href="contact-us.php">Contact</a>
                            </li>
                            <li class="c-divider">|</li>
                            <!--<li>
                                <a href="#">FAQ's</a>
                            </li>
                            <li class="c-divider">|</li>
                            <li><a href="#"> <i class="fa fa-taxi"></i> Need Driver?</a>
                                </li>
                                <li class="c-divider">|</li>-->
                        </ul>

                        <ul class="c-ext c-theme-ul">


                                <!--<li><a href="#" class="c-btn-icon c-cart-toggler">
                                <i class="fa fa-bell-o c-gold"></i><span class="c-cart-number ">5</span></a></li>
                                <li class="c-divider">|</li>-->
                                <!--li>
                                    <a href="#" data-toggle="modal" data-target="#login-form" class=" sign-btn c-btn  c-btn-header btn btn-sm c-btn-border-1x  c-btn-circle c-btn-uppercase c-btn-sbold ">
                                        <i class="fa fa-user"></i> Login</a>
                                </li-->


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
                            <a href="index.php" class="c-logo">
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

                                <!--<li class="c-active"><a href="#" class="c-link">Deals & Offers</a></li>
                                <li><a href="#" class="c-link">Surprise</a></li>
                                <li><a href="#" class="c-link">Guest List</a></li>
                                <li><a href="#" class="c-link">Book A Table</a></li>
                                <li><a href="#" class="c-link">Book A Bottle</a></li>
                                <li><a href="#" class="c-link">Packages</a></li>-->
                                <li><a href="#" class="c-link">December 31st Al Event Entry Tickets</a></li>




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
        <!--<nav class="c-layout-quick-sidebar">
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
                                <a href="#"><i class="fa fa-history"></i> Booking History</a>
                            </li>
                            <li>
                                <a href="notifications.html"><i class="fa fa-bell"></i> Notifications</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-file-text"></i> Receipts</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-eject"></i> Logout</a>
                            </li>

                        </ul>


                    </div>



                </div>




            </div>
        </nav>-->
        <!-- END: LAYOUT/SIDEBARS/QUICK-SIDEBAR -->
        <!-- BEGIN: PAGE CONTAINER -->
         <?php



         $pric=array("switchnonstayCouple"=>"6000","switchnonstayStag"=>"4000","switchnonstaySingleLady"=>"2500","DownTownCafeStagEarlyBird"=>"1999","DownTownCafeCoupleEarlyBird"=>"2999","DownTownCafeCabanas"=>"30000","TheBigMatakaLadyPass"=>"1499","TheBigMatakaGentlemenPass"=>"2499","TheBigMatakaCouplePass"=>"3499","RepeteBreweryandKitchenEBSingleFemalePass"=>"2999","RepeteBreweryandKitchenEBStagPass"=>"3999","RepeteBreweryandKitchenEBCouplePass"=>"5999","MayaEarlyBirdRegularStag"=>"1349","MayaEarlyBirdRegularCouple"=>"1799","MayaEarlyBirdREerularFamily"=>"2249","MayaVIPStagMale"=>"2249","MayaVIPStagFemale"=>"2024","MayaVIPCouple"=>"3149","MayaVIPFamily"=>"4949");




$vv=$pric[ $_REQUEST["ticket"]];

															//session_start();
$ticket=$_REQUEST["ticket"];
$ticketcount=$_REQUEST["ticketcount"];
$totAmount=$vv*$ticketcount;
															//include "db.php";
															//$username = $_SESSION["username"];


															//$sql = "SELECT * FROM users WHERE username = '$username'";
															//$result = mysql_query($sql, $link);

													//while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {?>
        <div class="c-layout-page">
            <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->

            <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
            <!-- BEGIN: PAGE CONTENT -->

            <div class="c-content-box c-size-md c-bg-grey">
                <div class="container">
                    <div class="row">








                     <div class="col-md-8">

                    <div class="c-content-bar-1 c-align-left c-bordered c-theme-border c-shadow">
                                    <h1 class="c-font-bold c-font-uppercase c-font-24">Your Order</h1>
                                    <ul class="c-order list-unstyled">
                                        <li class="row c-margin-b-15">
                                            <div class="col-md-6 c-font-20">
                                                <h2>Perticulars</h2>
                                            </div>
                                            <div class="col-md-6 c-font-20">
                                                <h2>Total</h2>
                                            </div>
                                        </li>
                                        <li class="row c-border-bottom"></li>
                                        <li class="row c-margin-b-15 c-margin-t-15">
                                            <div class="col-md-6 c-font-20">
                                                <a href="#" class="c-theme-link"><?php echo $ticket;?> x <?php echo $ticketcount;?></a>
                                            </div>
                                            <div class="col-md-6 c-font-20">
                                                <p class="">Rs. <?php echo $price;?>/-</p>
                                            </div>
                                        </li>


                                        <li class="row c-border-top c-margin-b-15"></li>
                                        <li class="row">


                                        </li>
                                        <li class="row c-margin-b-15 c-margin-t-15">
                                            <div class="col-md-6 c-font-20">
                                                <p class="c-font-30">Total</p>
                                            </div>
                                            <div class="col-md-6 c-font-20">
                                                <p class="c-font-bold c-font-30">Rs.
                                                    <span class="c-shipping-total"><?php echo $totAmount;?></span>
                                                </p>
                                            </div>
                                        </li>
                                        <!--li class="row">
                                            <div class="col-md-12">
                                                <div class="c-radio-list">

                                                    <div class="c-radio">
                                                        <input type="radio" id="radio1" class="c-radio" name="payment">
                                                        <label for="radio1" class="c-font-bold c-font-20">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Credit Card </label>
                                                    </div>


                                                        <div class="c-radio">
                                                        <input type="radio" id="radio3" class="c-radio" name="payment">
                                                        <label for="radio3" class="c-font-bold c-font-20">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Net Banking </label>
                                                    </div>

                                                    <div class="c-radio">
                                                        <input type="radio" id="radio2" class="c-radio" name="payment">
                                                        <label for="radio2" class="c-font-bold c-font-20">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span> Debet Card</label>
                                                        <img class="img-responsive" width="250" src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" /> </div>
                                                </div>
                                            </div>
                                        </li-->
 <?php if(!isset($_GET['nI'])){ $noofItems=1;}?>
                                        <form method="post" action="checkoutpay.php">
                                        <li class="row">
                                            <div class="form-group col-md-12" role="group">

                                            <input type="text" class="form-control c-square c-theme" placeholder="Name" name="buyername"  value='<?php echo $_SESSION["name"];?>'  required >

                                            <input type="email" class="form-control c-square c-theme" placeholder="E-Mail" name="email"value="<?php echo $_SESSION['email'];?>" required  >

                                            <input type="hidden" class="form-control c-square c-theme" placeholder="Total Amount" name="amount" value="<?php echo $total;?>" required >
                                             <input type="text" class="form-control c-square c-theme" placeholder="Phone Number" name="phone"  required  >
                                             <input type="text" class="form-control c-square c-theme" placeholder="Purpose" name="purpose" value='<?php echo $noofItems*$price;?>' required readonly>

<li class="row c-margin-b-15 c-margin-t-15">
                                            <div class="form-group col-md-12">
                                                <div class="c-checkbox">
                                                    <input type="checkbox" id="checkbox1-11" class="c-check" required checked="checked">
                                                    <label for="checkbox1-11">
                                                        <span class="inc"></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span> I've read and accept the Terms & Conditions </label>
                                                </div>
                                            </div>
                                        </li>

                                                <button type="submit" class="btn btn-lg c-theme-btn c-btn-square c-btn-uppercase c-btn-bold">Pay Now</button>
                                                <button type="button" class="btn btn-lg btn-default c-btn-square c-btn-uppercase c-btn-bold" onclick="javascript:location.href=index.php">Cancel</button>

                                            </div>
                                        </li>
                                        </form>
                                    </ul>
                                </div>


<?php // }?>



                    <!-- END: PAGE CONTENT -->
                </div>
                     </div><!--col div-->

                    </div>
                </div>
            </div>


            <!-- END: PAGE CONTENT -->
        </div>
        <!-- END: PAGE CONTAINER -->
        <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
        <a name="footer"></a>
        <footer class="c-layout-footer c-layout-footer-7">
            <div class="container">
                <div class="c-prefooter">
                    <div class="c-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <ul class="c-links c-theme-ul">
                                    <li>
                                        <a href="about.php">About Disconox</a>
                                    </li>
                                    <!--<li>
                                        <a href="#">Privacy Policy</a>
                                    </li>-->

                                    <!--<li>
                                        <a href="#">FAQ's</a>
                                    </li>-->
                                    <li>
                                        <a href="contact-us.php">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="terms-of-use.html">Terms Of Use</a>
                                    </li>
                                    <!--<li>
                                        <a href="#">Become a Partner</a>
                                    </li>-->
                                </ul>
                                <!--<ul class="c-links c-theme-ul">
                                    <li>
                                        <a href="#">Blog</a>
                                    </li>
                                    <li>
                                        <a href="#">Pramotional Offers</a>
                                    </li>
                                    <li>
                                        <a href="#">Link one</a>
                                    </li>
                                    <li>
                                        <a href="#">Link two</a>
                                    </li>
                                    <li>
                                        <a href="#">Link three</a>
                                    </li>
                                    <li>
                                        <a href="#">Link four</a>
                                    </li>
                                </ul>-->
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


                                    <br/> Email:
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
                            <p class="c-copyright c-font-grey">2017-2018 &copy; DISCONOX
                                <span class="c-font-grey-3">All Rights Reserved.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- END: LAYOUT/FOOTERS/FOOTER-5 -->
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
        <script src="assets/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

        <!-- END: CORE PLUGINS -->
        <!-- BEGIN: LAYOUT PLUGINS -->
        <script src="assets/plugins/cubeportfolio/js/jquery.cubeportfolio.min.js" type="text/javascript"></script>

        <script src="assets/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

        <script src="assets/plugins/fancybox/jquery.fancybox.pack.js" type="text/javascript"></script>

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