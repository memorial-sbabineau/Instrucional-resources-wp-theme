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
        ?>
<div class="row">
 <?php
// Define an array with the category IDs you want to display
$cats = get_terms(array('taxonomy'=>'category','hide_empty'=>true)); 

 foreach ($cats as $cat){
      $term = "category_".$cat->term_id;
      $acf_color=get_field('cat-color',$term);
      $acf_desc=get_field('front_page_description',$term);
      $cat_link = esc_url(home_url('/'))."category/".$cat->slug;
      $cat_image = get_field('category_image',$term);
      $cat_name = $cat->name;
      ?>

   
            
          
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4 " >
       <!-- Card start -->  
       <a href="<?php echo $cat_link; ?>" title="<?php echo $cat_name ;?>" class="fp-cat-link">
            <div class="card p-4 fp-cat" style=" <?php if ($acf_color):?>background-color:<?php echo $acf_color; endif;?>;">
              <?php if ($cat_image): ?>
              <img src="<?php echo $cat_image; ?>" class="card-img-top" role="presentation">
            <?php endif; ?>
<div class="card-body">
    <h4 class="card-title"><?php echo $cat_name ; ?></h4>
    <?php if ($acf_desc) : ?>
        <?php echo $acf_desc; ?>
    <?php endif; ?>
  
    

   
    </div>
  </div>
  </a>
<!-- Card end -->
</div>
    <?php
}
?>
    <?php
    // Restore the original post data
    wp_reset_postdata();

    
    ?>
   </div>     
</div><!-- .row -->
</div>

<?php get_footer(); ?>
