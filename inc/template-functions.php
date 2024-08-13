<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
} 
/**
 * Render header layout.
 *
 * @return string
 */
if (!function_exists('jws_header')) {
    function jws_header()
    {
        global $jws_option;
        ob_start();
        if(isset($jws_option['select-header']) && !empty($jws_option['select-header'])) {
          get_template_part('template-parts/header/header');  
        }else {
          get_template_part('template-parts/header/header_none');  
        }
        
        $output = ob_get_clean();
        echo apply_filters('jws_header', $output);
    }
}

/**
 * Render footer layout.
 *
 * @return string
 */
if (!function_exists('jws_footer')) {
    function jws_footer()
    {
        global $jws_option;
        
        
        ob_start();
        if(isset($jws_option['select-footer']) && !empty($jws_option['select-footer'])) {
          get_template_part('template-parts/footer/footer');  
        }else {
          get_template_part('template-parts/footer/footer_none');  
        }
        
        $output = ob_get_clean();
        echo apply_filters('footer', $output);
    }
}
function jws_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'jws_mime_types');
/**
* Get post title by ID
*
* @since 1.1.0
*/
function jws_get_posts_title_by_id() {

		$ids = isset( $_POST['id'] ) ? $_POST['id'] : array();
        $req_post_type = isset( $_POST['post_type'] ) ? sanitize_text_field( $_POST['post_type'] ) : 'any';
		$results = [];

		$query = new \WP_Query(
			[
				'post_type'      => $req_post_type,
				'post__in'       => $ids,
				'posts_per_page' => -1,
			]
		);

		foreach ( $query->posts as $post ) {
			$results[ $post->ID ] = $post->post_title;
		}

		// return the results in json.
		wp_send_json( $results );
}  
    

add_action( 'wp_ajax_jws_get_posts_title_by_id', 'jws_get_posts_title_by_id' );
/** Add Function Crop Images   **/
function jws_getImageBySize($params = array())
{
    $params = array_merge( array(
    		'post_id' => null,
    		'attach_id' => null,
    		'thumb_size' => 'thumbnail',
    		'class' => '',
    	), $params );
    
    	if ( ! $params['thumb_size'] ) {
    		$params['thumb_size'] = 'thumbnail';
    	}
    
    	if ( ! $params['attach_id'] && ! $params['post_id'] ) {
    		return false;
    	}
    
    	$post_id = $params['post_id'];
    
    	$attach_id = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
    	$attach_id = apply_filters( 'vc_object_id', $attach_id );
    	$thumb_size = $params['thumb_size'];
    	$thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';
    
    	global $_wp_additional_image_sizes;
    	$thumbnail = '';
    
    	$sizes = array(
    		'thumbnail',
    		'thumb',
    		'medium',
    		'large',
    		'full',
    	);
    	if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
    		$attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
    		$thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
    	} elseif ( $attach_id ) {
    		if ( is_string( $thumb_size ) ) {
    			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
    			if ( isset( $thumb_matches[0] ) ) {
    				$thumb_size = array();
    				$count = count( $thumb_matches[0] );
    				if ( $count > 1 ) {
    					$thumb_size[] = $thumb_matches[0][0]; // width
    					$thumb_size[] = $thumb_matches[0][1]; // height
    				} elseif ( 1 === $count ) {
    					$thumb_size[] = $thumb_matches[0][0]; // width
    					$thumb_size[] = $thumb_matches[0][0]; // height
    				} else {
    					$thumb_size = false;
    				}
    			}
    		}
    		if ( is_array( $thumb_size ) ) {
    			// Resize image to custom size
    			$p_img = jws_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
    			$alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
    			$attachment = get_post( $attach_id );
    			if ( ! empty( $attachment ) ) {
    				$title = trim( wp_strip_all_tags( $attachment->post_title ) );
    
    				if ( empty( $alt ) ) {
    					$alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
    				}
    				if ( empty( $alt ) ) {
    					$alt = $title;
    				}
    				if ( $p_img ) {
    
    					$attributes = jws_stringify_attributes( array(
    						'class' => $thumb_class,
    						'src' => $p_img['url'],
    						'width' => $p_img['width'],
    						'height' => $p_img['height'],
    						'alt' => $alt,
    						'title' => $title,
    					) );
    
    					$thumbnail = '<img ' . $attributes . ' />';
    				}
    			}
    		}
    	}
    
    	$p_img_large = wp_get_attachment_image_src( $attach_id, 'large' );
    
    	return apply_filters( 'vc_wpb_getimagesize', array(
    		'thumbnail' => $thumbnail,
    		'p_img_large' => $p_img_large,
    	), $attach_id, $params );
}
if (!function_exists('jws_resize')) {
    /**
     * @param int $attach_id
     * @param string $img_url
     * @param int $width
     * @param int $height
     * @param bool $crop
     *
     * @since 4.2
     * @return array
     */
    function jws_resize($attach_id, $img_url, $width, $height, $crop)
    {
        // this is an attachment, so we have the ID
		$image_src = array();
		if ( $attach_id ) {
			$image_src = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
			// this is not an attachment, let's use the image url
		} elseif ( $img_url ) {
			$file_path = wp_parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size = getimagesize( $actual_file_path );
			$image_src[0] = $img_url;
			$image_src[1] = $orig_size[0];
			$image_src[2] = $orig_size[1];
		}
		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];

			// the image path without the extension
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

			// checking if the file size is larger than the target size
			// if it is smaller or the same size, stop right here and return
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image = array(
						'url' => $cropped_img_url,
						'width' => $width,
						'height' => $height,
					);

					return $vt_image;
				}

				if ( ! $crop ) {
					// calculate the size proportionaly
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

					// checking if the file already exists
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

						$vt_image = array(
							'url' => $resized_img_url,
							'width' => $proportional_size[0],
							'height' => $proportional_size[1],
						);

						return $vt_image;
					}
				}

				// no cache files - let's finally resize it
				$img_editor = wp_get_image_editor( $actual_file_path );

				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}

				$new_img_path = $img_editor->generate_filename();

				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}
				if ( ! is_string( $new_img_path ) ) {
					return array(
						'url' => '',
						'width' => '',
						'height' => '',
					);
				}

				$new_img_size = getimagesize( $new_img_path );
				$new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

				// resized output
				$vt_image = array(
					'url' => $new_img,
					'width' => $new_img_size[0],
					'height' => $new_img_size[1],
				);

				return $vt_image;
			}

			// default output - without resizing
			$vt_image = array(
				'url' => $image_src[0],
				'width' => $image_src[1],
				'height' => $image_src[2],
			);

			return $vt_image;
		}

		return false;
    }
}
function jws_stringify_attributes($attributes)
{
    $atts = array();
    foreach ($attributes as $name => $value) {
        $atts[] = $name . '="' . esc_attr($value) . '"';
    }
    return implode(' ', $atts);
}



/* Title Bar */
if ( ! function_exists( 'jws_title_bar' ) ) {
	function jws_title_bar() {
		global $jws_option;
     
        $page_titlebar = get_post_meta(get_the_ID(), 'title_bar_checkbox', true);
        if($page_titlebar) return;
		$delimiter = '/';
        $tle_bar_build = (did_action( 'elementor/loaded' )) ? Jws_Elementor::get_titlebar_id() : '';
        if(((isset($jws_option['title-bar-switch']) && $jws_option['title-bar-switch'])) || !isset($jws_option['title-bar-switch'])  || !empty($tle_bar_build)) :
        echo '<div class="jws-title-bar-wrap">';
        if(!empty($tle_bar_build)) {
           Jws_Elementor::display_titlebar(); 
        }else {
          ?>
			<div class="jws-title-bar-wrap-inner">
				<div class="container">
					<div class="jws-title-bar">
					<h1 class="jws-text-ellipsis"><?php echo jws_page_title(); ?></h1>
					<div class="jws-path">
							<div class="jws-path-inner">
								<?php echo jws_page_breadcrumb($delimiter); ?>
							</div>
					</div>
					</div>
				</div>
		    </div>
	      <?php  
            
        }
        echo '</div>';
        if ( is_search()) { 
           
            
            jws_display_search_result_page_tab();
            
            
        }
        endif;
	}
}


if ( ! function_exists( 'jws_display_search_result_page_tab' ) ) {
    function jws_display_search_result_page_tab() {

        if( apply_filters( 'jws_display_search_result_page_tab', true )) {
            $post_types = apply_filters( 'jws_display_search_result_page_tab_post_types', array( 'movies' , 'tv_shows' ,'videos', 'product' ) );
           // $search_link = get_search_link();
            $current_post_type = get_query_var( 'post_type' );
            $links = array();
            global $wp;
            $search_link = home_url($wp->request);
            $search_link = add_query_arg( 's', get_search_query()  , $search_link );
      
            if( $post_types > 1 ) {
                echo '<ul class="search-nav">';
                foreach ( $post_types as $key => $post_type ) {
                    $post_type_obj = get_post_type_object( $post_type );
                    $url = add_query_arg( 'post_type', $post_type, $search_link );
                    $class = 'search-result-tab-link';
                    if( $current_post_type == $post_type ) {
                        $class .= ' active';
                    }
                    if(isset($post_type_obj->labels->name)) echo '<li class="search-nav-item"><a href="' . esc_url( $url ) . '" class="' . esc_attr( $class ) . '">' . esc_html( $post_type_obj->labels->name ) . '</a></li>';
                }
                echo '</ul>';
            }
        }
    }
}

/* Page breadcrumb */
if (!function_exists('jws_page_breadcrumb')) {
    function jws_page_breadcrumb($args) {
		ob_start();
        
        
        $args = wp_parse_args( $args, array(
            'tv_shows'   =>  '',
            'season'   =>  '',
            'delimiter' => '/'
        ) );
        extract( $args );
        
		$home = esc_html__('Home', 'streamvid');

		global $post;
		$homeLink = home_url('/');
		if( is_home() ){
			_e('Home', 'streamvid');
		}else{
			echo '<a href="' . $homeLink . '">' . $home . '</a>'.'<span class="delimiter">'.$delimiter.'</span>' . '';
		}

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			echo '<span class="current">' . esc_html__('Archive by category: ', 'streamvid') . single_cat_title('', false) . '</span>';

		} elseif ( is_search() ) {
			echo '<span class="current">' . esc_html__('Search results for: ', 'streamvid') . get_search_query() . '</span>';

		} elseif ( is_post_type_archive( 'product' ) ) {
			echo '<span class="current">' . esc_html__('Shop', 'streamvid') . '</span>';

		} elseif ( is_day() ) {
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F').' '. get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<span class="current">' . get_the_time('d') . '</span>';

		} elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		} 
        elseif ( is_month() ) {
			echo '<span class="current">' . get_the_time('F'). ' '. get_the_time('Y') . '</span>';

		}
        elseif ( is_single() && !is_attachment() ) { 
			if ( get_post_type() != 'post' ) {
			     $post_type = get_post_type_object(get_post_type());
                 $slug = $post_type->rewrite;
				if(get_post_type() == 'episodes'){
			         
                    if(!empty($tv_shows)) {
                        $terms = get_the_terms($tv_shows, 'tv_shows_cat', '' , '' );    
                        $post_type_tv_shows = get_post_type_object(get_post_type($tv_shows));
						$slug = $post_type_tv_shows->rewrite;
						echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type_tv_shows->labels->singular_name . '</a>'.$delimiter;
					
                        if($terms) {
						    the_terms($tv_shows, 'tv_shows_cat', '' , ', ' );
                            echo ''.$delimiter;
                     
    					}
                        
                        echo '<a href="'.get_the_permalink($tv_shows).'" class="tv-shows-link">' . get_the_title($tv_shows) . '</a>';
                        
                        if(isset($season) && $season != '') {
                            echo ''.$delimiter.'<a href="'.get_the_permalink($tv_shows).$post_type->rewrite['slug'].'/?season='.$season.'" class="tv-shows-link">'.esc_html__('Season','streamvid').' '.$season. '</a>'.$delimiter.'';
                        }
                                      
                    }
                    
                    echo '<span class="current">' . get_the_title() . '</span>'; 
                  
				}elseif(get_post_type() == 'videos') {
				    
                    $terms = get_the_terms(get_the_ID(), 'videos_cat', '' , '' );
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>'.$delimiter;
					if($terms) {
						the_terms(get_the_ID(), 'videos_cat', '' , ', '  );
						echo ''.$delimiter.'<span class="current">' .get_the_title(). '</span>';
					}else{
						echo '<span class="current">'.get_the_title().'</span>';
					}
				}

			} else {
				echo '<span class="current">' .get_the_title(). '</span>';
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			if($post_type) echo '<span class="current">' . $post_type->labels->singular_name . '</span>';
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
		} elseif ( is_page() && !$post->post_parent ) {
			echo '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_page() && $post->post_parent ) {
		  
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				echo ''.$breadcrumbs[$i];
				if ($i != count($breadcrumbs) - 1)
					echo ' ' . $delimiter . ' ';
			}
			echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

		} elseif ( is_tag() ) {
			echo '<span class="current">' . esc_html__('Posts tagged: ', 'streamvid') . single_tag_title('', false) . '</span>';
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo '<span class="current">' . esc_html__('Articles posted by ', 'streamvid') . $userdata->display_name . '</span>';
		} elseif ( is_404() ) {
			echo '<span class="current">' . esc_html__('Error 404', 'streamvid') . '</span>';
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
				echo ' '.'<span class="delimiter">'.$delimiter.'</span> ' . ' '.'<span class="paged-number">'.__('Page', 'streamvid') . ' ' . get_query_var('paged').'</span>';
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}
			
		return ob_get_clean();
    }
}
/* Page title */
if (!function_exists('jws_page_title')) {
    function jws_page_title() { 
            ob_start();
			if( is_home() ){
				esc_html_e('Home', 'streamvid');
			}elseif(is_search()){
                esc_html_e('Search Keyword: ', 'streamvid'); echo get_search_query();
            }elseif (is_tax() || is_category()) {
               echo single_term_title( "", false );
            }elseif (is_post_type_archive()) {
                echo post_type_archive_title( "", false );
            } else {
                if (is_category()){
                    single_term_title( "", false );
                }
                elseif (is_tag()){
                    single_tag_title();
                }elseif (is_author()){
                    printf(__('Author: %s', 'streamvid'), '<span class="vcard">' . get_the_author() . '</span>');
                }elseif (is_day()){
                    printf(__('Day: %s', 'streamvid'), '<span>' . get_the_date() . '</span>');
                }elseif (is_month()){
                    printf(__('Month: %s', 'streamvid'), '<span>' . get_the_date() . '</span>');
                }elseif (is_year()){
                    printf(__('Year: %s', 'streamvid'), '<span>' . get_the_date() . '</span>');
                }elseif (is_tax('post_format', 'post-format-aside')){
                    esc_html_e('Asides', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-gallery')){
                    esc_html_e('Galleries', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-image')){
                    esc_html_e('Images', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-video')){
                    esc_html_e('Videos', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-quote')){
                    esc_html_e('Quotes', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-link')){
                    esc_html_e('Links', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-status')){
                    esc_html_e('Statuses', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-audio')){
                    esc_html_e('Audios', 'streamvid');
                }elseif (is_tax('post_format', 'post-format-chat')){
                    esc_html_e('Chats', 'streamvid');
                }
                elseif(get_post_type() == 'product' && !is_single()){
                   single_term_title();
                }else{
                    the_title();
                }
            }
                
            return ob_get_clean();
    }
}

function jws_get_videos_view($args = array()) {
   $args = wp_parse_args( $args , array(
      'id'    =>  get_the_ID(),
   ) );

    extract( $args );
    $count = get_post_meta( $id , 'views', true );
    if(!empty($count)) {
        return "$count";
    }else {
        return "0";
    }
    
}


function jws_gt_set_videos_view() {
    $key = 'views';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}


function jws_videos_time_ago_function($args = array()) {
     $args = wp_parse_args( $args , array(
      'id'    =>  get_the_ID(),
   ) );

    extract( $args );
    return sprintf( esc_html__( '%s ago', 'streamvid' ), human_time_diff(get_the_time ( 'U' , $id ), current_time( 'timestamp' ) ) );
}


if (!function_exists('jws_query_pagination')) {
    function jws_query_pagination($wp_query)
    {
        	$big = 999999999;
        	$pagi = '<div class="jws-pagination-number">';
        	$pagi .= paginate_links( array(
        		'prev_text'          => '<i class="jws-icon-caret-double-right"></i>',
        		'next_text'          => '<i class="jws-icon-caret-double-right"></i>',
        		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        		'format' => '?paged=%#%',
        		'current' => max( 1, get_query_var('paged') ),
        		'total' => $wp_query->max_num_pages,
                'type' => 'list'
        	) );
        	$pagi .= '</div>';
            return $pagi;
    }
}



/*Custom comment list*/
function jws_custom_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div ';
        $add_below = 'comment';
    } else {
        $tag = 'li ';
        $add_below = 'div-comment';
    }

    ?>
    <<?php echo ''.$tag; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
<?php endif; ?>

    <div class="comment-avatar">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
    </div>
    <div class="comment-info">
        <?php comment_reply_link(array_merge($args, array('reply_text' => __('Reply', 'streamvid'), 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
        <h6 class="comment-author"><?php printf(esc_html__('%s', 'streamvid'), get_comment_author()); ?></h6>
        <span class="comment-date"><?php printf(esc_html__('%1$s ', 'streamvid'), get_comment_date()); ?></span>
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
            
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'streamvid'); ?></em>
            <br/>
        <?php endif; ?>
    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}

function jws_custom_review($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div ';
        $add_below = 'comment';
    } else {
        $tag = 'li ';
        $add_below = 'div-comment';
    }
    
    $rating = get_comment_meta( get_comment_ID(), 'rating', true );
    
    ?>
    <<?php echo ''.$tag; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ('div' != $args['style']) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>

    <div class="comment-avatar">
        <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
    </div>
    <div class="comment-info">
        <?php if(!empty($rating)) { echo '<div  class="jws-raring-result"><span data-star="'.esc_attr($rating).'" style="width:' . ( ( $rating / 5 ) * 100 ) . '%"></span></div>'; } ?>
        <h6 class="comment-author"><?php printf(esc_html__('%s', 'streamvid'), get_comment_author()); ?></h6>
        <span class="comment-date"><?php printf(esc_html__('%1$s ', 'streamvid'), get_comment_date()); ?></span>
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
            
        <?php if ($comment->comment_approved == '0') : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'streamvid'); ?></em>
            <br/>
        <?php endif; ?>
    </div>

    <?php if ('div' != $args['style']) : ?>
    </div>
<?php endif; ?>
    <?php
}

/**
 * Render post tags.
 *
 * @since 1.0.0
 */
if (!function_exists('jws_get_tags')) :
    function jws_get_tags()
    {
        $output = '';

        // Get the tag list
        $tags_list = get_the_tag_list();
        if ($tags_list) {
            $output .= sprintf('<div class="post-tags fs-small"><span>'.esc_html__('Tags','streamvid').'</span>%2$s' . esc_html__('%1$s', 'streamvid') . '</div>', $tags_list, '');
        }
        return apply_filters('jws_get_tags', $output);
    }
endif;

/* Add Field To Admin User */
function jws_custom_field_user($profile_fields) {
    	// Add new fields
        $profile_fields['address'] = 'Address';
    	$profile_fields['twitter'] = 'Twitter URL';
    	$profile_fields['facebook'] = 'Facebook URL';
    	$profile_fields['linkedin'] = 'Linkedin';
    	return $profile_fields;
}
add_filter('user_contactmethods', 'jws_custom_field_user');

/**
 * ------------------------------------------------------------------------------------------------
 * Get post image
 * ------------------------------------------------------------------------------------------------
 */

if (!function_exists('jws_get_post_thumbnail')) {
    function jws_get_post_thumbnail($size = 'full', $attach_id = false)
    {
        global $post, $streamvid_loop;
        if (has_post_thumbnail()) {

            if (function_exists('jws_getImageBySize')) {
                if (!$attach_id) $attach_id = get_post_thumbnail_id();

                $img = jws_getImageBySize(array('attach_id' => $attach_id, 'thumb_size' => $size, 'class' => 'attachment-large wp-post-image'));
                $img = $img['thumbnail'];

            } else {
                $img = get_the_post_thumbnail($post->ID, $size);
                
            }

            return $img;
        }
    }
}



function jws_get_cat_list( $cat_slug, $cat_space , $id ) { 
 if(!isset($id)) {
    $id = get_the_ID();
 }   
 return get_the_term_list($id, $cat_slug , '', $cat_space);
    
}

function jws_custom_wpkses_post_tags( $tags, $context ) {

	if ( 'post' === $context ) {
		$tags['iframe'] = array(
			'src'             => true,
			'height'          => true,
			'width'           => true,
			'frameborder'     => true,
			'allowfullscreen' => true,
		);
	}

	return $tags;
}

add_filter( 'wp_kses_allowed_html', 'jws_custom_wpkses_post_tags', 10, 2 );





add_filter('wp_generate_tag_cloud', 'jws_myprefix_tag_cloud',10,1);

function jws_myprefix_tag_cloud($tag_string){
  return preg_replace('/style=("|\')(.*?)("|\')/','',$tag_string);
}


add_filter( 'get_the_archive_title', function ($title) {    
    if ( is_category() ) {    
            $title = single_cat_title( '', false );    
        } elseif ( is_tag() ) {    
            $title = single_tag_title( '', false );    
        } elseif ( is_author() ) {    
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;    
        } elseif ( is_tax() ) { //for custom post types
            $title = sprintf( __( '%1$s' , 'streamvid' ), single_term_title( '', false ) );
        } elseif (is_post_type_archive()) {
            $title = post_type_archive_title( '', false );
        }elseif (is_page()) {
            $title = get_the_title( '', false );
          
        }
    return $title;    
});



function jws_sidebar_content($el_id , $wg_id) { 
    
    ?>
    
        <div class="main-sidebar jws_sticky_move">
                <div class="jws-filter-modal">
                <div class="modal-overlay"></div>
                <div class="siderbar-inner jws-scrollbar modal-content sidebar">
                <div class="modal-top">
                    <span class="modal-title"><?php echo esc_html__('FILTERS','streamvid'); ?></span>
                    <span class="modal-close"><?php echo esc_html__('Close','streamvid'); ?></span>
                </div>
            	<?php
                    if ($el_id) { 
                           echo do_shortcode('[hf_template id="' . $el_id . '"]'); 
                    }else {
                       if ( is_active_sidebar( $wg_id ) ) {
            			     dynamic_sidebar( $wg_id );
            		   } 
                    }	
                 ?>
                 </div>
                 </div>
        </div>
    
    <?php
    
}


function jws_blog_page() {
    global $jws_option;
    $value = array();
    
    
    $jws_option['position_sidebar'] = isset($_GET['sidebar']) ? $_GET['sidebar'] : (isset($jws_option['position_sidebar']) ? $jws_option['position_sidebar'] : 'right');
    $value['check-content-sidebar'] = jws_theme_get_option('select-sidebar-post') || is_active_sidebar( 'sidebar-main' ) ? true : false;
    
    if((isset($jws_option['position_sidebar']) && $jws_option['position_sidebar'] == 'full') || !$value['check-content-sidebar'] ) {
       $content_col = 'post_content col-12 jws-blog-element'; 
       $sidebar_col = 'postt_sidebar sidebar-has_sidebar';
       $class = ' no_sidebar';
    }else {
       $content_col = 'post_content col-xl-8 col-lg-12 col-12 jws-blog-element';
       $sidebar_col = 'post_sidebar sidebar-has_sidebar col-xl-4 col-lg-12 col-12'; 
       $class = ' has_sidebar'; 
    }
    
    $layout = isset($_GET['layout']) ? $_GET['layout'] : (isset($jws_option['blog_layout']) ? $jws_option['blog_layout'] : 'layout1');
    
    $value['position_sidebar'] = $jws_option['position_sidebar'];
    $value['content_col'] = $content_col;
    $value['sidebar_col'] = $sidebar_col;
    $value['layout'] = $layout;
    $value['select-sidebar-post'] = jws_theme_get_option('select-sidebar-post');
    

    
    return $value;
}




function jws_archive_option($post_type) { 
    
    global $jws_option;
    
    $value = array();

    
    $jws_option[$post_type.'_position_sidebar'] = isset($_GET['sidebar']) ? $_GET['sidebar'] : (isset($jws_option[$post_type.'_position_sidebar']) ? $jws_option[$post_type.'_position_sidebar'] : 'right');
    $value['check-content-sidebar'] = jws_theme_get_option('select-sidebar-'.$post_type.'-page') || is_active_sidebar( 'sidebar-main' ) ? true : false;
    
    if((isset($jws_option[$post_type.'_position_sidebar']) && $jws_option[$post_type.'_position_sidebar'] == 'full') || !$value['check-content-sidebar'] ) {
       $content_col = 'post_content col-12'; 
       $sidebar_col = 'postt_sidebar sidebar-has_sidebar';
       $class = ' no_sidebar';
    }else {
       $content_col = 'post_content col-xl-10 col-lg-12 col-12';
       $sidebar_col = 'post_sidebar sidebar-has_sidebar col-xl-2 col-lg-12 col-12'; 
       $class = ' has_sidebar'; 
    }
    
    $layout = isset($_GET['layout']) ? $_GET['layout'] : (isset($jws_option[$post_type.'_layout']) ? $jws_option[$post_type.'_layout'] : 'layout1');
    
    $value['column'] = 'jws-post-item';
    
    $value['column'] .= ' col-xl-'.jws_theme_get_option('select-'.$post_type.'-columns').' col-lg-4 col-md-6 col-12';
    
    $value['position_sidebar'] = $jws_option[$post_type.'_position_sidebar'];
    $value['content_col'] = $content_col;
    $value['sidebar_col'] = $sidebar_col;
    $value['layout'] = $layout;
    $value['select-sidebar-post'] = jws_theme_get_option('select-sidebar-'.$post_type.'-page');
    if($post_type == 'person') {
        $value['select-top-person'] = jws_theme_get_option('select-layout-person-top'); 
    }
      
    
    return $value;
    
}



function jws_get_shortcode($id) {
    
 
    return do_shortcode("[hf_template id='$id']");
    
    
}


function jws_post_result() { 
    global $wp_query;
    ?>
    
      <div class="post-result fs-small cl-heading">
        <?php      
            $total = $wp_query->found_posts;
            $per_page = $wp_query->query_vars['posts_per_page'];
            $current = (get_query_var('paged')) ? get_query_var('paged') : 1;

            if ( 1 === intval( $total ) ) {
        		_e( 'Showing the single result', 'streamvid' );
        	} elseif ( $total <= $per_page || -1 === $per_page ) {
        		/* translators: %d: total results */
        		printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'streamvid' ), $total );
        	} else {
        		$first = ( $per_page * $current ) - $per_page + 1;
        		$last  = min( $total, $per_page * $current );
        		/* translators: 1: first result 2: last result 3: total results */
        		printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'streamvid' ), $first, $last, $total );
        	}
            
         ?>
    </div>
    
    <?php
    
}



if(!function_exists('jws_image_advanced')) {
    
    function jws_image_advanced($args) {
  
    $args = wp_parse_args( $args, array(
        'thumb_size'   =>  'full',
        'attach_id' => '',
        'class' => '',
        'retina' => false,
        'crop' => true,
        'return_url' => false
    ) );
    extract( $args );    

    $attachment_image = wp_get_attachment_image_src($attach_id, 'full', false);
    $alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );

    $size = explode("x",$thumb_size);
   
    if(isset($attachment_image[0]) && isset($size[1])) {
        
       $image_resize = matthewruddy_image_resize( $attachment_image[0], $attach_id , $size[0], $size[1], $crop, $retina );
      
 
       if($return_url) {
            return $image_resize['url'];
       }
   
       return "<img class='attachment-$thumb_size size-$thumb_size' alt='$alt' src=".$image_resize['url']." >";
     
    } elseif(!empty($attachment_image[0])) {
        
       if($return_url) {
            return $attachment_image[0];
       }
     
       return "<img class='attachment-full' alt='$alt' src=".$attachment_image[0]." >";
       
    } else {
        
        $jws_theme_update_option = jws_theme_get_option('jws_placeholder_image');
        
        if(isset($size[1])) {
            
            $image_resize = matthewruddy_image_resize( $jws_theme_update_option['url'], $jws_theme_update_option['id'] , $size[0], $size[1], $crop, $retina );
            
        } else {
            
            $image_resize = array('url' => $jws_theme_update_option['url'] );
            
        }
  
        if($return_url) {
             return $image_resize['url'];
        }
        
        return "<img class='attachment-$thumb_size size-$thumb_size' alt='$alt' src=".$image_resize['url']." >";

       }
  
    }  

  }




function jws_query_string_form_fields( $values = null, $exclude = array(), $current_key = '', $return = false ) {
	if ( is_null( $values ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$values = $_GET;
	} elseif ( is_string( $values ) ) {
		$url_parts = wp_parse_url( $values );
		$values    = array();

		if ( ! empty( $url_parts['query'] ) ) {
			// This is to preserve full-stops, pluses and spaces in the query string when ran through parse_str.
			$replace_chars = array(
				'.' => '{dot}',
				'+' => '{plus}',
			);

			$query_string = str_replace( array_keys( $replace_chars ), array_values( $replace_chars ), $url_parts['query'] );

			// Parse the string.
			parse_str( $query_string, $parsed_query_string );

			// Convert the full-stops, pluses and spaces back and add to values array.
			foreach ( $parsed_query_string as $key => $value ) {
				$new_key            = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $key );
				$new_value          = str_replace( array_values( $replace_chars ), array_keys( $replace_chars ), $value );
				$values[ $new_key ] = $new_value;
			}
		}
	}
	$html = '';

	foreach ( $values as $key => $value ) {
		if ( in_array( $key, $exclude, true ) ) {
			continue;
		}
		if ( $current_key ) {
			$key = $current_key . '[' . $key . ']';
		}
		if ( is_array( $value ) ) {
			$html .= jws_query_string_form_fields( $value, $exclude, $key, true );
		} else {
			$html .= '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( wp_unslash( $value ) ) . '" />';
		}
	}

	if ( $return ) {
		return $html;
	}

	echo ''.$html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}



function jws_tv_shows_nummber($post_id) {
    
   $tv_shows_seasons = get_post_meta($post_id , 'tv_shows_seasons' , true);

   if(!empty($tv_shows_seasons)) {
       $number = $tv_shows_seasons;  
       ?>   
       <span class="seasions-numer"> <?php  printf( _n( '%s Season', '%s Seasons', $number , 'streamvid' ), number_format_i18n( $number ) ); ?> </span>
       <?php 
    }
 
}

function jws_tv_shows_background($post_id) {    
    $image_size = 'full';
    $main_thub = get_the_post_thumbnail_url($post_id,$image_size);
    $two_thub = get_post_meta($post_id , 'featured_image_two', true );
    $image =  wp_get_attachment_image_src($two_thub, 'full', false);
    $background = isset($image[0]) ? $image[0] : $main_thub;
    return $background;
}


function jws_videos_ratio() {
      
      $ratio = array(
       '21x9' => '21x9',
       '16x9' => '16x9',
       '4x3' => '4x3',
      );

      return $ratio;
      
}

function jws_responsive_option_carousel($settings) {
            
$settings['slides_to_show'] = isset($settings['slides_to_show']) && !empty($settings['slides_to_show']) ? $settings['slides_to_show'] : '3';
$settings['slides_to_show_laptop'] = isset($settings['slides_to_show_laptop']) && !empty($settings['slides_to_show_laptop']) ? $settings['slides_to_show_laptop'] : $settings['slides_to_show'];
$settings['slides_to_show_tablet'] = isset($settings['slides_to_show_tablet']) && !empty($settings['slides_to_show_tablet']) ? $settings['slides_to_show_tablet'] : $settings['slides_to_show'];
$settings['slides_to_show_mobile'] = isset($settings['slides_to_show_mobile']) && !empty($settings['slides_to_show_mobile']) ? $settings['slides_to_show_mobile'] : $settings['slides_to_show']; 
$settings['slides_to_scroll'] = isset($settings['slides_to_scroll']) && !empty($settings['slides_to_scroll']) ? $settings['slides_to_scroll'] : '1';
$settings['slides_to_scroll_laptop'] = isset($settings['slides_to_scroll_laptop']) && !empty($settings['slides_to_scroll_laptop']) ? $settings['slides_to_scroll_laptop'] : $settings['slides_to_scroll'];
$settings['slides_to_scroll_tablet'] = isset($settings['slides_to_scroll_tablet']) && !empty($settings['slides_to_scroll_tablet']) ? $settings['slides_to_scroll_tablet'] : $settings['slides_to_scroll'];
$settings['slides_to_scroll_mobile'] = isset($settings['slides_to_scroll_mobile']) && !empty($settings['slides_to_scroll_mobile']) ? $settings['slides_to_scroll_mobile'] : $settings['slides_to_scroll']; 

$variablewidth = ($settings['variablewidth'] == 'yes') ? 'true' : 'false'; 
        
if($variablewidth == 'true') {
   $settings['slides_to_show']  = $settings['slides_to_show_laptop'] = $settings['slides_to_show_tablet'] = $settings['slides_to_show_mobile'] = '1';
}
    
// Retrieve the page settings manager
$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit();

$active_breakpoints = $kit->get_settings('active_breakpoints');

if(in_array("viewport_laptop", $active_breakpoints)) {
    
    $viewlap = $kit->get_settings('viewport_laptop');
    
    $viewlap =  !empty($viewlap) ? $viewlap : '1366';
    
    
}

if(isset($viewlap)) {
    
    $respon_sive = '"responsive":{
        "'.$viewlap.'":{"items": '.$settings['slides_to_show'].',"slideBy": '.$settings['slides_to_scroll'].'},
        "1024":{"items": '.$settings['slides_to_show_laptop'].',"slideBy": '.$settings['slides_to_scroll_laptop'].'},
        "768":{"items": '.$settings['slides_to_show_tablet'].',"slideBy": '.$settings['slides_to_scroll_tablet'].'},
        "0":{"items": '.$settings['slides_to_show_mobile'].',"slideBy": '.$settings['slides_to_scroll_mobile'].'}
    }';
    
} else {
    
    $respon_sive = '"responsive":{
        "1024":{"items": '.$settings['slides_to_show'].',"slideBy": '.$settings['slides_to_scroll'].'},
        "768":{"items": '.$settings['slides_to_show_tablet'].',"slideBy": '.$settings['slides_to_scroll_tablet'].'},
        "0":{"items": '.$settings['slides_to_show_mobile'].',"slideBy": '.$settings['slides_to_scroll_mobile'].'}
    }';
    
}



return $respon_sive;
    
    
    
}

/*  Search Ajax   */


function search_item_ajax(){
        
        $args = wp_parse_args( $_POST , array(
            'search'    =>  '',
            'post_type' => '',
            'type_query' => ''
        ) );

        extract( $args );
        
    
       $post_type = $type_query == 'all' ? array('movies','tv_shows','episodes','videos') : array($post_type);
       
        
        $query_args = array(
            'post_type'         =>  $post_type,
            'post_status'       =>  'publish',
            'posts_per_page'    =>  50,
            'orderby'           =>  'name',
            'order'             =>  'ASC',
            's'                 =>  $s,
            'search_columns' => ['post_title'],
            'tax_query'         =>  array(),
        );
        
        
        $posts =  get_posts( apply_filters( 'jws_search_ajax_query', $query_args, $args ) );
        $type_result = array();
        if( empty( $s ) ){
            $results = sprintf(
                '<p class="not-found fs-small">%s</p>',
                esc_html__( 'Please enter keywords', 'streamvid' )
            );
             wp_send_json_success( $results );
        }

        if( $posts ){

            ob_start();
                for ( $i = 0; $i < count( $posts ) ; $i++ ) { 
       
                    global $post;
                    $post = $posts[$i];
                    setup_postdata( $post );
       
                    if (in_array("product", $post_type)) { 
            				$factory = new WC_Product_Factory();
            		}

                    $post_id = get_the_ID();
                    
                    $post_type_slug = get_post_type($post_id);
                    if (!in_array($post_type_slug, $type_result) && $post_type_slug != 'episodes') {
                        $type_result[] = $post_type_slug;
                    }
                
                    echo '<div class="search-item col-xl-6 col-lg-6 col-12">';
                    
                	  if (get_post_type($post_id) == 'product') {
    					$post_pro = $factory->get_product( $post_id );
                        ?>
                        <div class="search-images">
                            <?php 
                                echo ''.$post_pro->get_image();
                            ?>
                        </div>
                        <div class="search-content fs-small">
                            <h6 class="fs-small"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                            <?php 
                                echo ''.$post_pro->get_price_html();
                            ?>
                        </div>
                  
                        
                        
                        <?php
    				
    				} else {
    				    $years = get_post_meta($post_id , 'videos_years' , true);
                        $time = get_post_meta($post_id , 'videos_time' , true);
                        $episodes_number = get_post_meta($post_id , 'episodes_number' , true);
                        
                        ?>
                            
                        <div class="search-images">
                            <?php 
                                echo get_the_post_thumbnail( null, 'thumbnail', '' );
                            ?>
                        </div>
                        <div class="search-content fs-small">
                            <h6 class="fs-small"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h6>
                            <div class="video-meta meta-inline">
                                <?php 
                                    echo !empty($years) ? '<span class="video-years">'.$years.'</span>' : '';
                                    echo !empty($time) ? '<span class="video-time">'.$time.'</span>' : '';
                                    echo !empty($episodes_number) ? '<span class="video-time">'.$episodes_number.'</span>' : '';
                                    jws_tv_shows_nummber($post_id);
                                ?>
                            </div>
                        </div>
                            
                        <?php
    				}
                    
                    
                    echo '</div>';
    
                    wp_reset_postdata(); 
                }
              

            $results = ob_get_clean();
          
        }else{
            $results = sprintf(
                '<p class="not-found fs-small">%s</p>',
                esc_html__( 'Nothing matched your search terms', 'streamvid' )
            );
        }
       $type_result = array_unique($type_result);
       wp_send_json_success( compact('results','type_result') );
        
        
    }
add_action( 'wp_ajax_jws_ajax_search', 'search_item_ajax', 10 );
add_action( 'wp_ajax_nopriv_jws_ajax_search', 'search_item_ajax', 10 );   