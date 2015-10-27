<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
}

$role = $_SESSION['role'];
switch ($role) {
	case 1:
		
		break;
	case 6:
		
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
				<h2>Successful Acceptance Fees Payments</h2>
                <hr>
                <h3>Note:</h3>
                <ul>
                	<li>This form is to search Successful payment for acceptance record(s)</li>
                </ul>

                <form action="" method="POST" class="form-horizontal search_adm_access" id="search_adm_access" >
                	
                	<!--
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-chevron-down"></i></span>
                        <select class="input-xlarge" name="faculty_id" id="faculty_id" >
                            <option value="all" selected>--Programme--</option>
                            <option value="PGA">Post Graduate</option>
                            <option value="DPA">Diploma</option>
                            <option value="PTA">Part Time</option>
                    		<option value="RP">Remedial</option>
                        </select>
                    </div> -->
                    
                    <?php
					$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
					$result_set = $database->query($sql_faculty);
					?>

					<div class="input-prepend">
						<span class="add-on"><i class="icon-chevron-down"></i></span>
						<select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
							<option value="">--Select Programme--</option>
							<?php
							while ($row = $database -> fetch_array($result_set)) {
								echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
							}
							?>
						</select>
					</div>
                    
                    
					<div class="input-prepend">
						<span class="add-on"><i class="icon-chevron-down"></i></span>
						<select class="input-xlarge" name="department_id" id="department_id" >
							<option value="">--Select Course--</option>
							<div id="department_id"></div>
						</select>
					</div>

                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-chevron-down"></i></span>
                        <input type="text" name="form_number" placeholder="Applicant Number" class="input-xlarge" />
                    </div>

                    <div class="control-group">
                        <div class="controls offset5"> 
                    		<br> 
                          	<button type="submit" class="btn btn-primary" id="search_adm_access_acc_button">Search</button>
                        </div>
					</div>
 
                </form>
                
                <div id="view_div">
                    <!-- the div where ajax will be poured into -->
                </div>
                
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
         
		</div>
		<!-- //Content -->

		<?php include_layout_template("footer.php"); ?>
	</body>
</html>

<?php
require_once (LIB_PATH . DS . 'javascript.php');
?>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/search_adm.js"></script>
<script src="selector.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>