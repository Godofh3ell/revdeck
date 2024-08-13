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
class Jws_Playlist_Trailer extends Widget_Base {

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
		return 'jws_playlist_trailer';
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
		return esc_html__( 'Jws Playlist Trailer', 'streamvid' );
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
        return ['slick'];
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
        return ['slick'];
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
			'setting_section_list',
			[
				'label' => esc_html__( 'Video List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image Trailer', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
       
        $repeater->add_control(
			'video_url',
			[
				'label' => esc_html__( 'Link', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'https://your-link.com', 'streamvid' ),
				'show_external' => true,
				'default' => '#'
			]
		);
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Video List', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'streamvid' ),
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
    					'default'      => 'yes',
    					'description'  => esc_html__( 'Enable dot.', 'streamvid' ),
    				]
    	);

        $this->add_control(
			'dots_color',
			[
				'label' => esc_html__( 'Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_playlist_trailer_element .jws_playlist_trailer .flickity-page-dots li.is-selected' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .jws_playlist_trailer_element .jws_playlist_trailer .flickity-page-dots li:before' => 'background: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();  
        
      $this->start_controls_section(
			'setting_arrow',
			[
				'label' => esc_html__( 'Arrow Navigation', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
					'enable_nav'             => 'yes',
				],
			]
		);
  
        
        $this->add_control(
			'arrow_color',
			[
				'label' => esc_html__( 'Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_playlist_trailer_element .jws-nav-carousel > div' => '--arrow_color: {{VALUE}}',
				],
			]
		);
        
        $this->add_control(
			'arrow_bd_color',
			[
				'label' => esc_html__( 'Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws_playlist_trailer_element .jws-nav-carousel > div' => '--arrow_border_color: {{VALUE}}',
				],
			]
		);
        
           
         $this->add_responsive_control(
			'arrow_vertical',
			[
				'label' => esc_html__( 'Vertical Position', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .jws_playlist_trailer_element .jws-nav-carousel > div' => 'top: {{SIZE}}{{UNIT}};',
				],
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
			'direction',
			[
				'label'     => esc_html__( 'Direction', 'streamvid' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
                    'horizontal' => esc_html__( 'Horizontal', 'streamvid' ),
					'vertical' => esc_html__( 'Vertical', 'streamvid' ),
				],
                'default'        => 'horizontal',
			]
		);
        $this->add_control(
			'fade',
			[
				'label'        => esc_html__( 'Fade Mode', 'streamvid' ),
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
			'slides_style',
			[
				'label' => esc_html__( 'Slides', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
       
        
         $this->add_responsive_control(
			'playlist_trailer_height',
			[
				'label' => esc_html__( 'Slider Min Height', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' , 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 500,
				],
				'selectors' => [
					'{{WRAPPER}} .jws_playlist_trailer_element .jws_playlist_trailer .video-background img' => 'min-height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
  
        $this->end_controls_section();


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
    
         $class_column = '';
    
         $class_row = 'jws_playlist_trailer'; 


        $class_column .= ' playlist_trailer-item slick-slide'; 
        $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
        $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
        $variableWidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false';
        $fade = ($settings['fade'] == 'yes') ? 'true' : 'false';
        
        $center = ($settings['center'] == 'yes') ? 'true' : 'false';
        
        $vertical = ($settings['direction'] == 'vertical') ? 'true' : 'false';

        
        $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '1';
        $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
        $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
        $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
        $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
        $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
        
        
        $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';

        $data_slick = 'data-slick=\'{
        "slidesToShow":'.$settings['slides_to_show'].' ,
        "slidesToScroll": '.$settings['slides_to_scroll'].', 
        "autoplay": '.$autoplay.',
        "arrows": '.$arrows.', 
        "dots":'.$dots.', 
        "autoplaySpeed": '.$autoplay_speed.',
        "variableWidth":'.$variableWidth.',
        "pauseOnHover":'.$pause_on_hover.',
        "centerMode":'.$center.', 
        "infinite":'.$infinite.',
        "fade":'.$fade.',
        "vertical":'.$vertical.',
        "speed": '.$settings['transition_speed'].', 
        "responsive":[
            {"breakpoint": 1024,"settings":{"slidesToShow": '.$settings['slides_to_show_tablet'].',"slidesToScroll": '.$settings['slides_to_scroll_tablet'].'}},
            {"breakpoint": 768,"settings":{"slidesToShow": '.$settings['slides_to_show_mobile'].',"slidesToScroll": '.$settings['slides_to_scroll_mobile'].'}}
        ]}\''; 
        
        $data_slick_nav = 'data-slick=\'{
        "slidesToShow":4 ,
        "slidesToScroll": 1, 
        "autoplay": '.$autoplay.',
        "arrows": true, 
        "dots":false, 
        "infinite":'.$infinite.',
        "vertical":true,
        "verticalSwiping":true,
        "speed": '.$settings['transition_speed'].', 
        "responsive":[
            {"breakpoint": 1024,"settings":{"slidesToShow": 4,"slidesToScroll": 1}},
            {"breakpoint": 768,"settings":{"slidesToShow":4,"slidesToScroll":1,"vertical":false}}
        ]}\'';

        $image_size = (!empty($settings['images_size']['width']) || !empty($settings['images_size']['height'])) ? $settings['images_size']['width'].'x'.$settings['images_size']['height'] : 'full';
        
         ?>
         <div class="jws_playlist_trailer_element jws-carousel">

            <div class="<?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?>>
                
                    <?php foreach (  $settings['list'] as $index => $item ) {
                        
                        ?>
                        <div class="<?php echo esc_attr($class_column); ?>">

                           <?php 
                                $attach_id = $item['image']['id'];
                     
                           ?>  
                           <div class="video-background">
                                <?php echo jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size)); ?>
                                <a class="view-video video-trailer" href="<?php echo esc_attr($item['video_url']); ?>">
                                    <i class="jws-icon-film"></i>
                                    <span><?php echo esc_html__('Watch Trailer!','streamvid'); ?></span>
                                </a>
                           </div>
   
                        </div>
                     <?php } ?>
                   
             <?php 
                if($settings['enable_dots'] == 'yes') {echo '<div class="playlist_trailer-dots-box"></div> ';}
                if($settings['enable_nav'] == 'yes') {
                 
                  echo '<div class="nav_left jws-icon-glyph"></div><div class="nav_right jws-icon-glyph-1"></div>';
                    
                }
             ?>        
                  
            </div>
            <div class="playlist-nav" <?php echo ''.$data_slick_nav; ?>>
                <?php foreach (  $settings['list'] as $index => $item ) {
            
                   $attach_id = $item['image']['id'];

                   ?>  
                   <div class="nav-item">
                        <?php
                            echo jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => '147x94'));
                         ?>
                   </div>
   
                 <?php }
                 echo '<div class="jws-nav-carousel"><div class="nav_prev jws-icon-caret-down"></div><div class="nav_next jws-icon-caret-down"></div></div>';
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