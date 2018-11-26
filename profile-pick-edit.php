<?php
if(isset($_GET['di'])){
    $image_id = base64_decode($_GET['di']);
    /*start*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
        "id"=>$image_id
    );
    $data_json = json_encode($data);
    $url = "http://localhost/angular/disconox/Disco/v1/InnoChat/imageDelete";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
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
            echo"<script>alert('".$message."');</script>";
            header("location:edit-deals-offers.php?ei=".$_GET['ie']);
        }
    }
    curl_close($ch);
    /*end*/



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
    <link href="assets/plugins/cropper/cropper.min.css" rel="stylesheet">
    <?php require_once ("header.php");?>
</head>
<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html"><img src="assets/images/disco-logo.png"/> </a>
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
                    </ul>
                </div>
            </nav>
        </header>
       <?php require_once ("left-sidebar.php");?>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-5 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Dashboard</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Partners</a></li>
                            <li class="breadcrumb-item active">Partners Profile Details</li>
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
                <div class="row">
                    <div class="col-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">Selected Partner Name Comes Here</h4>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-l0">
								<h4 class="card-title1 p-t9">ID: <span>#0001</span></h4>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-r0">
								<div class="text-right"><a href="edit-partner-profile.html" class="p-tb5"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info m-b20">Back</button></a></div>
							</div>
						</div>
                        <div class="card m-t10">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 p-20">
                                        <div class="img-container"><img id="image" src="assets/images/big/img2.jpg" class="img-responsive" alt="Picture"></div>
                                    </div>
                                    <div class="col-md-3 p-20">
                                        <div class="docs-preview clearfix">
                                            <div class="img-preview preview-lg"></div>
                                            <div class="img-preview preview-md"></div>
                                            <div class="img-preview preview-sm"></div>
                                            <div class="img-preview preview-xs"></div>
                                        </div>
                                        <div class="docs-data">
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataX">X</label>
                                                <input type="text" class="form-control" id="dataX" placeholder="x">
                                                <span class="input-group-addon">px</span> </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataY">Y</label>
                                                <input type="text" class="form-control" id="dataY" placeholder="y">
                                                <span class="input-group-addon">px</span> </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataWidth">Width</label>
                                                <input type="text" class="form-control" id="dataWidth" placeholder="width">
                                                <span class="input-group-addon">px</span> </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataHeight">Height</label>
                                                <input type="text" class="form-control" id="dataHeight" placeholder="height">
                                                <span class="input-group-addon">px</span> </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataRotate">Rotate</label>
                                                <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                                                <span class="input-group-addon">deg</span> </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                                                <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                                                <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 docs-buttons">
                                        <!-- .btn groups -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info" data-method="setDragMode" data-option="move" title="Move"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)"> <span class="fa fa-arrows"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-info" data-method="setDragMode" data-option="crop" title="Crop"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setDragMode&quot;, &quot;crop&quot;)"> <span class="fa fa-crop"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success" data-method="zoom" data-option="0.1" title="Zoom In"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)"> <span class="fa fa-search-plus"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-success" data-method="zoom" data-option="-0.1" title="Zoom Out"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)"> <span class="fa fa-search-minus"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="-10" data-second-option="0" title="Move Left"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, -10, 0)"> <span class="fa fa-arrow-left"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="10" data-second-option="0" title="Move Right"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 10, 0)"> <span class="fa fa-arrow-right"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="0" data-second-option="-10" title="Move Up"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, -10)"> <span class="fa fa-arrow-up"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="move" data-option="0" data-second-option="10" title="Move Down"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;move&quot;, 0, 10)"> <span class="fa fa-arrow-down"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="rotate" data-option="-45" title="Rotate Left"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)"> <span class="fa fa-rotate-left"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="rotate" data-option="45" title="Rotate Right"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)"> <span class="fa fa-rotate-right"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="scaleX" data-option="-1" title="Flip Horizontal"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleX&quot;, -1)"> <span class="fa fa-arrows-h"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="scaleY" data-option="-1" title="Flip Vertical"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleY&quot;, -1)"> <span class="fa fa-arrows-v"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="crop" title="Crop"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;crop&quot;)"> <span class="fa fa-check"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="clear" title="Clear"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;clear&quot;)"> <span class="fa fa-remove"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="disable" title="Disable"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;disable&quot;)"> <span class="fa fa-lock"></span> </span>
                                            </button>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="enable" title="Enable"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;enable&quot;)"> <span class="fa fa-unlock"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="reset" title="Reset"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;reset&quot;)"> <span class="fa fa-refresh"></span> </span>
                                            </button>
                                            <label class="btn btn-secondary btn-outline btn-upload" for="inputImage" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs"> <span class="fa fa-upload"></span> </span>
                                            </label>
                                            <button type="button" class="btn btn-secondary btn-outline" data-method="destroy" title="Destroy"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;destroy&quot;)"> <span class="fa fa-power-off"></span> </span>
                                            </button>
                                        </div>
                                        <div class="btn-group btn-group-crop">
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)"> Get Cropped Canvas </span> </button>
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 160, height: 90 })"> 160&times;90 </span> </button>
                                            <button type="button" class="btn btn-danger" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;, { width: 320, height: 180 })"> 320&times;180 </span> </button>
                                        </div>
                                        <div class="modal docs-cropped" id="getCroppedCanvasModal" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" role="dialog" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                                                    </div>
                                                    <div class="modal-body"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.html">Download</a> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getData&quot;)"> Get Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setData&quot;, data)"> Set Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getContainerData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getContainerData&quot;)"> Get Container Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getImageData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getImageData&quot;)"> Get Image Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getCanvasData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCanvasData&quot;)"> Get Canvas Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setCanvasData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCanvasData&quot;, data)"> Set Canvas Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="getCropBoxData" data-option data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCropBoxData&quot;)"> Get Crop Box Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="setCropBoxData" data-target="#putData"> <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;setCropBoxData&quot;, data)"> Set Crop Box Data </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="moveTo" data-option="0"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.moveTo(0)"> 0,0 </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="zoomTo" data-option="1"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoomTo(1)"> 100% </span> </button>
                                        <button type="button" class="btn btn-secondary btn-outline" data-method="rotateTo" data-option="180"> <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotateTo(180)"> 180° </span> </button>
                                        <input type="text" class="form-control" id="putData" placeholder="Get data to here or set data with this value">
                                    </div>
                                    <div class="col-md-3 docs-toggles">
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-secondary btn-outline active">
                                                <input type="radio" class="sr-only" id="aspectRatio0" name="aspectRatio" value="1.7777777777777777">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9"> 16:9 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.3333333333333333">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3"> 4:3 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1"> 1:1 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="0.6666666666666666">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3"> 2:3 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="NaN">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN"> Free </span> </label>
                                        </div>
                                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                                            <label class="btn btn-secondary btn-outline active">
                                                <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 0"> VM0 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" info="sr-only" id="viewMode1" name="viewMode" value="1">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 1"> VM1 </span> </label>
                                            <label class="btn btn-secondary btn-outline">
                                                <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 2"> VM2 </span> </label>
                                            <label class="btn btn-secondary  btn-outline">
                                                <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 3"> VM3 </span> </label>
                                        </div>
                                        <div class="dropdown dropup docs-options">
                                            <button type="button" class="btn btn-success btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true"> Toggle Options <span class="caret"></span> </button>
                                            <ul class="dropdown-menu" aria-labelledby="toggleOptions" role="menu">
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="responsive" checked> responsive </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="restore" checked> restore </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="checkCrossOrigin" checked> checkCrossOrigin </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="checkOrientation" checked> checkOrientation </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="modal" checked> modal </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="guides" checked> guides </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="center" checked> center </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="highlight" checked> highlight </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="background" checked> background </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="autoCrop" checked> autoCrop </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="movable" checked> movable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="rotatable" checked> rotatable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="scalable" checked> scalable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomable" checked> zoomable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomOnTouch" checked> zoomOnTouch </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="zoomOnWheel" checked> zoomOnWheel </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="cropBoxMovable" checked> cropBoxMovable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="cropBoxResizable" checked> cropBoxResizable </label>
                                                </li>
                                                <li role="presentation">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="toggleDragModeOnDblclick" checked> toggleDragModeOnDblclick </label>
                                                </li>
                                            </ul>
                                        </div>
										<div class="p-t10">
										<div class="flt-left m-r10"><a href="edit-partner-profile.html" class="p-tb5"><button type="button" class="btn waves-effect waves-light btn-rounded btn-info">CANCEL</button></a></div>
										<div class="text-left"><a href="edit-partner-profile.html" class="p-tb5 p-lr5"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">SAVE</button></a></div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="assets/plugins/cropper/cropper.min.js"></script>
    <script src="assets/plugins/cropper/cropper-init.js"></script>
    <?php  require_once ("footer.php");?>
</body>

</html>
