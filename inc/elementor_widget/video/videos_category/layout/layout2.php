<?php 
    $image_id = get_term_meta( $category->term_id, $settings['post_type'].'_image', true );
 
    $image = jws_image_advanced(array('attach_id' => $image_id, 'thumb_size' => $image_size));
    
    


?>


<a href="<?php echo esc_url(get_term_link($category->slug, $settings['post_type'])); ?>">
      <?php echo !empty($image) ? $image : ''; ?>  
      <span><?php echo esc_html($category->name); ?></span> 
</a>