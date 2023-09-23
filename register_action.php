<?php
  session_start();


	include 'include/conn.php';
	require 'PHPMailer/class.phpmailer.php';
	if(isset($_POST['submit'])){
		$patient_email_address = $_POST['patient_email_address'];
		$patient_first_name = $_POST['patient_first_name'];
		$patient_last_name = $_POST['patient_last_name'];
		$patient_phone_no = $_POST['patient_phone_no'];
		$patient_address = $_POST['patient_address'];
		$patient_date_of_birth = $_POST['patient_date_of_birth'];
		$patient_gender = $_POST['patient_gender'];
		$patient_maritial_status = $_POST['patient_maritial_status'];
		
   

        $email= $_POST['patient_email_address'];
			$fileinfo=PATHINFO($_FILES["patient_photo"]["name"]);
			$newFilename=$fileinfo['filename']. "." . $fileinfo['extension'];
			move_uploaded_file($_FILES["patient_photo"]["tmp_name"],'images/' .$newFilename);
			$location = $newFilename;   
			
	
  	
  	//creating patient_id
	  $numbers = '';
	
	  for($i = 0; $i < 10; $i++){
		  $numbers .= $i;
	  }
	  $patient_id = substr(str_shuffle($numbers), 0, 9);
	  //
		
		
						function generatePassword($length = 8) {
  // Define the characters that will be used to generate the password
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';

  // Shuffle the characters randomly
  $shuffled_chars = str_shuffle($chars);

  // Take the first $length characters from the shuffled string as the password
  $password = substr($shuffled_chars, 0, $length);

  // Return the generated password
  return $password;
}

// Generate an 8-character password
$pass = generatePassword();

 $password = password_hash($pass, PASSWORD_DEFAULT);
 $fullname = $patient_first_name.' '.$patient_last_name;



		

		$sql = "SELECT patient_email_address FROM patient_table  WHERE patient_email_address = '".$patient_email_address."' ";
		$query = $conn->query($sql);
		$result = mysqli_query($conn,$sql);
		$count = mysqli_num_rows($result);

		$row = $query->fetch_assoc();
		
	
		if ($count == 1 ) {
		$_SESSION['error'] = 'Have already Email Address';
		header('location: register.php');

		}
		
		else{
		
		$insert = "INSERT INTO patient_table(patient_id, patient_email_address, patient_photo, patient_password, patient_first_name, patient_last_name, patient_date_of_birth, patient_gender,  patient_address,  patient_phone_no, patient_maritial_status, patient_status,  added_on) 
		VALUES ('$patient_id', '$patient_email_address', '$location', '$password', '$patient_first_name', '$patient_last_name', '$patient_date_of_birth', '$patient_gender', '$patient_address', '$patient_phone_no',  '$patient_maritial_status', 'Active', NOW())";
		if($conn->query($insert)){
			$_SESSION['success'] = 'Patient Register Successfully';
			
			  $mail = new PHPMailer(true); 
        	$mail->IsSMTP();                           
        	$mail->SMTPAuth   = false;                 
        	$mail->Port       = 25;                    
        	$mail->Host       = "localhost"; 
        	$mail->Username   = "preparatory-log.online";   
        	$mail->Password   = "Markrod29";            
        
        	$mail->IsSendmail();  
        
        	$mail->From       = "preparatory-log.online";
        	$mail->FromName   = "markrodcadayong17@gmail.com";
        
        	$mail->AddAddress($email);
        	$mail->WordWrap   = 80; 
              $mail->isHTML(true);
            $mail->Subject = 'Jesus Hand Healing Hospital (Account Notification)';
            $mail->Body    = "Hi $fullname,<br><br>
           We are writing to confirm that you already have an account with Jesus Hand Healing Hospital. You can log in to your account using the following credentials:<br>
           Email: $email<br>
           Password:$pass<br><br>
            Thank you for being a part of the Jesus Hand Healing Hospital community. If you have any questions or concerns, please do not hesitate to contact us.
            <br><br>Best regards,
            <br>Jesus Hand Healing Hospital";
 
                 
            if(!$mail->Send())
            {
                   echo "Mail Not Sent";
                  
            }
            else
            {
                echo "Mail Sent";
                

            } 
            
		}
		else{
			$_SESSION['error'] = $conn->error;
		}


	}


}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	
    header('location: index.php');

    ?>