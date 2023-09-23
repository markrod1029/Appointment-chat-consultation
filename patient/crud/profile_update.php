<?php
	include 'session.php';

    if(isset($_POST['submit'])){
     
        $patient_email_address = $_POST['patient_email_address'];
		$pass = $_POST['patient_password'];
        $patient_password = password_hash($_POST['patient_table'], PASSWORD_DEFAULT);
        $patient_first_name = $_POST['patient_first_name'];
        $patient_last_name = $_POST['patient_last_name'];
        $patient_date_of_birth = $_POST['patient_date_of_birth'];
        $patient_gender = $_POST['patient_gender'];
        $patient_phone_no = $_POST['patient_phone_no'];
        $patient_maritial_status = $_POST['patient_maritial_status'];
        $patient_address = $_POST['patient_address'];
        $ID = $_POST['id'];

       
    	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
        $newFilename=$fileinfo['filename']. $fileinfo['extension'];
			move_uploaded_file($_FILES["photo"]["tmp_name"],'../../images/' .$newFilename);
			$location =$newFilename;   

            
            
        $sql = "SELECT * FROM patient_table WHERE id = '$ID'";
		$query = $conn->query($sql);
        $row = $query->fetch_assoc();
        
    if($location == null){


        if($pass == $row['patient_table']){

 

            
         $sql = "UPDATE patient_table SET patient_email_address = '$patient_email_address',
         patient_first_name = '$patient_first_name', patient_last_name = '$patient_last_name', patient_date_of_birth = '$patient_date_of_birth',
         patient_gender = '$patient_gender', patient_phone_no = '$patient_phone_no', patient_maritial_status = '$patient_maritial_status',
         patient_address = '$patient_address' WHERE id = '$ID'";

         
      
        }
        
        else{

                $sql = "UPDATE patient_table SET patient_email_address = '$patient_email_address', patient_password = '$patient_password',
                patient_first_name = '$patient_first_name', patient_last_name = '$patient_last_name', patient_date_of_birth = '$patient_date_of_birth',
                patient_gender = '$patient_gender', patient_phone_no = '$patient_phone_no', patient_maritial_status = '$patient_maritial_status',
                patient_address = '$patient_address' WHERE id = '$ID'";
        }


    }

    else{

        if($pass == $row['patient_table']){

                 
            
            $sql = "UPDATE patient_table SET patient_email_address = '$patient_email_address', patient_photo ='$location',
            patient_first_name = '$patient_first_name', patient_last_name = '$patient_last_name', patient_date_of_birth = '$patient_date_of_birth',
            patient_gender = '$patient_gender', patient_phone_no = '$patient_phone_no', patient_maritial_status = '$patient_maritial_status',
            patient_address = '$patient_address' WHERE id = '$ID'";

        }

        else{

            $sql = "UPDATE patient_table SET patient_email_address = '$patient_email_address',  patient_photo ='$location',  patient_password = '$patient_password',
            patient_first_name = '$patient_first_name', patient_last_name = '$patient_last_name', patient_date_of_birth = '$patient_date_of_birth',
            patient_gender = '$patient_gender', patient_phone_no = '$patient_phone_no', patient_maritial_status = '$patient_maritial_status',
            patient_address = '$patient_address' WHERE id = '$ID'";

        }
    }



         if($conn->query($sql)){
           $_SESSION['success'] = 'Patient updated successfully';
    
         }
         else{
           $_SESSION['error'] = $conn->error;
         }
      }
       else{
         $_SESSION['error'] = 'Fill up edit form first';
       }

    header('location: ../profile.php');
