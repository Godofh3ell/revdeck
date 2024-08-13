<div class="jws-tabs">

    <ul class="nav-tabs">
        <li><a class="active" href="#detail"><?php echo esc_html__('Detail','streamvid'); ?></a></li>
        <li><a href="#extras"><?php echo esc_html__('Extras','streamvid'); ?></a></li>
        <li><a href="#cast"><?php echo esc_html__('Cast','streamvid'); ?></a></li>
        <li><a href="#reviews"><?php echo esc_html__('Reviews','streamvid'); ?></a></li>
    </ul>
    <div class="tabs-content">
        <div id="detail" class="active">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <div class="jws-images">
                        <?php
                            $image_size = 'full';
                            $attach_id = get_post_thumbnail_id(get_the_ID());
                            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                            echo !empty($image) ? $image : '';
                         ?>
                     </div>
                </div>
                <div class="col-xl-8 col-lg-8">
                    
                         
                        <h1 class="jws-title">
                            <?php echo get_the_title(); ?>
                        </h1>
                        <?php 
                        
                            get_template_part( 
                              'template-parts/content/movies/post','meta-info'
                            );
                            get_template_part( 
                        	    'template-parts/content/movies/post','tool'
                        	);
                            echo '<div class="jws-description">'.the_content().'</div>';
                            
                            get_template_part( 
                              'template-parts/content/movies/post','meta-info2'
                            );
                         
                            
                       ?> 
                
                </div>
            </div>
        </div>
        <div id="extras"><?php 
            get_template_part( 
            	    'template-parts/content/global/post','videos'
            );
        ?></div>
        <div id="cast"><?php 
            get_template_part( 
            	    'template-parts/content/global/post','cast'
            );
        ?></div>
        <div id="reviews"><?php 
            get_template_part( 
            	    'template-parts/content/global/post','comments'
            );
        ?></div>
    </div>

</div>