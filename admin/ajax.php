<?php
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
     if(!null == ob_start()) 
    { 
        ob_start(); 
    }
    include_once '../inc/db.php';
    // include_once 'DataOperations.php';
    //include_once 'inc/top.php';
?>
<?php

if(isset($_POST['building_id']) && !empty($_POST['building_id'])){
    $buildingId = $_POST['building_id'];
    $query = "SELECT energy_types FROM `buildings` WHERE building_id = '$buildingId'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){


        echo '<option value="" hidden selected readonly>Choose Energy Type</option>';
             while($row = mysqli_fetch_array($run_query)){
                $eEnergyTypes = $row['energy_types'];
                $eEnergyType = explode(", ", $eEnergyTypes);
                    foreach($eEnergyType as $x => $value){
                        echo '<option value="'.$value.'" data-energy_type="'.$value.'">'.ucwords($value).'</option>';
                    }
            
        }
      }
    else{
        echo '<option value="">Energy Type Not Found</option>';
    }

}

if(isset($_POST['assignment_session']) && !empty($_POST['assignment_session'])){
    $session_name = $_POST['assignment_session'];
    $query = "SELECT teacher_assign.dept_id, departments.dept_name from teacher_assign inner JOIN departments on teacher_assign.dept_id = departments.dept_id WHERE teacher_assign.session = '$session_name' GROUP BY departments.dept_name";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        echo '<option value="">Choose Department</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['dept_id'].'" data-dept_id="'.$row['dept_id'].'">'.ucwords($row['dept_name']).'</option>';
        }
      }
    else{
        echo '<option value="">Departments Not Found</option>';
    }

}


if(isset($_POST['dept_id']) && !empty($_POST['dept_id'])){
    $dept_id = $_POST['dept_id'];
    $query = "SELECT students.degree_id, degrees.degree_name from students inner JOIN degrees on students.degree_id = degrees.degree_id WHERE students.dept_id = '$dept_id' GROUP BY degrees.degree_name";
    //echo "I am working";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){

        echo '<option value="">Choose Degree</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['degree_id'].'" data-degree_id="'.$row['degree_id'].'">'.ucwords($row['degree_name']).'</option>';
        }
      }
    else{
        echo '<option value="">Degrees Not Found</option>';
    }
       
    }


 if(isset($_POST['degree_id']) && !empty($_POST['degree_id'])){
    $degree_id = $_POST['degree_id'];
    $query = "SELECT DISTINCT semester from students WHERE degree_id = '$degree_id'";
    //echo "I am working";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){

        echo '<option value="">Choose Semester</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['semester'].'" data-semester_id="'.$row['semester'].'">'.$row['semester'].'</option>';
        }
      }
    else{
        echo '<option value="">Semester Not Found</option>';
    }
       
    }


 if(isset($_POST['degree_id1']) && isset($_POST['semester_id1']) && !empty($_POST['degree_id1']) && !empty($_POST['semester_id1'])){
    $degree_id1 = $_POST['degree_id1'];
    $semester_id1 = $_POST['semester_id1'];
    // echo '<script>alert("'.$semester.'")</script>';
    
    $query = "SELECT * FROM `subjects` WHERE degree_id = '$degree_id1' AND semester = '$semester_id1' AND sub_status = 1";
    //echo "I am working";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){

        echo '<option value="">Choose Course</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['sub_id'].'" data-course_id="'.$row['sub_id'].'">'.$row['sub_code'].'</option>';
        }
      }
    else{
        echo '<option value="">Course Not Found</option>';
    }
       
    }
    


if(isset($_REQUEST['add_vehicle_rate'])){
        
        $myArray = array(
        "User_Id" => $session_user_id,            
        "Vehicle_Name" => $_POST["vehicle_name"],
        "Vehicle_Route" => $_POST['vehicle_route'],
        "Vehicle_Capacity" => $_POST['vehicle_capacity'],
        "PPP_Offered" => $_POST['ppp_offered'],
        "Vehicle_Charges" => $_POST['vehicle_charges']    
        );
        $insert_vehicle_rates = new DataOperations;
        $message = $insert_vehicle_rates->insertRecord("vehicle_rates", $myArray);
        
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }
    }
