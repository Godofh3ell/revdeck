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
class Jws_Menu_Side extends Widget_Base {

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
		return 'jws_menu_side';
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
		return esc_html__( 'Jws Menu Side', 'streamvid' );
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
		return 'eicon-nav-menu';
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
				'label' => esc_html__( 'Menu List', 'streamvid' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);   

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'streamvid' ),
					'type' => \Elementor\Controls_Manager::ICONS,
				]
		);
        $repeater->add_control(
			'text',
			[
			    'label' => esc_html__( 'Text', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::TEXT,
                'default' 		=> '',
			]
		);
        $repeater->add_control(
			'url',
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
            'use_search',
            [
                'label'         => esc_html__( 'Use Search Popup', 'streamvid' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'streamvid' ),
                'label_off'     => esc_html__( 'No', 'streamvid' ),
            ]
        );
        $repeater->add_control(
            'use_expand',
            [
                'label'         => esc_html__( 'Use Expand the menu text', 'streamvid' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'streamvid' ),
                'label_off'     => esc_html__( 'No', 'streamvid' ),
            ]
        );
        $this->add_control(
			'list',
			[
				'label' => esc_html__( 'List', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
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
    
        $class_column = 'menu-item';
    
        $class_row = 'jws-menu-side'; 
        $actual_link = (function_exists('check_url')) ? check_url() : '';
         ?>
         <div class="jws-menu-side-element">

            <ul class="<?php echo esc_attr($class_row); ?>">
                
                    <?php foreach (  $settings['list'] as $index => $item ) {
                       $link_key = 'link' . $index;   
                       if($item['url']['nofollow']) $this->add_render_attribute( $link_key, 'rel',  'nofollow' );
                       if($item['url']['is_external']) $this->add_render_attribute( $link_key, 'target',  '_blank' );
                 
                       if($item['use_search'] == 'yes') $this->add_render_attribute( $link_key, 'data-modal-jws',  '#form_content_popup' );
                       if($item['use_expand'] == 'yes') $this->add_render_attribute( $link_key, 'class',  'menu-expand' );
                       
                     
                       if ( in_array($item['url']['url'],$actual_link) ) {
                          $this->add_render_attribute( $link_key, 'class', 'active' );          
                       }  
                       $this->add_render_attribute( $link_key, 'href',  $item['url']['url'] ); 
                       ?>
                        <li class="<?php echo esc_attr($class_column); ?>">
                            <a <?php echo ''.$this->get_render_attribute_string($link_key); ?>>
                                <?php if(!empty($item['icon']['value'])) {
                                  echo '<span class="menu-icon">';  
                                    \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] );  
                                  echo '</span>';
                                } ?>
                                
                                <span class="menu-text"><?php echo esc_html($item['text']); ?></span>
                            </a>
                        </li>
                     <?php } ?>
    
            </ul>
       
          
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