<?php
    /**
     * ReduxFramework Theme Config File
     * For full documentation, please visit: https://docs.reduxframework.com
     * */

    if ( ! class_exists( 'Redux_Framework_theme_config' ) ) {

        class Redux_Framework_theme_config {

            public $args = array();
            public $sections = array();
            public $theme;
            public $ReduxFramework;

            public function __construct() {

                if ( ! class_exists( 'ReduxFramework' ) ) {
                    return;
                }

                // This is needed. Bah WordPress bugs.  ;)
                if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                    $this->initSettings();
                } else {
                    add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
                }
		

            }

            public function initSettings() {

                // Just for demo purposes. Not needed per say.
                $this->theme = wp_get_theme();

                // Set the default arguments
                $this->setArguments();

                // Set a few help tabs so you can see how it's done
         

                // Create the sections and fields
                $this->setSections();

                if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                    return;
                }


                $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
            }

            /**
             * This is a test function that will let you see when the compiler hook occurs.
             * It only runs if a field    set with compiler=>true is changed.
             * */
            function compiler_action( $options, $css, $changed_values ) {
                echo '<h1>The compiler hook has run!</h1>';
                echo "<pre>";
                print_r( $changed_values ); // Values that have changed since the last save
                echo "</pre>";
            }

            /**
             * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
             * Simply include this function in the child themes functions.php file.
             * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
             * so you must use get_template_directory_uri() if you want to use any of the built in icons
             * */
            function dynamic_section( $sections ) {
                //$sections = array();
                $sections[] = array(
                    'title'  => __( 'Section via hook', 'streamvid' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'streamvid' ),
                    'icon'   => 'el-icon-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                //$args['dev_mode'] = true;

                return $args;
            }

            /**
             * Filter hook for filtering the default value of any given field. Very useful in development mode.
             * */
            function change_defaults( $defaults ) {
                $defaults['str_replace'] = 'Testing filter hook!';

                return $defaults;
            }

            // Remove the demo link and the notice of integrated demo from the redux-framework plugin
            function remove_demo() {

                // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
                if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
                }
            }

            public function setSections() {

                /**
                 * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
                 * */
                // Background Patterns Reader
                $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
                $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
                $sample_patterns      = array();

                if ( is_dir( $sample_patterns_path ) ) :

                    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                        $sample_patterns = array();

                        while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                            if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                                $name              = explode( '.', $sample_patterns_file );
                                $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                                $sample_patterns[] = array(
                                    'alt' => $name,
                                    'img' => $sample_patterns_url . $sample_patterns_file
                                );
                            }
                        }
                    endif;
                endif;

                ob_start();

                $ct          = wp_get_theme();
                $this->theme = $ct;
                $item_name   = $this->theme->get( 'Name' );
                $tags        = $this->theme->Tags;
                $screenshot  = $this->theme->get_screenshot();
                $class       = $screenshot ? 'has-screenshot' : '';

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'streamvid' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'streamvid' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'streamvid' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo esc_attr($this->theme->display( 'Name' )); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'streamvid' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'streamvid' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'streamvid' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo esc_attr($this->theme->display( 'Description' )); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'streamvid' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'streamvid' ), $this->theme->parent()->display( 'Name' ) );
                            }
                        ?>

                    </div>
                </div>

                <?php
                $item_info = ob_get_contents();

                ob_end_clean();

                $sampleHTML = '';
           
				
				$of_options_fontsize = array("8px" => "8px", "9px" => "9px", "10px" => "10px", "11px" => "11px", "12px" => "12px", "13px" => "13px", "14px" => "14px", "15px" => "15px", "16px" => "16px", "17px" => "17px", "18px" => "18px", "19px" => "19px", "20px" => "20px", "21px" => "21px", "22px" => "22px", "23px" => "23px", "24px" => "24px", "25px" => "25px", "26px" => "26px", "27px" => "27px", "28px" => "28px", "29px" => "29px", "30px" => "30px", "31px" => "31px", "32px" => "32px", "33px" => "33px", "34px" => "34px", "35px" => "35px", "36px" => "36px", "37px" => "37px", "38px" => "38px", "39px" => "39px", "40px" => "40px");
				$of_options_fontweight = array("100" => "100", "200" => "200", "300" => "300", "400" => "400", "500" => "500", "600" => "600", "700" => "700");
				$of_options_font = array("1" => "Google Font", "2" => "Standard Font", "3" => "Custom Font");

				//Standard Fonts
				$of_options_standard_fonts = array(
					'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
					"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
					"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
					"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
					"Courier, monospace" => "Courier, monospace",
					"Garamond, serif" => "Garamond, serif",
					"Georgia, serif" => "Georgia, serif",
					"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
					"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
					"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
					"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
					"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
					"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
					"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
					"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
					"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
					"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
				);
				
                //lists page
                $lists_page = array();
                $args_page = array(
                    'sort_order' => 'asc',
                    'sort_column' => 'post_title',
                    'hierarchical' => 1,
                    'exclude' => '',
                    'include' => '',
                    'meta_key' => '',
                    'meta_value' => '',
                    'authors' => '',
                    'child_of' => 0,
                    'parent' => -1,
                    'exclude_tree' => '',
                    'number' => '',
                    'offset' => 0,
                    'post_type' => 'page',
                    'post_status' => 'publish'
                );
                $pages = get_pages( $args_page );

                foreach( $pages as $p ){
                    $lists_page[ $p->ID ] = esc_attr( $p->post_title );
                }