if(isset($_REQUEST['display_vehicle_rates'])){
        $fetch_vrates_query = "SELECT `Id`, `Vehicle_Name`, `Vehicle_Route`, `Vehicle_Capacity`, `PPP_Offered`, `Vehicle_Charges` FROM `vehicle_rates` WHERE `vehicle_rates`.`User_Id` = $session_user_id";
        $fetch_vrates_run_query = mysqli_query($conn, $fetch_vrates_query);
        if(mysqli_num_rows($fetch_vrates_run_query) > 0){
            //$vrates_sr = 1;
            while($row = mysqli_fetch_array($fetch_vrates_run_query)){
                $id = $row['Id'];
                $f_vehicle_name = $row['Vehicle_Name'];
                $f_vehicle_route = $row['Vehicle_Route'];
                $f_vehicle_capacity = $row['Vehicle_Capacity'];
                $f_ppp_offered = $row['PPP_Offered'];
                $f_vehicle_charges = $row['Vehicle_Charges'];
            echo "
            <tr>
                <td>$id</td>
                <td>$f_vehicle_name</td>
                <td>$f_vehicle_route</td>
                <td>$f_vehicle_capacity</td>
                <td>$f_ppp_offered</td>
                <td>$f_vehicle_charges</td>
                <td align='center'><a href='Javascript:void(0)' onclick='editVehicleRate($id);' data-edit_veh_id='$id' id='abc'><i class='fa fa-edit fa-lg'></i></a></td>
                <td align='center'><a href='Javascript:void(0)' onclick='deleteVehicleRate($id);'><i class='fa fa-trash-o fa-lg'></i></a></td>
            </tr>";
            //$vrates_sr = $vrates_sr + 1;
            }
        }

    else {
        echo "<tr>
        <td colspan='8'><center><h4>Vehicle Rates Data not Available.</h4></center></td>
        </tr>";    
        }
}
if(isset($_REQUEST['edit_vehicle_rate'])){
        $vrate_edit_id = $_POST['id'];
    //echo $vrate_edit_id;
        $query = "SELECT `Id`, `Vehicle_Name`,`Vehicle_Route`,`Vehicle_Capacity`,`PPP_Offered`, `Vehicle_Charges` FROM `vehicle_rates` WHERE `vehicle_rates`.`Id` = $vrate_edit_id";
        $run_query = mysqli_query($conn, $query);
        if(mysqli_num_rows($run_query)>  0){
            while($edit_row = mysqli_fetch_array($run_query)){
                $update_id = $edit_row['Id'];
                $e_vName = $edit_row['Vehicle_Name'];
                $e_vRoute = $edit_row['Vehicle_Route'];
                $e_vCapacity = $edit_row['Vehicle_Capacity'];
                $e_pppOffered = $edit_row['PPP_Offered'];
                $e_vCharges = $edit_row['Vehicle_Charges'];
                
                echo $update_id.",".$e_vName.",".$e_vRoute.",".$e_vCapacity.",".$e_pppOffered.",".$e_vCharges;      
           }
        }
    }
if(isset($_REQUEST['delete_vehicle_rate'])){
        
        $id = $_POST['id'];
        $where = array("Id"=>$id,
                      "User_Id"=>$session_user_id
                      );
        $del_vehicle_rate = new DataOperations;
        
        $message = $del_vehicle_rate->deleteRecord("vehicle_rates", $where);
        if($message){
            echo $message;
        }
        else{
            echo "Data not deleted";
        }  
    }
if(isset($_REQUEST['update_vehicle_rate'])){
    $id = $_POST["id"];
    
        $where = array("Id"=>$id);
        $myArray = array(
        "Vehicle_Name" => $_POST["vehicle_name"],    
        "Vehicle_Route" => $_POST['vehicle_route'],
        "Vehicle_Capacity" => $_POST['vehicle_capacity'],
        "PPP_Offered" => $_POST['ppp_offered'],
        "Vehicle_Charges" => $_POST['vehicle_charges'] 
        );
        
        $update_vehicle_rate = new DataOperations;
        $message = $update_vehicle_rate->updateRecord("vehicle_rates",$where, $myArray);
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }   
    }

