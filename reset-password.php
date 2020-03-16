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
		    <p class="pb-2">Please enter your new password to reset your password.</p>

		<?php
	if(isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) && ($_GET["action"]=="reset") && !isset($_POST["action"])){
		$token = $_GET["key"];
		$email = $_GET["email"];
		$curDate = date("Y-m-d H:i:s");
		
		$query = "SELECT * FROM `password_reset_temp` WHERE email = '$email' AND token = '$token'";
		$runQuery = mysqli_query($conn, $query);

		$row = mysqli_num_rows($runQuery);

		if ($row==""){
			echo '<script>alert("You are using invalid or expired Link. Pleaes reset your password again!")</script>';
		}

		else{

			$row = mysqli_fetch_assoc($runQuery);
			$expDate = $row['expDate'];

			if ($expDate >= $curDate){
				?>
				<form method="post" action="" name="reset">
			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="password" id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>

			  <div class="form-group">
			  <label for="exampleInputEmailAddress" class="">Confirm Password</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" name="confirm-password" id="exampleInputEmailAddress" class="form-control input-shadow" placeholder="">
				  <div class="form-control-position">
					  <i class="icon-envelope-open"></i>
				  </div>
			   </div>
			  </div>
			  <input type="hidden" name="email" value="<?php if(isset($email)){echo $email; }?>"/>
			 
			  <button type="submit" name="reset_password_btn" class="btn btn-warning btn-block mt-3">Reset Password</button>
			 </form>
				






			<?php
			}

			else{
				echo '<script>alert("The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request")</script>';
				}
		}
					
	} // isset email key validate end



?>




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

	if(isset($_POST['reset_password_btn'])){

		// if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){




		$password = mysqli_real_escape_string($conn ,$_POST["password"]);
		$confirmPassword = mysqli_real_escape_string($conn ,$_POST["confirm-password"]);

		$email = $_POST["email"];
		$curDate = date("Y-m-d H:i:s");
		
		if($password != $confirmPassword){
			echo '<script>alert("Password do not match, both password should be same")</script>';
		}
		else{

			$password = md5($password);
		
			$query3 = "UPDATE `users` SET `password` = '$password', `updated_at` = CURRENT_TIMESTAMP WHERE `users`.`email` = '$email'";
			$runQuery3 = mysqli_query($conn, $query3);

			if($runQuery3){
				$query4 = "DELETE FROM `password_reset_temp` WHERE `email`='".$email."'";
				$runQuery4 = mysqli_query($conn, $query4);

				echo '<script>alert("Congratulations! Your password has been updated successfully.")
				window.location.href = "sign-in.php";
				</script>';

			}


		}
		
	}


?>