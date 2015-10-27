<?php
	require_once ("../../inc/initialize.php");
	
	//Send mail
		
		$mail = new PHPMailer();				
		$mail->IsSMTP();
		//$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "mail.unijos.edu.ng";      // sets GMAIL as the SMTP server
		$mail->Port       = 25; 
		$mail->Username=$_POST["email"];
		$mail->Password=$_POST["password"];
		$mail->SetFrom($mail->Username, customDecrypt($_POST["sender"]));
		
		$mail->AddReplyTo($mail->Username, customDecrypt($_POST["sender"]));
		
		
		$mail->Subject=$_POST["title"];
			  
		$MSG =  '
		<style type="text/css">
		.codrops-top{
			line-height: 55px;
			font-size: 30px;
			/*background: rgba(255, 255, 255, 0.4);*/
			background:#069;
			/*text-transform: uppercase;*/
			z-index: 9999;
			position: relative;
			box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
		}
		.codrops-top span.left{
			float: left;
			margin-top:10px;
			margin-left: 20px;
		}
		.codrops-top span.nxt{
			float: center;
			margin-top:10px;
			/*margin-left: 20px;*/
		}
		.codrops-top span.right{
			float: center;
		}
		.message
		{
			width:600px;
			min-height:500px;
			padding:10px;
			margin-top:10px;
			margin:auto;
			text-align:justify;
			font-size:16px;
		}
		
		</style>
		<div class="codrops-top">
		   <span class="left"><img src="http://mis.unijos.edu.ng/images/logo.png" width="80" height="90" alt="University of Jos Logo"></span>
			<span class="right"><center><font color="#FFFFFF">UNIVERSITY OF JOS - NIGERIA</font></center></span>
			<div class="nxt"><center><font color="#FFFFFF">Corporate Information System (CIS)</font></center></div>
			<div class="clr"></div>	
		</div>
		<div class="message">
			'.$_POST["message"].'
		</div>';

		$mail->MsgHTML($MSG);
		$mail->AddAddress($_POST['recipient']);
		//print_r($mail);
		if(!$mail->Send())
		{
			echo '<h4 class="alert alert-danger">Error</h4>';
			echo '<hr>';
			echo "Your email was not sent.";
			echo '<hr>';
		}
		else
		{
			echo '<h4 class="alert alert-success">Success</h4>';
			echo '<hr>';
			echo "You mail has been sent.";
			echo '<hr>';
		}

?>