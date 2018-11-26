<?php 
require_once("header.php"); 
if(isset($_POST['login']))
{
	//login use
    $data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "email"=>$_POST['email'],
           "password"=>$_POST['password']
           );
		$data_json = json_encode($data);
	    $url = $url."login";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response  = curl_exec($ch);
		if ($response === false) 
		{
			$info = curl_getinfo($ch);
			curl_close($ch);
			die('error occured during curl exec. Additioanl info: ' . var_export($info));
		} else 
		{
		
			$responsObj = json_decode($response, TRUE);

			if ($responsObj["error"]) 
			{
				echo "Bad Request";
			} else 
			{
				$user = (object)$responsObj['UserDetails'];
				session_start();
				$_SESSION['id'] = $user->id;
				$_SESSION['name'] = $user->name;
				$_SESSION['email'] = $user->email;
				$_SESSION['image'] = $user->image;
				$_SESSION['address'] = $user->address;
				$_SESSION['role']    = $user->role; 
				header("location:partners/index.php");
						
			}	
			curl_close($ch);
			//end

	    }
}
	
	//Register user
	if(isset($_POST['register']))
	{
		if($_POST['password']==$_POST['cpassword'])
	    {
	       $data  = array(
           "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
           "name"=>$_POST['first_name'].'-'.$_POST["last_name"],
           "password"=>$_POST['password'],
           "phone"=>$_POST['phone'],
           "email"=>$_POST['email'],
           "address"=>$_POST['street_name'].','.$_POST['city'].','.$_POST['state'],
           "venue_name"=>$_POST['venue_name'],
           "street_name"=>$_POST['street_name'],
           "location"=>$_POST['location'],
           "city"=>$_POST['city'],
           "state"=>$_POST['state'],
           "image"=>"",
           "role"=>2
           );
			$data_json = json_encode($data);
			$url = $url."registration";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			$response  = curl_exec($ch); 
			if ($response === false) 
			{
				
				$info = curl_getinfo($ch);
				curl_close($ch);
				die('error occured during curl exec. Additioanl info: ' . var_export($info));
			} else 
			{
		
			    $responsObj = json_decode($response, TRUE);

				if ($responsObj["error"]) 
				{
					echo "<script type='text/javascript'>alert('Bad Request')</script>";
					
				} else 
				{
			
					$_SESSION['id'] = $responsObj['id'];
					$_SESSION['profile_id'] = $responsObj['profile_id'];
					$_SESSION['name'] = $_POST['first_name'].'-'.$_POST["last_name"];
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['image'] ="";
					$_SESSION['address'] = $_POST['street_name'].','.$_POST['city'].','.$_POST['state'];
					$_SESSION['role']    = 2; 
			        
					$message = $responsObj['message'];
					if($message != 'Email Already Exist')
					{
					echo "<script type='text/javascript'>
					alert('$message');
					window.location='partners/my-profile.php';
					</script>";
					}
					else
					{
						
					echo "<script type='text/javascript'>
					alert('$message');
					</script>";
					
					}
			
				} 
            }	
         curl_close($ch);
	    }
	    else
		{
		
		     echo "<script type='text/javascript'>
		
		     alert('Passwords do no match');
		
		      </script>";
		
	    }
        //Registeration end
	}

