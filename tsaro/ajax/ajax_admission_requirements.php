<?php

require_once ("../../inc/initialize.php");

if (isset($_POST["btn"])) {
	switch ($_POST["btn"]) {
		case 'add_requirements':
			$requirements = new Requirements();
			$requirements->db_fields = array('p_id', 'name', 'content', 'visible');
			$requirements->name = $_POST['title'];
			$requirements->p_id = $_POST['p_id'];
			$requirements->content = $_POST['content'];
			$requirements->visible = 1;

			if($requirements->save()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully added a new record into requirements table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to insert into requirements table.";
				echo '<hr>';
			}
			break;
		case 'update_requirements':
			$requirements = new Requirements();
			$requirements->db_fields = array('p_id', 'name', 'content', 'visible');
			$requirements->id = customDecrypt($_POST['rid']);
			$requirements->name = $_POST['title'];
			$requirements->content = $_POST['content'];
			$requirements->p_id = $_POST['p_id'];
			$requirements->visible = $_POST['status'];
						
			if($requirements->save()){
				echo '<h4 class="alert alert-success">Success</h4>';
				echo '<hr>';
				echo "<p>You have successfully updated admission requirements table</p>";
				echo '<hr>';
			}else{
				echo '<h4 class="alert alert-error">Error</h4>';
				echo '<hr>';
				echo "Failed to update admission requirements table.";
				echo '<hr>';
			}
			break;
		
	}
}
?>