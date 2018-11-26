  <?php
  session_start();
  if(!isset($_SESSION['id'])){
	  header("location:logout.php");
	  }
  error_reporting(0);
  require_once 'controller/APIBaseController.php';
  
  
  define("IOSClient", "iOS");
  define("AndroidClient", "android");
  class User extends INNOCHAT\APIBaseController {
  
	  private $userName, $userSecret, $requestObj;
  
	  function __construct($requestParam) {
  
		  $this->requestObj = $requestParam;
	  }
  /*
   * User Registration
   */
  public function Registration() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId', 'name', 'password','email','phone','address','role','image');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name'];
					  $this->password = $jsonRequest['password'];
					  $this->email  = $jsonRequest['email'];
					  $this->phone  =  $jsonRequest['phone'];
					  $this->role  =  $jsonRequest['role'];
					  $this->address  = $jsonRequest['address'];
					  $this->image    = $jsonRequest['image'];
					  $this->status  = 1;
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("INSERT INTO `users`(`name`, `email`, `phone`, `address`, `password`, `image`, `role`, `status`) VALUES (?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("ssssssss", $this->name, $this->email,$this->phone,$this->address,md5($this->password),$this->image,$this->role,$this->status) or  trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
                      $last_inser_id = $this->conn->insert_id;
					  //$stmt->store_result();
					  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['id'] = $last_inser_id;
						  parent::echoRespnse(200, $response);
					}
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * User Registration
   */
  public function profile() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId', 'user_id', 'name','title','address','description','map_url','partner_pic','product_gallery','product_videos','booking_days','booking_time','facilities','dress_code','music_genre');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->name = $jsonRequest['name']; 
					  $this->title = $jsonRequest['title'];
					  $this->address  = $jsonRequest['address'];
					  $this->description  =  $jsonRequest['description'];
					  $this->map_url  =  $jsonRequest['map_url'];
					   $this->image    =$jsonRequest['partner_pic']; 
					  $this->product_gallery = (object)$jsonRequest['product_gallery'];
					  $this->product_videos = $jsonRequest['product_videos'];
					  $this->booking_days  = $jsonRequest['booking_days']; 
					  $this->booking_time  = $jsonRequest['booking_time'];
					  $this->facilities = $jsonRequest['facilities'];
					  $this->dress_code  = $jsonRequest['dress_code'];
					  $this->music_genre = $jsonRequest['music_genre'];
					  $gallery          = explode(",", $this->product_gallery->images);
					  $links             = explode(",", $this->product_videos[0]);
					  $userid    = $jsonRequest['user_id'];
					  $this->status   = 1;
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  
					  $stmt = $this->conn->prepare("INSERT INTO `partner_profile`(`Name`, `Title`, `Address`, `description`, `partner_pic`,facilities,dress_code,music_genre,`location`,`createdby`) VALUES (?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("ssssssssss", $this->name, $this->title,$this->address,$this->description,$this->image ,$this->facilities,$this->dress_code,$this->music_genre,$this->map_url,$userid) or  trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  /*links*/
					  
					   foreach ($links as $link) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $userid, $link) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					
					  /*product_gallery*/
					  
					  foreach ($gallery as $image) {
						  if($image!==""){
						  $type = 2;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $userid, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  }
  
					  //$stmt->store_result();
					  if (!$stmt) {
						 $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					}
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * User Registration
   */
  public function getProfile() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id, p.Name,p.Title, p.Address,p.description, p.partner_pic, p.location,facilities,dress_code,music_genre,
													  p.createdby, GROUP_CONCAT(pv.url) AS videos, GROUP_CONCAT(pim.image) AS images,GROUP_CONCAT(pim.id) AS imageids,GROUP_CONCAT(pv.id) AS videoids
													  FROM  partner_profile p
													  LEFT JOIN product_images pim ON pim.pid = p.createdby
													  LEFT JOIN product_videos pv ON pv.pid = p.createdby
													  WHERE p.createdby =?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'profile details.';
						  $response['error'] = false;
						  $response['profileDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *update user profile
   */
  public function updateprofile() { 
			   $jsonRequest = json_decode($this->requestObj, TRUE);
				$acceptedArray = array('clientId','user_id','profile_id', 'name','title','address','description','map_url','partner_pic','product_gallery','product_videos');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name'];
					  $this->title = $jsonRequest['title'];
					  $this->address  = $jsonRequest['address'];
					  $this->description  =  $jsonRequest['description'];
					  $this->map_url  =  $jsonRequest['map_url'];
					 $this->image    =$jsonRequest['partner_pic']; 
					  $this->product_gallery = $jsonRequest['product_gallery'];
					  $this->product_videos = $jsonRequest['product_videos'];
					  $gallery          = explode(",", $this->product_gallery['images']);
					  $image_ids       = explode(',',$this->product_gallery['imageIds']);
					  $links         = explode(",", $this->product_videos[0]);
					  $videoids      = explode(",", $this->product_videos['ids']);
					  $profile_id    = $jsonRequest['profile_id'];
					  $user_id       = $jsonRequest['user_id'];
					  
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
							   
							   if($this->image!=""){  //echo"UPDATE `partner_profile` SET `Name`='".$this->name."',`Title`='".$this->title."',`Address`='".$this->address."',`description`='".$this->description."',`partner_pic`='".$this->image."',`location`='".$this->map_url."',`createdby`=".$userid." WHERE id=".$profile_id.""; exit;
													  $stmt = $this->conn->prepare("UPDATE `partner_profile` SET `Name`=?,`Title`=?,`Address`=?,`description`=?,`partner_pic`=?,`location`=?,`createdby`=? WHERE id=?")
																		  or trigger_error($this->conn->error, E_USER_ERROR);
													  $stmt->bind_param("ssssssss",$this->name, $this->title,$this->address,$this->description,$this->image,$this->map_url,$user_id,$profile_id) or trigger_error($stmt->error, E_USER_ERROR);
													  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR); 		  
     											   }else{ 
												   $stmt = $this->conn->prepare("UPDATE `partner_profile` SET `Name`=?,`Title`=?,`Address`=?,`description`=?,`location`=?,`createdby`=? WHERE id=?")
																		  or trigger_error($this->conn->error, E_USER_ERROR);
													  $stmt->bind_param("sssssss",$this->name, $this->title,$this->address,$this->description,$this->map_url,$user_id,$profile_id) or trigger_error($stmt->error, E_USER_ERROR);
													  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR); 		   
													   
												   }		  

										$i=0;
									  foreach ($gallery as $image) {
										   if($image!=""){
										   $type=1;
										   $imageid = $image_ids[$i];
										   if(isset($imageid)){ 
										  // echo"UPDATE product_images SET   image ='".$image."' WHERE id=$imageid";echo"<br>";
											  $stmt = $this->conn->prepare("UPDATE product_images SET   image =? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
											    $stmt->bind_param("ss", $image,$imageid) or trigger_error($stmt->error, E_USER_ERROR);
											    $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  }else{ 
										  $type=3;
										  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
										  $stmt->bind_param("sss",  $user_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
										  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
											 }
										  }
										  
										  $i++;
									   }
										  /*product_videos*/
										  $i=0;
										  foreach ($links as $video) {
											  $vid = $videoids[$i];
											  if($vid!=""){ echo"yes";
											//	  echo"UPDATE `product_videos` SET `url`='".$video."' WHERE id=$videoids[$i]"; echo"<br>";
											  $stmt = $this->conn->prepare("UPDATE `product_videos` SET `url`=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("ss",$video,$vid) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  }else{ echo"no";
											   $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("ss", $user_id,$video) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);

										  }
										  $i++;
									  }//exit;
								   }
   
   
					$stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
   
				  $stmt->close();
								  
		  
				   
			   }else{
				   
			   parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }
/*
 *update user profile
 */
 /*
   *update user profile
   */
  public function partnerUpdate() {
			   $jsonRequest = json_decode($this->requestObj, TRUE);
			   $acceptedArray = array('clientId','user_id','profile_id', 'name','title','address','description','map_url','partner_pic','product_gallery','product_videos','facilities','dress_code','music_genere');
		  if (!empty($jsonRequest)) { 
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) { 
					  $this->name = $jsonRequest['name'];
					  $this->title = $jsonRequest['title'];
					  $this->address  = $jsonRequest['address'];
					  $this->description  =  $jsonRequest['description'];
					  $this->map_url  =  $jsonRequest['map_url'];
					 $this->image    =$jsonRequest['partner_pic']; 
					  $this->product_gallery = $jsonRequest['product_gallery'];
					  $this->product_videos = $jsonRequest['product_videos'];
					  $gallery          = explode(",", $this->product_gallery['images']);
					  $image_ids       = explode(',',$this->product_gallery['imageIds']);
					  $links         = explode(",", $this->product_videos[0]);
					  $videoids      = explode(",", $this->product_videos['ids']);
					  $profile_id    = $jsonRequest['profile_id'];
					  $user_id       = $jsonRequest['user_id'];
					  $facilities = $jsonRequest['facilities'];
					  $dress_code = $jsonRequest['dress_code'];
					  $music_genere = $jsonRequest['music_genere'];
					  
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
							   
							   if($this->image!=""){  //echo"UPDATE `partner_profile` SET `Name`='".$this->name."',`Title`='".$this->title."',`Address`='".$this->address."',`description`='".$this->description."',`partner_pic`='".$this->image."',`location`='".$this->map_url."',`createdby`=".$userid." WHERE id=".$profile_id.""; exit;
													  $stmt = $this->conn->prepare("UPDATE `partner_profile` SET `Name`=?,`Title`=?,`Address`=?,`description`=?,`partner_pic`=?,`location`=?,`createdby`=? ,facilities=?,dress_code=?,music_genere=? WHERE id=?")
																		  or trigger_error($this->conn->error, E_USER_ERROR);
													  $stmt->bind_param("sssssssssss",$this->name, $this->title,$this->address,$this->description,$this->image,$this->map_url,$user_id,$facilities,$dress_code,$music_genere,$profile_id) or trigger_error($stmt->error, E_USER_ERROR);
													  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR); 		  
     											   }else{ 
												   $stmt = $this->conn->prepare("UPDATE `partner_profile` SET `Name`=?,`Title`=?,`Address`=?,`description`=?,`location`=?,`createdby`=?,facilities=?,dress_code=?,music_genere=? WHERE id=?")
																		  or trigger_error($this->conn->error, E_USER_ERROR);
													  $stmt->bind_param("ssssssssss",$this->name, $this->title,$this->address,$this->description,$this->map_url,$user_id,$facilities,$dress_code,$music_genere,$profile_id) or trigger_error($stmt->error, E_USER_ERROR);
													  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR); 		   
													   
												   }		  

										$i=0;
									  foreach ($gallery as $image) {
										   if($image!=""){
										   $type=1;
										   $imageid = $image_ids[$i];
										   if(isset($imageid)){ 
										  // echo"UPDATE product_images SET   image ='".$image."' WHERE id=$imageid";echo"<br>";
											  $stmt = $this->conn->prepare("UPDATE product_images SET   image =? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
											    $stmt->bind_param("ss", $image,$imageid) or trigger_error($stmt->error, E_USER_ERROR);
											    $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  }else{ 
										  $type=3;
										  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
										  $stmt->bind_param("sss",  $user_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
										  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
											 }
										  }
										  
										  $i++;
									   }
										  /*product_videos*/
										  $i=0;
										  foreach ($links as $video) {
											  $vid = $videoids[$i];
											  if($vid!=""){ echo"yes";
											//	  echo"UPDATE `product_videos` SET `url`='".$video."' WHERE id=$videoids[$i]"; echo"<br>";
											  $stmt = $this->conn->prepare("UPDATE `product_videos` SET `url`=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("ss",$video,$vid) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  }else{ echo"no";
											   $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("ss", $user_id,$video) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);

										  }
										  $i++;
									  }//exit;
								   }
   
   
					$stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
   
				  $stmt->close();
								  
		  
				   
			   }else{
				   
			   parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }
  /*
   *update user
   */
  public function updateproduct() {
			   $jsonRequest = json_decode($this->requestObj, TRUE);
				$acceptedArray = array('clientId','productId','name', 'tags','highlights','closed_date','description','artist_info');
		  if (!empty($jsonRequest)) {
			   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->productId = $jsonRequest['productId'];
					  $this->name= $jsonRequest['name'];
					  $this->tags  =  $jsonRequest['tags'];
					  $this->highlights  =  $jsonRequest['highlights'];
					  $this->closed_date    =$jsonRequest['closed_date'];
					  $this->description = $jsonRequest['description'];
					  $this->artist_info = $jsonRequest['artist_info'];
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
							  // if($password==""){
  
								  
		  $stmt = $this->conn->prepare("UPDATE product  SET name =?,highlights =?,closed_date =?,tags =?,description =?,artist_info=? WHERE id=?")
							  or trigger_error($this->conn->error, E_USER_ERROR);
		  $stmt->bind_param("sssssss",$this->name, $this->highlights,$this->closed_date,$this->tags,$this->description,$this->artist_info,$this->productId) or trigger_error($stmt->error, E_USER_ERROR);
								   }
					$stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
  
				  $stmt->close();
								  
		  
				   
			   }else{
				   
			   parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }	
	  
  /*
  * user login
  */
  public function loginUser() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'email', 'password');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->email = $jsonRequest['email'];
					  $this->password = md5($jsonRequest['password']);
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
  
					  $stmt = $this->conn->prepare("Select * from users  where email = ? and password = ? and status=1") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("ss", $this->email, $this->password) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User login success.';
						  $response['error'] = FALSE;
						  $response['UserDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'User login failed.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *update user Data
   */
  public function userUpdate() {
			   $jsonRequest = json_decode($this->requestObj, TRUE);
				  $acceptedArray = array('clientId','userid','name','email','phone','address','password','image');
					if (!empty($jsonRequest)) {
					  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
						if (parent::checkClientId($jsonRequest['clientId'])) {
							   $userid   = $jsonRequest['userid'];
							   $name = $jsonRequest['name'];
							   $email = $jsonRequest['email'];
							   $phone = $jsonRequest['phone'];
							   $address = $jsonRequest['address'];
							   $password = $jsonRequest['password'];
							  $image    = $jsonRequest['image']; 
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
							   if($password==""){
								   //echo "UPDATE `users` SET`name`= ?,`email`=?,`phone`=?,`address`=?,image=$image WHERE  id= $userid"; exit;
		  $stmt = $this->conn->prepare("UPDATE `users` SET`name`= ?,`email`=?,`phone`=?,`address`=?,image=? WHERE  id= ?")
							  or trigger_error($this->conn->error, E_USER_ERROR);
		  $stmt->bind_param("ssssss",$name,$email,$phone,$address,$image,$userid) or trigger_error($stmt->error, E_USER_ERROR);
								   }else{ 
		 $stmt = $this->conn->prepare("UPDATE `users` SET`name`= ?,`email`=?,`phone`=?,`address`=?,`password`=?,image=? WHERE  id= ?")
							  or trigger_error($this->conn->error, E_USER_ERROR);
			   $stmt->bind_param("sssssss",$name,$email,$phone,$address,md5($password),$image,$userid) or trigger_error($stmt->error, E_USER_ERROR);
									   }
					  $stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
									$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
								  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
  
				  $stmt->close();
								  
		  
				   
			   }else{
				   
			   parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }else{
		  
		  parent::badRequest();
		  
	  }
		  }
  /*
   *delete user Data
   */
   public function userDelete() {
			   $jsonRequest = json_decode($this->requestObj, TRUE);
				  $acceptedArray = array('clientId','userid');
					if (!empty($jsonRequest)) {
					  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
						if (parent::checkClientId($jsonRequest['clientId'])) {
							   $userid   = $jsonRequest['userid'];
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
					$stmt = $this->conn->prepare("DELETE FROM `users`  WHERE  id= ?") or trigger_error($this->conn->error, E_USER_ERROR);
  
			   $stmt->bind_param("s",$userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute();
							  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['message'] = "successfully deleted";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['message']   = 'user Deltetion Failed';
								  parent::echoRespnse(200, $response);
				  }
				  $stmt->close();
					  }else{
			  parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }else{
		  
		  parent::badRequest();
		  
	  }
		  }
/*
 *getUser Details
 */			
   public function userDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("Select * from users  where id = ?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['UserDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
/*
   *getUser Details
   */			
   public function partnerDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT pf.id, pf.Name, pf.Title, pf.Address, pf.description, pf.partner_pic, pf.location
						                           FROM partner_profile pf WHERE pf.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['UserDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
/*
 *getUser Details
 */			
   public function userDetai() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("Select * from users  where id = ?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['UserDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *user notifications
   */			
   public function userNotifications() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("select id,notification from product_notification where user_id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					   $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['UserDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get All Users
   */			
  public function all_users() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  //$this->role = $jsonRequest['role'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT * FROM partner_profile p 
                                                    INNER JOIN users u ON u.id = p.createdby") or trigger_error($this->conn->error, E_USER_ERROR);                   
  
					  //$stmt->bind_param("s",$this->role) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
   
						  $response['message'] = 'All Users Data.';
						  $response['error'] = FALSE;
						  $response['PartnersData'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Users Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
 /*
   *get All Users
   */			
  public function allusers() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','role');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->role = $jsonRequest['role'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT `id`, `name`, `email`, `phone`, `address`, `password`, `role`, `image`, `status`, `created` FROM `users` WHERE  role=?") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("s",$this->role) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
   
						  $response['message'] = 'All Users Data.';
						  $response['error'] = FALSE;
						  $response['PartnersData'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Users Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *check user with using email
  */	
  public function checkuser() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','email');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->email = $jsonRequest['email'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("Select * from users  where email = ?") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("s",$this->email) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
   
						  $response['message'] = 'All Users Data.';
						  $response['error'] = FALSE;
						  $response['PartnersData'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Users Not Available.';
						  $response['error'] = FALSE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * artist Registration
   */
  public function add_artist() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId', 'name','email','phone','spec','exp','role','desc','images');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->name = $jsonRequest['name'];
					  $this->email  = $jsonRequest['email'];
					  $this->phone  =  $jsonRequest['phone'];
					  $this->role  =  $jsonRequest['role'];
					  $this->spec  = $jsonRequest['spec'];
					  $this->exp = $jsonRequest['exp'];
					  $this->desc = $jsonRequest['desc'];
					  $this->image = $jsonRequest['images'];
  
					  $this->status  = 1;
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
  
					  $stmt = $this->conn->prepare("INSERT INTO `users`(`name`, `email`, `phone`,`role`,`image`,`status`) VALUES (?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("ssssss", $this->name, $this->email,$this->phone,$this->role,$this->image,$this->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  if($last_inser_id = $this->conn->insert_id){
						  $stmt = $this->conn->prepare("INSERT INTO `artist`(`user_id`, `specialization`, `experience`, `description`) VALUES (?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
  
						  $stmt->bind_param("ssss", $last_inser_id, $this->spec,$this->exp,$this->desc) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  if (!$stmt) {
							  $response['message'] = 'Reigstratioin Failed Please Try Again.';
							  $response['error'] = TRUE;
							  parent::echoRespnse(200, $response);
						  }else{
							  $response['message'] = 'Registration Success.';
							  $response['error'] = FALSE;
							  $response['validUserDetails'] = "valid";
							  parent::echoRespnse(200, $response);
						  }
  
					  }
					  //$stmt->store_result();
  
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
   /*
	*delete Artist Data
   */
   public function artistDelete() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','userid');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $userid   = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("DELETE FROM `users`  WHERE  id= ?") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("s",$userid) or trigger_error($stmt->error, E_USER_ERROR);
					  if($stmt->execute()){
						  $stmt = $this->conn->prepare("DELETE FROM `artist` WHERE  user_id= ?") or trigger_error($this->conn->error, E_USER_ERROR);
  
						  $stmt->bind_param("s",$userid) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute();
						  $response = array();
						  if ($stmt->affected_rows == 1) {
							  $error  = True;
							  $response['message'] = "Artist successfully deleted";
							  parent::echoRespnse(200, $response);
						  } else {
							  $error  =False;
							  $response['message']   = 'Artist Deltetion Failed';
							  parent::echoRespnse(200, $response);
						  }
						  $stmt->close();
					  }
  
				  }else{
					  parent::badRequest();
				  }
			  }else{
				  parent::badRequest();
			  }
		  }else{
  
			  parent::badRequest();
  
		  }
	  }
   /*
   *get artist etails
   */
   public function artistDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'userid');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("select * from users u inner JOIN artist a on u.id = a.user_id and u.id = ?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res;
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
  
							  $res[$key] = $val;
						  }
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'Artist exists.';
						  $response['error'] = FALSE;
						  $response['artistDetails'] = $res;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "Artist doesn't Exits.";
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get artist etails
   */
  public function all_Artists() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("select u.id ,u.image, u.name, u.email, u.phone, u.address, u.password, u.role,u.status, a.id as artist_details_id,a.specialization,
													  a.experience,a.description from users u 
													  inner JOIN artist a on u.id = a.user_id and u.role=4 and u.status=1") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'Artists exists.';
						  $response['error'] = FALSE;
						  $response['Artists'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "Artists doesn't Exit.";
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get artist etails
   */
  public function updateArtist() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','userid');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->userid = $jsonRequest['userid'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("UPDATE `users` SET `status`=0 WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
  
				  $stmt->close();
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * artist Updation
   */
  public function artistUpdate() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','userid','name','email','phone','spec','exp','desc','image');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->userid = $jsonRequest['userid'];
					  $this->name = $jsonRequest['name'];
					  $this->email  = $jsonRequest['email'];
					  $this->phone  =  $jsonRequest['phone'];
					  $this->spec  = $jsonRequest['spec'];
					  $this->exp = $jsonRequest['exp'];
					  $this->desc = $jsonRequest['desc'];
					  $this->image = $jsonRequest['image'];
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
  
					  $stmt = $this->conn->prepare("UPDATE `users` SET `name`= ?,`email`=?,`phone`=?,image=? WHERE  id= ?")
					  or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("sssss", $this->name, $this->email, $this->phone,$this->image ,$this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  if ($stmt->execute()) {
						  $stmt = $this->conn->prepare("UPDATE `artist` SET `specialization`= ?,`experience`= ?,`description`= ? WHERE  user_id= ?")
						  or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ssss", $this->spec, $this->exp, $this->desc, $this->userid) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute();
						  $response = array();
						  if ($stmt->affected_rows == 1) {
							  $error = True;
							  $response['results'] = "successfully updated";
							  parent::echoRespnse(200, $response);
						  } else {
							  $error = False;
							  $response['results'] = 'updation failure';
							  parent::echoRespnse(200, $response);
  
						  }
  
						  $stmt->close();
  
					  }
  
					  }
					  //$stmt->store_result();
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * artist Registration
   */
  public function add_notification() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','users','partners','notification');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->userId = $jsonRequest['userId'];
					  $this->users = $jsonRequest['users'];
					  $this->partners = $jsonRequest['partners'];
					  $this->notification  = $jsonRequest['notification'];
					  $notification = explode(",",$this->notification);
					  $users = explode(",",$this->users);
					  $partners = explode(",",$this->partners);
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					$users = array_merge($users,$partners);
					  foreach($users as $user){
					  
					  $stmt = $this->conn->prepare("INSERT INTO `product_notification`(`notification`, `user_id`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  $stmt->bind_param("ss", $user, $notification[$i]) or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					 
						  if (!$stmt) {
							  $response['message'] = 'Reigstratioin Failed Please Try Again.';
							  $response['error'] = TRUE;
							  parent::echoRespnse(200, $response);
						  }else{
							  $response['message'] = 'Registration Success.';
							  $response['error'] = FALSE;
							  $response['validUserDetails'] = "valid";
							  parent::echoRespnse(200, $response);
						  }
  
					  }
					  //$stmt->store_result();
  
				  
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
	  /*revenue*/
	  /*
   * artist Registration
   */
  public function add_revenue() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','productid','userid','product_name','price','customer_name','customer_email','customer_phone','customer_address');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->uid = $jsonRequest['userid'];
					  $this->productid = $jsonRequest['productid'];
					  $this->product_name  = $jsonRequest['product_name'];
					  $this->price  = $jsonRequest['price'];
					  $this->customer_name  = $jsonRequest['customer_name'];
					  $this->customer_email  = $jsonRequest['customer_email'];
					  $this->customer_phone  = $jsonRequest['customer_phone'];
					  $this->customer_address  = $jsonRequest['customer_address'];
					  $status = 'proccess';
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("INSERT INTO `product_orders`( `pid`, `product_name`, `uid`, `price`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `status`) VALUES (?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("sssssssss", $this->productid,$this->product_name ,$this->uid,$this->price,$this->customer_name,$this->customer_email,$this->customer_phone,$this->customer_address,$status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					 
					  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					  }
  
					}
					//$stmt->store_result();
  
				  
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *delete user Data
  */
  public function imageDelete() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','id');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $image_id   = $jsonRequest['id'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("delete  from product_images  WHERE id=? ")
					  or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s",$image_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute();
					  $response = array();
					  if ($stmt->affected_rows == 1) {
						  $error  = True;
						  $response['message'] = "successfully updated";
						  parent::echoRespnse(200, $response);
					  } else {
						  $error  =False;
						  $response['message']   = 'Updation Failed';
						  echo
						  parent::echoRespnse(200, $response);
					  }
					  $stmt->close();
				  }else{
					  parent::badRequest();
				  }
			  }else{
				  parent::badRequest();
			  }
		  }else{
  
			  parent::badRequest();
  
		  }
	  }
  /*
  *update user Data
  */
  public function activateUser() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','userid','status');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $userid   = $jsonRequest['userid'];
					  $status = $jsonRequest['status'];
					  if($status==0){
						  $status = 1;
					  }elseif($status==1){
						  $status = 0;
					  }
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("UPDATE `users` SET `status`=? WHERE id=? ")
					  or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ss",$status,$userid) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute();
					  $response = array();
					  if ($stmt->affected_rows == 1) {
						  $error  = True;
						  $response['results'] = "successfully updated";
						  parent::echoRespnse(200, $response);
					  } else {
						  $error  =False;
						  $response['results']   = 'updation failed';
						  parent::echoRespnse(200, $response);
  
					  }
  
					  $stmt->close();
  
  
  
				  }else{
  
					  parent::badRequest();
				  }
			  }else{
				  parent::badRequest();
			  }
		  }else{
  
			  parent::badRequest();
  
		  }
	  }
  /*
  *add Product
  */
  public function addProduct() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product','product_deals','product_offers','product_terms','product_reviews','product_images','product_gallery','product_videos','user_id');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product = $jsonRequest['product']; 
					  $this->product_deals = $jsonRequest['product_deals'];
					  $this->product_offers = $jsonRequest['product_offers'];
					  $this->product_terms = $jsonRequest['product_terms'];
					  $this->product_reviews = $jsonRequest['product_reviews'];
					  $this->product_images = $jsonRequest['product_images'];
					  $this->product_gallery = $jsonRequest['product_gallery'];
					  $this->product_videos = $jsonRequest['product_videos'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status = 0;
					  $subtitle = '';
					  $product = (object)$this->product;//product
					  
					  $product_deals = (object)$this->product_deals;//product deals
					  $product_offers = (object)$this->product_offers;//product offers
					  $product_terms = (object)$this->product_terms;//product terms
					  $product_reviews = (object)$this->product_reviews;//product reviews
					  $product_images = (object)$this->product_images;//product images
					  $product_gallery = (object)$this->product_gallery;//product gallery
					  $product_videos = (object)$this->product_videos;//product videos
					  //$images = explode(",", $product_images->images);
					  //$gallery = explode(",", $product_gallery->images);
					 // $videos = explode(",", $product_videos->videos);
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*product*/
					  $stmt = $this->conn->prepare("INSERT INTO `product`(`name`, `category_id`, `address`, `highlights`, `location`, `closed_date`, `tags`, 
					  `description`, `artist_info`, `uid`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					   ///*INSERT INTO `product`( `name`, `category_id`, `address`, `highlights`, `location`, `closed_date`, `tags`, `description`, `artist_info`, `uid`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)*/
					  $stmt->bind_param("sssssssssss", $product->name, $product->category_id, $product->address, $product->highlights, $product->location, $product->closed_date,
						  $product->tags, $product->description, $product->artist_info, $this->user_id, $product->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   $product_id = $this->conn->insert_id; 
					  /*product deal*/
					  if ($last_inser_id = $this->conn->insert_id) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_deals_offers`(`pid`, `name`, `type`, `subtitle`, `price`, `start_date_time`, `end_date_time`, `tags`, `about_deal`) VALUES (?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sssssssss", $product_id, $product_deals->name, $product_deals->type, $subtitle, $product_deals->price, $product_deals->start_date_time, $product_deals->end_date_time,
							  $product_deals->tags, $product_deals->about_deal) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  /*product offer*/
						  if ($productdeal_id = $this->conn->insert_id) {
							  $stmt = $this->conn->prepare("INSERT INTO `product_deals_offers`(`pid`, `name`, `type`, `subtitle`, `price`, `start_date_time`, `end_date_time`, `tags`, `about_deal`) VALUES (?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
							  $stmt->bind_param("sssssssss", $product_id, $product_offers->name, $product_offers->type, $subtitle, $product_offers->price, $product_offers->start_date_time, $product_offers->end_date_time,
								  $product_offers->tags, $product_offers->about_deal) or trigger_error($stmt->error, E_USER_ERROR);
							  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
							  /*product_terms*/
							  if ($productoffer_id = $this->conn->insert_id) {
								  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
								  $stmt->bind_param("ss", $product_id, $product_terms->description) or trigger_error($stmt->error, E_USER_ERROR);
								  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
								  /*product_reviews*/
								  if ($productterm_id = $this->conn->insert_id) {
									  $stmt = $this->conn->prepare("INSERT INTO `product_reviews`(`pid`, `uid`, `rating`, `review`, `status`) VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
									  $stmt->bind_param("sssss", $product_id, $this->user_id, $product_reviews->rating, $product_reviews->review, $product_reviews->status) or trigger_error($stmt->error, E_USER_ERROR);
									  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
									  /*product images*/
									  if ($productreview_id = $this->conn->insert_id) {
										  
										 // foreach ($images as $image) {
											  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("sss", $product_id, $product_images->images, $product_images->type) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  //}
										  /*product_gallery*/
										 // foreach ($gallery as $image) {
											  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("sss", $product_id, $product_gallery->images, $product_gallery->type) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  //}
										  /*product_videos*/
										  //foreach ($videos as $video) {
											  $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
											  $stmt->bind_param("ss", $product_id,$product_videos->videos) or trigger_error($stmt->error, E_USER_ERROR);
											  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
										  //}
										  if (!$stmt) {
								 $response['message'] = 'Reigstratioin Failed Please Try Again.';
								 $response['error'] = TRUE;
								 parent::echoRespnse(200, $response);
							 }else{
								 $response['message'] = 'Registration Success.';
								 $response['error'] = FALSE;
								 $response['validUserDetails'] = "valid";
								 parent::echoRespnse(200, $response);
							 }
									  }
							  }
  
							  }
								  }
								  //$stmt->store_result();
							  }
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *ADD PRODUCT
  */
  public function Product() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','name','user_id','category_id','address','highlights','location','closed_date','tags','description','artist_info','status');
		 if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name']; 
					  $this->address = $jsonRequest['address'];
					  $this->highlights = $jsonRequest['highlights'];
					  $this->location = $jsonRequest['location'];
					  $this->closed_date = $jsonRequest['closed_date'];
					  $this->tags = $jsonRequest['tags'];
					  $this->description = $jsonRequest['description'];
					  //$this->product_videos = $jsonRequest['product_videos'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status = $jsonRequest['status'];
					  $this->category_id = $jsonRequest['category_id'];
					  $this->artist_info = $jsonRequest['artist_info'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $category_id =1;
					  $this->closed_date = "";
					  /*product*/
					  $stmt = $this->conn->prepare("INSERT INTO `product`(`name`, `category_id`, `address`, `highlights`, `location`, `closed_date`, `tags`, 
					  `description`, `artist_info`, `uid`,`status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("sssssssssss", $this->name, $this->category_id, $this->address, $this->highlights, $this->location, $this->closed_date,
					  $this->tags, $this->description, $this->artist_info, $this->user_id, $this->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   $product_id = $this->conn->insert_id; 
					   if (!$stmt) {
								 $response['message'] = 'Reigstratioin Failed Please Try Again.';
								
								 $response['error'] = TRUE;
								 parent::echoRespnse(200, $response);
							 }else{
								 $response['message'] = 'Registration Success.';
								 $response['error'] = FALSE;
								  $response['parent_id'] = $product_id;
								 $response['validUserDetails'] = "valid";
								 parent::echoRespnse(200, $response);
							 }
				 
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
		  } else {
			  parent::badRequest();
		  }}	
  /*
  *product update
  */
  public function Product1() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','name','user_id','highlights','closed_date','tags','description','artist_info','booking_days','status',"category_id");
		  
		 
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name'];  
					  $this->highlights = $jsonRequest['highlights'];
					  $this->closed_date  = $jsonRequest['closed_date']; 
					  $this->tags = $jsonRequest['tags'];
					  $this->description = $jsonRequest['description'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status = $jsonRequest['status'];
					  $this->category_id = $jsonRequest['category_id'];
					  $this->artist_info = $jsonRequest['artist_info'];
                      $this->booking_days  = $jsonRequest['booking_days'];  					  
					   $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   /*product*/
					  $stmt = $this->conn->prepare("INSERT INTO `product`(`name`, `category_id`, `highlights`,`tags`, 
					  `description`,booking_days,`artist_info`, `uid`,`status`,`closed_date`) VALUES (?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);	
					  $stmt->bind_param("ssssssssss", $this->name, $this->category_id, $this->highlights,$this->tags, $this->description,$this->booking_days,$this->artist_info, $this->user_id,
					   $this->status,$this->closed_date) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $product_id = $this->conn->insert_id; 
					   if (!$stmt) {
								 $response['message'] = 'Reigstratioin Failed Please Try Again.';
								
								 $response['error'] = TRUE;
								 parent::echoRespnse(200, $response);
							 }else{
								 $response['message'] = 'Registration Success.';
								 $response['error'] = FALSE;
								  $response['parent_id'] = $product_id;
								 $response['validUserDetails'] = "valid";
								 parent::echoRespnse(200, $response);
							 }
				 
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
		  } else {
			  parent::badRequest();
		  }}	
  /*
  *ADD PRODUCT
  */
  public function ProductUpdate() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','name','user_id','category_id','address','highlights','location','closed_date','tags','description','artist_info','status');
  
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name']; 
					  $this->address = $jsonRequest['address'];
					  $this->highlights = $jsonRequest['highlights'];
					  $this->location = $jsonRequest['location'];
					  $this->closed_date = $jsonRequest['closed_date'];
					  $this->tags = $jsonRequest['tags'];
					  $this->description = $jsonRequest['description'];
					  $this->product_videos = $jsonRequest['product_videos'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status = $jsonRequest['status'];
					  $this->category_id = $jsonRequest['category_id'];
					  $this->artist_info = $jsonRequest['artist_info'];
										
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*product*/
					  $stmt = $this->conn->prepare("UPDATE `product` SET `name`=?,``address`=?,`highlights`=?,`location`=?,`closed_date`=?,`tags`=?,`description`=?,`artist_info`=?,`uid`=?,`status`=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("sssssssssss", $this->name, $this->category_id, $this->address, $this->highlights, $this->location, $this->closed_date,
					  $this->tags, $this->description, $this->artist_info, $this->user_id, $this->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $product_id = $this->conn->insert_id; 
					   if (!$stmt) {
								 $response['message'] = 'Reigstratioin Failed Please Try Again.';
								
								 $response['error'] = TRUE;
								 parent::echoRespnse(200, $response);
							 }else{
								 $response['message'] = 'Registration Success.';
								 $response['error'] = FALSE;
								  $response['parent_id'] = $product_id;
								 $response['validUserDetails'] = "valid";
								 parent::echoRespnse(200, $response);
							 }
				 
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
   * addsurprisecategories
   */
  public function addsurpriseCategories() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','surprise_products','product_reviews','product_images','product_gallery','terms_conditions','link','cvideo');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->surprise_products = $jsonRequest['surprise_products'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $this->product_gallery = (object)$jsonRequest['product_gallery'];
					  $this->terms_conditions = (object)$jsonRequest['terms_conditions'];
					  $product_reviews = (object)$jsonRequest['product_reviews'];
					  $this->link = (object)$jsonRequest['link'];
					  $this->cvideo = $jsonRequest['cvideo'];
					  $images           = explode(",", $this->product_images->images);
					  $gallery          = explode(",", $this->product_gallery->images);
					  $terms_conditions = explode(",",$this->terms_conditions->terms_conditions);
					  $links             = explode(",", $this->link->links);
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*start*/
					 foreach($this->surprise_products as $product){
						 $product = (object)$product; //
						 //echo"<pre>"; print_r($product); echo"<br>";
						  $stmt = $this->conn->prepare("INSERT INTO `product_surprise`(`pid`, `category_id`, `price`,price2,price3 ,capture_event,`description`, `note`) VALUES (?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("ssssssss",  $this->product_id, $product->category_id, $product->price,$product->price2,$product->price3,$this->cvideo ,$product->description, $product->note) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR); 
						 //echo $product_id = $this->conn->insert_id;
					 }
					  /*upload images*/
					  foreach ($images as $image) {
							 if($image!=""){	  
						  $type = $this->product_images->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $this->product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
				  }
				  /*terms&conditions*/
					   foreach ($terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $this->product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  
					  /*links*/
					   foreach ($links as $link) {
						  $type = $this->product_gallery->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $this->product_id, $link) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  
  
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *
   */	
  
  public function Updatesurprise() {
   $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','surprise_products','cvideo');
		  if (!empty($jsonRequest)) {
	   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
			 if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->surprise_products = $jsonRequest['surprise_products']; 
					  $this->cvideo   = $jsonRequest['cvideo'];
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*start*/
					   foreach($this->surprise_products as $product){
						 $product = (object)$product; 
					$stmt = $this->conn->prepare("UPDATE product_surprise SET price=?,price2=?,price3=?,capture_event=?,description=?,note=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("sssssss", $product->price,$product->price2,$product->price3,$this->cvideo,$product->description,$product->note, $product->id) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						 //echo $product_id = $this->conn->insert_id;
					 }
					 
					$response = array();
				  if ($stmt->affected_rows == 1) {
									$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
							} else {
								  $error  =False;
								  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
				  $stmt->close();
					  /*end*/
						}else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
  /*
  *add package categories
  */	
  public function addpackageCategories() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','package_products','product_images','terms_conditions');
		  if (!empty($jsonRequest)) {
	   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
			 if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id']; 
					  $this->package_products = $jsonRequest['package_products'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $this->terms_conditions = $jsonRequest['terms_conditions']; 
					  $images           = explode(",", $this->product_images->images);
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 
					  /*start*/
					 foreach($this->package_products as $product){
						 $product = (object)$product; //
						 //echo"INSERT INTO `product_packages`(`pid`, `category_id`, `price`, `description`, `tags`) 
						  //VALUES ('$this->product_id','$product->category_id',$product->price,'$product->description',$product->tags)";
						 $stmt = $this->conn->prepare("INSERT INTO `product_packages`(`pid`, `category_id`, `price`, `description`, `tags`) VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("sssss",  $this->product_id, $product->category_id, $product->price, $product->description, $product->tags) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						 } 
					  /*upload images*/
					  $type=1;
					  foreach ($images as $image) {
						  if($image!=""){
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $this->product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  }
					  }
  
					
					  /*terms&conditions*/
					   foreach ($this->terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",$this->product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
				 if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
					  /*end*/
						}else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *add package categories
  
  */	
  
  public function packageUpdate() { 
   $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','package_products','package_ids');
		  if (!empty($jsonRequest)) {
	   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
			 if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->package_products = $jsonRequest['package_products']; 
					  $this->product_images = $jsonRequest['product_images'];
					  $terms_conditions = (object)$jsonRequest['terms_conditions'];
					  $terms            = explode(",",$terms_conditions->terms);
					  $term_ids             = $terms_conditions->ids;
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  echo"<pre>";
					   /*start*/
					  foreach($this->package_products as $product){
						 $product = (object)$product; //
						 $stmt = $this->conn->prepare("UPDATE `product_packages` SET `price`= ?,`description`= ?,`tags`=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("ssss", $product->price, $product->description,$product->tags, $product->id) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					 }
					  /*upload images*/
						  $stmt = $this->conn->prepare("UPDATE product_images SET   image =? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",$this->product_images['images'],$this->product_images['id']) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  /*terms&conditions*/
					  $i=0;
					  foreach ($terms as $term) {
						  $stmt = $this->conn->prepare("UPDATE product_terms SET discription =? WHERE id =?") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $term,$term_ids[$i]) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $i++;
					  }
			  if (!$stmt) {
					  $response['message'] = 'Updation Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Updatation of Package Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
					  /*end*/
						}else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *add package categories
  
  */	
  public function bottleUpdate() {
   $jsonRequest = json_decode($this->requestObj, TRUE);
		  		  $acceptedArray = array('clientId',"category_id",'product_id','bottle_info');
		  if (!empty($jsonRequest)) {
	   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
			 if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->bottle_info = $jsonRequest['bottle_info'];
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   for($i=0;$i<count($this->bottle_info['name']);$i++){
						    if($this->bottle_info['id'][$i]){ 
					    //echo"UPDATE product_book_a_bottle SET name ='". $this->bottle_info['name'][$i]."',price=".$this->bottle_info['price'][$i].",
						//actual_price =".$this->bottle_info['actual_price'][$i]." WHERE id=".$this->bottle_info['id'][$i]."";echo"<br>";	  
						 $stmt = $this->conn->prepare("UPDATE product_book_a_bottle SET name =?,price=?,actual_price =? 
						 WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("ssss", $this->bottle_info['name'][$i], $this->bottle_info['price'][$i],
						 $this->bottle_info['actual_price'][$i], $this->bottle_info['id'][$i]) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					 }else{ 
						// echo"INSERT INTO `product_book_a_bottle`(`pid`, `name`, `price`, `actual_price`) 
						// VALUES ($this->product_id,'".$this->bottle_info['name'][$i]."','".$this->bottle_info['price'][$i]."',
						// '".$this->bottle_info['actual_price'][$i]."')";echo'<br>';
						 $stmt = $this->conn->prepare("INSERT INTO `product_book_a_bottle`(`pid`, `name`, `price`, `actual_price`) 
						 VALUES (?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ssss",$this->product_id, $this->bottle_info['name'][$i],$this->bottle_info['price'][$i],
						  $this->bottle_info['actual_price'][$i]) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						}
					 } 
					  
			  if (!$stmt) {
					  $response['message'] = 'Updation Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Updatation of Bottle Info Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
					  /*end*/
						}else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *add package categories
  
  */	
  public function tableUpdate() {
   $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','seater','seater_ids');
		  if (!empty($jsonRequest)) {
  
			  
	   if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
			 if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->seater = $jsonRequest['seater']; 
					  $this->seater_ids = $jsonRequest['seater_ids']; 
					  //$this->product_images = $jsonRequest['product_images'];
					  //$terms_conditions = (object)$jsonRequest['terms_conditions'];
					  //$terms            = explode(",",$terms_conditions->terms);
					  //$term_ids             = $terms_conditions->ids;
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   /*start*/
					   $i=0;
					  foreach($this->seater as $key=>$val){
						  $id = $this->seater_ids[$i];
                        //echo"UPDATE `product_book_a_table` SET   `price`=$val WHERE id=$id"; echo"<br>";  						
						$stmt = $this->conn->prepare("UPDATE `product_book_a_table` SET   `price`=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",$val,$id) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  $i++;
						  }
			  if (!$stmt) {
					  $response['message'] = 'Updation Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Updatation  table  Info Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
					  /*end*/
						}else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *deal&offers//check
  */	
  public function addDealsOffers() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','name','type','price','highlite','start_date_time','end_date_time','tags','about_deal','product_images','product_terms');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id']; 
					  $name            = $jsonRequest['name'];
					  $type   = $jsonRequest['type']; 
					  $price   = $jsonRequest['price']; 
					  $start_date_time   = $jsonRequest['start_date_time'];  
					  $end_date_time   = $jsonRequest['end_date_time']; 
					  $tags   = $jsonRequest['tags']; 
					  $about_deal   = $jsonRequest['about_deal'];
					  $highlite  = $jsonRequest['highlite'];
					  $this->product_images = $jsonRequest['product_images']; 
					  $this->product_terms  = $jsonRequest['product_terms']['terms'];
					  
					  $db  = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 $stmt = $this->conn->prepare("INSERT INTO `product_deals_offers`( `pid`, `name`, `type`,`price`,`tags`, `about_deal`,start_date_time,end_date_time,subtitle) VALUES (?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR) or trigger_error($this->conn->error, E_USER_ERROR);
					 $stmt->bind_param("sssssssss",$this->product_id,$name,$type,$price, $tags,$about_deal,$start_date_time,$end_date_time,$highlite);
					 $stmt->execute()or trigger_error($stmt->error, E_USER_ERROR);					
					/*product_gallery*/
					      if($this->product_images['images']!=""){
						  $type = $this->product_gallery->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $this->product_id, $this->product_images['images'][0],$this->product_images['type']) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*terms&conditions*/
					   foreach ($this->product_terms as $term) { 
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $this->product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
				  
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *
   */	
  /*
  *deal&offers
  */	
  public function packageDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  
					  $this->product_id = $jsonRequest['product_id']; 
						  $db  = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 $stmt = $this->conn->prepare("SELECT pp.id,p.id AS product_id, p.name , p.address, p.highlights, p.closed_date,
												  p.tags,p.description, p.artist_info,p.uid,pim.image,pim.id AS image_id,
												  pp.category_id,pp.price,pp.description AS pdescription ,pp.tags AS ptags
												  FROM product p 
												  LEFT JOIN product_packages pp ON pp.pid = p.id
												  LEFT JOIN product_images pim ON pim.pid = p.id
												  
												  WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR) or trigger_error($this->conn->error, E_USER_ERROR);
					 $stmt->bind_param("s",$this->product_id);
					 $stmt->execute()or trigger_error($stmt->error, E_USER_ERROR);
					
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['packageDetails'] = $EventResult;
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *deal&offers   che..........
  */	
  public function bottleDetails1() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  
					  $this->product_id = $jsonRequest['product_id']; 
						  $db  = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 $stmt = $this->conn->prepare("SELECT pp.id,p.id AS product_id, p.name , p.address, p.highlights, p.closed_date,
														  p.tags,p.description, p.artist_info,p.uid,pi.image,pi.id AS image_id,
														  pp.category_id,pp.price,pp.description AS pdescription ,pp.tags AS ptags
														  FROM product p 
														  LEFT JOIN product_packages pp ON pp.pid = p.id
														  LEFT JOIN product_images PI ON pi.pid = p.id
														  
														  WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR) or trigger_error($this->conn->error, E_USER_ERROR);
					 $stmt->bind_param("s",$this->product_id);
					 $stmt->execute()or trigger_error($stmt->error, E_USER_ERROR);
					
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['packageDetails'] = $EventResult;
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
   * adddeals& offers
   */
  public function addDealsMedia() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product_id','product_terms','product_reviews','product_images','product_gallery','product_videos');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];
					  $this->product_terms = (object)$jsonRequest['product_terms'];
					  $product_reviews = (object)$jsonRequest['product_reviews'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $this->product_gallery = (object)$jsonRequest['product_gallery'];
					  $this->product_videos = (object)$jsonRequest['product_videos'];
					  $images           = explode(",", $this->product_images->images);
					  $gallery          = explode(",", $this->product_gallery->images);
					  $terms_conditions = explode(",",$this->product_terms);
					  $links             = explode(",", $this->product_videos->videos);
					  $product  = $this->product_deals;
					  $db               = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*product_gallery*/
					  foreach ($images as $image) {
						  $type = $this->product_images->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $this->product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*product_gallery*/
					  foreach ($gallery as $image) {
						  $type = $this->product_gallery->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $this->product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*terms&conditions*/
					   foreach ($terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $this->product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  
					  /*links*/
					   foreach ($links as $link) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_videos`(`pid`, `url`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $this->product_id, $link) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*reviews*/
					  $status=0;
						  $stmt = $this->conn->prepare("INSERT INTO `product_reviews`(`pid`, `uid`, `rating`, `review`, `status`) VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sssss",  $this->product_id, $product_reviews->uid,$product_reviews->rating,$product_reviews->review,$status) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
	  
  /*
   * addguestList
   */
  public function addguestList() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product','guest_options','product_images','terms_conditions','user_id','booking_days');
		  if (!empty($jsonRequest)) { 
		  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product = $jsonRequest['product'];
					  $guest_options = $jsonRequest['guest_options'];
					  $this->product_images = $jsonRequest['product_images'];
					  $terms_conditions = explode(',',$jsonRequest['terms_conditions'][0]);
					  $this->user_id = $jsonRequest['user_id'];
					  $this->booking_days  = $jsonRequest['booking_days'];
					  $this->status = 1;
					  $subtitle = '';
					  $product = (object)$this->product;//product
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect(); 
					  
					  /******************************new start****/
					/*product*/
					  $stmt = $this->conn->prepare("INSERT INTO `product`(`name`, `category_id`, `highlights`, `tags`, 
					  `description`, `artist_info`, `uid`,`status`,closed_date,booking_days) VALUES (?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssssssssss", $product->name, $product->category_id,  $product->highlights,
						  $product->tags, $product->description, $product->artist_info, $this->user_id, $this->status,$product->closed_date,$this->booking_days) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $product_id = $this->conn->insert_id; 
					 // print_r($guest_options['name']); exit;
					  //Array ( [name] => Array ( [0] => couple ) [event_date_time] => Array ( [0] => 05/16/2018/04:14 ) [price] => Array ( [0] => 5500 ) [actual_price] => Array ( [0] => 6000 ) )
					  /**start**/
					//foreach($guest_options as $guest){
						for($i=0;$i<count($guest_options['name']);$i++){
						  $stmt = $this->conn->prepare("INSERT INTO `product_guest_list`(`pid`, `name`, `event_date_time`, `price`, `actual_price`) VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sssss", $product_id,$guest_options['name'][$i], $guest_options['event_date_time'][$i], $guest_options['price'][$i], $guest_options['actual_price'][$i]) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  }
					   //echo $product_id = $this->conn->insert_id;
					  /*upload images*/
					  if($this->product_images['images']!=""){
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss", $product_id, $this->product_images['images'],$this->product_images['type']) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  
					  /*terms&conditions*/
					  
					   foreach ($terms_conditions as $term) {
                           if($term!=""){						 
						 $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",   $product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   }
					  }
				  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * addguestList
   */
  public function booktable() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product','prices','product_images','terms_conditions','user_id','booking_days');
		  if (!empty($jsonRequest)) { 
		  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product =    $jsonRequest['product'];
					  $this->prices = $jsonRequest['prices'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $terms_conditions = (object)$jsonRequest['terms_conditions'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->booking_days = $jsonRequest['booking_days'];
					  $this->status = 1;
					  $subtitle = '';
					  $product = (object)$this->product;//product
					  $images = explode(",", $this->product_images->images);
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  
					  /*product*/	
					  $stmt = $this->conn->prepare("INSERT INTO product(name,category_id,highlights,closed_date, tags, 
					 description,booking_days, artist_info, uid,status) VALUES (?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssssssssss", $product->name, $product->category_id,$product->highlights, $product->closed_date,
						  $product->tags, $product->description,$this->booking_days, $product->artist_info, $this->user_id, $this->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   $product_id = $this->conn->insert_id; 
					  $i=0;
					  foreach($this->prices as $key=>$rate) {
						  /*get price id*/
						 $EventResult = array();
						   $stmt = $this->conn->prepare("SELECT `id` FROM `product_book_a_table_categories` WHERE name=? and status=1") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("s", $key) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->store_result();
						  $meta = $stmt->result_metadata();
						  while ($field = $meta->fetch_field()) {
							  $parameters[] = &$row[$field->name];
						  }
						  call_user_func_array(array($stmt, 'bind_result'), $parameters);
						  $res = array();
						  while ($stmt->fetch()) {
							  foreach ($row as $key => $val) {
								  $res[$key] = $val;
							  }
							  $EventResult[] = $res;   
							  if(count($EventResult)>0){
								  
							 $id = $EventResult[0]['id']; 
							  $stmt = $this->conn->prepare("INSERT INTO `product_book_a_table`(`pid`, `price`, `category_id`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
							  $stmt->bind_param("sss", $product_id, $rate, $id) or trigger_error($stmt->error, E_USER_ERROR);
							  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
							  }
						  }
						  
					  }
					  
					 /*product_gallery*/
					  foreach ($images as $image) {
						  $type = $this->product_images->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",  $product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*terms&conditions*/
					   foreach ($terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",  $product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  
					  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					  }
					  /*end*/
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * bookbottle
   */
  public function bookbottle() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId',"category_id",'product','bottle_info','product_images','terms_conditions','user_id','booking_days');
		  if (!empty($jsonRequest)) {
				if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product = $jsonRequest['product'];
					  $bottle_info = $jsonRequest['bottle_info'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $this->terms_conditions = $jsonRequest['terms_conditions'];
					  $this->category_id  = $jsonRequest['category_id'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status =1;
					  $this->booking_days = $jsonRequest['booking_days'];
					  $subtitle = '';
					  $product = (object)$this->product;//product
					  $images = explode(",", $this->product_images->images);
					  $terms_conditions = explode(",",  $this->terms_conditions['terms_conditions']); 	
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 
					  /*product*/
					  $stmt = $this->conn->prepare("INSERT INTO `product`(name,`category_id`,`highlights`,`tags`, 
					  `description`, `artist_info`,booking_days,`uid`,`status`) VALUES (?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("sssssssss",$product->name, $product->category_id,  $product->highlights,
						  $product->tags, $product->description, $product->artist_info,$this->booking_days, $this->user_id, $this->status) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   $product_id = $this->conn->insert_id; 
					  /*start*/
					  for($i=0;$i<count($bottle_info['name']);$i++){
						  //echo "INSERT INTO `product_book_a_bottle`(`pid`, `name`, `price`, `actual_price`)
						  //VALUES ($product_id,'".$bottle_info['name'][$i]."',".$bottle_info['price'][$i].",". $bottle_info['actual_price'][$i].")";echo"<br>";
						  $stmt = $this->conn->prepare("INSERT INTO `product_book_a_bottle`(`pid`, `name`, `price`, `actual_price`) VALUES (?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ssss", $product_id, $bottle_info['name'][$i],$bottle_info['price'][$i], $bottle_info['actual_price'][$i]) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  }
						 // print_r($images); exit;
					 /*upload images*/
					  foreach ($images as $image) {
						  $type = $this->product_images->type;
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss", $product_id, $image, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*terms&conditions*/
					   foreach ($terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss", $product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
										  
					  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *getUser Details
   */			
   public function tableDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'productId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->productId = $jsonRequest['productId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name , p.address, p.highlights, p.closed_date, p.tags,p.description, p.artist_info,p.uid,
													 bt.price,bt.id AS table_id 
													 FROM product p 
													 JOIN product_book_a_table bt ON p.id = bt.pid AND p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->productId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['tableDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *getUser Details
   */			
   public function bottleDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'productId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->productId = $jsonRequest['productId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name , p.address, p.highlights, p.closed_date, p.tags,p.description, p.artist_info,p.uid,pim.image,
												 pim.id AS image_id, bb.name AS bottle_name,bb.price,bb.actual_price,bb.id AS bottle_id 
												 FROM product p 
												 LEFT JOIN product_book_a_bottle bb ON bb.pid = p.id 
												 LEFT JOIN product_images pim ON pim.pid = p.id 
												 WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->productId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'User exists.';
						  $response['error'] = false;
						  $response['bottleDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "User doesn't Exits.";
						  $response['error'] = true;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * bookEntry
   */
  public function bookentry() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product','entry_info','terms_conditions','user_id',"product_images",'booking_days');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					   $this->product = $jsonRequest['product'];
					   $entry_info = $jsonRequest['entry_info'];
					   $this->product_images = $jsonRequest['product_images']; 
					   $this->terms_conditions = $jsonRequest['terms_conditions'];
					   $this->user_id = $jsonRequest['user_id'];
					   $this->booking_days = $jsonRequest['booking_days'];
					   $this->status = 1;
					   $product = (object)$this->product;
					   $db = new INNOCHAT\APIBaseController();
					   $this->conn = $db->connect();
					   
					   $stmt = $this->conn->prepare("INSERT INTO `product`(`category_id`, `name`,`highlights`, `tags`, 
					  `description`, booking_days,`artist_info`, `uid`,`status`,closed_date) VALUES (?,?,?,?,?,?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssssssssss", $product->category_id,$product->name,$product->highlights, $product->tags, $product->description,$this->booking_days,$product->artist_info, 
					  $this->user_id, $this->status,$product->closed_date) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $product_id = $this->conn->insert_id; 
					  
					  /*start*/
					   for($i=0;$i<count($entry_info['price']);$i++){
						//echo"INSERT INTO `product_entry`(`pid`, `name`, `price`, `description`,event_date)
						//VALUES ($product_id,'".$entry_info['name'][$i]."',".$entry_info['price'][$i].",'".$entry_info['description'][$i]."',".
						$entry_info['event_date'][0].")";						   
						$stmt = $this->conn->prepare("INSERT INTO `product_entry`(`pid`, `name`, `price`, `description`,event_date)VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sssss", $product_id, $entry_info['name'][$i], $entry_info['price'][$i], $entry_info['description'][$i],$entry_info['event_date'][0]) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);					
										  }
										
										 
					  /*terms&conditions*/
					   foreach ($this->terms_conditions as $term) {
						  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss", $product_id,$term) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  /*product_gallery*/
						  $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss", $product_id, $this->product_images['images'], $this->product_images['type']) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  if (!$stmt) {
						  $response['message'] = 'Reigstratioin Failed Please Try Again.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Registration Success.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get artist etails
   */
   public function bookentryDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId', 'partnerId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $this->partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /**/
					  /**SELECT p.id AS product_id,pe.id, p.name AS productname, p.address AS product_address, p.highlights AS speciality, p.location AS location, p.closed_date,
					  p.tags,p.description, p.artist_info,p.uid,GROUP_CONCAT(pe.id SEPARATOR ',')AS peid,GROUP_CONCAT(pe.price SEPARATOR ',') AS peprice,
					  GROUP_CONCAT(pe.description SEPARATOR ',')AS pedescription, GROUP_CONCAT(pe.name SEPARATOR ',') AS pename,GROUP_CONCAT(pimg.image SEPARATOR ',') AS images ,
					  GROUP_CONCAT(pt.discription SEPARATOR ',') AS terms,pe.event_date
					  FROM product p 
					  LEFT JOIN product_entry pe ON pe.pid = p.id
					  LEFT JOIN product_images pimg ON pimg.pid = p.id
					  LEFT JOIN product_deals_offers pdf ON pdf.pid = p.id
					  LEFT JOIN product_terms pt ON pt.pid = p.id
					  WHERE p.uid=? GROUP BY pe.id
					  **/
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id,pe.id, p.name AS productname, p.address AS product_address, p.highlights AS speciality, p.location AS location, p.closed_date,
					  p.tags,p.description AS product_description, p.artist_info,p.uid,pe.id,pe.price,
					  pe.description ,pe.name,pimg.image,
					  GROUP_CONCAT(pt.discription SEPARATOR ',') AS terms,pe.event_date,pp.facilities,pp.dress_code,pp.music_genere
					  FROM product p 
					  INNER JOIN product_entry pe ON pe.pid = p.id
					  LEFT JOIN product_images pimg ON pimg.pid = p.id					
					  LEFT JOIN product_deals_offers pdf ON pdf.pid = p.id
					  LEFT JOIN product_terms pt ON pt.pid = p.id
					  LEFT JOIN users  u ON u.id = p.uid
					  LEFT JOIN partner_profile pp ON pp.createdby = u.id
					  WHERE p.uid=? GROUP BY pe.id") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $this->partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'Entry exists.';
						  $response['error'] = FALSE;
						  $response['entryDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = "Entry doesn't Exits.";
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *Product update 
  */ 
  public function updatebookEntry() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  			  $acceptedArray = array('clientId','entry_info','product_id','user_id','entryids');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					$this->user_id    = $jsonRequest['user_id']; 
					  $this->product_id = $jsonRequest['product_id']; 
					  $this->entry_info       = $jsonRequest['entry_info'];
					  $this->entryids       = $jsonRequest['entryids'];					  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					
                   for($i=0; $i<count($this->entry_info['price']);$i++){
					//echo"UPDATE product_entry SET  name = '".$this->entry_info['name'][$i]."',price =".$this->entry_info['price'][$i].",description = '".$this->entry_info['description'][$i]."'  WHERE id="..""; echo"<br>";
					  $stmt = $this->conn->prepare("UPDATE product_entry SET  name = ?,price = ?,description = ?  WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssss",$this->entry_info['name'][$i],$this->entry_info['price'][$i],$this->entry_info['description'][$i],$this->entryids[$i])or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  }
					  $response = array();
				  if ($stmt->affected_rows == 1) {
									$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
							} else {
								  $error  =False;
								  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
				  $stmt->close();
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
				} else {
			  parent::badRequest();
		  }
	  }		
  /*
   *get All entry
   */	
  public function allDeals() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("select p.id, p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, p.artist_info,p.uid,
						pi.image 
						from product p inner join product_images pi 
						on p.id= pi.pid 
						and p.category_id=1") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  //$stmt->bind_param("ss", $this->email, $this->password) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
  
  /*
   *get All entry
   */	
  public function allentry() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("select p.id, p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, p.artist_info,p.uid,
						pi.image 
						from product p inner join product_images pi 
						on p.id= pi.pid 
						and p.category_id=7") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  //$stmt->bind_param("ss", $this->email, $this->password) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get All Package
   */	
  public function allPackages() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("select p.id, p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, p.artist_info,p.uid, pi.image from product p inner join product_images pi where p.id= pi.pid and p.category_id=6") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					   $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
  /*
   *get All Book Bottle
   */	
  public function allBookbottle() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					   $productId = $jsonRequest['prodcutId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("SELECT pb.id ,p.id AS productid , p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, 
													  p.artist_info,p.uid, pi.image ,u.image,u.id AS userid,u.name AS username
													  FROM product p 
													  INNER JOIN users u ON u.id = p.uid
													  LEFT  JOIN `product_book_a_bottle` pb ON  p.id = pb.pid  
													  LEFT JOIN product_images PI ON pi.id= p.id AND  p.status=1 AND p.uid=?") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$productId) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get All Book Table
   */	
  public function allBookTable() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','user_id');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $user_id = $jsonRequest['uid'];
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("SELECT pb.price ,p.id AS productid , p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, 
													  p.artist_info,p.uid, pi.image ,u.image,u.id AS userid,u.name AS username
													  FROM product p 
													  INNER JOIN users u ON u.id = p.uid
													  LEFT  JOIN product_book_a_table pb ON  p.id = pb.pid  
													  LEFT JOIN product_images PI ON pi.id= p.id AND  p.status=1 and p.uid=? ") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$user_id) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
   *guest list
   */
   public function getGuestlist() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $user_id = $jsonRequest['productId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name AS productname, p.address AS product_address, p.highlights AS speciality, p.location AS location, p.closed_date,
													  p.tags,p.description, p.artist_info,
													  pg.id, pg.name, pg.event_date_time,pg.price, pg.actual_price
													  FROM product p 
													  LEFT JOIN product_guest_list pg ON pg.pid = p.id
													  LEFT JOIN product_images pim ON pim.pid = p.id
													  WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $user_id) or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  
  /*
   *get All Guest List
   */	
  public function allGuestlist() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','user_id');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $user_id = $jsonRequest['user_id'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("SELECT pg.id ,p.id AS productid , p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, 
					  p.artist_info,p.uid, pi.image ,u.image,u.id AS userid,u.name AS username
					  FROM product p 
					  INNER JOIN users u ON u.id = p.uid
					  LEFT  JOIN product_guest_list pg ON  p.id = pg.pid  
					  LEFT JOIN product_images PI ON pi.id= p.id AND  p.status=1 AND p.uid=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s", $user_id) or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
	  /*
   *get All surprise
   */	
  public function allSurprises() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','user_id');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $user_id = $jsonRequest['user_id'];
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  if($user_id==0){
						  $stmt = $this->conn->prepare("SELECT ps.id ,p.id AS productid , p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, 
													  p.artist_info,p.uid, pi.image ,u.image,u.id AS userid,u.name AS username
													  FROM product p 
													  INNER JOIN users u ON u.id = p.uid
													  LEFT  JOIN product_surprise ps ON  p.id = ps.pid  
													  LEFT JOIN product_images PI ON pi.id= p.id AND  p.status=1 ") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  //$stmt->bind_param("s", $user_id) or trigger_error($stmt->error, E_USER_ERROR);
						  
						  
						  }else{
					   $stmt = $this->conn->prepare("SELECT ps.id ,p.id AS productid , p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags, p.description, 
													  p.artist_info,p.uid, pi.image ,u.image,u.id AS userid,u.name AS username
													  FROM product p 
													  INNER JOIN users u ON u.id = p.uid
													  LEFT  JOIN product_surprise ps ON  p.id = ps.pid  
													  LEFT JOIN product_images PI ON pi.id= p.id AND  p.status=1 and p.uid = ? ") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s", $user_id) or trigger_error($stmt->error, E_USER_ERROR);
									 }
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
   *get All Deal&Offers
   */	
  public function product_list() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','user_id','category_id');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->user_id = $jsonRequest['user_id'];
					  $this->category_id = $jsonRequest['category_id'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  if($this->user_id==0){
							  $stmt = $this->conn->prepare("SELECT p.id AS productid , p.name,p.category_id, p.address,p.status, 								                                            p.highlights, p.location, p.closed_date, p.tags, p.description,u.address AS uaddress,
														  p.artist_info,p.uid, pimg.image ,u.image as uimage,u.id AS userid,u.name AS username
														  FROM product p 
														  INNER JOIN users u ON u.id = p.uid
														  LEFT JOIN product_images pimg ON pimg.pid= p.id  
														  WHERE p.status=1 AND p.category_id=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);		
							  $stmt->bind_param("s", $this->category_id) or trigger_error($stmt->error, E_USER_ERROR);
						  }else{
							  $stmt = $this->conn->prepare("SELECT p.id AS productid , p.name,p.category_id, p.address,p.status, 
											  p.highlights, p.location, p.closed_date, p.tags, p.description, 
											  p.artist_info,p.uid, pimg.image ,u.image as uimage,u.id AS userid,u.name AS username
											  FROM product p 
											  INNER JOIN users u ON u.id = p.uid
											  LEFT JOIN product_images pimg ON pimg.pid= p.id  
											  WHERE p.status=1 AND  p.uid=? AND p.category_id=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);
							  $stmt->bind_param("ss",$this->user_id,$this->category_id) or trigger_error($stmt->error, E_USER_ERROR);
						  }
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  
  /*
   *get All entry
   */	
  public function getproductDetails() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					   $product_id = $jsonRequest['productId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT pdf.id, CONCAT(pi.id,',',pi.image)AS images ,CONCAT(pt.id,',',pt.discription) AS terms ,CONCAT(pr.id,',',pr.rating,',',pr.review) AS reviews,pdf.about_deal,pdf.end_date_time,pdf.id,pdf.name,pdf.price,pdf.start_date_time,pdf.subtitle,pdf.tags,pdf.type
												  ,p.name,p.category_id,p.address,p.artist_info,p.closed_date,p.created,p.description,p.highlights,p.tags
												  FROM product_deals_offers pdf 
												  LEFT JOIN product_images PI ON pi.pid = pdf.pid
												  LEFT JOIN product_reviews pr ON pr.pid = pdf.pid
												  LEFT JOIN product_terms  pt ON pt.pid = pdf.pid
												  LEFT JOIN product_videos pv ON pv.pid = pdf.pid
												  LEFT JOIN product p ON p.id = pdf.pid
												  WHERE pdf.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s", $product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  
  /*
   *get All entry
   */	
  public function getproductMedia() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $product_id = $jsonRequest['productId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("select pi.id as image_id,pi.image,pi.type,pv.id as video_id ,pv.url, pt.id as term_id ,pt.discription,pr.id as review_id,pr.review,pr.rating
												  from product_images pi
												  inner join product_videos pv on pv.pid = pi.pid
												  inner join product_terms pt on pt.pid = pi.pid
												  inner join product_reviews pr  on pr.pid = pi.pid
												  where pi.pid =? and pr.status=1 
												   ") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s", $product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
  /*
  *get products by partners id
  */
  public function dealsByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id,p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
														pdf.id,pdf.type,pdf.name,pdf.start_date_time,pdf.`end_date_time`,
														pdf.price,pdf.`subtitle` , pdf.tags ,
														pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc,pp.`partner_pic`,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,pp.facilities,pp.dress_code,pp.music_zoner
														FROM product p
														INNER JOIN  product_deals_offers  pdf ON pdf.pid = p.id
														INNER JOIN partner_profile pp ON pp.createdby = p.uid
														LEFT JOIN  product_terms pt ON pt.pid=p.id
														WHERE p.status=1 AND p.uid=? GROUP BY pdf.id") or 
														trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
/*
 *surprise
 */	  
  public function surpriseByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id,p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,GROUP_CONCAT(ps.id) AS ps_ids,GROUP_CONCAT(ps.`category_id`) AS
					ps_catids,GROUP_CONCAT(psc.`name`) AS ps_catnames,GROUP_CONCAT(ps.price) AS ps_price,GROUP_CONCAT(ps.price2) AS ps_price2,
					GROUP_CONCAT(ps.price3) AS ps_price3,GROUP_CONCAT(ps.price) AS ps_price,GROUP_CONCAT(ps.`description` SEPARATOR ';') AS 
					ps_desc ,GROUP_CONCAT(ps.note SEPARATOR ';') AS ps_notes,pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` 
					AS partner_address,pp.`description` AS partner_desc,pp.`partner_pic`,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') 
					AS terms,pp.facilities,pp.dress_code,pp.music_zoner
													FROM product p
													INNER JOIN `product_surprise` ps ON ps.pid=p.id
													INNER JOIN `product_surprise_categories` psc ON psc.`id`=ps.`category_id`
													INNER JOIN `partner_profile` pp ON pp.createdby=p.uid
													LEFT  JOIN `product_terms` pt ON pt.pid=p.id
													WHERE p.status=1 AND p.uid=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	

  /*
  *get products by partners id
  */
  public function bottleByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();

					  $stmt = $this->conn->prepare("SELECT p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
					GROUP_CONCAT(DISTINCT pbb.id) AS pbb_ids,GROUP_CONCAT(pbb.name) AS pbb_name,GROUP_CONCAT(pbb.price) AS pbb_price,GROUP_CONCAT(pbb.`actual_price`) AS pbb_actual_price,pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc, pp.`partner_pic`,pimg.image AS product_img,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,pp.facilities,pp.dress_code,pp.music_zoner
					FROM product p
					INNER JOIN `product_book_a_bottle` pbb ON pbb.pid=p.id
					INNER JOIN `partner_profile` pp ON pp.createdby=p.uid
					INNER JOIN `product_images` pimg ON pimg.pid=p.id
					LEFT JOIN `product_terms` pt ON pt.pid=p.id
					WHERE p.status=1 AND p.uid=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
  *get products by partners id
  */
  public function guestlistByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
														pgl.name AS guest_list_name,`event_date_time`,`price`,`actual_price`,
														pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc,pp.`partner_pic`,pp.`location`,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,pp.facilities,pp.dress_code,pp.music_zoner
														FROM product p
														INNER JOIN `product_guest_list` pgl ON pgl.pid=p.id
														INNER JOIN `partner_profile` pp ON pp.createdby=p.uid
														LEFT  JOIN `product_terms` pt ON pt.pid=p.id
														WHERE p.status=1 AND p.uid=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
	  
  /*
  *get products by partners id
  */
  public function booktableByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					
					  $stmt = $this->conn->prepare("SELECT p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
													GROUP_CONCAT(pbt.id) AS pbt_ids,GROUP_CONCAT(pbt.`category_id`) AS pbt_catids,GROUP_CONCAT(pbtc.`name`) AS pbt_catnames,p.tags,
													GROUP_CONCAT(pbt.price) AS ps_price,
													pp.`Name` AS partner_name,pp.Title AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc,pp.`partner_pic`,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,
													pp.facilities,pp.dress_code,pp.music_zoner
													FROM product p
													INNER JOIN product_book_a_table pbt ON pbt.pid=p.id
													INNER JOIN product_book_a_table_categories pbtc ON  pbtc.id=pbt.category_id
													INNER JOIN partner_profile pp ON pp.createdby=p.uid
													LEFT  JOIN `product_terms` pt ON pt.pid=p.id
													WHERE p.status=1 AND p.uid=? GROUP BY p.id
													") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }

 /*
  *get products by partners id
  */
  public function packageByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
													GROUP_CONCAT(pps.id) AS pps_ids,GROUP_CONCAT(pps.`category_id`) AS pps_catids,GROUP_CONCAT(ppc.`name`) AS ppc_catnames,
													GROUP_CONCAT(pps.price) AS ps_price,GROUP_CONCAT(pps.tags SEPARATOR ';') AS pps_tags,GROUP_CONCAT(pps.description SEPARATOR ';') AS pps_desc,
													pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc,pp.`partner_pic`,pp.`location`,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,pp.facilities,pp.dress_code,pp.music_zoner
													FROM product p
													INNER JOIN `product_packages` pps ON pps.pid=p.id
													INNER JOIN `product_package_categories` ppc ON  ppc.id=pps.`category_id`
													INNER JOIN `partner_profile` pp ON pp.createdby=p.uid
													LEFT JOIN `product_terms` pt ON pt.pid=p.id
													WHERE p.status=1 AND p.uid=? GROUP BY p.id
													") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	  
  /*
  *get products by partners id
  */
  public function bookbottleByPartner() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','partnerId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $partnerId = $jsonRequest['partnerId'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.name,p.`category_id`,p.`highlights`,p.`description`,p.`artist_info`,
					GROUP_CONCAT(DISTINCT pbb.id) AS pbb_ids,GROUP_CONCAT(pbb.name) AS pbb_name,GROUP_CONCAT(pbb.price) AS pbb_price,GROUP_CONCAT(pbb.`actual_price`) AS pbb_actual_price,pp.`Name` AS partner_name,pp.`Title` AS partner_title,pp.`Address` AS partner_address,pp.`description` AS partner_desc, pp.`partner_pic`, pp.`location`, pimg.image AS product_img,GROUP_CONCAT(DISTINCT pt.discription SEPARATOR ';') AS terms,pp.facilities,pp.dress_code,pp.music_genere
					FROM product p
					INNER JOIN `product_book_a_bottle` pbb ON pbb.pid=p.id
					INNER JOIN `partner_profile` pp ON pp.createdby=p.uid
					INNER JOIN `product_images` pimg ON pimg.pid=p.id
					LEFT JOIN `product_terms` pt ON pt.pid=p.id
					WHERE p.status=1 AND p.uid=? GROUP BY p.id") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s",$partnerId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*---------------------------------------------product start----------------------------------------------*/
  /*
   * get product by category
   */
  public function productByCategory() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("select p.id, p.name,p.category_id, p.address, p.highlights, p.location, p.closed_date, p.tags,
					   p.description, p.artist_info,p.uid, pi.image,pc.name as category_name,pc.images from product 
					   p inner join product_images pi inner join product_categories pc where p.category_id = pc.id
					   and p.id = pi.pid group by p.category_id") or trigger_error($this->conn->error, E_USER_ERROR);
  
					  //$stmt->bind_param("ss", $this->email, $this->password) or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  $stmt->store_result();
  
					  $meta = $stmt->result_metadata();
  
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['ProductDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *modifyDeal
  */
  public function modifyDeal() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		 $acceptedArray = array('clientId','deal_id','name','highlights','price','start_date_time','end_date_time','tags','about_deal');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->deal_id          = $jsonRequest['deal_id'];
					  $this->name             = $jsonRequest['name']; 
					  $this->highlights       = $jsonRequest['highlights']; 
					  $this->price            = $jsonRequest['price']; 
					  $this->start_date_time  = $jsonRequest['start_date_time']; 
					  $this->end_date_time    = $jsonRequest['end_date_time'];
					  $this->tags             = $jsonRequest['tags'];
					  $this->about_deal       = $jsonRequest['about_deal'];  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("UPDATE product_deals_offers SET name =?,subtitle =?,price =?,start_date_time =?,end_date_time =?,tags =?,about_deal =? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssssssss", $this->name,$this->highlights,$this->price,$this->start_date_time,
					  $this->end_date_time,$this->tags,$this->about_deal,$this->deal_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $response = array();
				  if ($stmt->affected_rows == 1) {
									$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
							} else {
								  $error  =False;
								  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
				  $stmt->close();
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
				} else {
			  parent::badRequest();
		  }
	  }
	  /*product end*/
	  
  /*
   * addsurprisecategories
   */
  public function surprisemodify() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId','product','surprise_products','product_images','product_gallery','user_id');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product = $jsonRequest['product'];
					  $this->surprise_products = $jsonRequest['surprise_products'];
					  $this->product_images = (object)$jsonRequest['product_images'];
					  $this->product_gallery = (object)$jsonRequest['product_gallery'];
					  $this->user_id = $jsonRequest['user_id'];
					  $this->status = 0;
					  $subtitle = '';
					  $product = (object)$this->product;//product
					  $images = explode(",", $this->product_images->images);
					  $gallery = explode(",", $this->product_gallery->images);
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  /*start*/
					 foreach($this->surprise_products as $product){
						 $product = (object)$product; //
						 $stmt = $this->conn->prepare("INSERT INTO `product_surprise`(`pid`, `category_id`, `price`, `description`, `note`) VALUES (?,?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						 $stmt->bind_param("sssss", $product_id, $product->category_id, $product->price, $product->description, $product->note) or trigger_error($stmt->error, E_USER_ERROR);
						 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
						  $product_id = $this->conn->insert_id; 
					 }
  
					 
  
				  if (!$stmt) {
					  $response['message'] = 'Reigstratioin Failed Please Try Again.';
					  $response['error'] = TRUE;
					  parent::echoRespnse(200, $response);
				  }else{
					  $response['message'] = 'Registration Success.';
					  $response['error'] = FALSE;
					  $response['validUserDetails'] = "valid";
					  parent::echoRespnse(200, $response);
				  }
  
					  /*end*/
  
  
				  }else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
/*
 *get review /comments
 */	
public function getreviews(){
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId'); //changed from productId to userId
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					   $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT pr.id, pr.uid,pr.rating,pr.review,pr.status,pr.created,u.image,u.name
														FROM  product_reviews pr 
														LEFT JOIN users u ON u.id = pr.uid
														WHERE  pr.id IS NOT NULL") or trigger_error($this->conn->error, E_USER_ERROR);
					 $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['reviews'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
   /*
   *get review /comments
   */	
public function allreviews(){
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','userId'); //changed from productId to userId
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->userId = $jsonRequest['userId'];
					   $db = new INNOCHAT\APIBaseController();
					   $this->conn = $db->connect();
					   $stmt = $this->conn->prepare("SELECT pp.name,pp.title,pp.address,pp.description,pp.partner_pic,pp.location, GROUP_CONCAT(DISTINCT pim.image SEPARATOR ';') AS gallery, GROUP_CONCAT(pv.url SEPARATOR ',') AS videos,GROUP_CONCAT(pr.id SEPARATOR ',') AS prids,GROUP_CONCAT(pr.rating SEPARATOR ',') AS ratings ,GROUP_CONCAT(pr.review SEPARATOR  ';') AS review,GROUP_CONCAT(ua.name SEPARATOR ',') AS review_name,GROUP_CONCAT(ua.image SEPARATOR ';') AS review_img,GROUP_CONCAT(pr.created SEPARATOR ',') AS dates
						FROM users u
						INNER JOIN partner_profile pp ON pp.createdby = u.id
						LEFT JOIN  product_images pim ON pim.pid = u.id AND pim.type=2
						LEFT JOIN  product_videos pv ON pv.pid = u.id 
						LEFT JOIN  product_reviews pr ON pr.pid = u.id
						LEFT JOIN  users ua ON ua.id = pr.uid
						WHERE pp.createdby =?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("s",$this->userId) or trigger_error($stmt->error, E_USER_ERROR);
						  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['reviews'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
/*
 *get review /comments
 */	
  public function gettermsConditions(){
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['productId'];
					   $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT pt.id,pim.id AS imageid, pt.pid,pt.discription,p.id AS product_id,pim.image
													  FROM  product p
													  LEFT JOIN product_images pim ON pim.pid = p.id
													  LEFT JOIN product_terms pt ON p.id= pt.pid
													  WHERE  p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s", $this->product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['terms'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   *get artist etails
   */
  public function productStatus() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId','status');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->userid = $jsonRequest['productId'];
					 $this->status = $jsonRequest['status'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  if($this->status==0){
						 // echo"UPDATE `product` SET  `status`=1  WHERE id=$this->userid";
						  $stmt = $this->conn->prepare("UPDATE `product` SET  `status`=?  WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss", $this->status,$this->userid) or trigger_error($stmt->error, E_USER_ERROR);
					  }else{
						 // echo"UPDATE `product` SET  `status`=0  WHERE id=$this->userid";
					  $stmt = $this->conn->prepare("UPDATE `product` SET  `status`=0  WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ss", $this->status,$this->userid) or trigger_error($stmt->error, E_USER_ERROR);
                      }			//exit;		 
					 
					  $stmt->execute();
					  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
				  } else {
						 $response['error']  =False;
				  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
  
				  $stmt->close();
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }	
  /*
   *delete user Data
   */
   public function productDelete() {
			   $jsonRequest = json_decode($this->requestObj, TRUE);
				  $acceptedArray = array('clientId','productId');
					if (!empty($jsonRequest)) {
					  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
						if (parent::checkClientId($jsonRequest['clientId'])) {
							   $productId   = $jsonRequest['productId'];
								$db = new INNOCHAT\APIBaseController();
							   $this->conn = $db->connect();
					$stmt = $this->conn->prepare("DELETE FROM `product` WHERE  id= ?") or trigger_error($this->conn->error, E_USER_ERROR);
  
			   $stmt->bind_param("s",$productId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute();
							  $response = array();
				  if ($stmt->affected_rows == 1) {
					$error  = True;
									$response['message'] = "successfully deleted";
									 parent::echoRespnse(200, $response);
				  } else {
								  $error  =False;
				  $response['message']   = 'user Deltetion Failed';
								  parent::echoRespnse(200, $response);
				  }
				  $stmt->close();
					  }else{
			  parent::badRequest();    
			   }
			  }else{
				  parent::badRequest();    
			  }
	  }else{
		  
		  parent::badRequest();
		  
	  }
		  }	
  /*
   *get All entry
   */	
  public function getDealsoffers() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
				   $product_id = $jsonRequest['productId'];  
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name AS productname, p.address AS product_address, p.highlights AS speciality, p.location AS location, p.closed_date,
												  p.tags,p.description, p.artist_info,pdf.id, pdf.name, pdf.type,pdf.subtitle, pdf.price,pdf.start_date_time,pdf.end_date_time, pdf.tags,
												  pdf.about_deal,pim.id as imageid,pim.image
												  FROM product p 
												  LEFT JOIN product_deals_offers pdf ON pdf.pid = p.id
												  LEFT JOIN product_images pim ON pim.pid = p.id
												  WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					  $stmt->bind_param("s", $product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }		
  /*
   *get All entry
   */	
  public function getsurprises() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','productId');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
				   $productId = $jsonRequest['productId']; 
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name , p.address, p.highlights, p.closed_date, p.tags,p.description AS prdescription, p.artist_info,p.uid,
													pim.image,pim.id AS image_id, ps.id AS surprise_id ,ps.price,ps.price2,ps.price3,ps.description,ps.note,ps.category_id 
													FROM product p 
													LEFT JOIN product_surprise ps ON ps.pid = p.id 
													LEFT JOIN product_images pim 
													ON pim.pid = p.id 
													WHERE p.id=?") or trigger_error($this->conn->error, E_USER_ERROR);
														 
					  $stmt->bind_param("s", $productId) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
  *Product update 
  */ 
  public function updateItem() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
          
		  $acceptedArray = array('clientId','product_id','name','highlights','closed_date','tags','description','artist_info','product_images','product_terms');
		  if (!empty($jsonRequest)) {
				if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->product_id = $jsonRequest['product_id'];  
					  $this->name       = $jsonRequest['name']; 
					  $this->highlights = $jsonRequest['highlights']; 
					  $this->closed_date= $jsonRequest['closed_date'];
					  $this->tags       = $jsonRequest['tags'];  
					  $this->description= $jsonRequest['description'];
					  $this->artist_info = $jsonRequest['artist_info'];
					  $this->product_images = $jsonRequest['product_images']['images'];
					  $this->product_type = $jsonRequest['product_images']['type'];
					  $this->imageId      = $jsonRequest['product_images']['id'];  
					  $this->product_terms = $jsonRequest['product_terms']['terms'];
					  $this->term_id = $jsonRequest['product_terms']['id'];
					
				     /* echo"UPDATE `product` SET name = '$this->name',highlights = '$this->highlights',closed_date = '$this->closed_date',tags= '$this->tags',description= '$this->description',
					     artist_info= '$this->artist_info' WHERE id=$this->product_id"; exit; */
				 					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 $stmt = $this->conn->prepare("UPDATE `product` SET name = ?,highlights = ?,closed_date = ?,tags=?,description=?,
					  artist_info=? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("sssssss", $this->name,$this->highlights,$this->closed_date,$this->tags,$this->description,$this->artist_info,$this->product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					   if($this->product_images){ 
					  
					     if(is_array($this->imageId)){ $this->imageId= $this->imageId[0]; } 
						
					  if($this->imageId){ 
					 // echo "UPDATE `product_images` SET `image`= '".$this->product_images[0]."' WHERE id=,$this->imageId"; exit;
					      $stmt = $this->conn->prepare("UPDATE `product_images` SET `image`= ? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("ss",$this->product_images[0],$this->imageId ) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					 }else{ 
						  $type=1;
						//echo"INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES ($this->product_id,'$this->product_images',$type)"; exit;
					      $stmt = $this->conn->prepare("INSERT INTO `product_images`(`pid`, `image`, `type`) VALUES (?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
						  $stmt->bind_param("sss",$this->product_id, $this->product_images, $type) or trigger_error($stmt->error, E_USER_ERROR);
						  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);	
					  } 
					    }//exit;
					  for($i=0;$i<count($this->product_terms);$i++){
						  if($this->term_id[$i]){
						   //echo"UPDATE product_terms SET  discription= '".$this->product_terms[$i]."' WHERE id=".$this->term_id[$i].""; echo"<br>";
								$stmt = $this->conn->prepare("UPDATE `product_terms` SET  `discription`= ? WHERE id=?") or trigger_error($this->conn->error, E_USER_ERROR);
								  $stmt->bind_param("ss", $this->product_terms[$i], $this->term_id[$i]) or trigger_error($stmt->error, E_USER_ERROR);
								  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
							}else{
								//echo"INSERT INTO `product_terms`(`pid`, `discription`) VALUES ($this->product_id,'".$this->product_terms[$i]."')"; echo"<br>";
							  $stmt = $this->conn->prepare("INSERT INTO `product_terms`(`pid`, `discription`) VALUES (?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
								  $stmt->bind_param("ss", $this->product_id,$this->product_terms[$i]) or trigger_error($stmt->error, E_USER_ERROR);
								  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);

							}
						}  
						
					   $response = array();
				  if ($stmt->affected_rows == 1) {
									$error  = True;
									$response['results'] = "successfully updated";
									 parent::echoRespnse(200, $response);
							} else {
								  $error  =False;
								  $response['results']   = 'updation failure';
								  parent::echoRespnse(200, $response);
				  
				  }
				  $stmt->close();
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
				} else {
			  parent::badRequest();
		  }
	  }		
	  
  /**front**/
  public function  homesearch() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','search');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->search = explode(',',$jsonRequest['search']);   //city,venue,search
					 $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("SELECT p.id AS product_id, p.name , p.address, p.highlights, p.closed_date,
															  p.tags,p.description AS prdescription, p.artist_info,p.uid
															  FROM product p 
															  LEFT JOIN users u ON p.uid = u.id
															  WHERE u.address LIKE  :city AND  p.name LIKE :name AND p.category_id= :id") or trigger_error($this->conn->error, E_USER_ERROR);
														 
					  $stmt->bindValue(1, "'%$this->search[0]%'", PDO::PARAM_STR);
					  $stmt->bindValue(2, "'%$this->search[1]%'", PDO::PARAM_STR);
					  $stmt->bindValue(3, "'%$this->search[2]%'", PDO::PARAM_STR);
					  $stmt->execute(array(':city' => '%'.$this->search[0].'%',':name' => '%'.$this->search[1].'%',':id'=>$this->search[2]));		
					 // $stmt->bind_param("sss",$this->search[0],$this->search[1],$this->search[2]) or trigger_error($stmt->error, E_USER_ERROR);
  //                    $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*autosuggest*/
  public function  citysearch() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','city');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					 $this->city = $jsonRequest['city'];  //city,venue,search
				   
				   $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("select address from users where address like '%".$this->city."%'") or trigger_error($this->conn->error, E_USER_ERROR);
					  // $stmt->bind_param("sss",$this->search[0],$this->search[1],$this->search[2]) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'City Are Available.';
						  $response['error'] = FALSE;
						  $response['citys'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Data Is Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  /*
   * users Comment
   */
  public function comment() {
		  $jsonRequest = json_decode($this->requestObj, TRUE);
		  $acceptedArray = array('clientId', 'name','email','phone','comment');
		  if (!empty($jsonRequest)) {
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  $this->name = $jsonRequest['name'];
					  $this->email  = $jsonRequest['email']; 					
					  $this->phone  =  $jsonRequest['phone'];
					  $this->comment    = $jsonRequest['comment'];
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					  $stmt = $this->conn->prepare("INSERT INTO `comment`( `name`, `email`, `phone`, `comment`) VALUES (?,?,?,?)") or trigger_error($this->conn->error, E_USER_ERROR);
					  $stmt->bind_param("ssss", $this->name, $this->email,$this->phone,$this->comment) or  trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
  
					  //$stmt->store_result();
					  if (!$stmt) {
						 $response['message'] = 'Posting Failed.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }else{
						  $response['message'] = 'Posted Successfully.';
						  $response['error'] = FALSE;
						  $response['validUserDetails'] = "valid";
						  parent::echoRespnse(200, $response);
					}
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
  }
  
  /*
   *searchresult
   */	
  public function searchresult() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','user_id','word','category_id');
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
					  
					  
					  $word=$jsonRequest['word'];
					  if(isset($word)){
						  $sql.=" AND pp.Name LIKE '%".$word."%'";
					  }
					  
					  $category_id=$jsonRequest['category_id'];
					  if($category_id!=''){
					   if(isset($category_id)){
						  $sql.=" AND p.category_id=".$category_id;
					   }
					  }
					  $db = new INNOCHAT\APIBaseController();
					  $this->conn = $db->connect();
					 /*  echo"SELECT pp.id,pp.`Name`,pp.`Title`,pp.`Address`,pp.`description`,pp.`partner_pic`,
					 GROUP_CONCAT(p.`category_id`) as cat_ids,p.uid,avg(pr.rating) as rating,COUNT(pim.image) AS image_count,COUNT(pv.url) AS video_count
													  FROM `partner_profile` pp 
													  INNER JOIN `product` p ON p.`uid`= pp.`createdby`  
													  LEFT JOIN product_reviews pr ON pr.pid = p.id
													  LEFT JOIN product_images pim ON pim.pid = p.id
													  LEFT JOIN product_videos  pv ON pv.pid = p.id													  
													  WHERE p.status=1 ".$sql." GROUP BY p.uid"; exit; */
					 $stmt = $this->conn->prepare("SELECT pp.id,pp.`Name`,pp.`Title`,pp.`Address`,pp.`description`,pp.`partner_pic`,
					 GROUP_CONCAT(p.`category_id`) as cat_ids,p.uid,avg(pr.rating) as rating,COUNT(pim.image) AS image_count,COUNT(pv.url) AS video_count,pp.music_zoner,pp.dress_code,pp.facilities
													  FROM `partner_profile` pp 
													  INNER JOIN `product` p ON p.`uid`= pp.`createdby`  
													  LEFT JOIN product_reviews pr ON pr.pid = p.id
													  LEFT JOIN product_images pim ON pim.pid = p.id
													  LEFT JOIN product_videos  pv ON pv.pid = p.id													  
													  WHERE p.status=1 ".$sql." GROUP BY p.uid") or trigger_error($this->conn->error, E_USER_ERROR);
					 
					 // $stmt->bind_param("s", $product_id) or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->execute() or trigger_error($stmt->error, E_USER_ERROR);
					  $stmt->store_result();
					  $meta = $stmt->result_metadata();
					  while ($field = $meta->fetch_field()) {
						  $parameters[] = &$row[$field->name];
					  }
  
					  call_user_func_array(array($stmt, 'bind_result'), $parameters);
  
					  $res = array();
  
					  while ($stmt->fetch()) {
  
						  foreach ($row as $key => $val) {
							  $res[$key] = $val;
						  }
						  $EventResult[] = $res;
					  }
  
  
					  if ($stmt->num_rows >= 1) {
  
						  $response['message'] = 'product By Category.';
						  $response['error'] = FALSE;
						  $response['productDetails'] = $EventResult;
  
						  parent::echoRespnse(200, $response);
					  } else {
						  $response['message'] = 'Products Are Not Available.';
						  $response['error'] = TRUE;
						  parent::echoRespnse(200, $response);
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
   /************************************************************************************/
   
   
  public function registerDevice() {
  
		  $jsonRequest = json_decode($this->requestObj, TRUE);
  
		  $acceptedArray = array('clientId','userId', 'token' , 'clientType');
  
		  if (!empty($jsonRequest)) {
  
			  if (parent::checkIfKeysExist($jsonRequest, $acceptedArray)) {
  
				  if (parent::checkClientId($jsonRequest['clientId'])) {
  
					  if ($jsonRequest['token'] != "") {
  
						  $db = new INNOCHAT\APIBaseController();
						  $this->conn = $db->connect();
  
						  $currentTime = date('Y-m-d H:i:s');
												  
						  
						  if ($jsonRequest['clientType'] == IOSClient) {
  
							  $stmt = $this->conn->prepare("
							  Update userdevice set iosToken = ?, updated_date = ? Where userid = ?") or trigger_error($stmt->error, E_USER_ERROR);
							  $stmt->bind_param("sss", $jsonRequest['token'], $currentTime, $jsonRequest['userId']) or trigger_error($stmt->error, E_USER_ERROR);
							  
						  }
						  
						  elseif ($jsonRequest['clientType'] == AndroidClient) {
						  
						  }
						  
						  
						  $stmt->execute();
  
						  $response = array();
  
						  if ($stmt->affected_rows == 1) {
							  $response['error'] = FALSE;
							  parent::echoRespnse(200, $response);
						  } else {
							  $response['message'] = 'Could not register for remote notifications.';
							  $response['error'] = TRUE;
							  parent::echoRespnse(400, $response);
						  }
						   
						  
					  } else {
  
						  parent::badRequest();
					  }
				  } else {
					  parent::badRequest();
				  }
			  } else {
				  parent::badRequest();
			  }
		  } else {
			  parent::badRequest();
		  }
	  }
  
  }
  
  ?>