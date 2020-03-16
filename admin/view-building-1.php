<?php
	include_once '../inc/db.php';

	$gasCost = '';
	$waterCost = '';
	$elecCost = '';
	$fuelCost = '';
	$buildingName = '';

	

	if(isset($_GET['view_b'])){
        $viewBuildingId = $_GET['view_b'];
        $query = "SELECT costs.cost_id, costs.building_id, buildings.building_name, costs.consumption_date, costs.gas_consumption, costs.gas_cost, costs.water_consumption, costs.water_cost, costs.electricity_consumption, costs.electricity_cost, costs.fuel_consumption, costs.fuel_cost, costs.created_at, costs.updated_at FROM costs INNER JOIN buildings ON costs.building_id = buildings.building_id WHERE costs.building_id = '$viewBuildingId'";

        $runQuery = mysqli_query($conn, $query);
        if(mysqli_num_rows($runQuery)>  0){
            while ($row = mysqli_fetch_array($runQuery)) {
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
<html>
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title>Accelerometer data</title>

		<style type="text/css">			
			body{
				font-family: Arial;
			    margin: 80px 100px 10px 100px;
			    padding: 0;
			    color: white;
			    text-align: center;
			    background: #555652;
			}

			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
			}
		</style>

	</head>

	<body>	   
	    <div class="container">	
	    <h1>USE CHART.JS WITH MYSQL DATASETS</h1>       
			<canvas id="chart" style="width: 100%; height: 65vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

			<script>
				var ctx = document.getElementById("chart").getContext('2d');
    			var myChart = new Chart(ctx, {
        		type: 'line',
		        data: {
		            labels: [<?php echo $buildingName; ?>],
		            datasets: 
		            [{
		                label: 'Gas',
		                data: [<?php echo $gasCost; ?>],
		                bbackgroundColor: 'transparent',
		                borderColor:'rgba(255,99,132)',
		                borderWidth: 3
		            },

		            {
		            	label: 'Water',
		                data: [<?php echo $waterCost; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,255,255)',
		                borderWidth: 3	
		            },

		            {
		            	label: 'Electricity',
		                data: [<?php echo $elecCost; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(0,0,255)',
		                borderWidth: 3	
		            },
		            {
		            	label: 'Fuel',
		                data: [<?php echo $fuelCost; ?>],
		                backgroundColor: 'transparent',
		                borderColor:'rgba(255,255,0)',
		                borderWidth: 3	
		            }]
		        },
		     
		        options: {
		            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
		            tooltips:{mode: 'index'},
		            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
		        }
		    });
			</script>
	    </div>
	    
	</body>
</html>