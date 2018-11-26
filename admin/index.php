<?php
session_start();
if(!isset($_SESSION['id'])){
	header("location:login.php"); 
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
    <?php require_once ("header.php");?>
</head>
<body class="fix-header fix-sidebar card-no-border">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php"><img src="assets/images/disco-logo.png"/> </a>
            </div>
            <div class="navbar-collapse">
                <ul class="navbar-nav mr-auto mt-md-0">
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                    <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                  <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <form class="app-search">
                            <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                    </li>

                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/users/1.jpg" alt="user" class="profile-pic" /></a>
                        <div class="dropdown-menu dropdown-menu-right scale-up">
                            <ul class="dropdown-user">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="assets/images/users/1.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4>Steave Jobs</h4>
                                            <p class="text-muted">varun@gmail.com</p><a href="my-profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="my-profile.php"><i class="ti-user"></i> My Profile</a></li>
                                <li><a href="my-balance.php"><i class="ti-wallet"></i> My Balance</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href=""><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <?php require_once ("left-sidebar.php");?>
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor">Dashboard</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <div class="d-flex m-t-10 justify-content-end">
                        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                            <div class="chart-text m-r-10">
                                <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                            <div class="spark-chart">
                                <div id="monthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>
                        <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                            <div class="chart-text m-r-10">
                                <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 48,356</h4></div>
                            <div class="spark-chart">
                                <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row b-b">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0 m-b10">

                    <h4 class="card-title1 p-t9 flt-left p-l0">Order Status</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
                    <a href="#" class="p-tb5 p-r0"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">Clear All</button></a>
                </div>
            </div>
            <div class="row p-t10">
                    <div class="col-lg-12 col-md-12 ">
                    <div class="bg-white m-b30">
                        <div class="order-top-bg">
                            <div class="mw320 flt-left"><p>Partner Name</p></div>
                            <div class="mw260 flt-left"><p>Periculurs</p></div>
                            <div class="mw175 flt-left"><p>Amount</p></div>
                            <div class="mw221 flt-left"><p>Status</p></div>
                        </div>
                        <div class="order-status-list">
                            <div class="alert alert-warning terms-alert bg-list">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <div class="mw320 flt-left">
                                    <p class="m-l5">Partner name comes here</p>
                                </div>
                                <div class="mw260 flt-left">
                                    <p class="m-l5">Deals & Offers</p>
                                </div>
                                <div class="mw175 flt-left">
                                    <p><i class="fa fa-inr m-l5"></i> 2500/-</p>
                                </div>
                                <div class="mw221 flt-left">
                                    <div style="color:#c8a263; float:left;">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <span class="btn-view m-l50"><a href="invoice.php">View</a></span>
                                </div>
                            </div>
                            <div class="alert alert-warning terms-alert bg-list">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <div class="mw320 flt-left">
                                    <p class="m-l5">Partner name comes here</p>
                                </div>
                                <div class="mw260 flt-left">
                                    <p class="m-l5">Surprise</p>
                                </div>
                                <div class="mw175 flt-left">
                                    <p><i class="fa fa-inr m-l5"></i> 2500/-</p>
                                </div>
                                <div class="mw221 flt-left">
                                    <div style="color:#c3c3c3; float:left;">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <span class="btn-view m-l50"><a href="invoice.php">View</a></span>
                                </div>
                            </div>
                            <div class="alert alert-warning terms-alert bg-list">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <div class="mw320 flt-left">
                                    <p class="m-l5">Partner name comes here</p>
                                </div>
                                <div class="mw260 flt-left">
                                    <p class="m-l5">Guest List</p>
                                </div>
                                <div class="mw175 flt-left">
                                    <p><i class="fa fa-inr m-l5"></i> 2500/-</p>
                                </div>
                                <div class="mw221 flt-left">
                                    <div style="color:#c3c3c3; float:left;">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <span class="btn-view m-l50"><a href="invoice.php">View</a></span>
                                </div>
                            </div>
                            <div class="alert alert-warning terms-alert bg-list">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <div class="mw320 flt-left">
                                    <p class="m-l5">Partner name comes here</p>
                                </div>
                                <div class="mw260 flt-left">
                                    <p class="m-l5">Book A Table</p>
                                </div>
                                <div class="mw175 flt-left">
                                    <p><i class="fa fa-inr m-l5"></i> 2500/-</p>
                                </div>
                                <div class="mw221 flt-left">
                                    <div style="color:#c3c3c3; float:left;">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <span class="btn-view m-l50"><a href="invoice.php">View</a></span>
                                </div>
                            </div>
                            <div class="alert alert-warning terms-alert bg-list">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                                <div class="mw320 flt-left">
                                    <p class="m-l5">Partner name comes here</p>
                                </div>
                                <div class="mw260 flt-left">
                                    <p class="m-l5">Book A Bottle</p>
                                </div>
                                <div class="mw175 flt-left">
                                    <p><i class="fa fa-inr m-l5"></i> 2500/-</p>
                                </div>
                                <div class="mw221 flt-left">
                                    <div style="color:#c3c3c3; float:left;">
                                        <i class="fas fa-check-circle fa-2x"></i>
                                    </div>
                                    <span class="btn-view m-l50"><a href="invoice.php">View</a></span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <a href="partners.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0">324</h2>
                                    <h6 class="text-muted">Partners</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="users.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0">324</h2>
                                    <h6 class="text-muted">Users</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="artists.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0">324</h2>
                                    <h6 class="text-muted">Artists</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="notifications.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0">324</h2>
                                    <h6 class="text-muted">New Requests</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="edit-partner-profile.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h6 class="text-muted">Create New Partner</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="edit-user-profile.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h6 class="text-muted">Create New User</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="create-artist.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h6 class="text-muted">Create New Artist</h6></div>
                            </div>
                        </div></a>
                </div>
                <div class="col-md-6 col-lg-3">
                    <a href="notifications.php"><div class="card card-body">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h6 class="text-muted">Create Notifications</h6></div>
                            </div>
                        </div></a>
                </div>
            </div>
        </div>
        <div id="footer">
            <footer>
                <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
            </footer>
        </div>
    </div>
</div>
<?php require_once ("footer.php");?>
<script src="assets/plugins/chartist-js/dist/chartist.min.js"></script>
<script src="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-us-aea-en.js"></script>
<script src="js/dashboard3.js"></script>
</body>
</html>