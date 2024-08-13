<?php


if( function_exists('acf_add_local_field_group') ):

$key_slug = 'field_mov_';
$key_setting = 'movies_metabox';

acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Movies Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'movies',
            ),
        ),
    ),
));


/* Tabs Videos Main */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab1',
    'label' => 'Main Video',
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
    'key' => $key_slug.'is_affiliate',
    'label' => 'Is Affiliate URL ?',
    'name' => 'is_affiliate',
    'type' => 'true_false',
    'ui' => true,
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



/* Tabs Videos Trailer */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab2',
    'label' => 'Trailer Video',
    'name' => 'videos_tab2',
    'type' => 'tab',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'videos_trailer_type',
    'label' => 'Trailer Type',
    'name' => 'videos_trailer_type',
    'type' => 'select',
    'choices' => array(
        'file' => 'File',
        'url' => 'Url',        
     ),
    'parent' => $key_setting 
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_trailer_file',
    'label' => 'Trailer File',
    'name' => 'videos_trailer_file',
    'type' => 'file',
    'mime_types' => 'mp4, mov, avi',
    'conditional_logic' => array (
		array (
			array (
			'field' => $key_slug.'videos_trailer_type',
			'operator' => '==',
			'value' => 'file',
			),
		),
	),
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_trailer_url',
    'label' => 'Trailer Url',
    'name' => 'videos_trailer_url',
    'type' => 'textarea',
    'conditional_logic' => array (
		array (
			array (
			'field' => $key_slug.'videos_trailer_type',
			'operator' => '==',
			'value' => 'url',
			),
		),
	),
    'parent' => $key_setting
));


/* Tabs Videos Info */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab3',
    'label' => 'Videos Info',
    'name' => 'videos_tab3',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_tmdb',
    'label' => 'Tmdb ID',
    'name' => 'videos_tmdb',
    'type' => 'text',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'videos_vote',
    'label' => 'Tmdb Rating',
    'name' => 'videos_vote',
    'type' => 'text',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_imdb',
    'label' => 'Imdb Rating',
    'name' => 'videos_imdb',
    'type' => 'text',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_years',
    'label' => 'Years',
    'name' => 'videos_years',
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
    'key' => $key_slug.'videos_badge',
    'label' => 'Badge',
    'name' => 'videos_badge',
    'type' => 'text',
    'parent' => $key_setting
));
acf_add_local_field(array(
    'key' => $key_slug.'videos_language',
    'label' => 'Language',
    'name' => 'videos_language',
    'type' => 'text',
    'parent' => $key_setting
));
  acf_add_local_field(array(
        'key' => $key_slug.'featured_clips',
        'label' => 'Featured Clips',
        'name' => 'featured_clips',
        'type' => 'relationship',
        'elements' => array('featured_image'),
        'post_type' => array('videos'),
        'multiple' => true,
        'return_format' => 'id',
        'parent' => $key_setting
    ));

endif;


/* Tabs Cast */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab4',
    'label' => 'Cast',
    'name' => 'videos_tab4',
    'type' => 'tab',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'cast',
    'label' => 'Cast',
    'name' => 'cast',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
        array(
            'key' => $key_slug.'person',
            'label' => 'Person',
            'name' => 'person',
            'type' => 'post_object',
            'post_type' => array('person'),
            'multiple' => false,
            'return_format' => 'id',
        ),
        array(
            'key' => $key_slug.'as',
            'label' => 'As',
            'name' => 'as',
            'type' => 'text',
        )
    ),
  
    'min' => 0, 
    'max' => 200, 
));



/* Tabs Crew */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab5',
    'label' => 'Crew',
    'name' => 'videos_tab5',
    'type' => 'tab',
    'parent' => $key_setting
));


acf_add_local_field(array(
    'key' => $key_slug.'crew',
    'label' => 'Crew',
    'name' => 'crew',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
        array(
            'key' => $key_slug.'crew_person',
            'label' => 'Person',
            'name' => 'person',
            'type' => 'post_object',
            'post_type' => array('person'),
            'multiple' => false,
            'return_format' => 'id',
        ),
        array(
            'key' => $key_slug.'job',
            'label' => 'Job',
            'name' => 'job',
            'type' => 'text',
        )
    ),

    'min' => 0, 
    'max' => 200, 
));


/* Tabs Crew */


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
    'key' => $key_slug.'videos_tab9',
    'label' => 'Download',
    'name' => 'videos_tab9',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'download',
    'label' => 'Enble Download',
    'name' => 'download',
    'type' => 'true_false',
    'ui' => true,
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'download_list',
    'label' => 'Download List',
    'name' => 'download_list',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
        array(
            'key' => $key_slug.'download_name',
            'label' => 'File Name',
            'name' => 'download_name',
            'type' => 'text',
        ),
        array(
            'key' => $key_slug.'download_url',
            'label' => 'Download Url',
            'name' => 'download_url',
            'type' => 'text',
            'instructions' => 'You can use mp4 url from media or from external url.',
        )
        
    ),
    'min' => 0, 
    'max' => 200, 
    'conditional_logic' => array (
		array (
			array (
			'field' => $key_slug.'download',
			'operator' => '==',
			'value' => '1',
			),
		),
	),
));



acf_add_local_field(array(
        'key' => $key_slug.'videos_tab8',
        'label' => 'Videos Ads',
        'name' => 'videos_tab8',
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
        'key' => $key_slug.'videos_tab7',
        'label' => 'Videos Preview',
        'name' => 'videos_tab7',
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



acf_add_local_field_group(array(
    'key' => 'movies_meta_right',
    'title' => 'Featured image 2',
    'fields' => array (
        array(
            'key' => $key_slug.'featured_image_two',
            'label' => 'Image',
            'name' => 'featured_image_two',
            'type' => 'image',
            'return_format' => 'id',
            'preview_size' => 'full',
            'library' => 'all', 
        )
    ),
    'position' => 'side',
    'menu_order' => 0, 
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'movies',
            ),
        ),
    ),
));

acf_add_local_field_group(array(
    'key' => 'movies_playlist',
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
                'value' => 'movies_playlist',
            ),
        ),
    ),
));

?>