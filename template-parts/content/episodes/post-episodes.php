<?php 



$tv_shows_seasons = get_field('tv_shows_seasons',$args['tv_shows']);
$seasion = ($args['season'] - 1);
if(isset($tv_shows_seasons[$seasion]['episodes']) && !empty($tv_shows_seasons[$seasion]['episodes'])) : 

$episodes = $tv_shows_seasons[$seasion]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize');  

$user_id = get_current_user_id();
$video_progress_data = get_user_meta($user_id, 'video_progress_data',true);
$data_slick = 'data-owl-option=\'{
"autoplay":false,
"nav":true, 
"loop":false,
"dots":false, 
"autoWidth":true,
"smartSpeed":500, 
"responsive":{
    "1024":{"items":1,"slideBy":1},
    "768":{"items":1,"slideBy":1},
    "0":{"items":1,"slideBy":1}
}}\'';

?>
        <div class="jws-episodes_advanced-element global-episodes">
   
            <div class="jws-episodes-heading clear-both">
            
            <h5 class="heading"><?php echo esc_html__('Episodes','streamvid'); ?></h5>
            
            <a class="jws-view-episodes" href="<?php echo trailingslashit( get_the_permalink($args['tv_shows'] ) ) . 'episodes/?season='.$args['season'].''; ?>"><?php echo esc_html__('All Episodes','streamvid'); ?><i class="jws-icon-caret-right"></i></a>
            
            </div>
   
        <div class="jws-pisodes_advanced-slider episodes-content clear-both owl-carousel layout3" <?php echo ''.$data_slick; ?>>
            <?php 
                foreach($episodes as $episodes_value) { $post_id = $episodes_value;
                   ?>
                   
                    
                    <div class="jws-pisodes_advanced-item slider-item">
                    
                    
                   <?php 
                   
                   $number = get_post_meta($episodes_value , 'episodes_number' , true);
                   $time = get_post_meta($episodes_value , 'episodes_time' , true);
                   
                   
                    ?>
                    <div class="post-inner">
                            <div class="post-media">
                                <a href="<?php echo get_the_permalink($episodes_value); ?>">
                                    <?php 
                                        $attach_id = get_post_thumbnail_id($episodes_value);
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
                                <h6><a href="<?php echo get_the_permalink($episodes_value); ?>"><?php echo get_the_title($episodes_value); ?></a></h6>
                                <div class="jws-description">
                                    <?php  echo wp_trim_words( get_the_excerpt($episodes_value), 10, '...' ); ?>
                               
                                </div>
                            </div>
                    </div>
                    
                    
                    </div>
                   
                   
                   <?php 
                }
             ?>
        </div>
        <div class="jws-nav-carousel">
             <div class="jws-button-prev"><i class="jws-icon-caret-left"></i></div>
             <div class="jws-button-next"><i class="jws-icon-caret-right"></i></div>
        </div>
        </div>
<?php  endif; ?>