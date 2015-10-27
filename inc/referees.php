<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Referees extends DatabaseObject {
	
 protected static $table_name = "referees";
 public $db_fields=array('referees_id','applicant_id','referee_title_id','referee_name','referee_email','referee_phone_number','referee_form_status','referee_job_description','referee_address','referee_highest_qualification_obtained','rank_candidate','questionnaire','comments_on_candidate', 'how_long', 'what_capacity');
	
	public $referees_id;
	public $applicant_id;
	public $referee_title_id;
	public $referee_name;
	public $referee_email;
	public $referee_phone_number;
	public $referee_form_status;
	public $referee_job_description;
	public $referee_address;
	public $referee_highest_qualification_obtained;
	public $rank_candidate;
	public $questionnaire;
	public $comments_on_candidate;
	public $how_long;
	public $what_capacity;
	

	

	/**
   * This is to get applicant publication information from the database
   * Mohammed Ahmed Ghaji
   */
   
     public static function find_by_id($referees_id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE referees_id={$referees_id}");
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
		return isset($this->referees_id) ? $this->update() : $this->create();
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
	   // $this->referees_id = $database->insert_id();
	    //return true;
	    return $database->insert_id();
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
		$sql .= " WHERE referees_id=". $database->escape_value($this->referees_id);

	  	if($database->query($sql) || $database->affected_rows() == 1)
	  		return true; 
		else 
			return false;
	}
   
   
   /*
  	public function referees() {
 	if(isset($this->referees_id) && 
	isset($this->applicant_id)) 
	{
      return $this->referees_id. " " . $this->applicant_id;
    } else {
      return "";
    }
  }	
	*/
	
	public function sendRefereeMail($applicant_name)
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
		
		$mail->Subject='Referee Notification';
		
		$verification_link = 'http://'.$_SERVER['HTTP_HOST'].'/app_form_template/referee.php?'.md5('id').'='.customEncrypt($this->referees_id);
			  
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
	Hi '.$this->referee_name.',<br/>
	<p>You have been selected as a referee by '.$applicant_name.'. Please follow the link below to fill in the referee form.</p>
	<p>Note: The information will be verified and any false input will jeopardize the candidate\'s chances of getting admission</p>
	<p>Use the link below to referee the application</p>
	<div class="verify_link"><a href="'.$verification_link.'" >Referee Form</a></div>
</div>';

		$mail->MsgHTML($MSG);
		$mail->AddAddress($this->referee_email, $this->referee_name);
		
		if(!$mail->Send())
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	
}