<?php 
$args = wp_parse_args( $args , array(
    'id'    =>  0,
) );

extract( $args );

$video_time = get_post_meta($id , 'time' , true);

?>
<div class="post-inner">
    <input type="checkbox" name="watchlisted[]" value="<?php echo esc_attr($id); ?>" />
    <div class="post-media">
        <?php     
            $attach_id = get_post_thumbnail_id($id);
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $args['image_size']));
            echo !empty($image) ? $image : '';
	        
            if(!empty($video_time)) {
                echo '<span class="time"><i class="jws-icon-play-circle"></i>'.$video_time.'</span>';
            }
               
        ?>
    </div>
    <div class="videos-content">
        <h6 class="title">
           <a href="<?php echo get_the_permalink($id); ?>">
                 <?php echo get_the_title($id); ?>
           </a> 
        </h6>
        <div class="videos-meta">
                <span class="view">
                    <?php  printf( _n( '%s view', '%s views', jws_get_videos_view($args) , 'streamvid' ), jws_get_videos_view($args) ); ?> 
                </span>
                <span class="time">
                    <?php echo jws_videos_time_ago_function($args); ?>
                </span>
            </div>
    </div>
</div>