// -> START 
$this->sections[] = array(
    'title' => esc_html__('General', 'streamvid'),
    'id' => 'general',
    'customizer_width' => '300px',
    'icon' => 'el el-cogs',
    'fields' => array(
        array(
            'id'    => 'jws_color_info',
            'type'  => 'info',
            'title' => __('Note!', 'streamvid'),
            'style' => 'warning',
            'desc' => esc_html__('Some settings you need to change with ', 'streamvid') . '<a href="https://elementor.com/help/site-settings/?utm_source=editor-panel&utm_medium=wp-dash&utm_campaign=learn" target="_blank">Elenmentor Site Settings</a>',
        ),
        array(
            'id'        => 'favicon',
            'type'      => 'media',
            'url'       => true,
            'title'     => esc_html__('Favicon', 'streamvid' ),
            'compiler'  => 'false',
            'subtitle'  => esc_html__('Upload your favicon', 'streamvid' ),
        ),
        array(         
            'id'       => 'bg_body',
            'type'     => 'background',
            'title'    =>  esc_html__('Background', 'streamvid'),
            'subtitle' =>  esc_html__('background with image, color, etc.', 'streamvid'),
            'desc'     =>  esc_html__('Change background for body.', 'streamvid'),
            'default'  => array(
                'background-color' => '#ffffff',
            ),
            'output' => array('body'),
        ),
        array (
				'id'       => 'rtl',
				'type'     => 'switch',
				'title'    => esc_html__( 'RTL', 'streamvid' ),
				'default'  => false
		),
        array (
				'id'       => 'read_js_content',
				'type'     => 'switch',
				'title'    => esc_html__( 'Read Js Content', 'streamvid' ),
				'default'  => false
		),
        
        array(
            'id' => 'container_layout',
            'type' => 'select',
            'title' => esc_html__('Body Layout', 'streamvid'),
            'options' => array(
                'box' => 'Box',
                'full' => 'Full Width',
            ),
            'default' => 'box',
        ),
        
        array(
            'id'        => 'container-width',
            'type'      => 'slider',
            'title'     =>  esc_html__('Website Width', 'streamvid'),
            "default"   => 1200,
            "min"       => 700,
            "step"      => 10,
            "max"       => 1920,
            'display_value' => 'label',
            'required' => array('container_layout', '=','box'),
        ),
        array(
            'id'             => 'container-padding',
            'type'           => 'spacing',
            'title'     =>  esc_html__('Container Padding', 'streamvid'),
            'mode'           => 'padding',
            'units'          => array('em', 'px'),
            'top' => false,
            'bottom' => false,
            'units_extended' => 'false',
            'desc'           =>  esc_html__('You can enable or disable any piece of this field. Right, Left, or Units.', 'streamvid'),
            'default'            => array( 
                'padding-right'   => '70px', 
                'padding-left'    => '70px',
                'units'          => 'px', 
            ),
            'required' => array('container_layout', '=','full'),

        ),
        array(
            'id'        => 'jws_placeholder_image',
            'type'      => 'media',
            'url'       => true,
            'title'     => esc_html__('Image Placeholder', 'streamvid' ),
            'compiler'  => 'false',
            'subtitle'  => esc_html__('Use for missing thumbnail images.', 'streamvid' ),
        ),
));
// -> START Header Fields
$this->sections[] = array(
    'title' => esc_html__('Header', 'streamvid'),
    'id' => 'header',
    'desc' => esc_html__('Custom Header', 'streamvid'),
    'customizer_width' => '400px',
    'icon' => 'el el-caret-up',
    'fields' => array(
         array(
            'id' => 'choose-header-absolute',
            'type' => 'select',
            'multi' => true,
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select header absolute.', 'streamvid'),
            'description' => esc_html__('The selected header templates will override the content page.','streamvid')
        ),
        array(
            'id' => 'select-header',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for header', 'streamvid'),
            'desc' => esc_html__('Select layout for header from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'select-header-side',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for header side', 'streamvid'),
            'desc' => esc_html__('Select layout for header side from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array (
				'id'       => 'enable-header-side',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Header Side', 'streamvid' ),
				'default'  => false
		),
    )
);

// -> START Title Bar Fields
$this->sections[] = array(
    'title' => esc_html__('Title Bar', 'streamvid'),
    'id' => 'title_bar',
    'desc' => esc_html__('Custom title bar', 'streamvid'),
    'customizer_width' => '400px',
    'icon' => 'el el-text-height',
    'fields' => array(
        array(
            'id'       => 'title-bar-switch',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Switch On Title Bar', 'streamvid'),
            'default'  => true,
        ),
        array(
            'id' => 'select-titlebar',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(         
            'id'       => 'bg_titlebar',
            'type'     => 'background',
            'title'    =>  esc_html__('Background', 'streamvid'),
            'subtitle' =>  esc_html__('background with image, color, etc.', 'streamvid'),
            'desc'     =>  esc_html__('Change background for titler defaul (not woking with title elemetor template).', 'streamvid'),
            'default'  => array(
                'background-color' => '#333333',
            ),
            'output' => array('.jws-title-bar-wrap-inner'),
        ),
        array(
            'id'             => 'titlebar-spacing',
            'type'           => 'spacing',
            'output'         => array('.jws-title-bar-wrap-inner'),
            'mode'           => 'padding',
            'units'          => array('em', 'px'),
            'units_extended' => 'false',
            'desc'           =>  esc_html__('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'streamvid'),
            'default'            => array(
                'padding-top'     => '150px', 
                'padding-right'   => '15px', 
                'padding-bottom'  => '100px', 
                'padding-left'    => '15px',
                'units'          => 'px', 
         ),
        
    ),
));

// -> START footer Fields
$this->sections[] = array(
    'title' => esc_html__('Footer', 'streamvid'),
    'id' => 'footer',
    'desc' => esc_html__('Custom Footer', 'streamvid'),
    'customizer_width' => '400px',
    'icon' => 'el el-caret-down',
    'fields' => array(
        array(
            'id' => 'select-footer',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for footer', 'streamvid'),
            'desc' => esc_html__('Select layout for footer from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
    )
);

// -> START Color Fields
$this->sections[] = array(
    'title' => esc_html__('Color Styling', 'streamvid'),
    'id' => 'global-color',
    'desc' => esc_html__('These are really color fields!', 'streamvid'),
    'customizer_width' => '400px',
    'icon' => 'el el-brush',
);
$this->sections[] = array(
    'title' => esc_html__('Color', 'streamvid'),
    'id' => 'color-styling',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'main-color',
            'type' => 'color',
            'title' => esc_html__('Main Color', 'streamvid'),
            'default' => '#6C52EE',
        ),
        array(
            'id' => 'secondary-color',
            'type' => 'color',
            'title' => esc_html__('Secondary Color', 'streamvid'),
            'default' => '#FFBFCC',
        ),
        array(
            'id' => 'third-color',
            'type' => 'color',
            'title' => esc_html__('Third Color', 'streamvid'),
            'default' => '#6e8695',
        ),
        array(
            'id' => 'color_heading',
            'type' => 'color',
            'title' => esc_html__('Color Heading', 'streamvid'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'color_light',
            'type' => 'color',
            'title' => esc_html__('Color Light', 'streamvid'),
            'default' => '#ffffff',
        ),
        array(
            'id' => 'color_body',
            'type' => 'color',
            'title' => esc_html__('Color Body', 'streamvid'),
            'default' => '#a1a0a1',
        ),
        array(
            'id' => 'input_bg',
            'type' => 'color',
            'title' => esc_html__('Input Background', 'streamvid'),
            'default' => '#191c33',
        ),
    ),
);
$this->sections[] = array(
    'title' => esc_html__('Back To Top', 'streamvid'),
    'id' => 'to-top-styling',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'to-top-color',
            'type' => 'color',
            'title' => esc_html__('Color', 'streamvid'),
            'default' => '#333333',
            'output' => array('.backToTop'),
        ),
    ),
);
$this->sections[] = array(
    'title' => esc_html__('Button', 'streamvid'),
    'id' => 'button-styling',
    'subsection' => true,
    'fields' => array(
          array(
            'id'       => 'button-layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Button Global Skins', 'streamvid'), 
            'options'  => array(
                'default' => 'Default',
            ),
            'default'  => 'default',
        ),
        array(
            'id' => 'button-bgcolor',
            'type' => 'color',
            'title' => esc_html__('Background Color', 'streamvid'),
            'default' => '',
        ),
        array(
            'id' => 'button-bgcolor2',
            'type' => 'color',
            'title' => esc_html__('Background Color 2', 'streamvid'),
            'default' => '',
        ),
        array(
            'id' => 'button-bgcolor3',
            'type' => 'color',
            'title' => esc_html__('Background Color 3', 'streamvid'),
            'default' => '',
        ),
        array(
            'id' => 'button-color',
            'type' => 'color',
            'title' => esc_html__('Color', 'streamvid'),
            'default' => '',
        ),
        array(
            'id' => 'button-color2',
            'type' => 'color',
            'title' => esc_html__('Color 2', 'streamvid'),
            'default' => '',
        ),
         array(
            'id' => 'opt-typography-button',
            'type' => 'typography',
            'title' => esc_html__('Font', 'streamvid'),
            'google' => true,
            'color' => false,
            'text-align' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'subsets' => false ,
            'output' => array('body.button-default  .elementor-button, body.button-default .jws-cf7-style .wpcf7-submit, body.button-default .elementor-button.rev-btn'),
        ),
        array(
            'title' => esc_html__('Padding', 'streamvid'),
            'id'             => 'button-padding',
            'type'           => 'spacing',
            'mode'           => 'padding',
            'units'          => array('em', 'px'),
            'units_extended' => 'false',
            'output' => array('body.button-default  .elementor-button, body.button-default .jws-cf7-style .wpcf7-submit, body.button-default .elementor-button.rev-btn'),
        ),

    ),
);

// -> START 404
$this->sections[] = array(
    'title' => esc_html__('Video Global', 'streamvid'),
    'id' => 'video_global',
    'desc' => esc_html__('Setting for all video.', 'streamvid'),
    'customizer_width' => '300px',
    'icon' => 'jws-icon-monitor-play',
    'fields' => array(
       
        array(
            'id'=>'max_upload_size',
            'type' => 'text',
            'title' =>  esc_html__('Max Upload Site', 'streamvid'),
            'validate' => 'no_html',
            'default'  => number_format_i18n( ceil( wp_max_upload_size()/1048576 )), 
            'desc' =>   sprintf(
                             '<p>'.esc_html__( 'Your server upload size is currently %1$dMb', 'streamvid' ).'</p>
                             <p>'.esc_html__( 'Please put the value here in numeric form and no more than %1$dMb ( Examplate: 50 )', 'streamvid' ).'</p>',
                           number_format_i18n( ceil( wp_max_upload_size()/1048576 ) ).''
                        ) 
        ),
        array(
            'id' => 'video_advenced',
            'type' => 'select',
            'title' => esc_html__('Advanced Video Media', 'streamvid'),
            'desc' => esc_html__('Choose alternative function for mp4 video ', 'streamvid'),
            'options' => array(
                'encode' => 'Video Encode',
                'bunny' => 'Video Bunny',
                'cloudflare' => 'Video Cloudflare',
            ),
            'default' => 'encode',
       ),
       array(
    		'id'     => 'video_player',
    		'type'   => 'section',
    		'title'  => esc_html__( 'Player Settings', 'streamvid' ),
    		'indent' => true,
    	),
        array(
            'id' => 'video_ratio',
            'type' => 'select',
            'title' => esc_html__('Video Ratio', 'streamvid'),
            'desc' => esc_html__('Choose ratio for all video player detail', 'streamvid'),
            'options' => jws_videos_ratio(),
            'default' => '21x9',
       ),
       array(
            'id'       => 'video_autoplay',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Autoplay', 'streamvid'),
            'default'  => true,
       ),
       array(
            'id'       => 'video_muted',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Muted', 'streamvid'),
            'default'  => false,
       ),
       array(
            'id'       => 'next_episodes',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Auto Next Episodes ', 'streamvid'),
            'default'  => false,
       ),
       array(
            'id'        => 'player_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => esc_html__('Player Logo', 'streamvid' ),
            'compiler'  => 'false',
            'subtitle'  => esc_html__('Upload Your Logo', 'streamvid' ),
        ),
        array(
            'id'       => 'video_player_ads',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Player Ads', 'streamvid'),
            'default'  => true, 
       ),
        array(
    		'id'     => 'control_player',
    		'type'   => 'section',
    		'title'  => esc_html__( 'Player Control', 'streamvid' ),
    		'indent' => true,
    	),
        array(
            'id'       => 'video_chromcast',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Video Chromcast', 'streamvid'),
            'default'  => true, 
       ),
       
       array(
            'id'       => 'video_seek_button',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Video Fast Forward Button', 'streamvid'),
            'default'  => true, 
       ),
  
    )
);

if(!function_exists( 'exec' )) {
    
    $exec = __('Exec has been disabled.', 'streamvid');
    $ffmpeg  = __('ffmpeg is not installed. And not active with Shared Hosting server.', 'streamvid');
    
    
} else {
    
    $exec = __('Exec is enabled.', 'streamvid');
    
    $ffmpeg_output = '';
	
	exec( "which ffmpeg", $ffmpeg_output );

	if( !empty( $ffmpeg_output ) ){
	   
	   $ffmpeg  = __('Ffmpeg is already installed.', 'streamvid');
       				
	}else {
	   
	   $ffmpeg  = __('ffmpeg is not installed. And not active with Shared Hosting server.', 'streamvid');
       
	}
    
}




$this->sections[] = array(
    'title' => esc_html__('Media Encode FFmpeg', 'streamvid'),
    'id' => 'media_encode',
    'desc' => esc_html__('Setting for media encode.', 'streamvid'),
    'customizer_width' => '300px',
    'subsection' => true,
    'fields' => array(
        array(
            'id'    => 'exec_func',
            'type'  => 'info',
            'title' => __('Exec php', 'streamvid'),
            'style' => 'warning',
            'desc' => $exec,
        ),
        array(
            'id'    => 'ffmpeg_status',
            'type'  => 'info',
            'title' => __('Ffmpeg status', 'streamvid'),
            'style' => 'warning',
            'desc' => $ffmpeg,
        ),
        array(
            'id'=>'ffmpeg_path',
            'type' => 'text',
            'title' =>  esc_html__('FFmpeg path', 'streamvid'),
            'validate' => 'no_html',
            'default' => '/usr/bin/',
        ), 
        
       
    )
);

$this->sections[] = array(
    'title' => esc_html__('Bunny', 'streamvid'),
    'id' => 'media_bunny',
    'subsection' => true,
    'desc' => esc_html__('Setting for media bunny.', 'streamvid'),
    'customizer_width' => '300px',
    'fields' => array(
       
       array(
            'id'=>'library_id',
            'type' => 'text',
            'title' =>  esc_html__('Library Id', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
       array(
            'id'=>'bn_access_key',
            'type' => 'text',
            'title' =>  esc_html__('AccessKey', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
       array(
            'id'=>'bn_host_name',
            'type' => 'text',
            'title' =>  esc_html__('Host Name', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
    )
);
$this->sections[] = array(
    'title' => esc_html__('Cloudflare', 'streamvid'),
    'id' => 'media_cloudflare',
    'subsection' => true,
    'desc' => esc_html__('Setting for media cloudflare.', 'streamvid'),
    'customizer_width' => '300px',
    'fields' => array(
       
       array(
            'id'=>'cloudflare_id',
            'type' => 'text',
            'title' =>  esc_html__('Account ID', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
       array(
            'id'=>'cloudflare_key',
            'type' => 'text',
            'title' =>  esc_html__('API key', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
       array(
            'id'=>'cl_host_name',
            'type' => 'text',
            'title' =>  esc_html__('Customer subdomain', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 
    )
);

if(!function_exists('jws_option_categories_for_jws')) {
function jws_option_categories_for_jws($taxonomy, $select = 1)
    {
        $data = array();
    
        $query = new \WP_Term_Query(array(
            'hide_empty' => true,
            'taxonomy'   => $taxonomy,
        ));
        if ($select == 1) {
            $data['all'] = 'All';
        }
    
        if (! empty($query->terms)) {
            foreach ($query->terms as $cat) {
                $data[ $cat->slug ] = $cat->name;
            }
        }
    
        return $data;
    }  
}


$this->sections[] = array(
    'title' => esc_html__('Player Ads', 'streamvid'),
    'id' => 'player_ads',
    'desc' => esc_html__('Add ads to videos.', 'streamvid'),
    'customizer_width' => '300px',
    'subsection' => true,
    'fields' => array(

        array(
            'id'         => 'ads_movies',
            'type'       => 'repeater',
            'title'      => __( 'Apply Ads For Movies', 'streamvid' ),
            'subtitle'   => __( '', 'streamvid' ),
            'desc'       => __( '', 'streamvid' ),
            'group_values' => true, // Group all fields below within the repeater ID
            'item_name' => '', // Add a repeater block name to the Add and Delete buttons
            'fields'     => array(
                array(
                    'id' => 'choose-ads-movies',
                    'type' => 'select',
                    'multi' => false,
                    'data' => 'posts',
                    'args' => array('post_type' => array('adsvmap'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select Ads.', 'streamvid'),
                    'desc' => esc_html__('Select ads for movies from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=adsvmap')) . '" target="_blank">Ads Vmap</a>
                     <p>If you do not use custom query, ads will be displayed for all movies.</p>',
       
                ),
 
                array(
                        'id' => 'ads_movies_query_cat',
                        'type' => 'select',
                        'multi' => true,
                        'options' => jws_option_categories_for_jws('movies_cat',2),
                        'title' => esc_html__('Apply for category', 'meathouse'),
                       // 'required' => array('ads_movies_query', '=', 'custom_query'),
                ),
            )
        ),
        
        array(
            'id'         => 'ads_tv_shows',
            'type'       => 'repeater',
            'title'      => __( 'Apply Ads For Tv Shows', 'streamvid' ),
            'subtitle'   => __( '', 'streamvid' ),
            'desc'       => __( '', 'streamvid' ),
            'group_values' => true, // Group all fields below within the repeater ID
            'item_name' => '', // Add a repeater block name to the Add and Delete buttons
            'fields'     => array(
                
                array(
                    'id' => 'choose-ads-tv_shows',
                    'type' => 'select',
                    'multi' => false,
                    'data' => 'posts',
                    'args' => array('post_type' => array('adsvmap'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select Ads.', 'streamvid'),
                    'desc' => esc_html__('Select ads for movies from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=adsvmap')) . '" target="_blank">Ads Vmap</a>
                     <p>If you do not use custom query, ads will be displayed for all tv shows.</p>',
       
                ),
 
                array(
                        'id' => 'ads_tv_shows_query_cat',
                        'type' => 'select',
                        'multi' => true,
                        'options' => jws_option_categories_for_jws('tv_shows_cat',2),
                        'title' => esc_html__('Apply for category', 'meathouse'),
                       // 'required' => array('ads_movies_query', '=', 'custom_query'),
                ),
                
                
            )
        ) ,
        
        
        array(
            'id'         => 'ads_videos',
            'type'       => 'repeater',
            'title'      => __( 'Apply Ads For Videos', 'streamvid' ),
            'subtitle'   => __( '', 'streamvid' ),
            'desc'       => __( '', 'streamvid' ),
            'group_values' => true, // Group all fields below within the repeater ID
            'item_name' => '', // Add a repeater block name to the Add and Delete buttons
            'fields'     => array(
                
                array(
                    'id' => 'choose-ads-videos',
                    'type' => 'select',
                    'multi' => false,
                    'data' => 'posts',
                    'args' => array('post_type' => array('adsvmap'), 'posts_per_page' => -1),
                    'title' => esc_html__('Select Ads.', 'streamvid'),
                    'desc' => esc_html__('Select ads for movies from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=adsvmap')) . '" target="_blank">Ads Vmap</a>
                     <p>If you do not use custom query, ads will be displayed for all videos.</p>',
       
                ),
 
                array(
                        'id' => 'ads_videos_query_cat',
                        'type' => 'select',
                        'multi' => true,
                        'options' => jws_option_categories_for_jws('videos_cat',2),
                        'title' => esc_html__('Apply for category', 'meathouse'),
                       // 'required' => array('ads_movies_query', '=', 'custom_query'),
                ),
                
                
            )
        )
 
        
       
    )
);
$this->sections[] = array(
    'title' => esc_html__('Tool', 'streamvid'),
    'id' => 'media_tool',
    'subsection' => true,
    'desc' => esc_html__('Setting for tool.', 'streamvid'),
    'customizer_width' => '300px',
    'fields' => array(
       array(
            'id'       => 'videos_watchlist',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn on watchlist.', 'streamvid'),
            'default'  => true,
       ),
       array(
            'id'       => 'videos_share',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn on share.', 'streamvid'),
            'default'  => true,
       ),
       array(
            'id'       => 'videos_like',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn on like.', 'streamvid'),
            'default'  => true,
       ),
        
    )
);
// -> START Movies Fields
$this->sections[] = array(
    'title' => esc_html__('Movies', 'streamvid'),
    'id' => 'movies',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-film-strip',
    'fields' => array(
        array(
            'id' => 'select-layout-movies-archive',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'movies_position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'select-movies-columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '6' => '2 Columns',
                '4' => '3 Columns',
                '3' => '4 Columns',
                '20' => '5 Columns',
            ),
            'default' => '20',
        ),
        array(
            'id'       => 'movies_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Movies Skin', 'streamvid'), 
            'options'  => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
                'layout3' => 'Layout 3',
                'layout4' => 'Layout 4',
                'layout5' => 'Layout 5',
            ),
            'default'  => 'layout1',
        ),
        array(
            'id' => 'select-sidebar-movies-page',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'movies_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Image Size', 'streamvid'),
            'default'  => '388x470'
        ),
        array(
            'id' => 'movies_number',
            'type' => 'text',
            'title' => esc_html__('Movies Per Page', 'streamvid'),
            'default' => '-1',
        ),
        
    )
); 


$this->sections[] = array(
    'title' => esc_html__('Movies Single', 'streamvid'),
    'id' => 'movies-single',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-layout-movies',
            'type' => 'select',
            'title' => esc_html__('Select Layout Movies', 'streamvid'),
            'options' => array(
                'v1' => 'Version 1',
                'v2' => 'Version 2',
                'v3' => 'Version 3',
            ),
            'default' => 'v1',
        ),
        array(
            'id' => 'select-related-movies',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related movies', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        
        array(
            'id' => 'select-sidebar-movies',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select content for Sidebar movies', 'streamvid'),
            'desc' => esc_html__('Select content from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('select-layout-movies', '=','v2'),
        ),

    ),
);   


// -> START Tv Shows Fields
$this->sections[] = array(
    'title' => esc_html__('Tv Shows', 'streamvid'),
    'id' => 'tv_shows',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-television',
    'fields' => array(
        array(
            'id' => 'select-layout-tv_shows-archive',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'tv_shows_position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'select-tv_shows-columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '6' => '2 Columns',
                '4' => '3 Columns',
                '3' => '4 Columns',
                '20' => '5 Columns',
            ),
            'default' => '20',
        ),
        array(
            'id'       => 'tv_shows_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Tv Shows Skin', 'streamvid'), 
            'options'  => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
            ),
            'default'  => 'layout1',
        ),
        array(
            'id' => 'select-sidebar-tv_shows-page',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'tv_shows_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Image Size', 'streamvid'),
            'default'  => '388x470'
        ),
        array(
            'id' => 'tv_shows_number',
            'type' => 'text',
            'title' => esc_html__('Tv Shows Per Page', 'streamvid'),
            'default' => '-1',
        ),
    )
    
); 


$this->sections[] = array(
    'title' => esc_html__('Tv Shows Single', 'streamvid'),
    'id' => 'tv_shows-single',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-layout-tv_shows',
            'type' => 'select',
            'title' => esc_html__('Select Layout Tv Shows', 'streamvid'),
            'options' => array(
                'v1' => 'Version 1',
                'v2' => 'Version 2',
            ),
            'default' => 'v1',
        ),
        array(
            'id' => 'select-related-tv_shows',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related Tv Shows', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
  

    ),
);   

$this->sections[] = array(
    'title' => esc_html__('Episodes Single', 'streamvid'),
    'id' => 'episodes-single',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-layout-episodes',
            'type' => 'select',
            'title' => esc_html__('Select Layout Episodes', 'streamvid'),
            'options' => array(
                'v1' => 'Version 1',
                'v2' => 'Version 2',
            ),
            'default' => 'v1',
        ),
        array(
            'id' => 'select-episodes-single-list',
            'type' => 'select',
            'title' => esc_html__('Select Episodes or season displayed to the right of the video player', 'streamvid'),
            'options' => array(
                'episodes' => 'Episodes',
                'season' => 'Season',
            ),
            'default' => 'episodes',
            'required' => array('select-layout-episodes', '=', 'v2'),
        ),
        array(
            'id' => 'select-related-episodes',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related Episodes', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'select-sidebar-episodes',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select content for Sidebar episodes', 'streamvid'),
            'desc' => esc_html__('Select content from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        
    ),
);   

// -> START Videos Fields
$this->sections[] = array(
    'title' => esc_html__('Videos', 'streamvid'),
    'id' => 'videos',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-play-circle',
    'fields' => array(
        array(
            'id' => 'select-layout-videos-archive',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'videos_position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'select-videos-columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '6' => '2 Columns',
                '4' => '3 Columns',
                '3' => '4 Columns',
                '20' => '5 Columns',
            ),
            'default' => '20',
        ),
        array(
            'id'       => 'videos_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Videos Skin', 'streamvid'), 
            'options'  => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
            ),
            'default'  => 'layout1',
        ),
        array(
            'id' => 'select-sidebar-videos-page',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'videos_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Image Size', 'streamvid'),
            'default'  => '388x470'
        ),
        array(
            'id' => 'videos_number',
            'type' => 'text',
            'title' => esc_html__('Videos Per Page', 'streamvid'),
            'default' => '-1',
        ),
    )
); 


