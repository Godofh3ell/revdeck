<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage streamvid
 * @since 1.0.0
 */
global $jws_option; 

    $comments_number = get_comments_number();
    $archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
    $gallery = get_post_meta( get_the_ID(), 'blog_gallery', true );
    $image_size = (isset($jws_option['single_blog_imagesize']) && !empty($jws_option['single_blog_imagesize'])) ? $jws_option['single_blog_imagesize'] : 'full';
    $format = get_post_format();
    
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="row row-eq-height">
                  <div class="post-media col-xl-7 col-lg-6 <?php if(!has_post_thumbnail()) echo esc_attr(' post-no-thumbnail'); ?>">
                     
                        <?php 
                              $attach_id = get_post_thumbnail_id();
                              $image = jws_image_advanced(array('attach_id' => $attach_id, 'thumb_size' => $image_size));
                              echo !empty($image) ? $image : '';   
                      ?>
                   
                </div>

                <div class="jws-post-info col-xl-5 col-lg-6">
                    <span class="post_cat fs-small uppercase bage"><?php echo get_the_term_list(get_the_ID(), 'category', '', ', '); ?></span> 
                    <h3 class="entry_title">
                        <?php echo get_the_title(); ?>
                    </h3>
                    <div class="jws_post_excerpt">
                        <?php  echo get_the_excerpt();?>
                    </div>
                    <div class="jws_post_meta fs-small">
                        <span class="post_author"><?php echo '<a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author(); ?></a></span> 
                        <span class="entry-date"><a href="<?php echo esc_url(get_day_link($archive_year, $archive_month, $archive_day)); ?>"><?php echo get_the_date(); ?></a></span>

                        <a href="<?php echo get_the_permalink().'#comments'; ?>" class="entry-comment"><span class="jws-comment jws-icon-glyph-33"></span><?php echo sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'streamvid' ), $comments_number );; ?></span></a>
                   </div>  
                </div>
                
           </header>
           <div class="entry_content">
                <?php the_content(); ?> 
           </div>
           <div class="clear-both"></div>
           <footer>
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-12">
                        <?php echo jws_get_tags(); ?>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-12">
                        <?php if(function_exists('jws_share_buttons')) echo jws_share_buttons(); ?>
                    </div>
                </div>
                <?php 
                    get_template_part( 'template-parts/content/blog/single/template/author_box/author_box1' );
                 ?>
            </footer> 
            <?php 
                    get_template_part( 'template-parts/content/blog/single/template/nav/nav2' ); 
                    if (did_action( 'elementor/loaded' ) ) { 
                     ?>
                    <div class="post-related jws-blog-element">
                       
                            <?php get_template_part( 'template-parts/content/blog/single/template/related' ); ?>
                        
                    </div>
                    
           
                    <?php
                    }
                     // If comments are open or we have at least one comment, load up the comment template.
    				if ( comments_open() || get_comments_number() ) {
    					comments_template();
    				}
             ?>  
		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'streamvid' ),
				'after'  => '</div>',
			)
		);
		?>

</article><!-- #post-<?php the_ID(); ?> -->
