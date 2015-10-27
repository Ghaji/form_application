<?php
require_once ("inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_logged_in())
{
	redirect_to('index.php');
}
$user=new User();
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
				<h2>Read Notification</h2>
                <hr>
                <?php
                	$nid = customDecrypt($_POST["nid"]);
					$from = customDecrypt($_POST["from"]);
					$notification = $database->fetch_array($database->query("SELECT * FROM `applicant_notifications` WHERE notification_id = ". $nid));
					
				?>
                <form action="<?php echo $from; ?>" method="POST" class="form-horizontal" >
                    
                    <div class="control-group">
                        <label class="control-label" for="inputNotificationTitle">Notification Title: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="<?php if(isset($notification['title'])) echo $notification['title']; ?>" id="title" name="title" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputContent">Message: </label>
                        <div class="controls">
                        	<p><?php echo $notification['content']; ?></p>
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
			$result = $database->query("UPDATE applicant_notifications SET status=2 WHERE notification_id=".$nid);
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