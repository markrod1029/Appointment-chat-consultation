<?php

//doctor_action.php

include('../class/Appointment.php');

$object = new Appointment;

if(isset($_POST["action"]))
{
	if($_POST["action"] == 'fetch')
	{
		$order_column = array('doctor_name', 'doctor_status');

		$output = array();

		$main_query = "
		SELECT * FROM doctor_table ";

		$search_query = '';

		if(isset($_POST["search"]["value"]))
		{
			$search_query .= 'WHERE doctor_email_address LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_name LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_phone_no LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_date_of_birth LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_degree LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_expert_in LIKE "%'.$_POST["search"]["value"].'%" ';
			$search_query .= 'OR doctor_status LIKE "%'.$_POST["search"]["value"].'%" ';
		}

		if(isset($_POST["order"]))
		{
			$order_query = 'ORDER BY '.$order_column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
		}
		else
		{
			$order_query = 'ORDER BY doctor_id DESC ';
		}

		$limit_query = '';

		if($_POST["length"] != -1)
		{
			$limit_query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
		}

		$object->query = $main_query . $search_query . $order_query;

		$object->execute();

		$filtered_rows = $object->row_count();

		$object->query .= $limit_query;

		$result = $object->get_result();

		$object->query = $main_query;

		$object->execute();

		$total_rows = $object->row_count();

		$data = array();

		foreach($result as $row)
		{
			$sub_array = array();
			$sub_array[] = '<img src="'.$row["doctor_profile_image"].'" class="img-thumbnail" width="75" />';
			$sub_array[] = $row["doctor_id"];
			$sub_array[] = $row["doctor_email_address"];
			$sub_array[] = $row["doctor_name"];
			$sub_array[] = $row["doctor_phone_no"];
			$sub_array[] = $row["doctor_address"];
			$sub_array[] = $row["doctor_date_of_birth"];
			$sub_array[] = $row["doctor_expert_in"];
			$status = '';
			if($row["doctor_status"] == 'Available')
			{
				$status = '<button type="button" name="status_button" class="btn btn-primary btn-sm status_button" data-id="'.$row["id"].'" data-status="'.$row["doctor_status"].'">Available</button>';
			}
			else
			{
				$status = '<button type="button" name="status_button" class="btn btn-danger btn-sm status_button" data-id="'.$row["id"].'" data-status="'.$row["doctor_status"].'">Unavailable</button>';
			}
			$sub_array[] = $status;
			$sub_array[] = '
			<div align="center">
			<a name="edit" href="update_doctor.php?id='.$row['id'].'" class="btn btn-warning btn-circle btn-sm" ><i class="fas fa-edit"></i></a>
			<button type="button" name="delete_button" class="btn btn-danger btn-circle btn-sm delete_button" data-id="'.$row["id"].'"><i class="fas fa-times"></i></button>
			</div>
			';
			$data[] = $sub_array;
		}

		$output = array(
			"draw"    			=> 	intval($_POST["draw"]),
			"recordsTotal"  	=>  $total_rows,
			"recordsFiltered" 	=> 	$filtered_rows,
			"data"    			=> 	$data
		);
			
		echo json_encode($output);

	}


	if($_POST["action"] == 'fetch_single')
	{
		$object->query = "
		SELECT * FROM doctor_table 
		WHERE id = '".$_POST["doctor_id"]."'
		";

		$result = $object->get_result();

		$data = array();
 
		foreach($result as $row)
		{
			$data['doctor_id'] = $row['doctor_id'];
			$data['doctor_email_address'] = $row['doctor_email_address'];
			$data['doctor_password'] = $row['doctor_password'];
			$data['doctor_name'] = $row['doctor_name'];
			$data['doctor_profile_image'] = $row['doctor_profile_image'];
			$data['doctor_phone_no'] = $row['doctor_phone_no'];
			$data['doctor_address'] = $row['doctor_address'];
			$data['doctor_date_of_birth'] = $row['doctor_date_of_birth'];
			$data['doctor_degree'] = $row['doctor_degree'];
			$data['doctor_expert_in'] = $row['doctor_expert_in'];
		}

		echo json_encode($data);
	}


	if($_POST["action"] == 'change_status')
	{
		$data = array(
			':doctor_status'		=>	$_POST['next_status']
		);

		$object->query = "
		UPDATE doctor_table 
		SET doctor_status = :doctor_status 
		WHERE id = '".$_POST["id"]."'
		";

		$object->execute($data);

		echo '<div class="alert alert-success">Class Status change to '.$_POST['next_status'].'</div>';
	}

	if($_POST["action"] == 'delete')
	{
		$object->query = "
		DELETE FROM doctor_table 
		WHERE id = '".$_POST["id"]."'
		";

		$object->execute();

		echo '<div class="alert alert-success">Doctor Data Deleted</div>';
	}
}

?>