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
  <h1 class="h3 mb-4 text-gray">Doctor Management</h1>

        </section>
                        
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="h3 m-0 font-weight-bold text-success"> Add Doctor</h6>
                            	</div>
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        
        <form  class="form-horizontal box-show" method="POST" action="crud/doctor_add.php" enctype="multipart/form-data" id="doctor_form">
        
            <span id="form_message"></span>
            <div class="form-group">
                        <div class="row">
                                <div class="col-md-12">
                                <label>License <span class="text-danger">*</span></label>
                                <input type="text" name="license" id="doctor_email_address" minlength="7" maxlength="7" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label> Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="doctor_email_address" id="doctor_email_address" class="form-control" required data-parsley-type="email" data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="doctor_password" id="doctor_password" class="form-control" required  data-parsley-trigger="keyup" />
                            </div>
		          		</div>
		          	</div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>FullName <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_name" id="doctor_name" class="form-control" required data-parsley-trigger="keyup" />
                            </div>
                            <div class="col-md-6">
                                <label>Phone No. <span class="text-danger">*</span></label>
                                <input type="text"  minlength="11" maxlength="11" pattern="\d{11}" title="11-digit Phone Number"  name="doctor_phone_no" id="doctor_phone_no" class="form-control" required  data-parsley-trigger="keyup" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Address </label>
                                <input type="text" name="doctor_address" id="doctor_address" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Date of Birth </label>
                                <input type="date" name="doctor_date_of_birth" id="doctor_date_of_birth"  class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                           
                            <div class="col-md-6">
                                <label>Specialization <span class="text-danger">*</span></label>
                                <input type="text" name="doctor_expert_in" id="doctor_expert_in" class="form-control" required  data-parsley-trigger="keyup" />
                            </div>

                            <div class="col-md-6">
                                <label>Image <span class="text-danger">*</span></label>
                                <br />
                                <input type="file" name="doctor_profile_image" id="doctor_profile_image" />
                                <div id="uploaded_image"></div>
                                <input type="hidden" name="hidden_doctor_profile_image" id="hidden_doctor_profile_image" />
                            </div>
                        </div>
                    </div>
        </div>
    <div class="modal-footer">
        <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
        <button type="reset" class="btn btn-default">Reset</button>
    </div>
</form>



                            </div>
                        </div>
                    </div>

                    
                        
                <?php
                include('include/footer.php');
                ?>