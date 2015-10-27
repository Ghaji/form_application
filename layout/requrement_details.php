<?php
require_once("inc/initialize.php");
?>

 <?php 
  
    $sql = "SELECT * FROM requirements ORDER BY `id` DESC ";

     $require_contents = Requirements::find_by_sql($sql);
    
     ?>
     <ul>
     <?php foreach($require_contents as $require_content): ?> 
     
    <li>
        <a href='programs_details.php?id=<?php echo customEncrypt($require_content->id); ?>'>
    <i class="icon-hand-right"></i> <?php echo htmlentities($require_content->name); ?>
        </a>
    </li>
    <?php endforeach; ?>    
    </ul>






	