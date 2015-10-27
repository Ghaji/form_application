<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}
$role = $_SESSION['role'];
switch ($role) {
	case 1:
		break;

	case 2:
		break;
	case 3:
		break;
	case 7:
		break;

	case 9:
		break;
	
	default:
		redirect_to('home.php');
		break;
}
$db = new MySQLDatabase();
if($role == 4){
	$sql = "SELECT `department_name` from `department` WHERE `department_id` = '".$_SESSION["department_id"]."'";
	$dept =  $db->Query($sql);
	$dept = $db->fetch_array($dept);
	$dept = array_shift($dept);
}
$applicant_sql = "SELECT count(*) FROM `personal_details` WHERE `progress`='Completed'";
$total_applicant = $db->query($applicant_sql);
$total_applicant = $db->fetch_array($total_applicant);
$total_applicant = array_shift($total_applicant);

function pd_get_total($column, $value){
	global $db;
	$query = "SELECT count(*) FROM `personal_details` WHERE `progress`='Completed' AND `".$column."`='".$value."'";
	$total = $db->query($query);
	$total = $db->fetch_array($total);
	$total = array_shift($total);
	return $total;	
}

function get_total($value){
	global $db;
	$query = "SELECT count(*) FROM `admission_status` WHERE `status`=".$value;
	$total = $db->query($query);
	$total = $db->fetch_array($total);
	$total = array_shift($total);
	return $total;	
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
        
        <style type="text/css">
			.pagination{
				display:none;
			}
		</style>
        
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

			<div class="span9">
				<h2>Non-Functional Degree Application Summary</h2>
				<hr>
				
                <?php
					if($role == 1 || $role == 2 || $role == 3){
						echo '<div class="span5">'; 
						if($total_applicant > 0){
							echo '<h4 align="center">Gender <span class="badge badge-success">'.$total_applicant.'</span></h4>';
						}else{
							echo '<h4 align="center">Gender <span class="badge badge-Important">'.$total_applicant.'</span></h4>';
						}
						
						$male_applicant = pd_get_total('gender','M');
						$female_applicant = pd_get_total('gender','F');
				?>
						   <table class="table table-bordered table-hover">
						   <thead>
								<tr>
									<th>Gender</th>
									<th width="10%">Total</th>
								</tr>
							</thead>
							<tbody>
                            	<tr>
									<td>Male</td>
									<td width="10%"><?php if(isset($male_applicant)) echo $male_applicant; ?></td>
								</tr>
                                <tr>
									<td>Female</td>
									<td width="10%"><?php if(isset($female_applicant)) echo $female_applicant; ?></td>
								</tr>
							</tbody>
							</table>
                          <?php
						 echo '</div>';
						 /*End of Gender Summary*/
						 /*Post-Graduate Summary*/
						if($role == 1 || $role == 2){
						echo '<div class="span5">'; 
						$total_applicant = pd_get_total('student_status','PGA');
						if($total_applicant > 0){
							echo '<h4 align="center">Post-Graduate Programes <span class="badge badge-success">'.$total_applicant.'</span></h4>';
						}else{
							echo '<h4 align="center">Post-Graduate Programes <span class="badge badge-Important">'.$total_applicant.'</span></h4>';
						}
				?>
						   
                            <?php
								$query = "SELECT department_id, department_name FROM `department` WHERE faculty_id=12";
								$result = $db->query($query);
								$counter = 0;
								$max = 5;
								$pagecounter = 1;
								$serialno = 1;
								echo '<div id="myCarousel" class="carousel slide">
							  <!-- Carousel items -->
							  <div class="carousel-inner">';
								while($row = $db->fetch_array($result)){
									$total_applicants = pd_get_total('programme_applied_id', $row['department_id']);
									if($total_applicants != 0){
										$counter += $total_applicants;
										if($serialno % $max == 1){
											if($pagecounter == 1){
												echo '<div class="active item">';
											} else {
												echo '<div class="item">';
											}
											echo '<table class="table table-bordered table-hover">
										   <thead>
												<tr>
													<th width="10%">S/N</th>
													<th>Course</th>
													<th width="10%">Total</th>
												</tr>
											</thead>
											<tbody>';
										}
										echo'<tr>
										<td width="10%">'.$serialno.'</td>
										<td>'.$row['department_name'].'</td>
										<td width="10%">'.$total_applicants.'</td>
										</tr>';
										
										if($serialno % $max == 0){
											echo '</tbody>';
											echo '</table>';
												
											echo '</div>';
											$pagecounter++;
										}elseif($counter == $total_applicant){
											echo '</tbody>';
											echo '</table>';
											
											echo '</div>';
										}
										$serialno++;							
									}
								}
								echo '</div>';
	                          if(($serialno-1) > $max){
								echo'<!-- Carousel nav -->
							  <a class="pull-left left btn" href="#myCarousel" data-slide="prev">&lsaquo;</a>
							  <a class="pull-right right btn" href="#myCarousel" data-slide="next">&rsaquo;</a>';
									}
							echo '</div>';
							echo '</div>';
						} // end of if for Postgraduate
							?>
                          <?php
						 /*End of Post-Graduate Summary*/

						echo '<div class="span5">';
						if($total_applicant > 0){
							echo '<h4 align="center">Admission Status <span class="badge badge-success">'.$total_applicant.'</span></h4>';
						}else{
							echo '<h4 align="center">Admission Status <span class="badge badge-Important">'.$total_applicant.'</span></h4>';
						}
						
						$Pending_applicants = get_total(1);
						$ineligible_applicants = get_total(2);
						$Eligible_applicants = get_total(3);
						$rejected_applicants = get_total(4);
						$accepted_applicants = get_total(5);
				?>
						   <table class="table table-bordered table-hover">
						   <thead>
								<tr>
									<th>Status</th>
									<th width="10%">Total</th>
								</tr>
							</thead>
							<tbody>
                            	<tr>
									<td>Pending</td>
									<td width="10%"><?php if(isset($Pending_applicants)) echo $Pending_applicants; ?></td>
								</tr>
                                <tr>
									<td>Inenligible</td>
									<td width="10%"><?php if(isset($ineligible_applicants)) echo $ineligible_applicants; ?></td>
								</tr>
                                <tr>
									<td>Enligible</td>
									<td width="10%"><?php if(isset($Eligible_applicants)) echo $Eligible_applicants; ?></td>
								</tr>
                                <tr>
									<td>Not Offered Admission</td>
									<td width="10%"><?php if(isset($rejected_applicants)) echo $rejected_applicants; ?></td>
								</tr>
                                <tr>
									<td>Offered Admission</td>
									<td width="10%"><?php if(isset($accepted_applicants)) echo $accepted_applicants; ?></td>
								</tr>
							</tbody>
							</table>
                          <?php
                          echo '</div>';
						  /*End of Admission Status Summary*/
						  
						 /*Diploma Summary*/
						 echo '<div class="span5">'; 
						$total_applicant_dip = pd_get_total('student_status','DPA');
						if($total_applicant_dip > 0){
							echo '<h4 align="center">Diploma Programes <span class="badge badge-success">'.$total_applicant_dip.'</span></h4>';
						}else{
							echo '<h4 align="center">Diploma Programes <span class="badge badge-Important">'.$total_applicant_dip.'</span></h4>';
						}
				?>
						   
                            <?php
								$query = "SELECT department_id, department_name FROM `department` WHERE faculty_id=16";
								$result = $db->query($query);
								$counter_dip = 0;
								$max_dip = 5;
								$pagecounter_dip = 1;
								$serialno_dip = 1;
								echo '<div id="myCarousel2" class="carousel slide">
								  <!-- Carousel items -->
								  <div class="carousel-inner">';
								while($row = $db->fetch_array($result)){
									$total_applicants_dip = pd_get_total('programme_applied_id', $row['department_id']);
									if($total_applicants_dip != 0){
										$counter_dip += $total_applicants_dip;
										if($serialno_dip % $max_dip == 1){
											if($pagecounter_dip == 1){
												echo '<div class="active item">';
											} else {
												echo '<div class="item">';
											}
											echo '<table class="table table-bordered table-hover">
										   <thead>
												<tr>
													<th width="10%">S/N</th>
													<th>Course</th>
													<th width="10%">Total</th>
												</tr>
											</thead>
											<tbody>';
										}
										echo'<tr>
										<td width="10%">'.$serialno_dip.'</td>
										<td>'.$row['department_name'].'</td>
										<td width="10%">'.$total_applicants_dip.'</td>
										</tr>';
										
										if($serialno_dip % $max_dip == 0){
											echo '</tbody>';
											echo '</table>';
												
											echo '</div>';
											$pagecounter_dip++;
										}elseif($counter_dip == $total_applicant_dip){
											echo '</tbody>';
											echo '</table>';
											
											
											echo '</div>';
										}
										$serialno_dip++;
									}
								}
							?>
							</tbody>
							</table>
                          <?php
                          echo '</div>';
                          if(($serialno_dip-1) > $max_dip){
							echo'<!-- Carousel nav -->
						  <a class="pull-left left btn" href="#myCarousel2" data-slide="prev">&lsaquo;</a>
						  <a class="pull-right right btn" href="#myCarousel2" data-slide="next">&rsaquo;</a>';
								}
						echo '</div>';
						echo '</div>';
						  
					     /*End of Diploma Summary*/
						 /*Remedial Summary*/
						echo '<div class="span5">'; 
						$total_applicant = pd_get_total('student_status','RP');
						if($total_applicant > 0){
							echo '<h4 align="center">Remedial Programes <span class="badge badge-success">'.$total_applicant.'</span></h4>';
						}else{
							echo '<h4 align="center">Remedial Programes <span class="badge badge-Important">'.$total_applicant.'</span></h4>';
						}
				?>
						   <table class="table table-bordered table-hover">
						   <thead>
								<tr>
									<th width="10%">S/N</th>
									<th>Course</th>
									<th width="10%">Total</th>
								</tr>
							</thead>
							<tbody>
                            <?php
								$query = "SELECT department_id, department_name FROM `department` WHERE faculty_id=17";
								$result = $db->query($query);
								$counter = 1;
								while($row = $db->fetch_array($result)){
									echo'<tr>
									<td width="10%">'.$counter.'</td>
									<td>'.$row['department_name'].'</td>
									<td width="10%">'.pd_get_total('programme_applied_id', $row['department_id']).'</td>
									</tr>';
									$counter++;
								}
							?>
							</tbody>
							</table>
                          <?php
                          echo '</div>';
						 /*End of Remedial Summary*/
						 
					}
					
				?>
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
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>