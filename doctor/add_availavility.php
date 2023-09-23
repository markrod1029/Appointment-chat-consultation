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
                        
                    <span id="message"></span>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        	<div class="row">
                            	<div class="col">
                            		<h6 class="h3 m-0 font-weight-bold text-success">Doctor Availability</h6>
                            	</div>
                            	
                            </div>
                        </div>
                        <div class="card-body">

                        
<form  class="form-horizontal box-show" method="POST" action="crud/schedule_add.php" enctype="multipart/form-data" id="doctor_form">
        
        <span id="form_message"></span>
                   
                            <?php
                        
                            $id = $user['id']; 
                            $sql = " SELECT * FROM doctor_table 
                            WHERE id = '$id' ";
                            $query = $conn->query($sql);
                            $row = $query->fetch_assoc();?>
                     
                     

                            <input type="hidden" name="id" id="doctor_schedule_date" class="form-control" value='<?php echo $row["id"];?>' required  />

                     
<div class="form-group">
  <label>Schedule Day</label>
  <div class="custom-select">
    <label class="select-text">Select Days</label>
    <ul class="options">
      <li>
        <label>
          <input type="checkbox" name="day[]" value="Monday">
          Monday
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="day[]" value="Tuesday">
          Tuesday
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="day[]" value="Wednesday">
          Wednesday
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="day[]" value="Thursday">
          Thursday
        </label>
      </li>
      <li>
        <label>
          <input type="checkbox" name="day[]" value="Friday">
          Friday
        </label>
      </li>
      
       <li>
        <label>
          <input type="checkbox" name="day[]" value="Saturday">
          Saturday
        </label>
      </li>
      
       <li>
        <label>
          <input type="checkbox" name="day[]" value="Sunday">
          Sunday
        </label>
      </li>
    </ul>
  </div>
</div>
  
  
  
			
		          	<div class="form-group">
		          		<label>Start Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
		          		    <input type="time" name="doctor_schedule_start_time" id="doctor_schedule_start_time" class="form-control "  />
                        </div>
		          	</div>
                    <div class="form-group">
                        <label>End Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
                            <input type="time" name="doctor_schedule_end_time" id="doctor_schedule_end_time" class="form-control"  autocomplete="off" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Average Consulting Time</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clock"></i></span>
                            </div>
                            <select name="average_consulting_time" id="average_consulting_time" class="form-control" required>
                                <option value="">Select Consulting Duration</option>
                                <?php
                                $count = 0;
                                for($i = 1; $i <= 15; $i++)
                                {
                                    $count += 5;
                                    echo '<option value="'.$count.'">'.$count.' Minute</option>';
                                }
                                ?>
                            </select>
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





<style>
  .custom-select {
    position: relative;
    width: 100%;
    font-size: 16px;
    color: #333;
  }

  .select-text {
    display: block;
 
    cursor: pointer;
  }

  .options {
    position: absolute;
    top: calc(100% + 5px); /* Adjust the top position */
    left: 0;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 4px 4px;
    padding: 10px;
    z-index: 9999;
    display: none;
  }

  .options li {
    margin: 5px 0;
  }

  .options label {
    display: inline-block;
    margin-right: 10px;
  }

  .options input[type="checkbox"] {
    margin-right: 5px;
  }

  /* Style for selected options */
  .selected-options {
    margin-top: 10px;
  }

  .selected-options span {
    display: inline-block;
    margin-right: 5px;
    padding: 5px 10px;
    background-color: #e9ecef;
    border-radius: 20px;
  }

  .selected-options span:last-child {
    margin-right: 0;
  }
</style>



<script>
	document.addEventListener("DOMContentLoaded", function() {
  const selectText = document.querySelector(".custom-select .select-text");
  const options = document.querySelector(".custom-select .options");
  const checkboxes = document.querySelectorAll(".custom-select input[type='checkbox']");
  
  // Show/hide options
  selectText.addEventListener("click", function() {
    options.style.display = options.style.display === "block" ? "none" : "block";
  });
  
  // Update select text
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener("change", function() {
      const checked = document.querySelectorAll(".custom-select input[type='checkbox']:checked");
      selectText.innerHTML = "Select options";
      if (checked.length) {
        const values = [];
        checked.forEach(function(checkbox) {
          values.push(checkbox.parentNode.innerText.trim());
        });
        selectText.innerHTML = values.join(", ");
      }
    });
  });
});

</script>