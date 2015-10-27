<?php
	$db_emp = new MySQLDatabase();
	$session = new Session();
	$sql_emp = "SELECT * FROM employment WHERE applicant_id=" . $session->applicant_id;
	$result_emp = Employment::find_by_sql($sql_emp);
	//print_r($result_emp);
?>
<form action="" method="POST" class="employment_details" >

	<!-- Beginning of Employment Detais -->
	<table class="table table-hover">
	  <caption><h3>Employer Details</h3></caption>
	  <thead>
		<tr>
		   <th>S/N</th>
		  <th>Employer Name</th>
		  <th>Year of Employment</th>
		 <th>
		 	<div class="control-group"> 
				<div class="controls">
		 			Employer Address
		 		</div>
		 	</div>
		 </th>
		</tr>
	  </thead>
	  <tbody id="details_of_employment">
	  		<?php
	  			if(empty($result_emp)) {
	  		?>
	  				<tr>
					  	<td>1</td>
					  <td>
					  	<div class="control-group">
							<input type="text" class="input-xlarge" value="" id="employer_1" name="employer_1" placeholder="Employer" />
					  	</div>
					  </td>
					  <td>
					  	<div class="control-group">
							<input type="text" class="input-small" maxlength="4" value="" id="employment_year_1" name="employment_year_1" placeholder="Year"  />
					  	</div>
					  </td>
					  <td>
						<div class="control-group"> 
							<div class="controls">
								<textarea rows="4" class="input-xlarge" name="employer_address_1" id="employer_address_1"></textarea>
							</div>
						</div>
					  </td>
					
					</tr>
			<?php
	  			} else {
		  			foreach($result_emp as $row):
						if(!empty($row->employment_detail_one)) {
							$emp = unserialize($row->employment_detail_one);		
	  		?>
						  <tr>
						  	<td>1</td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-xlarge" value="<?php if(isset($emp['employer'])) echo $emp['employer']; ?>" id="employer_1" name="employer_1" placeholder="Employer" />
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php if(isset($emp['year'])) echo $emp['year']; ?>" id="employment_year_1" name="employment_year_1" placeholder="Year"  />
						  	</div>
						  </td>
						  <td>
							<div class="control-group"> 
								<div class="controls">
									<textarea rows="4" class="input-xlarge" name="employer_address_1" id="employer_address_1"><?php if(isset($emp['address'])) echo $emp['address']; ?></textarea>
								</div>
							</div>
						  </td>
						
						</tr>
			<?php
						}
						
						if(!empty($row->employment_detail_two)) {
							$emp = unserialize($row->employment_detail_two);		
	  		?>
						  <tr>
						  	<td>2</td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-xlarge" value="<?php if(isset($emp['employer'])) echo $emp['employer']; ?>" id="employer_2" name="employer_2" placeholder="Employer" />
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php if(isset($emp['year'])) echo $emp['year']; ?>" id="employment_year_2" name="employment_year_2" placeholder="Year"  />
						  	</div>
						  </td>
						  <td>
							<div class="control-group"> 
								<div class="controls">
									<textarea rows="4" class="input-xlarge" name="employer_address_2" id="employer_address_2"><?php if(isset($emp['address'])) echo $emp['address']; ?></textarea>
								</div>
							</div>
						  </td>
						
						</tr>
			<?php
						}
						if(!empty($row->employment_detail_three)) {
							$emp = unserialize($row->employment_detail_three);		
	  		?>
						  <tr>
						  	<td>3</td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-xlarge" value="<?php if(isset($emp['employer'])) echo $emp['employer']; ?>" id="employer_3" name="employer_3" placeholder="Employer" />
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php if(isset($emp['year'])) echo $emp['year']; ?>" id="employment_year_3" name="employment_year_3" placeholder="Year"  />
						  	</div>
						  </td>
						  <td>
							<div class="control-group"> 
								<div class="controls">
									<textarea rows="4" class="input-xlarge" name="employer_address_3" id="employer_address_3"><?php if(isset($emp['address'])) echo $emp['address']; ?></textarea>
								</div>
							</div>
						  </td>
						
						</tr>
			<?php
						}
						
						if(!empty($row->employment_detail_four)) {
							$emp = unserialize($row->employment_detail_four);		
	  		?>
						  <tr>
						  	<td>4</td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-xlarge" value="<?php if(isset($emp['employer'])) echo $emp['employer']; ?>" id="employer_4" name="employer_4" placeholder="Employer" />
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php if(isset($emp['year'])) echo $emp['year']; ?>" id="employment_year_4" name="employment_year_4" placeholder="Year"  />
						  	</div>
						  </td>
						  <td>
							<div class="control-group"> 
								<div class="controls">
									<textarea rows="4" class="input-xlarge" name="employer_address_4" id="employer_address_4"><?php if(isset($emp['address'])) echo $emp['address']; ?></textarea>
								</div>
							</div>
						  </td>
						
						</tr>
			<?php
						}
		  			endforeach;
				}
	  		?>
	  </tbody>
	</table>
	<!-- End of Employment Detais -->
			
	<!-- Number of Employment Rows -->
	<input type="hidden" value="" name="num_of_emp_rows" id="num_of_emp_rows" />
	
	<!-- Beginning of Employment Details Add and Remove Button -->
	<div align="center" class="control-group">
		<div class="controls"> 
			<button type="button" class="btn btn-danger" id="remove_employment_detail" disabled>Remove Employment Detail</button> 
			<button type="button" class="btn btn-primary" id="add_employment_details">Add Employment Details</button>
		</div>	
	</div>
	<!-- End of Employment Detais Add and Remove Button -->
	<br ><br >
	
	<!--Save and Continue Button-->
	<div id="accept_terms">		
		<div align="center" class="control-group">
			  <div class="controls">  
				<button type="submit" class="btn btn-primary" id="employment_details_submit">Save</button>
				<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
		      </div>
		</div>
	</div>
<!-- End of Save and Continue Button-->
</form>
<!-- End of form -->
