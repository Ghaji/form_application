<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject {
	
protected static $table_name="personal_details";
public $db_fields=array('applicant_id', 'title_id','surname','first_name','middle_name','password','gender','marital_status','dob','form_id','address','lga_id','religion_id','email','phone_number','student_status','academic_prizes','country_id','admission_id','programme_applied_id', 'mail_validation', 'progress', 'type_of_programme', 'date_of_registration');
	
	public $applicant_id;
	public $title_id;
	public $surname;
	public $first_name;
	public $middle_name;
	public $password;
	public $gender;
	public $marital_status;
	public $dob;
	public $form_id;
	public $address;
	public $lga_id;
	public $religion_id;
	public $email;
	public $phone_number;
	public $student_status;
	public $academic_prizes;
	public $country_id;
	public $admission_id;
	public $programme_applied_id;
	public $mail_validation;
	public $progress;
	public $type_of_programme;
	public $date_of_registration;
	
   /**
   * This is to get User information from the database
   * Mohammed Ahmed Ghaji
   */
  	public function full_name() {
 	if(isset($this->applicant_id) && 
	isset($this->surname)) 
	{
      return $this->applicant_id. " " . $this->surname;
    } else {
      return "";
    }
  }
  /*returns applicant's fullname*/
	public static function applicant_fullname($applicant_id) {
		$applicant_details = self::find_by_id($applicant_id);
		return $applicant_details->surname.' '.$applicant_details->first_name.' '.$applicant_details->middle_name;
	}
	
 	/**
   * This is to authentic User from the database
   * Mohammed Ahmed Ghaji
   */
	public static function authenticate($username="", $password="") {
    global $database;
    $username = $database->escape_value($username);
    $password = $database->escape_value($password);

    $sql  = "SELECT * FROM ".self::$table_name;
    $sql .= " WHERE username = '{$username}' ";
    $sql .= "AND password = '{$password}' ";
    $sql .= "LIMIT 1";
    $result_array = self::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
	}
	
	
	
	/**
   * This is to authentic User from the database
   * Mohammed Ahmed Ghaji
   */
	public static function checkUNEmail($username, $email) {
    global $database;
	
    $username = $database->escape_value($username);
    $email = $database->escape_value($email);
	
	$error = array('matsayi'=>false,'user_id'=>0);
	if(isset($username) && trim($username) != ""){
		
			$sql  = "SELECT * FROM ".self::$table_name;
			$sql .= " WHERE username = '{$username}' ";
			$sql .= "LIMIT 1";
	
		  if($database->query($sql)){
			  
			  if($database->num_rows() > 0){
				  return array('matsayi'=>true,'user_id'=>$user_id);}
			  else{
				  return $error;
			  }	
		   }
		  
	}
    elseif(isset($email) && trim($email) != "" ){
		
		  $sql  = "SELECT * FROM ".self::$table_name;
		  $sql .= " WHERE email = '{$email}' ";
		  $sql .= "LIMIT 1";
		  
		  if($database->query($sql)){
			  if($database->num_rows() >= 1){
				  return array('matsayi'=>true,'user_id'=>$user_id);
			   }else{
				  return $error;
			  }	
		  }
		
	}
	else{return $error;}
	}
	
	
	
	
	/**
   * This is to get User Email and Username from the database
   * Mohammed Ahmed Ghaji
   */
	/*public static function checkUNEmailll($username, $email){
	global $database;
	
	$email = $database->escape_value($email);
	$username = $database->escape_value($username);
	$error = array('matsayi'=>false,'user_id'=>0);
	
	if(isset($email) && trim($email) != "" ){
		
		  $sql  = "SELECT * FROM ".self::$table_name;
		  $sql .= " WHERE email = '{$email}' ";
		  $sql .= "LIMIT 1";
		  
		  if($database->query($sql)){
			  if($database->num_rows() > 0){
				  return array('matsayi'=>true,'user_id'=>$user_id);}
			  else{
				  return $error;
			  }	
		  }
		
	}
	elseif(isset($username) && trim($username) != ""){
		
			$sql  = "SELECT * FROM ".self::$table_name;
			$sql .= " WHERE username = '{$username}' ";
			$sql .= "LIMIT 1";
	
		  if($database->query($sql)){
			  
			  if($database->num_rows() > 0){
				  return array('matsayi'=>true,'user_id'=>$user_id);}
			  else{
				  return $error;
			  }	
		  }
		  
	}
	else{return $error;}
		
		
	}*/
	
	public static function getSecurityQuestion($user_id)
	{
	global $database;
	$questions = array();
	$questions[0] = "What is your mother's maiden name?";
	$questions[1] = "What city were you born in?";
	$questions[2] = "What is your favorite color?";
	$questions[3] = "What year did you graduate from High School?";
	$questions[4] = "What was the name of your first boyfriend/girlfriend?";
	$questions[5] = "What is your favorite model of car?";
	
		$sql  = "SELECT `secQ` FROM ".self::$table_name;
		$sql .= " WHERE `user_id` = '{$user_id}' ";
		$sql .= "LIMIT 1";
		
	if($database->query($sql)){
		return $questions[$secQ];	  
	} else{
		return false;
	}
	}
	
	public static function checkSecAnswer($user_id,$answer)
	{
	global $database;
	
		
		$sql  = "SELECT `username` FROM ".self::$table_name;
		$sql .= " WHERE `user_id` = '{$user_id}' AND LOWER(`secA`) = '{$answer}' ";
		$sql .= "LIMIT 1";
		$database->query($sql);
		
		if($database->num_rows() > 0){
			return true;	  
		} else{
			return false;
		}
	}
	

	// Common Database Methods
	public static function find_all() {
		return self::find_by_sql("SELECT * FROM ".self::$table_name);
  }
  
  public static function find_by_id($applicant_id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE applicant_id={$applicant_id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }

	public static function count_all() {
	  global $database;
	  $sql = "SELECT COUNT(*) FROM ".self::$table_name;
      $result_set = $database->query($sql);
	  $row = $database->fetch_array($result_set);
    return array_shift($row);
	}

	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		// Simple, long-form approach:
		// $object->id 			= $record['id'];
		// $object->username 	= $record['username'];
		// $object->password 	= $record['password'];
		// $object->first_name  = $record['first_name'];
		// $object->last_name 	= $record['last_name'];
		
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach($this->db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  // sanitize the values before submitting
	  // Note: does not alter the actual value of each attribute
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	public function save() {
	  // A new record won't have an id yet.
	  return isset($this->applicant_id) ? $this->update() : $this->create();
	}
	
	public function create() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - INSERT INTO table (key, key) VALUES ('value', 'value')
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
	  	$sql = "INSERT INTO ".self::$table_name." (";
		$sql .= join(", ", array_keys($attributes));
	  	$sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  if($database->query($sql)) {
	    $this->applicant_id = $database->insert_id();
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update() {
	  global $database;
		// Don't forget your SQL syntax and good habits:
		// - UPDATE table SET key='value', key='value' WHERE condition
		// - single-quotes around all values
		// - escape all values to prevent SQL injection
		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE ".self::$table_name." SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .= " WHERE applicant_id=". $database->escape_value($this->applicant_id);
	  	if($database->query($sql) || $database->affected_rows() == 1)
	  		return true; 
		else 
			return false;
	}

	public function delete() {
		global $database;
		// Don't forget your SQL syntax and good habits:
		// - DELETE FROM table WHERE condition LIMIT 1
		// - escape all values to prevent SQL injection
		// - use LIMIT 1
	  $sql = "DELETE FROM ".self::$table_name;
	  $sql .= " WHERE user_id=". $database->escape_value($this->user_id);
	  $sql .= " LIMIT 1";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	
		// NB: After deleting, the instance of User still 
		// exists, even though the database entry does not.
		// This can be useful, as in:
		//   echo $user->first_name . " was deleted";
		// but, for example, we can't call $user->update() 
		// after calling $user->delete().
	}
	
	public function sendVerificationMail()
	{
		//$pop = new POP3();
		
		//$pop->Authorise('mail.unijos.edu.ng', 25, false, 'applicationform@unijos.edu.ng', 'application1234form', 1);
		
		$mail = new PHPMailer();				
		$mail->IsSMTP();
		//$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "mail.unijos.edu.ng";      // sets GMAIL as the SMTP server
		$mail->Port       = 25; 
		$mail->Username='applicationform@unijos.edu.ng';
		$mail->Password='application1234form';
		$mail->SetFrom('applicationform@unijos.edu.ng', 'University Of Jos');
		
		$mail->AddReplyTo('applicationform@unijos.edu.ng', 'University of Jos');
		
		$mail->Subject='Verify Mail Address';
		
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/app_form_template/verify.php?'.md5('email').'='.customEncrypt($this->email);
			  
$MSG =  '
<style type="text/css">
.codrops-top{
	line-height: 55px;
	font-size: 30px;
	/*background: rgba(255, 255, 255, 0.4);*/
	background:#069;
	/*text-transform: uppercase;*/
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}
.codrops-top span.left{
	float: left;
	margin-top:10px;
	margin-left: 20px;
}
.codrops-top span.nxt{
	float: center;
	margin-top:10px;
	/*margin-left: 20px;*/
}
.codrops-top span.right{
	float: center;
}
.message
{
	width:600px;
	min-height:500px;
	padding:10px;
	margin-top:10px;
	margin:auto;
	text-align:justify;
	font-size:16px;
}
.verify_link{
	margin:auto;
	text-align:center;
}
.verify_link a
{
	margin:auto;
	text-decoration:none;
	color:blue;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	color:#f00;
	border-bottom:1px solid #f00;
}

</style>
<div class="codrops-top">
   <span class="left"><img src="http://mis.unijos.edu.ng/images/logo.png" width="80" height="90" alt="University of Jos Logo"></span>
    <span class="right"><center><font color="#FFFFFF">UNIVERSITY OF JOS - NIGERIA</font></center></span>
    <div class="nxt"><center><font color="#FFFFFF">Corporate Information System (CIS)</font></center></div>
    <div class="clr"></div>	
</div>
<div class="message">
	Hi, '.$this->surname.' '.$this->first_name.' '.$this->middle_name.'<br/>
	<p>Thank you for creating an account on University of Jos, Nigeria for application</p>
	<p>Before you can continue your registration you must verify your email address. This is to ensure that the email you provided during your registration was correct</p>
	<p>Use the link below to verify your mail and continue your registration</p>
	<p>Note that if you do not verify your mail after two weeks your account will be deleted</p>
	<div class="verify_link"><a href="'.$verification_link.'">Verify</a></div>
</div>';
		
		$mail->MsgHTML($MSG);
		$mail->AddAddress($this->email, $this->surname.' '.$this->first_name.' '.$this->middle_name);
		
		if(!$mail->Send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function sendPasswordReset()
	{
		//$pop = new POP3();
		
		//$pop->Authorise('mail.unijos.edu.ng', 25, false, 'applicationform@unijos.edu.ng', 'application1234form', 1);
		
		$mail = new PHPMailer();				
		$mail->IsSMTP();
		//$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "mail.unijos.edu.ng";      // sets GMAIL as the SMTP server
		$mail->Port       = 25; 
		$mail->Username='applicationform@unijos.edu.ng';
		$mail->Password='application1234form';
		$mail->SetFrom('applicationform@unijos.edu.ng', 'University Of Jos');
		
		$mail->AddReplyTo('applicationform@unijos.edu.ng', 'University of Jos');
		
		
		$mail->Subject='Password Reset';
		
		$pwdreset_link = 'http://'.$_SERVER['HTTP_HOST'].'/app_form_template/passwordreset.php?'.md5('email').'='.customEncrypt($this->email);
			  
$MSG =  '
<style type="text/css">
.codrops-top{
	line-height: 55px;
	font-size: 30px;
	/*background: rgba(255, 255, 255, 0.4);*/
	background:#069;
	/*text-transform: uppercase;*/
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}
.codrops-top span.left{
	float: left;
	margin-top:10px;
	margin-left: 20px;
}
.codrops-top span.nxt{
	float: center;
	margin-top:10px;
	/*margin-left: 20px;*/
}
.codrops-top span.right{
	float: center;
}
.message
{
	width:600px;
	min-height:500px;
	padding:10px;
	margin-top:10px;
	margin:auto;
	text-align:justify;
	font-size:16px;
}
.verify_link{
	margin:auto;
	text-align:center;
}
.verify_link a
{
	margin:auto;
	text-decoration:none;
	color:blue;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	color:#f00;
	border-bottom:1px solid #f00;
}

</style>
<div class="codrops-top">
   <span class="left"><img src="http://mis.unijos.edu.ng/images/logo.png" width="80" height="90" alt="University of Jos Logo"></span>
    <span class="right"><center><font color="#FFFFFF">UNIVERSITY OF JOS - NIGERIA</font></center></span>
    <div class="nxt"><center><font color="#FFFFFF">Corporate Information System (CIS)</font></center></div>
    <div class="clr"></div>	
</div>
<div class="message">
	Hi, '.$this->full_name().'<br/>
	<p>To reset your password, follow the link below</p>
	<p>Note: This link will expire after 48 hours</p>
	<div class="verify_link"><a href="'.$pwdreset_link.'" >Reset Password</a></div>
</div>';

		$mail->MsgHTML($MSG);
		$mail->AddAddress($this->email, $this->full_name());
		//print_r($mail);
		if(!$mail->Send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	
	public function registrationConfirmationMail()
	{
		//$pop = new POP3();
		
		//$pop->Authorise('mail.unijos.edu.ng', 25, false, 'applicationform@unijos.edu.ng', 'application1234form', 1);
		
		$mail = new PHPMailer();				
		$mail->IsSMTP();
		//$mail->SMTPDebug  = 1;
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "tls";                 // sets the prefix to the servier
		$mail->Host       = "mail.unijos.edu.ng";      // sets GMAIL as the SMTP server
		$mail->Port       = 25; 
		$mail->Username='applicationform@unijos.edu.ng';
		$mail->Password='application1234form';
		$mail->SetFrom('applicationform@unijos.edu.ng', 'University Of Jos');
		
		$mail->AddReplyTo('applicationform@unijos.edu.ng', 'University of Jos');
		
		$mail->Subject='Registration Confirmation';
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/app_form_template/verify.php?'.md5('email').'='.customEncrypt($this->email);
			  
$MSG =  '
<style type="text/css">
.codrops-top{
	line-height: 55px;
	font-size: 30px;
	/*background: rgba(255, 255, 255, 0.4);*/
	background:#069;
	/*text-transform: uppercase;*/
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}
.codrops-top span.left{
	float: left;
	margin-top:10px;
	margin-left: 20px;
}
.codrops-top span.nxt{
	float: center;
	margin-top:10px;
	/*margin-left: 20px;*/
}
.codrops-top span.right{
	float: center;
}
.message
{
	width:600px;
	min-height:500px;
	padding:10px;
	margin-top:10px;
	margin:auto;
	text-align:justify;
	font-size:16px;
}
.verify_link{
	margin:auto;
	text-align:center;
}
.verify_link a
{
	margin:auto;
	text-decoration:none;
	color:blue;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	color:#f00;
	border-bottom:1px solid #f00;
}

</style>
<div class="codrops-top">
   <span class="left"><img src="http://mis.unijos.edu.ng/images/logo.png" width="80" height="90" alt="University of Jos Logo"></span>
    <span class="right"><center><font color="#FFFFFF">UNIVERSITY OF JOS - NIGERIA</font></center></span>
    <div class="nxt"><center><font color="#FFFFFF">Corporate Information System (CIS)</font></center></div>
    <div class="clr"></div>	
</div>
<div class="message">
	Hi, '.$this->surname.' '.$this->first_name.' '.$this->middle_name.'<br/>
	<p>Thank you for completing your registration for admission into University of Jos, Jos Nigeria.</p>
	<p>This is a confirmation email that your application into University of Jos has been received, you can always login to track your admission status.</p>
	<p>Thank you once more for applying into University of Jos, Jos Nigeria</p>
</div>';

		$mail->MsgHTML($MSG);
		$mail->AddAddress($this->email, $this->surname.' '.$this->first_name.' '.$this->middle_name);
		
		if(!$mail->Send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
	public function get_form_id()
	{
		$sql = "SELECT `form_id` FROM ".self::$table_name." WHERE `applicant_id`=".$this->applicant_id." LIMIT 1";
		$returned_data = self::find_by_sql($sql);
		foreach($returned_data as $user)
		{
			$user->form_id;
		}
		return $user->form_id;
	}
	
	public function get_student_status()
	{
		$sql = "SELECT `student_status` FROM ".self::$table_name." WHERE `applicant_id`=".$this->applicant_id." LIMIT 1";
		$returned_data = self::find_by_sql($sql);
		foreach($returned_data as $user)
		{
			$user->student_status;
		}
		return $user->student_status;
	}
	
	public function updateProgress($tab_letter)
	{
		$sql_progress = "SELECT progress FROM ".self::$table_name." WHERE `applicant_id` = '".$this->applicant_id."'";
		
		$result_array = self::find_by_sql($sql_progress);
		
		$progress = !empty($result_array) ? array_shift($result_array) : false;
		
		$current_progress = $progress->progress;
		
		$array_current_progress = str_split($current_progress);
		
		if(!in_array($tab_letter, $array_current_progress))
		{
			$this->db_fields = array('progress');
		
			$this->progress = $current_progress.$tab_letter;

			$this->save();
		}
	}
}

?>