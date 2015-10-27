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

	case 4:
		break;

	case 5:
		break;
		
	 	break;
	case 7:
		
		break;
	case 9:
		
		break;
	
	default:
		redirect_to('home.php');
		break;
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
			#admission_status_wrapper, #set_admission_status, #exportdatabutton{
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
				<h2>View Applicant</h2>
				<hr>
				<?php
					//search query form
					include_layout_template('search_form.php');
				?>
                <form method="post" action="export.php">
                	<input type="hidden" value="" name="exportdata" id="exportdata" />
                    <input type="submit" id="exportdatabutton" name="exportdatabutton" class="btn btn-primary pull-left" value="Export To Excel"/>
                </form>
                <?php
				if($role == 1 || $role == 2 || $role == 4 || $role == 5) {
					echo '<form class="admission_multiple" >';
				}
				?>
					<div id="view_div">
						<!-- the div where ajax will be poured into -->
					</div>
						
					<?php
						if($role == 1 || $role == 2 || $role == 4 || $role == 5) {
							
							echo '<div class="pull-left" id="check" style="display: none;">
			                	<input type="checkbox" id="check_all" /> Check All
			                </div>
							<div id="admission_status_wrapper" class="input-prepend span4 offset2">
									<span class="add-on"><i class="icon-chevron-down"></i></span>
									<select class="input-large" name="admission_status" id="admission_status" >
										<option value="">--Admission Status--</option>
										<option value="4">Not offered Admission</option>
										<option value="5">Offered Admission</option>
									</select>
								</div>
								<button id="set_admission_status" type="button" class="btn btn-primary">Set Admission Status</button>
							</form>';
						}
				?>
				
                <div class="pagination pagination-centered">
                    <ul>
                      <li><a class="left prev" href="#">Prev</a></li>
                      
                      <li><a class="right next" href="#">Next</a></li>
                      
                      <li>
                          <div class="input-append">
                              <input type="number" class="right" id="pageNumber" min="1" style="width:60px; height: 30px;" title="Go to" placeholder="GOTO" />
                              <span class="add-on" style="height: 16px; padding: 11px;">/</span>
                          </div>
                      </li>
                      
                    </ul>
                    
                  </div>
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
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
	$('.datepicker').datepicker();	
});
</script>
<script src="selector.js"></script>
<script src="js/view_applicant.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>