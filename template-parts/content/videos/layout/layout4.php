<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID(),
    'playlist'   =>  ''
) );
extract( $args );
$video_time = get_post_meta(get_the_ID() , 'videos_time' , true);

?>

<div class="post-inner">
    <div class="post-media">
        <?php     
            do_action('streamvid_post_videos_media',$args);
	        
            if(!empty($video_time)) {
                echo '<span class="time"><i class="jws-icon-play-circle"></i>'.$video_time.'</span>';
            }
               
        ?>
    </div>
    <div class="videos-content">
        <h6 class="title">
           <a href="<?php if(!empty($playlist)) { echo add_query_arg( 'playlist', $playlist , get_the_permalink($post_id) ); } else { echo get_the_permalink($post_id); }  ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
        <div class="videos-meta">
                <span class="view">
                    <?php  printf( _n( '%s view', '%s views', jws_get_videos_view() , 'streamvid' ), jws_get_videos_view() ); ?> 
                </span>
                <span class="time">
                    <?php echo jws_videos_time_ago_function(); ?>
                </span>
            </div>
    </div>
</div>