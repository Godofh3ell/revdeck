<?php wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true ); ?>
<?php
    do_action('streamvid/movies/player');
    get_template_part( 
           'template-parts/content/global/post','sources' , 'list'
    );    
     
?>
<div class="row">

    <div class="col-xl-3 col-lg-4">
        <div class="jws_sticky_move">
            <div class="jws-images">
                <?php
                    $image_size = 'full';
                    $attach_id = get_post_thumbnail_id(get_the_ID());
                    $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                    echo !empty($image) ? $image : '';
                    get_template_part( 
                	    'template-parts/content/movies/post','tool'
                	);
                 ?>
             </div>
         </div>
    </div>
    
    <div class="col-xl-9 col-lg-8">
        
        <h1 class="jws-title">
            <?php echo get_the_title(); ?>
        </h1>
        <?php 
        
            get_template_part( 
              'template-parts/content/movies/post','meta-info'
            );
            
            
            echo '<div class="jws-description">'.the_content().'</div>';
            
            get_template_part( 
              'template-parts/content/movies/post','meta-info2'
            );
            
            get_template_part( 
              'template-parts/content/movies/post','related'
            );

            get_template_part( 
               'template-parts/content/global/post','comments'
            );
            
       ?> 
    </div>

</div>