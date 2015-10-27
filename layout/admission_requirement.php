<?php require_once("inc/initialize.php"); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php 
	require_once(LIB_PATH.DS.'javascript.php');
	require_once(LIB_PATH.DS.'css.php');
?>
</head>
<body>
<?php include_layout_template("header.php"); ?>

<!--The Main Content Here Please-->


<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span7" >
		<h4>Admission Requirements:</h4>
        <hr>	
Admission Requirement for the Following Programmes Below:
        <ol>
        <li>Diploma in Centre for Continuing Education (CCE) </li>
        <li>Diploma in Computer Science</li>
        <li>Diploma in Law</li>
        <li>Diploma in Psychology</li>
        <li>Diploma in Theathre Arts</li>
        <li><a href="javascript:;" id="showdchsinfo">Diploma in Christian Studies</a></li>
        <li><a href="javascript:;" id="showpginfo">Post-graduate</a></li>
        <li>PG APLORI</li>
        <li>PG and PG APLORI Reactivation</li>
        <li>Remedial Science</li>
        <li>Prelim French</li>
        <li><a href="javascript:;" id="showioeinfo">Institute of Education Programme</a></li>
        <li><a href="javascript:;" id="showptinfo">Part-time Programme</a></li>
        
        </ol>
        
		</div>
		
		<div class="span5">         
			<div class="create">
				
                <h5 align="center">Start Application</h5>
                <hr>
				<p class="pad">If you are a new applicant, you need to first create an account to obtain a <span class="label label-success">form number</span> which you will use to pay for your application online.</p>
                
                    <form class="form-horizontal" action="register.php" >
                      
                        <div class="control-group">
                        <label class="control-label" ></label>
                        <div class="controls">
                        
                          <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                      </div>
                    </form>
				<hr>
                <h5 align="center"><span class="label label-important">Application Close</span></h5>
			</div>
		
			
		</div>
	</div>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>

