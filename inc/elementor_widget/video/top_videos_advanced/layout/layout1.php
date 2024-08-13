<div class="top-videos-inner">

    <div class="top-number">
    
    <?php echo esc_html($index + 1); ?>
    
    </div>
    <a href="<?php echo get_the_permalink($id); ?>">
        <?php 
            $attach_id = get_post_thumbnail_id($id);
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
            echo !empty($image) ? $image : '';
        ?>
    </a>

</div>