<?php
require_once ("../inc/initialize.php");
//checks if admin user is logged in

if (!$session -> is_admin_logged_in()) {
  redirect_to('index.php');
}

$role = $_SESSION['role'];
switch ($role) {
  case 1:
    
    break;
  case 7:
    
    break;
  
  default:
    redirect_to('home.php');
    break;
}
?>
<!DOCTYPE HTML>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>University of Jos, Nigeria</title>
    <?php
    require_once (LIB_PATH . DS . 'css.php');
    ?>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-colorpalette.css">
  </head>

  <body>

    <!-- beginnning of main content-->
    <!-- header -->
    <?php
    include_layout_template('admin_header.php');
    ?>
    <!-- //header -->
    <br>
    <br>

    <!-- Content -->
    <div class="row-fluid">

      <?php
      include_layout_template('admin_menu.php');
      ?>

      <div class="span9">
        <h2>Add Themes</h2>
        <hr>
        <form class="form-horizontal add_theme" role="form" id="add_theme">
          <!-- Institution name -->
          <div class="control-group">
            <label class="control-label" for="institution_name">Institution Name: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                <input type="text" class="input-xlarge" name="institution_name" id="institution_name" placeholder="Enter Institution Name" />
              </div>
            </div>
          </div>

            <!-- Caption name -->
          <div class="control-group">
            <label class="control-label" for="institution_caption">Institution Caption: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                <input type="text" class="input-xlarge" name="institution_caption" id="institution_caption" placeholder="Enter Institution Caption" />
              </div>
            </div>
          </div>

          <!-- header Color -->
          <div class="control-group">
            <label class="control-label" for="institution_text_color">Institution Header Color: </label>
            <div class="controls">
              <div class="input-prepend btn-group">
                <span class="add-on"><i class="icon-pencil"></i></span>
                      
                        <input id="institution_text_color" name="institution_text_color" type="text" class="input-medium" placeholder="Pick Header Color">
                            <a class="btn dropdown-toggle" data-toggle="dropdown">Pick Color</a>
                            <ul class="dropdown-menu">
                              <li><div id="colorpalette1"></div></li>
                            </ul>
                      
              </div>
            </div>
          </div>

          <!-- Caption color -->
          <div class="control-group">
            <label class="control-label" for="institution_caption_text_color">Institution Caption Color: </label>
            <div class="controls">
              <div class="input-prepend btn-group">
                <span class="add-on"><i class="icon-pencil"></i></span>
                      
                        <input id="institution_caption_text_color" name="institution_caption_text_color" type="text" class="input-medium" placeholder="Pick Caption Color">
                            <a class="btn dropdown-toggle" data-toggle="dropdown">Pick Color</a>
                            <ul class="dropdown-menu">
                              <li><div id="colorpalette2"></div></li>
                            </ul>
                      
              </div>
            </div>
          </div>

          <!-- BG color -->
          <div class="control-group">
            <label class="control-label" for="header_bg_color">Header BG Color: </label>
            <div class="controls">
              <div class="input-prepend btn-group">
                <span class="add-on"><i class="icon-pencil"></i></span>
                      
                        <input id="header_bg_color" name="header_bg_color" type="text" class="input-medium" placeholder="Pick BG Color">
                            <a class="btn dropdown-toggle" data-toggle="dropdown">Pick Color</a>
                            <ul class="dropdown-menu">
                              <li><div id="colorpalette3"></div></li>
                            </ul>
                      
              </div>
            </div>
          </div>

          <!-- Image Field -->
          <div class="control-group">
            <div class="controls">  
                <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 120px; height: 80px;">
                            <?php define('SEP', '/');
                              $image_path = "css/assets/img/AAAAAA&text=no+image.gif"; 
                            ?>
                              <img src="<?php echo $image_path; ?>" /></div>
                              <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                              <div>
                          <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
                                <input type="hidden" name="MAX_FILE_SIZE" value="250000"/>
                          <input type="file" name="logo_name" id="logo_name" required /></span>
                          <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                </div>
            </div>
          </div>

          <!-- Image caption -->

          <div class="control-group">
            <label class="control-label" for="logo_caption">Logo Caption: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                <input type="text" class="input-xlarge" name="logo_caption" id="logo_caption" placeholder="Enter Logo Caption Name" />
              </div>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="site_url">Site URL: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on">http://</span>
                <input type="text" class="input-xlarge" name="site_url" id="site_url" placeholder="Enter Site URL" />
              </div>
            </div>
          </div>

          <!-- status field -->
          <div class="control-group">
            <label class="control-label" for="status">Status: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                <select name="status" id="status">
                  <option value="">--SELECT--</option>
                  <?php
                    $status = array('Activate' => 1, 'Deactivate' => 0);
                    
                    foreach ($status as $key => $value) 
                    {
                      echo '<option value="'.$value.'">'.$key.'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <!-- visible -->
          <div class="control-group">
            <label class="control-label" for="visible">Visible: </label>
            <div class="controls">
              <div class="input-prepend">
                <span class="add-on"><i class="icon-pencil"></i></span>
                <select name="visible" id="visible">
                  <option value="">--SELECT--</option>
                  <?php
                    $status = array('Visible' => 1, 'Not-Visible' => 0);
                    
                    foreach ($status as $key => $value) 
                    {
                      echo '<option value="'.$value.'">'.$key.'</option>';
                    }
                  ?>
                </select>
              </div>
            </div>
          </div>

          

          <div class="control-group">
            <button type="submit" class="btn btn-primary" name="create_theme" id="create_theme">Create Theme</button>
          </div>
        </form>
        
      </div>

    </div>
    <!-- //Content -->

    <?php include_layout_template("footer.php"); ?>
  </body>
</html>

<?php
require_once (LIB_PATH . DS . 'javascript.php');
?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/add_theme.js"></script>
<script src="js/bootstrap-colorpalette.js"></script>
<script type="text/javascript">jQuery('.dropdown-toggle').dropdown();</script>
<script src="../js/bootstrap-wysihtml5.js"></script>
<script>

jQuery('.textarea').wysihtml5();

</script>
<script type="text/javascript">
  
      jQuery('#colorpalette1').colorPalette().on('selectColor', function(e) {
        jQuery('#institution_text_color').val(e.color);
      });

      jQuery('#colorpalette2').colorPalette().on('selectColor', function(e) {
        jQuery('#institution_caption_text_color').val(e.color);
      });

      jQuery('#colorpalette3').colorPalette().on('selectColor', function(e) {
        jQuery('#header_bg_color').val(e.color);
      });

</script>
<div id="displayinfo" class="modal hide" tabindex="-1" data-backdrop="static" data-keyboard="false" style="display: none;">
  <div class="modal-body ajax_data"></div>
  <div class="modal-footer">
    <a href="#" class="btn" id="close">Close</a>
  </div>
</div>