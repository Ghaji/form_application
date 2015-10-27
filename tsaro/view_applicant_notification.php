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

if($session->applicant_id != 1){
	redirect_to('home.php');
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
				<h2>Read Applicant Notification</h2>
                <hr>
                <?php
					$database = new MySQLDatabase();
                	$nid = customDecrypt($_POST["nid"]);
					$from = customDecrypt($_POST["from"]);
					$notification_query = "SELECT * FROM `applicant_notifications` as a JOIN `Personal_details` as p WHERE a.sender_id = p.applicant_id AND notification_id = ". $nid;
					$result = $database->query($notification_query);
					
					
					while($row = $database->fetch_array($result)){
						$recipient_id = $row['sender_id'];
						$sender = $row["surname"]." ".$row["first_name"]." ".$row["middle_name"];
						$title = $row["title"];
						$content = $row["content"];
					}
					
				?>
                <form method="POST" class="form-horizontal reply_notification" >
                
                    <div class="control-group">
                        <label class="control-label" for="selectRecipient">Sender: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                            	<input type="hidden" name="recipient_id" value="<?php echo customEncrypt($recipient_id); ?>" />
                                <input type="text" class="input-large" value="<?php if(isset($sender)) echo $sender; ?>" id="sender" name="sender" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputNotificationTitle">Notification Title: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="<?php if(isset($title)) echo $title; ?>" id="title" name="title" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputContent">Message: </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <textarea style="width: 610px; height: 200px" name="message" id="message" readonly><?php if(isset($content)) echo $content; ?></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputContent">Reply Message: </label>
                        <div class="controls">
                            <div class="input-prepend">
                                <textarea required style="width: 610px; height: 200px" name="replymessage" id="replymessage" ></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
					  <div class="controls">  
                      	<button id="reply_notification" class="btn btn-primary">Reply</button>
						<a href="<?= $from; ?>"><button class="btn btn-danger">Back</button></a>
				      </div>
					</div>
                </form>
			</div>

		<?php
			$update_query = "UPDATE `applicant_notifications` SET `status` = '2' WHERE `notification_id` = ".$nid;
			$database->query($update_query);
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
<script src="js/send_applicant_notification.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>