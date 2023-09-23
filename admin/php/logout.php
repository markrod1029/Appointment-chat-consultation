<?php
    session_start();
    if(isset($_SESSION['admin_id'])){
        include_once "config.php";
        $logout_id = mysqli_real_escape_string($conn, $_GET['admin_id']);
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = mysqli_query($conn, "UPDATE admin_table SET chat_status = '{$status}' WHERE id={$_GET['admin_id']}");
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