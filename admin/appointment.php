<?php include('include/session.php');?>

<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>


                <?php include('include/header.php');?>
                <?php include('include/sidebar.php');?>
                <?php include('include/menubar.php');
                
                ?>

          
  <div class="content-wrapper">

  <section class="content-header">
  <h1 class="h3 mb-4 text-gray">Apointment Management Report</h1>

        </section>


                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col-sm-6">
                            		<h3 class="m-0 font-weight-bold text-success">Appointment Report</h3>
                            	</div>
                            	
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Reference Number</th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Appointment Day</th>
                                            <th>Appointment Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                    
                    $sql = "SELECT * FROM appointment_table 
                    INNER JOIN doctor_schedule_table 
                    ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
                    INNER JOIN doctor_table 
                    ON doctor_table.id = appointment_table.doctor_id 
                    INNER JOIN patient_table 
                    ON patient_table.id = appointment_table.patient_id";

                    $query = mysqli_query($conn, $sql);
                    $data = array();

                    while ($row = mysqli_fetch_assoc($query)) 
                    {
                       
                    ?>
                        <tr>
                        <td><?php echo $row['appointment_no'];?></td>

                        <td><?php echo $row["patient_first_name"]. ' '.$row["patient_last_name"];?></td>
                        <td><?php echo $row["doctor_name"];?></td>
                        <td><?php echo $row['doctor_schedule_day']?></td>
                        
                        	<td><?php echo date('h:i A', strtotime($row["doctor_schedule_start_time"])).' - '.date(' h:i A', strtotime($row["doctor_schedule_end_time"]))?></td>

                   
                    <?php
                            }
                    ?>

                        </tr>        


                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                include('include/footer.php');
                ?>


<!-- <script>
$(document).ready(function(){

    fetch_data('no');

    function fetch_data(is_date_search, start_date='', end_date='')
    {
        var dataTable = $('#appointment_table').DataTable({
            "processing" : true,
		"lengthChange": false,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                url:"crud/report_action.php",
                type:"POST",
                data:{
                    is_date_search:is_date_search, start_date:start_date, end_date:end_date, action:'fetch'
                }
            },
            "columnDefs":[
                {
                    <?php
                    if($_SESSION['type'] == 'Admin')
                    {
                    ?>
                    "targets":[3],
                    <?php
                    }
                    else
                    {
                    ?>
                    "targets":[6],
                    <?php
                    }
                    ?>
                    "orderable":false,
                },
            ],
        });
    }

    $(document).on('click', '.view_button', function(){

        var appointment_id = $(this).data('id');

        $.ajax({

            url:"crud/report_action.php",

            method:"POST",

            data:{appointment_id:appointment_id, action:'fetch_single'},

            success:function(data)
            {
                $('#viewModal').modal('show');

                $('#appointment_details').html(data);

                $('#hidden_appointment_id').val(appointment_id);

            }

        })
    });

    $('.input-daterange').datepicker({
        todayBtn:'linked',
        format: "yyyy-mm-dd",
        autoclose: true
    });

    $('#search').click(function(){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        if(start_date != '' && end_date !='')
        {
            $('#appointment_table').DataTable().destroy();
            fetch_data('yes', start_date, end_date);
        }
        else
        {
            alert("Both Date is Required");
        }
    });

    $('#refresh').click(function(){
        $('#appointment_table').DataTable().destroy();
        fetch_data('no');
    });

    $('#edit_appointment_form').parsley();

    $('#edit_appointment_form').on('submit', function(event){
        event.preventDefault();
        if($('#edit_appointment_form').parsley().isValid())
        {       
            $.ajax({
                url:"crud/report_action.php",
                method:"POST",
                data: $(this).serialize(),
                beforeSend:function()
                {
                    $('#save_appointment').attr('disabled', 'disabled');
                    $('#save_appointment').val('wait...');
                },
                success:function(data)
                {
                    $('#save_appointment').attr('disabled', false);
                    $('#save_appointment').val('Save');
                    $('#viewModal').modal('hide');
                    $('#message').html(data);
                    $('#appointment_table').DataTable().destroy();
                    fetch_data('no');
                    setTimeout(function(){
                        $('#message').html('');
                    }, 5000);
                }
            })
        }
    });

});
</script> -->