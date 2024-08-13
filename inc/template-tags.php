<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
// **********************************************************************// 
// ! Add favicon 
// **********************************************************************// 
if (!function_exists('jws_favicon')) {
    function jws_favicon()
    {

        if (function_exists('has_site_icon') && has_site_icon()) return '';

        // Get the favicon.
        $favicon = '';


        global $jws_option;
        
        if(isset($jws_option['favicon']) && !empty($jws_option['favicon'])) {
            $favicon = $jws_option['favicon']['url'];
        }

        ?>
        <link rel="shortcut icon" href="<?php echo esc_attr($favicon); ?>">
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo esc_attr($favicon); ?>">
        <?php
    }

    add_action('wp_head', 'jws_favicon');
}

if (!function_exists('jws_logo_url')) {
    function jws_logo_url()
    {

        $logo = '';
        global $jws_option;
        
        if(isset($jws_option['logo']) && !empty($jws_option['logo'])) {
            if(!empty($jws_option['logo'])) {
                $logo = $jws_option['logo']['url'];
            }
        }
        
        return $logo;

      
    }
}

//Lets add Open Graph Meta Info
 
function jws_insert_fb_in_head() {
    global $post;
    if ( !is_singular()) //if it is not a post or a page
        return;
        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'.get_bloginfo( 'name' ).'"/>';
    if(has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        echo '<meta property="og:image" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : '' ) . '"/>';
        echo '<meta property="og:image:secure_url" content="' . esc_attr( !empty($thumbnail_src[0]) ? $thumbnail_src[0] : ''  ) . '">';
        echo '<meta property="og:image:width" content="500">';
        echo '<meta property="og:image:height" content="400">';
    }

    echo "
";
}
add_action( 'wp_head', 'jws_insert_fb_in_head', 5 );


/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
add_action( 'wp_footer', 'jws_back_top_top'); 
function jws_back_top_top() {
    
    if(is_embed()) return;
    
    global $jws_option;
 
    $class = 'backToTop fas fa-arrow-up ';
    ?>
        <a href="#" class="<?php echo esc_attr($class); ?>"></a>
    <?php
}

/**
 * Add toolbar for mobile.
 **/
add_action( 'wp_footer', 'jws_toolbar_mobile'); 

