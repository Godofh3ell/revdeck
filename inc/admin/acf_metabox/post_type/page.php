<?php 

if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_page_';
    $key_setting = 'page_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Page Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'page',
            ),
        ),
    ),
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'page_select_header',
        'label' => 'Select Header For Page',
        'name' => 'page_select_header',
        'type' => 'post_object',
        'post_type' => array('hf_template'),
        'multiple' => false,
        'return_format' => 'id',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'page_select_footer',
        'label' => 'Select Footer For Page',
        'name' => 'page_select_footer',
        'type' => 'post_object',
        'post_type' => array('hf_template'),
        'multiple' => false,
        'return_format' => 'id',
        'parent' => $key_setting
    ));

    acf_add_local_field(array(
            'key' => $key_slug.'turn_off_header',
            'label' => 'Turn Off Header',
            'name' => 'turn_off_header',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting     
    ));
    
    acf_add_local_field(array(
            'key' => $key_slug.'turn_on_header_sidebar',
            'label' => 'Turn On Header Sidebar',
            'name' => 'turn_on_header_sidebar',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting     
    ));

    acf_add_local_field(array(
            'key' => $key_slug.'turn_off_footer',
            'label' => 'Turn On Footer',
            'name' => 'turn_off_footer',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting     
    ));
    
    acf_add_local_field(array(
            'key' => $key_slug.'title_bar_checkbox',
            'label' => 'Diable Title Bar',
            'name' => 'title_bar_checkbox',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting     
    ));
    
    acf_add_local_field(array(
            'key' => $key_slug.'tool_bar_checkbox',
            'label' => 'Turn Off Tool Bar Mobile',
            'name' => 'tool_bar_checkbox',
            'type' => 'true_false',
            'ui' => true,
            'parent' => $key_setting     
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'page_header_absolute',
        'label' => 'Header Absolute',
        'name' => 'page_header_absolute',
        'type' => 'select',
        'allow_null' => true,
        'choices' => array(
            'off' => __( 'No', 'streamvid' ),
            'on'   => __( 'Yes', 'streamvid' ),      
         ),
        'parent' => $key_setting 
    ));    
    
endif; 

?>