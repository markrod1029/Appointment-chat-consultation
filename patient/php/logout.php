<?php
    session_start();
    if(isset($_SESSION['patient_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['patient_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE patient_table SET chat_status = '{$status}' WHERE patient_id={$_GET['patient_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../../index.php");
            }
        }else{
            header("location: ../message.php");
        }
    }else{  
        header("location: ../../index.php");
    }
?>