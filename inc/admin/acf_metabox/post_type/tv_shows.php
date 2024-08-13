<?php 

add_filter('acf/fields/relationship/result', 'jws_acf_fields_relationship_result', 10, 4);
function jws_acf_fields_relationship_result( $text, $post, $field, $post_id ) {
    $episodes_number = get_field( 'episodes_number', $post->ID );
    if( $episodes_number ) {
        $text .= ' ' . sprintf( '| %s', $episodes_number );
    }
    return $text;
}

add_filter('acf/fields/post_object/result', 'jws_acf_fields_post_object_result', 10, 4);
function jws_acf_fields_post_object_result( $text, $post, $field, $post_id ) {
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'thumbnail');
    if ($thumbnail_url) {
        $text.= '<img style="width: 20px;float: left;margin-right: 10px;margin-top: 3px;" src="' . $thumbnail_url[0] . '">';
    }
    return $text;
}



if( function_exists('acf_add_local_field_group') ):


$key_slug = 'field_tvs_';
$key_setting = 'tv_shows_metabox';


acf_add_local_field_group(array(
    'key' => $key_setting,
    'title' => 'Tv Shows Setting',
    'fields' => array (),
    'location' => array (
        array (
            array (
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'tv_shows',
            ),
        ),
    ),
));



/* Tabs Videos Info */


acf_add_local_field(array(
    'key' => $key_slug.'videos_tab1',
    'label' => 'Videos Info',
    'name' => 'videos_tab1',
    'type' => 'tab',
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
    'key' => $key_slug.'videos_tmdb',
    'label' => 'Tmdb Id',
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
    'key' => $key_slug.'videos_badge',
    'label' => 'Badge',
    'name' => 'videos_badge',
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


/* Tabs Seasons */

acf_add_local_field(array(
    'key' => $key_slug.'videos_tab3',
    'label' => 'Seasons',
    'name' => 'videos_tab3',
    'type' => 'tab',
    'parent' => $key_setting
));

acf_add_local_field(array(
    'key' => $key_slug.'tv_shows_seasons',
    'label' => 'Seasons',
    'name' => 'tv_shows_seasons',
    'type' => 'repeater',
    'parent' => $key_setting,
    'sub_fields' => array(
        array(
            'key' => $key_slug.'season_thumbnail',
            'label' => 'Season Thumbnail',
            'name' => 'season_thumbnail',
            'type' => 'image',
            'return_format' => 'id',
        ),
         array(
            'key' => $key_slug.'season_name',
            'label' => 'Season Name',
            'name' => 'season_name',
            'type' => 'text',
        ),
        array(
            'key' => $key_slug.'episodes',
            'label' => 'Episodes',
            'name' => 'episodes',
            'type' => 'relationship',
            'post_type' => array('episodes'),
            'filters' => array('search' , 'taxonomy'),
            'return_format' => 'id',
            'elements' => array('featured_image'),
        
        )
    ),
  
    'min' => 0, 
    'max' => 100, 
));


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
    'max' => 100, 
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
        ),
    ),

    'min' => 0, 
    'max' => 100, 
));

acf_add_local_field(array(
    'key' => $key_slug.'videos_tab6',
    'label' => 'Videos Ads',
    'name' => 'videos_tab6',
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
    'allow_null' => true,
    'parent' => $key_setting
));



acf_add_local_field_group(array(
    'key' => 'tv_shows_taxonomy',
    'title' => 'Setting',
    'fields' => array (
        array(
            'key' => $key_slug.'color_background',
            'label' => 'Color Background',
            'name' => 'color_background',
            'type' => 'color_picker',
        ),
        array(
            'key' => $key_slug.'color_background2',
            'label' => 'Color Background 2',
            'name' => 'color_background2',
            'type' => 'color_picker',
        ),
        array(
            'key' => $key_slug.'tv_shows_cat_image',
            'label' => 'Image Thumbnail',
            'name' => 'tv_shows_cat_image',
            'type' => 'image',
        ),
    ),
    'location' => array (
        array (
            array (
                'param' => 'taxonomy',
                'operator' => '==',
                'value' => 'tv_shows_cat',
            ),
        ),
    ),
));

acf_add_local_field_group(array(
    'key' => 'tv_shows_meta_right',
    'title' => 'Tv Shows Setting Side',
    'fields' => array (
        array(
            'key' => $key_slug.'featured_image_two',
            'label' => 'Featured image 2',
            'name' => 'featured_image_two',
            'type' => 'image',
            'return_format' => 'id',
            'preview_size' => 'full',
            'library' => 'all', 
        ),
        array(
            'key' => $key_slug.'title_images',
            'label' => 'Title Image',
            'name' => 'title_images',
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
                'value' => 'tv_shows',
            ),
        ),
    ),
));


acf_add_local_field_group(array(
    'key' => 'tv_shows_playlist',
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
                'value' => 'tv_shows_playlist',
            ),
        ),
    ),
));

endif; ?>