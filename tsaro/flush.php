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
				<h2>Flush Database</h2>
                <hr>
                <h3>Note:</h3>
                <ul>
                	<li>Flushing database removes records from the database completely</li>
                    
                </ul>
                <?php
					$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
					$result_set = $database->query($sql_faculty);
				?>
			<form action="" method="POST" class="form-horizontal flush" id="flush" >
                <div class="control-group">
                    <label class="control-label">Programme</label>
                    <div class="controls">
                        <div class="input-prepend">
                            <span class="add-on"><i class="icon-chevron-down"></i></span>
                            <select class="input-xlarge" name="faculty_id" id="faculty_id" >
                                <option value="all">All Programmes</option>
                                <?php
                                while ($row = $database -> fetch_array($result_set)) {
                                    echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
   
                <div class="control-group">
                  <div class="controls">  
                    <button type="submit" class="btn btn-primary" id="flush_db">Flush Database</button>
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
<script src="js/flush_database.js"></script>

<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>