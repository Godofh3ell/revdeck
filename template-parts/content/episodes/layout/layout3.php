<?php 
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
$number = get_post_meta($post_id , 'episodes_number' , true); ?>
<div class="post-inner">
        <a href="<?php echo get_the_permalink($post_id); ?>">
        <?php 
            $attach_id = get_post_thumbnail_id($post_id);
            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
            echo !empty($image) ? $image : '';
        ?>
        </a>
        <div class="episodes-info">
            <h6><a href="<?php echo get_the_permalink($post_id); ?>"><?php echo get_the_title($post_id); ?></a></h6>
            <span class="episodes-number"><?php echo esc_attr($number); ?></span>
        </div>
</div>