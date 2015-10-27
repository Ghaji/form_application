<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in
if(!$session->is_admin_logged_in())
{
	redirect_to('index.php');
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
				<h2>Send Mail To Admin</h2>
                <hr>
                <h3>Note:</h3>
                <ul>
                	<li>This function is used for sending of mails to other admins</li>
                    <li>You will be required to enter your unijos mail password before you can send the mail</li>
                </ul>
                <?php
					$database = new MySQLDatabase();
					$sql_all_users = $database->query("SELECT * FROM admin_users");
					
					$admin_details = AdminLog::find_by_sql("SELECT * FROM admin_users WHERE user_id='".$session->applicant_id."'");
					$admin_details = array_shift($admin_details);
				?>
                <form action="" method="POST" class="form-horizontal sendmail" id="sendmail" >
                
                	<div class="control-group">
                        <label class="control-label" for="inputEmail">Email: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="<?php echo $admin_details->email ?>" id="email" name="email" readonly />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="selectRecipient">Select Recipient: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-user"></i></span>
                                <select name="recipient" class="input-xlarge" id="recipient" required >
                                <option value="">--Select A Recipient--</option>
                                <?php
									while($result = $database->fetch_array($sql_all_users)){
										echo '<option value="'.$result['email'].'">'.$result['surname'].' '.$result['othernames'].'</option>';
									}
								?>
                            </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Password: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-lock"></i></span>
                                <input type="password" class="input-large" value="" id="password" name="password" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Mail Title: </label>
                        <div class="controls">
                            <div class="input-prepend">
                            <span class="add-on"><i class="icon-envelope"></i></span>
                                <input type="text" class="input-large" value="" id="title" name="title" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Message: </label>
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
						<button type="submit" class="btn btn-primary" id="send_mail">Send Mail</button>
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
<script src="js/send_mail.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>