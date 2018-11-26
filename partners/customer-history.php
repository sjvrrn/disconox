<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
	<link href="css/fonts/css/fontawesome.css" rel="stylesheet">
    <link href="css/fonts/css/fa-brands.css" rel="stylesheet">
    <link href="css/fonts/css/fa-regular.css" rel="stylesheet">
    <link href="css/fonts/css/fa-solid.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
	<link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/disco-logo.png"/> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box"> <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search & enter"> <a class="srh-btn"><i class="ti-close"></i></a> </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
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
                                                <p class="text-muted">varun@gmail.com</p><a href="my-profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="my-profile.html"><i class="ti-user"></i> My Profile</a></li>
                                    <li><a href="my-balance.html"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile" style="background: url(assets/images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="assets/images/users/profile.png" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                        <div class="dropdown-menu animated flipInY"> <a href="my-profile.html" class="dropdown-item"><i class="ti-user"></i> My Profile</a> <a href="my-balance.html" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a> 
                            
                            <div class="dropdown-divider"></div> <a href="login.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a> </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">Admin Features</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="index.html" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="customers.html" aria-expanded="false">					<span style="color:#c3c3c3; float:left;">
                                  <i class="fas fa-handshake fa-2x"></i>
                            </span>
                            <span class="hide-menu flt-left p-t2 p-l5">Customers</span></a></li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="revenue.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                                  <i class="fas fa-suitcase fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Revenue</span></a>
                            
                        </li>
                        
                        
                        <li class="nav-devider"></li>
                        
                        <li> <a class="waves-effect waves-dark" href="deals-offers.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-shopping-basket fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Deals & Offers</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="surprise.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-gift fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Surprise</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="guest-list.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-address-book fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Guest List</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="book-table.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-table fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Book A Table</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="book-bottle.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-calendar-alt fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Book A Bottle</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="packages.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-archive fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Packages</span></a>    
                        </li>
						<li> <a class="waves-effect waves-dark" href="entry.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-sign-in-alt fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Entry</span></a>    
                        </li>
						<li class="nav-devider"></li>
						<li> <a class="waves-effect waves-dark" href="notifications.html" aria-expanded="false">
                        <span style="color:#c3c3c3; float:left;">
                              <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </span>
                        <span class="hide-menu flt-left p-t5 p-l5">Notifications</span></a>    
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Table</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Customers</li>
							<li class="breadcrumb-item active">Customer History</li>
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info"><i class="fa fa-inr flt-left p-t3"></i> 58,356</h4></div>
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
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    
                    
                    <!-- column -->
                    
                    <!-- column -->
                    
                    <!-- column -->
                    <div class="col-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">Selected User Name Comes Here</h4>
							</div>
                        
						</div>
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title1 p-t9">ID: <span>#0001</span></h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right m-t-16">
								<a href="customer-details.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">View Details</button></a>
								<a href="customers.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info m-b20 m-t16">Back</button></a>
							</div>
							
						</div>
						<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
								<h5 class="box-title m-t-30">Select From Date & To Date</h5>
								<div class="input-daterange input-group" id="date-range">
									<input type="text" class="form-control" name="start">
									<span class="input-group-addon bg-info b-0 text-white">to</span>
									<input type="text" class="form-control" name="end">
                                </div>
								
							</div>
							
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
								
								<div class="text-left m-b20 m-t57"><a href="#" class="p-tb5 p-lr15"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">GO</button></a></div>
							</div>
							<div class="col-lg-12 col-md-12col-sm-12 col-xs-12">
								<div class="search-mess">Not Available......   please change above date and search again</div>
							</div>
						</div>
                        <div class="card m-t-10">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Order ID</th>
                                                <th>Discription</th>
                                                <th>Price</th>
                                                <th>Payment Method</th>
                                                <th>Invoice</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td>0025</td>
                                                <td>Discription comes here </td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                <td>Credit Card(Master Card)</td>
                                                <td>
                                                 <div class="btn-view flt-left"><a href="invoice.html">View</a></div>   </td>
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td>0025</td>
                                                <td>Discription comes here </td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                <td>Credit Card(Master Card)</td>
                                                <td>
                                                 <div class="btn-view flt-left"><a href="invoice.html">View</a></div>   </td>
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td>0025</td>
                                                <td>Discription comes here </td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                <td>Credit Card(Master Card)</td>
                                                <td>
                                                 <div class="btn-view flt-left"><a href="invoice.html">View</a></div>   </td>
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td>0025</td>
                                                <td>Discription comes here </td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                <td>Credit Card(Master Card)</td>
                                                <td>
                                                 <div class="btn-view flt-left"><a href="invoice.html">View</a></div>   </td>
                                            </tr>
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
						<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="bg-white">
								<div class="flt-left m-r10"><a href="#" class="p-tb5 p-lr15"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">Download pdf</button></a></div>
								<div class="flt-left m-r10"><a href="#" class="p-tb5 p-lr15"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">Download excel</button></a></div>
								<div class="pull-right p-t5 total-price">Total: 54,360.00/-</div>
								<div class="clearfix"></div>
							</div>
						</div>
						</div>
                    </div>
                    <!-- column -->
                    
                </div>
                
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <div id="footer">
                <footer>
                    <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                </footer>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- jQuery peity -->
    <script src="assets/plugins/peity/jquery.peity.min.js"></script>
    <script src="assets/plugins/peity/jquery.peity.init.js"></script>
	
	
	<script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    
	<script>
    // MAterial Date picker    
    $('#mdate').bootstrapMaterialDatePicker({ weekStart : 0, time: false });
         $('#timepicker').bootstrapMaterialDatePicker({ format : 'HH:mm', time: true, date: false });
    $('#date-format').bootstrapMaterialDatePicker({ format : 'dddd DD MMMM YYYY - HH:mm' });
   
        $('#min-date').bootstrapMaterialDatePicker({ format : 'DD/MM/YYYY HH:mm', minDate : new Date() });
    // Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'
    });
    $('.clockpicker').clockpicker({
        donetext: 'Done',
    }).find('input').change(function() {
        console.log(this.value);
    });
    $('#check-minutes').click(function(e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show').clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
    // Colorpicker
    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
    // Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });
    </script>
   
</body>

</html>
