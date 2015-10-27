<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
}

function show_role($role_num, $staff_no){
	switch ($role_num) {
		case 1:
			$admin_role = $staff_no.' - Main Administrator';
			break;
		case 2:
			$admin_role = $staff_no.' - Post Graduate Administrator';
			break;
		case 3:
			$admin_role = $staff_no.' - Non NUC Programmes';
			break;
		case 4:
			$admin_role = $staff_no.' - Departmental Administrator';
			break;
		case 5:
			$admin_role = $staff_no.' - Admission Officer';
			break;
	}
	return $admin_role;
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
				<h2>Send Notification</h2>
                <hr>
                <h3>Note:</h3>
                <ul>
                	<li>This function is used for sending of notifications to other admins</li>
                    
                </ul>
                <?php
					$database = new MySQLDatabase();
					$sql_all_users = $database->query("SELECT * FROM admin_users");
					
					$admin_details = AdminLog::find_by_sql("SELECT * FROM admin_users WHERE user_id='".$session->applicant_id."'");
					$admin_details = array_shift($admin_details);
				?>
                <form action="" method="POST" class="form-horizontal sendnotification" id="sendnotification" >
                
                    <div class="control-group">
                        <label class="control-label" for="selectRecipient">Select Recipient: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                                <select name="recipient" class="input-xlarge" id="recipient" required >
                                <option value="">--Select A Recipient--</option>
                                <?php
									while($result = $database->fetch_array($sql_all_users)){
										echo '<option value="'.$result['user_id'].'">'.show_role($result['role'], $result['staff_id']).'</option>';
									}
								?>
                            </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputNotificationTitle">Notification Title: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="" id="title" name="title" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputContent">Message: </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <textarea class="textarea" style="width: 610px; height: 200px" name="message" id="message"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
					  <div class="controls">  
						<input type="hidden" value="<?php echo customEncrypt($admin_details->surname.' '.$admin_details->othernames); ?>" id="sender" name="sender" />
				      </div>
				</div>
                
                    <div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="send_notification">Send</button>
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
<script src="js/send_notification.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>