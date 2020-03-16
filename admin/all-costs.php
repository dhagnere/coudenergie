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
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
  <meta name="description" content=""/>
  <meta name="author" content=""/>
  <title>All Costs</title>
  <!--favicon-->
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  <!-- simplebar CSS-->
  <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet"/>
  <!-- Bootstrap core CSS-->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
  <!--Data Tables -->
  <link href="assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
  <link href="assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">
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
		    <h4 class="page-title">All Costs</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Costs</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Costs</li>
         </ol>
	   </div>
	   
     </div>
    <!-- End Breadcrumb-->
      
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i>All Cost List</div>
            <div class="card-body">
              <div class="table-responsive">
              	<?php
                $query = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, costs.gas_consumption, costs.gas_cost, costs.water_consumption, costs.water_cost, costs.electricity_consumption, costs.electricity_cost, costs.fuel_consumption, costs.fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id ORDER BY costs.cost_id DESC";
                $runQuery = mysqli_query($conn, $query);
                    
                if(mysqli_num_rows($runQuery) > 0){
            	?>
              <table id="example" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Building Name</th>
                        <th>Date</th>
                        <th>Gas Consumption</th>
                        <th>Gas Cost</th>
                        <th>Water Consumption</th>
                        <th>Water Cost</th>
                        <th>Electricity Consumption</th>
                        <th>Electricity Cost</th>
                        <th>Fuel Consumption</th>
                        <th>Fuel Cost</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	<?php
                    $sr = 1;
                    while($row = mysqli_fetch_array($runQuery)){
                    $costId = $row['cost_id'];
                    $buildingId = $row['building_id'];
                    $buildingName = ucwords($row['building_name']);
                    $consumptionDate = $row['consumption_date'];
                    $gasCons = $row['gas_consumption'];
                    $gasCost = $row['gas_cost'];
                    $waterCons = $row['water_consumption'];
                    $waterCost = $row['water_cost'];
                    $elecCons = $row['electricity_consumption'];
                    $elecCost = $row['electricity_cost'];
                    $fuelCons = $row['fuel_consumption'];
                    $fuelCost = $row['fuel_cost'];
                    $createdAt = $row['created_at'];
                    $updatedAt = $row['updated_at'];
                ?>
                    <tr>
                        <td><?php if(isset($sr)){echo $sr; } ?></td>
                        <td><?php if(isset($buildingName)){echo $buildingName; } ?></td>
                        <td><?php if(isset($consumptionDate)){echo $consumptionDate; } ?></td>
                        <td><?php if(isset($gasCons)){echo $gasCons; } ?></td>
                        <td><?php if(isset($gasCost)){echo $gasCost; } ?></td>
                        <td><?php if(isset($waterCons)){echo $waterCons; } ?></td>
                        <td><?php if(isset($waterCost)){echo $waterCost; } ?></td>
                        <td><?php if(isset($elecCons)){echo $elecCons; } ?></td>
                        <td><?php if(isset($elecCost)){echo $elecCost; } ?></td>
                        <td><?php if(isset($fuelCons)){echo $fuelCons; } ?></td>
                        <td><?php if(isset($fuelCost)){echo $fuelCost; } ?></td>
                        <td><?php if(isset($createdAt)){echo $createdAt; } ?></td>
                        
                        <td><a href="edit-cost.php?edit_c=<?php echo $costId; ?>"><i class="fa fa-pencil fa-lg"></i></a> &emsp;
                         <a href="view-cost.php?view_c=<?php echo $costId; ?>"><i class="fa fa-eye fa-lg"></i></a> &emsp;  
                         
<!--                         	<a href="all-costs.php?del_b=<?php // echo $costId; ?>"><i class="fa fa-trash-o fa-lg"></i></a> -->
                      
                    </tr>
                    <?php
                    	$sr = $sr + 1;
                		}
            		?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Sr</th>
                        <th>Building Name</th>
                        <th>Date</th>
                        <th>Gas Consumption</th>
                        <th>Gas Cost</th>
                        <th>Water Consumption</th>
                        <th>Water Cost</th>
                        <th>Electricity Consumption</th>
                        <th>Electricity Cost</th>
                        <th>Fuel Consumption</th>
                        <th>Fuel Cost</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            <?php
                }
                else {
                    echo "<center><h4>No Data Found!</h4></center>";    
                }
            ?>
            </div>
            </div>
          </div>
        </div>
      </div><!-- End Row-->
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

  <!--Sweet Alerts -->
  <script src="assets/plugins/alerts-boxes/js/sweetalert.min.js"></script>
  <script src="assets/plugins/alerts-boxes/js/sweet-alert-script.js"></script>

  <!--Data Tables js-->
  <script src="assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>



    <script>
     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable();


       var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
      } );
 
     table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
      
      } );

    </script>
	
</body>
</html>

<?php
    // Delete Building Code Start
    if(isset($_GET['del_b'])){
        $delBuildingId = $_GET['del_b'];
        $query = "DELETE FROM `buildings` WHERE `buildings`.`building_id` = '$delBuildingId'";
       
           $runQuery = mysqli_query($conn, $query);
            if($runQuery){
                
                echo'
                <script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    title: "Warning",
                    text: "Building has been deleted successfully.!",
                    icon: "warning",
                    timer: 3500,
                  })
                });
                window.location.href = "all-buildings.php";
                </script>
              ';
            }
            else{
                echo'
                <script type="text/javascript">
                $(document).ready(function(){
                  swal({
                    title: "Oops",
                    text: "Something Went Wrong!",
                    icon: "danger",
                    timer: 2500,
                  })
                });
                </script>
              ';
            }
    }
    // Delete Building  Code End
   ?>
