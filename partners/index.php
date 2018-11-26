<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['id'])){
 // header("location:index.php");
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
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/chartist-js/dist/chartist-init.css" rel="stylesheet">
    <link href="assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="assets/plugins/css-chart/css-chart.css" rel="stylesheet">
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="assets/plugins/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <link href="assets/plugins/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <?php require_once("header.php");?>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<body class="fix-header fix-sidebar card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php require_once ("top.php");?>
        <?php require_once ("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
              <?php echo show_title(); ?>
				<div class="row b-b">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
					
						<h4 class="card-title1 p-t9 flt-left p-l0">Bookings</h4>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
						<h4 class="card-title1 p-t9 flt-left p-l0">Table Booking</h4>
					</div>
							
				</div>
				<div class="row p-t10">
					
                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					
                    	<div class="bg-white m-b30">
                        	<div class="info-blog">
                        	<div class="order-top-bg">
                            	<div class="mw320 flt-left"><p>Deals & Offers</p></div>
                            </div>
                            <div class="booking-info">
                            	<div class="row b-details">
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10">Active :</span><span class="num flt-left p-t7">0</span></div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10 p-r10">Revenue :</span><span class="num flt-left p-t7"><i class="fa fa-inr f19"></i> 0/-</span></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    	<div class="b-active flt-right"><span class="flt-left p-t10">Today :</span><a href="customer-history.php"><span class="num num-bg m-l10">0</span></a></div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            
                            <div class="info-blog">
                        	<div class="order-top-bg">
                            	<div class="mw320 flt-left"><p>Surprise</p></div>
                            </div>
                            <div class="booking-info">
                            	<div class="row b-details">
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10">Active :</span><span class="num flt-left p-t7">0</span></div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10 p-r10">Revenue :</span><span class="num flt-left p-t7"><i class="fa fa-inr f19"></i> 0/-</span></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    	<div class="b-active flt-right"><span class="flt-left p-t10">Today :</span><a href="customer-history.php"><span class="num num-bg m-l10">0</span></a></div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            <div class="info-blog">
                        	<div class="order-top-bg">
                            	<div class="mw320 flt-left"><p>Guest List</p></div>
                            </div>
                            <div class="booking-info">
                            	<div class="row b-details">
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10">Active :</span><span class="num flt-left p-t7">0</span></div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10 p-r10">Revenue :</span><span class="num flt-left p-t7"><i class="fa fa-inr f19"></i> 0/-</span></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    	<div class="b-active flt-right"><span class="flt-left p-t10">Today :</span><a href="customer-history.php"><span class="num num-bg m-l10">0</span></a></div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            <div class="info-blog">
                        	<div class="order-top-bg">
                            	<div class="mw320 flt-left"><p>Book A Bottle</p></div>
                            </div>
                            <div class="booking-info">
                            	<div class="row b-details">
                                	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10">Active :</span><span class="num flt-left p-t7">0</span></div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10 p-r10">Revenue :</span><span class="num flt-left p-t7"><i class="fa fa-inr f19"></i> 0/-</span></div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    	<div class="b-active flt-right"><span class="flt-left p-t10">Today :</span><a href="customer-history.php"><span class="num num-bg m-l10">0</span></a></div>
                                    </div>
                                </div>
                                
                            </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    	<div class="bg-white m-b30 mh552">
                        	<div class="booking-info">
                            	<div class="row b-details">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    	<div class="b-active"><span class="flt-left p-t10 p-r10">Revenue :</span><span class="num flt-left p-t7"><i class="fa fa-inr f19"></i> 0/-</span></div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    	<div class="b-active flt-right"><span class="flt-left p-t10">Today :</span><a href="customer-history.php"><span class="num num-bg m-l10">0</span></a></div>
                                    </div>
                                </div>
                                <hr/>
                                <!--<div class="c-gray-bg">
                                	<div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                           
                                            	<span class="seter-info">4 Seter</span> <span class="seter-dtime">3/10/2018, 10:30 pm</span> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                           
                                            	<div class="btn-bview flt-right"><a href="customer-history.php">View</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-gray-bg">
                                	<div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            	<span class="seter-info">4 Seter</span> <span class="seter-dtime">3/10/2018, 10:30 pm</span> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            	<div class="btn-bview flt-right"><a href="customer-history.php">View</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-gray-bg">
                                	<div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            	<span class="seter-info">4 Seter</span> <span class="seter-dtime">3/10/2018, 10:30 pm</span> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            	<div class="btn-bview flt-right"><a href="customer-history.php">View</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-gray-bg">
                                	<div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            	<span class="seter-info">4 Seter</span> <span class="seter-dtime">3/10/2018, 10:30 pm</span> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            	<div class="btn-bview flt-right"><a href="customer-history.php">View</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="c-gray-bg">
                                	<div class="row">
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                            	<span class="seter-info">4 Seter</span> <span class="seter-dtime">3/10/2018, 10:30 pm</span> 
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                            	<div class="btn-bview flt-right"><a href="customer-history.php">View</a></div>
                                        </div>
                                    </div>
                                </div>-->
                                <hr class="m-t50"/>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <label class="m-t0">Book Now</label>
                                           <input type="text" id="date-format" class="form-control" placeholder="Date & Time">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 book-now">
                                    	<div class="demo-radio-button">
                                            <input name="group1" type="radio" id="radio_1" checked />
                                            <label for="radio_1">2</label>
                                            <input name="group1" type="radio" id="radio_2" />
                                            <label for="radio_2">4</label>
                                            <input name="group1" type="radio" id="radio_3" />
                                            <label for="radio_3">6</label>
                                            <input name="group1" type="radio" id="radio_4" />
                                            <label for="radio_4">8</label>
                                            <input name="group1" type="radio" id="radio_5" />
                                            <label for="radio_5">10</label>
                                        </div>
                                        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success o-line">DONE</button></a>
                                    </div>-->
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row p-t10">
                    <div class="col-md-6 col-lg-3">
                        <a href="customers.php"><div class="card card-body partners-card">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0">0</h2>
                                    <h6 class="text-muted">Customers</h6></div>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a><div class="card card-body partners-card">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0"><i class="fa fa-inr"></i> 0</h2>
                                    <h6 class="text-muted">Revenue</h6></div>
                            </div>
                        </div></a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a><div class="card card-body partners-card">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0"><span>10</span></h2>
                                    <h6 class="text-muted">Total Posts</h6></div>
                            </div>
                        </div></a>
                    </div>
                    <!--<div class="col-md-6 col-lg-3">
                        <a><div class="card card-body partners-card">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                    <h2 class="font-light m-b-0"><span>0</span></h2>
                                    <h6 class="text-muted">Active Posts</h6></div>
                            </div>
                        </div></a>
                    </div>-->
                    <div class="col-md-6 col-lg-3">
                        <a href="notifications.php"><div class="card card-body partners-card text-center">
                            <div class="row">
                                <div class="col p-r-0 text-center p-l0">
                                	<h2 class="font-light m-b-0 text-center"><span>0</span></h2>
                                    <h6 class="text-muted text-center">Notifications</h6></div>
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
    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="assets/plugins/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
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