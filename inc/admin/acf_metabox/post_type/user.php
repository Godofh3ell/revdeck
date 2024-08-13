<?php
if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_user_';
    $key_setting = 'user_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'User Custom Fields',
    'fields' => array (
        array(
            'key' => 'jws_date_of_birth',
            'label' => 'Date of birth',
            'name' => 'jws_date_of_birth',
            'type' => 'date_picker',
            'instructions' => 'Select a date.',
            'required' => false,
        ),
        array(
            'key' => 'jws_gender',
            'label' => 'Gender',
            'name' => 'jws_gender',
            'type' => 'select',
            'allow_null' => 1,
            'choices' => array(
                'male' => esc_html__('Male','streamvid'),
                'female' => esc_html__('Female','streamvid'),
                'other' => esc_html__('Other','streamvid'),       
            ),
        ),
        array(
            'key' => 'jws_postcode',
            'label' => 'Postcode',
            'name' => 'jws_postcode',
            'type' => 'text',
            'required' => false,
        ),
        array(
            'key' => 'user_phone',
            'label' => 'Phone',
            'name' => 'user_phone',
            'type' => 'text',
            'required' => false,
        ),
    ),   
    'location' => array (
        array (
            array (
                'param' => 'user_form',
                'operator' => '==',
                'value' => 'all',
            ),
        ),
    ),
    ));
    
   
endif;  

?>