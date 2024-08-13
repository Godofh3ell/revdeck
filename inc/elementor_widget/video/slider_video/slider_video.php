<?php
namespace Elementor;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Slider_Video extends Widget_Base {

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
		return 'jws_slider_video';
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
		return esc_html__( 'Jws Slider Video', 'streamvid' );
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
		return 'eicon-slider-video';
	}
    /**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
      public function get_script_depends() {
		return [ 'magnificPopup'];
	  }
      public function get_style_depends() {
		return [ 'magnificPopup'];
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
	 * Register Woo post Grid controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_controls() {

		/* General Tab */
        $this->register_content_general_controls();
        $this->register_content_filter_controls();

        $this->register_content_slider_controls();
      
 
	}

    /**
	 * Register Woo posts General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	*/
	protected function register_content_general_controls() {

		$this->start_controls_section(
			'section_general_field',
			[
				'label' => esc_html__( 'General', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
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
                        'multi'   => esc_html__( 'Tv Shows & Movies', 'streamvid' ),
					],
                    
				]
		);
         $this->add_control(
				'layout',
				[
					'label'     => esc_html__( 'Layout', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout 1', 'streamvid' ),
						'layout2'   => esc_html__( 'Layout 2', 'streamvid' ),
					],
                    
				]
		);
        $this->add_control(
			'play_text',
			[
				'label'     => esc_html__( 'Play Now Text', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Play Now',
			]
		);
        
        $this->add_control(
			'watch_later_text',
			[
				'label'     => esc_html__( 'Watch Later Text', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Watch Later',
			]
		);
        $this->add_control(
				'enable_background_video',
				[
					'label'        => esc_html__( 'Enable Background Video', 'streamvid' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
					'label_off'    => esc_html__( 'No', 'streamvid' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'Turning on will display the video background with the post\'s trailer data.', 'streamvid' ),
				]
		);
        $this->add_control(
				'enable_youtube_api',
				[
					'label'        => esc_html__( 'Enable Youtube Api', 'streamvid' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
					'label_off'    => esc_html__( 'No', 'streamvid' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'If the slider uses youtube url, please enable youtube api.', 'streamvid' ),
				]
		);

        $this->add_control(
			'slider_video_image_size',
			[
				'label' => esc_html__( 'Image Size', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => esc_html__( 'Add Image Size For Background Image.', 'streamvid' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		  );
 
		$this->end_controls_section();
       
     }   
    	/**
	 * Register Woo posts Filter Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_filter_controls() {

		$this->start_controls_section(
			'section_filter_field',
			[
				'label' => esc_html__( 'Query', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
       
			]
		);
        
        $this->add_control(
				'slider_video_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'streamvid' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '8',
					'condition' => [
						'query_type!'  => 'main',
					],
				]
			);
		$this->add_control(
				'query_type',
				[
					'label'   => esc_html__( 'Source', 'streamvid' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'all',
					'options' => [
						'all'    => esc_html__( 'All posts', 'streamvid' ),
						'custom' => esc_html__( 'Custom Query', 'streamvid' ),
						'manual' => esc_html__( 'Manual Selection', 'streamvid' ),
					],
                    'condition'   => [
						'post_type!' => [ 'multi' ]
					],
				]
			);
            
            
            
            $this->register_query_type_controls('movies');
            
            $this->register_query_type_controls('tv_shows');

			

			/* Advanced Filter */
			$this->add_control(
				'query_advanced',
				[
					'label'     => esc_html__( 'Advanced', 'streamvid' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
	
			$this->add_control(
				'orderby',
				[
					'label'     => esc_html__( 'Order by', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'date',
					'options'   => [
						'date'       => esc_html__( 'Date', 'streamvid' ),
						'title'      => esc_html__( 'Title', 'streamvid' ),
						'rand'       => esc_html__( 'Random', 'streamvid' ),
						'post__in' => esc_html__( 'Post In', 'streamvid' ),
                        'tmdb_vote' => esc_html__( 'Tmdb Vote', 'streamvid' ),
                        'imdb_vote' => esc_html__( 'Imdb Vote', 'streamvid' ),
                        'views' => esc_html__( 'Views', 'streamvid' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);
			$this->add_control(
				'order',
				[
					'label'     => esc_html__( 'Order', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'desc',
					'options'   => [
						'desc' => esc_html__( 'Descending', 'streamvid' ),
						'asc'  => esc_html__( 'Ascending', 'streamvid' ),
					],
					'condition' => [
						'query_type!' => 'main',
					],
				]
			);

		$this->end_controls_section();
	}
    
   	protected function register_query_type_controls($post_type) { 
   	    
        if($post_type == 'tv_shows') {
            
            $slug = '_tv_shows';
            
        } else {
            $slug = '';
        }
        
        $this->add_control(
				'category_filter_rule'.$slug,
				[
					'label'     => esc_html__( 'Category Filter Rule', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Categories', 'streamvid' ),
						'NOT IN' => esc_html__( 'Exclude Categories', 'streamvid' ),
					],
					'condition' => [
						'query_type' => 'custom',
                        'post_type' => $post_type,
					],
				]
			);
			$this->add_control(
				'category_filter'.$slug,
				[
					'label'     => esc_html__( 'Select Categories', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_slider_video_categories($post_type),
					'condition' => [
						'query_type' => 'custom',
                        'post_type' => $post_type,
					],
				]
			);
            
            
			$this->add_control(
				'tag_filter_rule'.$slug,
				[
					'label'     => esc_html__( 'Tag Filter Rule', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'IN',
					'options'   => [
						'IN'     => esc_html__( 'Match Tags', 'streamvid' ),
						'NOT IN' => esc_html__( 'Exclude Tags', 'streamvid' ),
					],
					'condition' => [
						'query_type' => 'custom',
                        'post_type' => $post_type,
					],
				]
			);
			$this->add_control(
				'tag_filter'.$slug,
				[
					'label'     => esc_html__( 'Select Tags', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_slider_video_tags($post_type),
					'condition' => [
						'query_type' => 'custom',
                        'post_type' => $post_type,
					],
				]
			);
			$this->add_control(
				'offset'.$slug,
				[
					'label'       => esc_html__( 'Offset', 'streamvid' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 0,
					'description' => esc_html__( 'Number of post to displace or pass over.', 'streamvid' ),
					'condition'   => [
						'query_type' => 'custom',
                        'post_type' => $post_type,
					],
				]
			);

			$this->add_control(
				'query_manual_ids'.$slug,
				[
					'label'     => esc_html__( 'Select posts', 'streamvid' ),
					'type'      => 'jws-query-posts',
					'post_type' => $post_type,
					'multiple'  => true,
					'condition' => [
						'query_type' => 'manual',
                        'post_type' => $post_type,
					],
				]
			);

			/* Exclude */
			$this->add_control(
				'query_exclude'.$slug,
				[
					'label'     => esc_html__( 'Exclude', 'streamvid' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => [ 'manual', 'main' ],
                        'post_type' => $post_type,
					],
				]
			);
			$this->add_control(
				'query_exclude_ids'.$slug,
				[
					'label'       => esc_html__( 'Select posts', 'streamvid' ),
					'type'        => 'jws-query-posts',
					'post_type'   => $post_type,
					'multiple'    => true,
					'description' => esc_html__( 'Select posts to exclude from the query.', 'streamvid' ),
					'condition'   => [
						'query_type!' => [ 'manual', 'main' ],
                        'post_type' => $post_type,
					],
				]
			);
			$this->add_control(
				'query_exclude_current'.$slug,
				[
					'label'        => esc_html__( 'Exclude Current post', 'streamvid' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
					'label_off'    => esc_html__( 'No', 'streamvid' ),
					'return_value' => 'yes',
					'default'      => '',
					'description'  => esc_html__( 'Enable this option to remove current post from the query.', 'streamvid' ),
					'condition'    => [
						'query_type!' => [ 'manual', 'main' ],
                        'post_type' => $post_type,
					],
				]
			);
        
   	}

    
    /**
	 * Register Slider Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_slider_controls() {
	    
        
        
        $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Slider Navigation', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
        $this->add_control(
				'enable_nav',
				[
					'label'        => esc_html__( 'Enable Nav', 'streamvid' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
					'label_off'    => esc_html__( 'No', 'streamvid' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'description'  => esc_html__( 'Enable nav arrow.', 'streamvid' ),
				]
    	);
        
         $this->add_responsive_control(
			'nav_position',
			[
				'label'     => esc_html__( 'Change Position Vertical For Nav.', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .video-action' => 'bottom: {{SIZE}}px;',
				],
                'condition'    => [
					'enable_nav'  => 'yes',
				],
			]
		);
        
        $this->add_responsive_control(
			'nav_position2',
			[
				'label'     => esc_html__( 'Change Position Horizontal For Nav.', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .video-action' => 'right: {{SIZE}}px;',
				],
                'condition'    => [
					'enable_nav'  => 'yes',
				],
			]
		);
   
        $this->add_control(
    				'enable_dots',
    				[
    					'label'        => esc_html__( 'Enable Dots', 'streamvid' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
    					'label_off'    => esc_html__( 'No', 'streamvid' ),
    					'return_value' => 'yes',
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable dot.', 'streamvid' ),
    				]
    	);

        $this->add_control(
    				'enable_dots_number',
    				[
    					'label'        => esc_html__( 'Enable Dots Number', 'streamvid' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
    					'label_off'    => esc_html__( 'No', 'streamvid' ),
    					'return_value' => 'yes',
    					'default'      => '',
    				]
    	);
        $this->end_controls_section();  
        
        
           
		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'streamvid' ),
				'type'      => Controls_Manager::SECTION,
			]
		);


		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'streamvid' ),
				'type'           => Controls_Manager::NUMBER,

			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'          => esc_html__( 'posts to Scroll', 'streamvid' ),
				'type'           => Controls_Manager::NUMBER,
	
			]
		);
        
		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
         $this->add_control(
			'center',
			[
				'label'        => esc_html__( 'Cener Mode', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        $this->add_responsive_control(
			'center_padding',
			[
				'label'     => esc_html__( 'Center Padding', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => [
					'center'             => 'yes',
				],

			]
		);
        
        $this->add_control(
			'variablewidth',
			[
				'label'        => esc_html__( 'variable Width', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			]
		);
         $this->add_responsive_control(
			'variablewidth_width',
			[
				'label'     => esc_html__( 'Add Width For Item Variable Width (px) ', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 1100,
				],
				'selectors' => [
					'{{WRAPPER}} .slider-item' => 'width: {{SIZE}}px;',
				],
                'condition'    => [
					'variablewidth' => 'yes',
				],
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'streamvid' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'selectors' => [
					'{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
				],
				'condition' => [
					'autoplay'             => 'yes',
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'        => esc_html__( 'Pause on Hover', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'autoplay'             => 'yes',
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'        => esc_html__( 'Infinite Loop', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
        $this->add_control(
			'rtl',
			[
				'label'        => esc_html__( 'Right To Left', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
		$this->add_control(
			'transition_speed',
			[
				'label'     => esc_html__( 'Transition Speed (ms)', 'streamvid' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);
		$this->end_controls_section();
        
        $this->start_controls_section(
			'settings_style',
			[
				'label' => esc_html__( 'Settings', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'slider_height',
			[
				'label'     => esc_html__( 'Slider Height', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .jws_slider_video_item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        
        $this->start_controls_section(
			'box_style',
			[
				'label' => esc_html__( 'Content Inner Video', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'box_vertical',
			[
				'label'       => esc_html__( 'Vertical Align', 'streamvid' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'at-center',
				'options'     => [
                    'at-center'  => [
						'title' => esc_html__( 'Center', 'streamvid' ),
						'icon'  => 'eicon-h-align-center',
					],
                    'at-top' => [
						'title' => esc_html__( 'Top', 'streamvid' ),
						'icon'  => 'eicon-v-align-top',
					],
                    'at-bottom' => [
						'title' => esc_html__( 'Bottom', 'streamvid' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'label_block' => false,
				'toggle'      => false,
                'prefix_class' => 'jws-content-vertical-',

			]
		);
        
      $this->add_control(
			'box_horizontal',
			[
				'label'       => esc_html__( 'Horizontal Align', 'streamvid' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'at-center',
				'options'     => [
                    'left'    		=> [
						'title' 	=> esc_html__( 'Left', 'streamvid' ),
						'icon' 		=> 'eicon-h-align-left',
					],
					'center' 		=> [
						'title' 	=> esc_html__( 'Center', 'streamvid' ),
						'icon' 		=> 'eicon-h-align-center',
					],
					'right' 		=> [
						'title' 	=> esc_html__( 'Right', 'streamvid' ),
						'icon' 		=> 'eicon-h-align-right',
					],
				],
				'label_block' => false,
				'toggle'      => false,
                'prefix_class' => 'jws-content-horizontal-',

			]
		);
        
        $this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .video-content-holder' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
       $this->add_responsive_control(
			'box_width',
			[
				'label'     => esc_html__( 'Content Width', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video-inner' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
         $this->start_controls_section(
			'box_category_style',
			[
				'label' => esc_html__( 'Category', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'category_color',
			[
				'label' => esc_html__( 'Category Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video-cat a , {{WRAPPER}} .video-content-holder .video-cat' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'category_color_hover',
			[
				'label' => esc_html__( 'Category Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video-cat a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'category_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .video-content-holder .video-cat',
			]
		);
        
        $this->add_responsive_control(
			'category_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'streamvid' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .video-content-holder .video-cat' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

				'separator' => 'before',
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'box_title_style',
			[
				'label' => esc_html__( 'Title', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video_title a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__( 'Title Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video_title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .video-content-holder .video_title',
			]
		);

        $this->add_responsive_control(
					'title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .video-content-holder .video_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);


        $this->end_controls_section();
        
        $this->start_controls_section(
			'meta_style',
			[
				'label' => esc_html__( 'Meata (imdb , year...)', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
					'meta_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .video-content-holder .video-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'excerpt_style',
			[
				'label' => esc_html__( 'Excerpt', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_excerpt',
			[
				'label' => esc_html__( 'Show Excerpt', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'streamvid' ),
				'label_off' => esc_html__( 'Hide', 'streamvid' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
        $this->add_control(
			'excerpt_length',
			[
				'label'     => esc_html__( 'Excerpt Length', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
			]
		);
        $this->add_control(
			'excerpt_more',
			[
				'label'     => esc_html__( 'Excerpt More', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => ' ... ',
			]
		);
        
        
        $this->add_control(
			'excerpt_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-content-holder .video-description' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .video-content-holder .video-description',
			]
		);
        $this->add_responsive_control(
					'excerpt_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .video-content-holder .video-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        
        $this->start_controls_section(
			'wishlist_style',
			[
				'label' => esc_html__( 'Video Wishlist', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        
        $this->add_control(
			'wishlist_layouts',
			[
				'label'     => esc_html__( 'Layout', 'streamvid' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'layout1',
				'options'   => [
					'layout1'   => esc_html__( 'With Text', 'streamvid' ),
					'layout2'   => esc_html__( 'Only Icon Plus', 'streamvid' ),
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
	protected function get_slider_video_categories($post_type) {

		$slider_video_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);
        
        $tax_slug = $post_type == 'tv_shows' ? 'tv_shows_cat' : 'movies_cat';

		$slider_video_categories = get_terms( $tax_slug , $cat_args );

		if ( ! empty( $slider_video_categories ) ) {

			foreach ( $slider_video_categories as $key => $category ) {
				$slider_video_cat[ $category->term_id ] = $category->name;
			}
		}

		return $slider_video_cat;
	}
    /**
	 * Get WooCommerce post Tags.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_slider_video_tags($post_type) {

		$slider_video_return = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);
        
        $tax_slug = $post_type == 'tv_shows' ? 'tv_shows_tag' : 'movies_tag';

		$slider_video_tag = get_terms( $tax_slug , $tag_args );

		if ( ! empty( $slider_video_tag ) ) {

			foreach ( $slider_video_tag as $key => $tag ) {

				$slider_video_return[ $tag->term_id ] = $tag->name;
			}
		}

		return $slider_video_return;
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

		$settings = $this->get_settings();


		   global $post;
            
           $post_type = $settings['post_type'];
           $slug_post_type = $settings['post_type'];
            
           if($post_type == 'tv_shows') {

                $flex = '_tv_shows';
                $slug_post_type = $settings['post_type'];
                
            }else {
                
                $flex = '';
            }
            
            if( $post_type == 'multi' ) {
                
                $slug_post_type = array('tv_shows','movies');
                
            }

			$query_args = [
				'post_type'      => $slug_post_type,
				'post_status'    => 'publish',
				'posts_per_page' => -1,
				'paged'          => 1,
				'post__not_in'   => array(),
			];
            // Default ordering args.
			$query_args['orderby'] = $settings['orderby'];
			$query_args['order']   = $settings['order'];
            
            if($settings['orderby'] == 'tmdb_vote') {
                $query_args['orderby'] = 'meta_value_num';
                $query_args['meta_query'] = array(
                    
                        array(
                            'key' => 'videos_vote',
                            'type' => 'NUMERIC' // unless the field is not a number
                        ),
                 
                );
     
            }
            
            if($settings['orderby'] == 'imdb_vote') { 
                
                $query_args['orderby'] = 'meta_value_num';
                
                $query_args['meta_query'] = array(
                    
                        array(
                            'key' => 'videos_imdb',
                            'type' => 'NUMERIC' // unless the field is not a number
                        ),
                 
                );
                
            }
            
            if($settings['orderby'] == 'views') { 
                
                $query_args['orderby'] = 'meta_value_num';
                
                $query_args['meta_query'] = array(
                    
                        array(
                            'key' => 'views',
                            'type' => 'NUMERIC' // unless the field is not a number
                        ),
                 
                );
                
            }
            
            
            
            
		    if ( $settings['slider_video_per_page'] > 0 ) {
				$query_args['posts_per_page'] = $settings['slider_video_per_page'];
			}


			if ( 'custom' === $settings['query_type'] ) {

				if ( ! empty( $settings['category_filter'.$flex] ) ) {

					$cat_operator = $settings['category_filter_rule'.$flex];

					$query_args['tax_query'][] = [
						'taxonomy' => $post_type.'_cat',
						'field'    => 'id',
						'terms'    => $settings['category_filter'.$flex],
						'operator' => $cat_operator,
					];
				}

				if ( ! empty( $settings['tag_filter'.$flex] ) ) {

					$tag_operator = $settings['tag_filter_rule'.$flex];

					$query_args['tax_query'][] = [
						'taxonomy' => $post_type.'_tag',
						'field'    => 'id',
						'terms'    => $settings['tag_filter'.$flex],
						'operator' => $tag_operator,
					];
				}

				if ( 0 < $settings['offset'.$flex] ) {

					/**
					 * Offset break the pagination. Using WordPress's work around
					 *
					 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
					 */
					$query_args['offset_to_fix'] = $settings['offset'.$flex];
				}
			}

			if ( 'manual' === $settings['query_type'] ) {

				$manual_ids = $settings['query_manual_ids'.$flex];

				$query_args['post__in'] = $manual_ids;
			}

			if ( 'manual' !== $settings['query_type'] && 'main' !== $settings['query_type'] ) {

				if ( '' !== $settings['query_exclude_ids'.$flex] ) {

					$exclude_ids = $settings['query_exclude_ids'.$flex];

					$query_args['post__not_in'] = $exclude_ids;
				}

				if ( 'yes' === $settings['query_exclude_current'.$flex] && isset($post->ID) ) {

					$query_args['post__not_in'][] = $post->ID;
				}
			}


			$slider_video = new \WP_Query( $query_args );

      $class_row = 'row slider_video_content';  
      $class_row .= ' '.$settings['layout'];
      if ( $slider_video->max_num_pages > 1) { $class_row.= ' jws_has_pagination'; }
      
      $class_column = 'jws_slider_video_item';


      if($settings['enable_youtube_api'] == 'yes') {
        wp_enqueue_script('jws-youtube-api');
      }  

   
            $class_row .= ' owl-carousel jws_slider_video_slider';
            $class_column .= ' slider-item';
            $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
            $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
            $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
            $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
            $rtl = ($settings['rtl'] == 'yes') ? 'true' : 'false';
            $center = ($settings['center'] == 'yes') ? 'true' : 'false';
       
            if($center == 'true') {
                $center_padding = $settings['center_padding'];
                $class_row .= ' center-mode';
            }else {
                $center_padding = '0px';
            }
            $variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false'; 
            $settings['center_padding_tablet'] = isset($settings['center_padding_tablet']) && !empty($settings['center_padding_tablet']) ? $settings['center_padding_tablet'] : $center_padding;
            $settings['center_padding_mobile'] = isset($settings['center_padding_mobile']) && !empty( $settings['center_padding_mobile']) ? $settings['center_padding_mobile'] : $center_padding;
         
            $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '1';

            $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
            $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
            
           
            
            $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
            
            $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
            $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
            $nav_thumbnail = $settings['enable_thumbnail'] == 'yes' ? '"asNavFor":"#thumbnail-'.$this->get_id().'",' : '';
            
            $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
            
            $data_slick = 'data-owl-option=\'{
                "autoplay": '.$autoplay.',
                "nav": '.$arrows.', 
                "dots":'.$dots.', 
                "autoplayTimeout": '.$autoplay_speed.',
                "autoplayHoverPause":'.$pause_on_hover.',
                "center":'.$center.', 
                "loop":'.$infinite.',
                "autoWidth":'.$variablewidth.',
                "smartSpeed": '.$settings['transition_speed'].', 
                "responsive":{
                    "1024":{"items": '.$settings['slides_to_show'].',"slideBy": '.$settings['slides_to_scroll'].'},
                    "768":{"items": '.$settings['slides_to_show_tablet'].',"slideBy": '.$settings['slides_to_scroll_tablet'].'},
                    "0":{"items": '.$settings['slides_to_show_mobile'].',"slideBy": '.$settings['slides_to_scroll_mobile'].'}
            }}\''; 
       

    
      $image_size = !empty($settings['slider_video_image_size']['width']) && !empty($settings['slider_video_image_size']['height']) ?  $settings['slider_video_image_size']['width'].'x'.$settings['slider_video_image_size']['height'] : 'full';
      $thumbnail_image_size = !empty($settings['thumbnail_image_size']['width']) && !empty($settings['thumbnail_image_size']['height']) ?  $settings['thumbnail_image_size']['width'].'x'.$settings['thumbnail_image_size']['height'] : 'full';  
 

      ?>
       <div class="jws-slider_video-element">

            <div class="<?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?>>
                <?php 
                      $i = 1;  
                      if ($slider_video->have_posts()) :
                            while ( $slider_video->have_posts() ) :
                        			$slider_video->the_post();
        
                                      echo '<div class="'.$class_column.'" data-index="'.$i.'">';
                                               include( 'layout/'.$settings['layout'].'.php' );
                                      echo '</div>';  
                            $i++;               
                            endwhile;    
                            wp_reset_postdata();
                           
                       endif;  
                  
                   
                ?>
           </div>
           <?php
            
            if($settings['enable_background_video'] == 'yes') {
                ?>    
                <div class="video-action">
                    <?php 
                          if($settings['enable_dots_number'] == 'yes') {
                          echo '<div class="jws-nav-carousel">
                            <div class="jws-button-prev"></div><span class="jws-nav-pre"><span></span></span><div class="jws-button-next"></div>
                           </div>'; 
                         };
                    ?>
                </div> 
                <?php
            }
           
            ?>
        </div>

	<?php }
    
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