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
$watchlisted = jws_watchlist_check($post_id);
?>

<div class="post-inner">
    <div class="content-front">
        <?php    
            do_action('streamvid_post_videos_media',$args);
        ?>
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
    </div>
    
    <div class="content-back">
        <h6 class="video_title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
        <div class="video-meta">
            <?php 
                echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : '';
                echo !empty($time) ? '<div class="video-time">'.$time.'</div>' : '';
            ?>
        </div>
        <div class="video-description jws-scrollbar">
            <?php echo get_the_excerpt($post_id); ?>
        </div>
        <a class="watchlist-add<?php if(!empty($watchlisted)) echo esc_attr($watchlisted); ?>" href="<?php echo get_the_permalink($post_id); ?>" data-post-id="<?php echo esc_attr($post_id); ?>">
            <i class="jws-icon-plus"></i>
            <span class="added"><?php echo esc_html__('Added to My List','streamvid'); ?></span>
            <span><?php echo esc_html__('Add to My List','streamvid'); ?></span>
        </a>
    </div>
</div>