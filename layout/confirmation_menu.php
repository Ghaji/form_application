<?php 
	$db = new MySQLDatabase();
  
  $session = new Session();
	$applicant_fullname = User::applicant_fullname($session->applicant_id);
	$result_details = User::find_by_id($session->applicant_id);
	$display_greeting = greeting();
	
	/**/ 
	$active_sql = "SELECT COUNT(*) FROM `applicant_notifications` WHERE status = 1 AND recipient_id = ".$session->applicant_id;
	$total_active = $db->query($active_sql);
	$total_active = $db->fetch_array($total_active);
	$total_active = array_shift($total_active);
	
	$inactive_sql = "SELECT COUNT(*) FROM `applicant_notifications` WHERE status = 2 AND recipient_id = ".$session->applicant_id;
	$total_inactive = $db->query($inactive_sql);
	$total_inactive = $db->fetch_array($total_inactive);
	$total_inactive = array_shift($total_inactive);
	
	$admissions = new Admission();
  
  $sql = "select * from admission_status where applicant_id='".$session->applicant_id."'";
  $admissions = Admission::find_by_sql($sql);
  foreach($admissions as $admission):
    $time = $admission->time_completed_application;
    $academic_session = $admission->academic_session;
    $status = $admission->status;
    $reason_ = $admission->reason;
  endforeach;
	
?>

<div class="navbar">
  <div class="navbar-inner"> <a class="brand" href="#"></a>
    <ul class="nav nav-tabs">
      <li class="active"><a href="home.php"><span><i class="icon-home"></i> </span> Home</a></li>
      <li class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"> <span><i class="icon-leaf"></i> </span> Activity Menu <b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
        <li class="nav-header">Check</li>
          <li class="divider"></li>
          <li><a href="admission_status.php">Admission Status</a></li>
          <li class="divider"></li>
          <li class="nav-header">Print</li>
          <li class="divider"></li>
          <li><a href="confirmation.php">Application Form</a></li>
          <li class="divider"></li>
          <li><a href="invoice.php">Form Payment Invoice</a></li>
          <?php
          if($status == 5) {
          ?>
            <li class="divider"></li>
            <li><a href="admission_letter.php">Admission Letter</a></li>
            <li class="divider"></li>
            <li><a href="academic_transcript.php">Transcript Request Form</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
      <li class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="icon-bell"></i> </span> Notifications <span class="badge badge-important"><?php echo $total_active; ?></span><b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
          <li class="nav-header">Active</li>
          <li> <a tabindex="-1" href="view_active_notifications.php">Unread <span class="badge badge-important"><?php echo $total_active; ?></span></a> </li>
          <li class="divider"></li>
          <li class="nav-header">Inactive</li>
          <li> <a tabindex="-1" href="view_inactive_notifications.php">Read <span class="badge badge-success"><?php echo $total_inactive; ?></span></a> </li>
          <li class="divider"></li>
          <li class="nav-header">Send</li>
          <li> <a tabindex="-1" href="send_notification.php">Send Message</a> </li>
          
        </ul>
      </li>
    </ul>
    <ul class="nav pull-right">
      <li><a href="#"> <span style="font-weight: bold; text-shadow: 1px 1px 4px"><i class="iconic-user"></i> <?php echo $display_greeting . ',  ' . $applicant_fullname; ?></span></a></li>
      <li></li>
      <li class="dropdown"> <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="icon-wrench"></i> </span> Settings <b class="caret"></b></a>
        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
          <li> <a href="logout.php?logoff">Logout <i class="icon-off"></i></a> </li>
        </ul>
      </li>
    </ul>
  </div>
</div>
