<?php 
if( function_exists('acf_add_local_field_group') ):

    
    $key_slug = 'field_vd_';
    $key_setting = 'videos_metabox';

    acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Videos Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'videos',
            ),
        ),
    ),
    ));
  
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tab1',
        'label' => 'Video Info',
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
        'key' => $key_slug.'video_ratio',
        'label' => 'Videos Ratio',
        'name' => 'video_ratio',
        'type' => 'select',
        'allow_null' => true,
        'choices' => jws_videos_ratio(),
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
        'key' => $key_slug.'videos_tab2',
        'label' => 'Video Live Stream Data',
        'name' => 'videos_tab2',
        'type' => 'tab',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'live_data',
        'label' => 'Video Data',
        'name' => 'live_data',
        'type' => 'live_data',
        'parent' => $key_setting
    ));
    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tab4',
        'label' => 'Videos Ads',
        'name' => 'videos_tab4',
        'type' => 'tab',
        'parent' => $key_setting
    ));
        
    acf_add_local_field( array(
        'key' => $key_slug.'videos_ads_special',
        'label' => 'Ads Special',
        'name' => 'videos_ads_special',
        'type' => 'post_object',
        'post_type' => array('adsvmap'),
        'multiple' => false,
        'return_format' => 'id',
        'parent' => $key_setting
    ));

    
    acf_add_local_field(array(
        'key' => $key_slug.'videos_tab3',
        'label' => 'Videos Preview',
        'name' => 'videos_tab3',
        'type' => 'tab',
        'instructions' => 'dsa',
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
    
    acf_add_local_field_group(array(
        'key' => 'video_playlist',
        'title' => 'Setting',
        'fields' => array (
            array(
                'key' => $key_slug.'playlist_image',
                'label' => 'Image Playlist',
                'name' => 'playlist_image',
                'type' => 'image',
            ),
            array(
                'key' => $key_slug.'status',
                'label' => 'Status',
                'name' => 'status',
                'type' => 'select',
                'default_value' => 'public',
                'choices' => array(
                    'public' => 'Public',
                    'private' => 'Private',       
                 ),
            ),
            array(
                    'key' => $key_slug.'user',
                    'label' => 'User',
                    'name' => 'user',
                    'type' => 'user',
              )
        ),
        'location' => array (
            array (
                array (
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'videos_playlist',
                ),
            ),
        ),
    ));


endif; ?>