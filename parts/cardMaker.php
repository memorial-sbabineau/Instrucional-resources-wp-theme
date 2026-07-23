 <?php 

        $tagsArray = array();
        $catArray = array();
        $postsArray = array();
        $resArray = array();
       ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php //print($post->post_type); ?>
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
       <div class="col-md-9 col-sm-12 col-lg-9 col-xl-10">
  <div class="row">
    <?php 
    //START CYCLE POSTS
if(count($postsArray)):?>
<h3>Resources:</h3>
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


    <?php  printAssetList($resArray);

      /*foreach($resArray as $pos){
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
       } */?>

<?php
    /*printCards($resArray);
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
       }*/
     endif;
   
?>