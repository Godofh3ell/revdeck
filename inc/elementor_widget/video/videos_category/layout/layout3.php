<?php 
    $color_background = get_term_meta( $category->term_id, 'color_background', true );
    $color_background2 = get_term_meta( $category->term_id, 'color_background2', true );
    $image_id = get_term_meta( $category->term_id, $settings['post_type'].'_image', true );
    $image = jws_image_advanced(array('attach_id' => $image_id, 'thumb_size' => $image_size));

?>


<div class="category-inner" <?php echo 'style="background-color:'.esc_attr($color_background).';"'; ?> href="<?php echo esc_url(get_term_link($category->slug, $settings['post_type'])); ?>">
      <div class="category-images">
        <span <?php echo 'style="background-color:'.esc_attr($color_background2).';"'; ?>></span>
        <?php echo !empty($image) ? $image : ''; ?> 
      </div> 
      <div class="category-content">
        <h6><?php echo esc_html($category->name); ?></h6>
        <span><?php  printf( _n( '%s Show', '%s Shows', $category->count, 'streamvid' ), number_format_i18n( $category->count ) ); ?></span>
      </div>
      <a class="overlay" href="<?php echo esc_url(get_term_link($category->slug, $settings['post_type'])); ?>"></a>
</div>