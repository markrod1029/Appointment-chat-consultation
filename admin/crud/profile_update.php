<?php
	include 'session.php';

    if(isset($_POST['submit'])){
     
        $admin_firstname = $_POST['admin_firstname'];
        $admin_lastname = $_POST['admin_lastname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
       echo  $pass = $_POST['password'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $id = $_POST['id'];

       
    	$fileinfo=PATHINFO($_FILES["photo"]["name"]);
        $newFilename=$fileinfo['filename']. $fileinfo['extension'];
			move_uploaded_file($_FILES["photo"]["tmp_name"],'../../images/' .$newFilename);
			$location =$newFilename;   

            
            
        $sql = "SELECT * FROM admin_table WHERE id = '$id'";
		$query = $conn->query($sql);
        $row = $query->fetch_assoc();
        
    if($location == null){


        if($pass == $row['password']){

            $sql = "UPDATE admin_table SET email = '$email',
            admin_firstname = '$admin_firstname', admin_lastname = '$admin_lastname', address = '$address',
            phone = '$phone' WHERE id = '$id'";
      
        }
        
        else{

            
            $sql = "UPDATE admin_table SET email = '$email', password = '$password',
            admin_firstname = '$admin_firstname', admin_lastname = '$admin_lastname', address = '$address',
            phone = '$phone' WHERE id = '$id'";
        }


    }

    else{

        if($pass == $row['password']){

            $sql = "UPDATE admin_table SET email = '$email',
            admin_firstname = '$admin_firstname', admin_lastname = '$admin_lastname', address = '$address',
            phone = '$phone', photo = '$location'  WHERE id = '$id'";
        }

        else{

            $sql = "UPDATE admin_table SET email = '$email', password = '$password',
            admin_firstname = '$admin_firstname', admin_lastname = '$admin_lastname', address = '$address',
            phone = '$phone', photo = '$location'  WHERE id = '$id'";

        }
    }



         if($conn->query($sql)){
           $_SESSION['success'] = 'Admin updated successfully';
    
         }
         else{
           $_SESSION['error'] = $conn->error;
         }
      }
       else{
         $_SESSION['error'] = 'Fill up edit form first';
       }

    header('location: ../profile.php');
