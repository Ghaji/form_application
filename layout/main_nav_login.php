<?php 
	$session = new Session();
	$applicant_fullname = User::applicant_fullname($session->applicant_id);
	$result_details = User::find_by_id($session->applicant_id);
	$display_greeting = greeting();
	
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
	
	
?>
<div class="navbar">
        <div class="navbar-inner">
          <a class="brand" href="#"></a>
			<ul class="nav nav-tabs">
            	<li><a href="application_form.php">Home</a></li>
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
            		<li><a href="#">
                    <span style="color: #09F; font-weight: bold; text-shadow: 1px 1px 4px #F89406"><i class="iconic-user"></i> <?php echo $display_greeting . ',  ' . $applicant_fullname; ?></span></a></li>
                    <li></li>
                    
                    <li class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="icon-wrench"></i> </span> Settings <b class="caret"></b></a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                            <li>
                            	<a href="logout.php?logoff">Logout <i class="icon-off"></i></a>
                            </li>
                        </ul>
                    </li>
             </ul>
           </div>
          </div>