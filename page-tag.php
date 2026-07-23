<?php get_header(); ?>
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
  <div class="col-md-12">

        <h1><?php the_title(); ?></h1>

        <?php 
        the_content();

        $tags = get_tags();

        foreach ($tags as $tag){
            ?>
            <p><a href="<?php print $tag->slug;?>"><?php print $tag->name; ?></a></p>
        <?php
        }

        ?>
        
</div><!-- .row -->
</div></div>

<?php get_footer(); ?>