$this->sections[] = array(
    'title' => esc_html__('Videos Single', 'streamvid'),
    'id' => 'videos-single',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-layout-videos',
            'type' => 'select',
            'title' => esc_html__('Select Layout Videos', 'streamvid'),
            'options' => array(
                'v1' => 'Version 1',
                'v2' => 'Version 2',
                'v3' => 'Version 3',
            ),
            'default' => 'v3',
        ),
        array(
            'id' => 'select-related-videos',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related Videos', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'select-trending-videos',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Trending Videos', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'select-sidebar-videos',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select content for Sidebar Videos', 'streamvid'),
            'desc' => esc_html__('Select content from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        
    ),
);  

$this->sections[] = array(
    'title' => esc_html__('Videos Upload', 'streamvid'),
    'id' => 'videos-upload',
    'subsection' => true,
    'fields' => array(
   
        array(
            'id'=>'max_upload_size',
            'type' => 'text',
            'title' =>  esc_html__('Max Upload Site', 'streamvid'),
            'validate' => 'no_html',
            'default'  => number_format_i18n( ceil( wp_max_upload_size()/1048576 )), 
            'desc' =>   sprintf(
                             '<p>'.esc_html__( 'Your server upload size is currently %1$dMb', 'streamvid' ).'</p>
                             <p>'.esc_html__( 'Please put the value here in numeric form and no more than %1$dMb ( Examplate: 50 )', 'streamvid' ).'</p>',
                           number_format_i18n( ceil( wp_max_upload_size()/1048576 ) ).''
                        ) 
        ),
       array(
            'id'       => 'video_upload',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Video Upload', 'streamvid'),
            'default'  => true,
       ),
       array(
            'id'       => 'video_live',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Video Live', 'streamvid'),
            'default'  => true,
       ),
        
    ),
); 




