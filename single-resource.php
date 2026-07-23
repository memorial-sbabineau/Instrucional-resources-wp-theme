<?php
get_header();

?>

 <div class="container" id="main">
  <div class="row">
        

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php //var_dump($post) ?>
  <?php $resources = get_field('resources');
          ?>

  <div class="col-md-9 col-sm-12 col-lg-9 col-xl-10">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

         
          <h1><?php the_title(); ?></h1>
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
             
              $resDesc = get_field('resource_description');
              $resLink = get_field('resource_link');
              $resFile = get_field('resource_file');
              $resRelated = get_field('related_to');

             ?>
         

          <div class="entry-content">
            
            <?php
              if($resDesc){
                print $resDesc;
              }

              if($resLink){ ?>
                <p><strong>Follow Link:</strong></p>
                <p><a href="<?php print $resLink; ?>" target= "_blank"><?php print $resLink; ?></a>
                  <?php
              }

              if($resFile){ 

                ?>

                <p><strong>Download File:</strong></p>
                
                <p><a href="<?php print $resFile['url']; ?>" target= "_blank"><?php print $resFile['title']; ?></a></p>
                <p><strong>File Type:</strong> <?php print $resFile['type']; ?></p>
                <p><strong>File Size:</strong> <?php print round($resFile['filesize']/1024); ?>KB</p>
                
                

                  <?php
                               } ?>
            <h2>Availability</h2>
                <?php if($resRelated){ ?>
                <p>This resource appears in the following articles:</p>
                <ul>
                  <?php
                    foreach($resRelated as $res){ ?>
                      <li><a href="<?php print the_permalink($res->ID);?> "><?php print get_the_title($res->ID); ?></a></li>

                    <?php }?>
                  </ul>
                    <?php

                  }
                  else{?>
                    <p>This resource is not currently included in any articles.</p>
                 <?php }

            ?>



            <?php
            if(get_field('created_by')){
              ?>
              <p><em>Resource created by: <?php print get_field('created_by'); ?> </em></p>
              <?php
            }
            ?>
          </div>
        </article>

       
      </div>

     <?php endwhile; endif; ?>
    

         
          <div class="col-md-3 col-lg-3 col-xl-2 sidebar" >
             
          <?php 

          $postCats = get_the_category(); 

          if ($postCats){ ?>
<div class="cat-tags">
            <p><strong>Categories</strong></p>
      <ul class="tip-list post-categories">
            <?php
            foreach($postCats as $postCat){?>

                  <li><a href="<?php echo esc_url(home_url('/')); ?>category/<?php print $postCat->slug; ?>" "><?php print $postCat->name; ?></a></li>
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

            <?php if($resources):?> 
          <div class="cat-tags">
            <p><strong>Related Resources</strong></p>
          
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

           function printLink($link,$type,$label){
                ?>
                  <li class="article-resource res-<?php print $type;?>">
                <a class="res-link" href="<?php print $link ?>"><?php print $label; ?>  
                </a>
                 </li>
           <?php }

            if(count($res_links)): ?>

            <p>Resources</p>
            <ul class="tip-list post-res">
              <?php 
              foreach($res_links as $res){
                //printLink(get_permalink($res->ID),"resource",get_the_title($res->ID)); 

                $fileLink = get_field('resource_file',$res->ID);
                $webLink = get_field('resource_link',$res->ID);
                $resourceLink ='';
                if($fileLink){
                  $resourceLink = $fileLink;
                }

                if($webLink){
                  $resourceLink = $webLink;
                }?>

                <li>
                <a href="<?php print $resourceLink ?>"><?php print get_the_title($res->ID); ?>
                </a>
                 </li>
                 <?php
              } 
              ?>
            </ul>
           <?php endif; ?>

                      <?php if(count($art_links)): ?>

            <p>Articles</p>
            <ul class="tip-list post-articles">
              <?php 
              foreach($art_links as $res){
                ?>
                 <li>
                <a  href="<?php print get_permalink($res->ID) ?>"><?php print get_the_title($res->ID) ?>  
                </a>
                 </li>
            <?php
              }
              ?>
            </ul>
           <?php endif; ?>
         </div>
          <?php endif;  ?>

          </div>
           
</div>

    </div>
  </div>
</div>

<?php get_footer(); ?>
