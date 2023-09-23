


<body   class="d-flex flex-column">


<div class="wrapper">
   
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars " style="  position:relative;  z-index: 1;"></i></a>
      </li>
    </ul>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <?php
           $id = $user['patient_id'];
           $sql = "SELECT DISTINCT outgoing_msg_id FROM messages WHERE message_status = '1' AND  incoming_msg_id = '$id' ";
           $query = $conn->query($sql);
           $result1 = $query->num_rows;

           ?>

                    <li class="nav-item mt-1">
                    <a class="nav-link" href="message.php" >
                    <i class="fab fa-facebook-messenger" style="color:#7ED956; font-size:25px;"></i>
                    <span class=" badge badge-danger"><?php echo $result1 ?></span>
                        </a>    
                </li>



                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small" id="user_profile_name"></span>
                            <img class="img-profile rounded-circle"
                                src="<?php echo (!empty($user['patient_photo']))? '../images/'.$user['patient_photo']:'../images/profile.jpg'; ?>" width="30" height="30" id="user_profile_image">
                        </a>
                        <!-- Dropdown - User Information -->
                      
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="php/logout.php?patient_id=<?php echo $user['patient_id']; ?>" >

                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                      
                       
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">