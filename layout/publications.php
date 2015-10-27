<?php
	$database = new MySQLDatabase();
	$session = new Session();

	$academic_publications = Publication::find_by_sql("SELECT * FROM academic_publications WHERE applicant_id=".$session->applicant_id);
	
	$other_publications = OtherPublication::find_by_sql("SELECT * FROM otherpublications WHERE applicant_id=".$session->applicant_id);
	
?>
<form action="" method="POST" class="publications" >

	<!-- Beginning of Publications -->
	<table class="table table-hover">
	  <caption><h3>Academic Publications</h3></caption>
	  <caption><h4>Thesis, Projects and Publications</h4></caption>
	  <thead>
		<tr>
		  <th>S/N</th>
		  <th>Title</th>
		  <th>Institution</th>
		  <th>Qualifications</th>
		  <th>Date</th>
		</tr>
	  </thead>
      
	  <tbody id="thesis_projects_publication">
      <?php
	  	if(!empty($academic_publications))
		{
			$index = 1;
			
			foreach($academic_publications as $academic)
			{
				$publication_title = 'publication_title_'.$index;
				$publication_inst = 'publication_institution_'.$index;
				$publication_qualification = 'publication_qualification_'.$index;
				$publication_date = 'publication_date_'.$index;
				$publication_id = 'publication_id_'.$index;
		?>
        <tr>
			  <td>
			  	<?php echo $index; ?>
			  </td>
			  <td><input type="hidden" name="<?php echo $publication_id; ?>" value="<?php echo $academic->publication_id; ?>"  />
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="<?php echo $academic->title_of_publication; ?>" id="<?php echo $publication_title; ?>" name="<?php echo $publication_title; ?>" placeholder="Title" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="<?php echo $academic->institution; ?>" id="<?php echo $publication_inst; ?>" name="<?php echo $publication_inst; ?>" placeholder="Institution" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="<?php echo $academic->qualification; ?>" id="<?php echo $publication_qualification; ?>" name="<?php echo $publication_qualification; ?>" placeholder="Qualification" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-small" id="<?php echo $publication_date; ?>" name="<?php echo $publication_date; ?>" placeholder="YYYY" maxlength="10"  value="<?php echo $academic->year_of_publication; ?>" />
			  	</div>
			  </td>
			</tr>
        <?php
			$index++;
			}
		}
		else
		{
	  ?>
			<tr>
			  <td>
			  	1
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="" id="publication_title_1" name="publication_title_1" placeholder="Title" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="" id="publication_institution_1" name="publication_institution_1" placeholder="Institution" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-xlarge" value="" id="publication_qualification_1" name="publication_qualification_1" placeholder="Qualification" />
			  	</div>
			  </td>
			  <td>
			  	<div class="control-group">
					<input type="text" class="input-small" id="publication_date_1" name="publication_date_1" placeholder="YYYY" maxlength="10"  />
			  	</div>
			  </td>
			</tr>
	<?php
		}
	?>
	  </tbody>
	</table>
	<!-- End of Publications -->
	
	<!-- Number of Thesis and Projects and publications -->
	<input type="hidden" value="<?php if(isset($index)) echo $index-1; else echo 1; ?>" name="num_of_pub_rows" id="num_of_pub_rows" />
	
	<!-- Beginning of Publications Add and Remove Button -->
	<div align="center" class="control-group">
		<div class="controls">  
			<button type="button" class="btn btn-danger" id="remove_publication" disabled>Remove Publication</button>
			<button type="button" class="btn btn-primary" id="add_publications">Add Publications</button>
		</div>	
	</div>
	<!-- End of Publications Add and Remove Button -->
	<br ><br >
	
	<!-- Beginning of Other Publications-->
	<table class="table table-hover">
	  <caption><h4>Other Publications</h4></caption>
	  <thead>
			<tr>
				<th>S/N</th>
			  	<th>Title</th>
			  	<th>Publisher</th>
			</tr>
	  </thead>
	  <tbody id="other_publications">
      <?php
	  	if(!empty($other_publications))
		{
			$index=1;
			foreach($other_publications as $otherpub)
			{
				$other_publications_title = 'other_publications_title_'.$index;
				$other_publications_publisher = 'other_publications_publisher_'.$index;
				$other_publication_id = 'other_publications_id_'.$index;
			?>
            
            <tr>
				<td>
					<?php echo $index; ?>
				</td>
				<td>
                	<input type="hidden" name="<?php echo $other_publication_id; ?>" value="<?php echo $otherpub->publication_id; ?>" />
					<div class="control-group">
						<input type="text" class="input-xlarge" value="<?php echo $otherpub->title_of_publication; ?>" id="<?php echo $other_publications_title; ?>" name="<?php echo $other_publications_title; ?>" placeholder="Title" />
					</div>
				</td>
				<td>
					<div class="control-group">
						<input type="text" class="input-xlarge" value="<?php echo $otherpub->publisher; ?>" id="<?php echo $other_publications_publisher; ?>" name="<?php echo $other_publications_publisher; ?>" placeholder="Publisher"  />
					</div>
				</td>
			</tr>
            
        <?php
			$index++;
			}
		}
		else
		{
	  ?>
			<tr>
				<td>
					1
				</td>
				<td>
					<div class="control-group">
						<input type="text" class="input-xlarge" value="" id="other_publications_title_1" name="other_publications_title_1" placeholder="Title" />
					</div>
				</td>
				<td>
					<div class="control-group">
						<input type="text" class="input-xlarge" value="" id="other_publications_publisher_1" name="other_publications_publisher_1" placeholder="Publisher"  />
					</div>
				</td>
			</tr>
		<?php
		}
		?>
	  </tbody>
	</table>
	<!-- End of Other Publications -->
	
	<!-- Number of Other Publications -->
	<input type="hidden" value="<?php if(isset($index)) echo $index-1; else echo 1; ?>" name="num_of_o_pub_rows" id="num_of_o_pub_rows" />
	
	<!-- Beginning of Other Publications Add and Remove Button -->
	<div align="center" class="control-group">
		<div class="controls">
			<button type="button" class="btn btn-danger" id="remove_other_publication" disabled>Remove Other Publications</button>  
			<button type="button" class="btn btn-info" id="add_other_publications">Add Other Publications</button>
		</div>	
	</div>
	<!-- End of Other Publications Add and Remove Button -->
	<br ><br >
	
	<!--Save and Continue Button-->
<div id="accept_terms">		
	<div align="center" class="control-group">
		  <div class="controls">  
			<button type="submit" class="btn btn-primary" id="publication_details_submit">Save</button>
			<button type="button" onClick="document.location.href='logout.php?logoff';" class="btn">Exit</button>
	      </div>
	</div>
</div>
<!-- End of Save and Continue Button-->
</form>
<!-- End of form -->
  