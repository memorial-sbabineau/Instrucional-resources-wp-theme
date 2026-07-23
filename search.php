<?php
get_header();
?>
<!-- SEARCH TEMPLATE -->
 <div class="container" id="main">
  <div class="row">
        

      
   
    <h1>Search Results for: <em><?php echo get_search_query(); ?></em></h1>

<?php include(get_template_directory()."/parts/cardMaker.php"); ?>
</div>
 </div>
<?php include(get_template_directory()."/parts/tagFilter.php"); ?>
  </div>

</div>


<?php get_footer(); ?>
