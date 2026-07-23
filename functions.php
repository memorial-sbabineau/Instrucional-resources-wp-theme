<?php
// Enqueue Bootstrap CSS and JavaScript
function enqueue_bootstrap() {
  // Enqueue Bootstrap CSS
  wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css');
  
  // Enqueue Theme CSS
  wp_enqueue_style('theme-css', get_stylesheet_uri(), array('bootstrap-css'));

  // Enqueue Bootstrap JavaScript
  wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js', array('jquery'), '', true);


}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

//turn off the block editor

//add_filter('use_block_editor_for_post', '__return_false');

//HELPER SHORTCODE TO FIND POSTS WITHOUT AUTHORS
function noAuthor(){
  echo "<ul>";
$args = array(
    'post_type'=>'post',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order'   => 'ASC',
'post_status'=>'publish');
   $queryPosts = new WP_Query($args);

   if($queryPosts->have_posts()) :
      while($queryPosts->have_posts()) : $queryPosts->the_post();
           if(!get_field('created_by')){
           ?>
           <li><a href="<?php echo the_permalink();?>"><?php the_title(); ?></a></li>
           <?php
           }

           
     endwhile; 
   endif;
  wp_reset_postdata();
   echo "</ul>";

}
add_shortcode( 'noAuthor', 'noAuthor' );

//END FIND AUTHORS

// Add Shortcode YOUTUBE
function youtubeEmbed( $atts , $content = null ) {
  $a=shortcode_atts(array('id'=>'YE7VzlLtp-4','caption'=>''),$atts);
  
  $output ="
             <!-- Start Video --> 
             <div class='row justify-content-center'>
                   
                     <div class='col-md-12 col-xl-8'>
                         <figure class='video-figure'>
                         <div class='ratio ratio-16x9'>
                            
  <iframe width='100%' src='https://www.youtube.com/embed/".$a['id']."' title='YouTube video player'  allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>

</div>
  <figcaption>".$a['caption']."</figcaption>
</figure>

                     </div>

                 </div><!-- End Video -->";
  return $output;
  }


add_shortcode( 'youtube', 'youtubeEmbed' );

//GENERIC MEDIA WRAP
function mediaEmbed( $atts , $content = null ) {
  $a=shortcode_atts(array('caption'=>''),$atts);
  
  return "<!-- Start Media --> <div class='row justify-content-center'><div class='col-xl-8 col-md-12 col-sm-12'><figure class='video-figure'><div class='ratio ratio-16x9'>".$content."</div><figcaption>".$a['caption']."</figcaption></figure></div></div><!-- End Media -->";
  
  }


add_shortcode( 'mediaEmbed', 'mediaEmbed' );

// Add Shortcode NOTE
function noteWrap( $atts , $content = null ) {

  return "<section class='notebox'><aside>".$content."</aside></section>";
  }


add_shortcode( 'note', 'noteWrap' );

// Add Shortcode EXAMPLE
function exampleWrap( $atts , $content = null ) {

  return "<section class='notebox examplebox'><aside>".$content."</aside></section>";
  }

  
add_shortcode( 'example', 'exampleWrap' );

// Add Shortcode TIP
function tipWrap( $atts , $content = null ) {

  return "<section class='notebox tipbox'><aside>".$content."</aside></section>";
  }

  
add_shortcode( 'tip', 'tipWrap' );

//Making Accordions!

function accOpen($atts, $content = null){
  $a = shortcode_atts(array('id'=>'accordion'),$atts);
  return "<!-- start accordion --><div class='accordion' id='".$a['id']."'>";
}
add_shortcode( 'open-accordion', 'accOpen' );

function accClose(){
  return "</div> <!-- end accordion -->";
}
add_shortcode( 'close-accordion', 'accClose' );

