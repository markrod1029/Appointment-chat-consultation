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

		<?php
        if(isset($_SESSION['error'])){
          echo " <br>
            <div class='alert alert-danger alert-dismissible'>
              ".$_SESSION['error']."
               <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            </div>
          ";;
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              ".$_SESSION['success']."
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>

            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h3 class="m-0 font-weight-bold text-success">Doctor List</h3>
                            	</div>
                            	<div class="col" align="right">
                            		<a href="add_doctor.php" type="button" name="add_doctor" id="add_doctor" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></a>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
								<thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Doctor License</th>
                                            <th>Email Address</th>
                                            <th>FullName</th>
                                            <th>Phone No.</th>
                                            <th>Address</th>
                                            <th>B-date</th>
                                            <th>Doctor Specialization</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                    
                    $sql = "SELECT * from  doctor_table ";

                    $query = mysqli_query($conn, $sql);
                    $data = array();

                    while ($row = mysqli_fetch_assoc($query)) 
                    {
                       
		

                    ?>
                        <tr>
                        <td><img src="<?php echo $row["doctor_profile_image"]?>" class="img-thumbnail" width="75" />
                         <td><?php echo $row["license"] ?></td>
                        <td><?php echo $row["doctor_email_address"] ?></td>
                        <td><?php echo $row['doctor_name'];?></td>
                        <td><?php echo $row['doctor_phone_no'];?></td>
                        <td><?php echo $row['doctor_address'];?></td>
                        <td><?php echo $row['doctor_date_of_birth'];?></td>
                        <td><?php echo $row['doctor_expert_in'];?></td>
                        <td>
						<?php
						$status = '';
						if($row["doctor_status"] == 'Available')
						{?>

							<a  class="btn btn-primary btn-sm status_button"  href="doctor.php?status=<?php echo $row["id"] ?>"  onclick="return confirm('Are you sure you want to Available it?')">Available</a>
						<?php
						}
						else{?>
							<a class="btn btn-danger btn-sm status_button" href="doctor.php?change=<?php echo $row["id"] ?>"  onclick="return confirm('Are you sure you want to Unavailable it?')">Unavailable</button>
						<?php }
						?></td>

                    <td>
						<a name="edit" href="update_doctor.php?id=<?php echo $row['id']?>" class="btn btn-warning btn-circle btn-sm" ><i class="fas fa-edit"></i></a>
						<a type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" href="doctor.php?del=<?php echo $row["id"] ?>" onclick="return confirm('Are you sure you want to Delete Doctor?')" ><i class="fas fa-times"></i></a>
                    </td>
                    
                    <?php
                            }
                    ?>

                        </tr>        


                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                <?php
                include('include/footer.php');?>


<?php



@$change = $_GET['change'];
@$next = $_GET['status'];
@$del = $_GET['del'];
if($change==TRUE)
{

	$id =$_GET['change'];
	$change = 'Available';

	$sql= "UPDATE doctor_table  SET doctor_status = '$change' WHERE id = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Change status  '.$change.' ';
	}

	else{
	$_SESSION['error'] = $connect->error;
	}	
	
	echo
"
	<script>
		window.location='doctor.php';
	</script>
";
}

if($next==TRUE)
{

	$id =$_GET['status'];
	$changes = 'Unavailable';

	$sql= "UPDATE doctor_table  SET doctor_status = '$changes' WHERE id = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Change status  '.$changes.' ';

	}

	else{
	$_SESSION['error'] = $connect->error;
	}	
	
	echo
"
	<script>
		window.location='doctor.php';
	</script>
";
}

if($del==TRUE)
{

	$id =$_GET['del'];

	$sql= "DELETE FROM doctor_table  WHERE id = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Delete Succesfully ';

	}

	else{
	$_SESSION['error'] = $connect->error;
	}	
	
	echo
"
	<script>
		window.location='doctor.php';
	</script>
";
}


?>


                