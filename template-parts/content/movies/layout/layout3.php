<?php 

$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );

$imdb = get_post_meta($post_id , 'videos_imdb' , true);
$years = get_post_meta($post_id , 'videos_years' , true);
$time = get_post_meta($post_id , 'videos_time' , true);
$badge = get_post_meta($post_id , 'videos_badge' , true);
$language = get_post_meta($post_id , 'videos_language' , true);
$cast = get_field('cast');
$crew = get_field('crew');

$trailer = jws_check_trailer($post_id);



?>

<div class="post-inner">
    <div class="content-display">
        <div class="post-media">
            <a href="<?php echo get_the_permalink($post_id); ?>">
            <?php    
              do_action('streamvid_post_videos_media',$args);
            ?>
            </a>
             <div class="content-hover">
                <div class="hover-inner jws-scrollbar">
                <?php 
                    if(!empty($imdb)) {
                        echo '<div class="video-imdb"><span>'.$imdb.'</span></div>';
                    }
                ?>
                <h5 class="video_title">
                   <a href="<?php echo get_the_permalink($post_id); ?>">
                         <?php echo get_the_title($post_id); ?>
                   </a> 
                </h5>
                <div class="video-meta">
                    <?php 
                        echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                        echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                        echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                    ?>
                </div>
                <div class="video-description">
                    <?php echo get_the_excerpt(); ?>
                </div>
                <div class="video-meta2">
                    <?php if(!empty($language)) : ?>
                        <div><label><?php echo esc_html__('Language:','streamvid'); ?></label><?php echo esc_html($language); ?></div>
                    <?php endif; ?> 
                    <?php if(!empty($cat)) : ?>
                        <div><label><?php echo esc_html__('Genre:','streamvid'); ?></label><?php echo jws_get_cat_list('movies_cat',', '); ?></div>
                    <?php endif; ?>    
                    <?php if(!empty($cast)) : ?>
                        <div><label><?php echo esc_html__('Actor:','streamvid'); ?></label>
                            <?php 
                                foreach($cast as $cast_value) {
                                    echo '<a href="'.get_the_permalink($cast_value['person']).'">'.get_the_title($cast_value['person']).'</a>';
                                    if ($cast_value != end($cast)) {
                                       echo ', ';
                                    }    
                                    
                                }
                             ?>
                        </div>
                    <?php endif; ?> 
                    <?php if(!empty($crew)) : ?>
                        <div><label><?php echo esc_html__('Crew:','streamvid'); ?></label>
                            <?php 
                                foreach($crew as $crew_value) {
                                    echo '<a href="'.get_the_permalink($crew_value['person']).'">'.get_the_title($crew_value['person']).'</a>';
                                    if ($crew_value != end($crew)) {
                                       echo ', ';
                                    }    
                                    
                                }
                             ?>
                        </div>
              
                    <?php endif; ?> 
                </div>
                <div class="video-play">
                    <?php if(!empty($trailer)) : ?>
                    <a class="video-trailer" href="<?php echo esc_attr($trailer); ?>">
                        <i class="jws-icon-play-fill"></i>
                        <?php echo esc_html__('Trailer','streamvid'); ?>
                    </a>
                    <?php endif; ?>
                    <a class="video-detail" href="<?php echo get_the_permalink($post_id); ?>">
                        <i class="jws-icon-info-light"></i>
                        <?php echo esc_html__('Detail','streamvid'); ?>
                    </a>
                </div>
            </div>
           </div> 
        </div>
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
        <div class="video-cat">
            <?php echo jws_get_cat_list('movies_cat',' ',$post_id);  ?>
        </div>
    </div>
    
   
</div>