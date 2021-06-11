<?php 

 get_header();
?>

<?php
   while( have_posts() ): the_post();
?>
    
      
	 <h1><?php the_title(); ?></h1> 
     <?php   the_content();
     
     ?>
     escrito por <?php  
      the_author();
      
     ?>
<?php 

   endwhile;
?> 

<?php 

 get_footer();
?>
