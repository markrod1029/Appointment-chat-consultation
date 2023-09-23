<?php
	include 'session.php';

    if(isset($_POST['submit'])){
     
        $doctor_email_address = $_POST['doctor_email_address'];
		$name = $_POST['doctor_name'];
		$doctor_name = $_POST['doctor_name'];
		$doctor_phone_no = $_POST['doctor_phone_no'];
		$doctor_address = $_POST['doctor_address'];
		$doctor_date_of_birth = $_POST['doctor_date_of_birth'];
		$password = password_hash($_POST['doctor_password'], PASSWORD_DEFAULT);
		$pass = $_POST['doctor_password'];
		$doctor_expert_in = $_POST['doctor_expert_in'];
		$doctor_email_address = $_POST['doctor_email_address'];
        $ID = $_POST['id'];

		$license = $_POST['license'];
		
       
    	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
        $newFilename=$fileinfo['filename']. $fileinfo['extension'];
			move_uploaded_file($_FILES["photo"]["tmp_name"],'../../images/' .$newFilename);
			$location =$newFilename;   

            
            
        $sql = "SELECT * FROM doctor_table WHERE id = '$ID'";
		$query = $conn->query($sql);
        $row = $query->fetch_assoc();
        
    if($location == null){


        if($pass == $row['doctor_password']){

 
            $sql = "UPDATE doctor_table SET license = '$license', doctor_email_address = '$doctor_email_address',
            doctor_name = '$doctor_name', doctor_phone_no = '$doctor_phone_no', doctor_address = '$doctor_address',
            doctor_date_of_birth = '$doctor_date_of_birth', doctor_expert_in = '$doctor_expert_in' WHERE id = '$ID'";
      
        }
        
        else{

           
         $sql = "UPDATE doctor_table SET license = '$license', doctor_email_address = '$doctor_email_address', doctor_password = '$password',
         doctor_name = '$doctor_name', doctor_phone_no = '$doctor_phone_no', doctor_address = '$doctor_address',
         doctor_date_of_birth = '$doctor_date_of_birth', doctor_expert_in = '$doctor_expert_in' WHERE id = '$ID'";
         
        }


    }

    else{

        if($pass == $row['doctor_password']){

                 
         $sql = "UPDATE doctor_table SET license = '$license',  doctor_email_address = '$doctor_email_address', 
         doctor_name = '$doctor_name', doctor_profile_image = '$location', doctor_phone_no = '$doctor_phone_no', doctor_address = '$doctor_address',
         doctor_date_of_birth = '$doctor_date_of_birth', doctor_expert_in = '$doctor_expert_in' WHERE id = '$ID'";
        }

        else{

            $sql = "UPDATE doctor_table SET license = '$license',  doctor_email_address = '$doctor_email_address', doctor_password = '$password',
         doctor_name = '$doctor_name',  doctor_profile_image = '$location', doctor_phone_no = '$doctor_phone_no', doctor_address = '$doctor_address',
         doctor_date_of_birth = '$doctor_date_of_birth', doctor_expert_in = '$doctor_expert_in' WHERE id = '$ID'";

        }
    }



         if($conn->query($sql)){
           $_SESSION['success'] = 'Doctor updated successfully';
    
         }
         else{
           $_SESSION['error'] = $conn->error;
         }
      }
       else{
         $_SESSION['error'] = 'Fill up edit form first';
       }

    header('location: ../profile.php');
