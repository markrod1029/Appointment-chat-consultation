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
                                    <img src="<?php echo (!empty($user['patient_photo']))? '../images/'.$user['patient_photo']:'../images/profile.jpg'; ?>" class="img-circle elevation-2 d-flex " style="height:100px; width:100px;" >

                                </div>
                                        
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        <form  method="POST" action="crud/profile_update.php" enctype="multipart/form-data" >
                        <div class="row">
							<div class="col-md-6">

								<div class="form-group">
									<label>Patient Email Address<span class="text-danger">*</span></label>
									<input type="text" name="patient_email_address" id="patient_email_address"  value="<?php echo $user['patient_email_address']?>" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
									<input type="hidden" name="id" id="patient_email_address"  value="<?php echo $user['id']?>" class="form-control" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Password<span class="text-danger">*</span></label>
									<input type="password" name="patient_password" id="patient_password"  value="<?php echo $user['patient_password']?>" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>

						

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient First Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_first_name" id="patient_first_name" class="form-control" required  value="<?php echo $user['patient_first_name']?>" data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Last Name<span class="text-danger">*</span></label>
									<input type="text" name="patient_last_name" id="patient_last_name" class="form-control"  value="<?php echo $user['patient_last_name']?>" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Date of Birth<span class="text-danger">*</span></label>
									<input type="date" name="patient_date_of_birth" id="patient_date_of_birth"  value="<?php echo $user['patient_date_of_birth']?>" class="form-control" required  data-parsley-trigger="keyup"  />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Gender<span class="text-danger">*</span></label>
									<select name="patient_gender" id="patient_gender"  value="<?php echo $user['patient_gender']?>" class="form-control">
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Contact No.<span class="text-danger">*</span></label>
									<input type="text" name="patient_phone_no" id="patient_phone_no"  value="<?php echo $user['patient_phone_no']?>" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Patient Maritial Status<span class="text-danger">*</span></label>
									<select name="patient_maritial_status" id="patient_maritial_status"   value="<?php echo $user['patient_maritial_status']?>"class="form-control">
										<option value="Single">Single</option>
										<option value="Married">Married</option>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Patient Complete Address<span class="text-danger">*</span></label>
							<textarea name="patient_address" id="patient_address" class="form-control"   required data-parsley-trigger="keyup"><?php echo $user['patient_address']?></textarea>
						</div>

                        <div class="form-group">
            <label>Doctor Image <span class="text-danger">*</span></label>
            <br />
            <input type="file" name="photo" id="doctor_profile_image" />
            <div id="uploaded_image"></div>
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