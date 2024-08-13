<?php 

if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_product_';
    $key_setting = 'product_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Product Setting',
    'fields' => array (),
    'menu_order' => 9999,    
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'product',
            ),
        ),
    ),
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'shop_single_layout',
        'label' => 'Layout',
        'name' => 'shop_single_layout',
        'type' => 'select',
        'allow_null' => true,
        'choices' => array(
             'default' => __( 'Default', 'streamvid' ),     
         ),
        'parent' => $key_setting 
    ));  
    
    acf_add_local_field(array(
        'key' => $key_slug.'shop_single_thumbnail_position',
        'label' => 'Thumbnail Position',
        'name' => 'shop_single_thumbnail_position',
        'type' => 'select',
        'allow_null' => true,
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
            'bottom' => 'Bottom',
            'bottom2' => 'Bottom 4 Item'   
         ),
        'parent' => $key_setting 
    ));  
    acf_add_local_field(array(
        'key' => $key_slug.'shop_single_video_type',
        'label' => 'Video Type',
        'name' => 'shop_single_video_type',
        'type' => 'select',
        'allow_null' => true,
        'choices' => array(
            'popup' => 'Popup',
            'inner' => 'Inner',  
         ),
        'parent' => $key_setting 
    ));  
    acf_add_local_field(array(
        'key' => $key_slug.'product_video',
        'label' => 'Product Video',
        'name' => 'product_video',
        'type' => 'text',
        'instructions' => 'Add link video for product(youtube, vimeo, mp4 ,...)',
        'parent' => $key_setting
    ));
    
endif; 
?>