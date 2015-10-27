<?php

    header("Content-type: text/css; charset: UTF-8");
    require_once ("../../inc/initialize.php");
    
    $theme = new Theme();
    $sql = "SELECT * from `themes` WHERE `status` = 1 AND `visible` = 1 Order By theme_id desc";
    $theme =  $theme->find_by_sql($sql);
    $themes = array_shift($theme);

    $header_bg_color = $themes->header_bg_color;

    $logo_path =  "../../images" .DS;
    $img = $logo_path. DS .$themes->logo_name;
?>

/* Header Style */
.codrops-top{
	line-height: 55px;
	font-size: 30px;
	/*background: rgba(255, 255, 255, 0.4);
	background:#069;*/
	background: <?php echo $header_bg_color; ?>;
	/*text-transform: uppercase;*/
	z-index: 9999;
	position: relative;
	box-shadow: 1px 0px 2px rgba(0,0,0,0.2);
}
.codrops-top a{
	padding: 0px 10px;
	letter-spacing: 1px;
	color: #333;
	text-shadow: 0px 1px 1px #fff;
	display: block;
	float: left;
}
.codrops-top a:hover{
	background: #fff;
}
.info{
	/*position: absolute;
	top: 0px;*/
	text-align:left;
	width: 27.7%;	
	padding: 18px 6% 60px 6%;
	margin: 0 0 12px 382px;
	background: rgb(247, 247, 247);
	border: 1px solid rgba(147, 184, 189,0.8);
	-webkit-box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	   -moz-box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	        box-shadow: 0pt 2px 5px rgba(105, 108, 109,  0.7),	0px 0px 8px 5px rgba(208, 223, 226, 0.4) inset;
	-webkit-box-shadow: 5px;
	-moz-border-radius: 5px;
		 border-radius: 5px;
	}

/*This is the span for the image*/
.codrops-top span.left{
	float: left;
	margin-top:10px;
	margin-left: 20px;
}
.codrops-top span.nxt{
	float: center;
	margin-top:10px;
	/*margin-left: 20px;*/
}
.codrops-top span.right{
	float: center;
}
.codrops-top span.right a{
	float: left;
	display: block;
}

.codrops-demos{
	text-align:center;
	display: block;
	padding: 14px;
}
.codrops-demos span{
	display: inline-block;
	padding-right: 15px;
	text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.8);
}
.codrops-demos a,
.codrops-demos a.current-demo,
.codrops-demos a.current-demo:hover{
    display: inline-block;
	font-style: italic;
	font-size: 12px;
	padding: 3px 5px;
	margin: 0px 3px;
	font-weight: 800;
	box-shadow: 1px 1px 1px rgba(0,0,0,0.05) inset;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.1);
	background: rgba(104,171,194,0.5);
}
.codrops-demos a:hover{
	background: #4fa2c4;
}
.codrops-demos a.current-demo,
.codrops-demos a.current-demo:hover{
	color: rgba(104,171,194,1);
	background: rgba(255,255,255,0.9);
	box-shadow: 0px 1px 1px rgba(0,0,0,0.1);
}
.img {
	background-image: url('<?php echo $img; ?>');
	background-size: 100%;
	background-repeat:no-repeat;
	width: 80px;
	height: 90px;
}