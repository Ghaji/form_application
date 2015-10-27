<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
}
$role = $_SESSION["role"];

if($role == 4){
	$db = new MySQLDatabase();
	$sql = "SELECT `department_name` from `department` WHERE `department_id` = '".$_SESSION["department_id"]."'";
	$dept =  $db->Query($sql);
	$dept = $db->fetch_array($dept);
	$dept = array_shift($dept);
}

function privilege() {
	global $role;
	switch($role){
		case 1:
			$msg = "Main Administrative";
			break;
		case 2:
			$msg = "Post Graduate Administrative";
			break;
		case 3:
			$msg = "Non NUC Administrative";
			break;
		case 4:
			$msg = "Departmental Administrative";
			break;
		case 5:
			$msg = "Admission Officer's";
			break;	
		case 6:
			$msg = "Financial Officer's";
			break;
		case 7:
			$msg = "Second Level Administrative";
			break;
		case 8:
			$msg = "News Officer's";
			break;
		case 9:
			$msg = "Bursary Officer's";
			break;
		case 10:
			$msg = "Requery Officer's";
			break;	
	}
	return $msg;
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
			div.create{
				padding-top:3px;
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
			
            <div class="span3">
            	<div class="bs-docs-sidebar create" style="padding-left:2px; padding-righ:2px;" >
                    <h2 style="text-align:center">Notice</h2>
                    <hr>
                    <p>Welcome to the admin panel of the application form. You are currently signed in with <?php echo privilege(); ?> privileges <?php if(isset($dept)) echo "for <strong>".$dept."</strong>"; ?>.  Actions done on this end are strictly confidential and are being logged.</p>
                    <p>Other information can be put here</p>
                </div>
            </div>

			<div class="span9">
				<h2>Control Panel <i class="iconic-cog"></i></h2>
				<hr>
                
                <h4>User Settings <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
                    <div class="span2 create">
						<a href="editprofile.php">
                             <p align="center"><i class="iconic-pen-alt2"></i> Edit Profile</p>
						</a>
					</div>
                    
					<?php
                    if($role == 1){
					?>
                    
                    <div class="span2 create">
						<a href="register.php">
                             <p align="center"><i class="iconic-user"></i> Add User</p>
						</a>
					</div>
                    
                    <div class="span2 create">
						<a href="view_users.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View Users</p>
						</a>
					</div>
                   
                    <?php
                    }
					?>
				</div>
                
                
                <?php
				if($role == 1){
				?>
                <hr>
				<h4>General Settings <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
                    <div class="span2 create">
						<a href="flush.php">
                             <p align="center"><i class="iconic-layers"></i> Flush Database</p>
						</a>
					</div>
                    
                    <div class="span2 create">
						<a href="validation.php">
                             <p align="center"><i class="iconic-mail"></i> Validation Mail</p>
						</a>
					</div>
                    
                    
                    <div class="span2 create">
						<a href="refereemail.php">
                             <p align="center"><i class="iconic-mail"></i> Referee Mail</p>
						</a>
					</div>
                    
				</div>
				<?php
				}
				?>                
				<hr>
                
                <?php
				if($role == 1 || $role == 2 || $role == 3 || $role == 7 || $role == 9 || $role == 4){
				?>
				<h4>Applicant Details <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
	                <?php
					if($role == 1 || $role == 2 || $role == 3 || $role == 7 || $role == 9 || $role == 4){
					?>
	                	<div class="span2 create">
							<a href="view_applicant.php">
	                             <p align="center"><i class="iconic-magnifying-glass"></i> View Applicants</p>
							</a>
						</div>
					<?php
					}

					if($role == 1 || $role == 2 || $role == 3 || $role == 7 || $role == 9 || $role == 4){
					?>
                     <div class="span2 create">
						<a href="view_summary.php">
                             <p align="center"><i class="iconic-document-alt"></i> Generate Report</p>
						</a>
					</div>
                    
					<?php
					}
					?>
				</div>
				<?php
				}
				?>
				
                <?php
				if($role == 1){
				?>
				<hr>
				<h4>Application Settings <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
                    <div class="span2 create">
						<a href="openapplication.php">
                             <p align="center"><i class="iconic-book-alt2"></i> Open Application</p>
						</a>
					</div>
                    
                    <div class="span2 create">
						<a href="closeapplication.php">
                             <p align="center"><i class="iconic-book-alt"></i> Close Application</p>
						</a>
					</div>
                    
                    <div class="span2 create">
						<a href="set_programmes.php">
                             <p align="center"><i class="iconic-cog"></i> Set Programme</p>
						</a>
					</div>

					<?php
					if($role <= 2){
					?>
						<div class="span2 create">
							<a href="set_ineligible_reasons.php">
	                             <p align="center"><i class="iconic-cog"></i> Ineligiblity Settings</p>
							</a>
						</div>
					<?php
					}
					?>
				</div>
                <?php
				}
				?>
                
                <?php
				if($role == 1 || $role == 6 || $role == 9){
				?>
				<hr>
				<h4>Forms Payment Management <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="search_acceptance.php">
                             <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search Tranx Log </p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="search_adm.php">
                            <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search ADM </p>
						</a>
					</div>
					
					
                    <div class="span2 create">
						<a href="insert_log.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add Tranx Log</p>
						</a>
					</div>
  
                    
                     <div class="span2 create">
						<a href="insert_admaccess.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add ADM</p>
						</a>
					</div>
                </div>
                <hr>
                <h4>Acceptance Payment Management <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="search_acceptance_acceptance.php">
                             <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search Tranx Log </p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="search_adm_acceptance.php">
                            <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search ADM </p>
						</a>
					</div>
					
					
                    <div class="span2 create">
						<a href="insert_log_acceptance.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add Tranx Log</p>
						</a>
					</div>
  
                    
                     <div class="span2 create">
						<a href="insert_admaccess_acceptance.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add ADM</p>
						</a>
					</div>
                </div>

                <hr>
				<h4>Bursary Payment Management <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="search_acceptance.php">
                             <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search Tranx Log </p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="search_adm.php">
                            <p align="center"><i class="iconic-magnifying-glass icon-white"></i> Search ADM </p>
						</a>
					</div>
					
					
                    <div class="span2 create">
						<a href="insert_log.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add Tranx Log</p>
						</a>
					</div>
  
                    
                     <div class="span2 create">
						<a href="insert_admaccess.php">
                             <p align="center"><i class="iconic-o-arrow-down"></i> Add ADM</p>
						</a>
					</div>
                </div>
                <?php
					}
					
					if($role == 1){
				?>
                <hr>
				<h4>Amount Management <i class="iconic-o-arrow-down"></i></h4>
                <div class="row-fluid">
                    <div class="span2 create">
						<a href="insert_form_amount.php">
                             <p align="center"><i class="iconic-o-plus"></i> Add Amount</p>
						</a>
					</div>
                    
                    <div class="span2 create">
						<a href="view_amount.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View Amount</p>
						</a>
					</div>
                    
				</div>
                <?php
				}
				?>
				
				<?php
				if($role == 1 || $role == 7){
				?>
				<hr>
				<h4>Developer's Management <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="add_credit.php">
                        
                        <p align="center"><i class="iconic-o-plus"></i> Add Developers</p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="view_credit.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View Developers</p>
						</a>
					</div>
				</div>
				<?php
				}

				if($role == 1 || $role == 2 || $role == 7 || $role == 8){
				?>
				<hr>
				<h4>News Management <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="add_index_news.php">
                        
                        <p align="center"><i class="iconic-o-plus"></i> Add News</p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="view_index_news.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View News</p>
						</a>
					</div>
				</div>
               	<?php
				}

				if($role == 1 || $role == 2 || $role == 7){
				?>
				<hr>
				<h4>Admission Requirements <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="add_admission_requirements.php">
                        
                        <p align="center"><i class="iconic-o-plus"></i> Add Requirements</p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="view_admission_requirements.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View Requirements</p>
						</a>
					</div>
				</div>

				<hr>
				<?php
					}
					if($role == 1 || $role == 7){
				?>
				<h4>Admission Registra <i class="iconic-o-arrow-down"></i></h4>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="add_registra.php">
                        
                        <p align="center"><i class="iconic-o-plus"></i> Add Registra</p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="view_registras.php">
                             <p align="center"><i class="iconic-magnifying-glass"></i> View Registras</p>
						</a>
					</div>
				</div>
				<?php
					}
					if($role == 1 || $role == 7){
				?>

				<hr>
				<h4>Application Settings <i class="iconic-o-arrow-down"></i></h4>
					<h5>Themes Settings</h5>
					<hr>
				<div class="row-fluid">
					<div class="span2 create">
						<a href="add_theme.php">
                        
                        <p align="center"><i class="iconic-o-plus"></i> Create Theme</p>
						</a>
					</div>
					
					<div class="span2 create">
						<a href="view_theme.php">
                             <p align="center"><i class="iconic-cog"></i> Manage Theme</p>
						</a>
					</div>
				</div>
                <?php
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
<script src="js/adminreg.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>