<?php


if( function_exists('acf_add_local_field_group') ):

$key_slug = 'field_ads_';
$key_setting = 'advertising_metabox';

acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Advertising Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'advertising',
            ),
        ),
    ),
));


acf_add_local_field(array(
    'key' => $key_slug.'ads_server',
    'label' => 'Advertising Server',
    'name' => 'ads_server',
    'type' => 'select',
    'choices' => array(
        'self_ads' => __( 'Self Ads', 'streamvid' ),
        'vast'   => __( 'VAST Ads Server', 'streamvid' ),      
     ),
    'parent' => $key_setting 
)); 


acf_add_local_field(array(
    'key' => $key_slug.'ads_tab1',
    'label' => 'Self Ads',
    'name' => 'ads_tab1',
    'type' => 'tab',
    'parent' => $key_setting,
     'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'ads_server',
    			'operator' => '==',
    			'value' => 'self_ads',
    			),
    		),
    ),
));

acf_add_local_field(array(
    'key' => $key_slug.'ads_target_url',
    'label' => 'Target URL',
    'name' => 'ads_target_url',
    'type' => 'text',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'ads_type',
    'label' => 'Ads Type',
    'name' => 'ads_type',
    'type' => 'select',
    'choices' => array(
        'linear' => __( 'Linear Ads', 'streamvid' ),
        'non_linear'   => __( 'NonLinear Ads', 'streamvid' ),      
     ),
    'parent' => $key_setting 
)); 

acf_add_local_field(array(
    'key' => $key_slug.'ads_banner',
    'label' => 'Banner Ads',
    'name' => 'ads_banner',
    'type' => 'group',
    'layout' => 'table',
    'sub_fields' => array(
             array(
                'key' => $key_slug.'ads_banner_image',
                'label' => 'Image',
                'name' => 'ads_banner_image',
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all', 
            ),    
            array(
                'key' => $key_slug.'ads_banner_position',
                'label' => 'Position',
                'name' => 'ads_banner_position',
                'type' => 'select',
                'choices' => array(
                    'middle' => __( 'Middle', 'streamvid' ),
                    'bottom'   => __( 'Bottom', 'streamvid' ),      
                ),
            ),
            
     ),
     'conditional_logic' => array (
		array (
			array (
			'field' => $key_slug.'ads_type',
			'operator' => '==',
			'value' => 'non_linear',
			),
		),
	),
    'parent' => $key_setting 
)); 

acf_add_local_field(array(
    'key' => $key_slug.'ads_duration',
    'label' => 'Ads Duration',
    'name' => 'ads_duration',
    'type' => 'text',
    'instructions' => 'Ad duration, Example: 00:00:10',
    'parent' => $key_setting,
    'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'ads_type',
    			'operator' => '==',
    			'value' => 'linear',
    			),
    		),
    	),
));

acf_add_local_field(array(
        'key' => $key_slug.'ads_video',
        'label' => 'Ads Video',
        'name' => 'ads_video',
        'type' => 'file',
        'mime_types' => 'mp4',
        'parent' => $key_setting,
         'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'ads_type',
    			'operator' => '==',
    			'value' => 'linear',
    			),
    		),
    	),
));

acf_add_local_field(array(
    'key' => $key_slug.'ads_skippable',
    'label' => 'Ads Skippable',
    'name' => 'ads_skippable',
    'type' => 'text',
    'instructions' => 'Ad Skippable, Example: 00:00:10 , leave blank for non-skippable',
    'parent' => $key_setting,
    'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'ads_type',
    			'operator' => '==',
    			'value' => 'linear',
    			),
    		),
    	),
));

acf_add_local_field(array(
    'key' => $key_slug.'ads_tab2',
    'label' => 'VAST Ads Server',
    'name' => 'ads_tab2',
    'type' => 'tab',
    'parent' => $key_setting,
     'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'ads_server',
    			'operator' => '==',
    			'value' => 'vast',
    			),
    		),
    ),
));
 

acf_add_local_field(array(
    'key' => $key_slug.'ads_vast_url',
    'label' => 'Ads Vast URL',
    'name' => 'ads_vast_url',
    'type' => 'textarea',
    'parent' => $key_setting,
));

endif;