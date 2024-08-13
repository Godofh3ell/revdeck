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
class Jws_watchlist_button extends Widget_Base {

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
		return 'jws_watchlist_button';
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
		return esc_html__( 'Jws Watch List', 'streamvid' );
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
		return 'eicon-post-list';
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
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'movies',
					'options'   => [
						'movies'   => esc_html__( 'Movies', 'streamvid' ),
						'tv_shows'   => esc_html__( 'Tv Shows', 'streamvid' ),
					],
                    
				]
		);
      
        $this->add_control(
				'videos_movies',
				[
					'label'     => esc_html__( 'Select Movies', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_all_top_videos('movies'),
                    'condition'	=> [
					   'post_type' => 'movies',
				    ],
				]
		);
        $this->add_control(
				'videos_tv_shows',
				[
					'label'     => esc_html__( 'Select Tv Shows', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_all_top_videos('tv_shows'),
                    'condition'	=> [
					   'post_type' => 'tv_shows',
				    ],
				]
		);
        
        $this->end_controls_section(); 
    

	}
    

     /**
	 * Get WooCommerce post Categories.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_all_top_videos($post) {
	   
        
        $args = array(
           'post_type' => $post,
           'posts_per_page' => -1
        );
        $return = array();
        
        $posts = get_posts( $args );
        
        foreach ( $posts as $post ) {
         
           $return[ $post->ID ] = get_the_title($post->ID);
        }

        return $return;
       
   

		
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
        $row_class = 'jws-watchlist-button';

        $id = $settings['post_type'] == 'movies' ? $settings['videos_movies'] : $settings['videos_tv_shows'];
        
        ?>
     
        <div class="<?php echo esc_attr($row_class); ?>">
            <?php  if(function_exists('jws_watchlist_button')) jws_watchlist_button($id); ?>
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