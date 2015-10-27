<?php
require_once ("inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_logged_in())
{
	redirect_to('index.php');
}
$user = new User();
$progress = $user->find_by_sql("SELECT progress FROM personal_details WHERE applicant_id='".$session->applicant_id."'");

$progress = array_shift($progress);

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
			include_layout_template('header.php');
		?>
		<!-- //header -->
		<br>
		<br>

		<!-- Content -->
		<div class="row-fluid">

			<?php
				if($progress->progress == 'Completed')
					include_layout_template('confirmation_menu.php');
				else
					include_layout_template('main_nav_login.php');
			?>

			<div class="span8 offset2">
				<h2>Send Message to the Main Administrator</h2>
                <hr>
                
                <form action="" method="POST" class="form-horizontal sendnotification" id="sendnotification" >

                    <div class="control-group">
                        <label class="control-label" for="inputNotificationTitle">Message Title: </label>
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