function accItem($atts, $content = null){
  $a = shortcode_atts(
                array(
                  'parent'=>'accordion',
                  'label'=>'Item',
                  'id'=>'item01',
                  'open'=>'false',
                  'stayopen'=>'false'
                  ),
                $atts);
  $bsparent = "data-bs-parent='#".$a['parent']."'";
  $open = '';
if($a['open']=='true'){
  $open = "show";
}

  if($a['stayopen']=='true'){
    $bsparent="";
  }
$output = "<div class='accordion-item'>\n
            <h2 class='accordion-header' id='".$a['id']."'>\n
            
            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse_".$a['id']."' aria-expanded='true' aria-controls='collapse_".$a['id']."'>\n
              ".$a['label']." </button> </h2>\n
            
            <div id='collapse_".$a['id']."' class='accordion-collapse collapse ".$open."' aria-labelledby='".$a['id']."' ".$bsparent.">\n

            
            <div class='accordion-body'>".$content."</div>\n
            </div>\n</div>";



 
  return $output;
}
add_shortcode( 'accordion-item', 'accItem' );

//END -- Making accordions


// ADD RESOURCE CUSTOM POST TYPE TO ARCHIVE SEARCH
function tg_include_custom_post_types_in_archive_pages( $query ) {
    if ( $query->is_main_query() && ! is_admin() && ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) ) {
        $query->set( 'post_type', array( 'post', 'resource' ) );
    }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_archive_pages' );

function printAssetList($postsArray){
      //print "<ul class=\"assets-list\">";
  print "<h3 class=\"d-none d-md-block\">Assets:</h3><div class=\"row p-2 d-none d-md-block\"> <div class=\"col-12\">";
    foreach($postsArray as $pos):
    $post_cats = get_the_category($pos->ID);
    $post_tags = get_the_tags($pos->ID); 
    $tag_slugs="";
    $cat_slugs="";

    foreach ($post_cats as $cat){
      $cat_slugs.="cat_".$cat->slug." ";
    }

    if($post_tags){
    foreach ($post_tags as $tag){
      $tag_slugs .="tag_".$tag->slug." ";
    }
  }   
    ?>




          
            <details class="asset-container"><summary><?php print get_the_title($pos->ID); ?></strong></summary>
             
          
          <h4 class="mt-4">Categories:</h4>
                <ul> 
                  <?php
                      foreach ($post_cats as $cat): ?>
                
                      <li><a href="<?php print get_site_url()."/category/".$cat->slug; ?>"><?php print $cat->name; ?></a></li>
                
                 <?php endforeach ?>
               </ul>
               
              

  <?php if( get_the_tags($pos->ID) ) : 
            $thisTags = get_the_tags($pos->ID);
          ?>
              
                <h4>Tags:</h4>
                <ul>
              <?php
              foreach($thisTags as $thisTag){
              ?>
              <li><a href="<?php print get_site_url()."/tag/".$thisTag->slug; ?>"><?php print $thisTag->name; ?></a></li>
              <?php
              }
                ?>
              </ul>
              
               <button class="btn btn-secondary asset-btn"><a class="card-title-link" href="<?php the_permalink($pos->ID) ?>">
                           View Assset</a></button>
            </details>

<?php endif; ?>
  
<?php 
//END Cycle posts
endforeach; 
print "</div></div>";
}

function printCards($postsArray){

    foreach($postsArray as $pos):
    $post_cats = get_the_category($pos->ID);
    $post_tags = get_the_tags($pos->ID); 
    $tag_slugs="";
    $cat_slugs="";
    
    foreach ($post_cats as $cat){
      $cat_slugs.="cat_".$cat->slug." ";
    }

    if($post_tags){
    foreach ($post_tags as $tag){
      $tag_slugs .="tag_".$tag->slug." ";
    }
  }   
    ?>



<div class="tag_container card-view col-lg-6 col-xl-4 col-md-12 col-sm-12  <?php print $cat_slugs;?> <?php print $tag_slugs;?>"  >

  <div class="card  d-none d-md-block" >
         
<div class="card-body ">

          <a class="card-title-link" href="<?php the_permalink($pos->ID) ?>"><p class="card-title"><strong><?php print get_the_title($pos->ID); ?> </strong></p></a>
         
          <div class="cat-tags">
           <div class="row"> 
            <div class="col-12"><p class="mb-1"><strong>Categories:</strong></p>
              <ul class="post-categories ps-2">
              <?php
                  foreach ($post_cats as $cat): ?>

                    <li><a href="<?php print get_site_url()."/category/".$cat->slug; ?>"><?php print $cat->name; ?></a></li>

                 <?php endforeach ?>
               </ul>
            </div>
            </div>

  <?php if( get_the_tags($pos->ID) ) : 
            $thisTags = get_the_tags($pos->ID);
          ?>
               <div class="row"> 
            <div class="col-12">
              <p class="mb-1"><strong>Tags:</strong></p>
            
              <ul class="post-tags ps-2">
              <?php
              foreach($thisTags as $thisTag){
              ?>
              <li><a href="<?php print get_site_url()."/tag/".$thisTag->slug; ?>"><?php print $thisTag->name; ?></a></li>
              <?php
              }
                ?>
             
 <?php //echo get_the_tag_list('<ul class=\'post-tags\'><li>', '</li><li>', '</li></ul>'); // Display tags as links ?>
              </ul>
            </div>
          </div>
          
<?php endif; ?>
          </div>
        
    
      </div>
    </div>
    <div class="d-block d-md-none <?php print $cat_slugs;?> <?php print $tag_slugs;?>"  >
<p> <a class="cat-mobile-link" href="<?php the_permalink($pos->ID) ?>"><strong><?php print get_the_title($pos->ID); ?> </strong></a></p>
</div>
    </div>

<?php 
//END Cycle posts

endforeach; 
}





