<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

 
    <div class="container pagehead">
      <div class="row mb-3">
      <div class="col-3" >
        <a href="https://www.mun.ca" target="_blank" id="munlogo"><span class="visually-hidden">Memorial University</span></a>
       </div>
       <div class="col-9">
         <?php get_search_form(); ?>
       </div>
      </div>


    </div>

    <div id="blue-head">
          <div class="container justify-content-center" >
      <div class="row ">
        <div class="col-md-8 col-sm-6  col-xs-12 pb-3 pb-md-0">
         <span>CITL - <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a></span>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 pb-3 pb-md-0">
          <?php include(get_template_directory()."/parts/dropmenu.php"); ?>
        </div>
      </div>
    </div>
    </div>
    <!-- <div class="black-bar">
 <div class="container" >
      <div class="row justify-content-end">

        <div class="col-md-6 col-sm-12" >
      
     


   </div>

</div>
</div> -->


