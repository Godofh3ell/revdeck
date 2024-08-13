<?php
namespace Elementor;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Jws_Banner extends Widget_Base {

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
		return 'jws_banner';
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
		return esc_html__( 'Jws banner', 'streamvid' );
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
		return 'eicon-banner';
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
				'banner_layout',
				[
					'label'     => esc_html__( 'Layout', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'layout1',
					'options'   => [
						'layout1'   => esc_html__( 'layout1', 'streamvid' ),

					],
                    
				]
		);
        $this->add_control(
				'banner_display',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'   => esc_html__( 'Grid', 'streamvid' ),
					],
                    
				]
		);

        $this->add_responsive_control(
				'banner_columns',
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
			'banner_position',
			[
				'label'       => esc_html__( 'Position', 'streamvid' ),
				'type'        => Controls_Manager::CHOOSE,
				'default'     => 'at-center',
				'options'     => [
                    'at-center'  => [
						'title' => esc_html__( 'Center', 'streamvid' ),
						'icon'  => 'fa fa-align-center',
					],
                    'at-top' => [
						'title' => esc_html__( 'Top', 'streamvid' ),
						'icon'  => 'fa fa-arrow-up',
					],
                    'at-bottom' => [
						'title' => esc_html__( 'Bottom', 'streamvid' ),
						'icon'  => 'fa fa-arrow-down',
					],
				],
				'label_block' => false,
				'toggle'      => false,
                'prefix_class' => 'jws-content-align-',
                
			]
		);
        
      $this->add_control(
				'banner_align',
				[
					'label' 		=> esc_html__( 'Content Align', 'streamvid' ),
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
							'{{WRAPPER}} .jws-banner .jws-banner-content' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
				]
		);

        $this->end_controls_section();   
	    $this->start_controls_section(
			'setting_section_list',
			[
				'label' => esc_html__( 'banner List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'streamvid' ),
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
				'default' => 'large',
				'separator' => 'none',
			]
		);
        $repeater->add_control(
				'text1',
				[
					'label'     => esc_html__( 'Text 1', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'text 1',
				]
		);
        $repeater->add_control(
				'text2',
				[
					'label'     => esc_html__( 'Text 2', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'text 2',
				]
		);
        $repeater->add_control(
				'text3',
				[
					'label'     => esc_html__( 'Text 3', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => 'text 3',
				]
		);
        
        $repeater->add_control(
			'link_url',
			[
				'label' => esc_html__( 'Link', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'streamvid' ),
				'show_external' => true,
				'default' => [
					'url' => '#',
				],
			]
		);

        $repeater->add_control(
			'item_margin',
			[
				'label'      => esc_html__( 'Image Margin', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}}  .jws-banner-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
              
			]
		);
        $repeater->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Item Padding', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner {{CURRENT_ITEM}}  .jws-banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
                
			]
		);
        $repeater->add_control(
				'item_align',
				[
					'label' 		=> esc_html__( 'Content Align', 'streamvid' ),
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
							'{{WRAPPER}}  .jws-banner {{CURRENT_ITEM}} .jws-banner-content' => 'text-align: {{VALUE}};',
					],
					'frontend_available' => true,
                
				]
		);
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'Menu List', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'banner_title' => esc_html__( 'Name #1', 'streamvid' ),
					],
				],
				'title_field' => '{{{ text1 }}}',
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
					'{{WRAPPER}} .jws-banner .jws-banner-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .jws-banner.row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
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
					'{{WRAPPER}} .jws-banner .jws-banner-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'banner_content_padding',
			[
				'label'      => esc_html__( 'Content Padding', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .jws-banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'banner_text1_style',
			[
				'label' => esc_html__( 'Text 1', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'banner_text1_color',
			[
				'label'     => esc_html__( 'Text Color', 'streamvid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .text-1' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_text1_typography',
				'label'     => esc_html__( 'Typography', 'streamvid' ),
				'selector'  => '{{WRAPPER}} .jws-banner .text-1',
			]
		);
        
         $this->add_responsive_control(
			'banner_text1_margin',
			[
				'label'      => esc_html__( 'Margin', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .text-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        $this->start_controls_section(
			'banner_text2_style',
			[
				'label' => esc_html__( 'Text 2', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'banner_text2_color',
			[
				'label'     => esc_html__( 'Text Color', 'streamvid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .text-2' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_text2_typography',
				'label'     => esc_html__( 'Typography', 'streamvid' ),
				'selector'  => '{{WRAPPER}} .jws-banner .text-2',
			]
		);
        
         $this->add_responsive_control(
			'banner_text2_margin',
			[
				'label'      => esc_html__( 'Margin', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .text-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_section();
        
        
          $this->start_controls_section(
			'banner_readmore_style',
			[
				'label' => esc_html__( 'Read More', 'streamvid' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
			'banner_readmore_color',
			[
				'label'     => esc_html__( 'Text Color', 'streamvid' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .jws-banner .button' => 'color: {{VALUE}};',
				],
			]
		);
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'banner_readmore_typography',
				'label'     => esc_html__( 'Typography', 'streamvid' ),
				'selector'  => '{{WRAPPER}} .jws-banner .button',
			]
		);
        
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'banner_readmore_border',
				'placeholder' => '1px',
				'default' => '1px',
				'selector' => '{{WRAPPER}} .jws-banner .button',
				'separator' => 'before',
			]
		);
        
        $this->add_responsive_control(
			'banner_readmore_padding',
			[
				'label'      => esc_html__( 'Padding', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
         $this->add_responsive_control(
			'banner_readmore_margin',
			[
				'label'      => esc_html__( 'Margin', 'streamvid' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .jws-banner .button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $class_row = 'jws-banner banner row '.$settings['banner_layout']; 

        $image_size = (!empty($settings['banner_dimension']['width']) || !empty($settings['banner_dimension']['height'])) ? $settings['banner_dimension']['width'].'x'.$settings['banner_dimension']['height'] : 'full';
        
          $class_column = 'jws-banner-item';
          $class_column .= ' col-xl-'.$settings['banner_columns'].'';
          $class_column .= (!empty($settings['banner_columns_tablet'])) ? ' col-lg-'.$settings['banner_columns_tablet'].'' : ' col-lg-'.$settings['banner_columns'].'' ;
          $class_column .= (!empty($settings['banner_columns_mobile'])) ? ' col-'.$settings['banner_columns_mobile'].'' :  ' col-'.$settings['banner_columns'].''; 
          
          $class_row .= ' '.$settings['banner_display'];

         ?>
         <div class="jws-banner-element">
            <?php if(isset($arrows) && $arrows == 'true') : ?>
              <nav class="jws-banner-nav">
                    <span class="prev-item jws-carousel-btn"><span class="jws-icon-arrow_carrot-left"></span></span>
                    <span class="next-item jws-carousel-btn"><span class="jws-icon-arrow_carrot-right"></span></span>
              </nav>
            <?php endif; ?>
            <div class="<?php echo esc_attr($class_row); ?>"  data-banner="jws-custom-<?php echo esc_attr($this->get_id()); ?>">
               <?php 
                 $i = 1; $n = 0; foreach (  $settings['list'] as $index => $item ) {
                    
             
                   $link_key = 'link' . $index;   
                   if($item['link_url']['is_external']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                   if($item['link_url']['nofollow']) $this->add_render_attribute( $link_key, 'target',  '_blank' );  
                   $this->add_render_attribute( $link_key, 'href',  $item['link_url']['url'] ); 

                    ?>
                        <div class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> <?php echo esc_attr($class_column); ?>">
                        <?php  include( ''.$settings['banner_layout'].'.php' );  ?>
                   
                    </div>
                <?php $n++; } ?>
            </div>
            <div class="slider-dots-box"></div>
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