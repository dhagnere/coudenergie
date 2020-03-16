<?php
  include_once '../inc/session.php';
  include_once '../inc/db.php';
  include_once 'ajax.php';

  if(isset($_SESSION['is_login'])){
        if($_SESSION['is_login'] != 1){
          header('Location: ../sign-out.php');
        }
  }
  //elseif($session_role != 'super admin'){
  if($_SESSION['user_role'] != 'admin'){
        header('Location: ../sign-out.php');
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Ajouter un bâtiment</title>
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
		    <h4 class="page-title">Bâtiments/Lieux</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Accueil</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Bâtiments</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ajouter un bâtiment</li>
         </ol>
	   </div>
	   
     </div>
    <!-- End Breadcrumb-->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form id="personal-info" method="post" action="" enctype="multipart/form-data">
                <h4 class="form-header text-uppercase">
                  <i class="fa fa-user-circle-o"></i>
                   Informations sur le bâtiment
                </h4>
                <div class="row">
                      <div class="form-group col-md-3">
                        <label for="building-name">Nom du bâtiment</label>
                        <input type="text" required="required" class="form-control" name="building-name" id="building-name">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="postal-code">Code Postal</label>
                        <input type="text" class="form-control" maxlength="5" size="5" name="postal-code" id="postal-code" placeholder="" required="required">
                      </div>

                      <div class="form-group col-md-3">
                        <label for="town">Ville</label>
                        <input type="text" class="form-control" name="town" id="town" placeholder="" required="required">
                      </div>

                      <div class="form-group col-md-3">
                        <label for="district">Quartier</label>
                        <input type="text" class="form-control" name="district" id="district" placeholder="" required="required">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="address">Addresse</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="" required="required">
                      </div>
                      <div class="col-md-5">
                        <label for="">Energie sur site</label>
                    
                            <div class="row">
                              <div class="col-md-3">
                                <div class="icheck-material-primary">
                                  <input type="checkbox" value="gas" id="primary" name="energy-type[]" checked/>
                                  <label for="primary">Gaz</label>
                                </div>
                               </div>
                               <div class="col-md-3">
                                <div class="icheck-material-success">
                                  <input type="checkbox" value="water" id="success" name="energy-type[]">
                                  <label for="success">Eau</label>
                                </div>
                               </div>
                               <div class="col-md-3">
                                <div class="icheck-material-danger">
                                  <input type="checkbox" id="danger" value="electricity" name="energy-type[]">
                                  <label for="danger">Electricité</label>
                                </div>
                               </div>
                               <div class="col-md-3">
                                <div class="icheck-material-info">
                                  <input type="checkbox" id="info" value="fuel" name="energy-type[]">
                                  <label for="info">Fuel</label>
                                </div>
                               </div>
                               
                            </div><!--End Row-->
                      </div>

                    </div>
                   

                      
                <div class="form-footer">
                  <button type="submit" name="add_building_btn" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAUVEGARDER</button>
                  <button type="reset" class="btn btn-danger"><i class="fa fa-times"></i> ANNULER</button>
                    
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
  /* Add Building Code Starting */
    if(isset($_POST['add_building_btn'])){
        $buildingName = strtolower($_POST['building-name']);
        $postalCode = $_POST['postal-code'];
        $town = $_POST['town'];
        $district = $_POST['district'];
        $address = $_POST['address'];
        $energy = $_POST['energy-type'];

        $energyType = implode(', ', $energy);
        $isActive = 1;
        
        $query1 = "SELECT * FROM `buildings` WHERE building_name = '$buildingName' AND postal_code = '$postalCode'";
        $runQuery1 = mysqli_query($conn, $query1);

        if(mysqli_num_rows($runQuery1) > 0){
          echo'
                <script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    title: "Attention!",
                    text: "Le bâtiment existe déja.!",
                    icon: "warning",
                    timer: 2500,
                  })
                });
                </script>
              ';
        }
        else{

            $query2 = "INSERT INTO `buildings` (`building_id`, `building_name`, `postal_code`, `town`, `district`, `address`, `energy_types`, `is_active`) VALUES (NULL, '$buildingName', '$postalCode', '$town', '$district', '$address', '$energyType', '$isActive')";
            $runQuery2 = mysqli_query($conn, $query2);

            if($runQuery2){
              echo'
                    <script type="text/javascript">
                    $(document).ready(function(){
                      swal({
                        title: "Succès!",
                        text: "Le bâtiment a été ajouté à la base de données!",
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
  }
  /* Add Building Code Ending */
?>