<?php

require_once ("../../inc/initialize.php");
$role = $_SESSION["role"];
$database = new MySQLDatabase();

$faculty = htmlspecialchars($_POST['faculty_id'], ENT_QUOTES);
$department = htmlspecialchars($_POST['department_id'], ENT_QUOTES);
$state = htmlspecialchars($_POST['state'], ENT_QUOTES);
$gender = htmlspecialchars($_POST['gender'], ENT_QUOTES);
$admission_status = htmlspecialchars($_POST['admission_status'], ENT_QUOTES);
$form_id = htmlspecialchars($_POST['form_id'], ENT_QUOTES);
$applicant_name = htmlspecialchars($_POST['applicant_name'], ENT_QUOTES);
$date_from = htmlspecialchars($_POST['date_from'], ENT_QUOTES);
$date_to = htmlspecialchars($_POST['date_to'], ENT_QUOTES);
$arrayDateSpec = array();
if($date_from != NULL && $date_to != NULL){
	$arrayDateSpec = array($date_from, $date_to);
}


if ($faculty != 'all') {
	$faculty_details_result = $database -> query("SELECT * FROM faculty WHERE faculty_id='" . $faculty . "'");
	$faculty_details = $database -> fetch_array($faculty_details_result);
	$faculty_code = $faculty_details['faculty_code'];
} else {
	$faculty_code = 'all';
}

if ($state != 'all') {
	$lga_result = $database -> query("SELECT lga_id FROM lga WHERE state_id = '" . $state . "'");
	$lga = array();
	while ($row = $database -> fetch_array($lga_result)) {
		array_push($lga, $row);
	}
}

$array_values = array('p.student_status' => $faculty_code, 'p.programme_applied_id' => $department, 'state_id' => $state, 'p.gender' => $gender, 'ads.status' => $admission_status, 'p.form_id'=>$form_id, 'applicant_name'=>$applicant_name, 'date'=>$arrayDateSpec);

function admission_status($status) {
	switch ($status) {
		case 1 :
			return "Pending";
			break;
		case 2 :
			return "InEligible";
			break;
		case 3 :
			return "Eligible";
			break;
		case 4 :
			return "Not Offered";
			break;
		case 5 :
			return "Offered Admission";
			break;
		default :
			break;
	}
}

function lgaClause() {
	global $lga;
	$returnstring = '';
	$firstclause = false;
	foreach ($lga as $key => $value) {
		if ($firstclause == false) {
			$returnstring .= "lga_id = '" . $value['lga_id'] . "'";
			$firstclause = true;
		} else {
			$returnstring .= " OR lga_id = '" . $value['lga_id'] . "'";
		}

	}
	return $returnstring;
}

function namesearch(){
	global $applicant_name;
	$returnstring = "p.surname LIKE '%".$applicant_name."%' OR p.first_name LIKE '%".$applicant_name."%' OR p.middle_name LIKE '%".$applicant_name."%'";
	return $returnstring;
}

function dateclause(){
	global $arrayDateSpec;
	$date_from = explode('-', $arrayDateSpec[0]);
	$date_to = explode('-', $arrayDateSpec[1]);
	$date_from = mktime(0, 0, 0, $date_from[1], $date_from[2], $date_from[0]);
	$date_to = mktime(23, 59, 59, $date_to[1], $date_to[2], $date_to[0]);
	return "ads.time_completed_application >= '".$date_from."' AND ads.time_completed_application <= '".$date_to."'";
}

