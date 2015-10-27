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
	case 2:
		break;
	case 7:
		
		break;
	case 8:
		
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
				<h2>News</h2>
				<hr>
						<?php 

							$query = "SELECT * FROM news_events ORDER BY id DESC";
				            $result =  News_Events::find_by_sql($query);
							
							$pagecounter = 1;
							$serialno = 1;
							$max = 10;
							$number_of_notifications = sizeof($result);
							echo '<div class="tabbable">
								<div class="tab-content">';

							foreach ($result as $row) {
								if($serialno % $max == 1){
									if($pagecounter == 1){
										echo '<div class="tab-pane active" id="'.$pagecounter.'">';
									}
									else {
										echo '<div class="tab-pane" id="'.$pagecounter.'">';
									}
									echo '<table class="table table-hover">
									<thead>
										<tr>
											<th>S/N</th>
											<th>Title</th>
											<th>Display Line</th>
											<th>Date</th>
											<th>Time</th>
											<th>Status</th>
											<th></th>
											<th></th>
										</tr>
									</thead>
									<tbody>';
									}
									echo '<form action="edit_news.php" method="POST">
									<tr>
										<td>'.$serialno.'</td>
										<td>'.$row->title.'</td>
										<td>'.$row->display_line.'</td>
										<td>'.$row->created_year.'</td>
										<td>'.$row->created_time.'</td>';
										
										if($row->visible== 1){
											echo '<td><span class="label label-success">Active</span></td>';
										} else if($row->visible== 2) {
											echo '<td><span class="label label-warning">Unverified</span></td>';
										} else {
											echo '<td><span class="label label-important">Inactive</span></td>';
										}
										
										echo '<td><button type="submit" class="btn btn-info" name="edit_news">Edit</button></td>
										
									</tr>
									<input type="hidden" name="nid" value="'.customEncrypt($row->id).'" />
									</form>';
									if($serialno % $max == 0){
										echo '</tbody>';
										echo '</table>';
										
										echo '</div>';
										$pagecounter++;
									}
									elseif($serialno == $number_of_notifications){
										echo '</tbody>';
										echo '</table>';
							
										echo '</div>';
									}
								$serialno++;
							}
							echo '</div>
								</div>';
								
							if($number_of_notifications == 0){
								echo '<p>You have no notification.</p>';
							}
						?>
				
				<?php
				if($serialno > $max){
					echo'
					<div class="pagination pagination-centered">
	                  <ul>
	                    <li><a class="left prev" href="#">Prev</a></li>
	                    
	                    <li><a class="right next" href="#">Next</a></li>
	                  </ul>
	                </div>';
					echo '<input type="hidden" id="pg_num" value="'.$pagecounter.'">';
				}
				?>
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
<script src="js/add_index_news.js"></script>
<script src="js/pagination.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
	<div class="modal-body ajax_data"></div>
	<div class="modal-footer">
		<a href="#" class="btn" id="close">Close</a>
	</div>
</div>