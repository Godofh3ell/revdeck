<?php
$args = wp_parse_args( $args, array(
    'image_size'   =>  'full',
    'post_id'   =>  get_the_ID()
) );
extract( $args );
?>
 <div class="post-inner">
    <div class="post-media">
        <a href="<?php echo get_the_permalink($post_id); ?>"> 
            <?php     
                $attach_id = get_post_thumbnail_id($post_id);
                $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                echo !empty($image) ? $image : '';   
            ?>
        </a>
    </div>
    <div class="person-content">
        <h6 class="title">
           <a href="<?php echo get_the_permalink($post_id); ?>">
                 <?php echo get_the_title($post_id); ?>
           </a> 
        </h6>
        <div class="cast-cat">
            <?php echo jws_get_cat_list('person_cat',' ',$post_id); ?>
        </div>
    </div>
</div>