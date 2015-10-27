
<form class="form-horizontal form-signin login" method="post" name="login" id="login">
 <legend>Log-In Information</legend>
 <img src="images/SSL.jpg" width="100" height="93">		
    <div class="control-group">
	    <label class="control-label">Staff Number</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="icon-user"></i></span>
					<input type="text" class="input-xlarge" required name="staff_id" id="staff_id" maxlength="4" placeholder="Enter Staff Number">
				</div>
			</div>
	</div>
    <div class="control-group">
	     <label class="control-label">Password</label>
			<div class="controls">
			    <div class="input-prepend">
				<span class="add-on"><i class="iconic-lock"></i></span>
					<input type="password" class="input-xlarge" required name="apassword" id="apassword" placeholder="Enter Password">
				</div>
			</div>
	</div>
    
    <div class="control-group">
    <label class="control-label" ></label>
    <div class="controls">
      Forgot your Password <a href="reset_password.php" class="act-primary">Click Here <i class="iconic-unlock" style="color:#06F"></i></a>
    </div>
  </div>
    
    <div class="control-group">
		  <div class="controls">
			<button type="submit" class="btn btn-primary" id="submit" >Submit</button>
			<button type="button" class="btn">Cancel</button>
	      </div>	
	</div>

</form>