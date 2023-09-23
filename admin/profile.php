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
                                    <img src="<?php echo (!empty($user['photo']))? '../images/'.$user['photo']:'../images/profile.jpg'; ?>" class="img-circle elevation-2 d-flex " style="height:100px; width:100px;" >

                                </div>
                                        
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        <form  method="POST" action="crud/profile_update.php" enctype="multipart/form-data" >

							<div class="row">
							<div class="col-md-6">

								<div class="form-group">
									<label>First Name<span class="text-danger">*</span></label>
									<input type="text" name="admin_firstname" id="patient_email_address" class="form-control" value="<?php echo $user['admin_firstname']?>" required autofocus data-parsley-type="email" data-parsley-trigger="keyup" />
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label>Last Name<span class="text-danger">*</span></label>
									<input type="text" name="admin_lastname" id="patient_password"  value="<?php echo $user['admin_lastname']?>" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>

						

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Admin Email<span class="text-danger">*</span></label>
									<input type="text" name="email" id="patient_first_name"   value="<?php echo $user['email']?>"  class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Phone number <span class="text-danger">*</span></label>
									<input type="text" name="phone" id="patient_last_name" class="form-control"  value="<?php echo $user['phone']?>"  required  data-parsley-trigger="keyup" />
									<input type="hidden" name="id" id="patient_last_name" class="form-control"  value="<?php echo $user['id']?>"  required  data-parsley-trigger="keyup" />
								</div>
							</div>
						</div>
	
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Password<span class="text-danger">*</span></label>
									<input type="password" name="password" id="password"   value="<?php echo $user['password']?>" class="form-control" required  data-parsley-trigger="keyup" />
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Complete Address<span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control"   required data-parsley-trigger="keyup"><?php echo $user['address']?></textarea>

									</select>
								</div>
							</div>
						</div>
						

                        <div class="form-group">
            <label>Patient Image <span class="text-danger">*</span></label>
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