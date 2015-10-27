<?php
    include ("inc/initialize.php");

    $theme = new Theme();
    $sql = "SELECT * from `themes` WHERE `status` = 1 AND `visible` = 1 Order By theme_id desc";
    $theme =  $theme->find_by_sql($sql);
    $themes = array_shift($theme);
    
    $logo_path =  "..".DS. "images" .DS;

    if(!empty($themes)) {
?>
<div class="codrops-top">
   <span class="left"><div class="img" height="80" alt="<?php echo $themes->institution_name; ?> Logo"> </div></span>
    <span class="right"><center><font color="<?php echo $themes->institution_text_color; ?>"><?php echo $themes->institution_name; ?></font></center></span>
    	<div class="nxt">
    		<center>
    			<font color="<?php echo $themes->institution_caption_text_color; ?>">
    				<?php echo $themes->institution_caption; ?>
    			</font>
    		</center>
    	</div>
    <div class="clr"></div>
</div>
<br>	
<?php
    } else {
?>
<div class="codrops-top">
   <span class="left"><div class="img" alt="Logo"></div></span>
    <span class="right"><center><font color="#FFF">Application Name</font></center></span>
        <div class="nxt">
            <center>
                <font color="#FFA">
                    Institution Caption
                </font>
            </center>
        </div>
    <div class="clr"></div>
</div>
<br>
<?php
    }
?>