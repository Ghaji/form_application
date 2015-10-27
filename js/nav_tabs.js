jQuery.noConflict();
jQuery(document).ready(function(){
	$('.datepicker').datepicker();
	/*---------------------- Modal -------------------------------------*/
	jQuery("#close").click(function(){
		jQuery(".modal").modal("hide");
	});
	jQuery("#done").click(function(){
		jQuery(".modal").modal("hide");
	});
	
	function show_modal(){
		jQuery(" .modal-body").html("<center class='loading'>Loading Please Wait...</center>");
		jQuery(" .modal-body").addClass("loader");
		jQuery("#displayinfo").modal("show");
	}
	
	function display_modal(msg){
		//jQuery(".modal .ajax_data").html("<pre>"+msg+"</pre>");
		//jQuery(".modal").modal("show");
		jQuery(".modal-body").removeClass("loader");
		jQuery(" .modal-body").html(msg);
		jQuery("#displayinfo").modal("show");
	}
	/*--------------------------------------------------------------------*/
	
	/*---------------------- Validation Variables -------------------------------------*/
	valid_personal_details = false;
	valid_academic_details = false;
	valid_employment_details = false;
	valid_proposed_thesis_details = false;
	valid_publication_details = false;
	valid_referees_details = false;
	filled_form = false;
	
	/*---------------------- Global Booleans -------------------------------------*/
	/*variables for toggling add second sitting button*/
	hiding_sitting_2 = true;
	prepend_fields = jQuery('#prepend_fields').val();
	
	/*---------------------- Initialise Number of Rows in Tables -------------------------------------*/
	
	ini_tetiary_institution_num_row = parseInt(jQuery('#num_of_high_insti_rows').val()) + 1;
	ini_o_qualification_num_row = parseInt(jQuery('#num_of_o_qualification_rows').val()) + 1;
	ini_pub_num_row = parseInt(jQuery('#num_of_pub_rows').val());
	ini_o_pub_num_row = parseInt(jQuery('#num_of_o_pub_rows').val());
	ini_secondary_school_num_row = parseInt(jQuery('#num_of_sec_school_rows').val()) + 1;
	num_of_sittings = parseInt(jQuery('#num_of_exam_sitting').val());
	ini_o_level_1_num_row = parseInt(jQuery('#num_of_o_level1').val()) + 1;
	ini_o_level_2_num_row = parseInt(jQuery('#num_of_o_level2').val()) + 1;
	ini_prize_num_row = parseInt(jQuery('#num_of_award_rows').val()) + 1;
	ini_add_docs_num_row = parseInt(jQuery('#num_of_doc_rows').val()) + 1;
	
	ini_employment_num_row = parseInt(jQuery('#details_of_employment tr:last-child td:first-child').html()) + 1;
	
	ini_proposed_topics_num_row = 2;
	
	/*display Remove Second Sitting if number of sitting is 2*/
	if (num_of_sittings == 2) {
		jQuery("#add_sitting").html("Remove Second Sitting");
		hiding_sitting_2 = false;
	}
	
	
	 // console.log(ini_prize_num_row);
		// console.log();
	// console.log(jQuery('#num_of_award_rows').val());
		
	/*---------------------- Helper function for removing buttons -------------------------------------*/
	function remove_row(row, counter, lower_limit, button) {
		var i = counter;
		if (i > lower_limit) {
			row.remove();
			counter--;
			if (counter == lower_limit){
				button.attr("disabled", true);
			}
		}
		return counter;
	}
	
	/*---------------------- Beginning of Publications -------------------------------------*/
	var remove_publication_button = jQuery("#remove_publication"),
		remove_other_publication_button = jQuery("#remove_other_publication");
	
	/*Add Publications*/
	jQuery("#add_publications").click(function (){
		var i = ++ini_pub_num_row,
		
			title_ID = "publication_title_"+i,
			institution_ID = "publication_institution_"+i,
			qualification_ID = "publication_qualification_"+i,
			date_ID = "publication_date_"+i,
			sn = "<td>"+i+"</td>",
			title = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+title_ID+"' name='"+title_ID+"' placeholder='Title' /></td></div>",
			institution = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+institution_ID+"' name='"+institution_ID+"' placeholder='Institution' /></div></td>",
			qualification = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+qualification_ID+"' name='"+qualification_ID+"' placeholder='Qualification' /></div></td>",
			date = "<td><div class='control-group'><input type='text' class='input-small' id='"+date_ID+"' name='"+date_ID+"' maxlength='10' placeholder='YYYY' /></div></td>",
			row = sn + title + institution + qualification + date;
		jQuery("#thesis_projects_publication").append("<tr>" + row + "</tr>");
		remove_publication_button.attr("disabled", false);
	});
	
	/*Remove Publications*/
	remove_publication_button.click(function (){
		var row = jQuery("#thesis_projects_publication tr:last-child"),
			default_i = 1;
			
		ini_pub_num_row = remove_row(row, ini_pub_num_row, default_i, jQuery(this));
	});
	
	/*Add Other Publications*/
	jQuery("#add_other_publications").click(function (){
		var other_publications = jQuery("#other_publications"),
			i = ++ini_o_pub_num_row,
			title_ID = "other_publications_title_"+i,
			publisher_ID = "other_publications_publisher_"+i,
			sn = "<td>"+i+"</td>",
			title = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+title_ID+"' name='"+title_ID+"'  placeholder='Title' /></div></td>",
			publisher = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+publisher_ID+"' name='"+publisher_ID+"' placeholder='Publisher' /></div></td>",
			row = sn + title + publisher;
			
		other_publications.append("<tr>" + row + "</tr>");
		remove_other_publication_button.attr("disabled", false);
	});
	
	/*Remove Other Publications*/
	remove_other_publication_button.click(function (){
		var row = jQuery("#other_publications tr:last-child"),
			default_i = 1;
			
		ini_o_pub_num_row = remove_row(row, ini_o_pub_num_row, default_i, jQuery(this));
	});
	/*---------------------- End of Publications -------------------------------------*/
	
	/*---------------------- Beginning of Academic Qualifications -------------------------------------*/
	var remove_tetiary_institution_button = jQuery("#remove_tetiary_institution"),
		remove_other_qualifications_button = jQuery("#remove_other_qualifications"),
		remove_secondary_school_button = jQuery("#remove_secondary_school"),
		remove_o_level_1_button = jQuery("#remove_o_level_1"),
		remove_o_level_2_button = jQuery("#remove_o_level_2"),
		remove_prize_button = jQuery("#remove_prize");
	
	/*Add Tetiary Institutions*/
	jQuery("#add_tetiary_institution").click(function (){
		var tetiary_institutions = jQuery("#tetiary_institutions"),
			i = ini_tetiary_institution_num_row;
			
		if (i <= 6) {
			var name_ID = "tetiary_institution_name_"+i,
				degree_ID = "tetiary_institution_degree_"+i,
				course_ID = "tetiary_institution_course_"+i,
				class_ID = "tetiary_institution_class_"+i,
				from_ID = "tetiary_institution_from_"+i,
				to_ID = "tetiary_institution_to_"+i,
				cgpa_ID = "tetiary_institution_cgpa_"+i,
				high_id = "high_id_"+i,
				
				name = "<td><div class='control-group'><input type='text' value='' id='"+name_ID+"' name='"+name_ID+"' placeholder='Institution Name' /></div></td>",
				degree = "<td><div class='control-group'><input type='text' class='input-small' value='' id='"+degree_ID+"' name='"+degree_ID+"' placeholder='Degree' /></div></td>",
				course = "<td><div class='control-group'><input type='text' value='' id='"+course_ID+"' name='"+course_ID+"' placeholder='Course of Study' /></div></td>",
				class_of_degree = "<td><div class='control-group'><input type='text' class='input-small' value='' id='"+class_ID+"' name='"+class_ID+"' placeholder='Class of Degree' /></div></td>",
				from = "<td><div class='control-group'><input type='text' maxlength='4' class='input-small' value='' id='"+from_ID+"' name='"+from_ID+"' placeholder='Year' ></div></td>",
				to = "<td><div class='control-group'><input type='text' maxlength='4' class='input-small' value='' id='"+to_ID+"' name='"+to_ID+"' placeholder='Year' ></div></td>",
				cgpa = "<td><div class='control-group'><input type='text' class='input-small' value='' id='"+cgpa_ID+"' name='"+cgpa_ID+"' placeholder='CGPA' ></div></td>",
				high_inst_id = "<input id='"+high_id+"' type='hidden' name='"+high_id+"' value=''>";
				row = name + degree + course + class_of_degree + from + to + cgpa + high_inst_id;
			
			tetiary_institutions.append("<tr>" + row + "</tr>");
			ini_tetiary_institution_num_row++;
			remove_tetiary_institution_button.attr("disabled", false);
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than six tetiary institutions.</p>");
		}
			
	});
	
	/*Remove Tetiary Institution*/
	remove_tetiary_institution_button.click(function (){
		var row = jQuery("#tetiary_institutions tr:last-child"),
			default_i = 2;
			
		ini_tetiary_institution_num_row = remove_row(row, ini_tetiary_institution_num_row, default_i, jQuery(this));
	});
	
	/*Add Other Relevant Qualifications*/
	jQuery("#add_other_qualifications").click(function (){
		var other_qualifications = jQuery("#other_qualifications"),
			i = ini_o_qualification_num_row;
			
		if (i <= 4) {
			var name_ID = "other_qualification_institute_name_"+i,
				from_ID = "other_qualification_from_"+i,
				to_ID = "other_qualification_to_"+i,
				qualification_ID = "other_qualification_certificate_"+i,
				grade_ID = "other_qualification_grade_"+i,
				qual_id = 'qual_id_'+i,
				
				name = "<td><div class='control-group'><input type='text' value='' id='"+name_ID+"' name='"+name_ID+"' placeholder='Name of Institution' /></div></td>",
				from = "<td><div class='control-group'><input type='text' maxlength='4' value='' class='input-small' id='"+from_ID+"' name='"+from_ID+"' placeholder='Year' ></div></td>",
				to = "<td><div class='control-group'><input type='text' maxlength='4' value='' class='input-small' id='"+to_ID+"' name='"+to_ID+"' placeholder='Year' ></div></td>",
				qualification = "<td><div class='control-group'><input type='text' value='' id='"+qualification_ID+"' name='"+qualification_ID+"' placeholder='Qualification' /></div></td>",
				grade = "<td><div class='control-group'><input type='text' value='' id='"+grade_ID+"' name='"+grade_ID+"' placeholder='Grade' /></div></td>",
				o_qual_id = "<input id='"+qual_id+"' type='hidden' name='"+qual_id+"' value=''>";
				row = name + from + to + qualification + grade + o_qual_id;
			
			other_qualifications.append("<tr>" + row + "</tr>");
			ini_o_qualification_num_row++;
			remove_other_qualifications_button.attr("disabled", false);
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than four qualifications.</p>");
		}
			
	});
	
	/*Remove Other Qualifications*/
	remove_other_qualifications_button.click(function (){
		var row = jQuery("#other_qualifications tr:last-child"),
			default_i = 2;
			
		ini_o_qualification_num_row = remove_row(row, ini_o_qualification_num_row, default_i, jQuery(this));
	});
	
	/*Add Secondary School*/
	jQuery("#add_secondary_school").click(function (){
		var secondary_schools = jQuery("#secondary_schools"),
			i = ini_secondary_school_num_row;
			
		if (i <= 2) {
			var name_ID = "secondary_school_name_"+i,
				address_ID = "secondary_school_address_"+i,
				from_ID = "secondary_school_from_"+i,
				to_ID = "secondary_school_to_"+i,
				sch_id = 'sch_id_'+i,
				
				name = "<td><div class='control-group'><input type='text' value='' id='"+name_ID+"' name='"+name_ID+"' placeholder='School Name' /></div></td>",
				address = "<td><div class='control-group'><input type='text' value='' id='"+address_ID+"' name='"+address_ID+"' placeholder='School Address' /></div></td>",
				from = "<td><div class='control-group'><input type='text' maxlength='4' value='' class='input-small' id='"+from_ID+"' name='"+from_ID+"' placeholder='Year' ></div></td>",
				to = "<td><div class='control-group'><input type='text' maxlength='4' value='' class='input-small' id='"+to_ID+"' name='"+to_ID+"' placeholder='Year' ></div></td>",
				sec_sch_id = "<input id='"+sch_id+"' type='hidden' name='"+sch_id+"' value=''>";
				
				row = name + address + from + to + sec_sch_id;
			
			secondary_schools.append("<tr>" + row + "</tr>");
			ini_secondary_school_num_row++;
			remove_secondary_school_button.attr("disabled", false);
		} else {
			show_modal();
	 		display_modal("<p>You cannot enter more than two secondary schools.</p>");
		}
			
	});
	
	/*Remove Secondary School*/
	remove_secondary_school_button.click(function (){
		var row = jQuery("#secondary_schools tr:last-child"),
			default_i = 2;
			
		ini_secondary_school_num_row = remove_row(row, ini_secondary_school_num_row, default_i, jQuery(this));
	});
	
	/*grade options for the first and second sitting*/
	var grade_options;
	jQuery.ajax({
	  url: "ajax/ajax_display_grade.php"
	}).done(function( msg ) {
			grade_options = msg;
		});
		
	/*exam options for the second sitting*/	
	var subject_options;
	jQuery.ajax({
	  url: "ajax/ajax_display_subject.php"
	}).done(function( msg ) {
			subject_options = msg;
		});
				
	/*Add O Level Subject and Grade for First Setting*/
	jQuery("#add_o_level_1").click(function (){
		var o_level = jQuery("#o_level_1"),
			i = ini_o_level_1_num_row;
			
		if (i <= 9) {
			var subject_ID = "o_level_1_subject_"+i,
				grade_ID = "o_level_1_grade_"+i,
				subject = "<td><div class='control-group'><select class='input-xlarge' id='"+subject_ID+"' name='"+subject_ID+"' ><option value=''>...</option>"+subject_options+"</select></div></td>",
				grade = "<td><div class='control-group'><select class='input-small' id='"+grade_ID+"' name='"+grade_ID+"' ><option value=''>...</option>"+grade_options+"</select></div></td>",
				row = subject + grade;
			
			o_level.append("<tr>" + row + "</tr>");
			ini_o_level_1_num_row++;
			remove_o_level_1_button.attr("disabled", false);
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than nine 'O' Levels for your first sitting.</p>");
		}
	});
	
	/*Remove O Level 1*/
	remove_o_level_1_button.click(function (){
		var row = jQuery("#o_level_1 tr:last-child"),
			default_i = 7;
			
		ini_o_level_1_num_row = remove_row(row, ini_o_level_1_num_row, default_i, jQuery(this));
	});
	
	/*Add O Level Subject and Grade for Second Setting*/
	jQuery("#add_o_level_2").click(function (){
		var o_level = jQuery("#o_level_2"),
			i = ini_o_level_2_num_row;
			
		if (i <= 9) {
			
			var subject_ID = "o_level_2_subject_"+i,
				grade_ID = "o_level_2_grade_"+i,
				subject = "<td><div class='control-group removable'><select class='input-xlarge' id='"+subject_ID+"' name='"+subject_ID+"' ><option value=''>...</option>"+subject_options+"</select></div></td>",
				grade = "<td><div class='control-group removable'><select class='input-small' id='"+grade_ID+"' name='"+grade_ID+"' ><option value=''>...</option>"+grade_options+"</select></div></td>",
				row = subject + grade;
			
			o_level.append("<tr>" + row + "</tr>");
			ini_o_level_2_num_row++;
			remove_o_level_2_button.attr("disabled", false);
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than nine 'O' Levels for your second sitting.</p>");
		}
	});
	
	/*Remove O Level 2*/
	remove_o_level_2_button.click(function (){
		var row = jQuery("#o_level_2 tr:last-child"),
			default_i = 7;
			
		ini_o_level_2_num_row = remove_row(row, ini_o_level_2_num_row, default_i, jQuery(this));
	});
	
	/*exam options for the second sitting*/	
	var exam_options;
	jQuery.ajax({
	  url: "ajax/ajax_display_exam.php"
	}).done(function( msg ) {
			exam_options = msg;
		});
		
	/*Add and Remove Sitting 2*/
	jQuery("#add_sitting").click(function (){
		var sitting_2 = jQuery("#sitting_2"),
			this_btn = jQuery(this);
		
		if(this_btn.html() == "Add Second Sitting") {
			if(prepend_fields == 'true') {
				var exam_no = "<div class='control-group removable'><label for='inputExamNo'><b>Examination Number</b></label><div class='controls'><input type='text' class='input-xlarge' value='' name='exam_no_2' id='exam_no_2' placeholder='Examination Number' /></div></div>",
				year = "<div class='control-group removable'><label class='control-label' for='inputYear'><b>Year</b></label><div class='controls'><input type='text' value='' class='input-small' maxlength='4' name='exam_year_2' id='exam_year_2' placeholder='Year' ></div></div>",
				exam_type = "<div class='control-group removable'><label class='control-label' for='inputExamType'><b>Examination Type</b></label><div class='controls'><select class='input-medium' id='exam_type_2' name='exam_type_2' ><option value=''>...</option>"+exam_options+"</select></div></div>";
				exam_center = "<div class='control-group removable'><label class='control-label' for='inputExamCentre'><b>Examination Centre Number</b></label><div class='controls'><input type='text' class='input-xlarge' value='' name='exam_centre_2' id='exam_centre_2' placeholder='Examination Centre' /></div></div>";
			
				sitting_2.prepend(exam_no, year, exam_type, exam_center);
			}
			sitting_2.show();
			hiding_sitting_2 = false;
			num_of_sittings = 2;
			this_btn.html("Remove Second Sitting");
				
		} else {
			jQuery(".removable").remove();
			sitting_2.hide();
			hiding_sitting_2 = true;
			ini_o_level_2_num_row = 7;
			num_of_sittings = 1;
			jQuery('#exam_no_2').attr('value', '');
			remove_o_level_2_button.attr("disabled", false);
			this_btn.html("Add Second Sitting");
		}
	});
	
	/*Beginning of Academic Prizes and Distinction*/
	jQuery("#add_prize").click(function (){
		var academic_prizes = jQuery("#academic_prizes"),
			i = ini_prize_num_row;
			
		if (i <= 5) {
			var prize_ID = "academic_prize_"+i,
				awarding_body_ID = "awarding_body_"+i,
				award_year_ID = "award_year_"+i,
				
				sn = "<td>"+i+"</td>",
				prize = "<td><div class='control-group'><div class='controls'><input type='text' class='input-xlarge' value='' id='"+prize_ID+"' name='"+prize_ID+"' placeholder='Academic Prize' /></div></div></td>",
				awarding_body = "<td><div class='control-group'><div class='controls'><input type='text' class='input-xlarge' value='' id='"+awarding_body_ID+"' name='"+awarding_body_ID+"' placeholder='Awarding Body' /></div></div></td>",
				award_year = "<td><div class='control-group'><div class='controls'><input type='text' class='input-xlarge' value='' id='"+award_year_ID+"' name='"+award_year_ID+"' maxlength='4' placeholder='Year' /></div></div></td>",
				
				row = sn + prize + awarding_body + award_year;
			
			academic_prizes.append("<tr>" + row + "</tr>");
			ini_prize_num_row++;
			remove_prize_button.attr("disabled", false);
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than five academic prizes.</p>");
		}
	});
	
	/*Remove Academic Prize*/
	remove_prize_button.click(function (){
		var row = jQuery("#academic_prizes tr:last-child"),
			default_i = 2;
			
		ini_prize_num_row = remove_row(row, ini_prize_num_row, default_i, jQuery(this));
	});
	/*---------------------- End of Academic Qualifications -------------------------------------*/
	
	/*---------------------- Beginning of Employment Details -------------------------------------*/
	var remove_emp_button = jQuery("#remove_employment_detail");
	
	jQuery("#add_employment_details").click(function (){
		
		var details_of_employment = jQuery("#details_of_employment"),
			i = ini_employment_num_row;
			
		if (i <= 4) {
			var employer_ID = "employer_"+i,
				employment_year_ID = "employment_year_"+i,
				employer_address_ID = "employer_address_"+i,
				
				sn = "<td>"+i+"</td>";
				employer = "<td><div class='control-group'><input type='text' class='input-xlarge' value='' id='"+employer_ID+"' name='"+employer_ID+"' placeholder='Employer' /></div></td>",
				year = "<td><div class='control-group'><input type='text' class='input-small' maxlength='4' value='' id='"+employment_year_ID+"' name='"+employment_year_ID+"' placeholder='Year'  /></div></td>",
				address = "<td><div class='control-group'><div class='controls'><textarea rows='4' class='input-xlarge' name='"+employer_address_ID+"' id='"+employer_address_ID+"'></textarea></div></div></td>";
				
				row = sn + employer + year + address;
			
			details_of_employment.append("<tr>" + row + "</tr>");
			remove_emp_button.attr("disabled", false);
			ini_employment_num_row++;
		} else {
			show_modal();
			display_modal("<p>You cannot enter more than four employment records.</p>");
		}
	});
	
	remove_emp_button.click(function (){
		var row = jQuery("#details_of_employment tr:last-child"),
			default_i = 2;
			
		ini_employment_num_row = remove_row(row, ini_employment_num_row, default_i, jQuery(this));
	});
	/*---------------------- End of Employment Details -------------------------------------*/
	
	/*---------------------- Beginning of Proposed Topic of Thesis -------------------------------------*/
	var remove_topic_button = jQuery("#remove_topic");
	
	jQuery("#add_topic").click(function (){
		var proposed_topics = jQuery("#proposed_topics"),
			i = ini_proposed_topics_num_row;
			
		if (i <= 3) {
			var topic_ID = "proposed_thesis_topic_"+i,
				sn = "<td>"+i+"</td>",
				topic = "<td><div class='control-group'><input type='text'  class='input-xxlarge' value='' id='"+topic_ID+"' name='"+topic_ID+"' placeholder='Proposed Topic of Thesis' /></div></td>",
				row = sn + topic;
			
			proposed_topics.append("<tr>" + row + "</tr>");
			remove_topic_button.attr("disabled", false);
			ini_proposed_topics_num_row++;
		} else {
			show_modal();
			display_modal("<p>You cannot propose more than three topics.</p>");
		}
	});
	
	remove_topic_button.click(function (){
		var row = jQuery("#proposed_topics tr:last-child"),
			default_i = 2;
			
		ini_proposed_topics_num_row = remove_row(row, ini_proposed_topics_num_row, default_i, jQuery(this));
	});
	/*---------------------- End of Proposed Topic of Thesis -------------------------------------*/
	
	/*---------------------- Beginning of Add Document -------------------------------------*/
	var add_doc = jQuery("#add_doc"),
		remove_doc_button = jQuery("#remove_doc");
	
	jQuery(add_doc).click(function (){
		var upload_docs = jQuery("#upload_docs"), 
			i = ini_add_docs_num_row;
			
			if (i <= 5) {
				var doc_ID = "document_"+i,
					doc = "<div class='control-group'>";
		            doc += "	<label class='control-label' for='inputDocument'"+doc_ID+">Document "+i+"</label>";
		            doc += "<div class='controls'>";
					doc += "<input type='file'  class='input-xlarge' value='' id='"+doc_ID+"' name='Document "+doc_ID+"'  />";
		            doc += "</div>";
					doc += "</div>";
				
				upload_docs.append(doc);
				remove_doc_button.attr("disabled", false);
				ini_add_docs_num_row++;
			} else {
				show_modal();
				display_modal("<p>You cannot upload more than five documents.</p>");
			}
	});
	
	remove_doc_button.click(function (){
		var row = jQuery("#upload_docs div.control-group:last-child"),
			default_i = 3;
			
		ini_add_docs_num_row = remove_row(row, ini_add_docs_num_row, default_i, jQuery(this));
	});
	/*---------------------- End of Add Document -------------------------------------*/
	
	/*Helper function to prevent navigation if form is not filled*/
	function set_filled_form(form_flag) {
		if (form_flag == false) {
			filled_form = false;
		} else {
			filled_form = true;
		}
	}
	
	function toggle_allow_navigation(flag) {
		switch (flag) {
			case 'valid_personal_details':
				set_filled_form(valid_personal_details);
				break;
			case 'valid_academic_details':
				set_filled_form(valid_academic_details);
				break;
			case 'valid_employment_details':
				set_filled_form(valid_employment_details);
				break;
			case 'valid_proposed_thesis_details':
				set_filled_form(valid_proposed_thesis_details);
				break;
			case 'valid_publication_details':
				set_filled_form(valid_publication_details);
				break;
			case 'valid_referees_details':
				set_filled_form(valid_referees_details);
				break;
		}
	}
	/*----------------------- Validations -------------------------------------------------------*/
	personal_details = jQuery('.personal_details');
	function validate_personal_details() {
		personal_details.validate(
		 {
		  rules: {
		  	title_id: {
		      required: true
		   	},
		   	gender_id: {
		      required: true
		   	},
		   	marital_status_id: {
		      required: true
		   	},
		   	dob: {
		   	  required: true
		   	},
		   	country_id: {
		      required: true
		   	},
		   	state_name: {
		      required: true
		   	},
		   	lga_id: {
		      required: true
		   	},
		   	religion_id: {
		      required: true
		   	},
		   	address: {
		      required: true,
			  minlength: 15
		   	},
			next_kin_name: {
		      required: true,
			  minlength: 3
		   	},
		   	next_of_kin_relationship: {
		      required: true,
			  minlength: 3
		   	},
		   	next_of_kin_number: {
		      required: true,
			  number: 11,
			  minlength: 11	
		   	},
		   	next_of_kin_address: {
		      required: true,
			  minlength: 15
		    }
		  },
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_personal_details = false;
		    toggle_allow_navigation('valid_personal_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		    valid_personal_details = true;
		    toggle_allow_navigation('valid_personal_details');
		  }
		});
	}
	//end of the validation for the personal details tab
	
	//validate function for other programmes tab in diploma
	other_programme_details = jQuery('.other_programme_details');
	function validate_other_programmes() {
		other_programme_details.validate(
		 {
		  rules: {
		  	fullname_id: {
		      required: true
		   	},
			occupation:{
				required:true
			},
			address:{
				required:true
			},
			reasons_for_seeking_admission:{
				required:true
			}
		  },
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		  }
		});
	}
	
	function validate_other_programmes2(){
		
		other_programme_details.validate(
		 {
		  rules: {
		  	fullname_id: {
		      required: true
		   	},
			occupation:{
				required:true
			},
			address:{
				required:true
			},
			reasons_for_seeking_admission:{
				required:true
			},
			institution_name:{
				required:true
			},
			institution_address:{
				required:true
			}
		  },
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		  }
		});
	
	}
	
	function set_rules_academic_details() {
		var i = 1,
			c = 1,
			x = 1,
			y = 1,
			z = 1,
			obj_key = [],
			obj_value = [],
			rules = {};
		
		/* Loop to push rules and keys into separate arrays for academic details */
		/* tetiary institutions */
		if(jQuery('input[name=applicant_status]').val() == 'PGA')
		{
			while (i < ini_tetiary_institution_num_row) {
			var institution_name = "tetiary_institution_name_"+i,
				institution_degree = "tetiary_institution_degree_"+i,
				institution_course = "tetiary_institution_course_"+i,
				institution_class = "tetiary_institution_class_"+i,
				institution_from = "tetiary_institution_from_"+i,
				institution_to = "tetiary_institution_to_"+i,
				cgpa = "tetiary_institution_cgpa_"+i,
				obj = {};
				
			obj[institution_name] = { required: true };
			obj[institution_degree] = { required: true };
			obj[institution_course] = { required: true };
			obj[institution_class] = { required: true };
			obj[institution_from] = { required: true, number: 4, minlength: 4 };
			obj[institution_to] = { required: true, number: 4, minlength: 4 };
			
			obj_key.push(institution_name, institution_degree, institution_course, institution_class, institution_from, institution_to, cgpa);
			obj_value.push(obj[institution_name], obj[institution_degree], obj[institution_course], obj[institution_class], obj[institution_from], obj[institution_to], obj[cgpa]);
			i++;
			}
		}
		
		/* other qualifications */
		/*while (c < ini_o_qualification_num_row) {
			var o_institute_name = "other_qualification_institute_name_"+c,
				o_institute_from = "other_qualification_from_"+c,
				o_institute_to = "other_qualification_to_"+c,
				o_institute_certificate = "other_qualification_certificate_"+c,
				o_institute_grade= "other_qualification_grade_"+c,
				obj = {};
				
			obj[o_institute_name] = { required: true };
			obj[o_institute_from] = { required: true, number: 4, minlength: 4 };
			obj[o_institute_to] = { required: true, number: 4, minlength: 4 };
			obj[o_institute_certificate] = { required: true };
			obj[o_institute_grade] = { required: true };
			
			obj_key.push(o_institute_name, o_institute_from, o_institute_to, o_institute_certificate, o_institute_grade);
			obj_value.push(obj[o_institute_name], obj[o_institute_from], obj[o_institute_to], obj[o_institute_certificate], obj[o_institute_grade]);
			c++;
		}*/
		
		/* secondary school */
		while (x < ini_secondary_school_num_row) {
			var school_name = "secondary_school_name_"+x,
				school_address = "secondary_school_address_"+x,
				school_from = "secondary_school_from_"+x,
				school_to = "secondary_school_to_"+x,
				obj = {};
				
			obj[school_name] = { required: true };
			obj[school_address] = { required: true };
			obj[school_from] = { required: true, number: 4, minlength: 4 };
			obj[school_to] = { required: true, number: 4, minlength: 4 };
			
			obj_key.push(school_name, school_address, school_from, school_to);
			obj_value.push(obj[school_name], obj[school_address], obj[school_from], obj[school_to]);
			x++;
		}
		
		/* o level rules for first sitting */
		while (y < ini_o_level_1_num_row) {
			var subject = "o_level_1_subject_"+y,
				grade = "o_level_1_grade_"+y,
				obj = {};
				
			obj[subject] = { required: true };
			obj[grade] = { required: true };
			
			obj_key.push(subject, grade);
			obj_value.push(obj[subject], obj[grade]);
			y++;
		}
		
		if (hiding_sitting_2 == false) {
			/* add second exam sitting details to rules */
			rules.exam_no_2 = { required: true }; 
			rules.exam_year_2 = { required: true }; 
			rules.exam_type_2 = { required: true }; 
			rules.exam_centre_2 = { required: true };
			
			/* o level rules for second sitting */
			while (z < ini_o_level_2_num_row) {
				var subject = "o_level_2_subject_"+z,
					grade = "o_level_2_grade_"+z,
					obj = {};
					
				obj[subject] = { required: true };
				obj[grade] = { required: true };
				
				obj_key.push(subject, grade);
				obj_value.push(obj[subject], obj[grade]);
				z++;
			}
		}
		
		/* add all academic details rules to the rules object */
		for (j = 0; j < obj_key.length; j++) {
			rules[obj_key[j]] = obj_value[j];
		}
		
		/* add exam sitting details to rules */
		rules.exam_no_1 = { required: true }; 
		rules.exam_year_1 = { required: true }; 
		rules.exam_type_1 = { required: true }; 
		rules.exam_centre_1 = { required: true }; 
		
		//console.log(rules);
		
		return rules;
	}
	
	academic_qualification = jQuery('.academic_qualification');
	function validate_academic_details() {
		var rule = set_rules_academic_details();
		
		academic_qualification.validate(
		 {
		  rules: rule,
		  //errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_academic_details = false;
		    toggle_allow_navigation('valid_academic_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		    valid_academic_details = true;
		    toggle_allow_navigation('valid_academic_details');
		  }
		}); 
	}
	//end of the validation for academic details tab
	
	function set_rules_employment_details() {
		var i = 1,
			obj_key = [],
			obj_value = [],
			rules = {};
		
		/* Loop to push rules and keys into separate arrays for employment details */
		while (i < ini_employment_num_row) {
			var employer = "employer_"+i,
				employment_year = "employment_year_"+i,
				employer_address = "employer_address_"+i,
				obj = {};
			obj[employer] = { required: true, minlength: 3 };
			obj[employment_year] = { required: true, number: 4, minlength: 4 };
			obj[employer_address] = { required: true, minlength: 3 };
			
			obj_key.push(employer, employment_year, employer_address);
			obj_value.push(obj[employer], obj[employment_year], obj[employer_address]);
			i++;
		}
		
		/* add all employment details rules to the rules object */
		for (j = 0; j < obj_key.length; j++) {
			rules[obj_key[j]] = obj_value[j];
		}
		
		return rules;
	}
	
	employment_details = jQuery('.employment_details');
	function validate_employment_details() {
		var rule = set_rules_employment_details();
		
		employment_details.validate(
		 {
		  rules: rule,
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_employment_details = false;
		    toggle_allow_navigation('valid_employment_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		    valid_employment_details = true;
		    toggle_allow_navigation('valid_employment_details');
		  }
		}); 
	}
	//end of the validation for employement details tab
	
	function set_rules_proposed_thesis() {
		var i = 1,
			c = 1,
			obj_key = [],
			obj_value = [],
			rules = {};
		
		/* Loop to push rules and keys into separate arrays for proposed thesis */
		while (i < ini_proposed_topics_num_row) {
			var thesis_topic = "proposed_thesis_topic_"+i,
				obj = {};
			obj[thesis_topic] = { required: true, minlength: 3 };
			obj_key.push(thesis_topic);
			obj_value.push(obj[thesis_topic]);
			i++;
		}
		
		/* add all publication rules to the rules object */
		for (j = 0; j < obj_key.length; j++) {
			rules[obj_key[j]] = obj_value[j];
		}
		
		return rules;
	}
	
	proposed_thesis_details = jQuery('.proposed_thesis_details');
	function validate_proposed_thesis_details() {
		var rule = set_rules_proposed_thesis();
		rule.proposed_field_brief = { required: true };
		
		proposed_thesis_details.validate(
		 {
		  rules: rule,
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_proposed_thesis_details = false;
		    toggle_allow_navigation('valid_proposed_thesis_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		    valid_proposed_thesis_details = true;
		    toggle_allow_navigation('valid_proposed_thesis_details');
		  }
		}); 
	}
	//end of the validation for proposed thesis details tab
	
	function set_rules_publication() {
		var i = 1,
			c = 1,
			obj_key = [],
			obj_value = [],
			rules = {};
		
		/* Loop to push rules and keys into separate arrays for publication */
		while (i <= ini_pub_num_row) {
			var 
				pub_title = "publication_title_"+i,
				insti_name = "publication_institution_"+i,
				pub_qual = "publication_qualification_"+i,
				pub_date = "publication_date_"+i,
				obj = {};
			obj[pub_title] = { required: true, minlength: 3 };
			obj[insti_name] = { required: true, minlength: 3 };
			obj[pub_qual] = { required: true, minlength: 3 };
			obj[pub_date] = { required: true, minlength: 4, number:4 };
			obj_key.push(pub_title, insti_name, pub_qual, pub_date);
			obj_value.push(obj[pub_title], obj[insti_name], obj[pub_qual], obj[pub_date]);
			i++;
		}
		
		/* Loop to push rules and keys into separate arrays for other publication */
		while (c < ini_o_pub_num_row) {
			var 
				title = "other_publications_title_"+c,
				publisher = "other_publications_publisher_"+c,
				obj = {};
			obj[title] = { required: true, minlength: 3 };
			obj[publisher] = { required: true, minlength: 3 };
			obj_key.push(title, publisher);
			obj_value.push(obj[title], obj[publisher]);
			c++;
		}
		
		/* add all publication rules to the rules object */
		for (j = 0; j < obj_key.length; j++) {
			rules[obj_key[j]] = obj_value[j];
		}
		
		return rules;
	}
	
	function validate_publication_details() {
		var rule = set_rules_publication();
		
		jQuery('.publications').validate(
		 {
		  rules: rule,
		  //errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_publication_details = false;
		    toggle_allow_navigation('valid_publication_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		     valid_publication_details = true;
		     toggle_allow_navigation('valid_publication_details');
		  }
		}); 
	}
	//end of the validation for the publication details tab
	
	function set_referees_rules() {
		var i = 1,
			obj_key = [],
			obj_value = [],
			rules = {};
		/* Loop to push rules and keys into separate arrays */
		while (i <= 3) {
			var ref_title = "reference_title_id_"+i,
				ref_name = "referees_name_"+i,
				ref_email = "referees_email_"+i,
				ref_phone = "referees_phone_number_"+i,
				obj = {};
			obj[ref_title] = { required: true };
			obj[ref_name] = { required: true, minlength: 3 };
			obj[ref_email] = { required: true };
			obj[ref_phone] = { required: true};
			obj_key.push(ref_title, ref_name, ref_email, ref_phone);
			obj_value.push(obj[ref_title], obj[ref_name], obj[ref_email], obj[ref_phone]);
			i++;
		}
		
		/* add all referee rules to the rune object */
		for (j = 0; j < obj_key.length; j++) {
			rules[obj_key[j]] = obj_value[j];
		}
		return rules;
	}
	
	referees_details = jQuery('.referees_details');
	function validate_referees_details() {
		rule = set_referees_rules();
		referees_details.validate(
		 {
		  rules: rule,
		  //errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    valid_referees_details = false;
		    toggle_allow_navigation('valid_referees_details');
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');
		      valid_referees_details = true;
		      toggle_allow_navigation('valid_referees_details');
		  }
		}); 
	}
	//end of the validation for the referees details tab
	
	/*-------------------- End of Validations ----------------------------------------------------*/
	
	/*---------------------- Navigation Global Variables -------------------------------------*/
	first = jQuery("#application_tabs li:first-child").children().attr("href");
	last = jQuery("#application_tabs li:last-child").children().attr("href");
	
	disable_prev = false;
	disable_next = false;
	disabled_prev = false;
	disabled_next = false;
	next_obj = jQuery("#next");
	prev_obj = jQuery("#prev");
	
	/*---------------------- Beginning of Navigation for Tabs -------------------------------------*/
	function check_prev() {
		if (disable_prev) {
			jQuery("#prev").parent().removeClass("active disabled");
			disable_prev = false;
		}
	}
	
	function check_next() {
		if (disable_next) {
			jQuery("#next").parent().removeClass("active disabled");
			disable_next = false;
		}
	}
	
	function disable_prev_nav(current_tab) {
		if (current_tab == first) {
			jQuery("#prev").parent().addClass("disabled");
			disable_prev = true;
		}
	}
	
	if (jQuery("#application_tabs li").children().attr("href") == first) {
			jQuery("#prev").parent().addClass("disabled");
			disable_prev = true;
	}
		
	jQuery("#application_tabs li").click(function(e){
		obj = jQuery(this);
		e.preventDefault();
		obj.children().tab('show')
		/*Don't forget to change this*/
		//filled_form = true;
		/*--------------------*/
		
		current_tab = obj.children().attr("href");
		next_tab = obj.next().children().attr("href");
		prev_tab = obj.prev().children().attr("href");
		
		//console.log(current_tab);
		
		check_prev();
		check_next();
		
		next_obj.attr("href", next_tab);
		prev_obj.attr("href", prev_tab);
		
		if (current_tab == last) {
			jQuery("#next").parent().addClass("disabled");
			disable_next = true;
		}
		
		disable_prev_nav(current_tab);
	});
	
	jQuery('#prev').click(function (e) {
		e.preventDefault();
		active_tab = jQuery("#application_tabs li.active");
		 
		current_tab = active_tab.children().attr("href");
		next_tab = active_tab.next().children().attr("href");
		prev_tab =  active_tab.prev().children().attr("href");
		
		//console.log(current_tab);
		
		next_obj.attr("href", next_tab);
		prev_obj.attr("href", prev_tab);
		
		check_next();
		if (prev_tab == first) {
			disabled_prev = true;
			jQuery(this)
				.tab('show')
					.parent();
				disable_prev = true;
			if (disabled_prev == true) {
				active_tab.removeClass("active");
				active_tab.prev().addClass("active");
			}
			
		} else if (prev_tab == undefined){
			active_tab.prev().addClass("active");
		}  else {
			jQuery(this)
			.tab('show')
				.parent()
				.removeClass("active");
				
			active_tab.removeClass("active");
			active_tab.prev().addClass("active");
			disabled_prev = false;
		}
	});
	
	jQuery('#next').click(function (e) {	
		e.preventDefault();
		active_tab = jQuery("#application_tabs li.active");
		  
		current_tab = active_tab.children().attr("href");
		next_tab = active_tab.next().children().attr("href");
		prev_tab =  active_tab.prev().children().attr("href");
		
		//console.log(current_tab);
		
		next_obj.attr("href", next_tab);
		prev_obj.attr("href", prev_tab);
		
		check_prev();
		
		if (next_tab == last) {
			
			//if (filled_form == true) {
				disabled_next = true;
				jQuery(this)
					.tab('show')
						.parent();
					disable_next = true;
				if (disabled_next == true) {
					active_tab.removeClass("active");
					active_tab.next().addClass("active");
				}
			// } else {
				// display_modal("<p>You cannot proceed until you have filled and saved all the details of this form.</p>");
			// }
			
		} else if (next_tab == undefined) {
			active_tab.next().addClass("active");
		} else {
			
			//if (filled_form == true) {
				jQuery(this)
					.tab('show')
						.parent()
						.removeClass("active");
						
					active_tab
					.removeClass("active")
						.next()
						.addClass("active");
					disabled_next = false;
				filled_form = false;
			 // } else {
			 	 // disable_prev_nav(current_tab);
				 // display_modal("<p>You cannot proceed until you have filled and saved all the details of this form.</p>");
			 // }
		}
	});
	/*---------------------- End of Navigation for Tabs -------------------------------------*/
	
	/*---------------------- Save buttons --------------------------------------------------------*/
	jQuery('#personal_details_submit').click(function(){
		
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_personal_details.php",
			  data: personal_details.serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		 
		validate_personal_details();
	});
	//end of the submit button for personal details being clicked
	
	$('#academic_qualification_submit').click(function(){
		jQuery('#num_of_high_insti_rows').attr('value', ini_tetiary_institution_num_row);
		jQuery('#num_of_o_qualification_rows').attr('value', ini_o_qualification_num_row);
		jQuery('#num_of_sec_school_rows').attr('value', ini_secondary_school_num_row);
		jQuery('#num_of_exam_sitting').attr('value', num_of_sittings);
		jQuery('#num_of_award_rows').attr('value', ini_prize_num_row);
		jQuery('#num_of_o_level1').attr('value', ini_o_level_1_num_row);
		jQuery('#num_of_o_level2').attr('value', ini_o_level_2_num_row);
		
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_academic_qualifications.php",
			  data: academic_qualification.serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		
		//console.log(academic_qualification.serialize());
		validate_academic_details();
	});
	//end of the submit button for academic qualification being clicked
	
	jQuery('#employment_details_submit').click(function(){
		
		jQuery('#num_of_emp_rows').attr('value', ini_employment_num_row);
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_employment_details.php",
			  data: employment_details.serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		 
		validate_employment_details();
	});
	//end of the submit button for employment details being clicked
	
	$('#proposed_thesis_details_submit').click(function(e){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			var fd = new FormData(document.getElementById("proposed_thesis_details"));
			fd.append("label", "WEBUPLOAD");
			
			var other_data = proposed_thesis_details.serialize();
			$.each(other_data, function(key, input){
				fd.append(input.name, input.value);
			});
			
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_proposed_thesis_details.php",
			  data: fd,
			  enctype: 'multipart/form-data',
			  processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		 
		validate_proposed_thesis_details();
	});
	//end of the submit button for proposed details being clicked
	
	$('#publication_details_submit').click(function(){
		jQuery('#num_of_pub_rows').attr('value', ini_pub_num_row);
		jQuery('#num_of_o_pub_rows').attr('value', ini_o_pub_num_row);
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_publication_details.php",
			  data: jQuery(".publications").serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		
		validate_publication_details();
	});
	//end of the submit button for publication details being clicked
	
	$('#referees_details_submit').click(function(){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_referees_details.php",
			  data: referees_details.serialize()
			}).done(function( msg ) {
					message = msg.split(';');
					
					id = message[0].split(':');
					$('#hr_1').attr('value', id[0]);
					$('#hr_2').attr('value', id[1]);
					$('#hr_3').attr('value', id[2]);
					display_modal(message[1]);
				});
			}
		 });
	  	
	  	validate_referees_details();
	});
	//end of the submit button for referees details being clicked
	
	/* for other programme on diploma form */
	$('#other_programme_submit').click(function(){
		jQuery.validator.setDefaults({
			submitHandler: function() {
				show_modal();
			jQuery.ajax({
			  type: "POST",
			  url: "ajax/ajax_other_programme_details.php",
			  data: other_programme_details.serialize()
			}).done(function( msg ) {
					
					display_modal(msg);
				});
			}
		 });
		 
		if(validate_function == 1)
		{
			validate_other_programmes();
		}
		else
		{
			validate_other_programmes2();
		}
	});
	
	
	/* Passport Save function */
	$('#passport_submit').click(function(e){
		//e.preventDefault();
		//console.log("submit event");
		show_modal();
            var fd = new FormData(document.getElementById("passportupload"));
            fd.append("label", "WEBUPLOAD");
            $.ajax({
              url: "ajax/ajax_passport.php",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				
                display_modal(data);
            });
            return false;
	}); 
	
	/** validate passport function */
	
	function validate_passport() {
		jQuery('.passport').validate(
		 {
		  rules: {
		  	picture: {
		      required: true
		   	}
		  },
		  errorClass: "help-inline",
		  highlight: function(label) {
		    jQuery(label).closest('.control-group').removeClass('success').addClass('error');
		    
		  },
		  success: function(label) {
		    label
		      .text('OK!').addClass('valid')
		      .closest('.control-group').addClass('success');

		  }
		});
	}
	
	/* File Uploads Save function */
	$('#upload_files_submit').click(function(e){
		e.preventDefault();
		show_modal();
            var fd = new FormData(document.getElementById("uploadfiles"));
            fd.append("label", "WEBUPLOAD");
            
            $.ajax({
              url: "ajax/ajax_upload_files.php",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
				
                display_modal(data);
            });
            return false;
	});
	
	close_btn = jQuery('#close');
	
	/* complete application button */
	jQuery('#complete_application').click(function(e){
		close_btn.hide();
		e.preventDefault();
		  show_modal();
		  jQuery.ajax({
			  type:"POST",
			  url: "ajax/ajax_complete_application.php",
		  }).done(function(msg){
			  display_modal(msg);
		  });
	});
	
	/*---------------------- End of Save buttons --------------------------------------------------------*/
	
	
	// variable validate_function checks if the field have you applied to another institution to determine what the validation will look like
	
	var validate_function;
	
	if(jQuery('#applied_to_other_institution_yes').is(':checked'))
	{
		jQuery('.other_university_details').css('display', 'block');
		validate_function = 2;
	}
	
	jQuery('input[name=applied_to_other_institution]').click(function(){
		if(jQuery(this).val() == 1)
		{
			jQuery('.other_university_details').slideDown('slow', '', function(){
				validate_function = 2;
			});
		}
		else if(jQuery(this).val() == 0)
		{
			jQuery('.other_university_details').slideUp('slow', '', function(){
				validate_function = 1;
			});
		}
	});
	
}); // end document.ready