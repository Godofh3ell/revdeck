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
class Jws_Video_Special extends Widget_Base {

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
		return 'jws_video_special';
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
		return esc_html__( 'Jws Video Special', 'streamvid' );
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
		return 'eicon-post';
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
		return [ ''];
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
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);
        
        $this->add_control(
			'video_type',
			[
				'label'   => esc_html__( 'Video Type', 'streamvid' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'file',
				'options' => [
					'file'    => esc_html__( 'File', 'streamvid' ),
					'url' => esc_html__( 'Url', 'streamvid' ),
				],
			]
		);

        
        $this->add_control(
			'video_file',
			[
				'label' => esc_html__( 'Choose Video', 'streamvid' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			    'media_types' => ['video'],
                'condition' => [
					'video_type' => 'file',
				],
			]
		);
        
        $this->add_control(
				'video_url',
				[
					'label'     => esc_html__( 'Video Url Mp4', 'streamvid' ),
					'type'      => Controls_Manager::TEXT,
					'default'   => '',
                    'condition' => [
    					'video_type' => 'url',
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
        
        $video_url = $settings['video_type'] == 'file' ? $settings['video_file']['url'] :  $settings['video_url']; 
      ?>
 
		
		<div class="jws-video-special-element">
                
            <div class="jws-image">
                <?php if(!empty($settings['image']['id'])) echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings );?> 
            </div>
         
            <div class="video-player" data-trailer="<?php if(!empty($video_url)) echo esc_attr($video_url); ?>"></div>
            <div class="change-speaker muted"><i class="jws-icon-speaker-x"></i></div>
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