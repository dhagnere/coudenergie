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


  if(isset($_GET['edit_c'])){
        $editCostId = $_GET['edit_c'];
        $query = "SELECT * FROM `costs` WHERE cost_id = '$editCostId'";
        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery)>  0){
            $row = mysqli_fetch_array($runQuery);
            $eCostId = $row['cost_id'];
            $eBuildingId = $row['building_id'];
            $eConsumptionDate = $row['consumption_date'];
            $eEnergyType = $row['energy_type'];
            $eConsumption = $row['consumption'];
            $eCost = $row['cost'];
            $eCreatedAt = $row['created_at'];
            $eUpdatedAt = $row['updated_at'];
         
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
  <title>Add Cost</title>
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
            <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Costs</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Cost</li>
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
                   Cost Info
                </h4>
                <div class="row">
                       <div class="form-group col-md-3">
                        <label for="input-1">Building</label>
                        <select class="form-control single-select" name="building-id" id="building_id" required="required">
                            <option value="" hidden selected readonly>Choose Building</option>
                            <?php  
                                    $query = "SELECT * FROM `buildings` where is_active = 1 order by building_name asc";
                                    $runQuery = mysqli_query($conn, $query);
                                    $totalRecords = mysqli_num_rows($runQuery);
                                    
                                    if(mysqli_num_rows($runQuery) > 0){
                                              
                                    while($row = mysqli_fetch_array($runQuery)){
                                    $buildingId = $row['building_id'];
                                    $buildingName = ucwords($row['building_name']);
                                    
                                    ?>
                                    <option value="<?php echo $buildingId; ?>" data-ins_id="<?php echo $buildingId; ?>" <?php
                                    if(isset($eBuildingId)){
                                        if($eBuildingId == $buildingId){
                                          echo "selected";
                                        }
                                    }
                                    ?>
                                    ><?php echo $buildingName; ?></option>
                                    <?php
                                        }
                                    }
                                    else{
                                        echo "<option value=''>No Building Found</option>";
                                     }                       
                                ?>
                        </select>
                      </div>
                      <div class="form-group col-md-3">
                        <label for="consumption-date">Consumption Date</label>
                        <input type="date" class="form-control" name="consumption-date" id="consumption-date" value="<?php if(isset($eConsumptionDate)){echo $eConsumptionDate; }?>" placeholder="" required="required">
                      </div>

                      <div class="form-group col-md-3">
                        <label for="energyy_type">Energy Type</label>
                        <select class="form-control single-select" name="energy-type" id="energy-type" required="required">
                          <option value="gas" <?php if(isset($eEnergyType)){
                            if($eEnergyType == 'gas'){
                              echo "selected";
                            }
                          }?>>Gas</option>
                          <option value="water" <?php if(isset($eEnergyType)){
                            if($eEnergyType == 'water'){
                              echo "selected";
                            }
                          }?>>Water</option>
                          <option value="electricity" <?php if(isset($eEnergyType)){
                            if($eEnergyType == 'electricity'){
                              echo "selected";
                            }
                          }?>>Electricity</option>
                          <option value="fuel" <?php if(isset($eEnergyType)){
                            if($eEnergyType == 'fuel'){
                              echo "selected";
                            }
                          }?>>Fuel</option>
                        </select>
                      </div>

                      <div class="form-group col-md-3">
                        <label for="consumption">Consumption (<span id="unit"></span>)</label>
                        <input type="text"  value="<?php if(isset($eConsumption)){echo $eConsumption; }?>"  class="form-control" name="consumption" id="consumption" placeholder="" required="required">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="cost">Cost (&euro;)</label>
                        <input type="text"  value="<?php if(isset($eCost)){echo $eCost; }?>" class="form-control" name="cost" id="cost" placeholder="" required="required">
                      </div>
                     
                      <input type="hidden" value="<?php if(isset($eCost)){echo $eCostId; }?>" name="cost-id" >
                    </div>
                   

                      
                <div class="form-footer">
                  <button type="submit" name="upd_cost_btn" class="btn btn-success"><i class="fa fa-check-square-o"></i> SAVE</button>
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
  /* Update Cost Code Starting */
    if(isset($_POST['upd_cost_btn'])){
        $costId = $_POST['cost-id'];
        $buildingId = $_POST['building-id'];
        $consumptionDate = $_POST['consumption-date'];
        $energyType = $_POST['energy-type'];
        $consumption = $_POST['consumption'];
        $cost = $_POST['cost'];
    
            $query2 = "UPDATE `costs` SET `building_id` = '$buildingId', `consumption_date` = '$consumptionDate', `energy_type` = '$energyType', `consumption` = '$consumption', `cost` = '$cost', `updated_at` = CURRENT_TIMESTAMP WHERE `costs`.`cost_id` = '$costId'";
            $runQuery2 = mysqli_query($conn, $query2);

            if($runQuery2){
              echo'
                    <script type="text/javascript">
                    $(document).ready(function(){
                      swal({
                        title: "Good job!",
                        text: "Cost has been updated successfully.!",
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
  /* Update Cost Code Ending */
?>