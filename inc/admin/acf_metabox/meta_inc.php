<?php 

if(function_exists('acf_add_local_field')) {
    
    require_once ('post_type/movies.php');
    require_once ('post_type/episodes.php');
    require_once ('post_type/blog.php');
    require_once ('post_type/page.php');
    require_once ('post_type/questions.php');
    require_once ('post_type/products.php');
    require_once ('post_type/tv_shows.php');
    require_once ('post_type/videos.php');
    require_once ('post_type/user.php');
    require_once ('post_type/person.php');
    require_once ('post_type/advertising.php');
    require_once ('post_type/adsvmap.php');
    
    require_once ('new_field/live_data.php');
    acf_register_field_type( 'jws_acf_field_live_data' );
    
    require_once ('new_field/video_preview.php');
    acf_register_field_type( 'jws_acf_field_videos_preview' );
        
}