if(isset($_REQUEST['add_destination'])){
        $date_interval = $_POST['night1'];
        $date = new DateTime($_POST['check_in1']);
        $date->add(new DateInterval('P'.$date_interval.'D'));
        
        $myArray = array(
        "User_Id" => $session_user_id,            
        "City" => $_POST["city1"],    
        "Check_In" => $_POST['check_in1'],
        "Check_Out" => $date->format('Y-m-d'),
        "Nights" => $_POST['night1']    
        );
        $insert_data = new DataOperations;
        $message = $insert_data->insertRecord("destination_plan", $myArray);
        
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }
    }
if(isset($_REQUEST['display_destination_plan'])){
        $display_data = new DataOperations;
        $show_data = $display_data->displayRecord("destination_plan");
            foreach ($show_data as $row) {
                $id = $row['Id'];
                $city = ucfirst($row['City']);
                $check_in = $row['Check_In'];
                $check_out = $row['Check_Out'];
                $nights = $row['Nights'];
                
                $check_in1 = date("d-m-Y", strtotime($check_in));
                $check_out1 = date("d-m-Y", strtotime($check_out));
                
                echo "<tr>
                    <td>$city</td>
                    <td>$check_in1</td>
                    <td>$check_out1</td>
                    <td>$nights</td>
                    <td align='center'><a href='Javascript:void(0)' onclick='deleteData($id);' id='del_data'><i class='fa fa-trash-o fa-lg'></i></a></td>
                </tr>"; 
                    }    
                 }
if(isset($_REQUEST['delete_data'])){
        //$id = $_POST['id'];

        //$del_data = DataOperations::deleteData($id);
        //echo $del_data;
        $id = $_POST['id']; //?? null;
        $where = array("Id"=>$id);
        $del_data = new DataOperations;
        
        $message = $del_data->deleteRecord("destination_plan", $where);
        if($message){
            echo $message;
        }
        else{
            echo "Data not deleted";
        }  
    }

if(isset($_REQUEST['add_room_rates'])){
        
        $myArray = array(    
        "User_Id" => $session_user_id,            
        "Hotel_Id" => $_POST['hotel_id'],    
        "Hotel_Name" => $_POST['hotel_name'],
        "From_Date" => $_POST['from_date'],
        "To_Date" => $_POST['to_date'],
        "Rate_Type" => $_POST['rate_type'],
        "Room_Type" => $_POST['room_type'],
        "DBL" => $_POST['dbl'],
        "TPL" => $_POST['tpl'],
        "QD" => $_POST['qd'],
        "JS" => $_POST['js'],
        "ES4" => $_POST['es4'],
        "ES6" => $_POST['es6'],
        "FS" => $_POST['fs'],
        "S2R" => $_POST['s2r'],
        "PS" => $_POST['ps']
            
        );
        $insert_rrates = new DataOperations;
        $message = $insert_rrates->insertRecord("room_rates", $myArray);
        
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }
    }

if(isset($_POST['cate_id']) && !empty($_POST['cate_id'])){
    $cate_id = $_POST['cate_id'];
    $query = "SELECT Id, Hotel_Name FROM `cu_hotels` WHERE `cu_hotels`.`User_Id` = $session_user_id AND `Id` = '$cate_id' AND `Hotel_Location` = 'makkah'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        echo '<option value="">Select Hotel</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['Hotel_Name'].'" data-hotel_id="'.$row['Id'].'">'.$row['Hotel_Name'].'</option>';
        }
      }
    else{
        echo '<option value="">Hotel data not available</option>';
    }

}
if(isset($_POST['hotel_id']) && !empty($_POST['hotel_id'])){
    $hotel_id = $_POST['hotel_id'];
    $query = "SELECT Id, Room_Type FROM `room_rates` WHERE `room_rates`.`User_Id` = $session_user_id AND `Hotel_Id` = '$hotel_id'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        echo '<option value="">Select Service</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['Room_Type'].'" data-service_id="'.$row['Id'].'">'.$row['Room_Type'].'</option>';
        }
      }
    else{
        echo '<option value="">Data not available</option>';
    }

}
if(isset($_POST['services']) && !empty($_POST['services'])){
    $services = $_POST['services'];
    $query = "SELECT DBL, TPL, QD, JS, ES4, ES6, FS, S2R, PS FROM `room_rates` WHERE `room_rates`.`User_Id` = $session_user_id AND `Id` = $services";
    //echo "I am working";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $dbl_price = $row['DBL'];
            $tpl_price = $row['TPL'];
            $qd_price = $row['QD'];
            $js_price = $row['JS'];
            $es4_price = $row['ES4'];
            $es6_price = $row['ES6'];
            $fs_price = $row['FS'];
            $s2r_price = $row['S2R'];
            $ps_price = $row['PS'];
        }
            echo $dbl_price.",".$tpl_price.",".$qd_price.",".$js_price.",".$es4_price.",".$es6_price.",".$fs_price.",".$s2r_price.",".$ps_price;
        
            
        }
    }