?>
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
  </head>
  <body class="c-layout-header-fixed">
    <!-- BEGIN: LAYOUT/HEADERS/HEADER-1 -->
    <!-- BEGIN: HEADER -->
    <?php require_once('top.php');?>
    <!-- END: HEADER -->
    <!-- BEGIN: PAGE CONTAINER -->
    <div class="c-layout-page">
      <!-- BEGIN: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
      
      <!-- END: LAYOUT/BREADCRUMBS/BREADCRUMBS-3 -->
      <!-- BEGIN: PAGE CONTENT -->

      <div class="c-content-box c-size-md c-bg-white">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="c-contact">
                <div class="c-content-title-1">
                  <h3 class="c-font-uppercase c-font-bold">Become A Partner</h3>
                  <div class="c-line-left"></div>
                </div>
                <form action="" method="post">
                  <div class="form-body">
                    <div class="row p-t-20">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">First Name</label>
                          <input type="text" value="<?php if(isset($_POST['first_name'])) { echo $_POST['first_name']; } ?>" id="first_name" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Last Name</label>
                          <input type="text" id="last_name" value="<?php if(isset($_POST['last_name'])) { echo $_POST['last_name']; } ?>" name="last_name" class="form-control form-control-danger" placeholder="Last Name" required>
                        </div>
                      </div>
                      <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Email</label>
                          <input type="email" name="email" id="UserEmail" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" onkeyup="checkemail();" class="form-control form-control-danger" placeholder="Enter E Mail" required>
                           <span id="email_status"></span>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Phone Number</label>
                          <input type="text" id="phone" name="phone" value="<?php if(isset($_POST['phone'])) { echo $_POST['phone']; } ?>"  class="form-control form-control-danger" placeholder="Enter Phone Number" required maxlength="10">

                        </div>
                      </div>
                      <!--/span-->
                    </div>
                    <!--/row-->

                    <!--/row-->
                    <h3 class="box-title m-t10">Address</h3>
                    <hr>
                    <div class="row">
                      <div class="col-md-12 ">
                        <div class="form-group">
                          <label>Venue name</label>
                          <input type="text" value="<?php if(isset($_POST['venue_name'])) { echo $_POST['venue_name']; } ?>" class="form-control" id="venue_name" name="venue_name" placeholder="Venue name" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 ">
                        <div class="form-group">
                          <label>Street</label>
                          <input type="text" class="form-control" value="<?php if(isset($_POST['street_name'])) { echo $_POST['street_name']; } ?>" id="street_name" name="street_name" placeholder="Enter Street Name" required>
                        </div>
                      </div>
					   <div class="col-md-12 ">
                        <div class="form-group">
                          <label>Location</label>
                          <input type="text" class="form-control" value="<?php if(isset($_POST['location'])) { echo $_POST['location']; } ?>" id="location" name="location" placeholder="Enter Location Name" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
					
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" value="<?php if(isset($_POST['city'])) { echo $_POST['city']; }?>" class="form-control" id="city" name="city" placeholder="Enter City Name" required>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>State</label>
                          <select class="form-control" id="state" name="state" required>
                            <option>--Select--</option>
                            <option <?php if(isset($_POST['city'])) { if($_POST['state'] == 'Telangana'){ echo 'selected'; }} ?> value="Telangana">Telangana</option>
                            <option <?php if(isset($_POST['city'])) { if($_POST['state'] == 'Andhra Pradesh'){ echo 'selected'; } } ?> value="Andhra Pradesh">Andhra Pradesh</option>
                          </select>
                        </div>
                      </div>

                      <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" id="password" value="<?php if(isset($_POST['password'])) { echo $_POST['password']; } ?>" name="password" class="form-control" placeholder="......" required>
                        </div>
                      </div>
                      <!--/span-->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Re Enter Password</label>
                          <input type="password" value="<?php  if(isset($_POST['cpassword'])) { echo $_POST['cpassword']; } ?>" name="cpassword" id="cpassword" class="form-control" placeholder="......" required>
                        </div>
                      </div>
                      <!--/span-->
                    </div>
                  </div>
                  <button type="submit" id="register" name="register" class="btn c-theme-btn c-btn-uppercase btn-lg c-btn-bold c-btn-square">Submit</button>
                </form>

              </div>
            </div>



            <div class="col-md-6 col-sm-12">
              <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">Brief about Us:</h3>
                <div class="c-line-left"></div>
              </div>
              <p>We Are a Premium Nightlife Aggregator Portal Offering Complete Solutions For Clubs & Pubs In Hyderabad.</p>
              <p>We are providing an Omni channel platform for our partners (clubs) to stay connected with the potential audience in real time and post event updates, facilities, Artists, deals, offers & more. It would be an ideal platform for your club to be featured and enjoy access to the most powerful platform ever built for clubs.<p/>
              <br>
              <div class="c-content-title-1">
                <h3 class="c-font-uppercase c-font-bold">What you get?</h3>
                <div class="c-line-left"></div>
              </div>
              <p>Your information would be directly channeled to website and apps where in clubbers can directly book tickets or reserve their table. Connect real time by posting lightening deals/offers from your club. You have host of features in the app where you can do endless marketing activities from it.<p/>
            </div>

          </div>
        </div>
      </div>
       <!-- checking for email in database -->
       <script>
		function checkemail()
		{
			
		 var email=document.getElementById( "UserEmail" ).value;
		
		 if(email)
		 {
		  $.ajax({
		  type: 'post',
		  url: 'checkdata.php',
		  data: {
		   user_email:email,
		  },
		  success: function (response) {
		   $( '#email_status' ).html(response);
		   if(response=="OK")	
		   {
			return true;	
		   }
		   else
		   {
			return false;	
		   }
		  }
		  });
		 }
		 else
		 {
		  $( '#email_status' ).html("");
		  return false;
		 }
		}

        </script>
		<!-- End code for checking email -->
      <!-- END: PAGE CONTENT -->
    </div>
    <!-- END: PAGE CONTAINER -->
    <!-- BEGIN: LAYOUT/FOOTERS/FOOTER-5 -->
    <?php require_once('footer.php');?>
  </body>

</html>