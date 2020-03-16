$(document).ready(function(){
    $('#building_id').on('change',function(){

        var buildingId = $(this).val();
        if(buildingId){
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'building_id='+buildingId,
                success:function(data){

                    // alert(data);                    
                    $('#energy_type').html(data);
                    //$('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#energy_type').html('<option value="">Select Building first</option>');
            //$('#city').html('<option value="">Select state first</option>'); 
        }
    });

    $('#energy_type').on('change',function(){

        // var energyType = $('#energy_type option:selected').attr('data-energy_type');
        var energyType = $('#energy_type').val();
        if(energyType == 'gas'){
            $('#unit').text("KWH");
        }
        if(energyType == 'water'){
            $('#unit').text("M3");
        }
        if(energyType == 'electricity'){
            $('#unit').text("KWH");
        }
        if(energyType == 'water'){
            $('#unit').text("L");
        }
        
    });

    $('#dept_id').on('change',function(){
        var deptId = $('#dept_id option:selected').attr('data-dept_id');
        if(deptId){
            // alert("working");
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'dept_id='+deptId,
                success:function(data){
                    $('#degree_id').html(data);
                }                 
            });
        }
            else{
                $('#degree_id').html('<option value="">Select Department first</option>');
            }
    });

    $('#assignment_dept_id').on('change',function(){
        var deptId = $('#dept_id option:selected').attr('data-dept_id');
        if(deptId){
            // alert("working");
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'assignment_dept_id='+deptId,
                success:function(data){
                    $('#degree_id').html(data);
                }                 
            });
        }
            else{
                $('#degree_id').html('<option value="">Select Department first</option>');
            }
    });

    $('#degree_id').on('change',function(){

        var degreeId = $('#degree_id option:selected').attr('data-degree_id');
        if(degreeId){
            // alert("working");
            $.ajax({
                type:'POST',
                url:'ajax.php',
                data:'degree_id='+degreeId,
                success:function(data){
                    $('#semester').html(data);
                }                 
            });
        }
            else{
                $('#semester').html('<option value="">Select Degree first</option>');
            }
    });

    $('#semester').on('change',function(){

        var degreeId1 = $('#degree_id option:selected').attr('data-degree_id');
        var semesterId1 = $('#semester option:selected').attr('data-semester_id');
        if(degreeId1 && semesterId1){
            // alert("working");
            $.ajax({
                type:'POST',
                url:'ajax.php',
                // data:'degree_id='+degreeId,
                data:'degree_id1='+degreeId1+'&semester_id1='+semesterId1,
                success:function(data){
                    $('#course').html(data);
                }                 
            });
        }
            else{
                $('#course').html('<option value="">Select Semester first</option>');
            }
    });
   

   $('#enter_fee').change(function () {
        
        var remainingFee = $('#remaining_fee').val();

        var fee = $(this).val();

        if(fee > remainingFee){
            alert("You are inputting invalid value!");
        }
        else{
            var remainingPayableFee = parseInt(remainingFee) - parseInt(fee);
       
             $("#remaining_payable_fee").val(remainingPayableFee); 
        }

        
    });


    

});