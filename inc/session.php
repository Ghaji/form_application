<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {
	
	private $logged_in=false;
	public $applicant_id;
	public $message;
	
	function __construct() {
		session_start();
		$this->check_message();
		$this->check_login();
    if($this->logged_in) {
      // actions to take right away if user is logged in
    } else {
      // actions to take right away if user is not logged in
    }
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }

	public function is_admin_logged_in(){
		if($_SESSION['role'] == true && $this->logged_in == true){
			return true;
		}else{
			return false;
		}
	}
  // store applicant_id is a session
  public function login($applicant_id) {
    if($applicant_id){
      $this->applicant_id = $_SESSION['applicant_id'] = $applicant_id;
      $this->logged_in = true;
    }
  }
  
  public function admin_login($applicant_id) {
    if($applicant_id){
      $this->applicant_id = $_SESSION['applicant_id'] = $applicant_id;
	  $this->role = true;
      $this->logged_in = true;
    }
  }
  
  public function logout() {
    unset($_SESSION['applicant_id']);
    unset($this->applicant_id);
    $this->logged_in = false;
	session_destroy();
  }

	public function message($msg="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
	    $_SESSION['message'] = $msg;
	  } else {
	    // then this is "get message"
			return $this->message;
	  }
	}

	private function check_login() {
    if(isset($_SESSION['applicant_id'])) {
      $this->applicant_id = $_SESSION['applicant_id'];
      $this->logged_in = true;
    } else {
      unset($this->applicant_id);
      $this->logged_in = false;
    }
  }
  
	private function check_message() {
		// Is there a message stored in the session?
	if(isset($_SESSION['message'])) {
			// Add it as an attribute and erase the stored version
      $this->message = $_SESSION['message'];
      unset($_SESSION['message']);
    } else {
      $this->message = "";
    }
	}
	
}

$session = new Session();
$message = $session->message();

?>