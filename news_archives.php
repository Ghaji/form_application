<?php require_once("inc/initialize.php");
  //checks if user is logged in 
  $session->logout();
  
  $settings = new Settings();
  
  if($session->is_logged_in())
  {
    redirect_to('application_form.php');
  }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>
</head>
<body>
<?php include_layout_template("header.php"); ?>
<!-- beginnning of main content-->
<div class="container">
  <div class="row-fluid">
    <div class="span12" >
   <h4><a href="index.php"><i class="icon-home"></i> University of Jos Online Form Portal </a></h4>
        <hr>

        <h3><i class="icon-bullhorn"></i>Archives NEWS</h3>
        <!-- # New Content Here -->

          <?php include_layout_template('archives_news_detail.php'); ?>

        <!-- # End of News Content -->
        </div>
    
  </div>
</div>
<hr>
 <table width="60%">
                        
<?php include_layout_template("footer.php"); ?>

  

</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/log.js"></script>
 