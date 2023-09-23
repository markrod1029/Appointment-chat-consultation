<?php include('include/session.php');
error_reporting(0);
?>



                <?php include('include/header.php');?>
                <?php include('include/sidebar.php');?>

                <?php include('include/menubar.php');
                
                ?>

          
  <div class="content-wrapper">

  <section class="content-header">
  <h1 class="h3 mb-4 text-gray">Doctor Schedule Managment</h1>
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
             

             <?php
                            $ID = $_GET['id'];
                            $view = "SELECT * FROM appointment_table  
                            INNER JOIN doctor_table  ON doctor_table.id = appointment_table.doctor_id 
                            INNER JOIN patient_table ON patient_table.id = appointment_table.patient_id 
                            INNER JOIN doctor_schedule_table ON doctor_schedule_table.doctor_schedule_id = appointment_table.doctor_schedule_id WHERE appointment_table.appointment_id ='$ID' ";
                            $result = $conn->query($view);
                            $row = $result->fetch_assoc();
                            
                            ?>


<div >
    <div class="w-75 mx-auto" >
        <form method="post" action='sched_patient.php?change=<?php echo $row['appointment_id']?>' id="edit_appointment_form">
            <div class="modal-content ">
                <div class="modal-header text-center">
                    <center><h4 class="modal-title " id="modal_title">View Appointment Details</h4></center>
                    <a href="doctor_schedule.php" class="close" data-dismiss="modal">&times;</a>
                </div>
                <div class="modal-body">
                <h4 class="text-center">Patient Details</h4>
                <table class="table">
                <tr>
                <th width="40%" class="text-right">Patient Name</th>
                <td><?php echo $row["patient_first_name"].' '.$row["patient_last_name"]?></td>
            </tr>
            <tr>
                <th width="40%" class="text-right">Contact No.</th>
                <td><?php echo $row["patient_phone_no"]?></td>
            </tr>
            <tr>
                <th width="40%" class="text-right">Address</th>
                <td><?php echo $row["patient_address"]?></td>
            </tr>
    </table>
        

                 <table class="table">

                 <h4 class="text-center">Appointment Details</h4>


			

                <tr>
					<th width="40%" class="text-right">Doctor Name</th>
					<td><?php echo $row["doctor_name"]?></td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Date</th>
					<td><?php echo $row["doctor_schedule_date"]?></td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Appointment Day</th>
					<td><?php echo $row["doctor_schedule_day"]?></td>
				</tr> 
                <tr>
					<th width="40%" class="text-right">Appointment Time</th>
			<td><?php echo date('H:i:A', strtotime($row["doctor_schedule_start_time"])).' - '.date(' H:i:A', strtotime($row["doctor_schedule_start_time"]))?></td>
				</tr>
				<tr>
					<th width="40%" class="text-right">Reason for Appointment</th>
					<td><?php echo $row["reason_for_appointment"]?></td>
				</tr> 

                <?php
              
              if($appointment_row["status"] != 'Cancel')
              {
                  if($_SESSION['type'] == 'Doctor')
                  {
                      if($row['patient_come_into_hospital'] == 'Yes')
                      {
                          if($row["status"] == 'Completed')
                          {
                              echo'
                                  <tr>
                                      <th width="40%" class="text-right">Patient come into Hostpital</th>
                                      <td>Yes</td>
                                  </tr>
                                  <tr>
                                      <th width="40%" class="text-right">Doctor Comment</th>
                                      <td>'.$row["doctor_comment"].'</td>
                                  </tr>
                              ';
  
                             echo '
                              <tr>
                                  <th width="40%" class="text-right">Doctor Disease</th>
                                  <td>'.$row["disease"].'</td>
                              </tr>
                          ';
  
                              
                          }
                          else
                          {
                            echo '
                                  <tr>
                                      <th width="40%" class="text-right">Patient come into Hostpital</th>
                                      <td>
                                          <select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
                                              <option value="">Select</option>
                                              <option value="Yes" selected>Yes</option>
                                          </select>
                                      </td>
                                  </tr
                              ';
                          }
                      }
                      else
                      {
                          echo '
                              <tr>
                                  <th width="40%" class="text-right">Patient come into Hostpital</th>
                                  <td>
                                      <select name="patient_come_into_hospital" id="patient_come_into_hospital" class="form-control" required>
                                          <option value="">Select</option>
                                          <option value="Yes">Yes</option>
                                      </select>
                                  </td>
                              </tr>
                          ';
                      }
                  }
  
                  if($_SESSION['type'] == 'Doctor')
                  {
                      if($row["patient_come_into_hospital"] == 'Yes')
                      {
                          if($row["status"] == 'Completed')
                          {
                             echo '
                      
                      
  
                      
  
                              <tr>
                                      <th width="40%" class="text-right">Doctor Comment</th>
                                      <td>
                                          <textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required>'.$appointment_row["doctor_comment"].'</textarea>
                                      </td>
                                  </tr>
  
  
  
                                  
                                  <tr>
                                  <th width="40%" class="text-right">Patient Disease</th>
                                  <td>
                                      <select name="disease" id="disease" class="form-control" required>
                                          <option value="Asthma">Asthma</option>
                                          <option value="Diabetes">Diabetes</option>
                                          <option value="Dengue">Dengue</option>
                                          <option value="Hypertension">Hypertension</option>
                                          <option value="Others">Others</option>
  
  
                                      </select>
                                  </td>
                              </tr>
                              
  
  
                              ';
  
                              
                          
                          }
                          else
                          {
                           echo '
  
                          
                          
                                  <tr>
                                      <th width="40%" class="text-right">Doctor Comment</th>
                                      <td>
                                          <textarea name="doctor_comment" id="doctor_comment" class="form-control" rows="8" required></textarea>
                                      </td>
                                  </tr>
  
  
                          
                                  <tr>
                                  <th width="40%" class="text-right">Patient Disease</th>
                                  <td>
                                  <select name="disease" id="disease" class="form-control" required>
                                  <option value="Asthma">Asthma</option>
                                  <option value="Diabetes">Diabetes</option>
                                  <option value="Dengue">Dengue</option>
                                  <option value="Hypertension">Hypertension</option>
                                  <option value="Others">Others</option>
  
  
                              </select>
                                  </td>
                              </tr>
  
                              ';
  
                                  
                          
                          }
                      }
                  }
              
              }
			

                    ?>
                </div>

    </table>


                <div class="modal-footer">
                    <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']?>" />
                    <input type="hidden" name="action" value="change_appointment_status" />

                    <input type="submit" name="save_appointment" id="save_appointment" class="btn btn-primary" value="Save" />
                    <a href="doctor_schedule.php" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </form>
    </div>
</div>


                <?php
                include('include/footer.php');?>    

<?php
@$change = $_GET['change'];
if($change==TRUE)
{
    $id = $_GET['change'];
    $status = $_POST['patient_come_into_hospital'];

	$sql= "UPDATE appointment_table SET status = 'In Process', patient_come_into_hospital = 'Yes'
    WHERE appointment_id = '$id'";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Appointment Status change to In Process';
	}

	else{
	$_SESSION['error'] = $connect->error;
	}	
	
	echo
"
	<script>
		window.location='doctor_schedule.php';
	</script>
";
}


if(isset($_POST['doctor_comment']))
{


    $id = $_POST['appointment_id'];
    $doctor_comment = $_POST['doctor_comment'];
    $disease = $_POST['disease'];
    $status = 'Approved';



    $sql = "UPDATE appointment_table 
    SET status = '$status', 
    doctor_comment = '$doctor_comment', disease =  '$disease' 
    WHERE appointment_id =  '$id'
    ";


    if($conn->query($sql)){
		$_SESSION['success'] ='Appointment Already Complete';
	}

	else{
	$_SESSION['error'] = $connect->error;
	}	
	



}


?>