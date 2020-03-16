<?php
    include_once 'inc/session.php';
    include_once 'inc/db.php'; 

 ?>   
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewpo<?php
    include_once 'inc/session.php';
    include_once 'inc/db.php'; 

 ?>   rt" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Forget Password</title>
  <link rel="icon" href="admin/assets/images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap core CSS-->
  <link href="admin/assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="admin/assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="admin/assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Custom Style-->
  <link href="admin/assets/css/app-style.css" rel="stylesheet"/>
  
  
</head>

<body>

<!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase pb-2">Reset Password</div>
		    <p class="pb-2">Please enter your email address. You will receive a link to create a new password via email.</p>
		    <form method="post" action="" name="reset">
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Email Address</label>
			   <div class="position-relative has-icon-right">
				  <input type="email" name="email" id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="Email Address">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			 
			  <button type="submit" name="forget_password_btn" class="btn btn-warning btn-block mt-3">Reset Password</button>
			 </form>
		   </div>
		  </div>
		   <div class="card-footer text-center py-3">
		    <p class="text-dark mb-0">Return to the <a href="sign-in.php"> Sign In</a></p>
		  </div>
	     </div>
    
     <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	
	
	</div><!--wrapper-->
	
  <!-- Bootstrap core JavaScript-->
  <script src="admin/assets/js/jquery.min.js"></script>
  <script src="admin/assets/js/popper.min.js"></script>
  <script src="admin/assets/js/bootstrap.min.js"></script>
	
  <!-- sidebar-menu js -->
  <script src="admin/assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="admin/assets/js/app-script.js"></script>
  
	
</body>
</html>





<?php

if(isset($_POST['forget_password_btn'])){
	$email = $_POST["email"];
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);

	if(!$email) {
		echo '<script>alert("Invalid email address please type a valid email address!")</script>';
	}

  	else{
		$sel_query = "SELECT * FROM `users` WHERE email='".$email."'";
		$results = mysqli_query($conn, $sel_query);
		
		$row = mysqli_num_rows($results);
			if ($row==""){
				echo '<script>alert("No user is registered with this email address!")</script>';
			}
		}
	
		$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
		$expDate = date("Y-m-d H:i:s",$expFormat);
		$token = md5(2418*2+$email);
		$addToken = substr(md5(uniqid(rand(),1)),3,10);
		$token = $token . $addToken;

		// Insert Temp Table
		// mysqli_query($con,
		// "");

		$query =  "INSERT INTO `password_reset_temp` (`email`, `token`, `expDate`) VALUES ('".$email."', '".$token."', '".$expDate."')";
		$runQuery = mysqli_query($conn, $query);

		$output='<p>Dear User,</p>';
		$output.='<p>Please click on the following link to reset your password.</p>';
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p><a href="http://localhost/projects/lab-management/reset-password.php?key='.$token.'&email='.$email.'&action=reset" target="_blank">http://localhost/projects/lab-management/reset-password.php?key='.$token.'&email='.$email.'&action=reset</a></p>';		
		$output.='<p>-------------------------------------------------------------</p>';
		$output.='<p>Please be sure to copy the entire link into your browser.
		The link will expire after 1 day for security reason.</p>';
		$output.='<p>If you did not request this forgotten password email, no action 
		is needed, your password will not be reset. However, you may want to log into 
		your account and change your security password as someone may have guessed it.</p>';   	
		$output.='<p>Thanks,</p>';
		$output.='<p>Lab Management</p>';


		$body = $output; 
		$subject = "Password Recovery - Lab Managment";

		$email_to = $email;
		$fromserver = "superiorcollegemianchannu@gmail.com"; 
		require("PHPMailer/PHPMailerAutoload.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = "smtp.gmail.com"; // Enter your host here
		$mail->SMTPAuth = true;
		$mail->Username = "superiorcollegemianchannu@gmail.com"; // Enter your email here
		$mail->Password = "superior3334"; //Enter your passwrod here
		$mail->Port = 25;
		$mail->IsHTML(true);
		$mail->From = "superiorcollegemianchannu@gmail.com";
		$mail->FromName = "Logixx Grid";
		$mail->Sender = $fromserver; // indicates ReturnPath header
		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AddAddress($email_to);

		if(!$mail->Send()){
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
		else{
			echo '<script>alert("An email has been sent to you with instructions on how to reset your password.")</script>';
			}		
		}
?>
