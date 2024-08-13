<?php 


$tv_shows_seasons = get_field('tv_shows_seasons',$args['tv_shows']);

$image_size = jws_theme_get_option('tv_shows_imagesize');  

?>
        <div class="jws-episodes_advanced-element">
            <div class="episodes-content layout4 jws-scrollbar">
                <?php 
                    foreach($tv_shows_seasons as $index => $seasons) {
                        
                       $season_thumbnail = $seasons['season_thumbnail'];
 
                       $active =  ''; 
              
                       $link = add_query_arg ('season', $index + 1 , get_the_permalink($args['tv_shows']).get_post_type()) ;
            
                      
                       ?>
                       
                        
                        <div class="jws-pisodes_advanced-item<?php echo esc_attr($active); ?>">
                   
                        <div class="post-inner">
                            <a href="<?php echo esc_attr($link); ?>">
                                    <div class="post-media">
                                        
                                            <?php 
                                        
                                                $image = jws_image_advanced(array('attach_id' => $season_thumbnail, 'thumb_size' => $image_size));
                                                echo !empty($image) ? $image : '';
                                            ?>
                                      
                                    </div>
                                    
                                    <div class="episodes-info">
                                        <?php $number_episodes = isset($seasons['episodes']) && !empty($seasons['episodes']) ? count($seasons['episodes']) : 0;  ?> 
                                        <span class="episodes-number">
                                        
                                         <?php 
                                     
                                           echo sprintf(
                                    		__('%s Ep', 'streamvid'),
                                    		$number_episodes
		                                   );  
                                             
                                         ?>
                                         
                                         </span>
                                        <h6><?php echo $seasons['season_name']; ?></h6>
                                    </div>
                            </a>        
                        </div>
                        
                        
                        </div>
                       
                       
                       <?php 
                    }
                 ?>
            </div>
        </div>
