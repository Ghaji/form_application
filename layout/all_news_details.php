  <?php

    $query_count = "SELECT * FROM news_events ";
    $news =  News_Events::find_by_sql($query_count);
    $new = array_shift($news);
            


   // 1. the current page number ($current_page)
    $page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    $per_page = 1;

    // 3. total record count ($total_count)
    if($new->visible == 1){
      $total_count = News_Events::count_all();
    }else{
      $total_count = News_Events::count_all_visible();
    }

    // Find all photos
    // use pagination instead

    $pagination = new Pagination($page, $per_page, $total_count);
    
    // Instead of finding all records, just find the records 
    // for this page
    $sql = "SELECT * FROM news_events ORDER BY `id` DESC ";
    $sql .= "LIMIT {$per_page} ";
    $sql .= "OFFSET {$pagination->offset()}";
    $newsEvents = News_Events::find_by_sql($sql);
    
    // Need to add ?page=$page to all links we want to 
    // maintain the current page (or store $page in $session)  

     $counter = 1;
     ?>


     <ul>
      <?php
        foreach($newsEvents as $item): 
                switch ($item->iType) {

                    case 1:
                        $icon = '<i class="icon-user"></i>';
                        break;

                    case 2:
                        $icon = '<i class="icon-user"></i>';
                        break;
                    
                    default:
                        $icon = '<i class="icon-user"></i>';
                        break;
                } ?>


        <p align="justify" >
                          <span class=""><?php //echo $icon; ?></span>
                          <a href="all_news.php?id=<?php echo customEncrypt($item->id);?>">
                          <h4 style ="color:#006699;"> <?php echo $item->title; ?></h4>
                          <strong> <?php echo $item->display_line; ?></strong><br>
                        </a>
<?php
          if(strlen($item->content) >= 200){ 

          echo substr($item->content, 0, 200).'...';

          }else{ 
            echo $item->content; 
          }
?>        
                          <div style ="color:#009cde;"> 
                              Posted by: <i class="icon-user"></i> <?php echo $item->author; ?> 
                              <i class="icon-time"></i> at <?php echo $item->created_time; ?>
                              Date: <i class="icon-calendar"></i> <?php echo $item->last_update; ?>
                          </div> 
                          
                    </p>


<?php
  endforeach;    
?>
     </ul>

            




        <div class="pagination " style="clear: both;">
<ul>
<?php
    if($pagination->total_pages() > 1) {
        
        if($pagination->has_previous_page()) { 
        //echo "<ul>";
        echo "<li class='disabled'><a href=\"index.php?page=";
        echo $pagination->previous_page();
        echo "\">&laquo; Previous</a></li> "; 
    }

        for($i=1; $i <= $pagination->total_pages(); $i++) {
            if($i == $page) {
                echo " <li><span class=\"selected\">{$i}</span></li> ";
            } else {
                echo " <li><a href=\"index.php?page={$i}\">{$i}</a></li> "; 
            }
        }

        if($pagination->has_next_page()) { 
            echo "<li class='disabled'> <a href=\"index.php?page=";
            echo $pagination->next_page();
            echo "\">Next &raquo;</a></li> "; 
            //echo "</ul>";
    }
        
    }

?>
</ul>
</div>

<hr> 















