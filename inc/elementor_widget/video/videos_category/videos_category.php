<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

/**
 * jwsProductAdvanced
 *
 * @author jwsSoft <hello.jwssoft@gmail.com>
 * @package jws
 */

final class Jws_Videos_Cat extends Widget_Base
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'jws-videos-category';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return esc_html__('Jws Videos Category List', 'streamvid');
        }

        /**
         * @return string
         */
        function get_icon()
        {
            return 'eicon-product-categories';
        }
        /**
         * @return array
         */
        public function get_categories()
        {
            return ['jws-elements'];
        }
        /**
         * Register controls
         */
        protected function register_controls()
        {
            
           
            $this->start_controls_section(
                'section_options', [
                'label' => esc_html__('Options', 'streamvid')
            ]);
            $this->add_responsive_control('post_type', [
                'label' => esc_html__('Post Type', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'videos_cat',
                'options' => [
                    'videos_cat' => esc_html__('Videos', 'streamvid'),
                    'movies_cat' => esc_html__('Movies', 'streamvid'),
                    'tv_shows_cat' => esc_html__('Tv Shows', 'streamvid'),
                ],

            ]);
            // Grid
            $this->add_responsive_control('display', [
                'label' => esc_html__('Display', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'streamvid'),
                    'slider' => esc_html__('Slider', 'streamvid'),
                    'slider2' => esc_html__('Slider 2', 'streamvid'),
                ],

            ]);
            
            $this->add_control(
				'videos_category_layouts',
				[
					'label'     => esc_html__( 'Layout', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'Layout 1', 'streamvid' ),
						'layout2'   => esc_html__( 'Layout 2', 'streamvid' ),
                        'layout3'   => esc_html__( 'Layout 3', 'streamvid' ),
					],
                    
				]
			);
            
            $this->add_control(
    			'image_size',
    			[
    				'label' => esc_html__( 'Image Size', 'streamvid' ),
    				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
    				'default' => [
    					'width' => '',
    					'height' => '',
    				],
    			]
    		  );
          
          
            $this->add_responsive_control('query', [
                'label' => esc_html__('Query', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('All', 'streamvid'),
                    'custom' => esc_html__('Custom', 'streamvid'),
                ],

            ]);
            //Cate
            $this->add_control('filter_categories', [
                'label' => esc_html__('Categories', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_jws('videos_cat', 2),
                'condition' => [
				     'query'  => 'custom',
				],
            ]);
            
            $this->add_control(
				'post_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'streamvid' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '8',
					'condition' => [
						'query'  => 'all',
					],
				]
			);
            
            $this->add_control(
    			'hide_empty',
    			[
    				'label'        => esc_html__( 'Hide Empty', 'streamvid' ),
    				'type'         => Controls_Manager::SWITCHER,
    				'return_value' => 'yes',
    				'default'      => '',
    			]
    		);

            $this->add_control('orderby', [
                'label' => esc_html__('Order by', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => $this->get_woo_order_by_for_jws(),
            ]);
            $this->add_control('order', [
                'label' => esc_html__('Order', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => $this->get_woo_order_for_jws(),
            ]);
            
            // Grid
            $this->add_responsive_control('columns', [
                'label' => esc_html__('Columns for row', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => '20',
                'options' => [
                    '1' => esc_html__('12', 'streamvid'),
                    '2' => esc_html__('6', 'streamvid'),
                    '3' => esc_html__('4', 'streamvid'),
                    '4' => esc_html__('3', 'streamvid'),
                    '6' => esc_html__('2', 'streamvid'),
                    '12' => esc_html__('1', 'streamvid'),
                    '20' => esc_html__('5', 'streamvid'),
                    '2' => esc_html__('6', 'streamvid'),
                ],

            ]);
            $this->end_controls_section();
            
            $this->start_controls_section(
                'normal_style_settings', [
                'label' => esc_html__('Style', 'streamvid'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            
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
    					'{{WRAPPER}} .category-tab-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
    					'{{WRAPPER}} .jws-videocat.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
    					'{{WRAPPER}} .category-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
    				],
    			]
    		);
      
       
       $this->end_controls_section();
       
       
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
					'size' => 206,
				],
				'selectors' => [
					'{{WRAPPER}} .slider-item' => 'width: {{SIZE}}px;',
				],
                'condition'    => [
					'variablewidth'             => 'yes',
				],
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
 
        }

        /**
         * Load style
         */
        public function get_style_depends()
        {
            return ['jws-style'];
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
            return ['jws-script'];
        }
        protected function get_categories_for_jws($taxonomy, $select = 1)
        {
            $data = array();
    
            $query = new \WP_Term_Query(array(
                'hide_empty' => false,
                'taxonomy'   => $taxonomy,
            ));
            if ($select == 1) {
                $data['all'] = 'All';
            }
    
            if (! empty($query->terms)) {
                foreach ($query->terms as $cat) {
                    $data[ $cat->term_id ] = $cat->name;
                }
            }
    
            return $data;
        }

        protected function get_list_posts($post_type = 'post')
        {
            $args = array(
                'post_type'        => $post_type,
                'suppress_filters' => true,
                'posts_per_page'   => 300,
                'no_found_rows'    => true,
            );
    
            $the_query = new \WP_Query($args);
            $results   = [];
    
            if (is_array($the_query->posts) && count($the_query->posts)) {
                foreach ($the_query->posts as $post) {
                    $results[ $post->ID ] = sanitize_text_field($post->post_title);
                }
            }
    
            return $results;
        }
            /**
     * Get oder by
     *
     * @return array oder_by
     */
    protected function get_woo_order_by_for_jws()
    {
        $order_by = array(
            'name'       => esc_html__('Name', 'streamvid'),
            'count' => esc_html__('Count', 'streamvid'),
        );

        return $order_by;
    }

    /**
     * Get oder
     *
     * @return array order
     */
    protected function get_woo_order_for_jws()
    {
        $order = array(
            'desc' => esc_html__('DESC', 'streamvid'),
            'asc'  => esc_html__('ASC', 'streamvid'),
        );

        return $order;
    }
        /**
         * Render
         */
        protected function render()
        {
            $settings = $this->get_settings_for_display();
            $this->add_inline_editing_attributes('title');

            $this->add_render_attribute('title', 'class', 'jws-title');

            include 'content.php';
       
        }
    }
