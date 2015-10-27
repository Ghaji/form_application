<?php
	
	//$thesis_details = Thesis::find_by_id($session->applicant_id);
	$db_upload_files = new MySQLDatabase();
	$session = new Session();
	/*find file record for degree certificate*/
	$sql_deg_upload_file = "SELECT * FROM files WHERE applicant_id=" . $session->applicant_id;
	$result_deg_upload_file = Files::find_by_sql($sql_deg_upload_file);

?>
<h3 align="center">Upload Relevant Documents</h3>
<hr>
<form action="" method="POST" class="uploadfiles form-horizontal" id="uploadfiles" >		
	    
	<br ><br >
		
			<input type="hidden" value="2097152" name="MAX_FILE_SIZE" />
			<div class="row-fluid">
				<div class="span7 offset2">
                	<div class="control-group">
                    	<div class="controls">
                            <h4>Note:</h4>
                            <p>The following documents are compulsory</p>
                            <ul>
                                <li>First degree certificate</li>
                                <li>NYSC discharge certificate</li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    <div id="upload_docs">
                    	<?php
                    	if(!empty($result_deg_upload_file)){
							$counter = 1;
							foreach($result_deg_upload_file as $row):
							?>
								<div class="control-group">
									<label class="control-label" for="inputAdress">Document <?php echo $counter; ?></label>
									<div class="controls">
										<input type="file"  class="input-xlarge" value="" id="document_<?php echo $counter; ?>" name="document_<?php echo $counter; ?>"  />
                                    <span><?php echo $row->caption; ?> uploaded</span>
									</div>
								</div>
                            <?php
							$counter++;
							endforeach;
							$counter--;
                        } else {
							?>
							<div class="control-group">
								<label class="control-label" for="inputAdress">Document 1</label>
								<div class="controls">
									<span><?php if(isset($deg_filename)) echo $deg_filename; ?></span>
									<input type="file"  class="input-xlarge" value="<?php if(isset($deg_filename)) echo $deg_filename; ?>" id="document_1" name="document_1"  />
								</div>
							</div>
							
							<div class="control-group">
								<label class="control-label" for="inputAdress">Document 2</label>
								<div class="controls">
									<span><?php if(isset($trans_filename)) echo $trans_filename; ?></span>
									<input type="file"  class="input-xlarge" value="<?php if(isset($trans_filename)) echo $trans_filename; ?>" id="document_2" name="document_2"  />
									<span></span>
								</div>
							</div>
                        <?php
						$counter = 2;
                        }
						?>
                        </div>
					
                    	<!-- Number of Documents -->
						<input type="hidden" value="2" name="num_of_doc_rows" id="num_of_doc_rows" />
                        
                    <div>
                    	<div class="controls"> 
                        	<button type="button" class="btn btn-success" id="add_doc">Add Document</button>
                     		<button type="button" class="btn btn-danger" id="remove_doc" <?php if($counter == 2) echo 'disabled="true"' ?> >Remove Document</button>
                        </div>
                    </div>
                    <br />
                    
					<!--Save and Continue Button-->
					<div id="accept_terms">		
						<div class="control-group">
							  <div class="controls">  
								<button type="submit" class="btn btn-primary" id="upload_files_submit">Save</button>
								<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
						      </div>
						</div>
					</div>
					<!-- End of Save and Continue Button-->
			</div>
		</div>
</form>
<!-- End of form -->
	