<?php
/**
 * Render custom styles.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'jws_custom_css' ) ) {
	function jws_custom_css( $css = array() ) {
    $page_id     = get_queried_object_id();

    $main_color_custom = get_post_meta($page_id, 'main_color', true);
    $bg_btn_color_custom = get_post_meta($page_id, 'button-bgcolor', true);
    $bg_btn_color2_custom = get_post_meta($page_id, 'button-bgcolor2', true);
    global $jws_option;
        /* Main Width */
        
  
        
        $website_width = (isset($jws_option['container-width']) && $jws_option['container-width']) ? $jws_option['container-width'] : '1200';
        $website_padding = (isset($jws_option['container-padding']) && $jws_option['container-padding']) ? $jws_option['container-padding'] : '70';
        $container_layout = (isset($jws_option['container_layout']) && $jws_option['container_layout']) ? $jws_option['container_layout'] : 'box';
        $blog_container_layout = (isset($jws_option['blog_container_layout']) && $jws_option['blog_container_layout']) ? $jws_option['blog_container_layout'] : '';
  
        $main_color = (isset($jws_option['main-color']) && $jws_option['main-color']) ? $jws_option['main-color'] : '#7B61FF';
        $secondary_color = (isset($jws_option['secondary-color']) && $jws_option['secondary-color']) ? $jws_option['secondary-color'] : '#c89263';
        $third_color = (isset($jws_option['third-color']) && $jws_option['third-color']) ? $jws_option['third-color'] : '#6e8695';
        $body_color = (isset($jws_option['color_body']) && $jws_option['color_body']) ? $jws_option['color_body'] : '#ffffff';
        $color_heading = (isset($jws_option['color_heading']) && $jws_option['color_heading']) ? $jws_option['color_heading'] : '';
        
        $light_color = (isset($jws_option['color_light']) && $jws_option['color_light']) ? $jws_option['color_light'] : '#ffffff';
        $bg_btn_color = (isset($jws_option['button-bgcolor']) && $jws_option['button-bgcolor']) ? $jws_option['button-bgcolor'] : '';
        $bg_btn_color2 = (isset($jws_option['button-bgcolor2']) && $jws_option['button-bgcolor2']) ? $jws_option['button-bgcolor2'] : '';
        $bg_btn_color3 = (isset($jws_option['button-bgcolor3']) && $jws_option['button-bgcolor3']) ? $jws_option['button-bgcolor3'] : '';
        $btn_color = (isset($jws_option['button-color']) && $jws_option['button-color']) ? $jws_option['button-color'] : '';
        $btn_color2 = (isset($jws_option['button-color2']) && $jws_option['button-color2']) ? $jws_option['button-color2'] : '';
        
        
        $input_bg = (isset($jws_option['input_bg']) && $jws_option['input_bg']) ? $jws_option['input_bg'] : '';
        $body_bg_color = (isset($jws_option['bg_body']['background-color']) && !empty($jws_option['bg_body']['background-color'])) ? $jws_option['bg_body']['background-color'] : '#00031c';
        
           
        if('post' == get_post_type() && !empty($blog_container_layout)) {
            $container_layout = $blog_container_layout;
        }


        if($container_layout != 'full') {
            if ( $website_width ) { 
                $css[] = '.container , .elementor-section.elementor-section-boxed > .elementor-container , .shop-single .woocommerce-notices-wrapper { max-width: ' . esc_attr( $website_width ) . 'px}';  
            }
        }else{
           $css[] = '.container , .elementor-section.elementor-section-boxed > .elementor-container , .shop-single .woocommerce-notices-wrapper { max-width:100%}';  
           if($website_padding) {
               $css[] = 'body { --container-padding:0 '.$website_padding['padding-right'].' 0 '.$website_padding['padding-left'].'}';  
           } 
        }
        
        
        
        
        if(!empty($input_bg)) {
          $css[] = 'body {--background-item:' . esc_attr( $input_bg ) . '; --input-background: ' . esc_attr( $input_bg ) . '}';   
        }
        if(!empty($main_color)) {
          $css[] = 'body {--e-global-color-primary:' . esc_attr( $main_color ) . '; --main: ' . esc_attr( $main_color ) . '}';   
        }
        if(!empty($secondary_color)) {
          $css[] = 'body {--secondary: ' . esc_attr( $secondary_color ) . '}';   
        }
        if(!empty($third_color)) {
          $css[] = 'body {--third: ' . esc_attr( $third_color ) . '}';   
        }
        if(!empty($body_color)) {
          $css[] = 'body {--body:' . esc_attr( $body_color ) . '}';   
        }
        if(!empty($color_heading)) {
          $css[] = 'body {--heading:' . esc_attr( $color_heading ) . '}';   
        }
        if(!empty($light_color)) {
          $css[] = 'body {--light:' . esc_attr( $light_color ) . '}';   
        }
        if(!empty($bg_btn_color)) {
          $css[] = 'body {--btn-bgcolor:' . esc_attr( $bg_btn_color ) . '}';   
        }
        if(!empty($bg_btn_color2)) {
          $css[] = 'body {--btn-bgcolor2:' . esc_attr( $bg_btn_color2 ) . '}';   
        }
        if(!empty($bg_btn_color2)) {
          $css[] = 'body {--btn-bgcolor3:' . esc_attr( $bg_btn_color3 ) . '}';   
        }
        if(!empty($btn_color)) {
          $css[] = 'body {--btn-color:' . esc_attr( $btn_color ) . '}';   
        }
        if(!empty($btn_color2)) {
          $css[] = 'body {--btn-color2:' . esc_attr( $btn_color2 ) . '}';   
        }
        if(!empty($body_bg_color)) {
          $css[] = 'body {--background-body:' . esc_attr( $body_bg_color ) . '}';   
        }
        
        
        /* Custom Page Color */
        
        if(!empty($main_color_custom)) {
          $css[] = 'body {--e-global-color-primary:' . esc_attr( $main_color_custom ) . ' !important; --main: ' . esc_attr( $main_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color_custom)) {
          $css[] = 'body {--btn-bgcolor: ' . esc_attr( $bg_btn_color_custom ) . '}';   
        }
        if(!empty($bg_btn_color2_custom)) {
          $css[] = 'body {--btn-bgcolor2: ' . esc_attr( $bg_btn_color2_custom ) . '}';   
        }
        
         /* Custom Font Family */
         $font2 = (isset($jws_option['opt-typography-font2']['font-family']) && $jws_option['opt-typography-font2']['font-family']) ? $jws_option['opt-typography-font2']['font-family'] : 'Metropolitano';
         $body_font = (isset($jws_option['opt-typography-body']['font-family']) && $jws_option['opt-typography-body']['font-family']) ? $jws_option['opt-typography-body']['font-family'] : 'Metropolitano';
         $css[] = 'body {--body-font: ' . esc_attr( $body_font ) . ';--font2: ' . esc_attr( $font2 ) . ';}'; 

        $header_absolute = (isset($jws_option['choose-header-absolute']) && $jws_option['choose-header-absolute']) ? $jws_option['choose-header-absolute'] : '';
        $header_absolute_page = get_post_meta($page_id, 'page_header_absolute', true);
      
         if(isset($header_absolute_page) && !empty($header_absolute_page))   {
            if($header_absolute_page == 'on') {
                $css[] ='.jws_header > .elementor {position:absolute;width:100%;left:0;top:0;}' ; 
            }
         }else {
            if(!empty($header_absolute)) {
                foreach($header_absolute as $value) {
                   $css[] ='.jws_header > .elementor-'.$value.'{position:absolute;width:100%;left:0;top:0;}' ;  
                }
             }
         }
         

		return preg_replace( '/\n|\t/i', '', implode( '', $css ) );
	}
}