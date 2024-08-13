<?php

if( function_exists('acf_add_local_field_group') ):

$key_slug = 'field_adsvmap_';
$key_setting = 'adsvmap_metabox';

acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Ads Vmap Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'adsvmap',
            ),
        ),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'preroll',
    'label' => 'Preroll',
    'name' => 'preroll',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(

         array(
            'key' => $key_slug.'ads_tag',
            'label' => 'Ads Tag',
            'name' => 'ads_tag',
            'type' => 'post_object',
            'post_type' => array('advertising'),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
        )
    ),
  
    'min' => 0, 
    'max' => 100, 
));


acf_add_local_field(array(
    'key' => $key_slug.'midroll',
    'label' => 'Midroll',
    'name' => 'midroll',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
         array(
            'key' => $key_slug.'ads_tag_mid',
            'label' => 'Ads Tag',
            'name' => 'ads_tag_mid',
            'type' => 'post_object',
            'post_type' => array('advertising'),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
        ),
        array(
            'key' => $key_slug.'time_offset',
            'label' => 'Time Offset',
            'name' => 'time_offset',
            'type' => 'text',
            'instructions' => 'Time appears, Example: 00:00:10',
            'parent' => $key_setting,
        )

    ),
  
    'min' => 0, 
    'max' => 100, 
));



acf_add_local_field(array(
    'key' => $key_slug.'postroll',
    'label' => 'Postroll',
    'name' => 'postroll',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
        array(
            'key' => $key_slug.'ads_tag_end',
            'label' => 'Ads Tag',
            'name' => 'ads_tag_end',
            'type' => 'post_object',
            'post_type' => array('advertising'),
            'allow_null' => 0,
            'multiple' => 0,
            'return_format' => 'id',
        )

    ),
  
    'min' => 0, 
    'max' => 100, 
));



endif;