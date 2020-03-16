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



  $gasCost = '';
  $waterCost = '';
  $elecCost = '';
  $fuelCost = '';
  $buildingName = '';

  

  if(isset($_GET['view_b'])){
        $viewBuildingId = $_GET['view_b'];

        $query1 = "SELECT building_name FROM `buildings` WHERE building_id = '$viewBuildingId'";
        $runQuery1 = mysqli_query($conn, $query1);
        if(mysqli_num_rows($runQuery1)>  0){
            $row1= mysqli_fetch_array($runQuery1);
            
            $vBuildingName = ucwords($row1['building_name']);
            
         
        }


        $query = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, costs.gas_consumption, costs.gas_cost, costs.water_consumption, costs.water_cost, costs.electricity_consumption, costs.electricity_cost, costs.fuel_consumption, costs.fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id WHERE costs.building_id = '$viewBuildingId' ORDER BY cost_id DESC LIMIT 12";

        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery)>  0){
            while ($row = mysqli_fetch_array($runQuery)) {
          // $buildingName1 = $row['building_name'];
          $gasCost = $gasCost . '"'. $row['gas_cost'].'",';
          $waterCost = $waterCost . '"'. $row['water_cost'] .'",';
          $elecCost = $elecCost . '"'. $row['electricity_cost'] .'",';
          $fuelCost = $fuelCost . '"'. $row['fuel_cost'] .'",';
          $buildingName = $buildingName . '"'. ucwords($row['consumption_date']) .'",';
      }

      $gasCost = trim($gasCost,",");
      $waterCost = trim($waterCost,",");
      $elecCost = trim($elecCost,",");
      $fuelCost = trim($fuelCost,",");
      $buildingName = trim($buildingName,",");
         
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
  <title>All Buildings</title>
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

  <script type="text/javascript" src="assets/js/Chart.bundle.min.js"></script>
    <title>Accelerometer data</title>

    <style type="text/css">     
      .container {
      }
      #chart{
        
        /*background-color: #222;*/
      }
    </style>
  
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
		    <h4 class="page-title">All Buildings</h4>
		    <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javaScript:void();">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="javaScript:void();">Buildings</a></li>
            <li class="breadcrumb-item active" aria-current="page">All Buildings</li>
         </ol>
	   </div>
	   
     </div>
    <!-- End Breadcrumb-->
      
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> All Building List</div>
            <div class="card-body">
              <div class="container"> 
      <h1><?php if(isset($vBuildingName)){echo "Cost: " .$vBuildingName; }?></h1>       
      <canvas id="chart" style="width: 100%; height: 65vh; ; border: 1px solid #555652;"></canvas>

      <script>
        var ctx = document.getElementById("chart").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $buildingName; ?>],
                datasets: 
                [{
                    label: 'Gas',
                    data: [<?php echo $gasCost; ?>],
                    backgroundColor: 'rgba(63, 141, 118, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3
                },

                {
                  label: 'Water',
                    data: [<?php echo $waterCost; ?>],
                    backgroundColor: 'rgba(173, 131, 5, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },

                {
                  label: 'Electricity',
                    data: [<?php echo $elecCost; ?>],
                    backgroundColor: 'rgba(52, 114, 239, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },
                {
                  label: 'Fuel',
                    data: [<?php echo $fuelCost; ?>],
                    backgroundColor: 'rgba(142, 150, 205, 0.8)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                }]
            },
         
            options: {
                scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                tooltips:{mode: 'index'},
                legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,0,0)', fontSize: 16}}
            }
        });
      </script>
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
