<?php  


$background_banner = get_post_meta( get_the_ID() , 'featured_image_two', true );
$image_size = 'full';
$attach_id = get_post_thumbnail_id($background_banner);
$image = jws_image_advanced(array('attach_id' => $background_banner, 'thumb_size' => 'full','return_url'=>true));
$background = !empty($image) ? "style=background-image:url($image)" : '';

?>
<div class="jws-banners" <?php echo esc_attr($background); ?>>
   <div class="jws-banners-inner">
    <div class="jws-images">
        <?php
            $image_size = 'full';
            $attach_id = get_post_thumbnail_id(get_the_ID());
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
            echo !empty($image) ? $image : '';
         ?>
    </div>
  
    <div class="banners-right">
        
             
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
                get_template_part( 
                  'template-parts/content/movies/post','button-play'
                );
                
           ?> 
  
    </div>
   </div>      
</div>
<div class="jws-content">
    
    
    
    <?php
        
        
        get_template_part( 
           'template-parts/content/global/post','cast'
        );
        
        get_template_part( 
           'template-parts/content/global/post','videos'
        );
        get_template_part( 
           'template-parts/content/global/post','sources' , 'table'
        );
        get_template_part( 
           'template-parts/content/global/post','comments'
        );
        
        get_template_part( 
          'template-parts/content/movies/post','related'
        );
        
   ?> 
</div>
<div id="video-popup" class="mfp-hide"><?php do_action('streamvid/movies/player'); ?></div>