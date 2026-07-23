<?php
get_header();
?>
<div class="container" id="main">
  <div class="row">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php //var_dump($post) ?>
    <?php $resources = get_field('resources');
    $related = get_field('related_content');
    ?>
    <div class="col-md-9 col-sm-12 col-lg-9 col-xl-10">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
        <h1><?php the_title(); ?> </h1>
        <?php
        //some info for admins
        $show_debug = false;
        $current_user = wp_get_current_user();
        if (in_array('administrator', $current_user->roles) && $show_debug) { ?>
        
        <div class="row">
          <div class="col-md-12 bg-info">
            <details>
            <summary>Post Info</summary>
            <dl>
              <?php print("<dt>Post ID</dt><dd>".$post->ID."</dd>"); ?>
              <?php print("<dt>Post Title</dt><dd>".$post->post_title."</dd>"); ?>
              <?php print("<dt>Created</dt><dd>".$post->post_date."</dd>"); ?>
              <?php print("<dt>Last Updated</dt><dd>".$post->post_modified."</dd>"); ?>
              <?php print("<dt>Status</dt><dd>".$post->post_status."</dd>"); ?>
              
              
            </dl>
            </details>
          </div></div>
          <?php
          }
          
          ?>
          
          <div class="entry-content">
            <?php the_content(); ?>
            <?php
            if(get_field('created_by')){
            ?>
            <p class="resource-author"><em>Resource created by: <?php print get_field('created_by'); ?> </em></p>
            <?php
            }
            ?>
            <p class="res-og"><small><em>Originally Published: <?php $post_date = get_the_date( 'F j, Y' ); echo $post_date; ?></em></small></p>
            <?php wp_link_pages(); ?>
          </div>
        </article>
        
      </div>
      <?php endwhile; endif; ?>
      
      
      <div class="col-md-3 col-lg-3 col-xl-2" >
        
        <?php
        $postCats = get_the_category();
        if ($postCats){ ?>
        <div class="cat-tags">
          <p><strong>Categories</strong></p>
          <ul class="tip-list post-categories">
            <?php
            foreach($postCats as $postCat){?>
            <li><a href="<?php echo esc_url(home_url('/')); ?>category/<?php print $postCat->slug; ?>" ><?php print $postCat->name; ?></a></li>
            <?php
            }?>
          </ul>
        </div>
        <?php
        }
        ?>
        
        <?php
        $postTags = get_the_tags();
        if($postTags){
        ?>
        <div class="cat-tags">
          <p><strong>Tags</strong></p>
          <ul class="tip-list post-tags">
            <?php foreach($postTags as $tag){ ?>
            <li><a href="<?php echo esc_url(home_url('/')); ?>tag/<?php print $tag->slug; ?>" ><?php print $tag->name; ?></a></li>
            <?php } ?>
          </ul>
        </div>
        <?php
        }
        ?>
        <?php
        //related content
        if($related):
        ?>
        <div class="cat-tags">
          <p><strong>Related Articles</strong></p>
          <ul class="tip-list post-articles">
            <?php
            foreach ($related as $r_post) { ?>
            <li ><a class="" href="<?php print get_permalink($r_post->ID); ?>"><?php print $r_post->post_title; ?></a></li>
            <?php
            }
            ?>
          </ul>
        </div>
        <?php
        endif;
        //// END related content
        ?>
        
        
        </div> <!-- END SIDEBAR -->
        
        </div><!-- END MAIN ROW -->
        <?php if($resources):?>
        <?php
        $res_links = [];
        $art_links =[];
        foreach($resources as $resource):
        $rType = get_post_type($resource->ID);
        if($rType == "post"){
        $art_links[]=$resource;
        }
        else if($rType == "resource"){
        $res_links[] = $resource;
        }
        
        
        endforeach;
        ?>
        <hr>
        <div class="row">
          <div class="col-12">
            
            <details>
            <summary><strong>Related Resources (<?php echo count($resources); ?>)</strong></summary>
            <div class="mt-4">
                         <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Resource Type</th>
                              <th>Resource Link</th>
                            </tr>
                          </thead>
                          <tbody>
              <?php
              if(count($res_links)): ?>

              <!-- <ul class="tip-list post-res">-->
                <?php
                foreach($res_links as $res){
                $fileLink = get_field('resource_file',$res->ID);
                $webLink = get_field('resource_link',$res->ID);
                $resType="";
                $resourceLink ='';
                if($fileLink){
                $resourceLink = $fileLink['url'];
                $resType = "File";
                }
                if($webLink){
                $resourceLink = $webLink;
                $resType = "External Link";
                }?>
                <tr>
                  <td>
                  <em><?php print $resType; ?>  </em>
                  </td>
                  <td><a href="<?php print the_permalink($res->ID); ?>"><?php print get_the_title($res->ID); ?>
                  </a></td>
                </tr>
                <?php
                }
                ?>
               <!-- </ul> -->
              <?php endif; ?>
              <?php if(count($art_links)): ?>
              <!-- <ul class="tip-list post-articles"> -->
                <?php
                foreach($art_links as $res){
                ?>
                <tr>
                  <td>
                  <em>Article </em>
                </td>
                  <td> 
                    <a  href="<?php print get_permalink($res->ID) ?>"><?php print get_the_title($res->ID) ?>
                                    </a></td>
                </tr>
                <?php
                }
                ?>
              <!-- </ul> -->
            
              
              <?php endif; //END RESOURCES CHECK ?>
              </tbody>
              </table>
            </div>
          </div>
          </details>
          </div><!-- end Row -->
          <?php endif;  // END LOOP ?>
          </div> <!-- END CONTAINER -->
          <?php get_footer(); ?>