<?php
if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_person_';
    $key_setting = 'person_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Person Setting',
    'fields' => array (

        array(
            'key' => $key_slug.'know',
            'label' => 'Know for',
            'name' => 'know',
            'type' => 'text',
        ),
        array(
            'key' => $key_slug.'gender',
            'label' => 'Gender',
            'name' => 'gender',
            'type' => 'select',
            'allow_null' => 1,
            'choices' => array(
                'male' => esc_html__('Male','streamvid'),
                'female' => esc_html__('Female','streamvid'),
                'other' => esc_html__('Other','streamvid'),       
            ),
        ),
    
        array(
            'key' => $key_slug.'birthday',
            'label' => 'Birthday',
            'name' => 'birthday',
            'type' => 'date_picker',
            'instructions' => 'Select a date.',
            'required' => false,
        ),
        array(
            'key' => $key_slug.'address',
            'label' => 'Place of Birth',
            'name' => 'address',
            'type' => 'text',
        ),
        array(
            'key' => $key_slug.'know_as',
            'label' => 'Also Known As',
            'name' => 'know_as',
            'type' => 'text',
        ),
        array(
            'key' => $key_slug.'videos_tmdb',
            'label' => 'Tmdb',
            'name' => 'videos_tmdb',
            'type' => 'text',
        ),

  
    ),   
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'person',
            ),
        ),
    ),
    ));
    
   
endif;  

?>