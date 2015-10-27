<?php
	require_once ("../inc/initialize.php");
	if(isset($_POST['exportdatabutton'])){
		$sql = customDecrypt($_POST['exportdata']);
		$database = new MYSQLDatabase();
		$result = $database->query($sql);
		
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
		
		$filename = 'Exported data on '.date('Y-m-d');
		
		$file_ending = "xls";
		//header info for browser
		//header("Content-Type: application/xls");
		header("Content-Type: application/vnd.ms-excel");    
		header("Content-Disposition: attachment; filename=$filename.xls");  
		header("Pragma: no-cache"); 
		header("Expires: 0");
		/*******Start of Formatting for Excel*******/   
		//define separator (defines columns in excel & tabs in word)
		$sep = "\t"; //tabbed character
		
		$schema_insert = "";
		
		echo 'S/N'.$sep;
		
		echo 'Application Number'.$sep;
		
		echo 'Fullname'.$sep;
		
		echo 'Programme'.$sep;
		
		echo 'Date of Application'.$sep;
		
		echo 'Admission Status'.$sep;
		
		print("\n");
		$serialno = 1;
		while($row=$database->fetch_array($result)){
			$schema_insert .= $serialno . $sep;
			$schema_insert .= $row["form_id"] . $sep;
			$schema_insert .= ucwords($row["surname"]) . ' ' . $row["first_name"] . ' ' . $row["middle_name"] . $sep;
			$schema_insert .= $row["department_name"] . $sep;
			$schema_insert .= date('Y-m-d', $row["time_completed_application"]) . $sep;
			$schema_insert .= admission_status($row["status"]) . $sep;
			
			$schema_insert .= "\n";
			$serialno++;
		}
		
		echo $schema_insert;
	}
	else{
		redirect_to('view_applicant.php');
	}
?>