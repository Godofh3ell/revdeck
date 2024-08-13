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
class Jws_Pmpro_Level extends Widget_Base {

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
		return 'jws_pmpro_level';
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
		return esc_html__( 'Jws Pmpro Level', 'streamvid' );
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
		return 'eicon-price-table';
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
		return [];
	  }
      public function get_style_depends() {
		return [];
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
				'layouts',
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
				'pricing_active',
				[
					'label'     => esc_html__( 'Choose number pricing active.', 'streamvid' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '',
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
					'{{WRAPPER}} .pmpro-level-item' => 'padding-right: calc( {{SIZE}}{{UNIT}}/2 ); padding-left: calc( {{SIZE}}{{UNIT}}/2 );',
					'{{WRAPPER}} .row' => 'margin-left: calc( -{{SIZE}}{{UNIT}}/2 ); margin-right: calc( -{{SIZE}}{{UNIT}}/2 );',
				],
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
			'section_grid_options',
			[
				'label'     => esc_html__( 'Grid Options', 'streamvid' ),
				'type'      => Controls_Manager::SECTION,
			]
		);
		$this->add_responsive_control(
				'columns',
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
        if(!function_exists('pmpro_sort_levels_by_order')) return false;

        global $wpdb, $pmpro_msg, $pmpro_msgt, $current_user;
        
        $pmpro_levels = pmpro_sort_levels_by_order( pmpro_getAllLevels(false, true) );
        $pmpro_levels = apply_filters( 'pmpro_levels_array', $pmpro_levels );
        
        $row_class = 'row row-eq-height '.$settings['layouts'];  
        $class_column = 'pmpro-level-item ';
        $class_column .= ' col-xl-'.$settings['columns'].'';
        $class_column .= (!empty($settings['columns_tablet'])) ? ' col-lg-'.$settings['columns_tablet'].'' : ' col-lg-'.$settings['columns'].'' ;
        $class_column .= (!empty($settings['columns_mobile'])) ? ' col-'.$settings['columns_mobile'].'' :  ' col-'.$settings['columns'].'';
     

      ?>
 
		
		<div class="jws-pmpro-level-element">
            <div class="<?php echo esc_attr($row_class); ?>">
            	<?php
            		$count 			= 1;
            		$has_any_level	= false;
            		foreach( $pmpro_levels as $level ):
            			$user_level 		= pmpro_getSpecificMembershipLevelForUser( $current_user->ID, $level->id );
            			$has_level 			= ! empty( $user_level )	? true 	: false;
            			$has_any_level 		= $has_level 				? : $has_any_level;
            
            			$cost_text 			= pmpro_getLevelCost($level, true, true); 
            			$expiration_text 	= pmpro_getLevelExpiration($level);
                        
                        if($settings['pricing_active'] == $count) {
                            $active = ' active';
                        }else {
                            $active = '';
                        }
                     
                        ?>
                        
                        <div class="<?php echo esc_attr($class_column.$active); ?>">
                        
                            <?php 
                            
                               include( 'layout/'.$settings['layouts'].'.php' );
                            
                            ?>
                      
                        
                        
                        
                        </div>
                        
                        <?php
                   $count++; endforeach;     		
                ?>
            </div>
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