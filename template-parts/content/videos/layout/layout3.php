<?php 

$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID(),
    'edit'      => false,
) );
extract( $args );
$video_time = get_post_meta($post_id , 'videos_time' , true);
$live = get_post_meta($post_id , 'live_data' , true);

?>

<div class="post-inner">
    <div class="post-media">
        <?php     
            do_action('streamvid_post_videos_media',$args);
        ?>
    </div>
    <div class="videos-content">
        <div class="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 50 ); ?><?php if(!empty($live)) echo '<span class="live"></span>'; ?>
        </div>
        <div>
            <h6 class="title">
               <a href="<?php echo get_the_permalink($post_id); ?>">
                     <?php echo get_the_title($post_id); ?>
               </a> 
            </h6>
            <div class="videos-meta">
                <span class="author-name">
                    <?php echo get_the_author_meta( 'display_name', get_the_author_meta( 'ID' )); ?>
                </span>
                <span class="view">
                    <?php  printf( _n( '%s view', '%s views', jws_get_videos_view() , 'streamvid' ), jws_get_videos_view() ); ?> 
                </span>
                <span class="time">
                    <?php echo jws_videos_time_ago_function(); ?>
                </span>
            </div>
        </div>
    </div>
</div>