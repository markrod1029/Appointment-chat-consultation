<?php 
    session_start();
    if(isset($_SESSION['admin_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['admin_id'];
        $status = 1;
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        if(!empty($message)){
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, message_status)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$status}')") or die();
        }
    }else{
        header("location: ../login.php");
    }


    
?>