$whereclause = '';
foreach ($array_values as $key => $value) {
	if($key == 'p.form_id'){
		if($value != ''){
			$whereclause .= "AND " . $key . " = '" . $value . "'";
		}
	}elseif($key == 'applicant_name' && $value != ''){
		$whereclause .= "AND (" . namesearch() . ")";
	}elseif($key=='date' && sizeof($arrayDateSpec)!=0){
		$whereclause .= "AND (" . dateclause() . ")";
	}
	elseif (($value != 'all' || $value == '0') && ($key != 'applicant_name' && $key != 'date')) {
		if ($key == 'state_id' && $value != 'all') {
			$whereclause .= "AND (" . lgaClause() . ")";
		}else {
			$whereclause .= "AND " . $key . " = '" . $value . "'";
		}
	}
}
//$sql = "SELECT * FROM personal_details " . $whereclause;
$sql = "SELECT * FROM personal_details p JOIN department d JOIN admission_status ads WHERE p.programme_applied_id = d.department_id AND p.applicant_id = ads.applicant_id AND p.progress = 'Completed' " . $whereclause;
//die($sql);
$row_count = 1;
$applicant_personal_details_result = $database->query($sql);
$number_of_applicants = $database->num_rows($applicant_personal_details_result);

if($number_of_applicants > 0)
{
	echo '<h4 align="center"><span class="badge badge-info">'.$number_of_applicants.'</span> applicant(s) found</h4>';
	
	$number_of_pages = ceil($number_of_applicants / 10);
	
	echo '<div class="tabbable">';
	echo '<input type="hidden" value="'.$number_of_applicants.'" name="exportdata"/>';
	echo '<div class="tab-content">';
	
	$link_str = "";
	$pagecounter = 1;
	$serialno = 1;
	while ($result = $database->fetch_array($applicant_personal_details_result)){
		if($serialno % 10 == 1){
			if($pagecounter == 1){
				echo '<div class="tab-pane active" id="'.$pagecounter.'">';
				//$link_str .= '<li><a class="link" href="#page_'.$pagecounter.'">'.$pagecounter.'</a></li>';
			}
			elseif($pagecounter == 2){
				echo '<div class="tab-pane" id="'.$pagecounter.'">';
				//$link_str .= '<li><a class="link" href="#page_'.$pagecounter.'">'.$pagecounter.'</a></li>';
			}
			else{
				echo '<div class="tab-pane" id="'.$pagecounter.'">';
				//$link_str .= '<li><a class="link" href="#page_'.$pagecounter.'">'.$pagecounter.'</a></li>';
			}
			echo '<table class="table table-hover">
					<thead>
						<tr>';
						if($role == 1 || $role == 5){
							echo'<th></th>';
						}
							echo '<th>S/N</th>
							<th>Application Number</th>
							<th>Full Name</th>
							<th>Programme Applied for</th>
							<th>Application Date</th>
							<th>Admission Status</th>
						</tr>
					</thead>';
					echo '<tbody>';
			}
		
		echo '
		<tr>';
		if($role == 1 || $role == 5){
			echo '<td><input type="checkbox" name="applicant_id_'.$serialno.'" value="'.customEncrypt($result['applicant_id']).'"> </td>';
		}
			echo '<td>' . $serialno . '</td>
			<td>' . $result["form_id"] . '</td>
			<td>' . ucwords($result["surname"]) . ' ' . $result["first_name"] . ' ' . $result["middle_name"] . '</td>
			<td>' . $result["department_name"] . '</td>
			<td>' . date('Y-m-d', $result["time_completed_application"]) . '</td>
			<td>' . admission_status($result["status"]) . '</td>
			<td>
				<a href="applicant_details.php?'.md5('applicant_id').'='.customEncrypt($result['applicant_id']).'" class="btn btn-primary">View</a>
			</td>
			
		</tr>';
		
		
		if($serialno % 10 == 0){
			echo '</tbody>';
			echo '</table>';
			
			echo '</div>';
			$pagecounter++;
		}
		elseif($serialno == $number_of_applicants){
			echo '</tbody>';
			echo '</table>';
			
			echo '</div>';
		}
		$serialno++;
	}
	
	echo '</div>';
	
	echo '</div>';
	echo 'pagenumber='.$number_of_pages;
	echo 'export='.customEncrypt($sql);
	/*<a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
	<a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
	</div>';*/
	
	
}
else
{
	echo '<h4 align="center">No Applicant Found</h4>';
	echo 'pagenumber=0';
}
?>