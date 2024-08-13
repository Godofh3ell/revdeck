<?php 


$tv_shows_seasons = get_field('tv_shows_seasons',$args['tv_shows']);
$seasion = ($args['season'] - 1);
if(isset($tv_shows_seasons[$seasion]['episodes']) && !empty($tv_shows_seasons[$seasion]['episodes'])) : 

$episodes = $tv_shows_seasons[$seasion]['episodes'];

$image_size = jws_theme_get_option('tv_shows_imagesize');  

$user_id = get_current_user_id();
$video_progress_data = get_user_meta($user_id, 'video_progress_data',true);
$post_id = get_the_ID();
?>
        <div class="jws-episodes_advanced-element">
            <div class="episodes-content layout4 jws-scrollbar">
                <?php 
                    foreach($episodes as $episodes_value) {
                       $active = ($episodes_value == $post_id)  ? ' active' : ''; 
                       $link = get_the_permalink($episodes_value); 
                       if(isset($_GET['version'])) {
                         $link .= '?version=v2'; 
                       }
                       ?>
                       
                        
                        <div id="episodes-item-<?php echo esc_attr($episodes_value); ?>" class="jws-pisodes_advanced-item<?php echo esc_attr($active); ?>">
                        
                        
                       <?php 
                       
                       $number = get_post_meta($episodes_value , 'episodes_number' , true);
                       $time = get_post_meta($episodes_value , 'episodes_time' , true);
                       
                       
                        ?>
                        <div class="post-inner">
                            <a href="<?php echo esc_attr($link); ?>">
                                    <div class="post-media">
                                        
                                            <?php 
                                                $attach_id = get_post_thumbnail_id($episodes_value);
                                                $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                                echo !empty($image) ? $image : '';
                                            ?>
                                      
                                        <?php echo !empty($time) ? '<span class="time"><i class="jws-icon-play-circle"></i>'.$time.'</span>' : ''; ?>
                                        <?php  if(isset($video_progress_data[$episodes_value]['time'])) {
            
                            				$time = $video_progress_data[$episodes_value]['time'] / $video_progress_data[$episodes_value]['endtime'] * 100;
                            
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
                                        <h6><?php echo get_the_title($episodes_value); ?></h6>
                                    </div>
                            </a>        
                        </div>
                        
                        
                        </div>
                       
                       
                       <?php 
                    }
                 ?>
            </div>
        </div>
<?php  endif; ?>