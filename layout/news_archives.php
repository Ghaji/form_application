<?php require_once("inc/initialize.php");
  $get_id = customDecrypt($_GET['id']);
 
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>University of Jos, Nigeria</title>
<?php require_once(LIB_PATH.DS.'css.php'); ?>
</head>
<body>
<?php include_layout_template("header.php"); ?>
<!-- beginnning of main content-->
<div class="container">
	<div class="row-fluid">
		<div class="span7" >
		<h4><a href="index.php"><i class="icon-home"></i> University of Jos Online Form Portal </a></h4>
        <hr>

      	<!-- <h3><i class="icon-bullhorn"></i> News ON</h3> -->
        <!-- # New Content Here -->

          <?php 
            if(is_numeric($get_id)) {
              $sql = "SELECT * FROM news_events WHERE id = $get_id
                      AND visible = 1
                      AND verified_by !='' 
                      LIMIT 1";

              $newsEvents = News_Events::find_by_sql($sql);
            } else {
              $newsEvents = array();
            }
    
          if(!empty($newsEvents)){
                foreach($newsEvents as $item): 
                    switch ($item->iType) {

                    case 1:
                        $icon = '<i class="icon-bullhorn"></i>';
                        break;

                    case 2:
                        $icon = '<i class="icon-bullhorn"></i>';
                        break;
                    
                    default:
                        $icon = '<i class="icon-bullhorn"></i>';
                        break;
                } ?>


        <p align="justify" >
                         
                         <a href="#">
                          <h4 style ="color:#006699;"> <?php echo $icon; ?> <?php echo $item->title; ?></h4>
                          <strong> <?php echo $item->display_line; ?></strong><br>
                        </a>
                     <?php  echo $item->content;?>        
                          <div style ="color:#009cde;"> 
                              Posted by: <i class="icon-user"></i> <?php echo $item->author; ?> 
                              <i class="icon-time"></i> at <?php echo $item->created_time; ?>
                              Date: <i class="icon-calendar"></i> <?php echo $item->last_update; ?>
                              <br>
                              <a href="javascript:history.go(-1)" class="text-warning pull-leftbtn">
                             <i class="icon-arrow-left"></i> Back
                             </a>
                          </div> 
                              
                    </p>
                

                  <?php
                 endforeach;

          } else {
            echo '<h4 class="text-center text-info">No related items</h4>';
          }
 

                   ?>


        <!-- # End of News Content -->
      
       <!-- Start News Title--> 	
      
	   
		</div>
		<div class="span5">
        
      <h4> Related News Items </h4>
        <hr>

			
	
    <?php

           

   // 1. the current page number ($current_page)
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    $per_page = 5;

    // 3. total record count ($total_count)
    $total_count = News_Events::count_all();
    

    // Find all photos
    // use pagination instead

    $pagination = new Pagination($page, $per_page, $total_count);
    
    // Instead of finding all records, just find the records 
    if(!empty($newsEvents)) {
    // for this page
      $sql ="SELECT * FROM news_events 
                  WHERE id != $get_id
                  AND visible = 1
                  AND verified_by !='' 
                  ORDER BY id DESC  ";
      $sql .= "LIMIT {$per_page} ";
      $sql .= "OFFSET {$pagination->offset()}";
      $news_query = News_Events::find_by_sql($sql);
    } else {
      $sql ="SELECT * FROM news_events 
                  WHERE visible = 1
                  AND verified_by !='' 
                  ORDER BY id DESC  ";
      $sql .= "LIMIT {$per_page} ";
      $sql .= "OFFSET {$pagination->offset()}";
      $news_query = News_Events::find_by_sql($sql);
    }
    // Need to add ?page=$page to all links we want to 
    // maintain the current page (or store $page in $session)  

     $counter = 1;


  

  foreach($news_query as $itemR) {?>

   ffff
      <ul>
        <li style ="border">
      <i class="icon-hand-right"></i> 
    <a href="all_news.php?id=<?php echo customEncrypt($itemR->id); ?> "> <?php echo $itemR->title; ?> </a>
     </li>
     </ul>
  <?php
  }

  ?>
 

<?php  //endforeach ;?>
  <div class="pagination pagination-centered" style="clear: both;">

<?php
    if($pagination->total_pages() > 1) {
        
        if($pagination->has_previous_page()) { 
        //echo "<ul>";
        echo "<li class='disabled'><a href=\"all_news.php?page=";
        echo $pagination->previous_page();
        echo "\">&laquo; Previous</a></li> "; 
    }

        for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
                echo " <li><span class=\"selected\">{$i}</span></li> ";
            } else {
                echo " <li><a href=\"all_news.php?page={$i}\">{$i}</a></li> "; 
            }
        }

        if($pagination->has_next_page()) { 
            echo "<li class='disabled'> <a href=\"all_news.php?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a></li> "; 
            //echo "</ul>";
    }
        
    }

?>

    
		 <!-- End Start News Title--> 
			
		</div>
	</div>
</div>

              
         
<?php include_layout_template("footer.php"); ?>

  

</body>
</html>

<?php require_once(LIB_PATH.DS.'javascript.php'); ?>
<script src="js/jquery.js"></script>
<script src="css/assets/js/bootstrap.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/log.js"></script>
 