<?php    
    include_once '../inc/session.php';
    include_once '../inc/db.php';

    if(isset($_SESSION['is_login'])){
      if($_SESSION['is_login'] != 1){
        header('Location: ../sign-out.php');
      }
    }
    //elseif($session_role != 'super admin'){
    if($_SESSION['user_role'] != 'admin'){
          header('Location: ../sign-out.php');
    }


    if(isset($_GET['chg_pass'])){
        $userId = $_GET['chg_pass'];
        $query = "SELECT * FROM `users` WHERE user_id = '$userId'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery)>  0){
            $row = mysqli_fetch_array($runQuery);
            
            $eUserId = $row['user_id'];
            $eUsername = $row['username'];
            $ePassword = $row['password'];
            $eEmail = $row['email'];
            $eUserRole = $row['user_role'];
            $eIsActive = $row['is_active'];
            $eCreatedAt = $row['created_at'];
            $eUpdateAt = $row['updated_at'];
              
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
  <title>Change Password</title>
  <!--favicon-->
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  <!--Select Plugins-->
  <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet"/>
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- animate CSS-->
  <link href="assets/css/animate.css" rel="stylesheet" type="text/css"/>
  <!-- Icons CSS-->
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <!-- Sidebar CSS-->
  <link href="assets/css/sidebar-menu.css" rel="stylesheet"/>
  <!-- Custom Style-->
  <link href="assets/css/app-style.css" rel="stylesheet"/>
  <!-- skins CSS-->
  <link href="assets/css/skins.css" rel="stylesheet"/>


   
  
</head>

<body>

   <!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">

  <?php include_once 'inc/sidebar.php'; ?>

  <?php include_once '../inc/top-header.php'; ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumb-->
     <div class="row pt-2 pb-2">
        <div class="col-sm-12">
		    <h4 class="page-title">Change Password</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
         </ol>
	   </div>
	   
     </div>
    <!-- End Breadcrumb-->
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div class="card">
            <div class="card-body">
              <form id="personal-info" method="post" action="" enctype="multipart/form-data">
                <h4 class="form-header text-uppercase">
                  <i class="fa fa-user-circle-o"></i>
                   USER INFO
                </h4>
                <div class="row">
                      <div class="form-group col-md-4">
                        <label for="username">Username</label>
                        <input type="text" required="required" class="form-control" name="username" id="username" value="<?php if(isset($eUsername)){echo $eUsername; }?>" disabled="disabled">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                      </div>

                      <div class="form-group col-md-4">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm-password" id="confirm_password">
                      </div>

                    <input type="hidden" name="user-id" value="<?php if(isset($eUserId)){echo $eUserId; }?>">
                    </div>
                <div class="form-footer">
                  <button type="submit" name="upd_user_pass_btn" class="btn btn-success"><i class="fa fa-check-square-o"></i> Update</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> CANCEL</button>
                    
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!--End Row-->

      
<!--start overlay-->
	  <div class="overlay toggle-menu"></div>
	<!--end overlay-->
    </div>
    <!-- End container-fluid-->
    
    </div><!--End content-wrapper-->
   <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->
	
	<?php include_once '../inc/footer.php'; ?>
  
  <?php include_once '../inc/color-switch.php'; ?>
   
  </div><!--End wrapper-->


  <!-- Bootstrap core JavaScript-->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
	
  <!-- simplebar js -->
  <script src="assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- sidebar-menu js -->
  <script src="assets/js/sidebar-menu.js"></script>
  
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>


  <!--Select Plugins Js-->
  <script src="assets/plugins/select2/js/select2.min.js"></script>

  <!--Sweet Alerts -->
  <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
  <script src="assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <script>
        $(document).ready(function() {
            $('.single-select').select2();
      
            $('.multiple-select').select2();

            $('#session').mask('0000-0000');

            $('#cnic_or_bform').mask('00000-0000000-0')
});

</script>

  <!--Form Validatin Script-->
    <script src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    
</body>
</html>

<?php
  /* Update User Password Code Starting */
    if(isset($_POST['upd_user_pass_btn'])){
        $userId = $_POST['user-id'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        if($password != $confirmPassword){
            echo'
                <script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    title: "Oops!",
                    text: "Password & Confirm Password not same.!",
                    icon: "error",
                    timer: 2500,
                  })
                });
                </script>
              ';
        }

        else{
            $password = md5($password);
            $query2 = "UPDATE `users` SET `password` = '$password' WHERE `users`.`user_id` = '$userId'";


            $runQuery2 = mysqli_query($conn, $query2);
            
            if($runQuery2){
              echo'
                    <script type="text/javascript">
                    $(document).ready(function(){
                      swal({
                        title: "Good job!",
                        text: "User Password has been updated successfully.!",
                        icon: "success",
                        timer: 2500,
                      })
                    });
                    </script>
                  ';
            }
            
            else{
                //echo $error = mysqli_connect_error();
                $error = mysqli_error($conn);
                echo '<script>alert("'.$error.'");</script>';
            }

        }

        // echo '<script>alert("'.$password.'")</script>';



        
    }
    /* Update User Password Code Ending */
?>