// -> START person Fields
$this->sections[] = array(
    'title' => esc_html__('Person', 'streamvid'),
    'id' => 'person',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-user-circle',
    'fields' => array(
        array(
            'id' => 'select-layout-person-single',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'select-layout-person-top',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for top person elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for top person elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id' => 'person_position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'select-person-columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '6' => '2 Columns',
                '4' => '3 Columns',
                '3' => '4 Columns',
                '20' => '5 Columns',
            ),
            'default' => '20',
        ),
        array(
            'id'       => 'person_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select person Skin', 'streamvid'), 
            'options'  => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
            ),
            'default'  => 'layout1',
        ),
        array(
            'id' => 'select-sidebar-person-page',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'person_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Image Size', 'streamvid'),
            'default'  => '388x470'
        ),
        array(
            'id' => 'person_number',
            'type' => 'text',
            'title' => esc_html__('person Per Page', 'streamvid'),
            'default' => '-1',
        ),
    )
); 

$this->sections[] = array(
    'title' => esc_html__('person Single', 'streamvid'),
    'id' => 'person-single',
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'select-related-person',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related person', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),

        
    ),
);   

// -> START Profile Fields
$this->sections[] = array(
    'title' => esc_html__('Profile', 'streamvid'),
    'id' => 'profile',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-user-circle',
    'fields' => array(
       
       
       array(
            'id' => 'select-update-level',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
            'title' => esc_html__('Select Page Pricing Update Level', 'streamvid'),
            'desc' => esc_html__('Select from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
        ),
       
    )
); 


// -> START Profile Fields
$this->sections[] = array(
    'title' => esc_html__('Tmdb Import', 'streamvid'),
    'id' => 'tmdb_import',
    'customizer_width' => '300px',
    'icon' => 'jws-icon-upload',
    'fields' => array(
       
       array(
            'id'=>'tmdb_api',
            'type' => 'text',
            'title' =>  esc_html__('Tmdb Api', 'streamvid'),
            'validate' => 'no_html',
            'default' => '',
       ), 

    )
); 




// -> START Blogs Fields
$this->sections[] = array(
    'title' => esc_html__('Blogs', 'streamvid'),
    'id' => 'blogs',
    'customizer_width' => '300px',
    'icon' => 'el el-blogger',
    'fields' => array(
       array(
            'id' => 'blog_container_layout',
            'type' => 'select',
            'title' => esc_html__('Body Layout', 'streamvid'),
            'options' => array(
                'box' => 'Box',
                'full' => 'Full Width',
            ),
        ),
    )
);
// -> START Blogs Fields
$this->sections[] = array(
    'title' => esc_html__('Blogs Page', 'streamvid'),
    'id' => 'blogs_page',
    'customizer_width' => '300px',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-titlebar-blog-archive',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'right',
        ),
        array(
            'id' => 'select-sidebar-post-columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ),
            'default' => '1',
        ),
        array(
            'id'       => 'blog_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Blog Skin', 'streamvid'), 
            'options'  => array(
                'grid' => 'Grid',
                'list' => 'List',
            ),
            'default'  => 'grid',
        ),
        array(
            'id' => 'select-sidebar-post',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'blog_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Image Size', 'streamvid'),
            'default'  => '866x505'
        ),
        array(
            'id' => 'exclude-blog',
            'type' => 'select',
            'multi' => true,
            'data' => 'posts',
            'args' => array('post_type' => array('post'), 'posts_per_page' => -1),
            'title' => esc_html__('Select blog types not show in blog archive page.', 'streamvid'),
        ),
      
    )
);
$this->sections[] = array(
    'title' => esc_html__('Blog Single', 'streamvid'),
    'id' => 'blog-single',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'blog-title-bar-switch',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Switch On Title Bar', 'streamvid'),
            'default'  => true,
        ),
        array(
            'id' => 'select-titlebar-blog',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('blog-title-bar-switch', '=', true),
        ),
        array(
            'id' => 'select-header-blog',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for header', 'streamvid'),
            'desc' => esc_html__('Select layout for header from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
            'id'       => 'blog_single_layout',
            'type'     => 'select',
            'title'    =>  esc_html__('Select Single Blog Skin', 'streamvid'), 
            'subtitle' =>  esc_html__('No validation can be done on this field type', 'streamvid'),
            'desc'     =>  esc_html__('Choose layout for single blog (comment,meta, author box...)', 'streamvid'),
            'options'  => array(
                'layout1' => 'Layout 1',
            ),
            'default'  => 'layout1',
        ),
        array(
            'id' => 'select-related-blog',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for Related Post', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'position_sidebar_blog_single',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'full' => 'No Sidebar',
            ),
            'default' => 'right',
        ),
         array(
            'id' => 'select-sidebar-post-single',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for sidebar', 'streamvid'),
            'desc' => esc_html__('Select layout from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
            'required' => array('position_sidebar_blog_single', '!=', 'no_sidebar'),
        ),
        array(
            'id'       => 'single_blog_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Single Blog Image Size', 'streamvid'),
            'default'  => '1170x550'
        ),
        array(
            'id'       => 'single_related_imagesize',
            'type'     => 'text',
            'title'    =>  esc_html__('Related Blog Image Size', 'streamvid'),
            'default'  => '420x240'
        ),
        array(
            'id' => 'select-content-before-footer-blog-single',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select content before footer for archive', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
    ),
);

