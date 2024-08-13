<?php 
$image_size = !empty($settings['image_size']['width']) && !empty($settings['image_size']['height']) ?  $settings['image_size']['width'].'x'.$settings['image_size']['height'] : 'full';

$settings['columns_tablet'] = isset($settings['columns_tablet']) ? $settings['columns_tablet'] : $settings['columns'];
$settings['columns_mobile'] = isset($settings['columns_mobile']) ? $settings['columns_mobile'] : $settings['columns'];
$class_column = 'category-tab-item';

$class_row = 'jws-videocat row '.$settings['videos_category_layouts'].'';  

$option = array(
    'orderby' => $settings['orderby'] ,
    'order' => $settings['order']
);

if($settings['post_per_page'] != 0) {
   $option['number']  = $settings['post_per_page'];
}

if(!empty($settings['filter_categories']) && $settings['query'] == 'custom') {
    
    $option['include'] = $settings['filter_categories'];
    
}

$option['hide_empty'] = $settings['hide_empty'] == 'yes' ? true : false;

$query = get_terms(
$settings['post_type'], $option 
);



if($settings['display'] == 'slider') {
    $class_row .= ' owl-carousel jws_advanced_'.$settings['display'].'';
    $class_column .= ' slider-item';
    $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
    $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
    $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
    $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
    $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
    $variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false';
    
    $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '3';

    $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
    $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
    
    $center = ($settings['center'] == 'yes') ? 'true' : 'false';
                
    if($center ==  'true') {
        
        $class_row .= ' center-mode';
        
    }
           
    
    $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
    
    $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
    $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
    
    
    $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';

    if($variablewidth == 'true') {
      $settings['slides_to_show']  = $settings['slides_to_show_tablet'] = $settings['slides_to_show_mobile'] = '1';
    }
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
}else {
    $data_slick = '';
    $class_column .= (!empty($settings['columns'])) ? ' col-xl-'.$settings['columns'].'' : '' ;
    $class_column .= (!empty($settings['columns_tablet'])) ? ' col-lg-'.$settings['columns_tablet'].'' : ' col-lg-'.$settings['columns'].'' ;
    $class_column .= (!empty($settings['columns_mobile'])) ? ' col-'.$settings['columns_mobile'].'' :  ' col-'.$settings['columns'].''; 
}

?>

<div class="jws-videocat-list">
<?php if(isset($arrows) && $arrows == 'true') : ?>
    <div class="scroller scroller-left">
        <div><i class="jws-icon-left-open"></i></div>
        <span></span>
    </div>
    <div class="scroller scroller-right">
        <div><i class="jws-icon-right-open"></i></div>
        <span></span>
    </div>
<?php endif; ?>
  <div class="<?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?>>  
  <?php
  
        if ( !empty($query) ) :
        
        	foreach( $query as $category ) {
        	   
        	   ?>
               
                <div class="<?php echo esc_attr($class_column); ?>">
                    <?php include( 'layout/'.$settings['videos_category_layouts'].'.php' ); ?>
                </div>
               
               <?php
        	}
        
        endif;

    ?>
 </div>   
</div>