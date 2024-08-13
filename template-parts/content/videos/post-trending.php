<?php 

global $jws_option;

$selected_layout = $jws_option['select-trending-videos'] ;    
if(isset($_GET['version']) && $_GET['version'] == 'v3') {
    $selected_layout = '4153';
}
if(!empty($selected_layout)) {
   echo '<div class="jws-trending">'.do_shortcode('[hf_template id="' . $selected_layout . '"]').'</div>'; 
}

