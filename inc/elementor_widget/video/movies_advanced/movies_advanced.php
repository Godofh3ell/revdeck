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
class Jws_Movies_Advanded extends Widget_Base {

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
		return 'jws_movies_advanced';
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
		return esc_html__( 'Jws Movies Advanced', 'streamvid' );
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
		return 'eicon-video-playlist';
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
		$this->register_content_grid_controls();

        $this->register_content_pagination_controls();
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
				'movies_advanced_display',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'   => esc_html__( 'Grid', 'streamvid' ),
						'slider'   => esc_html__( 'Slider', 'streamvid' ),
                        'mixed'   => esc_html__( 'Mixed', 'streamvid' ),

					],
                    
				]
			);
            $this->add_control(
    			'enable_masonry',
    			[
    				'label' => esc_html__( 'Enable Masonry', 'streamvid' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'streamvid' ),
    				'label_off' => esc_html__( 'Off', 'streamvid' ),
    				'return_value' => 'yes',
    			]
    		);
            $this->add_control(
    			'enable_animation',
    			[
    				'label' => esc_html__( 'Enable Animation', 'streamvid' ),
    				'type' => \Elementor\Controls_Manager::SWITCHER,
    				'label_on' => esc_html__( 'On', 'streamvid' ),
    				'label_off' => esc_html__( 'Off', 'streamvid' ),
    				'return_value' => 'yes',
    			]
    		);
            $this->add_control(
    			'border_popover_toggle',
    			[
    				'label' => esc_html__( 'Border', 'streamvid' ),
    				'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
    				'label_off' => esc_html__( 'Default', 'streamvid' ),
    				'label_on' => esc_html__( 'Custom', 'streamvid' ),
    				'return_value' => 'yes',
    				'default' => 'yes',
    			]
		    );
            $this->add_control(
				'movies_advanced_layouts',
				[
					'label'     => esc_html__( 'Layout', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout 1', 'streamvid' ),
						'layout2'   => esc_html__( 'Layout 2', 'streamvid' ),
                        'layout3'   => esc_html__( 'Layout 3', 'streamvid' ),
                        'layout4'   => esc_html__( 'Layout 4', 'streamvid' ),
                        'layout5'   => esc_html__( 'Layout 5 (Not Hover)', 'streamvid' ),
					],
                    
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
				'readmore_text',
				[
					'label'     => esc_html__( 'Read More Text', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Read More',
				]
			);
            $this->add_control(
				'icon',
				[
					'label' => esc_html__( 'Read More Icon', 'streamvid' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fab fa-wordpress',
                		'library' => 'fa-brands',
					],
				]
		  );
          $this->add_control(
			'movies_advanced_image_size',
			[
				'label' => esc_html__( 'Image Size', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		  );
          $this->add_control(
			'post_archive',
			[
				'label' => esc_html__( 'Show Post For Archive Category', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'streamvid' ),
				'label_off' => esc_html__( 'Off', 'streamvid' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
        $this->add_control(
			'post_related',
			[
				'label' => esc_html__( 'Show post related for single movies_advanced', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'streamvid' ),
				'label_off' => esc_html__( 'Off', 'streamvid' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
         $this->add_control(
			'title_related',
			[
				'label'     => esc_html__( 'Title Related', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
                'condition' => [
					'post_related' => ['yes'],
				],
			]
		  );
          $this->add_control(
				'related_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'streamvid' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '',
					'condition' => [
						'post_related'  => 'yes',
					],
				]
		  ); 
          $this->add_control(
			'ajax_page',
			[
				'label' => esc_html__( 'ajax_page', 'streamvid' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => '',
			]
		  );
          $this->add_control(
    				'post_nav_on',
    				[
    					'label'        => esc_html__( 'Enable Nav', 'streamvid' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
    					'label_off'    => esc_html__( 'No', 'streamvid' ),
    					'return_value' => 'yes',
    					'description'  => esc_html__( 'Enable nav filter post.', 'streamvid' ),
    				]
    	   );
           $this->add_control(
				'post_text_first',
				[
					'label'     => esc_html__( 'Nav Text All', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
                    'default' => 'ALL CATEGORIES',
                    'condition'	=> [
						'post_nav_on' => 'yes',
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
                'condition' => [
						'post_archive!' => [ 'yes' ],
                        'post_related!' => [ 'yes' ],
				],
			]
		);
        
        $this->add_control(
				'movies_advanced_per_page',
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
				]
			);

			$this->add_control(
				'category_filter_rule',
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
					],
				]
			);
			$this->add_control(
				'category_filter',
				[
					'label'     => esc_html__( 'Select Categories', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_movies_advanced_categories(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
            
            
			$this->add_control(
				'tag_filter_rule',
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
					],
				]
			);
			$this->add_control(
				'tag_filter',
				[
					'label'     => esc_html__( 'Select Tags', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_movies_advanced_tags(),
					'condition' => [
						'query_type' => 'custom',
					],
				]
			);
			$this->add_control(
				'offset',
				[
					'label'       => esc_html__( 'Offset', 'streamvid' ),
					'type'        => Controls_Manager::NUMBER,
					'default'     => 0,
					'description' => esc_html__( 'Number of post to displace or pass over.', 'streamvid' ),
					'condition'   => [
						'query_type' => 'custom',
					],
				]
			);

			$this->add_control(
				'query_manual_ids',
				[
					'label'     => esc_html__( 'Select posts', 'streamvid' ),
					'type'      => 'jws-query-posts',
					'post_type' => 'movies',
					'multiple'  => true,
					'condition' => [
						'query_type' => 'manual',
					],
				]
			);

			/* Exclude */
			$this->add_control(
				'query_exclude',
				[
					'label'     => esc_html__( 'Exclude', 'streamvid' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition' => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_ids',
				[
					'label'       => esc_html__( 'Select posts', 'streamvid' ),
					'type'        => 'jws-query-posts',
					'post_type'   => 'movies',
					'multiple'    => true,
					'description' => esc_html__( 'Select posts to exclude from the query.', 'streamvid' ),
					'condition'   => [
						'query_type!' => [ 'manual', 'main' ],
					],
				]
			);
			$this->add_control(
				'query_exclude_current',
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
					],
				]
			);

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
                        'comment_count' => esc_html__( 'Number Review', 'streamvid' ),
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
    
   
	/**
	 * Register grid Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_grid_controls() {
		$this->start_controls_section(
			'section_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'streamvid' ),
				'type'      => Controls_Manager::SECTION,
			]
		);
		$this->add_responsive_control(
				'movies_advanced_columns',
				[
					'label'          => esc_html__( 'Columns', 'streamvid' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '4',
					'options'        => [
						'12' => '1',
						'6' => '2',
						'4' => '3',
						'3' => '4',
						'20' => '5',
						'2' => '6',
					],
				]
			);
		$this->end_controls_section();
	}
      /**
	 * Register Pagination Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_pagination_controls() {

		$this->start_controls_section(
			'section_pagination_field',
			[
				'label'     => esc_html__( 'Pagination', 'streamvid' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'movies_advanced_display' => ['grid'],
				],
			]
		);
         $this->add_control(
				'pagination_align',
				[
					'label' 		=> esc_html__( 'Align', 'streamvid' ),
					'type' 			=> Controls_Manager::CHOOSE,
					'options' 		=> [
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
                    'selectors' => [
							'{{WRAPPER}} .jws-pagination-number ul ,{{WRAPPER}} .jws_pagination ' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);
		$this->add_control(
				'pagination_type',
				[
					'label'     => esc_html__( 'Type', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '',
					'options'   => [
						''              => esc_html__( 'None', 'streamvid' ),
                        'load_more' => esc_html__( 'Load More', 'streamvid' ),
                        'pagination-number' => esc_html__( 'Number Pagination', 'streamvid' ),
					],
				]
		);
        $this->add_control(
				'pagination_loadmore_label',
				[
					'label'     => esc_html__( 'Loadmore Label', 'streamvid' ),
					'default'   => esc_html__( 'Load more posts', 'streamvid' ),
					'condition' => [
						'pagination_type'      => ['load_more'],
					],
				]
		);
		$this->end_controls_section();
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
        

        $this->add_control(
    				'enable_dots',
    				[
    					'label'        => esc_html__( 'Enable Dots', 'streamvid' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
    					'label_off'    => esc_html__( 'No', 'streamvid' ),
    					'return_value' => 'yes',
    					'default'      => '',
    					'description'  => esc_html__( 'Enable dot.', 'streamvid' ),
    				]
    	);

    
        $this->end_controls_section();  
        
       
		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => esc_html__( 'Slider Options', 'streamvid' ),
				'type'      => Controls_Manager::SECTION,
				'condition' => [
					'movies_advanced_display' => ['slider'],
				],
			]
		);

		$this->add_responsive_control(
			'slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'streamvid' ),
				'type'           => Controls_Manager::NUMBER,
                'condition'    => [
					'variablewidth!'             => 'yes',
				],
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
        
        $this->add_control(
			'variablewidth',
			[
				'label'        => esc_html__( 'variable Width', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
                'default' => 'yes'

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
					'size' => 288,
				],
				'selectors' => [
					'{{WRAPPER}} .post-inner' => 'width: {{SIZE}}px;',
				],
                'condition'    => [
					'variablewidth'             => 'yes',
				],
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
			'box_style',
			[
				'label' => esc_html__( 'Box', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'column_gap',
			[
				'label'     => esc_html__( 'Columns Gap', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-post-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .movies_advanced_content.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'     => esc_html__( 'Rows Gap', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
			'align',
			[
				'label' => esc_html__( 'Alignment', 'streamvid' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'streamvid' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'streamvid' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'streamvid' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws-post-item' => 'text-align: {{VALUE}};',
				],
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
					'{{WRAPPER}} .video_title a' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .video_title a:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .video_title',
			]
		);

        $this->add_responsive_control(
					'title_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .video_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'excerpt_color',
			[
				'label' => esc_html__( 'Excerpt Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_excerpt' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'excerpt_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_excerpt',
			]
		);
        $this->add_responsive_control(
					'excerpt_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        
        
        $this->start_controls_section(
			'date_style',
			[
				'label' => esc_html__( 'Date', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_date',
			[
				'label' => esc_html__( 'Show Date', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'streamvid' ),
				'label_off' => esc_html__( 'Hide', 'streamvid' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'date_color',
			[
				'label' => esc_html__( 'Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-movies_advanced-element .post-inner .entry-date a' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .jws-movies_advanced-element .post-inner .entry-date',
			]
		);
        $this->add_responsive_control(
					'date_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-movies_advanced-element .post-inner .entry-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
					]
		);
        $this->end_controls_section();
        
        
        $this->start_controls_section(
			'readmore_style',
			[
				'label' => esc_html__( 'Read More', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
			'show_readmore',
			[
				'label' => esc_html__( 'Show Readmore', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'streamvid' ),
				'label_off' => esc_html__( 'Hide', 'streamvid' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			're_color',
			[
				'label' => esc_html__( 'Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_content .jws_post_readmore' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			're_color_hover',
			[
				'label' => esc_html__( 'Color Hover', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
				'selectors' => [
					'{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_content .jws_post_readmore:hover' => 'color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'readmore_typography',
				'label' => esc_html__( 'Typography', 'streamvid' ),
				'selector' => '{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_content .jws_post_readmore',
			]
		);
        $this->add_responsive_control(
					'readmore_margin',
					[
						'label' 		=> esc_html__( 'Margin', 'streamvid' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .jws-movies_advanced-element .post-inner .jws_post_content .jws_post_readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],

						'separator' => 'before',
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
	protected function get_movies_advanced_categories() {

		$movies_advanced_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$movies_advanced_categories = get_terms( 'movies_cat', $cat_args );

		if ( ! empty( $movies_advanced_categories ) ) {

			foreach ( $movies_advanced_categories as $key => $category ) {
				$movies_advanced_cat[ $category->term_id ] = $category->name;
			}
		}

		return $movies_advanced_cat;
	}
    /**
	 * Get WooCommerce post Tags.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function get_movies_advanced_tags() {

		$movies_advanced_return = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$movies_advanced_tag = get_terms( 'movies_tag', $tag_args );

		if ( ! empty( $movies_advanced_tag ) ) {

			foreach ( $movies_advanced_tag as $key => $tag ) {

				$movies_advanced_return[ $tag->term_id ] = $tag->name;
			}
		}

		return $movies_advanced_return;
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

			$query_args = [
				'post_type'      => 'movies',
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
            
            
		    if ( $settings['movies_advanced_per_page'] > 0 ) {
				$query_args['posts_per_page'] = $settings['movies_advanced_per_page'];
			}
			if ( '' !== $settings['pagination_type'] ) {

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : '1';


					$query_args['paged'] = $paged;
                    
			}


			if ( 'custom' === $settings['query_type'] ) {

				if ( ! empty( $settings['category_filter'] ) ) {

					$cat_operator = $settings['category_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'movies_cat',
						'field'    => 'id',
						'terms'    => $settings['category_filter'],
						'operator' => $cat_operator,
					];
				}

				if ( ! empty( $settings['tag_filter'] ) ) {

					$tag_operator = $settings['tag_filter_rule'];

					$query_args['tax_query'][] = [
						'taxonomy' => 'movies_tag',
						'field'    => 'id',
						'terms'    => $settings['tag_filter'],
						'operator' => $tag_operator,
					];
				}

				if ( 0 < $settings['offset'] ) {

					/**
					 * Offset break the pagination. Using WordPress's work around
					 *
					 * @see https://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
					 */
					$query_args['offset_to_fix'] = $settings['offset'];
				}
			}

			if ( 'manual' === $settings['query_type'] ) {

				$manual_ids = $settings['query_manual_ids'];

				$query_args['post__in'] = $manual_ids;
			}

			if ( 'manual' !== $settings['query_type'] && 'main' !== $settings['query_type'] ) {

				if ( '' !== $settings['query_exclude_ids'] ) {

					$exclude_ids = $settings['query_exclude_ids'];

					$query_args['post__not_in'] = $exclude_ids;
				}

				if ( 'yes' === $settings['query_exclude_current'] && isset($post->ID) ) {

					$query_args['post__not_in'][] = $post->ID;
				}
			}


			$movies_advanced = new \WP_Query( $query_args );

      $class_row = 'row movies_advanced_content';  
      $class_row .= ' '.$settings['movies_advanced_layouts'].'';
      $class_row .= ' movies_advanced_ajax_'.$this->get_id().''; 
      if ( $movies_advanced->max_num_pages > 1) { $class_row.= ' jws_has_pagination'; }
      
      $class_column = 'jws-post-item';

      
      if($settings['movies_advanced_display'] == 'slider') {
            $class_row .= ' owl-carousel jws_movies_advanced_'.$settings['movies_advanced_display'].'';
            $class_column .= ' slider-item';
            $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
            $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
            $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
            $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
            $rtl = ($settings['rtl'] == 'yes') ? 'true' : 'false';
            
            $variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false'; 

            $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
            
            $center = ($settings['center'] == 'yes') ? 'true' : 'false';
                
            if($center ==  'true') {
                
                $class_row .= ' center-mode';
                
            }
             
            
            $carousel_responsive = jws_responsive_option_carousel($settings); 

 
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
                '.$carousel_responsive.'}\'';

       }else {
            $data_slick = '';
              $class_column .= ' col-xl-'.$settings['movies_advanced_columns'].'';
          $class_column .= (!empty($settings['movies_advanced_columns_tablet'])) ? ' col-lg-'.$settings['movies_advanced_columns_tablet'].'' : ' col-lg-'.$settings['movies_advanced_columns'].'' ;
          $class_column .= (!empty($settings['movies_advanced_columns_mobile'])) ? ' col-'.$settings['movies_advanced_columns_mobile'].'' :  ' col-'.$settings['movies_advanced_columns'].''; 
       }
 
       
       if($settings['enable_masonry'] == 'yes') {
            $class_row .= ' has-masonry';
       }
       
       if($settings['enable_animation'] == 'yes') {
            $class_row .= ' has-animation';
            $class_column .= ' jws-ani-item';
       }
       
       if($settings['post_related'] == 'yes' && !\Elementor\Plugin::$instance->editor->is_edit_mode()){
              
            $related_per_page = ( $settings['related_per_page'] > 0 ) ? $settings['related_per_page'] : 100;
    		
            $args = array( 
              'numberposts'		=> $related_per_page, // -1 is for all
              'post_type'		=> 'movies', // or 'post', 'page'
              'orderby' 		=> 'title', // or 'date', 'rand'
            
              'tax_query' => array(
                array(
                    'taxonomy' => 'movies_cat',
                    'field'    => 'term_id',
                    'terms'    =>wp_get_object_terms( $post->ID, 'movies_cat', array('fields' => 'ids') ),
                ),
             ),
              'post__not_in' => array($post->ID) 
            );
            $movies_advanced = new \WP_Query( $args );
           
        
        }
       
      $image_size_global = jws_theme_get_option('movies_imagesize');  
      $image_size = !empty($settings['movies_advanced_image_size']['width']) && !empty($settings['movies_advanced_image_size']['height']) ?  $settings['movies_advanced_image_size']['width'].'x'.$settings['movies_advanced_image_size']['height'] : $image_size_global;
    
       $args = array_merge( $settings, array(
            'image_size'    =>  $image_size
        ) ); 
     
      ?>
 
		
		<div class="jws-movies_advanced-element">
        
            <?php if($settings['post_related'] == 'yes' && $movies_advanced->have_posts()) echo '<h5 class="title-related">'.esc_html($settings['title_related']).'</h5>'; ?> 
            <div class="<?php echo esc_attr($class_row); ?>"  <?php echo ''.$data_slick; ?>>
                <?php 
                  
                    if($settings['post_archive'] == 'yes') {
                       if (have_posts()) {
                            while ( have_posts() ) :
                        			the_post();
                                  
                                        echo '<div class="'.$class_column.'">';

                                                get_template_part( 'template-parts/content/movies/layout/'.$settings['movies_advanced_layouts'].'' , '' ,$args ); 
            
                                        echo '</div>';
                            endwhile;    
                            wp_reset_postdata();      
                       }else{
                            get_template_part( 'template-parts/content/content', 'none' );
                       }
                    }else {
                      if ($movies_advanced->have_posts()) :
                            while ( $movies_advanced->have_posts() ) :
                        			$movies_advanced->the_post();
                                   
                                     echo '<div class="'.$class_column.'">';
                                              get_template_part( 'template-parts/content/movies/layout/'.$settings['movies_advanced_layouts'].'' , '' , $args ); 
                                      echo '</div>';  
                                           
                            endwhile;    
                            wp_reset_postdata();
                           
                       endif;  
                    }
                   
                ?>
            </div>
            
            <?php if(isset($arrows) && $arrows == 'true')

                global $wp_query;
                if($settings['post_archive'] == 'yes') { 
                   $number_page = $wp_query->max_num_pages;
                   $pagi_number = jws_query_pagination($wp_query);
                   $url = get_next_posts_page_link( $wp_query->max_num_pages );
                }else {
                   $number_page = $movies_advanced->max_num_pages;
                   $pagi_number = jws_query_pagination($movies_advanced);
                   $url = get_next_posts_page_link( $movies_advanced->max_num_pages ); 
                }

 
           ?>
            <?php if ( $number_page > 1 && $settings['pagination_type'] == 'load_more' ) {
                 $load_attr = 'data-ajaxify-options=\'{"wrapper":".movies_advanced_ajax_'.$this->get_id().'","items":"> .jws-post-item","trigger":"click"}\''; 
              
                ?>
                <div class="jws_pagination jws_ajax">
                    <?php if(!empty($url)) : ?>
                        <a class="jws-load-more btn-main button-default"  data-ajaxify="true"  href="<?php echo add_query_arg( 'ajaxify', '1', $url); ?>" <?php echo wp_kses_post($load_attr); ?>>
                            <span class="has-loading"><?php echo esc_html($settings['pagination_loadmore_label']); ?></span>
                           <span class="has-loaded"><?php echo esc_html__('All items loaded ','streamvid'); ?></span> 
                        </a>
                    <?php endif; ?>
                </div>
            <?php }elseif($number_page > 1 && $settings['pagination_type'] == 'pagination-number'){
                      echo ''.$pagi_number;   
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