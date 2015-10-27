<?php require_once("inc/initialize.php");
if(isset($_GET['id'])) { 
 $get_id = customDecrypt($_GET['id']);
	}
  else{redirect_to('index.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>
<style type="text/css">
@media print{

  .noprint{display:none;}
}
</style>
</head>
<body>
<?php include_layout_template("header.php"); ?>
<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span12" >
		<h4> <i class="icon-home"> </i> <a href="index.php"> Welcome to University of Jos Online Form Portal</a></h4>
        <hr>

      	<h3>Admission Requrement</h3>
        <!-- # New Content Here -->


           <?php 
  
             $sql = "SELECT * FROM requirements WHERE `id`=" . $get_id;

               $require_contents = Requirements::find_by_sql($sql);
               $require_content = array_shift($require_contents);
             ?>
   
    <p>
        
          <h4> <i class="icon-certificate"> </i> <?php echo $require_content->name; ?></h4><br>
           <?php echo $require_content->content; ?>
           <table width="60%">
                        <tr><td>
                              <a href="javascript:history.go(-1)" class="text-warning pull-left btn noprint">
                             <i class="icon-arrow-left"></i> Back
                             </a> 
                            </td>
                            <td align="right">
                             <a href='#?id=<?php echo $get_id; ?>'target="blank" class="text-success pull-left btn printbtn noprint" align="center">
                               Print <i class="icon-print"></i> 
                            </a>
                          </td></tr>
                      </table>
                          </div> 
    </p>
    
        <!-- # End of News Content -->
          
        	</div>
		
	</div>
</div>
<hr>
<?php include_layout_template("footer.php"); ?>

  

</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/log.js"></script>
<script type="text/javascript">
  jQuery('.printbtn').click(function() {
    window.print();
  });
</script>
