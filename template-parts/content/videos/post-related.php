<?php 

 global $jws_option;

$selected_layout = $jws_option['select-related-videos'] ;  

$related_cat  = wp_get_object_terms( get_the_ID() , 'videos_cat', array('fields' => 'ids'));
if(empty($related_cat)) {
    return false;
}
  
if(!empty($selected_layout)) {
   echo '<div class="jws-related">'.do_shortcode('[hf_template id="' . $selected_layout . '"]').'</div>'; 
}

