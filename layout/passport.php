<?php
	$database = new MySQLDatabase();
	$session = new Session();

	$photo_details = Photograph::find_by_sql("SELECT * FROM photographs WHERE applicant_id=".$session->applicant_id);
	foreach($photo_details as $photo_detail):
	$photo_detail->image_id;
	$photo_detail->applicant_id;
	$photo_detail->filename;
	$photo_detail->type;
	$photo_detail->size;
	$photo_detail->caption;
	endforeach;
	
?>

<form action="" method="POST" id="passportupload" >
<?php if($photo_detail->applicant_id == $session->applicant_id){ ?>

<table align="center">
<tr><td align="center">
<span style="color: #09F; font-weight: bold; text-shadow: 1px 1px 4px #F89406"><i class="iconic-user"></i> <?php echo $photo_detail->caption; ?></span>
</td></tr>
<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
			<div class="control-group">
				<div class="controls">	
			    	<div>
			    		<div class="fileupload fileupload-new" data-provides="fileupload">
			                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                            <?php define('SEP', '/');
							$image_path = str_replace(DS, SEP, $photo_detail->image_path()); ?>
                            <img src="<?php echo $image_path; ?>" /></div>
			                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
			                <div>
			                  <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                              <input type="hidden" name="MAX_FILE_SIZE" value="250000"/>
			                  <input type="file" name="picture" id="picture" required /></span>
			                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
			                </div>
			            </div>
			   		</div>
			 	</div>
			 </div>
	 	</td>
	 </tr>
	</table>

<?php }else{ ?>
	<table align="center">
	<tr><td><div class="alert alert-error"><h4 style="text-align:center">Maximum Upload size is 250kb</h4></div></td></tr>
	<tr>
		<td>
			<div class="control-group">
				<div class="controls">	
			    	<div>
			    		<div class="fileupload fileupload-new" data-provides="fileupload">
			                <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="css/assets/img/AAAAAA&text=no+image.gif" /></div>
			               <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
			                <div>
			                  <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
			                  <input type="file" name="picture" id="picture" required /></span>
			                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
			                </div>
			            </div>
			   		</div>
			 	</div>
			 </div>
	 	</td>
	 </tr>
	</table>
   <?php }?>
	<br>
	<!--Save and Continue Button-->
	<div id="accept_terms">		
		<div align="center" class="control-group">
			  <div class="controls">  
				<button type="submit" class="btn btn-primary" id="passport_submit">Save</button>
				<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
		      </div>
		</div>
	</div>
	<!-- End of Save and Continue Button-->
</form>