<?php
	$session = new Session();
	
	$thesis_details = Thesis::find_by_id($session->applicant_id);
?>
<h3 align="center">Proposed Topic Of Thesis Details</h3>
<hr>

<form action="" method="POST" class="proposed_thesis_details form-horizontal" id="proposed_thesis_details" >		
	    
	<br ><br >
		
			
			<div class="row-fluid">
				<div class="span12">
			
			<!--Write Briefly on Your Proposed Field of Special Interst-->
			<div class="control-group">
				<label class="control-label" for="inputAdress">Write Briefly on Your Proposed Field of Special Interest</label> 
				<div class="controls">
					<textarea  class="textarea" style="width: 610px; height: 100px" id="proposed_field_brief" name="proposed_field_brief"><?php if(isset($thesis_details->comment_on_field)) echo $thesis_details->comment_on_field; ?></textarea>
				</div>
			</div>
            
          <div class="control-group">
				
				<div class="controls">
					<p style="font-weight:bold;">Note: This section is compulsory for Ph.D applicants</p>
				</div>
			</div>
            
         
            
            <div class="control-group">
            	<label class="control-label" for="inputAdress">Proposed Topic</label>
                <div class="controls">
<textarea class="textarea" placeholder="Proposed Topic of Thesis..." id="proposed_thesis_topic" name="proposed_thesis_topic" style="width: 610px; height: 50px"><?php if(isset($thesis_details->thesis_topic)) echo $thesis_details->thesis_topic; ?></textarea>
                
               	</div>
			</div>
            
            <div class="control-group">
				<label class="control-label" for="inputAdress">Type Thesis Proposal or Attach a file</label> 
				<div class="controls">
                <textarea class="textarea" id="thesis_proposal" name="thesis_proposal" style="width: 610px; height: 200px"><?php if(isset($thesis_details->proposal_on_thesis)) echo $thesis_details->proposal_on_thesis; ?></textarea>
				</div>
			</div>
            
            <div class="control-group">
            	<label class="control-label" for="inputAdress">Attach Thesis Proposal</label>
                <div class="controls">
               		<span><?php if(isset($thesis_details->thesis_attachment)) echo $thesis_details->thesis_attachment; ?></span>
					<input type="hidden" name="MAX_FILE_SIZE" value="2097152"/>
                    <input type="file"  class="input-xlarge" value="" id="attach_thesis_proposal" name="attach_thesis_proposal"  />
               	</div>
			</div>
			
			<!--Save and Continue Button-->
			<div id="accept_terms">		
				<div class="control-group">
					  <div class="controls">  
						<button type="submit" class="btn btn-primary" id="proposed_thesis_details_submit">Save</button>
						<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
				      </div>
				</div>
			</div>
			<!-- End of Save and Continue Button-->
			</div>
		</div>
</form>
<link href="../css/assets/css/bootstrap-wysihtml5.css" rel="stylesheet">
<script src="../js/wysihtml5-0.3.0.js"></script>
<script src="../js/jquery.js"></script>
<script src="../css/assets/js/bootstrap.js"></script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>


<!-- End of form -->
	