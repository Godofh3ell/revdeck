<?php

if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'manage_options',
        'redirect'    => false,    
        'position' => '3.2',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-settings',
        'menu_slug'     => 'theme-header',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-settings',
        'menu_slug'     => 'theme-header',
    ));

    
}

if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_jws_';
    $key_setting = 'jws_theme_settings';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Theme Settings',
    'fields' => array (
        array(
            'key' => $key_slug.'general_tab',
            'label' => '<i class="fas fa-star"></i> General',
            'name' => 'general_tab',
            'type' => 'tab',
            'placement' => 'left', 
        ),
        array(
            'key' => $key_slug.'header_tab',
            'label' => '<i class="fas fa-star"></i> Header',
            'name' => 'header_tab',
            'type' => 'tab',
            'placement' => 'left', 
        ),
        array(
            'key' => $key_slug.'footer_tab',
            'label' => 'Footer',
            'name' => 'footer_tab',
            'type' => 'tab',
            'placement' => 'left',    
        )
      
    ),   
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-settings',
            ),
        ),
    ),
    ));
    
    
    acf_add_local_field_group(array(
    'key' => 'jws_theme_header_settings',
    'title' => 'Header Settings',
    'fields' => array (

      
    ),   
    'location' => array (
        array (
            array (
                'param' => 'options_page',
                'operator' => '==',
                'value' => 'theme-header',
            ),
        ),
    ),
    ));
   
endif;  

?>