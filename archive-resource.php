<?php
get_header();
?>
<!-- RESOURCE TEMPLATE -->
 <div class="container" id="main">
  <div class="row">
        

      
   
  <h1><em><?php single_cat_title(); ?>Resources</em></h1>

<div class="col-md-9 col-sm-12 col-lg-9 col-xl-10">
  <div class="row">
 
         <?php 
        $tagsArray = array();
        $catArray = array();
        $postsArray = array();
        $resArray = array();
       ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

          <?php
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
if(count($postsArray)):
  ?>
 <h2>Articles Found</h2>
  <?php
    printCards($postsArray);
     foreach($postsArray as $pos){
      if(get_the_tags($pos->ID)){
          $thisTags = get_the_tags($pos->ID);
          foreach($thisTags as $postTag){
            if(!in_array($postTag->slug ,$tagsArray)){
              $tagEntry = array("slug"=>$postTag->slug, "name"=>$postTag->name);
              $tagsArray[$postTag->slug]=$tagEntry;}
            }
         }

         if(get_the_category($pos->ID)){
          $thisTags = get_the_category($pos->ID);
          foreach($thisTags as $postTag){
            if(!in_array($postTag->slug ,$catArray)){
              $tagEntry = array("slug"=>$postTag->slug, "name"=>$postTag->name);
              $catArray[$postTag->slug]=$tagEntry;}
            }
         }
       }
     endif;
?>
<?php 
//IF THERE ARE RESOURCE FILES
  if(count($resArray)):
?>
<h2>Resources Found</h2>
<?php
    printCards($resArray);
      foreach($resArray as $pos){
      if(get_the_tags($pos->ID)){
          $thisTags = get_the_tags($pos->ID);
          foreach($thisTags as $postTag){
            if(!in_array($postTag->slug ,$tagsArray)){
              $tagEntry = array("slug"=>$postTag->slug, "name"=>$postTag->name);
              $tagsArray[$postTag->slug]=$tagEntry;}
            }
         }
         if(get_the_category($pos->ID)){
          $thisTags = get_the_category($pos->ID);
          foreach($thisTags as $postTag){
            if(!in_array($postTag->slug ,$catArray)){
              $tagEntry = array("slug"=>$postTag->slug, "name"=>$postTag->name);
              $catArray[$postTag->slug]=$tagEntry;}
            }
         }
       }
     endif;
   
?>
</div>
 </div>
<?php include(get_template_directory()."/parts/tagFilter.php"); ?>
  </div>

</div>


<?php get_footer(); ?>
