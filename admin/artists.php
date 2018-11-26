<?php
error_reporting(0);
require_once("header.php");

/*get all artists*/
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
    );
    $data_json = json_encode($data);
    $ud = $url."all_Artists";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ud);
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
           $artists = $responsObj['Artists'];
        }
    }
    curl_close($ch);
    /*end*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
  <?php  require_once ("header.php");?>
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
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                            <li class="breadcrumb-item active">Artsts</li>
							
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
                <div class="row all-posts">
                    <div class="col-lg-12">
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							 <h4 class="card-title m-b20">You have <span><?php  echo count($artists);?></span>  Artists</h4>
							</div>
						</div>
						<div class="row b-b">
							<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 p-l0">
								<div class="form-group">
									<div>
										Search <input type="text" class="form-control w65 border-no border-rno" placeholder=" ">
									</div>
                                </div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 p-l0"></div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 p-r0 text-right">
                            <div class="flt-left m-b20 m-r10"><a href="create-artist.php" class="p-tb5"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">+ NEW ARTIST</button></a></div>
							</div>
						</div>
                    </div>
					
                    <?php
                    foreach($artists as $artist){

                        echo'<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="card card-outline-info m-t20"> 
							<div class="card-body">
								<div class="card-top" style="background:url('.$artist["image"].') no-repeat center center /cover; width:100%; height:192px;">
									<div><a id="delete" href="create-artist.php?da='.base64_encode($artist["id"]).'" class="fatrash"  ><i class="fa fa-trash-o"></i></a></div>
								</div>
                                <div class="card-middle">
									<div class="entry-name p-b10">'.$artist["name"].'</div>
									<div class="switch flt-left m-t2">
                                        <label>
                                            <input id="status" name="status" type="checkbox" checked="" value='.$artist["id"].'><span class="lever switch-col-amber m-l0"></span>
										</label>
                                    </div>
									<div class="text-right"><a href="create-artist.php?ea='.base64_encode($artist["id"]).'"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">EDIT</button></a></div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					</div>';

                    }
                    ?>
					</div>
<div id="myTrash" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header text-right">
      </div>
      <div class="modal-body">
	  <button type="button" class="close " data-dismiss="modal">&times;</button>
        <p>You Want To Delete? </p>
        <p>&nbsp;</p>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">YES</button></a>
        <a href="#"><button type="button" class="btn waves-effect waves-light btn-rounded btn-danger">NO</button></a>
       
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
<?php require_once ("footer.php");?>
</body>

</html>
<script>
    $(document).ready(function(){
        $(document).on("click","#delete",function(){
            if (confirm('Would You like To Delete')) {
               // return true;
            }else{ return false;}
        });
		//status
		$(document).on("change","#status",function(){
			var id = $(this).val();
		/*ajax start*/
		 $.ajax({
                    type: 'post',
                    url: 'post_category.php',
                    data:"user_id="+id,
                    success: function (data) {
						alert(data);
					location.reload();
                    }
                });
		/*ajax end*/
			
		});

    });

</script>