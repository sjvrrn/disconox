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
    <?php  require_once("header.php"); ?>
</head>

<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <?php require_once("top.php"); ?>
        <?php require_once("left-sidebar.php"); ?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">MY Balance</li>
							
                        </ol>
                    </div>
                    <div class="col-md-7 col-4 align-self-center">
                        <div class="d-flex m-t-10 justify-content-end">
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>THIS MONTH</small></h6>
                                    <h4 class="m-t-0 text-info">$58,356</h4></div>
                                <div class="spark-chart">
                                    <div id="monthchart"></div>
                                </div>
                            </div>
                            <div class="d-flex m-r-20 m-l-10 hidden-md-down">
                                <div class="chart-text m-r-10">
                                    <h6 class="m-b-0"><small>LAST MONTH</small></h6>
                                    <h4 class="m-t-0 text-primary">$48,356</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
                            <!--<a href="edit-partner-profile.html"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info m-b20 flt-left">Back</button></a>-->
								<h4 class="card-title1 p-t9 flt-left p-l20">My Balance</h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0 text-right">
								<a href="#" class="p-tb5 p-lr15"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">At This Time</button></a>
							</div>
							
						</div>
						<div class="row">
						</div>
                        <div class="card m-t-10">
                            <div class="card-body">
                            	<div class="row">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
								<h5 class="box-title m-t-30">Select Date</h5>
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
								<div class="search-mess"> </div>
							</div>
						</div>
                                <div class="table-responsive">
                                    <!--<table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>23/10/2018</td>
                                                <td><i class="fa fa-inr"></i> 5825/- </td>
                                                
                                            </tr>
											
                                        </tbody>
                                    </table>-->
                                </div>
                                
                                	<div class="gray-red-bg">
                                    	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    	<div class="today-txt"><span class="flt-left p-r10"><b>Total:</b></span> <span class="m-t-2"><i class="fa fa-inr p-r3"></i> <span class="flt-left">0/-</span></span></div>
                                        <div class="clearfix"></div>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
						
                    </div>
                    <!-- column -->
                    
                </div>
               
            </div>
            <div id="footer">
                <footer>
                    <p>2017-2018 &copy; DISCONOX All Rights Reserved.</p>
                </footer>
            </div>
        </div>
    </div>
  <?php  require_once("footer.php");?>
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
