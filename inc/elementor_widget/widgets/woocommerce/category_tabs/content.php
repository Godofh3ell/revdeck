<?php 

if($settings['display'] == 'grid') {
    $settings['columns_tablet'] = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : $settings['columns'];
    $settings['columns_mobile'] = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : $settings['columns'];
    $class_column = 'category-tab-item col-xl-' . $settings['columns'] . ' col-lg-' . $settings['columns_tablet'] . ' col-' . $settings['columns_mobile'] .'';
    $data_slick = '';
    $class_row = ' row';  
}else {
    $class_row = ' jws-slider owl-carousel';
    $class_column = ' category-tab-item slider-item slider-item'; 
    $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
    $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
    $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
    $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
    $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
    $variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false';
    $center = ($settings['center'] == 'yes') ? 'true' : 'false';
    
    
    $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '1';
    $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
    $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
    
    $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
    $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
    $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
    
    
    $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
    
    
    $data_slick = 'data-owl-option=\'{
        "autoplay": '.$autoplay.',
        "nav": '.$arrows.', 
        "dots":'.$dots.', 
        "autoplayTimeout": '.$autoplay_speed.',
        "autoplayHoverPause":'.$pause_on_hover.',
        "center":'.$center.', 
        "loop":'.$infinite.',
        "autoWidth":'.$variablewidth.',
        "smartSpeed": '.$settings['transition_speed'].', 
        "responsive":{
            "1024":{"items": '.$settings['slides_to_show'].',"slideBy": '.$settings['slides_to_scroll'].'},
            "768":{"items": '.$settings['slides_to_show_tablet'].',"slideBy": '.$settings['slides_to_scroll_tablet'].'},
            "0":{"items": '.$settings['slides_to_show_mobile'].',"slideBy": '.$settings['slides_to_scroll_mobile'].'}
    }}\'';
   
}




if(!empty($settings['image_size']['width']) && !empty($settings['image_size']['height'])) {
    $image_size = $settings['image_size']['width'].'x'.$settings['image_size']['height'];
 }else {
    $image_size = 'full';
 } 

if(!empty($settings['image_size2']['width']) && !empty($settings['image_size2']['height'])) {
    $image_size2 = $settings['image_size2']['width'].'x'.$settings['image_size2']['height'];
 }else {
    $image_size2 = 'full';
 }  




?>
<div class="jws-category-list<?php if($settings['display'] == 'slider') echo ' jws-carousel'; ?>">
<div class="category-content<?php echo esc_attr($class_row.' '.$settings['layouts']); ?>" <?php echo ''.$data_slick; ?>>


  <?php
        if($settings['filter_categories']){
            $i = 0;
            foreach ($settings['filter_categories'] as $product_cat_slug) {
                $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
                $selected = '';
                if(isset($product_cat->slug)){
                    if (isset($settings['wc_attr']['product_cat']) && $settings['wc_attr']['product_cat'] == $product_cat->slug) {
                        $selected = 'jws-selected';
                    }
                
                        ?>
                            <div class="<?php echo esc_attr($class_column); ?>">
                               
                               <div class="category-image">
                                     <a href="<?php echo esc_url(get_term_link($product_cat->slug, 'product_cat')); ?>">
                                        <?php  
                                            $attach_id = get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 );
                                            $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                                            echo !empty($image) ? $image : '';
                                        ?>
                                      </a>   
                                 </div> 
                                <h6><a href="<?php echo esc_url(get_term_link($product_cat->slug, 'product_cat')); ?>"><?php echo esc_html($settings['before_name'].' '.$product_cat->name); ?><i class="jws-icon-caret-circle-right"></i></a></h6>  
                            
                            </div>
                        <?php

                }
                
            $i++; } 
        }
    ?>

</div>
<?php if($settings['enable_dots'] == 'yes') : ?>
<div class="slider-dots-box"></div>
<?php endif; ?>
</div>