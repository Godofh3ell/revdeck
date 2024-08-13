<?php 
    
    $trailer_type = get_post_meta(get_the_ID() , 'videos_trailer_type' , true);
    
    if($trailer_type == 'url') {
        $url =  get_post_meta(get_the_ID() , 'videos_trailer_url' , true);
        
      
    } else {
        $video_id =  get_post_meta(get_the_ID() , 'videos_trailer_file' , true);
    
        $url = wp_get_attachment_url($video_id);
     
    }
    
    if(empty($url)) $url = 'https://trailer.vieon.vn/Teaser_TheLionKing2019.mp4';
        
?>


<div class="video-play clear-both">
    <a class="btn-main button-default jws-play" href="#video-popup"><?php echo esc_html__('Watch Now','streamvid'); ?><i class="jws-icon-play-circle"></i></a> 
 
    <a class="btn-main button-custom video-trailer" href="<?php echo esc_attr($url); ?>">
    <?php echo esc_html__('Play Trailer','streamvid'); ?><i class="jws-icon-play-circle"></i>                                      
    </a>
</div>