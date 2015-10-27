<?php
$email = $_GET['email']; 

preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email, $matches);

//preg_match('/^([a-zA-Z0-9_-]+)(@unijos.edu.ng)$/i', $email, $matches);

if($matches)

	echo 'true';
else 
	echo 'false';


?>