// -> START Blogs Fields

if ( ! function_exists( 'jws_product_rent_available_fields' ) ) {
	/**
	 * All available fields for Theme Settings sorter option.
	 *
	 * @since 4.5
	 */
	function jws_product_rent_available_fields() {
		$product_attributes = array();
        $fields = array();
		if( function_exists( 'wc_get_attribute_taxonomies' ) ) {
			$product_attributes = wc_get_attribute_taxonomies();
		}
    
		if ( count( $product_attributes ) > 0 ) {
			foreach ( $product_attributes as $attribute ) {
				$fields[ 'pa_'.$attribute->attribute_name ] = $attribute->attribute_label;
			}	
		}

		return $fields;
	}
}

// -> START Login Register Fields
$this->sections[] = array(
    'title' => esc_html__('Login/Register', 'streamvid'),
    'id' => 'login_register',
    'customizer_width' => '300px',
    'icon' => 'el el-unlock',
    'fields' => array(
            array(
                'id'       => 'select-page-login-register-author',
                'type'     => 'switch', 
                'title'    =>  esc_html__('Switch On Login Register To User Page', 'streamvid'),
                'default'  => false,
            ),
            array(
                'id' => 'login_form_redirect',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                'title' => esc_html__('Select Page Form Login Redirect', 'streamvid'),
                'desc' => esc_html__('Select Page Form Login Redirect From: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
            ),
            array(
                'id' => 'logout_form_redirect',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('page'), 'posts_per_page' => -1),
                'title' => esc_html__('Select Page Form Logout Redirect', 'streamvid'),
                'desc' => esc_html__('Select Page Form Logout Redirect From: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=page')) . '" target="_blank">Pages</a>',
            ),
    )
);

