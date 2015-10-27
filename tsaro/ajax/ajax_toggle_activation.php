<?php

require_once ("../../inc/initialize.php");

if (isset($_POST["btn"])) {
	$faculty_id = $_POST["faculty_id"];
	$department_id = $_POST["department_id"];
	$dept = "";
	$faq = "";
	
	if ($faculty_id != 'all') {
		$sql_faq = "SELECT * FROM faculty WHERE faculty_id = " . $faculty_id;
		$result_faq = $database -> query($sql_faq);
		while ($row = $database -> fetch_array($result_faq)) {
			$faq = $row['faculty_name'];
		}
	}

	if ($department_id != 'all') {
		$sql_dept = "SELECT * FROM department WHERE department_id = " . $department_id;
		$result_dept = $database -> query($sql_dept);
		while ($row = $database -> fetch_array($result_dept)) {
			$dept = $row['department_name'];
		}
	}
	
	if ($_POST["btn"] == 'activate_submit') {
		if ($department_id == 'all') {
			// Activate sale of form for a faculty
			$sql_act = "UPDATE `mis_form_application`.`faculty` SET `status` = '1' WHERE `faculty`.`faculty_id` = " . $faculty_id;
			$result_act = $database -> query($sql_act);

			if ($result_act == 1) {
				echo "You have activated sale of form for <strong>" . $faq . "</strong> faculty";
			}
		} else {
			// Activate sale of form for a department
			$sql_act = "UPDATE `mis_form_application`.`department` SET `status` = '1' WHERE `department`.`department_id` = " . $department_id;
			$result_act = $database -> query($sql_act);

			if ($result_act == 1) {
				echo "You have activated sale of form for <strong>" . $dept . "</strong> department";
			}
		}

	} else if ($_POST["btn"] == 'deactivate_submit') {
		if ($department_id == 'all') {
			// Deactivate sale of form for a faculty
			$sql_deact = "UPDATE `mis_form_application`.`faculty` SET `status` = '0' WHERE `faculty`.`faculty_id` = " . $faculty_id;
			$result_deact = $database -> query($sql_deact);

			if ($result_deact == 1) {
				echo "You have deactivated sale of form for <strong>" . $faq . "</strong> faculty";
			}
		} else {
			// Activate sale of form for a department
			$sql_deact = "UPDATE `mis_form_application`.`department` SET `status` = '0' WHERE `department`.`department_id` = " . $department_id;
			$result_deact = $database -> query($sql_deact);

			if ($result_deact == 1) {
				echo "You have deactivated sale of form for <strong>" . $dept . "</strong> department";
			}
		}
	}
}
?>