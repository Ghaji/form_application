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
$registra = $registra->find_by_sql("SELECT * FROM registras WHERE visible=1");
$registra = array_shift($registra);

$admissions = new Admission();
	
$sql = "SELECT * FROM admission_status WHERE applicant_id='".$session->applicant_id."'";
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
<div class="container">
	<div class="alert alert-info noprint">
    	<h4 style="text-align:center">PLEASE NOTE: OUTPUT BEST WITH COLOUR PRINTER</h4>
    </div>
    <div class="noprint">
    	<h5 style="text-align:center">Admission Letter</h5>
    </div>
    <?php if ($student_status == 'PGA') { ?>
   	<!--Admission letter Template-->
   	<div class="print">
   	<?php
    	if($student_status == 'PGA') {
    		
    		$min_duration = 12;
    		$max_duration = 24;
    		$expression = "/(M\.Phil)/i";
    		$expression_2 = "/(Ph\.d)/i";
    		$expression_3 = "/(PGD)/i";
    		$expression_4 = "/(Postgraduate diploma)/i";
    		$expression_5 = "/(Post Graduate Diploma)/i";
			if (preg_match($expression, $personal_details['department_name']) || preg_match($expression_2, $personal_details['department_name'])) {
			    $min_duration = 36;
    			$max_duration = 60;
			} elseif (preg_match($expression_3, $personal_details['department_name']) || 
					preg_match($expression_4, $personal_details['department_name']) ||
					preg_match($expression_5, $personal_details['department_name'])) {
				$min_duration = 18;
    			$max_duration = 24;
			}
  	?>
  		<!-- Page 1 -->
  		<table width="100%">
   			<tbody>
   				<tr>
   					<td width="25%"></td>
   					<td align="center">
   						<h4 style="color: #428bca; font-size: 14px;">SCHOOL OF POSTGRADUATE STUDIES</h4>
   						<h5 style="color: #428bca; font-size: 14px;">UNIVERSITY OF JOS, JOS, NIGERIA.</h5>
   					</td>
   					<td width="25%"></td>
   				</tr>
   				<tr>
   					<td>
   						<span style="color: #428bca;">REF. NO: <strong>PGA/UJ/130</strong></span><br>
   						<strong style="color: #428bca;"><?= $user->applicant_fullname($user->applicant_id); ?></strong><br>
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
   					<td colspan="2">
   						<h5 style="color: #428bca; font-size: 12px;">PROVISIONAL ADMISSION</h5>
   					</td>
   					<td></td>
   				</tr>
   			</tbody>
   		</table>
		
		<p>
			I am pleased to inform you that on the recommendation of the Board, School of Postgraduate Studies and the approval of the University Senate, you have been offered a provisional admission to pursue Full/Part-Time course of study leading to <strong><?= $personal_details['department_name']; ?></strong> of the University of Jos. The programme will run for a minimum period of <strong><?= $min_duration; ?> months</strong> and maximum period of <strong><?= $max_duration; ?> months</strong>. It will commence immediately. You are expected to register for your course not later than two weeks from the date of commencement of the <strong><?= $academic_session; ?></strong> session/programme. Failure to do so may result in your not participating in the course.
		</p>
		<p>Furthermore this admission is subject to the following conditions:-</p>
		<ol>
			<li><strong>That your former University/College has sent us your entire transcript:</strong></li>
			<li><strong>That your referees have completed and sent to us their letters of references:</strong></li>
			<li><strong>That you have sent us the photocopies of your certificates including the NYSC Discharge Certificate.</strong></li>
		</ol>

		<p>
			Enclosed herewith, is an acceptance from to be carefully studied, completed and returned to <strong>&quot;The Secretary, School of Postgraduate Studies, University of Jos, P.M.B. 2084, Jos, Plateau State, Nigeria&quot;</strong> to reach us <strong>immediately</strong>.
		</p>

		<p>
			Also the following items are forwarded for your study and necessary action:
		</p>

		<ul>
			<li><strong>A copy of the financial regulation for Postgraduate Studies</strong></li>
			<li><strong>A copy of Student&apos;s Medical Examination Form</strong></li>
			<li><strong>Guarantor&apos;s Form</strong></li>
		</ul>

		<p>
			The forms should be completed and returned to the Secretary along with your acceptance form. In addition to your accepting this offer, I should inform you that the following documents are required during the Registration exercise:
		</p>

		<ul>
			<li>Completed Registration Forms:</li>
			<li>Original Birth Certificate/Statutory Declaration of Age</li>
			<li>Original Certificates/evidence of qualifications claimed</li>
			<li>Completed Student&apos;s Medical Examination Form</li>
			<li>Receipts of Acceptance of Offer</li>
		</ul>

		<p>
			All correspondence should be addressed to the <strong>Secretary, School of Postgraduate Studies, University of Jos, Jos, Nigeria.</strong>
		</p>

		<p>
			We look forward to your arrival and a successful period of study.
		</p>

		<p>
			Please note that the University does not provide Hostel Accommodation for Postgraduate Students. Also note this offer cannot be deferred to another session.
		</p>

		<table>
			<tr>
				<td width="25%">
					Yours sincerely,
				</td>
				<td>
				</td>
				<td width="25%">
					<span class="visible-print hide text-info" style="font-size: 10px;">
						Date Printed: <?= date('d F Y'); ?>
					</span>
				</td>
			</tr>
		</table>

		<p align="center" style="line-height: 17px;">
			<?= $registra->full_name; ?><br>
			Deputy Registrar/Secretary<br>
			School of Postgraduate Studies.
		</p>
		<!-- /page 1 -->
		<!-- Page 2 -->
		<div class="visible-print hide">
  		<table width="100%">
   			<tbody>
   				<tr>
   					<td width="25%"></td>
   					<td align="center">
   						<h4 style="color: #428bca; font-size: 14px;">SCHOOL OF POSTGRADUATE STUDIES</h4>
   						<h5 style="color: #428bca; font-size: 14px;">UNIVERSITY OF JOS, JOS, NIGERIA.</h5>
   					</td>
   					<td width="25%">
   						
   					</td>
   				</tr>
   				<tr>
   					<td width="25%">
   						<span style="color: #428bca;">REF. NO: <strong>PGA/UJ/130</strong></span><br>
   						<strong style="color: #428bca;"><?= $user->applicant_fullname($user->applicant_id); ?></strong><br>
						Dear Sir/Madam,
						<h5 style="color: #428bca; font-size: 12px;">PROVISIONAL ADMISSION</h5>
   					</td>
   					<td align="center">
   						<div>
				   			<img style="height:110px;" src="/mis.unijos.edu.ng/app_form_template/images/logo.png">
				   		</div>
   					</td>
   					<td>
   						<div class="pull-right">
				   			<div style="height:120px; overflow:hidden; margin:auto; border:1px solid #ccc;">
                            	<img src="<?php echo 'passport/'.$personal_details['filename']; ?>" alt="<?php echo $personal_details['caption']; ?>" title="<?php echo $personal_details['caption']; ?>" width="200" />
                            </div>
				   		
					   		<span style="color: #428bca;">
	   							<?= $personal_details['form_id']; ?><br>
	   							<strong>Date:</strong> <?= date('d F, Y', strtotime($admission['admission_date'])); ?>
	   						</span>
   						</div>
   					</td>
   				</tr>
   			</tbody>
   		</table>
		
		<p>
			I am pleased to inform you that on the recommendation of the Board, School of Postgraduate Studies and the approval of the University Senate, you have been offered a provisional admission to pursue Full/Part-Time course of study leading to <strong><?= $personal_details['department_name']; ?></strong> of the University of Jos. The programme will run for a minimum period of <strong>12 months</strong> and maximum period of <strong>24 months</strong>. It will commence immediately. You are expected to register for your course not later than two weeks from the date of commencement of the <strong><?= $academic_session; ?></strong> session/programme. Failure to do so may result in your not participating in the course.
		</p>
		<p>Furthermore this admission is subject to the following conditions:-</p>
		<ol>
			<li><strong>That your former University/College has sent us your entire transcript:</strong></li>
			<li><strong>That your referees have completed and sent to us their letters of references:</strong></li>
			<li><strong>That you have sent us the photocopies of your certificates including the NYSC Discharge Certificate.</strong></li>
		</ol>

		<p>
			Enclosed herewith, is an acceptance from to be carefully studied, completed and returned to <strong>&quot;The Secretary, School of Postgraduate Studies, University of Jos, P.M.B. 2084, Jos, Plateau State, Nigeria&quot;</strong> to reach us <strong>immediately</strong>.
		</p>

		<p>
			Also the following items are forwarded for your study and necessary action:
		</p>

		<ul>
			<li><strong>A copy of the financial regulation for Postgraduate Studies</strong></li>
			<li><strong>A copy of Student&apos;s Medical Examination Form</strong></li>
			<li><strong>Guarantor&apos;s Form</strong></li>
		</ul>

		<p>
			The forms should be completed and returned to the Secretary along with your acceptance form. In addition to your accepting this offer, I should inform you that the following documents are required during the Registration exercise:
		</p>

		<ul>
			<li>Completed Registration Forms:</li>
			<li>Original Birth Certificate/Statutory Declaration of Age</li>
			<li>Original Certificates/evidence of qualifications claimed</li>
			<li>Completed Student&apos;s Medical Examination Form</li>
			<li>Receipts of Acceptance of Offer</li>
		</ul>

		<p>
			All correspondence should be addressed to the <strong>Secretary, School of Postgraduate Studies, University of Jos, Jos, Nigeria.</strong>
		</p>

		<p>
			We look forward to your arrival and a successful period of study.
		</p>

		<p>
			Please note that the University does not provide Hostel Accommodation for Postgraduate Students. Also note this offer cannot be deferred to another session.
		</p>

		<table style="padding: 0;">
			<tr>
				<td width="25%">
					Yours sincerely,
				</td>
				<td>
				</td>
				<td width="25%">
					<span class="text-info" style="font-size: 10px;">
						Date Printed: <?= date('d F Y'); ?>
					</span>
				</td>
			</tr>
		</table>

		<p align="center" style="line-height: 17px; padding: 0;">
			<?= $registra->full_name; ?><br>
			Deputy Registrar/Secretary<br>
			School of Postgraduate Studies.
		</p>

		</div>
		<!-- /page 2 -->
   	<?php
   		}
   	?>
   	</div>

   	<?php }else{ ?>

   	Non NUC Programmes....


   	<?php } ?>
   	<!--Admission letter Template-->

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