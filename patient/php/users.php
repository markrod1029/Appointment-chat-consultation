<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['patient_id'];
    $sql = "SELECT * FROM doctor_table   ORDER BY doctor_id ";
    $query = mysqli_query($conn, $sql);
    $output = "";
  
    $sql1 = "SELECT * FROM admin_table  ORDER BY id ";
    $query1 = mysqli_query($conn, $sql1);
    $output = "";

    if(mysqli_num_rows($query) == 0 ){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0 || mysqli_num_rows($query1) >  0){

        include_once "data.php";
    }
    echo $output;
?>