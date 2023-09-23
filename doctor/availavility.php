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
  <h1 class="h3 mb-4 text-gray">Doctor Schedule Management</h1>

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
								<h3 class="m-0 font-weight-bold text-success">Doctor Schedule List</h3>
                            	</div>
                            	<div class="col" align="right">
								<a href="add_availavility.php" type="button" name="add_exam" id="add_doctor_schedule" class="btn btn-success btn-circle btn-sm"><i class="fas fa-plus"></i></a>
                            	</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center" id="myTable" width="100%" cellspacing="0">
								<thead>
                                        <tr>
                                            <th>Appointment Day</th>
                                            <th>Appointment Time</th>
                                            <th>Consulting Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                          <?php 
                  $today =  date('Y-m-d');
                  $id = $user['id'];
                    $sql = " SELECT * FROM doctor_schedule_table 
					INNER JOIN doctor_table 
					ON doctor_table.id = doctor_schedule_table.doctor_id WHERE doctor_schedule_table.doctor_id = '$id'
					 ";

                    $query = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($query)) 
                    {
                        
                        // if($row['doctor_schedule_date'] > $today )
                       
		

                    ?>
                        <tr>
                        <td><?php echo $row['doctor_schedule_day']?></td>
                      	<td><?php echo date('h:i A', strtotime($row["doctor_schedule_start_time"])).' - '.date(' h:i A', strtotime($row["doctor_schedule_start_time"]))?></td>
                        <td><?php echo $row["average_consulting_time"] . ' Minute';?></td>
                  
                        <td>
						<?php
						$status = '';
						if($row["doctor_schedule_status"] == 'Available')
						{?>

							<a  class="btn btn-primary btn-sm status_button"  href="availavility.php?status=<?php echo $row["doctor_schedule_id"] ?>" onclick="return confirm('Are you sure you want to Unavailable it?')">Available</a>
						<?php
						}
						else{?>
							<a class="btn btn-danger btn-sm status_button" href="availavility.php?change=<?php echo $row["doctor_schedule_id"] ?>"  onclick="return confirm('Are you sure you want to Available it?')">Unavailable</button>
						<?php }
						?></td>

                    <td>
					<a name="edit" href="update_availavility.php?doctor_schedule_id=<?php echo $row["doctor_schedule_id"] ?>" class="btn btn-warning btn-circle btn-sm" ><i class="fas fa-edit"></i></a>
						<a type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" href="availavility.php?del=<?php echo $row["doctor_schedule_id"] ?>" onclick="return confirm('Are you sure you want to Delete Doctor Schedule?')" ><i class="fas fa-times"></i></a>
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

	$sql= "UPDATE doctor_schedule_table  SET doctor_schedule_status = '$change' WHERE doctor_schedule_id = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Change status  '.$change.' ';
	}

	else{
	$_SESSION['error'] = $conn->error;
	}	
	
	echo
"
	<script>
		window.location='availavility.php';
	</script>
";
}

if($next==TRUE)
{

	$id =$_GET['status'];
	$changes = 'Unavailable';

	$sql= "UPDATE doctor_schedule_table  SET doctor_schedule_status = '$changes' WHERE doctor_schedule_id = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Change status  '.$changes.' ';

	}

	else{
	$_SESSION['error'] = $conn->error;
	}	
	

}

if($del==TRUE)
{

	$id =$_GET['del'];

	$sql= "DELETE FROM doctor_schedule_table  WHERE doctor_schedule_id	 = '".$id."' ";
	if($conn->query($sql)){
		$_SESSION['success'] = 'Doctor Delete Succesfully ';

	}

	else{
	$_SESSION['error'] = $conn->error;
	}	
	
	echo
"
	<script>
		window.location='availavility.php';
	</script>
";
}


?>


                