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
<!-- beginnning of main content-->
<div class="container create">
    <div class="row-fluid">
        <div class="span12">
    <?php 
	$admissions = new Admission();
	
	$sql = "select * from admission_status where applicant_id='".$session->applicant_id."'";
	$admissions = Admission::find_by_sql($sql);
	
	foreach($admissions as $admission):
	$time = $admission->time_completed_application;
	$academic_session = $admission->academic_session;
	$status = $admission->status;
	$reason = $admission->reason;
	endforeach;
	
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

        
        	<!-- Personal Details -->
            <h4 align="center" class="alert alert-success">Personal Details</h4>
			<table class="table table-bordered">
			  	<tbody>
                	<tr>
                    	<td style="width:20%">Application Number: </td>
                    	<td><?php echo $personal_details['form_id']; ?></td>
                        
                        <td rowspan="8" colspan="2">
                        	<div style="width:200px; height:260px; overflow:hidden; margin:auto; border:1px solid #ccc; padding:2px;">
                            	<img src="<?php echo 'passport/'.$personal_details['filename']; ?>" alt="<?php echo $personal_details['caption']; ?>" title="<?php echo $personal_details['caption']; ?>" width="200" /></div>
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
            
       </div>
    </div>
   </div>

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