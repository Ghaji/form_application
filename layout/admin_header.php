<?php 
	require_once ("../inc/initialize.php");
	$session = new Session();
	$db = new MySQLDatabase();
	$active_sql = "SELECT COUNT(*) FROM `notifications` WHERE status = 1 AND recipient = ".$_SESSION['applicant_id'];
	$total_active = $db->query($active_sql);
	$total_active = $db->fetch_array($total_active);
	$total_active = array_shift($total_active);
	
	$active_sql2 = "SELECT COUNT(*) FROM `applicant_notifications` WHERE status = 1 AND recipient_id = ".$_SESSION['applicant_id'];
	$total_applicant_active = $db->query($active_sql2);
	$total_applicant_active = $db->fetch_array($total_applicant_active);
	$total_applicant_active = array_shift($total_applicant_active);
	
	if($session->applicant_id == 1){
		$total_active += $total_applicant_active;
	}
	
	$inactive_sql = "SELECT COUNT(*) FROM `notifications` WHERE status = 2 AND recipient = ".$_SESSION['applicant_id'];
	$total_inactive = $db->query($inactive_sql);
	$total_inactive = $db->fetch_array($total_inactive);
	$total_inactive = array_shift($total_inactive);
	
	$inactive_sql2 = "SELECT COUNT(*) FROM `applicant_notifications` WHERE status = 2 AND recipient_id = ".$_SESSION['applicant_id'];
	$total_applicant_inactive = $db->query($inactive_sql2);
	$total_applicant_inactive = $db->fetch_array($total_applicant_inactive);
	$total_applicant_inactive = array_shift($total_applicant_inactive);
	
	$all_sql = "SELECT COUNT(*) FROM `notifications` WHERE recipient = ".$_SESSION['applicant_id'];
	$total_all = $db->query($all_sql);
	$total_all = $db->fetch_array($total_all);
	$total_all = array_shift($total_all);
?>
<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></a>

					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active">
								<a href="#" class="brand">University of Jos</a>
							</li>
                            
                            <li>
								<a href="#" class=""><?php echo greeting().', '.AdminLog::admin_fullname($session->applicant_id).'.'; ?></a>
							</li>
						</ul>

						<ul class="nav pull-right">
							<li class="dropdown">
								<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="icon-envelope"></i> </span> Mails<b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
									<li>
										<a tabindex="-1" href="sendmail.php">Send Mail</a>
									</li>
									<li class="divider"></li>
									<li>
										<a tabindex="-1" target="_blank" href="http://mail.unijos.edu.ng">Go to Unijos Mail<span><i class="icon-chevron-right"></i> </span></a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="icon-bell"></i> </span> Notifications <span class="badge badge-important"><?php echo $total_active; ?></span><b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
									<li class="nav-header">Active</li>
									<li>
										<a tabindex="-1" href="view_active_notifications.php">Unread Notifications <span class="badge badge-important"><?php echo $total_active; ?></span></a>
									</li>
                                    <?php
									if($session->applicant_id == 1){
									echo '
                                    <li>
                                    	<a tabindex="-1" href="view_applicant_active_notifications.php">
                                        Unread Applicant Notifications <span class="badge badge-important">'.$total_applicant_active.'</span>
                                        </a>
                                    </li>';
                                    }
                                    ?>
									<li class="divider"></li>
									<li class="nav-header">Inactive</li>
									<li>
										<a tabindex="-1" href="view_inactive_notifications.php">Read Admin Notifications <span class="badge badge-success"><?php echo $total_inactive; ?></span></a>
									</li>
                                    <?php
									if($session->applicant_id == 1){
									echo '
                                    <li>
                                    	<a tabindex="-1" href="view_applicant_active_notifications.php">
                                        Read Applicant Notifications <span class="badge badge-success">'.$total_applicant_inactive.'</span>
                                        </a>
                                    </li>';
                                    }
                                    ?>
									<li class="divider"></li>
									<li class="nav-header">Send</li>
									<li>
										<a tabindex="-1" href="send_notification.php">Send Notification</a>
									</li>
									<li class="divider"></li>
									<li class="nav-header">ALL</li>
									<li>
										<a tabindex="-1" href="view_all_notifications.php"><b>View All</b><span><i class="icon-chevron-right"></i> </span> <span class="badge badge-info"><?php echo $total_all; ?></span></a>
									</li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown"><span><i class="iconic-user"></i> </span> Settings<b class="caret"></b></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
									<li>
										<a tabindex="-1" href="editprofile.php">Profile</a>
									</li>
									<li class="divider"></li>
									<li>
										<a tabindex="-1" href="logout.php?logoff=logoff">Logout</a>
									</li>
								</ul>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>