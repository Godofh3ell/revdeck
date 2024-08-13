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
class Jws_Post_Category_Filter extends Widget_Base {

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
		return 'jws_post_category_filter';
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
		return esc_html__( 'Jws Post Category Filter', 'streamvid' );
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
		return 'eicon-product-categories';
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
				'post_type',
				[
					'label'     => esc_html__( 'Display', 'streamvid' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'movies_cat',
					'options'   => [
						'movies_cat'   => esc_html__( 'Movies', 'streamvid' ),
						'tv_shows_cat'   => esc_html__( 'Tv Shows', 'streamvid' ),
                        'videos_cat'   => esc_html__( 'videos', 'streamvid' ),
                        'person_cat'   => esc_html__( 'person', 'streamvid' ),
					],
                    
				]
		);
         $this->add_control('orderby', [
                'label' => esc_html__('Order by', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => array(
                    'name'       => esc_html__('Name', 'streamvid'),
                    'count' => esc_html__('Count', 'streamvid'),
                    'date' => esc_html__('Date', 'streamvid'),      
                )
            ]);
            $this->add_control('order', [
                'label' => esc_html__('Order', 'streamvid'),
                'description' => esc_html__('', 'streamvid'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'desc' => esc_html__('DESC', 'streamvid'),
                    'asc'  => esc_html__('ASC', 'streamvid'),
                )
            ]);
            $this->add_control(
				'post_per_page',
				[
					'label'     => esc_html__( 'posts Per Page', 'streamvid' ),
					'type'      => Controls_Manager::NUMBER,
					'default'   => '8',
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
        $this->end_controls_section(); 

	}
    
    
    protected function check_current_cat($slug) { 
        
        $current_cat = get_queried_object();
        
        if(isset($current_cat->slug) && $current_cat->slug  ==  $slug) {
            
            $current_class = ' current';
            
        } else {
            
            $current_class = '';
        }
        
        return $current_class;
   
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
        $row_class = 'jws-post-category-filter';

        $post_type = $settings['post_type'];
        $option = array(
            'orderby' => $settings['orderby'] ,
            'order' => $settings['order']
        );
        
        if($settings['post_per_page'] != 0) {
           $option['number']  = $settings['post_per_page'];
        }
   
        
        $option['hide_empty'] = $settings['hide_empty'] == 'yes' ? true : false;
        
        $option['parent'] = 0;
        
        
        
        $query = get_terms(
        $settings['post_type'], $option 
        );
 
        ?>
     
        <div class="<?php echo esc_attr($row_class); ?>">
        
         <ul class="reset_ul_ol">
			<?php 

                if ( !empty($query) ) :
                	foreach( $query as $category ) {
                	   $subcategories = get_terms(array(
                          'taxonomy' => $settings['post_type'],
                          'parent' => $category->term_id,
                          'hide_empty' => false
                        ));
                    
                        
                	   ?>
                       
                        <li class="cat-item<?php echo ''.$this->check_current_cat($category->slug); ?>">
                                <a href="<?php echo  add_query_arg(array($_GET), get_term_link($category->slug, $settings['post_type']) ); ?>">
                                      <span><?php echo esc_html($category->name); ?></span> 
                                </a>
                                <?php if (!empty($subcategories)) { ?>
                                    <ul class="subcategories reset_ul_ol">
                                      <?php foreach ($subcategories as $subcategory) { ?>
                                        <li class="cat-item<?php echo ''.$this->check_current_cat($subcategory->slug); ?>">
                                          <a href="<?php echo add_query_arg(array($_GET), get_term_link($subcategory) ); ?>"><span><?php echo esc_html($subcategory->name); ?></span> </a>
                                        </li>
                                      <?php } ?>
                                    </ul>
                                  <?php } ?>
                        </li>
                       
                       <?php
                	}
                
                endif;
             
            ?>
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