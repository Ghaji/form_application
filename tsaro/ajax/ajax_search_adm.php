<?php
require_once ("../../inc/initialize.php");
$role = $_SESSION["role"];
$database = new MySQLDatabase();
//print_r($_POST);
$whereclause = '';
foreach ($_POST as $key => $value) {
	switch ($key) {
		case 'form_number':
			if(!empty($value)){
				$whereclause .= " AND adm.jamb_rem_no = '".$value."'";
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
		case 'session':
			if(!empty($value) && $value !='all'){
				$whereclause .= " AND ads.academic_session = '".$value."'";
			}
			break;
	}
}
//$query_adm_access = "SELECT * FROM adm_access_code adm, personal_details p, department d, admission_status ads WHERE adm.jamb_rem_no = p.form_id AND p.programme_applied_id = d.department_id AND p.applicant_id = ads.applicant_id". $whereclause;

$query_adm_access = "SELECT * FROM adm_access_code adm, personal_details p, department d, faculty f WHERE adm.jamb_rem_no = p.form_id AND p.programme_applied_id = d.department_id AND f.faculty_id = d.faculty_id". $whereclause;
//die($query_adm_access);

$row_count = 1;
$result = $database->query($query_adm_access);
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
							echo '<th>S/N</th>
							<th>Application Number</th>
							<th>Full Name</th>
							<th>Programme Applied for</th>
							<th>Amount</th>
							<th>Status</th>
							<th></th>
						</tr>
					</thead>';
					echo '<tbody>';
			}
		
		echo '
		<tr>';
		
			echo '<td>' . $serialno . '</td>
			<td>' . $record["jamb_rem_no"] . '</td>
			<td>' . ucwords($record["surname"]) . ' ' . ucwords($record["first_name"]) . ' ' . ucwords($record["middle_name"]) . '</td>
			<td>' . $record["department_name"] . '</td>
			<td>' . $record["amount"] . '</td>
			<td>' . $record["student_status"] . '</td>
			<td><a href="view_payment.php?q='. customEncrypt($record["jamb_rem_no"]) .'" class="btn">View</a></td>
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