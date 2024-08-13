<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
$user_id = get_current_user_id();
$video_progress_data = get_user_meta($user_id, 'video_progress_data',true);

$number = get_post_meta($post_id , 'episodes_number' , true);
$time = get_post_meta($post_id , 'videos_time' , true);

?> 
<div class="post-inner"> 
        <div class="post-media">
            <a href="<?php echo get_the_permalink($post_id); ?>">
                <?php 
                    $attach_id = get_post_thumbnail_id($post_id);
                    $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                    echo !empty($image) ? $image : '';
                ?>
            </a>
            <?php echo !empty($time) ? '<span class="time"><i class="jws-icon-play-circle"></i>'.$time.'</span>' : ''; ?>
				 <?php  if(isset($video_progress_data[$post_id]['time'])) {

				$time = $video_progress_data[$post_id]['time'] / $video_progress_data[$post_id]['endtime'] * 100;

			  ?>
			  <div class="time-data">
				   <span style="width:<?php echo esc_attr($time) ?>%;" class=""></span>
					   <?php 

					   ?>
				</div>
			<?php } ?>
        </div>
        
        <div class="episodes-info">
            <span class="episodes-number"><?php echo esc_attr($number); ?></span>
            <h6><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h6>
            <div class="jws-description"> <?php  echo wp_trim_words( get_the_excerpt($post_id), 10, '...' ); ?></div>
        </div>
</div>
