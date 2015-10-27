<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
	redirect_to('index.php');
}

if (isset($_POST['nid']) && !empty($_POST['nid'])) {
	$news = News_Events::find_by_id(customDecrypt($_POST['nid']));
	// print_r($news->title);
	// die();
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
				<h2>Edit Index News</h2>
				<hr>
				<form class="form-horizontal update_news" role="form">

					<div class="row">
						<div class="span5">
							<div class="control-group">
								<label class="control-label" for="title">News Title: </label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-pencil"></i></span>
										<input class="span12" name="title" id="title" <?php if(isset($news->title)) echo ' value ="'.$news->title.'"'; ?> />
									</div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="display_line">Display Line: </label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-pencil"></i></span>
										<input class="span12" name="display_line" id="display_line" <?php if(isset($news->display_line)) echo ' value ="'.$news->display_line.'"'; ?> />
									</div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="status">Status: </label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-pencil"></i></span>
										<select class="span12" name="status" id="status">
											<option value="1">Active</option>
											<option value="0">Inactive</option>
										</select>
									</div>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="author">Author: </label>
								<div class="controls">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-pencil"></i></span>
										<input class="span12" name="author" id="author" readonly="readonly" <?php if(isset($news->author)) echo ' value ="'.$news->author.'"'; ?> />
									</div>
								</div>
							</div>
						</div>

						<div class="span5">
								<div class="control-group">
									<label class="control-label" for="created_year">Year: </label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-pencil"></i></span>
											<input class="span12" name="created_year" id="created_year" readonly="readonly" <?php if(isset($news->created_year)) echo ' value ="'.$news->created_year.'"'; ?> />
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="created_time">Time: </label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-pencil"></i></span>
											<input class="span12" name="created_time" id="created_time" readonly="readonly" <?php if(isset($news->created_time)) echo ' value ="'.$news->created_time.'"'; ?> />
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="verified_by">Verified By: </label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-pencil"></i></span>
											<input class="span12" name="verified_by" id="verified_by" readonly="readonly" <?php if(isset($news->verified_by)) echo ' value ="'.$news->verified_by.'"'; ?> />
										</div>
									</div>
								</div>

								<div class="control-group">
									<label class="control-label" for="last_update">Last Update: </label>
									<div class="controls">
										<div class="input-prepend">
											<span class="add-on"><i class="icon-pencil"></i></span>
											<input class="span12" name="last_update" id="last_update" readonly="readonly" <?php if(isset($news->last_update)) echo ' value ="'.$news->last_update.'"'; ?> />
										</div>
									</div>
								</div>
						</div>
					</div>

					<div class="control-group">
						<textarea class="textarea" name="content" id="content" style="width: 610px; height: 120px"><?php if(isset($news->content)) echo $news->content; ?></textarea>
					</div>

					<input name="nid" type="hidden" value="<?= $_POST['nid']; ?>">
					<div class="control-group">
						<button type="submit" class="btn btn-primary" name="update_news" id="update_news">Update News</button>
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
<script src="js/add_index_news.js"></script>
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