$this->sections[] = array(
    'title' => esc_html__('Form Login/Register', 'streamvid'),
    'id' => 'form_login_register',
    'subsection' => true,
    'fields' => array(
        array(
            'id'        => 'form_logo',
            'type'      => 'media',
            'url'       => true,
            'title'     => esc_html__('Form Logo', 'streamvid' ),
            'compiler'  => 'false',
            'subtitle'  => esc_html__('Upload Your Logo', 'streamvid' ),
        ),
     
        array(
            'id'        => 'form_privacy_text',
            'type'             => 'editor',
            'title'            => __('Privacy Policy Text', 'streamvid'), 
            'default'          => 'By registering, you agree to Streamvid\'s <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>',
            'args'   => array(
                'teeny'            => true,
                'textarea_rows'    => 10
            )
        ),
    ),
);


if ( ! function_exists( 'jws_user_featured_list' ) ) {
	/**
	 * All available fields for Theme Settings sorter option.
	 *
	 * @since 4.5
	 */
	function jws_user_featured_list() {

        $blogusers = get_users( );
        // Array of WP_User objects.
        foreach ( $blogusers as $user ) {
            $fields[$user->ID] = $user->display_name;
        }

		return $fields;
	}
}



// -> START 404
$this->sections[] = array(
    'title' => esc_html__('404 Page', 'streamvid'),
    'id' => '404_page',
    'desc' => esc_html__('Select Layout For 404 Page.', 'streamvid'),
    'customizer_width' => '300px',
    'icon' => 'el el-error',
    'fields' => array(
         array(
            'id'       => '404-off-header',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn Off Header', 'streamvid'),
            'default'  => false,
        ),  
         array(
            'id'       => '404-off-footer',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn Off Footer', 'streamvid'),
            'default'  => false,
        ), 
         array(
            'id'       => '404-off-titlebar',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn Off TitleBar', 'streamvid'),
            'default'  => false,
        ),   
        array(
            'id' => 'select-footer-404',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for footer elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for footer elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
         array(
                'id' => 'select-content-404',
                'type' => 'select',
                'data' => 'posts',
                'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
                'title' => esc_html__('Select Content 404', 'streamvid'),
                'desc' => esc_html__('Select content 404 from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
         ),
    )
);
if ( ! function_exists( 'jws_product_available_fields' ) ) {
	/**
	 * All available fields for Theme Settings sorter option.
	 *
	 * @since 4.5
	 */
	function jws_product_available_fields() {
		$product_attributes = array();
        $fields = array();
		if( function_exists( 'wc_get_attribute_taxonomies' ) ) {
			$product_attributes = wc_get_attribute_taxonomies();
		}
    
		if ( count( $product_attributes ) > 0 ) {
			foreach ( $product_attributes as $attribute ) {
				$fields[ 'pa_' . $attribute->attribute_name ] = $attribute->attribute_label;
			}	
		}

		return $fields;
	}
}

// -> START Shop
$this->sections[] = array(
    'title' => esc_html__('Shop', 'streamvid'),
    'id' => 'shop',
    'customizer_width' => '300px',
    'icon' => 'el el-shopping-cart',
    'fields' => array( 
        array(
            'id' => 'select-header-shop',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for header elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for header elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'select-footer-shop',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for footer elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for footer elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'select-before-footer-shop',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for before footer elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for before footer elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'exclude-product-in-shop',
            'type' => 'select',
            'multi' => true,
            'data' => 'posts',
            'args' => array('post_type' => array('product'), 'posts_per_page' => -1),
            'title' => esc_html__('Select product and remove in shop page', 'streamvid'),
        ), 
        array(
            'id' => 'exclude-category-in-shop',
            'type' => 'select',
            'multi' => true,
            'data' => 'terms',
            'args' => array('taxonomy' => array('product_cat'), 'hide_empty' => false),
            'title' => esc_html__('Select category and remove in shop page', 'streamvid'),
        ),
    )
);
$this->sections[] = array(
    'title' => esc_html__('Shop Page', 'streamvid'),
    'id' => 'shop_page',
    'subsection' => true,
    'fields' => array(
         array(
            'id' => 'select-titlebar-shop',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'shop_position_sidebar',
            'type' => 'select',
            'title' => esc_html__('Select Position Sidebar', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'no_sidebar' => 'No Sidebar',
            ),
            'default' => 'no_sidebar',
        ),
          array(
            'id'       => 'shop-fullwidth-switch',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Switch On Shop Full Width', 'streamvid'),
            'default'  => false,
        ),
        array(
            'id' => 'shop_layout',
            'type' => 'select',
            'title' => esc_html__('Archive Layout', 'streamvid'),
            'options' => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
            ),
            'default' => 'layout1',
        ),
        
        array(
            'id' => 'select-banner-before-product',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for banner before product elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for banner before product elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
 

        array(
            'id'=>'product_per_page',
            'type' => 'text',
            'title' =>  esc_html__('Product Per Page', 'streamvid'),
            'subtitle' => __('Please enter the number', 'streamvid'),
            'validate' => 'no_html',
            'default' => '12',
        ),
        array(
            'id' => 'shop_columns',
            'type' => 'select',
            'title' => esc_html__('Select Columns Default', 'streamvid'),
            'options' => array(
                '1' => '1 Columns',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns',
            ),
            'default' => '3',
        ),
        array(
            'id'       => 'columns_review',
            'type'     => 'checkbox',
            'title'    => __('Columns Review', 'streamvid'), 
            'options'  => array(
                '1' => '1 Columns',
                '2' => '2 Columns',
                '3' => '3 Columns',
                '4' => '4 Columns'
            ),
            'default' => array(
                '1' => '1', 
                '2' => '0', 
                '3' => '1',
                '4' => '0'
            )
        ),
        array(
            'id' => 'shop_pagination_layout',
            'type' => 'select',
            'title' => esc_html__('Shop Pagination Layout', 'streamvid'),
            'options' => array(
                'number' => 'Number',
                'loadmore' => 'Load More',
                'infinity' => 'Infinity Loader',
            ),
            'default' => 'number',
        ),

    )
);
$this->sections[] = array(
    'title' => esc_html__('Shop Single', 'streamvid'),
    'id' => 'shop_single',
    'subsection' => true,
    'fields' => array(
         array(
            'id'       => 'product-single-title-bar-switch',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Switch On Title Bar', 'streamvid'),
            'default'  => true,
         ), 
         array(
            'id'       => 'product-single-breadcrumb',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Switch On Breadcrumb Content Left', 'streamvid'),
            'default'  => true,
         ),  
         array(
            'id' => 'select-titlebar-shop-single',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for title bar elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for title bar elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
        array(
            'id' => 'shop_single_layout',
            'type' => 'select',
            'title' => esc_html__('Shop Layout', 'streamvid'),
            'options' => array(
                'default' => 'Default',
            ),
            'default' => 'default',
        ),
        array(
            'id' => 'shop_single_thumbnail_position',
            'type' => 'select',
            'title' => esc_html__('Thumbnail Position', 'streamvid'),
            'options' => array(
                'left' => 'Left',
                'right' => 'Right',
                'bottom' => 'Bottom',
                'bottom2' => 'Bottom 4 Item',
            ),
            'default' => 'left',
        ),
        array(
            'id' => 'shop_related_item',
            'type' => 'select',
            'title' => esc_html__('Select Related Item Number', 'streamvid'),
            'options' => array(
                '3' => '3 Item',
                '4' => '4 Item',
            ),
            'default' => '4',
        ),
        array(
            'id' => 'shop_related_layout',
            'type' => 'select',
            'title' => esc_html__('Related Layout', 'streamvid'),
            'options' => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
            ),
            'default' => 'layout1',
        ),

    )
);

$this->sections[] = array(
    'title' => esc_html__('Questions & Answers', 'streamvid'),
    'id' => 'questions_answers',
    'subsection' => true,
    'fields' => array(
         array(
            'id'       => 'auestions-enble',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Enble Questions & Answers', 'streamvid'),
            'default'  => true,
            'desc'      =>  esc_html__('Show Questions & Answers To Single Product.', 'streamvid'),
        ),
        array(
            'id'        => 'auestions-number',
            'type'      => 'slider',
            'title'     =>  esc_html__('Number Questions & Answers Display', 'streamvid'),
            "default"   => 3,
            "min"       => 1,
            "step"      => 1,
            "max"       => 99,
            'display_value' => 'label'
        ),
 
    )
);



$this->sections[] = array(
    'title' => esc_html__('My Account', 'streamvid'),
    'id' => 'shop_account',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'select-shop-form-login',
            'type' => 'select',
            'data' => 'posts',
            'args' => array('post_type' => array('hf_template'), 'posts_per_page' => -1),
            'title' => esc_html__('Select layout for header elementor', 'streamvid'),
            'desc' => esc_html__('Select layout for header elementor from: ', 'streamvid') . '<a href="' . esc_url(admin_url('/edit.php?post_type=hf_template')) . '" target="_blank">Header Footer Template</a>',
        ),
    )
);
$this->sections[] = array(
    'title' => esc_html__('Wishlist', 'streamvid'),
    'id' => 'wishlist',
    'subsection' => true,
    'fields' => array(
       			array (
				'id'       => 'wishlist',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable wishlist', 'streamvid' ),
				'subtitle' => esc_html__( 'Enable wishlist functionality built in with the theme. Read more information in our documentation.', 'streamvid' ),
				'default'  => true
			),
			array(
				'id'       => 'wishlist_page',
				'type'     => 'select',
				'multi'    => false,
				'data'     => 'posts',
				'args'     => array( 'post_type' =>  array( 'page' ), 'numberposts' => -1 ),
				'title'    => esc_html__( 'Wishlist page', 'streamvid' ),
				'subtitle' => esc_html__( 'Select a page for wishlist table. It should contain the shortcode: [jws_wishlist]', 'streamvid' ),
			),
			array (
				'id'       => 'empty_wishlist_text',
				'type'     => 'textarea',
				'title'    => esc_html__('Empty wishlist text', 'streamvid'),
				'subtitle' => esc_html__('Text will be displayed if user don\'t add any products to wishlist', 'streamvid'),      
				'default'  => 'No products added in the wishlist list. You must add some products to wishlist them.<br> You will find a lot of interesting products on our "Shop" page.',
				'class'   => 'without-border'
			),
    )
);

