<?php 

if( function_exists('acf_add_local_field_group') ):
    
    $key_slug = 'field_questions_';
    $key_setting = 'questions_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Questions Setting',
    'fields' => array (),
    'menu_order' => 9999,    
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'questions',
            ),
        ),
    ),
    ));
 
    acf_add_local_field(array(
        'key' => $key_slug.'product_name',
        'label' => 'Name',
        'name' => 'product_name',
        'type' => 'text',
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'product_email',
        'label' => 'Email',
        'name' => 'product_email',
        'type' => 'text',
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'answer_content',
        'label' => 'Answer Conten',
        'name' => 'answer_content',
        'type' => 'textarea',
        'parent' => $key_setting
    ));
endif;    

?>