<?php
get_header();
?>
<!-- CATEGORY TEMPLATE -->
 <div class="container" id="main">
  <div class="row">
        

      
   
    <h1>Search Results for: <em><?php echo get_search_query(); ?></em></h1>

<div class="col-md-9 col-sm-12 col-lg-9 col-xl-10">
  <div class="row">
 
         <?php 
        $tagsArray = array();
        $postsArray = array();
        $resArray = array();
       ?>
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php 

    
    
    $post_cats = get_the_category();
    $post_tags = get_the_tags(); 
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



<div class="tag_container col-lg-6 col-xl-4 col-md-12 col-sm-12 <?php print $cat_slugs;?> <?php print $tag_slugs;?>" style="margin-bottom:2rem;" >

  <div class="card">
         
<div class="card-body  hidden-sm hidden-xs">

          <a class="card-title-link" href="<?php the_permalink() ?>"><h3 class="card-title"><?php the_title(); ?></h3></a>
          <hr>
          <div class="cat-tags">
           <div class="row"> 
            <div class="col-lg-4 col-md-12 col-sm-12"><h4>Categories:</h4></div>
            <div class="col-lg-8 col-md-12 col-sm-12">   
              <ul class="post-categories">
              <?php
                  foreach ($post_cats as $cat): ?>

                    <li><a href="<?php print get_site_url()."/category/".$cat->slug ?>"><?php print $cat->name; ?></a></li>

                 <?php endforeach ?>
               </ul>
            </div>
            </div>

  <?php if( has_tag() ) : ?>
               <div class="row"> 
            <div class="col-lg-4 col-md-12 col-sm-12">
              <h4>Tags:</h4>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
 <?php echo get_the_tag_list('<ul class=\'post-tags\'><li>', '</li><li>', '</li></ul>'); // Display tags as links ?>
 <?php $thisTags = get_the_tags();
    foreach($thisTags as $postTag){
      if(!in_array($postTag->slug ,$tagsArray)){
        $tagEntry = array("slug"=>$postTag->slug, "name"=>$postTag->name);
        $tagsArray[$postTag->slug]=$tagEntry;}
    }
 ?>
            </div>
          </div>
          
<?php endif; ?>
          </div>
        
    
      </div>
    </div>
    </div>

         <?php endwhile; ?>

       <?php endif; ?>
</div>
 </div>
   <div class="col-md-3 col-lg-3 col-xl-2" id="tagsinpage">
    <h4>Filter results by tag:</h4>
    <ul id="tip-list">

    </ul>
     <button id="clearFilter" class="btn btn-info btn-fullwide">Clear Filter</button>
    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="alltags">
  <label class="form-check-label" for="flexSwitchCheckDefault">Show only articles containing all selected tags.</label>
</div>
   
  </div>
  </div>

</div>

<script type="text/javascript">
    const tip_list = document.getElementById('tip-list');
    const tag_containers = document.querySelectorAll(".tag_container");
    const clearFilter = document.getElementById("clearFilter");
    const allTags = document.getElementById("alltags");

    let filterTags = [];
    clearFilter.addEventListener('click',function(){
      showAllblocks();
      
    });

//Adding elements to pagetags by printing php variables
  let pagetags = [<?php foreach($tagsArray as $tag){print "['".$tag['slug']."','".$tag['name']."'],";} ?>];
  
    pagetags.forEach(function(i){

        tip_list.innerHTML +='<li><button data-tag="'+i[0]+'"class="btn btn-sm btn-outline-primary tip-btn">'+i[1]+'</button></li>';
    });
// This variable is created after the buttons are created becasue otherwise they would not exist
  const tip_btns = document.querySelectorAll(".tip-btn");

tip_btns.forEach(btn=>{btn.addEventListener('click',function(){filterSelected(btn)})});

allTags.addEventListener("click",function(){
  if(filterTags.length > 0){
        updateFilter();
      }

});

// CLick the tag button
    function filterSelected(btn){
              //change the color of the button
          if(!btn.classList.contains('active')){
              btn.classList.remove('btn-outline-primary');
              btn.classList.add('btn-success');
              btn.classList.add('active');

              filterTags.push("tag_"+btn.dataset.tag);
              
              //check if each container has a class matching the buttons tag and hide it if it doesn't match


              }
              else{
                btn.classList.add('btn-outline-primary');
                btn.classList.remove('btn-success');
                btn.classList.remove('active');
                let tagIndex = filterTags.indexOf("tag_"+btn.dataset.tag);
                filterTags.splice(tagIndex,1);

              }
              if(filterTags.length !== 0){
                updateFilter();
              }
              else{
                showAllblocks();
              }
              
        }

// Update the filter diplaying the blocks
function updateFilter(){
                let getAll = allTags.checked;
               
               
                tag_containers.forEach(function(t){
                  //hide everything
                  let show = false;
                  let noCount=0;
                  t.style.display="none";
                  //if a box contains one of the classes from filterTags show it
                  filterTags.forEach(function(f){
                    if(t.classList.contains(f)){
                          show=true;
                        }
                        else{
                          noCount++;
                        }
                  });

                  if(getAll&&noCount>0){
                    show=false;
                  }

                  if(show){
                          t.style.display="inline-block";
                        }

                });


                  
}

// Show all the blocks
function showAllblocks(){
  tag_containers.forEach(function(t){
        t.style.display="inline-block";
      });
}

</script>
<?php get_footer(); ?>
