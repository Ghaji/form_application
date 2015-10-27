<?php
require_once("../inc/initialize.php");

if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
}

if(!$_GET[md5('applicant_id')])
{
	redirect_to('view_applicant.php');
}
$role = $_SESSION["role"];

function getFileDirectory($filename, $filetype){
	if($filetype == 'Degree Certificate'){
		$rootdirectory = '../documents/certificates/';
	}elseif($filetype == 'Degree Transcript'){
		$rootdirectory = '../documents/transcripts/';
	}elseif($filetype == 'Thesis Proposal'){
		$rootdirectory = '../documents/thesis/';
	}
	
	$rootdirectory .= $filename;
	
	return $rootdirectory;
}

$applicant_id = customDecrypt($_GET[md5('applicant_id')]);

$user = new User();

$user->applicant_id = $applicant_id;

$progress = $user->find_by_sql("SELECT progress FROM personal_details WHERE applicant_id='".$user->applicant_id."'");

$progress = array_shift($progress);

$student_status = $user->get_student_status();

$database = new MySQLDatabase();

?>
<?php
	$personal_details = $database->query("SELECT * FROM personal_details p, title t, lga l, state s, religion r, nationality n, department d, faculty f, next_of_kin next, marital mar, photographs photo WHERE p.applicant_id='".$applicant_id."' AND p.title_id=t.title_id AND p.lga_id=l.lga_id AND l.state_id=s.state_id AND p.religion_id=r.religion_id AND p.country_id=n.country_id AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id AND p.applicant_id=next.applicant_id AND p.applicant_id=photo.applicant_id AND p.marital_status=mar.marital_status_id");
	
	$personal_details = $database->fetch_array($personal_details);
	
	$admissions = new Admission();
	
	$sql = "select * from admission_status where applicant_id='".$applicant_id."'";
	$admissions = Admission::find_by_sql($sql);
	
	foreach($admissions as $admission):
	$date = $admission->date_completed_application;
	$time = $admission->time_completed_application;
	$academic_session = $admission->academic_session;
	$status = $admission->status;
	$reason = $admission->reason;
	endforeach;
	
	if($status == 0){
		 $msg = '<span class="label label-inverse">You have not completed your application form yet</span>';
	 }elseif($status == 1){
		 $msg = '<span class="label ">Pending</span>';
	 }elseif($status == 2){
		 $msg = '<span class="label label-info">Being Processed @ Departmental Level</span>';
	 }elseif($status == 3){
		 $msg = '<span class="label label-warning">Waiting for Approval by admission board</span>';
	 }elseif($status == 4){
		 $msg = '<span class="label label-important">Not Offered Admission</span>';	
	 }else{
		 $msg = '<span class="label label-success">Offered Admission</span>';
	}
			
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php
		require_once (LIB_PATH . DS . 'css.php');
?>
</head>
<body>

		<!-- beginnning of main content-->
		<!-- header -->
		<?php
			include_layout_template('admin_header.php');
		?>
		<!-- //header -->
		<br>
		<br>

		<!-- Content -->
		<div class="row-fluid">

			<?php
				include_layout_template('admin_menu.php');
			?>
