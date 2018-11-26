<?php
error_reporting(0);
session_start();
require_once("header.php");
if(!isset($_SESSION['id'])){
    header("location:login.php");
}
/*start*/
$role = 2;
    $data = array(
        "clientId"=>"x6DmrbsQFZyUUiggs0BZ"
    );
    $data_json = json_encode($data);
   echo  $ul = url."all_users"; exit;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ul);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response  = curl_exec($ch); //echo"<pre>";print_r($response); exit;


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
            $partners = $responsObj['PartnersData'];
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
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Disconox</title>
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
                                                <p class="text-muted"><?php echo $_SESSION['name']; ?></p><a href="my-profile.php" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
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
                            <li class="breadcrumb-item active">Partners</li>
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
                                    <h4 class="m-t-0 text-primary"><i class="fa fa-inr flt-left p-t3"></i> 0</h4></div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas width="60" height="35" style="display: inline-block; width: 60px; height: 35px; vertical-align: top;"></canvas></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						 <h4 class="card-title p-t5">You have <span>53</span> Partners</h4>
						</div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
						 <div class="text-right m-b20"><a href="edit-partner-profile.php" class="p-tb5"><button type="button" class="btn waves-effect waves-light btn-rounded btn-success">+ NEW PARTNER</button></a></div>
						</div>
						</div>
						<div class="clearfix"></div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>First Name</th>
                                                <!--<th>Last Name</th>-->
                                                <th>Email / phone</th>
                                                <th>Active / Deactive</th>
                                                <th>Edit / Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                  <?php
                                            $i=1;

                                            foreach($partners as $parnter){
                                                if($parnter['status']==0){
                                                          $status ='<span class="p-r10" id="active_'.$parnter["id"].'"><div class="btn-view flt-left"><a href="edit-partner-profile.php?du='.base64_encode($parnter["id"]).'&us='.base64_encode($parnter["status"]).'" id="active" data-status="0"  data-pid="'.$parnter["id"].'" class="btn">Active</a></div></span>';
                                                           }else{
                                                           $status ='<span class="p-r10" id="deactive_'.$parnter["id"].'"><div class="btn-view flt-left"><a href="edit-partner-profile.php?du='.base64_encode($parnter["id"]).'&us='.base64_encode($parnter["status"]).'" id="active" data-status="1"  data-pid="'.$parnter["id"].'" class="btn">DeActive</a></div></span>';
                                                            }
                                           // $partner_name = explode("_",$parnter['name']);
                                               echo'<tr>
                                                <td>'.$i.'</td>
                                                <td>'.$parnter['Name'].'</td>
                                                <!--<td>'.$partner_name[1].'</td>-->
                                                <td>'.$parnter["email"].'</td>
                                                <td>	<div class="text-right revenue-fa">
                                                        '.$status.'
                                                </div></td><td>
													<div class="text-right revenue-fa">
													<span class="p-r10"><a href="edit-partner-profile.php?ei='.base64_encode($parnter['id']).'" id="edit"><i class="fa fa-pencil lblue"></i></a></span>
													<span class="p-r10"><a href="edit-partner-profile.php?di='.base64_encode($parnter['id']).'"  id="delete"><i class="fa fa-trash red "></i></a></span>
															</div>
												</td>
                                            </tr>';
                                                $i++;
                                            }

                                            ?>
                                        </tbody>
                                    </table>
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
                <!--<div id="myTrash" class="modal fade" role="dialog">
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
                </div>-->
    </div>
    <?php require_once ("footer.php");?>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../../../cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="../../../../../cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="../../../../../cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="../../../../../cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="../../../../../cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="../../../../../cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="../../../../../cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
</body>
</html>
<script>
    $(document).ready(function(){
        $(document).on("click","#delete",function(){
            if (confirm('Would You like To Delete')) {
               return true;
            }else{ return false;}
        });
/*active /deactive*/
$(document).on('click','#active',function(event){
                //event.preventDefault();
                var id = $(this).data('pid');
                var status = $(this).data('status'); 
                var data= {};
                data["clientId"] =  "x6DmrbsQFZyUUiggs0BZ";
                data["userid"]       = id;
                data["status"]   = status;
                $.ajax({
                    type: 'post',
                    url: 'http://localhost/angular/disconox/Disco/v1/InnoChat/activateUser',
                    data: JSON.stringify(data),
                    contentType: "application/json; charset=utf-8",
                    traditional: true,
                    success: function (data) {
						var obj = $.parseJSON(data);
						alert(obj['results']);
                    if(id==0){
						$("#active_"+id).html("hello");
						$("#active_"+id).replace('<span class="p-r10" id="deactive_'+id+'"><div class="btn-view flt-left"><a href="edit-partner-profile.php?" id="active" data-status="0"  data-pid="'+id+'" class="btn">DeActive</a></div></span>')
						}else{
						$("#deactive_"+id).html('<span class="p-r10" id="active_'+id+'"><div class="btn-view flt-left"><a href="edit-partner-profile.php?" id="active" data-status="0"  data-pid="'+id+'" class="btn">Active</a></div></span>');
							}
							
                    }
                });
	});
    });

</script>