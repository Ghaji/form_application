<?php
require_once ("../../inc/initialize.php");
//$role = $_SESSION["role"];
$database = new MySQLDatabase();
// print_r($_POST);
// die();
//echo "<br>";
$whereclause = '';
foreach ($_POST as $key => $value) {
	switch ($key) {
		case 'form_number':
			if(!empty($value)){
				$whereclause .= " AND acc.student_id = '".$value."'";
			}
			break;
		case 'faculty_id':
			if(!empty($value) && $value !='all'){
				$whereclause .= " AND f.faculty_id = '".$value."'";
			}
			break;
		case 'department_id':
			if(!empty($value) && $value !='all'){
				$whereclause .= " AND d.department_id = '".$value."'";
			}
			break;
		case 'approval_status':
			if(!empty($value) && $value !='all'){
				$whereclause .= " AND acc.ResponseCode = '".$value."'";
			}
			break;
	}
}
//$query_acceptance = "SELECT * FROM acceptance_acceptance_log acc, personal_details p, department d, faculty f WHERE acc.student_id = p.form_id AND p.programme_applied_id = d.department_id AND f.faculty_id = d.faculty_id". $whereclause;

$query_acceptance = "SELECT * FROM acceptance_acceptance_log acc, personal_details p, department d, faculty f WHERE acc.student_id = p.form_id AND p.programme_applied_id = d.department_id AND f.faculty_id = d.faculty_id". $whereclause;

//print_r($query_acceptance);

$row_count = 1;
$result = $database->query($query_acceptance);
$number_of_records = $database->num_rows($result);

if($number_of_records > 0)
{
	echo '<h4 align="center"><span class="badge badge-info">'.$number_of_records.'</span> applicant(s) found</h4>';
	
	echo '<div class="tabbable">';
	//echo '<input type="hidden" value="'.$result.'" name="exportdata"/>';
	echo '<div class="tab-content">';
	
	$link_str = "";
	$pagecounter = 1;
	$serialno = 1;
	$max = 10;
	$number_of_pages = ceil($number_of_records / $max);
	while ($record = $database->fetch_array($result)){ 
		if($serialno % $max == 1){
			if($pagecounter == 1){
				echo '<div class="tab-pane active" id="'.$pagecounter.'">';
			}
			elseif($pagecounter == 2){
				echo '<div class="tab-pane" id="'.$pagecounter.'">';
			}
			else{
				echo '<div class="tab-pane" id="'.$pagecounter.'">';
			}
			echo '<table class="table table-hover">
					<thead>
						<tr>';
						// if($role == 1 || $role == 6){
							// echo'<th></th>';
						// }
							echo '<th>S/N</th>
							<th>App No</th>
							<th>Response Code</th>
							<th>Response Description</th>
							<th>Amount</th>
							<th>Payment Ref</th>
							<th>Interswitch Date</th>
							<th>View</th>
						</tr>
					</thead>';
					echo '<tbody>';
			}
		
		echo '
		<tr>';
		// if($role == 1 || $role == 6){
			// echo '<td><input type="checkbox" name="applicant_id_'.$serialno.'" value="'.customEncrypt($result['applicant_id']).'"> </td>';
		// }
			echo '<td>' . $serialno . '</td>
			<td>' . $record["student_id"] . '</td>
			<td>' . $record["ResponseCode"] . '</td>
			<td>' . $record["ResponseDescription"] . '</td>
			<td>' . $record["Amount"] . '</td>
			<td>' . $record["PaymentReference"] . '</td>
			<td>' . $record["Interswitch_date"] . '</td>
			<td><a href="view_log_acc.php?q='. customEncrypt($record["student_id"]) .'" class="btn">View</a></td>
			</tr>';
		
		
		if($serialno % $max == 0){
			echo '</tbody>';
			echo '</table>';
			
			echo '</div>';
			$pagecounter++;
		}
		elseif($serialno == $number_of_records){
			echo '</tbody>';
			echo '</table>';
			
			echo '</div>';
		}
		$serialno++;
	}
	
	echo '</div>';
	
	echo '</div>';
	echo 'pagenumber='.$number_of_pages;
}
else
{
	echo '<h4 align="center">No Applicant Found</h4>';
	echo 'pagenumber=0';
}
?>