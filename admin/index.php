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
  <title>Vue générale</title>
  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon"/>
  <!-- Vector CSS -->
  <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet"/>
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
   <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
   <!-- end loader -->

<!-- Start wrapper-->
 <div id="wrapper">
 
  <?php include_once 'inc/sidebar.php'; ?>

  <?php include_once '../inc/top-header.php'; ?>

<div class="clearfix"></div>
	
  <div class="content-wrapper">
    <div class="container-fluid">

      <!--Start Dashboard Content-->


       <div class="row mt-3">       
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
          

            $query1  = "SELECT SUM(gas_consumption) as gas_consumption FROM `costs`";
                $runQuery1 = mysqli_query($conn, $query1);

                  if(mysqli_num_rows($runQuery1)>  0){
                    $row = mysqli_fetch_array($runQuery1);
                    
                    $gasConsumption = $row['gas_consumption'];
                    
                }

          ?>
         <div class="card gradient-ohhappiness">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($gasConsumption)){echo $gasConsumption; }?> <span class="float-right"><i class="fa fa-fire"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Gaz total consommé en 2020 (MwH) </p>
            </div>
         </div>
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
            $query2  = "SELECT SUM(gas_cost) as gas_cost FROM `costs`";
                $runQuery2 = mysqli_query($conn, $query2);

                  if(mysqli_num_rows($runQuery2)>  0){
                    $row = mysqli_fetch_array($runQuery2);
                    
                    $gasCost = $row['gas_cost'];
                    
                }

          ?>
         <div class="card gradient-ohhappiness">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($gasCost)){echo $gasCost; }?> <span class="float-right"><i class="fa fa-eur"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Coût total gaz consommé en 2020 (Euros)</p>
            </div>
         </div>
       </div>

       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
        
            $query3  = "SELECT SUM(water_consumption) as water_consumption FROM `costs`";
                $runQuery3 = mysqli_query($conn, $query3);

                  if(mysqli_num_rows($runQuery3)>  0){
                    $row = mysqli_fetch_array($runQuery3);
                    
                    $waterCons = $row['water_consumption'];
                    
                }

          ?>
         <div class="card gradient-info">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($waterCons)){echo $waterCons; }?><span class="float-right"><i class="fa fa-tint"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Consommation totale eau en 2020 (m3)</p>
            </div>
         </div>
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
          

            $query4  = "SELECT SUM(water_cost) as water_cost FROM `costs`";
                $runQuery4 = mysqli_query($conn, $query4);

                  if(mysqli_num_rows($runQuery4)>  0){
                    $row = mysqli_fetch_array($runQuery4);
                    
                    $waterCost = $row['water_cost'];
                    
                }

          ?>
         <div class="card gradient-info">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($waterCost)){echo $waterCost; }?><span class="float-right"><i class="fa fa-eur"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">coût total eau consommée en 2020 (Euros) </p>
            </div>
         </div>
       </div>
       
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
            $query5  = "SELECT SUM(electricity_consumption) as electricity_consumption FROM `costs`";
                $runQuery5 = mysqli_query($conn, $query5);

                  if(mysqli_num_rows($runQuery5)>  0){
                    $row = mysqli_fetch_array($runQuery5);
                    
                    $elecCons = $row['electricity_consumption'];
                    
                }

          ?>
         <div class="card gradient-danger">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($elecCons)){echo $elecCons; }?><span class="float-right"><i class="fa fa-bolt"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Electricité conosmmée en 2020 (Kwh)</p>
            </div>
         </div> 
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
            $query6  = "SELECT SUM(electricity_cost) as electricity_cost FROM `costs`";
                $runQuery6 = mysqli_query($conn, $query6);

                  if(mysqli_num_rows($runQuery6)>  0){
                    $row = mysqli_fetch_array($runQuery6);
                    
                    $elecCost = $row['electricity_cost'];
                    
                }

          ?>
         <div class="card gradient-danger">
           <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($elecCost)){echo $elecCost; }?><span class="float-right"><i class="fa fa-eur"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Coût total electricté consommée en 2020 (Euros)</p>
            </div>
         </div> 
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
          

            $query7  = "SELECT SUM(fuel_consumption) as fuel_consumption FROM `costs`";
                $runQuery7 = mysqli_query($conn, $query7);

                  if(mysqli_num_rows($runQuery7)>  0){
                    $row = mysqli_fetch_array($runQuery7);
                    
                    $fuelCons = $row['fuel_consumption'];
                    
                }

          ?>
         <div class="card gradient-dark-light">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($fuelCons)){echo $fuelCons; }?><span class="float-right"><i class="fa fa-truck"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Fuel consommé en 2020 (Litres)</p>
            </div>
         </div>
       </div>
       <div class="col-12 col-lg-6 col-xl-3">
        <?php 
          

            $query8  = "SELECT SUM(fuel_cost) as fuel_cost FROM `costs`";
                $runQuery8 = mysqli_query($conn, $query8);

                  if(mysqli_num_rows($runQuery8)>  0){
                    $row = mysqli_fetch_array($runQuery8);
                    
                    $fuelCost = $row['fuel_cost'];
                    
                }

          ?>
         <div class="card gradient-dark-light">
            <div class="card-body">
              <h5 class="text-white mb-0"><?php if(isset($fuelCost)){echo $fuelCost; }?><span class="float-right"><i class="fa fa-eur"></i></span></h5>
                <div class="progress my-3" style="height:3px;">
                   <div class="progress-bar" style="width:55%"></div>
                </div>
              <p class="mb-0 text-white small-font">Coût total fuel consommé en 2020 (Euros)</p>
            </div>
         </div>
       </div>
       

       
     </div><!--End Row-->
     <div class="row">
      <div class="col-md-8">
       <form action="" method="post">
        <div class="row">
        
        <div class="form-group col-md-3">
            <label for="input-1">Bâtiment/lieu</label>
            <select class="form-control single-select" name="building-id" id="building_id" required="required">
                <option value="" hidden selected readonly>Choix du bâtiment/lieu</option>
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
                            echo "<option value=''>Aucun bâtiment ou lieu dans la base !</option>";
                         }                       
                    ?>
            </select>
        </div>
        <div class="col-md-3 form-group">
          <label for="">nombre de mois</label>
          <input type="number" name="last-month" class="form-control" required="required">
        </div>
        <div class="col-md-3">
          <br>
          <input type="submit" class="btn btn-info btn-lg" value="Rechercher" name="graph_btn">
        </div>
        
        
        </div>
        </form>


       
      </div>
      <div class="col-md-4">
        <form action="" method="post">
          <div class="row">
            <div class="col-md-3">
                  <br>
                  <input type="submit" class="btn btn-info btn-lg" value="Tous les batiments" name="all_graph_btn">
                </div>
          </div>
        </form>
      </div>
       <div class="col-md-12">
         <?php
              $gasCost = '';
              $waterCost = '';
              $elecCost = '';
              $fuelCost = '';
              $buildingName = '';


              if(isset($_POST['graph_btn'])){
                $buildId = $_POST['building-id'];
                $month = $_POST['last-month'];

                $graph  = 1;

                  $query9 = "SELECT building_name FROM `buildings` WHERE building_id = '$buildId'";
                    $runQuery9 = mysqli_query($conn, $query9);
                    if(mysqli_num_rows($runQuery9)>  0){
                        $row9= mysqli_fetch_array($runQuery9);
                        
                        $vBuildingName = ucwords($row9['building_name']);
                        
                     
                    }

                    $query10 = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, costs.gas_consumption, costs.gas_cost, costs.water_consumption, costs.water_cost, costs.electricity_consumption, costs.electricity_cost, costs.fuel_consumption, costs.fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id WHERE costs.building_id = '$buildId' ORDER BY costs.cost_id DESC LIMIT $month";

                    $runQuery10 = mysqli_query($conn, $query10);
             

                    


                    
                    if(mysqli_num_rows($runQuery10)>  0){
                        while ($row10 = mysqli_fetch_array($runQuery10)) {
                      // $buildingName1 = $row['building_name'];
                      $gasCost = $gasCost . '"'. $row10['gas_cost'].'",';
                      $waterCost = $waterCost . '"'. $row10['water_cost'] .'",';
                      $elecCost = $elecCost . '"'. $row10['electricity_cost'] .'",';
                      $fuelCost = $fuelCost . '"'. $row10['fuel_cost'] .'",';
                      $buildingName = $buildingName . '"'. ucwords($row10['consumption_date']) .'",';
                  }

                  $gasCost = trim($gasCost,",");
                  $waterCost = trim($waterCost,",");
                  $elecCost = trim($elecCost,",");
                  $fuelCost = trim($fuelCost,",");
                  $buildingName = trim($buildingName,",");
                     
                    }
                }
         ?>
       </div>

       <div class="col-md-12">
         <?php
              $gasCons = '';
              $waterCons = '';
              $elecCons = '';
              $fuelCons = '';
              $buildingName1 = '';

              if(isset($_POST['graph_btn'])){
                $buildId1 = $_POST['building-id'];
                $month1 = $_POST['last-month'];

                $graph = 1;

                    $query11 = "SELECT building_name FROM `buildings` WHERE building_id = '$buildId1'";
                    $runQuery11 = mysqli_query($conn, $query11);
                    if(mysqli_num_rows($runQuery11)>  0){
                        $row11= mysqli_fetch_array($runQuery11);
                        
                        $vBuildingName2 = ucwords($row9['building_name']);
                        
                     
                    }


                    $query12 = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, costs.gas_consumption, costs.gas_cost, costs.water_consumption, costs.water_cost, costs.electricity_consumption, costs.electricity_cost, costs.fuel_consumption, costs.fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id WHERE costs.building_id = '$buildId1' ORDER BY costs.cost_id DESC LIMIT $month1";

                    $runQuery12 = mysqli_query($conn, $query12);
                    if(mysqli_num_rows($runQuery12)>  0){
                        while ($row12 = mysqli_fetch_array($runQuery12)) {
                      // $buildingName1 = $row['building_name'];
                      $gasCons = $gasCons . '"'. $row12['gas_consumption'].'",';
                      $waterCons = $waterCons . '"'. $row12['water_consumption'] .'",';
                      $elecCons = $elecCons . '"'. $row12['electricity_consumption'] .'",';
                      $fuelCons = $fuelCons . '"'. $row12['fuel_consumption'] .'",';
                      $buildingName1 = $buildingName1 . '"'. ucwords($row12['consumption_date']) .'",';
                  }

                  $gasCons = trim($gasCons,",");
                  $waterCons = trim($waterCons,",");
                  $elecCons = trim($elecCons,",");
                  $fuelCons = trim($fuelCons,",");
                  $buildingName1 = trim($buildingName1,",");
                     
                    }
                  }
               
         ?>
       </div>


       <div class="col-md-12">
         <?php
              $aGasCost = '';
              $aWaterCost = '';
              $aElecCost = '';
              $aFuelCost = '';
              $aBuildingName = '';


              if(isset($_POST['all_graph_btn'])){

                $all_graph = 1;
                

                    $query13 = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, SUM(costs.gas_consumption) as gas_consumption, SUM(costs.gas_cost) as gas_cost, SUM(costs.water_consumption) as water_consumption, SUM(costs.water_cost) as water_cost, SUM(costs.electricity_consumption) as electricity_consumption, SUM(costs.electricity_cost) as electricity_cost, SUM(costs.fuel_consumption) as fuel_consumption, SUM(costs.fuel_cost) as fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id GROUP BY buildings.building_id";

                    $runQuery13 = mysqli_query($conn, $query13);
            
                    
                    if(mysqli_num_rows($runQuery13)>  0){
                        while ($row13 = mysqli_fetch_array($runQuery13)) {
                      $aGasCost = $aGasCost . '"'. $row13['gas_cost'].'",';
                      $aWaterCost = $aWaterCost . '"'. $row13['water_cost'] .'",';
                      $aElecCost = $aElecCost . '"'. $row13['electricity_cost'] .'",';
                      $aFuelCost = $aFuelCost . '"'. $row13['fuel_cost'] .'",';
                      $aBuildingName = $aBuildingName . '"'. ucwords($row13['building_name']) .'",';
                  }

                  $aGasCost = trim($aGasCost,",");
                  $aWaterCost = trim($aWaterCost,",");
                  $aElecCost = trim($aElecCost,",");
                  $aFuelCost = trim($aFuelCost,",");
                  $aBuildingName = trim($aBuildingName,",");
                     
                    }
                }
         ?>
       </div>

       <div class="col-md-12">
         <?php
              $aGasCons = '';
              $aWaterCons = '';
              $aElecCons = '';
              $aFuelCons = '';
              $aBuildingName1 = '';

              if(isset($_POST['all_graph_btn'])){

                $all_graph = 1;


                    $query14 = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, SUM(costs.gas_consumption) as gas_consumption, SUM(costs.gas_cost) as gas_cost, SUM(costs.water_consumption) as water_consumption, SUM(costs.water_cost) as water_cost, SUM(costs.electricity_consumption) as electricity_consumption, SUM(costs.electricity_cost) as electricity_cost, SUM(costs.fuel_consumption) as fuel_consumption, SUM(costs.fuel_cost) as fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id GROUP BY buildings.building_id";

                    $runQuery14 = mysqli_query($conn, $query14);
                    if(mysqli_num_rows($runQuery14)>  0){
                        while ($row14 = mysqli_fetch_array($runQuery14)) {
                      // $buildingName1 = $row['building_name'];
                      $aGasCons = $aGasCons . '"'. $row14['gas_consumption'].'",';
                      $aWaterCons = $aWaterCons . '"'. $row14['water_consumption'] .'",';
                      $aElecCons = $aElecCons . '"'. $row14['electricity_consumption'] .'",';
                      $aFuelCons = $aFuelCons . '"'. $row14['fuel_consumption'] .'",';
                      $aBuildingName1 = $aBuildingName1 . '"'. ucwords($row14['building_name']) .'",';
                  }

                  $aGasCons = trim($aGasCons,",");
                  $aWaterCons = trim($aWaterCons,",");
                  $aElecCons = trim($aElecCons,",");
                  $aFuelCons = trim($aFuelCons,",");
                  $aBuildingName1 = trim($aBuildingName1,",");
                     
                    }
                  }
               
         ?>
       </div>

       

     </div>


     <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Bâtiment séléctionné</div>
            <div class="card-body">
              <div class="container">
                <h1>Coûts en Euro</h1>
                 <canvas id="chart" style="width: 100%; height: 65vh; ; border: 1px solid #555652;"></canvas>
                 <br><br><br>
                 <h1>Consommations</h1>
                 <canvas id="chartt" style="width: 100%; height: 65vh; ; border: 1px solid #555652;"></canvas>
                 <h1>Coûts en Euro</h1>
                 <canvas id="charttt" style="width: 100%; height: 65vh; ; border: 1px solid #555652;"></canvas>
                 <br><br><br>
                 <h1>Consommations</h1>
                 <canvas id="chartttt" style="width: 100%; height: 65vh; ; border: 1px solid #555652;"></canvas>
               
          

         
              </div>
            </div>
          </div>
        </div>
      </div>

      <!--End Dashboard Content-->
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
  <!-- loader scripts -->
  <script src="assets/js/jquery.loading-indicator.js"></script>
  <!-- Custom scripts -->
  <script src="assets/js/app-script.js"></script>
  <!-- Chart js -->
  
  <script src="assets/plugins/Chart.js/Chart.min.js"></script>
  <!-- Vector map JavaScript -->
  <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Easy Pie Chart JS -->
  <script src="assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
  <!-- Sparkline JS -->
  <script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
  <script src="assets/plugins/jquery-knob/excanvas.js"></script>
  <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
    
    <script>
        $(function() {
            $(".knob").knob();
        });
    </script>
  <!-- Index js -->
  <script src="assets/js/index.js"></script>


  <script>
        var ctx = document.getElementById("chart").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $buildingName; ?>],
                datasets: 
                [{
                    label: 'Gaz',
                    data: [<?php echo $gasCost; ?>],
                    backgroundColor: 'rgba(63, 141, 118, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3
                },

                {
                  label: 'Eau',
                    data: [<?php echo $waterCost; ?>],
                    backgroundColor: 'rgba(0, 132, 255, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },

                {
                  label: 'Electricité',
                    data: [<?php echo $elecCost; ?>],
                    backgroundColor: 'rgba(251, 59, 85, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },
                {
                  label: 'Fuel',
                    data: [<?php echo $fuelCost; ?>],
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                }]
            },
         
            options: {
                scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                tooltips:{mode: 'index'},
                legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 16}}
            }
        });


          var ctx2 = document.getElementById("chartt").getContext('2d');
          var myChart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: [<?php echo $buildingName1; ?>],
                datasets: 
                [{
                    label: 'Gas',
                    data: [<?php echo $gasCons; ?>],
                    backgroundColor: 'rgba(63, 141, 118, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3
                },

                {
                  label: 'Water',
                    data: [<?php echo $waterCons; ?>],
                    backgroundColor: 'rgba(0, 132, 255, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },

                {
                  label: 'Electricity',
                    data: [<?php echo $elecCons; ?>],
                    backgroundColor: 'rgba((251, 59, 85, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },
                {
                  label: 'Fuel',
                    data: [<?php echo $fuelCons; ?>],
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
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



var ctx3 = document.getElementById("charttt").getContext('2d');
          var myChart = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: [<?php echo $aBuildingName; ?>],
                datasets: 
                [{
                    label: 'Gas',
                    data: [<?php echo $aGasCost; ?>],
                    backgroundColor: 'rgba(63, 141, 118, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3
                },

                {
                  label: 'Water',
                    data: [<?php echo $aWaterCost; ?>],
                    backgroundColor: 'rgba(0, 132, 255, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },

                {
                  label: 'Electricity',
                    data: [<?php echo $aElecCost; ?>],
                    backgroundColor: 'rgba(251, 59, 85, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },
                {
                  label: 'Fuel',
                    data: [<?php echo $aFuelCost; ?>],
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
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


          var ctx4 = document.getElementById("chartttt").getContext('2d');
          var myChart2 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: [<?php echo $aBuildingName1; ?>],
                datasets: 
                [{
                    label: 'Gas',
                    data: [<?php echo $aGasCons; ?>],
                    backgroundColor: 'rgba(63, 141, 118, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3
                },

                {
                  label: 'Water',
                    data: [<?php echo $aWaterCons; ?>],
                    backgroundColor: 'rgba(0, 132, 255, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },

                {
                  label: 'Electricity',
                    data: [<?php echo $aElecCons; ?>],
                    backgroundColor: 'rgba(251, 59, 85, 1)',
                    borderColor:'rgba(255,255,255)',
                    borderWidth: 3  
                },
                {
                  label: 'Fuel',
                    data: [<?php echo $aFuelCons; ?>],
                    backgroundColor: 'rgba(0, 0, 0, 0.5)',
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

  
</body>
</html>
