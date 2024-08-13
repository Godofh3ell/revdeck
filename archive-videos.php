<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage streamvid
 * @since 1.0.0
 */

get_header();

wp_enqueue_script( 'stick-content', JWS_URI_PATH. '/assets/js/sticky_content.js', array(), '', true );
$videos = jws_archive_option('videos');
$args = array(
     'image_size'    =>  jws_theme_get_option('videos_imagesize')
);
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main jws-videos-archive jws-videos-advanced-element <?php echo 'sidebar-'.esc_attr($videos['position_sidebar']); ?>">
        <div class="container">
        <div class="row">
             <?php if($videos['position_sidebar'] == 'left' && $videos['check-content-sidebar']) : ?>
                <div class="<?php echo esc_attr($videos['sidebar_col']); ?>">
                    <?php jws_sidebar_content($el_id = $videos['select-sidebar-post'] , $wg_id = 'sidebar-main'); ?>
                </div>
            <?php endif; ?> 
            <div class="<?php echo esc_attr($videos['content_col']); ?>">
                <div class="archive-nav row row-end-height">
                 <div class="col-xl-6 col-lg-12">
                    <a class="show_filter_shop" href="javascript:void(0)">
                        <i aria-hidden="true" class="jws-icon-plus"></i>
                        <span><?php echo esc_html__('Filters','streamvid'); ?></span>
                    </a>
                    <?php jws_post_result();?>
                 </div>  
                 <div class="col-xl-6 col-lg-12">
                    <?php  do_action('streamvid/videos/filter'); ?>
                 </div>  
                 
                
                </div>
                <div class="videos-advanced-content row <?php echo esc_attr($videos['layout']); ?>">
                	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
            
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                             
                            echo '<div class="'.$videos['column'].'">'; 
            				    get_template_part( 'template-parts/content/videos/layout/'.$videos['layout'] , '' , $args );
                            echo '</div>'; 
            
            				// End the loop.
            			endwhile;
            
            
            			// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'template-parts/content/content', 'none' );
            
            		endif;
            		?>
                    </div> 
                    <?php global $wp_query;   echo function_exists('jws_query_pagination') ? jws_query_pagination($wp_query) : ''; ?>
            </div>
            <?php if($videos['position_sidebar'] == 'right' && $videos['check-content-sidebar'] ) : ?>
                <div class="<?php echo esc_attr($videos['sidebar_col']); ?>">
                    <?php jws_sidebar_content($el_id = $videos['select-sidebar-post'] , $wg_id = 'sidebar-main'); ?>
                </div>
            <?php endif; ?>    
        </div>
	
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->  
<?php
get_footer();