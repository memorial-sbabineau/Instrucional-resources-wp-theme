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

<div class="row"><?php 

$terms = get_terms( array(
    'taxonomy'   => 'collection',
    'hide_empty' => true,
        ) ); 

  foreach ($terms as $term)
            {
              
              $featured = get_field('featured',$term);
              ?>
              <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4 " >
<a class="fc-link" href="<?php echo esc_url(home_url('/')); ?>collection/<?php print $term->slug; ?>">
<div class="card fc-card">
  <div class="card-body">
    <h4 class="card-title"><?php print $term->name; ?></h4>
    <?php if($featured){?> <p><em>Featured</em></p> <?php }?>
    <p class="card-text"><?php print $term->description; ?></p>
  </div>

</div>
</a>
</div>


          <?php  
        
        }        
          ?></div>
        
</div><!-- .row -->
</div></div>

<?php get_footer(); ?>
