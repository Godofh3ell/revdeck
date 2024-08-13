<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
$imdb = get_post_meta($post_id , 'videos_imdb' , true);
$years = get_post_meta($post_id , 'videos_years' , true);
$time = get_post_meta($post_id , 'videos_time' , true);
$image2 = get_post_meta($post_id , 'featured_image_two' , true);
$trailer = jws_check_trailer($post_id);
 
?>

<div class="post-inner">
 
        <div class="post-media">
      
            <?php    
                do_action('streamvid_post_videos_media',$args);
                $attach_id = get_post_thumbnail_id($post_id);
                $backgroumd_hover = !empty($image2) ? $image2 : $attach_id;
            ?>
       
             <div class="content-hover" data-url="<?php echo wp_get_attachment_image_url($backgroumd_hover, 'full' ); ?>">
             <a class="overlay" href="<?php echo get_the_permalink($post_id); ?>">  </a> 
                <div class="hover-inner">
                <h6 class="video_title">
                   <a href="<?php echo get_the_permalink($post_id); ?>">
                         <?php echo get_the_title($post_id); ?>
                   </a> 
                </h6>
                <div class="video-meta">
                    <?php 
                        echo !empty($badge) ? '<div class="video-badge">'.$badge.'</div>' : '';
                        echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                        echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
                    ?>
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
 
</div>