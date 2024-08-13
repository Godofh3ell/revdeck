<?php // Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}
class jws_Header_Admin {
    
	/**
	 * Current theme template
	 *
	 * @var String
	 */
	public $template;
    public $post_type;
	/**
	 * Instance of Elemenntor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	private static $elementor_instance;
	/**
	 * Constructor
	 */
	function __construct() {

		$this->template = get_template();

		if ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) {

	        self::$elementor_instance = Elementor\Plugin::instance();   
            add_action('init', array( $this, 'jws_register__header_blocks'));  
            // Add shortcode column to block list
            add_filter('manage_edit-hf_template_columns', array( $this, 'jws_edit_heading_header_columns'));
     
            add_action( 'restrict_manage_posts', array( $this, 'jws_edit_heading_header_columns_sortable' ) );
            add_action('manage_hf_template_posts_custom_column', array( $this,'jws_create_shortcode_header_vc'), 10, 2);
            add_action( 'template_redirect',array( $this, 'block_template_frontend' ));
            add_filter( 'single_template', array( $this, 'load_edit_template'  ));
            
            if(function_exists('insert_shortcode')) {
                 insert_shortcode( 'hf_template', array( $this, 'jws_get_content_header_block' ) );
                 insert_shortcode( 'elementor-template', array( $this, 'jws_get_content_elementor_template_block' ) );
            }    
		} 

	} 
    
    /**
	 * Single template function which will choose our template
	 *
	 * @since  1.0.1
	 *
	 * @param  String $single_template Single template.
	 */
	function load_edit_template( $single_template ) {

		global $post;

		if ( 'hf_template' == $post->post_type ) {
    
			$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

			if ( file_exists( $elementor_2_0_canvas ) ) {
				return $elementor_2_0_canvas;
			} else {
				return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
			}
		}

		return $single_template;
	}
    
    
    function jws_register__header_blocks()
    {
        $labels = array(
            'name' => _x('Header , Footers And Template', 'Post Type General Name', 'streamvid'),
            'singular_name' => _x('Header , Footers And Template', 'Post Type Singular Name', 'streamvid'),
            'menu_name' => esc_html__('Header , Footers And Template', 'streamvid'),
            'parent_item_colon' => esc_html__('Parent Item:', 'streamvid'),
            'all_items' => esc_html__('Header , Footers And Template', 'streamvid'),
            'view_item' => esc_html__('View Item', 'streamvid'),
            'add_new_item' => esc_html__('Add New Item', 'streamvid'),
            'add_new' => esc_html__('Add New', 'streamvid'),
            'edit_item' => esc_html__('Edit Item', 'streamvid'),
            'update_item' => esc_html__('Update Item', 'streamvid'),
            'search_items' => esc_html__('Search Item', 'streamvid'),
            'not_found' => esc_html__('Not found', 'streamvid'),
            'not_found_in_trash' => esc_html__('Not found in Trash', 'streamvid'),
        );
    
        $args = array(
            'label' => esc_html__('Header , Footers And Template', 'streamvid'),
            'description' => esc_html__('Elemetor content for custom HTML to place in your pages', 'streamvid'),
            'labels' => $labels,
            'menu_position' => 29,
            'taxonomies'  => array( 'hf_template_cat' ),
            'menu_icon'           => ''.JWS_URI_PATH.'/assets/image/posttyle_icon/template_icon_type.png',
            'publicly_queryable' => true,
        	'public'              => true,
			'show_ui'             => true,
			'show_in_menu'		  => 'jws_settings',
			'show_in_nav_menus'   => true,
			'exclude_from_search' => true,
			'capability_type'     => 'page',
			'hierarchical'        => true,
			'supports'            => array( 'title', 'thumbnail', 'streamvid' , 'revisions'),
            
            
        );

         
        if(function_exists('custom_reg_post_type')){
        	custom_reg_post_type( 'hf_template', $args );
        } 
        
        $labels = array(
			'name'					=> _x( 'Jws Template Categories', 'Taxonomy plural name', 'streamvid' ),
			'singular_name'			=> _x( 'Jws Template Category', 'Taxonomy singular name', 'streamvid' ),
			'search_items'			=> esc_html__( 'Search Categories', 'streamvid' ),
			'popular_items'			=> esc_html__( 'Popular project Categories', 'streamvid' ),
			'all_items'				=> esc_html__( 'All project Categories', 'streamvid' ),
			'parent_item'			=> esc_html__( 'Parent Category', 'streamvid' ),
			'parent_item_colon'		=> esc_html__( 'Parent Category', 'streamvid' ),
			'edit_item'				=> esc_html__( 'Edit Category', 'streamvid' ),
			'update_item'			=> esc_html__( 'Update Category', 'streamvid' ),
			'add_new_item'			=> esc_html__( 'Add New Category', 'streamvid' ),
			'new_item_name'			=> esc_html__( 'New Category', 'streamvid' ),
			'add_or_remove_items'	=> esc_html__( 'Add or remove Categories', 'streamvid' ),
			'choose_from_most_used'	=> esc_html__( 'Choose from most used text-domain', 'streamvid' ),
			'menu_name'				=> esc_html__( 'Category', 'streamvid' ),
		);
	
		$args = array(
			'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'hf_template_cat' ),
		);
        

        if(function_exists('custom_reg_taxonomy')){
            custom_reg_taxonomy( 'hf_template_cat', array( 'hf_template' ), $args  );
        }
        
      
    
    }
    
    function jws_edit_heading_header_columns_sortable($post_type) {
        if($post_type == 'hf_template') {
            $this->post_type = $post_type;
    		$taxonomies      = get_object_taxonomies( $post_type, 'objects' );
    		$taxonomies      = array_filter( $taxonomies, array( $this, 'is_filterable' ) );
    		array_walk( $taxonomies, array( $this, 'output_filter_for' ) );
        }
        
    }
    
    	/**
	 * Check if we have some taxonomies to filter.
	 *
	 * @param \WP_Taxonomy $taxonomy The taxonomy object.
	 *
	 * @return bool
	 */
	protected function is_filterable( $taxonomy ) {
		// Post category is filterable by default.
		if ( 'post' === $this->post_type && 'category' === $taxonomy->name ) {
			return false;
		}
  
		return true;
	}

	/**
	 * Output filter for a taxonomy.
	 *
	 * @param \WP_Taxonomy $taxonomy The taxonomy object.
	 */
	protected function output_filter_for( $taxonomy ) {
		wp_dropdown_categories( array(
			'show_option_all' => sprintf( __( 'All %s', 'streamvid' ), $taxonomy->label ),
			'orderby'         => 'name',
			'order'           => 'ASC',
			'hide_empty'      => false,
			'hide_if_empty'   => true,
			'selected'        => filter_input( INPUT_GET, $taxonomy->query_var, FILTER_SANITIZE_STRING ),
			'hierarchical'    => true,
			'name'            => $taxonomy->query_var,
			'taxonomy'        => $taxonomy->name,
			'value_field'     => 'slug',
		) );
	}
    
    function jws_edit_heading_header_columns($columns)
    {
        
            $columns = array(
                'cb' => '<input type="checkbox" />',
                'title' => esc_html__('Title', 'streamvid'),
                'shortcode' => esc_html__('Shortcode', 'streamvid'),
                'date' => esc_html__('Date', 'streamvid'),
                'taxonomy-hf_template_cat' => esc_html__('Category', 'streamvid'),
            );
        
            return $columns;
    }
        
    function jws_create_shortcode_header_vc($column, $post_id)
        {
            switch ($column) {
                case 'shortcode' :
                    echo '<strong>[hf_template id="' . $post_id . '"]</strong>';
                    break;
            }
    }
    
    function block_template_frontend() {
    		if ( is_singular( 'hf_template' ) && ! current_user_can( 'edit_posts' ) ) {
    			wp_redirect( site_url(), 301 );
    			die;
    		}
    }
    function jws_get_content_header_block($atts) {
       	$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'hf_template'
		);

		$id = ! empty( $atts['id'] ) ? apply_filters( 'hfe_render_template_id', intval( $atts['id'] ) ) : '';

		if ( empty( $id ) ) {
			return '';
		}
  
	
		return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id , true  );
    }
    
    function jws_get_content_elementor_template_block($atts) {
       	$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'elementor_library'
		);

		$id = ! empty( $atts['id'] ) ? apply_filters( 'elementor_library_id', intval( $atts['id'] ) ) : '';

		if ( empty( $id ) ) {
			return '';
		}
        
        $include_css = true;


		return Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $id , true );
       
    }
    
    
    



}  
new jws_Header_Admin();
