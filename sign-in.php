<?php
    include_once 'inc/session.php';
    include_once 'inc/db.php';   

    if(isset($_POST['sign_in_btn'])){

      

        $username = mysqli_real_escape_string($conn, strtolower($_POST['username']));
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        $query = "SELECT * FROM users WHERE Username = '$username' AND is_active = 1";
        $runQuery = mysqli_query($conn, $query);
        
        if(mysqli_num_rows($runQuery) > 0){
          
            
            $row = mysqli_fetch_array($runQuery);
            
            $db_user_id = $row['user_id'];
            $db_username = $row['username'];
            $db_password = $row['password'];
            $db_email = $row['email'];
            $db_user_role = $row['user_role'];
            $db_student_id = $row['student_id'];
            $db_teacher_id = $row['teacher_id'];
            $db_is_active = $row['is_active'];
            $db_created_at = $row['created_at'];
            $db_updated_at = $row['updated_at'];
            
            $password = md5($password);  
            
            if($username == $db_username && $password == $db_password){
              // echo '<script>alert("working")</script>';
                if($db_user_role == 'super admin'){
                    header("Location: super-admin/index.php");
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['user_role'] = $db_user_role;
                    $_SESSION['is_active'] = $db_is_active;
                    $_SESSION['created_at'] = $db_created_at;
                    $_SESSION['updated_at'] = $db_updated_at;
                    $_SESSION['student_id'] = $db_student_id;
                    $_SESSION['teacher_id'] = $db_teacher_id;
                    $_SESSION['is_login'] = 1;
                }
                elseif($db_user_role == 'teacher'){
                    header("Location: teacher/index.php");
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['user_role'] = $db_user_role;
                    $_SESSION['is_active'] = $db_is_active;
                    $_SESSION['created_at'] = $db_created_at;
                    $_SESSION['updated_at'] = $db_updated_at;
                    $_SESSION['student_id'] = $db_student_id;
                    $_SESSION['teacher_id'] = $db_teacher_id;
                    $_SESSION['is_login'] = 1;
                }
                elseif($db_user_role == 'student'){
                    header("Location: student/index.php");
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['user_role'] = $db_user_role;
                    $_SESSION['is_active'] = $db_is_active;
                    $_SESSION['created_at'] = $db_created_at;
                    $_SESSION['updated_at'] = $db_updated_at;
                    $_SESSION['student_id'] = $db_student_id;
                    $_SESSION['teacher_id'] = $db_teacher_id;
                    $_SESSION['is_login'] = 1;
                }
                elseif($db_user_role == 'admin'){
                    header("Location: admin/index.php");
                    $_SESSION['user_id'] = $db_user_id;
                    $_SESSION['username'] = $db_username;
                    $_SESSION['email'] = $db_email;
                    $_SESSION['user_role'] = $db_user_role;
                    $_SESSION['is_active'] = $db_is_active;
                    $_SESSION['created_at'] = $db_created_at;
                    $_SESSION['updated_at'] = $db_updated_at;
                    $_SESSION['student_id'] = $db_student_id;
                    $_SESSION['teacher_id'] = $db_teacher_id;
                    $_SESSION['is_login'] = 1;
                } 
            }
            else{
                $error = "les données ne sont pas bonnes..!";
                echo '<script>alert("'.$error.'")</script>';

            }
            
        }
        else{
            $error = "l'utilisateur n'existe pas..!";
            echo '<script>alert("'.$error.'")</script>';
        }
                                              
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Se connecter</title>
  <!--favicon-->
  <link rel="icon" href="img/favicon.ico" type="image/x-icon">
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
     <br>
    <div class="text-center">
        <img src="img/logoCDK.png" alt="logo icon">
    </div>

 <div class="loader-wrapper"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>
	<div class="card card-authentication1 mx-auto my-5">
		<div class="card-body">
		 <div class="card-content p-2">
		  <div class="card-title text-uppercase text-center py-3">Se connecter</div>
		    <form method="post" action="">
			  <div class="form-group">
			  <label for="username" class="sr-only">Nom d'utilisateur</label>
			   <div class="position-relative has-icon-right">
				  <input type="text" id="username" class="form-control input-shadow" placeholder="Entrer votre nom d'utilisateur" name="username" required="required">
				  <div class="form-control-position">
					  <i class="icon-user"></i>
				  </div>
			   </div>
			  </div>
			  <div class="form-group">
			  <label for="password" class="sr-only">Mot de passe</label>
			   <div class="position-relative has-icon-right">
				  <input type="password" id="password" class="form-control input-shadow" placeholder="Entrer votre mot de passe" name="password" required="required">
				  <div class="form-control-position">
					  <i class="icon-lock"></i>
				  </div>
			   </div>
			  </div>
			<div class="form-row">
			 <!-- <s></s> -->
			 <!-- <div class="form-group col-12 text-right">
			  <a href="forget-password.php">reseter le mot de passe</a>
			 </div> -->
			</div>
			 <button type="submit" class="btn btn-primary btn-block" name="sign_in_btn">Se connecter</button>
			 </form>
		   </div>
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
