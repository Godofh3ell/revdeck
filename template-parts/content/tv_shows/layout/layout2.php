<?php  
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );


$tv_shows_seasons = get_field('tv_shows_seasons',$post_id);

?>

<div class="post-inner">
    <div class="post-media">
        <a class="videos-play fs-small fw-500" href="<?php echo get_the_permalink($post_id); ?>">
            <i class="jws-icon-play-circle"></i>
            <?php echo esc_html__('Play Now','streamvid'); ?>
        </a>
        <?php     
            do_action('streamvid_post_videos_media',$args);
	
        ?>
    </div>
    <div class="tv-shows-content">
        <h6 class="title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
        <div class="tv-shows-cat fs-small">
            <?php echo jws_get_cat_list('tv_shows_cat',', ',$post_id); ?>
        </div>
    </div>
</div>