if(!function_exists('jws_option_categories_for_jws')) {
function jws_option_categories_for_jws($taxonomy, $select = 1)
    {
        $data = array();
    
        $query = new \WP_Term_Query(array(
            'hide_empty' => true,
            'taxonomy'   => $taxonomy,
        ));
        if ($select == 1) {
            $data['all'] = 'All';
        }
    
        if (! empty($query->terms)) {
            foreach ($query->terms as $cat) {
                $data[ $cat->slug ] = $cat->name;
            }
        }
    
        return $data;
    }  
}




// -> START Typography
$this->sections[] = array(
    'title' => esc_html__('Typography', 'streamvid'),
    'id' => 'typography',
    'icon' => 'el el-text-width',
    'fields' => array(
        array(
            'id' => 'opt-typography-body',
            'type' => 'typography',
            'title' => esc_html__('Body Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the body font properties.', 'streamvid'),
            'google' => true,
            'color' => true,
            'subsets' => false,
            'output' => array('body'),
        ),
        
         array(
            'id' => 'opt-typography-font2',
            'type' => 'typography',
            'title' => esc_html__('Font 2', 'streamvid'),
            'google' => true,
            'color' => false,
            'text-align' => false,
            'letter-spacing' => false,
            'text-transform' => false,
            'font-size' => false,
            'subsets' => false,
            'font-weight' => false,
            'line-height' => false
        ),
        
        array(
            'id' => 'opt-typography-h1',
            'type' => 'typography',
            'title' => esc_html__('H1 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h1 font properties.', 'streamvid'),
            'google' => true,
            'subsets' => false,
            'color' => false,
            'output' => array('h1','.h1'),
        ),
        array(
            'id' => 'opt-typography-h2',
            'type' => 'typography',
            'title' => esc_html__('H2 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h2 font properties.', 'streamvid'),
            'google' => true,
            'subsets' => false,
            'color' => false,
            'output' => array('h2','.h2'),
        ),
        array(
            'id' => 'opt-typography-h3',
            'type' => 'typography',
            'title' => esc_html__('H3 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h3 font properties.', 'streamvid'),
            'google' => true,
            'subsets' => false,
            'color' => false,
            'output' => array('h3','.h3'),
        ),
        array(
            'id' => 'opt-typography-h4',
            'type' => 'typography',
            'title' => esc_html__('H4 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h4 font properties.', 'streamvid'),
            'google' => true,
            'color' => false,
            'subsets' => false,
            'output' => array('h4','.h4'),
        ),
        array(
            'id' => 'opt-typography-h5',
            'type' => 'typography',
            'title' => esc_html__('H5 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h5 font properties.', 'streamvid'),
            'google' => true,
            'subsets' => false,
            'color' => false,
            'output' => array('h5','.h5'),
        ),
        array(
            'id' => 'opt-typography-h6',
            'type' => 'typography',
            'title' => esc_html__('H6 Font', 'streamvid'),
            'subtitle' => esc_html__('Specify the h6 font properties.', 'streamvid'),
            'google' => true,
            'color' => false,
            'subsets' => false,
            'output' => array('h6','.h6'),
        ),
        
        
  
  
    )
);

