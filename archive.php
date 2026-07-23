<?php
get_header();
?>
<!-- ARCHIVE TEMPLATE -->
 <div class="container" id="main">
  <div class="row">
        

      
   
  <h1><em><?php single_cat_title(); ?></em></h1>

<?php include(get_template_directory()."/parts/cardMaker.php"); ?>
</div>
 </div>
<?php include(get_template_directory()."/parts/tagFilter.php"); ?>
  </div>

</div>


<?php get_footer(); ?>
