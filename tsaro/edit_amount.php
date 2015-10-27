<?php require_once ("../inc/initialize.php");
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
$database = new MYSQLDatabase();
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
				<h2>Edit Amount Details</h2>
				<hr>
				<?php 
					$amount_id = customDecrypt($_POST['amount_id']);
					$amount_details_sql = $database->query("SELECT * FROM `form_amount` WHERE amount_id = ".$amount_id."");
					$amount_details = $database->fetch_array($amount_details_sql);
				?>
				<!-- Begining of Credit form -->
				<form class="form-horizontal amount_update" id="amount_update">
					<input type="hidden" name="amount_id" value="<?php echo $amount_details['amount_id']; ?>"/>
					<div class="control-group">
						<label class="control-label">Programme</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="iconic-lightbulb"></i></span>
                                <select name="programme">
								<?php
									$sql_faculty = "SELECT * FROM faculty WHERE `status` = 1 ORDER BY faculty_name ASC";
	  								$result_set = $database->query($sql_faculty);
									while($row = $database->fetch_array($result_set))
									{
										if($row['faculty_code'] == $amount_details['student_status'])
											echo '<option selected="selected" value="'. $row['faculty_code'] .'">'.$row['faculty_name'].'</option>'; 
										else
											echo '<option value="'. $row['faculty_code'] .'">'.$row['faculty_name'].'</option>'; 
									}
								?>
                                </select>
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i>&#8358;</i></span>
								<input type="number" id="amount" name="amount" placeholder="Amount" class="input-medium" value="<?php echo $amount_details['amount']; ?>" />
							</div>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label">Transaction Amount</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i>&#8358;</i></span>
								<input type="number" id="transaction_amount" name="transaction_amount" placeholder="Transaction Amount" class="input-medium" value="<?php echo $amount_details['transaction_amount']; ?>" />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Pay Item ID</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="iconic-award"></i></span>
								<input type="text" id="pay_item_id" name="pay_item_id" placeholder="Pay Item ID" class="input-xlarge" value="<?php echo $amount_details['pay_item_id']; ?>" />
							</div>
						</div>
					</div>

                     
                     
                     <div class="control-group">
						<label class="control-label">Description</label>
						<div class="controls">
							<div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
							<textarea class="input-xlarge" name="description" id="description"><?php echo $amount_details['description']; ?></textarea>
							</div>
						</div>
					</div>
                    
                    <?php
						//$arrayRoleSql = "SELECT * FROM `credit_status` WHERE `status` = 1";
						//$result = $database->query($arrayRoleSql);
					?>
                    
					
					<!--Save Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">
							  	<a href="<?php if(isset($_POST['from'])) echo customDecrypt($_POST['from']); ?>" class="btn btn-default" name="back" id="back">Back</a>  
								<button type="submit" class="btn btn-info" name="update_amount" id="update_amount">Update</button>
						      </div>
						</div>
					</div>
					<!-- End of Save Button-->
				</form>
				<!-- End of Credit form -->
				
			</div>
            
		</div>
		<!-- //Content -->

		<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
			<div class="modal-body ajax_data"></div>
			<div class="modal-footer">
				<a href="#" class="btn" id="close">Close</a>
			</div>
		</div>
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
<script src="js/edit_amount.js"></script>

<link href="../css/assets/css/bootstrap-wysihtml5.css" rel="stylesheet">
<script src="../js/wysihtml5-0.3.0.js"></script>
<!--<script src="../js/jquery.js"></script>
<script src="../css/assets/js/bootstrap.js"></script>-->
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>