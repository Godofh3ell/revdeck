<?php 

$videos = get_post_meta(get_the_ID() , 'featured_clips' , true);

$image_size = '580x326';  


$data_slick = 'data-owl-option=\'{
"autoplay":false,
"nav":true, 
"loop":false,
"dots":false, 
"autoWidth":true,
"smartSpeed":500, 
"responsive":{
    "1024":{"items":1,"slideBy":1},
    "768":{"items":1,"slideBy":1},
    "0":{"items":1,"slideBy":1}
}}\'';


if(!empty($videos)) : ?>
        <div class="jws-videos-advanced-element global-video">
        <h5><?php echo esc_html__('Featured Clips','streamvid'); ?></h5>
        <div class="videos-advanced-content layout1 jws-videos-advanced-slider owl-carousel clear-both" <?php echo ''.$data_slick; ?>>
            <?php 
                foreach($videos as $videos_value) {
                  
                    $video_time = get_post_meta($videos_value , 'video_time' , true);
                    
                    ?>
                    <div class="jws-post-item slider-item">
                        <div class="post-inner">
                            <div class="post-media">
                                <?php     
                                    $attach_id = get_post_thumbnail_id($videos_value);
                                    $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                    echo !empty($image) ? $image : '';
                        	        
                                    if(!empty($video_time)) {
                                        echo '<span class="time"><i class="jws-icon-play-circle"></i>'.$video_time.'</span>';
                                    }
                                       
                                ?>
                            </div>
                            <div class="videos-content">
                                <h6 class="title">
                                   <a href="<?php echo get_the_permalink($videos_value); ?>">
                                         <?php echo get_the_title($videos_value); ?>
                                   </a> 
                                </h6>
                        
                            </div>
                        </div>
                    </div>
             <?php   }
             ?>
        </div>
        </div>
<?php else :


echo esc_html__('Empty video','streamvid');


endif; ?>