// -> START API Fields
$this->sections[] = array(
    'title' => esc_html__('API And Other Setting', 'streamvid'),
    'id' => 'api',
    'customizer_width' => '300px',
    'icon' => 'el el-network',
    'fields' => array(
        array(
    		'id'     => 'google-api-section-start',
    		'type'   => 'section',
    		'title'  => esc_html__( 'Google Settings', 'streamvid' ),
    		'indent' => true,
    	),
        array(
            'id' => 'google_api',
            'type' => 'text',
            'title' => esc_html__('Google API Key', 'streamvid'),
            'default' => '',
        ),
        array(
    		'id'     => 'google-api-section-end',
    		'type'   => 'section',
    		'indent' => false,
    	),
        array(
    		'id'     => 'other-section-start',
    		'type'   => 'section',
    		'title'  => esc_html__( 'Other Settings', 'streamvid' ),
    		'indent' => true,
    	),
       array(
            'id'       => 'block_user_function',
            'type'     => 'switch', 
            'title'    =>  esc_html__('Turn on blocking user upload media.', 'streamvid'),
            'default'  => false,
       ),
       array(
    		'id'     => 'custom_slug_post',
    		'type'   => 'section',
    		'title'  => esc_html__( 'Custom Slug Url For Post', 'streamvid' ),
    		'indent' => true,
    	),
        array(
            'id'    => 'jws_slug_info',
            'type'  => 'info',
            'title' => __('Note!', 'streamvid'),
            'style' => 'warning',
            'desc' => esc_html__('After changing the slug, save the permalink to update the data. ', 'streamvid') . '<a href="'.esc_url(admin_url('/options-permalink.php')).'" target="_blank">Permalink option</a>',
        ),
        array(
            'id' => 'movies_slug',
            'type' => 'text',
            'title' => esc_html__('Movies Slug', 'streamvid'),
            'desc'  => 'Default slug is "movie" ',
            'default' => '',
        ),
        array(
            'id' => 'tv_shows_slug',
            'type' => 'text',
            'title' => esc_html__('Tv Shows Slug', 'streamvid'),
            'desc'  => 'Default slug is "tv_shows" ',
            'default' => '',
        ),
        array(
            'id' => 'episodes_slug',
            'type' => 'text',
            'title' => esc_html__('Episodes Slug', 'streamvid'),
            'desc'  => 'Default slug is "episodes" ',
            'default' => '',
        ),
        array(
            'id' => 'videos_slug',
            'type' => 'text',
            'title' => esc_html__('Videos Slug', 'streamvid'),
            'desc'  => 'Default slug is "videos" ',
            'default' => '',
        ),
        array(
            'id' => 'person_slug',
            'type' => 'text',
            'title' => esc_html__('Person Slug', 'streamvid'),
            'desc'  => 'Default slug is "person" ',
            'default' => '',
        ),
        

    )
);

// -> START API Fields
$this->sections[] = array(
    'title' => esc_html__('Toolbar Popup', 'streamvid'),
    'id' => 'toolbarfix',
    'customizer_width' => '300px',
    'icon' => 'el el-minus',
    'fields' => array(
        array (
				'id'       => 'toolbar_fix',
				'type'     => 'switch',
				'title'    => esc_html__( 'Toolbar Nav For Tablet And Mobile', 'streamvid' ),
				'default'  => true
		),
        array (
				'id'       => 'toolbar_movies',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Movies', 'streamvid' ),
				'default'  => true
		),
        array (
				'id'       => 'toolbar_tv_shows',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Tv Shows', 'streamvid' ),
				'default'  => true
		),
        array (
				'id'       => 'toolbar_videos',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Tv Videos', 'streamvid' ),
				'default'  => true
		),
        array (
				'id'       => 'toolbar_search',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Search', 'streamvid' ),
				'default'  => true
		),

        array (
				'id'       => 'toolbar_account',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Account', 'streamvid' ),
				'default'  => true
		),
        array(
            'id'         => 'toolbar_custom',
            'type'       => 'repeater',
            'title'      => __( 'Tool Bar Custom', 'streamvid' ),
            'subtitle'   => __( '', 'streamvid' ),
            'desc'       => __( '', 'streamvid' ),
            'group_values' => true, // Group all fields below within the repeater ID
            'item_name' => '', // Add a repeater block name to the Add and Delete buttons
            'fields'     => array(
                array(
                    'id'          => 'toolbar_custom_name',
                    'type'        => 'text',
                    'placeholder' => __( 'Name', 'streamvid' ),
                ),
                array(
                    'id'          => 'toolbar_custom_icon',
                    'type'        => 'text',
                    'placeholder' => __( 'Icon Class', 'streamvid' ),
                ),
                array(
                    'id'          => 'toolbar_custom_link',
                    'type'        => 'text',
                    'placeholder' => __( 'Link', 'streamvid' ),
                ),

            )
        )

    )
);


if (file_exists(dirname(__FILE__) . '/../README.md')) {
    $this->sections[] = array(
        'icon' => 'el el-list-alt',
        'title' => esc_html__('Documentation', 'streamvid'),
        'fields' => array(
            array(
                'id' => '17',
                'type' => 'raw',
                'markdown' => true,
                'content_path' => dirname(__FILE__) . '/../README.md', // FULL PATH, not relative please
                //'content' => 'Raw content here',
            ),
        ),
    );

}
				
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'streamvid' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'streamvid' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'streamvid' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'streamvid' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'streamvid' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'jws_option',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'submenu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Theme Options', 'streamvid' ),
                    'page_title'           => __( 'Theme Options', 'streamvid' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => '',
                    // Set a different name for your global variable other than the opt_name
                    'dev_mode'             => false,
                    // Show the time the page took to load, etc
                    'update_notice'        => false,
                    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                    'customizer'           => true,
                    // Enable basic customizer support
                    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                    // OPTIONAL -> Give you extra features
                    'page_priority'        => null,
                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                    'page_parent'          => 'jws_settings',
                    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                    'page_permissions'     => 'manage_options',
                    // Permissions needed to access the options panel.
                    'menu_icon'            => '',
                    // Specify a custom URL to an icon
                    'last_tab'             => '',
                    // Force your panel to always open to a specific tab (by id)
                    'page_icon'            => 'icon-themes',
                    // Icon displayed in the admin panel next to your menu_title
                    'page_slug'            => 'jws_option',
                    // Page slug used to denote the panel
                    'save_defaults'        => true,
                    // On load save the defaults to DB before user clicks save or not
                    'default_show'         => false,
                    // If true, shows the default value next to each field that is not the default value.
                    'default_mark'         => '',
                    // What to print by the field's title if the value shown is default. Suggested: *
                    'show_import_export'   => true,
                    // Shows the Import/Export panel when not used as a field.

                    // CAREFUL -> These options are for advanced use only
                    'transient_time'       => 60 * MINUTE_IN_SECONDS,
                    'output'               => true,
                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                    'output_tag'           => true,
                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                    'database'             => '',
                    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                    'system_info'          => false,
                    // REMOVE

                    // HINTS
                    'hints'                => array(
                        'icon'          => 'icon-question-sign',
                        'icon_position' => 'right',
                        'icon_color'    => 'lightgray',
                        'icon_size'     => 'normal',
                        'tip_style'     => array(
                            'color'   => 'light',
                            'shadow'  => true,
                            'rounded' => false,
                            'style'   => '',
                        ),
                        'tip_position'  => array(
                            'my' => 'top left',
                            'at' => 'bottom right',
                        ),
                        'tip_effect'    => array(
                            'show' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'mouseover',
                            ),
                            'hide' => array(
                                'effect'   => 'slide',
                                'duration' => '500',
                                'event'    => 'click mouseleave',
                            ),
                        ),
                    )
                );
				
                // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Visit us on GitHub',
                    'icon'  => 'el-icon-github'
                    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Like us on Facebook',
                    'icon'  => 'el-icon-facebook'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Follow us on Twitter',
                    'icon'  => 'el-icon-twitter'
                );
                $this->args['share_icons'][] = array(
                    'url'   => '#',
                    'title' => 'Find us on LinkedIn',
                    'icon'  => 'el-icon-linkedin'
                );
            }

            public function validate_callback_function( $field, $value, $existing_value ) {
                $error = true;
                $value = 'just testing';

                /*
              do your validation

              if(something) {
                $value = $value;
              } elseif(something else) {
                $error = true;
                $value = $existing_value;
                
              }
             */

                $return['value'] = $value;
                $field['msg']    = 'your custom error message';
                if ( $error == true ) {
                    $return['error'] = $field;
                }

                return $return;
            }

            public function class_field_callback( $field, $value ) {
                print_r( $field );
                echo '<br/>CLASS CALLBACK';
                print_r( $value );
            }

        }

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_theme_config();
    } else {
        echo "The class named Redux_Framework_theme_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ):
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    endif;

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ):
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            
          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }
    endif;


    if( ! function_exists('jws_theme_get_option') ){
        function jws_theme_get_option($name, $default=false){
            global $jws_option;
            return isset( $jws_option[ $name ] ) ? $jws_option[ $name ] : $default;
        }
    }

    if( ! function_exists('jws_theme_update_option') ){
        function jws_theme_update_option($name, $value){
            global $jws_option;
            $jws_option[ $name ] = $value;
        }
    }