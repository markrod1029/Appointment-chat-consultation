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
  <h1 class="h3 mb-4 text-gray">Patient Management</h1>

        </section>
                        
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="h3 m-0 font-weight-bold text-success">Add Patient</h6>
                            	</div>
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        <form  method="POST" action="crud/patient_add.php" enctype="multipart/form-data" >

							<div class="row">
							<div class="col-md-6">

								<div class="form-group">
									<label>Email Address<span class="text-danger">*</span></label>
									<input type="text" name="patient_email_address" id="patient_email_address" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Password<span class="text-danger">*</span></label>
									<input type="password" name="patient_password" id="patient_password" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>

						

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Last Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_last_name" id="patient_last_name" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Date of Birth<span class="text-danger">*</span></label>
									<input type="date" name="patient_date_of_birth" id="patient_date_of_birth" class="form-control" required  data-parsley-trigger="keyup"  />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender<span class="text-danger">*</span></label>
									<select name="patient_gender" id="patient_gender" class="form-control">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Contact No.<span class="text-danger">*</span></label>
									<input type="text" name="patient_phone_no"  minlength="11" maxlength="11" pattern="\d{11}" title="11-digit Phone Number"id="patient_phone_no" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Maritial Status<span class="text-danger">*</span></label>
									<select name="patient_maritial_status" id="patient_maritial_status" class="form-control">
										<option value="Single">Single</option>
										<option value="Married">Married</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Complete Address<span class="text-danger">*</span></label>
							<textarea name="patient_address" id="patient_address" class="form-control" required data-parsley-trigger="keyup"></textarea>
						</div>

                        <div class="form-group">
            <label> Image <span class="text-danger">*</span></label>
            <br />
            <input type="file" name="patient_photo" id="doctor_profile_image" />
            <div id="uploaded_image"></div>
        </div>
                        <div class="modal-footer">
 
                            <input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Add" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>

						
					</form>


                            </div>
                        </div>
                    </div>

                    
                        
                <?php
                include('include/footer.php');
                ?>