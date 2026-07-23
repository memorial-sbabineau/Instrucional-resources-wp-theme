 <div class="dropdown " id="cat-nav" role="navigation" aria-label="Site Categories">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Please Select a Category
  </button>
 
  <ul class="dropdown-menu">
 <?php 

 $cats = get_terms(array('taxonomy'=>'category','hide_empty'=>true,'exclude'=>1)); 

 foreach ($cats as $cat){
      $term = "category_".$cat->term_id;
      $acf_color=get_field('cat-color',$term);
      ?>
<li ><a class="dropdown-item" href="<?php print get_site_url()."/category/".$cat->slug ?>"><?php print $cat->name; ?></a></li>

      <?php
 }
 ?>
  </ul>
</div>
</div>