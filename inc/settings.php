<?php
require_once (LIB_PATH . DS . 'database.php');

class Settings extends DatabaseObject {
	public function closeApplicationForm($closedate, $closetime) {
		global $database;

		$sql = "UPDATE application_status SET application_close_date='" . $closedate . "', application_close_time='" . $closetime . "' WHERE id=1";

		return ($database -> query($sql) == true) ? true : false;
	}

	public function openApplicationForm($date, $time, $session) {
		global $database;

		$sql = "UPDATE application_status SET application_open_date='" . $date . "', application_open_time='" . $time . "', session='".$session."' WHERE id=1";

		return ($database -> query($sql) == true) ? true : false;
	}

	public function isApplicationOpen() {
		global $database;

		$sql = "SELECT * FROM application_status WHERE id=1";

		$result = $database -> query($sql);

		$row = $database -> fetch_array($result);

		$open_date = $row['application_open_date'];
		$open_time = $row['application_open_time'];
		$close_date = $row['application_close_date'];
		$close_time = $row['application_close_time'];

		$array_open_date = explode('-', $open_date);
		$array_open_time = explode(':', $open_time);

		$array_close_date = explode('-', $close_date);
		$array_close_time = explode(':', $close_time);

		$opentimeinsecs = mktime($array_open_time[0], $array_open_time[1], 0, $array_open_date[1], $array_open_date[2], $array_open_date[0]);

		$closetimeinsecs = mktime($array_close_time[0], $array_close_time[1], 0, $array_close_date[1], $array_close_date[2], $array_close_date[0]);
		$current_time = time();
		
		if ($current_time >= $opentimeinsecs && $current_time < $closetimeinsecs) {
			return true;
		} else {
			return false;
		}
	}

	public function getApplicationCloseDate()
	{
		global $database;
		
		$sql = "SELECT * FROM application_status WHERE id=1";

		$result = $database -> query($sql);

		$row = $database -> fetch_array($result);
		
		$closedetails = '<h5 align="center">Application Closes on '.$row['application_close_date'].' by '.$row['application_close_time'].'</h5>';
		
		return $closedetails;		
	}
	
	public function role(){
		return false;
	}
}
?>