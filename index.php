<?php get_header(); ?>

<div class="row">
  <div class="col-md-8">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
      <article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>
        <h2><?php the_title(); ?></h2>
        
        <?php if (has_post_thumbnail()) : ?>
          <div class="post-thumbnail">
            <?php the_post_thumbnail('large'); ?>
          </div>
        <?php endif; ?>
        
        <div class="entry-content">
          <?php the_content(); ?>
        </div>
      </article>
    
    <?php endwhile; endif; ?>

  </div>

  <div class="col-md-4">
    <?php get_sidebar(); ?>
  </div>
</div><!-- .row -->

<?php get_footer(); ?>
