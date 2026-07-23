   

   <?php if(!$tagsArray){
    $tagsArray = [];
   }
   ?>

   <?php if(count($tagsArray)>0): 
      //make sure the tags array is not empty-- finishes after the javascript
    ?>


    <button id="list-view" class="btn btn-outline-secondary view-btn mb-2">List View</button>
    <button id="card-view" class="btn btn-outline-secondary view-btn">Card View</button>
    <h4 class="mt-3 mb-1">Filter results:</h4>
   
    <ul id="tip-list">

    </ul>
     <button id="clearFilter" class="btn btn-secondary btn-fullwide">Clear Filter</button><br><br>
    <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="alltags">
  <label class="form-check-label" for="flexSwitchCheckDefault">Show only articles containing all selected tags.</label>
  <br><br>
</div>
   
  </div>

  <script type="text/javascript">
    
    const listView = document.getElementById("list-view");
    const cardView = document.getElementById("card-view");
    const mainContainer = document.getElementById('main');
    const tip_list = document.getElementById('tip-list');
    const tag_containers = document.querySelectorAll(".tag_container");
    const clearFilter = document.getElementById("clearFilter");
    const allTags = document.getElementById("alltags");

    let filterTags = [];
    clearFilter.addEventListener('click',function(){
      showAllblocks();
      
    });

//Adding elements to pagetags by printing php variables
  let pagetags = [<?php foreach($tagsArray as $tag){print "['".$tag['slug']."','".$tag['name']."','tag'],";} ?>];
  let pagecats = [<?php foreach($catArray as $tag){print "['".$tag['slug']."','".$tag['name']."','cat'],";} ?>];
  console.log(pagetags);


  //add tags label
    tip_list.innerHTML += "<p><strong>Tags</strong></p>";
    pagetags.forEach(function(i){
      //add list items
        tip_list.innerHTML +='<li><button data-tag="'+i[2]+'_'+i[0]+'"class="btn btn-sm btn-outline-warning tip-btn '+i[2]+'-btn">'+i[1]+'</button></li>';
    });


    // add categories label
    tip_list.innerHTML += "<p class='mt-2'><strong>Categories</strong></p>";
    pagecats.forEach(function(i){
      //add list items
        tip_list.innerHTML +='<li><button data-tag="'+i[2]+'_'+i[0]+'"class="btn btn-sm btn-outline-primary tip-btn '+i[2]+'-btn">'+i[1]+'</button></li>';
    });


// This variable is created after the buttons are created becasue otherwise they would not exist
  const tip_btns = document.querySelectorAll(".tip-btn");

tip_btns.forEach(btn=>{btn.addEventListener('click',function(){filterSelected(btn)})});

//this is the switch to filter for all selected tags
allTags.addEventListener("click",function(){
  if(filterTags.length > 0){
        updateFilter();
      }

});

//change the card layout to a list layout
listView.addEventListener('click',function(){
   const catTags = document.querySelectorAll(".cat-tags");
   catTags.forEach(function(v,i){
    v.style.display="none"
   });

  tag_containers.forEach(function(v,i){
    v.classList.remove('col-lg-6','col-xl-4','col-md-12','col-sm-12', 'card-view');
    v.classList.add('col-12');
});
});

//change the list layout to a card layout
cardView.addEventListener('click',function(){
     const catTags = document.querySelectorAll(".cat-tags");
   catTags.forEach(function(v){
    v.style.display="block";
   });
  tag_containers.forEach(function(v,i){
    v.classList.remove('col-12');
    v.classList.add('col-lg-6','col-xl-4','col-md-12','col-sm-12', 'card-view');
    
});
});


// CLick the tag button
    function filterSelected(btn){
              //change the color of the button
          if(!btn.classList.contains('active')){
              //btn.classList.remove('btn-outline-primary');
              //btn.classList.add('btn-success');
              btn.classList.add('active');

              filterTags.push(btn.dataset.tag);
              
              //check if each container has a class matching the buttons tag and hide it if it doesn't match


              }
              else{
                //btn.classList.add('btn-outline-primary');
                //btn.classList.remove('btn-success');
                btn.classList.remove('active');
                let tagIndex = filterTags.indexOf(btn.dataset.tag);
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

                  if(show&&t.classList.contains('asset-list-item')){
                          t.style.display="block";
                        }
                        else if(show){
                          t.style.display="inline-block";
                        }

                });


                  
}

// Show all the blocks
function showAllblocks(){
  tag_containers.forEach(function(t){
        t.style.display="inline-block";
      });
    tip_btns.forEach(function(b){
      b.classList.remove('active');
    });
    filterTags = [];
    if(allTags.checked){allTags.checked=false;}

}



</script>

<?php 
    endif; 
    //finish making dure that the tags array is not empty

  ?>