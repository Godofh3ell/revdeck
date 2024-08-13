<?php 

global $jws_option;

$selected_layout = $jws_option['select-related-tv_shows'] ;    
if(!empty($selected_layout)) {
   echo '<div class="jws-related">'.do_shortcode('[hf_template id="' . $selected_layout . '"]').'</div>'; 
}