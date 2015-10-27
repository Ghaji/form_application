<?php

require_once ("../../inc/initialize.php");

if (isset($_POST["btn"])) {
	switch ($_POST["btn"]) {
		case 'add_news':
			$news = new News_Events();
			$news->db_fields = array('title','display_line', 'content', 'visible', 'author', 'created_year', 'created_time', 'last_update');
			$news->title = $_POST['title'];
			$news->display_line = $_POST['display_line'];
			$news->content = $_POST['content'];
			$news->visible = 2;
			$admin = AdminLog::find_by_id($_SESSION['applicant_id']);
			$news->author = $admin->surname . " " .$admin->othernames;
			$time = time();
			$news->created_year = date("Y", $time);
			$news->created_time = date("H:i:s", $time);
			$news->last_update = date("Y-m-d H:i:s", $time);
			
			if($news->save()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully added a new record into news event table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to insert into news event table.";
				echo '<hr>';
			}
			break;
		case 'update_news':
			$news = new News_Events();
			$news->db_fields = array('title','display_line', 'content', 'visible', 'verified_by', 'last_update');
			$news->id = customDecrypt($_POST['nid']);
			$news->title = $_POST['title'];
			$news->display_line = $_POST['display_line'];
			$news->content = $_POST['content'];
			$news->visible = $_POST['status'];
			$admin = AdminLog::find_by_id($_SESSION['applicant_id']);
			$news->verified_by = $admin->surname . " " .$admin->othernames;
			$time = time();
			$news->last_update = date("Y-m-d H:i:s", $time);
			
			if($news->save()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully updated news event table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to update news event table.";
				echo '<hr>';
			}
			break;
		
	}
}
?>