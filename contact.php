<?php
// Functions to filter user inputs
function filterName($field){
    // Sanitize user name
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    
    // Validate user name
    if(filter_var($field, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+/")))){
        return $field;
    }else{
        return FALSE;
    }
}    
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
    
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    }else{
        return FALSE;
    }
}
 
// Define variables and initialize with empty values
$nameErr = $emailErr =$subjectErr=$descriptionErr = "";
$name = $email = $subject = $description = $success="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate user name
    if(empty($_POST["name"])){
        $nameErr = 'Name is required';
    }else{
        $name = filterName($_POST["name"]);
        if($name == FALSE){
            $nameErr = 'Please enter a valid name.';
        }
    }
    
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = 'Email is required';     
    }else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = 'Please enter a valid email address.';
        }
    }
    
    // Validate message subject
    if(empty($_POST["subject"])){
        $subjectErr ='Subject is required';
    }else{
        $subject = filterString($_POST["subject"]);
        if($subject == FALSE){
            $subjectErr = 'Please enter a valid email address.';
        }
    }
    
    // Validate user comment
    if(empty($_POST["description"])){
        $descriptionErr = 'Description is required.';     
    }else{
        $description = filterString($_POST["description"]);
        if($description == FALSE){
            $descriptionErr = 'Please enter a valid comment.';
        }
    }
    
    
    if($_POST){
	     if(empty($nameErr) && empty($emailErr) && empty($subjectErr) && empty($messageErr)){
	      
	        
	      // Recipient email address
	        $to = 'saydulhaque.iium@gmail.com';
	        //$to = 'saidurrahman.uia@gmail.com';
	        
	        // Create email headers
	        $headers =  'MIME-Version: 1.0' . "\r\n"; 
	        $headers .= 'From: Your name <'.$email .'>' . "\r\n";
	          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
	          $message = "
	           Name: $name <br/>
	             Email: $email <br/>
	            Subject: $subject <br/>
	             Description: $description 
	                   ";
	
	        
	        // Sending email
	        if(mail($to, $subject, $message, $headers)){
	         $success="Your message has been sent successfully!";
	        }else{
	            echo '<p class="error">Unable to send email. Please try again!</p>';
	        }
	    }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sayd Haque Official Website</title>
  <link rel="shortcut icon" type="image/png" href="image/Favicon.png">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/styles.css">
  <style>
  .error{ color: red; }
        .success{ color: green; }
  body {
   background-image: url("image/100.gif");
   
 
    }
  </style>
  
</head>
<body>

<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        
   <a href="http://www.saydhaque.com"  > <img class="img-responsive" src="image/logo.png"  alt="" height="80"width="100"></a>
    </div><br/>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-center">
       <li> <a href="http://www.saydhaque.com">HOME</a></li>

          <li><a href="about ">ABOUT</a></li>
        <li><a href="news">NEWS</a></li>
        <li><a href="ongoingproject">ONGOING PROJECTS</a></li>
        <li><a href="photogallery">PHOTO  GALLERY</a></li>
	
	
	<li><a href="works">WORKS</a></li>
	<li><a href="service">SERVICE</a></li>
	<li><a href="contact">CONTACT</a></li>
	</ul>
      <ul class="nav navbar-nav navbar-right">
        <a href="https://www.facebook.com/saydhaque.iium"  target="_blank" ><img  src="image/facebook.png"  alt="" height="50" width="50" ></a>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
   <div class="clearfix">
   <div class="row">
   <div class="col-md-4" ><hr style="font-weight:bold; color:green"></div>
    <div class="sayd">
   <div class="col-md-4"><center><h4 style="font-weight: bold;color:green">CONTACT</h4><h5 style=" font-weight: bold; color:black">For any business enquiries</h5></center></div>
   </div>
   <div class="col-md-4"><hr></div>
   </div></br>
    <div class="row">
  <div class="col-md-6">
    
<form action="contact" method="post">
        <p>
            <label for="inputName">Name:</label>
            <input type="text" name="name" id="inputName" value="<?php echo $name; ?>">
            <span class="error"><?php echo $nameErr; ?></span>
        </p>
        <p>
            <label for="inputEmail">Email:</label>
            <input type="text" name="email" id="inputEmail" value="<?php echo $email; ?>">
            <span class="error"><?php echo $emailErr; ?></span>
        </p>
        <p>
            <label for="inputSubject">Subject:</label>
            <input type="text" name="subject" id="inputSubject" value="<?php echo $subject; ?>">
			<span class="error"><?php echo $subjectErr; ?></span>
        </p>
        <p>
            <label for="inputComment">Description:</label></br>
            <textarea name="description" id="inputComment" class="form-control"  rows="3" cols="53"><?php echo $description; ?></textarea>
            <span class="error"><?php echo $descriptionErr; ?></span>
        </p>
        </br>
        <input type="submit" value="Send" style="background-color:red;">
        <input type="reset" value="Reset"></br></br>
        <div class="success"><?=$success; ?> </div>
        
        

    </form>
  </br>
  </div>
<div class="col-md-4"></div>
<div class="col-md-2">
<div class="papri">
  <b> Contact Details</b>
  
  <h6>Block A-/27</h6>
   <h6>PV2 Platinum Hill Condo</h6>
    <h6>Kuala Lumpur,Malaysia</h6>
     <p>Tel:<b>+60182423746</b></p>
   <h6>Email:contact@saydhaque.com</h6>
</div>
</div>
</div>
</div>
</div>
 




<footer class="container-fluid">
		<div class="row">
			<div class=" col-md-7" style="z-index: 999;">
				<ul class="list-inline" >
				<li><a href="http://www.saydhaque.com">HOME</a></li>
				<li><a href="about">ABOUT</a></li>
				<li><a href="news">NEWS</a></li>
				<li><a href="ongoingproject">ONGOING PROJECTS</a></li>
			    <li><a href="photogallery">PHOTO GALLERY</a></li>
				<li><a href="works">WORKS</a></li>
				<li><a href="service">SERVICE</a></li>
				<li><a href="contact">CONTACT</a></li>
              </ul>
			 
			</div>
  <div class="col-md-2">
     <ul class=" list-inline" >
     <li><h5>KEEP IN TOUCH:</h5></li>
  </ul>
  </div>
				   
 <div class=" col-md-3">
 <ul class=" list-inline" >
	<li><a href="https://www.facebook.com/saydhaque.iium"  target="_blank" ><img  src="image/facebook.png"  alt="" height="30" width="30"></a></li>
	<li><a href="https://www.linkedin.com/in/sayd-haque-69609971/"  target="_blank" ><img  src="image/lin.png"  alt="" height="30" width="30" ></a></li>
	<li><a href="https://twitter.com/HaqueSayd"  target="_blank" ><img  src="image/52.png"  alt="" height="30" width="30" ></a></li>
	<li><a href="https://www.instagram.com/saydhaque/"  target="_blank" ><img  src="image/in.png"  alt="" height="30" width="30" ></a></li>
     </ul>
	
 </div>
 </div>
 <p style="font-size: 7px;color: green;float:right;margin-right:60px;">&copy; 2017 saydhaque.com All Rights Reserved. Web Design by : <a href="https://www.facebook.com/unwanted.person.1694" target="_blank" >Saidur Rahman</a></p>
</footer>
</body>
</html>