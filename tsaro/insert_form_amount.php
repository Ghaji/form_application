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
	
	default:
		redirect_to('home.php');
		break;
}
$database = new MySQLDatabase();
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
				<h2>Insert into Form Amount Table</h2>
				<hr>
                
				<!-- Begining of form amount table form -->
				<form class="form-horizontal form_amount">
					
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i>&#8358;</i></span>
								<input type="number" name="amount" placeholder="Amount" class="input-xlarge" value="" />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Transaction Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i>&#8358;</i></span>
								<input type="number" name="transaction_amount" placeholder="Transaction Amount" class="input-xlarge" value="" />
							</div>
						</div>
					</div>
                    
                    <!-- Student Status -->
                    <div class="control-group">
						<label class="control-label">Programme</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <select class="input-xlarge" name="student_status" id="student_status" >
                                <option value="">--SELECT--</option>
								<?php
									$sql_faculty = "SELECT * FROM faculty WHERE `status` = 1 ORDER BY faculty_name ASC";
	  								$result_set = $database->query($sql_faculty);
									while($row = $database->fetch_array($result_set))
									{
										echo '<option value="'. $row['faculty_code'] .'">'.$row['faculty_name'].'</option>'; 
									}
								?>
                                </select>
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Pay Item Id</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
								<input type="number" id="pay_item_id" name="pay_item_id" placeholder="Pay Item Id" class="input-xlarge" value="" />
							</div>
						</div>
					</div>
                    
					<div class="control-group">
						<label class="control-label">Description</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-chevron-down"></i></span>
                                <textarea class="input-xlarge" name="description" id="description"></textarea>
							</div>
						</div>
					</div>
					
					
					
					
					<!--Insert Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">
                              <a href="home.php" class="btn btn-default" name="back_submit" id="back_submit">Back</a> 
                                <button type="submit" class="btn btn-primary" name="insert" id="insert">Enter</button>
						      </div>
						</div>
					</div>
					<!-- End of insert Button-->
				</form>
				<!-- End of form amount table form -->
				
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
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="js/form_amount_insert.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>