if(isset($_REQUEST['add_makkah'])){
        $myArray = array(              
        "User_Id" => $session_user_id,            
        "Makkah_Hotel_Category" => $_POST['hotel_category'],    
        "Makkah_Hotel_Name" => $_POST['hotel_name'],
        "Makkah_Hotel_Service" => $_POST['hotel_service'],
        "Makkah_Hotel_DBL" => $_POST['dbl_total_price'],
        "Makkah_Hotel_TPL" => $_POST['tpl_total_price'],
        "Makkah_Hotel_QD" => $_POST['qd_total_price'],
        "Makkah_Hotel_JS" => $_POST['js_total_price'],
        "Makkah_Hotel_ES4" => $_POST['es4_total_price'],
        "Makkah_Hotel_ES6" => $_POST['es6_total_price'],
        "Makkah_Hotel_FS" => $_POST['fs_total_price'],
        "Makkah_Hotel_S2R" => $_POST['s2r_total_price'],
        "Makkah_Hotel_PS" => $_POST['ps_total_price'],
        "Makkah_Accomdation_Total" => $_POST['makkah_accom_total']
            
        );
        $insert_makkah_accom = new DataOperations;
        $message = $insert_makkah_accom->insertRecord("makkah_accomdation", $myArray);
        
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }
    }
if(isset($_REQUEST['display_mak_accom'])){
        $display_accomd = new DataOperations;
        $show_accomd = $display_accomd->displayRecord("makkah_accomdation");
            foreach ($show_accomd as $row) {
                $id = $row['Id'];
                $mak_hot_cate = $row['Makkah_Hotel_Category'];
                $mak_hot_name = $row['Makkah_Hotel_Name'];
                $mak_hot_service = $row['Makkah_Hotel_Service'];
                $mak_hot_dbl = $row['Makkah_Hotel_DBL'];
                $mak_hot_tpl = $row['Makkah_Hotel_TPL'];
                $mak_hot_qd = $row['Makkah_Hotel_QD'];
                $mak_hot_js = $row['Makkah_Hotel_JS'];
                $mak_hot_es4 = $row['Makkah_Hotel_ES4'];
                $mak_hot_es6 = $row['Makkah_Hotel_ES6'];
                $mak_hot_fs = $row['Makkah_Hotel_FS'];
                $mak_hot_s2r = $row['Makkah_Hotel_S2R'];
                $mak_hot_ps = $row['Makkah_Hotel_PS'];
                $mak_accom_total = $row['Makkah_Accomdation_Total'];
                
                
                echo "<tr>
                    <td>$mak_hot_cate</td>
                    <td>$mak_hot_name</td>
                    <td>$mak_hot_service</td>
                    <td>$mak_hot_dbl</td>
                    <td>$mak_hot_tpl</td>
                    <td>$mak_hot_qd</td>
                    <td>$mak_hot_js</td>
                    <td>$mak_hot_es4</td>
                    <td>$mak_hot_es6</td>
                    <td>$mak_hot_fs</td>
                    <td>$mak_hot_s2r</td>
                    <td>$mak_hot_ps</td>
                    <td align='center'><a href='Javascript:void(0)' onclick='deleteAccomdation($id);' id='del_accom'><i class='fa fa-trash-o fa-lg'></i></a></td>
                    <td style='display:none;'><input type='text' value='$mak_accom_total' id='mak_accom_total_price' class='form-control input-sm'></td>
                </tr>"; 
                    }    
                 }