<!-- applicant details will show here -->
			<div class="span9">
				<?php
                    echo '<h2>Application Details for '.$personal_details['title_name'].' '.$personal_details['surname'].' '.$personal_details['first_name'].' '.$personal_details['middle_name'].' </h2>'
                ?>
                <hr>
                
                <h4 align="center" class="alert alert-success">Personal Details</h4>
				<div><h5 style="text-align:center">Admission Status: <?php echo $msg; ?></h5></div>
				<table class="table table-bordered">
			  	<tbody>
                	<tr>
                    	<td style="width:20%">Application Number: </td>
                    	<td><?php echo $personal_details['form_id']; ?></td>
                        
                        <td rowspan="8" colspan="2">
                        	<div style="width:200px; height:260px; overflow:hidden; margin:auto; border:1px solid #ccc; padding:2px;">
                            	<img src="<?php echo '../passport/'.$personal_details['filename']; ?>" alt="<?php echo $personal_details['caption']; ?>" title="<?php echo $personal_details['caption']; ?>" width="200" /></div>
                        </td>
                    </tr>
                    <tr>
                    	<td>Academic Session: </td>
                    	<td width="40%"><?php echo $academic_session; ?></td>
                    </tr>
			  		<tr>
                    	<td>Full Name: </td>
                    	<td width="40%"><?php echo $personal_details['title_name'].' '.$personal_details['surname'].' '.$personal_details['first_name'].' '.$personal_details['middle_name']; ?></td>
                    </tr>
                    <tr>
                    	<td>Email: </td>
                    	<td><?php echo $personal_details['email']; ?></td>
                    </tr>
                    <tr>
                    	<td>Phone Number: </td>
                    	<td><?php echo $personal_details['phone_number']; ?></td>
                    </tr>
                    <tr>
                    	<td>Gender: </td>
                    	<td><?php echo ($personal_details['gender']=='M') ? 'Male' : 'Female'; ?></td>
                    </tr>
                    <tr>
                    	<td>Date of Birth: </td>
                    	<td><?php echo $personal_details['dob']; ?></td>
                    </tr>
                    <tr>
                    	<td>Marital Status: </td>
                    	<td><?php echo $personal_details['marital_status']; ?></td>
                    </tr>
                    <tr>
                    	<td>State of Origin: </td>
                    	<td><?php echo $personal_details['state_name']; ?></td>
                        <td width="20%">LGA:</td>
                        <td><?php echo $personal_details['lga_name']; ?></td>
                    </tr>
                    <tr>
                    	<td>Contact Address: </td>
                    	<td><?php echo $personal_details['address']; ?></td>
                        <td>Country: </td>
                        <td><?php echo $personal_details['country_name']; ?></td>
                    </tr>
                     <tr>
                    	<td>Religion: </td>
                    	<td><?php echo $personal_details['religion_name']; ?></td> 
                        <td>Programme Type: </td> 
                        <td><?php
                        	switch($personal_details['type_of_programme'])
							{
								case 'FT': echo 'Full Time'; break;
								case 'PT': echo 'Part Time'; break;
							}
						?></td>                     
                    </tr>
			  	</tbody>
			</table>
			
			<!-- table for programme applied details-->
            <h4 align="center" class="alert alert-success">Programme Applied Details</h4>
            <?php
				$thesis_details = Thesis::find_by_id($applicant_id);
			?>
            <table class="table table-bordered table-hover">
            	<tbody>
                	<tr>
                    	<td>Programme: </td>
                        <td><?php echo $personal_details['faculty_name'];?></td>
                    </tr>
                    <tr>
                    	<td>Course: </td>
                        <td><?php echo $personal_details['department_name'];?> </td>
                    </tr>
                   <?php if($personal_details['student_status'] == "PGA"){ ?>
                    <tr>
                    	<td>Proposed Thesis Topic: </td>
                        <td><?php echo isset($thesis_details->thesis_topic) && !empty($thesis_details->thesis_topic) ? $thesis_details->thesis_topic: 'No Information Supplied'; ?> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <!--Employment Details-->
            
            <h4 align="center" class="alert alert-success">Employment Details</h4>
            <table class="table table-bordered table-hover">
            <thead>
            	<tr>
            		<th>S/N</th>
                    <th width="30%">Employer</th>
                    <th width="30%">Year of Employment</th>
                    <th width="40%">Employer's Address</th>
				</tr>
            </thead>
            <tbody>
			    <?php	
			        $employments = Employment::find_by_id($applicant_id);
					if(empty($employments))
					{
						echo '<tr>
								<td>1</td>
								<td>No Information Supplied</td>
								<td>No Information Supplied</td>
								<td>No Information Supplied</td>
							</tr>';
					}
					else
					{
						if(!empty($employments->employment_detail_one)) {
							$emp = unserialize($employments->employment_detail_one);
							
							echo '<tr>
							  	<td>1</td>
							  	<td>'.$emp['employer'].'</td>
							  	<td>'.$emp['year'].'</td>
							  	<td>'.$emp['address'].'</td>
							</tr>';		
						}
						
						if(!empty($employments->employment_detail_two)) {
							$emp = unserialize($employments->employment_detail_two);		
	  		
							echo '<tr>
							  	<td>2</td>
							  	<td>'.$emp['employer'].'</td>
							  	<td>'.$emp['year'].'</td>
							  	<td>'.$emp['address'].'</td>
							</tr>';	
						}
						if(!empty($employments->employment_detail_three)) {
							$emp = unserialize($employments->employment_detail_three);		
	  	
							echo '<tr>
							  	<td>3</td>
							  	<td>'.$emp['employer'].'</td>
							  	<td>'.$emp['year'].'</td>
							  	<td>'.$emp['address'].'</td>
							</tr>';	
						}
						
						if(!empty($employments->employment_detail_four)) {
							$emp = unserialize($employments->employment_detail_four);	
								
	  		 				echo '<tr>
							  	<td>4</td>
							  	<td>'.$emp['employer'].'</td>
							  	<td>'.$emp['year'].'</td>
							  	<td>'.$emp['address'].'</td>
							</tr>';	
						}
					}
				?>
				</tbody>
	       </table>
            <!--End of Emploment details-->
            
            <!-- Academic details -->
            <h4 align="center" class="alert alert-success">Academic Qualifications</h4>
            <?php if($personal_details['student_status'] == 'PGA'){ ?>
            <h4 align="center">A-Level</h4>
            <table class="table table-bordered table-hover">
            	<thead>
                	<th>S/N</th>
                    <th>Institution Name</th>
                    <th>Class of Degree</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Degree Earned</th>
                    <th>CGPA</th>
                    <th>Course of Study</th>
                </thead>
            <?php
				$tertiary_institution = HigherInstitutions::find_by_sql("SELECT * FROM higher_institutions WHERE applicant_id='".$applicant_id."'");
				$index = 1;
				echo '<tbody>';
				foreach($tertiary_institution as $higher_institution)
				{
					echo '
					<tr>
						<td width="4%">'.$index.'</td>
						<td width="30%">'.$higher_institution->institution_name.'</td>
						<td width="15%">'.$higher_institution->class_of_degree.'</td>
						<td width="5%">'.$higher_institution->year_of_attendance.'</td>
						<td width="5%">'.$higher_institution->graduation_year.'</td>
						<td width="8%">'.$higher_institution->degree_earned.'</td>
						<td width="5%">'.$higher_institution->cgpa.'</td>
						<td>'.$higher_institution->course_of_study.'</td>
					</tr>';
					$index++;
				}
				echo '</tbody>';
			?>
            </table>
            <!--End of PGA condition for Tertiary Institution-->
            <?php } ?>
            
            
            
            <!-- O - level details -->
            <h4 align="center" >O-Level Details</h4>
            <div class="row-fluid">
           
				<?php
$o_level_data = $database->query("SELECT * FROM o_level_details olevel, exam_id ex WHERE olevel.applicant_id='".$applicant_id."' AND olevel.exam_type_id=ex.exam_type_id");
					
					$count=1;
					
					while($o_level = $database->fetch_array($o_level_data))
					{
						$sitting_name = ($count == 1) ? ' First Sitting' : 'Second Sitting';
						echo '
						<div class="span6"><h5><span class="label label-info">'.$sitting_name.'</span></h5>
							<table class="table table-bordered table-hover">
								<tbody>
									<tr>
										<td style="font-weight:bold">Year</td>
										<td>'.$o_level['exam_year'].'</td>
										<td style="font-weight:bold">Exam No:</td>
										<td>'.$o_level['exam_number'].'</td>
									</tr>
									<tr>
										<td style="font-weight:bold">Exam Name</td>
										<td>'.$o_level['exam_name'].'</td>
										<td style="font-weight:bold">Exam Center</td>
										<td>'.$o_level['exam_centre'].'</td>
									</tr>';
						$o_level_result = unserialize($o_level['subject_grade']);
						$size = (sizeof($o_level_result))/2;
						for($counter = 1; $counter <= $size; $counter++)
						{
							
							$subject = $database->query("SELECT subject_name FROM exam_subject WHERE subject_id='".$o_level_result['o_level_'.$count.'_subject_'.$counter]."'");
							$grade = $database->query("SELECT grade FROM exam_grade WHERE grade_id='".$o_level_result['o_level_'.$count.'_grade_'.$counter]."'");
							$subject = $database->fetch_array($subject);
							$grade = $database->fetch_array($grade);
							echo '<tr>';
							echo '<td colspan="3">'.ucwords($subject['subject_name']).'</td>';
							echo '<td>'.$grade['grade'].'</td>';
							echo '</tr>';
						}
						echo '		</tbody>
                			</table>
						</div>
						';
						$count++;
					}
                ?> 
     </div>           
           
            <!-- Awards and Prizes -->
           
            <h4 align="center" class="alert alert-success">Awards and Prizes</h4>
            <table class="table table-bordered table-hover">
            	<thead>
                	<th>S/N</th>
                    <th>Prize</th>
                    <th>Awarding Body</th>
                    <th>Year</th>
                </thead>
                <tbody>
	            <?php
				
	            	$default = "No Information Supplied";
					
					$awards = User::find_by_id($applicant_id);
					
					
					
					
					if(empty($awards)){
						echo '<tr>
								<td>1</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
							</tr>
						';
					} else {
						$award = unserialize($awards->academic_prizes);
						$awards_size = sizeof($award);
						if($awards_size < 1){
							echo '<tr>
								<td>1</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
							</tr>
							';
						} else {
							$award_counter = 1;
							while($award_counter <= $awards_size) {
								echo '<tr>
									<td>'.$award_counter.'</td>
									<td>'.$award[$award_counter]["prize"].'</td>
									<td>'.$award[$award_counter]["awarding_body"].'</td>
									<td>'.$award[$award_counter]["year"].'</td>
								</tr>
							';
								$award_counter++;
							}	
						}
					}
	            ?>
	            </tbody>
            </table>
            
            <!-- Other Relevant Qualifications -->
            <h4 align="center" class="alert alert-success">Professional and Other Relevant Qualifications</h4>
            <table class="table table-bordered table-hover">
            	<thead>
                	<tr>
                		<th>S/N</th>
					  	<th>Name of Institution</th>
						<th>From</th>
						<th>To</th>
						<th>Qualification</th>
						<th>Grade</th>
					</tr>
                </thead>
                <tbody>
	            <?php
	            	$default = "No Information Supplied";
	            	$sql_qualification = "SELECT * FROM other_relevant_qualifications WHERE applicant_id=" . $applicant_id;
				$result_qualification = Qualifications::find_by_sql($sql_qualification);
				
				if(empty($result_qualification)) {
					echo '<tr>
								<td>1</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
								<td>'.$default.'</td>
							</tr>
						';
				} else {
					$qual_counter = 1;
					foreach($result_qualification as $qualification) {
						echo '<tr>
							<td>'.$qual_counter.'</td>
							<td>'.$qualification->name_of_institutions.'</td>
							<td>'.$qualification->from_year.'</td>
							<td>'.$qualification->to_year.'</td>
							<td>'.$qualification->certificate_qualification_name.'</td>
							<td>'.$qualification->grade.'</td>
						</tr>
					';
						$qual_counter++;
					}
				}
	            ?>
	            </tbody>
            </table>
                
            <?php if($personal_details['student_status'] == "PGA"){ ?>
		             
		            	<h4 align="center" class="alert alert-success">Academic Publications</h4>
		    <?php	
		        $academic_publication = Publication::find_by_sql("SELECT * FROM academic_publications WHERE applicant_id='".$applicant_id."'");
				
				if(empty($academic_publication))
				{
					$no_information = 'No Information Supplied';
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>Title Of Publication</th>
		                    <th>Institution</th>
		                    <th>Qualification</th>
		                    <th>Year</th>
		                </thead>
						<tbody>
							<tr>
								<td width="4%"> 1. </td>
								<td width="20%">'.$no_information.'</td>
								<td width="20%">'.$no_information.'</td>
								<td width="20%">'.$no_information.'</td>
								<td width="20%">'.$no_information.'</td>
							</tr>
						</tbody>
		
		            </table>';
				}
				else
				{
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>Title Of Publication</th>
		                    <th>Institution</th>
		                    <th>Qualification</th>
		                    <th>Year</th>
		                </thead>';
						
						$index = 1;
						echo '<tbody>';
						foreach($academic_publication as $acad_publication)
						{
							echo '
							<tr>
								<td width="4%">'.$index.'</td>
								<td width="40%">'.$acad_publication->title_of_publication.'</td>
								<td width="40%">'.$acad_publication->institution.'</td>
								<td width="5%">'.$acad_publication->qualification.'</td>
								<td width="5%">'.$acad_publication->year_of_publication.'</td>
							</tr>';
							$index++;
						}
						echo '</tbody>
		
		            </table>';
				}
			?>
		    
		    
		    	<h4 align="center" class="alert alert-success">Other Publications</h4>
		    <?php	
		        $other_publication = OtherPublication::find_by_sql("SELECT * FROM otherpublications WHERE applicant_id='".$applicant_id."'");
				
				if(empty($other_publication))
				{
					$no_information = 'No Information Supplied';
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>Title Of Publication</th>
		                    <th>Publisher</th>
		                </thead>
						<tbody>
							<tr>
								<td width="4%"> 1. </td>
								<td width="60%">'.$no_information.'</td>
								<td width="30%">'.$no_information.'</td>
							</tr>
						</tbody>
		
		            </table>';
				}
				else
				{
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>Title Of Publication</th>
		                    <th>Publisher</th>
		                </thead>';
						
						$index = 1;
						echo '<tbody>';
						foreach($other_publication as $otherpub)
						{
							echo '
							<tr>
								<td width="4%">'.$index.'</td>
								<td width="70%">'.$otherpub->title_of_publication.'</td>
								<td width="20%">'.$otherpub->publisher.'</td>
							</tr>';
							$index++;
						}
						echo '</tbody>
		
		            </table>';
				}
			?>
		    
		    <h4 align="center" class="alert alert-success">Referee Details</h4>
		    <?php	
		        $referees = Referees::find_by_sql("SELECT * FROM referees WHERE applicant_id='".$applicant_id."'");
				
				if(empty($referees))
				{
					echo 'Not applicable';
				}
				else
				{
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>Referee Name</th>
		                    <th>Referee Mail</th>
							<th>Mobile Number</th>
							<th>Status</th>
		                </thead>';
						
						$index = 1;
						echo '<tbody>';
						foreach($referees as $ref)
						{
							switch($ref->referee_form_status)
							{
								case '1': $formstatus = 'Responded'; 
									$button = '<button type="submit" class="btn btn-info" name="view_ref_response">View Response</button>';
									break;
								case '0': $formstatus = 'No Response';
									$button = '<button type="submit" class="btn btn-danger disabled" name="view_ref_response">View Response</button>';
									break;
							}
							echo '
							<tr>
								<td width="4%">'.$index.'</td>
								<td width="30%">'.$ref->referee_name.'</td>
								<td width="27%">'.$ref->referee_email.'</td>
								<td width="10%">'.$ref->referee_phone_number.'</td>
								<td width="11%">'.$formstatus.'</td>
								<form action="referee_response.php" method="POST"><td width="15%">'.$button.'</td>
								<input type="hidden" name="refid" value="'.customEncrypt($ref->referees_id).'" />
								<input type="hidden" name="aid" value="'.customEncrypt($applicant_id).'" />
								</form>
							</tr>';
							$index++;
						}
						echo '</tbody>
		
		            </table>';
				}
			 } ?>
			
			
			<h4 align="center" class="alert alert-success">Attached Documents</h4>
		    <?php	
		        $files = Files::find_by_sql("SELECT * FROM files WHERE applicant_id='".$applicant_id."'");
				
				if(empty($files))
				{
					echo 'Not Attached';
				}
				else
				{
					echo '
					<table class="table table-bordered table-hover">
		            	<thead>
		                	<th>S/N</th>
		                    <th>File</th>
		                    <th>Type</th>
							<th>Size</th>
		                </thead>';
						
						$index = 1;
						echo '<tbody>';
						foreach($files as $file)
						{
							//$file = split("-", $file->filename);
							echo '
							<tr>
								<td width="4%">'.$index.'</td>
								<td width="30%">'.$file->filename.'</td>
								<td width="27%">'.$file->caption.'</td>
								<td width="10%">'.number_format ($file->size /1024, 2).'kb</td>
								<form action="load.php" method="POST" target="_blank">
								<td width="10%"><button type="submit" class="btn btn-default view-file" id="'.$index.'">View</button></td>
								<input type="hidden" id="'.$index.'-file" name="aid" value="'.getFileDirectory($file->filename, $file->caption).'" />
								</form>
							</tr>';
							$index++;
						}
						echo '</tbody>
		
		            </table>';
				} ?>

			 <h4 align="center" class="alert alert-success">Applicant's Eligibility</h4>
			 <form method="POST" class="eligibility">
				 <table class="table table-bordered table-hover">
				 	<thead>
				 		<th width="15%">Eligibility</th>
				 		<th>Reason</th>
				 	</thead>
				 	<tbody>
				 		<td width="15%">
				 			<div class="control-group">
					 			<div class="controls">
						 			<select class="input-medium" name="eligibility_status" id="eligibility_status">
						 				<?php 
						 				if(isset($status) && !empty($status)) {
						 					switch ($status) {
											 case 2:
												 echo '<option value="2">Not Eligible</option>
						 								<option value="3">Eligible</option>';
												 break;
											 case 3:
												 echo '<option value="3">Eligible</option>
						 								<option value="2">Not Eligible</option>';
												 break;
											  default:
												  echo '<option value="2">Not Eligible</option>
						 								<option value="3">Eligible</option>';
												  break;
										 	}
						 				}
						 				?>
						 			</select>
					 			</div>
				 			</div>
				 			
				 		</td>
                       
				 		<td>
				 		 <div class="control-group">
					 			<div class="controls">
									<select name="reason" <?php if(isset($status) && $status == 3) echo 'disabled="disabled"'; ?>>
                                    	<option value="">--Select--</option>
                                        <?php
											$sqlreasons = $database->query("SELECT * FROM reasons_inelligibility WHERE reason_status=1");
											while($row = $database->fetch_array($sqlreasons)){
												if(isset($reason) && $row['reason'] == $reason){
													echo '<option selected="selected" value="'.$row['reason'].'">'.$row['reason'].'</option>';
												}else{
													echo '<option value="'.$row['reason'].'">'.$row['reason'].'</option>';
												}
											}
										?>
                                    </select>
								</div>
							</div>	
	                	</td>

				 	</tbody>
				 </table>
				 <input type="hidden" name="aid" value="<?php echo customEncrypt($applicant_id); ?>" />
				 <button type="submit" class="btn btn-inverse offset5" id="eligibility_submit">Update</button>
			 </form>
			 
			 <?php
			 if($role == 1){
			 ?>
					<!-- Set Admission Status -->
					<h4 align="center" class="alert alert-success">Set Admission Status</h4>
					<form method="POST" class="admission">
						<div id="admission_status_wrapper" class="input-prepend span4 offset2">
							<span class="add-on"><i class="icon-chevron-down"></i></span>
							<select class="input-xlarge" name="admission_status" id="admission_status" >
								<option value="4">Not offered Admission</option>
								<option value="5">Offered Admission</option>
							</select>
						</div>
						<input type="hidden" name="aid" value="<?php echo customEncrypt($applicant_id); ?>" />
						<button id="set_admission_status" type="submit" class="btn btn-primary">Set Admission Status</button>
					</form>
			 <?php
			 }
			 ?>
			<!-- end of applicant details -->              
			</div>

		</div>
		<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
		    <div class="modal-body ajax_data"></div>
		    <div class="modal-footer">
		         <a href="#" class="btn" id="close">Close</a>
			</div> 
		</div>
		<!-- //Content -->
		<?php include_layout_template("footer.php"); ?>
	</body>
</html>
<?php
require_once (LIB_PATH . DS . 'javascript.php');
?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script src="js/admin_post_eligibility.js"></script>
<script src="js/admin_admission_status.js"></script>
<script type="text/javascript">
	
</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none; width:1000px; height:1000px;">
	<div class="modal-body ajax_data" style="height:1000px; width:1000px;"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>