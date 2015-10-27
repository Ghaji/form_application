<?php
	$db_academic = new MySQLDatabase();
	$session = new Session();
	$sql_high_insti = "SELECT * FROM higher_institutions WHERE applicant_id=" . $session->applicant_id;
	$result_high_insti = HigherInstitutions::find_by_sql($sql_high_insti);
	
	$applicant_details = User::find_by_sql("SELECT student_status FROM personal_details WHERE applicant_id='".$session->applicant_id."'");

	foreach($applicant_details as $applicant)
	{
		$applicant->student_status;
	}
?>
<h3 align="center">Academic Qualification</h3>
<hr>

<form action="" method="POST" class="academic_qualification" >
<input type="hidden" name="applicant_status" value="<?php echo $applicant->student_status; ?>" />
	<!-- Beginning of Tertiary Institution -->
    
    <?php if($applicant->student_status == "PGA"){ ?>
    
	<table class="table table-hover">
		<caption><h4>Tertiary Institution</h4></caption>
		<thead>
			<tr>
			  	<th>Institution Name</th>
			  	<th>Degree Earned</th>
			  	<th>Course of Study</th>
			  	<th>Class of Degree</th>
				<th>From</th>
				<th>To</th>
				<th>CGPA</th>
			</tr>
		</thead>
		<tbody id="tetiary_institutions">
			<?php
				if(!empty($result_high_insti)) {
					
				 	$i = 1;
					foreach($result_high_insti as $row):
					
						$name_ID = "tetiary_institution_name_".$i;
						$degree_ID = "tetiary_institution_degree_".$i;
						$course_ID = "tetiary_institution_course_".$i;
						$class_ID = "tetiary_institution_class_".$i;
						$from_ID = "tetiary_institution_from_".$i;
						$to_ID = "tetiary_institution_to_".$i;
						$cgpa_ID = "tetiary_institution_cgpa_".$i;
						$high_id = "high_id_".$i;
			?>
					<tr>
					  	<td>
					  		<div class="control-group">
								<input type="text" value="<?php echo $row->institution_name; ?>" id="<?php echo $name_ID; ?>" name="<?php echo $name_ID; ?>" placeholder="Institution Name" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
					  			<input type="text" class="input-small" value="<?php echo $row->degree_earned; ?>" id="<?php echo $degree_ID; ?>" name="<?php echo $degree_ID; ?>" placeholder="Degree" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" value="<?php echo $row->course_of_study; ?>" id="<?php echo $course_ID; ?>" name="<?php echo $course_ID; ?>" placeholder="Course of Study" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" value="<?php echo $row->class_of_degree; ?>" id="<?php echo $class_ID; ?>" name="<?php echo $class_ID; ?>" placeholder="Class of Degree" />
							</div>				
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php echo $row->year_of_attendance; ?>" id="<?php echo $from_ID; ?>" name="<?php echo $from_ID; ?>" placeholder="Year" >
							</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="<?php echo $row->graduation_year; ?>" id="<?php echo $to_ID; ?>" name="<?php echo $to_ID; ?>" placeholder="Year" >
							</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
					  			<input type="text" class="input-small" value="<?php echo $row->cgpa; ?>" id="<?php echo $cgpa_ID; ?>" name="<?php echo $cgpa_ID; ?>" placeholder="CGPA" >
							</div>
					  	</td>
					  	<!-- higher institution id -->
						<input type="hidden" value="<?php echo $row->high_id; ?>" name="<?php echo $high_id; ?>" id="<?php echo $high_id; ?>" />
					</tr>
			<?php
						$i++;
					endforeach;
				} else {
			?>
					<tr>
					  	<td>
					  		<div class="control-group">
								<input type="text" value="" id="tetiary_institution_name_1" name="tetiary_institution_name_1" placeholder="Institution Name" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" value="" id="tetiary_institution_degree_1" name="tetiary_institution_degree_1" placeholder="Degree" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" value="" id="tetiary_institution_course_1" name="tetiary_institution_course_1" placeholder="Course of Study" />
							</div>
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" value="" id="tetiary_institution_class_1" name="tetiary_institution_class_1" placeholder="Class of Degree" />
							</div>				
						</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="" id="tetiary_institution_from_1" name="tetiary_institution_from_1" placeholder="Year" >
							</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
								<input type="text" class="input-small" maxlength="4" value="" id="tetiary_institution_to_1" name="tetiary_institution_to_1" placeholder="Year" >
							</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
					  			<input type="text" class="input-small" value="" id="tetiary_institution_cgpa_1" name="tetiary_institution_cgpa_1" placeholder="CGPA" >
							</div>
					  	</td>
					  	<!-- higher institution id -->
						<input type="hidden" value="" name="high_id_1" id="high_id_1" />
					</tr>
			<?php	
				}
			?>
		</tbody>
	</table>
   
	
	<!-- Number of Tetiary Institution Rows -->
	<input type="hidden" value="<?php if(isset($i)) { echo $i - 1;} else { echo 1;} ?>" name="num_of_high_insti_rows" id="num_of_high_insti_rows" />
	<!-- End of Tetiary Institution -->
	
	<!-- Beginning of Tetiary Institution Add and Remove Buttons -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-danger" id="remove_tetiary_institution" disabled>Remove Tetiary Institution</button>
			<button type="button" class="btn btn-primary" id="add_tetiary_institution">Add Tetiary Institution</button>
		</div>	
	</div>
	<!-- End of Tetiary Institution Add and Remove Buttons -->
	<br ><br >
	<hr>
     <?php } ?>
	<!-- Beginning of Secondary School -->
	<table class="table table-hover">
		<caption><h4>Secondary School</h4></caption>
		<thead>
			<tr>
			  	<th>School Name</th>
			  	<th>School Address</th>
				<th>From</th>
				<th>To</th>
			</tr>
		</thead>
		<tbody id="secondary_schools">
			<?php
				$sql_school = "SELECT * FROM secondary_school_attended WHERE applicant_id=" . $session->applicant_id;
				$result_school = SecondarySchoolUser::find_by_sql($sql_school);
				//print_r($result_school);
				
				if(!empty($result_school)) {
					
				 	$k = 1;
					foreach($result_school as $row):
						$name = "secondary_school_name_".$k;
						$address = "secondary_school_address_".$k;
						$from = "secondary_school_from_".$k;
						$to = "secondary_school_to_".$k;
						$sch_id = 'sch_id_'.$k;
			?>
						<tr>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="<?php echo $row->school_name; ?>" id="<?php echo $name; ?>" name="<?php echo $name; ?>" placeholder="School Name" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="<?php echo $row->school_address; ?>" id="<?php echo $address; ?>" name="<?php echo $address; ?>" placeholder="School Address" />
								</div>
							</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" maxlength="4" class="input-small" value="<?php echo $row->from_year; ?>" id="<?php echo $from; ?>" name="<?php echo $from; ?>" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" maxlength="4" class="input-small" value="<?php echo $row->to_year; ?>" id="<?php echo $to; ?>" name="<?php echo $to; ?>" placeholder="Year" >
								</div>
						  	</td>
						  	<!-- Secondary School id -->
							<input type="hidden" value="<?php echo $row->school_id; ?>" name="<?php echo $sch_id; ?>" id="<?php echo $sch_id; ?>" />
						</tr>
			<?php
						$k++;
					endforeach;
				} else {
			?>
						<tr>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="" id="secondary_school_name_1" name="secondary_school_name_1" placeholder="School Name" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="" id="secondary_school_address_1" name="secondary_school_address_1" placeholder="School Address" />
								</div>
							</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" class="input-small" maxlength="4" value="" id="secondary_school_from_1" name="secondary_school_from_1" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" class="input-small" maxlength="4" value="" id="secondary_school_to_1" name="secondary_school_to_1" placeholder="Year" >
								</div>
						  	</td>
						  	<!-- Secondary School id -->
							<input type="hidden" value="" name="sch_id_1" id="sch_id_1" />
						</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<!-- Number of Other Secondary School Rows -->
	<input type="hidden" value="<?php if(isset($k)) { echo $k - 1;} else { echo 1;} ?>" name="num_of_sec_school_rows" id="num_of_sec_school_rows" />
	<!-- End of Secondary School -->
	
	<!-- Beginning of Secondary School Add Button -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-danger" id="remove_secondary_school" disabled>Remove Secondary School</button>
			<button type="button" class="btn btn-success" id="add_secondary_school">Add Secondary School</button>
		</div>	
	</div>
	<!-- End of Secondary School Add Button -->
	<br ><br >
	<hr>
	
	<!-- Beginning of O-level details -->
	<div class="row-fluid">
		<h4 align="center">O Level Details</h4>
		<?php
			$sql_olevel = "SELECT * FROM o_level_details WHERE applicant_id=" . $session->applicant_id;
			$result_olevel = Olevel::find_by_sql($sql_olevel);
			//print_r($result_olevel);
			
			$no_arr = array();
			$year_arr = array();
			$type_arr = array();
			$centre_arr = array();
			$olevel_detail = array();
			$olevels = array();	
			if(!empty($result_olevel)) {
				
			 	$o = 1;
				foreach($result_olevel as $row):
					$no_arr[$o] = 'exam_no_'.$o;
					$year_arr[$o] = 'exam_year_'.$o;
					$type_arr[$o] = 'exam_type_'.$o;
					$centre_arr[$o] = 'exam_centre_'.$o;
					
					$olevel_detail[$o] = $row;
					$olevels[$o] = unserialize($row->subject_grade);
					
					//print_r($olevel_detail[$o]->o_level_id);
					//echo "<br>";
					$o++;
				endforeach;
			}
			
			$sql_exam = "SELECT * FROM exam_id";
			$result_exam = $db_academic->query($sql_exam);
			
			//print_r($olevel_detail[1]->exam_type_id);
							
			/*First row from database*/
			if(!empty($olevel_detail[1])) {
		?>
			<div class="span6">
			<!-- Examination Number -->
			<div class="control-group">
				<label for="inputFormId"><b>Examination Number</b></label>
				<div class="controls"> 
					<input type="text" class="input-xlarge" value="<?php echo $olevel_detail[1]->exam_number; ?>" name="<?php echo $no_arr[1]; ?>" id="<?php echo $no_arr[1]; ?>" placeholder="Examination Number" />
				</div>
			</div>
			
			<!-- Year -->
			<div class="control-group">
			    <label class="control-label" for="inputTitle"><b>Year</b></label>
				<div class="controls">
	                <input type="text" maxlength="4" value="<?php echo $olevel_detail[1]->exam_year; ?>" class="input-small" name="<?php echo $year_arr[1]; ?>" id="<?php echo $year_arr[1]; ?>" placeholder="Year" >
				</div>
			</div>
			
			<!-- Examination Type -->
			<div class="control-group">
				<label class="control-label" for="inputFormId"><b>Examination Type</b></label> 
				<div class="controls">
					<select class="input-medium" name="<?php echo $type_arr[1]; ?>" id="<?php echo $type_arr[1]; ?>" >
						<option value="">...</option>
						<?php
						    while($record = $db_academic->fetch_array($result_exam))
							{
								if($record['exam_type_id'] == $olevel_detail[1]->exam_type_id) 
								{
									echo '<option selected="selected" value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>';
								} else 
								{
									echo '<option value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>'; 
								}
							}
						?>
					</select>
				</div>
			</div>
			
			<!-- Examination Centre -->
			<div class="control-group">
				<label class="control-label" for="inputFormId"><b>Examination Centre Number</b></label> 
				<div class="controls">
					<input type="text" class="input-xlarge" value="<?php echo $olevel_detail[1]->exam_centre; ?>" name="<?php echo $centre_arr[1]; ?>" id="<?php echo $centre_arr[1]; ?>" placeholder="Examination Centre" />
				</div>
			</div>
			<!-- Beginning of O-level -->
			<table class="table-hover">
				<thead>
					<tr>
					  	<th>Subject</th>
					  	<th>Grade</th>
					</tr>
				</thead>
				<tbody id="o_level_1">
					 <?php
					 	$z = 1;
						$max = sizeof($olevels[1]) / 2;
						while ($z<=$max) {
							$o_level_1_subject_id = "o_level_1_subject_$z";
							$o_level_1_grade_id = "o_level_1_grade_$z";
							
							$sql_grade = "SELECT * FROM exam_grade";
							$result_grade = $db_academic->query($sql_grade);
							
							$sql_subject = "SELECT * FROM exam_subject where visible = 1";
							$result_subject = $db_academic->query($sql_subject);
							
							//print_r($olevels[1]["o_level_1_grade_$z"]);
							//echo "<br>";
					   ?>
					<tr>
					  	<td>
					  		<div class="control-group">
					  			<select class="input-xlarge" name="<?php echo $o_level_1_subject_id ?>" id="<?php echo $o_level_1_subject_id ?>" >
									<option value="">...</option>
									<?php
									    while($record = $db_academic->fetch_array($result_subject))
										{	
											
											if($record['subject_id'] == $olevels[1]["o_level_1_subject_$z"]) 
											{
												echo '<option selected="selected" value="'. $record['subject_id'] .'">'.ucwords($record['subject_name']).'</option>';
											} else 
											{
												echo '<option value="'. $record['subject_id'] .'">'.ucwords($record['subject_name']).'</option>';  
											}
										
										}
									?>
								</select>
					  		</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
								<select class="input-small" name="<?php echo $o_level_1_grade_id ?>" id="<?php echo $o_level_1_grade_id ?>" >
									<option value="">...</option>
									<?php
									    while($record = $db_academic->fetch_array($result_grade))
										{
											if($record['grade_id'] == $olevels[1]["o_level_1_grade_$z"]) 
											{
												echo '<option selected="selected" value="'. $record['grade_id'] .'">'.$record['grade'].'</option>';
											} else 
											{
												echo '<option value="'. $record['grade_id'] .'">'.$record['grade'].'</option>'; 
											}
										}
									?>
								</select>
							</div>
					  	</td>
					</tr>
					<?php
							$z++;
						}
					?>
				</tbody>
			</table>
			<br >
			<!-- Number of O Level subjects and grade -->
	        <input type="hidden" value="<?php if(isset($z)) { echo $z - 1;} else { echo 1;} ?>" name="num_of_o_level1" id="num_of_o_level1" />
			<!-- exam_id -->
			<input type="hidden" value="<?php echo $olevel_detail[1]->o_level_id; ?>" name="o_level1_id" id="o_level1_id" />
			<!-- End of O-level -->
			<!-- Beginning of O-level details Add Button -->
			<div class="control-group">
				<div class="controls">  
					<button type="button" class="btn btn-danger" id="remove_o_level_1" disabled>Remove O Level</button>
					<button type="button" class="btn btn-inverse" id="add_o_level_1">Add O Level</button>
				</div>	
			</div>
			<!-- End of O-level details Add Button -->
		</div>
		<?php
			} else {
			
		?>
				<div class="span6">
					<!-- Examination Number -->
					<div class="control-group">
						<label for="inputFormId"><b>Examination Number</b></label>
						<div class="controls"> 
							<input type="text" class="input-xlarge" value="" name="exam_no_1" id="exam_no_1" placeholder="Examination Number" />
						</div>
					</div>
					
					<!-- Year -->
					<div class="control-group">
					    <label class="control-label" for="inputTitle"><b>Year</b></label>
						<div class="controls">
			                <input type="text" maxlength="4" value="" class="input-small" name="exam_year_1" id="exam_year_1" placeholder="Year" >
						</div>
					</div>
					
					<!-- Examination Type -->
					<div class="control-group">
						<label class="control-label" for="inputFormId"><b>Examination Type</b></label> 
						<div class="controls">
							<select class="input-medium" name="exam_type_1" id="exam_type_1" >
								<option value="">...</option>
								<?php
								    while($record = $db_academic->fetch_array($result_exam))
									{
										echo '<option value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>'; 
									}
								?>
							</select>
						</div>
					</div>
					
					<!-- Examination Centre -->
					<div class="control-group">
						<label class="control-label" for="inputFormId"><b>Examination Centre Number</b></label> 
						<div class="controls">
							<input type="text" class="input-xlarge" value="" name="exam_centre_1" id="exam_centre_1" placeholder="Examination Centre" />
						</div>
					</div>
					<!-- Beginning of O-level -->
					<table class="table-hover">
						<thead>
							<tr>
							  	<th>Subject</th>
							  	<th>Grade</th>
							</tr>
						</thead>
						<tbody id="o_level_1">
							 <?php
							 	$z = 1;
								while ($z<=6) {
									$o_level_1_subject_id = "o_level_1_subject_$z";
									$o_level_1_grade_id = "o_level_1_grade_$z";
									
									$sql_grade = "SELECT * FROM exam_grade";
									$result_grade = $db_academic->query($sql_grade);
									
									$sql_subject = "SELECT * FROM exam_subject";
									$result_subject = $db_academic->query($sql_subject);
							   ?>
							<tr>
							  	<td>
							  		<div class="control-group">
							  			<select class="input-xlarge" name="<?php echo $o_level_1_subject_id ?>" id="<?php echo $o_level_1_subject_id ?>" >
											<option value="">...</option>
											<?php
											    while($record = $db_academic->fetch_array($result_subject))
												{	
													echo '<option value="'. $record['subject_id'] .'">'.$record['subject_name'].'</option>'; 
												}
											?>
										</select>
									</div>
							  	</td>
							  	<td>
							  		<div class="control-group">
										<select class="input-small" name="<?php echo $o_level_1_grade_id ?>" id="<?php echo $o_level_1_grade_id ?>" >
											<option value="">...</option>
											<?php
											    while($record = $db_academic->fetch_array($result_grade))
												{	
													echo '<option value="'. $record['grade_id'] .'">'.$record['grade'].'</option>'; 
												}
											?>
										</select>
									</div>
							  	</td>
							</tr>
							<?php
									$z++;
								}
							?>
						</tbody>
					</table>
					<br >
					<!-- Number of O Level subjects and grade -->
			        <input type="hidden" value="<?php if(isset($z)) { echo $z - 1;} else { echo 1;} ?>" name="num_of_o_level1" id="num_of_o_level1" />
					<!-- exam_id -->
					<input type="hidden" value="" name="o_level1_id" id="o_level1_id" />
					<!-- End of O-level -->
					
					<!-- Beginning of O-level details Add Button -->
					<div class="control-group">
						<div class="controls">  
							<button type="button" class="btn btn-danger" id="remove_o_level_1" disabled>Remove O Level</button>
							<button type="button" class="btn btn-inverse" id="add_o_level_1">Add O Level</button>
						</div>	
					</div>
					<!-- End of O-level details Add Button -->
				</div>
		<?php
			}

			$sql_exam = "SELECT * FROM exam_id";
			$result_exam = $db_academic->query($sql_exam);
			
			/*Second Sitting (row) from database*/
			if(!empty($olevel_detail[2])) {
		?>
				<div id="sitting_2" class="span5">
					<!-- Examination Number -->
					<div class="control-group">
						<label for="inputFormId"><b>Examination Number</b></label>
						<div class="controls"> 
							<input type="text" class="input-xlarge" value="<?php echo $olevel_detail[2]->exam_number; ?>" name="<?php echo $no_arr[2]; ?>" id="<?php echo $no_arr[2]; ?>" placeholder="Examination Number" />
						</div>
					</div>
					
					<!-- Year -->
					<div class="control-group">
					    <label class="control-label" for="inputTitle"><b>Year</b></label>
						<div class="controls">
			                <input type="text" maxlength="4" value="<?php echo $olevel_detail[2]->exam_year; ?>" class="input-small" name="<?php echo $year_arr[2]; ?>" id="<?php echo $year_arr[2]; ?>" placeholder="Year" >
						</div>
					</div>
					
					<!-- Examination Type -->
					<div class="control-group">
						<label class="control-label" for="inputFormId"><b>Examination Type</b></label> 
						<div class="controls">
							<select class="input-medium" name="<?php echo $type_arr[2]; ?>" id="<?php echo $type_arr[2]; ?>" >
								<option value="">...</option>
								<?php
								    while($record = $db_academic->fetch_array($result_exam))
									{
										if($record['exam_type_id'] == $olevel_detail[2]->exam_type_id) 
										{
											echo '<option selected="selected" value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>';
										} else 
										{
											echo '<option value="'. $record['exam_type_id'] .'">'.$record['exam_name'].'</option>'; 
										}
									}
								?>
							</select>
						</div>
					</div>
					
					<!-- Examination Centre -->
					<div class="control-group">
						<label class="control-label" for="inputFormId"><b>Examination Centre Number</b></label> 
						<div class="controls">
							<input type="text" class="input-xlarge" value="<?php echo $olevel_detail[2]->exam_centre; ?>" name="<?php echo $centre_arr[2]; ?>" id="<?php echo $centre_arr[2]; ?>" placeholder="Examination Centre" />
						</div>
					</div>
				<!-- Beginning of O-level -->
				<table class="table-hover">
					<thead>
						<tr>
						  	<th>Subject</th>
						  	<th>Grade</th>
						</tr>
					</thead>
					<tbody id="o_level_2">
						<?php
							$num_of_sitting = 2;
						 	$x = 1;
							$max = sizeof($olevels[2]) / 2;
							while ($x<=$max) {
								$o_level_2_subject_id = "o_level_2_subject_$x";
								$o_level_2_grade_id = "o_level_2_grade_$x";
								
								$sql_grade = "SELECT * FROM exam_grade";
								$result_grade = $db_academic->query($sql_grade);
								
								$sql_subject = "SELECT * FROM exam_subject where visible = 1";
								$result_subject = $db_academic->query($sql_subject);
						   ?>
						<tr>
						  	<td>
						  		<div class="control-group">
						  			<select class="input-xlarge" name="<?php echo $o_level_2_subject_id; ?>" id="<?php echo $o_level_2_subject_id; ?>" >
										<option value="">...</option>
										<?php
										    while($record = $db_academic->fetch_array($result_subject))
											{
												if($record['subject_id'] == $olevels[2]["o_level_2_subject_$x"]) 
												{
													echo '<option selected="selected" value="'. $record['subject_id'] .'">'.$record['subject_name'].'</option>';
												} else 
												{
													echo '<option value="'. $record['subject_id'] .'">'.$record['subject_name'].'</option>'; 
												}	
											}
										?>
									</select>
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
								<select class="input-small" name="<?php echo $o_level_2_grade_id ?>" id="<?php echo $o_level_2_grade_id ?>" >
									<option value="">...</option>
									<?php
									    while($record = $db_academic->fetch_array($result_grade))
										{
											if($record['grade_id'] == $olevels[2]["o_level_2_grade_$x"]) 
											{
												echo '<option selected="selected" value="'. $record['grade_id'] .'">'.$record['grade'].'</option>';
											} else 
											{
												echo '<option value="'. $record['grade_id'] .'">'.$record['grade'].'</option>'; 
											}
										}
									?>
								</select>
								</div>
						  	</td>
						</tr>
						<?php
								$x++;
							}
						?>
					</tbody>
				</table>
				<br >
				<!-- Number of Examination Sittings -->
				<input type="hidden" value="<?php if(isset($num_of_sitting)) echo $num_of_sitting; ?>" name="num_of_exam_sitting" id="num_of_exam_sitting" />
				<!-- Number of O Level subjects and grade for sitting 2 -->
		        <input type="hidden" value="<?php if(isset($x)) { echo $x - 1;} else { echo 1;} ?>" name="num_of_o_level2" id="num_of_o_level2" />
				<!-- exam_id -->
				<input type="hidden" value="<?php echo $olevel_detail[2]->o_level_id; ?>" name="o_level2_id" id="o_level2_id" />
				<!-- prepend fields -->
				<input type="hidden" value="false" name="prepend_fields" id="prepend_fields" />
				<!-- End of O-level -->
				
				<!-- Beginning of O-level details Add Button -->
				<div class="control-group">
					<div class="controls">  
						<button type="button" class="btn btn-danger" id="remove_o_level_2" disabled>Remove O Level</button>
						<button type="button" class="btn btn-inverse" id="add_o_level_2">Add O Level</button>
					</div>	
				</div>
				<!-- End of O-level details Add Button -->
			</div>
		<?php
			} else {
		?>
		
		<div id="sitting_2" class="span5 hide">
			
			<!-- Beginning of O-level -->
			<table class="table-hover">
				<thead>
					<tr>
					  	<th>Subject</th>
					  	<th>Grade</th>
					</tr>
				</thead>
				<tbody id="o_level_2">
					<?php
						$l = 2;
					 	$x = 1;
						while ($x<=6) {
							$o_level_2_subject_id = "o_level_2_subject_$x";
							$o_level_2_grade_id = "o_level_2_grade_$x";
							
							$sql_grade = "SELECT * FROM exam_grade";
							$result_grade = $db_academic->query($sql_grade);
							
							$sql_subject = "SELECT * FROM exam_subject";
							$result_subject = $db_academic->query($sql_subject);
					   ?>
					<tr>
					  	<td>
					  		<div class="control-group">
					  			<select class="input-xlarge" name="<?php echo $o_level_2_subject_id; ?>" id="<?php echo $o_level_2_subject_id; ?>" >
									<option value="">...</option>
									<?php
									    while($record = $db_academic->fetch_array($result_subject))
										{	
											echo '<option value="'. $record['subject_id'] .'">'.$record['subject_name'].'</option>'; 
										}
									?>
								</select>
					  		</div>
					  	</td>
					  	<td>
					  		<div class="control-group">
							<select class="input-small" name="<?php echo $o_level_2_grade_id ?>" id="<?php echo $o_level_2_grade_id ?>" >
								<option value="">...</option>
								<?php
								    while($record = $db_academic->fetch_array($result_grade))
									{	
										echo '<option value="'. $record['grade_id'] .'">'.$record['grade'].'</option>'; 
									}
								?>
							</select>
							</div>
					  	</td>
					</tr>
					<?php
							$x++;
						}
					?>
				</tbody>
			</table>
			<br >
			<!-- Number of Examination Sittings -->
			<input type="hidden" value="<?php if(isset($l)) { echo $l - 1;} else { echo 1;} ?>" name="num_of_exam_sitting" id="num_of_exam_sitting" />
			<!-- Number of O Level subjects and grade for sitting 2 -->
	        <input type="hidden" value="<?php if(isset($x)) { echo $x - 1;} else { echo 1;} ?>" name="num_of_o_level2" id="num_of_o_level2" />
			<!-- exam_id -->
			<input type="hidden" value="" name="o_level2_id" id="o_level2_id" />
			<!-- prepend fields -->
			<input type="hidden" value="true" name="prepend_fields" id="prepend_fields" />
			<!-- End of O-level -->
			
			<!-- Beginning of O-level details Add Button -->
			<div class="control-group">
				<div class="controls">  
					<button type="button" class="btn btn-danger" id="remove_o_level_2" disabled>Remove O Level</button>
					<button type="button" class="btn btn-inverse" id="add_o_level_2">Add O Level</button>
				</div>	
			</div>
			<!-- End of O-level details Add Button -->
		</div>
	<?php
		}
	?>
		
		
	</div>
	<!-- End of O-level details -->
	<br >
	
	<!-- Beginning of add sitting Add Button -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-warning" id="add_sitting" >Add Second Sitting</button>
		</div>	
	</div>
	<!-- End of add sitting Add Button -->
	<br ><br >
	<hr>
	<!-- Beginning of Academic Distinction and Prizes Awarded -->
	<table class="table table-hover">
	  <caption><h4>Academic Distinction and Prizes Awarded</h4></caption>
	  <thead>
		<tr>
		  <th>S/N</th>
		  <th>Academic Prize</th>
		  <th>Awarding Body</th>
		  <th>Year</th>
		</tr>
	  </thead>
	  <tbody id="academic_prizes">
	  	<?php
				$sql_awards = "SELECT academic_prizes FROM personal_details WHERE applicant_id=" . $session->applicant_id;
				$result_awards = User::find_by_sql($sql_awards);
				
				if(!empty($result_awards)) {
					
					foreach($result_awards as $row):
						$awards = unserialize($row->academic_prizes);
					endforeach;
				}
				
				if(!empty($awards)) {
					$a = 1;
					foreach ($awards as $award) :
						$prize  = 'academic_prize_'.$a;
						$award_body  = 'awarding_body_'.$a;
						$year  = 'award_year_'.$a;
		?>
						<tr>
						  <td>
						  	<?php echo $a; ?>
						  </td>
						  <td>
						  	<div class="control-group">
								<div class="controls">
									<input type="text" class="input-xlarge" value="<?php if(isset($award['prize'])) echo $award['prize']; ?>" id="<?php echo $prize; ?>" name="<?php echo $prize; ?>" placeholder="Academic Prize" />
						  		</div>
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<div class="controls">
									<input type="text" class="input-xlarge" value="<?php if(isset($award['awarding_body'])) echo $award['awarding_body']; ?>" id="<?php echo $award_body; ?>" name="<?php echo $award_body; ?>" placeholder="Awarding Body" />
						  		</div>
						  	</div>
						  </td>
						  <td>
						  	<div class="control-group">
								<div class="controls">
									<input type="text" class="input-xlarge" value="<?php if(isset($award['year'])) echo $award['year']; ?>" id="<?php echo $year; ?>" name="<?php echo $year; ?>" maxlength="4" placeholder="Year" />
						  		</div>
						  	</div>
						  </td>
						</tr>
		<?php
						$a++;
						endforeach;
				} else {
		?>
					<tr>
					  <td>
					  	1
					  </td>
					  <td>
					  	<div class="control-group">
							<div class="controls">
								<input type="text" class="input-xlarge" value="" id="academic_prize_1" name="academic_prize_1" placeholder="Academic Prize" />
					  		</div>
					  	</div>
					  </td>
					  <td>
					  	<div class="control-group">
							<div class="controls">
								<input type="text" class="input-xlarge" value="" id="awarding_body_1" name="awarding_body_1" placeholder="Awarding Body" />
					  		</div>
					  	</div>
					  </td>
					  <td>
					  	<div class="control-group">
							<div class="controls">
								<input type="text" class="input-xlarge" value="" id="award_year_1" name="award_year_1" maxlength="4" placeholder="Year" />
					  		</div>
					  	</div>
					  </td>
					</tr>
		<?php		
				}
		?>
				<!-- Number of Academic Distinction and Prizes Awarded Rows -->
						<input type="hidden" value="<?php if(isset($a)) { echo $a - 1;} else { echo 1;} ?>" name="num_of_award_rows" id="num_of_award_rows" />
	  </tbody>
	</table>
	<!-- End of Publications -->
	
	<!-- Beginning of Publications Add Button -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-danger" id="remove_prize" disabled>Remove Prize/Distinction</button>
			<button type="button" class="btn btn-primary" id="add_prize">Add Prize/Distinction</button>
		</div>	
	</div>
	<!-- End of Publications Add Button -->
	<br ><br >

	 <hr>
    
    <!-- Beginning of Other Relevant Qualifications -->
	<table class="table table-hover">
		<caption><h4>Professional and Other Relevant Qualifications</h4></caption>
		<thead>
			<tr>
			  	<th>Name of Institution</th>
				<th>From</th>
				<th>To</th>
				<th>Qualification</th>
				<th>Grade</th>
			</tr>
		</thead>
		<tbody id="other_qualifications">
			<?php
				$sql_qualification = "SELECT * FROM other_relevant_qualifications WHERE applicant_id=" . $session->applicant_id;
				$result_qualification = Qualifications::find_by_sql($sql_qualification);
				//print_r($result_qualification);
				
				if(!empty($result_qualification)) {
					
				 	$j = 1;
					foreach($result_qualification as $row):
						$name_of_insti_ID = 'other_qualification_institute_name_'.$j;
						$from_ID = 'other_qualification_from_'.$j;
						$to_ID = 'other_qualification_to_'.$j;
						$certificate_ID = 'other_qualification_certificate_'.$j;
						$grade_ID = 'other_qualification_grade_'.$j;
						$qual_id = 'qual_id_'.$j;
			?>
						<tr>
						  	<td>
						  		<div class="control-group">
						  			<input type="text" value="<?php echo $row->name_of_institutions; ?>" id="<?php echo $name_of_insti_ID; ?>" name="<?php echo $name_of_insti_ID; ?>" placeholder="Name of Institution" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" maxlength="4" class="input-small" value="<?php echo $row->from_year; ?>" id="<?php echo $from_ID; ?>" name="<?php echo $from_ID; ?>" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" maxlength="4" class="input-small" value="<?php echo $row->to_year; ?>" id="<?php echo $to_ID; ?>" name="<?php echo $to_ID; ?>" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="<?php echo $row->certificate_qualification_name; ?>" id="<?php echo $certificate_ID; ?>" name="<?php echo $certificate_ID; ?>" placeholder="Qualification" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="<?php echo $row->grade; ?>" id="<?php echo $grade_ID; ?>" name="<?php echo $grade_ID; ?>" placeholder="Grade" />
						  		</div>
						  	</td>
							<!-- Other Relevant Qualification id -->
							<input type="hidden" value="<?php echo $row->other_qualifications_id; ?>" name="<?php echo $qual_id; ?>" id="<?php echo $qual_id; ?>" />
						</tr>
			<?php
						$j++;
					endforeach;
				} else {
			?>
						<tr>
						  	<td>
						  		<div class="control-group">
						  			<input type="text" value="" id="other_qualification_institute_name_1" name="other_qualification_institute_name_1" placeholder="Name of Institution" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" class="input-small" maxlength="4" value="" id="other_qualification_from_1" name="other_qualification_from_1" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" class="input-small" maxlength="4" value="" id="other_qualification_to_1" name="other_qualification_to_1" placeholder="Year" >
								</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="" id="other_qualification_certificate_1" name="other_qualification_certificate_1" placeholder="Qualification" />
						  		</div>
						  	</td>
						  	<td>
						  		<div class="control-group">
									<input type="text" value="" id="other_qualification_grade_1" name="other_qualification_grade_1" placeholder="Grade" />
						  		</div>
						  	</td>
							<!-- Other Relevant Qualification id -->
							<input type="hidden" value="" name="qual_id_1" id="qual_id_1" />
						</tr>
			<?php	
				}
			?>
		</tbody>
	</table>
	<!-- Number of Other Relevant Qualification Rows -->
	<input type="hidden" value="<?php if(isset($j)) { echo $j - 1;} else { echo 1;} ?>" name="num_of_o_qualification_rows" id="num_of_o_qualification_rows" />
	<!-- End of Other Relevant Qualifications -->
	
	<!-- Beginning of Other Relevant Qualifications Add and Remove Buttons -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-danger" id="remove_other_qualifications" disabled>Remove</button>
			<button type="button" class="btn btn-info" id="add_other_qualifications">Add</button>
		</div>	
	</div>
	<!-- End of Other Relevant Qualifications Add Button -->
    
    <br>
    <hr>
    
    <!-- Beginning of Buttons -->
	<div id="accept_terms">		
		<div align="center" class="control-group">
			<div class="controls">  
				<button type="submit" class="btn btn-primary" id="academic_qualification_submit">Save</button>
				<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
			</div>	
		</div>
	</div>
	<!-- End of Buttons -->
     <br ><br >
	
    
    
</form>
  