if(isset($_REQUEST['delete_mak_accom'])){
        
        $id = $_POST['id'];
        $where = array("Id"=>$id);
        $del_accom = new DataOperations;
        
        $message = $del_accom->deleteRecord("makkah_accomdation", $where);
        if($message){
            echo $message;
        }
        else{
            echo "Data not deleted";
        }  
    }

if(isset($_POST['madina_hotel_cate_id']) && !empty($_POST['madina_hotel_cate_id'])){
    $mad_hot_cate_id = $_POST['madina_hotel_cate_id'];
    $query = "SELECT Id, Hotel_Name FROM `cu_hotels` WHERE `cu_hotels`.`User_Id` = $session_user_id AND `Id` = '$mad_hot_cate_id' AND `Hotel_Location` = 'madina'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        echo '<option value="">Select Hotel</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['Hotel_Name'].'" data-mad_hotel_id="'.$row['Id'].'">'.$row['Hotel_Name'].'</option>';
        }
      }
    else{
        echo '<option value="">Hotel data not available</option>';
    }

}
if(isset($_POST['madina_hotel_id']) && !empty($_POST['madina_hotel_id'])){
    $madina_hotel_id = $_POST['madina_hotel_id'];
    $query = "SELECT Id, Room_Type FROM `room_rates` WHERE `room_rates`.`User_Id` = $session_user_id AND `Hotel_Id` = '$madina_hotel_id'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        echo '<option value="">Select Service</option>';
             while($row = mysqli_fetch_array($run_query)){
            echo '<option value="'.$row['Room_Type'].'" data-mad_hotel_service_id="'.$row['Id'].'">'.$row['Room_Type'].'</option>';
        }
      }
    else{
        echo '<option value="">Room Type data not available</option>';
    }

}
if(isset($_POST['mad_hotel_services']) && !empty($_POST['mad_hotel_services'])){
    $mad_hotel_services = $_POST['mad_hotel_services'];
    $query = "SELECT DBL, TPL, QD, JS, ES4, ES6, FS, S2R, PS FROM `room_rates` WHERE `room_rates`.`User_Id` = $session_user_id AND `Id` = $mad_hotel_services";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $dbl_price = $row['DBL'];
            $tpl_price = $row['TPL'];
            $qd_price = $row['QD'];
            $js_price = $row['JS'];
            $es4_price = $row['ES4'];
            $es6_price = $row['ES6'];
            $fs_price = $row['FS'];
            $s2r_price = $row['S2R'];
            $ps_price = $row['PS'];
        }
            echo $dbl_price.",".$tpl_price.",".$qd_price.",".$js_price.",".$es4_price.",".$es6_price.",".$fs_price.",".$s2r_price.",".$ps_price;   
        }
    }
if(isset($_REQUEST['add_mad'])){
        $myArray = array(              
        "User_Id" => $session_user_id,            
        "Madina_Hotel_Category" => $_POST['hotel_category'],    
        "Madina_Hotel_Name" => $_POST['hotel_name'],
        "Madina_Hotel_Service" => $_POST['hotel_service'],
        "Madina_Hotel_DBL" => $_POST['dbl_total_price'],
        "Madina_Hotel_TPL" => $_POST['tpl_total_price'],
        "Madina_Hotel_QD" => $_POST['qd_total_price'],
        "Madina_Hotel_JS" => $_POST['js_total_price'],
        "Madina_Hotel_ES4" => $_POST['es4_total_price'],
        "Madina_Hotel_ES6" => $_POST['es6_total_price'],
        "Madina_Hotel_FS" => $_POST['fs_total_price'],
        "Madina_Hotel_S2R" => $_POST['s2r_total_price'],
        "Madina_Hotel_PS" => $_POST['ps_total_price'],
        "Madina_Accomdation_Total" => $_POST['madina_accom_total_price']
        );
        $insert_madina_accom = new DataOperations;
        $message = $insert_madina_accom->insertRecord("madina_accomdation", $myArray);
        
        if($message){
            echo $message;
        }    
        else{
            echo "Data not Saved.";
        }
    }
