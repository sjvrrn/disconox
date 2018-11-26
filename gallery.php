<!DOCTYPE html>
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
  <?php require_once('header.php');?>
  <link href="colorbox/colorbox.css" rel="stylesheet" media="all">
</head>

<body class="c-layout-header-fixed">
  <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
  <!-- BEGIN: HEADER -->
  <?php require_once("top.php");?>
  <!-- END: HEADER -->

  <div class="c-layout-page">
    <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!--<div class="c-layout-breadcrumbs-1 c-bgimage c-subtitle c-fonts-uppercase c-fonts-bold c-bg-img-center" style="background-image:url(assets/images/note-bg.jpg)">
        <div class="container">
          <div class="c-page-title">
            <p class="s-font c-font-white c-font-26 ">About Disconox</p>
          </div>
        </div>
      </div>-->
    <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
    <!-- BEGIN: PAGE CONTENT -->

    <div class="c-content-box c-size-md c-bg-white">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="c-content-title-1">
              <h3 class=" c-font-uppercase c-font-bold">Capture your event</h3>
              <div class="c-line-left c-theme-bg"></div>
            </div>
            <section>
             <div class="thumbholder">
                <div id="72157639163628903" class="thumbs default"></div>
             </div>	
             <div class="thumbholder">
			    <div id="72157629025244071" class="thumbs default"></div>
		     </div>
             <div class="thumbholder">
			<div id="72157622964920227" class="thumbs default"></div>
		</div>
	       </section>
          </div>
        </div>
      </div>
    </div>
    <!-- END: PAGE CONTENT -->
  </div>
  <?php require_once('footer.php');?>
  <script src="colorbox/jquery.colorbox-min.js"></script>
  <script src="colorbox/flickr-thumb-gallery.js"></script>
  <script>
$(document).ready(function(){

$(".thumbs.default").flickrGalleryThumbs();

$(".thumbs.bottomTitle").flickrGalleryThumbs({

titlePostion: "bottom"

});

$(".thumbs.customSize").flickrGalleryThumbs({

width: 600,
height: 400

});

});		
</script>
</body>

</html>