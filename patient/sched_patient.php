<?php include('include/session.php');
?>



                <?php include('include/header.php');?>
                <?php
                 include('include/sidebar.php');
                 ?>

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
             

             <?php
                            $ID = $_GET['id'];
                            $view = "	SELECT *,  doctor_schedule_table.doctor_id AS did  FROM doctor_schedule_table 
                            INNER JOIN doctor_table 
                            ON doctor_table.id = doctor_schedule_table.doctor_id 
                            WHERE doctor_schedule_table.doctor_schedule_id ='$ID' ";
                            $result = $conn->query($view);
                            $row = $result->fetch_assoc();
                            
                            ?>


<div >
    <div >
        <form method="post" action='sched_patient.php?change=<?php echo $row['doctor_schedule_id']?>' id="edit_appointment_form">
            <div class="modal-content ">
                <div class="modal-header text-center">
                    <center><h4 class="modal-title " id="modal_title">View Appointment Details</h4></center>
                    <a href="availavility.php" class="close" data-dismiss="modal">&times;</a>
                </div>
                <div class="modal-body">
                <h4 class="text-center">Patient Details</h4>
                <table class="table">
                <tr>
                <th width="40%" class="text-right">Patient Name</th>
                <td><?php echo $user["patient_first_name"].' '.$user["patient_last_name"]?></td>
            </tr>
            <tr>
                <th width="40%" class="text-right">Contact No.</th>
                <td><?php echo $user["patient_phone_no"]?></td>
            </tr>
            <tr>
                <th width="40%" class="text-right">Address</th>
                <td><?php echo $user["patient_address"]?></td>
            </tr>
    </table>
        

                 <table class="table">

                 <h4 class="text-center">Appointment Details</h4>


                 <tr>
				<th width="40%" class="text-right">Doctor Name</th>
				<td><?php echo $row["doctor_name"]?></td>
			</tr>
		
			<tr>
				<th width="40%" class="text-right">Appointment Day</th>
				<td>    <?php echo $row["doctor_schedule_day"]?></td>
			</tr>
			<tr>
				<th width="40%" class="text-right">Available Time</th>
                <td><?php echo date('h:i A', strtotime($row["doctor_schedule_start_time"])).' - '.date('h:i A', strtotime($row["doctor_schedule_end_time"])); ?></td>
				
			</tr>


                </div>

    </table>


    <div class="form-group">
                    	<label><b>Reason for Appointment</b></label>
                    	<textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control" required rows="5"></textarea>
                    </div>
                    
                <div class="modal-footer">
                <input type="hidden" name="doctor_id" value="<?php echo $row['did'];?>" />
          			<input type="hidden" name="doctor_schedule_id" value="<?php echo $row['doctor_schedule_id'];?>" id="hidden_doctor_schedule_id" />
          			<input type="hidden" name="action" id="action" value="book_appointment" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Submit" />
          			<a href='availavility.php' type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                </div>
            </div>
        </form>
    </div>
</div>


                <?php
                include('include/footer.php');?>    

<?php




@$change = $_GET['change'];
if($change==true)
	{
	
       $doctor_schedule_id =  $_POST['doctor_schedule_id'];

        $patient_id = $user['id'];
       $qry="SELECT * FROM appointment_table 
       WHERE patient_id = '$patient_id' ";
		$query = $conn->query($qry) ;
		$num=mysqli_num_rows($query);

				function generatePassword($length = 8) {
  // Define the characters that will be used to generate the password
  $chars = '0123456789';

  // Shuffle the characters randomly
  $shuffled_chars = str_shuffle($chars);

  // Take the first $length characters from the shuffled string as the password
  $password = substr($shuffled_chars, 0, $length);

  // Return the generated password
  return $password;
}

// Generate an 8-character password
$appointment_no = generatePassword();
      

             if($num>0)
        {
            $_SESSION['error'] ='have already applied for appointment for this, try for other day';
            echo
            "
                <script>
                    window.location='sched_patient.php?id=$doctor_schedule_id';
                </script>";
        }

        else{




            $sql="SELECT * FROM doctor_schedule_table 
			WHERE doctor_schedule_id = ' $doctor_schedule_id'";
             $query = $conn->query($sql) ;

             $total_doctor_available_minute = 0;
			$average_consulting_time = 0;
			$total_appointment = 0;


            while($row = $query->fetch_assoc()){


                $end_time = strtotime($row["doctor_schedule_end_time"] . ':00');

				$start_time = strtotime($row["doctor_schedule_start_time"] . ':00');

				$total_doctor_available_minute = ($end_time - $start_time) / 60;

				$average_consulting_time = $row["average_consulting_time"];
            }


            $sql1="SELECT COUNT(appointment_id) AS total FROM appointment_table 
			WHERE doctor_schedule_id = ' $doctor_schedule_id'";
             $query1 = $conn->query($sql) ;


             while($row1 = $query1->fetch_assoc()){
             $total_appointment = $row1["total"];

            }

            $total_appointment_minute_use = $total_appointment * $average_consulting_time;

			$appointment_time = date("H:i", strtotime('+'.$total_appointment_minute_use.' minutes', $start_time));
			$date = date('Y-m-d H:i:s');
            
            $status = '';

            if(strtotime($end_time) > strtotime($appointment_time . ':00'))
			{
				$status = 'Booked';
			}
			else
			{
				$status = 'Waiting';
			}


       $doctor_id = $_POST['doctor_id'];
       $id =  $user['id'];
       $doctor_schedule_id = $_POST['doctor_schedule_id'];
       $reason_for_appointment =   $_POST['reason_for_appointment'];
        $status = 'Booked';
       $doctor_schedule_status = 'Unavailable';
       $reason_for_appointment =   $_POST['reason_for_appointment'];

		
				$insert1 = "INSERT INTO appointment_table 
				(appointment_no, doctor_id, patient_id, doctor_schedule_id, reason_for_appointment, appointment_time, status, date) 
				VALUES ('$appointment_no','$doctor_id','$id', '$doctor_schedule_id', '$reason_for_appointment', '$appointment_time', '$status',NOW())";

                    if($conn->query($insert1)){
                        $_SESSION['success'] = 'Your Appointment has been '.$status.' ';
                      
                    }   

                    else{

                        $_SESSION['error'] = $connect->error;

                    }

	

			    echo
    "
        <script>
            window.location='availavility.php';
        </script>";	
	
}
	

	
    echo
    "
        <script>
            window.location='availavility.php';
        </script>";	

		
	}





?>