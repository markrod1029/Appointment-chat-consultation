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
                            	<div class="col">
                            		<h3 class="m-0 font-weight-bold text-success">Appointment List</h3>
                            	</div>
                            
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
								<thead>
                                        <tr>
                                            <th>Reference Number </th>
                                            <th>Patient Name</th>
                                            <th>Doctor Name</th>
                                            <th>Appointment Time</th>
                                            <th>Appointment Day</th>
                                            <th>Appointment Status</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                    
                  

                    $sql = "SELECT * FROM appointment_table  
                    INNER JOIN doctor_table  ON doctor_table.id = appointment_table.doctor_id 
                    INNER JOIN patient_table ON patient_table.id = appointment_table.patient_id 
                    INNER JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id 
                    WHERE appointment_table.status != 'Completed'
                   ";

                    $query = mysqli_query($conn, $sql);
                    $data = array();

                    while ($row = mysqli_fetch_assoc($query)) 
                    {
                       
                        $status = '';

                        if($row["status"] == 'Booked')
                        {
                            $status = '<span class="badge badge-warning"  style="font-size:15px;">' . $row["status"] . '</span>';
                        }
            
                        if($row["status"] == 'In Process')
                        {
                            $status = '<span class="badge badge-primary " style="font-size:15px;">' . $row["status"] . '</span>';
                        }
            
                        if($row["status"] == 'Completed')
                        {
                            $status = '<span class="badge badge-success"  style="font-size:15px;">' . $row["status"] . '</span>';
                        }
            
                        if($row["status"] == 'Cancel')
                        {
                            $status = '<span class="badge badge-danger"  style="font-size:15px;">' . $row["status"] . '</span>';
                        }
            

                    ?>
                        <tr>
                        <td><?php echo $row['appointment_no'];?></td>
                        <td><?php echo$row["patient_first_name"] . ' ' . $row["patient_last_name"]; ?></td>
                        <td><?php echo $row['doctor_name'];?></td>
                       	<td><?php echo date('H:i A', strtotime($row["doctor_schedule_start_time"])).' - '.date(' H:i A', strtotime($row["doctor_schedule_start_time"]))?></td>
                        <td><?php echo $row['doctor_schedule_day'];?></td>
                        <td><?php echo $status;?></td>

                    <td>
                        <a type="button" name="view_button" class="btn btn-info btn-circle btn-sm view_button" href="sched_patient.php?id=<?php echo $row["appointment_id"]?>"><i class="fas fa-eye"></i></a>

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





                <?php
                include('include/footer.php');?>
