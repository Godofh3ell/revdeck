<?php
if(!empty($args['tv_shows'])) {
    
    $post = get_post($args['tv_shows']); 
    setup_postdata($post); 
    if ( comments_open() || get_comments_number() ) :
        comments_template();
    endif; 
    wp_reset_postdata(); 
    
}
