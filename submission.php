<?php
include 'connection.php';
include('Mobile_Detect.php');
include('BrowserDetection.php');
date_default_timezone_set('Asia/Kolkata');
$date = date( 'Y-m-d');
$browser=new Wolfcast\BrowserDetection;

$browser_name=$browser->getName();
$browser_version=$browser->getVersion();

$detect=new Mobile_Detect();

if($detect->isMobile()){
	$type='Mobile';
}elseif($detect->isTablet()){
	$type='Tablet';
}else{
	$type='PC';
}

if($detect->isiOS()){
	$os='IOS';
}elseif($detect->isAndroidOS()){
	$os='Android';
}else{
	$os='Window';
}

$url=(isset($_SERVER['HTTPS'])) ? "https":"http";
$url.="//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ref='';
if(isset($_SERVER['HTTP_REFERER'])){
	$ref=$_SERVER['HTTP_REFERER'];
}
$sql="insert into visitor(browser_name,browser_version,type,os,url,ref,added_on) values('$browser_name','$browser_version','$type','$os','$url','$ref','$date')";
mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
form{
	width:500px;
}
fieldset {
	margin:10px;
	padding:30px;
	border: 2px solid gray;
	}
	#capt{
		height:100px;
		width:150px;
		background:skyblue;
		
		
	}
	#final-cap{
		background:transparent;
		border:none;
		font-weight:bold;
		font-size:20px;
		text-align:center;
	}
	@media only  screen and (max-width :768px){
		form{
	width:auto;
}
	}
</style>
<body>

<div class="container">


  <form id="contact-form" action="" method="post"  enctype="multipart/form-data">
  <fieldset>
 <legend> <center>
  <h2>Animal Information</h2></center></legend><br>
          <div class="error-container"></div>
          
            
              <div class="form-group">
                <label>Animal Name</label>
                <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text" required>
              </div><br>
           
              <div class="form-group">
              <label>Select Category</label><br>
               <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" id="customRadio1" name="customRadio" value="Herbivores">
      <label class="custom-control-label" for="customRadio1">Herbivores</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" id="customRadio2" name="customRadio" value="Omnivores">
      <label class="custom-control-label" for="customRadio2">Omnivores</label>
    </div>

        <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" class="custom-control-input" id="customRadio3" name="customRadio" value="Carnivores">
      <label class="custom-control-label" for="customRadio3">Carnivores</label>
    </div>
              </div><br>
           
              <div class="form-group">
			  	
                <label>Upload Image</label>
               <div class="custom-file">
			   
    <input type="file" class="custom-file-input" id="file" name="file" required />
    <label class="custom-file-label" for="file">Choose file</label>
  </div>
              </div><br>
           
          
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="5"
              required></textarea>
          </div><br>
		  
            <div class="form-group">
            <label>Life Expectancy</label>
             <select name="span" class="custom-select mb-3" required />
      <option selected>Select</option>
      <option value="0-1">0-1 years</option>
      <option value="1-5">1-5 years</option>
      <option value="5-10">5-10 years</option>
          <option value="10+">10+ years</option>
    </select>
            </div><br>
			
			  <div class="form-group">
			  <div class="row">
			  <div class="col">
                <label>Enter Captcha</label>
                <input class="form-control form-control-name1" name="cat_name" id="cat_name" placeholder="" type="text" required>
              </div>
			   <div class="col">
			   
						
<div id="capt">
<?php
 
$permitted_chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
    $input_length = strlen($permitted_chars);
    $random_string = '';
    for($i = 0; $i < 5; $i++) {
        $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
  
    //echo $random_string;
 
 
 
?>

<center><h3></br><input class="form-control form-control-name2" type="text" id="final-cap" name="final-cap" value="<?php $final_cap = $random_string; echo $final_cap; ?>"></h3></center>
<!--<center><button class="btn btn-success" name="refresh" id="refresh" type="refresh">Refresh</button></center>-->


</div>
			   </div>
			  </div></div><br>
			  
			  
			
          <div class="text-right"><br>
        <center><button class="btn btn-primary solid blank" id="submit" name="submit" type="submit">Submit</button></center>
          </div><br>
        	</fieldset>
        </form>
	<script>

$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</div>
<?php



if(isset($_POST["submit"])) {
    $cap = $_POST['cat_name'];
	$final_cap = $_POST['final-cap'];
	if($final_cap == $cap){
		
  $target_dir = "uploads/";
$target_file = $target_dir.basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));  

 $images = glob($target_dir."*.{jpg,gif,png,jpeg}",GLOB_BRACE);

      foreach($images as $pic) {
            if($pic == $target_file){
                                                 
                echo "<script>alert('Sorry, This file already exist.')</script>";
               
                echo '<meta http-equiv="refresh" content="1; URL=submission.php" />';
                     exit();                          
                }
			 }
								

 if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
  echo '<meta http-equiv="refresh" content="1; URL=submission.php" />';
  $uploadOk = 0;
}


else if ($uploadOk == 0) {
  echo "<script>alert('Sorry, your file was not uploaded.')</script>";
  echo '<meta http-equiv="refresh" content="1; URL=submission.php" />';

} else {
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
  
	
				$name = $_POST['name'];
				$cat = $_POST['customRadio'];
				$image = $_FILES['file']["name"];
				$desc = $_POST['message'];
				$life = $_POST['span'];
				
			
				
				$sql_query = "insert into info values('','$name','$cat','$image','$desc','$life',current_date())";
			mysqli_query($conn, $sql_query) or die("database error:". mysqli_error($conn));
			echo "<script>alert('Added Successfully');</script>";
			 echo '<meta http-equiv="refresh" content="1; URL=animal-list.php" />';
  } else {
    echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
	echo '<meta http-equiv="refresh" content="1; URL=submission.php" />';
  }
}
}else{
	echo "<script>alert('<?php echo $final_cap; echo $cap; ?>')</script>";
	echo '<meta http-equiv="refresh" content="1; URL=submission.php" />';
}
}

?>
</body>
</html>




					
	