//---TURN OFF EXTRA LINE BREAKS
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
function aiooc_crunchify_wpautop_nobr( $content ) {
    return wpautop( $content, false );
}
add_filter( 'the_content', 'aiooc_crunchify_wpautop_nobr' );
add_filter( 'the_excerpt', 'aiooc_crunchify_wpautop_nobr' );

//Print resource Links

 /*function printLink($link,$type,$label){
                ?>
                  <li class="article-resource res-<?php print $type;?>">
                <a class="res-link" href="<?php print $link ?>"><?php print $label; ?>  
                </a>
                 </li> 
                 <?php
          }*/
/*-- change the sprt order for archive pages to by title ascending */

          function my_change_sort_order($query) {
    if ( !is_admin() && $query->is_main_query() && is_archive() ) {
        // Set the order to ascending (alphabetical A->Z)
        $query->set( 'order', 'ASC' );
        // Set the orderby parameter to title (name)
        $query->set( 'orderby', 'title' );
    }
}
add_action( 'pre_get_posts', 'my_change_sort_order' );

//ACF-----------------------------------------------------------------------------------------

add_action( 'acf/include_fields', function() {
  if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
  }

  acf_add_local_field_group( array(
  'key' => 'group_65e8a8244d66d',
  'title' => 'Additional Category Fields',
  'fields' => array(
    array(
      'key' => 'field_65e8a8714e326',
      'label' => 'cat-color',
      'name' => 'cat-color',
      'aria-label' => '',
      'type' => 'color_picker',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'enable_opacity' => 0,
      'return_format' => 'string',
    ),
    array(
      'key' => 'field_65e8af8861c69',
      'label' => 'Front Page Description',
      'name' => 'front_page_description',
      'aria-label' => '',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
      'delay' => 0,
    ),
    array(
      'key' => 'field_65e8b21110823',
      'label' => 'Category Image',
      'name' => 'category_image',
      'aria-label' => '',
      'type' => 'image',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'url',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
      'preview_size' => 'medium',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'taxonomy',
        'operator' => '==',
        'value' => 'category',
      ),
    ),
  ),
  'menu_order' => -10,
  'position' => 'side',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
) );

  acf_add_local_field_group( array(
  'key' => 'group_64dbab8f5381b',
  'title' => 'Post Display',
  'fields' => array(
    array(
      'key' => 'field_64dbab8f8c2bf',
      'label' => 'weight',
      'name' => 'weight',
      'aria-label' => '',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => 0,
      'maxlength' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
    ),
    array(
      'key' => 'field_64dcdd97b865a',
      'label' => 'Created By',
      'name' => 'created_by',
      'aria-label' => '',
      'type' => 'text',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'maxlength' => '',
      'placeholder' => '',
      'prepend' => '',
      'append' => '',
    ),
    array(
      'key' => 'field_6619414766eb5',
      'label' => 'Related Content',
      'name' => 'related_content',
      'aria-label' => '',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array(
        0 => 'post',
      ),
      'post_status' => '',
      'taxonomy' => '',
      'filters' => array(
        0 => 'search',
        1 => 'post_type',
        2 => 'taxonomy',
      ),
      'return_format' => 'object',
      'min' => '',
      'max' => '',
      'elements' => '',
      'bidirectional' => 1,
      'bidirectional_target' => array(
        0 => 'field_6619414766eb5',
      ),
    ),
    array(
      'key' => 'field_65ef1563b0093',
      'label' => 'Resources',
      'name' => 'resources',
      'aria-label' => '',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => array(
        0 => 'resource',
        1 => 'post',
      ),
      'post_status' => '',
      'taxonomy' => '',
      'filters' => array(
        0 => 'search',
        1 => 'post_type',
        2 => 'taxonomy',
      ),
      'return_format' => 'object',
      'min' => '',
      'max' => '',
      'elements' => '',
      'bidirectional' => 1,
      'bidirectional_target' => array(
        0 => 'field_65f1aaf086874',
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'post',
      ),
    ),
  ),
  'menu_order' => -10,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
) );

  acf_add_local_field_group( array(
  'key' => 'group_65f0868e15acc',
  'title' => 'Collections',
  'fields' => array(
    array(
      'key' => 'field_65f0868e47935',
      'label' => 'Feature this collection',
      'name' => 'featured',
      'aria-label' => '',
      'type' => 'checkbox',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'Yes' => 'Yes',
      ),
      'default_value' => array(
      ),
      'return_format' => 'value',
      'allow_custom' => 0,
      'layout' => 'vertical',
      'toggle' => 0,
      'save_custom' => 0,
      'custom_choice_button_text' => 'Add new choice',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'taxonomy',
        'operator' => '==',
        'value' => 'collection',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
) );

  acf_add_local_field_group( array(
  'key' => 'group_65f0a4384934c',
  'title' => 'Page Options',
  'fields' => array(
    array(
      'key' => 'field_65f0a438747f2',
      'label' => 'Banner Image',
      'name' => 'banner_image',
      'aria-label' => '',
      'type' => 'image',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'url',
      'library' => 'all',
      'min_width' => '',
      'min_height' => '',
      'min_size' => '',
      'max_width' => '',
      'max_height' => '',
      'max_size' => '',
      'mime_types' => '',
      'preview_size' => 'medium',
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'page',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
) );

  acf_add_local_field_group( array(
  'key' => 'group_65e1cfbb4ae16',
  'title' => 'Resource fields',
  'fields' => array(
    array(
      'key' => 'field_65e1d088e1b53',
      'label' => 'Resource Description',
      'name' => 'resource_description',
      'aria-label' => '',
      'type' => 'wysiwyg',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'tabs' => 'all',
      'toolbar' => 'full',
      'media_upload' => 1,
      'delay' => 0,
    ),
    array(
      'key' => 'field_65e1cfbbe6330',
      'label' => 'Resource Link',
      'name' => 'resource_link',
      'aria-label' => '',
      'type' => 'url',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_65e1cff5e6331',
            'operator' => '==empty',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ),
    array(
      'key' => 'field_65e1cff5e6331',
      'label' => 'Resource File',
      'name' => 'resource_file',
      'aria-label' => '',
      'type' => 'file',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => array(
        array(
          array(
            'field' => 'field_65e1cfbbe6330',
            'operator' => '==empty',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'return_format' => 'array',
      'library' => 'all',
      'min_size' => '',
      'max_size' => '',
      'mime_types' => '',
    ),
    array(
      'key' => 'field_65f1aaf086874',
      'label' => 'Related to',
      'name' => 'related_to',
      'aria-label' => '',
      'type' => 'relationship',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'post_type' => '',
      'post_status' => '',
      'taxonomy' => '',
      'filters' => array(
        0 => 'search',
        1 => 'post_type',
        2 => 'taxonomy',
      ),
      'return_format' => 'object',
      'min' => '',
      'max' => '',
      'elements' => '',
      'bidirectional' => 1,
      'bidirectional_target' => array(
        0 => 'field_65ef1563b0093',
      ),
    ),
  ),
  'location' => array(
    array(
      array(
        'param' => 'post_type',
        'operator' => '==',
        'value' => 'resource',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
  'active' => true,
  'description' => '',
  'show_in_rest' => 0,
) );
} );

add_action( 'init', function() {
  register_taxonomy( 'collection', array(
  0 => 'post',
  1 => 'resource',
), array(
  'labels' => array(
    'name' => 'Collections',
    'singular_name' => 'Collection',
    'menu_name' => 'Collections',
    'all_items' => 'All Collections',
    'edit_item' => 'Edit Collection',
    'view_item' => 'View Collection',
    'update_item' => 'Update Collection',
    'add_new_item' => 'Add New Collection',
    'new_item_name' => 'New Collection Name',
    'search_items' => 'Search Collections',
    'popular_items' => 'Popular Collections',
    'separate_items_with_commas' => 'Separate collections with commas',
    'add_or_remove_items' => 'Add or remove collections',
    'choose_from_most_used' => 'Choose from the most used collections',
    'not_found' => 'No collections found',
    'no_terms' => 'No collections',
    'items_list_navigation' => 'Collections list navigation',
    'items_list' => 'Collections list',
    'back_to_items' => '← Go to collections',
    'item_link' => 'Collection Link',
    'item_link_description' => 'A link to a collection',
  ),
  'public' => true,
  'show_in_menu' => true,
  'show_in_rest' => true,
) );
} );

add_action( 'init', function() {
  register_post_type( 'resource', array(
  'labels' => array(
    'name' => 'Resources',
    'singular_name' => 'Resource',
    'menu_name' => 'Resources',
    'all_items' => 'All Resources',
    'edit_item' => 'Edit Resource',
    'view_item' => 'View Resource',
    'view_items' => 'View Resources',
    'add_new_item' => 'Add New Resource',
    'new_item' => 'New Resource',
    'parent_item_colon' => 'Parent Resource:',
    'search_items' => 'Search Resources',
    'not_found' => 'No resources found',
    'not_found_in_trash' => 'No resources found in Trash',
    'archives' => 'Resource Archives',
    'attributes' => 'Resource Attributes',
    'insert_into_item' => 'Insert into resource',
    'uploaded_to_this_item' => 'Uploaded to this resource',
    'filter_items_list' => 'Filter resources list',
    'filter_by_date' => 'Filter resources by date',
    'items_list_navigation' => 'Resources list navigation',
    'items_list' => 'Resources list',
    'item_published' => 'Resource published.',
    'item_published_privately' => 'Resource published privately.',
    'item_reverted_to_draft' => 'Resource reverted to draft.',
    'item_scheduled' => 'Resource scheduled.',
    'item_updated' => 'Resource updated.',
    'item_link' => 'Resource Link',
    'item_link_description' => 'A link to a resource.',
  ),
  'public' => true,
  'show_in_rest' => true,
  'supports' => array(
    0 => 'title',
    1 => 'excerpt',
    2 => 'revisions',
    3 => 'custom-fields',
    4 => 'post-formats',
  ),
  'taxonomies' => array(
    0 => 'post_tag',
    1 => 'category',
  ),
  'has_archive' => 'resource',
  'rewrite' => array(
    'feeds' => false,
  ),
  'delete_with_user' => false,
) );
} );


//CUSTOM FOOTER
function my_theme_settings_init() {
    // 1. IMPORTANT: Use 'general' as the first argument (the group)
    register_setting('general', 'footer_custom_text', array(
        'sanitize_callback' => 'wp_kses_post', // Optional: Sanitize for HTML safety
        'type' => 'string'
    ));

    // 2. Add the section to the 'general' page
    add_settings_section(
        'footer_settings_section',
        'Footer Customization',
        '__return_false', // No need for a description function
        'general'
    );

    // 3. Add the field
    add_settings_field(
        'footer_text_field',
        'Footer Content',
        'my_theme_footer_field_callback',
        'general',
        'footer_settings_section'
    );
}
add_action('admin_init', 'my_theme_settings_init');

// The callback stays the same
function my_theme_footer_field_callback() {
    $value = get_option('footer_custom_text', '');
    echo '<textarea name="footer_custom_text" rows="5" cols="50" class="large-text">' . esc_textarea($value) . '</textarea>';
}

?>