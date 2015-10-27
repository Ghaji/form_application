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
		<div class="span9" >
			<h4>Developers Information Page</h4>
	        <hr>	
	 	</div>
	</div>
    <?php $credit = Credit::find_by_id(customDecrypt($_GET['id'])); ?>
    <form class="form-horizontal credit" id="credit">
					
					<div class="control-group">
						<label class="control-label">Fullname</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-user"></i></span>
								<input type="text" id="fullname" name="fullname" placeholder="Fullname" class="input-xlarge" value="<?php if(isset($credit->fullname)) echo $credit->fullname; ?>" readonly />
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label">Email</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input type="email" id="email" name="email" placeholder="Email" class="input-xlarge" value="<?php if(isset($credit->email)) echo $credit->email; ?>" readonly />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Phone</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input type="text" id="phone" name="phone" placeholder="Phone" class="input-xlarge" value="<?php if(isset($credit->phone)) echo $credit->phone; ?>" readonly />
							</div>
						</div>
					</div>
                    
                    <div class="control-group">
						<label class="control-label">Role</label>
						<div class="controls">
							<div class="input-prepend">
								<span class="add-on"><i class="icon-envelope"></i></span>
								<input type="text" id="phone" name="phone" placeholder="Phone" class="input-xlarge" value="<?php if(isset($credit->role)) echo $credit->role; ?>" readonly />
							</div>
						</div>
					</div>
					
					<div class="control-group">
						<div class="controls">	
					    	<div>
					    		<div class="fileupload fileupload-new" data-provides="fileupload">
					                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
						  <?php 
                          $passport_path = "documents" .DS. "credit_passports" .DS; ?>
                          <img src="<?php if(isset($credit->passport)) echo $passport_path.$credit->passport; ?>" /></div>
                          
					                
					            </div>
					   		</div>
					 	</div>
					 </div>
                     
                     
                     <div class="control-group">
						<label class="control-label">About You</label>
						<div class="controls">
							<div class="input-prepend">
				<textarea class="textarea" id="aboutyou" placeholder="...Detail information about you." name="aboutyou" style="width: 610px; height: 200px" disabled><?php if(isset($credit->aboutyou)) echo $credit->aboutyou; ?></textarea>
							</div>
						</div>
					</div>
					
					<!--Save Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">
							  	<a href="credit.php?id=<?php echo customEncrypt($credit->credit_id); ?>" class="btn btn-default" name="back" id="back">Back</a>
                             
						      </div>
						</div>
					</div>
					<!-- End of Save Button-->
				</form>
</div>
<!--The Main Content Here Please-->
<?php include_layout_template("footer.php"); ?>
</body>
</html>

<link href="css/assets/css/bootstrap-wysihtml5.css" rel="stylesheet">
<script src="js/wysihtml5-0.3.0.js"></script>
<!--<script src="../js/jquery.js"></script>
<script src="../css/assets/js/bootstrap.js"></script>-->
<script src="js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>
 
