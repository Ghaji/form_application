<?php
function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'layout'.DS.$template);
}

function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

function customEncrypt($string)
{
	//encode the initial string sent
	$encodedString = base64_encode($string);
	//generate random 4 digit integer
	$first_int_part = rand(1000, 9999);
	
	$last_int_part = rand(1000, 9999);
	
	//concatenate the random digits with the encoded string
	return $first_int_part.$encodedString.$last_int_part;
}

function customDecrypt($string)
{
	//remove the first 4 digits random integer
	$string_without_first_int = substr($string, 4);
	//remove the last 4 digit random integer
	$string_without_last_int = substr($string_without_first_int, 0, strlen($string_without_first_int)-4);
	//decode the remaining string
	return base64_decode($string_without_last_int);
}
function pageredirect($url)
{
	echo "
	<script type='text/javascript'>

		location.replace('".$url."');
					
	</script>";	
}
function form_id_generator($applicant_id, $programme)
{
	//get the length of random number to generate
	$random_number_length = 6 - strlen($applicant_id);
	//get d last two digits of the session
	
	$database = new MySQLDatabase();
	$selectsessionsql = $database->query("SELECT session FROM application_status WHERE id=1");
	$result = $database->fetch_array($selectsessionsql);
	$year = explode('/', $result['session']);
	$year = substr($year[0], 2, 2);
	$random_number = rand(pow(10, ($random_number_length-1)), pow(10, $random_number_length) - 1);
	
	// The function returns year, programme
	return $year.$programme.$random_number.$applicant_id;
}


function greeting(){

	$time = date("H:i:s");

    if($time > '00:00:00' && $time < '12:00:00'){
        $msg = 'Good Morning';
    }
    elseif($time > '12:00:00' && $time < '18:00:00'){
        $msg = 'Good Afternoon';
    }
    else{
        $msg = 'Good Evening';
    }

		$greeting = "$msg";

	return $greeting;
} 
function randomDigits($numDigits) {
if ($numDigits <= 0) {
	return '';
}
return mt_rand(1, 9) . randomDigits($numDigits - 1);
}

function doSleep($df = 0) {
		if($df) {
			sleep($df);
		} else {
			sleep(1);
		}
		return false;
}
?>