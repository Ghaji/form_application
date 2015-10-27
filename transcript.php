<?php require_once("inc/initialize.php");

	
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); 
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>

<!--The Main Content Here Please-->
<div class="container">
    <div class="span8 offset2 border-radius">     
          <h5 align="center">Transcript Request Form</h5>
    <hr>
    <p align="justify">APPLICANT:  This form must be fully completed and accompany your post secondary academic records (transcripts, marks sheets, diplomas, etc.). ask the institution to complete the form and send an official copy of the academic records to POST GRADUATE SCHOOL UNIVERSITY OF JOS at the addressnoted above. (if these official documents are not prepared in English, an English translation must also be sent to POST GRADUATE SCHOOL UNIVERSITY OF JOS.) Useof this form will expedit the matching of ypur transcript to your file when the transcript and English translation (if necessary) are recieved by POST GRADUATE SCHOOL UNIVERSITY OF JOS</p>
    <hr/>
    <?php
		include_layout_template('transcriptform.php');
	?>
    
    </div>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>
<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/passwordreset.js"></script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
      <div class="modal-body ajax_data"></div>
      <div class="modal-footer">
         <a href="#" class="btn" id="close">Close</a>
 </div> 
 </div>

