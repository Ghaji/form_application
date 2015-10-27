<!-- Begining of Select Applicant form -->
<form class="form-inline view_applicant_form" method="POST">
	<?php
	$database = new MySQLDatabase();

	?>

	<div class="row-fluid">
		<div class="span3">

			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
					
					<?php
					$arraySpecialRoles = array(2=>12, 3=>array(16, 17));
					if(isset($_SESSION['department_id']) && $_SESSION['department_id'] != 0){
						$sql_get_departmentdetails = $database->query("SELECT * FROM department d, faculty f WHERE d.department_id='".$_SESSION['department_id']."' AND d.faculty_id=f.faculty_id");
						$result_departmentdetails = $database->fetch_array($sql_get_departmentdetails);
						echo '<option value="' . $result_departmentdetails['faculty_id'] . '">' . $result_departmentdetails['faculty_name'] . '</option>';
					}elseif(array_key_exists($_SESSION['role'], $arraySpecialRoles) && $_SESSION['department_id'] == 0){
						if(is_array($arraySpecialRoles[$_SESSION['role']])){
							$sql_faculty=$database->query("SELECT * FROM faculty WHERE faculty_id='".$arraySpecialRoles[$_SESSION['role']][0]."' OR faculty_id='".$arraySpecialRoles[$_SESSION['role']][1]."'");
							$output = '';
							while($result_faculty = $database->fetch_array($sql_faculty)){
								$output .= '<option value="'.$result_faculty['faculty_id'].'">'.$result_faculty['faculty_name'].'</option>';
							}
						}else{
							$sql_faculty=$database->query("SELECT * FROM faculty WHERE faculty_id='".$arraySpecialRoles[$_SESSION['role']]."'");
							$result_faculty = $database->fetch_array($sql_faculty);
							$output = '<option value="'.$result_faculty['faculty_id'].'">'.$result_faculty['faculty_name'].'</option>';
						}
						echo $output;
					}
					else{
						echo '<option value="all">--Select Programme--</option>';
						$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
						$result_set = $database -> query($sql_faculty);
						while ($row = $database -> fetch_array($result_set)) {
							echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
						}
					}
					
					?>
				</select>
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>

				<select class="input-xlarge" name="department_id" id="department_id" >
					
                    <?php
						if(isset($_SESSION['department_id']) && $_SESSION['department_id'] != 0){
							echo '<option value="' . $result_departmentdetails['department_id'] . '">' . $result_departmentdetails['department_name'] . '</option>';	
						}else{
							echo '<option value="all">--Select Course--</option>';
							echo '<div id="department_id"></div>';
						}
					?>
					
				</select>
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<select class="input-xlarge" name="state" id="state" >
					<option value="all">--Select State--</option>
					<?php
					$sql_state = $database -> query("SELECT * FROM state");
					while ($row = $database -> fetch_array($sql_state)) {
						echo '<option value="' . $row['state_id'] . '">' . $row['state_name'] . '</option>';
					}
					?>
				</select>
			</div>
		</div>

		<div class="span3  offset1">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<select class="input-xlarge" name="gender" id="gender" >
					<option value="all">--Pick Gender--</option>
					<option value="M">Male</option>
					<option value="F">Female</option>
				</select>
			</div>
			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<select class="input-xlarge" name="admission_status" id="admission_status" >
					<option value="all">--Admission Status--</option>
					<option value="1">Pending</option>
					<option value="2">InEligible</option>
					<option value="3">Eligible</option>
					<option value="4">Not offered Admission</option>
					<option value="5">Offered Admission</option>
				</select>
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<input type="text" name="form_id" placeholder="Search Applicant Form Number" class="input-xlarge" />
			</div>

		</div>

		<div class="span3  offset1">
			<div class="input-prepend">
				<span class="add-on"><i class="icon-chevron-down"></i></span>
				<input type="text" name="applicant_name" placeholder="Search Applicant's Name" class="input-large" />
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<input type="text" class="input-medium datepicker" value="" id="date_from" name="date_from" maxlength="10" readonly="readonly"  data-date-format="yyyy-mm-dd" placeholder="Date From" />
			</div>

			<div class="input-prepend">
				<span class="add-on"><i class="icon-calendar"></i></span>
				<input type="text" class="input-medium datepicker" value="" id="date_to" name="date_to" maxlength="10" readonly="readonly"  data-date-format="yyyy-mm-dd" placeholder="Date To" />
			</div>
		</div>
	</div>
	<div class="control-group">
		<div class="controls offset5">
			<br>
			<button type="submit" class="btn btn-primary" id="submit" >
				Search
			</button>
		</div>
	</div>

	<!--Activate and Deactivate Button-->
	<!-- End of Activate and Deactivate Button-->
</form>
<!-- End of Select Applicant -->