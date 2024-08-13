<?php 

if( function_exists('acf_add_local_field_group') ):
    
    $key_slug = 'field_blog_';

    acf_add_local_field_group(array(
        'key' => 'blog_quote_metabox',
        'title' => 'Quote Setting',
        'fields' => array(
            array(
                'key' => 'blog_name_quote',
                'label' => 'Add Name Quote',
                'name' => 'blog_name_quote',
                'type' => 'text',
            ),
         ),    
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'quote',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_audio_metabox',
        'title' => 'Audio Setting',
        'fields' => array(
            array(
                'key' => 'blog_audio_url',
                'label' => 'Add Link Audio',
                'name' => 'blog_audio_url',
                'type' => 'text',
            ),
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'audio',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_link_metabox',
        'title' => 'Link Setting',
        'fields' => array(
            array(
                'key' => 'blog_name_link',
                'label' => 'Add Name Link',
                'name' => 'blog_name_link',
                'type' => 'text',
            ),
            array(
                'key' => 'blog_url_link',
                'label' => 'Add Url Link',
                'name' => 'blog_url_link',
                'type' => 'text',
            ),
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'link',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_video_metabox',
        'title' => 'Video Setting',
        'fields' => array(
            array(
                'key' => 'blog_video',
                'label' => 'Add Url For Video',
                'name' => 'blog_video',
                'type' => 'text',
            ),
            
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'video',
                ),
            ),
        ),
    ));
    
    acf_add_local_field_group(array(
        'key' => 'blog_gallery_metabox',
        'title' => 'Gallery Setting',
        'fields' => array(
          
          array(
            'key' => 'image_gallery_list',
            'label' => 'Gallery',
            'name' => 'image_gallery_list',
            'type' => 'gallery',
            'instructions' => 'Select images for the gallery.',
            'required' => false,
            'return_format' => 'array',
            'preview_size' => 'thumbnail',
            'library' => 'all',
        )
            
         ),   
        'location' => array (
            array (
                array(
                    'param' => 'post_format',
                    'operator' => '==',
                    'value' => 'gallery',
                ),
            ),
        ),
    ));

endif;   


?>