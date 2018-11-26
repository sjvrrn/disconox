<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<?php 
//include('header.php');
//header start
//include_once("db_connect.php");
//db connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imageupload";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>
<title>phpzag.com : Dome of Image Upload and Image Crop in Modal with PHP and jQuery</title>
<script src="dist_files/jquery.imgareaselect.js" type="text/javascript"></script>
<script src="dist_files/jquery.form.js"></script>
<link rel="stylesheet" href="dist_files/imgareaselect.css">
<script src="dist_files/functions.js"></script>
<?php // include('container.php');?>
<div class="container">
	<h2>Example: Image Upload and Image Crop in Modal with PHP and jQuery</h2>		
	
	<div>
		<img id="profile_picture" height="128" data-src="dist_files/default.jpg"  data-holder-rendered="true" style="width: 140px; height: 140px;" src="dist_files/default.jpg"/>
		<br><br>
		<a type="button" class="btn btn-primary" id="change-profile-pic">Change Profile Picture</a>
	</div>
	<div id="profile_pic_modal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				   <h3>Change Profile Picture</h3>
				</div>
				<div class="modal-body">
					<form id="cropimage" method="post" enctype="multipart/form-data" action="change_pic.php">
						<strong>Upload Image:</strong> <br><br>
						<input type="file" name="profile-pic" id="profile-pic" />
						<input type="hidden" name="hdn-profile-id" id="hdn-profile-id" value="1" />
						<input type="hidden" name="hdn-x1-axis" id="hdn-x1-axis" value="" />
						<input type="hidden" name="hdn-y1-axis" id="hdn-y1-axis" value="" />
						<input type="hidden" name="hdn-x2-axis" value="" id="hdn-x2-axis" />
						<input type="hidden" name="hdn-y2-axis" value="" id="hdn-y2-axis" />
						<input type="hidden" name="hdn-thumb-width" id="hdn-thumb-width" value="" />
						<input type="hidden" name="hdn-thumb-height" id="hdn-thumb-height" value="" />
						<input type="hidden" name="action" value="" id="action" />
						<input type="hidden" name="image_name" value="" id="image_name" />
						
						<div id='preview-profile-pic'></div>
					<div id="thumbs" style="padding:5px; width:600p"></div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" id="save_crop" class="btn btn-primary">Crop & Save</button>
				</div>
			</div>
		</div>
	</div>
		
	<div style="margin:50px 0px 0px 0px;">
		<a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/image-upload-and-crop-in-modal-with-php-and-jquery/" title="">Back to Tutorial</a>			
	</div>		
</div>
<?php //include('footer.php');?>