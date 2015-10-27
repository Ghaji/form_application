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
				<h2>Open Form Application</h2>
                <hr>
                <h3>Note:</h3>
                <ul>
                	<li>Once you open application, people can register</li>
                    <li>You can also set a future date for the application to be opened</li>
                </ul>
                <?php
					$database = new MySQLDatabase();
					$sql = $database->query("SELECT * FROM application_status WHERE id=1");
					$result = $database->fetch_array($sql);
				?>
                <form action="" method="POST" class="form-horizontal openapplication" id="openapplication" >
                	<div class="control-group">
                        <label class="control-label" for="inputOpeningDate">Opening Date:</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" class="input-medium datepicker" value="<?php echo $result['application_open_date']; ?>" id="date" name="date" maxlength="10"  data-date-format="yyyy-mm-dd" placeholder="YYYY-MM-DD" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputOPeningTime">Opening Time:</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                                <input type="text" class="input-medium" value="<?php echo $result['application_open_time']; ?>" id="time" name="time" maxlength="5" placeholder="HH:MM" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputSession">Session:</label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-calendar"></i></span>
                                <select name="session" class="input-large" id="session" required="required">
                                <?php
									for($index = date('Y')-5; $index <= date('Y')+5; $index++){
										echo '<option value="'.$index.'/'.($index+1).'">'.$index.'/'.($index+1).'</option>';
									}
								?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="close_app">Open Application</button>
				      </div>
					</div>
 
                </form>
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
<script src="js/close_open_app.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('.datepicker').datepicker();	
});
</script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>