function jws_toolbar_mobile() {
    
    if(is_embed()) return;
     
    $enable = jws_theme_get_option('toolbar_fix');
  
       if(get_post_meta( get_the_ID(), 'tool_bar_checkbox', 1 )) {
           $enable = false;
       }  
 
     
    if ($enable) { 
    if(function_exists('jws_check_layout_shop')) {
         $shop = jws_check_layout_shop();
    }    
   
    ?>
        <div class="jws-toolbar-wap">
            <?php  if((is_home() && ((isset($_GET['sidebar']) && $_GET['sidebar'] != 'full') || !isset($_GET['sidebar'])) ) || (is_single() && 'post' == get_post_type() && !isset($_GET['sidebar']))) : ?>
            <div class="jws-toolbar-item">
                <a class="show_filter_shop" href="javascript:void(0)">
                    <i aria-hidden="true" class="jws-icon-dots-three-outline-vertical"></i>
                    <span><?php echo esc_html__('Sidebar','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php  if(isset($shop) && is_shop() && ($shop['filter_layout'] == 'sideout' || $shop['position'] == 'left' || $shop['position'] == 'right')) : ?>
            <div class="jws-toolbar-item">
                <a class="show_filter_shop" href="javascript:void(0)">
                    <i aria-hidden="true" class="jws-icon-funnel"></i>
                    <span><?php echo esc_html__('Filter','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php if(jws_theme_get_option('toolbar_movies')) : ?>
            <div class="jws-toolbar-item">
                <a href="<?php echo get_post_type_archive_link( 'movies' ); ?>">
                    <i aria-hidden="true" class="jws-icon-film-strip"></i>
                    <span><?php echo esc_html__('Movies','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php if(jws_theme_get_option('toolbar_tv_shows')) : ?>
            <div class="jws-toolbar-item">
                <a href="<?php echo get_post_type_archive_link( 'tv_shows' ); ?>">
                    <i aria-hidden="true" class="jws-icon-television"></i>
                    <span><?php echo esc_html__('Tv Shows','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php if(jws_theme_get_option('toolbar_videos')) : ?>
            <div class="jws-toolbar-item">
                <a href="<?php echo get_post_type_archive_link( 'videos' ); ?>">
                    <i aria-hidden="true" class="jws-icon-play-circle"></i>
                    <span><?php echo esc_html__('Videos','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php if(jws_theme_get_option('toolbar_search')) : ?>
            <div class="jws-toolbar-item">
                <a class="jws_toolbar_search" href="#" data-modal-jws="#form_content_popup">
                    <i aria-hidden="true" class="jws-icon-magnifying-glass"></i>
                    <span><?php echo esc_html__('Search','streamvid'); ?></span>
                </a>
            </div>
            <?php endif; ?>
            <?php if(jws_theme_get_option('toolbar_account')) : ?>
            <div class="jws-toolbar-item">
                <a class="jws-open-login<?php if(is_user_logged_in()) echo ' logged'; ?>" href="<?php echo get_author_posts_url( get_current_user_id() ); ?>">
                    <i aria-hidden="true" class="jws-icon-user-circle"></i>
                    <span><?php echo esc_html__('My account','streamvid'); ?></span>
                </a>
            </div>
             <?php endif; ?>
             
            <?php 
                $custom_toolbar = jws_theme_get_option('toolbar_custom');
                $i = 0;
                if(!empty($custom_toolbar['redux_repeater_data'])) {
                   foreach($custom_toolbar['redux_repeater_data'] as $value) {
                        if(!empty($custom_toolbar['toolbar_custom_link'][$i])) {
                        ?>
                          <div class="jws-toolbar-item">
                                <a href="<?php echo esc_url($custom_toolbar['toolbar_custom_link'][$i]); ?>">
                                    <i aria-hidden="true" class="<?php echo esc_attr($custom_toolbar['toolbar_custom_icon'][$i]); ?>"></i>
                                    <span><?php echo esc_html($custom_toolbar['toolbar_custom_name'][$i]); ?></span>
                                </a>
                          </div>
                        <?php
                        }
                    $i++;} 
                }
             ?> 
        </div>
    <?php
    }
}


/**
 * Add form login.
 **/
add_action( 'wp_footer', 'jws_form_login_popup'); 
function jws_form_login_popup() {
    if(is_embed()) return;
    global $jws_option;
    ?>
        <div class="jws-form-login-popup jws-scrollbar">
            <div class="jws-form-overlay"></div>
            <div class="jws-form-content">
                <div class="jws-close"><i aria-hidden="true" class="jws-icon-x"></i></div>
                <?php jws_get_content_form_login(true,true,'login'); ?>
            </div>
        </div>
    <?php
}

/**
 * Add form search.
 **/
add_action( 'wp_footer', 'jws_form_search_popup'); 
function jws_form_search_popup() {
if(is_embed()) return;
global $jws_option;
?>    
<div id="form_content_popup" class="form_content_popup mfp-hide"> 
<div class="jws-search-form">
    	<form role="search" method="get" class="searchform jws-ajax-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" data-count="20" data-post_type="movies" data-thumbnail="1" data-price="1">
			<?php 

                $args = array( 
        			'hide_empty' => 1,
        			'parent' => 0
        		);
                $option = jws_theme_get_option('exclude-category-in-shop');
                if(!empty($option)) {
                  $args['exclude'] = $option;  
                }
            ?>
            <select class="choose-post">
                <option value="movies"><?php echo esc_html__('Movies','streamvid'); ?></option>
                <option value="tv_shows"><?php echo esc_html__('Tv Shows','streamvid'); ?></option>
                <option value="videos"><?php echo esc_html__('Videos','streamvid'); ?></option>
                <?php if (class_exists('Woocommerce')) : ?>
                <option value="product"><?php echo esc_html__('Product','streamvid'); ?></option>
                <?php endif; ?>
            </select>
            <input type="text" class="s" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'streamvid' ); ?>..." value="<?php echo get_search_query(); ?>" name="s" />
			<input type="hidden" name="post_type" value="movies">
			<button type="submit" class="searchsubmit">
		       <i aria-hidden="true" class="jws-icon-magnifying-glass"></i>
			</button>
            <span class="form-loader">
            </span>
		</form>
        <div class="search-results-wrapper"><div class="jws-search-results row jws-scrollbar"></div></div>
</div>   
</div>
<?php
}

/**
 * Add newseleter popup.
 **/
add_action( 'wp_footer', 'jws_form_newsletter_popup'); 
function jws_form_newsletter_popup() {
    if(is_embed()) return;    
    global $jws_option;
    if(jws_theme_get_option('newsletter_enble') && !is_page( 'Landing Page' ) && (did_action( 'elementor/loaded' ) && !\Elementor\Plugin::$instance->preview->is_preview_mode()))    :
    ?>
        <div class="jws-newsletter-popup mfp-hide">
            <div class="jws-form-content">
                <div class="newsletter-content">
                    <?php 
                        if(isset($jws_option['newsletter_content'])){
                             echo do_shortcode('[hf_template id="'.$jws_option['newsletter_content'].'"]');
                        }
                    ?>
               </div>
            </div>
        </div>
    <?php endif; ?>    
    <?php
}


/**
 * Add extra initialisation for Contact 7 Form in Elementor popups.
 **/
function jws_ct_body_classes( $classes ) {
    if(is_embed()) return $classes;
    global $jws_option;
    $layout = (isset($jws_option['button-layout'])) ? $jws_option['button-layout'] : 'default';
    $tool_bar = jws_theme_get_option('toolbar_fix');
    $classes[] = 'button-'.$layout;
    if ( !is_user_logged_in() ) {
            $classes[] = 'user-not-logged-in';
    }
    
    if($tool_bar) {
        $classes[] = 'has-tool-bar';
    }

    
    if(isset($jws_option['shop_single_layout'])) {
       $classes[] = 'single-product-'.$jws_option['shop_single_layout']; 
    }
    
    
    if(isset($jws_option['container_layout'])) {
       $classes[] = 'container-'.$jws_option['container_layout']; 
    }

    /** rtl **/
    $classes[] = (isset($jws_option['rtl']) && $jws_option['rtl']) ? 'rtl' : '';
    
    
    $header_side = get_post_meta( get_the_ID(), 'turn_on_header_sidebar', 1 );
     
    $header_side = $header_side ? $header_side : jws_theme_get_option('enable-header-side');
    if($header_side)  {
        $classes[] = 'has-header-side';
    }
    
    
    if(isset($_GET['absolute']) && $_GET['absolute'] == 'true') {
        $classes[] = 'header-absolute';
    }
    
    if (!defined('streamvidcore') )  {
        $classes[] = 'elementor-not-load';
    }
    
      
    return $classes;
}
add_filter( 'body_class','jws_ct_body_classes' );

function jws_mini_cart_content2() { ?>
        <div class="jws-mini-cart-wrapper">
            <div class="jws-cart-sidebar">
                <div class="jws_cart_content">
                </div>
            </div>
            <div class="jws-cart-overlay"></div>
        </div>   
<?php }
if (class_exists('Woocommerce')) { 
   add_action( 'wp_footer', 'jws_mini_cart_content2' ); 
}

function jws_filter_backups_demos($demos)
	{
		$demos_array = array(
			'streamvid' => array(
				'title' => esc_html__('streamvid', 'streamvid'),
				'screenshot' => 'https://jwsuperthemes.com/import_demo/streamvid/screenshot.jpg',
				'preview_link' => 'https://streamvid.jwsuperthemes.com/',
			),
		);
        $download_url = 'https://jwsuperthemes.com/import_demo/streamvid/download-script/';
		foreach ($demos_array as $id => $data) {
			$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
				'url' => $download_url,
				'file_id' => $id,
			));
			$demo->set_title($data['title']);
			$demo->set_screenshot($data['screenshot']);
			$demo->set_preview_link($data['preview_link']);
			$demos[$demo->get_id()] = $demo;
			unset($demo);
		}
		return $demos;
}
add_filter('fw:ext:backups-demo:demos', 'jws_filter_backups_demos');
if (!function_exists('jws_deactivate_plugins')){
	function jws_deactivate_plugins() {
		deactivate_plugins(array(
			'brizy/brizy.php'
		));    
		
	}
}
add_action( 'admin_init', 'jws_deactivate_plugins' );


add_action( 'admin_menu', 'jws_add_menu_page' );
if(!function_exists('jws_add_menu_page')) {
  function jws_add_menu_page() {
    add_menu_page( 'Jws Settings', 'Jws Settings', 'manage_options', 'jws_settings', 'jws_settings', '', 1 );
  }  
}

function purchase_code_page() {
   add_submenu_page(
    'jws_settings',
    'Check Purchase Code',
    'Check Purchase Code',
    'manage_options',
    'purchase_code',
    'jws_settings', 1  );  
}

add_action( 'admin_menu', 'purchase_code_page' );

function jws_settings() {
    
    
    $jws_purchase_code = get_option( 'jws_purchase_code' );
    $jws_token = get_option( 'jws_token' );  

    ?>
    
    
    <form class="form-wrap" id="check_purchase_code">
    
        
        <h4><?php echo esc_html__('Check Purchase Code','streamvid'); ?></h4>  
        
        <div>
        
            <?php 
                
                echo esc_html__('Verify the license to be able to plugin update functionality.','streamvid');
            
            
            ?>
        
        </div>
          
        <p class="form-field"><label><?php echo esc_html__('Your personal tokens','streamvid'); ?></label><input type="text" value="<?php echo isset($jws_token) ?  $jws_token : ''; ?>" name="token" /></p>
        
        <p class="form-field"><label><?php echo esc_html__('Purchase Code','streamvid'); ?></label><input type="text" value="<?php echo isset($jws_purchase_code) ?  $jws_purchase_code : ''; ?>" name="purchase_code" /></p>
        
 
        <p class="form-field"><button class="button button-primary" type="submit"><?php echo esc_html__('Submit','streamvid'); ?></button></p>
        
        
        <div class="data-return">
            
            <?php
            
    
               if(get_option('jws_license') == 'good') {
                 $data_li = get_option('jws_license_data');   
                 echo '<span class="success">'.esc_html__('Successful License.','mikalto').'</span>';
                 if(!empty($data_li)) {
                    echo '<div>';
                     
                        echo '<span>'.esc_html__('Sold at: ','mikalto').$data_li['sold_at'].'</span>';
                        echo '<span>'.esc_html__('License: ','mikalto').$data_li['license'].'</span>';
                     
                    echo '</div>';
                 }
                 
                 
                 
               } else {
                
                 echo '<span class="error">'.esc_html__('You haven\'t verified your license yet.','mikalto').'</span>';
                    
               }
            
             ?>
        
        
        </div>
        
        <div class="note">
        
        
            <a href="https://build.envato.com/my-apps/" target="_blank"> <?php echo esc_html__('Create your personal tokens here','streamvid'); ?> </a>
            
            <p>And add these 3 permissions to the token.</p>
            
            <ul>
                <li>View and search Envato sites</li>
                <li>Verify purchases of your items</li>
                <li>Verify purchases you've made</li>
            </ul>
        
        </div>
        
    </form>
    
    
    <?php

}

  
add_action('wp_ajax_check_purchase_code','check_purchase_code');
  

function check_purchase_code() {
    
    $args = wp_parse_args( $_POST, array(
        'purchase_code'  =>  '',
        'token'  =>  '',
        'item_id' => '46440024'
    ) );

    extract( $args );
    
        if(isset($purchase_code)) {
             update_option( 'jws_purchase_code', $purchase_code );
        }
        
        if(isset($token)) {
             update_option( 'jws_token', $token );
        }


        $url = "https://api.envato.com/v3/market/buyer/purchase?code=$purchase_code";
        
        $headers = array(
            'Authorization' => "Bearer $token",
            "User-Agent: Purchase code verification script"
        );
        
        $response = wp_remote_get($url, array('headers' => $headers));
        
        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code === 401 || $response_code === 404 || $response_code === 403) { 
            
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            wp_send_json_error( $data );
            
        }   
        if ($response_code === 200) {
            
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
       
            
            if ($data['item']['id'] == $item_id) {

                update_option( 'jws_license', 'good' );
                update_option( 'jws_license_data', array('sold_at' => $data['sold_at'],'license' => $data['license']) );
                wp_send_json_success($data);
                
            } else {
                update_option( 'jws_license', 'bad' );
                wp_send_json_error(array('error'=>'This code is not from the theme author.'));
                
            }
            
            
        } else {
            
            update_option( 'jws_license', 'bad' );
            
        }
        
        wp_send_json_error( array('error'=>'Purchase code is incorrect.') );
 
}         
        


// Hide all posts from users who are not logged-in or are not administrators or members
function jws_exclude_posts($query) {
  global $jws_option;
  $meta_query = (array) $query->get( 'meta_query' );
  if(isset($jws_option['exclude-blog']) && !empty($jws_option['exclude-blog'])) {
     $result = array_map('intval', array_filter($jws_option['exclude-blog'], 'is_numeric'));
     if(!is_admin() && $query->is_main_query() && !is_single()){
        set_query_var('post__not_in', $result);
    }  
  }
  if ( $query->is_post_type_archive( 'questions' ) && $query->is_main_query() && ! is_admin() ) {
    $query->set( 'posts_per_page', jws_theme_get_option('auestions-number') );
    if(isset($_GET['product_questions'])) {
        
         $meta_query[] = array(
            array(
    				'key'     => 'product_questions',
    				'value'   => sanitize_text_field( $_GET['product_questions'] ),
    				'compare' => 'LIKE',
    		)
       ) ;
	
    }
     
  }
  
   if($query->is_main_query() && ! is_admin()) { 
    
       if(isset($_GET['years']) && !empty($_GET['years'])) { 
            $meta_values = explode( ',', $_GET['years'] );
            $meta_query[] = array(
           
                array(
        				'key'     => 'videos_years',
        				'value'   => $meta_values,
        				'compare' => 'IN',
        		)
           ) ;
            
        }
        
            
  
        if(isset($_GET['sortby']) && !empty($_GET['sortby'])) {
            
            
            if($_GET['sortby'] == 'date') {
                $orderby = 'date';
            }
            if($_GET['sortby'] == 'title') {
                $orderby = 'title';
                $query->set( 'order', 'ASC' );
            }
            if($_GET['sortby'] == 'likes' || $_GET['sortby'] == 'views') {
                $orderby = 'meta_value_num';
                $query->set( 'meta_key' ,$_GET['sortby'] );
    		    $query->set( 'type', 'NUMERIC' );
            }
         
            $query->set( 'orderby', $orderby );
    	
            
        }
        
        if(isset($_GET['starts_with']) && !empty($_GET['starts_with'])) { 
            $starts_with = explode( ',', $_GET['starts_with'] );
            $query->set( 'title_starts_with',  $starts_with );
        }
        
   }

  
  if(($query->is_post_type_archive( 'movies' ) || is_tax('movies_cat')) && $query->is_main_query() && ! is_admin()) {

    $query->set( 'posts_per_page', jws_theme_get_option('movies_number') );
    if(isset($_GET['orderby'])) {
        $query->set( 'orderby', 'rand' );
    }
        
    
  }
  

  if(($query->is_post_type_archive( 'tv_shows' ) || is_tax('tv_shows_cat')) && $query->is_main_query() && ! is_admin()) {
   
    $query->set( 'posts_per_page', jws_theme_get_option('tv_shows_number') );

   
  }
  
  
  if(($query->is_post_type_archive( 'videos' ) || is_tax('videos_cat')) && $query->is_main_query() && ! is_admin()) { 
    
        $query->set( 'posts_per_page', jws_theme_get_option('videos_number') );
        
        if(isset($_GET['live']) && !empty($_GET['live'])) { 
            $meta_query[] = array(
                array(
        				'key'     => 'live_data',
        				'value' => '',
                        'compare' => '!='
        		)
           ) ;
            
        }
  }
  
if($query->is_post_type_archive( 'person' ) && $query->is_main_query() && ! is_admin()) {
    
    $query->set( 'posts_per_page', jws_theme_get_option('person_number') );
  
}

 $query->set( 'meta_query', $meta_query );
  
}
add_action('pre_get_posts', 'jws_exclude_posts');


add_filter('posts_where', 'jws_posts_where' , 10, 2);

function jws_posts_where( $where , $query ) {
    $wpdb = $GLOBALS['wpdb'];
    $starts_with = $query->get('title_starts_with');
  

    if (empty($starts_with) || !is_array($starts_with)) {
        return $where;
    }  
    $where .= ' AND (1=0';
  
    foreach ($starts_with as $sw) {
            $sw = esc_sql($sw);
            if($sw == 'number')  {
                $where .= $wpdb->prepare(" OR $wpdb->posts.post_title REGEXP %s", '^[0-9]');
            } else {
                $where .= $wpdb->prepare(" OR $wpdb->posts.post_title LIKE %s", $sw . '%');
            } 
    }
    $where .= ')';
    return $where;
}


add_filter( 'comments_template','comments_template_loader');

function comments_template_loader($template ) {
    
    $post_type = get_post_type();

        if ( ! in_array( $post_type, array( 'episodes', 'tv_shows', 'videos', 'movies' ) ) ) {
            return $template;
        }
        
         return JWS_ABS_PATH.'/template-parts/custom_review/review.php';
        
}


function jws_content_show_more( $content = '' ){

	if( empty( $content ) || (get_post_type() != 'videos' && get_post_type() != 'movies' && get_post_type() != 'tv_shows' &&  get_post_type() != 'person') || ! is_main_query()){
		return $content;
	}
    
    if(!jws_theme_get_option('read_js_content')) {
        return $content;
    }

	$new_content = '';

	$new_content = sprintf(
		'<div class="js-content">%s</div>',
		$content
	);

	$new_content .= '<button class="view-more-content reset-button fs-small fw-700 cl-heading">'.esc_html__('Show More','streamvid').'<i class="jws-icon-caret-down"></i></button>';

	return sprintf(
		'<div class="js-content-container">%s</div>',
		$new_content
	);
}
add_filter( 'the_content', 'jws_content_show_more', 9999, 1 );