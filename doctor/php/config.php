<?php
  $hostname = "localhost";
  $username = "appointment";
  $password = "doctor_appointment";
  $dbname = "doctor_appointment";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>


