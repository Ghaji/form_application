<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'mis.unijos.edu.ng'.DS.'app_form_template');
defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'inc');

//load config file first
require_once(LIB_PATH.DS.'config.php');


//require_once(LIB_PATH.DS.'javascript.php');
//require_once(LIB_PATH.DS.'css.php');

//load core objects
require_once(LIB_PATH.DS.'session.php');
require_once(LIB_PATH.DS.'database.php');
require_once(LIB_PATH.DS.'database_object.php');
//require_once(LIB_PATH.DS.'pagination.php');
require_once(LIB_PATH.DS."phpmailer".DS."class.phpmailer.php");
require_once(LIB_PATH.DS."phpmailer".DS."class.smtp.php");
require_once(LIB_PATH.DS."phpmailer".DS."class.pop3.php");
//require_once(LIB_PATH.DS."phpmailer".DS."language".DS."phpmailer.lang-en.php");

//load database-related classes
require_once(LIB_PATH.DS.'user.php');
require_once(LIB_PATH.DS.'kin.php');
require_once(LIB_PATH.DS.'theme.php');
require_once(LIB_PATH.DS.'thesis.php');
require_once(LIB_PATH.DS.'admission.php');
require_once(LIB_PATH.DS.'news_event.php');
require_once(LIB_PATH.DS.'admission_requirements.php');
require_once(LIB_PATH.DS.'programme_type.php');
//require_once(LIB_PATH.DS.'employment.php');
require_once(LIB_PATH.DS.'other_programme.php');
require_once(LIB_PATH.DS.'higher_institutions.php');
require_once(LIB_PATH.DS.'qualifications.php');
require_once(LIB_PATH.DS.'secondary_school_user.php');
require_once(LIB_PATH.DS.'olevel.php');
require_once(LIB_PATH.DS.'photograph.php');
require_once(LIB_PATH.DS.'settings.php');
//require_once(LIB_PATH.DS.'comment.php');
//load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');
?>
