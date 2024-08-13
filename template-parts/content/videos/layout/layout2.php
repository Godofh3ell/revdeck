<?php 

$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID(),
    'edit'      => false,
) );
extract( $args );
$video_time = get_post_meta($post_id , 'videos_time' , true);

?>

<div class="post-inner">
    <div class="post-media">
        <a href="<?php echo get_the_permalink($post_id); ?>">
        <?php     
           do_action('streamvid_post_videos_media',$args);
	        
            if(!empty($video_time)) {
                echo '<span class="time">'.$video_time.'</span>';
            }

            echo '<a href="'.get_the_permalink($post_id).'" class="play-video"><i class="jws-icon-play-circle"></i></a>';

        ?>
        </a>
    </div>
    <div class="videos-content">
        <div class="author-avatar">
            <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
            </a>
        </div>
        <div class="video-cat">
            <?php echo jws_get_cat_list('videos_cat',' ',$post_id); ?>
        </div>
        <h6 class="title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
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