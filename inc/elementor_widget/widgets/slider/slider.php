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
class Jws_Slider extends Widget_Base {

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
		return 'jws_slider';
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
		return esc_html__( 'Jws slider', 'streamvid' );
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
		return 'eicon-slides';
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
 
    public function get_tabs_list() { 
        
        global $jws_option;
        
        
        if(isset($jws_option['slider_category']) && !empty($jws_option['slider_category'])) {
          
    
      
            $tabsok = array();
            foreach (  $jws_option['slider_category'] as $index => $item_tabs ) { 
              $tabsok[ preg_replace('/[^a-zA-Z]+/', '', $item_tabs) ] = $item_tabs;     
           
            };  
            return $tabsok;
        }
        
    
    }
    /**
     * Load style
     */
    public function get_style_depends()
    {
        return [''];
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
        return [''];
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
				'label' => esc_html__( 'slider List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();
        
    
        
        $repeater->add_control(
				'select_template',
				[
					'label'       => esc_html__( 'Select Template.', 'streamvid' ),
					'type'        => 'jws-query-posts',
					'post_type'   => 'hf_template',
					'multiple'    => false,
					'description' => esc_html__( 'Select template for slide.', 'streamvid' ),
				]
			);
        
        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image For Thumbnail Nav' , 'streamvid' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
         $repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
 
         $repeater->add_control(
			'change_special',
			[
				'label'        => esc_html__( 'Change logo,color for this section', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
        
   
        $repeater->add_control(
			'menu_color',
			[
				'label' => esc_html__( 'Menu Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body{{CURRENT_ITEM}} .elementor_jws_menu_layout_menu_horizontal .jws_main_menu .jws_main_menu_inner>ul>li>a , body{{CURRENT_ITEM}} .jws_search.popup > button , body{{CURRENT_ITEM}} .jws-offcanvas-trigger .elementor-button-icon i' => 'color: {{VALUE}} !important',
				],
                'condition' => [
					'change_special'  => 'yes',
				],
			]
		);
        $repeater->add_control(
			'menu_color_2',
			[
				'label' => esc_html__( 'Menu Color Active (Hover)', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body{{CURRENT_ITEM}} .elementor_jws_menu_layout_menu_horizontal .jws_main_menu .jws_main_menu_inner>ul>li.current-menu-parent>a' => 'color: {{VALUE}} !important',
                    'body{{CURRENT_ITEM}} .elementor_jws_menu_layout_menu_horizontal .jws_main_menu .jws_main_menu_inner>ul>li>a:hover' => 'color: {{VALUE}} !important',
				],
                'condition' => [
					'change_special'  => 'yes',
				],
			]
		);
        $repeater->add_control(
			'main_color',
			[
				'label' => esc_html__( 'Main Color', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'body{{CURRENT_ITEM}} .elementor_jws_menu_layout_menu_horizontal.elementor-before-menu-skin-background_animation > .elementor-widget-container > .jws_main_menu > .jws_main_menu_inner > .nav > li > a:before' => 'background: {{VALUE}} !important',
				],
                'condition' => [
					'change_special'  => 'yes',
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
        
        $this->add_control(
    				'enable_thumbnail',
    				[
    					'label'        => esc_html__( 'Enable Thumbnail', 'streamvid' ),
    					'type'         => Controls_Manager::SWITCHER,
    					'label_on'     => esc_html__( 'Yes', 'streamvid' ),
    					'label_off'    => esc_html__( 'No', 'streamvid' ),
    					'return_value' => 'yes',
    					'default'      => 'no',
    					'description'  => esc_html__( 'Enable thumbnail navigation.', 'streamvid' ),
    				]
    	);
        
        $this->add_responsive_control(
			'nav_slides_to_show',
			[
				'label'          => esc_html__( 'posts to Show', 'streamvid' ),
				'type'           => Controls_Manager::NUMBER,
                'condition' => [
					'enable_thumbnail'             => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'nav_slides_to_scroll',
			[
				'label'          => esc_html__( 'posts to Scroll', 'streamvid' ),
				'type'           => Controls_Manager::NUMBER,
                'condition' => [
					'enable_thumbnail'             => 'yes',
				],
			]
		);
         $this->add_control(
			'dot_inside',
			[
				'label'        => esc_html__( 'Enable Dot Inside', 'streamvid' ),
				'type'         => Controls_Manager::SWITCHER,
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
        $this->add_responsive_control(
			'center_padding',
			[
				'label'     => esc_html__( 'Center Padding', 'streamvid' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => '',
				'condition' => [
					'center'             => 'yes',
				],
                'selectors' => [
					'{{WRAPPER}} .jws_slider_element .jws-nav-carousel > div.nav_left' => 'left: calc({{VALUE}} + 20px);',
                    '{{WRAPPER}} .jws_slider_element .jws-nav-carousel > div.nav_right' => 'right: calc({{VALUE}} + 20px);',
				],

			]
		);
        $this->add_control(
			'mousewheel',
			[
				'label'        => esc_html__( 'Mousewheel Mode', 'streamvid' ),
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
					'size' => 1100,
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
        
        $this->start_controls_section(
			'slides_style',
			[
				'label' => esc_html__( 'Slides', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
       
        
         $this->add_responsive_control(
			'slider_height',
			[
				'label' => esc_html__( 'Slider Height', 'streamvid' ),
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
					'{{WRAPPER}} .jws_slider_element .jws_slider .slider-item' => 'height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
  
        $this->end_controls_section();


	}
    
    public function get_saved_data(  ) {
        
      
      
        global $post;
        $posts = get_posts( array( 'post_type' => 'hf_template' , 'orderby'=> 'title' , 'order' => 'ASC' , 'posts_per_page' => -1  ) );
        if( $posts ){
           foreach( $posts as $post ) :   
           
           $options[$post->ID] = $post->post_title;
           
        endforeach; 
        wp_reset_postdata(); 
        }else {
           $options['no_template'] = esc_html__( 'It seems that, you have not saved any template yet.', 'streamvid' ); 
        }
  
		return $options;
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
    
        $class_row = 'jws_slider owl-carousel'; 

        $class_column .= ' slider-item'; 
        $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
        $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
        $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
        $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
        $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
    
        $fade = ($settings['fade'] == 'yes') ? 'true' : 'false';
        
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
            
        $vertical = ($settings['direction'] == 'vertical') ? 'true' : 'false';
        
        if($settings['mousewheel'] == 'yes') {
           $class_row .= ' slick_wheel'; 
        }
       
        
        $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '1';
        $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
        $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
        $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
        $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
        $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
        
        
        $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
        
        $nav_thumbnail = $settings['enable_thumbnail'] == 'yes' ? '"asNavFor":"#thumbnail-'.$this->get_id().'",' : '';
        
        if($settings['dot_inside'] == 'yes') {
           $class_row .= ' dot-inside'; 
        }
        

        
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
        
       


         ?>
         <div class="jws_slider_element">

            <div id="<?php echo 'slider-'.$this->get_id(); ?>" class="<?php echo esc_attr($class_row); ?>" <?php echo ''.$data_slick; ?>>
                
                    <?php foreach (  $settings['list'] as $index => $item ) {
        
                        if($item['change_special'] == 'yes') {
                           $special = ' special_section';  
                        }else {
                           $special = ''; 
                        }
                        
                        ?>
                        <div class="slider-item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?><?php echo esc_attr($class_column.$special); ?>" data-slider="elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>" data-index="<?php echo esc_attr($index); ?>">
                            <?php if(!empty($item['select_template']))  echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['select_template'] , true );   ?>
                        </div>
                     <?php } ?>
 
            </div>
            
            
            <?php
            
                if($settings['enable_thumbnail'] == 'yes') {
                    
                $settings['nav_slides_to_show'] = isset($settings['nav_slides_to_show']) && !empty($settings['nav_slides_to_show']) ? $settings['nav_slides_to_show'] : '4';
                $settings['nav_slides_to_show_tablet'] = isset($settings['nav_slides_to_show_tablet']) && !empty($settings['nav_slides_to_show_tablet']) ? $settings['nav_slides_to_show_tablet'] : $settings['nav_slides_to_show'];
                $settings['nav_slides_to_show_mobile'] = isset($settings['nav_slides_to_show_mobile']) && !empty($settings['nav_slides_to_show_mobile']) ? $settings['nav_slides_to_show_mobile'] : $settings['nav_slides_to_show'];
                $settings['nav_slides_to_scroll'] = isset($settings['nav_slides_to_scroll']) && !empty($settings['nav_slides_to_scroll']) ? $settings['nav_slides_to_scroll'] : '1';
                $settings['nav_slides_to_scroll_tablet'] = isset($settings['nav_slides_to_scroll_tablet']) && !empty($settings['nav_slides_to_scroll_tablet']) ? $settings['nav_slides_to_scroll_tablet'] : $settings['nav_slides_to_scroll'];
                $settings['nav_slides_to_scroll_mobile'] = isset($settings['nav_slides_to_scroll_mobile']) && !empty($settings['nav_slides_to_scroll_mobile']) ? $settings['nav_slides_to_scroll_mobile'] : $settings['nav_slides_to_scroll']; 
                
                
                $data_slick_nav = 'data-owl-option=\'{
                        "autoplay": '.$autoplay.',
                        "nav": false, 
                        "dots":false, 
                        "autoplayTimeout": '.$autoplay_speed.',
                        "autoplayHoverPause":'.$pause_on_hover.',
                        "center":'.$center.', 
                        "loop":false,
                        "autoWidth":'.$variablewidth.',
                        "smartSpeed": '.$settings['transition_speed'].', 
                        "responsive":{
                            "1024":{"items": '.$settings['nav_slides_to_show'].',"slideBy": '.$settings['nav_slides_to_scroll'].'},
                            "768":{"items": '.$settings['nav_slides_to_show_tablet'].',"slideBy": '.$settings['nav_slides_to_scroll_tablet'].'},
                            "0":{"items": '.$settings['nav_slides_to_show_mobile'].',"slideBy": '.$settings['nav_slides_to_scroll_mobile'].'}
                }}\'';
                

                    
                    echo '<div id="thumbnail-'.$this->get_id().'" class="thumbnail-nav owl-carousel" '.$data_slick_nav.'>';  
                    foreach (  $settings['list'] as $index => $item ) {
                        ?>
                        <div class="nav-item slider-item" data-index="<?php echo esc_attr($index); ?>">
                            <div><?php if(!empty($item['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $item );?></div>
                        </div>
                     <?php } 
                    echo '</div>'; 
                }
            
             if($settings['enable_dots_number'] == 'yes') {
              echo '<div class="jws-nav-carousel">
                <div class="jws-button-prev"></div><span class="jws-nav-pre"><span></span></span><div class="jws-button-next"></div>
               </div>'; 
             }
             ?> 
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