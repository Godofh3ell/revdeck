<?php
global $jws_option;

$selected_layout = $jws_option['select-related-blog'] ;    
if(!empty($selected_layout)) {
   echo '<div class="post-related">'.do_shortcode('[hf_template id="' . $selected_layout . '"]').'</div>'; 
}
