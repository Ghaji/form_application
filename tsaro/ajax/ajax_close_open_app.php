<?php
	require_once("../../inc/initialize.php");
	
	$date = htmlspecialchars($_POST['date'], ENT_QUOTES);
	$time = htmlspecialchars($_POST['time'], ENT_QUOTES);
	
	$formclass = $_POST['class'];
	
	if($formclass == '.closeapplication')
	{
		if(Settings::closeApplicationForm($date, $time))
		{
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'Application Close Date successfully set<br>';
			echo 'Closing Date: '.$date.'<br>';
			echo 'Closing Time: '.$time;
		}
		else
		{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo 'Application Close Date was not successfully set<br>';
		}
	}
	elseif($formclass == '.openapplication')
	{
		$session = $_POST['session'];
		if(Settings::openApplicationForm($date, $time, $session))
		{
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo 'Application Close Date successfully set<br>';
			echo 'Closing Date: '.$date.'<br>';
			echo 'Closing Time: '.$time;
		}
		else
		{
			echo '<h4 class="alert alert-error">Error</h4>';
			echo '<hr>';
			echo 'Application Close Date was not successfully set<br>';
		}
	}
	
?>