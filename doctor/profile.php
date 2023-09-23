<?php include('include/session.php');?>

<?php 
  include '../timezone.php'; 
  $today = date('Y-m-d');
  $year = date('Y');
  if(isset($_GET['year'])){
    $year = $_GET['year'];
  }
?>


                <?php include('include/header.php');?>
                <?php include('include/sidebar.php');?>
                <?php include('include/menubar.php');
                
                ?>

          
  <div class="content-wrapper">

  <section class="content-header">

  <h1 class="h3 mb-4 text-gray">Profile Setting</h1>


        </section>
              
        
                     
<?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

        
       <span id="message"></span>
                    <div class="card shadow mb-4">

                        <div class="card-header py-3">
                        	<div class="row">
                                
                            <div class=" col-11 d-flex justify-content-center">
                                    <img src="<?php echo (!empty($user['doctor_profile_image']))? '../images/'.$user['doctor_profile_image']:'../images/profile.jpg'; ?>" class="img-circle elevation-2 d-flex " style="height:100px; width:100px;" >

                                </div>
                                        
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        <form  method="POST" action="crud/profile_update.php" enctype="multipart/form-data" >

                        <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>License <span class="text-danger">*</span></label>
                                <input type="text" name="license" id="doctor_email_address" value="<?php echo $user['license']?>" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                            </div>
                            
                               <div class="col-md-6">
                                <label>Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="doctor_email_address" id="doctor_email_address" value="<?php echo $user['doctor_email_address']?>" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                            </div>
                            
                            
		          		</div>
		          	</div>
                    <div class="form-group">
                        <div class="row">
                            
                            <div class="col-md-6">
                                <label>Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_name" id="doctor_name" class="form-control" value="<?php echo $user['doctor_name']?>" required data-parsley-trigger="keyup" />
                                <input type="hidden" name="id" id="doctor_name" class="form-control" value="<?php echo $user['id']?>" required data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label> Phone No. <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_phone_no" id="doctor_phone_no" class="form-control" value="<?php echo $user['doctor_phone_no']?>" required  data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Doctor Address </label>
                                <input type="text" name="doctor_address" id="doctor_address" value="<?php echo $user['doctor_address']?>" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Doctor Date of Birth </label>
                                <input type="date" name="doctor_date_of_birth" id="doctor_date_of_birth" value="<?php echo $user['doctor_date_of_birth']?>"  class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           
                            <div class="col-md-6">
                                <label>Doctor Speciality <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_expert_in" id="doctor_expert_in" class="form-control" value="<?php echo $user['doctor_expert_in']?>" required  data-parsley-trigger="keyup" />
                            </div>

                                <div class="col-md-6">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="doctor_password" id="doctor_password" value="<?php echo $user['doctor_password']?>" class="form-control" required  data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                      
                     
                            

                            <div class="col-md">
                            <label>Image <span class="text-danger">*</span></label>
                            <br />
                            <input type="file" name="photo" id="doctor_profile_image" />
                            <div id="uploaded_image"></div>
                            </div>  
                        </div>
                    </div>


                    </div>
                        <div class="modal-footer">
 
                            <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Update" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

						
					</form>


                            </div>
                        </div>
                    </div>

                    
                        
                <?php
                include('include/footer.php');
                ?>