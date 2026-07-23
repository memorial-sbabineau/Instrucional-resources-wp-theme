<?php
get_header();
?>
 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
 <div class="container" id="main">

  <?php 

$banner = get_field('banner_image');

if($banner){

  ?>
  <div class="container-fluid py-5 banner d-none d-sm-block" style="background-image: url(<?php print $banner; ?>);"></div>
  <?php

}
  ?>
  <div class="row">
    <div class="col-lg-9 col-md-12 col-sm-12">
                  



        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         
<h1 class="pt-2"><?php the_title(); ?></h1>

          <div class="entry-content">
            <?php the_content(); ?>
          </div>
        </article>

<div class="row ">
<h3>Categories</h3>
<?php
// Define an array with the category IDs you want to display
$cats = get_terms(array('taxonomy'=>'category','hide_empty'=>true,'exclude'=>1)); 

 foreach ($cats as $cat){
      $term = "category_".$cat->term_id;
      $acf_color=get_field('cat-color',$term);
      $acf_desc=get_field('front_page_description',$term);
      $cat_link = esc_url(home_url('/'))."category/".$cat->slug;
      $cat_image = get_field('category_image',$term);
      $cat_name = $cat->name;
      ?>

   
            
          
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 mb-4 d-none d-md-block" >
       <!-- Card start -->  
       <a href="<?php echo $cat_link; ?>" title="<?php echo $cat_name ;?>" class="fp-cat-link">
            <div class="card p-4 fp-cat" >

<div class="card-body ">
    <p class="card-title"><strong><?php echo $cat_name ; ?></strong></p>
    
    <?php if ($acf_desc) : ?>
        <?php echo $acf_desc; ?>
    <?php endif; ?>
  
    

   
    </div>
  </div>
  </a>
<!-- Card end -->
</div>
<section class="d-block d-md-none fp-cat-mobile">
  <details>
<summary ><?php echo $cat_name ; ?></a></summary>
    <div class="mt-3">
    <?php if ($acf_desc) : ?>
        <?php echo $acf_desc; ?>
    <?php endif; ?>
    <button class="btn btn-secondary"><a href="<?php echo $cat_link; ?>" title="<?php echo $cat_name ;?>" class="fp-cat-link mobile">View Category</a></button>
  </div>
  </details>
  </section>

    <?php
}
?>
    <?php
    // Restore the original post data
    wp_reset_postdata();

    
    ?>
</div>

         </div>
         <div class="col-md-12 col-lg-3 fp-side">
          <h3>Featured Collections</h3>
          
<?php 

$terms = get_terms( array(
    'taxonomy'   => 'collection',
    'hide_empty' => true,
        ) ); 

  foreach ($terms as $term)
            {
              
              $featured = get_field('featured',$term);
             if($featured): ?>
<a class="fc-link" href="<?php echo esc_url(home_url('/')); ?>collection/<?php print $term->slug; ?>">
<div class="card fc-card">
  <div class="card-body">
    <h4 class="card-title"><?php print $term->name; ?></h4>
    <p class="card-text"><?php print $term->description; ?></p>
  </div>

</div>
</a>


          <?php  
        endif;
        }        
          ?>
         
      <?php endwhile; endif; ?>
      <button class="btn btn-secondary collection-btn" style="width:100%"><a href="collection" >View All Collections</a></button>
      <h3>Recently Added: </h3>
      <ul class="recents">
        <?php $args = array(
    'post_type'=>array('post','resource'),
    'posts_per_page' => 5,
    'post_type'=>'post',
    'orderby' => 'date',
    'order'   => 'DESC',);
   $queryPosts = new WP_Query($args);

   if($queryPosts->have_posts()) :
      while($queryPosts->have_posts()) : $queryPosts->the_post();
        ?>
          <li><a href="<?php print the_permalink();?>"><?php print get_the_title(); ?></a></li>


   <?php 
 endwhile;
 endif;
wp_reset_postdata();
 ?>
</ul>
 <h3>Recently Updated: </h3>
 <ul class="recents">
        <?php $args = array(
    'post_type'=>array('post','resource'),
    'posts_per_page' => 5,
    'post_type'=>'post',
    'orderby' => 'modified',
    'order'   => 'DESC',);
   $queryPosts = new WP_Query($args);

   if($queryPosts->have_posts()) :
      while($queryPosts->have_posts()) : $queryPosts->the_post();
        ?>
          <li><a href="<?php print the_permalink();?>"><?php print get_the_title(); ?></a></li>


   <?php 
 endwhile;
 endif;
wp_reset_postdata();
 ?>
</ul>
</div>
  </div>
</div>

<?php get_footer(); ?>
