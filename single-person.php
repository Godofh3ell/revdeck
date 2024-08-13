<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage streamvid
 * @since 1.0.0
 */

get_header();


?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
         
            <div class="container">
                <?php 
                   if( have_posts() ): the_post();
                       get_template_part( 
        	                'template-parts/content/person/single/content-single'
    	               ); 
           
  
                   endif;
    			?>

           </div>      
          
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer();