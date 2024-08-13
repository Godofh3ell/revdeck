<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}
function alnuar_auto_login_new_user_after_registration( $user_id ) {

		if (isset($_POST['password'])) {
			wp_set_password( $_POST['password'], $user_id ); //Password previously checked in add_filter > registration_errors
		}
	

}
add_action( 'user_register', 'alnuar_auto_login_new_user_after_registration' );

function auto_redirect_after_logout(){
   global $jws_option;  
   if(isset($jws_option['logout_form_redirect']) && !empty($jws_option['logout_form_redirect'])) {
      $login_redirect = get_page_link($jws_option['logout_form_redirect']);
   }else {
      $login_redirect = home_url('/');
   }  
  wp_safe_redirect($login_redirect);
  exit;
}
add_action('wp_logout','auto_redirect_after_logout');


if (!function_exists('jws_get_content_form_login')) {
    function jws_get_content_form_login($show_login,$show_register,$active)
    {       
    global $jws_option;    
    $registration_enabled = get_option( 'users_can_register' );
    $active_login = $active_signup = '';
    if($active == 'login' && !isset($_GET['signup'])) {
        $active_class = ' in-login';
    }
    if($active == 'signup' || (isset($_GET['signup']) && $_GET['signup'] == 'true')) {
        $active_class = ' in-register';
    }
    
    $account_link = class_exists('Woocommerce') ? wc_get_page_permalink( 'myaccount' ) : home_url( '/' );  
    $wc_lostpassword_url = class_exists('Woocommerce') ? wc_lostpassword_url() : wp_lostpassword_url();  
      if(isset($jws_option['form_logo']['id'])) {
            $logo = $jws_option['form_logo']['id'];
        }
     ?>

    <div id="jws-login-form" class="jws-login-form<?php echo esc_attr($active_class); ?>">
		<div class="jws-login-container">
            <div class="jws-animation">
                    <div class="form-head">
                      <?php
                      
                        if(isset($logo)) {
                           $image = jws_image_advanced(array('attach_id' => $logo, 'thumb_size' => 'full'));
                           echo '  <div class="logo">'.$image.'</div>'; 
                            
                        }
                      
                       ?>  
                    
                      <div class="lg">
                        <h5 class="heading-form"><?php echo esc_html__('Welcome Back!','streamvid') ?></h5>
                      </div>
                      <div class="rg">
                        <h5 class="heading-form"><?php echo esc_html__('Create Free Account','streamvid') ?></h5>
                        <p class="fs-small"><?php echo esc_html__('It\'s free. No subscription required','streamvid') ?></p>
                      </div>  
                    </div>

  
                    <div class="login-width-social">
                    <?php
                    
                    if(class_exists('NextendSocialLogin', false)){
                            echo NextendSocialLogin::renderButtonsWithContainer();       
                    }
                
                     ?>
                    <div class="social-line">
                            <span><?php echo esc_html__('or','streamvid'); ?></span>
                    </div>
                    </div>
          
              
                    <div class="form-contaier owl-carousel">
                        <?php if($show_login) :  ?>
            			<div class="jws-login slider-item">
                          
                            
            				<form name="loginpopopform" id="jws-loginform" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">
                                <div class="row">       
                					<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Email or username', 'streamvid' ); ?></label>
                						<input type="text" name="log" class="input required" value="" size="20" />
                					</div>
                					<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Password', 'streamvid' ); ?></label>
                						<input type="password" name="pwd" class="input required" value="" size="20" />
                                        <span class="field-icon toggle-password2 jws-icon-eye-thin"></span>
                					</div>
                				
                                    <div class="forgetmenot login-remember col-12 fs-small">
                						<label for="popupRememberme"><input name="rememberme" type="checkbox" value="forever" id="popupRememberme" /> <?php esc_html_e( 'Remember me', 'streamvid' ); ?></label><?php echo '<a class="lost-pass-link" href="' . $wc_lostpassword_url . '" title="' . esc_attr__( 'Lost Password', 'streamvid' ) . '">' . esc_html__( 'Lost your password?', 'streamvid' ) . '</a>'; ?>
                					</div>
                					<div class="submit login-submit jws-button  col-12">
                						<input type="submit" name="wp-submit" class="button button-default" value="<?php esc_attr_e( 'Sign In', 'streamvid' ); ?>" />
                						<input type="hidden" name="testcookie" value="1" />
                					</div>
                                </div> 
                            <?php  if($show_login && ($show_register && $registration_enabled)) {   
                                printf(
                                    '<a class="register change-form fs-small" href="%s">%s %s</a>',
                                    esc_url( jws_get_register_url() ),
                                    esc_html__( 'Not registered yet?', 'streamvid'),   
                                    '<span>'.esc_html__( 'Register', 'streamvid').'</span>'                                        
                                );
                                 
            			     }?>
            			
            				</form>
            			</div>
                        <?php endif; ?>
            			<?php if ( $registration_enabled && $show_register ): ?>
            				<div class="jws-register slider-item">
                              
            					<form class="auto_login" name="registerformpopup"  method="post" novalidate="novalidate">
            
                                    <?php wp_nonce_field( 'ajax_register_nonce', 'register_security' ); ?>
                                    <div class="row">
                                    
                                    
                                    <div class="col-xl-6 col-lg-6 col-12 form-row">
                                        <label><?php esc_attr_e( 'First Name', 'streamvid' ); ?></label>
            							<input type="text" name="first_name" class="input" />
            						</div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-row">
                                        <label><?php esc_attr_e( 'Last Name', 'streamvid' ); ?></label>
            							<input type="text" name="last_name" class="input" />
            						</div>
                                    
                                   
            						<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Username *', 'streamvid' ); ?></label>
            							<input  type="text" name="user_login" class="input required" />
            						</div>
            
            						<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Email *', 'streamvid' ); ?></label>
            							<input type="email" name="user_email" class="input required" />
            						</div>
        							<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Password *', 'streamvid' ); ?></label>
        								<input type="password" name="password" class="input required" />
                                        <span class="field-icon toggle-password2 jws-icon-eye-thin"></span>
        							</div>
        							<div class="col-12 form-row">
                                        <label><?php esc_attr_e( 'Confirm Password *', 'streamvid' ); ?></label>
        								<input type="password" name="repeat_password" class="input required" />
        							</div>
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="fs-small2"><?php esc_attr_e( 'Birthday', 'streamvid' ); ?></label>
                                        <input type="text" id="jws_date_of_birth" name="jws_date_of_birth" value="" placeholder="<?php echo esc_attr_x( 'dd/mm/yy', 'placeholder', 'streamvid' ); ?>" required="" autocomplete="off">
            						</div>
                                    
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <label class="fs-small2"><?php esc_attr_e( 'Gender', 'streamvid' ); ?></label>
                                        <select name="jws_gender" id="jws_gender">
                                        <?php
                                        
                                        $gender = jws_get_gender();
                                                        
                                         echo '<option value="">'.esc_html__( 'None', 'streamvid' ).'</option>';
                                         foreach ( $gender as $key => $value ) {
                                        
                                            printf(
                                                '<option value="%s">%s</option>',
                                                esc_attr( $key ),
                                                esc_html( $value )
                                            );
                        
                                        }?>
                                      
                                       </select>
            						</div>
                                    <div class="submit jws-button col-12">
            							<input type="submit" name="wp-submit" class="button button-default" value="<?php echo esc_attr_x( 'Register', 'Login popup form', 'streamvid' ); ?>" />
            						</div>   
            						<input type="hidden" name="modify_user_notification" value="1">
            						<?php do_action( 'signup_hidden_fields', 'create-another-site' ); ?>
                                    </div>
            					</form>
            				    <?php  
                                
                                if($show_login && ($show_register && $registration_enabled)) {
            				        
                                    printf(
                                        '<a class="login change-form fs-small" href="%s">%s %s</a>',
                                        esc_url( jws_get_login_page_url() ),
                                        esc_html__( 'Already have an account?', 'streamvid'),   
                                        '<span>'.esc_html__( 'Login', 'streamvid').'</span>'                                        
                                    );
                                 
            				    }
                                ?>
                                  <div class="meter">
                                    <div class="meter-box">
                                        <span class="box1"></span>
                                        <span class="box2"></span>
                                        <span class="box3"></span>
                                        <span class="box4"></span>
                                          <span class="text-meter"></span>
                                    </div>
                                  
                                  </div>  
                                  <div class="jws-password-hint fs-small">
                                       <?php echo esc_html__('Hint: The password should be at least eight characters long. To make it stronger, use upper and lower case letters, numbers, and symbols like ! " ? $ % ^ & ).','streamvid'); ?>
                                 </div>
            				</div>
            			<?php endif; ?>
                       
                    </div>
                     <?php
                   
                        printf(
                            '<div class="fs-small privacy-policy">%s</div>',
                            isset($jws_option['form_privacy_text']) ? $jws_option['form_privacy_text'] : ''                          
                        );
                        
                      ?>
             
  
            </div>
            </div>
		</div>

    <?php
    }
}     


/**
 * Filter lost password link
 *
 * @param $url
 *
 * @return string
 */
if ( ! function_exists( 'jws_get_lost_password_url' ) ) {
	function jws_get_lost_password_url() {
		$url = add_query_arg( 'action', 'lostpassword', jws_get_login_page_url() );

		return $url;
	}
}

/**
 * Get login page url
 *
 * @return false|string
 */
if ( ! function_exists( 'jws_get_login_page_url' ) ) {
	function jws_get_login_page_url() {

		if ( function_exists('jws_plugin_active') && !jws_plugin_active( 'js_composer/js_composer.php' ) ) {
			return wp_login_url();  
		}

	
		global $wpdb;
		$page = $wpdb->get_col(
		$wpdb->prepare(
					"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
			WHERE 	pm.meta_key = %s
			AND 	pm.meta_value = %s
			AND		p.post_type = %s
			AND		p.post_status = %s",
					'jws_login_page',
					'1',
					'page',
					'publish'
				)
			);
			if ( ! empty( $page[0] ) ) {
				return get_permalink( $page[0] );
			}
	

		return wp_login_url();

	}
}


/**
 * Filter register link
 *
 * @param $register_url
 *
 * @return string|void
 */
if ( ! function_exists( 'jws_get_register_url' ) ) {
	function jws_get_register_url() {
		$url = add_query_arg( 'action', 'register', jws_get_login_page_url() );

		return $url;
	}
}
if ( ! is_multisite() ) {
	add_filter( 'register_url', 'jws_get_register_url' );
}
if ( ! function_exists( 'jws_register_ajax_callback' ) ) {
	function jws_register_ajax_callback() {

		$secure = check_ajax_referer( 'ajax_register_nonce', 'register_security', false );
        $errors = new WP_Error(); 
		if ( ! $secure ) {
		  
            $errors->add(
               'secure_miss',
               $secure
            );
            wp_send_json_error( $errors );
	
		}

		parse_str( $_POST['data'], $data );
        $code    = -1;
		foreach ( $data as $k => $v ) {
			$_POST[ $k ] = $v;
		}

		$_POST['is_popup_register'] = 1;

		if ( ! empty( $data['modify_user_notification'] ) ) {
			$_REQUEST['modify_user_notification'] = 1;
		}

		$info = array();

		$info['user_login'] = sanitize_user( $data['user_login'] );
		$info['user_email'] = sanitize_email( $data['user_email'] );
		$info['user_pass']  = sanitize_text_field( $data['password'] );
        
        
          if(!empty($info['user_login']) && isset( $info['user_login'] )) { 
                if (mb_strlen($info['user_login']) < 3) {
                      
                        $errors->add(
                           'chater_least2',
                           esc_html__( 'Your User Name Must Contain At Least 3 Characters!', 'streamvid' )
                        );
                }
        }

        if(!empty($info['user_pass']) && isset( $info['user_pass'] )) {
                $password = $info['user_pass'];
                $cpassword = $data['repeat_password'];
                if (mb_strlen($info['user_pass']) < 8) {
                   
                    $errors->add(
                       'chater_error',
                       esc_html__( 'Your Password Must Contain At Least 8 Characters!', 'streamvid' )
                    );
                 
                }

                elseif(!preg_match("#[A-Z]+#",$password)) {
                 
                    $errors->add(
                       'chater_capital',
                       esc_html__( 'Your Password Must Contain At Least 1 Capital Letter!', 'streamvid' )
                    );
                }

                elseif (strcmp($password, $cpassword) !== 0) {
                    $response_data = array(
					   'message' => esc_html__( 'Passwords must match!', 'streamvid' )
				    );
                    $errors->add(
                       'passwords_must',
                       esc_html__( 'Passwords must match!', 'streamvid' )
                    );
                }

            } 
      
         
           if( $errors->get_error_code() ){
      
                wp_send_json_error( $errors );
           
           } 
		// Register the user
		$user_register = register_new_user( $info['user_login'], $info['user_email'] );

		if ( is_wp_error( $user_register ) ) {
			$error = $user_register->get_error_codes();
      
			if ( in_array( 'empty_username', $error ) ) {
			
                $errors->add(
                   'empty_username',
                   esc_html__( 'Please enter a username!', 'streamvid' )
                );
                
			}elseif ( in_array( 'empty_password', $error ) ) {
                $errors->add(
                   'empty_password',
                   esc_html__( 'Please enter a password!', 'streamvid' )
                );
			} elseif ( in_array( 'invalid_username', $error ) ) {
                $errors->add(
                   'invalid_username',
                   esc_html__( 'The username is invalid. Please try again!', 'streamvid' )
                );
			} elseif ( in_array( 'username_exists', $error ) ) {
                $errors->add(
                   'username_exists',
                   esc_html__( 'This username is already registered. Please choose another one.', 'streamvid' )
                );
			} elseif ( in_array( 'empty_email', $error ) ) {
                $errors->add(
                   'empty_email',
                   esc_html__( 'Please type your e-mail address!', 'streamvid' )
                );
			} elseif ( in_array( 'invalid_email', $error ) ) {
                $errors->add(
                   'empty_email',
                   esc_html__( 'The email address isn\'t correct. Please try again!', 'streamvid' ) 
                );
			} elseif ( in_array( 'email_exists', $error ) ) {
                $errors->add(
                   'email_exists',
                   esc_html__( 'This email is already registered. Please choose another one!', 'streamvid' )
                );
			}
            
           if( $errors->get_error_code() ){
      
                wp_send_json_error( $errors );
           
           } 
	
		} else {
    		      
			    $code  = 1; 
                global $jws_option;
                $user = get_user_by('login', $info['user_login']);
             
                    
                     $user_id = $user->ID;
                    if (isset($_POST['first_name'])) {
						update_user_meta($user_id, 'first_name', sanitize_text_field($_POST['first_name']));
					}
					if (isset($_POST['last_name'])) {
						update_user_meta($user_id, 'last_name', sanitize_text_field($_POST['last_name']));
					}
					if (isset($_POST['jws_gender'])) {
						update_user_meta($user_id, 'jws_gender', sanitize_text_field($_POST['jws_gender']));
					}
                    if (isset($_POST['jws_date_of_birth'])) {
						update_user_meta($user_id, 'jws_date_of_birth', sanitize_text_field($_POST['jws_date_of_birth']));
					}
                   
                    if( $user ) {
                        wp_set_current_user( $user_id, $user->user_login );
                        wp_set_auth_cookie( $user_id );

                        do_action('wp_login', $user->user_login, $user);
                    }
            		if($jws_option['select-page-login-register-author']) {
            		    $login_redirect   = get_author_posts_url($user_id); 
            		}
                    elseif(isset($jws_option['login_form_redirect']) && !empty($jws_option['login_form_redirect'])) {
                        $login_redirect = get_page_link($jws_option['login_form_redirect']);
                    }
                    else {
            		    $current_page_id = get_queried_object_id();	 
            			$login_redirect = get_permalink( $current_page_id );
            		}
                    
                    $response_data = array(
    				    'code'    => $code,
        				'message' => '<p class="jws-dealer-note green">' . esc_html__( 'Login successful, redirecting...', 'streamvid' ) . '</p>',
                        'redirect' => $login_redirect
    				); 
  

				wp_send_json_success( $response_data );
		
		}
  
	}
}

if ( get_option( 'users_can_register' ) ) {
	add_action( 'wp_ajax_nopriv_jws_register_ajax', 'jws_register_ajax_callback' );
    add_action( 'wp_ajax_jws_register_ajax', 'jws_login_ajax_callback' );
}

if ( ! function_exists( 'jws_login_ajax_callback' ) ) {
	function jws_login_ajax_callback() {
	
        $errors = new WP_Error(); 
		if ( empty( $_REQUEST['data'] ) ) {
		
            $errors->add(
               'something_wrong',
               esc_html__( 'Something wrong. Please try again.', 'streamvid' )
            );    
            wp_send_json_error( $errors );
           
         
		} else {

			parse_str( $_REQUEST['data'], $login_data );

			$creds = array();
            $creds['user_login'] = $login_data['log'];
            $creds['user_password'] = $login_data['pwd'];
            $creds['remember'] = isset($login_data['rememberme']) ? $login_data['rememberme'] : false;
            $secure_cookie = is_ssl() ? true : false;
      
        
            $user_verify = wp_signon($creds, $secure_cookie);
      
			$code    = 1;
			$message = '';
	
            global $jws_option;    
			if($jws_option['select-page-login-register-author']) {
			    $login_redirect   = get_author_posts_url($user_verify->ID); 
			}
            elseif(isset($jws_option['login_form_redirect']) && !empty($jws_option['login_form_redirect'])) {
                $login_redirect = get_page_link($jws_option['login_form_redirect']);
            }
            else {
			    $current_page_id = get_queried_object_id();	 
				$login_redirect = get_permalink( $current_page_id );
			}

			if ( is_wp_error( $user_verify ) ) {
			    wp_send_json_error( $user_verify );
			} else {
			    $code    = 1; 
				$message = '<p class="jws-dealer-note green">' . esc_html__( 'Login successful, redirecting...', 'streamvid' ) . '</p>';
			}

			$response_data = array(
				'code'    => $code,
				'message' => $message,
                'redirect' => $login_redirect
			);

		}
		wp_send_json_success( $response_data );

	}
}
add_action( 'wp_ajax_nopriv_jws_login_ajax', 'jws_login_ajax_callback' );
add_action( 'wp_ajax_jws_login_ajax', 'jws_login_ajax_callback' );


remove_action( 'register_new_user', 'wp_send_new_user_notifications' );

/*
* Function ajax filter
*/
if (!function_exists('jws_ajax_product_filter')) {
    function jws_ajax_product_filter()
    {
        $inc_product_ids = $ex_product_ids = $asset_type = $filter_categories = $posts_per_page = $orderby = $order = null;
        if (isset($_POST['ex_product_ids'])) {
            $ex_product_ids = $_POST['ex_product_ids'];
        }
        if (isset($_POST['inc_product_ids'])) {
            $inc_product_ids = $_POST['inc_product_ids'];
        }
        if (isset($_POST['asset_type'])) {
            $asset_type = sanitize_text_field($_POST['asset_type']);
        }
        if (isset($_POST['filter_categories'])) {
            $filter_categories = sanitize_text_field($_POST['filter_categories']);
        }
        if (isset($_POST['posts_per_page'])) {
            $posts_per_page = intval($_POST['posts_per_page']);
        }
        if (isset($_POST['orderby'])) {
            $orderby = sanitize_text_field($_POST['orderby']);
        }
        if (isset($_POST['order'])) {
            $order = strtoupper(sanitize_text_field($_POST['order']));
        }

        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }
        
        if(isset($_POST['paged'] ) && $_POST['paged'] > 1 ) $paged = $_POST['paged'];
        
        if($_POST['layout'] == 'carousel'){
            $grid_class = 'product-item product slick-slide '.$_POST['display'].'';
        }else {
            $class    = 'grid-layout row';
            $grid_class = 'product-item product '.$_POST['display'].' col-xl-' . $_POST['columns'] . ' col-lg-' . $_POST['columns_tablet'] . ' col-' . $_POST['columns_mobile'] .'';
        }
        
        
        
        
         if($_POST['layout'] == 'carousel') {
            
                
        $_POST['show_nav'] ? $_POST['show_nav'] : $_POST['show_nav'] = 'false';
        $_POST['show_nav_tablet'] ? $_POST['show_nav_tablet'] : $_POST['show_nav_tablet'] = 'false';
        $_POST['show_nav_mobile'] ? $_POST['show_nav_mobile'] : $_POST['show_nav_mobile'] = 'false';
        
        $_POST['show_pag'] ? $_POST['show_pag'] : $_POST['show_pag'] = 'false';
        $_POST['show_pag_tablet'] ? $_POST['show_pag_tablet'] : $_POST['show_pag_tablet'] = 'false';
        $_POST['show_pag_mobile'] ? $_POST['show_pag_mobile'] : $_POST['show_pag_mobile'] = 'false';
        
        $_POST['autoplay'] ? $_POST['autoplay'] : $_POST['autoplay'] = 'false';
        $_POST['autoplay_tablet'] ? $_POST['autoplay_tablet'] : $_POST['autoplay_tablet'] = 'false';
        $_POST['autoplay_mobile'] ? $_POST['autoplay_mobile'] : $_POST['autoplay_mobile'] = 'false';  
         $infinite = ($_POST['infinite']) ? 'true' : 'false';
        if($_POST['enble_muntirow'] == 'yes') {
           $_POST['number_row'] ? $_POST['number_row'] : $_POST['number_row'] = 1;
           $_POST['number_row_tablet'] ? $_POST['number_row_tablet'] : $_POST['number_row_tablet'] = 1;
           $_POST['number_row_mobile'] ? $_POST['number_row_mobile'] : $_POST['number_mobile'] = 1;
           
           $_POST['number_col_row'] ? $_POST['number_col_row'] : $_POST['number_col_row'] = 1;
           $_POST['number_col_row_tablet'] ? $_POST['number_col_row_tablet'] : $_POST['number_col_row_tablet'] = 1;
           $_POST['number_col_row_mobile'] ? $_POST['number_col_row_mobile'] : $_POST['number_col_row_mobile'] = 1;
    
        
       
            
            $data_slick = 'data-slick=\'{"rows":"'.$_POST['number_row'].'","slidesPerRow":"'.$_POST['number_col_row'].'","slidesToShow":1 ,"slidesToScroll":1,"autoplay": '.$_POST['autoplay'].',"arrows": '.$_POST['show_nav'].', "dots":'.$_POST['show_pag'].',
            "speed": '.$_POST['speed'].', "responsive":[{"breakpoint": 1024,"settings":{"rows":"'.$_POST['number_row_tablet'].'","slidesPerRow":"'.$_POST['number_col_row_tablet'].'"}},
            {"breakpoint": 768,"settings":{"rows":"'.$_POST['number_row_mobile'].'","slidesPerRow":"'.$_POST['number_col_row_mobile'] .'"}}]}\''; 
              }else{
                   $data_slick = 'data-slick=\'{"slidesToShow":'.$_POST['slides_to_show']['size'].' ,"slidesToScroll": '.$_POST['scroll'].',"autoplay": '.$_POST['autoplay'].',"arrows": '.$_POST['show_nav'].', "dots":'.$_POST['show_pag'].',
                    "speed": '.$_POST['speed'].', "infinite":'.$infinite.' , "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": '.$_POST['slides_to_show_tablet']['size'].',"slidesToScroll": '.$_POST['scroll'].'}},
                    {"breakpoint": 768,"settings":{"slidesToShow": '.$_POST['slides_to_show_mobile']['size'].',"slidesToScroll": '.$_POST['scroll'].'}}]}\''; 
              }   
          }else {
                $data_slick = '';
          }
        
        
        $wc_attr = array(
            'post_type' => 'product',
            'product_cat' =>  $filter_categories,
            'posts_per_page' => $posts_per_page,
            'paged' => $paged,
            'orderby' => $orderby,
            'order' => $order,  
        );
        
        
        if(!empty($ex_product_ids)) {
           $wc_attr['post__not_in'] = $ex_product_ids;
        }
        
  
        
        if(!empty($inc_product_ids)) {
           $wc_attr['post__in'] = $inc_product_ids;
        }

        if ($asset_type) {
            switch ($asset_type) {
                case 'featured':
                    $meta_query[] = array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field'    => 'name',
                            'terms'    => 'featured',
                            'operator' => 'IN'
                        ),
                    );
                    $wc_attr['tax_query'] = $meta_query;
                    break;
                case 'onsale':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    break;
                case 'best-selling':
                    $wc_attr['meta_key'] = 'total_sales';
                    $wc_attr['orderby']  = 'meta_value_num';
                    break;
                case 'latest':
                    $wc_attr['orderby'] = 'date';
                    break;
                case 'toprate':
                    $wc_attr['orderby'] = 'meta_value_num';
                    $wc_attr['meta_key'] = '_wc_average_rating';
                    $wc_attr['order'] = 'DESC';
                    break;
                case 'deal':
                    $product_ids_on_sale = wc_get_product_ids_on_sale();
                    $wc_attr['post__in'] = $product_ids_on_sale;
                    $wc_attr['meta_query'] = array(
                        'relation' => 'AND',
                        array(
                            'key' => '_sale_price_dates_to',
                            'value' => time(),
                            'compare' => '>'
                        )
                    );
                    break;
                default:
                    break;
            }
        }


        if (isset($_POST['product_attribute']) && isset($_POST['attribute_value'])) {
            if (is_array($_POST['product_attribute'])) {
                foreach ($_POST['product_attribute'] as $key => $value) {
                    $tax_query[] = array(
                        'taxonomy' => $value,
                        'terms'    => array_map('sanitize_title', (array)$_POST['attribute_value'][$key]),
                        'field'    => 'slug',
                        'operator' => 'IN'
                    );
                }
            } else {
                $tax_query[] = array(
                    'taxonomy' => sanitize_title($_POST['product_attribute']),
                    'terms'    => array_map('sanitize_title', (array)$_POST['attribute_value']),
                    'field'    => 'slug',
                    'operator' => 'IN'
                );
            }
        }

        if (isset($_POST['product_tag'])) {
            $wc_attr['product_tag'] = sanitize_title($_POST['product_tag']);
        }

        if (isset($_POST['price_filter']) && $_POST['price_filter'] > 0) {
            $min = (intval($_POST['price_filter']) - 1)*intval($_POST['price_filter_range']);
            $max = intval($_POST['price_filter'])*intval($_POST['price_filter_range']);
            $meta_query[] = array(
                'key'     => '_price',
                'value'   => array($min, $max),
                'compare' => 'BETWEEN',
                'type'    => 'NUMERIC'
            );
        }

        if (isset($_POST['s']) && $_POST['s'] != '') {
            $wc_attr['s'] = esc_attr($_POST['s']);
        }

        $product_query = new WP_Query($wc_attr);
        
        ob_start(); ?>
        
        <?php if(isset($_POST['paged'] ) && $_POST['paged'] > 1 ) {
             while ($product_query->have_posts()) {
                 $product_query->the_post();
                 echo '<div class="'.esc_attr($grid_class).'">';    
                 include( JWS_ABS_PATH_WC.'/archive-layout/content-'.$_POST['display'].'.php'  );
                 echo '</div>';
            } 
            
        } else { ?>
            
            <div class="products">
                <?php 
                    if($_POST['layout'] == 'carousel') echo '<div class="carousel" '.$data_slick.'>';  
                            while ($product_query->have_posts()) {
                                 $product_query->the_post();
                                 echo '<div class="'.esc_attr($grid_class).'">';    
                                 wc_get_template_part( 'archive-layout/content', $_POST['display'] );
                                 echo '</div>';
                            }
                    if($_POST['layout'] == 'carousel') echo '</div>'; 
                ?>
            </div>
            
        <?php } ?>
        <?php
        wp_reset_postdata();
        $output = ob_get_clean();
        
        $output =  array(
    	    		'items' => $output,
    	    		'status' => ( $product_query->max_num_pages > $paged ) ? 'have-posts' : 'no-more-posts'
    	 );

        
        
      
      
       echo json_encode( $output );

		die();
    }

    add_action('wp_ajax_jws_ajax_product_filter', 'jws_ajax_product_filter');
    add_action('wp_ajax_nopriv_jws_ajax_product_filter', 'jws_ajax_product_filter');
}

/*
* Function ajax filter
*/
if (!function_exists('jws_ajax_category_tabs_filter')) {
    function jws_ajax_category_tabs_filter()
    {

     if(!empty($_POST['filter_categories'])) {
      
        if($_POST['filter_categories'] == 'all'){
             if($_POST['filter_categories_for_asset']){
                foreach ($_POST['filter_categories_for_asset'] as $product_cat_slug) {
                    $product_cat = get_term_by('slug', $product_cat_slug, 'product_cat');
  
                    ?>
                    
                    <div class="<?php echo esc_attr($_POST['columns']); ?>">
                        <a href="<?php echo get_term_link( $product_cat->term_id, 'product_cat' );  ?>">
                            <?php echo wp_get_attachment_image( get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 ), 'full' ); ?>
                            <h4><?php echo esc_html($product_cat->name); ?></h4>
                        </a>
                    </div>
                    
                    <?php
   
                } 
            }     
        }else{
            $term = get_queried_object();
        
            $category = get_term_by( 'slug', $_POST['filter_categories'], 'product_cat' );
        
            $id = $category->term_id;
            
            $children = get_categories(
              array(
                'taxonomy' => 'product_cat',
                'parent' =>$id
              )
            );
        
            if ( $children ) { 
                foreach( $children as $product_cat )
                {
                    ?>
                    
                    <div class="<?php echo esc_attr($_POST['columns']); ?>">
                        <a href="<?php echo get_term_link( $product_cat->term_id, 'product_cat' );  ?>">
                            <?php echo wp_get_attachment_image( get_term_meta( $product_cat->term_id, 'thumbnail_id', 1 ), 'full' ); ?>
                            <h4><?php echo esc_html($product_cat->name); ?></h4>
                        </a>
                    </div>
                    
                    <?php
                }
            }  
        }
wp_die();
    }  
       
    }

    add_action('wp_ajax_jws_ajax_category_tabs_filter', 'jws_ajax_category_tabs_filter');
    add_action('wp_ajax_nopriv_jws_ajax_category_tabs_filter', 'jws_ajax_category_tabs_filter');
}



/*
* Function ajax filter
*/
if (!function_exists('jws_ajax_tv_shows_tabs')) {
    function jws_ajax_tv_shows_tabs()
    {
   
        ob_start(); 
        
        
            $settings = $_POST;
            
            $class_column = 'jws-post-item';  
          
            if($settings['tv_shows_tabs_display'] == 'slider') { 
              $class_column .= ' slider-item';
            } else {
              $data_slick = '';
              $class_column .= ' col-xl-'.$settings['tv_shows_tabs_columns'].'';
              $class_column .= (!empty($settings['tv_shows_tabs_columns_tablet'])) ? ' col-lg-'.$settings['tv_shows_tabs_columns_tablet'].'' : ' col-lg-'.$settings['tv_shows_tabs_columns'].'' ;
              $class_column .= (!empty($settings['tv_shows_tabs_columns_mobile'])) ? ' col-'.$settings['tv_shows_tabs_columns_mobile'].'' :  ' col-'.$settings['tv_shows_tabs_columns'].''; 
            }
            
             $query_args = [
    			'post_type'      => 'tv_shows',
    			'post_status'    => 'publish',
    			'posts_per_page' => -1,
    			'paged'          => 1,
    			'post__not_in'   => array(),
    		];
            
            if (isset($settings['orderby'])) {
                $query_args['orderby'] = $settings['orderby'];
            }
            if (isset($settings['order'])) {
                $query_args['order']  = $settings['order'];
            }
            
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

            $manual_ids = $settings['manual_ids'];
            if(!empty($manual_ids)) {
                $query_args['post__in'] = $manual_ids; 
            }
    		$image_size_global = jws_theme_get_option('tv_shows_imagesize');  
           $image_size = !empty($settings['images_size']['width']) && !empty($settings['images_size']['height']) ?  $settings['images_size']['width'].'x'.$settings['images_size']['height'] : $image_size_global;
           $args = array(
                'image_size'    =>  $image_size
           ) ;
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

        wp_reset_postdata();
        $output = ob_get_clean();
       
        
   
        $result = array(
           'content' => $output,
           'status' => $_POST,
        );
        wp_send_json_success( $result );
    }

    add_action('wp_ajax_jws_ajax_tv_shows_tabs', 'jws_ajax_tv_shows_tabs');
    add_action('wp_ajax_nopriv_jws_ajax_tv_shows_tabs', 'jws_ajax_tv_shows_tabs');
}
