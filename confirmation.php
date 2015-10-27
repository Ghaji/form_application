<?php
require_once("inc/initialize.php");

if(!$session->is_logged_in())
{
	redirect_to('index.php');
}
$user = new User();

$user->applicant_id = $session->applicant_id;

$progress = $user->find_by_sql("SELECT progress FROM personal_details WHERE applicant_id='".$user->applicant_id."'");

$progress = array_shift($progress);

if($progress->progress!='Completed')
{
	redirect_to('application_form.php');
}

$student_status = $user->get_student_status();

$database = new MySQLDatabase();

?>
<?php
            
            $personal_details = $database->query("SELECT * FROM personal_details p, title t, lga l, state s, religion r, nationality n, department d, faculty f, next_of_kin next, marital mar, photographs photo WHERE p.applicant_id='".$session->applicant_id."' AND p.title_id=t.title_id AND p.lga_id=l.lga_id AND l.state_id=s.state_id AND p.religion_id=r.religion_id AND p.country_id=n.country_id AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id AND p.applicant_id=next.applicant_id AND p.applicant_id=photo.applicant_id AND p.marital_status=mar.marital_status_id");
            
            $personal_details = $database->fetch_array($personal_details);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria - <?php echo $personal_details['faculty_name']; ?> Complete Application Form</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
<style type="text/css">
	@media print{
		.noprint{display:none}
	}
</style>
</head>
<body>
<?php include_layout_template("header.php"); ?> 
<div class="noprint">
<?php include_layout_template("confirmation_menu.php"); ?> 
</div>
<?php 
	$admissions = new Admission();
	
	$sql = "select * from admission_status where applicant_id='".$session->applicant_id."'";
	$admissions = Admission::find_by_sql($sql);
	
	foreach($admissions as $admission):
	$time = $admission->time_completed_application;
	$academic_session = $admission->academic_session;
	$status = $admission->status;
	$reason_ = $admission->reason;
	endforeach;

	$reason = new Reason();
	
	$sql = "select * from reasons_inelligibility where reason='".$reason_."'";
	$reason = Reason::find_by_sql($sql);
	$reason = array_shift($reason);
	
	//convert the $time to a format that can be read
	$when_application_completed = date('l d \of F Y \@ \A\b\o\u\t g:i:s:A', $time);
	
	if($status == 0){
		$msg = '<span class="label label-inverse">You have not completed your application form yet</span>';
	}elseif($status == 1){
		$msg = '<span class="label ">Pending</span>';
	}elseif($status == 2){
		$msg = '<span class="label label-info">Processing...</span>';
	}elseif($status == 3){
		$msg = '<span class="label label-warning">Processing...</span>';
	}elseif($status == 4){
		$msg = '<span class="label label-important">Not Offered Admission</span>';	
	}elseif($status == 5){
		$msg = '<span class="label label-success">Offered Admission</span>';
	}
?>

<!--The Main Content Here Please-->
<div class="container create">
	<div class="alert alert-info">
    <h4 style="text-align:center">Complete Application Form (<?php echo $personal_details['faculty_name']; ?>) - <?php echo $academic_session; ?></h4>
     <h5 style="text-align:center">( The Application was Completed And Submitted On <?php echo $when_application_completed; ?> )</h5> </div>
     <div><h5 style="text-align:center">Admission Status: <?php echo $msg; ?></h5></div>
   	<?php
		if($status == 4 && $reason->reason != ''){
			echo '<h5 style="text-align:center">Reason: '.$reason->reason.'</h5>';
			echo '<p style="text-align:center">'.$reason->description.'</p>';
		}
	?>
    
    <div class="row-fluid">
        <div class="span12">
        

        
        	<!-- Personal Details -->
            <h4 align="center" class="alert alert-success">Personal Details</h4>
			<table class="table table-bordered">
			  	<tbody>
                	<tr>
                    	<td style="width:20%">Application Number: </td>
                    	<td><?php echo $personal_details['form_id']; ?></td>
                        
                        <td rowspan="8" colspan="2">
                        	<div style="width:200px; height:260px; overflow:hidden; margin:auto; border:1px solid #ccc; padding:2px;">
                            	<img src="<?php echo 'passport/'.$personal_details['filename']; ?>" alt="<?php echo $personal_details['caption']; ?>" title="<?php echo $personal_details['caption']; ?>" width="200" />
                            </div>
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
				$thesis_details = Thesis::find_by_id($session->applicant_id);
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
			        $employments = Employment::find_by_id($session->applicant_id);
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
				$tertiary_institution = HigherInstitutions::find_by_sql("SELECT * FROM higher_institutions WHERE applicant_id='".$session->applicant_id."'");
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
$o_level_data = $database->query("SELECT * FROM o_level_details olevel, exam_id ex WHERE olevel.applicant_id='".$session->applicant_id."' AND olevel.exam_type_id=ex.exam_type_id");
					
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
					
					$awards = User::find_by_id($session->applicant_id);
					
					
					
					
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
	            	$sql_qualification = "SELECT * FROM other_relevant_qualifications WHERE applicant_id=" . $session->applicant_id;
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
        $academic_publication = Publication::find_by_sql("SELECT * FROM academic_publications WHERE applicant_id='".$session->applicant_id."'");
		
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
        $other_publication = OtherPublication::find_by_sql("SELECT * FROM otherpublications WHERE applicant_id='".$session->applicant_id."'");
		
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
        $referees = Referees::find_by_sql("SELECT * FROM referees WHERE applicant_id='".$session->applicant_id."'");
		
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
						case '1': $formstatus = 'Responded'; break;
						case '0': $formstatus = 'No Response'; break;
					}
					echo '
					<tr>
						<td width="4%">'.$index.'</td>
						<td width="30%">'.$ref->referee_name.'</td>
						<td width="20%">'.$ref->referee_email.'</td>
						<td width="10%">'.$ref->referee_phone_number.'</td>
						<td width="10%">'.$formstatus.'</td>
					</tr>';
					$index++;
				}
				echo '</tbody>

            </table>';
		}
	?>
    <?php }else{?>
	
	
	<h4 align="center" class="alert alert-success">Fees</h4>
	  <?php
      
          $default = "No Information Supplied";
		  $other_programme = "SELECT * FROM  other_programme_details WHERE applicant_id='".$session->applicant_id."'";
          $other_programme_details = OtherProgramme::find_by_sql($other_programme);
		  foreach($other_programme_details as $other_programme_detail):
		  $other_programme_detail->sponsor_occupation;
		  $other_programme_detail->sponsor_address;
		  endforeach;
?>

<table class="table table-bordered table-hover">
  <tbody>
      <tr>
          <td width="2%">Name of person or body who will be responsible for your fees: 
     <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"><?php echo $other_programme_detail->sponsor_fullname; ?></span>
     Address: <span style=" font-weight: bold; text-shadow: 1px 1px 4px #51A351;"><?php echo $other_programme_detail->sponsor_address; ?></span><br>
     If you are offered admission by the University, you will be required to pay your fees fully in advance of commencement of lectures.
     </td></tr>
 </tbody>
 </table>


<?php } ?>







