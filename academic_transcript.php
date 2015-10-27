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

$registra = new Registra();
$registra = $registra->find_by_sql("SELECT * FROM registras WHERE cat=2 AND visible=1");
$registra = array_shift($registra);

$admissions = new Admission();
	
$sql = "select * from admission_status where applicant_id='".$session->applicant_id."'";
$admissions = Admission::find_by_sql($sql);

foreach($admissions as $admission):
	$time = $admission->time_completed_application;
	$academic_session = $admission->academic_session;
	$status = $admission->status;
endforeach;

if($status < 5) {
	redirect_to('confirmation.php');
}

$student_status = $user->get_student_status();

$database = new MySQLDatabase();

?>

<?PHP
$higher_institutions= new HigherInstitutions();
$query = "SELECT * FROM higher_institutions
          WHERE applicant_id='".$session->applicant_id."'";



$myschool = $higher_institutions->find_by_sql($query);

$myschool = array_shift($myschool);

?>



<?php
            
            $personal_details = $database->query("SELECT * FROM personal_details p, title t, lga l, state s, religion r, nationality n, department d, faculty f, next_of_kin next, marital mar, photographs photo WHERE p.applicant_id='".$session->applicant_id."' AND p.title_id=t.title_id AND p.lga_id=l.lga_id AND l.state_id=s.state_id AND p.religion_id=r.religion_id AND p.country_id=n.country_id AND p.programme_applied_id=d.department_id AND d.faculty_id=f.faculty_id AND p.applicant_id=next.applicant_id AND p.applicant_id=photo.applicant_id AND p.marital_status=mar.marital_status_id");
            
            $personal_details = $database->fetch_array($personal_details);

            $admission = $database->query("SELECT * FROM `admission_letter_date` WHERE visible = 1");

            $admission = $database->fetch_array($admission);
            // $programme = $database->query("SELECT * FROM `department` WHERE `department_id` = ");
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
	.print {
		font-size: 12px;
	}

	.date{display:none;}

	@media print{
		.noprint{display:none}

		/*.date{display:block;}*/

		.visible-print {
		    display: block !important;
		}

		.imgg{
			margin-top:-630px;
			margin-left: 200px; 
			opacity:0.2; 
			width:200px; 
			/*display:inline-block !important;*/
		}

		.imgg-2{
			margin-top:-1210px;
			margin-left: 200px; 
			opacity:0.2; 
			width:200px; 
			/*display:inline-block !important;*/
		}
		
	}

	.imgg, .imgg-2{display:none;}
</style>
</head>
<body>

<div class="noprint">
<?php include_layout_template("header.php"); ?> 
<?php include_layout_template("confirmation_menu.php"); ?> 
</div>
<?php 
	//convert the $time to a format that can be read
	$when_application_completed = date('l d \of F Y \@ \A\b\o\u\t g:i:s:A', $time);
?>

