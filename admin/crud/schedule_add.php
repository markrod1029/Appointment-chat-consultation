<?php

	include 'conn.php';


	if(isset($_POST['submit'])){

		$id = $_POST['id'];

		$doctor_schedule_start_time = $_POST['doctor_schedule_start_time'];
		$doctor_schedule_end_time = $_POST['doctor_schedule_end_time'];
		$average_consulting_time = $_POST['average_consulting_time'];
		

$selectedDays = $_POST['day']; // Retrieve the selected days from the checkboxes

    // Convert the array of selected days into a comma-separated string
    $daysString = implode(',', $selectedDays);
    
    
		$insert = "INSERT INTO doctor_schedule_table (doctor_id, doctor_schedule_day, doctor_schedule_start_time, doctor_schedule_end_time, average_consulting_time) 
		VALUES ('$id',  '$daysString', '$doctor_schedule_start_time', '$doctor_schedule_end_time', '$average_consulting_time')";
		if($conn->query($insert)){
			$_SESSION['success'] = 'Teacher added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}


	}



	header('location: ../availavility.php');

	

    ?>