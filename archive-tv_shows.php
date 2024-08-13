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
$tv_shows = jws_archive_option('tv_shows');
$args = array(
     'image_size'    =>  jws_theme_get_option('tv_shows_imagesize')
);
?>
<div id="primary" class="content-area">
		<main id="main" class="site-main jws-tv_shows-archive jws-tv-shows-advanced-element <?php echo 'sidebar-'.esc_attr($tv_shows['position_sidebar']); ?>">
        <div class="container">
        <div class="row">
             <?php if($tv_shows['position_sidebar'] == 'left' && $tv_shows['check-content-sidebar']) : ?>
                <div class="<?php echo esc_attr($tv_shows['sidebar_col']); ?>">
                    <?php jws_sidebar_content($el_id = $tv_shows['select-sidebar-post'] , $wg_id = 'sidebar-main'); ?>
                </div>
            <?php endif; ?> 
            <div class="<?php echo esc_attr($tv_shows['content_col']); ?>">
                <div class="archive-nav row row-end-height">
                 <div class="col-xl-4 col-lg-12">
                    <a class="show_filter_shop" href="javascript:void(0)">
                        <i aria-hidden="true" class="jws-icon-plus"></i>
                        <span><?php echo esc_html__('Filters','streamvid'); ?></span>
                    </a>
                    <?php jws_post_result();?>
                 </div>  
                 <div class="col-xl-8 col-lg-12">
                    <?php  do_action('streamvid/videos/filter',array('year'=>true,'category'=>true)); ?>
                 </div>  
                </div>
                <div class="tv-shows-advanced-content row <?php echo esc_attr($tv_shows['layout']); ?>">
                	<?php if ( have_posts() ) :
            			while ( have_posts() ) :
            				the_post();
            
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
                             
                            echo '<div class="'.$tv_shows['column'].'">'; 
            				    get_template_part( 'template-parts/content/tv_shows/layout/'.$tv_shows['layout'] , '' , $args );
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
            <?php if($tv_shows['position_sidebar'] == 'right' && $tv_shows['check-content-sidebar'] ) : ?>
                <div class="<?php echo esc_attr($tv_shows['sidebar_col']); ?>">
                    <?php jws_sidebar_content($el_id = $tv_shows['select-sidebar-post'] , $wg_id = 'sidebar-main'); ?>
                </div>
            <?php endif; ?>    
        </div>
	
        </div>
		</main><!-- #main -->
	</div><!-- #primary -->  
<?php
get_footer();