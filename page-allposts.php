<?php
get_header();
?>
<!-- ARCHIVE TEMPLATE -->
 <div class="container" id="main">
  <?php 

$banner = get_field('banner_image');

if($banner){

  ?>
  <div class="container-fluid py-5 banner" style="background-image: url(<?php print $banner; ?>);"></div>
  <?php

}
  ?>
  
  <div class="row">
        

      
   
 



<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
     <h1><?php the_title(); ?></h1>

  <?php the_content(); ?>

  <div class="row">
<?php
         $tagsArray = array();
        $catArray = array();
        $postsArray = array();
        $resArray = array();
  $args = array(
    'post_type'=>array('post'),
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order'   => 'ASC',);
   $queryPosts = new WP_Query($args);

   if($queryPosts->have_posts()) :
      while($queryPosts->have_posts()) : $queryPosts->the_post();
          
            if($post->post_type == 'post'){
              $postsArray[] = $post;
            }
            else if ($post->post_type =='resource'){
              $resArray[] = $post;
            }
           
          ?>
         <?php endwhile; ?>

       <?php endif; ?>

 <?php 
    //START CYCLE POSTS
if(count($postsArray)):?>
<h3>Articles:</h3>
  <?php
    printCards($postsArray);
 
     endif;
?>
<?php 
//IF THERE ARE RESOURCE FILES
  if(count($resArray)):
?>
<h3>Resources:</h3>
<?php
    printCards($resArray);
 
     endif;
   
?>
</div>
 </div>
<?php //include(get_template_directory()."/parts/tagFilter.php"); ?>
  </div>

</div>


<?php get_footer(); ?>
