<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
$imdb = get_post_meta($post_id , 'videos_imdb' , true);
$years = get_post_meta($post_id , 'videos_years' , true);
$time = get_post_meta($post_id, 'videos_time' , true);
$badge = get_post_meta($post_id, 'videos_badge' , true);

?>

<div class="post-inner">
    <div class="post-media">
        <a href="<?php echo get_the_permalink($post_id); ?>">
            <?php 
                     
                 do_action('streamvid_post_videos_media',$args);
    	
            ?>
        </a>
    </div>
    <div class="movies-content">
        <h6 class="video_title fs-small fw-500">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
    </div>
</div>