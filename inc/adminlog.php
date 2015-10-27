<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class AdminLog extends DatabaseObject {
	
 protected static $table_name="admin_users";
 public $db_fields=array('user_id', 'staff_id', 'email', 'password', 'surname', 'othernames', 'rank', 'last_logged_in', 'edit_status', 'activated_status', 'role', 'department_id');
	
	public $user_id;
	public $staff_id;
	public $email;
	public $password;
	public $surname;
	public $othernames;
	public $rank;
	public $last_logged_in;
	public $edit_status;
	public $activated_status;
	public $role;
	public $department_id;
	
   /**
   * This is to get User information from the database
   * Mohammed Ahmed Ghaji
   */
  	public function full_name() {
 	if(isset($this->user_id) && 
	isset($this->surname)) 
	{
      return $this->user_id. " " . $this->surname;
    } else {
      return "";
    }
  }
  /*returns applicant's fullname*/
	public static function admin_fullname($user_id) {
		$applicant_details = self::find_by_id($user_id);
		return $applicant_details->surname.' '.$applicant_details->othernames;
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
  
  public static function find_by_id($user_id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE user_id={$user_id} LIMIT 1");
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
	  return isset($this->user_id) ? $this->update() : $this->create();
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
	    $this->user_id = $database->insert_id();
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
		$sql .= " WHERE user_id=". $database->escape_value($this->user_id);
		
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
	
	public function sendVerificationMail($password)
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
		
		$mail->Subject='Account Created on UNIJOS';
		
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/mis.unijos.edu.ng/app_form_template/tsaro/index.php';
			  
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
.verify_link
{
	width:120px;
	height:50px;
	font-size:16px;
	text-align:center;
	margin-top:30px;
	background:#069;
	margin:auto;
	border-radius:5px;
	color:#fff;
	padding-top:10px;
}
.verify_link a
{
	text-decoration:none;
	color:#fff;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	border-bottom:1px solid #fff;
}

</style>
<div class="codrops-top">
   <span class="left"><img src="http://mis.unijos.edu.ng/images/logo.png" width="80" height="90" alt="University of Jos Logo"></span>
    <span class="right"><center><font color="#FFFFFF">UNIVERSITY OF JOS - NIGERIA</font></center></span>
    <div class="nxt"><center><font color="#FFFFFF">Corporate Information System (CIS)</font></center></div>
    <div class="clr"></div>	
</div>
<div class="message">
	Hi, '.$this->surname.' '.$this->othernames.'<br/>
	<p>An admministrative account has been created for you on University of Jos Application portal</p>
	<p>Use the following details to log in by clicking on the link below</p>
	<p>Ensure that you change your password once you log in</p>
	<p>Staff ID: '.$this->staff_id.'<br>Password: '.$password.'</p>
	<div class="verify_link"><a href="'.$verification_link.'">Verify</a></div>
</div>';

		$mail->MsgHTML($MSG);
		$mail->AddAddress($this->email, $this->surname.' '.$this->othernames);
		
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
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/mis.unijos.edu.ng/app_form_template/passwordreset.php?'.md5('email').'='.customEncrypt($this->email);
			  
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
.verify_link
{
	width:180px;
	height:50px;
	font-size:16px;
	text-align:center;
	margin-top:30px;
	background:#069;
	margin:auto;
	border-radius:5px;
	color:#fff;
	padding-top:10px;
}
.verify_link a
{
	text-decoration:none;
	color:#fff;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	border-bottom:1px solid #fff;
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
	
	<div class="verify_link"><a href="'.$verification_link.'" >Reset Password</a></div>
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
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/mis.unijos.edu.ng/app_form_template/verify.php?'.md5('email').'='.customEncrypt($this->email);
			  
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
.verify_link
{
	width:120px;
	height:50px;
	font-size:16px;
	text-align:center;
	margin-top:30px;
	background:#069;
	margin:auto;
	border-radius:5px;
	color:#fff;
	padding-top:10px;
}
.verify_link a
{
	text-decoration:none;
	color:#fff;
	font-weight:bold;
	font-size:24px;
}
.verify_link a:hover
{
	border-bottom:1px solid #fff;
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
	<p>This is a confirmation email that your application into '.$this->programme_applied_id.', you can always login to track your admission status.</p>
	<p>Thnak yo once more for applying into University of Jos, Jos Nigeria</p>
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
		$sql = "SELECT `form_id` FROM ".self::$table_name." WHERE `user_id`=".$this->user_id." LIMIT 1";
		$returned_data = self::find_by_sql($sql);
		foreach($returned_data as $user)
		{
			$user->form_id;
		}
		return $user->form_id;
	}
	
	public function get_student_status()
	{
		$sql = "SELECT `student_status` FROM ".self::$table_name." WHERE `user_id`=".$this->user_id." LIMIT 1";
		$returned_data = self::find_by_sql($sql);
		foreach($returned_data as $user)
		{
			$user->student_status;
		}
		return $user->student_status;
	}
	
	public function updateProgress($tab_letter)
	{
		$sql_progress = "SELECT progress FROM ".self::$table_name." WHERE `user_id` = '".$this->user_id."'";
		
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