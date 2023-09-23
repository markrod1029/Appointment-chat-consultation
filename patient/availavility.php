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


                   		<?php
        if(isset($_SESSION['error'])){
          echo " <br>
            <div class='alert alert-danger alert-dismissible'>
              ".$_SESSION['error']."
               <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            </div>
          ";;
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              ".$_SESSION['success']."
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>

            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col-sm-6">
								<h3 class="m-0 font-weight-bold text-success">Appointment List</h3>
                            	</div>
                            	<div class="col-sm-6" align="right">
                                    <div class="row">
                                  
                                       
                                    </div>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
							<table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">

		      			<thead>
			      			<tr>
			      			    <th>Doctor License</th>
			      				<th>Doctor Name</th>
			      				<th>Specialization</th>
			      				<th>Appointment Date</th>
			      				<th>Action</th>
			      			</tr>


						

			      		</thead>

						  <?php 

						  $date = date('Y-m-d');
                  $id = $user['id'];
                    $sql = " SELECT * FROM doctor_schedule_table 
					INNER JOIN doctor_table 
					ON doctor_table.id = doctor_schedule_table.doctor_id 
					WHERE 
			
					doctor_schedule_table.doctor_schedule_status = 'Available' 
				
					 ";

                    $query = mysqli_query($conn, $sql);
	// 	doctor_schedule_table.doctor_schedule_date >= '$date' AND
                    while ($row = mysqli_fetch_assoc($query)) 
                    {
		
                    ?>
			      		<tbody>

						  <td><?php echo $row["license"] ?></td>
						  <td><?php echo $row["doctor_name"] ?></td>
                        <td><?php echo $row['doctor_expert_in'];?></td>
                        <td><?php echo $row['doctor_schedule_day'];?></td>
                        
						<td>
							<div align="center">

<a type="button" name="get_appointment" class="btn btn-primary btn-sm get_appointment" href="sched_patient.php?id=<?php echo $row['doctor_schedule_id']?>">Appointment</a>
</div></td>

						</tbody>

						  
						  <?php
                            }
                    ?>

			      	</table>
			    </div>
			</div>
		</div>
	</div>

</div>



<div id="appointmentModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="appointment_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Make Appointment</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <div id="appointment_detail"></div>
                    <div class="form-group">
                    	<label><b>Reasone for Appointment</b></label>
                    	<textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control" required rows="5"></textarea>
                    </div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_doctor_id" id="hidden_doctor_id" />
          			<input type="hidden" name="hidden_doctor_schedule_id" id="hidden_doctor_schedule_id" />
          			<input type="hidden" name="action" id="action" value="book_appointment" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Book" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>



<?php

include('include/footer.php');

?>

</div>