if(isset($_REQUEST['display_mad_accom'])){
        $display_mad_accomd = new DataOperations;
        $show_mad_accomd = $display_mad_accomd->displayRecord("madina_accomdation");
            foreach ($show_mad_accomd as $row) {
                $id = $row['Id'];
                $mak_hot_cate = $row['Madina_Hotel_Category'];
                $mak_hot_name = $row['Madina_Hotel_Name'];
                $mak_hot_service = $row['Madina_Hotel_Service'];
                $mak_hot_dbl = $row['Madina_Hotel_DBL'];
                $mak_hot_tpl = $row['Madina_Hotel_TPL'];
                $mak_hot_qd = $row['Madina_Hotel_QD'];
                $mak_hot_js = $row['Madina_Hotel_JS'];
                $mak_hot_es4 = $row['Madina_Hotel_ES4'];
                $mak_hot_es6 = $row['Madina_Hotel_ES6'];
                $mak_hot_fs = $row['Madina_Hotel_FS'];
                $mak_hot_s2r = $row['Madina_Hotel_S2R'];
                $mak_hot_ps = $row['Madina_Hotel_PS'];
                $mad_accom_total = $row['Madina_Accomdation_Total'];
                
                
                echo "<tr>
                    <td>$mak_hot_cate</td>
                    <td>$mak_hot_name</td>
                    <td>$mak_hot_service</td>
                    <td>$mak_hot_dbl</td>
                    <td>$mak_hot_tpl</td>
                    <td>$mak_hot_qd</td>
                    <td>$mak_hot_js</td>
                    <td>$mak_hot_es4</td>
                    <td>$mak_hot_es6</td>
                    <td>$mak_hot_fs</td>
                    <td>$mak_hot_s2r</td>
                    <td>$mak_hot_ps</td>
                    <td align='center'><a href='Javascript:void(0)' onclick='deleteMadinaAccomdation($id);' id='del_accom'><i class='fa fa-trash-o fa-lg'></i></a></td>
                    <td style='display:none;'><input type='text' value='$mad_accom_total' id='mad_accom_total_price' class='form-control input-sm'></td>
                </tr>"; 
                    }    
                 }
if(isset($_REQUEST['delete_mad_accom'])){
        
        $id = $_POST['id'];
        $where = array("Id"=>$id);
        $del_mad_accom = new DataOperations;
        
        $message = $del_mad_accom->deleteRecord("madina_accomdation", $where);
        if($message){
            echo $message;
        }
        else{
            echo "Data not deleted";
        }  
    }

if(isset($_POST['vehicle_id']) && !empty($_POST['vehicle_id'])){
    $vehicle_id = $_POST['vehicle_id'];
    $query = "SELECT Vehicle_Capacity, PPP_Offered FROM `vehicles` WHERE `vehicles`.`User_Id` = $session_user_id AND `Id` = '$vehicle_id'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            //$id = $row['Id'];
            $vehicle_capacity = $row['Vehicle_Capacity'];
            $ppp_offered = $row['PPP_Offered'];
            }
        echo $vehicle_capacity.",".$ppp_offered;
        
      }
    else{
        echo "Data not available";
    }

}
if(isset($_POST['veh_name']) && !empty($_POST['veh_name'])){
    $veh_name = $_POST['veh_name'];
    $query = "SELECT Id, Vehicle_Route, Vehicle_Charges FROM `vehicle_rates` WHERE `vehicle_rates`.`User_Id` = '$session_user_id' AND `Vehicle_Name` = '$veh_name'";
    $run_query = mysqli_query($conn, $query);    
    if(mysqli_num_rows($run_query) > 0){
        while($row = mysqli_fetch_array($run_query)){
            $id = $row['Id'];
            $vehicle_route = $row['Vehicle_Route'];
            $vehicle_charges = $row['Vehicle_Charges'];
          
        echo "
            <tr>
                <td><input type='checkbox' name='vehicle_route' value='$vehicle_route'></td>
                <td>$vehicle_route</td>
                <td>$vehicle_charges</td>
            </tr>";
            }
        }
    else{
        echo "Data not available";
    }

}
?>