<!--The Main Content Here Please-->
<div class="container-semifluid" >

	<div class="alert alert-info">
    	<h4 style="text-align:center; font-size: 22px;">UNIVERSITY OF JOS, JOS - NIGERIA</h4>
    </div>

    <div class="noprint">
    	<h5 style="text-align:center"><?= $academic_session; ?> POST GRADUATE ONLINE APPLICATION</h5>
    </div>
    
   	<!--Transcript form Template-->
   	<div class="print">
  
  		<!-- Page 1 -->
  		<table width="100%">
   			<tbody>
   				<tr>
   					<td width="25%"></td>
   					<td align="center">
   						
   						<!-- <h5 style="color: #428bca; font-size: 14px;">UNIVERSITY OF JOS, JOS, NIGERIA.</h5> -->
   					</td>
   					<td width="25%"></td>
   				</tr>
   				<tr>
   					<td>
   						<span style="color: #428bca;"><strong> The Registrar,</strong></span><br>
   						<strong style="color: #428bca;"><?php echo $myschool->institution_name;?></strong><br>
						Dear Sir/Madam,
   					</td>
   					<td align="center">
   						<div>
				   			<img style="height:110px;" src="/mis.unijos.edu.ng/app_form_template/images/logo.png">
				   		</div>
   					</td>
   					<td>
   						<span class="pull-right" style="color: #428bca;">
   							<?= $personal_details['form_id']; ?><br>
   							<strong>Date:</strong> <?= date('d F, Y', strtotime($admission['admission_date'])); ?>
   						</span>
   					</td>
   				</tr>
   				

   				<tr>
   					<td width="25%"></td>
   					<td align="center">
   						<h4 style="color: #428bca; font-size: 14px;"><strong>SCHOOL OF POSTGRADUATE STUDIES</strong></h4>
   						<h4 style="color: #428bca; font-size: 11px;">REQUEST FOR ACADEMIC TRANSCRIPT</h4>
   							<hr>
   					</td>
   					<td width="25%"></td>
   				</tr>
   			</tbody>
   		</table>

   		<!-- Begining of content positioning -->
   	<div class="row-fluid">
         
		
		<p><strong class="text-success"> <?=$personal_details['title_name'] . " " . $user->applicant_fullname($user->applicant_id); ?></strong> 
		who graduate from  your institution has applied to University of Jos  for a Full/Part-Time 
		course of study leading to <strong class="text-info"><?= $personal_details['department_name']; ?>, </strong> below is the 
		applicant details.</p>
		
		<div class="row-fluid">

		<div class="span12">
		<table class="table table-bordered">
			<tr>
				<td>
					<ul>
						<li><strong>REGISTRATION NO:</strong>  </li>
						<li><strong>PROGRAMME:</strong> </li>
						<li><strong>QUALIFICATION:</strong> </li>
						<li><strong>Class:</strong> </li>
						<li><strong>YEAR GRADUATED:</strong> </li>
						<li><strong>C.G.P.A:</strong> </li>
					</ul>
				</td>
				<td>
					<ul>
						<li> <?php echo $myschool->registration_no;?> </li>
						<li> <?php echo $myschool->course_of_study;?></li>
						<li> <?php echo $myschool->degree_earned;?></li>
						<li> <?php echo $myschool->class_of_degree;?></li>
						<li> <?php echo $myschool->graduation_year;?></li>
						<li> <?php echo $myschool->cgpa;?></li>
					</ul>
				</td>
			</tr>
		</table>
			

		</div>
		 </div>


		<p>Kindly process and send his/her academic transcript to the address below for our consideration:</p>
		   <div class="row-fluid">
		   	<div class="span6">

		   		    <address>
				    <strong>The Secretary,<br>
				    School of Postgraduate Studies,<br>
				    University of Jos,<br>
				    P.M.B. 2084, Jos, Plateau State, Nigeria.</strong><br>
				    </address>
				     
				    <address>
				    Thank you<br>

				    Your Sincerely,<br><br>
				    
				    <?= $registra->full_name; ?><br>
				    For Dean, School of Postgraduate Studies,<br>
				    University of Jos.
				    
				    </address>
		   		
		   	</div>
		   </div>
<table>
			<tr>
				
				<td width="25%">
					<span class="visible-print hide text-info" style="font-size: 10px;">
						Date Printed: <?= date('d F Y'); ?>
					</span>
				</td>
			</tr>
		</table>
		<!-- /page 1 -->
		
   
   	</div>
   	<!--End Transcript form Template-->

   	<div class="row">
   		<div class="span2 offset6">
		   	<div class="control-group noprint">
			    <label class="control-label" ></label>
			    <div class="controls">    
			      <button type="submit" class="btn printbtn">Print <i class="icon-print"></i></button>
			    </div>
			</div>
		</div>
   	</div>
  	<div >
		<img src="/mis.unijos.edu.ng/app_form_template/images/logo.png" class="imgg visible-print">
		<img src="/mis.unijos.edu.ng/app_form_template/images/logo.png" class="imgg-2 visible-print">
	</div>
</div>
<!-- beginnning of main content-->

<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
</div> 

</div>
</div>

<!-- Footer for the page -->
<div class="noprint">

<?php include_layout_template("footer.php"); ?>

</div>

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