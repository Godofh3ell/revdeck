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
class Jws_Tv_Shows_Tabs extends Widget_Base {

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
		return 'jws_tv_shows_tabs';
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
		return esc_html__( 'Jws Tv Shows Tabs', 'streamvid' );
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
				'tv_shows_tabs_display',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'   => esc_html__( 'Grid', 'streamvid' ),
                        'metro'   => esc_html__( 'Metro', 'streamvid' ),
						'slider'   => esc_html__( 'Slider', 'streamvid' ),
					],
                    
				]
		);

        $this->add_control(
			'tv_shows_tabs_layout',
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
				'tv_shows_tabs_columns',
				[
					'label'          => esc_html__( 'Columns', 'streamvid' ),
					'type'           => Controls_Manager::SELECT,
					'default'        => '3',
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
				'label' => esc_html__( 'Videos List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
				'tabs_title',
				[
					'label'     => esc_html__( 'Tabs Title', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'Tab 1',
				]
		);
  
        $repeater->add_control(
				'tabs_tv_shows',
				[
					'label'     => esc_html__( 'Select tv_shows', 'streamvid' ),
					'type'      => Controls_Manager::SELECT2,
					'multiple'  => true,
					'default'   => '',
					'options'   => $this->get_all_tv_shows(),
                    'select2options' => [
                         'sortable' => true
                      ]
				]
		);
 
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tabs_title }}}',
			]
		);
        $this->end_controls_section();
        
        	$this->start_controls_section(
			'section_filter_field',
			[
				'label' => esc_html__( 'Query', 'streamvid' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
            
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
                    '{{WRAPPER}} .tv_shows-content.metro > div' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-post-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .columns-left .jws-post-item .post-inner' => 'height:{{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .columns-right .jws-post-item .post-inner' => 'height:{{SIZE}}{{UNIT}};',
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
        
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title', 'streamvid' ),
				'selector' => '{{WRAPPER}} .post-inner .title',
			]
		);
        
        $this->end_controls_section();
        
        

               
        $this->start_controls_section(
			'setting_navigation',
			[
				'label' => esc_html__( 'Setting Navigation', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition'	=> [
					'tv_shows_tabs_display' => 'slider',
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
					'tv_shows_tabs_display' => ['slider'],
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
                'default'      => 'yes',
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
					'size' => 335,
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
	protected function get_all_tv_shows() {
	   
        
        $args = array(
           'post_type' => 'tv_shows',
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
  
        
        $class_column = 'jws-post-item';  
        $class_row = 'tv_shows-content row';
        $class_row .= ' '.$settings['tv_shows_tabs_layout'].' '.$settings['tv_shows_tabs_display'];
      if($settings['tv_shows_tabs_display'] == 'slider') {
            $class_row .= ' owl-carousel';
            $class_column .= ' slider-item';
            $dots = ($settings['enable_dots'] == 'yes') ? 'true' : 'false';
            $arrows = ($settings['enable_nav'] == 'yes') ? 'true' : 'false';
            $autoplay = ($settings['autoplay'] == 'yes') ? 'true' : 'false';
            $pause_on_hover = ($settings['pause_on_hover'] == 'yes') ? 'true' : 'false';
            $infinite = ($settings['infinite'] == 'yes') ? 'true' : 'false';
        
            $variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false';    
            $settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '3';

            $settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
            $settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show'];
            
            if($variablewidth == 'true') {
               $settings['slides_to_show']  = $settings['slides_to_show_tablet'] = $settings['slides_to_show_mobile'] = '1';
            }
            
            $settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
            
            $settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
            $settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 
            
            
            $autoplay_speed = ($settings['autoplay_speed']) ? $settings['autoplay_speed'] : '0';
            

            $data_slick = 'data-owl-option=\'{
                "autoplay": '.$autoplay.',
                "nav": '.$arrows.', 
                "dots":'.$dots.', 
                "autoplayTimeout": '.$autoplay_speed.',
                "autoplayHoverPause":'.$pause_on_hover.',
                "loop":'.$infinite.',
                "autoWidth":'.$variablewidth.',
                "smartSpeed": '.$settings['transition_speed'].', 
                "responsive":{
                    "1024":{"items": '.$settings['slides_to_show'].',"slideBy": '.$settings['slides_to_scroll'].'},
                    "768":{"items": '.$settings['slides_to_show_tablet'].',"slideBy": '.$settings['slides_to_scroll_tablet'].'},
                    "0":{"items": '.$settings['slides_to_show_mobile'].',"slideBy": '.$settings['slides_to_scroll_mobile'].'}
            }}\'';
       }else {
          $data_slick = '';
          $class_column .= ' col-xl-'.$settings['tv_shows_tabs_columns'].'';
          $class_column .= (!empty($settings['tv_shows_tabs_columns_tablet'])) ? ' col-lg-'.$settings['tv_shows_tabs_columns_tablet'].'' : ' col-lg-'.$settings['tv_shows_tabs_columns'].'' ;
          $class_column .= (!empty($settings['tv_shows_tabs_columns_mobile'])) ? ' col-'.$settings['tv_shows_tabs_columns_mobile'].'' :  ' col-'.$settings['tv_shows_tabs_columns'].''; 
       }  
       $image_size_global = jws_theme_get_option('tv_shows_imagesize');  
       $image_size = !empty($settings['images_size']['width']) && !empty($settings['images_size']['height']) ?  $settings['images_size']['width'].'x'.$settings['images_size']['height'] : $image_size_global;
       $args = array(
            'image_size'    =>  $image_size
       ) ;
       
       
       $filter_arr = array(
            'orderby'            => $settings['orderby'],
            'order'           => $settings['order'],
            'tv_shows_tabs_display'           => $settings['tv_shows_tabs_display'],
            'tv_shows_tabs_layout' => $settings['tv_shows_tabs_layout'],
            'tv_shows_tabs_columns' => $settings['tv_shows_tabs_columns'],
            'images_size' => $settings['images_size']
        );
        
        ?>
         <div class="jws-tv_shows-tabs-element jws-tv-shows-advanced-element">
            <div class="tv_shows-nav" data-args='<?php echo json_encode($filter_arr); ?>'>
            <?php 
                foreach (  $settings['list'] as $index => $item ) {  
                    $active = $index == 0 ? 'active' : '';
                    $id_data = !empty($item['tabs_tv_shows']) ? 'data-id=\''.json_encode($item['tabs_tv_shows'],true).'\'' : '';
                    echo '<div><a class="'.$active.'" href="#" '.$id_data.'>'.$item['tabs_title'].'</a></div>';
                    
                }
             ?>
             </div>
             <div class="<?php echo esc_attr($class_row); ?>" <?php echo  ''.$data_slick; ?>>
             
             <?php   
                foreach (  $settings['list'] as $index => $item ) { 
                    
                      if($index == 0) {
                         $query_args = [
                			'post_type'      => 'tv_shows',
                			'post_status'    => 'publish',
                			'posts_per_page' => -1,
                			'paged'          => 1,
                			'post__not_in'   => array(),
                		];
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
                        
                        
                        $manual_ids = $item['tabs_tv_shows'];
                		$query_args['post__in'] = $manual_ids; 
                    
                  
                        $posts = get_posts( $query_args );
                        if($settings['tv_shows_tabs_display'] == 'metro') { 
                                
                                $i = 1;
                                foreach ( $posts as $post ) {
                                $args['post_id'] = $post->ID;   
                                if($i == 1) {
                                    ?>
                                    <div class="col-xl-5 col-lg-6 hidden_mobile hidden_tablet columns-left">
                                        <div class="row">
                                            <div class="jws-post-item col-xl-12">
                                                <?php get_template_part( 'template-parts/content/tv_shows/layout/'.$settings['tv_shows_tabs_layout'].'' , '' , $args );  ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                } 
                                $i++; }
                                
                                ?>
                                    <div class="col-xl-7 col-lg-12 columns-right">
                                        <div class="row">
                                        <?php
                                           
                                            foreach ( $posts as $post ) {
                                            $args['post_id'] = $post->ID; 
                                           
                                                ?>
                                                    <div class="jws-post-item col-xl-4 col-lg-4 col-6">
                                                        <?php  get_template_part( 'template-parts/content/tv_shows/layout/'.$settings['tv_shows_tabs_layout'].'' , '' , $args );  ?>
                                                    </div>
                                                <?php
                                         
                                            }
                                        ?>
                                        </div>
                                    </div>
                                <?php  
                                
                        }  else {
                            foreach ( $posts as $post ) {
                                    $args['post_id'] = $post->ID; 
                                    ?>
                                        <div class="<?php echo esc_attr($class_column); ?>">
                                            <?php  get_template_part( 'template-parts/content/tv_shows/layout/'.$settings['tv_shows_tabs_layout'].'' , '' , $args );  ?>
                                        </div>
                                    <?php
                                
                            }
                        }
                    
                      }  
                         
                 
                    
                }
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