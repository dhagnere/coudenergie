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
<html lang="FR">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>Valider une facture/consommation</title>
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

  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
   <script src="main.js" type="text/javascript"></script>


   
  
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
		    <h4 class="page-title">Cost</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Acceuil</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Dépenses</a></li>
            <li class="breadcrumb-item active" aria-current="page">Valider une facture/consommation</li>
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
                   VALIDER UNE FACTURE OU UNE CONSOMMATION.
                </h4>
                <div class="row">
                       <div class="form-group col-md-3">
                        <label for="input-1">Bâtiment</label>
                        <select class="form-control single-select" name="building-id" id="building_id" required="required">
                            <option value="" hidden selected readonly>Choix du bâtiment</option>
                            <?php  
                                    $query = "SELECT * FROM `buildings` where is_active = 1 order by building_name asc";
                                    $runQuery = mysqli_query($conn, $query);
                                    $totalRecords = mysqli_num_rows($runQuery);
                                    
                                    if(mysqli_num_rows($runQuery) > 0){
                                              
                                    while($row = mysqli_fetch_array($runQuery)){
                                    $buildingId = $row['building_id'];
                                    $buildingName = ucwords($row['building_name']);
                                    
                                    ?>
                                    <option value="<?php echo $buildingId; ?>" data-ins_id="<?php echo $buildingId; ?>"><?php echo $buildingName; ?></option>
                                    <?php
                                        }
                                    }
                                    else{
                                        echo "<option value=''>Aucun bâtiment ne corrspond</option>";
                                     }                       
                                ?>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="consumption-date">Date</label>
                        <input type="date" class="form-control" name="consumption-date" id="consumption-date" placeholder="" required="required">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="gas-consumption">Consommation de gaz(<span id="unit">KWH</span>)</label>
                        <input type="text" class="form-control" name="gas-consumption" id="gas-consumption" placeholder="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="gas-cost">Coût gaz (&euro;)</label>
                        <input type="text" class="form-control" name="gas-cost" id="gas-cost" placeholder="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="water-consumption">Consommation d'eau(<span id="unit">M3</span>)</label>
                        <input type="text" class="form-control" name="water-consumption" id="water-consumption" placeholder="">
                      </div>
                       <div class="form-group col-md-3">
                        <label for="water-cost">Coût eau (&euro;)</label>
                        <input type="text" class="form-control" name="water-cost" id="water-cost" placeholder="">
                      </div>
                      
                      <div class="form-group col-md-3">
                        <label for="electricity-consumption">Consommation électrique(<span id="unit">KWH</span>)</label>
                        <input type="text" class="form-control" name="electricity-consumption" id="electricity-consumption" placeholder="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="electricity-cost">Coût électrique (&euro;)</label>
                        <input type="text" class="form-control" name="electricity-cost" id="electricity-cost" placeholder="">
                      </div>

                      <div class="form-group col-md-3">
                        <label for="fuel-consumption">Consommation fuel(<span id="unit">L</span>)</label>
                        <input type="text" class="form-control" name="fuel-consumption" id="fuel-consumption" placeholder="">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="fuel-cost">Cout fuel (&euro;)</label>
                        <input type="text" class="form-control" name="fuel-cost" id="fuel-cost" placeholder="">
                      </div>
                     

                    </div>
                   

                      
                <div class="form-footer">
                  <button type="submit" name="add_cost_btn" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
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
  <!-- <script src="assets/js/jquery.min.js"></script> -->
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
  /* Add Cost Code Starting */
    if(isset($_POST['add_cost_btn'])){
        $buildingId = $_POST['building-id'];
        $consumptionDate = $_POST['consumption-date'];
        $gasCons = $_POST['gas-consumption'];
        $gasCost = $_POST['gas-cost'];
        $waterCons = $_POST['water-consumption'];
        $waterCost = $_POST['water-cost'];
        $elecCons = $_POST['electricity-consumption'];
        $elecCost = $_POST['electricity-cost'];
        $fuelCons = $_POST['fuel-consumption'];
        $fuelCost = $_POST['fuel-cost'];
        
        $query1 = "SELECT * FROM `costs` WHERE building_id = '$buildingId' AND consumption_date = '$consumptionDate'";
        $runQuery1 = mysqli_query($conn, $query1);

        if(mysqli_num_rows($runQuery1) > 0){
          echo'
                <script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    title: "Oops!",
                    text: "Cost Already Added.!",
                    icon: "warning",
                    timer: 2500,
                  })
                });
                </script>
              ';
        }
        else{

            $query2 = "INSERT INTO `costs` (`cost_id`, `building_id`, `consumption_date`, `gas_consumption`, `gas_cost`, `water_consumption`, `water_cost`, `electricity_consumption`, `electricity_cost`, `fuel_consumption`, `fuel_cost`, `created_at`, `updated_at`) VALUES (NULL, '$buildingId', '$consumptionDate', '$gasCons', '$gasCost', '$waterCons', '$waterCost', '$elecCons', '$elecCost', '$fuelCons', '$fuelCost', CURRENT_TIMESTAMP, NULL);";
            $runQuery2 = mysqli_query($conn, $query2);

            if($runQuery2){
              echo'
                    <script type="text/javascript">
                    $(document).ready(function(){
                      swal({
                        title: "Bon travail!",
                        text: "le coût a bien été enregistré.!",
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
  /* Add Cost Code Ending */
?>