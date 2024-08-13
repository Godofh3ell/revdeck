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
class Jws_Top_Videos extends Widget_Base {

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
		return 'jws_top_videos';
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
		return esc_html__( 'Jws Top Videos', 'streamvid' );
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
				'top-videos_display',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'   => esc_html__( 'Grid', 'streamvid' ),
						'slider'   => esc_html__( 'Slider', 'streamvid' ),
					],
                    
				]
		);

        $this->add_control(
			'top-videos_layout',
			[
				'label' => esc_html__( 'Layout', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1'  => esc_html__( 'Layout 1', 'streamvid' ),
                    'layout2'  => esc_html__( 'Layout 2', 'streamvid' ),
                    'layout3'  => esc_html__( 'Layout 3', 'streamvid' ),
				],
			]
		);
 
        $this->add_responsive_control(
				'top-videos_columns',
				[
					'label'          => esc_html__( 'Columns', 'streamvid' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '12',
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
    
        $this->add_control(
    			'images_size',
    			[
    				'label' => __( 'Image Size', 'streamvid' ),
    				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
    				'description' => __( 'Image Size', 'streamvid' ),
    			]
    	);

        
        $this->end_controls_section(); 
    
	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'top-videos List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
				'top-videos_post_type',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'movies',
					'options'   => [
						'movies'   => esc_html__( 'Movies', 'streamvid' ),
						'tv_shows'   => esc_html__( 'Tv Shows', 'streamvid' ),
                        'videos'   => esc_html__( 'Videos', 'streamvid' ),
					],
                    
				]
		);
      
        $repeater->add_control(
				'videos_movies',
				[
					'label'     => esc_html__( 'Select Movies', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_all_top_videos('movies'),
                    'condition'	=> [
					   'top-videos_post_type' => 'movies',
				    ],
				]
		);
            
        $repeater->add_control(
				'videos_tv_shows',
				[
					'label'     => esc_html__( 'Select Tv Shows', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_all_top_videos('tv_shows'),
                    'condition'	=> [
					   'top-videos_post_type' => 'tv_shows',
				    ],
				]   
		);
        
        $repeater->add_control(
				'videos_videos',
				[
					'label'     => esc_html__( 'Select Tv Shows', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => false,
					'default'   => '',
					'options'   => $this->get_all_top_videos('videos'),
                    'condition'	=> [
					   'top-videos_post_type' => 'videos',
				    ],
				]   
		);
        
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
					'{{WRAPPER}} .top-videos-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
                    '{{WRAPPER}} .top-videos-content > div' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .top-videos-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
        
        $this->add_responsive_control(
			'height_left',
			[
				'label'     => esc_html__( 'Height Image Left', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .columns-left .top-videos-item img' => 'min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'height_right',
			[
				'label'     => esc_html__( 'Height Image right', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .columns-right .top-videos-item img' => 'min-height:{{SIZE}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();

       $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition'	=> [
					'top-videos_display' => 'slider',
				],
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
    					'default'      => 'yes',
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
					'top-videos_display' => ['slider'],
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
				'label'     => esc_html__( 'Add Width For Item Variable Width ', 'streamvid' ),
				'type'      => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 320,
				],
				'selectors' => [
					'{{WRAPPER}} .top-videos-inner' => 'width: {{SIZE}}px;',
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
        $class_column = 'top-videos-item';
           $class_row =  'top-videos-content row '.$settings['top-videos_layout'].'';
          
           
           $image_size = !empty($settings['images_size']['width']) && !empty($settings['images_size']['height']) ?  $settings['images_size']['width'].'x'.$settings['images_size']['height'] : 'full';
           
           
           if($settings['top-videos_display'] == 'slider') {
                $class_row .= ' owl-carousel '.$settings['top-videos_display'].'';
                $class_column .= ' slider-item';
                $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
                $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
                $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
                $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
                $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
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
               $class_column .= ' col-xl-'.$settings['top-videos_columns'].'';
               $class_column .= (!empty($settings['top-videos_columns_tablet'])) ? ' col-lg-'.$settings['top-videos_columns_tablet'].'' : ' col-lg-'.$settings['top-videos_columns'].'' ;
               $class_column .= (!empty($settings['top-videos_columns_mobile'])) ? ' col-'.$settings['top-videos_columns_mobile'].'' :  ' col-'.$settings['top-videos_columns'].''; 
           }
        ?>
         <div class="jws-top-videos-tabs-element">
   
             <div class="<?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?>>
             
                    <?php 
                    
                     foreach (  $settings['list'] as $index => $item ) {  
                        $key = 'videos_'.$item['top-videos_post_type'];
                        $id = $item[$key];
                        
                        ?>
                            <div class="<?php echo esc_attr($class_column); ?>">
                                    <?php include( 'layout/'.$settings['top-videos_layout'].'.php' ); ?>
                             </div>
                        <?php
                        
                     };
               
                    ?>
                            
                                
                              
                      
           
            </div>
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