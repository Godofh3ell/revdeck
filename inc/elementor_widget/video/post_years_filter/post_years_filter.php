<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Post_Years_Filter extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'jws_post_years_filter';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Jws Post Years Filter', 'streamvid' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-number-field';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'jws-elements' ];
	}

    /**
     * Load style
     */
    public function get_style_depends()
    {
        return [];
    }

    /**
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return [];
    }
 
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
	    $this->start_controls_section(
			'setting_section',
			[
				'label' => esc_html__( 'Setting', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

 
         $this->add_control(
				'post_type',
				[
					'label'     => esc_html__( 'Post Type', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'movies',
					'options'   => [
						'movies'   => esc_html__( 'Movies', 'streamvid' ),
						'tv_shows'   => esc_html__( 'Tv Shows', 'streamvid' ),
					],
                    
				]
		);
        
        $this->end_controls_section(); 

	}
    
    
    protected function check_current_cat($slug) { 
        
        $current_cat = get_queried_object();
        
        if(isset($current_cat->slug) && $current_cat->slug  ==  $slug) {
            
            $current_class = ' current';
            
        } else {
            
            $current_class = '';
        }
        
        return $current_class;
   
    }
    
    protected function get_current_term_slug($meta) {
		
        if(isset($_GET[$meta]) && !empty($_GET[$meta])) {
           return  explode( ',', $_GET[$meta] );  
        }else {
            return array();
        }
        
        
	}
    
    
     protected function get_widget_link($value,$post_type,$filter_name) {
        
        if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) { 
            
            return '';
            
        }
     
        if (is_post_type_archive()) {
          $link = get_post_type_archive_link($post_type);
        }else {
			$queried_object = get_queried_object();
            
            if(!isset($queried_object->slug)) {
                return ''; 
            }
            
			$link   = get_term_link( $queried_object->slug, $queried_object->taxonomy );
		}
        
        if ( isset( $_GET['sortby'] ) ) {
			$link = add_query_arg( 'sortby', $_GET['sortby'], $link );
		}
        
        if ( isset( $_GET['post_type'] ) ) {
			$link = add_query_arg( 'post_type', $_GET['post_type'], $link );
		}
        
        if ( isset( $_GET['starts_with'] ) ) {
			$link = add_query_arg( 'starts_with', $_GET['starts_with'], $link );
		}
        
        if ( get_search_query() ) {
            $link = add_query_arg( 's', rawurlencode( jws_chars_spec_html( get_search_query() ) ), $link );
        }
      
        $current_filter = isset( $_GET[$filter_name] ) ? explode( ',', $_GET[$filter_name] ) : array();
		$current_filter = array_map( 'sanitize_title', $current_filter );
        
        if ( ! in_array( $value , $current_filter ) ) {
			$current_filter[] = $value;
		}
    
        
        
        foreach ( $current_filter as $key => $value_current ) {
	
			if ( in_array($value_current, $this->get_current_term_slug($filter_name))  && $value == $value_current ) {
	
				unset( $current_filter[$key] );
			}

		}

        if ( ! empty( $current_filter ) ) {
			$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

		}
        
     
        
        
        return $link;
                    
        
	}
    
    
    

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
	   
		$settings = $this->get_settings_for_display();
        $row_class = 'jws-post-years-filter';

        $post_type = $settings['post_type'];

        $year_key = 'videos_years';
        $category = $post_type == 'movies' ? 'movies_cat' : 'tv_shows_cat';
        	
        $filter_name = 'years'; 
     
        	
          global $wpdb;

          $query = $wpdb->get_results( $wpdb->prepare( "
            SELECT DISTINCT  pm.meta_value FROM {$wpdb->postmeta} pm
            LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            WHERE pm.meta_key = '%s' 
            AND p.post_type = '%s'
          ", $year_key , $post_type
        ) );
        

        ?>
     
        <div class="<?php echo esc_attr($row_class); ?>">
 
         <?php if(!empty($query)) : sort($query); ?>   
             <ul class="reset_ul_ol jws-filter-list">
    		      <?php 
                
                  foreach($query as $value) {
                    if(empty($value->meta_value)) continue;
                    if ( in_array($value->meta_value, $this->get_current_term_slug($filter_name)) ) {
	                      $current_active = ' current'; 
			        }else {
			             $current_active = ''; 
			        }

                    
                    $link = $this->get_widget_link($value->meta_value,$post_type,$filter_name);
                  
                    echo '<li><a class="fs-small'.$current_active.'" href="'.$link.'">'.$value->meta_value.'</a></li>';
                    
                  }
                  
                  ?>
             </ul>
         <?php endif; ?>
  
           
        </div>    
          
        <?php

	}
    


	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {}
}