<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Invoice extends DatabaseObject {
	
 protected static $table_name="invoice";
 public $db_fields=array('invoice_id', 'applicant_id','date', 'amount');
	
	public $invoice_id;
	public $applicant_id;
	public $date;
	public $amount;
	
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
   * This is to get User Email and Username from the database
   * Mohammed Ahmed Ghaji
   */
	/*public static function checkUNEmailll($username, $email){
	global $database;
	
	$email = $database->escape_value($email);
	$username = $database->escape_value($username);
	$error = array('matsayi'=>false,'applicant_id'=>0);
	
	if(isset($email) && trim($email) != "" ){
		
		  $sql  = "SELECT * FROM ".self::$table_name;
		  $sql .= " WHERE email = '{$email}' ";
		  $sql .= "LIMIT 1";
		  
		  if($database->query($sql)){
			  if($database->num_rows() > 0){
				  return array('matsayi'=>true,'applicant_id'=>$applicant_id);}
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
				  return array('matsayi'=>true,'applicant_id'=>$applicant_id);}
			  else{
				  return $error;
			  }	
		  }
		  
	}
	else{return $error;}
		
		
	}*/
	

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
		// $object->applicant_id 			= $record['applicant_id'];
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
	  // A new record won't have an applicant_id yet.
	  return isset($this->invoice_id) ? $this->update() : $this->create();
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
	  $sql .= " WHERE applicant_id=". $database->escape_value($this->applicant_id);
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
	


}

?>