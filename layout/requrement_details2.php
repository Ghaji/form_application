<?php
require_once("inc/initialize.php");
?>

 <?php 
     // 1. the current page number ($current_page)
    //$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

    // 2. records per page ($per_page)
    //$per_page = 2;

    // 3. total record count ($total_count)
    //$total_count = Requirements::count_all();
    

    // Find all photos
    // use pagination instead

   // $pagination = new Pagination($page, $per_page, $total_count);
    
    // Instead of finding all records, just find the records 
    // for this page
    // $sql = "SELECT * FROM requirements ORDER BY `id` DESC ";
    // $sql .= "LIMIT {$per_page} ";
    // $sql .= "OFFSET {$pagination->offset()}";
    $sql = "SELECT * FROM requirements ORDER BY `id` DESC ";

     $require_contents = Requirements::find_by_sql($sql);
    
    // Need to add ?page=$page to all links we want to 
    // maintain the current page (or store $page in $session)  

     //$counter = 1;
     ?>
     <ul>
     <?php foreach($require_contents as $require_content): ?> 
     
    <li>
        <a href='view_all.php?=<?php echo customEncrypt($require_content->id); ?>'>
    <i class="icon-hand-right"></i> <?php echo htmlentities($require_content->name); ?>
        </a>
    </li>
    <?php endforeach; ?>    
    </ul>


<!-- <div class="pagination " style="clear: both;">
<ul> -->
<?php
    // if($pagination->total_pages() > 1) {
        
    //     if($pagination->has_previous_page()) { 
    //     //echo "<ul>";
    //     echo "<li class='disabled'><a href=\"index.php?page=";
    //     echo $pagination->previous_page();
    //     echo "\">&laquo; Previous</a></li> "; 
    // }

    //     for($i=1; $i <= $pagination->total_pages(); $i++) {
    //         if($i == $page) {
    //             echo " <li><span class=\"selected\">{$i}</span></li> ";
    //         } else {
    //             echo " <li><a href=\"index.php?page={$i}\">{$i}</a></li> "; 
    //         }
    //     }

    //     if($pagination->has_next_page()) { 
    //         echo "<li class='disabled'> <a href=\"index.php?page=";
    //         echo $pagination->next_page();
    //         echo "\">Next &raquo;</a></li> "; 
    //         //echo "</ul>";
    // }
        
    // }

?>
<!-- </ul>
</div> --> 



	