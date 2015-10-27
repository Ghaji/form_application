<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class HigherInstitutions extends DatabaseObject {
	
 protected static $table_name="higher_institutions";
 public $db_fields=array('high_id','applicant_id','institution_name', 'registration_no', 'class_of_degree','year_of_attendance','graduation_year','degree_earned','cgpa','course_of_study');
	
	public $high_id;
	public $applicant_id;
	public $institution_name;
	public $class_of_degree;
	public $year_of_attendance;
	public $graduation_year;
	public $degree_earned;
	public $cgpa;
	public $course_of_study;
	public $registration_no;
	
	/**
   * This is to get applicant publication information from the database
   * Mohammed Ahmed Ghaji
   */
   
   	public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = self::instantiate($row);
    }
    return $object_array;
  }
	
  	public static function find_by_id($applicant_id=0) {
		$result_array = self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE applicant_id={$applicant_id} LIMIT 1");
		return !empty($result_array) ? array_shift($result_array) : false;
  	}
	
	private static function instantiate($record) {
		// Could check that $record exists and is an array
    $object = new self;
		
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
	  return isset($this->high_id) ? $this->update() : $this->create();
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
		$sql .= " WHERE high_id=". $database->escape_value($this->high_id);
	  	if($database->query($sql) || $database->affected_rows() == 1)
	  		return true; 
		else 
			return false;
	}
	
  	// public function higher_institutions() {
 	// if(isset($this->high_id) && 
	// isset($this->applicant_id)) 
	// {
      // return $this->high_id. " " . $this->applicant_id;
    // } else {
      // return "";
    // }
  // }	
	
	
}