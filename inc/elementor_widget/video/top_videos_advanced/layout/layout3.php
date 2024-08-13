<?php $years = get_post_meta($id , 'videos_years' , true); ?>
<div class="top-videos-inner">

    <div class="top-images">
    
        <a href="<?php echo get_the_permalink($id); ?>">
            <?php 
                $attach_id = get_post_thumbnail_id($id);
                $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                echo !empty($image) ? $image : '';
            ?>
        </a>
        <div class="top-number">
    
        <?php echo esc_html($index + 1); ?>
        
        </div>
    
    </div>
    <div class="top-content">
        <?php   echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : ''; ?>
        <div class="video-cat fs-small">
            <?php echo jws_get_cat_list($item['top-videos_post_type'].'_cat',', ',$id); ?>
        </div>
        <h6 class="fs-small">
            <a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a>
        </h6>
        <div class="view fs-small">
            <?php 
             $views = jws_get_videos_view(array('id' => $id));
             printf( _n( '%s view', '%s views', $views , 'streamvid' ), $views ); ?> 
        </div>
            
    
    </div>

</div>