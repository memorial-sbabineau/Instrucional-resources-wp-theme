<?php get_header(); ?>
 <div class="container" id="main">


<div class="row">
  <div class="col-md-8">

   
    
     
        
        <h1>Whoops!</h1>

        <p>Looks like that page is missing.</p>
        <p>Don't worry...</p>
        <p>You can try a search:</p>
         <div class="input-group ">
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
    <label>
        <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
        <input type="search" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </label>
     <button type="submit" class="search-submit btn btn-info" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />Search</button> 
</form>
</div>

<p>Or browse the categories:</p>
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

  </div>

  <div class="col-md-4">
  
  </div>
</div><!-- .row -->
</div>

<?php get_footer(); ?>
