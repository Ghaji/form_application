<?php
	$database = new MySQLDatabase();
	$session = new Session();

	$referees_details = Referees::find_by_sql("SELECT * FROM referees WHERE applicant_id=".$session->applicant_id);
	
?>
<form action="" method="POST" class="referees_details" >
	<table class="table table-hover">
	  <caption><h3>Referees</h3></caption>
	  <thead>
		<tr>
		  <th>S/N</th>
		  <th>Title</th>
		  <th>Full Name</th>
		  <th>Email</th>
		  <th>Phone Number</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php 
	  	if(!empty($referees_details))
			{
				$counter = 1;
				foreach($referees_details as $referees_data)
				{
					$referee_title[$counter] = $referees_data->referee_title_id;
					$referee_name[$counter] = $referees_data->referee_name;
					$referee_email[$counter] = $referees_data->referee_email;
					$referee_phone_number[$counter] = $referees_data->referee_phone_number;
					$referee_id[$counter] = $referees_data->referees_id;
					$counter++;
				}
			}
			
		for ($x=1; $x<=3; $x++) {
			$reference_title_id = "reference_title_id_$x";
			$referees_name = "referees_name_$x";
			$referees_email = "referees_email_$x";
			$referees_phone_number = "referees_phone_number_$x";
			$referee_id_field = 'referees_id_'.$x;
			
	   ?>
			  <tr>
			  <td><?php echo $x ?></td>
			  <td>
              <!-- title for 1st refree -->
              <?php
				$sql_title = "SELECT * FROM title";
				$result = $database->query($sql_title);
				?>
                <?php
                	if(isset($referee_id[$x]))
					{
						echo '<input type="hidden" name="'.$referee_id_field.'" value="'.$referee_id[$x].'"/>';
					}
				
				?>
                
			  	<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-chevron-down"></i></span>
							<select class="input-small" name="<?php echo $reference_title_id ?>" id="<?php echo $reference_title_id ?>" >
								<option value="">--Title--</option>
                           
							
                            
                            
                            <?php
                            while($row = $database->fetch_array($result))
							{
								if(isset($referee_title[$x]) && $row['title_id'] == $referee_title[$x])
								{
									echo '<option selected="selected" value="'. $row['title_id'] .'">'.$row['title_name'].'</option>'; 
								}
								else
								{
									echo '<option value="'. $row['title_id'] .'">'.$row['title_name'].'</option>'; 
								}
	 						}
							?>
                            </select>
                            
						</div>
					</div>
				</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span>
							<input type="text" class="input-medium" value="<?php if(isset($referee_name[$x])) echo $referee_name[$x]; ?>" name="<?php echo $referees_name ?>" id="<?php echo $referees_name ?>" placeholder="Surname First Name Middle Name" />
						</div>
					</div>
				</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-envelope"></i></span>
							<input type="email" class="input-medium" value="<?php if(isset($referee_email[$x])) echo $referee_email[$x]; ?>" id="<?php echo $referees_email ?>" name="<?php echo $referees_email ?>" placeholder="Enter email"  />
						</div>
					</div>
				</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-hdd"></i></span>
							<input type="text" class="input-medium" value="<?php if(isset($referee_phone_number[$x])) echo $referee_phone_number[$x]; ?>" id="<?php echo $referees_phone_number ?>" name="<?php echo $referees_phone_number ?>" maxlength="15" placeholder="Enter phone number"  />
							<input type="hidden" id="<?php echo 'hr_'.$x; ?>" name="<?php echo 'referees_id_'.$x; ?>" value="" />
						</div>
					</div>
				</div>
			  </td>
			</tr>
		<?php
		}
		?>
	  </tbody>
	</table>
	
	<br>
	
	<!--Save and Continue Button-->
	<div id="accept_terms">		
		<div align="center" class="control-group">
			  <div class="controls">  
				<button type="submit" class="btn btn-primary" id="referees_details_submit">Save</button>
				<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
		      </div>
		</div>
	</div>
	<!-- End of Save and Continue Button-->
</form>
<!-- End of form -->
  