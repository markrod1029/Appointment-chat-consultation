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
  <h1 class="h3 mb-4 text-gray">Appointment Management</h1>

        </section>

<!-- DataTales Example -->

					<span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            	</div>
                            	<div class="col" align="right">
                            		<a href="add_patient.php" type="button" name="add_doctor" id="add_doctor" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></a>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                <div class="table-responsive">
		      		<table class="table table-striped table-bordered" id="myTable" width="100%" cellspacing="0">
		      			<thead>
			      			<tr>
			      				<th>Doctor Name</th>
			      				<th>Appointment Day</th>
			      				<th>Appointment Time</th>
			      				<th>Appointment Status</th>
			      				<th>Action</th>
			      			</tr>
			      		</thead>
						  <?php 
                    $id = $user['id'];
                    $sql = "SELECT * from appointment_table LEFT JOIN doctor_table 
					ON doctor_table.id = appointment_table.doctor_id 
					LEFT JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id  
					 where patient_id = '$id' ";

                    $query = mysqli_query($conn, $sql);
                    $data = array();

                    while ($row = mysqli_fetch_assoc($query)) 
                    {
						$status = '';

						if($row["status"] == 'Booked')
						{
							$status = '<span class="badge badge-warning p-2">' . $row["status"] . '</span>';
						}
			
						if($row["status"] == 'In Process')
						{
							$status = '<span class="badge badge-primary p-2">' . $row["status"] . '</span>';
						}
			
						if($row["status"] == 'Approved Appointment')
						{
							$status = '<span class="badge badge-success p-2">' . $row["status"] . '</span>';
						}
			
						if($row["status"] == 'Cancel')
						{
							$status = '<span class="badge badge-danger p-2">' . $row["status"] . '</span>';
						}

						
			
                    ?>
						
						  <tbody>
						
                        <tr>
                       
                        <td><?php echo $row["doctor_name"]?></td>
                         <td><?php echo $row['doctor_schedule_day']?></td>
                        	<td><?php echo date('h:i A', strtotime($row["doctor_schedule_start_time"])).' - '.date(' h:i A', strtotime($row["doctor_schedule_end_time"]))?></td>
                        <td><?php echo $status?></td>
            
						<td>

						<a href="download.php?id=<?php echo $row["appointment_id"]?>" class="btn btn-primary btn-sm" target="_blank"><i class="fas fa-file-pdf"></i> </a>
                    


					<?php

						if($row['status']=='Booked'){

					?>
					<a href="crud/cancel_appointment.php?id=<?php echo $row["appointment_id"]?>" onclick="return confirm('Are you sure you want to go to Cancel this Appointment?')"  name="cancel_appointment" class="btn btn-danger btn-sm cancel_appointment" data-id="<?php $row["appointment_id"]?>"><i class="fas fa-times"></i></a>
							<?php 
						}

						else{

						}
						?>

				</td>
                    
                    <?php
                            }
                    ?>

                        </tr>       



			      </tbody>
			      	</table>
			    </div>
			</div>
		</div>
	</div>

</div>

<?php

include('include/footer.php');

?>


<script>

// $(document).ready(function(){

// 	var dataTable = $('#appointment_list_table').DataTable({
// 		"processing" : true,
        
// 		"lengthChange": false,

// 		"serverSide" : true,
// 		"order" : [],
// 		"ajax" : {
// 			url:"action.php",
// 			type:"POST",
// 			data:{action:'fetch_appointment'}
// 		},
// 		"columnDefs":[
// 			{
//                 "targets":[5, 6],				
// 				"orderable":false,
// 			},
// 		],
// 	});

// 	$(document).on('click', '.cancel_appointment', function(){
// 		var appointment_id = $(this).data('id');
// 		if(confirm("Are you sure you want to cancel this appointment?"))
// 		{
// 			$.ajax({
// 				url:"action.php",
// 				method:"POST",
// 				data:{appointment_id:appointment_id, action:'cancel_appointment'},
// 				success:function(data)
// 				{
// 					$('#message').html(data);
// 					dataTable.ajax.reload();
// 					setTimeout(function(){
//                         $('#message').html('');
//                     }, 5000);
// 				}
// 			})
// 		}
// 	});
	

// });

</script>