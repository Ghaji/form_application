<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
}

function show_role($role_num, $staff_no, $dept=""){
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
			$admin_role = $staff_no.' - Departmental Administrator - '.$dept;
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
				<h2>Read Notification</h2>
                <hr>
                <?php
                	$nid = customDecrypt($_POST["nid"]);
					$from = customDecrypt($_POST["from"]);
					$notification = NotificationLog::find_by_sql("SELECT * FROM `notifications` WHERE notification_id = ". $nid);
					$notification = array_shift($notification);
					
					
					$sender = AdminLog::find_by_id($notification->user_id);
					$sender = show_role($sender->role, $sender->staff_id, $sender->department_id);
					
				?>
                <form action="<?php echo $from; ?>" method="POST" class="form-horizontal" >
                
                    <div class="control-group">
                        <label class="control-label" for="selectRecipient">Sender: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                                <input type="text" class="input-large" value="<?php if(isset($sender)) echo $sender; ?>" id="sender" name="sender" readonly="readonly" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputNotificationTitle">Notification Title: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="<?php if(isset($notification->title)) echo $notification->title; ?>" id="title" name="title" readonly="readonly" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputContent">Message: </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <textarea style="width: 610px; height: 200px" name="message" id="message" readonly="readonly"><?php if(isset($notification->content)) echo $notification->content; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="send_notification">Back</button>
				      </div>
					</div>
                </form>
			</div>

		<?php
			$notification = new NotificationLog();
			$notification->db_fields = array('notification_id', 'status');
			
			$notification->notification_id = $nid;
			$notification->status = 2;
			$notification->save();
		?>
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
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>