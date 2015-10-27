<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if(!isset($_POST['uid'])){
	redirect_to('view_users.php');
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
				<?php 	
					if(isset($_POST["uid"])) {
						$user_id = customDecrypt($_POST["uid"]);
						$user = AdminLog::find_by_id($user_id);
						
						if(isset($user->surname) && isset($user->othernames))
							echo '<h5 align="center">Edit '.$user->surname.' '.$user->othernames.'\'s Profile</h5>';
					}
				?>
				<hr>
				<form action="" method="POST" class="admin_edit_form form-horizontal" >
				  <div class="control-group">
				    <label class="control-label" for="inputSurname">Surname</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-user"></i></span>
				            <input type="text" id="surname" name="surname" placeholder="Enter surname" value="<?php if(isset($user->surname)) echo $user->surname ?>" required />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputOtherNames">Other Names</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-user"></i></span>
				            <input type="text" id="othernames" name="othernames" placeholder="Enter other names" value="<?php if(isset($user->othernames)) echo $user->othernames ?>" required />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputStaff">Staff ID</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-user"></i></span>
				            <input type="text" maxlength="4" id="staffid" name="staffid" placeholder="Enter Staff ID" value="<?php if(isset($user->staff_id)) echo $user->staff_id ?>" required />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputRank">Rank</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-bookmark"></i></span>
				            <input type="text" id="rank" name="rank" placeholder="Enter staff's rank" value="<?php if(isset($user->rank)) echo $user->rank ?>" required />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputEmail">Email</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-envelope"></i></span>
				            <input type="text" required id="email" name="email" placeholder="Enter e-mail" value="<?php if(isset($user->email)) echo $user->email ?>" />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputPassword">Password</label>
				    <div class="controls">
				      <div class="input-prepend">
				      		<span class="add-on"><i class="icon-lock"></i></span>
				            <input type="password" id="epassword" name="epassword" placeholder="Enter Password" />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputPassword">Confirm Password</label>
				    <div class="controls">
				      <div class="input-prepend">
				      		<span class="add-on"><i class="icon-lock"></i></span>
				            <input type="password" id="cepassword" name="cepassword" placeholder="Confirm Password" />
				    	</div>
				    </div>
				  </div>
				  
				  <div class="control-group">
				    <label class="control-label" for="inputActivationStatus">Activation Status</label>
				    <div class="controls">
				    	<div class="input-prepend">
				      		<span class="add-on"><i class="icon-user"></i></span>
				            <select name="activated_status" id="activated_status">
				            	<?php 
				            		if($user->activated_status == 0){
				            			echo '<option value="0">Deactivate</option>
				            				  <option value="1">Activate</option>';
				            		}
				            		else{
				            			echo '<option value="1">Activate</option>
				            				  <option value="0">Deactivate</option>';
				            		}
				            	?>
				            </select>
				    	</div>
				    </div>
				  </div>
	
    <div class="control-group">
    <label class="control-label" for="inputPassword">Role</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-bookmark"></i></span>
            <select name="role" class="input-xlarge" id="role" required >
            	<option value="">--Select A Role--</option>
            	<?php
					$roles = $database->query("SELECT * FROM admin_roles");
					
					//The key acts as values in the database
					while($row_roles = $database->fetch_array($roles)){
						echo '<option value="'.$row_roles['admin_role_id'].'">'.$row_roles['admin_role_name'].'</option>';
					}
				?>
            	
            </select>
    	</div>
    </div>
  </div>
    			  
   <?php
  	
  	$sql_faculty = "SELECT * FROM faculty ORDER BY faculty_name ASC";
  	$result_set = $database->query($sql_faculty);
  ?>
  <div class="department_administrator" style=" <?php if($user->role != 4) echo 'display:none'; ?> " >
	<div class="control-group">
    <label class="control-label">Programme</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-chevron-down"></i></span>
                <select class="input-xlarge" name="faculty_id" id="faculty_id" onChange="get_options(this.value);" >
                    <option value="">--Select Programme--</option>
                    <?php
						$faculty = $database->query("SELECT faculty_id FROM department WHERE department_id='".$user->department_id."'");
						$faculty = $database->fetch_array($faculty);
                    while ($row = $database -> fetch_array($result_set)) {
						if($row['faculty_id'] == $faculty['faculty_id']){
							echo '<option selected="selected" value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
						}else{
                        	echo '<option value="' . $row['faculty_id'] . '">' . $row['faculty_name'] . '</option>';
						}
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    
    <div class="control-group">
        <label class="control-label">Course</label>
        <div class="controls">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-chevron-down"></i></span>
				<input type="hidden" value="<?= $user->department_id; ?>" id="department_from_db" />
                <select class="input-xlarge" name="department_id" id="department_id" >
                    <option value="">--Select Course--</option>
                    <div id="department_id"></div>
                </select>
            </div>
        </div>
    </div>
  </div>
                  
				  <input type="hidden" name="uid" value="<?php if(isset($user->user_id)) echo customEncrypt($user->user_id); ?>" />
				
				<div id="accept_terms">		
					<div class="control-group">
						  <div class="controls">  
							<button type="submit" class="btn btn-primary" id="submit" >Update</button>
							<button type="button" onClick="document.location.href='index.php';" class="btn">Cancel</button>
					      </div>	
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
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/admin_user_edit.js"></script>
<script src="selector2.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>