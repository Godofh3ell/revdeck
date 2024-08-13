<?php 


if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_ep_';
    $key_setting = 'episodes_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Episodes Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'episodes',
            ),
        ),
    ),
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tab1',
        'label' => 'Videos Info',
        'name' => 'videos_tab1',
        'type' => 'tab',
        'parent' => $key_setting
    ));    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_type',
        'label' => 'Videos Type',
        'name' => 'videos_type',
        'type' => 'select',
        'choices' => array(
            'file' => 'File',
            'url' => 'Url',        
         ),
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_file',
        'label' => 'Videos File',
        'name' => 'videos_file',
        'type' => 'file',
        'mime_types' => 'mp4, mov, avi',
        'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'videos_type',
    			'operator' => '==',
    			'value' => 'file',
    			),
    		),
    	),
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_url',
        'label' => 'Videos Url',
        'name' => 'videos_url',
        'type' => 'textarea',
        'instructions' => 'For video url field you can use mp4 or youtube url, iframe html and can use shortcode of other plugins.',
        'conditional_logic' => array (
    		array (
    			array (
    			'field' => $key_slug.'videos_type',
    			'operator' => '==',
    			'value' => 'url',
    			),
    		),
    	),
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'episodes_number',
        'label' => 'Episodes Number',
        'name' => 'episodes_number',
        'type' => 'text',
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'videos_time',
        'label' => 'Time',
        'name' => 'videos_time',
        'type' => 'text',
        'parent' => $key_setting
    ));
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tmdb',
        'label' => 'Tmdb Id',
        'name' => 'videos_tmdb',
        'type' => 'text',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'sub_titles',
        'label' => 'Subtitles',
        'name' => 'sub_titles',
        'type' => 'repeater',
        'parent' => $key_setting,
        'sub_fields' => array(
     
            array(
                'key' => $key_slug.'language',
                'label' => 'Language',
                'name' => 'language',
                'type' => 'text',
            ),
            
            array(
                'key' => $key_slug.'vtt_file',
                'label' => 'Vtt File',
                'name' => 'vtt_file',
                'type' => 'file',
                'parent' => $key_setting
            ),
    
            array(
                'key' => $key_slug.'vtt_url',
                'label' => 'Vtt Url',
                'name' => 'vtt_url',
                'type' => 'text',
                'instructions' => 'You can use an external Vtt url to replace the Vtt file.',
            )
            
        ),
    
        'min' => 0, 
        'max' => 200, 
    ));

    acf_add_local_field(array(
    'key' => $key_slug.'videos_tab6',
    'label' => 'Sources',
    'name' => 'videos_tab6',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'sources',
    'label' => 'Sources',
    'name' => 'sources',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
     
      array(
            'key' => $key_slug.'main',
            'label' => 'Use Main Sources',
            'name' => 'main',
            'type' => 'true_false',
            'ui' => true,
      ),
      array(
            'key' => $key_slug.'url',
            'label' => 'Sources Url',
            'name' => 'url',
            'type' => 'textarea',
      ),
      array(
            'key' => $key_slug.'quality',
            'label' => 'Quality',
            'name' => 'quality',
            'type' => 'text',
      ),
      array(
            'key' => $key_slug.'language',
            'label' => 'Language',
            'name' => 'language',
            'type' => 'text',
      ),
      array(
            'key' => $key_slug.'player',
            'label' => 'Player',
            'name' => 'player',
            'type' => 'text',
      ),
      array(
            'key' => $key_slug.'date',
            'label' => 'Date',
            'name' => 'date',
            'type' => 'text',
      ),
     
    ),
    'min' => 0, 
    'max' => 5, 
));
    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tab2',
        'label' => 'Videos Preview',
        'name' => 'videos_tab2',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_preview',
        'label' => 'Preview',
        'name' => 'videos_preview',
        'type' => 'videos_preview',
        'instructions' => 'After changing settings update post. Then reload the post to see the preview video.',
        'parent' => $key_setting
    ));

endif; ?>