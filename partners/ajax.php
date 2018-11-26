<?php 
error_reporting(0);
session_start();
define("url","http://localhost/disconox/v1/InnoChat/");
//get Main Category Values
if($_POST['main_category']){
	$main_category = $_POST['main_category'];
	//start
	 $data = array(
                  "clientId"=>"x6DmrbsQFZyUUiggs0BZ",
                  "user_id"=> $_SESSION['id'],
				  "cat_id"=>1
              );
              $data_json = json_encode($data);
              $ue = url."getCategory";
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $ue);
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
					  $Main_Categories = $responsObj['categories'];
					  //for Only subcategories means 2nd stageq
					  if(count($Main_Categories)>0){
						  //subcategories
						  $sub_Categories .="<select name='cat_name' id='main_cat'>
						                      <option>Select Category<option>";
						  foreach($Main_Categories as $main){ $main = (object)$main; 
							$sub_Categories.='<option value="'.$main->id.'">'.$main->cat_name.'</option>';
							  
						  }
						  $sub_Categories.='</select>';
						echo $sub_Categories;   
					  }
                     // header('categories.php');
                      
              
                  }
              }
              curl_close($ch); 
	//end
	
}
//get subcategories values
if($_POST['super_category_id']){ 

	$super_category_id = $_POST['super_category_id']; 
/*start*/
$data = array(
			"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
			'super_cat_id' => $super_category_id,
			'user_id'=> $_SESSION['id']	
		   );
$data_json = json_encode($data);
$ul = url."getSubCategory"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ul);
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
		//        echo "Bad Request";        
    } else {
      /**start**/
	   $message = $responsObj['message']; 
		$super_Categories = $responsObj['categories'];
					  //for Only subcategories means 2nd stageq
					  if(count($super_Categories)>0){
						  //subcategories
						  $sub_Categories ="<select name='subcat_name' id='sub_cat'><option>Select </option>";
						  foreach($super_Categories as $main){ 
						    $main = (object)$main; 
							$sub_Categories.='<option value="'.$main->id.'">'.$main->cat_name.'</option>';
						  }
						  $sub_Categories.='</select>';
						  echo $sub_Categories; exit;
					  }
                     // header('categories.php');
                      
	  /*end*/
    }
}
curl_close($ch);
/*end*/
	
	
}

//get subcategories values for child category
if($_POST['sub_category_id']){ 

	$super_category_id = $_POST['sub_category_id']; 
/*start*/
$data = array(
			"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
			'super_cat_id' => $super_category_id,
			'user_id'=> $_SESSION['id']	
		   );
$data_json = json_encode($data);
$ul = url."getSubCategory"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ul);
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
		//        echo "Bad Request";        
    } else {
      /**start**/
	   $message = $responsObj['message']; 
		$super_Categories = $responsObj['categories'];
					  //for Only subcategories means 2nd stageq
					  if(count($super_Categories)>0){
						  //subcategories
						  $sub_Categories ="<select name='subcat_name' id='sub_cat2'><option>Select </option>";
						  foreach($super_Categories as $main){ 
						    $main = (object)$main; 
							$sub_Categories.='<option value="'.$main->id.'">'.$main->cat_name.'</option>';
						  }
						  $sub_Categories.='</select>';
						  echo $sub_Categories; exit;
					  }
                     // header('categories.php');
                      
	  /*end*/
    }
}
curl_close($ch);
/*end*/
	
	
}


//get childsub categories
if($_POST['subcategory_id']){ 

	$subcategory_id = $_POST['subcategory_id']; 
	$maincat_id     = $_POST['maincat_id'];
	$cat_id         = 3;
/*start*/
$data = array(
			"clientId"=>"x6DmrbsQFZyUUiggs0BZ",
			'supercat_id' => $maincat_id,
			'subcat_id'=> $subcategory_id,
			'cat_id'=> $cat_id,
			'user_id'=> $_SESSION['id']	
		   );
$data_json = json_encode($data);
$ul = url."getChildCategory"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ul);
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
		//        echo "Bad Request";        
    } else {
      /**start**/
	   $message = $responsObj['message']; 
		$sub_Categories = $responsObj['categories'];
					  //for Only subcategories means 2nd stageq
					  if(count($sub_Categories)>0){
						  //subcategories
						  $child_Categories ="<select name='childcat_name' id='sub_cat'><option>Select </option>";
						  foreach($sub_Categories as $main){ 
						    $main = (object)$main; 
							$child_Categories.='<option value="'.$main->id.'">'.$main->cat_name.'</option>';
						  }
						  $child_Categories.='</select>';
						  echo $child_Categories; exit;
					  }
                     // header('categories.php');
                      
	  /*end*/
    }
}
curl_close($ch);
/*end*/
	
	
}