<?php if($personal_details['student_status'] == 'PGA'){ ?>
<h4 align="center" class="alert alert-success">Declaration</h4>
<table class="table table-bordered table-hover">
            <tbody>
            	<tr>
            		<td width="2%"><input type="checkbox" name="" value="" checked disabled></td>
                    <td width="35%">I hereby declare that all the information I supplied in this application is, to the best of my knowledge and belief, accurate in every detail misrepresentation may result in the denial or cancellation of admission.
</td>
                   
                    
				</tr>
           <tr><td></td><td>
           
           <p>You should request your past Institution(s) to forward an offical copy of your academic transcripts directly to:</p>
           
           <address>
           <strong> 
          	The Secretary<br>
            School of Postgraduate Studies<br> 
			University of Jos,<br> 
            PMB 2084, Jos. <br>
			Plateau State, Nigeria</strong><br>
            </address>
            <adress><span class="label label-important">If You didn't upload throught the upload files tab.</span></address>
           <address>
           If you have any enquiries or problems with the registration you can send an email to <br>
		   <strong>Email:</strong> <a href="mailto:#">pgsupport[at]unijos.edu.ng</a>
			</address><br>
            
            <p>You should also rember to BOLDY and CLEARLY indicate your Application Number on the TOP LEFT CORNER of the parcel or envelop containing your transcripts.</p>
           </td></tr>
           
           <tr>
<td></td>
<td>

<div class="control-group noprint">
    <label class="control-label" ></label>
    <div class="controls">
    
      <button type="submit" class="btn printbtn">Print <i class="icon-print"></i></button>
      <a href="logout.php?logoff"><button type="submit" class="btn">Close <i class="icon-off"></i></button></a>
    </div>
  </div> </td></tr> 
            
			   
				</tbody>
	         </table>

<?php }else{ ?>
 
<h4 align="center" class="alert alert-success">Declaration</h4>
<table class="table table-bordered table-hover">
            <tbody>
            	<tr>
            		<td width="2%"><input type="checkbox" name="" value="" checked disabled></td>
                    <td width="35%"><p>I here declare that I wish to enroll for the Non-NUC Funded Programme, University of Jos, that the particulars given in this form are to the best of my knowledge and belief, correct, and that if admitted by the Programme, I shall regard myself bound by the Act, Statutes and Regulations of the University in-so- far as they affect me. I understand that withholding any information requested, giving false information about my qualification will make me ineligible for admission and enrollment (matriculation). I also understand that the Non-NUC Funded Programme, University of Jos reserves the right to withdraw admission made in error and to cancel my admission or enrollment if it is subsequently discovered that I have given false information or withheld information to aid my admission.</p>
<p>The decision of the Non-NUC Funded Programme, University of Jos on all matters pertaining to the application is final and no communications will be entertained from any candidate whose application is unsuccessful.</p></td>
                   
                    
				</tr>
<tr>
<td></td>
<td>

<div class="control-group noprint">
    <label class="control-label" ></label>
    <div class="controls">
    
      <button type="submit" class="btn printbtn">Print <i class="icon-print"></i></button>
      <a href="logout.php?logoff"><button type="submit" class="btn">Close <i class="icon-off"></i></button></a>
    </div>
  </div> </td></tr> 
</tbody>
	       </table>
	
	
<?php } ?>
            
            </div>
            
        </div>
    </div>
    
</div>
<!-- beginnning of main content-->

<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	jQuery('.printbtn').click(function(){
		window.print();
	});
});
</script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>