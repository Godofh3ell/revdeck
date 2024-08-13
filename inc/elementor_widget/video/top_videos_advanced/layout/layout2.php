<?php $years = get_post_meta($id , 'videos_years' , true); ?>
<div class="top-videos-inner">

    <div class="top-number h5">
    
    <?php echo esc_html($index + 1); ?>
    
    </div>
    <div class="top-images">
    
        <a href="<?php echo get_the_permalink($id); ?>">
            <?php 
                $attach_id = get_post_thumbnail_id($id);
                $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                echo !empty($image) ? $image : '';
            ?>
        </a>
    
    </div>
    <div class="top-content">
        <?php   echo !empty($years) ? '<div class="video-years">'.$years.'</div>' : ''; ?>
        <h6>
            <a href="<?php echo get_the_permalink($id); ?>"><?php echo get_the_title($id); ?></a>
        </h6>
        <div class="video-cat">
            <?php echo jws_get_cat_list($item['top-videos_post_type'].'_cat',' ',$id); ?>
        </div>
        
    
    </div>

</div>