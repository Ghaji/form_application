<h5 align="center">Create an Account</h5>
<hr>
<h6 align="center">All Fields are Required</h6>
<form action="" method="POST" class="create_form form-horizontal" >
  <div class="control-group">
    <label class="control-label" for="inputEmail">Surname</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="sname" name="sname" placeholder="Enter surname" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">First Name</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="fname" name="fname" placeholder="Enter first name" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Middle Name</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-user"></i></span>
            <input type="text" id="mname" name="mname" placeholder="Enter middle name" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Phone Number</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="iconic-iphone"></i></span>
            <input type="text" id="phone" name="phone" maxlength="14" placeholder="Enter phone number" required />
    	</div>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
    	<div class="input-prepend">
      		<span class="add-on"><i class="icon-envelope"></i></span>
            <input type="text" required id="email" name="email" placeholder="Enter e-mail" />
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
  
  <div class="control-group">
	<div class="controls">
    <div id="termswrap">
		<label class="checkbox">
			<input type="checkbox" id="terms" name="terms" value="1"> By clicking the checkbox i agree to  
<a href="terms_condition.php" id="terms_cond" rel="ajaxpanel" title="Terms and Condition" data-loadtype="iframe"><br>University of Jos</a> Terms and Condition<br> and that i am a Human.
		</label>
	</div>
	</div>
</div>
<div class="control-group" >
	<div class="controls">
		<div id="captchaimage">
			<a href="<?php echo $_SERVER['PHP_SELF']; ?>" id="refreshimg" title="Click to refresh image">
			<img src="images/image.php?<?php echo time(); ?>" width="132" height="46" alt="Captcha image" /></a>
		</div>
        <br>
        <div class="input-prepend">
			<span class="add-on"><i class="iconic-pen-alt2"></i></span>
			<input type="text" class="input-xlarge" required name="captcha" id="captcha" maxlength="6" disabled placeholder="Enter the number from the box">
		</div>
   </div>	
</div>
<div id="accept_terms">		
	<div class="control-group">
		  <div class="controls">  
			<button type="submit" class="btn btn-primary" id="submit" disabled >Submit</button>
			<button type="button" onClick="document.location.href='index.php';" class="btn">Cancel</button>
	      </div>	
	</div>
</div>
</form>
  