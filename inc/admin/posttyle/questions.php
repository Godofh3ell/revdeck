<?php // Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

    function jws_register_questions() {
      
      $option = jws_theme_get_option('auestions-enble'); 
        
      if(!$option) return;  
        
	 // Set UI labels for Custom Post Type
            $labels = array(
                'name' => _x('Questions & Answers', 'Post Type General Name', 'streamvid'),
                'singular_name' => _x('Question', 'Post Type Singular Name', 'streamvid'),
                'menu_name' => __('Questions & Answers', 'streamvid'),
                'parent_item_colon' => __('Parent discussion', 'streamvid'),
                'all_items' => __('Questions & Answers', 'streamvid'),
                'view_item' => __('View discussions', 'streamvid'),
                'add_new_item' => __('Add new question', 'streamvid'),
                'add_new' => __('Add new', 'streamvid'),
                'edit_item' => __('Edit discussion', 'streamvid'),
                'update_item' => __('Update discussion', 'streamvid'),
                'search_items' => __('Search discussion', 'streamvid'),
                'not_found' => __('Not found', 'streamvid'),
                'not_found_in_trash' => __('Not found in the bin', 'streamvid'),
            );

            // Set other options for Custom Post Type

            $args = array(
                'label' => __('Questions & Answers', 'streamvid'),
                'description' => __('YITH Questions and Answers', 'streamvid'),
                'labels' => $labels,
                // Features this CPT supports in Post Editor
                'supports' => array(
                    'title',
                    //'editor',
                    //'author',
                ),
                'hierarchical' => false,
                'public' => false,
                'show_ui' => true,
                'show_in_menu'	 => 'woocommerce',
                'show_in_nav_menus' => false,
                'show_in_admin_bar' => false,
                'menu_position' => 9,
                'can_export' => false,
                'has_archive' => true,
                'exclude_from_search' => true,
                'menu_icon' => 'dashicons-clipboard',
                'query_var' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            );

     


        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'questions', $args );
        }

		
	};
add_action( 'init', 'jws_register_questions', 1 );

