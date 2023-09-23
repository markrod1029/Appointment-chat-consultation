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
  <h1 class="h3 mb-4 text-gray">Doctor Schedule Management</h1>

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
                   $id = $user['id'];
                    
                    $sql = "SELECT * FROM appointment_table 
                    INNER JOIN doctor_schedule_table 
                    ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
                    INNER JOIN doctor_table 
                    ON doctor_table.id = appointment_table.doctor_id 
                    INNER JOIN patient_table 
                    ON patient_table.id = appointment_table.patient_id 
                    WHERE appointment_table.doctor_id ='$id'";

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

