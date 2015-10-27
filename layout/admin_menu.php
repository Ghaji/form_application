<div class="span3 bs-docs-sidebar">
				<ul class="nav nav-list bs-docs-sidenav affix">
					<li class="dropdown"> 
						<a href="#" id="drop4" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="iconic-user"></i> User Settings<span><i class="icon-chevron-right"></i> </span></b></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop4">
							<li>
								<a tabindex="-1" href="editprofile.php">Edit Profile</a>
							</li>
                            <?php
								if($_SESSION['role'] == 1){
									echo '
									<li>
										<a tabindex="-1" href="register.php">Add User</a>
									</li>
									<li>
										<a tabindex="-1" href="view_users.php">View Users</a>
									</li>';
								}
							?>
							
						</ul>
					</li>
					<?php
						if($_SESSION['role'] == 1){
					?>
					<li class="dropdown">
						<a href="#" id="drop2" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="iconic-cog"></i> General Settings<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop2">
							<li>
								<a tabindex="-1" href="flush.php">Flush Database</a>
							</li>
                            <li class="divider"></li>
							<li>
								<a tabindex="-1" href="validation.php">Validation Mail</a>
							</li>
                            <li>
								<a tabindex="-1" href="refereemail.php">Referee Mail</a>
							</li>
							<li class="divider"></li>
						</ul>
					</li>
					<?php
						}
					?>
					<?php
					if($_SESSION['role'] == 1 || $_SESSION['role'] != 7 || $_SESSION['role'] != 9){
					?>
					<li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-aperture"></i> Applicant Details<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
							<?php
							if($_SESSION['role'] == 1 || $_SESSION['role'] != 7 || $_SESSION['role'] != 9){
							?>
							<li>
								<a tabindex="-1" href="view_applicant.php">View Applicant</a>
							</li>
							<?php
							}

							if($_SESSION['role'] == 1 || $_SESSION['role'] != 7 || $_SESSION['role'] != 9){
							?>
							<li>
								<a tabindex="-1" href="view_summary.php">Generate Report</a>
							</li>
							<?php
							}
							?>
						</ul>
					</li>
                    <?php
                    }
						if($_SESSION['role'] == 1){
					?>
                    <li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="iconic-wrench"></i> Application Settings<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="openapplication.php">Open Application</a>
							</li>
							<li>
								<a tabindex="-1" href="closeapplication.php">Close Application</a>
							</li>
							<li>
								<a tabindex="-1" href="set_programmes.php">Set Programmes</a>
							</li>
							<?php
							if($_SESSION['role'] <= 2){
							?>
								<li>
									<a tabindex="-1" href="set_ineligible_reasons.php">Ineligiblity Settings</a>
								</li>
							<?php	
							}
							?>							
						</ul>
					</li>
					<?php
						}
					?>
                    
                    <?php
						if($_SESSION['role'] == 1 || $_SESSION['role'] == 6 || $_SESSION['role'] == 9){
					?>
                    <li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-tag"></i> Payment Management<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
							<li class="dropdown-submenu">
							    <a tabindex="-1" href="#">Forms <span><i class="icon-chevron-right"></i> </span></a>
							    <ul class="dropdown-menu">
							    	<li class="nav-header">
										<span class="label label-info">Search Form Log</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href="search_acceptance.php"><i class="icon-search"></i> Transactions</a>
									</li>
									<li>
										<a tabindex="-1" href="search_adm.php"><i class="icon-search"></i> Payments</a>
									</li>
									<li class="divider"></li>
									<li>
									<li class="nav-header">
										<span class="label label-success">Add to Form Log</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href="insert_log.php"><i class="icon-plus"></i> Transaction</a>
									</li>
		                            <li>
										<a tabindex="-1" href="insert_admaccess.php"><i class="icon-plus"></i> Payments</a>
									</li>
							    </ul>
							</li>  
							<li class="dropdown-submenu">
							    <a tabindex="-1" href="#">Acceptance <span><i class="icon-chevron-right"></i> </span></a>
							    <ul class="dropdown-menu">
							    <li class="nav-header">
										<span class="label label-info">Search Acceptance Log</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href="search_acceptance_acceptance.php"><i class="icon-search"></i> Transactions </a>
									</li>
									<li>
										<a tabindex="-1" href="search_adm_acceptance.php"><i class="icon-search"></i> Payments</a>
									</li>
									<li class="divider"></li>
									<li class="nav-header">
										<span class="label label-success">Add to Acceptance Log</span>
									</li>
							    	<li class="divider"></li>
									<li>
										<a tabindex="-1" href="insert_log_acceptance.php"><i class="icon-plus"></i> Transactions</a>
									</li>
		                            <li>
										<a tabindex="-1" href="insert_admaccess_acceptance.php"><i class="icon-plus"></i> Payments</a>
									</li>
							    </ul>
							</li>                       	
						</ul>
					</li>


					<?php
						if($_SESSION['role'] == 1 || $_SESSION['role'] == 9){

							$naira = '&#8358;';
					?>
                    <li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class=""><?=$naira;?></i> Bursary Management<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
							<li class="dropdown-submenu">
							    <a tabindex="-1" href="#">Forms <span><i class="icon-chevron-right"></i> </span></a>
							    <ul class="dropdown-menu">
							    	<li class="nav-header">
										<span class="label label-info">Search Invoice</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href=""><i class="icon-search"></i> Forms</a>
									</li>
									<li>
										<a tabindex="-1" href=""><i class="icon-search"></i> Acceptance</a>
									</li>
									<li class="divider"></li>
									<li>
									<li class="nav-header">
										<span class="label label-success">Verify Invoice</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href=""><i class="icon-check"></i> Forms</a>
									</li>
		                            <li>
										<a tabindex="-1" href=""><i class="icon-check"></i> Acceptance</a>
									</li>
							    </ul>
							</li>  
							<li class="dropdown-submenu">
							    <a tabindex="-1" href="#">Acceptance <span><i class="icon-chevron-right"></i> </span></a>
							    <ul class="dropdown-menu">
							    <li class="nav-header">
										<span class="label label-info">Search Invoice</span>
									</li>
							    	<li class="divider"></li>
							    	<li>
										<a tabindex="-1" href="search_acceptance_acceptance.php">Transactions </a>
									</li>
									<li>
										<a tabindex="-1" href="search_adm_acceptance.php">Payments</a>
									</li>
									<li class="divider"></li>
									<li class="nav-header">
										<span class="label label-success">Verify Invoice</span>
									</li>
							    	<li class="divider"></li>
									<li>
										<a tabindex="-1" href="insert_log_acceptance.php">Transactions</a>
									</li>
		                            <li>
										<a tabindex="-1" href="insert_admaccess_acceptance.php">Payments</a>
									</li>
							    </ul>
							</li>                       	
						</ul>
					</li> 
					<?php
						}
					?>


					<?php
						}
						
						if($_SESSION['role'] == 1){
					?>
                    <li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-pin"></i> Amount Management<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="insert_form_amount.php">Add Amount</a>
							</li>
                            <li>
								<a tabindex="-1" href="view_amount.php">View Amount</a>
							</li>
						</ul>
					</li>
					<?php
						}
						
						if($_SESSION['role'] == 1 || $_SESSION['role'] == 7){
					?>
                    <li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-award"></i> Developer Management<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="add_credit.php">Add Developer</a>
							</li>
							<li>
								<a tabindex="-1" href="view_credit.php">View Developer</a>
							</li>
						</ul>
					</li>
					<?php
					}

					if($_SESSION['role'] == 1 || $_SESSION['role'] == 7 || $_SESSION['role'] == 8){
					?>
					<li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-target"></i> News Management<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="add_index_news.php">Add News</a>
							</li>
							<li>
								<a tabindex="-1" href="view_index_news.php">View News</a>
							</li>
						</ul>
					</li>
					<?php
					}

					if($_SESSION['role'] == 1 || $_SESSION['role'] == 7){
					?>
					<li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-rss"></i> Admission Requirements<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="add_admission_requirements.php">Add Admission Requirements</a>
							</li>
							<li>
								<a tabindex="-1" href="view_admission_requirements.php">View Admission Requirements</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-pilcrow"></i> Registras<span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="add_registra.php">Add Registra</a>
							</li>
							<li>
								<a tabindex="-1" href="view_registras.php">View Registras</a>
							</li>
						</ul>
					</li>

					<li class="dropdown">
						<a href="#" id="drop1" role="button" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="iconic-chart"></i> Theme Settings <span><i class="icon-chevron-right"></i> </span></a>
						<ul class="dropdown-menu offset10" role="menu" aria-labelledby="drop1">
                        	<li>
								<a tabindex="-1" href="add_theme.php">Create Theme</a>
							</li>
							<li>
								<a tabindex="-1" href="view_theme.php">manage Theme</a>
							</li>
						</ul>
					</li>
					<?php
						}
					?>
					<li><a href="home.php"> <i class="iconic-home"></i> Main Menu</a></li>
					
				</ul>
</div>