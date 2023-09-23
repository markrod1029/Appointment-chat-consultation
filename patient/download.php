<?php

//download.php

include('../class/Appointment.php');
include('include/session.php');

$object = new Appointment;


if(isset($_GET["id"]))
{
	$html = '
	<html lang="en" class="">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	
	<table border="0" cellpadding="5" cellspacing="5" width="100%">';


		$html .= '<tr><td align="center">';
	
		$html .= '<h2 align="center">Jesus Hand Healing Hospital</h2>
		<p align="center"> Rizal St, Urbiztondo, Pangasinan</p>
		';
	

	$html .= "
	<tr><td><hr /></td></tr>
	<tr><td>
	";

	$object->query = "
	SELECT * FROM appointment_table 
	WHERE appointment_id = '".$_GET["id"]."'
	";

	$appointment_data = $object->get_result();

	foreach($appointment_data as $appointment_row)
	{

		$object->query = "
		SELECT * FROM patient_table 
		WHERE id = '".$appointment_row["patient_id"]."'
		";

		$patient_data = $object->get_result();

		$object->query = "
		SELECT * FROM doctor_schedule_table 
		INNER JOIN doctor_table 
		ON doctor_table.doctor_id = doctor_schedule_table.doctor_id 
		WHERE doctor_schedule_table.doctor_schedule_id = '".$appointment_row["doctor_schedule_id"]."'
		";

		$doctor_schedule_data = $object->get_result();
		
		$html .= '
		<h4 align="center">Patient Details</h4>
		<table border="0" cellpadding="5" cellspacing="5" width="100%">';

		foreach($patient_data as $patient_row)
		{
			$html .= '<tr><th width="50%" align="right">Patient Name</th><td>'.$patient_row["patient_first_name"].' '.$patient_row["patient_last_name"].'</td></tr>
			<tr><th width="50%" align="right">Contact No.</th><td>'.$patient_row["patient_phone_no"].'</td></tr>
			<tr><th width="50%" align="right">Address</th><td>'.$patient_row["patient_address"].'</td></tr>';
		}

		$html .= '</table><br /><hr />
		<h4 align="center">Appointment Details</h4>
		<table border="0" cellpadding="5" cellspacing="5" width="100%">
		
		';
		foreach($doctor_schedule_data as $doctor_schedule_row)
		{
			$html .= '
			<tr>
				<th width="50%" align="right">Doctor Name</th>
				<td>'.$doctor_schedule_row["doctor_name"].'</td>
			</tr>
			<tr>
				<th width="50%" align="right">Appointment Date</th>
				<td>'.$doctor_schedule_row["doctor_schedule_date"].'</td>
			</tr>
			<tr>
				<th width="50%" align="right">Appointment Day</th>
				<td>'.$doctor_schedule_row["doctor_schedule_day"].'</td>
			</tr>
				<tr>
				<th width="50%" align="right">Appointment Time</th>				

				<td><?php echo date("H:i A", strtotime($appointment_row["doctor_schedule_start_time"])).' - '.date(" H:i A", strtotime($appointment_row["doctor_schedule_start_time"]))?></td>
			</tr>
				
			';
		}

		$html .= '
			<tr>
				<tr><th width="50%" align="right">Reference Number </th><td>'.$appointment_row["appointment_no"].'</td></tr>
			<tr>
				<th width="50%" align="right">Reason for Appointment</th>
				<td>'.$appointment_row["reason_for_appointment"].'</td>
			</tr>
			<tr>
				<th width="50%" align="right">Patient come into Hostpital</th>
				<td>'.$appointment_row["patient_come_into_hospital"].'</td>
			</tr>
			<tr>
				<th width="50%" align="right">Doctor Comment</th>
				<td>'.$appointment_row["doctor_comment"].'</td>
			</tr>
		</table>
			';
	}

	$html .= '
			</td>
		</tr>
	</table></html>';

	echo $html;



}

?>