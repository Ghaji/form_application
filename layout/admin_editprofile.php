<?php
	$session = new Session();
	//the $session->applicant_id is the user_id of the admin
	$user = AdminLog::find_by_id($session->applicant_id);
?>
<h5 align="center">Edit Profile</h5>
<hr>
<h6 align="center">All Fields are Required</h6>
<form action="" method="POST" class="create_form form-horizontal" >
  <div class="control-group">
    <label class="control-label" for="inputEmail">Surname</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="surname" name="surname" placeholder="Enter surname" value="<?php if(isset($user->surname)) echo $user->surname ?>" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Other Names</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="othernames" name="othernames" placeholder="Enter other names" value="<?php if(isset($user->othernames)) echo $user->othernames ?>" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputStaff">Staff ID</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="staffid" name="staffid" maxlength="4" placeholder="Enter Staff ID" value="<?php if(isset($user->staff_id)) echo $user->staff_id ?>" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Rank</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-bookmark"></i></span>
            <input type="text" id="rank" name="rank" placeholder="Enter staff's rank" value="<?php if(isset($user->rank)) echo $user->rank ?>" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-envelope"></i></span>
            <input type="text" required id="email" name="email" placeholder="Enter e-mail" value="<?php if(isset($user->email)) echo $user->email ?>" />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" id="epassword" name="epassword" placeholder="Enter Password" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Confirm Password</label>
    <div class="controls">
      <div class="input-prepend">
      		<span class="add-on"><i class="icon-lock"></i></span>
            <input type="password" id="cepassword" name="cepassword" placeholder="Confirm Password" required />
    	</div>
    </div>
  </div>
  

<div id="accept_terms">		
	<div class="control-group">
		  <div class="controls">  
			<button type="submit" class="btn btn-primary" id="submit" >Edit Profile</button>
			<button type="button" onClick="document.location.href='index.php';" class="btn">Cancel</button>
	      </div>	
	</div>
</div>
</form>
  